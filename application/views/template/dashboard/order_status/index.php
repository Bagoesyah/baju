<?php
# @Author: Awan Tengah
# @Date:   2017-04-01T09:55:10+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-20T12:23:01+07:00
?>

<div class="box-member">
    <div class="col-sm-12">
        <div class="row">
            <?php alert_message(); ?>
            <?php if(isset($order_status)): ?>
                <?php foreach($order_status->DATA as $row): ?>
                    <?php
                    if (!empty($row->IMAGE_CUSTOM)) {
                        $img = base_url('assets/img/img_order/' . $row->IMAGE_CUSTOM);
                    } else if (empty($row->IMAGE_CUSTOM) && !empty($row->IMAGE)) {
                        $img = base_url('assets/img/upload/product_image/' . $row->IMAGE);
                    } else {
                        $img = base_url('assets/img/no_image.png');
                    }
                    ?>
                    <div class="box-history">
                        <div class="col-sm-4">
                            <img src="<?php echo $img; ?>" class="img-responsive">
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-6">
                                <ul class="list-unstyled box-detail">
                                    <li>
                                        <span class="ion-ios-calendar-outline"></span> <?php echo to_date_format($row->CREATED_AT, 'd/m/Y'); ?>
                                    </li>
                                    <li><span class="ion-bag"></span> <?php echo format_currency($row->BASE + $row->OPTION + $row->TAX); ?></li>
                                    <li><span class="ion-tshirt-outline"></span> color</li>
                                    <li><?php echo $row->ORDER_NUMBER; ?></li>
                                    <li><span class="ion-ios-keypad"></span> <strong><?php echo strtoupper($row->ORDER_TYPE_TEXT); ?></strong></li>
                                    <li>Quantity: <?php echo $row->QUANTITY; ?></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 text-center">
                                <ul class="list-unstyled box-detail">
                                    <li><span class="label label-success label-status"><?php echo $row->STATUS_TEXT; ?></span></li>
                                    <li>Delivery <span style="color: red;">Free</span></li>
                                    <li><a onclick="view_detail_order_custom_history(<?php echo $row->ID_CUSTOM_PRODUCT; ?>, 'order_status', 'view_custom_detail_<?php echo $row->ID; ?>')">Lihat Detail</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="view_custom_detail_<?php echo $row->ID; ?> view_custom_collapse"></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
