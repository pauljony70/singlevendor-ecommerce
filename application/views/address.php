<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <?php include("includes/head.php") ?>
    <title>Address Book - <?= get_store_settings('store_name') ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashboard.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/address.css') ?>">
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
                    <h1 class="font-family-lora mb-4 mb-md-5">Address Book</h1>

                    <?php if (!empty(json_decode($address['addressarray'], true))) : ?>
                        <div class="row">
                            <?php foreach (json_decode($address['addressarray'], true) as $address_data) : ?>
                                <div class="col-12 col-md-6">
                                    <div class="text-capitalize mb-5">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="fw-bold m-0"><?= $address_data['fullname'] ?> - <?= $address_data['address'] ?> - <?= $address_data['city'] ?></h6>
                                            <a href="<?= base_url('edit-address/' . $address_data['address_id']) ?>" class="fs-6 fw-bold text-dark">Edit</a>
                                        </div>
                                        <hr class="my-2">
                                        <p class="profile-details mb-1"><?= $address_data['fullname'] ?></p>
                                        <p class="profile-details mb-1"><?= $address_data['address'] ?></p>
                                        <p class="profile-details mb-1"><?= $address_data['city'] ?>, <?= $address_data['state'] ?>, <?= $address_data['pincode'] ?></p>
                                        <p class="profile-details mb-2"><?= $address_data['phone'] ?></p>
                                        <?php if ($address_data['address_id'] == $address['defaultaddress']) : ?>
                                            <div class="default-shipping-address fw-semibold p-3 mb-2">Default Shipping Address</div>
                                        <?php else : ?>
                                            <a href="<?= base_url('make-default-address/' . $address_data['address_id']) ?>" class="default-address text-decoration-underline mb-1">Make Default Shipping Address</a>
                                        <?php endif; ?>
                                        <div>
                                            <a href="<?= base_url('delete-address/' . $address_data['address_id']) ?>" class="remove-address text-decoration-underline mb-1">Remove Address</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="fs-6">No Saved Addresses</p>
                    <?php endif; ?>
                    <a href="<?= base_url('add-address') ?>" class="btn btn-lg btn-outline-primary rounded-1 mb-4">Add New Address</a><br>
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