<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-24T00:28:45+07:00
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
            <li><a href="<?php echo site_url('admin/material-fabric'); ?>"><?php echo ucwords('fabric'); ?></a></li>
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

                <div class="form-group <?php echo form_error('category') ? 'has-error' : ''; ?>">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Choose</option>
                        <option value="1" <?php echo isset($material_fabric) ? set_select("category", '1', $material_fabric->category == '1' ? true : false)  : set_select("category", '1'); ?>>Standard</option>
                        <option value="2" <?php echo isset($material_fabric) ? set_select("category", '2', $material_fabric->category == '2' ? true : false)  : set_select("category", '2'); ?>>Premium</option>
                        <option value="3" <?php echo isset($material_fabric) ? set_select("category", '3', $material_fabric->category == '3' ? true : false)  : set_select("category", '3'); ?>>Super Premium</option>
                    </select>
                    <?php echo form_error('category', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('code_fabric') ? 'has-error' : ''; ?>">
                    <label for="code_fabric">Code fabric</label>
                    <input type="text" name="code_fabric" id="code_fabric" class="form-control" placeholder="Enter Code Fabric" value="<?php echo isset($material_fabric) ? $material_fabric->code_fabric : set_value('code_fabric'); ?>">
                    <?php echo form_error('code_fabric', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($material_fabric) ? $material_fabric->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('color_pattern') ? 'has-error' : ''; ?>">
                    <label for="color_pattern">Color and Pattern</label>
                    <input type="text" name="color_pattern" id="color_pattern" class="form-control" placeholder="Enter Color and Pattern" value="<?php echo isset($material_fabric) ? $material_fabric->color_pattern : set_value('color_pattern'); ?>">
                    <?php echo form_error('color_pattern', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('mixing_ratio') ? 'has-error' : ''; ?>">
                    <label for="mixing_ratio">Mixing ratio</label>
                    <input type="text" name="mixing_ratio" id="mixing_ratio" class="form-control" placeholder="Enter Mixing Ratio" value="<?php echo isset($material_fabric) ? $material_fabric->mixing_ratio : set_value('mixing_ratio'); ?>">
                    <?php echo form_error('mixing_ratio', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('origin') ? 'has-error' : ''; ?>">
                    <label for="origin">Origin</label>
                    <input type="text" name="origin" id="origin" class="form-control" placeholder="Enter Origin" value="<?php echo isset($material_fabric) ? $material_fabric->origin : set_value('origin'); ?>">
                    <?php echo form_error('origin', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('price') ? 'has-error' : ''; ?>">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?php echo isset($material_fabric) ? $material_fabric->price : set_value('price'); ?>">
                    <?php echo form_error('price', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('stock') ? 'has-error' : ''; ?>">
                    <label for="stock">Stock (dalam meter)</label>
                    <input type="text" name="stock" id="stock" class="form-control" placeholder="Enter Stock" value="<?php echo isset($material_fabric) ? $material_fabric->stock : set_value('stock'); ?>">
                    <?php echo form_error('stock', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_fabric)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($material_fabric->thumb) ? base_url(path_image('material_fabric_path') . $material_fabric->thumb) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $material_fabric->title; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('image') ? 'has-error' : ''; ?>">
                    <label for="image">Image (100 x 100)px</label>
                    <input type="file" name="image" id="image" class="form-control" placeholder="Enter Image" value="<?php echo isset($material_fabric) ? $material_fabric->image : set_value('image'); ?>">
                    <?php echo form_error('image', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
