<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=1190, initial-scale=1, maximum-scale=1">
        <title>Invoice #<?php echo $orders[0]['order']->order_number; ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/invoice.css'); ?>">
    </head>
    <body>

    <!-- PRINT BUTTON -->
    <?php
    if ($this->input->get('ac') && $this->input->get('ac') == 'printButton') {
        ?>
        <div class="print-ex" style="padding: 20px 0;display:block;text-align:center;">
            <button type="button" onclick="window.print()">Print</button>
        </div>
        <?php
    }
    ?>
    <!-- END PRINT BUTTON -->

    <!-- BEGIN INVOICE -->
    <div id="print-container" class="print-container">

        <?php
        foreach ($orders as $value) {
            for ($j=1;$j<=$value['order']->quantity;$j++) {
        ?>
        
        <!-- BEGIN GREEN FORM -->
        <?php
        $option_checked = FALSE;
        if ($value['order']->option != 0 && $value['order']->option != '') {
            $option_checked = TRUE;
        }
        ?>
        <div class="table-page-container">
        <table class="main-table-green p10" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td colspan="2" valign="top">
                    <table class="main-table-green-header" width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td align="left" width="20%"><img style="width:135px;" src="<?php echo base_url("assets/img/Logo.png");?>" alt=""></td>
                            <td align="center"><strong>PATTERN ORDER SHIRT (FOR MEN) <br> ⯁ Order Form ⯁</strong></td>
                            <td align="right" width="20%">
                                <span style="display:block;">ORDER NO.: #<?php echo $orders[0]['order']->order_number; ?></span>
                                <span style="display:block;padding-top:5px;">ORDER DATE: <?php echo date('d',strtotime($orders[0]['order']->order_date)); ?>/<?php echo date('m',strtotime($orders[0]['order']->order_date)); ?>/<?php echo date('Y',strtotime($orders[0]['order']->order_date)); ?> Option <?php echo $option_checked ? '<img class="img-check img-check-header" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check img-check-header" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?></span></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- BEGIN MATERIAL -->
            <tr>

                <!-- BEGIN GREEN LEFT -->
                <td width="50%" valign="top" style="padding:10px 10px 0 0;">

                    <!-- FABRIC -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table" valign="top">01 Fabric</td>
                        </tr>
                        <tr>
                            <td class="inner-content" valign="top">
                                <span class="fabric-text">Fabric Code (4 Digits)</span>
                                <div class="left">
                                    <?php
                                    $fabric_code = str_split($value['order']->code_fabric);
                                    ?>
                                    <span class="square"><?php echo isset($fabric_code[0]) ? $fabric_code[0] : ''; ?></span>
                                    <span class="square" style="margin-left:-1px;"><?php echo isset($fabric_code[1]) ? $fabric_code[1] : ''; ?></span>
                                    <span class="square" style="margin-left:-1px;"><?php echo isset($fabric_code[2]) ? $fabric_code[2] : ''; ?></span>
                                    <span class="square" style="margin-left:-1px;"><?php echo isset($fabric_code[3]) ? $fabric_code[3] : ''; ?></span>
                                </div>
                                <span class="left square" style="width:58.5%;margin-left:10px;"><?php echo $value['order']->fabric_title; ?></span>
                            </td>
                        </tr>
                    </table>
                    <!-- END FABRIC -->

                    <!-- COLLAR -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table">02 Collar</td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                            <?php
                            if ($value['collar']->num_rows() > 0) {
                                foreach ($value['collar']->result() as $row_collar) {
                                    if ($row_collar->xform == 'green') {
                                    ?>
                                    <span class="img-collar-container">
                                        <img class="material-img" src="<?php echo base_url("assets/img/upload/material_collar/" . $row_collar->image);?>" alt="">
                                        <?php
                                            if ($row_collar->id == $value['order']->id_collar) {
                                                ?>
                                                <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                <?php
                                            } else {
                                                ?>
                                                <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                <?php
                                            }
                                        ?>
                                    </span>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            </td>
                        </tr>
                    </table>
                    <!-- END COLLAR -->

                    <!-- CUFF AND FRONT BODY -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td width="60%" valign="top" style="padding:0 10px 0 0;">

                                <!-- CUFF -->
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="header-table">03 Cuffs</td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content">
                                            <?php
                                            if ($value['cuff']->num_rows() > 0) {
                                                foreach ($value['cuff']->result() as $row_cuff) {
                                                    if ($row_cuff->category == 1 && $row_cuff->xform == 'green') {
                                                        ?>
                                                        <span class="cuff">
                                                            <img class="material-img" src="<?php echo base_url("assets/img/upload/material_cuff/" . $row_cuff->image);?>" alt="">
                                                            <?php
                                                                if ($row_cuff->id == $value['order']->id_cuff) {
                                                                    ?>
                                                                    <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                    <?php
                                                                }
                                                            ?>
                                                        </span>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php
                                            if ($value['cuff']->num_rows() > 0) {
                                                foreach ($value['cuff']->result() as $row_cuff) {
                                                    if ($row_cuff->category == 2 && $row_cuff->xform == 'green') {
                                                        ?>
                                                        <span class="cuff">
                                                            <img class="material-img" src="<?php echo base_url("assets/img/upload/material_cuff/" . $row_cuff->image);?>" alt="">
                                                            <?php
                                                                if ($row_cuff->id == $value['order']->id_sleeve) {
                                                                    ?>
                                                                    <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                    <?php
                                                                }
                                                            ?>
                                                        </span>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                                <!-- END CUFF -->

                            </td>
                            <td width="40%" valign="top" style="padding:0 0 0 10px;">

                                <!-- FRONT BODY -->
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="header-table">04 Front Body</td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content">
                                        <?php
                                        if ($value['body_type']->num_rows() > 0) {
                                            foreach ($value['body_type']->result() as $row_body_type) {
                                                if ($row_body_type->category == 1 && $row_body_type->xform == 'green') {
                                                    ?>
                                                    <span class="front-body">
                                                        <img class="material-img" style="width:100%;" src="<?php echo base_url("assets/img/upload/material_body_type/" . $row_body_type->image);?>" alt="">
                                                        <?php
                                                            if ($row_body_type->id == $value['order']->id_body_type_front) {
                                                                ?>
                                                                <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                <?php
                                                            }
                                                        ?>
                                                    </span>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                </table>
                                <!-- END FRONT BODY -->

                            </td>
                        </tr>
                    </table>
                    <!-- END CUFF AND FRONT BODY -->

                    <!-- POCKET AND HEM -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>

                            <!-- POCKET -->
                            <td width="60%" valign="top" style="padding:0 10px 0 0;">                                
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="header-table">05 Pocket</td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content">
                                        <?php
                                        if ($value['pocket']->num_rows() > 0) {
                                            foreach ($value['pocket']->result() as $row_pocket) {
                                                if ($row_pocket->xform == 'green') {
                                                ?>
                                                <span class="pocket">
                                                    <img class="material-img" src="<?php echo base_url("assets/img/upload/material_pocket/" . $row_pocket->image);?>" alt="">
                                                    <?php
                                                        if ($row_pocket->id == $value['order']->id_pocket) {
                                                            ?>
                                                            <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                            <?php
                                                        }
                                                    ?>
                                                </span>
                                                <?php
                                                }
                                            }
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <!-- END POCKET -->
                            
                            <!-- HEM -->
                            <td width="40%" valign="top" style="padding:0 0 0 10px;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="header-table">06 Hem</td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content">
                                        <?php
                                        if ($value['body_type']->num_rows() > 0) {
                                            foreach ($value['body_type']->result() as $row_body_type_hem) {
                                                if ($row_body_type_hem->category == 3 && $row_body_type_hem->xform == 'green') {
                                                ?>
                                                <span class="hem">
                                                    <img class="material-img" style="width:100%;" src="<?php echo base_url("assets/img/upload/material_body_type/" . $row_body_type_hem->image);?>" alt="">
                                                    <?php
                                                        if ($row_body_type_hem->id == $value['order']->id_body_type_hem) {
                                                            ?>
                                                            <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                            <?php
                                                        }
                                                    ?>
                                                </span>
                                                <?php
                                                }
                                            }
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <!-- END HEM -->

                        </tr>
                    </table>
                    <!-- END POCKET AND HEM -->

                    <!-- BACK BODY -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table">07 Back Body</td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                            <?php
                            if ($value['body_type']->num_rows() > 0) {
                                foreach ($value['body_type']->result() as $row_body_type_back) {
                                    if ($row_body_type_back->category == 2 && $row_body_type_back->xform == 'green') {
                                        ?>
                                        <span class="back-body">
                                            <img class="material-img" src="<?php echo base_url("assets/img/upload/material_body_type/" . $row_body_type_back->image);?>" alt="">
                                            <?php
                                                if ($row_body_type_back->id == $value['order']->id_body_type_back) {
                                                    ?>
                                                    <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                    <?php
                                                }
                                            ?>
                                        </span>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            </td>
                        </tr>
                    </table>
                    <!-- BACK BODY -->

                </td>
                <!-- END GREEN LEFT -->

                <!-- BEGIN GREEN RIGHT -->
                <td width="50%" valign="top" style="padding:10px 0 0 10px;">
                
                    <!-- BUTTONS -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table">08 Button</td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                            <?php
                            if ($value['button']->num_rows() > 0) {
                                foreach ($value['button']->result() as $row_button) {
                                    if ($row_button->xform == 'green') {
                                    ?>
                                    <span class="buttons">
                                        <img class="img-button" src="<?php echo base_url("assets/img/upload/material_buttons/" . $row_button->image);?>" alt="">
                                        <?php
                                            if ($row_button->id == $value['order']->id_button) {
                                                ?>
                                                <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                <?php
                                            } else {
                                                ?>
                                                <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                <?php
                                            }
                                        ?>
                                    </span>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            </td>
                        </tr>
                    </table>
                    <!-- END BUTTONS -->

                    <!-- SIZE -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table">Size</td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td width="17%">
                                            <span class="txt-size">1. New Order</span>
                                            <span class="right">
                                                <?php
                                                if ($value['order']->repeat_order == 0) {
                                                    ?>
                                                    <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                    <?php
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td align="right">
                                            <span class="txt-size">2. Repeat Order</span>
                                            <span class="right pl10">
                                                <?php
                                                if ($value['order']->repeat_order == 1) {
                                                    ?>
                                                    <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                    <?php
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td align="right">
                                            <span class="txt-size">3. Garment Sample</span>
                                            <span class="right pl10">
                                                <?php
                                                if ($value['order']->repeat_order == 2) {
                                                    ?>
                                                    <img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                    <?php
                                                }
                                                ?>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td width="15%"><span class="txt-box">Body Type</span></td>
                                        <td width="18%">
                                            <span class="txt-size" style="padding-left:38px;">2. Slim</span>
                                            <span class="right">
                                                <?php echo ($value['order']->body_type_selection == 'PM2') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?>
                                            </span>
                                        </td>
                                        <td width="27%">
                                            <span class="txt-size pl50">3. Standard I</span>
                                            <span class="right">
                                            <?php echo ($value['order']->body_type_selection == 'PM3') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?>
                                            </span>
                                        </td>
                                        <td align="right">
                                            <span class="txt-size">4. Standard II</span>
                                            <span class="right pl10">
                                            <?php echo ($value['order']->body_type_selection == 'PM4') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>
                                            <span class="txt-size" style="padding-left:35px;">5. Big I</span>
                                            <span class="right">
                                            <?php echo ($value['order']->body_type_selection == 'PM5') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="txt-size pl50">7. Big II</span>
                                            <span class="right">
                                            <?php echo ($value['order']->body_type_selection == 'PM7') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?>
                                            </span>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td><span class="txt-box">Sleeve</span></td>
                                        <td>
                                            <span class="txt-size">1. Slim Sleeve</span>
                                            <span class="right">
                                            <?php echo ($value['order']->sleeve_type_selection == 'slim') ? '<img style="float:right;" class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img style="float:right;" class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="txt-size pl30">2. Regular Sleeve</span>
                                            <span class="right">
                                            <?php echo ($value['order']->sleeve_type_selection == 'regular') ? '<img style="float:right;" class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img style="float:right;" class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?>
                                            </span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding-top:5px;">
                                            <table width="100%" cellpadding="5" cellspacing="0" border="1">
                                                <tr>
                                                    <td align="center">Measure</td>
                                                    <td align="center" width="14%">Neck</td>
                                                    <td align="center" width="14%">R. Sleeve</td>
                                                    <td align="center" width="14%">L. Sleeve</td>
                                                    <td align="center" width="14%">Chest</td>
                                                    <td align="center" width="14%">Waist</td>
                                                    <td align="center" width="14%">Shoulder</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">Shirt</td>
                                                    <td align="center"><?php echo ($value['size_check']) ? $value['real_size']->row()->neck : 0; ?></td>
                                                    <td align="center">-</td>
                                                    <td align="center">-</td>
                                                    <td align="center"><?php echo ($value['size_check']) ? $value['real_size']->row()->chest : 0; ?></td>
                                                    <td align="center"><?php echo ($value['size_check']) ? $value['real_size']->row()->waist : 0; ?></td>
                                                    <td align="center"><?php echo ($value['size_check']) ? $value['real_size']->row()->shoulder : 0; ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="center">Actual</td>
                                                    <td align="center"><?php echo ($value['size_check']) ? $value['order']->neck : 0; ?></td>
                                                    <td align="center"><?php echo ($value['size_check']) ?$value['order']->sleeve_length_right_selection : 0; ?></td>
                                                    <td align="center"><?php echo ($value['size_check']) ? $value['order']->sleeve_length_left_selection : 0; ?></td>
                                                    <td align="center"><?php echo ($value['size_check']) ? $value['order']->chest : 0; ?></td>
                                                    <td align="center"><?php echo ($value['size_check']) ? $value['order']->waist : 0; ?></td>
                                                    <td align="center"><?php echo ($value['size_check']) ? $value['order']->shoulder : 0; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding-top:5px;">
                                            <table width="100%" cellpadding="5" cellspacing="0" border="1">
                                                <tr>
                                                    <td width="31%">Special Adjustment</td>
                                                    <td>Neck Size: <?php echo ($value['size_check']) ? $value['order']->neck - $value['real_size']->row()->neck : 0; ?></td>
                                                    <td>Shoulder: <?php echo ($value['size_check']) ? $value['order']->shoulder - $value['real_size']->row()->shoulder : 0; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding-top:5px;">
                                            <span class="block bold">Note</span>
                                            <div class="notes"><?php echo !empty($value['order']->special_request_verify) ? $value['order']->special_request_verify : '&nbsp;'; ?></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellpadding="5" cellspacing="0" border="0">
                        <tr>
                            <td style="border:1px solid red;padding:5px;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td colspan="7" class="bold" style="padding-bottom:5px;">Total Price</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">
                                            <table width="100%" cellpadding="2" cellspacing="0" border="1">
                                                <tr>
                                                    <td align="center">Base</td>
                                                </tr>
                                                <tr align="center">
                                                    <td><?php echo number_format($value['order']->base / $value['order']->quantity,0,',','.'); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="2%" align="center">+</td>
                                        <td width="20%">
                                            <table width="100%" cellpadding="2" cellspacing="0" border="1">
                                                <tr>
                                                    <td align="center">Option</td>
                                                </tr>
                                                <tr>
                                                    <td align="center"><?php echo number_format($value['order']->option / $value['order']->quantity,0,',','.'); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="2%" align="center">+</td>
                                        <td width="20%">
                                            <table width="100%" cellpadding="2" cellspacing="0" border="1">
                                                <tr>
                                                    <td align="center">Delivery Cost</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="2%" align="center">=</td>
                                        <td width="20%">
                                            <table width="100%" cellpadding="2" cellspacing="0" border="1">
                                                <tr>
                                                    <td align="center">Total</td>
                                                </tr>
                                                <tr align="center">
                                                    <td><?php echo number_format($value['order']->custom_price,0,',','.'); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="mt5">
                        <tr>
                            <td width="75%">
                                <table width="100%" cellpadding="5" cellspacing="0" border="1">
                                    <tr>
                                        <td colspan="2" width="59%" align="center">Membership Number</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="22%" align="center" style="padding:10px 0;">Name</td>
                                        <td colspan="8"><?php echo $value['shipping']->row()->name; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="padding:10px 0;">Address</td>
                                        <td colspan="8"><?php echo $value['shipping']->row()->address; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center">Tel/HP</td>
                                        <td colspan="8"><?php echo $value['shipping']->row()->hp; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center">Email</td>
                                        <td colspan="8"><?php echo $value['shipping']->row()->email; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="center">Handling Date</td>
                                        <td colspan="8"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding-left:5px;" valign="top">
                                <table width="100%" cellpadding="5" cellspacing="0" border="1">
                                    <tr>
                                        <td align="center">Customer<br/>Sign</td>
                                    </tr>
                                    <tr>
                                        <td style="height:39px;">&nbsp;</td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="5" cellspacing="0" border="1" style="margin-top:5px;">
                                    <tr>
                                        <td align="center">Store Sign</td>
                                    </tr>
                                    <tr>
                                        <td style="height:39px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- END SIZE -->

                </td>
                <!-- END GREEN RIGHT -->

            </tr>
            <!-- END MATERIAL -->

        </table><!-- End main-table-green -->
        </div>
        <!-- END GREEN FORM -->

        <!-- BEGIN BLUE FORM -->
        <div class="table-page-container" style="height:auto;padding-bottom:43px;">
        <table class="main-table-blue" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td colspan="2" valign="top">
                    <table class="main-table-green-header" width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td align="left" width="40%"><img style="width:135px;" src="<?php echo base_url("assets/img/Logo.png");?>" alt=""></td>
                            <td align="center"><strong>PATTERN ORDER SHIRT (FOR MEN) <br> <span style="color:#FF0000;">⯁ Option Form ⯁</span></strong></td>
                            <td align="right" width="40%">
                                <span style="display:block;">ORDER NO.: #<?php echo $orders[0]['order']->order_number; ?></span>
                                <div class="inline pt5">
                                    <span class="left pt5 pr10">Fabric Code</span>
                                    <span class="square"><?php echo isset($fabric_code[0]) ? $fabric_code[0] : ''; ?></span>
                                    <span class="square" style="margin-left:-1px;"><?php echo isset($fabric_code[1]) ? $fabric_code[1] : ''; ?></span>
                                    <span class="square" style="margin-left:-1px;"><?php echo isset($fabric_code[2]) ? $fabric_code[2] : ''; ?></span>
                                    <span class="square" style="margin-left:-1px;"><?php echo isset($fabric_code[3]) ? $fabric_code[3] : ''; ?></span>
                                    <span class="square" style="width:170px;margin-left:10px;"><?php echo $value['order']->fabric_title; ?></span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- BEGIN BLUE INVOICE -->
            <?php
            $x50 = 0;
            $x30 = 0;
            $x70 = 0;
            $x100 = 0;
            ?>
            <tr>

                <!-- BEGIN BLUE LEFT -->
                <td width="45%" valign="top" style="padding:0 10px 0 0;">
                
                    <!-- COLLAR -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table" valign="top" colspan="2">02 Collar</td>
                        </tr>
                        <tr>
                            <td class="inner-content" valign="top" width="36%">
                            <?php
                            if ($value['collar']->num_rows() > 0) {
                                foreach ($value['collar']->result() as $row_collar) {
                                    if ($row_collar->xform == 'blue' && $row_collar->additional_charge == 0) {
                                    ?>
                                    <span class="txt-checkbox full-width left">
                                        <?php
                                        if ($row_collar->id == $value['order']->id_collar) {
                                        ?>
                                        <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_collar->title; ?></span>
                                        <?php
                                        } else {
                                        ?>
                                        <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_collar->title; ?></span>
                                        <?php
                                        }
                                        ?>
                                    </span>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <span class="item-no-charge-txt"><b>&#8903;</b> &nbsp;No additional charge for above items </span>
                            </td>
                            <td class="inner-content" valign="top">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="border-red">
                                            <div style="width:50%;float:left;box-sizing:border-box;">
                                            <?php
                                            $check_collar_50 = FALSE;
                                            $i_collar = 1;
                                            if ($value['collar']->num_rows() > 0) {
                                                foreach ($value['collar']->result() as $row_collar) {
                                                    if ($row_collar->xform == 'blue' && $row_collar->additional_charge == 1 && $row_collar->price == 50000 && $i_collar <= 3) {
                                                        if ($row_collar->id == $value['order']->id_collar) {
                                                            $check_collar_50 = TRUE;
                                                            $x50++;
                                                        ?>
                                                        <span class="txt-checkbox full-width left">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?>
                                                        </span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                        <span class="txt-checkbox full-width left">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?>
                                                        </span>
                                                        <?php
                                                        $i_collar++;
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            </div>
                                            <div style="width:50%;float:left;box-sizing:border-box;">
                                                <?php
                                                $s_collar = 1;
                                                if ($value['collar']->num_rows() > 0) {
                                                    foreach ($value['collar']->result() as $row_collar) {
                                                        if ($row_collar->xform == 'blue' && $row_collar->additional_charge == 1 && $row_collar->price == 50000) {
                                                            if ($s_collar > 3) {
                                                                if ($row_collar->id == $value['order']->id_collar) {
                                                                    $check_collar_50 = TRUE;
                                                                    $x50++;
                                                                ?>
                                                                <span class="txt-checkbox full-width left">
                                                                    <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?>
                                                                </span>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                <span class="txt-checkbox full-width left">
                                                                    <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?>
                                                                </span>
                                                                <?php
                                                                }
                                                            }
                                                            $s_collar++;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <span class="price-right right pt5">
                                                    <span>Rp. 50.000</span>
                                                    <span>
                                                    <?php
                                                    if ($check_collar_50) {
                                                    ?>
                                                    <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                    <?php
                                                    }
                                                    ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-red">
                                        <div style="width:100%;float:left;box-sizing:border-box;">
                                            <?php
                                            $check_collar_100 = FALSE;
                                            if ($value['collar']->num_rows() > 0) {
                                                foreach ($value['collar']->result() as $row_collar) {
                                                    if ($row_collar->xform == 'blue' && $row_collar->additional_charge == 1 && $row_collar->price == 100000) {
                                                        if ($row_collar->id == $value['order']->id_collar) {
                                                            $check_collar_100 = TRUE;
                                                            $x100++;
                                                        ?>
                                                        <span class="txt-checkbox full-width left">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?>
                                                        </span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                        <span class="txt-checkbox full-width left">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?>
                                                        </span>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            </div>
                                            <div style="width:100%;float:left;box-sizing:border-box;">
                                                <?php
                                                if ($check_collar_100) {
                                                    $str_collar_fabric = $fabric_code;
                                                    if (!empty($value['order']->cleric_type) && !empty($value['order']->id_cleric)) {
                                                        if ($value['order']->cleric_type == 1 || $value['order']->cleric_type == 2) {
                                                            $str_collar_fabric = str_split($value['order']->code_fabric_cleric);
                                                        }
                                                    }
                                                }
                                                ?>
                                                <span class="left" style="padding:5px 5px 0 0;">Fabric Code (4 Digits)</span>
                                                <span class="square"><?php echo isset($str_collar_fabric[0]) ? $str_collar_fabric[0] : ''; ?></span>
                                                <span class="square" style="margin-left:-1px;"><?php echo isset($str_collar_fabric[1]) ? $str_collar_fabric[1] : ''; ?></span>
                                                <span class="square" style="margin-left:-1px;"><?php echo isset($str_collar_fabric[2]) ? $str_collar_fabric[2] : ''; ?></span>
                                                <span class="square" style="margin-left:-1px;"><?php echo isset($str_collar_fabric[3]) ? $str_collar_fabric[3] : ''; ?></span>
                                                <span class="price-right right pt5">
                                                    <span>Rp. 100.000</span>
                                                    <span>
                                                    <?php
                                                    if ($check_collar_100) {
                                                    ?>
                                                    <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                    <?php
                                                    }
                                                    ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- END COLLAR -->

                    <!-- CUFFS -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table" valign="top" colspan="2">03 Cuffs</td>
                        </tr>
                        <tr>
                            <td class="inner-content" valign="top" width="36%">
                            <?php
                            if ($value['cuff']->num_rows() > 0) {
                                foreach ($value['cuff']->result() as $row_cuff) {
                                    if ($row_cuff->xform == 'blue' && $row_cuff->additional_charge == 0) {
                                    ?>
                                    <span class="txt-checkbox full-width left">
                                        <?php
                                        if ($row_cuff->id == $value['order']->id_cuff) {
                                        ?>
                                        <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_cuff->title; ?></span>
                                        <?php
                                        } else {
                                        ?>
                                        <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_cuff->title; ?></span>
                                        <?php
                                        }
                                        ?>
                                    </span>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <span class="item-no-charge-txt"><b>&#8903;</b> &nbsp;No additional charge for above items </span>
                            </td>
                            <td class="inner-content" valign="top">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="border-red">
                                        <?php
                                        $check_cuff_70 = FALSE;
                                        if ($value['cuff']->num_rows() > 0) {
                                            foreach ($value['cuff']->result() as $row_cuff) {
                                                if ($row_cuff->xform == 'blue' && $row_cuff->additional_charge == 1 && $row_cuff->price == 70000) {
                                                    ?>
                                                    <span class="txt-checkbox left">
                                                    <?php
                                                    if ($row_cuff->id == $value['order']->id_cuff) {
                                                        $check_cuff_70 = TRUE;
                                                        $x70++;
                                                    ?>
                                                    <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_cuff->title; ?></span>
                                                    <?php
                                                    } else {
                                                        $check_cuff_70 = FALSE;
                                                    ?>
                                                    <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_cuff->title; ?></span>
                                                    <?php
                                                    }
                                                    ?>
                                                </span>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <span class="price-right right">
                                            <span>Rp. 70.000</span>
                                            <span>
                                            <?php
                                            if ($check_cuff_70) {
                                            ?>
                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                            <?php
                                            } else {
                                            ?>
                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                            <?php
                                            }
                                            ?>
                                            </span>
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-red">
                                        <?php
                                        $check_cuff_100 = FALSE;
                                        if ($value['cuff']->num_rows() > 0) {
                                            foreach ($value['cuff']->result() as $row_cuff) {
                                                if ($row_cuff->xform == 'blue' && $row_cuff->additional_charge == 1 && $row_cuff->price == 100000) {
                                                    ?>
                                                    <span class="txt-checkbox left full-width">
                                                    <?php
                                                    if ($row_cuff->id == $value['order']->id_cuff) {
                                                        $check_cuff_100 = TRUE;
                                                        $x100++;
                                                    ?>
                                                    <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_cuff->title; ?></span>
                                                    <?php
                                                    } else {
                                                        $check_cuff_100 = FALSE;
                                                    ?>
                                                    <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_cuff->title; ?></span>
                                                    <?php
                                                    }
                                                    ?>
                                                </span>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="block">
                                            <?php
                                            if ($check_cuff_100) {
                                                $str_cuff_fabric = $fabric_code;
                                                if (!empty($value['order']->cleric_type) && !empty($value['order']->id_cleric)) {
                                                    if ($value['order']->cleric_type == 1 || $value['order']->cleric_type == 2) {
                                                        $str_cuff_fabric = str_split($value['order']->code_fabric_cleric);
                                                    }
                                                }
                                            }
                                            ?>
                                            <span class="left" style="padding:5px 5px 0 0;">Fabric Code (4 Digits)</span>
                                            <span class="square"><?php echo isset($str_cuff_fabric[0]) ? $str_cuff_fabric[0] : ''; ?></span>
                                            <span class="square" style="margin-left:-1px;"><?php echo isset($str_cuff_fabric[1]) ? $str_cuff_fabric[1] : ''; ?></span>
                                            <span class="square" style="margin-left:-1px;"><?php echo isset($str_cuff_fabric[2]) ? $str_cuff_fabric[2] : ''; ?></span>
                                            <span class="square" style="margin-left:-1px;"><?php echo isset($str_cuff_fabric[3]) ? $str_cuff_fabric[3] : ''; ?></span>
                                            <span class="price-right right pt5">
                                                <span>Rp. 100.000</span>
                                                <span>
                                                <?php
                                                if ($check_cuff_100) {
                                                ?>
                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                <?php
                                                } else {
                                                ?>
                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                <?php
                                                }
                                                ?>
                                                </span>
                                            </span>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td class="header-table" valign="top" colspan="2">04 Front Body</td>
                                                </tr>
                                                <tr>
                                                    <td class="inner-content">
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td class="border-red">
                                                                <span class="txt-checkbox left">
                                                                <?php
                                                                $check_front_body_70 = FALSE;
                                                                if ($value['body_type']->num_rows() > 0) {
                                                                    foreach ($value['body_type']->result() as $row_body_type) {
                                                                        if ($row_body_type->category == 1 && $row_body_type->xform == 'blue' && $row_body_type->price == 70000) {
                                                                            if ($row_body_type->id == $value['order']->id_body_type_front) {
                                                                                $check_front_body_70 = TRUE;
                                                                                $x70++;
                                                                            ?>
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_body_type->title; ?></span>
                                                                                <?php
                                                                            } else {
                                                                                $check_front_body_70 = FALSE;
                                                                            ?>
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_body_type->title; ?></span>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                </span>
                                                                <span class="price-right right">
                                                                    <span>Rp. 70.000</span>
                                                                    <span>
                                                                    <?php
                                                                    if ($check_front_body_70) {
                                                                    ?>
                                                                    <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                    <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    </span>
                                                                </span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- END CUFFS -->

                    <!-- BUTTON & BODY SNAP BUTTONS -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>

                            <!-- BUTTON -->
                            <td valign="top" width="60%" style="padding:0 5px 0 0;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="header-table" valign="top" colspan="2">08 Button</td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td class="border-red">
                                                    <?php
                                                    $button_shell_x100 = FALSE;
                                                    if ($value['button']->num_rows() > 0) {
                                                        foreach ($value['button']->result() as $row_button) {
                                                            if ($row_button->xform == 'blue' && $row_button->price == 100000) {
                                                                if ($value['order']->id_button == $row_button->id) {
                                                                    $button_shell_x100 = TRUE;
                                                                    $x100++;
                                                                    ?>
                                                                    <span class="txt-checkbox left full-width">
                                                                        <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button->title; ?></span>
                                                                    </span>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <span class="txt-checkbox left pt5" style="padding-right:10px;">
                                                                        <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button->title; ?></span>
                                                                    </span>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                        <span class="square"></span>
                                                        <span class="square" style="margin-left:-1px;"></span>
                                                        <span class="square" style="margin-left:-1px;"></span>
                                                        <span class="square" style="margin-left:-1px;"></span>
                                                        <span class="price-right right pt5">
                                                            <span>Rp. 100.000</span>
                                                            <span>
                                                            <?php
                                                            if ($button_shell_x100) {
                                                            ?>
                                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                            <?php
                                                            } else {
                                                            ?>
                                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                            <?php
                                                            }
                                                            ?>
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <!-- END BUTTON -->

                            <!-- BODY SNAP BUTTONS -->
                            <td valign="top" width="40%" style="padding:0 0 0 5px;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="header-table" valign="top" colspan="2">09 Body Snap Button</td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td class="border-red">
                                                        <span class="txt-checkbox left pt5" style="padding-right:10px;">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display" style="font-size:10px;">2.5 Snap Button</span>
                                                        </span>
                                                        <span class="price-right right pt5">
                                                            <span>Rp. 50.000</span>
                                                            <span><img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"></span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <!-- END BODY SNAP BUTTONS -->

                        </tr>
                    </table>
                    <!-- END BUTTON & BODY SNAP BUTTONS -->

                    <!-- CLERIC -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table" valign="top">10 Cleric</td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    </tr>
                                        <td class="border-red">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td width="60%">
                                                    <?php
                                                    if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 1 && !empty($value['order']->id_cleric)) {
                                                        ?>
                                                        <span class="txt-checkbox left full-width">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display">1 Collar,Collar Stand,Cuffs</span>
                                                        </span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="txt-checkbox left full-width">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display">1 Collar,Collar Stand,Cuffs</span>
                                                        </span>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 2 && !empty($value['order']->id_cleric)) {
                                                        ?>
                                                        <span class="txt-checkbox left full-width">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display">2 Collar,Collar stand,Cuffs,Front placket</span>
                                                        </span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="txt-checkbox left full-width">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display">2 Collar,Collar stand,Cuffs,Front placket</span>
                                                        </span>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 3 && !empty($value['order']->id_cleric)) {
                                                        ?>
                                                        <span class="txt-checkbox left full-width">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display">3 Inner collar stand,inner cuffs</span>
                                                        </span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="txt-checkbox left full-width">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display">3 Inner collar stand,inner cuffs</span>
                                                        </span>
                                                        <?php
                                                    }
                                                    ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($value['order']->cleric_type) && !empty($value['order']->id_cleric) && ($value['order']->cleric_type == 1 || $value['order']->cleric_type == 2 || $value['order']->cleric_type == 3)) {
                                                            $str_cleric1 = str_split($value['order']->code_fabric_cleric);
                                                            $x50++;
                                                        }
                                                        ?>
                                                        <div class="block">Fabric Code (4 Digits)</div>
                                                        <div class="block pt5">
                                                            <span class="square"><?php echo isset($str_cleric1[0]) ? $str_cleric1[0] : ''; ?></span>
                                                            <span class="square" style="margin-left:-1px;"><?php echo isset($str_cleric1[1]) ? $str_cleric1[1] : ''; ?></span>
                                                            <span class="square" style="margin-left:-1px;"><?php echo isset($str_cleric1[2]) ? $str_cleric1[2] : ''; ?></span>
                                                            <span class="square" style="margin-left:-1px;"><?php echo isset($str_cleric1[3]) ? $str_cleric1[3] : ''; ?></span>
                                                            <span class="price-right right pt5">
                                                                <span>Rp. 50.000</span>
                                                                <span>
                                                                <?php
                                                                if (!empty($value['order']->cleric_type) && !empty($value['order']->id_cleric) && ($value['order']->cleric_type == 1 || $value['order']->cleric_type == 2 || $value['order']->cleric_type == 3)) {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                <?php
                                                                }
                                                                ?>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tr>
                                        <td class="border-red">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td width="60%" valign="bottom">
                                                    <?php
                                                    if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 4 && !empty($value['order']->id_cleric)) {
                                                        ?>
                                                        <span class="txt-checkbox left full-width">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display">4 Inner Collar Stand,Inner Cuffs,Lower Placket</span>
                                                        </span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="txt-checkbox left full-width">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display">4 Inner Collar Stand,Inner Cuffs,Lower Placket</span>
                                                        </span>
                                                        <?php
                                                    }
                                                    ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($value['order']->cleric_type) && !empty($value['order']->id_cleric) && $value['order']->cleric_type == 4) {
                                                            $str_cleric4 = str_split($value['order']->code_fabric_cleric);
                                                            $x100++;
                                                        }
                                                        ?>
                                                        <div class="block">Fabric Code (4 Digits)</div>
                                                        <div class="block pt5">
                                                            <span class="square"><?php echo isset($str_cleric4[0]) ? $str_cleric4[0] : ''; ?></span>
                                                            <span class="square" style="margin-left:-1px;"><?php echo isset($str_cleric4[1]) ? $str_cleric4[1] : ''; ?></span>
                                                            <span class="square" style="margin-left:-1px;"><?php echo isset($str_cleric4[2]) ? $str_cleric4[2] : ''; ?></span>
                                                            <span class="square" style="margin-left:-1px;"><?php echo isset($str_cleric4[3]) ? $str_cleric4[3] : ''; ?></span>
                                                            <span class="price-right right pt5">
                                                                <span>Rp. 100.000</span>
                                                                <span>
                                                                <?php
                                                                if (!empty($value['order']->cleric_type) && !empty($value['order']->id_cleric) && $value['order']->cleric_type == 4) {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                <?php
                                                                }
                                                                ?>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- END CLERIC -->

                    <!-- NAME -->
                    <table width="70%" cellpadding="10" cellspacing="0" border="1">
                        <tr>
                            <td width="15%">Name</td>
                            <td><?php echo $value['shipping']->row()->name; ?></td>
                        </tr>
                    </table>

                </td>
                <!-- END BLUE LEFT -->

                <!-- BEGIN BLUE RIGHT -->
                <td width="55%" valign="top" style="padding:0 0 0 10px;">

                    <!-- BUTTON HOLE, BUTTON THREAD & STITCH THREAD -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>

                            <!-- BUTTON HOLE -->
                            <td valign="top" width="33%" style="padding-right:2px;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="header-table" valign="top">11 Button Hole</td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content" valign="top">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                </tr>
                                                    <td class="border-red">
                                                    <div style="width:50%;box-sizing: border-box;float:left;">
                                                    <?php
                                                    $check_button_hole_30 = FALSE;
                                                    $i_bhole = 1;
                                                    if ($value['button_hole']->num_rows() > 0) {
                                                        foreach ($value['button_hole']->result() as $row_button_hole) {
                                                            if ($row_button_hole->xform == 'blue' && $row_button_hole->price == 30000) {
                                                                if ($i_bhole <= 5) {
                                                                    if ($row_button_hole->id == $value['order']->id_button_hole) {
                                                                        $check_button_hole_30 = TRUE;
                                                                        $x30++;
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button_hole->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                    } else {
                                                                        if (!$check_button_hole_30) $check_button_hole_30 = FALSE;
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button_hole->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                    }
                                                                    $i_bhole++;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    </div>
                                                    <div style="width:50%;box-sizing: border-box;float:left;">
                                                    <?php
                                                    $i_bhole = 1;
                                                    if ($value['button_hole']->num_rows() > 0) {
                                                        foreach ($value['button_hole']->result() as $row_button_hole) {
                                                            if ($row_button_hole->xform == 'blue' && $row_button_hole->price == 30000) {
                                                                if ($i_bhole > 5) {
                                                                    if ($row_button_hole->id == $value['order']->id_button_hole) {
                                                                        $check_button_hole_30 = TRUE;
                                                                        $x30++;
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button_hole->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                    } else {
                                                                        if (!$check_button_hole_30) $check_button_hole_30 = FALSE;
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button_hole->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                    }
                                                                }
                                                                $i_bhole++;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    </div>
                                                    <div class="left full-width pt5">
                                                        <span class="price-right right pt5">
                                                            <span>Rp. 30.000</span>
                                                            <span>
                                                            <?php
                                                            if ($check_button_hole_30) {
                                                            ?>
                                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                            <?php
                                                            } else {
                                                            ?>
                                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                            <?php
                                                            }
                                                            ?>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <!-- END BUTTON HOLE -->

                            <!-- BUTTON THREAD -->
                            <td valign="top" width="33%" style="padding-left:2px;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="header-table" valign="top">12 Button Thread</td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content" valign="top">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                </tr>
                                                    <td class="border-red">
                                                        <div style="width:50%;box-sizing: border-box;float:left;">
                                                        <?php
                                                        $check_button_thread_30 = FALSE;
                                                        $i_bthread = 1;
                                                        if ($value['button_thread']->num_rows() > 0) {
                                                            foreach ($value['button_thread']->result() as $row_button_thread) {
                                                                if ($row_button_thread->xform == 'blue' && $row_button_thread->price == 30000) {
                                                                    if ($i_bthread <= 5) {
                                                                        if ($row_button_thread->id == $value['order']->id_button_thread) {
                                                                            $check_button_thread_30 = TRUE;
                                                                            $x30++;
                                                                            ?>
                                                                            <span class="txt-checkbox left full-width">
                                                                                <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button_thread->title; ?></span>
                                                                            </span>
                                                                            <?php
                                                                        } else {
                                                                            if (!$check_button_thread_30) $check_button_thread_30 = FALSE;
                                                                            ?>
                                                                            <span class="txt-checkbox left full-width">
                                                                                <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button_thread->title; ?></span>
                                                                            </span>
                                                                            <?php
                                                                        }
                                                                        $i_bthread++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </div>
                                                        <div style="width:50%;box-sizing: border-box;float:left;">
                                                        <?php
                                                        $i_bthread = 1;
                                                        if ($value['button_thread']->num_rows() > 0) {
                                                            foreach ($value['button_thread']->result() as $row_button_thread) {
                                                                if ($row_button_thread->xform == 'blue' && $row_button_thread->price == 30000) {
                                                                    if ($i_bthread > 5) {
                                                                        if ($row_button_thread->id == $value['order']->id_button_thread) {
                                                                            $check_button_thread_30 = TRUE;
                                                                            $x30++;
                                                                            ?>
                                                                            <span class="txt-checkbox left full-width">
                                                                                <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button_thread->title; ?></span>
                                                                            </span>
                                                                            <?php
                                                                        } else {
                                                                            if (!$check_button_thread_30) $check_button_thread_30 = FALSE;
                                                                            ?>
                                                                            <span class="txt-checkbox left full-width">
                                                                                <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_button_thread->title; ?></span>
                                                                            </span>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    $i_bthread++;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </div>
                                                        <div class="left full-width pt5">
                                                            <span class="price-right right pt5">
                                                                <span>Rp. 30.000</span>
                                                                <span>
                                                                <?php
                                                                if ($check_button_thread_30) {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                <?php
                                                                }
                                                                ?>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <!-- END BUTTON THREAD -->

                            <!-- STITCH THREAD -->
                            <td valign="top" width="33%" style="padding-left:4px;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="header-table" valign="top">13 Stitch Thread</td>
                                    </tr>
                                    <tr>
                                        <td class="inner-content" valign="top">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                </tr>
                                                    <td class="border-red">
                                                        <div style="width:50%;box-sizing: border-box;float:left;">
                                                        <?php
                                                        $i_thread = 1;
                                                        $check_amf_stitch_50 = FALSE;
                                                        if ($value['option']->num_rows() > 0) {
                                                            foreach ($value['option']->result() as $row_option) {
                                                                if ($row_option->category == 1 && $row_option->xform == 'blue' && $row_option->price == 50000) {
                                                                    if ($i_thread <= 5) {
                                                                        if ($row_option->id == $value['order']->id_option_amf_stitch) {
                                                                            $check_amf_stitch_50 = TRUE;
                                                                            $x50++;
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                        } else {
                                                                            if (!$check_amf_stitch_50) $check_amf_stitch_50 = FALSE;
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                        }
                                                                        $i_thread++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </div>
                                                        <div style="width:50%;box-sizing: border-box;float:left;">
                                                        <?php
                                                        $i_thread = 1;
                                                        if ($value['option']->num_rows() > 0) {
                                                            foreach ($value['option']->result() as $row_option) {
                                                                if ($row_option->category == 1 && $row_option->xform == 'blue' && $row_option->price == 50000) {
                                                                    if ($i_thread > 5) {
                                                                        if ($row_option->id == $value['order']->id_option_amf_stitch) {
                                                                            $check_amf_stitch_50 = TRUE;
                                                                            $x50++;
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                        } else {
                                                                            if (!$check_amf_stitch_50) $check_amf_stitch_50 = FALSE;
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    $i_thread++;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </div>
                                                        <div class="left full-width pt5">
                                                            <span class="price-right right pt5">
                                                                <span>Rp. 50.000</span>
                                                                <span>
                                                                <?php
                                                                if ($check_amf_stitch_50) {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                <?php
                                                                }
                                                                ?>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <!-- END STITCH THREAD -->

                        </tr>
                    </table>
                    <!-- END BUTTON HOLE, BUTTON THREAD & STITCH THREAD -->

                    <!-- EMBROIDERY -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table" valign="top">14 Embroidery</td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="border-red" style="padding:0px;" valign="top">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td style="border-bottom:1px dashed #929292;padding:5px;" valign="top">
                                                        <span class="block" style="text-align:center;padding-bottom:5px;">Position</span>
                                                        <div style="width:100%;float:left;">
                                                        <?php
                                                        if ($value['embroidery']->num_rows() > 0) {
                                                            foreach ($value['embroidery']->result() as $row_embroidery_position) {
                                                                if ($row_embroidery_position->category == 1 && $row_embroidery_position->xform == 'blue') {
                                                                    if ($row_embroidery_position->id == $value['order']->id_embroidery_position) {
                                                                    ?>
                                                                    <span class="txt-checkbox left full-width">
                                                                        <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_embroidery_position->title; ?></span>
                                                                    </span>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                    <span class="txt-checkbox left full-width">
                                                                        <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_embroidery_position->title; ?></span>
                                                                    </span>
                                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </div>
                                                    </td>
                                                    <td style="border-bottom:1px dashed #929292;border-right:1px dashed #929292;border-left:1px dashed #929292;padding:5px;" width="33%" valign="top">
                                                        <span class="block" style="text-align:center;padding-bottom:5px;">Color</span>
                                                        <div style="width:50%;float:left;">
                                                        <?php
                                                        $i_ecolor = 1;
                                                        if ($value['embroidery']->num_rows() > 0) {
                                                            foreach ($value['embroidery']->result() as $row_embroidery_color) {
                                                                if ($row_embroidery_color->category == 3 && $row_embroidery_color->xform == 'blue') {
                                                                    if ($i_ecolor <= 5) {
                                                                        if ($row_embroidery_color->id == $value['order']->id_embroidery_color) {
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_embroidery_color->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_embroidery_color->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                        }
                                                                        $i_ecolor++;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </div>
                                                        <div style="width:50%;float:left;">
                                                        <?php
                                                        $i_ecolor = 1;
                                                        if ($value['embroidery']->num_rows() > 0) {
                                                            foreach ($value['embroidery']->result() as $row_embroidery_color) {
                                                                if ($row_embroidery_color->category == 3 && $row_embroidery_color->xform == 'blue') {
                                                                    if ($i_ecolor > 5) {
                                                                        if ($row_embroidery_color->id == $value['order']->id_embroidery_color) {
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_embroidery_color->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                        <span class="txt-checkbox left full-width">
                                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_embroidery_color->title; ?></span>
                                                                        </span>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    $i_ecolor++;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </div>
                                                    </td>
                                                    <td style="border-bottom:1px dashed #929292;padding:5px;" width="33%" valign="top">
                                                        <span class="block" style="text-align:center;padding-bottom:5px;">Font Type</span>
                                                        <div style="width:100%;float:left;">
                                                        <?php
                                                        if ($value['embroidery']->num_rows() > 0) {
                                                            foreach ($value['embroidery']->result() as $row_embroidery_font) {
                                                                if ($row_embroidery_font->category == 2 && $row_embroidery_font->xform == 'blue') {
                                                                    if ($row_embroidery_font->id == $value['order']->id_embroidery_font) {
                                                                    ?>
                                                                    <span class="txt-checkbox left full-width">
                                                                        <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_embroidery_font->title; ?></span>
                                                                    </span>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                    <span class="txt-checkbox left full-width">
                                                                        <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_embroidery_font->title; ?></span>
                                                                    </span>
                                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="padding:5px;">
                                                        <?php
                                                        if (!empty($value['order']->embroidery_text)) {
                                                            $str = str_split($value['order']->embroidery_text);
                                                        }
                                                        ?>
                                                        <span class="square"><?php echo isset($str[0]) ? $str[0] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[1]) ? $str[1] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[2]) ? $str[2] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[3]) ? $str[3] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[4]) ? $str[4] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[5]) ? $str[5] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[6]) ? $str[6] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[7]) ? $str[7] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[8]) ? $str[8] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[9]) ? $str[9] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[10]) ? $str[10] : ''; ?></span>
                                                        <span class="square" style="margin-left:-1px;"><?php echo isset($str[11]) ? $str[11] : ''; ?></span>
                                                        <span class="item-no-charge-txt block" style="float:left;width:65%;padding-top:5px;">&#8903; please write down your initial (font type 1,2,3) or long name (font type 4) into above boxes</span>
                                                        <span class="price-right right pt5">
                                                            <span>Rp. 50.000</span>
                                                            <span>
                                                            <?php
                                                            if (!empty($value['order']->embroidery_text) && !empty($value['order']->id_embroidery_font) && !empty($value['order']->id_embroidery_color) && !empty($value['order']->id_embroidery_position)) {
                                                            $x50++;
                                                            ?>
                                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                            <?php
                                                            } else {
                                                            ?>
                                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                            <?php
                                                            }
                                                            ?>
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- END EMBROIDERY -->

                    <!-- INTERLINING -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table" valign="top">15 Interlining</td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <?php
                                        $i_interlining = 1;
                                        $check_interlining_100 = FALSE;
                                        if ($value['option']->num_rows() > 0) {
                                            foreach ($value['option']->result() as $row_option) {
                                                if ($row_option->category == 2 && $row_option->xform == 'blue' && $row_option->price == 100000) {
                                                    if ($row_option->id == $value['order']->id_option_interlining) {
                                                        $check_interlining_100 = TRUE;
                                                        $x100++;
                                                    ?>
                                                    <td class="border-red" width="<?php echo $i_interlining == 1 ? '40%' : '60%'; ?>">
                                                        <span class="txt-checkbox left">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option->title; ?></span>
                                                        </span>
                                                        <?php
                                                        if ($i_interlining > 1) {
                                                            ?>
                                                            <span class="price-right right pt5">
                                                                <span>Rp. 100.000</span>
                                                                <span>
                                                                <?php
                                                                if ($check_interlining_100) {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                <?php
                                                                }
                                                                ?>
                                                                </span>
                                                            </span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <td class="border-red" width="<?php echo $i_interlining == 1 ? '40%' : '60%'; ?>">
                                                        <span class="txt-checkbox left">
                                                            <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option->title; ?></span>
                                                        </span>
                                                        <?php
                                                        if ($i_interlining > 1) {
                                                            ?>
                                                            <span class="price-right right pt5">
                                                                <span>Rp. 100.000</span>
                                                                <span>
                                                                <?php
                                                                if ($check_interlining_100) {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                                <?php
                                                                }
                                                                ?>
                                                                </span>
                                                            </span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <?php
                                                    }
                                                    $i_interlining++;
                                                }
                                            }
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- END INTERLINING -->

                    <!-- SEWING OPTION -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table" valign="top">16 Sewing Option</td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="border-red" valign="top">
                                        <?php
                                        $check_sewing_100 = FALSE;
                                        if ($value['option']->num_rows() > 0) {
                                            foreach ($value['option']->result() as $row_option_sewing) {
                                                if ($row_option_sewing->category == 3 && $row_option_sewing->xform == 'blue' && $row_option_sewing->price == 100000) {
                                                    if ($row_option_sewing->id == $value['order']->id_option_sewing) {
                                                        $check_sewing_100 = TRUE;
                                                        $x100++;
                                                    ?>
                                                    <span class="txt-checkbox left">
                                                        <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option_sewing->title; ?></span>
                                                    </span>
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <span class="txt-checkbox left">
                                                        <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option_sewing->title; ?></span>
                                                    </span>
                                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        <span class="price-right right pt5">
                                            <span>Rp. 100.000</span>
                                            <span>
                                            <?php
                                            if ($check_sewing_100) {
                                            ?>
                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                            <?php
                                            } else {
                                            ?>
                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                            <?php
                                            }
                                            ?>
                                            </span>
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-red" valign="top">
                                        <?php
                                        $check_sewing_200 = FALSE;
                                        if ($value['option']->num_rows() > 0) {
                                            foreach ($value['option']->result() as $row_option_sewing) {
                                                if ($row_option_sewing->category == 3 && $row_option_sewing->xform == 'blue' && $row_option_sewing->price == 200000) {
                                                    if ($row_option_sewing->id == $value['order']->id_option_sewing) {
                                                        $check_sewing_200 = TRUE;
                                                        $x100 = $x100 + 2;
                                                    ?>
                                                    <span class="txt-checkbox left">
                                                        <img class="img-check left" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option_sewing->title; ?></span>
                                                    </span>
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <span class="txt-checkbox left">
                                                        <img class="img-check left" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"><span class="left txt-display"><?php echo $row_option_sewing->title; ?></span>
                                                    </span>
                                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        <span class="price-right right pt5">
                                            <span>Rp. 200.000</span>
                                            <span>
                                            <?php
                                            if ($check_sewing_200) {
                                            ?>
                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                            <?php
                                            } else {
                                            ?>
                                            <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                            <?php
                                            }
                                            ?>
                                            </span>
                                        </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- END SEWING OPTION -->

                    <!-- TAPE -->
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td class="header-table" valign="top">17 Tape (Inner Collar Stand &amp; Lower Placket)</td>
                        </tr>
                        <tr>
                            <td class="inner-content">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td class="border-red" valign="top">
                                            <?php
                                            $check_tape_70 = FALSE;
                                            if ($value['option']->num_rows() > 0) {
                                                foreach ($value['option']->result() as $row_option_tape) {
                                                    if ($row_option_tape->category == 4 && $row_option_tape->xform == 'blue' && $row_option_tape->price == 70000) {
                                                        if ($row_option_tape->id == $value['order']->id_option_tape) {
                                                            $check_tape_70 = TRUE;
                                                            $tape_title = $row_option_tape->title;
                                                            $x70++;
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            <span class="square"></span>
                                            <span class="square" style="margin-left:-1px;"></span>
                                            <span class="square" style="margin-left:-1px;"></span>
                                            <span class="square" style="margin-left:-1px;"></span>
                                            <span class="square" style="width:150px;margin-left:10px;"><?php echo ($check_tape_70) ? $tape_title : ''; ?></span>
                                            <span class="price-right right pt5">
                                                <span>Rp. 70.000</span>
                                                <span>
                                                <?php
                                                if ($check_tape_70) {
                                                ?>
                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                                <?php
                                                } else {
                                                ?>
                                                <img style="margin:-1px 0 0 5px;" class="img-check right" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                                <?php
                                                }
                                                ?>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- END TAPE -->

                    <!-- TOTAL OPTION -->
                    <table width="56%" cellpadding="2" cellspacing="0" border="1">
                        <tr>
                            <td colspan="2" width="17%" align="center">Option</td>
                            <td width="17%" align="center">Quantity</td>
                            <td width="22%" align="center">Subtotal</td>
                        </tr>
                        <tr>
                            <td width="2%" align="center">A</td>
                            <td align="right">30.000</td>
                            <td align="center"><?php echo $x30; ?></td>
                            <td align="right"><?php echo number_format($x30 * 30000,0,',','.'); ?></td>
                        </tr>
                        <tr>
                            <td align="center">B</td>
                            <td align="right">50.000</td>
                            <td align="center"><?php echo $x50; ?></td>
                            <td align="right"><?php echo number_format($x50 * 50000,0,',','.'); ?></td>
                        </tr>
                        <tr>
                            <td align="center">C</td>
                            <td align="right">70.000</td>
                            <td align="center"><?php echo $x70; ?></td>
                            <td align="right"><?php echo number_format($x70 * 70000,0,',','.'); ?></td>
                        </tr>
                        <tr>
                            <td align="center">D</td>
                            <td align="right">100.000</td>
                            <td align="center"><?php echo $x100; ?></td>
                            <td align="right"><?php echo number_format($x100 * 100000,0,',','.'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center">Option Total</td>
                            <td align="right"><?php echo number_format(($x30 * 30000) + ($x50 * 50000) + ($x70 * 70000) + ($x100 * 100000),0,',','.'); ?></td>
                        </tr>
                    </table>
                    <!-- END TOTAL OPTION -->

                </td>
                <!-- END BLUE RIGHT -->                                                

            </tr>
            <!-- END BLUE INVOICE -->

        </table><!-- End main-table-blue -->
        </div>
        <!-- END BLUE FORM -->

        <?php
        }
    }
        ?>

    </div><!-- End print-container -->
    <!-- END INVOICE -->

    <!-- BEGIN SCRIPT -->
    <script
    src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="<?php echo base_url('assets/js/html2canvas.min.js'); ?>"></script>
    <script>
    $(document).ready(function() {

        setTimeout(function() {
            window.scrollTo(0, 0);
            html2canvas(document.getElementById('print-container')).then(function(canvas) {
                //var pdf = new jsPDF("p","mm","a4");
                $('.print-container').addClass('canvas-image');
                var imgData = canvas.toDataURL('image/png');
                
                $('.print-container').html('').append('<img class="img-canvas" style="width:100%;">');
                $('.img-canvas').attr('src', imgData);
                //var width = pdf.internal.pageSize.width;
                //var height = pdf.internal.pageSize.height;
                //pdf.addImage(imgData, 0, 0, width, height);
                //pdf.save("invoice_<?php echo $orders[0]['order']->order_number; ?>.pdf");
            });
        },100);
    });
    </script>
    </body>
</html>
