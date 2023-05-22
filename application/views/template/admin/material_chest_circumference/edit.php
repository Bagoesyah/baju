<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-28T14:45:50+07:00
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
            <li><a href="<?php echo site_url('admin/material_chest_circumference'); ?>"><?php echo ucwords('material_chest_circumference'); ?></a></li>
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

                <div class="form-group <?php echo form_error('category') ? 'has-error' : ''; ?>">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Choose</option>
                        <option value="1" <?php echo isset($material_chest_circumference) ? set_select("category", '1', $material_chest_circumference->category == '1' ? true : false)  : set_select("category", '1'); ?>>Dimensions</option>
                        <option value="2" <?php echo isset($material_chest_circumference) ? set_select("category", '2', $material_chest_circumference->category == '2' ? true : false)  : set_select("category", '2'); ?>>Correction</option>
                        <option value="3" <?php echo isset($material_chest_circumference) ? set_select("category", '3', $material_chest_circumference->category == '3' ? true : false)  : set_select("category", '3'); ?>>Product up dimension</option>
                    </select>
                    <?php echo form_error('category', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($material_chest_circumference) ? $material_chest_circumference->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('price') ? 'has-error' : ''; ?>">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?php echo isset($material_chest_circumference) ? $material_chest_circumference->price : set_value('price'); ?>">
                    <?php echo form_error('price', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
