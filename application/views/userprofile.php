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
            <div class="col-8 user_main_content">
                <?php include('includes/sidebarmobile.php') ?>
                <h1>Dashboard</h1>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="profile_details">
                            <div class="d-flex profile_detail_headings">
                                <h5 class="m-0">Profile</h6>
                                    <a href="#" class="profile_link fs-9">Edit</a>
                            </div>
                            <hr class="payment_ruler">
                            <p class="labels">First Name</p>
                            <p class="profile_details_users">Yuvraj</p>

                            <p class="labels">Last Name</p>
                            <p class="profile_details_users">Solanki</p>

                            <p class="labels">Mobile Number</p>
                            <p class="profile_details_users">+91 9302650674</p>

                            <p class="labels">Email</p>
                            <p class="profile_details_users">yuvraj@gmail.com</p>
                        </div>

                        <div class="profile_details">
                            <div class="d-flex profile_detail_headings">
                                <h5 class="m-0">Passwords</h6>
                                    <!-- <a href="#" class="profile_link fs-9">View</a> -->
                            </div>
                            <hr class="payment_ruler">
                            <a href="<?=base_url()?>password" class="btn btn-outline-primary w-100 mt-3 fw-1">Set Password</a>
                        </div>

                        <div class="profile_details">
                            <div class="d-flex profile_detail_headings">
                                <h5 class="m-0">Address List</h6>
                                    <a href="#" class="profile_link fs-9">View</a>
                            </div>
                            <hr class="payment_ruler">
                            <button class="btn btn-outline-primary w-100 mt-3 fw-1">Add new Address</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="profile_details">
                            <div class="d-flex profile_detail_headings">
                                <h5 class="m-0">Order History</h6>
                                    <a href="#" class="profile_link fs-9">View All</a>
                            </div>
                            <hr class="payment_ruler">
                            <!-- <p class="order_hist_desc fs-9">No record found</p> -->
                            <div class="oder_hist_short">
                                <p class="order_hist_desc fs-9">Most recent Order</p>
                                <div class="row">
                                    <div class="col-4">
                                        <img src="<?=base_url()?>assets/images/producta2.jpeg" alt="product_umg" class="user_wishlist_img">
                                    </div>
                                    <div class="col-8">
                                        <p class="order_number_profile">Order No. 43867949048</p>
                                        <p class="order_number_profile">Placed On: 24 Dec 2023</p>
                                        <p class="order_number_profile">Order Status: Placed</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profile_details">
                            <div class="d-flex profile_detail_headings">
                                <h5 class="m-0">Wishlist</h6>
                                    <a href="#" class="profile_link fs-9">View All</a>
                            </div>
                            <hr class="payment_ruler">
                            <div class="wishlist_items">
                                <!-- Display only 2 products rest in the wishlist page -->
                                <?php for ($j = 0; $j < 2; $j++) { ?>
                                    <div class="row user_profile_wishlist_div">
                                        <div class="col-5">
                                            <img src="<?= base_url() ?>assets/images/producta2.jpeg" alt="cart_image"
                                                class="user_wishlist_img">
                                            <p class="user_profile_wishlist_status">IN STOCK</p>
                                        </div>
                                        <div class="col-7">
                                            <p class="user_profile_pname">Bellini Top</p>
                                            <p class="profile_wishlist_menu">Color: Pink</p>
                                            <p class="profile_wishlist_menu">
                                                <label for="qty">Qty:</label>
                                                <select name="qty" id="qty">
                                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                        <option value="<?= $i ?>">
                                                            <?= $i ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </p>
                                            <p class="profile_wishlist_menu">Size: 10</p>
                                            <p class="profile_wishlist_menu">Rs 1900</p>
                                        </div>
                                    </div>
                                <?php } ?>
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

</body>

</html>