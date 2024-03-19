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
                    <h1 class="font-family-lora mb-4 mb-md-5">Order History</h1>
                    <?php if (!empty($orders)) : ?>
                        <div class="row">
                            <?php foreach ($orders as $order) : ?>
                                <div class="col-12 col-md-9">
                                    <div class="card rounded-1 mb-5">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fw-bold m-0">Order No. <?= $order['order_id'] ?></h6>
                                                <a href="<?= base_url('order/' . $order['order_id'] . '/' . $order['prod_id']) ?>" class="fs-6 fw-bold text-dark">View details</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3 col-md-2">
                                                    <img src="<?= MEDIA_URL . json_decode($order['prod_img'])[0] ?>" alt="Product" class="w-100">
                                                </div>
                                                <div class="col-9 col-md-10">
                                                    <p class="fs-6 mb-1">Placed on: <?= date('d M Y', strtotime($order['create_date'])) ?></p>
                                                    <p class="fs-6 mb-1">Order Status: <?= $order['status'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fw-medium m-0"><?= $order['qty'] ?> Total item(s)</h6>
                                                <div class="fs-6 fw-medium"><?= price_format($order['prod_price'] * $order['qty']) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="fs-6">No Orders</p>
                    <?php endif; ?>
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