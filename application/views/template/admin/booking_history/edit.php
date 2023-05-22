<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-22T21:17:18+07:00
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <?php if (isset($sub_page_title)): ?>
                <small><?php echo $sub_page_title; ?></small>
            <?php endif; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/booking_history'); ?>"><?php echo ucwords('order_product'); ?></a></li>
            <li class="active"><?php echo $on_section . ' ' . $page_title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <?php echo form_open(); ?>
            <div class="box-body">
                <?php alert_message(); ?>

                <div class="form-group <?php echo form_error('order_number') ? 'has-error' : ''; ?>">
                    <label for="order_number">Order number</label>
                    <input type="text" name="order_number" id="order_number" class="form-control" placeholder="Enter Order Number" value="<?php echo isset($order_product) ? $order_product->order_number : set_value('order_number'); ?>" readonly>
                    <?php echo form_error('order_number', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('order_type') ? 'has-error' : ''; ?>">
                    <label for="order_type">Order type</label>
                    <select name="order_type" id="order_type" class="form-control" readonly>
                        <option value="">Choose</option>
                        <option value="1" <?php echo isset($order_product) ? set_select("order_type", '1', $order_product->order_type == '1' ? true : false)  : set_select("order_type", '1'); ?>>Product</option>
                        <option value="2" <?php echo isset($order_product) ? set_select("order_type", '2', $order_product->order_type == '2' ? true : false)  : set_select("order_type", '2'); ?>>Custom</option>
                    </select>
                    <?php echo form_error('order_type', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <!-- <div class="form-group <?php echo form_error('id_custom_product') ? 'has-error' : ''; ?>">
                    <label for="id_custom_product">Id custom product</label>
                    <input type="text" name="id_custom_product" id="id_custom_product" class="form-control" placeholder="Enter Id Custom Product" value="<?php echo isset($order_product) ? $order_product->id_custom_product : set_value('id_custom_product'); ?>">
                    <?php echo form_error('id_custom_product', '<p class="help-block text-red">', '</p>'); ?>
                </div> -->

                <div class="form-group <?php echo form_error('quantity') ? 'has-error' : ''; ?>">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Enter Quantity" value="<?php echo isset($order_product) ? $order_product->quantity : set_value('quantity'); ?>">
                    <?php echo form_error('quantity', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('sub_total') ? 'has-error' : ''; ?>">
                    <label for="sub_total">Sub total</label>
                    <input type="text" name="sub_total" id="sub_total" class="form-control" placeholder="Enter Sub Total" value="<?php echo isset($order_product) ? $order_product->sub_total : set_value('sub_total'); ?>">
                    <?php echo form_error('sub_total', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('base') ? 'has-error' : ''; ?>">
                    <label for="base">Base</label>
                    <input type="text" name="base" id="base" class="form-control" placeholder="Enter Base" value="<?php echo isset($order_product) ? $order_product->base : set_value('base'); ?>">
                    <?php echo form_error('base', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('option') ? 'has-error' : ''; ?>">
                    <label for="option">Option</label>
                    <input type="text" name="option" id="option" class="form-control" placeholder="Enter Option" value="<?php echo isset($order_product) ? $order_product->option : set_value('option'); ?>">
                    <?php echo form_error('option', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('delivery_cost') ? 'has-error' : ''; ?>">
                    <label for="delivery_cost">Delivery cost</label>
                    <input type="text" name="delivery_cost" id="delivery_cost" class="form-control" placeholder="Enter Delivery Cost" value="<?php echo isset($order_product) ? $order_product->delivery_cost : set_value('delivery_cost'); ?>">
                    <?php echo form_error('delivery_cost', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('tax') ? 'has-error' : ''; ?>">
                    <label for="tax">Tax</label>
                    <input type="text" name="tax" id="tax" class="form-control" placeholder="Enter Tax" value="<?php echo isset($order_product) ? $order_product->tax : set_value('tax'); ?>">
                    <?php echo form_error('tax', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('total') ? 'has-error' : ''; ?>">
                    <label for="total">Total</label>
                    <input type="text" name="total" id="total" class="form-control" placeholder="Enter Total" value="<?php echo isset($order_product) ? $order_product->total : set_value('total'); ?>">
                    <?php echo form_error('total', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('arrival_date') ? 'has-error' : ''; ?>">
                    <label for="arrival_date">Arrival date</label>
                    <input name="arrival_date" id="arrival_date" class="form-control datepicker" placeholder="Enter Arrival Date" value="<?php echo isset($order_product) ? $order_product->arrival_date : set_value('arrival_date'); ?>">
                    <?php echo form_error('arrival_date', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('status') ? 'has-error' : ''; ?>">
                    <label for="status">Status</label>
                    <input name="status" id="status" class="form-control datepicker" placeholder="Enter Status" value="<?php echo isset($order_product) ? $order_product->status : set_value('status'); ?>">
                    <?php echo form_error('status', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
