<?php
include('session.php');
//include('../db_connection.php');
//session_start();// Starting Session

//echo "admin is ".$_SESSION['admin'];
if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
  // echo " dashboard redirect to index";
}

?>
<?php include("header.php"); ?>

<!-- main content start-->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">All Products</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div data-example-id="simple-form-inline">

                <div class="row">
                  <div class="col-12 d-flex flex-wrap align-items-center">
                    <div class="form-group mb-0">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Name.." name="search" style="width:300px;" id="search_name">
                        <button type="submit" class="btn btn-dark" href="javascript:void(0)" onclick="searchName(this); return false;"><i class="fa fa-search"></i></button>
                      </div>
                    </div>

                    <div style=" display: inline-block;  vertical-align: middle">
                      <b>&nbsp;&nbsp; Sorted By : &nbsp;&nbsp;</b>
                      <input type="checkbox" id="Checkcat" onclick="sortbycatfun()"> Category <a>&nbsp;&nbsp;</a>
                      <input type="checkbox" id="Checklowstock" onclick="sortbycatfun()"> Lowstock <a>&nbsp;&nbsp;</a>
                    </div>
                  </div>
                  <div class="col-12 mt-2 d-flex flex-wrap align-items-center">
                    <select class="form-control mr-2" id="selectcategory" name="selectcategory" onchange="catfilter()" style="width:300px;">
                      <?php
                      echo '<option value="blank">Select Category </option>';

                      function categoryTree($parent_id = 0, $sub_mark = '')
                      {
                        global $conn;
                        $query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id ORDER BY cat_name ASC");

                        if ($query->num_rows > 0) {
                          while ($row = $query->fetch_assoc()) {
                            echo '<option value="' . $row['cat_id'] . '">' . $sub_mark . $row['cat_name'] . '</option>';
                            categoryTree($row['cat_id'], $sub_mark . '---');
                          }
                        }
                      }
                      categoryTree();


                      ?>
                    </select>
                    <!-- <select class="form-control mr-2" id="selectsize" name="selectsize" onchange="applysizecolorfilter()" style="width:300px;">
                      <option value="blank">Select Size </option>
                    </select>
                    <select class="form-control" id="selectcolor" name="selectcolor" onchange="applysizecolorfilter()" style="width:300px;">
                      <option value="blank">Select Color </option>

                    </select> -->
                  </div>
                </div>
                <br>
              </div>
              <div class="work-progres">
                <div class="table-responsive">
                  <table class="table table-hover" id="tblname">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>Image</th>
                        <th>ProductID</th>
                        <th>Name</th>
                        <th>SKU CODE</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Category</th>
                        <th></th>
                        <th></th>
                        <th></th>

                      </tr>
                    </thead>
                    <tbody id="tbodyPostid">

                    </tbody>
                  </table>
                </div>
                <div class="row align-items-center">
                  <div class="col-md-6">
                    <div class="pull-right" style="float:left;">
                      Total Row : <a id="totalrowvalue" class="totalrowvalue"></a>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="pull-right page_div ml-auto" style="float:right;"> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>


  <div class="clearfix"></div>
</div>


<div class="col_1">


  <div class="clearfix"> </div>

</div>


