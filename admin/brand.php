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
            <h4 class="page-title">Add Brand</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="panel-info widget-shadow">


                <div class="form-two widget-shadow">

                  <div class="form-body" data-example-id="simple-form-inline">
                    <form class="form-inline align-items-center" id="myform">
                      <div class="form-group mr-2">
                        <label for="name" class="mr-2">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Brand Name">
                      </div>
                      <div class="form-group">
                        <label for="image" class="mr-2">Image</label>
                        <input type="file" name="1" id="1" required></input>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-dark" value="Upload" href="javascript:void(0)" onclick="uploadImage('1'); return false;">Add</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="clearfix"> </div>
                </br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h2>Brand List</h2>
              <button type="submit" class="label pull-left label-warning" value="delete" name="delete" href="javascript:void(0)" onclick="deleteBrand(this); return false;">DELETE</button>
              <button type="submit" class="label pull-left label-warning" value="edit" name="edit" href="javascript:void(0)" onclick="editBrand(this); return false;" style="margin-left: 50px;">EDIT</button>
              <br><br>
              <ul class="bt-list row" id="cat_list">


              </ul>
              <div class="clearfix"> </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col_1">


    <div class="clearfix"> </div>

  </div>

</div>

<!--footer-->
<?php include('footernew.php'); ?>
<!--//footer-->

<script type="text/javascript">
  var imagejson = "";

  function uploadImage(element) {

    //  alert( "input name---"+ element+"---" );
    var file_data = $('#' + element).prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    //  alert("sdfsdf");                             
    $.ajax({
      url: 'add_product_image.php', // point to server-side PHP script 
      dataType: 'text', // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(response) {
        if (response.status === "success") {
          // Do something with the success response
          var thumname = response.data.filePath;
          imagejson = thumname;
        } else {
          // Handle the error response

        }
        addbrand(1);
      }
    });

  }
</script>
<script>
  function editBrand(item) {
    // alert(item);
    var editstring = "";
    var count = 0;

    $('input:checkbox[name=chkbox]:checked').each(function() {
      // alert( $(this).val());

      if (count == 0) {
        editstring = $(this).val();
      } else {
        // deletestring = deletestring +", "+ $(this).val();   
      }
      count = count + 1;

    });
    if (count > 1) {
      alert("Please Select One Brand only.");
    } else {
      // alert("catid "+editstring);
      var mapForm = document.createElement("form");
      mapForm.target = "_self";
      mapForm.method = "POST"; // or "post" if appropriate
      mapForm.action = "edit_brand.php";

      var mapInput = document.createElement("input");
      mapInput.type = "text";
      mapInput.name = "catid";
      mapInput.value = editstring;
      mapForm.appendChild(mapInput);


      document.body.appendChild(mapForm);

      map = window.open("", "_self");

      if (map) {
        mapForm.submit();
      } else {
        alert('You must allow popups for this map to work.');
      }

    }


  }
</script>

<script type="text/javascript">
  function addbrand(element) {

    var namevalue = $('#name').val();
    //  alert( newstitle );
    $.ajax({
      method: 'POST',
      url: 'add_brand_process.php',
      data: {
        name: namevalue,
        img: imagejson,
        code: "123"
      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        //  window.open("events.php","_self");  
        $(':input', '#myform')
          .not(':button, :submit, :reset, :hidden')
          .val('');
        getBrand();
      }
    });
  }
</script>
<script>
  function getBrand() {

    // alert( "sdfs" );
    var count = 1;
    $.ajax({
      method: 'POST',
      url: 'get_brand_data.php',
      data: {
        code: "123"
      },
      success: function(response) {
        //  alert(response); // display response from the PHP script, if any
        var data = $.parseJSON(response);
        $("#cat_list").empty();

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
          $("#cat_list").append('<li class="col-4 mb-2"> <div class="checkbox-inline1"><input  type="checkbox" class="chkboxx" name="chkbox" value="' + this.id + '"><select name="catorderlist" class="catorderlist" style="margin-left:10px; margin-right:10px;">' + optionsAsString + '</select><label class = "cat-name"> ' + this.name + '</label> <img src=' + this.img + ' style="width: 72px; height: 72px;">' +
            '</div></li>');

          count = count + 1;
        });

        $('select[name="catorderlist"]').on('change', function() {
          var $row = $(this).closest("li"); // Find the row
          var text = $row.find(".chkboxx").val();

          //alert("catid "+text+"---"+$(this).val());   
          editBrandOrder(text, $(this).val());
        });

      }
    });
  }
</script>
<script>
  function editBrandOrder(idvalue, orderno) {
    $.ajax({
      method: 'POST',
      url: 'edit_brand_order.php',
      data: {

        catid: idvalue,
        ordernumber: orderno
      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        //  window.open("events.php","_self");  
        getBrand();
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
      url: 'delete_brand.php',
      data: {
        deletearray: deletestring

      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        getBrand();

      }
    });
  }
</script>