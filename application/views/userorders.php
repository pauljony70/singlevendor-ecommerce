<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        <?= get_store_settings('store_name') ?>. - User Profile
    </title>

    <?php include("includes/head.php") ?>
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
        <section class="row user_profile">
            <div class="col-3 user_sidebar">
                <!-- Sidebar -->
                <?php include('includes/usersidebar.php') ?>
            </div>
            <div class="col-6 user_main_content">
                <?php include('includes/sidebarmobile.php') ?>
                <h1>Order History</h1>
                <?php if (1 != 2) { ?>
                    <div class="profile_form mt-4">
                        <div class="text-center">
                            <img src="<?= base_url() ?>assets/images/no-order.png" alt="no_order_image"
                                class="no_order_image">
                            <h5>You haven't placed any order yet!</h5>
                            <h6>Once you place an order, you can track it here!</h6>
                            <button class="btn btn-primary w-40 my-3">Start Shopping</button>
                        </div>
                    </div>
                <?php } ?>
                <section id="previous_orders" class="previous_orders">
                    <div class="single_order_detil">
                        <div class="card">
                            <div class="card-body prev_order_head">
                                <h5 class="card-title">Order No. 4878943749</h6>
                                    <h6 class="card-subtitle text-muted"><a href="<?= base_url() ?>orderdetails">View Detials</a></h6>
                            </div>
                            <div class="card-body px-0">
                                <div class="row px-4">
                                    <div class="col-3">
                                        <img src="<?= base_url() ?>assets/images/producta2.jpeg" alt="image"
                                            class="prev_order_img" />
                                    </div>
                                    <div class="col-9">
                                        <p class="card-text prev_order_para">Placed on: 24 Dec 2023</p>
                                        <p class="card-text prev_order_para">Order Status: Order Placed</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="card_footer px-4">
                                    <a href="#" class="card-link">1 Total Item</a>
                                    <a href="#" class="card-link">Rs 3,280</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </main>


    <!-- Footer Area -->
    <?php include("includes/footer.php") ?>
    <!-- Footer Area End -->

    <?php include("includes/script.php") ?>
    <script src="<?php echo site_url(); ?>/assets/js/cart.js"></script>

</body>

</html>