<?php
# @Author: Awan Tengah
# @Date:   2017-03-09T20:42:49+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-10T10:21:08+07:00
?>
<div class="login-box">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">
                <h1>Welcome to karuizawa shirt</h1>
                <p>Your best T-shirt should be like your bed, it just feels like you are home when you are in it.</p>
            </div>
            <br>
            <h4>REGISTER</h4>
            <p>Welcome to Karuizawa-shirt!</p>
            <p>
                Enter the following fields.<br>
                We will send you an e-mail confirming the registration member.
            </p>
            <div class="col-lg-4 col-centered">
                <?php alert_message(); ?>
                <?php alert_validation(); ?>
                <?php echo form_open(); ?>
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" value="<?php echo set_value('name'); ?>">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo set_value('phone'); ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="checkbox text-left">
                    <label>
                        <input type="checkbox" name="get_new_info"> Get new information via e-mail
                    </label>
                </div>
                <hr>
                <div class="checkbox text-left">
                    <label>
                        <input type="checkbox" name="accept_term_service"> I accept the Terms of Service
                    </label>
                </div>
                <div class="col-xs-4 col-centered">
                    <button type="submit" class="btn btn-default col-xs-12">Register</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
