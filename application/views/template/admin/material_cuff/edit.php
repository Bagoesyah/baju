<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T19:17:59+07:00
?>

<?php
if (!isset($material_cuff) || (isset($material_cuff) && $material_cuff->category == 1)) {
?>
<style>
.is-long-sleeve{display:none;}
</style>
<?php
}
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
            <li><a href="<?php echo site_url('admin/material_cuff'); ?>"><?php echo ucwords('cuff'); ?></a></li>
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
                        <option value="1" <?php echo isset($material_cuff) ? set_select("category", '1', $material_cuff->category == '1' ? true : false)  : set_select("category", '1'); ?>>Cuff</option>
                        <option value="2" <?php echo isset($material_cuff) ? set_select("category", '2', $material_cuff->category == '2' ? true : false)  : set_select("category", '2'); ?>>Sleeve</option>
                    </select>
                    <?php echo form_error('category', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($material_cuff) ? $material_cuff->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('price') ? 'has-error' : ''; ?>">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?php echo isset($material_cuff) ? $material_cuff->price : set_value('price'); ?>">
                    <?php echo form_error('price', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_cuff)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($material_cuff->image) ? base_url(path_image('material_cuff_path') . $material_cuff->image) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $material_cuff->title; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('image') ? 'has-error' : ''; ?>">
                    <label for="image">Image (183 x 183)px</label>
                    <input type="file" name="image" id="image" class="form-control" placeholder="Enter Image" value="<?php echo isset($material_cuff) ? $material_cuff->image : set_value('image'); ?>">
                    <?php echo form_error('image', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_cuff) && !empty($material_cuff->object)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_cuff->object; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('object') ? 'has-error' : ''; ?>">
                    <label for="image">Object</label>
                    <input type="file" name="object" id="object" class="form-control" value="<?php echo isset($material_cuff) ? $material_cuff->object : set_value('object'); ?>">
                    <?php echo form_error('object', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($material_cuff) && !empty($material_cuff->mtl)): ?>
                    <div class="attachment-block clearfix">
                        <?php echo $material_cuff->mtl; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('mtl') ? 'has-error' : ''; ?>">
                    <label for="image">MTL File</label>
                    <input type="file" name="mtl" id="mtl" class="form-control" value="<?php echo isset($material_cuff) ? $material_cuff->mtl : set_value('mtl'); ?>">
                    <?php echo form_error('mtl', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('stock') ? 'has-error' : ''; ?>">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" id="stock" class="form-control" placeholder="Enter Stock" value="<?php echo isset($material_cuff) ? $material_cuff->stock : set_value('stock'); ?>">
                    <?php echo form_error('stock', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('need_stock_for_custom') ? 'has-error' : ''; ?>">
                    <label for="need_stock_for_custom">Need Stock For Custom</label>
                    <input type="text" name="need_stock_for_custom" id="need_stock_for_custom" class="form-control" placeholder="Enter Need Stock For Custom" value="<?php echo isset($material_cuff) ? $material_cuff->need_stock_for_custom : set_value('need_stock_for_custom'); ?>">
                    <?php echo form_error('need_stock_for_custom', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('is_default') ? 'has-error' : ''; ?>">
                    <label for="is_default">Set As Default</label><br />
                    <input type="checkbox" name="is_default" id="is_default" value="1" <?php echo isset($material_cuff) && $material_cuff->is_default == 1 ? 'checked="checked"' : set_checkbox('is_default', 1); ?>>
                    <?php echo form_error('is_default', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group is-long-sleeve <?php echo form_error('is_long_sleeve') ? 'has-error' : ''; ?>">
                    <label for="is_long_sleeve">Long Sleeve</label><br />
                    <input type="checkbox" name="is_long_sleeve" id="is_long_sleeve" value="1" <?php echo isset($material_cuff) && $material_cuff->is_long_sleeve == 1 ? 'checked="checked"' : set_checkbox('is_default', 1); ?>>
                    <?php echo form_error('is_long_sleeve', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('xform') ? 'has-error' : ''; ?>">
                    <label for="xform">Form</label><br />
                    <select name="xform" class="form-control">
                        <option value="green" <?php echo isset($material_cuff) && $material_cuff->xform == 'green' ? 'selected="selected"' : ''; ?>>Green</option>
                        <option value="blue" <?php echo isset($material_cuff) && $material_cuff->xform == 'blue' ? 'selected="selected"' : ''; ?>>Blue</option>
                    </select>
                    <?php echo form_error('xform', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('most_pick') ? 'has-error' : ''; ?>">
                    <label for="most_pick">Most Pick</label><br />
                    <input type="checkbox" name="most_pick" id="most_pick" value="1" <?php echo isset($material_cuff) && $material_cuff->most_pick == 1 ? 'checked="checked"' : set_checkbox('most_pick', 1); ?>>
                    <?php echo form_error('most_pick', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('additional_charge') ? 'has-error' : ''; ?>">
                    <label for="additional_charge">Additional Charge</label><br />
                    <input type="checkbox" name="additional_charge" id="additional_charge" value="1" <?php echo isset($material_cuff) && $material_cuff->additional_charge == 1 ? 'checked="checked"' : set_checkbox('additional_charge', 1); ?>>
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

<script>
$(function() {
    $('#category').change(function() {
        if ($(this).val() == 2) {
            $('.is-long-sleeve').slideDown();
        } else {
            $('.is-long-sleeve').slideUp();
        }
    });
})
</script>
