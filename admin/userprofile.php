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
            <h4 class="page-title">Users</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">

              <div class="form-three widget-shadow">
                <h4>Add New User</h4>

                <form class="form-horizontal" id="myform">
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">First Name *</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="fname" placeholder=" First Name" required>
                    </div>
                    <div class="col-sm-2">
                      <p class="help-block"></p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Last Name *</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="lname" placeholder="Last Name" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Email *</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="email" placeholder="email" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Password *</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="password" placeholder="Password" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="focusedinput" class="col-sm-2 control-label">Re-Password *</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="repassword" placeholder="Re-Password" required>
                    </div>
                  </div>
                  </br>
                  <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-dark" href="javascript:void(0)" onclick="addUser(this); return false;">Add User</button>
                  </div>


                </form>


                <div class="clearfix"> </div>
                </br>

                <h3>All Users</h3>
                <button style='margin-right:30px;' type="submit" class="label pull-left label-warning" value="delete" name="delete" href="javascript:void(0)" onclick="deleteCategory(this); return false;">DELETE</button>
                </br>
                <ul class="bt-list" id="cat_list">


                </ul>

              </div>
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
    if (count > 1) {
      alert("Please Select One Category only.");
    } else {
      //  alert("catid "+editstring);
      var mapForm = document.createElement("form");
      mapForm.target = "_self";
      mapForm.method = "POST"; // or "post" if appropriate
      mapForm.action = "edit_category.php";

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
      url: 'delete_user.php',
      data: {
        deletearray: deletestring

      },
      success: function(response) {
        alert(response); // display response from the PHP script, if any
        getCategory();
        /* $(':input','#myform')
           .not(':button, :submit, :reset, :hidden')
           .val('')
          location.reload(); */
      }
    });
  }
</script>

<script type="text/javascript">
  var imagejson = "";

  function addUser(element) {

    var fnamevalue = $('#fname').val();
    var lnamevalue = $('#lname').val();
    var emailvalue = $('#email').val();
    var passvalue = $('#password').val();
    var repassvalue = $('#repassword').val();

    // var myJSON = JSON.stringify(imagejson);
    // alert( "kaka");
    if (fnamevalue == "" || fnamevalue == null) {

      alert("Name is empty");
    } else if (lnamevalue == "" || lnamevalue == null) {

      alert("Name is empty");
    } else if (emailvalue == "" || emailvalue == null) {

      alert("email is empty");
    } else if (passvalue == "" || passvalue == null) {

      alert("Password is empty");
    } else if (repassvalue == "" || repassvalue == null) {

      alert("Re- Password is empty");
    } else if (passvalue !== repassvalue) {

      alert("Password not match");
    } else if (passvalue.length < 6) {

      alert("At least 6 letters in Password ");
    } else {


      $.ajax({
        method: 'POST',
        url: 'add_user_process.php',
        data: {
          code: "123",
          fname: fnamevalue,
          lname: lnamevalue,
          email: emailvalue,
          password: passvalue,
          repassword: repassvalue,
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

  }
</script>
<script>
  function getCategory() {

    //  alert( "sdfs" );
    var count = 1;
    $.ajax({
      method: 'POST',
      url: 'get_user.php',
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
          $("#cat_list").append('<li> <div class="checkbox-inline1"><label><input  type="checkbox" name="chkbox" value="' + this.id + '"> ' + this.name + '</label><br> <span>' + this.email + '</span></div></li>');

          count = count + 1;
        });

      }
    });
  }
</script>
<script>
  $(document).ready(function() {

    getCategory();

  });
</script>