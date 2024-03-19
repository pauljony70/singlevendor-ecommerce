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
                <a href="<?= base_url ?>userorders" class="checkout_back_btn fs-9 checkout_navbar_area_dibvide">
                    <img src="<?= base_url() ?>assets/images/icons/back_arrow.svg" alt="back_arrow"
                        class="coupon_image">
                    <span>Back to Order History</span>
                </a>
                <div class="order_details_main_div mt-4">
                    <h3>Order Details</h3>
                    <div class="orderdetails_div px-4">
                        <p class="card-text prev_order_para">Order No. 4878943749</p>
                        <p class="card-text prev_order_para">Placed on: 24 Dec 2023</p>
                    </div>
                    <div class="orderdetails_div px-4">
                        <p class="card-text prev_order_para">Order Status: Order Placed</p>
                        <p class="card-text prev_order_para">Payment Mode: Pay on Delivery</p>
                    </div>
                    <div class="card orderdetails_Card">
                        <div class="card_footer px-4 mt-2 pb-0">
                            <a href="#" class="card-link">1 Total Item</a>
                            <a href="#" class="card-link">Rs 3,280</a>
                        </div>
                        <hr>
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
                        </div>
                    </div>
                    <div class="order_summary">
                        <h5 class="order_summ_title my-2">
                            Order Summary
                        </h5>
                        <div class="cart_subtotal my-2">
                            <span>Subtotal(3 Items)</span>
                            <span>Rs 8932</span>
                        </div>
                        <div class="cart_total my-2">
                            <span>Total</span>
                            <span>Rs 8932</span>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 col-sm-6">
                            <div class="add_content">
                                <h5 class="orderdetails_heading">Shipping Address:</h5>
                                <h6 class="add_contnet_blocks">yuvraj solanki</h6>
                                <h6 class="add_contnet_blocks">Bhopal Madhya Pradesh</h6>
                                <h6 class="add_contnet_blocks">Bhopal</h6>
                                <h6 class="add_contnet_blocks">Bhopal MP</h6>
                                <h6 class="add_contnet_blocks">Mobile Number</h6>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="add_content">
                                <h5 class="orderdetails_heading">Billing Address:</h5>
                                <h6 class="add_contnet_blocks">yuvraj solanki</h6>
                                <h6 class="add_contnet_blocks">Bhopal Madhya Pradesh</h6>
                                <h6 class="add_contnet_blocks">Bhopal</h6>
                                <h6 class="add_contnet_blocks">Bhopal MP</h6>
                                <h6 class="add_contnet_blocks">Mobile Number</h6>
                            </div>
                        </div>
                    </div>
                </div>
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