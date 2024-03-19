<input type="hidden" class="site_url" value="<?= base_url() ?>">
<input type="hidden" id="user_id" value="<?= $this->session->userdata('user_id') ?>">
<input type="hidden" class="securecode" value="1234567890">

<nav class="navbar navbar-light bg-white navbar-sticky border-bottom" style="position: sticky; top: 0px; z-index: 999;">
    <div class="container">
        <div class="d-flex align-items-center w-100 justify-content-between">
            <a href="<?= base_url() ?>" class="col-4">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Shopping</span>
            </a>
            <a class="col-4 navbar-brand m-0 py-0 text-center" href="<?= base_url() ?>">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="<?= get_store_settings('store_name') ?>" srcset="<?= base_url('assets/images/logo-200x200.png') ?> 200w" sizes="(min-width: 992px) 85px, 60px">
            </a>
            <a href="tel:<?= get_store_settings('whatsappno') ?>" class="col-4 text-end">
                <span class="">Need Help? Call <?= get_store_settings('whatsappno') ?></span>
                <i class="fa-solid fa-phone"></i>
            </a>
        </div>
    </div>
</nav>