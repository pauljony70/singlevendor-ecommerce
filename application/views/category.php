<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title><?= get_store_settings('store_name') ?> - Category Products</title>
	<?php include("includes/head.php") ?>

	<link rel="stylesheet" href="<?= base_url('assets/css/product-filter.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/product-card.css') ?>">
</head>

<body>
	<!-- Preloder -->
	<?php include("includes/preloader.php") ?>
	<!-- Preloder End -->

	<!-- back to to button start-->
	<a href="#" id="scroll-top" class="back-to-top-btn"><i class='bx bx-up-arrow-alt'></i></a>
	<!-- back to to button end-->

	<!-- Header area -->
	<?php include("includes/topbar.php") ?>
	<?php include("includes/navbar.php") ?>
	<!-- Header area end -->

	<main>
		<input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat_id; ?>">
		<div class="offcanvas offcanvas-start" tabindex="-1" id="mobilefilteroffcanvas" aria-labelledby="mobilefilteroffcanvasLabel">
			<div class="offcanvas-header align-items-center justify-content-between border-bottom">
				<h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter By</h5>
				<button type="button" class="close-btn-offcanvas text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
			<div class="offcanvas-body">
				<div class="accordion accordion-flush" id="accordionFlushFilterMobile">
					<?php if (!empty($price_filter['min_price']) && !empty($price_filter['max_price'])) :  ?>
						<?php if ($price_filter['min_price'] != $price_filter['max_price']) :  ?>
							<!-- Price Slider -->
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button collapsed px-0 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-price" aria-expanded="false" aria-controls="flush-price">
										Price
									</button>
								</h2>
								<div id="flush-price" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFilterMobile">
									<div>
										<div class="noui-wrapper">
											<div class="d-flex justify-content-between mb-3">
												<input type="text" class="form-control me-4 text-center" readonly>
												<input type="text" class="form-control text-center" readonly>
											</div>
											<div class="noui-slider-div">
												<div class="noui-slider-range mt-2" data-range-min='<?= $price_filter['min_price'] ?>' data-range-max='<?= $price_filter['max_price'] ?>' data-range-selected-min='<?= $price_filter['min_price'] ?>' data-range-selected-max='<?= $price_filter['max_price'] ?>'></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr>
						<?php endif; ?>
					<?php endif; ?>
					<?php
					foreach ($product_filter as $p_weight) :
						$encoded_filter_name = preg_replace('/[^a-zA-Z0-9]/', '', $p_weight['name']);
					?>
						<div class="accordion-item">
							<h2 class="accordion-header">
								<button class="accordion-button collapsed px-0 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-<?= $encoded_filter_name ?>" aria-expanded="false" aria-controls="flush-<?= $encoded_filter_name ?>">
									<?= $encoded_filter_name ?>
								</button>
							</h2>
							<div id="flush-<?= $encoded_filter_name ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFilterMobile">
								<?php foreach ($p_weight['value'] as $key => $product_weight) : ?>
									<div class="form-check">
										<input type="hidden" name="attr_name" id="attr_name" value="<?= $p_weight['name']; ?>">
										<input type="hidden" name="attr_id" id="attr_id" value="<?= $p_weight['attr_id']; ?>">
										<input class="form-check-input" type="checkbox" value="<?= $product_weight; ?>" id="flexCheckChecked">
										<label <?= $p_weight['name'] == 'Color' ? 'style="' . getDarkColorStyle($product_weight) . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<hr>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<section class="shop-area filter-page my-5">
			<div class="container">
				<?php if (!empty($category_details)) : ?>
					<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
						<ol class="breadcrumb mb-4">
							<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
							<?php foreach ($category_tree as $key => $category) : ?>
								<?php if (count($category_tree) - 1 == $key) : ?>
									<li class="breadcrumb-item active" aria-current="page"><?= $category['cat_name'] ?></li>
								<?php else : ?>
									<li class="breadcrumb-item"><a href="<?= base_url('category/' . $category['cat_name'] . '/' . $category['cat_id']) ?>"><?= $category['cat_name'] ?></a></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ol>
					</nav>
					<div class="row main_content">
						<div class="col-3 col-md-2 d-none d-md-block">
							<h6 class="filter_head">Filter By:</h6>
							<hr>
							<!-- Accordian Start -->
							<div class="accordion accordion-flush" id="accordionFlushFilter">
								<?php if (!empty($price_filter['min_price']) && !empty($price_filter['max_price'])) :  ?>
									<?php if ($price_filter['min_price'] != $price_filter['max_price']) :  ?>
										<!-- Price Slider -->
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed px-0 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-price" aria-expanded="false" aria-controls="flush-price">
													Price
												</button>
											</h2>
											<div id="flush-price" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFilter">
												<div>
													<div class="noui-wrapper">
														<div class="d-flex justify-content-between mb-3">
															<input type="text" class="form-control me-4 text-center" readonly>
															<input type="text" class="form-control text-center" readonly>
														</div>
														<div class="noui-slider-div">
															<div class="noui-slider-range mt-2" data-range-min='<?= $price_filter['min_price'] ?>' data-range-max='<?= $price_filter['max_price'] ?>' data-range-selected-min='<?= $price_filter['min_price'] ?>' data-range-selected-max='<?= $price_filter['max_price'] ?>'></div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<hr>
									<?php endif; ?>
								<?php endif; ?>
								<?php
								foreach ($product_filter as $p_weight) :
									$encoded_filter_name = preg_replace('/[^a-zA-Z0-9]/', '', $p_weight['name']);
								?>
									<div class="accordion-item">
										<h2 class="accordion-header">
											<button class="accordion-button collapsed px-0 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-<?= $encoded_filter_name ?>" aria-expanded="false" aria-controls="flush-<?= $encoded_filter_name ?>">
												<?= $encoded_filter_name ?>
											</button>
										</h2>
										<div id="flush-<?= $encoded_filter_name ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFilter">
											<?php foreach ($p_weight['value'] as $key => $product_weight) : ?>
												<div class="form-check">
													<input type="hidden" name="attr_name" id="attr_name" value="<?= $p_weight['name']; ?>">
													<input type="hidden" name="attr_id" id="attr_id" value="<?= $p_weight['attr_id']; ?>">
													<input class="form-check-input" type="checkbox" value="<?= $product_weight; ?>" id="flexCheckChecked">
													<label <?= $p_weight['name'] == 'Color' ? 'style="' . getDarkColorStyle($product_weight) . '"' : '' ?> class="form-check-label <?= $p_weight['name'] ?>"><?= $p_weight['name'] != 'Color' ?  $product_weight : '' ?></label>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
									<hr>
								<?php endforeach; ?>
							</div>
							<!-- Accordian END -->
						</div>
						<div class="col-12 col-md-10">
							<div class="row align-items-center mb-3">
								<div class="col-4 product-count"><span id="total_products">0</span> Results</span></div>
								<div class="col-8 d-flex align-items-center justify-content-end">
									<div class="product-count me-3">Sort By :</div>
									<select class="form-select" id="sort_data_id" aria-label="Sort By option">
										<option id="0" value="0">Most Relevent</option>
										<option id="1" value="1">Price Low to High</option>
										<option id="2" value="2">Price High to Low</option>
										<option id="3" value="3">New Arrivals</option>
										<option id="4" value="4">Popular</option>
									</select>
								</div>
								<!-- Mobile Sorting Menu -->
								<div class="mobile-sorting mt-3 text-center d-md-none">
									<button class="btn text-secondary w-100 fw-medium" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilefilteroffcanvas" aria-controls="mobilefilteroffcanvas">FILTERS</button>
								</div>
							</div>
							<!-- Sorting checks -->
							<!-- <div class="sorting_checks"></div> -->
							<div class="product_cards">
								<div class="row" id="category_product">
									<!-- <?php foreach ($category_details as $popular_product_data) : ?>
										<div class="col-6 col-md-4 col-lg-3 mb-4">
											<a href="<?= base_url('productdetail/' . $popular_product_data['prod_name'] . '/' . $popular_product_data['prod_id']) ?>" class="d-flex flex-column card product-card rounded-0">
												<div class="product-card-img zoom-img rounded-0">
													<img src="<?= MEDIA_URL . $popular_product_data['prod_img_url'][0] ?>" class="card-img-top rounded-0" alt="<?= $popular_product_data['prod_name'] ?>">
												</div>
												<div class="card-body d-flex flex-column product-card-body px-0">
													<h5 class="card-title product-title pb-3 fs-6"><?= $popular_product_data['prod_name'] ?></h5>
													<div class="card-text d-flex py-1">
														<div class="sell-price fw-medium"><?= $popular_product_data['prod_price'] ?></div>
														<div class="mrp-price text-decoration-line-through fw-light ms-2"><?= $popular_product_data['prod_mrp'] ?></div>
														<div class="discount text-danger fw-medium ms-2"><?= $popular_product_data['offpercent'] ?>% OFF</div>
													</div>
												</div>
											</a>
										</div>
									<?php endforeach; ?> -->
								</div>
								<div class="loading-container text-center m-5">
									<div class="spinner-border text-primary" role="status">
										<span class="visually-hidden">Loading...</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div class="d-flex flex-column align-items-center">
						<img src="<?= base_url('assets/images/empty-product.png') ?>" alt="Empty Product" class="text-center w-25">
						<div class="text-center page-heading font-family-lora fw-semibold mb-3 mb-md-4">Sorry! We couldn’t find what you’re looking for.</div>
						<a href="<?= base_url() ?>" class="btn btn-lg btn-secondary rounded-5">Go to homepage</a>
					</div>
				<?php endif; ?>
			</div>
		</section>

	</main>

	<!-- Footer Area -->
	<?php include("includes/footer.php") ?>
	<!-- Footer Area End -->
	<?php include("includes/script.php") ?>

	<script src="<?= base_url('assets/js/app/product-filter.js') ?>"></script>

	<!-- <script>
		$(function() {
			window.onload = category_product_list();
		});
		//function for get category all products
		// category_product_list();

		function category_product_list() {
			var caterory_id = $('#cat_id').val();
			$.ajax({
				type: "POST",
				url: site_url + 'getcategory_product',
				data: {
					language: 1,
					securecode: securecode,
					catid: caterory_id,
					[csrfName]: csrfHash
				},

				success: function(html) {
					console.log(html);
					var category_product_list = category_product_html = '';
					var catObjs = JSON.parse(html);
					var categorysArray = catObjs.Information;
					//FUNCTION FOR CREATE sub category slider
					//	get_sub_category(catObjs.Information.subcategory);
					var totalArrays = categorysArray.length;
					if (totalArrays > 0) {
						for (var i = 0; i < totalArrays; i++) {
							var catArrayproduct = categorysArray[i];
							var imageObj = JSON.parse(catArrayproduct.img_url);
							var product_name = create_product_url(catArrayproduct.name);
							if (catArrayproduct.pricearray) {
								var pricearray = catArrayproduct.pricearray;
							} else {
								var pricearray = '';
							}

							if (pricearray.length > 2) {
								var price_obj = JSON.parse(pricearray);
								var prices = price_obj[0].attrvalue;
								var mrps = price_obj[0].attrmrpvalue;
								var discount = (mrps - prices);
								var off_cal = (discount / mrps) * 100;
								var offs = off_cal.toFixed(0);
							} else {
								var prices = catArrayproduct.price;
								var mrps = catArrayproduct.mrp;
								var offs = catArrayproduct.offpercent;
							}
							if (imageObj[0]) {
								var img_url = imageObj[0].url;
							} else {
								var img_url = '';
							}
							prices = prices.replace(/,/g, '');
							var titles = catArrayproduct.name.slice(0, 30) + (catArrayproduct.name.length > 30 ? "..." : "");


							category_product_list += '<div class="col-xxl-2 col-xl-2 col-lg-4 col-md-4 col-sm-12 col-6"><div class="home-one-product-box"><div class="home-one-product-img"><a href="' + site_url + 'productdetail/' + catArrayproduct.name + '/' + catArrayproduct.id + '"><img src="<?= MEDIA_URL ?>img_url + '
							" alt="
							' + catArrayproduct.name + '
							"></a></div><div class="
							home - one - product - content text - center "><span><a href="
							' + site_url + '
							productdetail / ' + catArrayproduct.name + ' / ' + catArrayproduct.id + '
							">' + titles + '</a></span><div class="
							home - one - product - price - list "><ul><li>₹ ' + prices + '</li><li><del>₹ ' + mrps + '</del></li></ul></div></div></div></div>';
						}
						$("#category_product_list").html(category_product_list);
					} else {
						$("#category_product_list").html('<div class="no-record text-center mb-76">' + catObjs.msg + '</div>');
					}
				}
			});
		}
	</script> -->

</body>



</html>