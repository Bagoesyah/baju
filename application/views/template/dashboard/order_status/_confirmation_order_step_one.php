<?php
# @Author: Awan Tengah
# @Date:   2017-04-04T14:05:09+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T11:23:08+07:00
?>
<div class="">
    <h4>Confirmation Order</h4>
    <div class="table-responsive">
        <?php echo form_open('dashboard/order-status/confirmation-order'); ?>
        <table class="table">
            <tbody>
                <tr>
                    <td>Invoice</td>
                    <td>:</td>
                    <td>
                        <input type="hidden" name="order_number" value="<?php echo isset($order_product) ? $order_product->ORDER_NUMBER : ''; ?>">
                        <?php echo $order_product->ORDER_NUMBER; ?>
                    </td>
                </tr>
                <tr>
                    <td>Total Invoice</td>
                    <td>:</td>
                    <td>
                        <span id="total_payable_"></span>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pembayaran</td>
                    <td>:</td>
                    <td>
                        <div class="form-group">
                            <input type="date" name="payment_date" class="form-control" placeholder="dd/mm/yyyy">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Cara Pembayaran</td>
                    <td>:</td>
                    <td>
                        <div class="form-group">
                            <select class="form-control" name="payment_method">
                                <option value="">Choose</option>
                                <?php if(!empty($order_product->PAYMENT_METHOD)): ?>
                                    <?php foreach($order_product->PAYMENT_METHOD as $row): ?>
                                        <option value="<?php echo $row->ID ?>"><?php echo $row->TITLE; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Dari Rekening</td>
                    <td>:</td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="sender_account" class="form-control" placeholder="Dari Rekening">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Rekening Tujuan</td><td>:</td>
                    <td>
                        <div class="form-group">
                            <select class="form-control" name="destination_account">
                                <option value="">Choose</option>
                                <?php if(!empty($order_product->PAYMENT_LIST)): ?>
                                    <?php foreach($order_product->PAYMENT_LIST as $row): ?>
                                        <option value="<?php echo $row->ID ?>"><?php echo "{$row->BANK_NAME} - {$row->NO_REK} a/n : {$row->ACCOUNT_NAME}"; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah Pembayaran</td>
                    <td>:</td>
                    <td>
                        <div class="form-group">
                            <input type="text" name="payment_amount" class="form-control" placeholder="Jumlah Pembayaran">
                            <small>
                                Inputlah sesuai dengan jumlah uang yang Anda transfer.<br>
                                Masukkan jumlah pembayaran tanpa tanda titik atau koma.<br>
                                Contoh: 150000
                            </small>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="form-group">
                            <textarea name="information" rows="5" cols="80" class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="submit" class="btn btn-default" value="Submit">
                    </td>
                </tr>
            </tbody>
        </table>
        <?php form_close(); ?>
    </div>
</div>

<script>
$.ajax({
    url: base_url + '/api/order/get_sum_price',
    type: 'post',
    beforeSend: function(xhr){
        xhr.setRequestHeader('APP_TOKEN', app_token);
        xhr.setRequestHeader('USER_TOKEN', '<?php echo $order_product->USER_TOKEN; ?>');
    },
    data: {ID_USER: '<?php echo $order_product->ID_USER; ?>', ORDER_NUMBER: '<?php echo $order_product->ORDER_NUMBER; ?>'},
    success: function(data) {
        if(data.STATUS == 'SUCCESS') {
            $('#total_payable_').html('');
            $('#total_payable_').html(data.DATA.PRICE_TOTAL);
        }
    }
});
</script>
