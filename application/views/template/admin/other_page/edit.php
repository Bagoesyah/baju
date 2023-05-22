<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-21T16:47:27+07:00
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
            <li><a href="<?php echo site_url('admin/other_page'); ?>"><?php echo ucwords('other_page'); ?></a></li>
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

                <?php if(isset($other_page)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($other_page->header_image) ? base_url(path_image('other_page_path') . $other_page->header_image) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $other_page->title; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('header_image') ? 'has-error' : ''; ?>">
                    <label for="header_image">Header image</label>
                    <input type="file" name="header_image" id="header_image" class="form-control" placeholder="Enter Header Image" value="<?php echo isset($other_page) ? $other_page->header_image : set_value('header_image'); ?>">
                    <?php echo form_error('header_image', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($other_page) ? $other_page->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('content') ? 'has-error' : ''; ?>">
                    <label for="ckeditor">Content</label>
                    <textarea name="content" id="ckeditor" class="form-control" placeholder="Enter Content">
                        <?php echo isset($other_page) ? $other_page->content : set_value('content'); ?>
                    </textarea>
                    <?php echo form_error('content', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
