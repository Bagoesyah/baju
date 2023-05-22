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
            <li class="active"><?php echo $on_section . ' ' . $page_title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box">
            <?php alert_message(); ?>
            <?php echo form_open(); ?>
            <div class="box-header">
                <div class="form-group <?php echo form_error('id_level') ? 'has-error' : ''; ?>">
                    <label for="id_level">level</label>
                    <select name="id_level" id="id_level" class="form-control" onchange="show_list_menu(this.value);" required>
                        <option value="">Choose</option>
                        <?php foreach ($level as $row): ?>
                            <option value="<?php echo $row->id; ?>"><?php echo $row->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_level', '<p class="help-block text-red">', '</p>'); ?>
                </div>
            </div>
            <div class="box-body">
                <div id="list-menu"></div>
            </div>
            <div class="box-footer">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    function show_list_menu(val) {
        $.get("<?php echo base_url('admin/privilege/lists'); ?>" + "/" + val, function (data) {
            $("#list-menu").html(data);
        });
    }
</script>