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
            <li class="active">Configuration</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <?php echo form_open(); ?>
            <div class="box-body">

                <?php alert_message(); ?>

                <div class="form-group <?php echo form_error('notification_email') ? 'has-error' : ''; ?>">
                    <label for="notification_email">Order Notification Email</label>
                    <input type="text" name="notification_email" id="notification_email" class="form-control" placeholder="Order notification email.." value="<?php echo isset($configs->order_notification_email) ? $configs->order_notification_email : ''; ?>">
                    <?php echo form_error('notification_email', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- End box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section><!-- End content -->
</div><!-- End content-wrapper -->