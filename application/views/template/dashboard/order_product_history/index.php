<?php
# @Author: Awan Tengah
# @Date:   2017-03-31T13:59:41+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-20T12:23:13+07:00
?>

<div class="box-member">
    <div class="col-sm-7">
        <div class="row">
            <?php if(isset($order_product_history)): ?>
                <?php foreach($order_product_history->DATA as $row): ?>
                    <div class="box-history">
                        <div class="col-sm-4">
                            <?php
                            if (!empty($row->IMAGE) && empty($row->IMAGE_CUSTOM)) {
                                if (is_file($row->PATH . $row->IMAGE)) {
                                ?>
                                <img style="width:100%;" src="<?php echo !empty($row->IMAGE) ? base_url($row->PATH . $row->IMAGE) : base_url('assets/img/no_image.png'); ?>" class="img-responsive">
                                <?php
                                } else {
                                    ?>
                                    <img style="width:100%;" src="<?php echo base_url('assets/img/no_image.png'); ?>" />
                                    <?php
                                }
                            } else {
                                if (is_file('assets/img/img_order/' . $row->IMAGE_CUSTOM)) {
                                ?>
                                <img src="<?php echo !empty($row->IMAGE_CUSTOM) ? base_url('assets/img/img_order/' . $row->IMAGE_CUSTOM) : base_url('assets/img/no_image.png'); ?>" class="img-responsive">
                                <?php
                                } else {
                                    ?>
                                    <img style="width:100%;" src="<?php echo base_url('assets/img/no_image.png'); ?>" />
                                    <?php
                                }
                            }
                            ?>
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
                                    <li><a href="#" onclick="view_detail_order_custom_history(<?php echo $row->ID_CUSTOM_PRODUCT; ?>, 'order_product_history', 'view_custom_detail')">Lihat Detail</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="view_custom_detail view_custom_collapse"></div>
    </div>
</div>