<!--footer-->
<?php include('footernew.php'); ?>
<script src="<?= BASEURL . 'admin/js/admin/manage_product_filter.js' ?>"></script>
<script type="application/javascript">
  function editProduct(item, stock) {
    // alert("sdsdfds");

    var mapForm = document.createElement("form");
    mapForm.target = "_self";
    mapForm.method = "POST"; // or "post" if appropriate
    mapForm.action = "edit_product.php";

    var mapInput = document.createElement("input");
    mapInput.type = "text";
    mapInput.name = "productid";
    mapInput.value = item;
    mapForm.appendChild(mapInput);

    var mapInput = document.createElement("input");
    mapInput.type = "text";
    mapInput.name = "stock";
    mapInput.value = stock;
    mapForm.appendChild(mapInput);

    //alert("move");
    document.body.appendChild(mapForm);

    map = window.open("", "_self");

    if (map) {
      mapForm.submit();
    } else {
      alert('You must allow popups for this map to work.');
    }
  }

  function deleteProduct(item) {
    //     alert("prod id "+item );
    $.ajax({
      method: 'POST',
      url: 'delete_product_statusonly.php',
      data: {
        code: "123",
        prodid: item

      },
      success: function(response) {
        //  alert(response); // display response from the PHP script, if any
        var data = $.parseJSON(response);
        if (data["status"] == "1") {
          // alert("refresh");
          // searchenable = false;
          if (searchenable == true) {
            searchName('abc');

          } else {
            rowno = 0;
            getProducts(pageno, rowno);

          }

        }

      }
    });

  }

  function activateProduct(item, statusid) {
    //   alert("prod id "+item );
    $.ajax({
      method: 'POST',
      url: 'delete_product_inactivate.php',
      data: {
        code: "123",
        prodid: item,
        prodstatusid: statusid
      },
      success: function(response) {
        //alert(response); // display response from the PHP script, if any
        var data = $.parseJSON(response);
        if (data["status"] == "1") {
          // alert("refresh");
          // searchenable = false;
          if (searchenable == true) {
            searchName('abc');

          } else {
            rowno = 0;
            getProducts(pageno, rowno);

          }

        }

      }
    });

  }
</script>
<script>
  /* function addclick() {
    $(".pagenovalue").click(function() {
      // alert("clci ");
      rowno = 0;
      getProducts(parseInt(pageno), rowno);



    });
    $(".pagenovalue2").click(function() {
      rowno = 0;
      getProducts(parseInt(pageno) + 1, rowno);


    });
    $(".pagenovalue3").click(function() {
      rowno = 0;
      getProducts(parseInt(pageno) + 2, rowno);


    });
    $(".pagenovalue4").click(function() {
      rowno = 0;
      getProducts(parseInt(pageno) + 3, rowno);


    });
    $(".pagenovalue5").click(function() {
      rowno = 0;
      getProducts(parseInt(pageno) + 4, rowno);


    });

  } */
</script>
<script>
  /* function getOrder(action) {
    // alert("action "+action);
    if (action == "first") {
      rowno = 0;
      getProducts(1, rowno);
    } else if (action == "previous") {
      rowno = 0;
      getProducts(parseInt(pageno) - 1, rowno);
    } else if (action == "next") {
      rowno = 0;
      getProducts(parseInt(pageno) + 1, rowno);
    } else if (action == "last") {
      rowno = 0;
      getProducts(99999, rowno);

    }
  } */
</script>
<script>
  function searchName(orderid) {

    var checkBoxcat = document.getElementById("Checkcat");
    var tempcat = "false";
    if (checkBoxcat.checked == true) {
      // alert("cmplete");
      tempcat = "true";
    }

    var count = 1;
    var search_namevalue = $('#search_name').val();
    var cat = document.getElementById("selectcategory");
    var catvalue = cat.options[cat.selectedIndex].value;

    // alert("search "+search_namevalue );
    if (search_namevalue == "" || search_namevalue == null) {
      searchenable = false;
      alert("Invalid Name");
    } else {
      searchenable = true;

      $.ajax({
        method: 'POST',
        url: 'get_product_search_filter.php',
        data: {
          code: "1",
          prod_name: search_namevalue,
          catid: catvalue,
          page: 0,
          rowno: 0,
          sortcat: tempcat

        },
        success: function(response) {
          // alert(response);
          var data = $.parseJSON(response);

          if (data["status"] == "1") {
            $("#tbodyPostid").empty();

            rowno = data["totalrow"];
            pageno = data["pageno"];
            $('#pagenovalue').html(pageno);
            $('#totalrowvalue').html(rowno);


            $(data["details"]).each(function() {
              //alert(this.rollno);
              var btnactive = '<button type = "button" class = "btn-info"> Add into list</button>';


              $("#tbodyPostid").append('<tr> <th scope="row">' + count + '</th><td><img src=' + this.img + ' style="width: 121px; height: 72px;"></td><td class="nr">' + this.id + '</td><td>' + this.name + '</td><td>' + this.hsncode + '</td> <td>' + this.price + '</td> <td class="stk" style="display:none"> ' + this.stock + '</td><td> ' + this.cat + '</td> <td>	<button type = "button" class = "btn-warning">' + "Edit" + '</button></td><td>' + btnactive + '</td></tr> ');

              count = count + 1;

            });

            $(".btn-danger").click(function() {
              var $row = $(this).closest("tr"); // Find the row
              var $text = $row.find(".nr").text(); // Find the text
              deleteProduct($text);
              //alert("prod ID "+$text); 


            });
            $(".btn-success").click(function() {
              var $row = $(this).closest("tr"); // Find the row
              var $text = $row.find(".nr").text(); // Find the text
              activateProduct($text, "active");
              // alert("prod ID "+$text); 


            });
            $(".btn-info").click(function() {
              var $row = $(this).closest("tr"); // Find the row
              var $text = $row.find(".nr").text(); // Find the text
              activateProduct($text, "inactive");
              // alert("prod ID "+$text); 


            });
            $(".btn-warning").click(function() {
              var $row = $(this).closest("tr"); // Find the row
              var $text = $row.find(".nr").text(); // Find the text
              var $stock = $row.find(".stk").text(); // Find the text

              // alert("prod ID "+$text+$stock); 
              editProduct($text, $stock);

            });
            //  createtable();
          } else {
            alert(" no product found. please try again");
          }


        }
      });


    } //else close

  }
