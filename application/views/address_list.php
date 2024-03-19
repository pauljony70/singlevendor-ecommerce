<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Address List - Mkkirana</title>

	<?php include("includes/head.php") ?>
	<style>
		.inner-wish {
			position: relative;
		}

		.delivery-add {
			background-color: #fff;
			border-radius: 8px;
			border: 1px solid gainsboro;
			padding: 10px;
			margin-bottom: 10px;
		}

		.inner-wish .right {
			display: inline-block;
			vertical-align: top;
			width: 80%;
			margin-left: 15px;
		}

		.delivery-add p {
			margin-bottom: 0;
			color: gray;
		}

		.inner-wish .right .cart {
			bottom: 10px;
			right: 20px;
			position: absolute;
			background-color: orange;
			color: #fff;
			padding: 4px 8px;
			border-radius: 50%;
		}

		.inner-wish .right .close {
			position: absolute;
			top: 20px;
			right: 20px;
			opacity: 1;
			padding: 4px 6px;
			border-radius: 50%;
			border: 2px solid;
			font-size: 15px;
		}
	</style>

</head>



<body>
	<!-- Preloder -->
	<?php include("includes/preloader.php") ?>
	<!-- Preloder End -->

	<!-- back to to button start-->
	<a href="#" id="scroll-top" class="back-to-top-btn"><i class='bx bx-up-arrow-alt'></i></a>
	<!-- back to to button end-->

	<!-- Header area -->
	<?php include("includes/navbar.php") ?>
	<!-- Header area end -->

	<main>
		<!-- Checkout Area -->
		<section class="checkout-area mt-4">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="checkout-bill-title">
							<h4>Saved Addresses</h4>
						</div>
					</div>
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div id="delivery_address_id1">
						</div>
					</div>

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<a href="<?php echo base_url; ?>checkout" class="float-end"><button class="common-btn shop-details-review-btn update-cart-content-btn">Continue</button></a>
					</div>
				</div>

				<div class="row my-5">
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mx-auto">
						<div class="checkout-form-wrap">
							<div class="checkout-bill-title">
								<h4 class="fs-4 text-center">Add a New Address</h4>
							</div>
							<form id="contact-form-two" action="" method="POST" class="contat-input checkout-form-input new-add">
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label form-check-label-first">Full Name*</label>
										<input type="text" name="name" class="form-control" id="address_full_name" placeholder="Full Name">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">Email</label>
										<input type="email" name="email" class="form-control" id="address_email" placeholder="Email">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">Address Line 1</label>
										<input type="text" name="address_line1" class="form-control" id="address_line1" placeholder="Address line 1">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">Address Line 2</label>
										<input type="text" name="address_line2" class="form-control" id="address_line2" placeholder="Address line 2">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">City</label>
										<input type="text" name="address_city" class="form-control" id="address_city" placeholder="City">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">State</label>
										<input type="text" name="address_state" class="form-control" id="address_state" placeholder="State">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">Pincode</label>
										<input type="text" name="address_pincode" class="form-control" onkeypress="return isNumberKey(event)" id="address_pincode" placeholder="Pincode">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12 mb-3">
										<label class="form-check-label">Phone Number</label>
										<input type="text" name="address_phone" class="form-control" onkeypress="return isNumberKey(event)" id="address_phone" placeholder="Phone Number">
									</div>
									<div class="details-page-reply-btn-wrap d-flex">
										<button class="common-btn shop-details-review-btn update-cart-content-btn" id="address_save_btn">Save</button>
										<div class=" ms-3 d-none" id="form-message">
										</div>
									</div>
									<!-- <p class="form-message"></p> -->
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Checkout Area End -->
	</main>
	<!-- Footer Area -->
	<?php include("includes/footer.php") ?>
	<!-- Footer Area End -->

	<?php include("includes/script.php") ?>
	<script src="<?php echo site_url(); ?>/assets/js/checkout.js"></script>
</body>

</html>