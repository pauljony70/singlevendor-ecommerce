<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
<input type="hidden" class="site_url" value="<?= base_url() ?>">
<input type="hidden" id="user_id" value="<?= $this->session->userdata('user_id') ?>">
<input type="hidden" name="website_name" value="<?php echo $website_name; ?>" id="website_name">
<input type="hidden" class="securecode" value="1234567890">

<!-- New Navbar -->

<header class="navbar-light navbar-sticky" style="position: sticky; top: -1px; z-index: 1000;">
    <!-- Part 1 Navbar (Logo, Search, Cart and User Details) -->
    <nav class="navbar menu-navbar navbar-expand-lg bg-white">
        <div class="container">
            <div class="row w-100">
                <div class="col-4">
                    <div class="d-flex d-lg-none align-items-center h-100">
                        <a class="ms-3 text-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </div>
                </div>
                <a class="col-4 navbar-brand m-0 py-0 text-center" href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="<?= get_store_settings('store_name') ?>" srcset="<?= base_url('assets/images/logo-200x200.png') ?> 200w" sizes="(min-width: 992px) 85px, 50px">
                </a>
                <div class="col-4 d-flex align-items-center justify-content-end">
                    <a href="javascript:void(0)" title="Search">
                        <i class="fa-solid cross-btn fa-magnifying-glass"></i>
                    </a>
                    <a href="<?= base_url('wishlist') ?>" class="ms-3 ms-md-4 position-relative" title="Wishlist">
                        <i class="fa-regular fa-heart"></i>
                        <span class="wishlist-icon-count">
                            <div id="badge-wishlist-count">0</div>
                        </span>
                    </a>
                    <a href="<?= base_url('cart') ?>" class="ms-3 ms-md-4 position-relative" title="Cart" id="cart-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="icon-count">
                            <div id="badge-cart-count">0</div>
                        </span>
                    </a>
                    <div class="dropdown">
                        <a class="ms-3 ms-md-4 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Profile">
                            <i class="fa-regular fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end mt-2 hidden_login_box">
                            <p class="px-3 mb-2">Welcome</p>
                            <?php if ($this->session->userdata('user_id') == '') : ?>
                                <div class="px-3">
                                    <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">Login/Signup</a>
                                </div>
                            <?php else : ?>
                                <a href="<?= base_url('dashboard') ?>" class="px-3 text-dark fw-medium"><?= $this->session->userdata('displayname') ?></a>
                            <?php endif; ?>
                            <hr>
                            <ul class="h_login_links px-3 p-0">
                                <li><a href="<?= base_url('wishlist') ?>">Wishlist</a></li>
                                <li><a href="<?= base_url('order') ?>">Orders</a></li>
                                <li><a href="javascript:void(0)">Contact Us</a></li>
                            </ul>
                            <?php if ($this->session->userdata('user_id') != '') : ?>
                                <hr>
                                <ul class="h_login_links px-3 p-0">
                                    <li><a href="<?= base_url('logout') ?>">Logout</a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Part 2 Navbar (Categories) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm bg-white category-navbar py-0">
        <div class="container position-relative">
            <div class="navbar-collapse w-100 collapse" id="navbarCollapse2">
                <ul class="menu-items mb-0 px-0 w-100 justify-content-center">
                    <?php
                    $maincats = array_slice($header_cat, 0, 4);
                    foreach ($maincats as $maincat) : ?>
                        <li class="menu-li">
                            <a href="<?= base_url('category/' . $maincat['cat_name'] . '/' . $maincat['cat_id']) ?>" class="menu-item pb-3">
                                <?= $maincat['cat_name'] ?>
                            </a>
                            <?php if (!empty($maincat['subcat_1'])) : ?>
                                <div class="mega-menu">
                                    <div class="content box-shadow-0">
                                        <div class="container content">
                                            <?php for ($i = 0; $i < 4; $i++) : ?>
                                                <div class="col px-2 py-4">
                                                    <section>
                                                        <?php if (!empty($maincat['subcat_1'][$i])) : ?>
                                                            <a href="<?= base_url('category/' . $maincat['subcat_1'][$i]['cat_name'] . '/' . $maincat['subcat_1'][$i]['cat_id']) ?>" class="item-heading">
                                                                <?= $maincat['subcat_1'][$i]['cat_name'] ?>
                                                            </a>
                                                            <?php if (count($maincat['subcat_1'][$i]['subsubcat_2']) > 0) : ?>
                                                                <ul class="mega-links px-0">
                                                                    <?php foreach ($maincat['subcat_1'][$i]['subsubcat_2'] as $key => $subsubcat_2) : ?>
                                                                        <?php
                                                                        // if ($key > 4) :
                                                                        //     break;
                                                                        // endif;
                                                                        ?>
                                                                        <li>
                                                                            <a href="<?= base_url('category/' . $subsubcat_2['cat_name'] . '/' . $subsubcat_2['cat_id']) ?>">
                                                                                <?= $subsubcat_2['cat_name'] ?>
                                                                            </a>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                                <!--  <a class="view-all" href="<?= base_url('sub_category/' . $maincat['subcat_1'][$i]['cat_id']) ?>" href="">view all <i class="fa-solid fa-arrow-right"></i></a> -->
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </section>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    <?php foreach ($custom_navigations as $custom_navigation) : ?>
                        <?php if (count($custom_navigation['navigation_data']) === 4) : ?>
                            <li class="menu-li">
                                <a href="#cutom-nav-<?= $custom_navigation['id'] ?>" class="menu-item pb-3"><?= $custom_navigation['name'] ?></a>
                                <div class="mega-menu">
                                    <div class="content custom-banner-content box-shadow-0">
                                        <div class="container content">
                                            <?php foreach ($custom_navigation['navigation_data'] as $navigation_data) : ?>
                                                <?php if ($navigation_data['banner']) : ?>
                                                    <a href="<?= base_url('navigation-products/' . $custom_navigation['name'] . '/' . $navigation_data['id']) ?>" class="col px-2 py-4">
                                                        <img src="<?= MEDIA_URL . $navigation_data['banner'] ?>" alt="Collection" srcset="" class="w-100 h-100">
                                                    </a>
                                                <?php endif; ?>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endif ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="search-form-div position-absolute d-none">
        <form action="<?= base_url('search/s') ?>" role="search">
            <div class="position-relative">
                <div class="input-group search-input-group w-100">
                    <input type="text" class="form-control" autocomplete="off" id="search" name="search" value="<?= isset($_REQUEST['search']) ? $_REQUEST['search'] : '' ?>" placeholder="Search (keywords,etc)" aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn" type="submit" id="searchButton">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>

                <div class="dropdown position-absolute w-100 mt-2" style="left: 0; z-index: 1000;">
                    <ul class="dropdown-menu searchResults py-0 w-100" id="searchResults"></ul>
                </div>
            </div>

        </form>
    </div>

    <div class="search-form-overlay"></div>
