<div class="accordion mb-4 d-lg-none" id="accordionSidebar">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed border p-2 fw-bolder" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                User Profile
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse hide" aria-labelledby="headingOne"
            data-bs-parent="#accordionSidebar">
            <div class="accordion-body border p-0">
                <ul class="p-0 user-routing-list">
                    <?php $link = $_SERVER['REQUEST_URI']; ?>
                    <li>
                        <a href="<?= base_url('dashboard') ?>" class="<?php echo strpos($link, "dashboard") ? "active" : "" ?>">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('account-details') ?>" class="<?php echo strpos($link, "account-details") ? "active" : "" ?>">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('address') ?>" class="<?php echo strpos($link, "address") ? "active" : "" ?>">
                            Address
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('order') ?>" class="<?php echo strpos($link, "order") ? "active" : "" ?>">
                            My Orders
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('wishlist') ?>" class="<?php echo strpos($link, "wishlist") ? "active" : "" ?>">
                            Wishlist
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('logout') ?>">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>