<?php
include('session.php');

if (!isset($_SESSION['admin'])) {
	header("Location: index.php");
}

?>
<?php
include("header.php");
function get_system_settings($conn, $type)
{
	$response = '';
	$query = $conn->query("SELECT * FROM `settings` WHERE type ='" . $type . "'");
	if ($query->num_rows > 0) {
		$rows = $query->fetch_assoc();

		$response = $rows['description'];
	}
	return $response;
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
						<h4 class="page-title">Store Setting</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card d-none">
						<div class="card-body">
							<div class="form-three widget-shadow">
								<h3>Set Values :</h3><br>
								<?php

								$newuser = "";
								$discountper = "";
								$minorder = "0";
								$freeship = "0";
								$cashondelivery = "";
								$stmt11 = $conn->prepare("SELECT name, value FROM store_config");
								$stmt11->execute();
								$stmt11->store_result();
								$stmt11->bind_result($col11, $col12);

								while ($stmt11->fetch()) {
									//  echo " order id ".$col1;
									if ($col11 == "newuser_coins") {
										$newuser  = $col12;
									} else if ($col11 == "coins_discount_percent") {
										$discountper  = $col12;
									} else if ($col11 == "minorder") {
										$minorder  = $col12;
									} else if ($col11 == "freeship") {
										$freeship  = $col12;
									} else if ($col11 == "cashondelivery") {
										$cashondelivery  = $col12;
									} else if ($col11 == "working_hour_start") {
										$working_hour_start  = $col12;
									} else if ($col11 == "working_hour_end") {
										$working_hour_end  = $col12;
									} else if ($col11 == "store_open_status") {
										if ($col12 == 0) {
											$store_open_status  = 'Open';
										} else {
											$store_open_status  = 'Close';
										}
									}
								}
								?>
								<form class="form-horizontal" id="myformmm">
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Free Shipping</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="freeship" placeholder="500" required value="<?php echo  $freeship;  ?>">
										</div>

									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Min Order</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="minorder" placeholder="200" required value="<?php echo  $minorder;  ?>">
										</div>

									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Cash On Delivery</label>
										<div class="col-sm-8">
											<button type="submit" class="btn btn-md btn-success" id="cashondelivery" onclick="updatePayment(); return false;" style="float:left; display: inline-block; margin-right:20px;"><?php echo  $cashondelivery;  ?></button>
										</div>
									</div>
									<?php /* <div class="form-group row">
        									<label for="focusedinput" class="col-sm-2 control-label">Working Hour Start</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control" id="working_hour_start" placeholder="500" required value="<?php echo  $working_hour_start;  ?>">
        									</div>
        								
        								</div>
										<div class="form-group row">
        									<label for="focusedinput" class="col-sm-2 control-label">Working Hour End</label>
        									<div class="col-sm-8">
        										<input type="text" class="form-control" id="working_hour_end" placeholder="500" required value="<?php echo  $working_hour_end;  ?>">
        									</div>
        								
        								</div> */ ?>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Store Status</label>
										<div class="col-sm-8">
											<button type="submit" class="btn btn-md btn-success" id="store_open_status" onclick="updatestore(); return false;" style="float:left; display: inline-block; margin-right:20px;"><?php echo  $store_open_status;  ?></button>
										</div>
									</div>

									</br></br>
									<div class="col-sm-offset-2">
										<button type="submit" class="btn btn-dark" href="javascript:void(0)" onclick="addConfig(this); return false;">Save</button>
									</div>


								</form>






							</div>
							<div class="clearfix"> </div>

						</div>


						<?php

						$name = "";
						$address = "";
						$phone = "";
						$whatsapp = "";
						$website = "";
						$aboutus = "";
						$termc = "";
						$email = "";
						$youtube = "";
						$stmt11 = $conn->prepare("SELECT store_name, address, phone, whatsappno, termcondition, aboutus, email, youtubeurl FROM store_setting");
						$stmt11->execute();
						$stmt11->store_result();
						$stmt11->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col17, $col8);

						while ($stmt11->fetch()) {
							//  echo " order id ".$col1;

							$name = $col1;
							$address = $col2;
							$phone = $col3;
							$whatsapp = $col4;
							$termc = $col5;
							$aboutus = $col6;
							$email = $col17;
							$youtube = $col8;
						}

						?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="form-three widget-shadow">
								<div class="d-flex justify-content-between">
									<div>
										<h3>Add Business Details :</h3>
									</div>
									<div>
										<?php
										if ($_SESSION['roll'] === "admin") {
											echo "	<button onclick=\"location.href = 'userprofile.php';\" type = \"button\" class = \"btn btn-primary  pull-right\">Manage User</button>";
										}

										?>
									</div>
								</div>

								<!--	<button onclick="location.href = 'userprofile.php';" type = "button" class = "btn btn-primary  pull-right">Manage User</button>  -->



								<form class="form-horizontal" id="myform">
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Business Name</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="name" placeholder="Name" required value="<?php echo $name;  ?>">
										</div>
										<div class="col-sm-2">
											<p class="help-block"></p>
										</div>
									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Address</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="address" placeholder="Business Address" required value="<?php echo $address;  ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Phone</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="phone" placeholder="Use , for multiple phone number. Ex. 0755123456, 546548745" required value="<?php echo $phone;  ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">WhatsApp No <br> (With 91)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="whatsapp" placeholder=" with 91 " value="<?php echo $whatsapp;  ?>">
										</div>
									</div>

									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Contact Email <br> (optional)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="email" placeholder="Contact email id" value="<?php echo $email;  ?>">
										</div>
									</div>
									<div class="form-group row" style="display:none;">
										<label for="focusedinput" class="col-sm-2 control-label">TAX GST No <br> (optional)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="tax" placeholder="Ex. GSTIN Number" value="<?php echo $tax;  ?>">
										</div>
									</div>
									<div class="form-group row" style="display:none;">
										<label for="focusedinput" class="col-sm-2 control-label">Website URL <br> (optional)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="website" placeholder="Ex. www.blueappsoftware.com" value="<?php echo $website;  ?>">
										</div>
									</div>
									<div class="form-group row d-none">
										<label for="exampleInputFile" class="col-sm-2 control-label">Brochure Photo</label>
										<div class="col-sm-9">
											<div class="input-files">
												<div style="vertical-align: middle; margin-top:5px;">

													<input type="file" name="1" id="1" style="float:left; display: inline-block; margin-right:20px;" required>
													<button type="submit" class="btn btn-sm btn-success" onclick="uploadImage('1'); return false;" style="float:left; display: inline-block; margin-right:20px;">Upload</button>
													<button type="submit" class="btn btn-sm btn-danger" onclick="removeImage('1'); return false;" style="float:left; display: inline-block; margin-right:20px;">Remove</button>

												</div>
												</br>
											</div>

										</div>
									</div>
									<div class="form-group row d-none">
										<label for="focusedinput" class="col-sm-2 control-label">Yoututbe URL <br> (optional)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="youtube" placeholder="Youtube Channel URL" value="<?php echo $youtube;  ?>">
										</div>
									</div>

									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">About Us</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="6" cols="90" id="aboutus" name="aboutus" form="usrform" placeholder="Enter text here..."><?php echo $aboutus;  ?></textarea>
										</div>
									</div>

									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Term & Condition</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="6" cols="90" id="termc" name="termc" form="usrform" placeholder="Enter text here..."><?php echo $termc;  ?></textarea>
										</div>
									</div>

									</br></br>
									<div class="col-sm-offset-2">
										<button type="submit" class="btn btn-dark" href="javascript:void(0)" onclick="return false;">Save</button>
									</div>


								</form>
							</div>




						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="form-three widget-shadow">
								<h3>Website Settings</h3><br>

								<form class="form-horizontal" id="website_settings">
									<div class="form-group row d-none">
										<label for="focusedinput" class="col-sm-2 control-label">Topbar Offer</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="topbar_offer" name="topbar_offer" placeholder="500" required value="<?= get_system_settings($conn, 'topbar_offer') ?>">
										</div>
									</div>

									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Theme Colour (Hex code)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="theme_color" name="theme_color" placeholder="500" required value="<?= get_system_settings($conn, 'theme_color') ?>">
										</div>
									</div>

									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">COD Available</label>
										<div class="col-sm-8">
											<select name="cod_available" id="cod_available" class="form-control">
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>

									<div class="form-group row d-none">
										<label for="focusedinput" class="col-sm-2 control-label">Footer Text</label>
										<div class="col-sm-8">
											<textarea name="footer_text" class="form-control" id="footer_text" cols="30" rows="10"><?= get_system_settings($conn, 'footer_text') ?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Facebook Link</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="facebook_link" name="facebook_link" placeholder="500" required value="<?= get_system_settings($conn, 'facebook_link') ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Instagram Link</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="instagram_link" name="instagram_link" placeholder="500" required value="<?= get_system_settings($conn, 'instagram_link') ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Snapchat Link</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="snapchat_link" name="snapchat_link" placeholder="500" required value="<?= get_system_settings($conn, 'snapchat_link') ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Twitter Link</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="twitter_link" name="twitter_link" placeholder="500" required value="<?= get_system_settings($conn, 'twitter_link') ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Youtube Link</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="youtube_link" name="youtube_link" placeholder="500" required value="<?= get_system_settings($conn, 'youtube_link') ?>">
										</div>
									</div>
									</br></br>
									<div class="col-sm-offset-2">
										<button type="submit" class="btn btn-dark" href="javascript:void(0)" onclick="return false;">Save</button>
									</div>


								</form>

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
							<div class="form-three widget-shadow">
								<h3>Script Settings</h3><br>

								<form class="form-horizontal" id="scriptform">
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Header Scripts</label>
										<div class="col-sm-8">
											<textarea class="form-control" name="gtag_manager" id="gtag_manager" cols="30" rows="10"><?= get_system_settings($conn, 'gtag_manager') ?></textarea>
										</div>
									</div>

									<!-- <div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Facebook Pixel</label>
										<div class="col-sm-8">
											<textarea class="form-control" name="facebook_pixel" id="facebook_pixel" cols="30" rows="10"><?= get_system_settings($conn, 'facebook_pixel') ?></textarea>
										</div>
									</div> -->


									</br></br>
									<div class="col-sm-offset-2">
										<button type="submit" class="btn btn-dark" href="javascript:void(0)" onclick="return false;">Save</button>
									</div>


								</form>

							</div>
							<div class="clearfix"> </div>

						</div>


						<?php

						$name = "";
						$address = "";
						$phone = "";
						$whatsapp = "";
						$website = "";
						$aboutus = "";
						$termc = "";
						$email = "";
						$youtube = "";
						$stmt11 = $conn->prepare("SELECT store_name, address, phone, whatsappno, termcondition, aboutus, email, youtubeurl FROM store_setting");
						$stmt11->execute();
						$stmt11->store_result();
						$stmt11->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col17, $col8);

						while ($stmt11->fetch()) {
							//  echo " order id ".$col1;

							$name = $col1;
							$address = $col2;
							$phone = $col3;
							$whatsapp = $col4;
							$termc = $col5;
							$aboutus = $col6;
							$email = $col17;
							$youtube = $col8;
						}

						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="form-three widget-shadow">
								<h3>Third Party APIs</h3><br>

								<form class="form-horizontal" id="thirdpartyapiform">
									<div class="form-group row">
										<label for="focusedinput" class="col-sm-2 control-label">Razorpay Key</label>
										<div class="col-sm-8">
											<input type="text" name="razorpay_key" id="razorpay_key" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label for="shiprocket_email" class="col-sm-2 control-label">Shiprocket Email</label>
										<div class="col-sm-8">
											<input type="text" name="shiprocket_email" id="shiprocket_email" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label for="shiprocket_password" class="col-sm-2 control-label">Shiprocket Password</label>
										<div class="col-sm-8">
											<input type="text" name="shiprocket_password" id="shiprocket_password" class="form-control">
										</div>
									</div>

									</br></br>
									<div class="col-sm-offset-2">
										<button type="submit" class="btn btn-dark" href="javascript:void(0)" onclick="return false;">Save</button>
									</div>


								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"> </div>

