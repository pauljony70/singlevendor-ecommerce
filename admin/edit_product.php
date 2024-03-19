<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
}
$productid = $_POST['productid'];
$stock = $_POST['stock'];
$rowProdJsonArray = "";
?>
<?php include("header.php"); ?>

<?php
$variantvalue = "";
function variantTree($parent_idv = 0, $sub_mark = '')
{
  global $conn;
  $query2 = $conn->query("SELECT * FROM product_variant_cat WHERE parent_id = $parent_idv ORDER BY variant_name ASC");

  if ($query2->num_rows > 0) {
    while ($row = $query2->fetch_assoc()) {
      echo '<option value="' . $row['variant_name'] . '">' . $sub_mark . $row['variant_name'] . '</option>';
      variantTree($row['variant_id'], $sub_mark . '---');
    }
  }
}
?>

<!-- main content start-->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">Edit Product</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Configurations</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body p-2">
                      <!-- <div class="col-sm-8" id="add_more_attr_btndiv">
                        <a class="fa fa-plus fa-4 btn btn-dark waves-effect waves-light" aria-hidden="true" onclick="add_more_attrs();">Add More Attributes</a>
                      </div> -->
                      <form class="form-horizontal" id="myform_attr">
                        <div class="form-group row align-items-center">
                          <div class="form-group mb-0">
                            <div class="col-sm-12">
                              <div class="attributes">
                                <table class="table table-sm table-borderless mb-0">
                                  <tbody id="selectattrs_div"></tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark waves-effect waves-light" id="manage_configurations_btn" onclick=" return manage_configurations();">Add Configurations</button>
                    </div>
                  </div>

                </div>
              </div>

              <?php

              $product_details = array();
              $stmt = $conn->prepare("SELECT * FROM productdetails WHERE prod_id=?");
              $stmt->bind_param("s", $productid);
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  // Print or use the data as needed
                  $product_details = $row;
                }
              }

              $stmt->close();

              // echo "<pre>";
              // print_r($product_details);
              // exit;
              ?>

              <div class="form-three widget-shadow">
                <form class="form-horizontal" id="myform" method="post" enctype="multipart/form-data">
                  <a> ** required field</a>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Product Name **</label>
                    <input type="hidden" class="form-control" id="prod_id" name="prod_id" value=<?= $productid; ?>></input>

                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_name" name="prod_name" value="<?= $product_details['prod_name']; ?>" placeholder="Name" required>
                    </div>
                    <div class="col-sm-2">
                      <p class="help-block"></p>
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Product Name Arabic **</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_name_ar" name="prod_name_ar" value="<?= $product_details['name_ar']; ?>" placeholder="Name Arabic">
                    </div>
                    <div class="col-sm-2">
                      <p class="help-block"></p>
                    </div>
                  </div>
                  <div class="form-group row d-none">
                    <label for="focusedinput" class="col-sm-2 control-label">Product Short details **</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_short" name="prod_short" value="<?= $product_details['prod_desc'] ?>" placeholder="Short description">
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Product Short details Arabic **</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_short_ar" name="prod_short_ar" value="<?= $product_details['short_ar'] ?>" placeholder="Short description Arabic">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Product Full Details **</label>
                    <div class="col-sm-8">
                      <textarea rows="6" cols="90" class="form-control" id="prod_details" name="prod_details" form="usrform" required placeholder="Enter text here..."><?= $product_details['prod_fulldetail']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Product Full Details Arabic **</label>
                    <div class="col-sm-8">
                      <textarea rows="6" cols="90" class="form-control" id="prod_details_ar" name="prod_details_ar" form="myform" placeholder="Enter text here..."><?= $product_details['prod_fulldetail']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">MRP **</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_mrp" name="prod_mrp" value="<?= $product_details['prod_mrp']; ?>" placeholder="MRP ex. 450" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Sale Price**</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_price" name="prod_price" value="<?= $product_details['prod_price']; ?>" placeholder="Sale Price ex. 235" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Stock </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_qty" name="prod_qty" value="<?= $product_details['stock']; ?>" placeholder="Quantity ex. 20, 50">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputFile" class="col-sm-2 control-label">Configurations</label>
                    <div class="col-sm-8">
                      <a class="btn btn-dark text-light" aria-hidden="true" id="moreAttribute"><i class="fa-solid fa-plus"></i> Add Configuration</a>
                    </div>
                  </div>
                  <div class="form-group row align-items-center">
                    <label for="focusedinput" class="col-sm-2 control-label mt-1"> </label>
                    <div class="col-sm-8">
                      <div id="skip_pric" style="display:none;">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="skip_sale_price" id="skip_sale_price" value="1">
                          <label class="form-check-label" for="skip_sale_price">Apply single price to all SKUs</label>
                        </div>
                      </div>
                      <div id="configurations_div_html" class="table-responsive">
                        <?php

                        $stmtcp = $conn->query("SELECT * FROM product_attribute_value WHERE product_id = '" . $product_details['prod_id'] . "'");

                        // $stmtcp->execute();
                        //	$data = $stmtcp->bind_result($conf_id, $product_sku, $prices, $mrps,$stocks);
                        if ($stmtcp->num_rows > 0) {

                        ?>
                          <table class="table table-bordered table-centered mt-1">
                            <thead class="thead-light">
                              <tr>
                                <th>Product Name</th>
                                <th>Sale Price</th>
                                <th>MRP </th>
                                <th>STOCK </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                              while ($rows = $stmtcp->fetch_assoc()) {
                                $prices = $rows['price'];
                                $mrps = $rows['mrp'];
                                $stocks = $rows['stock'];
                                $conf_id = $rows['id'];
                                $prod_attr_value = implode('-', json_decode($rows['prod_attr_value'], true));

                              ?>
                                <tr id="remove_attr_tr1"><input type="hidden" name="conf_ids[]" value="<?= $conf_id; ?>" style="width: 100%;">
                                  <td><?= preg_replace('/[^a-zA-Z0-9]/', '-', $product_details['prod_name']) . '-' . $prod_attr_value ?></td>
                                  <td><input type="number" name="sale_price[]" class="sale_prices form-control" value="<?= $prices; ?>" style="width: 100%;"></td>
                                  <td><input type="number" name="mrp_price[]" class="mrp_price form-control" value="<?= $mrps; ?>" style="width: 100%;"></td>
                                  <td><input type="number" name="stocks[]" class="form-control" value="<?= $stocks; ?>" style="width: 100%;"></td>
                                </tr>

                              <?php } ?>
                            </tbody>
                          </table>
                        <?php } ?>

                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">SKU Code</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_hsn" name="prod_hsn" placeholder="Product SKU code" value="<?= $product_details['hsn_code']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">CGST (in %)</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_cgst" name="prod_cgst" value="<?= $product_details['cgst']; ?>" placeholder="CGST on sale price. Example. 5, 18 ">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">SGST (in %)</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_sgst" name="prod_sgst" value="<?= $product_details['sgst']; ?>" placeholder="SGST on sale price. Example. 5, 18 ">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">IGST (in %)</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_igst" name="prod_igst" value="<?= $product_details['igst']; ?>" placeholder="IGST on sale price. Example. 5, 18 ">
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label class="col-sm-2 control-label">Essential free ship</label>
                    <div class="col-sm-8">
                      <select class="form-control" id="freeshipessential" name="freeshipessential">
                        <?php
                        if ($product_details['freeship'] == 0) {

                          echo '<option value="0" selected>No</option>';
                          echo '<option value="1" >Yes</option>';
                        } else {
                          echo '<option value="0" >No</option>';
                          echo '<option value="1" selected>Yes</option>';
                        }

                        ?>

                      </select>
                    </div>
                  </div>

                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Shipping Cost</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="shipping" name="shipping" value="<?= $product_details['shipping']; ?>" placeholder="Shipping Cost. Ex. 50">
                    </div>
                  </div>

                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Whole Sale Price</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="w_price" name="w_price" value="<?= $product_details['w_price']; ?>" placeholder="Single Product Price without Tax in Whole sale">
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Min. Whole Sale Qty.</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="w_qty" name="w_qty" value="<?= $product_details['w_qty']; ?>" placeholder="Min. Quantity required to place order in whole sale.">
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="color" name="color" placeholder="use , for multiple color. Example red, yellow, blue" value="<?= json_decode($product_details['other_attribute'])->color; ?>">
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Size </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="size" name="size" placeholder="use , for multiple size. Example S, M, L, XL" value="<?= json_decode($product_details['other_attribute'])->size; ?>">
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Weight </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="weight" name="weight" placeholder="Ex. 200 gm, 1 kg" value="<?= json_decode($product_details['other_attribute'])->weight; ?>">
                    </div>
                  </div>



                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Display Stock</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="displaystock" name="displaystock" value="<?= $product_details['displaystock']; ?>" placeholder="Display Stock ex. 200, 500">
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Stockist Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="sellername" name="sellername" value="<?= $product_details['sellername']; ?>" placeholder="Stockist Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Remarks</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_remark" name="prod_remark" value="<?= $product_details['prod_remark']; ?>" placeholder="200 sold in 3 hours">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Rating Star </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_rating" name="prod_rating" value="<?= $product_details['prod_rating']; ?>" placeholder="Ex. Rating between 1 to 5">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Rating Count </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_ratingcount" name="prod_ratingcount" value="<?= $product_details['prod_rating_count']; ?>" placeholder="Ex. 200, 556">
                    </div>
                  </div>
                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Unit </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="unit" name="unit" value="<?= $product_details['unit']; ?>" placeholder="Example - gm, kg. bottle">
                    </div>
                  </div>

                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Discount Coins</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_discountcoins" name="prod_discountcoins" placeholder="1 coins = 1 rupee" value="<?= $product_details['discount_coins']; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="display:none;">
                    <label for="focusedinput" class="col-sm-2 control-label">Refer Coins</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="prod_refercoins" name="prod_refercoins" placeholder="Ex. 20" value="<?= $product_details['coins']; ?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 control-label">Select Category **</label>
                    <div class="col-sm-8">
                      <select class="form-control" id="selectcategory" name="selectcategory">
                        <?php

                        // $catidd = $catid;                                         
                        function categoryTree($parent_id = 0, $sub_mark = '')
                        {
                          global $conn;
                          global $product_details;
                          $query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id ORDER BY cat_name ASC");

                          if ($query->num_rows > 0) {
                            while ($row = $query->fetch_assoc()) {

                              if ($row['cat_id'] == $product_details['cat_id']) {

                                echo '<option value="' . $row['cat_id'] . '" selected>' . $sub_mark . $row['cat_name'] . '</option>';
                              } else {
                                echo '<option value="' . $row['cat_id'] . '">' . $sub_mark . $row['cat_name'] . '</option>';
                              }
                              categoryTree($row['cat_id'], $sub_mark . '---');
                            }
                          }
                        }
                        categoryTree();

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 control-label">Select Brand **</label>
                    <div class="col-sm-8">
                      <select class="form-control" id="selectbrand" name="selectbrand">
                        <?php

                        echo '<option value="blank">Select Brand </option>';
                        $stmt = $conn->prepare("SELECT brand_id, brand_name FROM brand ORDER By brand_name ASC");
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($col31, $col32);

                        while ($stmt->fetch()) {
                          if ($col31 === $product_details['brand_id']) {

                            echo '<option value="' . $col31 . '" selected>' . $col32 . '</option>';
                          } else {
                            echo '<option value="' . $col31 . '">' . $col32 . '</option>';
                          }
                        }


                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="exampleInputFile" class="col-md-2 control-label">Product Galley</label>
                    <div class="col-md-8">
                      <div class="p-3" style="background-color: #F6EAEA;">
                        <div class="d-flex flex-wrap" id="bt_list" style="gap: 10px;">
                          <?php
                          $oldarray = json_decode($product_details['prod_img_url'], true) ?? array();
                          $count = 0;
                          foreach ($oldarray as $arraykey) {
                            $prod_url = MEDIA_URL . $arraykey;
                            echo
                            '<div style="position: relative">
                              <a class="label font-weight-bolder text-danger position-absolute" style="right: 3px; cursor: pointer;" onclick="deleteImg(' . $count . ')" >DELETE</a>
                              <img src=' . $prod_url . ' alt=' . $prod_url . ' height="150">
                            </div>';
                            $count = $count + 1;
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- icon-hover-effects -->

                  </br>
                  <input type="hidden" class="form-control" id="prod_imgurl" value="<?= $product_details['prod_img_url']; ?>"></input>

                  <div class="form-group row">
                    <label for="exampleInputFile" class="col-sm-2 control-label">Product Images</label>
                    <div class="col-sm-8 input-files1">
                      <a class="btn btn-primary text-light" aria-hidden="true" id="moreImg"><i class="fa fa-plus"></i> Add More Image</a>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="exampleInputFile" class="col-sm-2 control-label">Images</label>
                    <div class="col-sm-9">
                      <div class="input-files">
                        <div style="vertical-align: middle; margin-top:5px;">
                          <input type="file" name="prod_image[]" id="1" style="float:left; display: inline-block; margin-right:20px;" data-parsley-errors-container="#product-image-error">
                          <button type="button" class="btn btn-danger" onclick="removeImage('1'); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</button><br><br>
                          <div id="product-image-error" role="alert"></div>
                        </div>
                        </br>
                      </div>
                    </div>
                  </div>



                  </br></br>
                  <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-dark" href="javascript:void(0)" onclick="javascript:history.back()">Cancel</button>

                  </div>


                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--		</div>  -->
    </div>


    <div class="clearfix"> </div>

  </div>






  <div class="clearfix"> </div>

</div>


<div class="col_1">


  <div class="clearfix"> </div>

</div>

<!--footer-->
<?php include('footernew.php'); ?>
<script src="<?= BASEURL . 'admin/js/admin/edit-product.js' ?>"></script>