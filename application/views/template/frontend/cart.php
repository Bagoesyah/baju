<?php
# @Author: Awan Tengah
# @Date:   2017-03-30T13:41:57+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-24T12:45:51+07:00
?>
<style>
table.table tbody tr td{border-top:0px;border-bottom:1px dashed #ccc;}
table.table tbody tr:nth-child(odd){background:#f1f1f1;}
table.table thead tr th{border-bottom:0px;}
</style>
<div class="cart">
    <h3>Your Cart</h3>
    <p>Here is your shopping list. Please feel free to check back. If you want to add quantity and shop more, please go back to page <a href="#">shop</a></p>
    <div class="container">
        <div class="table-responsive">
            <table class="table text-justify">
                <thead class="btn-default">
                    <th width="250">Product</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Custom Amount</th>
                    <th></th>
                </thead>
                <tbody id="cart_list">
                </tbody>
            </table>
        </div>
    </div>
    <div class="container cart-footer">
        <div class="row">
            <div class="col-sm-4">
                <h4>Coupon Code & Points</h4>
                <strong>COUPON CODE</strong>
                <p>If you have a coupon code, please enter it.</p>
                <form method="post" action="">
                <?php
                if ($this->session->flashdata('coupon_error')) {
                    ?>
                    <div class="alert alert-danger">
                        <p><?php echo $this->session->flashdata('coupon_error'); ?></p>
                    </div>
                    <?php
                }
                if ($this->session->flashdata('coupon_success')) {
                    ?>
                    <div class="alert alert-success">
                        <p><?php echo $this->session->flashdata('coupon_success'); ?></p>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <input type="text" name="promo_code" class="form-control" placeholder="Enter promo code..">
                </div>
                <input type="submit" name="submit_promo_code" class="btn btn-white" value="Coupon Confirmation"/>
                </form>
            </div>
            <div class="col-sm-4">
                <h4>Shipping</h4>
                <p>About elivery method.</p>
                <p>We will send it by <a href="#" style="color: #aaa;">Indonesia Post</a></p>
                <p>*Please understand that you can not specify the shipping agent.</p>
                <p>In the case of free fabric samples, we will send it by post. Please not that date can not be specified.</p>
                <p><strong>The delivery fee is uniformly free.</strong></p>
            </div>
            <div class="col-sm-4">
                <h4>Shoping cart total</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Base amount</td>
                            <td><span id="sub_total_all"></span></td>
                        </tr>
                        <tr>
                            <td>Option amount</td>
                            <td><span id="option_total_all"></span></td>
                        </tr>
                        <tr>
                            <td>Shipping fee</td>
                            <td>Free</td>
                        </tr>
                        <tr>
                            <td>Consumption tax</td>
                            <td><span id="tax_all"></span></td>
                        </tr>
                        <tr>
                            <td>Coupon Discount</td>
                            <td><span id="coupon_discount"></span></td>
                        </tr>
                        <tr>
                            <td>Total amount (tax included)</td>
                            <td><span id="price_total_all"></span></td>
                        </tr>
                    </tbody>
                </table>
                <a href="<?php echo site_url('cart/proceed_checkout'); ?>" class="btn btn-primary btn-block">Proceed to checkout</a>
                <a href="<?php echo site_url('custom'); ?>" class="btn btn-default btn-block">Continue Shop</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#cart_list').html("<tr class='text-center'><td colspan='6'>LOADING..</td></tr>");
    $.ajax({
        url: base_url + '/api/order/get_order_product',
        type: "post",
        beforeSend: function(xhr){
            xhr.setRequestHeader('APP_TOKEN', app_token);
            xhr.setRequestHeader('USER_TOKEN', '<?php echo $_user_login->user_token; ?>');
        },
        data: {ID_USER: <?php echo $_user_login->id; ?>, ORDER_STATUS: '1', TEMPLATE_CART_LIST: true},
        success: function(response) {
            if(response.STATUS == 'SUCCESS') {
                $('#cart_list').html(response.DATA.TEMPLATE);
                $('#sub_total_all').html('<strong>'+response.DATA.SUB_TOTAL_CART+'</strong>');
                $('#option_total_all').html('<strong>'+response.DATA.OPTION_TOTAL_CART+'</strong>');
                $('#tax_all').html('<strong>'+response.DATA.TAX_TOTAL_CART+'</strong>');
                $('#price_total_all').html('<strong>'+response.DATA.PRICE_TOTAL_CART+'</strong>');
                if (response.COUPON) {
                    $('#coupon_discount').html('<strong>'+response.COUPON.coupon_discount+'</strong>');
                } else {
                    $('#coupon_discount').html('<strong>-</strong>');
                }
            } else {
                $('#cart_list').html("<tr class='text-center'><td colspan='6'>CART EMPTY</td></tr>");
            }
        }
    });
});
</script>
