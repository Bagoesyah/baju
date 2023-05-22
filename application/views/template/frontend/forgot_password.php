<?php
# @Author: Awan Tengah
# @Date:   2017-05-01T23:58:33+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T01:26:41+07:00
?>

<div class="login-box">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <i class="ion-ios-locked" style="font-size: 5em;"></i>
                <h1>Forgot your password?</h1>
                <p>You can reset your password here.</p>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 col-centered">
                    <?php alert_message(); ?>
                    <?php echo form_open(); ?>
                    <div class="form-group text-justify">
                        <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail">
                    </div>
                    <button type="submit" class="btn btn-default">Send My Password</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
