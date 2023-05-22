<?php
# @Author: Awan Tengah
# @Date:   2017-03-31T01:16:07+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T19:50:06+07:00
?>
<div class="container">
    <h1>Welcome to karuizawa shirt</h1>
    <p>Your best T-shirt should be like your bed, it just feels like you are home when you are in it.</p>
    <br>
    <h1><strong>Shoping Bag</strong></h1>
    <div class="row text-left">
        <div class="col-sm-6">
            <?php alert_message(); ?>
            <?php 
            if ($this->session->flashdata('error_shipping')) {
                ?>
                <div class="alert alert-danger">
                    <p><?php echo $this->session->flashdata('error_shipping'); ?></p>
                </div>
                <?php
            }
            ?>
            <?php echo form_open('cart/order_shipping'); ?>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Your name.." value="<?php echo (($order_shipping->STATUS == 'SUCCESS')) ? $order_shipping->DATA->NAME : set_value('name'); ?>">
                    <?php echo form_error('name', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control" placeholder="Full address.." rows="5" cols="80"><?php echo (isset($order_shipping->DATA->ADDRESS) && $order_shipping->STATUS == 'SUCCESS') ? $order_shipping->DATA->ADDRESS : set_value('address'); ?></textarea>
                    <?php echo form_error('address', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="form-group">
                    <label>HP</label>
                    <input type="text" name="hp" class="form-control" placeholder="+62.." value="<?php echo (($order_shipping->STATUS == 'SUCCESS')) ? $order_shipping->DATA->HP : set_value('hp'); ?>">
                    <?php echo form_error('hp', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Your Email.." value="<?php echo (($order_shipping->STATUS == 'SUCCESS')) ? $order_shipping->DATA->EMAIL : set_value('email'); ?>">
                    <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" placeholder="Enter City.." value="<?php echo (($order_shipping->STATUS == 'SUCCESS')) ? $order_shipping->DATA->CITY : set_value('city'); ?>">
                    <?php echo form_error('city', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="+62.." value="<?php echo (($order_shipping->STATUS == 'SUCCESS')) ? $order_shipping->DATA->PHONE : set_value('phone'); ?>">
                    <?php echo form_error('phone', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="form-group">
                    <label>Zip Code</label>
                    <input type="text" name="zip_code" class="form-control" placeholder="Zip Code.." value="<?php echo (($order_shipping->STATUS == 'SUCCESS')) ? $order_shipping->DATA->ZIP_CODE : set_value('zip_code'); ?>">
                    <?php echo form_error('zip_code', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-default" value="Save">
                </div>
            <?php echo form_close(); ?>
        </div>
        <div class="col-sm-6 text-center">
            <ul class="list-unstyled">
                <li><h2>Total Amount To Be Paid</h2></li>
                <?php $get_price = !empty($sum_price_by_order_number->DATA) ? $sum_price_by_order_number->DATA->PRICE_TOTAL : 0; ?>
                <?php $pg_price = (int) $get_price; ?>
                <li><h3><?php echo format_currency($get_price); ?></h3></li>
                <?php $get_order_number = !empty($sum_price_by_order_number->DATA) ? $sum_price_by_order_number->DATA->ORDER_NUMBER : ''; ?>
                <li>Order Number : <?php echo $get_order_number; ?></li>
                <!-- <li>
                    <div class="form-group">
                        <input type="text" name="code_voucher" class="form-control" placeholder="Use Code Voucher.." readonly>
                        <small>Select the payment would you like to use</small>
                    </div>
                </li>
                <li>
                    Schedule Arrival Date <br>
                    Friday: .....
                </li>
                <li>
                    <br>
                    Payment Method
                </li> -->
                <li>
                    <br>
                    <a href="<?php echo site_url('cart/confirm_checkout'); ?>" class="btn btn-default" id="pay_now">Pay Now</a>
                </li>
            </ul>
        </div>
    </div>
</div>
