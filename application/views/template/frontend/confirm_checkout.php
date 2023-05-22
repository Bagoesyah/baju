<style>
.btn-check-payment.btn-choosen{background:#5b75ae;color:#FFF;}
#cc-content{display:none;}
#manual-transfer-content li{padding:5px 5px 5px 0;width:45%;display:inline-block;list-style:none;}
</style>
<?php $get_price = !empty($sum_price_by_order_number->DATA) ? $sum_price_by_order_number->DATA->PRICE_TOTAL : 0; ?>
<?php $pg_price = (int) $get_price; ?>
<?php $get_order_number = !empty($sum_price_by_order_number->DATA) ? $sum_price_by_order_number->DATA->ORDER_NUMBER : ''; ?>
<div class="container">
    <div class="text-left">
        <div class="">
            <h4>Total amount to be paid: <span><?php echo format_currency($get_price); ?></span></h4>
        </div><br/>
        <div class="" style="display:inline-block;">
            <div id="manual-button" class="manual-button btn-check-payment btn-choosen" style="min-width:200px;border:1px solid #ccc;border-radius:5px;float:left;">
                <div class="pull-left" style="padding:40px 20px;">
                    <input type="radio" data-show="manual-transfer-content" name="payment_method" value="transfer" checked="checked" class="manual-button">
                </div>
                <div class="pull-right" style="padding:10px 20px;text-align:center;">
                    <img src="<?php echo base_url('assets/img/coin.png'); ?>"><br/>Manual Transfer
                </div>
            </div>
        </div>
        <div class="" style="display:inline-block;margin-left:20px;">
            <div id="cc-button" class="cc-button btn-check-payment" style="min-width:200px;border:1px solid #ccc;border-radius:5px;float:left;">
                <div class="pull-left" style="padding:40px 20px;">
                    <input type="radio" data-show="cc-content" name="payment_method" value="cc" class="manual-button">
                </div>
                <div class="pull-right" style="padding:10px 20px;text-align:center;">
                    <img src="<?php echo base_url('assets/img/credit-card.png'); ?>"><br/>Credit Card
                </div>
            </div>
        </div>
    </div><br/>
    <div class="clearfix"></div>
    <div class="row text-left">
        <div class="col-lg-12">
            <div class="acc-card-type" style="padding:10px 20px;background:#e3e3e3;">
                Accepted Card Type: &nbsp;&nbsp;&nbsp;&nbsp; <span><img src="<?php echo base_url('assets/img/visa.png'); ?>"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><img src="<?php echo base_url('assets/img/mastercard.png'); ?>"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><img src="<?php echo base_url('assets/img/maestro.png'); ?>"></span>
            </div>
        </div>
    </div><br/>
    <div class="row text-left">
        <div class="col-lg-6">
            <div id="manual-transfer-content" class="payment-content">
                <h4><strong>Manual Transfer</strong></h4><br/>
                <form method="post" action="<?php echo site_url('cart/confirm_check_manual'); ?>">
                    <div class="">
                        <span style="display:block;">Pilih bank tujuan transfer:</span><br/>
                        <div class="">
                            <?php
                            if ($bank_list->num_rows() > 0) {
                                $i = 1;
                                foreach($bank_list->result() as $row_bank) {
                                    ?>
                                    <li style=""><input <?php echo ($i==1) ? 'checked="checked"' : '' ?> type="radio" name="bank_name" value="<?php echo $row_bank->id; ?>"> <span><?php echo $row_bank->bank_name; ?></span></li>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                        <div>
                            <br/>
                            <p><a style="color:#dc7317;" href="">Terms &amp; Conditions</a></p><br/>
                            <button style="background:#f19b51;border-color:#f39443;" type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="cc-content" class="payment-content">
                <h4><strong>Credit Card Payment</strong></h4><br/>
                <div class="">
                    <a href="<?php echo site_url("payment/proceed?ORDER_NUMBER={$get_order_number}&PRICE=$pg_price"); ?>" class="btn btn-primary btn-block">Proceed To Payment</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="" style="border:1px solid #e3e3e3;">
                <div class="detail-header" style="padding:10px;background:#626262;color:#FFF;">Detail Order</div>
                <div class="detail-order-number" style="text-align:center;font-size:16px;">
                    <p><br/>Ordered number your T-Shirt <br/><strong><?php echo $get_order_number; ?></strong></p>
                </div>
                <div class="detail-product-list" style="padding:10px;">
                <?php
                if (isset($order_products)) {
                    foreach ($order_products->DATA as $product) {
                        ?>
                        <div class="col-lg-3">
                            <?php
                            if (!empty($product->IMAGE_CUSTOM)) {
                                ?>
                                <img style="width:100%" src="<?php echo base_url('assets/img/img_order/' . $product->IMAGE_CUSTOM); ?>">
                                <?php
                            } else {
                                ?>
                                <img style="width:100%" src="<?php echo base_url($product->PATH . $product->IMAGE); ?>">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-lg-9">
                            <?php
                            $q_custom = $this->db->query("
                                SELECT 
                                    c.embroidery_text,
                                    c.special_request_verify,
                                    c.cleric_type,
                                    c.id_cleric,
                                    f.title AS fabric_title,
                                    col.title AS collar_title,
                                    cu.title AS cuff_title,
                                    po.title AS pocket_title,
                                    sl.title AS sleeve_title,
                                    btf.title AS body_type_front_title,
                                    btb.title AS body_type_back_title,
                                    bth.title AS body_type_hem_title,
                                    btn.title AS button_title,
                                    btnth.title AS button_thread_title,
                                    btnh.title AS button_hole_title,
                                    emb.title AS embroidery_position,
                                    emf.title AS embroidery_font,
                                    emc.title AS embroidery_color,
                                    optamf.title AS option_amf_title,
                                    optin.title AS option_interlining_title,
                                    optsew.title AS option_sewing_title,
                                    opttp.title AS option_tape_title,
                                    mtcl.code_fabric AS cleric_fabric_code,
                                    mtcl.title AS cleric_title
                                FROM custom_product c 
                                LEFT JOIN material_fabric f ON f.id = c.id_fabric 
                                LEFT JOIN material_collar col ON col.id = c.id_collar
                                LEFT JOIN material_cuff cu ON cu.id = c.id_cuff
                                LEFT JOIN material_pocket po ON po.id = c.id_pocket
                                LEFT JOIN material_buttons btn ON btn.id = c.id_button
                                LEFT JOIN material_buttons btnth ON btnth.id = c.id_button_thread
                                LEFT JOIN material_buttons btnh ON btnh.id = c.id_button_hole
                                LEFT JOIN material_cuff sl ON sl.id = c.id_sleeve
                                LEFT JOIN material_body_type btf ON btf.id = c.id_body_type_front 
                                LEFT JOIN material_body_type btb ON btb.id = c.id_body_type_back
                                LEFT JOIN material_body_type bth ON bth.id = c.id_body_type_hem
                                LEFT JOIN material_embroidery emb ON emb.id = c.id_embroidery_position
                                LEFT JOIN material_embroidery emf ON emf.id = c.id_embroidery_font
                                LEFT JOIN material_embroidery emc ON emc.id = c.id_embroidery_color
                                LEFT JOIN material_option optamf ON optamf.id = c.id_option_amf_stitch
                                LEFT JOIN material_option optin ON optin.id = c.id_option_interlining
                                LEFT JOIN material_option optsew ON optsew.id = c.id_option_sewing
                                LEFT JOIN material_option opttp ON opttp.id = c.id_option_tape
                                LEFT JOIN material_cleric mtcl ON mtcl.id = c.id_cleric
                                WHERE c.id = ".$product->ID_CUSTOM_PRODUCT."
                            ");
                            if ($q_custom->num_rows() > 0) {
                                ?>
                                <span>Spec:</span><hr/>
                                <ol>
                                <?php
                                foreach($q_custom->result() as $row_custom) {

                                    $cleric_type = 'None';
                                    $cleric_fabric = 'None';
                                    if (!empty($row_custom->cleric_type) && !empty($row_custom->id_cleric) && !empty($row_custom->cleric_fabric_code)) {
                                        
                                        if ($row_custom->cleric_type == 1) {
                                            $cleric_type = 'Collar &amp; Cuffs';
                                        } else if ($row_custom->cleric_type == 2) {
                                            $cleric_type = 'Collar/Cuffs &amp; Front Placket';
                                        } else if ($row_custom->cleric_type == 3) {
                                            $cleric_type = 'Inner Collar Stand &amp; Inner Cuffs';
                                        } else if ($row_custom->cleric_type == 4) {
                                            $cleric_type = 'Inner Collar Stand/Inner Cuffs &amp; Lower Placket';
                                        }

                                        $cleric_fabric = $row_custom->cleric_title . ' ('.$row_custom->cleric_fabric_code.')';
                                    }

                                    ?>
                                    <li>Fabric: <?php echo !empty($row_custom->fabric_title) ? $row_custom->fabric_title : 'None'; ?></li>
                                    <li>Collar: <?php echo !empty($row_custom->collar_title) ? $row_custom->collar_title : 'None'; ?></li>
                                    <li>Cuff: <?php echo !empty($row_custom->cuff_title) ? $row_custom->cuff_title : 'None'; ?></li>
                                    <li>Sleeve: <?php echo !empty($row_custom->sleeve_title) ? $row_custom->sleeve_title : 'Long Sleeve'; ?></li>
                                    <li>Body Type: <br />Front: <?php echo !empty($row_custom->body_type_front_title) ? $row_custom->body_type_front_title : 'None'; ?><br/>Back: <?php echo !empty($row_custom->body_type_back_title) ? $row_custom->body_type_back_title : 'None'; ?><br/>Hem: <?php echo !empty($row_custom->body_type_hem_title) ? $row_custom->body_type_hem_title : 'None'; ?></li>
                                    <li>Pocket: <?php echo !empty($row_custom->pocket_title) ? $row_custom->pocket_title : 'None'; ?></li>
                                    <li>Button: <br />Button: <?php echo !empty($row_custom->button_title) ? $row_custom->button_title : 'None'; ?><br/>Button Hole: <?php echo !empty($row_custom->button_hole_title) ? $row_custom->button_hole_title : 'Match Fabric Color'; ?><br/>Button Thread: <?php echo !empty($row_custom->button_thread_title) ? $row_custom->button_thread_title : 'Match Fabric Color'; ?></li>
                                    <li>Cleric: <br />Type: <?php echo $cleric_type; ?><br />Fabric: <?php echo $cleric_fabric; ?></li>
                                    <li>Embroidery: <br />Position: <?php echo !empty($row_custom->embriodery_position) ? $row_custom->embriodery_position : 'None'; ?><br/>Font: <?php echo !empty($row_custom->embriodery_font) ? $row_custom->embriodery_font : 'None'; ?><br/>Color: <?php echo !empty($row_custom->embriodery_color) ? $row_custom->embriodery_color : 'None'; ?><br/>Text: <?php echo !empty($row_custom->embroidery_text) ? $row_custom->embroidery_text : '-'; ?></li>
                                    <li>Option: <br />Stitch Thread: <?php echo !empty($row_custom->option_amf_title) ? $row_custom->option_amf_title : 'None'; ?><br/>Interlining: <?php echo !empty($row_custom->option_interlining_title) ? $row_custom->option_interlining_title : 'Standard'; ?><br/>Sewing: <?php echo !empty($row_custom->option_sewing_title) ? $row_custom->option_sewing_title : 'Standard'; ?><br/>Tape: <?php echo !empty($row_custom->option_tape_title) ? $row_custom->option_tape_title : 'None'; ?></li>
                                    <li>Special Request: <?php echo !empty($row_custom->special_request_verify) ? $row_custom->special_request_verify : '-'; ?></li>
                                    <?php
                                }
                                ?>
                                </ol>
                                <span>Main Size:</span><hr/>
                                <ol>
                                <?php
                                $q_size = $this->db->query("
                                    SELECT 
                                        sz.*
                                    FROM custom_product_size sz
                                    WHERE sz.id_custom_product = ".$product->ID_CUSTOM_PRODUCT."
                                ");
                                ?>
                                <li>Around Neck: <?php echo !empty($q_size->row()->around_neck_selection) ? $q_size->row()->around_neck_selection : '-'; ?></li>
                                <li>Sleeve Length Right: <?php echo !empty($q_size->row()->sleeve_length_right_selection) ? $q_size->row()->sleeve_length_right_selection : '-'; ?></li>
                                <li>Sleeve Length Left: <?php echo !empty($q_size->row()->sleeve_length_left_selection) ? $q_size->row()->sleeve_length_left_selection : '-'; ?></li>
                                <li>Body Type: <?php echo !empty($q_size->row()->body_type_selection) ? $q_size->row()->body_type_selection : '-'; ?></li>
                                <li>Sleeve Type: <?php echo !empty($q_size->row()->sleeve_type_selection) ? $q_size->row()->sleeve_type_selection : '-'; ?></li>
                                </ol>
                                <span>Size:</span><hr/>
                                <ol>
                                <li>Neck: <?php echo !empty($q_size->row()->neck) ? $q_size->row()->neck : '-'; ?></li>
                                <li>Shoulder: <?php echo !empty($q_size->row()->shoulder) ? $q_size->row()->shoulder : '-'; ?></li>
                                <li>Chest: <?php echo !empty($q_size->row()->chest) ? $q_size->row()->chest : '-'; ?></li>
                                <li>Waist: <?php echo !empty($q_size->row()->waist) ? $q_size->row()->waist : '-'; ?></li>
                                <li>Hip: <?php echo !empty($q_size->row()->hip) ? $q_size->row()->hip : '-'; ?></li>
                                <li>Arm Hole: <?php echo !empty($q_size->row()->arm_hole) ? $q_size->row()->arm_hole : '-'; ?></li>
                                <li>Back Length (~88cm): <?php echo !empty($q_size->row()->back_length_88) ? $q_size->row()->back_length_88 : '-'; ?></li>
                                <li>Back Length (89cm~): <?php echo !empty($q_size->row()->back_length_89) ? $q_size->row()->back_length_89 : '-'; ?></li>
                                <li>Aloha (~88cm): <?php echo !empty($q_size->row()->aloha_88) ? $q_size->row()->aloha_88 : '-'; ?></li>
                                <li>Aloha (89cm~): <?php echo !empty($q_size->row()->aloha_89) ? $q_size->row()->aloha_89 : '-'; ?></li>
                                <li>Cuffs Circle: <?php echo !empty($q_size->row()->cuffs_circle) ? $q_size->row()->cuffs_circle : '-'; ?></li>
                                <li>Short Sleeve: <?php echo !empty($q_size->row()->short_sleeve) ? $q_size->row()->short_sleeve : '-'; ?></li>
                                <li>Sleeve Circle: <?php echo !empty($q_size->row()->sleeve_circle) ? $q_size->row()->sleeve_circle : '-'; ?></li>
                                </ol>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>
                <div>
                <div class="clearfix"></div>
            </div>
            <hr/>
            <div class="detail-footer" style="padding-bottom:10px;text-align:center;">
                <h4 style="color:#d42727;">TOTAL AMOUNT TO BE PAID <span style="display:block;margin-top:10px;font-weight:bold;color:#000;"><?php echo format_currency($get_price); ?></span></h4>
                <span>(Termasuk biaya pajak)</span>
                <div class="clearfix"></div>
            </div>

            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('input[name=payment_method]').on('click', function() {
        var payContent = $(this).attr('data-show');
        $('.payment-content').hide();
        $('#' + payContent).show();
        $('.btn-check-payment').removeClass('btn-choosen');
        $(this).closest('.btn-check-payment').addClass('btn-choosen');
    });
})
</script>