</div>


<div class="col_1">


	<div class="clearfix"> </div>

</div>

<!--footer-->
<?php include('footernew.php'); ?>

<script>
	function updateSetting(form) {
		event.preventDefault();
		// $.busyLoadFull("show");
		var form = document.getElementById('scriptform'); // Get the form element by its ID
		var formData = new FormData(form);
		formData.append('code', '123@384#$$65$');
		formData.append('type', 'default_setting');
		$.ajax({
			method: 'POST',
			url: 'update_system_settings.php',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response) {
				$.busyLoadFull("hide");
				var data = $.parseJSON(response);
				if (data["status"] == "1") {
					successmsg(data["msg"]);
				} else {
					successmsg(data["msg"]);
				}
			}
		});
	}
</script>

<script>
	function updateWebsiteSetting(form) {
		event.preventDefault();
		// $.busyLoadFull("show");
		var form = document.getElementById('website_settings'); // Get the form element by its ID
		console.log(form);
		var formData = new FormData(form);
		formData.append('code', '123@384#$$65$');
		formData.append('type', 'default_setting');
		$.ajax({
			method: 'POST',
			url: 'update_system_settings.php',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response) {
				$.busyLoadFull("hide");
				var data = $.parseJSON(response);
				if (data["status"] == "1") {
					successmsg(data["msg"]);
				} else {
					successmsg(data["msg"]);
				}
			}
		});
	}
