<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-22T21:20:58+07:00
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
            <li><a href="<?php echo site_url('admin/payment_list'); ?>"><?php echo ucwords('payment_list'); ?></a></li>
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
                
                                        <div class="form-group <?php echo form_error('bank_name') ? 'has-error' : ''; ?>">
                                            <label for="bank_name">Bank name</label>
                                            <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Enter Bank Name" value="<?php echo isset($payment_list) ? $payment_list->bank_name : set_value('bank_name'); ?>">
                                            <?php echo form_error('bank_name', '<p class="help-block text-red">', '</p>'); ?>
                                        </div>

                                        <div class="form-group <?php echo form_error('account_name') ? 'has-error' : ''; ?>">
                                            <label for="account_name">Account name</label>
                                            <input type="text" name="account_name" id="account_name" class="form-control" placeholder="Enter Account Name" value="<?php echo isset($payment_list) ? $payment_list->account_name : set_value('account_name'); ?>">
                                            <?php echo form_error('account_name', '<p class="help-block text-red">', '</p>'); ?>
                                        </div>

                                        <div class="form-group <?php echo form_error('no_rek') ? 'has-error' : ''; ?>">
                                            <label for="no_rek">No rek</label>
                                            <input type="text" name="no_rek" id="no_rek" class="form-control" placeholder="Enter No Rek" value="<?php echo isset($payment_list) ? $payment_list->no_rek : set_value('no_rek'); ?>">
                                            <?php echo form_error('no_rek', '<p class="help-block text-red">', '</p>'); ?>
                                        </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
