<?php
# @Author: Awan Tengah
# @Date:   2017-03-10T14:53:40+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-22T12:54:31+07:00
?>
<div class="guide">
    <ul class="nav nav-pills">
        <?php if(isset($product_category)): ?>
            <?php if($product_category->STATUS == 'SUCCESS'): ?>
                <?php foreach($product_category->DATA as $key => $value): ?>
                    <li role="presentation" class="<?php echo !is_null($slug) ? ($slug == $value->SLUG ? 'active' : '') : ($key == '0' ? 'active' : ''); ?>"><a href="<?php echo site_url('view/guide/' . $value->SLUG); ?>"><?php echo $value->TITLE; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
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