</script>
<script>
  function getfiltername() {


    var cat = document.getElementById("selectcategory");
    var catvalue = cat.options[cat.selectedIndex].value;

    $.ajax({
      method: 'POST',
      url: 'get_product_filtername.php',
      data: {
        code: "16584",
        catid: catvalue

      },
      success: function(response) {
        //alert(response);
        var data = $.parseJSON(response);

        if (data["status"] == "1") {
          $('#selectsize').empty();
          var count = 1;
          var o = new Option("Select Size", "blank");
          $("#selectsize").append(o);
          $(data["size"]).each(function() {
            var o = new Option(data["size"][count], data["size"][count]);
            $("#selectsize").append(o);
            count = count + 1;
          });

          $('#selectcolor').empty();
          var count = 1;
          var o = new Option("Select Color", "blank");
          $("#selectcolor").append(o);
          $(data["color"]).each(function() {
            var o = new Option(data["color"][count], data["color"][count]);
            $("#selectcolor").append(o);
            count = count + 1;

          });
          //  createtable();
        } else {
          alert("No Filter found. please try again");
        }


      }
    });



  } // function close
</script>
<script>
  function addintosharelist(id, img, name, hsn, price, size, color) {
    //    alert("prod id "+id+"--"+sharelistid );
    $.ajax({
      method: 'POST',
      url: 'add_product_into_sharelist.php',
      data: {
        code: "123",
        prod_id: id,
        img: img,
        name: name,
        hsn: hsn,
        price: price,
        size: size,
        color: color,
        sharelistid: sharelistid
      },
      success: function(response) {
        // alert(response); // display response from the PHP script, if any
        var data = $.parseJSON(response);
        if (data["status"] == "1") {
          alert(data["msg"]);
          sharelistid = data["listid"]
          $('#shareitemscount').html(data["itemcount"]);

        } else {
          alert("please try again");
        }

      }
    });

  }
</script>
<script>
  function checksharelist() {
    // alert("open new page "+sharelistid);

    var mapForm = document.createElement("form");
    mapForm.target = "_self";
    mapForm.method = "POST"; // or "post" if appropriate
    mapForm.action = "http://bongosaj.com/products/" + sharelistid;

    var mapInput = document.createElement("input");
    mapInput.type = "text";
    mapInput.name = "listid";
    mapInput.value = sharelistid;
    mapForm.appendChild(mapInput);

    document.body.appendChild(mapForm);

    map = window.open("", "_self");

    if (map) {
      mapForm.submit();
    } else {
      alert('You must allow popups for this map to work.');
    }
  }
</script>
<script>
  function sortbycatfun() {

    rowno = 0;
    getfiltername();
    getProducts(pageno, rowno);
  }
</script>
<script>
  function catfilter() {
    // alert("fildre");
    rowno = 0;
    getfiltername();
    getProducts(1, rowno);

  }
</script>
<script>
  function applysizecolorfilter() {
    // alert("fildre");
    rowno = 0;
    //getfiltername();
    getProducts(1, rowno);

  }
</script>
<script>

</script>