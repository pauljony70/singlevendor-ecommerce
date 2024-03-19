<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Mkkirana - Contact Us</title>

	<?php include("includes/head.php") ?>

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

	<main class="mb-5">
		<section>
			<div class="breadcrumb-area">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="breadcrumb-content text-center">
								<h3>Contact us</h3>
								<div class="breadcrumb-link">
									<p><a href="<?php echo base_url; ?>" class="home_link_bread">Home</a></p>
									<span></span>
									<p>Contact us</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Contact Area Area -->
		<section class="contsct-area">
			<div class="container">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="login-form-description">
							<div class="shop-details-content-title">
								<h4>Our information</h4>
							</div>
							<div class="shop-details-content-description login-form-content-description">
								<p><b>Location :</b> Delhi</p>
								<p><b>Mobile Number:</b> </p>
								<p><b>Email:</b> support@mkkirana.com</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-50">
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
						<div class="location-map d-table h-100 w-100">
							<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d59956.56854490233!2d74.38566064649537!3d20.08034746393019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sLaxmi%20Nagar%20Vinchur%20Road%2CYeola%20Near%20K%20K%20Bajaj%20Showroom%2C%20NASHIK%2C%20MAHARASHTRA%2C%20Nashik%2CMaharashtra%2C423401!5e0!3m2!1sen!2sin!4v1658923629841!5m2!1sen!2sin" style="border:0;" aria-hidden="false" tabindex="0" allowfullscreen=""></iframe>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 both-small-50">
						<div class="contact-form-wrap">
							<form id="contact-form" action="mail.php" method="POST" class="contat-input shop-details-contat-input">
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label form-check-label-first">Your Name*</label>
										<input type="text" name="name" class="form-control">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">Your Email*</label>
										<input type="email" name="email" class="form-control">
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="form-check-label">Type something:</label>
										<textarea name="message" id="message" cols="30" rows="4" class="form-control"></textarea>
									</div>
									<div class="col-xl-12 col-lg-12 col-sm-12 col-12">
										<label class="shop-check">Save my name, email, and website for the next time I comment.
											<input type="checkbox">
											<span class="checkmark"></span>
										</label>
									</div>
									<div class="details-page-reply-btn-wrap">
										<button type="submit" class="common-btn shop-details-review-btn">Submit</button>
									</div>
									<p class="form-message"></p>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Contact Area Area End -->
	</main>

	<!-- Footer Area -->
	<?php include("includes/footer.php") ?>
	<!-- Footer Area End -->

	<?php include("includes/script.php") ?>
</body>

</html>