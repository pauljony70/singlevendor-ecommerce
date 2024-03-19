<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <?php include("includes/head.php") ?>
    <title>Dashboard - <?= get_store_settings('store_name') ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dashboard.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/address.css') ?>">
</head>

<body>
    <!-- Preloader -->
    <?php include("includes/preloader.php"); ?>
    <?php include("includes/topbar.php") ?>
    <?php include("includes/navbar.php") ?>


    <main class="my-5">
        <div class="container">
            <section class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    <!-- Sidebar -->
                    <?php include('includes/usersidebardesktop.php') ?>
                </div>
                <div class="col-12 col-lg-9">
                    <?php include('includes/sidebarmobile.php') ?>
                    <h1 class="font-family-lora mb-4">Dashboard</h1>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-5">
                                <div class="d-flex justify-content-between">
                                    <h5 class="fw-medium m-0">Profile</h5>
                                    <a href="<?= base_url('account-details') ?>" class="fs-6 text-dark">Edit</a>
                                </div>
                                <hr class="my-2">
                                <p class="m-0">Full Name</p>
                                <p class="profile-details"><?= $userdetails['full_name'] ?></p>

                                <p class="m-0">Mobile Number</p>
                                <p class="profile-details"><?= $userdetails['phone_no'] ?></p>

                                <p class="m-0">Email</p>
                                <p class="profile-details"><?= $userdetails['email'] ?></p>
                            </div>

                            <div class="mb-5">
                                <div class="d-flex justify-content-between">
                                    <h5 class="fw-medium m-0">Address Book</h5>
                                    <a href="<?= base_url('address') ?>" class="fs-6 text-dark">View</a>
                                </div>
                                <hr class="my-2">
                                <?php foreach (json_decode($address['addressarray'], true) as $address_data) : ?>
                                    <?php if ($address_data['address_id'] == $address['defaultaddress']) : ?>
                                        <div class="text-capitalize mt-3">
                                            <p class="profile-details mb-1"><?= $address_data['fullname'] ?></p>
                                            <p class="profile-details mb-1"><?= $address_data['address'] ?></p>
                                            <p class="profile-details mb-1"><?= $address_data['city'] ?>, <?= $address_data['state'] ?>, <?= $address_data['pincode'] ?></p>
                                            <p class="profile-details mb-2"><?= $address_data['phone'] ?></p>
                                            <div class="default-shipping-address fw-semibold p-3 mb-2">Default Shipping Address</div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <a href="<?= base_url('add-address') ?>" class="btn btn-lg btn-outline-dark mt-3 fw-semibold py-2 px-3 fs-6 rounded-1">Add new Address</a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-5">
                                <div class="d-flex justify-content-between">
                                    <h5 class="fw-medium m-0">Order History</h5>
                                    <a href="<?= base_url('order') ?>" class="fs-6 text-dark">View All</a>
                                </div>
                                <hr class="my-2">
                                <?php if (!empty($orders)) : ?>
                                    <p class="fs-6 fw-light mb-3">Most recent Order</p>
                                    <a href="<?= base_url('order/' . $orders[0]['order_id']) ?>" class="row text-dark">
                                        <div class="col-3">
                                            <img src="<?= MEDIA_URL . json_decode($orders[0]['prod_img'])[0] ?>" alt="product_umg" class="w-100">
                                        </div>
                                        <div class="col-9">
                                            <p class="mb-2">Order Number: <?= $orders[0]['order_id'] ?></p>
                                            <p class="mb-2">Qty: <?= $orders[0]['qty'] ?></p>
                                            <p class="mb-2">Placed On: <?= date('d M Y', strtotime($orders[0]['create_date'])) ?></p>
                                            <p class="mb-2">Order Status: <?= $orders[0]['status'] ?></p>
                                        </div>
                                    </a>
                                    <div class="col-12">
                                        <hr class="my-2">
                                        <div class="d-flex justify-content-between fw-medium">
                                            <div><?= $orders[0]['qty'] ?> Total item(s)</div>
                                            <div><?= price_format($orders[0]['prod_price'] * $orders[0]['qty']) ?></div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <p class="fs-6 fw-light mb-3">No Order</p>
                                <?php endif; ?>
                            </div>

                            <div class="mb-5">
                                <div class="d-flex justify-content-between">
                                    <h5 class="fw-medium m-0">Wishlist</h5>
                                    <a href="#" class="fs-6 text-dark">View All</a>
                                </div>
                                <hr class="my-2">
                                <div class="wishlist-items">
                                    <!-- Display only 2 products rest in the wishlist page -->
                                    <?php foreach ($wishlist_data as $key => $wishlist) : ?>
                                        <?php if ($key >= 2) {
                                            break;
                                        } ?>
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
                    </div>
                </div>
            </section>
        </div>
    </main>
    <?php include("includes/footer.php") ?>
    <?php include("includes/script.php") ?>

</body>

</html>