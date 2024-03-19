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
                <h1>Profile</h1>
                <div class="profile_form">
                    <form action="#" method="post" class="user_details_form">
                        <div class="my-3">
                            <label for="fname">First Name</label><br>
                            <input type="text" name="fname" id="fname" class="profile_input_box" value="Yuvraj">
                        </div>
                        <div class="my-3">
                            <label for="lname">Last Name</label><br>
                            <input type="text" name="lname" id="lname" class="profile_input_box" value="Solanki">
                        </div>
                        <div class="my-3">
                            <label for="mobile_num">Mobile Number</label><br>
                            <input type="text" name="mobile_num" id="mobile_num" class="profile_input_box"
                                value="893579834">
                        </div>
                        <div class="my-3">
                            <label for="email">Email</label><br>
                            <input type="text" name="email" id="email" class="profile_input_box"
                                value="yuvraj@gmail.com">
                        </div>
                        <div class="profile_btn_group">
                            <button class="btn btn-outline-secondary w-20 me-2">Cancel</button>
                            <button class="btn btn-primary w-20 ms-2">Save</button>
                        </div>
                    </form>
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