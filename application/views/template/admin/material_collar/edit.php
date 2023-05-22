<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T19:09:48+07:00
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
            <li><a href="<?php echo site_url('admin/material-collar'); ?>"><?php echo ucwords('collar'); ?></a></li>
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

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($material_collar) ? $material_collar->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('price') ? 'has-error' : ''; ?>">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?php echo isset($material_collar) ? $material_collar->price : set_value('price'); ?>">
                    <?php echo form_error('price', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($material_collar->image) ? base_url(path_image('material_collar_path') . $material_collar->image) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $material_collar->title; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('image') ? 'has-error' : ''; ?>">
                    <label for="image">Image (176 x 176)px</label>
                    <input type="file" name="image" id="image" class="form-control" placeholder="Enter Image" value="<?php echo isset($material_collar) ? $material_collar->image : set_value('image'); ?>">
                    <?php echo form_error('image', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar) && !empty($material_collar->object)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_collar->object; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('object') ? 'has-error' : ''; ?>">
                    <label for="image">Object</label>
                    <input type="file" name="object" id="object" class="form-control" value="<?php echo isset($material_collar) ? $material_collar->object : set_value('object'); ?>">
                    <?php echo form_error('object', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar) && !empty($material_collar->mtl)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_collar->mtl; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('mtl') ? 'has-error' : ''; ?>">
                    <label for="image">MTL File</label>
                    <input type="file" name="mtl" id="mtl" class="form-control" value="<?php echo isset($material_collar) ? $material_collar->mtl : set_value('mtl'); ?>">
                    <?php echo form_error('mtl', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar) && !empty($material_collar->button_obj)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_collar->button_obj; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('button_obj') ? 'has-error' : ''; ?>">
                    <label for="image">Button Object</label>
                    <input type="file" name="button_obj" id="button_obj" class="form-control" value="<?php echo isset($material_collar) ? $material_collar->button_obj : set_value('button_obj'); ?>">
                    <?php echo form_error('button_obj', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('remove_button') ? 'has-error' : ''; ?>">
                    <label for="remove_button">Remove Button</label><br />
                    <input type="checkbox" name="remove_button" id="remove_button" value="1">
                    <?php echo form_error('remove_button', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar) && !empty($material_collar->button_mtl)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_collar->button_mtl; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('button_mtl') ? 'has-error' : ''; ?>">
                    <label for="image">Button MTL</label>
                    <input type="file" name="button_mtl" id="button_mtl" class="form-control" value="<?php echo isset($material_collar) ? $material_collar->button_mtl : set_value('button_mtl'); ?>">
                    <?php echo form_error('button_mtl', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar) && !empty($material_collar->button_hole_obj)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_collar->button_hole_obj; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('button_hole_obj') ? 'has-error' : ''; ?>">
                    <label for="image">Button Hole Object</label>
                    <input type="file" name="button_hole_obj" id="button_hole_obj" class="form-control" value="<?php echo isset($material_collar) ? $material_collar->button_hole_obj : set_value('button_hole_obj'); ?>">
                    <?php echo form_error('button_hole_obj', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('remove_button_hole') ? 'has-error' : ''; ?>">
                    <label for="remove_button_hole">Remove Button Hole</label><br />
                    <input type="checkbox" name="remove_button_hole" id="remove_button_hole" value="1">
                    <?php echo form_error('remove_button_hole', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar) && !empty($material_collar->button_hole_mtl)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_collar->button_hole_mtl; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('button_hole_mtl') ? 'has-error' : ''; ?>">
                    <label for="image">Button Hole MTL</label>
                    <input type="file" name="button_hole_mtl" id="button_hole_mtl" class="form-control" value="<?php echo isset($material_collar) ? $material_collar->button_hole_mtl : set_value('button_hole_mtl'); ?>">
                    <?php echo form_error('button_hole_mtl', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar) && !empty($material_collar->button_thread_obj)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_collar->button_thread_obj; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('button_thread_obj') ? 'has-error' : ''; ?>">
                    <label for="image">Button Thread Object</label>
                    <input type="file" name="button_thread_obj" id="button_thread_obj" class="form-control" value="<?php echo isset($material_collar) ? $material_collar->button_thread_obj : set_value('button_thread_obj'); ?>">
                    <?php echo form_error('button_thread_obj', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('remove_button_thread') ? 'has-error' : ''; ?>">
                    <label for="remove_button_thread">Remove Button Thread</label><br />
                    <input type="checkbox" name="remove_button_thread" id="remove_button_thread" value="1">
                    <?php echo form_error('remove_button_thread', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar) && !empty($material_collar->button_thread_mtl)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_collar->button_thread_mtl; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('button_thread_mtl') ? 'has-error' : ''; ?>">
                    <label for="image">Button Thread MTL</label>
                    <input type="file" name="button_thread_mtl" id="button_thread_mtl" class="form-control" value="<?php echo isset($material_collar) ? $material_collar->button_thread_mtl : set_value('button_thread_mtl'); ?>">
                    <?php echo form_error('button_thread_mtl', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('remove_inner_collar') ? 'has-error' : ''; ?>">
                    <label for="remove_inner_collar">Remove Inner Collar</label><br />
                    <input type="checkbox" name="remove_inner_collar" id="remove_inner_collar" value="1">
                    <?php echo form_error('remove_inner_collar', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_collar) && !empty($material_collar->inner_collar_obj)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_collar->inner_collar_obj; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('inner_collar_obj') ? 'has-error' : ''; ?>">
                    <label for="image">Inner Collar Object</label>
                    <input type="file" name="inner_collar_obj" id="inner_collar_obj" class="form-control" value="<?php echo isset($material_collar) ? $material_collar->inner_collar_obj : set_value('inner_collar_obj'); ?>">
                    <?php echo form_error('inner_collar_obj', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('stock') ? 'has-error' : ''; ?>">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" id="stock" class="form-control" placeholder="Enter Stock" value="<?php echo isset($material_collar) ? $material_collar->stock : set_value('stock'); ?>">
                    <?php echo form_error('stock', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('need_stock_for_custom') ? 'has-error' : ''; ?>">
                    <label for="need_stock_for_custom">Need Stock For Custom</label>
                    <input type="text" name="need_stock_for_custom" id="need_stock_for_custom" class="form-control" placeholder="Enter Need Stock For Custom" value="<?php echo isset($material_collar) ? $material_collar->need_stock_for_custom : set_value('need_stock_for_custom'); ?>">
                    <?php echo form_error('need_stock_for_custom', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('is_default') ? 'has-error' : ''; ?>">
                    <label for="is_default">Set As Default</label><br />
                    <input type="checkbox" name="is_default" id="is_default" value="1" <?php echo isset($material_collar) && $material_collar->is_default == 1 ? 'checked="checked"' : set_checkbox('is_default', 1); ?>>
                    <?php echo form_error('is_default', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('xform') ? 'has-error' : ''; ?>">
                    <label for="xform">Form</label><br />
                    <select name="xform" class="form-control">
                        <option value="green" <?php echo isset($material_collar) && $material_collar->xform == 'green' ? 'selected="selected"' : ''; ?>>Green</option>
                        <option value="blue" <?php echo isset($material_collar) && $material_collar->xform == 'blue' ? 'selected="selected"' : ''; ?>>Blue</option>
                    </select>
                    <?php echo form_error('xform', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('most_pick') ? 'has-error' : ''; ?>">
                    <label for="most_pick">Most Pick</label><br />
                    <input type="checkbox" name="most_pick" id="most_pick" value="1" <?php echo isset($material_collar) && $material_collar->most_pick == 1 ? 'checked="checked"' : set_checkbox('most_pick', 1); ?>>
                    <?php echo form_error('most_pick', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('additional_charge') ? 'has-error' : ''; ?>">
                    <label for="additional_charge">Additional Charge</label><br />
                    <input type="checkbox" name="additional_charge" id="additional_charge" value="1" <?php echo isset($material_collar) && $material_collar->additional_charge == 1 ? 'checked="checked"' : set_checkbox('additional_charge', 1); ?>>
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
