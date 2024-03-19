<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Register - <?= get_store_settings('store_name') ?></title>
	<?php include("includes/head.php") ?>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/login.css') ?>">
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

	<!-- <main>
		<section class="login-area-wrap">
			<div class="container">
				<div class="row mt-50">
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 both-small-50 mx-auto">
						<div class="sign-wrap">
							<div class="login-content-title text-center mb-4">
								<h4 class=" fs-5">Customer Signup</h4>
							</div>
							<form id="signup_form" action="" method="POST" class="contat-input">
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label form-check-label-first">Your Name*</label>
										<input type="text" name="name" id="user_name">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">Phone Number:</label>
										<input type="text" onkeypress="return isNumberKey(event)" maxlength="10" name="phone" id="user_mobile">
									</div>

									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">Password:</label>
										<input type="password" name="password" id="user_password" maxlength="30">
									</div>

									<div class="col-xl-12 col-lg-12 col-sm-12 col-12 mb-3">
										<label class="form-check-label">Confirm Password:</label>
										<input type="password" name="c_password" id="user_passwordre" maxlength="30">
									</div>

									<div class="details-page-reply-btn-wrap d-flex">
										<button type="submit" id="signup_btn" class="common-btn shop-details-review-btn">Signup</button>
										<div class=" ms-3 d-none" id="form-message">
										</div>
									</div>
								</div>
							</form>
						</div>

						<p class="text-start mt-4 black-text">Already have an Account ! <a href="login" class="color-text">Log In here</a></p>
					</div>
				</div>
			</div>
		</section>
	</main> -->

	<main class="login_main_box">
		<!-- Login Form Area -->
		<section class="login-area-wrap">
			<div class="container">
				<div class="row">
					<div class="login_main_container my-5 px-0">
						<img src="<?= base_url() ?>assets/images/login-banner.jpg" alt="login_banner_img" class="login_banner_img w-100">
						<div class="login-wrap">
							<div class="customer_login font-family-lora fw-medium">Signup</div>

							<div class="my-3 login-des">To quickly find your favourite items, saved addresses and payments.</div>

							<form id="contact-form" action="" method="POST" class="contat-input">
								<div class="form-floating mb-3">
									<input type="text" class="form-control ps-1 rounded-0" id="fullname" name="fullname" placeholder="John Doe">
									<label class="ps-0" for="emailOtp">Fullname</label>
									<span id="error"></span>
								</div>

								<div class="input-group form-floating mb-3">
									<input type="email" class="form-control ps-1 rounded-0" id="email" name="email" placeholder="name@example.com">
									<label class="ps-0" for="email">Email address</label>
									<button type="button" class="btn btn-outline-secondary border-0 border-bottom" id="send-otp-btn" type="button">Send OTP</button>
									<span id="error"></span>
								</div>

								<div class="form-floating mb-3">
									<input type="number" class="form-control ps-1 rounded-0" id="emailOtp" name="emailOtp" placeholder="123456" oninput="enforceMaxLength(this)" maxlength="6">
									<label class="ps-0" for="emailOtp">OTP</label>
									<span id="error"></span>
								</div>

								<button type="submit" id="signin_button" class="btn btn-lg btn-primary rounded-2 mt-3 w-100">Submit</button>
							</form>
							<p class="text-start mt-4 black-text">Already have an account ! <a href="<?= base_url('login') ?>" class="color-text">Log in here</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Login Form Area End -->
	</main>

	<!-- Footer Area -->
	<?php include("includes/footer.php") ?>
	<!-- Footer Area End -->

	<?php include("includes/script.php") ?>
	<script src="<?= base_url('assets/js/app/register.js'); ?>"></script>
</body>

</html>