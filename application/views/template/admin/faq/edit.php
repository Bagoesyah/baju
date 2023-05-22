<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-20T14:00:01+07:00
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
            <li><a href="<?php echo site_url('admin/faq'); ?>"><?php echo ucwords('faq'); ?></a></li>
            <li class="active"><?php echo $page_title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <?php echo form_open(); ?>
            <div class="box-body">
                <?php alert_message(); ?>

                <div class="form-group <?php echo form_error('question') ? 'has-error' : ''; ?>">
                    <label for="question">Question</label>
                    <input type="text" name="question" id="question" class="form-control" placeholder="Enter Question" value="<?php echo isset($faq) ? $faq->question : set_value('question'); ?>">
                    <?php echo form_error('question', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('answer') ? 'has-error' : ''; ?>">
                    <label for="ckeditor">Answer</label>
                    <textarea name="answer" id="ckeditor" class="form-control" placeholder="Enter Answer">
                        <?php echo isset($faq) ? $faq->answer : set_value('answer'); ?>
                    </textarea>
                    <?php echo form_error('answer', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
