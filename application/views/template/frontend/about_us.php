<?php
# @Author: Awan Tengah
# @Date:   2017-03-09T21:25:26+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-21T18:08:46+07:00
?>
<div class="about-us">
    <div class="container-fluid about-us-image padding-0">
        <?php if($about_us->STATUS == 'SUCCESS'): ?>
            <?php if(!empty($about_us->DATA->HEADER_IMAGE)): ?>
                <img src="<?php echo base_url($about_us->DATA->PATH . $about_us->DATA->HEADER_IMAGE); ?>" class="img-responsive col-centered">
            <?php endif; ?>
        <?php endif; ?>
        <div class="about-us-caption">
            <h3>ABOUT US</h3>
            <p>
                100% cotton of natural material is good for the environment
            </p>
        </div>
    </div>
    <div style="padding: 2em 0;">
        <img src="<?php echo base_url('assets/img/Logo.png'); ?>" class="img-responsive col-centered">
    </div>
    <div class="container">
        <div class="col-lg-12">
            <?php if($about_us->STATUS == 'SUCCESS'): ?>
                <div class="text-center">
                    <h3><strong><?php echo $about_us->DATA->TITLE; ?></strong></h3>
                    <h4><?php echo $about_us->DATA->SUB_TITLE; ?></h4>
                    <div class="col-sm-10 col-centered" style="padding: 2em 0;">
                        <?php echo $about_us->DATA->DESCRIPTION; ?>
                    </div>
                    <div class="col-sm-6">
                        <img src="<?php echo !empty($about_us->DATA->IMAGE1) ? base_url($about_us->DATA->PATH . $about_us->DATA->IMAGE1) : base_url('assets/img/no_image.png'); ?>" class="img-responsive img-width-100">
                    </div>
                    <div class="col-sm-6">
                        <img src="<?php echo !empty($about_us->DATA->IMAGE2) ? base_url($about_us->DATA->PATH . $about_us->DATA->IMAGE2) : base_url('assets/img/no_image.png'); ?>" class="img-responsive img-width-100">
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php elseif($about_us->STATUS == 'FAILED'): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $about_us->MESSAGE; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
