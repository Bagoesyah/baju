<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T13:37:31+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T00:08:48+07:00
?>
<div class="login-box">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">
                <h1>Karuizawa Administrator</h1>
                <p>Your best T-shirt should be like your bed, it just feels like you are home when you are in it.</p>
            </div>
            <br>
            <h4>LOGIN</h4>
            <p>If you are already registered, please enter your email address and password</p>
            <div class="col-sm-6 col-lg-4 col-centered">
                <?php alert_message(); ?>
                <?php echo form_open(); ?>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="checkbox">
                    <div class="col-xs-6 text-right">
                        <label>
                            <input type="checkbox" name="stay_in"> Let it stay in
                        </label>
                    </div>
                    <div class="col-xs-6 text-left">
                        <a href="<?php echo site_url('forgot-password'); ?>">Forgot your password?</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-centered">
                        <button type="submit" class="btn btn-default col-xs-12">Login</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <br>
        </div>
    </div>
</div>
