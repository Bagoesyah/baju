<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:48+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-24T15:17:49+07:00
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_app_title; ?> | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.3.0/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/select2/select2.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.3.0/dist/css/AdminLTE.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/iCheck/all.min.css'); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.3.0/build/less/skins/skin-awantengah.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sweet-alert.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/datepicker/datepicker3.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.min.css'); ?>">

    <script src="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/angular.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/angular-locale_id-id.js'); ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-awantengah sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="<?php echo site_url(); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>AT</b>S</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b><?php echo $_app_title; ?></b></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?php echo profile_photo(); ?>"
                                class="user-image" alt="<?php echo $_user_login->name; ?>">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo strtoupper($_user_login->name); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?php echo profile_photo(); ?>"
                                    class="img-circle" alt="<?php echo $_user_login->name; ?>">
                                    <p>
                                        <?php echo $_user_login->name; ?>
                                        <small>since <?php echo to_date_format($_user_login->created_at, 'M, Y'); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('admin/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('logout'); ?>" class="btn btn-default btn-flat">Sign
                                            out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="image">
                            <img src="<?php echo profile_photo(); ?>"
                            class="img-circle" alt="<?php echo $_user_login->name; ?>">
                        </div>
                        <div class="info">
                            <p><?php echo strtoupper($_user_login->name); ?></p>
                            <!-- Status -->
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu">
                        <!-- Optionally, you can add icons to the links -->
                        <?php foreach ($ci->parent_menu() as $row): ?>
                            <?php if ($ci->has_child_menu($row->id)): ?>
                                <li class="treeview">
                                    <a href="<?php echo site_url($row->url); ?>">
                                        <i class="<?php echo $row->icon; ?>"></i> <span><?php echo $row->title; ?></span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <?php foreach ($ci->has_child_menu($row->id) as $row): ?>
                                            <?php if ($ci->has_child_menu($row->id)): ?>
                                                <li>
                                                    <a href="<?php echo site_url($row->url); ?>">
                                                        <i class="<?php echo $row->icon; ?>"></i> <span><?php echo $row->title; ?></span>
                                                        <i class="fa fa-angle-left pull-right"></i>
                                                    </a>
                                                    <ul class="treeview-menu">
                                                        <?php foreach ($ci->has_child_menu($row->id) as $row): ?>
                                                            <li>
                                                                <a href="<?php echo site_url($row->url); ?>">
                                                                    <span class="pull-right-container">
                                                                        <i class="<?php echo $row->icon; ?>"></i>
                                                                    </span>
                                                                    <span><?php echo $row->title; ?></span>
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a href="<?php echo site_url($row->url); ?>">
                                                        <span class="pull-right-container">
                                                            <i class="<?php echo $row->icon; ?>"></i>
                                                        </span>
                                                        <span><?php echo $row->title; ?></span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <?php if ($row->url != '#'): ?>
                                    <li>
                                        <a href="<?php echo site_url($row->url); ?>">
                                            <i class="<?php echo $row->icon; ?>"></i>
                                            <span><?php echo $row->title; ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul><!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <?php echo $_main_content; ?>
        </div><!-- ./wrapper -->

        <script src="<?php echo base_url('assets/AdminLTE-2.3.0/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/smart-table.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/SweetAlert.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/sweet-alert.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/ui-bootstrap-2.0.0.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/ui-bootstrap-tpls-2.0.0.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/iCheck/icheck.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/datepicker/bootstrap-datepicker.min.js'); ?>"></script>
        <!-- Select2 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/select2/select2.full.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/AdminLTE-2.3.0/dist/js/app.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/ckeditor/ckeditor.js'); ?>"></script>
        <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();

            // instance, using default configuration.
            if ($('#ckeditor').length == 1) {
                CKEDITOR.config.removeButtons = 'Save,About';
                CKEDITOR.replace('ckeditor');
            }

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
        });
        </script>
    </body>
    </html>
