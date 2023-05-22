<?php
# @Author: Awan Tengah
# @Date:   2017-04-10T01:10:27+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-18T12:24:16+07:00
?>

<div class="detail-process-order">
    <h3 style="color: red;">Your item is on the way</h3>
    <span>Order Number: <?php echo $order_product->ORDER_NUMBER; ?></span>
    <div class="logo-icon">
        <i class="ion-android-car"></i>
    </div>
    <h5><strong>Schedule Arrival Date</strong></h5>
    .....
    <h5><strong>Anda sudah menerima barang?</strong></h5>
    <ul class="list-unstyled col-sm-7 col-centered">
        <li><a onclick="already_received_product('<?php echo $order_product->ORDER_NUMBER; ?>')" class="btn btn-primary btn-block">Sudah Terima</a></li>
        <li><a onclick="view_detail_order_custom_history(<?php echo $order_product->ID_CUSTOM_PRODUCT; ?>, 'order_status', 'view_custom_detail_<?php echo $order_product->ID; ?>')" class="btn btn-default btn-block">My Detail Order</a></li>
    </ul>
</div>
