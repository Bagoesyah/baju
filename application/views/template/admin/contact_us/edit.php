<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-22T21:17:45+07:00
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
            <li><a href="<?php echo site_url('admin/contact_us'); ?>"><?php echo ucwords('contact_us'); ?></a></li>
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

                <div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" value="<?php echo isset($contact_us) ? $contact_us->email : set_value('email'); ?>">
                    <?php echo form_error('email', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('message') ? 'has-error' : ''; ?>">
                    <label for="ckeditor">Message</label>
                    <textarea name="message" id="ckeditor" class="form-control" placeholder="Enter Message">
                        <?php echo isset($contact_us) ? $contact_us->message : set_value('message'); ?>
                    </textarea>
                    <?php echo form_error('message', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