</script>

<script type="text/javascript">
	/// upload image /video
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
				alert(response); // display response from the PHP script, if any
				var thumname = response.replace("Upload successfully--", "");

				imagejson = thumname;
			}
		});

	}
</script>
<script>
	function removeImage(element) {

		//  alert( "input name---"+ element+"---" );
		var file_data = $('#' + element).prop('files')[0];
		var form_data = new FormData();
		form_data.append('file', file_data);
		$('#' + element).val('');


		imagejson = "";



	}
</script>

<script>
	function addBusiness() {

		//alert( " -- " );
		var prod_namevalue = $('#name').val();
		var prod_addrsvalue = $('#address').val();
		var prod_phonevalue = $('#phone').val();
		var whatsappvalue = $('#whatsapp').val();
		var prod_taxvalue = $('#tax').val();
		var prod_websitevalue = $('#website').val();
		var prod_termcvalue = $('#termc').val();
		var aboutus_value = $('#aboutus').val();
		var email_value = $('#email').val();
		var youtube_value = $('#youtube').val();

		var count = 1;

		if (prod_namevalue == "" || prod_namevalue == null) {

			alert("Business Name is empty");
		} else if (prod_addrsvalue == "" || prod_addrsvalue == null) {

			alert("Address is empty");
		} else if (prod_phonevalue == "" || prod_phonevalue == null) {

			alert("Phone Number is empty");
		} else {
			//  alert(" ready to store "+whatsappvalue );

			$.ajax({
				method: 'POST',
				url: 'store_setting_process.php',
				data: {
					code: "123",
					name: prod_namevalue,
					address: prod_addrsvalue,
					phone: prod_phonevalue,
					tax: prod_taxvalue,
					website: prod_websitevalue,
					imagejson: imagejson,
					whatsapp: whatsappvalue,
					termc: prod_termcvalue,
					aboutus: aboutus_value,
					email: email_value,
					youtube: youtube_value
				},
				success: function(response) {
					alert(response); // display response from the PHP script, if any
					// imagejson.length = 0;
					/*    $(':input','#myform')
					      .not(':button, :submit, :reset, :hidden')
					      .val('')
					      */
				}
			});



		}
	}
