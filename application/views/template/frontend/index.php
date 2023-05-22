<?php
# @Author: Awan Tengah
# @Date:   2017-02-16T18:18:54+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-26T11:24:35+07:00
?>

<?php $this->load->view('template/frontend/sub/front_slider'); ?>

<div class="home-page">
    <div class="col-xs-12 information">
        <?php if(isset($information)): ?>
            <?php $i = 1; ?>
            <?php foreach($information as $row): ?>
                <div class="col-xs-6 col-sm-3 box-information">
                    <h4><strong><?php echo $row->title; ?></strong></h4>
                    <p><?php echo $row->content; ?></p>
                    <?php if($i != count($information)): ?>
                        <div class="vertical-divider <?php echo ($i % 2) == 0 ? 'hidden-xs' : ''; ?>"></div>
                    <?php endif; ?>
                </div>
                <?php $i++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="container-fluid">
    <div class="list-product ready-to-wear-product">
        <div class="container">
            <div class="col-lg-12 pb-20">
                <h4><strong>READY TO WEAR</strong></h4>
                <?php if(isset($product_category)): ?>
                    <div class="row">
                    <?php foreach($product_category->DATA as $row): ?>
                        <div class="col-sm-3 item ready-to-wear">
                            <a alt="<?php echo $row->TITLE; ?>" title="<?php echo $row->TITLE; ?>" href="<?php echo site_url('view/ready-to-wear/' . $row->SLUG); ?>">
                                <div class="ready-to-wear-img">
                                    <img src="<?php echo !empty($row->IMAGE) ? base_url(path_image('product_image_path') . $row->IMAGE) : base_url('assets/img/no_image.png'); ?>" class="img-responsive img-width-100">
                                </div>
                                <div class="ready-to-wear-content">
                                    <h5><strong><?php echo $row->TITLE; ?></strong></h5>
                                    <span><strong><?php echo format_currency($row->PRICE); ?></strong></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="product-sort-menu">
    <div class="container">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#product-new-arrival" aria-controls="home" role="tab" data-toggle="tab">New Arrival</a></li>
            <li role="presentation"><a href="#product-best-seller" aria-controls="home" role="tab" data-toggle="tab">Best Seller</a></li>
            <li role="presentation"><a href="#product-special-offer" aria-controls="home" role="tab" data-toggle="tab">Special Offer</a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active list-product" id="product-new-arrival">
                <?php if(isset($product_new_arrival)): ?>
                    <?php if($product_new_arrival->STATUS == 'SUCCESS'): ?>
                        <?php foreach($product_new_arrival->DATA as $row): ?>
                            <div class="col-sm-3 col-xs-6 item new-arrival">
                                <a alt="<?php echo $row->TITLE; ?>" title="<?php echo $row->TITLE; ?>" href="<?php echo site_url('view/product/' . $row->SLUG); ?>">
                                    <div class="new-arrival-img">
                                        <img src="<?php echo !empty($row->IMAGE) ? base_url($row->PATH . $row->IMAGE[0]->IMAGE) : base_url('assets/img/no_image.png'); ?>" class="img-responsive col-centered">
                                    </div>
                                    <div class="new-arrival-content">
                                        <h5><strong><?php echo $row->TITLE; ?></strong></h5>
                                        <span><strong><?php echo format_currency($row->PRICE); ?></strong></span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div role="tabpanel" class="tab-pane list-product" id="product-best-seller">
                <?php if(isset($product_best_seller)): ?>
                    <?php if($product_best_seller->STATUS == 'SUCCESS'): ?>
                        <?php foreach($product_best_seller->DATA as $row): ?>
                            <div class="col-sm-3 col-xs-6 item new-arrival">
                                <a alt="<?php echo $row->TITLE; ?>" title="<?php echo $row->TITLE; ?>" href="<?php echo site_url('view/product/' . $row->SLUG); ?>">
                                    <div class="new-arrival-img">
                                        <img src="<?php echo !empty($row->IMAGE) ? base_url($row->PATH . $row->IMAGE[0]->IMAGE) : base_url('assets/img/no_image.png'); ?>" class="img-responsive col-centered">
                                    </div>
                                    <div class="new-arrival-content">
                                        <h5><strong><?php echo $row->TITLE; ?></strong></h5>
                                        <span><strong><?php echo format_currency($row->PRICE); ?></strong></span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div role="tabpanel" class="tab-pane list-product" id="product-special-offer">
                <?php if($product_special_offer): ?>
                    <?php foreach($product_special_offer->DATA as $row): ?>
                        <div class="col-sm-3 item ready-to-wear promo-product">
                            <a href="<?php echo site_url('view/product/' . $row->SLUG); ?>">
                                <div class="ready-to-wear-img">
                                    <img src="<?php echo !empty($row->IMAGE) ? base_url(path_image('product_image_path') . $row->IMAGE[0]->IMAGE) : base_url('assets/img/no_image.png'); ?>" class="img-responsive img-width-100">
                                </div>
                                <div class="ready-to-wear-content">
                                    <h5><strong><?php echo $row->TITLE; ?></strong></h5>
                                    <span><strong><strike><?php echo format_currency($row->PRICE); ?></strike></strong> <strong><?php echo format_currency(get_price_promo($row->PRICE,$row->PROMO_VALUE,$row->TYPE_PROMO == 1 ? TRUE : FALSE)); ?></strong></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
