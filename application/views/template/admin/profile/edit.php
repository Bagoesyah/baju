<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:48+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T16:08:54+07:00
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
            <li><a href="<?php echo site_url('admin/profile'); ?>">Profile</a></li>
            <li class="active"><?php echo $on_section . ' ' . $page_title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <?php alert_message(); ?>
            <?php echo form_open_multipart(); ?>
            <div class="box-body">

                <div class="form-group <?php echo form_error('name') ? 'has-error' : ''; ?>">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"
                           value="<?php echo isset($user) ? $user->name : set_value('name'); ?>">
                    <?php echo form_error('name', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('password') ? 'has-error' : ''; ?>">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                           placeholder="Enter Password"
                           value="<?php echo isset($user) ? $user->password : set_value('password'); ?>">
                    <?php echo form_error('password', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control"
                           placeholder="Enter Email"
                           value="<?php echo isset($user) ? $user->email : set_value('email'); ?>">
                    <?php echo form_error('email', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="attachment-block clearfix">
                    <img class="attachment-img" src="<?php echo profile_photo(); ?>" alt="<?php echo $user->name; ?>">
                </div>

                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control" placeholder="Enter Photo">
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
