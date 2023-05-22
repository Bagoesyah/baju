<?php
# @Author: Awan Tengah
# @Date:   2017-05-02T00:48:35+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T01:40:38+07:00
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Forgot Password</title>
    </head>
    <body>
        <img src="<?php echo base_url('assets/img/Logo.png'); ?>">
        <hr>
        <p>Hi, somebody recently asked to reset your Karuizawa password.</p>
        <p>If want to reset your password, please click link below.</p>
        <a href="<?php echo site_url("reset-password/{$encrypt_id_user}/{$encrypt_generate_password}"); ?>">Click Here to Change Your Password</a>
        <p>
            If you forgot your password, you can click link above and this is your new password <strong><?php echo isset($generate_password) ? $generate_password : '......'; ?></strong>
        </p>
        <p><strong>And then change your password as soon as possible.</strong></p>
        <p><strong>IGNORE THIS IF YOU DID NOT RESET YOUR PASSWORD</strong></p>
        <hr>
        Best Regards,<br>
        Karuizawa
    </body>
</html>
