<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title><?= get_store_settings('store_name') ?> - Home</title>
	<?php include("includes/head.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
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
		<div class="top-video mb-5">
			<a href="<?= $home_banners['top_video'][0]['link'] ?>">
				<video src="<?= base_url('media/' . $home_banners['top_video'][0]['image']) ?>" class="w-100" autoplay muted loop></video>
			</a>
		</div>
		<div class="container">
			<!--
		  		--------------------------------------------------- 
		  		Top Links
		  		---------------------------------------------------
			-->
			<div class="top-links pb-4">
				<div class="row">
					<?php foreach ($home_banners['top_link_section'] as $top_link_section) : ?>
						<div class="col-md-4 mb-2">
							<a href="<?= $top_link_section['link'] ?>" class="btn btn-outline-primary w-100"><?= $top_link_section['image'] ?></a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<!--
				--------------------------------------------------- 
				Top category
				---------------------------------------------------
			-->
			<div class="top-category pt-4 mb-5">
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