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
        <title>New Account</title>
    </head>
    <body>
        <img src="<?php echo base_url('assets/img/Logo.png'); ?>">
        <hr>
        <p>Hi, Thanks for joining us. Here is your account information: </p>
        
        <p><strong>Username:</strong> <?php echo $username; ?></p>
        <p><strong>Password:</strong> <?php echo $password; ?></p>
        <p>
            You can login to our website using your username and password.
        </p>
        <a href="<?php echo site_url("login"); ?>">Click Here to Login</a>
        <hr>
        Best Regards,<br>
        Karuizawa
    </body>
</html>
