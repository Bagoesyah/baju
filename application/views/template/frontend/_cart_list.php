<?php
# @Author: Awan Tengah
# @Date:   2017-04-20T09:41:10+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-01T11:12:41+07:00
?>

<?php if(isset($order_product_on_cart)): ?>
    <?php foreach($order_product_on_cart as $row): ?>
        <tr>
            <td>
                <?php
                if (!empty($row->IMAGE) && empty($row->IMAGE_CUSTOM)) { 
                    ?>
                    <img style="width:100%;" src="<?php echo !empty($row->IMAGE) ? base_url($row->PATH . $row->IMAGE) : base_url('assets/img/no_image.png'); ?>" class="img-responsive">
                    <?php
                } else {
                    ?>
                    <img src="<?php echo !empty($row->IMAGE_CUSTOM) ? base_url('assets/img/img_order/' . $row->IMAGE_CUSTOM) : base_url('assets/img/no_image.png'); ?>" class="img-responsive">
                    <?php
                }
                ?>
            </td>
            <td><strong><?php echo strtoupper($row->ORDER_TYPE_TEXT); ?></strong></td>
            <td><strong><?php echo format_currency($row->CUSTOM_PRICE); ?></strong></td>
            <td>
                <div class="form-group margin-0">
                    <input type="number" name="quantity" class="form-control change-quantity" value="<?php echo $row->QUANTITY; ?>" style="width: 75px;" min="1" data-usertoken="<?php echo $row->USER_TOKEN?>" data-idcustomproduct="<?php echo $row->ID_CUSTOM_PRODUCT; ?>">
                </div>
            </td>
            <td><strong><?php echo format_currency($row->CUSTOM_PRICE * $row->QUANTITY); ?></strong></td>
            <td><a href="#" class="remove-cart-item" data-idcustomproduct="<?php echo $row->ID_CUSTOM_PRODUCT; ?>" style="font-size: 1.5em; color: #000;"><i class="ion-close-circled"></i></a></td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>

<script>
$(document).ready(function() {
    $('.change-quantity').bind("keyup change",function(e) {
        e.preventDefault();
        var usertoken = $(this).data('usertoken');
        var idcustomproduct = $(this).data('idcustomproduct');
        $.ajax({
            url: base_url + '/api/order/change_quantity_product_and_update_order_product_price',
            type: "post",
            beforeSend: function(xhr){
                xhr.setRequestHeader('APP_TOKEN', app_token);
                xhr.setRequestHeader('USER_TOKEN', usertoken);
            },
            data: {ID_CUSTOM_PRODUCT: idcustomproduct, QUANTITY: e.target.value},
            success: function(response) {
                window.location = base_url + '/cart';
            }
        });
    });

    $(".remove-cart-item").click(function(e) {
        e.preventDefault();
        var idcustomproduct = $(this).data('idcustomproduct');
        var result = confirm("Want to remove this item?");
        if (result) {
            $.ajax({
                url: base_url + '/api/order/cancel_item_on_cart',
                type: "post",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('APP_TOKEN', app_token);
                },
                data: {ID_CUSTOM_PRODUCT: idcustomproduct},
                success: function(response) {
                    window.location = base_url + '/cart';
                }
            });
        }
    });
});
</script>
