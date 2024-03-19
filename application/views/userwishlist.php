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
            <div class="col-9 user_main_content">
                <?php include('includes/sidebarmobile.php') ?>
                <h1>Wishlist</h1>
                <?php if (1 == 2) { ?>
                    <div class="profile_form mt-4">
                        <div class="text-center">
                            <img src="<?= base_url() ?>assets/images/no-order.png" alt="no_order_image"
                                class="no_order_image">
                            <h5>You haven't placed any order yet!</h5>
                            <h6>Once you place an order, you can track it here!</h6>
                            <button class="btn btn-primary w-40 my-3">Start Shopping</button>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="wishlist_product_cart">
                        <?php for ($jk = 0; $jk < 2; $jk++) { ?>
                            <div class="row">
                                <div class="col-4 user_wishlist_left_div">
                                    <img src="<?= base_url() ?>assets/images/producta2.jpeg" alt="product title"
                                        class="wishlist_product_image">
                                </div>
                                <div class="col-6 user_wishlist_right_div">
                                    <p class="user_wishlist_name">Bellini Top</p>
                                    <p class="user_wishlist_attr">Color: Pink</p>
                                    <div class="size">
                                        <p class="user_wishlsit_size_head">Select Size:</p>
                                        <div class="p-size mb-3">
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check rounded-circle attribute-values"
                                                    attribute-label="Color" name="btnradio_Size" id="#12<?=$jk?>" value="#12<?=$jk?>"
                                                    autocomplete="off">
                                                <label class="Size btn btn-outline-primary rounded-circle" for="#12<?=$jk?>">
                                                    12
                                                </label>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check rounded-circle attribute-values"
                                                    attribute-label="Color" name="btnradio_Size" id="#14<?=$jk?>" value="#14<?=$jk?>"
                                                    autocomplete="off">
                                                <label class="Size btn btn-outline-primary rounded-circle" for="#14<?=$jk?>">
                                                    14
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="user_wishlist_attr">
                                        <label for="qty">Qty:</label>
                                        <select name="qty" id="qty">
                                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                <option value="<?= $i ?>">
                                                    <?= $i ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </p>
                                    <p class="user_wishlsit_size_head">Rs 1900</p>
                                    <div class="cart_icons">
                                        <a href="javascript:void(0)" class="offcanvas_cart_icon">
                                            <img src="<?= base_url() ?>assets/images/icons/edit.svg" alt="edit"
                                                class="cart_icon_img" title="Edit">
                                        </a>
                                        <a href="javascript:void(0)" class="offcanvas_cart_icon">
                                            <img src="<?= base_url() ?>assets/images/icons/delete.svg" alt="delete"
                                                class="cart_icon_img" title="Delete">
                                        </a>
                                    </div>
                                    <button class="btn btn-outline-primary mt-3">Move to Bag</button>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                    </div>
                <?php } ?>
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