</header>

<!-- New Mobile Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header align-items-center justify-content-end">
        <button type="button" class="close-btn-offcanvas text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php foreach ($header_cat as $header_cat_mobile_data) : ?>
                <?php if (count($header_cat_mobile_data['subcat_1']) > 0) : ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="<?= count($header_cat_mobile_data['subcat_1']) > 0 ? '' : 'no-arrow' ?> accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#accordion<?= $header_cat_mobile_data['cat_id'] ?>" aria-expanded="false" aria-controls="accordion<?= $header_cat_mobile_data['cat_id'] ?>">
                                <?= $header_cat_mobile_data['cat_name'] ?>
                            </button>
                        </h2>
                        <div id="accordion<?= $header_cat_mobile_data['cat_id'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body py-0">
                                <?php foreach ($header_cat_mobile_data['subcat_1'] as $subcat_1_data) : ?>
                                    <?php if (count($subcat_1_data['subsubcat_2']) > 0) : ?>
                                        <div class="accordion accordion-flush" id="accordion<?= $header_cat_mobile_data['cat_id'] ?>Example">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="<?= count($subcat_1_data['subsubcat_2']) > 0 ? '' : 'no-arrow' ?> accordion-button pe-0 collapsed fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#accordion<?= $subcat_1_data['cat_id'] ?>" aria-expanded="false" aria-controls="accordion<?= $subcat_1_data['cat_id'] ?>">
                                                        <?= $subcat_1_data['cat_name'] ?>
                                                    </button>
                                                </h2>
                                                <div id="accordion<?= $subcat_1_data['cat_id'] ?>" class="accordion-collapse collapse" data-bs-parent="accordion#<?= $subcat_1_data['cat_id'] ?>Example">
                                                    <div class="accordion-body py-0">
                                                        <?php foreach ($subcat_1_data['subsubcat_2'] as $subcat_2_data) : ?>
                                                            <div class="accordion accordion-flush" id="accordion<?= $subcat_1_data['cat_id'] ?>Example">
                                                                <a href="<?= base_url('category/' . $subcat_2_data['cat_name'] . '/' . $subcat_2_data['cat_id']) ?>" class="accordion-item">
                                                                    <h2 class="accordion-header">
                                                                        <button class="no-arrow accordion-button pe-0 collapsed fw-light" type="button" data-bs-toggle="collapse" data-bs-target="#accordion<?= $subcat_2_data['cat_id'] ?>" aria-expanded="false" aria-controls="accordion<?= $subcat_2_data['cat_id'] ?>">
                                                                            <?= $subcat_2_data['cat_name'] ?>
                                                                        </button>
                                                                    </h2>
                                                                </a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="accordion accordion-flush" id="accordion<?= $header_cat_mobile_data['cat_id'] ?>Example">
                                            <a href="<?= base_url('category/' . $subcat_1_data['cat_name'] . '/' . $subcat_1_data['cat_id']) ?>" class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="<?= count($subcat_1_data['subsubcat_2']) > 0 ? '' : 'no-arrow' ?> accordion-button pe-0 collapsed fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#accordion<?= $subcat_1_data['cat_id'] ?>" aria-expanded="false" aria-controls="accordion<?= $subcat_1_data['cat_id'] ?>">
                                                        <?= $subcat_1_data['cat_name'] ?>
                                                    </button>
                                                </h2>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <a href="<?= base_url('category/' . $header_cat_mobile_data['cat_name'] . '/' . $header_cat_mobile_data['cat_id']) ?>" class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="<?= count($header_cat_mobile_data['subcat_1']) > 0 ? '' : 'no-arrow' ?> accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#accordion<?= $header_cat_mobile_data['cat_id'] ?>" aria-expanded="false" aria-controls="accordion<?= $header_cat_mobile_data['cat_id'] ?>">
                                <?= $header_cat_mobile_data['cat_name'] ?>
                            </button>
                        </h2>
                    </a>
                <?php endif ?>
                <hr class="m-0">
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Cart Offcanvas -->
<div class="offcanvas offcanvas-end m-1" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
    <div class="offcanvas-header">
        <div class="offcanvas-title fw-medium" id="cartOffcanvasLabel">Your Shopping Bag (<span class="total-cart-item">0</span> Items)</div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr class="mt-0">
    <div class="offcanvas-body">

    </div>
    <div class="offcanvas-footer">
        <div class="d-flex justify-content-between">
            <p class="fs-6 fw-bold">Total</p>
            <p class="fs-6 fw-bold total-cart-value"><?= price_format(0) ?></p>
        </div>
        <p class="">All prices are included with tax.</p>
        <div class="offcanvas_fooer_actions">
            <a href="<?= base_url('checkout') ?>" class="btn btn-primary w-100 mb-2">Checkout</a>
            <a href="<?= base_url('cart') ?>" class="btn ps-0">View Shopping Cart</a>
        </div>
    </div>
</div>