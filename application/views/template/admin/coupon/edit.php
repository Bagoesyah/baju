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
            <li><a href="<?php echo site_url('admin/promo'); ?>"><?php echo ucwords('promo'); ?></a></li>
            <li class="active"><?php echo $on_section . ' ' . $page_title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <?php echo form_open_multipart(); ?>
            <div class="box-body">
                <?php alert_message(); ?>

                <div class="form-group <?php echo form_error('code') ? 'has-error' : ''; ?>">
                    <label for="code">Coupon Code</label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Coupon code.." value="<?php echo isset($coupon) ? $coupon->code : set_value('code'); ?>">
                    <?php echo form_error('code', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('discount') ? 'has-error' : ''; ?>">
                    <label for="discount">Discount Value</label>
                    <input type="number" name="discount" id="discount" class="form-control" placeholder="Ex: 100" value="<?php echo isset($coupon) ? $coupon->discount : set_value('discount'); ?>">
                    <?php echo form_error('discount', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('num_type') ? 'has-error' : ''; ?>">
                    <label for="num_type">Type Value</label>
                    <select name="num_type" id="num_type" class="form-control">
                        <option value="">Choose</option>
                        <option value="p" <?php echo isset($coupon) ? set_select("num_type", 'p', $coupon->num_type == 'p' ? true : false)  : set_select("num_type", 'p'); ?>>Percentage</option>
                        <option value="v" <?php echo isset($coupon) ? set_select("num_type", 'v', $coupon->num_type == 'v' ? true : false)  : set_select("num_type", 'v'); ?>>Value</option>
                    </select>
                    <?php echo form_error('num_type', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('exp_date') ? 'has-error' : ''; ?>">
                    <label for="title">Expire Date</label>
                    <input type="text" name="exp_date" id="exp_date" class="form-control datepicker" value="<?php echo isset($coupon) ? date('d/m/Y', strtotime($coupon->expired_at)) : set_value('exp_date'); ?>">
                    <?php echo form_error('exp_date', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('status') ? 'has-error' : ''; ?>">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option <?php echo isset($coupon) ? set_select("status", 1, $coupon->status == 1 ? true : false)  : set_select("status", 1); ?> value="1">Publish</option>
                        <option <?php echo isset($coupon) ? set_select("status", 0, $coupon->status == 0 ? true : false)  : set_select("status", 0); ?> value="0">Draft</option>
                    </select>
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

<script>
$(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
})
</script>