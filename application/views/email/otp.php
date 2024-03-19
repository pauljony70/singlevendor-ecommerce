<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0; margin-top: 0px;">
            <div style="border-bottom:1px solid #eee">
                <a href="<?= base_url() ?>" style="font-size:1.4em;color: <?= get_settings('theme_color') ?>;text-decoration:none;font-weight:600"><img src="<?= base_url('assets/images/logo.png') ?>" alt="logo" width="70">
            </div>
            <p style="font-size:1.1em">Hi <?= $full_name ?>,</p>
            <p>Thank you for choosing <?= get_store_settings('store_name') ?> Use the following OTP to complete your password reset procedures. OTP is valid for 3 minutes</p>
            <h2 style="background: <?= get_settings('theme_color') ?>;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;"><?= $otp ?></h2>
            <p style="font-size:0.9em; margin-bottom: 0px">Regards,<br /> <?= get_store_settings('store_name') ?></p>
            <a style="font-size:0.9em; color: #3869d4" href="<?= base_url() ?>"><?= base_url() ?></a><br>
            <img style="margin-top: 5px;" src="<?= base_url('assets/images/logo.png') ?>" alt="logo" width="70">
            <hr style="border:none;border-top:1px solid #eee" />
            <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                <p><?= get_store_settings('store_name') ?> Inc</p>
            </div>
        </div>
    </div>
</body>

</html>