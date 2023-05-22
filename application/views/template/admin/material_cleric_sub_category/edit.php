<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-24T15:58:37+07:00
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
            <li><a href="<?php echo site_url('admin/material_cleric_sub_category'); ?>"><?php echo ucwords('material_cleric_sub_category'); ?></a></li>
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

                <div class="form-group <?php echo form_error('id_category') ? 'has-error' : ''; ?>">
                    <label for="id_category">Category</label>
                    <select name="id_category" id="id_category" class="form-control">
                        <option value="">Choose</option>
                        <?php foreach($material_cleric_category as $row): ?>
                            <option value="<?php echo $row->id; ?>" <?php echo isset($material_cleric_sub_category) ? set_select("id_category", $row->id, $material_cleric_sub_category->id_category == $row->id ? true : false)  : set_select("id_category", $row->id); ?>><?php echo $row->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_category', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($material_cleric_sub_category) ? $material_cleric_sub_category->title : set_value('title'); ?>">
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
