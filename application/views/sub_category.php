<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Mkkirana. - Category Products</title>
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

	<main>

		<section>
			<div class="breadcrumb-area py-3">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="breadcrumb-content text-center">
								<div class="breadcrumb-link">
									<p><a href="/">Home</a></p>
									<span></span>
									<p><?= $name_cat[0]['name'] ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


		<!-- Shop Area -->

		<section class="home-three-category-area mt-4 mb-76">
			<div class="container">
				<div class="row">
					<?php
					// print_r($category);
					if (!empty($category)) {
						foreach ($category as $category_data) { ?>
							<div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-6">
								<div class="arrival-box home-three-arrival-box all_cat">
									<div class="arrival-box-img">
										<a href="<?php echo base_url(); ?>sub_category/<?php echo $category_data['id']; ?>"><img src="<?php echo '../media/' . $category_data['imgurl']; ?>" alt=""></a>
									</div>
									<div class="arrival-box-content text-center">
										<h6><a href="<?php echo base_url(); ?>sub_category/<?php echo $category_data['id']; ?>"><?php echo $category_data['name']; ?></a></h6>
										<div class="col-12">
											<div class="row">
												<?php
												foreach ($category_data['subcat_1'] as $subcat_1) { ?>
													<ul class="list-unstyled ps-4">
														<li><span class=" d-inline-flex align-items-center"><i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;<a class="text-dark text-decoration-none fs-6" href="<?php echo base_url() . 'sub_category/' . $subcat_1['name']; ?>"><?php echo $subcat_1['name'] ?></a></span></li>
														<?php foreach ($subcat_1['subsubcat_2'] as $sub_to_sub_cat_1) { ?>
															<li><span class=" d-inline-flex align-items-center"><i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;<a class="text-dark text-decoration-none fs-6" href="<?php echo base_url() . 'sub_category/' . $sub_to_sub_cat_1['name']; ?>"><?php echo $sub_to_sub_cat_1['name'] ?></a></span></li>
														<?php } ?>
													</ul>
												<?php
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php }
					} else {
						redirect(base_url('category/' . preg_replace('/[^A-Za-z0-9\s]/', ' ', $name_cat[0]['name']) . '/' . $cat_id));
					}
					?>
				</div>
			</div>
		</section>

		<!-- Shop Area End -->

	</main>



	<!-- Footer Area -->

	<?php include("includes/footer.php") ?>

	<!-- Footer Area End -->



	<?php include("includes/script.php") ?>



</body>



</html>