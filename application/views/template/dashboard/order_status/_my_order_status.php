<?php
# @Author: Awan Tengah
# @Date:   2017-04-09T23:21:27+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-28T18:41:55+07:00
?>

<div class="my-order-status">
    <div class="col-sm-6">
        <ul class="list-unstyled">
            <li><strong>Pesanan <?php echo $order_product->ORDER_NUMBER; ?></strong></li>
            <li><?php echo to_date_format($order_product->CREATED_AT, 'd F Y'); ?></li>
        </ul>
    </div>
    <div class="col-sm-6 text-center">
        <ul class="list-unstyled">
            <li><span class="label label-success label-status"><?php echo $order_product->STATUS_TEXT; ?></span></li>
            <li><strong>Order Status</strong></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-12 status-order-line">
        <ul class="list-inline text-center">
            <li>
                <span class="<?php echo $order_product->STATUS <= '4' ? 'on-section' : ''; ?>">Status Order</span> <br>
                <i class="ion-android-hand"></i>
            </li>
            <li>
                <span class="<?php echo $order_product->STATUS == '7' ? 'on-section' : ''; ?>">Production</span> <br>
                <i class="ion-tshirt-outline"></i>
            </li>
            <li>
                <span class="<?php echo $order_product->STATUS == '9' ? 'on-section' : ''; ?>">Sedang Dikirim</span> <br>
                <i class="ion-ios-box"></i>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-12 status-information">
        <div class="pull-left status-icon-left">
            <?php if($order_product->STATUS <= '4'): ?>
                <i class="ion-android-hand"></i>
            <?php elseif($order_product->STATUS == '7'): ?>
                <i class="ion-tshirt-outline"></i>
            <?php elseif($order_product->STATUS == '9'): ?>
                <i class="ion-ios-box"></i>
            <?php endif; ?>
        </div>
        <div class="">
            Riwayat Status <br>
            <?php if($order_product->STATUS <= '4'): ?>
                <?php echo to_date_format($order_product->UPDATED_AT, 'd F Y') . ', ' . to_date_format($order_product->UPDATED_AT, 'H:i'); ?> <br>
                Waiting for confirmation..<br>
                Mohon ditunggu untuk proses selanjutnya..
            <?php elseif($order_product->STATUS == '7'): ?>
                <?php echo to_date_format($order_product->UPDATED_AT, 'd F Y') . ', ' . to_date_format($order_product->UPDATED_AT, 'H:i'); ?> <br>
                T-Shirt anda sedang dalam proses pembuatan..<br>
                Mohon ditunggu untuk proses selanjutnya..
            <?php elseif($order_product->STATUS == '9'): ?>
                <?php echo to_date_format($order_product->UPDATED_AT, 'd F Y') . ', ' . to_date_format($order_product->UPDATED_AT, 'H:i'); ?> <br>
                T-Shirt anda dalam proses pengiriman. Mohon hubungi kita jika ada kesalahan / hal lain yang ingin ditanyakan. Terima kasih..
            <?php endif; ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-12">
        <div class="panel panel-default text-center">
            <div class="panel-body">
                <?php if($order_product->STATUS >= '9'): ?>
                    Proses selanjutnya.. <br>
                    Mohon hubungi kontak kita di mail@mail.com/0111111
                <?php else: ?>
                    Proses selanjutnya.. <br>
                    Proses tersebut akan memakan waktu beberapa hari..
                <?php endif; ?>
            </div>
        </div>
        <?php if($order_product->STATUS >= '9'): ?>
            <div class="text-center">
                <a href="#" id="detail-process-order" class="btn btn-primary" data-ordernumber="<?php echo $order_product->ORDER_NUMBER; ?>" data-iduser="<?php echo $order_product->ID_USER; ?>" data-usertoken="<?php echo $order_product->USER_TOKEN; ?>">Detail Process</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#detail-process-order").click(function(e) {
        e.preventDefault();
        var order_number = $(this).data('ordernumber');
        var id_user = $(this).data('iduser');
        var user_token = $(this).data('usertoken');

        $.ajax({
            url: base_url + '/api/order/get_detail_process_order',
            type: 'post',
            beforeSend: function(xhr){
                xhr.setRequestHeader('APP_TOKEN', app_token);
                xhr.setRequestHeader('USER_TOKEN', user_token);
            },
            data: {ID_USER: id_user, ORDER_NUMBER: order_number, TEMPLATE: true},
            success: function(data) {
                $('.side-order-detail').html('');
                $('.side-order-detail').html(data.DATA);
            }
        });
    });
});
</script>
