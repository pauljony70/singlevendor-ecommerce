<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title><?= get_store_settings('store_name') ?> - Home</title>
	<?php include("includes/head.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/product-card.css') ?>">
</head>

<body>
	<?php include("includes/preloader.php") ?>
	<?php include("includes/topbar.php"); ?>
	<?php include("includes/navbar.php"); ?>

	<main>
		<!--
		  	--------------------------------------------------- 
		  	Top full height video
		  	---------------------------------------------------
		-->
		<div class="top-video mb-3 mb-md-5">
			<div class="">
				<a href="<?= $home_banners['top_video'][0]['link'] ?>">
					<img src="<?= base_url('assets/images/banner3.jpg') ?>" alt="Banner" class="w-100 img-fluid">
				</a>
			</div>
		</div>
		<div class="container">
			<!--
		  		--------------------------------------------------- 
		  		Top Links
		  		---------------------------------------------------
			-->
			<!-- <div class="top-links pb-4">
				<div class="row">
					<?php foreach ($home_banners['top_link_section'] as $top_link_section) : ?>
						<div class="col-md-4 mb-2">
							<a href="<?= $top_link_section['link'] ?>" class="btn btn-outline-primary w-100"><?= $top_link_section['image'] ?></a>
						</div>
					<?php endforeach; ?>
				</div>
			</div> -->
			<!--
				--------------------------------------------------- 
				New Arrivals
				---------------------------------------------------
			-->
			<div class="top-category pt-4 mb-5">
				<h1 class="heading text-center mb-4">New Arrivals</h1>
				<div class="row">
					<?php foreach ($new_arrivals as $new_arrival) : ?>
						<div class="col-6 col-md-4 col-lg-3 mb-4">
							<a href="<?= base_url('productdetail/' . $new_arrival['prod_name'] . '/' . $new_arrival['prod_id']) ?>" class="d-flex flex-column card product-card rounded-0">
								<div class="product-card-img zoom-img rounded-0">
									<img src="<?= MEDIA_URL . json_decode($new_arrival['prod_img_url'], true)[0] ?>" class="card-img-top rounded-0" alt="<?= $new_arrival['prod_name'] ?>">
								</div>
								<div class="card-body d-flex flex-column product-card-body px-0">
									<h5 class="card-title product-title pb-3 fs-6"><?= $new_arrival['prod_name'] ?></h5>
									<div class="card-text d-flex flex-wrap py-1">
										<div class="sell-price fw-medium"><?= $new_arrival['prod_price'] ?></div>
										<?php if ($new_arrival['prod_mrp'] !== $new_arrival['prod_price']) : ?>
											<div class="mrp-price text-decoration-line-through fw-light"><?= $new_arrival['prod_mrp'] ?></div>
											<div class="discount text-danger fw-medium"><?= $new_arrival['offpercent'] ?>% OFF</div>
										<?php endif; ?>
									</div>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<!--
				--------------------------------------------------- 
				Top category
				---------------------------------------------------
			-->
			<div class="top-category mb-5">
				<h1 class="heading text-center mb-4">Shop By Category</h1>
				<div class="row">
					<?php foreach ($home_banners['top_category'] as $top_category) : ?>
						<a href="<?= $top_category['link'] ?>" class="col-6 col-md-3 mb-4">
							<img src="<?= base_url('media/' . $top_category['image']) ?>" alt="Category" srcset="" class="w-100">
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<!--
				--------------------------------------------------- 
				Trending Now
				---------------------------------------------------
			-->
			<div class="trending-now pt-4 mb-5">
				<h1 class="heading text-center mb-4">Trending Now</h1>
				<div class="row">
					<?php foreach ($home_banners['trending_section'] as $trending_section) : ?>
						<a href="<?= $trending_section['link'] ?>" class="col-md-4 mb-4">
							<img src="<?= base_url('media/' . $trending_section['image']) ?>" alt="Trending" srcset="" class="w-100">
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<!--
			--------------------------------------------------- 
			Full width banner
			---------------------------------------------------
		-->
		<div class="promo-banner">
			<?php foreach ($home_banners['promotion_section'] as $promotion_section) : ?>
				<a href="<?= $promotion_section['link'] ?>">
					<img src="<?= base_url('media/' . $promotion_section['image']) ?>" alt="Promo" srcset="" class="w-100 mb-5">
				</a>
			<?php endforeach; ?>
		</div>
		<!--
			--------------------------------------------------- 
			Bottom Links
			---------------------------------------------------
		-->
		<div class="container">
			<div class="top-links mb-4">
				<div class="row">
					<?php foreach ($home_banners['bottom_link_section'] as $bottom_link_section) : ?>
						<div class="col-md-3 mb-2">
							<a href="<?= $bottom_link_section['link'] ?>" class="btn btn-outline-primary w-100 h-100">
								<div class="d-flex align-items-center justify-content-center h-100"><?= $bottom_link_section['image'] ?></div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</main>

	<!-- Footer Area -->
	<?php include("includes/footer.php") ?>
	<!-- Footer Area End -->

	<?php include("includes/script.php") ?>
</body>

</html>