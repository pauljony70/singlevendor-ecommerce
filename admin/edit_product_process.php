<?php
include('session.php');
include('common_functions.php');

// Assign sanitized values to variables
$prod_id = sanitizeInput($_POST['prod_id']);
$name = sanitizeInput($_POST['prod_name']);
$short = sanitizeInput($_POST['prod_short']);
$full = sanitizeInput($_POST['prod_details']);
$name_ar = sanitizeInput($_POST['prod_name_ar']);
$short_ar = sanitizeInput($_POST['prod_short_ar']);
$full_ar = sanitizeInput($_POST['prod_details_ar']);
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
$remark = sanitizeInput($_POST['prod_remark']);
$unit = sanitizeInput($_POST['unit']);
$cat = sanitizeInput($_POST['selectcategory']);
$brand = sanitizeInput($_POST['selectbrand']);
$imagejson = array();
$editdone = false;

// Check admin session
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
  die;
}

global $conn;

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

try {
  $product_details = array();
  $stmt = $conn->prepare("SELECT * FROM productdetails WHERE prod_id=?");
  $stmt->bind_param("i", $prod_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      // Print or use the data as needed
      $product_details = $row;
    }
  }
  $prod_img_url = json_decode($product_details['prod_img_url']) ?? array();

  $stmt->close();

  if (isset($_FILES['prod_image']['name']) && !empty($_FILES['prod_image']['name'])) {
    $image_array = secureImageUpload($_FILES['prod_image'], '../media/');
    $imagejson = json_encode(array_column($image_array, 'filePath'), JSON_PRETTY_PRINT);
    $imagejson = json_decode($imagejson, true);
  }

  $imagejson = json_encode(array_merge($prod_img_url, $imagejson));

  $datetime = date('Y-m-d H:i:s');
  $other_attr = json_encode(['size' => $size, 'color' => $color, 'weight' => $weight]);

  $rating = sanitizeInput($_POST['prod_rating']);
  $ratingcount = sanitizeInput($_POST['prod_ratingcount']);
  $reviewid = "";

  $stmt11 = $conn->prepare("UPDATE productdetails SET prod_name = ?, prod_desc = ?, prod_fulldetail = ?, name_ar = ?, short_ar = ?, desc_ar = ?, prod_mrp = ?, prod_price = ?, cgst = ?, sgst = ?, igst = ?, shipping = ?, hsn_code = ?, w_price = ?, w_qty = ?, other_attribute = ?, stock = ?, unit = ?, prod_rating = ?, prod_rating_count = ?, prod_img_url = ?, cat_id = ?, brand_id = ?, review_id = ?, update_by = ?, pricearray = ?, coins = ?, discount_coins = ?, displaystock = ?, sellername = ?, prod_remark = ? WHERE prod_id = ?");
  $stmt11->bind_param("ssssssddddddsdisiidisiiisssssssi", $name, $short, $full, $name_ar, $short_ar, $full_ar, $mrp, $price, $cgst, $sgst, $igst, $shipping, $hsn, $w_price, $w_qty, $other_attr, $stockqty, $unit, $rating, $ratingcount, $imagejson, $cat, $brand, $reviewid, $datetime,  $pricearray, $refercoins, $discountcoins, $displaystock, $sellername, $remark, $prod_id);
  $stmt11->execute();
  $stmt11->store_result();


  if ($stmt11->affected_rows > 0) {
    $editdone  = true;
  }

  $stmt12 = $conn->prepare("UPDATE product SET prod_name =?, prod_stock =?, prod_cat_id=?, prod_brand_id=? WHERE prod_id=?");
  $stmt12->bind_param("siiii", $name, $stockqty, $cat, $brand, $prod_id);
  $stmt12->execute();
  $stmt12->store_result();

  if ($stmt12->affected_rows > 0) {
    $editdone = true;
  }

  if (array_key_exists('selected_attr', $_POST) && array_key_exists('attr_combination', $_POST)) {
    if (count($_POST['selected_attr']) > 0 && count($_POST['attr_combination']) > 0) {
      $delete_product_attribute = $conn->prepare("DELETE FROM `product_attribute`  WHERE `prod_id` = '" . $prod_id . "' ");
      $delete_product_attribute->execute();

      $delete_product_attribute_value = $conn->prepare("DELETE FROM `product_attribute_value` WHERE `product_id` = ?");
      $delete_product_attribute_value->bind_param("i", $prod_id);

      $select_conf_image = $conn->prepare("SELECT `conf_image` FROM `product_attribute_value` WHERE `product_id` = ?");
      $select_conf_image->bind_param("i", $prod_id);
      $select_conf_image->execute();
      $select_conf_image->bind_result($conf_image_before_delete);
      $select_conf_image->fetch();
      $select_conf_image->close();

      if ($delete_product_attribute_value->execute()) {
        // If deletion is successful, proceed to unlink images
        if ($conf_image_before_delete) {
          // Unlink images if the conf_image field is not empty
          $image_paths = json_decode($conf_image_before_delete, true);

          if (!empty($image_paths)) {
            foreach ($image_paths as $image_path) {
              // Assuming $your_image_directory is the directory where the images are stored
              unlinkFile($image_path);
            }
          }
        }
      }

      $delete_product_attribute_value->close();

      $prod_stock = 0;
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
        $prod_stock += $stocks;

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

      $sql_meta_prep = $conn->prepare("INSERT INTO `product_attribute_value`(`product_id`, `prod_attr_value`, `price`, `mrp`, `stock`,`conf_image`, `notify_on_stock_below`) VALUES " . $sql_attr);
      $sql_meta_prep->execute();
      $sql_meta_prep->store_result();

      if ($sql_meta_prep->affected_rows > 0) {
        $editdone = true;

        $stmt13 = $conn->prepare("UPDATE product SET prod_stock = ? WHERE prod_id = ?");
        $stmt13->bind_param("ii", $prod_stock, $prod_id);
        $stmt13->execute();

        $stmt14 = $conn->prepare("UPDATE productdetails SET stock = ? WHERE prod_id = ?");
        $stmt14->bind_param("ii", $prod_stock, $prod_id);
        $stmt14->execute();
      }
    }
  } else {
    if (array_key_exists('mrp_price', $_POST) && array_key_exists('sale_price', $_POST)) {
      $sale_price = $_POST['sale_price'];
      $mrp_price = $_POST['mrp_price'];
      $stocks = $_POST['stocks'];
      $conf_ids = $_POST['conf_ids'];
      $prod_stock = 0;
      $count_varient = count($_POST['conf_ids']);
      for ($v = 0; $v < $count_varient; $v++) {
        $prod_stock += $stocks[$v];
        $sql_meta_prep = $conn->prepare("UPDATE `product_attribute_value` SET `price` ='" . $sale_price[$v] . "' , `mrp` = '" . $mrp_price[$v] . "', `stock` = '" . $stocks[$v] . "', `notify_on_stock_below` = 1 WHERE `product_id` = '" . $prod_id . "' AND id ='" . $conf_ids[$v] . "'");
        $sql_meta_prep->execute();
        $sql_meta_prep->store_result();

        if ($sql_meta_prep->affected_rows > 0) {
          $editdone = true;
        }
      }

      $stmt13 = $conn->prepare("UPDATE product SET prod_stock = ? WHERE prod_id = ?");
      $stmt13->bind_param("ii", $prod_stock, $prod_id);
      $stmt13->execute();

      $stmt14 = $conn->prepare("UPDATE productdetails SET stock = ? WHERE prod_id = ?");
      $stmt14->bind_param("ii", $prod_stock, $prod_id);
      $stmt14->execute();
    }
  }
  
  $conn->close();

  if ($editdone) {
    echo "Edit Successful";
  } else {
    echo "No rows are affected.";
  }
} //catch exception
catch (Exception $e) {
  echo 'Message: ' . $e->getMessage();
}

function sanitizeInput($input)
{
  return stripslashes(htmlspecialchars(trim($input)));
}
