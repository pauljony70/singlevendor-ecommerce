<link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/index.js') ?>">


<div class="desktop_dashboard_sidebar">
    <div>
        <div class="user_pages mt-6">
            <ul class="p-0 user_routing_list">
                <?php $link = $_SERVER['REQUEST_URI']; ?>
                <li>
                    <a href="<?= base_url() ?>user2" class="<?php echo strpos($link, "user2") ? "actives" : "" ?>">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>profile" class="<?php echo strpos($link, "profile") ? "actives" : "" ?>">
                        Profile
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>password" class="<?php echo strpos($link, "password") ? "actives" : "" ?>">
                        Password
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>addresses" class="<?php echo strpos($link, "addresses") ? "actives" : "" ?>">
                        Address
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>userorders" class="<?php echo strpos($link, "userorders") ? "actives" : "" ?>">
                        My Orders
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>userwishlist" class="<?php echo strpos($link, "userwishlist") ? "actives" : "" ?>">
                        Wishlist
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>logout">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