</script>
<script>
	function addConfig() {

		var freeshipvalue = $('#freeship').val();
		var minordervalue = $('#minorder').val();
		var working_hour_start = $('#working_hour_start').val();
		var working_hour_end = $('#working_hour_end').val();
		// alert(" config "+signupcoinsvalue );

		$.ajax({
			method: 'POST',
			url: 'store_config_process.php',
			data: {
				code: "123@384#$$65$",
				freeship: freeshipvalue,
				minorder: minordervalue,
				working_hour_start: working_hour_start,
				working_hour_end: working_hour_end
			},
			success: function(response) {
				alert(response); // display response from the PHP script, if any

			}
		});


	}
</script>


<script>
	function addWebsiteConfig() {

		var topbar_offer = $('#topbar_offer').val();
		// alert(" config "+signupcoinsvalue );

		$.ajax({
			method: 'POST',
			url: 'website_config_process.php',
			data: {
				code: "123@384#$$65$",
				topbar_offer: topbar_offer,
			},
			success: function(response) {
				alert(response); // display response from the PHP script, if any
			}
		});


	}
</script>


<script type="text/javascript">
	function addAllIndia(element) {

		var allindiashipfeesvalue = $('#allindiashipvalue').val();
		// var myJSON = JSON.stringify(imagejson);
		// alert( "kaka "+ imagejson);

		$.ajax({
			method: 'POST',
			url: 'edit_pincode_allindia_process.php',
			data: {
				code: "212125487785",
				shipfees: allindiashipfeesvalue
			},
			success: function(response) {
				alert(response); // display response from the PHP script, if any
				//  window.open("events.php","_self");  
				$(':input', '#myform')
					.not(':button, :submit, :reset, :hidden')
					.val('');

			}
		});
	}
