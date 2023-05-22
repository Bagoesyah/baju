<?php
/**
 * User: Awan Tengah
 */
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
            <li><a href="<?php echo site_url('admin/menu'); ?>"><?php echo ucwords('menu'); ?></a></li>
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
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title"
                           value="<?php echo isset($menu) ? $menu->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('id_parent') ? 'has-error' : ''; ?>">
                    <label for="id_parent">Parent</label>
                    <select name="id_parent" id="id_parent" class="form-control">
                        <option value="0">Main Menu</option>
                        <?php foreach ($parent as $row): ?>
                            <option
                                value="<?php echo $row->id; ?>" <?php echo isset($menu->id_parent) != 0 ? set_select("id_parent", $row->id, $row->id == $menu->id_parent ? true : false) : set_select("id_parent", 0); ?>><?php echo $row->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_parent', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('controller') ? 'has-error' : ''; ?>">
                    <label for="controller">Controller</label>
                    <input type="text" name="controller" id="controller" class="form-control"
                           placeholder="Enter Controller"
                           value="<?php echo isset($menu) ? $menu->controller : set_value('controller'); ?>">
                    <?php echo form_error('controller', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('url') ? 'has-error' : ''; ?>">
                    <label for="url">Url</label>
                    <input type="text" name="url" id="url" class="form-control"
                           placeholder="Enter Url"
                           value="<?php echo isset($menu) ? $menu->url : set_value('url'); ?>">
                    <?php echo form_error('url', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('order') ? 'has-error' : ''; ?>">
                    <label for="order">Order</label>
                    <input type="text" name="order" id="order" class="form-control" placeholder="Enter Order"
                           value="<?php echo isset($menu) ? $menu->order : 0; ?>">
                    <?php echo form_error('order', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('icon') ? 'has-error' : ''; ?>">
                    <label for="icon">Icon</label>
                    <input type="text" name="icon" id="icon" class="form-control" placeholder="Enter Icon"
                           value="<?php echo isset($menu) ? $menu->icon : set_value('icon'); ?>">
                    <?php echo form_error('icon', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->