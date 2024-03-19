<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>
		Cart - <?= get_store_settings('store_name') ?>
	</title>

	<?php include("includes/head.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets/css/cart.css') ?>">
</head>

<body>
	<!-- Preloder -->
	<?php include("includes/preloader.php") ?>
	<!-- Preloder End -->
	<!-- back to to button start-->
	<a href="#" id="scroll-top" class="back-to-top-btn"><i class='bx bx-up-arrow-alt'></i></a>
	<!-- back to to button end-->
	<?php include("includes/topbar.php") ?>
	<!-- Header area -->
	<?php include("includes/navbar.php") ?>
	<!-- Header area end -->

	<main class="cart-page">
		<!-- New Cart Page start -->
		<section class="container my-5" id="cart-page-container">
			<?php
			// echo "<pre>";
			// print_r($cartdetails);
			?>
			<?php if (!empty($cartdetails['cart_result'])) : ?>
				<div class="row">
					<div class="col-12 col-md-6">
						<h1 class="page-heading font-family-lora">Your Cart</h1>
						<hr>
						<div class="cart_products">
							<?php foreach ($cartdetails['cart_result'] as $key => $cart_prod) : ?>
								<div class="row">
									<div class="col-3">
										<a href="<?= base_url('productdetail/' . $cart_prod['prod_name'] . '/' . $cart_prod['prod_id']) ?>" title="<?= $cart_prod['prod_name'] ?>">
											<img src="<?= MEDIA_URL . $cart_prod['prod_img_url'][0] ?>" alt="<?= $cart_prod['prod_name'] ?>" class="w-100">
										</a>
										<p class="fs-6 mt-2 <?= $cart_prod['stock'] > 0 ? 'text-success' : 'text-danger' ?>"><?= $cart_prod['stock'] > 0 ? 'IN STOCK' : 'OUT OF STOCK' ?></p>
									</div>
									<div class="col-9">
										<a href="<?= base_url('productdetail/' . $cart_prod['prod_name'] . '/' . $cart_prod['prod_id']) ?>" class="prod-name text-dark font-family-lora" title="<?= $cart_prod['prod_name'] ?>">
											<div class="mb-3"><?= $cart_prod['prod_name'] ?></div>
										</a>
										<div class="product-attributes d-flex justify-content-between mb-2">
											<div class="arributes">
												<?php foreach ($cart_prod['config_attr'] as $config_attr) : ?>
													<?php if (substr($config_attr['attr_value'], 0, 1) === '#') : ?>
														<div class="d-flex align-items-center"><?= $config_attr['attr_name'] ?>: <label class="Color ms-1" style="<?= getDarkColorStyle($config_attr['attr_value']) ?>"></label></div>
													<?php else : ?>
														<div><?= $config_attr['attr_name'] ?>: <?= $config_attr['attr_value'] ?></div>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
											<div class="row">
												<label for="prod-qty" class="col-2 col-form-label px-0">Qty: </label>
												<div class="col-10">
													<select name="cart-qty" id="cart-qty" class="form-select" onchange="updateCartQty(this, <?= $cart_prod['prod_id'] ?>)">
														<?php for ($i = 1; $i <= 10; $i++) : ?>
															<option value="<?= $i ?>" <?= $i == $cart_prod['qty'] ? 'selected' : '' ?>><?= $i ?></option>
														<?php endfor; ?>
													</select>
												</div>
											</div>
										</div>
										
										<div class="d-flex mt-5">
											<a href="javascript:void(0)" class="text-dark fs-6" onclick="delete_cart_item(<?= $cart_prod['prod_id'] ?>)"><i class="fa-regular fa-trash-can"></i></a>
											<a href="javascript:void(0)" class="ms-4 text-dark fs-6"><i class="fa-regular fa-heart"></i></a>
										</div>
									</div>
								</div>
								<hr>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="col-12 col-md-6">

						<div class="order-summary p-4">
							<h4 class="my-3">
								Order Summary
							</h4>
							<div class="d-flex justify-content-between my-2">
								<span class="fs-6">Subtotal(<span class="total-cart-item"><?= count($cartdetails['cart_result']) ?></span> Items)</span>
								<span class="fs-6 total-cart-value"><?= $cartdetails['total_cart_value'] ?></span>
							</div>
							<div class="d-flex justify-content-between my-2">
								<span class="fs-6 fw-medium">Total</span>
								<span class="fs-6 fw-medium total-cart-value"><?= $cartdetails['total_cart_value'] ?></span>
							</div>
						</div>
						<!-- <div class="form-check my-3">
							<input class="form-check-input" type="checkbox" value="" id="agree_condition_checkbox" />
							<label class="form-check-label fs-9" for="agree_condition_checkbox">I AGREE TO TERMS AND
								CONDITIONS</label>
						</div> -->
						<a href="<?= base_url('checkout') ?>" class="btn btn-lg btn-primary w-100 rounded-2 my-3" id="ceckout_btn">Checkout</a>
					</div>
				</div>
			<?php else : ?>
				<div class="d-flex flex-column align-items-center">
					<img src="<?= base_url('assets/images/empty-product.png') ?>" alt="Empty Product" class="text-center w-25">
					<div class="text-center page-heading font-family-lora fw-semibold mb-1">Your Cart is Empty!</div>
					<p class="mb-3 mb-md-4">There is a lot for you to shop from. So, why wait?</p>
					<a href="<?= base_url() ?>" class="btn btn-lg btn-secondary rounded-5">Continue Shopping</a>
				</div>
			<?php endif; ?>
		</section>
		<!-- New Cart End -->
	</main>

	<!-- Coupon Modal -->
	<div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" style="height: 50vh;">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Apply Coupon</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Enter your Coupon Code" aria-label="Coupon Code" aria-describedby="basic-addon2" name="apply_coupon_code" id="apply_coupon_code">
						<button class="input-group-text" id="basic-addon2">Check</button>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary w-100">Apply</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Footer Area -->
	<?php include("includes/footer.php") ?>
	<!-- Footer Area End -->
	<?php include("includes/script.php") ?>

	<script>
		let ceckout_btn = document.getElementById("ceckout_btn")
		let agree_condition_checkbox = document.getElementById("agree_condition_checkbox")

		agree_condition_checkbox.addEventListener("change", () => {
			ceckout_btn.disabled = !agree_condition_checkbox.checked
		});

		ceckout_btn.addEventListener("click", () => {
			window.location.href = "<?= base_url() ?>checkout"
		})
	</script>

</body>

</html>