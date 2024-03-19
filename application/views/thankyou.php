<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Thank you <?= $order_details['customer_name'] ?> - <?= get_store_settings('store_name') ?></title>

	<?php include("includes/head.php") ?>
	<style>
		p {
			font-size: .875rem;
		}

		.view-order {
			background-color: rgba(var(--bs-secondary-rgb), 0.4);
		}

		.continue-shopping {
			background-color: var(--bs-gray-200);
		}
	</style>

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

	<main class="container my-5">
		<!-- Just an image -->
		<?php if (!empty($order_details)) : ?>
			<section class="text-center mb-5">
				<h1 class="font-family-lora mb-5">Thank you for your order.</h1>
				<p class="mb-1">You will receive an email confirmation at</p>
				<p class="mb-1"><?= $order_details['customer_email'] ?></p>
				<p class="mb-1">
					<b>Order no : </b>
					<?= $order_details['order_id'] ?>
				</p>
				<p class="mb-1">
					<b>Order date : </b>
					<?= date('d M Y', strtotime($order_details['create_date'])) ?>
				</p>
			</section>
			<section class="view-order text-center p-5 mb-5">
				<h5 class="font-family-lora mb-4">Track and manage your order easily</h5>
				<a href="<?= base_url('order/' . $order_details['order_id']) ?>" class="btn btn-lg btn-outline-dark rounded-0 fw-medium">View order</a>
			</section>
			<section class="continue-shopping text-center p-5">
				<h5 class="font-family-lora mb-4">Add new and fabulous styles to your wardrobe</h5>
				<a href="<?= base_url() ?>" class="btn btn-lg btn-outline-dark rounded-0 fw-medium">Continue shopping</a>
			</section>
		<?php else : ?>
			<section class="view-order text-center p-5 mb-5">
				<h5 class="font-family-lora mb-4">No order details found</h5>
				<a href="<?= base_url() ?>" class="btn btn-lg btn-outline-dark rounded-0 fw-medium">Continue shopping</a>
			</section>
		<?php endif; ?>
	</main>

	<?php include("includes/footer.php") ?>
	<?php include("includes/script.php") ?>


</body>



</html>