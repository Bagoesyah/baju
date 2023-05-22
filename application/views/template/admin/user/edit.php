<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:48+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-22T21:31:00+07:00
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
            <li><a href="<?php echo site_url('admin/user'); ?>"><?php echo ucwords('user'); ?></a></li>
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

                <div class="form-group <?php echo form_error('id_user_category') ? 'has-error' : ''; ?>">
                    <label for="id_user_category">User Category</label>
                    <select name="id_user_category" id="id_user_category" class="form-control">
                        <option value="">Choose</option>
                        <?php foreach ($user_category as $row): ?>
                            <option value="<?php echo $row->id; ?>" <?php echo isset($user_category) ? (isset($user) ? set_select("id_user_category", $row->id, $user->id_user_category == $row->id ? true : false) : '') : set_select("id_user_category", $row->id); ?>><?php echo $row->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_level', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('name') ? 'has-error' : ''; ?>">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"
                           value="<?php echo isset($user) ? $user->name : set_value('name'); ?>">
                    <?php echo form_error('name', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email"
                           value="<?php echo isset($user) ? $user->email : set_value('email'); ?>">
                    <?php echo form_error('email', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('password') ? 'has-error' : ''; ?>">
                    <label for="password">Password (Leave blank if password not changed)</label>
                    <input type="password" name="password" id="password" class="form-control"
                           placeholder="Enter Password">
                    <?php echo form_error('password', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('passconf') ? 'has-error' : ''; ?>">
                    <label for="passconf">Password Confirmation (Leave blank if password not changed)</label>
                    <input type="password" name="passconf" id="passconf" class="form-control"
                           placeholder="Enter Password Confirmation">
                    <?php echo form_error('passconf', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('id_level') ? 'has-error' : ''; ?>">
                    <label for="id_level">level</label>
                    <select name="id_level" id="id_level" class="form-control">
                        <option value="">Choose</option>
                        <?php foreach ($level as $row): ?>
                            <option
                                value="<?php echo $row->id; ?>" <?php echo isset($level) ? (isset($user) ? set_select("id_level", $row->id, $user->id_level == $row->id ? true : false) : '') : set_select("id_level", $row->id); ?>><?php echo $row->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_level', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('status') ? 'has-error' : ''; ?>">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Choose</option>
                        <option value="1" <?php echo isset($user) ? set_select("status", '1', $user->status == '1' ? true : false)  : set_select("status", '1'); ?>>Active</option>
                        <option value="2" <?php echo isset($user) ? set_select("status", '2', $user->status == '2' ? true : false)  : set_select("status", '2'); ?>>Non Active</option>
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
