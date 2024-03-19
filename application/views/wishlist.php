<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Wishlist - <?= get_store_settings('store_name') ?></title>
    <?php include("includes/head.php") ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashboard.css') ?>">
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

    <main class="my-5">
        <div class="container">
            <section class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    <!-- Sidebar -->
                    <?php include('includes/usersidebardesktop.php') ?>
                </div>
                <div class="col-12 col-lg-9">
                    <?php include('includes/sidebarmobile.php') ?>
                    <h1 class="font-family-lora mb-4">Wishlist</h1>
                    <div class="row">
                        <div class="wishlist-items col-12 col-lg-8">
                            <?php foreach ($wishlist_data as $wishlist) : ?>
                                <div class="row">
                                    <a href="<?= base_url('productdetail/' . $wishlist['prod_name'] . '/' . $wishlist['prod_id']) ?>" class="col-3">
                                        <img src="<?= MEDIA_URL . $wishlist['prod_img_url'][0] ?>" alt="<?= $wishlist['prod_name'] ?>" class="w-100">
                                    </a>
                                    <div class="col-9">
                                        <a href="<?= base_url('productdetail/' . $wishlist['prod_name'] . '/' . $wishlist['prod_id']) ?>" class="prod-name fs-5 fw-medium text-dark"><?= $wishlist['prod_name'] ?></a>
                                        <div class="price-div d-flex flex-wrap mt-4 py-1">
                                            <div class="sell-price fw-medium text-dark"><?= $wishlist['prod_price'] ?></div>
                                            <?php if ($wishlist['prod_mrp'] !== $wishlist['prod_price']) : ?>
                                                <div class="mrp-price text-decoration-line-through fw-light text-dark"><?= $wishlist['prod_mrp'] ?></div>
                                                <div class="discount text-danger fw-medium"><?= $wishlist['offpercent'] ?>% OFF</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                            <?php endforeach; ?>
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