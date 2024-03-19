<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <?php include("includes/head.php") ?>
  <title>Order History - <?= get_store_settings('store_name') ?></title>
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashboard.css') ?>">
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

  <!-- main content -->
  <main class="my-5">
    <div class="container">
      <section class="row">
        <div class="col-lg-3 d-none d-lg-block">
          <!-- Sidebar -->
          <?php include('includes/usersidebardesktop.php') ?>
        </div>
        <div class="col-12 col-lg-9">
          <?php include('includes/sidebarmobile.php') ?>
          <h1 class="font-family-lora mb-2">Order History</h1>
          <a href="<?= base_url('order') ?>" class="d-flex align-items-center text-dark mb-4">
            <i class="fs-6 fa-solid fa-arrow-left-long"></i>
            <div class="fs-6 fw-medium text-decoration-underline ms-1">Back to Order History</div>
          </a>
          <div class="fs-5 fw-semibold mb-3">Order Detail</div>
          <div class="row">
            <div class="col-12 col-md-9">
              <div class="row fs-6 mb-3">
                <div class="col-md-6">Order Number: <?= $order['order_details']['order_id'] ?></div>
                <div class="col-md-6">Placed on: <?= date('d M Y', strtotime($order['order_details']['create_date'])) ?></div>
                <div class="col-md-6">Order Status: <?= $order['order_details']['status'] ?></div>
                <div class="col-md-6">Payment mode: <span class="text-uppercase"><?= $order['order_details']['payment_mode'] ?></span></div>
              </div>
              <hr class="my-2">
              <div class="d-flex justify-content-between fs-6">
                <div class="fs-6 fw-medium"><?= $order['order_details']['qty'] ?> Total item(s)</div>
                <div class="fs-6 fw-medium"><?= price_format($order['order_details']['prod_price'] * $order['order_details']['qty']) ?></div>
              </div>
              <hr class="mt-2 mb-3">
              <div class="row mb-4">
                <div class="col-3">
                  <a href="<?= base_url('productdetail/' . $order['order_details']['prod_name'] . '/' . $order['order_details']['prod_id']) ?>">
                    <img src="<?= MEDIA_URL . json_decode($order['order_details']['prod_img'])[0] ?>" alt="<?= $order['order_details']['prod_name'] ?>" class="w-100">
                  </a>
                </div>
                <div class="col-9">
                  <a href="<?= base_url('productdetail/' . $order['order_details']['prod_name'] . '/' . $order['order_details']['prod_id']) ?>" class="fs-6 fw-semibold text-dark"><?= $order['order_details']['prod_name'] ?></a>
                  <div class="mt-1 fs-6">
                    <?php foreach (json_decode($order['order_details']['prod_attr'], true) as $config_attr) : ?>
                      <?php if (substr($config_attr['attr_value'], 0, 1) === '#') : ?>
                        <div class="d-flex align-items-center"><?= $config_attr['attr_name'] ?>: <label class="Color ms-1" style="<?= getDarkColorStyle($config_attr['attr_value']) ?>"></label></div>
                      <?php else : ?>
                        <div><?= $config_attr['attr_name'] ?>: <?= $config_attr['attr_value'] ?></div>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </div>
                  <div class="fs-6 mt-4 mb-1">Qty: <?= $order['order_details']['qty'] ?></div>
                  <div class="d-flex fs-6">
                    <div class="fw-medium"><?= price_format($order['order_details']['prod_price']) ?></div>
                    <div class="ms-2 text-decoration-line-through fw-light"><?= price_format($order['order_details']['prod_mrp']) ?></div>
                  </div>
                </div>
              </div>
              <div class="bg-secondary bg-opacity-25 p-3 mb-4">
                <h5 class="fw-semibold mb-4">Price Summary</h5>
                <div class="d-flex justify-content-between fs-6 fw-light mb-3">
                  <div>Subtotal (<?= $order['order_details']['qty'] ?> Items)</div>
                  <div><?= price_format($order['order_details']['prod_price'] * $order['order_details']['qty']) ?></div>
                </div>
                <div class="d-flex justify-content-between fs-6 fw-medium mb-3">
                  <div>Total</div>
                  <div><?= price_format($order['order_details']['prod_price'] * $order['order_details']['qty']) ?></div>
                </div>
              </div>
              <h5 class="fw-semibold mb-3">Shipping Address:</h5>
              <div class="fs-6 fw-light mb-3">
                <div><?= $order['order_details']['customer_name'] ?></div>
                <div><?= $order['order_details']['customer_address'] ?></div>
                <div><?= $order['order_details']['customer_state'] ?>, <?= $order['order_details']['customer_city'] ?>, <?= $order['order_details']['customer_pincode'] ?></div>
                <div><?= $order['order_details']['customer_phone'] ?>, <?= $order['order_details']['customer_email'] ?></div>
              </div>
              <a href="<?= base_url('order') ?>" class="fs-6 fw-medium text-decoration-underline text-dark">Back to Order History</a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>


  <!-- Footer Area -->
  <?php include("includes/footer.php") ?>
  <!-- Footer Area End -->

  <?php include("includes/script.php") ?>

</body>

</html>