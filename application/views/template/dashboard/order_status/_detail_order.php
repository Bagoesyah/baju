<?php
# @Author: Awan Tengah
# @Date:   2017-04-01T13:37:12+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T11:23:29+07:00
?>
<div class="row box-history border" style="border: none;">
    <div class="col-sm-6">
        <div class="col-sm-6">
            <div class="text-center">
                <h4 style="color: red;">Detail Order</h4>
                Product
            </div>
            <?php
            if (!empty($order_product->IMAGE_CUSTOM)) {
                $img = base_url('assets/img/img_order/' . $order_product->IMAGE_CUSTOM);
            } else if (empty($order_product->IMAGE_CUSTOM) && !empty($order_product->IMAGE)) {
                $img = base_url('assets/img/upload/product_image/' . $order_product->IMAGE);
            } else {
                $img = base_url('assets/img/no_image.png');
            }
            ?>
            <img src="<?php echo $img; ?>" class="img-responsive">
        </div>
        <div class="col-sm-6">
            <ul class="list-unstyled box-detail pull-right">
                <li><span class="label label-success label-status"><?php echo $order_product->STATUS_TEXT; ?></span></li>
                <li>Delivery <span style="color: red;">Free</span></li>
                <li><?php echo $order_product->ORDER_NUMBER; ?></li>
            </ul>
        </div>
        <div class="col-sm-12">
            <strong>Total Payable <span class="pull-right" id="total_payable"></span></strong>
            <br><br><br>
            <ul class="list-unstyled box-detail">
                <?php
                if ($order_product->STATUS < 5) {
                ?>
                <li><a href="#" class="btn btn-default btn-block confirmation-order-link" data-ordernumber="<?php echo $order_product->ORDER_NUMBER; ?>" data-iduser="<?php echo $order_product->ID_USER; ?>" data-usertoken="<?php echo $order_product->USER_TOKEN; ?>">Confirmation Order</a></li>
                <?php
                }
                ?>
                <li><a href="#" class="btn btn-default btn-block my-order-link" data-ordernumber="<?php echo $order_product->ORDER_NUMBER; ?>" data-iduser="<?php echo $order_product->ID_USER; ?>" data-usertoken="<?php echo $order_product->USER_TOKEN; ?>">My Order</a></li>
            </ul>
        </div>
    </div>
    <div class="col-sm-6 side-order-detail">
        <h5><strong>SPEC</strong></h5>
        <table class="table">
            <tbody>
                <tr>
                    <td>Fabric</td>
                    <td>:</td>
                    <td>(<?php echo $order_product->FABRIC_CODE; ?>) <?php echo $order_product->FABRIC_TITLE; ?></td>
                </tr>
                <tr>
                    <td>Collar</td>
                    <td>:</td>
                    <td><?php echo $order_product->COLLAR_TITLE; ?></td>
                </tr>
                <tr>
                    <td>Cuff</td>
                    <td>:</td>
                    <td><?php echo (!empty($order_product->CUFF_TITLE)) ? $order_product->CUFF_TITLE : 'None'; ?></td>
                </tr>
                <tr>
                    <td>Sleeve</td>
                    <td>:</td>
                    <td><?php echo $order_product->SLEEVE_TITLE; ?></td>
                </tr>
                <tr>
                    <td>Body Type</td>
                    <td>:</td>
                    <td>
                        Front: <?php echo $order_product->BODY_TYPE_FRONT_TITLE; ?><br>
                        Back: <?php echo $order_product->BODY_TYPE_BACK_TITLE; ?><br>
                        Hem: <?php echo $order_product->BODY_TYPE_HEM_TITLE; ?>
                    </td>
                </tr>
                <tr>
                    <td>Pocket</td>
                    <td>:</td>
                    <td><?php echo $order_product->POCKET_TITLE; ?></td>
                </tr>
                <tr>
                    <td>Button</td>
                    <td>:</td>
                    <td>
                        Button: <?php echo $order_product->BUTTON_TITLE; ?><br>
                        Button Hole: <?php echo (!empty($order_product->BUTTON_HOLE_TITLE)) ? $order_product->BUTTON_HOLE_TITLE : 'Match Fabric Color'; ?><br>
                        Button Thread: <?php echo (!empty($order_product->BUTTON_THREAD_TITLE)) ? $order_product->BUTTON_THREAD_TITLE : 'Match Fabric Color'; ?>
                    </td>
                </tr>
                <tr>
                    <td>Cleric</td>
                    <td>:</td>
                    <td>
                        Type: <?php echo (!empty($order_product->CLERIC_CATEGORY_TITLE)) ? $order_product->CLERIC_CATEGORY_TITLE : 'None'; ?><br>
                        Fabric: <?php echo (!empty($order_product->CLERIC_TITLE)) ? $order_product->CLERIC_TITLE . ' ('.$order_product->CLERIC_CODE_FABRIC.')' : 'None'; ?><br>
                    </td>
                </tr>
                <tr>
                    <td>Embroidery</td>
                    <td>:</td>
                    <td>
                        Position: <?php echo !empty($order_product->EMBROIDERY_POSITION_TITLE) ? $order_product->EMBROIDERY_POSITION_TITLE : 'None'; ?><br>
                        Font: <?php echo !empty($order_product->EMBROIDERY_FONT_TITLE) ? $order_product->EMBROIDERY_FONT_TITLE : 'None'; ?><br>
                        Color: <?php echo !empty($order_product->EMBROIDERY_COLOR_TITLE) ? $order_product->EMBROIDERY_COLOR_TITLE : 'None'; ?><br>
                        Text: <?php echo !empty($order_product->EMBROIDERY_TEXT) ? $order_product->EMBROIDERY_TEXT : ''; ?>
                    </td>
                </tr>
                <tr>
                    <td>Option</td>
                    <td>:</td>
                    <td>
                        Stitch Thread: <?php echo !empty($order_product->OPTION_AMF_STITCH_TITLE) ? $order_product->OPTION_AMF_STITCH_TITLE : 'None'; ?><br>
                        Interlining: <?php echo !empty($order_product->OPTION_INTERLINING_TITLE) ? $order_product->OPTION_INTERLINING_TITLE : 'Standard'; ?><br>
                        Sewing: <?php echo !empty($order_product->OPTION_SEWING_TITLE) ? $order_product->OPTION_SEWING_TITLE : 'Standard'; ?><br>
                        Tape: <?php echo !empty($order_product->OPTION_TAPE_TITLE) ? $order_product->OPTION_TAPE_TITLE : 'None'; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <h5><strong>MAIN SIZE</strong></h5>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td width="150">Around Neck</td>
                        <td width="10">:</td>
                        <td><?php echo $order_product->AROUND_NECK_SELECTION; ?></td>
                    </tr>
                    <tr>
                        <td width="150">Sleeve Length Right</td>
                        <td width="10">:</td>
                        <td><?php echo $order_product->SLEEVE_LENGTH_RIGHT_SELECTION; ?></td>
                    </tr>
                    <tr>
                        <td width="150">Sleeve Length Left</td>
                        <td width="10">:</td>
                        <td><?php echo $order_product->SLEEVE_LENGTH_LEFT_SELECTION; ?></td>
                    </tr>
                    <tr>
                        <td width="150">Body Type</td>
                        <td width="10">:</td>
                        <td><?php echo $order_product->BODY_TYPE_SELECTION; ?></td>
                    </tr>
                    <tr>
                        <td width="150">Sleeve Type</td>
                        <td width="10">:</td>
                        <td><?php echo ucwords($order_product->SLEEVE_TYPE_SELECTION); ?> Sleeve</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h5><strong>SIZE</strong></h5>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td width="150">Neck</td>
                        <td width="10">:</td>
                        <td><?php echo $order_product->NECK; ?></td>
                    </tr>
                    <tr>
                        <td>Shoulder</td>
                        <td>:</td>
                        <td><?php echo $order_product->SHOULDER; ?></td>
                    </tr>
                    <tr>
                        <td>Chest</td>
                        <td>:</td>
                        <td><?php echo $order_product->CHEST; ?></td>
                    </tr>
                    <tr>
                        <td>Waist</td>
                        <td>:</td>
                        <td><?php echo $order_product->WAIST; ?></td>
                    </tr>
                    <tr>
                        <td>Hip</td>
                        <td>:</td>
                        <td><?php echo $order_product->HIP; ?></td>
                    </tr>
                    <tr>
                        <td>Arm Hole</td>
                        <td>:</td>
                        <td><?php echo $order_product->ARM_HOLE; ?></td>
                    </tr>
                    <tr>
                        <td>Back Length (~88cm)</td>
                        <td>:</td>
                        <td><?php echo $order_product->BACK_LENGTH_88; ?></td>
                    </tr>
                    <tr>
                        <td>Back Length (89cm~)</td>
                        <td>:</td>
                        <td><?php echo $order_product->BACK_LENGTH_89; ?></td>
                    </tr>
                    <tr>
                        <td>Aloha (~88cm)</td>
                        <td>:</td>
                        <td><?php echo $order_product->ALOHA_88; ?></td>
                    </tr>
                    <tr>
                        <td>Aloha (89cm~)</td>
                        <td>:</td>
                        <td><?php echo $order_product->ALOHA_89; ?></td>
                    </tr>
                    <tr>
                        <td>Cuffs Circle</td>
                        <td>:</td>
                        <td><?php echo $order_product->CUFFS_CIRCLE; ?></td>
                    </tr>
                    <tr>
                        <td>Short Sleeve</td>
                        <td>:</td>
                        <td><?php echo $order_product->SHORT_SLEEVE; ?></td>
                    </tr>
                    <tr>
                        <td>Sleeve Circle</td>
                        <td>:</td>
                        <td><?php echo $order_product->SLEEVE_CIRCLE; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <ul class="list-unstyled">
            <li><strong>Special Request Verify:</strong> <?php echo $order_product->SPECIAL_REQUEST_VERIFY; ?></li>
        </ul>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".confirmation-order-link").click(function(e) {
        e.preventDefault();
        var order_number = $(this).data('ordernumber');
        var id_user = $(this).data('iduser');
        var user_token = $(this).data('usertoken');

        $.ajax({
            url: base_url + '/api/order/get_confirmation_order_step_one',
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

    $(".my-order-link").click(function(e) {
        e.preventDefault();
        var order_number = $(this).data('ordernumber');
        var id_user = $(this).data('iduser');
        var user_token = $(this).data('usertoken');

        $.ajax({
            url: base_url + '/api/order/get_my_order_status',
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
                $('#total_payable').html('');
                $('#total_payable').html(data.DATA.PRICE_TOTAL);
            }
        }
    });
});
</script>
