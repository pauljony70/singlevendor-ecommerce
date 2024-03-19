<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <?php include("includes/head.php") ?>
    <title>Profile - <?= get_store_settings('store_name') ?></title>
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
                    <h1 class="font-family-lora mb-4 mb-md-5">Profile</h1>
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <?php if ($msg = $this->session->flashdata('msg')) :
                                $msg_class = $this->session->flashdata('msg_class');
                                $badge = $this->session->flashdata('badge');
                                $badge_class = $this->session->flashdata('badge_class');
                            ?>
                                <div class="alert <?= $msg_class ?> alert-dismissible d-flex align-items-center fs-6 fade show" role="alert">
                                    <i class="<?= $badge; ?>"></i>
                                    <div class="ms-3"><?= $msg; ?></div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="col-12 col-md-9">
                            <form action="<?= base_url('account-details') ?>" method="post" id="addressForm" class="mb-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control ps-1" id="fullname" name="fullname" placeholder="John Doe" value="<?= $userdetails['full_name'] ?>">
                                            <label class="ps-0" for="fullname">Full name</label>
                                            <?php if (!empty(form_error('fullname'))) : ?>
                                                <div class="mt-1 text-danger"><i class="fa-solid fa-circle-xmark"></i> <?= strip_tags(form_error('fullname')) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control ps-1" id="email" name="email" placeholder="john@hotmail.com" value="<?= $userdetails['email'] ?>">
                                            <label class="ps-0" for="email">Email</label>
                                            <?php if (!empty(form_error('email'))) : ?>
                                                <div class="mt-1 text-danger"><i class="fa-solid fa-circle-xmark"></i> <?= strip_tags(form_error('email')) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-5">
                                            <input type="number" class="form-control ps-1" id="phone" name="phone" placeholder="0123456789" value="<?= $userdetails['phone_no'] ?>" oninput="enforceMaxLength(this)" maxlength="10">
                                            <label class="ps-0" for="phone">Phone</label>
                                            <?php if (!empty(form_error('phone'))) : ?>
                                                <div class="mt-1 text-danger"><i class="fa-solid fa-circle-xmark"></i> <?= strip_tags(form_error('phone')) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary rounded-2">Save</button>
                            </form>
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