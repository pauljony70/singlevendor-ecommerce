<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
  header("Location: index.php");
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
            <h4 class="page-title">HomePage</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="form-two widget-shadow">
                <div class="form-body" data-example-id="simple-form-inline">
                  <form class="" id="myform">
                    <div class="row">
                      <div class="form-group col-md-3">
                        <div class="col-sm-30">
                          <input type="text" class="form-control" id="title" placeholder="custom title name" style="">
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <!-- 0 -h, 1- 2, 2 -3, 3 -v, 4 - f,  5- fb  -->
                        <div class="col-sm-30">
                          <select class="form-control" id="selectlayout" name="selectlayout" onchange="funSelectLayout()" style="">
                            <option value="10">Select LayoutType</option>
                            <option value="0">Horizontal Row</option>
                            <option value="1">2x2 Grid</option>
                            <option value="2">1 by 2 layout</option>
                            <option value="3">Vertical layout</option>
                            <option value="4">full width category</option>
                            <option value="5">full width banner</option>

                          </select>
                        </div>
                      </div>

                      <div class="form-group col-md-3">
                        <!-- 0 -h, 1- 2, 2 -3, 3 -v, 4 - f,  5- fb  -->
                        <div class="col-sm-30">
                          <select class="form-control" id="selectclick" name="selectclick" onchange="funSelectclick()" disabled style="background:lightgrey; ">
                            <option value="10">Select Click Action</option>
                            <option value="0">No Click</option>
                            <option value="1">Open Category</option>
                            <option value="2">Open Product</option>


                          </select>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <div class="col-sm-30">
                          <select class="form-control" id="selectcategory" name="selectcategory" style="">
                            <?php

                            echo '<option value="0:none">Select Category </option>';
                            function categoryTree($parent_id = 0, $sub_mark = '')
                            {
                              global $conn;
                              $query = $conn->query("SELECT * FROM category WHERE parent_id = $parent_id ORDER BY cat_name ASC");

                              if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                  echo '<option value="' . $row['cat_id'] . ':' . $row['cat_name'] . '">' . $sub_mark . $row['cat_name'] . '</option>';
                                  categoryTree($row['cat_id'], $sub_mark . '---');
                                }
                              }
                            }
                            categoryTree();


                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <div class="col-sm-30">
                          <select class="form-control" id="selectproduct" name="selectproduct" disabled style="background:lightgrey; ">
                            <?php
                            echo '<option value="0:none">Select Product </option>';
                            $sns = "active";
                            $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.hsn_code FROM product pr, productdetails pt WHERE pt.prod_id = pr.prod_id AND pr.status=? ORDER BY pt.prod_name ASC");
                            $stmt->bind_param("s", $sns);
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($col1, $col2, $col3);

                            while ($stmt->fetch()) {
                              echo '<option value="' . $col1 . ':' . $col2 . '">' . $col3 . " - " . $col2 . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <a class="btn btn-primary" aria-hidden="true" id="moreImg"><i class="fa fa-plus"></i> Add full width Banner</a>
                    </div>
                    <div class="col-sm-9">
                      <div class="input-files">
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-dark" value="Upload" href="javascript:void(0)" onclick="addadsbanner(this); return false;">Add</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"> </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h2>HomePage Design</h2>
              </br>
              <table class="table table-hover" id="tblname">
                <thead>
                  <tr>
                    <th></th>
                    <th>Sno</th>
                    <th>title</th>
                    <th>layout</th>
                    <th>click action</th>
                    <th>category</th>
                    <th>product</th>

                    <th></th>

                  </tr>
                </thead>
                <tbody id="tbodyPostid">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"> </div>

    </div>


    <div class="col_1">


      <div class="clearfix"> </div>

    </div>

  </div>
</div>
<!--footer-->
<?php include('footernew.php'); ?>

<script>
  function funSelectLayout() {
    var y = document.getElementById("selectlayout").value;
    // document.getElementById("demo").innerHTML = "You selected: " + x;
    // alert(y);  
    if (y == 5) {
      document.getElementById("selectclick").value = "10";
      document.getElementById("selectclick").disabled = false;
      document.getElementById("selectclick").style.backgroundColor = "white";
      document.getElementById("selectcategory").disabled = true;
      document.getElementById("selectproduct").disabled = true;
      document.getElementById("selectcategory").value = "0:none";
      document.getElementById("selectproduct").value = "0:none";

      document.getElementById("selectcategory").style.backgroundColor = "lightgrey";
      document.getElementById("selectproduct").style.backgroundColor = "lightgrey";

    } else {
      document.getElementById("selectclick").value = "10";
      document.getElementById("selectclick").disabled = true;
      document.getElementById("selectclick").style.backgroundColor = "lightgrey";

      document.getElementById("selectcategory").value = "0:none";
      document.getElementById("selectproduct").value = "0:none";

      document.getElementById("selectcategory").disabled = false;
      document.getElementById("selectproduct").disabled = true;

      document.getElementById("selectcategory").style.backgroundColor = "white";
      document.getElementById("selectproduct").style.backgroundColor = "lightgrey";

    }
  }
</script>

<script>
  function funSelectclick() {
    var x = document.getElementById("selectclick").value;
    // document.getElementById("demo").innerHTML = "You selected: " + x;
    // alert(x);  
    if (x == 10) {
      document.getElementById("selectcategory").disabled = true;
      document.getElementById("selectproduct").disabled = true;
      document.getElementById("selectcategory").value = "0:none";
      document.getElementById("selectproduct").value = "0:none";

      document.getElementById("selectcategory").style.backgroundColor = "lightgrey";
      document.getElementById("selectproduct").style.backgroundColor = "lightgrey";
    } else if (x == 0) {
      document.getElementById("selectproduct").disabled = true;

      document.getElementById("selectcategory").value = "0:none";
      document.getElementById("selectproduct").value = "0:none";

      document.getElementById("selectcategory").style.backgroundColor = "lightgrey";
      document.getElementById("selectproduct").style.backgroundColor = "lightgrey";



    } else if (x == 1) {
      document.getElementById("selectcategory").disabled = false;
      document.getElementById("selectproduct").disabled = true;
      document.getElementById("selectcategory").style.backgroundColor = "white";
      document.getElementById("selectproduct").style.backgroundColor = "lightgrey";
      document.getElementById("selectproduct").value = "0:none";
    } else {
      document.getElementById("selectcategory").disabled = true;
      document.getElementById("selectproduct").disabled = false;

      document.getElementById("selectcategory").style.backgroundColor = "lightgrey";
      document.getElementById("selectproduct").style.backgroundColor = "white";
      document.getElementById("selectcategory").value = "0:none";
    }

  }
</script>

<script type="text/javascript">
  function uploadImage(element) {

    //alert("upload start");
    var clickb = document.getElementById("selectclick");
    var clickbvalue = clickb.options[clickb.selectedIndex].value;

    var cat = document.getElementById("selectcategory");
    var catvalue = cat.options[cat.selectedIndex].value;
    var partss = catvalue.split(':', 2);
    var catidvalue = partss[0];
    var catnamevalue = partss[1];

    // alert( "kaka");
    var bra = document.getElementById("selectproduct");
    var prodvalue = bra.options[bra.selectedIndex].value;
    var parts = prodvalue.split(':', 2);
    var prodidvalue = parts[0];
    var prodnamevalue = parts[1];

    //alert( "input name---"+ element+"---" );
    var file_data = $('#' + element).prop('files')[0];

    if (file_data == "" || file_data == null) {
      alert("Please Select Image");
    } else {
      var form_data = new FormData();
      form_data.append('file', file_data);
      //alert("sdfsdf");                             
      $.ajax({
        url: 'add_product_image.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response) {
          alert(response); // display response from the PHP script, if any
          var thumname = response.replace("Upload successfully--", "");

          imagejson.push({
            "id": element,
            "url": thumname,
            "clicktype": clickbvalue,
            "catid": catidvalue,
            "prodid": prodidvalue
          });
          //   notiimage =thumname;

          // reset layout 
          //document.getElementById("selectclick").value= "10";
          //document.getElementById("selectclick").disabled=false;
          //document.getElementById("selectclick").style.backgroundColor = "white";

          document.getElementById("selectcategory").value = "0:none";
          document.getElementById("selectproduct").value = "0:none";

          //document.getElementById("selectcategory").disabled=true;
          //document.getElementById("selectproduct").disabled=true;

          //document.getElementById("selectcategory").style.backgroundColor = "lightgrey";
          //document.getElementById("selectproduct").style.backgroundColor = "lightgrey";
        }

      });
    }


  }

  function addadsbanner() {

    var titlevalue = $('#title').val();

    var lay = document.getElementById("selectlayout");
    var layvalue = lay.options[lay.selectedIndex].value;

    var clickb = document.getElementById("selectclick");
    var clickbvalue = clickb.options[clickb.selectedIndex].value;

    var cat = document.getElementById("selectcategory");
    var catvalue = cat.options[cat.selectedIndex].value;
    var partss = catvalue.split(':', 2);
    var catidvalue = partss[0];
    var catnamevalue = partss[1];

    // alert( "kaka");
    var bra = document.getElementById("selectproduct");
    var prodvalue = bra.options[bra.selectedIndex].value;
    var parts = prodvalue.split(':', 2);
    var prodidvalue = parts[0];
    var prodnamevalue = parts[1];
    //  alert(" here --"+titlevalue+"--"+layvalue+"--"+ clickbvalue+"--"+catidvalue + "--"+ catnamevalue + "--"+ prodidvalue+"--"+ prodnamevalue); 
    var myJSON = JSON.stringify(imagejson)

    var ctype = 0;
    var isgood = 0;
    if (layvalue == 10) {
      alert("Please select layout type")
    } else if (layvalue != 5 && catidvalue == 0) {
      alert("Please select category")
    }
    /*else if(layvalue == 5 && clickbvalue == 10){
                 alert("Please select click action")
             }else if( layvalue == 5 && clickbvalue == 1 && catidvalue == 0){
                 alert ("Please select category")
             }else if( layvalue == 5 && clickbvalue == 2 && prodidvalue == 0){
                 alert ("Please select product")
             }*/
    else if (layvalue == 5 && imagejson.length == 0) {
      alert("Please upload a banner image")
    } else {
      //alert( imagejson);

      $.ajax({
        method: 'POST',
        url: 'add_homepagecategory_process.php',
        data: {
          code: "123uhbj234567",
          title: titlevalue,
          layout: layvalue,
          clicktype: clickbvalue,
          prodid: prodidvalue,
          prodname: prodnamevalue,
          catid: catidvalue,
          catname: catnamevalue,
          img: myJSON
        },
        success: function(response) {
          alert(response); // display response from the PHP script, if any
          //  window.open("events.php","_self");  
          $(':input', '#myform')
            .not(':button, :submit, :reset, :hidden')
            .val('');
          getHomeCatData();
          imagejson.length = 0;
          multipriceimagecount = 0;
          $(".input-files").empty();
        }
      });
    }
  }
