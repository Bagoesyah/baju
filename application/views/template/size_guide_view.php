<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Men's Size Guide</title>
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugin/superslides/stylesheets/superslides.min.css'); ?>">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/stylesheets/style.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/overide.css'); ?>"/>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="<?php echo base_url('assets/AdminLTE-2.3.0/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>

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

<div class="guide">
    <ul class="nav nav-pills" style="text-align:center;">
        <li role="presentation" style="padding:10px 0;">Guide</li>
    </ul>
    <div class="container-fluid">
        <?php if(isset($guide)): ?>
            <?php if($guide->STATUS == 'SUCCESS'): ?>
                <?php foreach($guide->DATA as $key => $value): ?>
                    <div class="col-sm-6">
                        <img src="<?php echo base_url($value->PATH . $value->IMAGE); ?>" class="img-responsive img-width-100">
                    </div>
                <?php endforeach; ?>
            <?php elseif($guide->STATUS == 'FAILED'): ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo $guide->MESSAGE; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('assets/bootstrap/javascripts/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/classie.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.matchHeight.js'); ?>"></script>
</body>
</html>