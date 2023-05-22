<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:33:51+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T16:52:27+07:00
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
            <li><a href="<?php echo site_url('admin/product_category'); ?>"><?php echo ucwords('product_category'); ?></a></li>
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

                                        <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($product_category) ? $product_category->title : set_value('title'); ?>">
                                            <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                                        </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
