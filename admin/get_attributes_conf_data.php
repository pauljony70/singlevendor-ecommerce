<?php
include('session.php');

$code = $_POST['code'];
$code =   stripslashes($code);

$error = '';  // Variable To Store Error Message

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else
if ($code == $_SESSION['_token']) {
    try {

        if ($_POST['selectattrs'] && $_POST['product_name']) {
            echo
            '<table class="table table-bordered table-centered mt-1">
                <thead class="thead-light">
                    <tr>
                        <th>Product Name</th>
                        <!-- <th>Product SKU</th> -->
                        <th>Sale Price</th>
                        <th>MRP</th>
                        <th>STOCK</th>
                        <th>Image</th>
                        <!-- <th>Remove</th> -->
                    </tr>
                </thead>
                <tbody>';
            $html = '';
            $product_name = $_POST['product_name'];
            foreach ($_POST['selectattrs'] as $selectattrs) {
                $attr_val = $_POST['attr' . $selectattrs];
                if (!empty($attr_val)) {
                    $data[] = $attr_val;
                    $attr_arr = array("attribute_id" => $selectattrs, "attribute_val" => $attr_val);
                    echo "<input type='hidden' name='selected_attr[]' value='" . json_encode($attr_arr) . "'>";
                }
            }
            $combos = combos($data);

            $i = 0;
            foreach ($combos as $key => $attr_sel) {
                $i++;
                $html .=  "<tr id='remove_attr_tr" . $i . "'><input type='hidden' name='attr_combination[]' value='" . json_encode($attr_sel, JSON_FORCE_OBJECT) . "'>";
                $html .=  '<td>' . $product_name . '-' . implode("-", $attr_sel) . '</td>
                            <!-- <td><input type ="text" class="form-control" name="prod_skus[]" readonly value="' . str_replace(" ", "-", $product_name) . '-' . implode("-", $attr_sel) . '" style="width: auto;"></td> -->
                            <td><input type ="number" name="sale_price[]" class="form-control sale_prices" style="width: 80px;"></td>
                            <td><input type ="number" name="mrp_price[]" class="form-control mrp_price" style="width: 80px;" ></td>
                            <td><input type ="number" class="form-control" name="stocks[]" style="width: 80px;"></td>
                            <td><div class="d-flex align-items-center"><input type ="file" class="form-control-file" name="conf_image' . $key . '[]" style="width: auto;" accept="image/*" multiple><div id="image-viewer"></div></td>
                            <!-- <td><a href="javascript:void(0);" class="btn btn-sm btn-danger waves-effect waves-light" onclick=remove_attr_tr("remove_attr_tr' . $i . '"); return false;">Remove</a></td> -->
                    </tr>';
            }
            echo  $html;

            echo '</tbody> </table>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function combos($data, &$all = array(), $group = array(), $val = null, $i = 0)
{
    if (isset($val)) {
        array_push($group, $val);
    }
    if ($i >= count($data)) {
        array_push($all, $group);
    } else {
        foreach ($data[$i] as $v) {
            combos($data, $all, $group, $v, $i + 1);
        }
    }
    return $all;
}
