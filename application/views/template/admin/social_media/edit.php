<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-21T08:53:04+07:00
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
            <li><a href="<?php echo site_url('admin/social_media'); ?>"><?php echo ucwords('social media'); ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <?php echo form_open(); ?>
            <div class="box-body">
                <?php alert_message(); ?>

                <div class="form-group <?php echo form_error('facebook') ? 'has-error' : ''; ?>">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Enter Facebook" value="<?php echo isset($social_media) ? $social_media->facebook : set_value('facebook'); ?>">
                    <?php echo form_error('facebook', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('twitter') ? 'has-error' : ''; ?>">
                    <label for="twitter">Twitter</label>
                    <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Enter Twitter" value="<?php echo isset($social_media) ? $social_media->twitter : set_value('twitter'); ?>">
                    <?php echo form_error('twitter', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('pinterest') ? 'has-error' : ''; ?>">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" name="pinterest" id="pinterest" class="form-control" placeholder="Enter Pinterest" value="<?php echo isset($social_media) ? $social_media->pinterest : set_value('pinterest'); ?>">
                    <?php echo form_error('pinterest', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('instagram') ? 'has-error' : ''; ?>">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Enter Instagram" value="<?php echo isset($social_media) ? $social_media->instagram : set_value('instagram'); ?>">
                    <?php echo form_error('instagram', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('linkedin') ? 'has-error' : ''; ?>">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" name="linkedin" id="linkedin" class="form-control" placeholder="Enter Linkedin" value="<?php echo isset($social_media) ? $social_media->linkedin : set_value('linkedin'); ?>">
                    <?php echo form_error('linkedin', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('google_plus') ? 'has-error' : ''; ?>">
                    <label for="google_plus">Google plus</label>
                    <input type="text" name="google_plus" id="google_plus" class="form-control" placeholder="Enter Google Plus" value="<?php echo isset($social_media) ? $social_media->google_plus : set_value('google_plus'); ?>">
                    <?php echo form_error('google_plus', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