</script>
<script type="text/javascript">
	function addMHfees(element) {

		var mhshipfeesvalue = $('#mhshipvalue').val();
		// var myJSON = JSON.stringify(imagejson);
		// alert( "kaka "+ imagejson);

		$.ajax({
			method: 'POST',
			url: 'edit_pincode_mh_process.php',
			data: {
				code: "212125487785",
				shipfees: mhshipfeesvalue
			},
			success: function(response) {
				alert(response); // display response from the PHP script, if any
				//  window.open("events.php","_self");  
				$(':input', '#myform')
					.not(':button, :submit, :reset, :hidden')
					.val('');

			}
		});
	}
</script>


<script>
	function updatePayment() {

		var payvalue = $('#cashondelivery').text();
		//  alert("Pay value "+payvalue );
		$.ajax({
			method: 'POST',
			url: 'store_cashondelivery.php',
			data: {
				code: "123",
				payvalue: payvalue
			},
			success: function(response) {
				//alert(response); // display response from the PHP script, if any
				var parsedJSON = JSON.parse(response);
				//   alert(" status "+parsedJSON.msg);
				$("#cashondelivery").text(parsedJSON.newvalue);

			}
		});

	}

	function updatestore() {

		var store_open_status = $('#store_open_status').text();
		//  alert("Pay value "+payvalue );
		$.ajax({
			method: 'POST',
			url: 'store_update.php',
			data: {
				code: "123",
				store_open_status: store_open_status
			},
			success: function(response) {
				//alert(response); // display response from the PHP script, if any
				var parsedJSON = JSON.parse(response);
				//   alert(" status "+parsedJSON.msg);
				$("#store_open_status").text(parsedJSON.newvalue);

			}
		});

	}
</script>