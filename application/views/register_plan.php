<!DOCTYPE html>
<html lang="zxx" class="js">

<?php 
if(!empty($otp))
{
print_r($otp);
}
include("includes/head.php") ?>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <?php // include("includes/sidebar.php") ?>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?php  // include("includes/header.php") ?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="" class="logo-link">
                                <h3>VERIFY SHOPI</h3>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-inner card-inner-lg" id="reg_card">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title text-center">Register</h4>
                                        <div class="nk-block-des">
                                            <?php echo @$message; ?>
                                        </div>
                                    </div>
                                </div>
								
                               <form  action="" method="post">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Full Name</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" name="fullname" class="form-control form-control-lg" required id="fullname" placeholder="Enter Full Name">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" name="email" class="form-control form-control-lg" required id="email" placeholder="Enter your email address">
                                        </div>
                                    </div>
									<div class="row" > 
									<div class="form-group col-md-4">
										<label class="form-label" for="cf-email-address">Country</label>
										<div class="form-group">
											<div class="form-control-wrap ">
												<div class="form-control-select">
													<select class="form-control required invalid" data-msg="Required" id="country_code" name="country_code" required="">
														<option value="">Select Code</option>
														  
														<?php foreach($country_data->result() as $country) { ?>
														<option  value="<?php echo $country->phonecode; ?>"><?php echo '(+'.$country->phonecode.')  '.$country->nicename; ?></option>
														<?php } ?>
														
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group col-md-8">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Phone No</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" name="phone" class="form-control form-control-lg" maxlength="10" required id="phone" placeholder="Enter Phone No">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" name="password" class="form-control form-control-lg" required id="password" placeholder="Enter your Password">
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Confirm Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" name="cpassword" class="form-control form-control-lg" required id="cpassword" placeholder="Enter your Password">
                                        </div>
                                    </div>
									<!--<div class="form-group">
										<label class="form-label" for="cf-email-address">Role</label>
										<div class="form-group">
											<div class="form-control-wrap ">
												<div class="form-control-select">
													<select class="form-control required invalid" data-msg="Required" id="role" name="role" required="">
														<option value="">Select Role</option>
														<option  value="appuser">App User</option>
														<option  value="inventory">Inventory User</option>
														<option  value="dashboard">Dashboard User</option>
													</select>
												</div>
											</div>
										</div>
									</div>-->
									<input type="hidden" name="plan_id" id="plan_id" value="<?php echo $plan_id; ?>">
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" onclick="call_register(); return false;">Sign Up</button>
                                    </div>
                                </form>
                                  <div class="form-note-s2 text-center pt-4"> Already Register To <a href="/dashboard/sub_login">Login</a>
                            </div>
                            </div>

		
							<div class="card-inner card-inner-lg" id="otp_card" style="display:none">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title text-center">Verify OTP</h4>
                                        <div class="nk-block-des">
                                            <?php echo @$message; ?>
                                        </div>
                                    </div>
                                </div>
                               <form method="post" action="">
                                    
									<div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">OTP</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" name="otp" class="form-control form-control-lg" required id="otp" placeholder="Enter OTP">
                                        </div>
                                    </div>
									<input type="hidden" name="otp_check"  id="otp_check" >
									
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" onclick="verify_otp(); return false;">Varify Now</button>
                                    </div>
                                </form>
                                
                                </div>
                                
                            </div>
							


                        </div>
                    </div>
                    
                </div>
				
				
                <!-- content @e -->
                <!-- footer @s -->
                <?php // include("includes/footer.php") ?>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
   
    <!-- JavaScript -->
    <?php include("includes/script.php") ?>
	<script>
 var site_url = $('.site_url').val(); // CSRF hash

	function call_register() {
       //alert("call");
      var fullname = $("#fullname").val();
      var email = $("#email").val();
      var country_code = $("#country_code").val();
      var phone = $("#phone").val();
      var pass = $("#password").val();
      var cpass = $("#cpassword").val();
      //var role = $("#role").val();
      var plan_id = $("#plan_id").val();
      //  alert("phone  "+phonev+"---"+namev+ "===="+phonev.length);

      if (fullname == "" || fullname == null) {

        alert("Full Name is Empty");
        
      } else if (email == "" || email == null) {

        alert("Email is Empty");
	
	  } else if (country_code == "" || country_code == null) {

        alert("Country Code is Empty");

     
	  } else if (phone == "" || phone == null) {

        alert("Phone No is Empty");

	  } else if (pass == "" || pass == null) {

         alert("Password is Empty");

	  } else if (pass.length <= 6 && pass.length >= 30) {

         alert("Minimum 6 character and Maximum 30 character Password Allow");
	    
	 } else if (cpass == "" || cpass == null) {

         alert("Confirm Password is Empty");
	  } else if (pass != cpass) {

        alert("Password And Confirm Password are not Same.");

      } else if (phone.length != 10) {

        alert("Invalid Phone Number");
      } else {
        $.ajax({
          method: 'POST',
		  url: site_url+'Plan/signup',

          data: {
            fullname: fullname,
            email: email,
            country_code: country_code,
            phone: phone,
            password: pass,
           // role: role,
            plan_id: plan_id

          },
          success: function(response) {
            //console.log(response);
            //alert("response is "+response);
            var otp = response;
			$('#otp').val(otp);
			$('#otp_check').val(otp);
			
            ////alert("status is " + abc.msg);
            //if (abc.status == 1) {
              // show otp verify div
              $('#reg_card').hide();
              $('#otp_card').show();

            //} else {
              //$('.aa-myaccount-otp').show();
              //alert(abc.msg);
           // }

          },
          error: function(data) {
            debugger;
            alert("Error");
          }
        });

      }
    }

	function verify_otp() {
		
		var otp = $('#otp').val();
		var otp_check = $('#otp_check').val();
		if(otp == otp_check)
		{
			location.href=site_url+'checkout';
		}
		else
		{
			alert('Invalid OTP');
		}
    }

		function verify_otp0() {
		var fullname = $("#fullname").val();
		var email = $("#email").val();
		  var country_code = $("#country_code").val();
		  var phone = $("#phone").val();
		  var pass = $("#password").val();
		  var cpass = $("#cpassword").val();
		 // var role = $("#role").val();
		  var plan_id = $("#plan_id").val();
      

        $.ajax({
          method: 'POST',
		  url: site_url+'Plan/verify_otp',
           data: {
            fullname: fullname,
            email: email,
            country_code: country_code,
            phone: phone,
            password: pass,
            //role: role,
            plan_id: plan_id

          },
          success: function(response) {
            //console.log(response);
			//alert('ddd');
			//location.href=site_url+'checkout';
		var required_Url = site_url+'checkout';
		$.ajax({
			type: "POST",
			url: required_Url,
			data: {
            fullname: fullname,
            email: email,
            country_code: country_code,
            phone: phone,
            password: pass,
            plan_id: plan_id

          },
			dataType: "json",
			success: function(data, txtStatus) {
				//alert(data.redirect);
				 
				if (data.redirect) {
					// data.redirect contains the string URL to redirect to
					location.href = data.redirect;
				}
				else {
					// data.form contains the HTML replacement form
					//$("#my_form").replaceWith(data.form);
				}
			}
		});


			if(response.msg == 'Login successfully')
			{
				location.href=site_url+'login';
			}
			else
			{
				//alert(response.msg);
			}
		    //location.href=site_url+'login';
            //alert("response is " + response);
            // var parsedJSON = jQuery.parseJSON(response ); //JSON.parse(response);
            //   alert("status is" +parsedJSON );

          },
        });
    }
	</script>
</body>

</html>