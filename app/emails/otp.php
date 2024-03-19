<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0; margin-top: 0px;">
        <div style="border-bottom:1px solid #eee">
            <a href="<?= BASEURL ?>" style="font-size:1.4em;color: #008ecc;text-decoration:none;font-weight:600"><img src="<?= BASEURL ?>assets/images/logo.png" alt="logo" width="70">
        </div>
        <p style="font-size:1.1em">Hi User,</p>
        <p>Thank you for choosing <?= ucfirst(APP_NAME) ?> Use the following OTP to complete your password reset procedures. OTP is valid for 3 minutes</p>
        <h2 style="background: #008ecc;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">{{OTP}}</h2>
        <p style="font-size:0.9em; margin-bottom: 0px">Regards,<br /><?= ucfirst(APP_NAME) ?></p>
        <a style="font-size:0.9em;" href="<?= BASEURL ?>"><?= BASEURL ?></a><br>
        <img style="margin-top: 5px;" src="<?= BASEURL ?>assets/images/logo.png" alt="logo" width="70">
        <hr style="border:none;border-top:1px solid #eee" />
        <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
            <p><?= ucfirst(APP_NAME) ?> Inc</p>
        </div>
    </div>
</div>