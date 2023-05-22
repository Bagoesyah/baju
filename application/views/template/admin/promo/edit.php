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
            <li><a href="<?php echo site_url('admin/promo'); ?>"><?php echo ucwords('promo'); ?></a></li>
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

                <?php if(isset($promo)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($promo->image) ? base_url(path_image('promo_path') . $promo->image) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $promo->promo_name; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('image') ? 'has-error' : ''; ?>">
                    <label for="image">Banner Promo</label>
                    <input type="file" name="image" id="image" class="form-control" placeholder="Enter Header Image" value="<?php echo isset($promo) ? $promo->image : set_value('image'); ?>">
                    <?php echo form_error('image', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('promo_name') ? 'has-error' : ''; ?>">
                    <label for="title">Name</label>
                    <input type="text" name="promo_name" id="promo_name" class="form-control" placeholder="Enter Name" value="<?php echo isset($promo) ? $promo->promo_name : set_value('promo_name'); ?>">
                    <?php echo form_error('promo_name', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('type_promo') ? 'has-error' : ''; ?>">
                    <label for="type_promo">Type Promo</label>
                    <select name="type_promo" id="type_promo" class="form-control">
                        <option value="">Choose</option>
                        <?php foreach($type_promo as $row): ?>
                            <option value="<?php echo $row->id; ?>" <?php echo isset($promo) ? set_select("id", $row->id, $promo->type_promo == $row->id ? true : false)  : set_select("id", $row->id); ?>><?php echo $row->type_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('type_promo', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('value') ? 'has-error' : ''; ?>">
                    <label for="title">Promo Value</label>
                    <input type="number" name="value" id="value" class="form-control" placeholder="Ex: 100" value="<?php echo isset($promo) ? $promo->value : set_value('value'); ?>">
                    <?php echo form_error('value', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('exp_date') ? 'has-error' : ''; ?>">
                    <label for="title">Expire Date</label>
                    <input type="text" name="exp_date" id="exp_date" class="form-control datepicker" value="<?php echo isset($promo) ? date('d/m/Y', strtotime($promo->expired_at)) : set_value('exp_date'); ?>">
                    <?php echo form_error('exp_date', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('status') ? 'has-error' : ''; ?>">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option <?php echo isset($promo) ? set_select("status", 1, $promo->status == 1 ? true : false)  : set_select("status", 1); ?> value="1">Publish</option>
                        <option <?php echo isset($promo) ? set_select("status", 0, $promo->status == 0 ? true : false)  : set_select("status", 0); ?> value="0">Draft</option>
                    </select>
                    <?php echo form_error('status', '<p class="help-block text-red">', '</p>'); ?>
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
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
})
</script>
