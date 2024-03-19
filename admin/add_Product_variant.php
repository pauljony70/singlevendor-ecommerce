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

              <h4 class="mt-0">Add name</h4>

              <div class="form-two widget-shadow">

                <div class="form-body" data-example-id="simple-form-inline">

                  <form class="form-inline" id="myform">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control mx-2" id="name" placeholder="Name"> </input>

                    </div>



                    <button type="submit" class="btn btn-dark" value="Upload" href="javascript:void(0)" onclick="addvariant(); return false;">Add</button>
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
              <div class="d-flex justify-content-between" style="">
                <div>
                  <h2 class="mt-0">Variant Category - <label id="bredcrum" style="color:blue;"></label> </h2>
                  <lable>Click on name to see all variant</lable>
                  <i class="fa fa-home" onclick="goHome(this); return false;"></i> <label id="bredcrum" style="color:blue;"></label>
                </div>
                <div>
                  <button type="submit" class="label pull-left label-warning" value="delete" name="delete" href="javascript:void(0)" onclick="deleteCategory(this); return false;">DELETE</button>
                </div>

              </div>
              <div class="d-flex">
              </div>
              </br>
              <ul class="bt-list row" id="cat_list">


                <div class="clearfix"> </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col_1">


        <div class="clearfix"> </div>

      </div>
    </div>
  </div>
</div>
<!--footer-->
<?php include('footernew.php'); ?>

<script>
  function deleteCategory() {

    // alert("delete call");
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
      url: 'delete_variant.php',
      data: {
        deletearray: deletestring

      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        getCategory();

      }
    });
  }
</script>


<script type="text/javascript">
  function addvariant() {

    var namevalue = $('#name').val();
    // var myJSON = JSON.stringify(imagejson);
    // alert( "kaka");

    $.ajax({
      method: 'POST',
      url: 'add_product_variant_process.php',
      data: {
        name: namevalue,
        code: "123",
        parentid: parentvalue
      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        //  window.open("events.php","_self");  
        $(':input', '#myform')
          .not(':button, :submit, :reset, :hidden')
          .val('');
        getCategory();

      }
    });
  }
</script>
<script>
  function goHome() {
    parentvalue = 0;
    getCategory();
  }
</script>
<script>
  function getCategory() {

    //  alert( "sdfs" );
    var count = 1;
    $.ajax({
      method: 'POST',
      url: 'get_variant_data.php',
      data: {
        code: "123",
        parentid: parentvalue
      },
      success: function(response) {
        //  alert(response); // display response from the PHP script, if any
        // var data = $.parseJSON(response);
        $("#cat_list").empty();
        var parsedJSON = JSON.parse(response);

        $("#bredcrum").text(parsedJSON.parentv);
        //  alert(" parent "+parsedJSON.parentv);
        var data = parsedJSON.subcat;
        //   alert("data size "+data.length);
        var order = data.length;
        $(data).each(function() {
          //alert(this.rollno);
          var optionsAsString = "";
          for (var i = 0; i < data.length; i++) {
            if (this.orderno == i) {
              optionsAsString += "<option value='" + i + "' selected >" + i + "</option>";

            } else {
              optionsAsString += "<option value='" + i + "' >" + i + "</option>";

            }
          }
          //	$("#cat_list").append('<li><input type="checkbox" name="chkbox"  value="'+this.id+'"/><lable>'+this.name+'</label> </li>');
          $("#cat_list").append('<li class="col-4"> <div class="checkbox-inline1"><input  type="checkbox" class="chkboxx" name="chkbox" value="' + this.id + '"><select name="catorderlist" class="catorderlist" style="margin-left:10px; margin-right:10px;">' + optionsAsString + '</select><label class = "cat-name"> ' + this.name + '</label>' +
            '</div></li>');

          count = count + 1;
        });

        $(".cat-name").click(function() {
          var $row = $(this).closest("li"); // Find the row
          var text = $row.find(".chkboxx").val();
          parentvalue = text;
          // alert("cat ID "+text); 
          getCategory()

        });

        $('select[name="catorderlist"]').on('change', function() {
          var $row = $(this).closest("li"); // Find the row
          var text = $row.find(".chkboxx").val();

          // alert("catid "+text+"---"+$(this).val());   
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
      url: 'edit_variant_order.php',
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
  var parentvalue = 0;
  $(document).ready(function() {

    getCategory();

  });
</script>