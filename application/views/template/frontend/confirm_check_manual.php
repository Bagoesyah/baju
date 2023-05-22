<style>
table.payment_info tr td{border-bottom:1px solid #e3e3e3;padding:10px;}
</style>
<?php $get_price = !empty($sum_price_by_order_number->DATA) ? $sum_price_by_order_number->DATA->PRICE_TOTAL : 0; ?>
<?php $pg_price = (int) $get_price; ?>
<?php $get_order_number = !empty($sum_price_by_order_number->DATA) ? $sum_price_by_order_number->DATA->ORDER_NUMBER : ''; ?>
<div class="container">
    <div class="text-left">
        <div class="">
            <h4>Total amount to be paid: <span><?php echo format_currency($get_price); ?></span></h4>
        </div><br/>
    </div>
    <div class="clearfix"></div><br/>
    <div class="row text-left">
        <div class="col-lg-6">
            <div id="manual-transfer-content" class="payment-content">
                <h4>Manual Transfer</h4><br/>
                <?php
                if ($bank_list->num_rows() > 0) {
                    $row_bank = $bank_list->row();
                ?>
                <div style="padding:0 40px;">
                    <table class="payment_info" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="30%">Recipient Bank</td>
                            <td><?php echo $row_bank->bank_name; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Recipient Name</td>
                            <td><?php echo $row_bank->account_name; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Account Number</td>
                            <td><?php echo $row_bank->no_rek; ?></td>
                        </tr>
                    </table>
                    <div>
                        <br/>
                        <button style="background:#f19b51;border-color:#f39443;" type="button" class="btn btn-primary btn-block btn-confirm-payment">I have completed payment</button>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="" style="border:1px solid #e3e3e3;">
                <div class="detail-header" style="padding:10px;background:#626262;color:#FFF;">Detail Order</div>
                <div class="detail-order-time" style="text-align:center;padding:10px;">
                    <p>Mohon selesaikan pembayaran dalam</p>
                    <div class="countdown-timer" style="padding:10px 0;margin:0 20%;border:1px solid #ccc;">
                        <div class="countdown-container" id="count-timer"></div>
                    </div>
                </div>
                <div class="detail-order-number" style="text-align:center;font-size:16px;">
                    <p>Ordered number your T-Shirt <br/><strong><?php echo $get_order_number; ?></strong></p>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left">Payment Confirmation</h4>
      </div>
      <div class="modal-body" style="padding:15px 30px;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group text-left">
                        <label>Pilih Bank</label>
                        <select id="payment_list" class="form-control">
                        <?php
                        $q = $this->db->query("SELECT * FROM payment_list WHERE deleted_at IS NULL ORDER by bank_name ASC");
                        if ($q->num_rows() > 0) {
                            foreach ($q->result() as $row) {
                                ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->bank_name; ?></option>
                                <?php
                            }
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group text-left">
                        <label>Account Number</label>
                        <input type="text" name="acc_number" id="acc_number" placeholder="ex: 999000000" class="form-control">
                    </div>
                    <!--
                    <div class="form-group text-left">
                        <label>Cara Pembayaran</label>
                        <input type="text" name="pay_type" id="pay_type" placeholder="ex: Internet banking" class="form-control">
                    </div>
                    -->
                    <div class="form-group text-left">
                        <label>Notes</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group text-left">
                        <label>Account Name</label>
                        <input type="text" name="acc_name" id="acc_name" placeholder="ex: John Doe" class="form-control">
                    </div>
                    <div class="form-group text-left">
                        <label>Jumlah Dibayar</label>
                        <input type="text" name="pay_amount" id="pay_amount" placeholder="ex: 999000000" class="form-control">
                    </div>
                    <div class="form-group text-left">
                        <label>Upload Bukti Transfer</label>
                        <input class="form-control" type="file" name="bukti_transfer">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-bottom:0px;">Batal</button>
        <button type="button" class="btn btn-primary btn-confirm-submit" style="margin-bottom:0px;">Konfirmasi</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="myModalComplete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-left">Payment Confirmation</h4>
      </div>
      <div class="modal-body" style="padding:15px 30px;">
            <p>Terima kasih telah melakukan konfirmasi order.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-goto-profile" data-dismiss="modal" style="margin-bottom:0px;">Ok</button>
      </div>
    </div>
    </div>
</div>
<script>
$(function() {

    $('#count-timer').countdown('<?php echo $expired; ?>').on('update.countdown', function(event) {
        var $this = $(this).html(event.strftime(' '  
        + '<span class="timer-count">%H <span class="timer-text">jam</span></span> ' 
        + '<span class="timer-count">%M <span class="timer-text">menit</span></span> ' 
        + '<span class="timer-count">%S <span class="timer-text">detik</span></span>'));
    });

    $('.btn-confirm-payment').click(function(e) {
        e.preventDefault();
        $('#myModal').modal('show');
    });

    $('.btn-confirm-submit').click(function (e) {
        e.preventDefault();
        var imgFile = false;
        var file = $("input[type=file]")[0].files[0];

        $('.btn-confirm-submit').attr('disabled','disabled');
        $('.btn-confirm-submit').html('Processing...');
        $('.error_msg').remove();
        if ($('#payment_list').val() != '' && $('#acc_number').val() != '' && $('#pay_type').val() != '' && $('#acc_name').val() != '' && $('#pay_amount').val() != '') {
            
            if (file) {

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    $.ajax({
                        url: '<?php echo base_url('cart/set_confirm_payment'); ?>',
                        data: {
                            payment_list: $('#payment_list').val(),
                            acc_number: $('#acc_number').val(),
                            pay_type: $('#pay_type').val(),
                            acc_name: $('#acc_name').val(),
                            pay_amount: $('#pay_amount').val(),
                            img_file: reader.result,
                            order_num: '<?php echo $order_number; ?>',
                            notes: $('#notes').val()
                        },
                        dataType: 'json',
                        type: 'post',
                        success: function (d) {
                            if (d.status == 200) {
                                $('#myModal').modal('hide');
                                $('#myModalComplete').modal('show');
                                $('#myModalComplete').on('hide.bs.modal', function (e) {
                                    window.location.href="<?php echo base_url('dashboard/order-status'); ?>";
                                })
                            }
                            $('.btn-confirm-submit').removeAttr('disabled');
                            $('.btn-confirm-submit').html('Konfirmasi');
                        }
                    });
                };
                
            } else {
                $('.btn-confirm-submit').removeAttr('disabled');
                $('.btn-confirm-submit').html('Konfirmasi');
                $('.modal-body').prepend(
                    '<div class="error_msg alert alert-danger"><p>Please complete form below before continue.</p></div>'
                );
            }
        } else {
            $('.btn-confirm-submit').removeAttr('disabled');
            $('.btn-confirm-submit').html('Konfirmasi');
            $('.modal-body').prepend(
                '<div class="error_msg alert alert-danger"><p>Please complete form below before continue.</p></div>'
            );
        }
    });
})
</script>
