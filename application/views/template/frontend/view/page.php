<?php
# @Author: Awan Tengah
# @Date:   2017-04-21T20:26:03+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-22T01:12:42+07:00
?>
<style>
.page-content{margin-bottom:100px;line-height:22px;}
.page-content h3{margin-bottom:20px;font-size:20px;color:#313131;}
.page-content h3.headtitle{font-size:24px;}
.page-content ol li, .page-content ul li{padding:2px 0;}
.page-content strong{color:#313131;}
.page-content a{color:#ea8007;font-weight:bold;text-decoration: underline;}
.page-contenta:hover{color:#af6007;}
</style>
<div class="about-us">
    <div class="container-fluid about-us-image padding-0">
        <?php if(!empty($page->header_image)): ?>
            <img src="<?php echo base_url(path_image('other_page_path') . $page->header_image); ?>" alt="<?php echo $page->title; ?>" class="img-responsive col-centered">
        <?php endif; ?>
    </div>
    <div class="container text-left page-content">
        <h3 class="headtitle"><strong><?php echo $page->title; ?></strong></h3>
        <?php echo $page->content; ?>
    </div>
</div>
