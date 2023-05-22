<?php
# @Author: Awan Tengah
# @Date:   2017-02-09T21:28:36+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-12T10:37:48+07:00



/**
 * User: Awan Tengah
 * Date: 09/04/2016
 * Time: 21:03
 */
?>

<div class="content-wrapper" style="min-height: 1096px;">
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
            <li class="active"><?php echo $on_section; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <?php alert_message(); ?>
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo profile_photo(); ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $profile->name; ?></h3>
                        <p class="text-muted text-center"><?php echo $profile->email; ?></p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Username</b> <a class="pull-right"><?php echo $profile->name; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Password</b> <a class="pull-right">**********</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right"><?php echo $profile->email; ?></a>
                            </li>
                        </ul>

                        <a href="<?php echo site_url('admin/profile/edit/' . $this->session->userdata('id_user')); ?>" class="btn btn-primary btn-block"><b>Edit</b></a>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div>
