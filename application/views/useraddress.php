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
                <h1>Address Book</h1>
                <?php if (1 != 2) { ?>
                    <section id="default_address" class="mt-4">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="heading_edit_btn">
                                    <h4 class="add_heading_text">Full Address</h4>
                                    <a href="#" class="add_edit_btn">Edit</a>
                                </div>
                                <hr class="add_display_hr">
                                <p class="add_type">
                                    <span>Address Type</span>
                                    <input type="text" value="Shipping" class="add_input_default" disabled>
                                </p>
                                <div class="add_content">
                                    <h6 class="add_contnet_blocks">yuvraj solanki</h6>
                                    <h6 class="add_contnet_blocks">Bhopal Madhya Pradesh</h6>
                                    <h6 class="add_contnet_blocks">Bhopal</h6>
                                    <h6 class="add_contnet_blocks">Bhopal MP</h6>
                                    <h6 class="add_contnet_blocks">Mobile Number</h6>
                                    <button class="add_contnet_default_btns"disabled>Default Shipping Address</button><br>
                                    <a href="#" class="add_contnet_link">Remove Address</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 add_content_divv">
                                <div class="heading_edit_btn">
                                    <h4 class="add_heading_text">Full Address</h4>
                                    <a href="#" class="add_edit_btn">Edit</a>
                                </div>
                                <hr class="add_display_hr">
                                <p class="add_type">
                                    <span>Address Type</span>
                                    <input type="text" value="Shipping" class="add_input_default" disabled>
                                </p>
                                <div class="add_content">
                                    <h6 class="add_contnet_blocks">yuvraj solanki</h6>
                                    <h6 class="add_contnet_blocks">Bhopal Madhya Pradesh</h6>
                                    <h6 class="add_contnet_blocks">Bhopal</h6>
                                    <h6 class="add_contnet_blocks">Bhopal MP</h6>
                                    <h6 class="add_contnet_blocks">Mobile Number</h6>
                                    <button class="add_contnet_default_btns"disabled>Default Shipping Address</button><br>
                                    <a href="#" class="add_contnet_link">Remove Address</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="profile_form" id="no_address_form">
                        <p class="add_msg fs-9 mt-4">No Saved Addresses</p>
                        <button id="new_add_btn" class="btn btn-outline-primary mb-4">Add New Address</button><br>
                        <a href="<?= base_url() ?>user2" class="a_link fs-9 my-4">Back to Account</a>
                    </div>
                <?php } ?>
                <div id="new_address_section">
                    <form action="#" method="post" class="shipping_form_address">
                        <div class="form-floating mb-3">
                            <input type="text" id="address_title" class="address_input_block form-control me-1"
                                name="addresstitle" placeholder="Address Title">
                            <label for="address_title">Address Title</label>
                        </div>
                        <div class="input-group my-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="address_input_block form-control me-1" name="first_name"
                                    placeholder="First Name">
                                <label>First Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="address_input_block form-control ms-1" name="last_name"
                                    placeholder="Last Name">
                                <label>Last Name</label>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="address_input_block form-control my-4" name="address1"
                                placeholder="Address 1">
                            <label>Address 1</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="address_input_block form-control my-4" name="address2"
                                placeholder="Address 2">
                            <label>Address 2</label>
                        </div>
                        <div class="input-group my-4">
                            <select name="country" id="country" class="address_input_block form-control">
                                <option value="India" selected>India</option>
                                <option value="UAE">UAE</option>
                                <option value="Jordan">Jorden</option>
                            </select>
                            <input type="text" class="address_input_block form-control ms-1" name="zip_code"
                                placeholder="Zip Code">
                        </div>
                        <div class="input-group my-4">
                            <select name="state" id="state" class="address_input_block form-control">
                                <option value="Assam">Assam</option>
                                <option value="Madhya Pradesh" selected>Madhya Pradesh</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Delhi">Delhi</option>
                            </select>
                            <input type="text" class="address_input_block form-control ms-1" name="city"
                                placeholder="City">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text address_number">+91</span>
                            <input type="text" class="address_input_block form-control" placeholder="Mobile Number">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text address_number" id="-addon1">Address Type</span>
                            <select name="state" id="state" class="address_input_block form-control">
                                <option value="Shipping">Shipping</option>
                                <option value="Billing">Billing</option>
                                <option value="Both">Both</option>
                            </select>
                        </div>
                        <div class="form-check my-4 default_addd_checkbox">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Default Shipping address
                            </label>
                        </div>
                        <div class="add_ress_button">
                            <button class="btn btn-outline-secondary w-40">Cancel</button>
                            <button class="btn btn-primary w-40">Save</button>
                        </div>
                    </form>
                    <a href="<?= base_url() ?>user2" class="a_link mt-5">Back to Account</a>
                </div>
            </div>
        </section>
    </main>


    <!-- Footer Area -->
    <?php include("includes/footer.php") ?>
    <!-- Footer Area End -->

    <?php include("includes/script.php") ?>
    <script src="<?php echo site_url(); ?>/assets/js/cart.js"></script>

    <script>
        let new_add_btn = document.getElementById("new_add_btn")
        new_add_btn.addEventListener("click", () => {
            new_address_section = document.getElementById("new_address_section")
            new_address_section.style.display = 'block'

            no_address_form = document.getElementById("no_address_form")
            default_address = document.getElementById("default_address")
            default_address.style.display = 'none'
            no_address_form.style.display = 'none'
        });
    </script>

</body>

</html>