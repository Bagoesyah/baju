<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:48+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-25T09:47:38+07:00
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
    <link rel="stylesheet" href="<?php echo base_url('assets/plugin/superslides/stylesheets/superslides.min.css'); ?>">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/stylesheets/style.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/overide.css'); ?>"/>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPod/i); 
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
    </script>

</head>
<body>
    <header class="header">
        <nav class="navbar navbar-default">
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-inline">
                                <?php if(is_null($_user_login)): ?>
                                    <li><a href="<?php echo site_url('login'); ?>">Login</a></li> |
                                    <li><a href="<?php echo site_url('register'); ?>">Register</a></li>
                                <?php else: ?>
                                    <li><a href="<?php echo site_url($_login_redirect); ?>">Dashboard</a></li>
                                <?php endif; ?>
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
                        <li><a id="ready_to_wear_link" href="<?php echo site_url('view/ready-to-wear'); ?>">READY TO WEAR</a></li>
                        <li><a id="custom_link" href="<?php echo site_url('custom'); ?>?p=default">CUSTOM</a></li>
                        <li><a id="guide_link" href="<?php echo site_url('view/guide'); ?>">GUIDE</a></li>
                        <li><a id="about_link" href="<?php echo site_url('view/about-us'); ?>">ABOUT US</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden-xs">
                            <form id="search-form" action="<?php echo site_url('view/ready-to-wear'); ?>" class="navbar-form navbar-left">
                                <div class="input-group navbar-search">
                                    <div id="search-label-div">
                                        <label for="search-input">
                                            <span id="search-label" class="glyphicon glyphicon-search"></span>
                                        </label>
                                    </div>
                                    <div id="search-input-div">
                                        <?php $key = $this->input->get('key', true); ?>
                                        <input type="text" name="key" value="<?php echo (isset($key)) ? $key : ''; ?>" id="search-input" placeholder="Enter search...">
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <section class="section <?php echo $_container_fluid == true ? 'container-fluid' : ''; ?>">
        <?php echo $_main_content; ?>
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
                        <a href="<?php echo site_url('subscribes');?>" class="btn btn-brown">Email magazine registration</a>
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
<script src="<?php echo base_url('assets/js/objects.js'); ?>"></script>
</body>
</html>
