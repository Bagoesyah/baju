<?php
# @Author: Awan Tengah
# @Date:   2017-04-28T18:29:36+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T21:19:42+07:00
?>

<div class="detail-process-order">
    <i class="ion-card" style="font-size: 6em;"></i>
    <br>
    <h4 style="color: #27ae60; letter-spacing: 1px;">Please complete your payment</h4>
    <br>
    <?php $get_order_number = $order_product->ORDER_NUMBER; ?>
    <a id="btnPayMember" class="btn btn-default">Pay</a>
</div>

<script>
$("#btnPayMember").click(function(e) {
    $.ajax({
        url: base_url + '/api/order/get_sum_price',
        type: 'post',
        beforeSend: function(xhr){
            xhr.setRequestHeader('APP_TOKEN', app_token);
            xhr.setRequestHeader('USER_TOKEN', '<?php echo $order_product->USER_TOKEN; ?>');
        },
        data: {ID_USER: '<?php echo $order_product->ID_USER; ?>', ORDER_NUMBER: '<?php echo $order_product->ORDER_NUMBER; ?>', NUMERIC_PRICE: true},
        success: function(data) {
            if(data.STATUS == 'SUCCESS') {
                window.location = base_url + '<?php echo "/payment/proceed?ORDER_NUMBER={$get_order_number}&PRICE="; ?>' + data.DATA.PRICE_TOTAL
            }
        }
    });
});
</script>
