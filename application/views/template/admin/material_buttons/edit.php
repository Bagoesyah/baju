<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T19:44:21+07:00
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
            <li><a href="<?php echo site_url('admin/material-buttons'); ?>"><?php echo ucwords('buttons'); ?></a></li>
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
                        <option value="1" <?php echo isset($material_buttons) ? set_select("category", '1', $material_buttons->category == '1' ? true : false)  : set_select("category", '1'); ?>>Button</option>
                        <option value="2" <?php echo isset($material_buttons) ? set_select("category", '2', $material_buttons->category == '2' ? true : false)  : set_select("category", '2'); ?>>Button Hole</option>
                        <option value="3" <?php echo isset($material_buttons) ? set_select("category", '3', $material_buttons->category == '3' ? true : false)  : set_select("category", '3'); ?>>Button Thread</option>
                    </select>
                    <?php echo form_error('category', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($material_buttons) ? $material_buttons->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('price') ? 'has-error' : ''; ?>">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?php echo isset($material_buttons) ? $material_buttons->price : set_value('price'); ?>">
                    <?php echo form_error('price', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_buttons)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($material_buttons->image) ? base_url(path_image('material_buttons_path') . $material_buttons->image) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $material_buttons->title; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('image') ? 'has-error' : ''; ?>">
                    <label for="image">Image (177 x 177)px</label>
                    <input type="file" name="image" id="image" class="form-control" placeholder="Enter Image" value="<?php echo isset($material_buttons) ? $material_buttons->image : set_value('image'); ?>">
                    <?php echo form_error('image', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_buttons)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($material_buttons->texture) ? base_url(path_image('material_buttons_path') . $material_buttons->texture) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $material_buttons->title; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('texture') ? 'has-error' : ''; ?>">
                    <label for="image">Texture (177 x 177)px</label>
                    <input type="file" name="texture" id="texture" class="form-control" placeholder="Enter Image" value="<?php echo isset($material_buttons) ? $material_buttons->texture : set_value('texture'); ?>">
                    <?php echo form_error('texture', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('stock') ? 'has-error' : ''; ?>">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" id="stock" class="form-control" placeholder="Enter Stock" value="<?php echo isset($material_buttons) ? $material_buttons->stock : set_value('stock'); ?>">
                    <?php echo form_error('stock', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('need_stock_for_custom') ? 'has-error' : ''; ?>">
                    <label for="need_stock_for_custom">Need Stock For Custom</label>
                    <input type="text" name="need_stock_for_custom" id="need_stock_for_custom" class="form-control" placeholder="Enter Need Stock For Custom" value="<?php echo isset($material_buttons) ? $material_buttons->need_stock_for_custom : set_value('need_stock_for_custom'); ?>">
                    <?php echo form_error('need_stock_for_custom', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('is_default') ? 'has-error' : ''; ?>">
                    <label for="is_default">Set As Default</label><br />
                    <input type="checkbox" name="is_default" id="is_default" value="1" <?php echo isset($material_buttons) && $material_buttons->is_default == 1 ? 'checked="checked"' : set_checkbox('is_default', 1); ?>>
                    <?php echo form_error('is_default', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('xform') ? 'has-error' : ''; ?>">
                    <label for="xform">Form</label><br />
                    <select name="xform" class="form-control">
                        <option value="green" <?php echo isset($material_buttons) && $material_buttons->xform == 'green' ? 'selected="selected"' : ''; ?>>Green</option>
                        <option value="blue" <?php echo isset($material_buttons) && $material_buttons->xform == 'blue' ? 'selected="selected"' : ''; ?>>Blue</option>
                    </select>
                    <?php echo form_error('xform', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('most_pick') ? 'has-error' : ''; ?>">
                    <label for="most_pick">Most Pick</label><br />
                    <input type="checkbox" name="most_pick" id="most_pick" value="1" <?php echo isset($material_buttons) && $material_buttons->most_pick == 1 ? 'checked="checked"' : set_checkbox('most_pick', 1); ?>>
                    <?php echo form_error('most_pick', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('additional_charge') ? 'has-error' : ''; ?>">
                    <label for="additional_charge">Additional Charge</label><br />
                    <input type="checkbox" name="additional_charge" id="additional_charge" value="1" <?php echo isset($material_buttons) && $material_buttons->additional_charge == 1 ? 'checked="checked"' : set_checkbox('additional_charge', 1); ?>>
                    <?php echo form_error('additional_charge', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