</script>

<script>
  function getHomeCatData() {

    // alert( "sdfs" );
    var count = 1;
    $.ajax({
      method: 'POST',
      url: 'get_homepagecategory_data.php',
      data: {
        code: "123"
      },
      success: function(response) {
        // alert(response); // display response from the PHP script, if any
        var data = $.parseJSON(response);
        $("#cat_list").empty();
        $("#tbodyPostid").empty();
        $(data).each(function() {

          var optionsAsString = "";
          for (var i = 0; i < data.length; i++) {
            if (this.orderno == i) {
              optionsAsString += "<option value='" + i + "' selected >" + i + "</option>";

            } else {
              optionsAsString += "<option value='" + i + "' >" + i + "</option>";

            }
          }
          //alert(this.rollno);
          //	$("#cat_list").append('<li><input type="checkbox" name="chkbox"  value="'+this.id+'"/><lable>'+this.name+'</label> </li>');
          // $("#cat_list").append('<li> <div class="checkbox-inline1"><input  type="checkbox" class="chkboxx"  name="chkbox" value="'+this.catid+'"> <select name="catorderlist" class="catorderlist" style="margin-left:10px; margin-right:10px;">'+optionsAsString+'</select><label>'+this.catname+'</label></div></li>');

          var layoutname = "";
          if (this.layouttype == 0) {
            layoutname = "Horizontal Row";
          } else if (this.layouttype == 1) {
            layoutname = "2x2 Grid";
          } else if (this.layouttype == 2) {
            layoutname = "1 by 2 layout";
          } else if (this.layouttype == 3) {
            layoutname = "Vertical layout";
          } else if (this.layouttype == 4) {
            layoutname = "full width category";
          } else if (this.layouttype == 5) {
            layoutname = "full width banner";
          }

          var clickname = "";
          if (this.clicktype == 1) {
            clickname = "Open Category";
          } else if (this.clicktype == 2) {
            clickname = "Open Product";
          } else if (this.clicktype == 0) {
            clickname = "No Click";
          } else {
            clickname = "Open Product";
          }
          var btnstatus = '<button type = "button" class = "btn-danger">DELETE</button>';
          $("#tbodyPostid").append('<tr> <th scope="row">' + count + '</th><td class="nimg"> <div class="checkbox-inline1"><input  type="checkbox" class="chkboxx"  name="chkbox" value="' + this.sno + '"> <select name="catorderlist" class="catorderlist" style="margin-left:10px; margin-right:10px;">' + optionsAsString + '</select></div></td><td class="nr" style="display:none;">' + this.sno + '</td><td>' + this.title + '</td><td class="nname">' + layoutname + '</td> <td class="nhsn">' + clickname + '</td><td class="nprice">' + this.catname + '</td> <td class="stk"> ' + this.prodname + '</td> <td>' + btnstatus + '</td></tr> ');

          count = count + 1;
        });


        $('select[name="catorderlist"]').on('change', function() {
          var $row = $(this).closest("tr"); // Find the row
          var text = $row.find(".chkboxx").val();

          //alert("catid "+text+"---"+$(this).val());   
          editCatOrder(text, $(this).val());
        });

        $(".btn-danger").click(function() {
          var $row = $(this).closest("tr"); // Find the row
          var $text = $row.find(".nr").text(); // Find the text
          deleteHomebanner($text);
          //alert("prod ID "+$text); 


        });

      }
    });
  }
