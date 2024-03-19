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
            <h4 class="page-title">Category Variants</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">


              <div class="form-two widget-shadow">
                <div class="form-body" data-example-id="simple-form-inline">
                  <form class="form-inline" id="myform">
                    <div class="form-group">
                      <div class="col-sm-30">
                        <select class="form-control1" id="selectbrand" name="selectbrand">
                          <?php

                          echo '<option value="blank">Select Product </option>';

                          $sns = "active";
                          $stmt = $conn->prepare("SELECT pt.prod_id, pt.prod_name, pt.hsn_code FROM product pr, productdetails pt WHERE pt.prod_id = pr.prod_id AND pr.status=? ORDER BY pt.prod_name ASC");
                          $stmt->bind_param("s", $sns);
                          $stmt->execute();
                          $stmt->store_result();
                          $stmt->bind_result($col1, $col2, $col3);

                          while ($stmt->fetch()) {
                            echo '<option value="' . $col1 . '">' . $col2 . '</option>';
                          }


                          ?>
                        </select>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-default" value="Upload" href="javascript:void(0)" onclick="addbrand(this); return false;">Add</button>
                  </form>
                </div>
              </div>
              <div class="clearfix"> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">

              <div class="d-flex justify-content-between">
                <div>
                  <h2>Popular Product List</h2>
                </div>
                <div>
                  <button type="submit" class="label pull-left label-warning" value="delete" name="delete" href="javascript:void(0)" onclick="deleteBrand(this); return false;">DELETE</button>
                </div>
              </div>
              <ul class="bt-list row" id="cat_list">


              </ul>
              <div class="clearfix"> </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col_1">


      <div class="clearfix"> </div>

    </div>

  </div>
</div>
<!--footer-->
<?php include('footernew.php'); ?>

<script type="text/javascript">
  function addbrand(element) {

    var bra = document.getElementById("selectbrand");
    var bravalue = bra.options[bra.selectedIndex].value;
    var braname = bra.options[bra.selectedIndex].text;
    // alert( bravalue+"--"+braname );
    if (bravalue == "blank") {

      alert("Please Select Product Name");
    } else {

      $.ajax({
        method: 'POST',
        url: 'add_popularprod_process.php',
        data: {
          id: bravalue,
          name: braname,
          code: "123"
        },
        success: function(response) {
          alert(response); // display response from the PHP script, if any
          //  window.open("events.php","_self");  
          $(':input', '#myform')
            .not(':button, :submit, :reset, :hidden')
            .val('');
          location.reload();
        }
      });

    }

  }
</script>
<script>
  function getBrand() {

    // alert( "sdfs" );
    var count = 1;
    $.ajax({
      method: 'POST',
      url: 'get_popularprod_data.php',
      data: {
        code: "123"
      },
      success: function(response) {
        //  alert(response); // display response from the PHP script, if any
        var data = $.parseJSON(response);
        $("#cat_list").empty();

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
          $("#cat_list").append('<li class="col-4"> <div class="checkbox-inline1"><input  type="checkbox" class="chkboxx"  name="chkbox" value="' + this.id + '"> <select name="catorderlist" class="catorderlist" style="margin-left:10px; margin-right:10px;">' + optionsAsString + '</select><label>' + this.name + '</label></div></li>');

          count = count + 1;
        });


        $('select[name="catorderlist"]').on('change', function() {
          var $row = $(this).closest("li"); // Find the row
          var text = $row.find(".chkboxx").val();

          //alert("catid "+text+"---"+$(this).val());   
          editCatOrder(text, $(this).val());
        });

      }
    });
  }
</script>
<script>
  function editCatOrder(idvalue, orderno) {
    $.ajax({
      method: 'POST',
      url: 'edit_popularprod_order.php',
      data: {

        catid: idvalue,
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
</script>
<script>
  $(document).ready(function() {

    getBrand();

  });
</script>
<script>
  function deleteBrand() {

    //alert("delete call");
    var event_idarray = new Array();
    var deletestring = "";
    var count = 0;

    $('input:checkbox[name=chkbox]:checked').each(function() {
      //alert( $(this).val());
      event_idarray.push($(this).val());
      if (count == 0) {
        deletestring = $(this).val();
      } else {
        deletestring = deletestring + ", " + $(this).val();
      }
      count = count + 1;

    });

    // alert(deletestring );

    $.ajax({
      method: 'POST',
      url: 'delete_popularprod.php',
      data: {
        deletearray: deletestring

      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        location.reload();

      }
    });
  }
</script>