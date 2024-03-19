<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title><?= get_store_settings('store_name') ?> - Product Details</title>

	<meta name="og_title" property="og:title" content="<?= $prod_details_data['Information']['name']; ?>" />
	<meta name="og_site_name" property="og:site_name" content="<?= base_url() ?>" />


	<meta property="og:description" content="<?= strip_tags(html_entity_decode($prod_details_data['Information']['fulldetail'])); ?>" />

	<meta name="og_image" property="og:image" content="<?= MEDIA_URL . json_decode($prod_details_data['Information']['img_url'])[0]; ?>" />

	<?php include("includes/head.php"); ?>

	<!-- Plugin css -->
	<link rel="stylesheet" href="<?= base_url('assets/libs/swiper/swiper-bundle.min.css') ?>" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">

	<!-- Custom Css -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/productdetails.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/product-card.css') ?>">
</head>

<?php
$actual_link = urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
?>

<body>
	<!-- Preloder -->
	<?php include("includes/preloader.php"); ?>
	<!-- Preloder End -->
	<span id="meta_img"></span>
	<!-- back to to button start-->
	<a href="#" id="scroll-top" class="back-to-top-btn"><i class='bx bx-up-arrow-alt'></i></a>
	<!-- back to to button end-->

	<input type="hidden" name="prod_id" id="prod_id" value="<?= $prod_id; ?>">
	<input type="hidden" id="config_attr" value="">

	<!-- Header area -->
	<?php include("includes/topbar.php") ?>
	<?php include("includes/navbar.php") ?>
	<!-- Header area end -->
	<main>

		<section class="shop-details-product my-2">
			<div class="container">
				<?php $image_data = json_decode($prod_details_data['Information']['img_url']) ?>

				<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
						<?php foreach ($prod_details_data['Information']['category_tree'] as $category) : ?>
							<li class="breadcrumb-item"><a href="<?= base_url('category/' . $category['cat_name'] . '/' . $category['cat_id']) ?>"><?= $category['cat_name'] ?></a></li>
						<?php endforeach; ?>
						<li class="breadcrumb-item active" aria-current="page"><?= $prod_details_data['Information']['name']; ?></li>
					</ol>
				</nav>

				<div class="row product-details-div mb-5">
					<div class="col-lg-6">
						<div class="row product-gallery mb-4">
							<div class="col-lg-3 d-none d-lg-block h-100 ps-lg-1">
								<div thumbsSlider="" class="swiper product-details-swiper-sm-desktop py-0">
									<div class="swiper-wrapper">
										<?php foreach ($image_data as $img) : ?>
											<div class="swiper-slide">
												<img src="<?= MEDIA_URL . $img ?>" class="w-100 h-100" />
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
							<div class="col-lg-9 h-100 pe-lg-1">
								<div class="swiper product-details-swiper-desktop">
									<div class="swiper-wrapper">
										<?php foreach ($image_data as $img) : ?>
											<a class="swiper-slide spotlight zoom-img" data-fancybox="mobile-group" href="<?= MEDIA_URL . $img ?>">
												<img src="<?= MEDIA_URL . $img ?>" class="w-100" />
											</a>
										<?php endforeach; ?>
									</div>
									<div class="swiper-button-next"></div>
									<div class="swiper-button-prev"></div>
								</div>
							</div>
						</div>
						<div class="row d-none d-lg-flex">
							<div class="col-12 px-0">
								<div class="accordion" id="accordionPanelsStayOpenExample">
									<div class="accordion-item">
										<h2 class="accordion-header">
											<button class="accordion-button px-0" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
												Product Description
											</button>
										</h2>
										<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
											<div class="accordion-body px-0">
												<?= htmlspecialchars_decode($prod_details_data['Information']['fulldetail']) ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 ps-lg-5">
						<div class="d-flex align-items-center justify-content-between mb-3">
							<h2 class="product-name mb-0"><?= $prod_details_data['Information']['name'] ?></h2>
							<div class="toggle-btn d-flex">
								<span class="share-icon">
									<div class="d-flex align-items-center" id="share-btn">
										<img src="<?= base_url('assets/images/icons/share.svg') ?>" alt="Share">
									</div>
									<div class="hover-card box-shadow">
										<div class="d-flex justify-content-between flex-wrap">
											<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= $actual_link ?>" title="Facebook Share" class="brand-icon facebook">
												<img src="<?= base_url('assets/images/brands/facebook.svg') ?>" alt="Facebook" srcset="">
											</a>
											<a target="_blank" href="whatsapp://send?text=<?= $actual_link ?>" class="brand-icon whatsapp">
												<img src="<?= base_url('assets/images/brands/whatsapp.svg') ?>" alt="Facebook" srcset="">
											</a>
											<a target="_blank" href="http://twitter.com/share?url=<?= $actual_link ?>&text=I ♥ this product on <?= get_store_settings('store_name') ?>! <?= $prod_details_data['Information']['name']; ?>&via=<?= get_store_settings('store_name') ?>&hashtags=buyon<?= get_store_settings('store_name') ?>" class="brand-icon twitter">
												<img src="<?= base_url('assets/images/brands/twitter.svg') ?>" alt="Twitter" srcset="">
											</a>
											<a target="_blank" href="https://www.pinterest.com/pin/create/button/?url=<?= $actual_link ?>&media=<?= urlencode(MEDIA_URL . json_decode($prod_details_data['Information']['img_url'])[0]) ?>&description=<?= urlencode($prod_details_data['Information']['name'] . ' - ' . strip_tags(html_entity_decode($prod_details_data['Information']['fulldetail']))) ?>" class="brand-icon pinterest">
												<img src="<?= base_url('assets/images/brands/pinterest.svg') ?>" alt="Pinterest" srcset="">
											</a>
										</div>
										<span class="arrow"></span>
									</div>
								</span>
								<span class="mobile-share-icon" onclick="mobileShareLink('')">
									<div class="d-flex align-items-center" id="share-btn">
										<img src="<?= base_url('assets/images/icons/share.svg') ?>" alt="Share">
									</div>
								</span>
							</div>
						</div>
						<div class="d-flex flex-wrap align-items-center" id="price-div">
							<div class="product-price"><?= price_format($prod_details_data['Information']['price']) ?></div>
							<?php if ($prod_details_data['Information']['mrp'] !== $prod_details_data['Information']['price']) : ?>
								<div class="product-mrp text-decoration-line-through fw-light ms-3"><?= price_format($prod_details_data['Information']['mrp']) ?></div>
								<span class="badge rounded-pill text-bg-secondary fw-semibold offpercent ms-3">SAVE <?= $prod_details_data['Information']['offpercent'] ?>%</span>
							<?php endif; ?>
						</div>
						<div class="text-muted">MRP Inclusive of all taxes</div>
						<hr>
						<div class="pDetails">
							<div class="product-size mb-4 mb-lg-4">
								<input type="hidden" name="attribute_data" value="<?= json_encode($productdetails['configure_attr']); ?>">

								<?php foreach ($prod_details_data['Information']['configure_attr'] as $p_weight) : ?>
									<?php if (!empty($p_weight['item'])) : ?>
										<span class="fw-bold"><?= $p_weight['attr_name']; ?></span>
									<?php endif; ?>

									<?php
									$symbols = array(' ', ',', '.', '!', '@', '#', '$', '%', '^', '&', '+', '/', '*', '(', ')');
									$attr_name_safe = str_replace($symbols, '_', $p_weight['attr_name']);
									$attr_id_safe = $attr_name_safe . '_attr_id';
									?>

									<div class="p-size">
										<input type="hidden" name="<?= $attr_name_safe; ?>_attr_name" id="<?= $attr_name_safe; ?>_attr_name" value="<?= $p_weight['attr_name']; ?>">
										<input type="checkbox" style="display:none" name="<?= $attr_id_safe; ?>" id="<?= $attr_id_safe; ?>" class="product_attributes" value="<?= $p_weight['attr_id']; ?>">

										<?php if (!empty($p_weight['item'])) : ?>
											<?php foreach ($p_weight['item'] as $product_weight) : ?>
												<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
													<?php
													$attr_label_safe = str_replace($symbols, '_', $p_weight['attr_name']);
													$dark_color_style = ($p_weight['attr_name'] == 'Color') ? getDarkColorStyle($product_weight['itemvalue']) : '';
													?>
													<input type="radio" onclick="get_product_attributes('<?= $p_weight['attr_name']; ?>')" class="btn-check attribute-values" attribute-label="<?= $attr_label_safe; ?>" name="btnradio_<?= $p_weight['attr_name']; ?>" id="<?= $product_weight['itemvalue']; ?>" value="<?= $product_weight['itemvalue']; ?>" autocomplete="off">
													<label style="<?= $dark_color_style; ?>" class="<?= $p_weight['attr_name']; ?> btn btn-outline-primary" for="<?= $product_weight['itemvalue']; ?>">
														<?php echo ($p_weight['attr_name'] != 'Color') ? $product_weight['itemvalue'] : ''; ?>
													</label>
												</div>
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="fs-6 fw-semibold mb-2">Quantity</div>
						<div class="row mb-1">
							<div class="col-5">
								<select name="quantity" id="quantity" class="form-select">
									<?php for ($i = 1; $i <= 10; $i++) : ?>
										<option value="<?= $i ?>"><?= $i ?></option>
									<?php endfor; ?>
								</select>
							</div>
						</div>
						<div class="fs-6 mb-4">In Stock</div>
						<!-- Add to Cart and By now and Whatsapp Buttons -->
						<div class="row align-items-center bg-white btn-wrap mb-3">
							<div class="col-9">
								<button type="button" id="add-to-cart-btn" onclick="single_product_add_cart(<?= $prod_id; ?>,0)" class="btn btn-primary w-100">Buy Now</button>
							</div>
							<div class="col-3">
								<a class="btn btn-light wishlist-btn heart-container" onclick="product_add_wishlist(<?= $prod_id; ?>)">
									<div class="d-flex justify-content-center align-items-center h-100">
										<i class="fa-<?= $productdetails['wishlist_count'] > 0 ? 'solid' : 'regular' ?> fa-heart add-to-wishlist"></i>
									</div>
								</a>
							</div>
						</div>
						<a href="<?= base_url('return-and-exchange-policy') ?>" target="_blank" class="fs-6 text-dark text-decoration-underline mb-4" rel="noopener noreferrer">Return and exchange policy</a>
						<div class="accordion d-md-none" id="accordionPanelsStayOpenExample">
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button px-0" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
										Product Description
									</button>
								</h2>
								<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
									<div class="accordion-body px-0">
										<?= htmlspecialchars_decode($prod_details_data['Information']['fulldetail']) ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="similar-products-div">
					<div class="text-center heading fs-3 fw-bolder mb-4">Similar Products</div>
					<div class="swiper similar-prod-swiper">
						<div class="swiper-wrapper" id="recently_viewed_products">
							<?php for ($i = 0; $i < 1; $i++) : ?>
								<?php foreach ($prod_details_data['related'] as $related_prod) : ?>
									<div class="swiper-slide">
										<a href="<?= base_url('productdetail/' . $related_prod['name'] . '/' . $related_prod['id']) ?>" class="d-flex flex-column card product-card rounded-0">
											<div class="product-card-img zoom-img rounded-0">
												<img src="<?= MEDIA_URL . $related_prod['img_url'][0] ?>" class="card-img-top rounded-0" alt="<?= $related_prod['name'] ?>">
											</div>
											<div class="card-body d-flex flex-column product-card-body ps-0">
												<h5 class="card-title product-title line-clamp-1 pb-2 fs-6"><?= $related_prod['name'] ?></h5>
												<div class="card-text d-flex flex-wrap py-1">
													<div class="sell-price fw-medium"><?= price_format($related_prod['price']) ?></div>
													<?php if ($related_prod['mrp'] !== $related_prod['price']) : ?>
														<div class="mrp-price text-decoration-line-through fw-light"><?= price_format($related_prod['mrp']) ?></div>
														<div class="discount text-danger fw-medium"><?= $related_prod['offpercent'] ?>% OFF</div>
													<?php endif; ?>
												</div>
											</div>
										</a>
									</div>
								<?php endforeach; ?>
							<?php endfor ?>
						</div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</div>
			</div>
		</section>
		<!-- Shop Details Top Area End -->

	</main>

	<!-- Footer Area -->
	<?php include("includes/footer.php") ?>
	<!-- Footer Area End -->

	<?php include("includes/script.php") ?>

	<!-- Plugin JS -->
	<script src="<?= base_url('assets/libs/swiper/swiper-bundle.min.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

	<!-- Custom JS -->
	<script src="<?= base_url('assets/js/app/productdetail.js'); ?>"></script>


	<script>
		/* function add_product_qty(type) {
			curr_qty = $("#quantity").val();
			if (parseInt(curr_qty) == 1 && type == "-1") {
				toastr.error("Minimum 1 quantity is available");
			} else {
				if (type == "1") {
					curr_qty = parseInt(curr_qty) + 1;
				} else {
					curr_qty = parseInt(curr_qty) - 1;
				}
				$("#quantity").val(curr_qty);
			}
		}

		$(function() {
			window.onload = attr_data_change(event);
		});

		$('#quantity').val();
		var csrfName = $(".txt_csrfname").attr("name"); //
		var csrfHash = $(".txt_csrfname").val(); // CSRF hash
		var site_url = "<?= base_url() ?>"; // CSRF hash
		var securecode = $(".securecode").val();
		$(document).ready(function(e) {
			$("#image-upload-form").on('submit', (function(e) {
				e.preventDefault();
				$.ajax({
					url: site_url + 'custom_image',
					//	url: "upload.php",
					type: "POST",
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success: function(data) {
						$("#targetLayer").html(data);
					},
					error: function(data) {
						console.log("error");
						console.log(data);
					}
				});
			}));
		});

		// Add to Cart
		function single_product_add_cart(product_id, product_price) {
			var quantity = $('#quantity').val();
			var custom_title = $('#custom_title').val();
			var custom_image = $('#img_div').html();
			var total_stock = $("#attr_data option:selected").attr('data-stock');
			var total_stock_single = $('#total_stock').val();

			<?php if (empty($this->session->userdata('user_id'))) { ?>
				toastr.error("Please Login to add product into cart")

			<?php } else { ?>

				if (product_id) {
					attr_value = $('#attr_data option:selected').val();
					if (attr_value == '') {
						toastr.warning('Please Select Arrtibutes');
					} else if (parseInt(quantity) > total_stock) {
						toastr.warning('Only ' + total_stock + ' Qty Available');
					} else if (parseInt(quantity) > total_stock_single) {
						toastr.warning('Only ' + total_stock_single + ' Qty Available');
					} else {
						var size = $('#attr_data option:selected').text();
						var price = $('#mrp').text();
						var product_size = size;
						//alert(product_size);
						//alert(price);

						var product_color = '';

						$("#cart" + product_id).html('<i class="fa fa-spinner fa-spin"></i>');

						$.ajax({

							type: "POST",
							url: site_url + 'add_to_cart',
							//data: {language : 1 , securecode : securecode, prod_id : prod_id, [csrfName]: csrfHash},
							data: {
								language: 1,
								securecode: securecode,
								size: product_size,
								color: product_color,
								user_id: '<?php echo $this->session->userdata('user_id'); ?>',
								prod_id: product_id,
								prod_price: product_price,
								qty: quantity,
								custom_title: custom_title,
								custom_image: price,
								[csrfName]: csrfHash
							},
							success: function(html) {
								get_cart_products('<?php echo $this->session->userdata('user_id'); ?>');
								$("#cart" + product_id).html('<i class="fa fa-cart-plus" aria-hidden="true"></i>');
								var catObj = JSON.parse(html)
								// Set the count of cart
								$("#cart_count_mobile").text = catObj.Information.cart_count;
								$("#cart_count").text = catObj.Information.cart_count;
								toastr.success(catObj.msg);

								var cartArray = catObj.Information;
								var status = catObj.status;
								if (status == 2) {
									alert(catObj.msg);
								} else {

									//	get_cart_products('');

								}
							}
						});
					}
				} else {
					toastr.error("some error")
				}
			<?php } ?>

		}

		// Add to Wishlist
		function product_add_wishlist(product_id, product_price) {
			var quantity = 1;
			let user_id = $("#user_id").val();
			// alert(user_id);
			if (user_id != "") {
				if (product_id) {
					$("#wishlist" + product_id).html('<i class="fa fa-spinner fa-spin"></i>');
					$.ajax({
						type: "POST",
						url: site_url + "add_prod_into_wishlist",

						data: {
							language: 1,
							securecode: securecode,
							user_id: user_id,
							prod_id: prod_id,
							prod_price: product_price,
							qty: quantity,
							[csrfName]: csrfHash,
						},

						success: function(html) {
							get_wishlist_products(user_id);
							$("#wishlist" + product_id).html(
								'<i class="fa fa-heart" aria-hidden="true"></i>'
							);

							var catObj = JSON.parse(html);
							toastr.success(catObj.msg)
							$("#wishlist_div_image").src = site_url + "/images/icons/wishlisted.png";
							var cartArray = catObj.Information;
						},
					});
				}
			} else {
				toastr.error("Please Login to add product in wishlist")
			}
		}

		function attr_data_change(event) {
			//var selectElement = event.target;
			//var value = selectElement.value;
			value = $("#attr_data option:selected").val();
			price = $("#attr_data option:selected").attr('data-id');
			if (value != 'undefined') {
				// alert(value);
				$("#mrp").text(value);
				$("#price").text(price);
			}
			//$("#price").html(this.price);
			//alert(value);
		} */
	</script>

</body>

</html>