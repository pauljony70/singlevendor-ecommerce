<!doctype html>
<html lang="en">
<?php
$paymentorder_id = "PAY" . date('YmdHis');
$description = "Product Description";
$txnid = date("YmdHis");
$key_id = "rzp_live_T6fvRlqyWh4Zuj";
$currency_code = $currency_code;
$total = (1 * 100); // 100 = 1 indian rupees
$amount = 1;
$merchant_order_id = date("YmdHis");
$card_holder_name = $this->session->userdata('fullname');
$name = "Mkkirana";
// echo "<pre>";
// print_r($cartdetails); exit;
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Checkout - <?= get_store_settings('store_name') ?></title>

	<?php include("includes/head.php") ?>
	<link rel="stylesheet" href="<?= base_url('assets/css/checkout.css') ?>">
</head>

<body>
	<!-- Preloder -->
	<?php include("includes/preloader.php") ?>
	<!-- Preloder End -->

	<?php
	$sql = "SELECT name,value FROM store_config";
	$query = $this->db->query($sql);
	if ($query->num_rows() > 0) {
		foreach ($query->result() as $row) {
			if ($row->name == "store_open_status") {
				if ($row->value == 0) {
					$store_open_status = 'Open';
				} else {
					$store_open_status = 'Close';
				}
			}
		}
	}
	?>

	<form name="razorpay-form" id="razorpay-form" action="<?php echo $callback_url; ?>" method="POST">
		<input type="hidden" name="store_open_status" id="store_open_status" value="<?php echo $store_open_status; ?>" />
		<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
		<input type="hidden" name="paymentorder_id" id="paymentorder_id" value="<?php echo $paymentorder_id; ?>" />
		<input type="hidden" name="delivery_add_id" id="delivery_add_id">
		<input type="hidden" name="total_price_payment" id="total_price_payment">
		<input type="hidden" name="totalshipping_fee" id="totalshipping_fee">
		<input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>" />
		<input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>" />
		<input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>" />
		<input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>" />
		<input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>" />
		<input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>" />
		<input type="hidden" name="merchant_total" id="merchant_total" />
		<input type="hidden" name="merchant_amount" id="merchant_amount" />
	</form>

	<?php include("includes/navbar-brand.php") ?>

	<main class="my-5">
		<!-- Just an image -->
		<section class="container">
			<div class="row">
				<div class="col-md-7 pe-md-5 mb-4">
					<h1 class="page-heading fw-medium font-family-lora">Checkout</h1>
					<h6>Shipping Address</h6>
					<?php if (!empty($address)) : ?>
						<div class="adress-container">
							<?php foreach ($address as $key => $add_data) : ?>
								<label for="radio-card-<?= $key ?>" class="radio-card w-100">
									<input type="radio" class="defaultAdderess" name="radio-card" id="radio-card-<?= $key ?>" value="<?= $add_data['address_id']; ?>" />
									<div class="card-content-wrapper">
										<span class="check-icon"></span>
										<div class="card-content ps-3">
											<div class="name m-0 mb-1">
												<h6 class="mb-0"><?= $add_data['fullname']; ?>, </h6>
											</div>
											<div class="address m-0">
												<h6 class="mb-0"><?= $add_data['email'] ?>, <?= $add_data['phone'] ?></h6>
												<h6 class="m-0"><?= $add_data['address'] ?></h6>
												<h6 class="m-0"><?= $add_data['city'] . ', ' . $add_data['state'] . ', ' . 'India' . ', ' . $add_data['pincode'] ?></h6>
											</div>
										</div>
									</div>
								</label>
							<?php endforeach; ?>
						</div>

						<a id="address_div_id" class="btn ps-0 my-4" data-bs-toggle="collapse" href="#addressForm" role="button" aria-expanded="false" aria-controls="address-form"><i class="fa-solid fa-plus"></i> <span class="ms-3">Add a New Address</span></a>
					<?php endif;  ?>

					<form action="#" method="post" id="addressForm" class="mb-5 <?= !empty($address) ? 'collapse' : '' ?>">
						<div class="row">
							<div class="col-md-12">
								<div class="form-floating mb-3">
									<input type="text" class="form-control ps-1" id="fullname" placeholder="John Doe">
									<label class="ps-0" for="fullname">Full name</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-floating mb-3">
									<input type="email" class="form-control ps-1" id="email" placeholder="john@hotmail.com">
									<label class="ps-0" for="email">Email</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-floating mb-3">
									<input type="number" class="form-control ps-1" id="phone" placeholder="0123456789" oninput="enforceMaxLength(this)" maxlength="10">
									<label class="ps-0" for="phone">Phone</label>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-floating mb-3">
									<input type="text" class="form-control ps-1" id="address" placeholder="Address">
									<label class="ps-0" for="address">Address</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-floating mb-3">
									<input type="number" class="form-control ps-1" id="pincode" placeholder="123456" oninput="enforceMaxLength(this)" maxlength="6">
									<label class="ps-0" for="pincode">Pincode</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-floating mb-3">
									<select class="form-select ps-1" id="state" aria-label="Select state">
										<option value="0">Select state</option>
									</select>
									<label class="ps-0" for="state">Select state</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-floating mb-3">
									<select class="form-select ps-1" id="city" aria-label="Select city">
										<option value="0">Select city</option>
									</select>
									<label class="ps-0" for="city">Select city</label>
								</div>
							</div>
						</div>
					</form>
					<div class="payment-types mb-5">
						<h6 class="mb-3">Payment Type</h6>
						<!-- <div class="form-check mb-2">
							<input class="form-check-input" type="radio" name="flexRadioDefault" id="online" value="online">
							<label class="form-check-label" for="online">
								Net Banking/ UPI/ Credit card/ Debit card
							</label>
						</div> -->
						<div class="form-check mb-2">
							<input class="form-check-input" type="radio" name="flexRadioDefault" id="cod" value="cod" checked>
							<label class="form-check-label" for="cod">
								Cash On Delivery(COD)
							</label>
						</div>
					</div>
					<div id="place-order-btn-div">
						<button type="button" class="btn btn-lg btn-primary fs-4 fw-bold rounded-5 w-100 place-order-btn" id="placeOrderBtn" onclick="place_order_data(this)">Place Order</button>
					</div>
				</div>

				<div class="col-md-5 px-0 border">
					<div class="order-summary border-bottom p-4">
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

					<?php foreach ($cartdetails['cart_result'] as $key => $cart_prod) : ?>

						<div class="row  p-4">
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
								<div class="product-attributes d-flex mb-2">
									<?php if (!empty($cart_prod['config_attr'])) : ?>
										<div class="arributes">
											<?php foreach ($cart_prod['config_attr'] as $config_attr) : ?>
												<?php if (substr($config_attr['attr_value'], 0, 1) === '#') : ?>
													<div class="d-flex align-items-center"><?= $config_attr['attr_name'] ?>: <label class="Color ms-1" style="<?= getDarkColorStyle($config_attr['attr_value']) ?>"></label></div>
												<?php else : ?>
													<div><?= $config_attr['attr_name'] ?>: <?= $config_attr['attr_value'] ?></div>
												<?php endif; ?>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
									<label for="prod-qty">Qty: <?= $cart_prod['qty'] ?></label>
								</div>
								<div class="price-div row py-1">
									<div class="col-6 col-sm-4 sell-price fw-medium"><?= $cart_prod['prod_price'] ?></div>
									<div class="col-6 col-sm-4 mrp-price text-decoration-line-through fw-light"><?= $cart_prod['prod_mrp'] ?></div>
									<div class="col-6 col-sm-4 discount text-danger fw-medium"><?= $cart_prod['offpercent'] ?>%OFF</div>
								</div>
							</div>
						</div>
						<?= $key !== count($cartdetails['cart_result']) - 1 ? '<hr>' : '' ?>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	</main>


	<!-- Footer Area -->
	<?php include("includes/footer.php") ?>
	<!-- Footer Area End -->

	<?php include("includes/script.php") ?>
	<script src="<?= base_url('assets/js/app/checkout.js') ?>"></script>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

	<script>

	</script>

	<script>
		var delivery_address_id = $('#delivery_address_id1').val();
		//alert(delivery_address_id);
		if (delivery_address_id == '') {
			//alert('Add Delivery Address');
		}

		$("input[name='flexRadioDefault']").change(function() {
			//alert('dddd');
			if ($(this).val() === '10') {
				$(this).attr('checked', true);
				razorpaySubmit(this);
			} else if ($(this).val() === '20') {
				$(this).attr('checked', true);
				$(this).attr('checked', true);
				//alert('fff');
			}
		});

		var razorpay_pay_btn, instance;

		function razorpaySubmit(el) {
			var cart_totalprice = <?= $cartdetails['total_cart_price'] ?>;
			// var id_number = parseInt(cart_totalprice.replace(/[^0-9.]/g, ""));
			var merchant_total = <?= $cartdetails['total_cart_price'] ?>;
			var options = {
				key: "<?php echo $key_id; ?>",
				amount: cart_totalprice * 100,
				name: "<?php echo $name; ?>",
				description: "Order # <?php echo $merchant_order_id; ?>",
				netbanking: true,
				currency: "<?php echo $currency_code; ?>", // INR
				prefill: {
					name: "<?php echo $card_holder_name; ?>",
					email: "admin@gmail.com",
					contact: "<?php echo $this->session->userdata('phone'); ?>"
				},
				notes: {
					soolegal_order_id: "<?php echo $merchant_order_id; ?>",
				},

				handler: function(transaction) {

					document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
					//	alert(transaction.razorpay_payment_id);
					if (transaction.razorpay_payment_id != '') {
						place_order_data(event)
					}
					// document.getElementById('razorpay-form').submit();
				},

				"modal": {
					"ondismiss": function() {

						location.reload()
					}
				}
			};

			if (typeof Razorpay == 'undefined') {
				setTimeout(razorpaySubmit, 200);
				if (!razorpay_pay_btn && el) {
					razorpay_pay_btn = el;
					el.disabled = true;
					el.value = 'Please wait...';
				}
			} else {
				if (!instance) {
					instance = new Razorpay(options);
					if (razorpay_pay_btn) {
						razorpay_pay_btn.disabled = false;
						razorpay_pay_btn.value = "Pay Now";
					}
				}
				instance.open();
			}
		}

		function place_order_data_pre(event) {
			var store_open_status = $('#store_open_status').val();
			if (store_open_status == 'Close') {
				alert('Store is Closed Now. Please Try After Some Time.');
			} else if ($('input[name="flexRadioDefault"]:checked').val() == 1) {
				razorpaySubmit(this);

			} else if ($('input[name="flexRadioDefault"]:checked').val() == 2) {
				place_order_data(event)
				//razorpaySubmit(this);
			} else {
				alert('Select Any Payment Option');
			}
		}
	</script>

</body>



</html>