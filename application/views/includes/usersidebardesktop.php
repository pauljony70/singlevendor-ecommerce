<div class="mt-0">
    <ul class="p-0 user-routing-list">
        <?php $link = $_SERVER['REQUEST_URI']; ?>
        <li>
            <a href="<?= base_url('dashboard') ?>" class="<?= strpos($link, "dashboard") ? "active" : "" ?>">
                Dashboard
            </a>
        </li>
        <li>
            <a href="<?= base_url('account-details') ?>" class="<?= strpos($link, "account-details") ? "active" : "" ?>">
                Profile
            </a>
        </li>
        <li>
            <a href="<?= base_url('address') ?>" class="<?= strpos($link, "address") ? "active" : "" ?>">
                Address
            </a>
        </li>
        <li>
            <a href="<?= base_url('order') ?>" class="<?= strpos($link, "order") ? "active" : "" ?>">
                My Orders
            </a>
        </li>
        <li>
            <a href="<?= base_url('wishlist') ?>" class="<?= strpos($link, "wishlist") ? "active" : "" ?>">
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