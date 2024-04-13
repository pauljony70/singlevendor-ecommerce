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
	<?php include("includes/topbar.php") ?>
	<!-- Preloder End -->

	<!-- back to to button start-->
	<a href="#" id="scroll-top" class="back-to-top-btn"><i class='bx bx-up-arrow-alt'></i></a>
	<!-- back to to button end-->

	<!-- Header area -->
	<?php include("includes/navbar.php") ?>
	<!-- Header area end -->

	<main class="login_main_box">
		<!-- Login Form Area -->
		<section class="login-area-wrap">
			<div class="container">
				<div class="row">
					<div class="login_main_container my-5 px-0">
						<img src="<?= base_url() ?>assets/images/login-banner.png" alt="login_banner_img" class="login_banner_img w-100">
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