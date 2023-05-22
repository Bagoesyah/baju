<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:48+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-26T19:23:53+07:00
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Home</title>
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugin/superslides/stylesheets/superslides.min.css'); ?>">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/stylesheets/style.min.css'); ?>">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-default">
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-inline">
                                <li>Welcome to karuizawa shirt</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url(); ?>">
                        <img src="<?php echo base_url('assets/img/Logo.png'); ?>" alt="Logo" class="img-responsive">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo site_url('view/ready-to-wear'); ?>">READY TO WEAR</a></li>
                        <li><a href="<?php echo site_url('custom'); ?>">CUSTOM</a></li>
                        <li><a href="<?php echo site_url('view/guide'); ?>">GUIDE</a></li>
                        <li><a href="<?php echo site_url('view/about-us'); ?>">ABOUT US</a></li>
                    </ul>
                    <!-- <ul class="nav navbar-nav navbar-right">
                        <li class="hidden-xs">
                            <form id="search-form" class="navbar-form navbar-left">
                                <div class="input-group navbar-search">
                                    <div id="search-label-div">
                                        <label for="search-input">
                                            <span id="search-label" class="glyphicon glyphicon-search"></span>
                                        </label>
                                    </div>
                                    <div id="search-input-div">
                                        <input type="text" name="search" id="search-input" placeholder="Enter search...">
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul> -->
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <section class="section <?php echo $_container_fluid == true ? 'container-fluid' : ''; ?>">
        <div class="container text-justify">
            <ul class="list-unstyled">
                <li>Hello <?php echo $_user_login->name; ?></li>
                <li><a href="<?php echo site_url('logout') ?>">Log out</a></li>
            </ul>
            <div class="col-xs-12 member-container">
                <div class="col-sm-4 col-md-3 sidebar">
                    <img src="<?php echo base_url('assets/img/Logo.png'); ?>" alt="Logo" class="img-responsive">
                    <div class="menu">
                        <ul class="list-unstyled">
                            <li <?php echo isset($sidebar_menu) ? ($sidebar_menu == 'profile' ? 'class="active"' : '') : ''; ?>><a href="<?php echo site_url('dashboard/profile'); ?>">Edit Profile</a></li>
                            <li <?php echo isset($sidebar_menu) ? ($sidebar_menu == 'order_product_history' ? 'class="active"' : '') : ''; ?>><a href="<?php echo site_url('dashboard/order-product-history'); ?>">My Custom History</a></li>
                            <li <?php echo isset($sidebar_menu) ? ($sidebar_menu == 'order_status' ? 'class="active"' : '') : ''; ?>><a href="<?php echo site_url('dashboard/order-status'); ?>">Order Status</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8 col-md-9 content">
                    <div class="menu-header-member">
                        <span class="title"><?php echo isset($visited_title) ? $visited_title : ''; ?></span>
                        <span class="pull-right"><?php echo isset($sub_visited_title) ? $sub_visited_title : ''; ?></span>
                    </div>
                    <?php echo $_main_content; ?>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="footer-black">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h4>Karuizawa Shirt Contact Inquiries</h4>
                        <ul class="list-unstyled">
                            <li>Reception hours weekday 9:00 - 18:00</li>
                            <li>Phone number: <?php echo isset($_about_us) ? $_about_us->phone : '-'; ?></li>
                            <li>Email: <?php echo isset($_about_us) ? $_about_us->email : '-'; ?></li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h4>Useful Links</h4>
                        <ul class="list-unstyled">
                            <?php if(isset($_other_page)): ?>
                                <?php foreach($_other_page as $row): ?>
                                    <li><a href="<?php echo site_url('view/page/' . $row->slug); ?>"><?php echo $row->title; ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h4>Email Magazine</h4>
                        <p>
                            It is a service that delivers new products, deals, special coupons, etc. Free of charge
                        </p>
                        <a href="#" class="btn btn-primary">Email magazine registration</a>
                    </div>
                    <div class="col-sm-3 text-right">
                        <ul class="list-unstyled">
                            <li class="pull-right">
                                <img src="<?php echo base_url('assets/img/logo-w.png'); ?>" alt="Logo" class="img-responsive">
                            </li>
                            <li class="pull-right">
                                &copy <?php echo date('Y'); ?> <a href="<?php echo site_url(); ?>">Karuizawa shirt</a>
                            </li>
                            <li class="pull-right">
                                All Rights Reserved. Flex Japan, Inc.
                            </li>
                            <li class="pull-right">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-white">
            <div class="footer-logo">
                <img src="<?php echo base_url('assets/img/Logo.png'); ?>" class="img-responsive col-centered">
            </div>
            <div class="col-lg-12 list-social-media">
                <ul class="list-inline text-center">
                    <li><a href="<?php echo isset($_social_media) ? (!empty($_social_media->facebook) ? $_social_media->facebook : '#') : '#'; ?>">facebook</a></li>
                    <li><a href="<?php echo isset($_social_media) ? (!empty($_social_media->twitter) ? $_social_media->twitter : '#') : '#'; ?>">twitter</a></li>
                    <li><a href="<?php echo isset($_social_media) ? (!empty($_social_media->pinterest) ? $_social_media->pinterest : '#') : '#'; ?>">pinterest</a></li>
                    <li><a href="<?php echo isset($_social_media) ? (!empty($_social_media->instagram) ? $_social_media->instagram : '#') : '#'; ?>">instagram</a></li>
                    <li><a href="<?php echo isset($_social_media) ? (!empty($_social_media->linkedin) ? $_social_media->linkedin : '#') : '#'; ?>">linked in</a></li>
                    <li><a href="<?php echo isset($_social_media) ? (!empty($_social_media->google_plus) ? $_social_media->google_plus : '#') : '#'; ?>">google+</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <p class="text-center">&copy <?php echo date('Y'); ?> <a href="<?php echo site_url(); ?>">Karuizawa</a> - Custom Shirt | All rights reserved</p>
            </div>
        </div>
    </footer>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('assets/bootstrap/javascripts/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/classie.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.matchHeight.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>
</html>
