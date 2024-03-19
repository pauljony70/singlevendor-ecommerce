<?php
include('session.php');
include('common_functions.php');

// Validate and sanitize input data
/* $requiredFields = ['prod_name', 'short', 'prod_details', 'name_ar', 'short_ar', 'full_ar', 'prod_mrp', 'prod_price', 'prod_cgst', 'prod_sgst', 'prod_igst', 'shipping', 'prod_hsn', 'w_price', 'w_qty', 'color', 'size', 'weight', 'prod_qty', 'unit', 'selectcategory', 'selectbrand', 'imagejson'];
foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        echo "Invalid Parameters. Please fill all required fields.";
        die;
    }
} */

// Assign sanitized values to variables
$name = sanitizeInput($_POST['prod_name']);
$short = sanitizeInput($_POST['short']);
$full = sanitizeInput($_POST['prod_details']);
$name_ar = sanitizeInput($_POST['name_ar']);
$short_ar = sanitizeInput($_POST['short_ar']);
$full_ar = sanitizeInput($_POST['full_ar']);
$mrp = sanitizeInput($_POST['prod_mrp']);
$price = sanitizeInput($_POST['prod_price']);
$cgst = sanitizeInput($_POST['prod_cgst']);
$sgst = sanitizeInput($_POST['prod_sgst']);
$igst = sanitizeInput($_POST['prod_igst']);
$shipping = sanitizeInput($_POST['shipping']);
$hsn = sanitizeInput($_POST['prod_hsn']);
$w_price = sanitizeInput($_POST['w_price']);
$w_qty = sanitizeInput($_POST['w_qty']);
$color = sanitizeInput($_POST['color']);
$size = sanitizeInput($_POST['size']);
$weight = sanitizeInput($_POST['weight']);
$stockqty = sanitizeInput($_POST['prod_qty']);
$unit = sanitizeInput($_POST['unit']);
$cat = sanitizeInput($_POST['selectcategory']);
$brand = sanitizeInput($_POST['selectbrand']);
$imagejson = "";

// Additional sanitization for file upload
if (isset($_FILES['prod_image']['name']) && !empty($_FILES['prod_image']['name'])) {
    $image_array = secureImageUpload($_FILES['prod_image'], '../media/');
    $imagejson = json_encode(array_column($image_array, 'filePath'), JSON_PRETTY_PRINT);
}

// Check admin session
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    die;
}

// Database connection
include('../app/db_connection.php');
global $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start transaction
$conn->begin_transaction();

try {
    $datetime = date('Y-m-d H:i:s');
    $other_art = json_encode(['size' => $size, 'color' => $color, 'weight' => $weight]);

    $rating = sanitizeInput($_POST['prod_rating']);
    $ratingcount = sanitizeInput($_POST['prod_ratingcount']);
    $reviewid = "";
    $stmt11 = $conn->prepare("INSERT INTO productdetails( prod_name, prod_desc, prod_fulldetail, name_ar, short_ar, desc_ar, prod_mrp, prod_price, cgst, sgst, igst, shipping, hsn_code, w_price, w_qty, other_attribute, stock, unit, prod_rating, prod_rating_count, prod_img_url, cat_id, brand_id, review_id, create_by, update_by, pricearray,  coins, discount_coins, displaystock, sellername, prod_remark )  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt11->bind_param("ssssssddddddsdisisdisiiisssiiiss", $name, $short, $full, $name_ar, $short_ar, $full_ar, $mrp, $price, $cgst, $sgst, $igst, $shipping, $hsn, $w_price, $w_qty, $other_art, $stockqty, $unit, $rating, $ratingcount, $imagejson, $cat, $brand, $reviewid, $datetime, $datetime, $pricearray, $refercoins, $discountcoins, $displaystock, $sellername, $remark);
    $stmt11->execute();
    $stmt11->store_result();
    $rows = $stmt11->affected_rows;

    if ($rows > 0) {
        $prod_id = $stmt11->insert_id;
        $defaultstatus = "active";
        $stmt12 = $conn->prepare("INSERT INTO product( prod_id, prod_name, prod_stock,  prod_brand_id, prod_cat_id, status)  VALUES (?,?,?,?,?,?)");
        $stmt12->bind_param("isiiis", $prod_id, $name, $stockqty, $brand, $cat, $defaultstatus);
        $stmt12->execute();
        $stmt12->store_result();
        $rows2 = $stmt12->affected_rows;

        if ($rows2 > 0) {
            if (array_key_exists('selected_attr', $_POST) && array_key_exists('attr_combination', $_POST)) {
                if (count($_POST['selected_attr']) > 0 && count($_POST['attr_combination']) > 0) {
                    foreach ($_POST['selected_attr'] as $attr_json) {
                        $attr_json_decod = json_decode($attr_json);
                        $attr_id = $attr_json_decod->attribute_id;
                        $attribute_val = json_encode($attr_json_decod->attribute_val, JSON_FORCE_OBJECT);

                        $sql_attr_prep = $conn->prepare("INSERT INTO `product_attribute`(`prod_attr_id`,`prod_id`,`attr_value`) VALUES (?,?,?)");
                        $sql_attr_prep->bind_param("iss", $attr_id, $prod_id, $attribute_val);
                        $sql_attr_prep->execute();
                        $sql_attr_prep->store_result();
                    }

                    $sql_attr = '';
                    $count_varient = count($_POST['attr_combination']);
                    for ($v = 0; $v < $count_varient; $v++) {
                        $varient_val = json_encode($_POST['attr_combination'][$v], JSON_FORCE_OBJECT);
                        $sale_price = $_POST['sale_price'][$v];
                        $mrp_price = $_POST['mrp_price'][$v];
                        $stocks = $_POST['stocks'][$v];

                        if ($_FILES['conf_image' . $v]['name']) {
                            $conf_image = [];
                            $conf_image_array = secureImageUpload($_FILES['conf_image' . $v], '../media/');
                            foreach ($conf_image_array as $image) {
                              if ($image['status'] === 'success') {
                                $conf_image[] = $image['filePath'];
                              }
                            }
                  
                            $conf_image = json_encode($conf_image);
                          }

                        $sql_attr .= "('" . $prod_id . "', " . $varient_val . ", '" . $sale_price . "', '" . $mrp_price . "', '" . $stocks . "','" . $conf_image . "', 1),";
                    }
                    $sql_attr .= ";";
                    $sql_attr = str_replace(',;', ';', $sql_attr);

                    $sql_meta_prep = $conn->prepare("INSERT INTO `product_attribute_value`(`product_id`, `prod_attr_value`, `price`, `mrp`, `stock`,`conf_image`, `notify_on_stock_below`) 
                            VALUES " . $sql_attr);
                    $sql_meta_prep->execute();
                    $sql_meta_prep->store_result();
                }
            }

            // Commit the transaction
            $conn->commit();
            echo "Product Added Successfully";
        } else {
            throw new Exception("Failed to add. Please try again");
        }
    } else {
        throw new Exception("Failed to add. Please try again");
    }
} catch (Exception $e) {
    // Rollback the transaction on exception
    $conn->rollback();
    echo $e->getMessage();
}

function sanitizeInput($input)
{
    return stripslashes(htmlspecialchars(trim($input)));
}

die;
?>