</script>
<script>
  function editCatOrder(idvalue, orderno) {
    $.ajax({
      method: 'POST',
      url: 'edit_homepagecategory_order.php',
      data: {

        sno: idvalue,
        ordernumber: orderno
      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        //  window.open("events.php","_self");  
        // getCategory();
        //imagejson ="";
      }
    });
  }

  function deleteHomebanner(sno) {

    //alert("delete call");
    var deletestring = sno;
    // alert(deletestring );

    $.ajax({
      method: 'POST',
      url: 'delete_homepagecategory.php',
      data: {
        deletearray: deletestring

      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        // location.reload();
        getHomeCatData();
      }
    });
  }
</script>
<script>
  var imagejson = [];
  $(document).ready(function() {

    getHomeCatData();

    var high = "6";
    var multipriceimagecount = 0;
    $("#moreImg").click(function() {
      multipriceimagecount = ++multipriceimagecount;

      var showId = multipriceimagecount;
      //  alert("file id "+multipriceimagecount +"---"+high)	

      var lay = document.getElementById("selectlayout");
      var layvalue = lay.options[lay.selectedIndex].value;

      var clickb = document.getElementById("selectclick");
      var clickbvalue = clickb.options[clickb.selectedIndex].value;

      var cat = document.getElementById("selectcategory");
      var catvalue = cat.options[cat.selectedIndex].value;
      var partss = catvalue.split(':', 2);
      var catidvalue = partss[0];
      var catnamevalue = partss[1];

      // alert( "kaka");
      var bra = document.getElementById("selectproduct");
      var prodvalue = bra.options[bra.selectedIndex].value;
      var parts = prodvalue.split(':', 2);
      var prodidvalue = parts[0];
      var prodnamevalue = parts[1];

      if (layvalue != 5) {
        alert("Please select layout type as Full width banner")

      } else if (layvalue == 5 && clickbvalue == 10) {
        alert("Please select click action")
        multipriceimagecount = --multipriceimagecount;
      } else if (layvalue == 5 && clickbvalue == 1 && catidvalue == 0) {
        alert("Please select category")
        multipriceimagecount = --multipriceimagecount;
      } else if (layvalue == 5 && clickbvalue == 2 && prodidvalue == 0) {
        alert("Please select product")
        multipriceimagecount = --multipriceimagecount;
      } else if (showId <= high) {
        $(".input-files").append('<br><input type="file" id="' + showId + '" style="float:left; display: inline-block; margin-right:20px;"> </input> ' +
          '<button name="btn_upload-' + showId + '" type="submit" class="btn btn-sm btn-success" onclick="uploadImage(' + showId + '); return false;" style="float:left; display: inline-block; margin-right:20px;">Upload</button><br> ');


      }
    });
  });
</script>