<?php $this->load->helper('manage_helper') ?>
<?php
$default_language = $this->session->userdata('default_language');
if (empty($this->session->userdata('default_language'))) {
    $newdata = array(
        'default_language'  => '2',
        'logged_in' => TRUE
    );
    $set_data = $this->session->set_userdata($newdata);
}
?>
<style>
    :root {
        --theme-color: <?= get_settings('theme_color') ?>;
    }
</style>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/images/favicon_io/apple-touch-icon.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/images/favicon_io/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/favicon_io/favicon-16x16.png') ?>">
<link rel="manifest" href="<?= base_url('assets/images/favicon_io/site.webmanifest') ?>">


<?= get_settings('gtag_manager') ?>
<?= get_settings('facebook_pixel') ?>

<!-- Plugins css -->
<link rel="stylesheet" href="<?= base_url('assets/libs/bootstrap-5.3.2/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/libs/fontawesome/css/all.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/nouislider.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.css'); ?>" />

<!-- Custom css -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/topbar.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/navbar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/footer.css') ?>">

<script>
    window.global_user_id = <?= $this->session->userdata("user_id") ?? 0 ?>
</script>