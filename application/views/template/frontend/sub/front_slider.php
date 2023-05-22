<?php
# @Author: Awan Tengah
# @Date:   2017-03-12T22:25:43+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-20T23:16:15+07:00
?>
<style>
.height-fill{width:90% !important;margin: 0 auto !important;}
.slides-container .container{position:absolute;right:40px;display:block !important;margin-right:100px !important;}
</style>
<div class="loading-container">
    <div class="pulse"></div>
</div>
<div id="slides" class="height-fill">
    <ul class="slides-container">
        <?php if($front_slider): ?>
            <?php foreach($front_slider as $row): ?>
                <li>
                    <div class="overlay">
                        <img src="<?php echo !empty($row->image) ? base_url(path_image('front_slider_path') . $row->image) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $row->title; ?>">
                        <div class="container col-sm-4 col-sm-push-8">
                            <div class="col-lg-12">
                                <div class="logo-karui"></div>
                                <h3>Make your own shirt here!</h3>
                            </div>
                            <div class="col-sm-6 col-centered">
                                <a href="<?php echo site_url('custom'); ?>" class="btn btn-default btn-round col-xs-12">Custom Shirt</a>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if($promo_slider): ?>
            <?php foreach($promo_slider as $row): ?>
                <li>
                    <div class="overlay">
                        <a href="<?php echo site_url('promo/'.$row->slug); ?>">
                            <img src="<?php echo !empty($row->image) ? base_url(path_image('promo_path') . $row->image) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $row->promo_name; ?>">
                        </a>
                        <div class="container col-sm-4 col-sm-push-8">
                            <div class="col-lg-12">
                                <div class="logo-karui"></div>
                                <h3><?php echo $row->promo_name; ?></h3>
                            </div>
                            <div class="col-sm-6 col-centered">
                                <a href="<?php echo site_url('promo/'.$row->slug); ?>" class="btn btn-default btn-round col-xs-12">Click Here</a>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <nav class="slides-navigation">
        <a href="#" class="next"><i class="ion-android-arrow-dropright-circle"></i></a>
        <a href="#" class="prev"><i class="ion-android-arrow-dropleft-circle"></i></a>
    </nav>
</div>

<script src="<?php echo base_url('assets/plugin/superslides/javascripts/jquery.easing.1.3.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugin/superslides/javascripts/jquery.animate-enhanced.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugin/superslides/javascripts/jquery.hammer.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugin/superslides/jquery.superslides.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugin/superslides/javascripts/application.js'); ?>"></script>
