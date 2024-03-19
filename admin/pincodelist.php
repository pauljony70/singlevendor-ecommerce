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
            <h4 class="page-title">Pincode</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">


              <div class="form-two widget-shadow">
                <div class="form-title">
                  <h4>Add Pin Code</h4>

                </div>
                <div class="form-body" data-example-id="simple-form-inline">
                  <form class="" id="myform">
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="name">Area</label>
                        <input type="text" class="form-control" id="name" placeholder="Area">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="name">Pincode</label>
                        <input type="text" class="form-control" id="pincodev" placeholder="Pin Code">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="name">Shipping Fees</label>
                        <input type="text" class="form-control" id="shipvalue" placeholder="Shipping Fees">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-dark" value="Upload" href="javascript:void(0)" onclick="addbrand(this); return false;">Add</button>
                  </form>
                </div>
                <div class="form-body" data-example-id="simple-form-inline">
                  <?php

                  $allindia = "";
                  $stmt11 = $conn->prepare("SELECT name, value FROM store_config");
                  $stmt11->execute();
                  $stmt11->store_result();
                  $stmt11->bind_result($col11, $col12);

                  while ($stmt11->fetch()) {
                    //  echo " order id ".$col1;
                    if ($col11 == "allindia_ship") {
                      $allindia  = $col12;
                    }
                  }
                  ?>
                  <form class="form-inline" id="myform2">
                    <div class="form-group">
                      <label for="name">All India Shipping Fees</label>
                      <input type="text" class="form-control ml-2" id="allindiashipvalue" placeholder="Shipping Fees" value="<?php echo $allindia; ?>">
                    </div>
                    <button type="submit" class="btn btn-warning" value="Upload" href="javascript:void(0)" onclick="addAllIndia(this); return false;">Save</button>
                  </form>
                </div>
                <div class="form-body" data-example-id="simple-form-inline">
                  <?php

                  $allindia = "";
                  $stmt11 = $conn->prepare("SELECT name, value FROM store_config");
                  $stmt11->execute();
                  $stmt11->store_result();
                  $stmt11->bind_result($col11, $col12);

                  while ($stmt11->fetch()) {
                    //  echo " order id ".$col1;
                    if ($col11 == "allindia_ship") {
                      $allindia  = $col12;
                    }
                  }
                  ?>
                  <form class="form-inline" id="myform2" style="display:none;">
                    <div class="form-group">
                      <label for="name">M.H. Shipping Fees</label>
                      <input type="text" class="form-control" id="allindiashipvalue" placeholder="Shipping Fees" value="<?php echo $allindia; ?>">
                    </div>
                    <button type="submit" class="btn btn-warning" value="Upload" href="javascript:void(0)" onclick="addAllIndia(this); return false;">Save</button>
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
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h2>PinCode List</h2>
                </div>
                <div class="d-flex">
                  <div>
                    <button style="margin-right:20px;" type="submit" class="label pull-left label-warning" value="edit" name="edit" href="javascript:void(0)" onclick="editCategory(this); return false;">EDIT</button>
                  </div>
                  <div>
                    <button type="submit" class="label pull-left label-warning" value="delete" name="delete" href="javascript:void(0)" onclick="deleteBrand(this); return false;">DELETE</button>
                  </div>
                </div>
              </div>


              </br>
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

    var namevalue = $('#name').val();
    var pinvalue = $('#pincodev').val();
    var shipvalue = $('#shipvalue').val();

    //     alert(  namevalue  );
    $.ajax({
      method: 'POST',
      url: 'add_pincode_process.php',
      data: {
        name: namevalue,
        pincode: pinvalue,
        shipping: shipvalue,
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
      url: 'get_pincode_data.php',
      data: {
        code: "123"
      },
      success: function(response) {
        //  alert(response); // display response from the PHP script, if any
        var data = $.parseJSON(response);
        $("#cat_list").empty();

        $(data).each(function() {
          //alert(this.rollno);
          //	$("#cat_list").append('<li><input type="checkbox" name="chkbox"  value="'+this.id+'"/><lable>'+this.name+'</label> </li>');
          $("#cat_list").append('<li class="col-4"> <div class="checkbox-inline1"><label><input  type="checkbox" name="chkbox" value="' + this.id + '"> ' + this.name + '<br>' + this.id + '<br>' + this.shipfee + '</label></div></li>');

          count = count + 1;
        });

      }
    });
  }
</script>

<script>
  function editCategory() {
    //alert(item);
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

    if (count == 0) {
      alert("Please select one pincode.");
    } else
    if (count > 1) {
      alert("Please Select One pincode only.");
    } else {
      // alert("areaid "+editstring +"---"+count);
      var mapForm = document.createElement("form");
      mapForm.target = "_self";
      mapForm.method = "POST"; // or "post" if appropriate
      mapForm.action = "edit_pinocde.php";

      var mapInput = document.createElement("input");
      mapInput.type = "text";
      mapInput.name = "pincodeid";
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
      url: 'delete_pincode.php',
      data: {
        deletearray: deletestring

      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        getBrand();
        /* $(':input','#myform')
           .not(':button, :submit, :reset, :hidden')
           .val('')
          location.reload(); */
      }
    });
  }
</script>