<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=960, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/stylesheets/style.min.css'); ?>">
    <style>
    @media all {
    .material-list img{width:100%;max-width: 100% !important;}
    div[class*='col-']{padding-left:5px !important;padding-right:5px !important;}
    img.img-check{width:18px;max-width: 100% !important;}
    .material-list label{display:block;text-align:center;}
    label.radio-inline{display:inline-block;width:125px;text-align:left;}
    .radio-no-padding label{margin:0 !important;padding:0 !important;}
    .radio-no-padding label span img{float:right;}
    .repeat-check label.radio-inline{width:145px;padding-left:0px;}
    .repeat-check label.radio-inline img.img-check{float:left;margin-right:10px;}
    .repeat-check label.radio-inline span{display:inline-block;}
    .panel-primary {
	border: 0px solid #ffffff;
}
.panel-heading-costume {
	background-color: #92B5DD;
	padding: 10px;
}
.panel-heading-costume span {
	color: #ffffff;
}
.hor-clear {
	padding-left: 0px;
}
.ver-clear {
	padding-right: 0px;
}
.border-costume {
	border: 1px solid red;
}
.dashed {
	border-style: dashed solid red;
}
/*input[type=checkbox]
{
  -ms-transform: scale(2.1);
  -moz-transform: scale(2.1);
  -webkit-transform: scale(2.1);
  -o-transform: scale(2.1); 
  padding: 8px;
}*/

 hr{
    height: 10px;
    color: red; /* old IE */
}

.form-costume input[type=text] {
  font-family: inherit;
  font-size: inherit;
  line-height: inherit;
  width: 38px !important;
  height: 38px !important;
}
    }
    @media print {
        body * {
            visibility: hidden;
        }
        #print-container, #print-container * {
            visibility: visible;
        }
        #print-container {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
    </style>
    <script>
    var base_url = "<?php echo base_url(); ?>";
    </script>
    <title>Invoice #<?php echo $orders[0]['order']->order_number; ?></title>
</head>
<body>
<?php
if ($this->input->get('ac') && $this->input->get('ac') == 'printButton') {
    ?>
    <div class="print-ex" style="padding: 20px 0;display:block;text-align:center;">
        <button type="button" onclick="window.print()">Print</button>
    </div>
    <?php
}
?>
<div id="print-container" class="container" style="min-width:960px;padding-top:20px;padding-bottom:20px;">
    <div class="col-xs-4">
        <img src="<?php echo base_url("assets/img/Logo.png");?>" alt="">
    </div>
    <div class="col-xs-4">
        <h4 class="text-center">PATTERN ORDER SHIRT (FOR MEN) <br> ⯁ Order Form ⯁ </h4>
    </div>
    <div class="col-xs-4">
        <?php
        foreach ($orders as $value) {
            if ($value['order']->option != 0 && $value['order']->option != '') {
                $option_checked = true;
            }
        }
        ?>
        <h4 class="text-right"> Order No.: #<?php echo $orders[0]['order']->order_number; ?><br> Order Date.: <?php echo date('d',strtotime($orders[0]['order']->order_date)); ?>/<?php echo date('m',strtotime($orders[0]['order']->order_date)); ?>/<?php echo date('Y',strtotime($orders[0]['order']->order_date)); ?> Option <?php echo isset($option_checked) ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?></h4>
    </div>
    <?php
    foreach ($orders as $value) {
        ?>
        <div class="clearfix"></div><br/>
        <div class="col-xs-6">
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">01 Fabric </div>
                    <div class="panel-body">
                        <div class="col-xs-4">
                            <span style="padding-top:10px;display:block;"><strong>Fabric Code(4 Digit)</strong></span>                
                        </div>
                        <div class="col-xs-4">
                            <table class="table table-bordered" border="1" style="margin-bottom:0px;">
                                <?php
                                $fabric_code = str_split($value['order']->code_fabric);
                                ?>
                            <td align="center"><?php echo isset($fabric_code[0]) ? $fabric_code[0] : ''; ?></td>
                            <td align="center"><?php echo isset($fabric_code[1]) ? $fabric_code[1] : ''; ?></td>
                            <td align="center"><?php echo isset($fabric_code[2]) ? $fabric_code[2] : ''; ?></td>
                            <td align="center"><?php echo isset($fabric_code[3]) ? $fabric_code[3] : ''; ?></td>
                            </table>                
                        </div>
                        <div class="col-xs-4">
                            <table class="table table-bordered" border="1" style="margin-bottom:0px;">
                            <td><?php echo $value['order']->fabric_title; ?></td>
                            </table>                
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">02 Collar </div>
                    <div class="panel-body">
                            <?php
                            if ($value['collar']->num_rows() > 0) {
                                foreach ($value['collar']->result() as $row_collar) {
                                    if ($row_collar->xform == 'green') {
                                    ?>
                                    <div class="col-xs-3 material-list">
                                        <img src="<?php echo base_url("assets/img/upload/material_collar/" . $row_collar->image);?>" alt="">
                                        <label> <?php //echo $row_collar->id; ?> <?php //echo $row_collar->title; ?>
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
                                        <!-- <input type="radio" name="collar" value=""> -->
                                        </label>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                    </div>
                </div>
            </div><!-- End div col-xs-12 collar -->
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">03 Cuff </div>
                    <div class="panel-body">
                            <?php
                            if ($value['cuff']->num_rows() > 0) {
                                foreach ($value['cuff']->result() as $row_cuff) {
                                    if ($row_cuff->category == 1 && $row_cuff->xform == 'green') {
                                        ?>
                                        <div class="col-xs-4 material-list">
                                            <img src="<?php echo base_url("assets/img/upload/material_cuff/" . $row_cuff->image);?>" alt="">
                                            <label>
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
                                            </label>
                                        </div>
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
                                        <div class="col-xs-4 material-list">
                                            <img src="<?php echo base_url("assets/img/upload/material_cuff/" . $row_cuff->image);?>" alt="">
                                            <label>
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
                                            </label>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                    </div>
                </div>
            </div><!-- End div col-xs-8 Cuff -->
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">04 Front Body </div>
                    <div class="panel-body">
                            <?php
                            if ($value['body_type']->num_rows() > 0) {
                                foreach ($value['body_type']->result() as $row_body_type) {
                                    if ($row_body_type->category == 1 && $row_body_type->xform == 'green') {
                                        ?>
                                        <div class="col-xs-4 text-center">
                                            <img style="width:100%;" src="<?php echo base_url("assets/img/upload/material_body_type/" . $row_body_type->image);?>" alt="">
                                            <label>
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
                                            </label>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                    </div>
                </div>
            </div><!-- End div col-xs-4 Front Body -->
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">05 Pocket </div>
                    <div class="panel-body">
                            <?php
                            if ($value['pocket']->num_rows() > 0) {
                                foreach ($value['pocket']->result() as $row_pocket) {
                                    if ($row_pocket->xform == 'green') {
                                    ?>
                                    <div class="col-xs-3 material-list">
                                        <img src="<?php echo base_url("assets/img/upload/material_pocket/" . $row_pocket->image);?>" alt="">
                                        <label>
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
                                        </label>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                    </div>
                </div>
            </div><!-- End col-xs-8 pocket -->
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">06 Hem </div>
                    <div class="panel-body">
                            <?php
                            if ($value['body_type']->num_rows() > 0) {
                                foreach ($value['body_type']->result() as $row_body_type_hem) {
                                    if ($row_body_type_hem->category == 3 && $row_body_type_hem->xform == 'green') {
                                    ?>
                                    <div class="col-xs-4 text-center">
                                        <img style="width:100%;" src="<?php echo base_url("assets/img/upload/material_body_type/" . $row_body_type_hem->image);?>" alt="">
                                        <label>
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
                                        </label>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                    </div>
                </div>
            </div><!-- End col-xs-4 Hem -->
            <div class="clearfix"></div>
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">07 Back Body </div>
                    <div class="panel-body">
                            <?php
                            if ($value['body_type']->num_rows() > 0) {
                                foreach ($value['body_type']->result() as $row_body_type_back) {
                                    if ($row_body_type_back->category == 2 && $row_body_type_back->xform == 'green') {
                                        ?>
                                        <div class="col-xs-3 material-list">
                                            <img src="<?php echo base_url("assets/img/upload/material_body_type/" . $row_body_type_back->image);?>" alt="">
                                            <label>
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
                                            </label>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                    </div>
                </div>
            </div><!-- End col-xs-12 Back Body -->
        </div><!-- End Left -->
        <div class="col-xs-6">
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">08 Button </div>
                    <div class="panel-body">
                            <?php
                            if ($value['button']->num_rows() > 0) {
                                foreach ($value['button']->result() as $row_button) {
                                    if ($row_button->xform == 'green') {
                                    ?>
                                    <div class="col-xs-3 material-list">
                                        <img src="<?php echo base_url("assets/img/upload/material_buttons/" . $row_button->image);?>" alt="">
                                        <label>
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
                                        </label>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                    </div>
                </div>
            </div><!-- End col-xs-12 Button -->
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">Size </div>
                    <div class="panel-body">
                        <div class="form form-group">
                            <div class="col-xs-12 repeat-check">
                                <label class="radio-inline"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"> <span>1. New Order</span></label>
                                <label class="radio-inline"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"> <span>2. Repeat Order</span></label>
                                <label class="radio-inline"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>"> <span>3. Garment Sample</span></label>
                            </div>
                        </div>

                        <div class="clearfix"></div><br/>
                        <div style="float:left;padding:2px 5px;border:1px solid #ccc;">Body Type</div>
                        <div class="col-xs-10 material-list radio-no-padding body-type-selection">
                            <label class="radio-inline">2. Slim <span><?php echo ($value['order']->body_type_selection == 'PM2') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?></span></label>
                            <label class="radio-inline">3. Standard I  <span><?php echo ($value['order']->body_type_selection == 'PM3') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?></span></label>
                            <label class="radio-inline">4. Standard II  <span><?php echo ($value['order']->body_type_selection == 'PM4') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?></span></label>
                            <label class="radio-inline">5. Big I  <span><?php echo ($value['order']->body_type_selection == 'PM5') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?></span></label>
                            <label class="radio-inline">6. Big II  <span><?php echo ($value['order']->body_type_selection == 'PM7') ? '<img class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?></span></label>
                        </div>

                        <div class="clearfix"></div><br/>
                        <div style="float:left;padding:2px 5px;border:1px solid #ccc;">Sleeve</div>
                        <div class="col-xs-4 radio-no-padding">
                            1. Slim Sleeve <span><?php echo ($value['order']->sleeve_type_selection == 'slim') ? '<img style="float:right;" class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img style="float:right;" class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?></span>
                        </div>
                        <div class="col-xs-4 radio-no-padding">
                            2. Regular Sleeve <span><?php echo ($value['order']->sleeve_type_selection == 'regular') ? '<img style="float:right;" class="img-check" src="'.base_url('assets/img/check2-60x60.png').'">' : '<img style="float:right;" class="img-check" src="'.base_url('assets/img/uncheck2-60x60.png').'">'; ?></span>
                        </div>
                        
                        <div class="clearfix"></div><br/>
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>Measure</th>
                                    <th>Neck</th>
                                    <th>R.Sleeve</th>
                                    <th>L.Sleeve</th>
                                    <th>Chest</th>
                                    <th>Waist</th>
                                    <th>Shoulder</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>Shirt</td>
                                    <td><?php echo ($value['size_check']) ? $value['real_size']->row()->neck : 0; ?></td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td><?php echo ($value['size_check']) ? $value['real_size']->row()->chest : 0; ?></td>
                                    <td><?php echo ($value['size_check']) ? $value['real_size']->row()->waist : 0; ?></td>
                                    <td><?php echo ($value['size_check']) ? $value['real_size']->row()->shoulder : 0; ?></td>
                                    </tr>
                                    <tr>
                                    <td>Actual</td>
                                    <td><?php echo ($value['size_check']) ? $value['order']->neck : 0; ?></td>
                                    <td><?php echo ($value['size_check']) ?$value['order']->sleeve_length_right_selection : 0; ?></td>
                                    <td><?php echo ($value['size_check']) ? $value['order']->sleeve_length_left_selection : 0; ?></td>
                                    <td><?php echo ($value['size_check']) ? $value['order']->chest : 0; ?></td>
                                    <td><?php echo ($value['size_check']) ? $value['order']->waist : 0; ?></td>
                                    <td><?php echo ($value['size_check']) ? $value['order']->shoulder : 0; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>

                        <div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                    <td>Special Adjustment</td>
                                    <td>Neck Size</td>
                                    <td>Shoulder</td>
                                    </tr>
                                    <tr>
                                    <td>1</td>
                                    <td><?php echo ($value['size_check']) ? $value['order']->neck - $value['real_size']->row()->neck : 0; ?></td>
                                    <td><?php echo ($value['size_check']) ? $value['order']->shoulder - $value['real_size']->row()->shoulder : 0; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>

                        Note<br><textarea class="form form-control" name=""><?php echo $value['order']->special_request_verify; ?></textarea>
                        <div class="clearfix" style="padding-bottom:20px;"></div>
                        Total Price<br>

                        <div class="col-xs-3">
                            <div class="panel panel-success">
                                <div class="panel-heading" style="color:black">Base </div>
                                <div class="panel-body">
                                    <span><?php echo number_format($value['order']->base,0,'.',','); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="panel panel-success">
                                <div class="panel-heading" style="color:black">Option </div>
                                <div class="panel-body">
                                    <span><?php echo number_format($value['order']->option,0,'.',','); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="panel panel-success">
                                <div class="panel-heading" style="color:black">Delivery </div>
                                <div class="panel-body">
                                    <span>Free</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="panel panel-success">
                                <div class="panel-heading" style="color:black">Total </div>
                                <div class="panel-body">
                                    <span><?php echo number_format($value['order']->custom_price,0,'.',','); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-xs-12">
                            <table class="table table-bordered">
                            <tr>
                                <td>Membership Number</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td colspan="5"><?php echo $value['shipping']->row()->name; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td colspan="5"><?php echo $value['shipping']->row()->address; ?></td>
                            </tr>
                            <tr>
                                <td>Tel/Hp</td>
                                <td colspan="5"><?php echo $value['shipping']->row()->hp; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td colspan="5"><?php echo $value['shipping']->row()->email; ?></td>
                            </tr>
                            <tr>
                                <td>Handling Date</td>
                                <td colspan="5"></td>
                            </tr>            
                            </table>
                        </div>

                        <div class="col-xs-6">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="color:black">Customer's sign </div>
                                <div class="panel-body">
                                    <br/><br/><br/><br/>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="color:black">Store's Sign </div>
                                <div class="panel-body">
                                    <br/><br/><br/><br/>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div><!-- End right -->
<?php
    $x50 = 0;
    $x30 = 0;
    $x70 = 0;
    $x100 = 0;
    $x200 = 0;
    ?>
    <div class="clearfix" style="padding-bottom:100px;"></div>
	<br>
	<div class="col-xs-5">
		<div class="col-xs-12 hor-clear">
			<div class="panel panel-primary">
	  			<div class="panel-heading-costume"><span>02 COLLAR</span></div>
	  			<div class="panel-body hor-clear">
	  				<div class="col-xs-4">
		  				<div class="form-group">
                            <?php
                            if ($value['collar']->num_rows() > 0) {
                                foreach ($value['collar']->result() as $row_collar) {
                                    if ($row_collar->xform == 'blue' && $row_collar->additional_charge == 0) {
                                    ?>
                                    <div class="checkbox">
                                        <?php
                                        if ($row_collar->id == $value['order']->id_collar) {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?></label>
                                        <?php
                                        } else {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?></label>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
						</div>
						<span style="color: red;"><b>&#8903;</b> &nbsp;No additional charge for above items </span>	
	  				</div>
	  				<div class="col-xs-8">
                        <div class="col-xs-12 border-costume" style="min-height:53px;">
                            <?php
                            $check_collar_50 = FALSE;
                            if ($value['collar']->num_rows() > 0) {
                                foreach ($value['collar']->result() as $row_collar) {
                                    if ($row_collar->xform == 'blue' && $row_collar->additional_charge == 1 && $row_collar->price == 50000) {
                                    ?>
                                    <div class="col-xs-6 hor-clear">
                                        <div class="checkbox">
                                            <?php
                                            if ($row_collar->id == $value['order']->id_collar) {
                                                $check_collar_50 = TRUE;
                                                $x50++;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?></label>
                                            <?php
                                            } else {
                                                $check_collar_50 = FALSE;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?></label>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <div class="col-xs-12 ver-clear">
                                <div class="checkbox">
                                    <?php
                                    if ($check_collar_50) {
                                        ?>
                                        Rp 50.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                        <?php
                                    } else {
                                        ?>
                                        Rp 50.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 border-costume" style="min-height:53px; margin-top:5px;">
                            <?php
                            $check_collar_100 = FALSE;
                            if ($value['collar']->num_rows() > 0) {
                                foreach ($value['collar']->result() as $row_collar) {
                                    if ($row_collar->xform == 'blue' && $row_collar->additional_charge == 1 && $row_collar->price == 100000) {
                                    ?>
                                    <div class="col-xs-6 hor-clear">
                                        <div class="checkbox">
                                            <?php
                                            if ($row_collar->id == $value['order']->id_collar) {
                                                $check_collar_100 = TRUE;
                                                $x100++;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?></label>
                                            <?php
                                            } else {
                                                $check_collar_100 = FALSE;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_collar->title; ?></label>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <div class="col-xs-12 ver-clear">
                                <div class="checkbox">
                                    <?php
                                    if ($check_collar_100) {
                                        ?>
                                        Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                        <?php
                                    } else {
                                        ?>
                                        Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-xs-12" style="padding:5px 0px 5px;margin-top: -5px;">
                                    <b>&#8903;</b> Fabric Code (4 Digit)
                                </div>
                                <div class="col-xs-6 hor-clear ver-clear">
                                    <?php
                                    $fabric_code = $value['order']->code_fabric_cleric;
                                    if (!empty($value['order']->id_cleric) && ($value['order']->cleric_type == 1 || $value['order']->cleric_type == 2)) {
                                        $fabric_code = $value['order']->code_fabric_cleric;                                        
                                    }

                                    if ($check_collar_50 || $check_collar_100) {
                                        $str = str_split($fabric_code);
                                    }
                                    ?>
                                    <form action="">
                                        <input class="text-center" type="text" name="" value="<?php echo isset($str[0]) ? $str[0] : ''; ?>" maxlength="1" size="1">
                                        <input class="text-center" type="text" name="" value="<?php echo isset($str[1]) ? $str[1] : ''; ?>" maxlength="1" size="1">
                                        <input class="text-center" type="text" name="" value="<?php echo isset($str[2]) ? $str[2] : ''; ?>" maxlength="1" size="1">
                                        <input class="text-center" type="text" name="" value="<?php echo isset($str[3]) ? $str[3] : ''; ?>" maxlength="1" size="1">
                                    </form><br/>
                                </div>
                            </div>
                        </div>
                    </div><!-- End div col-8 -->
	  			</div>
			</div>
		</div>

		<div class="clearfix"></div>
		<!-- <br> -->

		<div class="col-xs-12 hor-clear">
			<div class="panel panel-primary">
	  			<div class="panel-heading-costume"><span>03 CUFFS</span></div>
	  			<div class="panel-body hor-clear">
	  				<div class="col-xs-4">
		  				<div class="form-group">
                            <?php
                            if ($value['cuff']->num_rows() > 0) {
                                foreach ($value['cuff']->result() as $row_cuff) {
                                    if ($row_cuff->xform == 'blue' && $row_cuff->additional_charge == 0) {
                                    ?>
                                    <div class="checkbox">
                                        <?php
                                        if ($row_cuff->id == $value['order']->id_cuff) {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_cuff->title; ?></label>
                                        <?php
                                        } else {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_cuff->title; ?></label>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
						</div>
						<span style="color: red;"><b>&#8903;</b> &nbsp;No additional charge for above items </span>	
	  				</div>
	  				<div class="col-xs-8">
                        <div class="col-xs-12 border-costume" style="">
                          <?php
                          $check_cuff_70 = FALSE;
                            if ($value['cuff']->num_rows() > 0) {
                                foreach ($value['cuff']->result() as $row_cuff) {
                                    if ($row_cuff->xform == 'blue' && $row_cuff->additional_charge == 1 && $row_cuff->price == 70000) {
                                    ?>
                                    <div class="col-xs-6 hor-clear">
                                        <div class="checkbox">
                                            <?php
                                            if ($row_cuff->id == $value['order']->id_cuff) {
                                                $check_cuff_70 = TRUE;
                                                $x70++;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_cuff->title; ?></label>
                                            <?php
                                            } else {
                                                $check_cuff_70 = FALSE;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_cuff->title; ?></label>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <div class="col-xs-12 hor-clear ver-clear">
                                <div class="col-xs-12 ver-clear">
                                    <div class="checkbox">
                                    <?php
                                    if ($check_cuff_70) {
                                        ?>
                                        Rp 70.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                        <?php
                                    } else {
                                        ?>
                                        Rp 70.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 border-costume" style="margin-top:5px;">
                            <?php
                          $check_cuff_100 = FALSE;
                            if ($value['cuff']->num_rows() > 0) {
                                foreach ($value['cuff']->result() as $row_cuff) {
                                    if ($row_cuff->xform == 'blue' && $row_cuff->additional_charge == 1 && $row_cuff->price == 100000) {
                                    ?>
                                    <div class="col-xs-6 hor-clear">
                                        <div class="checkbox">
                                            <?php
                                            if ($row_cuff->id == $value['order']->id_cuff) {
                                                $check_cuff_100 = TRUE;
                                                $x100++;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_cuff->title; ?></label>
                                            <?php
                                            } else {
                                                $check_cuff_100 = FALSE;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_cuff->title; ?></label>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <div class="col-xs-12 hor-clear ver-clear">
                                <div class="col-xs-6" style="padding:5px 0px 5px;margin-top: -5px;">
                                    <b>&#8903;</b> Fabric Code (4 Digit)
                                </div>
                                <div class="col-xs-6 hor-clear ver-clear">
                                    <?php
                                    if (!empty($value['order']->id_cleric) && ($value['order']->cleric_type == 1 || $value['order']->cleric_type == 2)) {
                                        $fabric_code = $value['order']->code_fabric_cleric;                                       
                                    }

                                    if ($check_cuff_70 || $check_cuff_100) {
                                         $str_cuffs = str_split($fabric_code);
                                    }
                                    ?>
                                    <form action="">
                                        <input class="text-center" type="text" name="" value="<?php echo isset($str_cuffs[0]) ? $str_cuffs[0] : ''; ?>" maxlength="1" size="1">
                                        <input class="text-center" type="text" name="" value="<?php echo isset($str_cuffs[1]) ? $str_cuffs[1] : ''; ?>" maxlength="1" size="1">
                                        <input class="text-center" type="text" name="" value="<?php echo isset($str_cuffs[2]) ? $str_cuffs[2] : ''; ?>" maxlength="1" size="1">
                                        <input class="text-center" type="text" name="" value="<?php echo isset($str_cuffs[3]) ? $str_cuffs[3] : ''; ?>" maxlength="1" size="1">
                                    </form>
                                </div>
                                <div class="col-xs-12 ver-clear">
                                    <div class="checkbox">
                                    <?php
                                    if ($check_cuff_100) {
                                        ?>
                                        Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                        <?php
                                    } else {
                                        ?>
                                        Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
	  				</div><!-- End col-xs-8 -->
	  			</div>
			</div>
		</div>

        <div class="clearfix"></div>
        
        <div class="col-xs-12 hor-clear">
			<div class="panel panel-primary">
	  			<div class="panel-heading-costume"><span>04 FRONT BODY</span></div>
	  			<div class="panel-body hor-clear ver-clear">
                    <div class="col-xs-12 border-costume">
                        <div class="col-xs-8 hor-clear">                            
                                <?php
                                $check_front_body_70 = FALSE;
                                if ($value['body_type']->num_rows() > 0) {
                                    foreach ($value['body_type']->result() as $row_body_type) {
                                        if ($row_body_type->category == 1 && $row_body_type->xform == 'blue' && $row_body_type->price == 70000) {
                                            if ($row_body_type->id == $value['order']->id_body_type_front) {
                                                $check_front_body_70 = TRUE;
                                                $x70++;
                                            ?>
                                                <div class="checkbox">
                                                <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_body_type->title; ?></label>
                                                </div>
                                                <?php
                                            } else {
                                                $check_front_body_70 = FALSE;
                                            ?>
                                                <div class="checkbox">
                                                <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;<?php echo $row_body_type->title; ?></label>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                        </div>
                        <div class="col-xs-4">
                            <?php
                            if ($check_front_body_70) {
                                ?>
                                Rp 70.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                <?php
                            } else {
                                ?>
                                Rp 70.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<div class="col-xs-6 hor-clear">
			<div class="panel panel-primary">
				<div class="panel-heading-costume"><span>08 BUTTON</span></div>
				<div class="panel-body" style="padding: 10px 0 10px;">
					<div class="col-xs-12 border-costume">
						<div class="col-xs-12 hor-clear">
                            <?php
                            $check_button_100 = FALSE;
                            if ($value['button']->num_rows() > 0) {
                                foreach ($value['button']->result() as $row_button) {
                                    if ($row_button->xform == 'blue' && $row_button->price == 100000) {
                                    ?>
                                    <div class="checkbox">
                                        <?php
                                        if ($row_button->id == $value['order']->id_button) {
                                            $check_button_100 = TRUE;
                                            $x100++;
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_button->title; ?></label>
                                        <?php
                                        } else {
                                            $check_button_100 = FALSE;
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_button->title; ?></label>
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
						</div>
						<div class="col-xs-12 ver-clear">
							<div class="checkbox">
								<?php
                                if ($check_button_100) {
                                    ?>
                                    Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                    <?php
                                } else {
                                    ?>
                                    Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                    <?php
                                }
                                ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 hor-clear">
			<div class="panel panel-primary">
				<div class="panel-heading-costume"><span>09 Body's 25 Snap Button</span></div>
				<div class="panel-body" style="padding: 10px 0 10px;">
					<div class="col-xs-12 border-costume">
						<div class="col-xs-6 hor-clear">
							<div class="checkbox">
								<label><input type="checkbox" value="">&nbsp;&nbsp;Yes</label>
							</div>
						</div>
						<div class="col-xs-6 ver-clear" style="padding-left: 42px;">
							<div class="checkbox">
								Rp 50.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" style="margin-left:0px;">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-xs-12 hor-clear">
			<div class="panel panel-primary">
				<div class="panel-heading-costume"><span>10 Cleric</span></div>
					<div class="panel-body hor-clear" style="padding: 10px 0 10px;">
						<div class="col-xs-12 border-costume">
							<div class="col-xs-6 hor-clear">
								<div class="checkbox">
                                    <?php
                                    if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 1) {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp; 1 Collar,Collar Stand,Cuffs</label>
                                        <?php
                                    } else {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp; 1 Collar,Collar Stand,Cuffs</label>
                                        <?php
                                    }
                                    ?>
								</div>
								<div class="checkbox">
                                    <?php
                                    if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 2) {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;2  Collar,Collar stand,Cuffs,Front placket</label>
                                        <?php
                                    } else {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;2  Collar,Collar stand,Cuffs,Front placket</label>
                                        <?php
                                    }
                                    ?>
								</div>
								<div class="checkbox">
                                    <?php
                                    if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 3) {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;3 Inner collar stand,inner cuffs</label>
                                        <?php
                                    } else {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;3 Inner collar stand,inner cuffs</label>
                                        <?php
                                    }
                                    ?>
								</div>
							</div>
							<div class="col-xs-6" style="padding-left: 53px;">
							<br>
								<div class="col-xs-12">
			  						<b>&#8903;</b> Fabric Code (4 Digit)
			  					</div>
			  					<div class="col-xs-6 ver-clear">
									<form action="">
                                        <?php
                                        if (!empty($value['order']->cleric_type) && ($value['order']->cleric_type == 1 || $value['order']->cleric_type == 2 || $value['order']->cleric_type == 3)) {
                                            $str_cleric1 = str_split($value['order']->code_fabric_cleric);
                                            $x50++;
                                        }
                                        ?>
										<input class="text-center" type="text" name="" value="<?php echo isset($str_cleric1[0]) ? $str_cleric1[0] : ''; ?>" maxlength="1" size="1">
										<input class="text-center" type="text" name="" value="<?php echo isset($str_cleric1[1]) ? $str_cleric1[1] : ''; ?>" maxlength="1" size="1">
										<input class="text-center" type="text" name="" value="<?php echo isset($str_cleric1[2]) ? $str_cleric1[2] : ''; ?>" maxlength="1" size="1">
										<input class="text-center" type="text" name="" value="<?php echo isset($str_cleric1[3]) ? $str_cleric1[3] : ''; ?>" maxlength="1" size="1">
									</form>
			  					</div>
			  					<div class="col-xs-6 hor-clear" style="margin-top: -10px;">
									<div class="checkbox">
                                        <?php
                                        if (!empty($value['order']->cleric_type) && ($value['order']->cleric_type == 1 || $value['order']->cleric_type == 2 || $value['order']->cleric_type == 3)) {
                                            ?>
                                            Rp 50.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                            <?php
                                        } else {
                                            ?>
                                            Rp 50.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                            <?php
                                        }
                                        ?>
									</div>
			  					</div>
							</div>
						</div>
						<div class="col-xs-12 border-costume" style="margin-top:5px;">
							<div class="col-xs-6 hor-clear">
								<br>
								<div class="checkbox">
                                    <?php
                                    if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 4) {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;4 Inner Collar Stand,Inner Cuffs,Lower Placket</label>
                                        <?php
                                    } else {
                                        ?>
                                        <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;4 Inner Collar Stand,Inner Cuffs,Lower Placket</label>
                                        <?php
                                    }
                                    ?>
								</div>
							</div>
							<div class="col-xs-6" style="margin-top: -10px;padding-left: 53px;">
							<br>
								<div class="col-xs-12">
			  						<b>&#8903;</b> Fabric Code (4 Digit)
			  					</div>
			  					<div class="col-xs-6 ver-clear">
                                    <?php
                                    if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 4) {
                                        $str_cleric4 = str_split($value['order']->code_fabric_cleric);
                                        $x100++;
                                    }
                                    ?>
									<form action="">
										<input class="text-center" type="text" name="" value="<?php echo isset($str_cleric4[0]) ? $str_cleric4[0] : ''; ?>" maxlength="1" size="1">
										<input class="text-center" type="text" name="" value="<?php echo isset($str_cleric4[1]) ? $str_cleric4[1] : ''; ?>" maxlength="1" size="1">
										<input class="text-center" type="text" name="" value="<?php echo isset($str_cleric4[2]) ? $str_cleric4[2] : ''; ?>" maxlength="1" size="1">
										<input class="text-center" type="text" name="" value="<?php echo isset($str_cleric4[3]) ? $str_cleric4[3] : ''; ?>" maxlength="1" size="1">
									</form>
			  					</div>
			  					<div class="col-xs-6 hor-clear" style="margin-top: -10px;">
									<div class="checkbox">
                                        <?php
                                        if (!empty($value['order']->cleric_type) && $value['order']->cleric_type == 4) {
                                            ?>
                                            Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                            <?php
                                        } else {
                                            ?>
                                            Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                            <?php
                                        }
                                        ?>
									</div>
			  					</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-xs-10 hor-clear">
				<form class="form-inline">
					<div class="form-group">
				    	<label for="name">Name</label>
				    	<input type="name" class="form-control" id="name" value="<?php echo $value['shipping']->row()->name; ?>">
				  	</div>
				</form>
			</div>
		</div>

	<div class="col-xs-7 hor-clear ver-clear">
		<div class="col-xs-4 hor-clear ">
			<div class="panel panel-primary">
				<div class="panel-heading-costume"><span>11 Button hole</span></div>
				<div class="panel-body border-costume" style="margin-top: 13px;">
                    <?php
                    $check_button_hole_30 = FALSE;
                    if ($value['button_hole']->num_rows() > 0) {
                        foreach ($value['button_hole']->result() as $row_button_hole) {
                            if ($row_button_hole->xform == 'blue' && $row_button_hole->price == 30000) {
                            ?>
                            <div class="col-xs-6 hor-clear ver-clear">
                                <div class="checkbox">
                                <?php
                                if ($row_button_hole->id == $value['order']->id_button_hole) {
                                    $check_button_hole_30 = TRUE;
                                    $x30++;
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_button_hole->title; ?></label>
                                    <?php
                                } else {
                                    $check_button_hole_30 = FALSE;
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_button_hole->title; ?></label>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <?php
                            }
                        }
                    }
                    ?>
					<div class="col-xs-12 hor-clear">
						<div class="checkbox">
                            <?php
                            if ($check_button_hole_30) {
                                ?>
                                Rp 30.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                <?php
                            } else {
                                ?>
                                Rp 30.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                <?php
                            }
                            ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-4 hor-clear ">
			<div class="panel panel-primary">
				<div class="panel-heading-costume"><span>12 Button Thread</span></div>
				<div class="panel-body border-costume" style="margin-top: 13px;">
                    <?php
                    $check_button_thread_30 = FALSE;
                    if ($value['button_thread']->num_rows() > 0) {
                        foreach ($value['button_thread']->result() as $row_button_thread) {
                            if ($row_button_thread->xform == 'blue' && $row_button_thread->price == 30000) {
                            ?>
                            <div class="col-xs-6 hor-clear ver-clear">
                                <div class="checkbox">
                                <?php
                                if ($row_button_thread->id == $value['order']->id_button_thread) {
                                    $check_button_thread_30 = TRUE;
                                    $x30++;
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_button_thread->title; ?></label>
                                    <?php
                                } else {
                                    $check_button_thread_30 = FALSE;
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_button_thread->title; ?></label>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <?php
                            }
                        }
                    }
                    ?>
					<div class="col-xs-12 hor-clear">
						<div class="checkbox">
							<?php
                            if ($check_button_thread_30) {
                                ?>
                                Rp 30.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                <?php
                            } else {
                                ?>
                                Rp 30.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                <?php
                            }
                            ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-4 hor-clear ">
			<div class="panel panel-primary">
				<div class="panel-heading-costume"><span>13 Stitch Thread</span></div>
				<div class="panel-body border-costume" style="margin-top: 13px;">
                    <?php
                    $check_amf_stitch_50 = FALSE;
                    if ($value['option']->num_rows() > 0) {
                        foreach ($value['option']->result() as $row_option) {
                            if ($row_option->category == 1 && $row_option->xform == 'blue' && $row_option->price == 50000) {
                            ?>
                            <div class="col-xs-6 hor-clear ver-clear">
                                <div class="checkbox">
                                    <?php
                                    if ($row_option->id == $value['order']->id_option_amf_stitch) {
                                        $check_amf_stitch_50 = TRUE;
                                        $x50++;
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_option->title; ?></label>
                                    <?php
                                    } else {
                                        $check_amf_stitch_50 = FALSE;
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_option->title; ?></label>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            }
                        }
                    }
                    ?>
					<div class="col-xs-12 hor-clear">
						<div class="checkbox">
                            <?php
                            if ($check_amf_stitch_50) {
                                ?>
                                Rp 50.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                <?php
                            } else {
                                ?>
                                Rp 50.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                <?php
                            }
                            ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="claerfix"></div>
		<br>

		<div class="col-xs-12 hor-clear">
			<div class="panel panel-primary">
				<div class="panel-heading-costume"><span>14 Embroidery</span></div>
				<div class="panel-body border-costume" style="margin-top: 13px;">
					<div class="col-xs-3 hor-clear ver-clear" style="border-bottom: dashed 2px #FF0000;padding-bottom: 25px;border-right:dashed 2px #FF0000;">
						<center>
							<p>Position</p>
                        </center>
                        <?php
                        if ($value['embroidery']->num_rows() > 0) {
                            foreach ($value['embroidery']->result() as $row_embroidery_position) {
                                if ($row_embroidery_position->category == 1 && $row_embroidery_position->xform == 'blue') {
                                ?>
                                <div class="checkbox">
                                    <?php
                                    if ($row_embroidery_position->id == $value['order']->id_embroidery_position) {
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_embroidery_position->title; ?></label>
                                    <?php
                                    } else {
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_embroidery_position->title; ?></label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                }
                            }
                        }
                        ?>
					</div>
					<div class="col-xs-5" style="padding:0px;border-bottom: dashed 2px #FF0000;padding-bottom: 25px;">
						<center>
							<p>Color</p>
                        </center>
                        <?php
                        if ($value['embroidery']->num_rows() > 0) {
                            foreach ($value['embroidery']->result() as $row_embroidery_color) {
                                if ($row_embroidery_color->category == 3 && $row_embroidery_color->xform == 'blue') {
                                ?>
                                <div class="checkbox">
                                    <?php
                                    if ($row_embroidery_color->id == $value['order']->id_embroidery_color) {
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_embroidery_color->title; ?></label>
                                    <?php
                                    } else {
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_embroidery_color->title; ?></label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                }
                            }
                        }
                        ?>
					</div>
					<div class="col-xs-4 ver-clear" style="border-bottom: dashed 2px #FF0000;padding-bottom: 25px;border-left:dashed 2px #FF0000;border-right: dashed 2px #FF0000;">
						<center>
							<p>Font Type</p>
						</center>
						<?php
                        if ($value['embroidery']->num_rows() > 0) {
                            foreach ($value['embroidery']->result() as $row_embroidery_font) {
                                if ($row_embroidery_font->category == 2 && $row_embroidery_font->xform == 'blue') {
                                ?>
                                <div class="checkbox">
                                    <?php
                                    if ($row_embroidery_font->id == $value['order']->id_embroidery_font) {
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_embroidery_font->title; ?></label>
                                    <?php
                                    } else {
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_embroidery_font->title; ?></label>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                }
                            }
                        }
                        ?>
					</div>

					<div class="clearfix"></div>
					<br>

					<div class="col-xs-12 hor-clear">
                        <?php
                        if (!empty($value['order']->embroidery_text)) {
                            $str = str_split($value['order']->embroidery_text);
                        }
                        ?>
						<form action="" class="form-costume">
							<input class="text-center" type="text" name="" value="<?php echo (!empty($value['order']->embroidery_text) && !empty($value['order']->id_embroidery_font)) ? $value['order']->id_embroidery_font : ''; ?>"> <b>&#x25CF;</b>
							<input class="text-center" type="text" name="" value="<?php echo isset($str[0]) ? $str[0] : ''; ?>">
							<input class="text-center" type="text" name="" value="<?php echo isset($str[1]) ? $str[1] : ''; ?>">
							<input class="text-center" type="text" name="" value="<?php echo isset($str[2]) ? $str[2] : ''; ?>">
							<input class="text-center" type="text" name="" value="<?php echo isset($str[3]) ? $str[3] : ''; ?>">
							<input class="text-center" type="text" name="" value="<?php echo isset($str[4]) ? $str[4] : ''; ?>">
							<input class="text-center" type="text" name="" value="<?php echo isset($str[5]) ? $str[5] : ''; ?>">
							<input class="text-center" type="text" name="" value="<?php echo isset($str[6]) ? $str[6] : ''; ?>">
							<input class="text-center" type="text" name="" value="<?php echo isset($str[7]) ? $str[7] : ''; ?>">
							<input class="text-center" type="text" name="" value="<?php echo isset($str[8]) ? $str[8] : ''; ?>">
							<input class="text-center" type="text" name="" value="<?php echo isset($str[9]) ? $str[9] : ''; ?>">
                            <input class="text-center" type="text" name="" value="<?php echo isset($str[10]) ? $str[10] : ''; ?>">
                            <input class="text-center" type="text" name="" value="<?php echo isset($str[11]) ? $str[11] : ''; ?>">
						</form>
					</div>

					<div class="clearfix"></div>

					<span style="color: red;">&#8903; please write down your initial (font type 1,2,3) or long name (font type 4) into above boxes</span>

				</div>
			</div>
		</div>

		<div class="clearfix"></div>
		<!-- <br> -->

		<div class="col-xs-12 hor-clear">
			<div class="panel panel-primary">
				<div class="panel-heading-costume"><span>15 Interlining</span></div>
				<div class="panel-body border-costume" style="padding: 10px 0 10px;">
                    <div class="col-xs-10">
                    <?php
                    $check_interlining_100 = FALSE;
                    if ($value['option']->num_rows() > 0) {
                        foreach ($value['option']->result() as $row_option) {
                            if ($row_option->category == 2 && $row_option->xform == 'blue' && $row_option->price == 100000) {
                            ?>
                            <div class="col-xs-6 hor-clear ver-clear">
                                <div class="checkbox">
                                    <?php
                                    if ($row_option->id == $value['order']->id_option_interlining) {
                                        $check_interlining_100 = TRUE;
                                        $x100++;
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_option->title; ?></label>
                                    <?php
                                    } else {
                                        $check_interlining_100 = FALSE;
                                    ?>
                                    <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp; <?php echo $row_option->title; ?></label>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            }
                        }
                    }
                    ?>
                    </div>
					<div class="col-xs-2">
						<div class="checkbox">
                            <?php
                            if ($check_interlining_100) {
                                ?>
                                Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                <?php
                            } else {
                                ?>
                                Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                <?php
                            }
                            ?>
						</div>
                    </div>
				</div>
			</div>
		</div>

		<div class="clerfix"></div>
		<!-- <br> -->

		<div class="col-xs-12 hor-clear">
			<div class="panel panel-primary">
				<div class="panel-heading-costume"><span>16 Sewing Option</span></div>
					<div class="panel-body hor-clear" style="padding: 10px 0 10px;">
						<div class="col-xs-12 border-costume">
                            <?php
                            $check_sewing_100 = FALSE;
                            if ($value['option']->num_rows() > 0) {
                                foreach ($value['option']->result() as $row_option_sewing) {
                                    if ($row_option_sewing->category == 3 && $row_option_sewing->xform == 'blue' && $row_option_sewing->price == 100000) {
                                    ?>
                                    <div class="col-xs-2 hor-clear">
                                        <div class="checkbox">
                                            <?php
                                            if ($row_option_sewing->id == $value['order']->id_option_sewing) {
                                                $check_sewing_100 = TRUE;
                                                $x100++;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;Yes</label>
                                            <?php
                                            } else {
                                                $check_sewing_100 = FALSE;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;Yes</label>
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-10 hor-clear">
                                        <p style="margin-top: 10px;"><?php echo $row_option_sewing->title; ?></p>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <div class="col-xs-12" style="border-top:0 !important">
                                <div class="checkbox">
                                    <?php
                                    if ($check_sewing_100) {
                                        ?>
                                        Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                        <?php
                                    } else {
                                        ?>
                                        Rp 100.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
						</div><!-- End col-xs-12 -->
                        <div class="col-xs-12 border-costume" style="margin-top:5px;">
                            <?php
                            $check_sewing_200 = FALSE;
                            if ($value['option']->num_rows() > 0) {
                                foreach ($value['option']->result() as $row_option_sewing) {
                                    if ($row_option_sewing->category == 3 && $row_option_sewing->xform == 'blue' && $row_option_sewing->price == 200000) {
                                    ?>
                                    <div class="col-xs-2 hor-clear">
                                        <div class="checkbox">
                                            <?php
                                            if ($row_option_sewing->id == $value['order']->id_option_sewing) {
                                                $check_sewing_200 = TRUE;
                                                $x200++;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">&nbsp;&nbsp;Yes</label>
                                            <?php
                                            } else {
                                                $check_sewing_200 = FALSE;
                                            ?>
                                            <label style="padding-left:0px;"><img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">&nbsp;&nbsp;Yes</label>
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-10 hor-clear">
                                        <p style="margin-top: 10px;"><?php echo $row_option_sewing->title; ?></p>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <div class="col-xs-12" style="border-top:0 !important">
                                <div class="checkbox">
                                    <?php
                                    if ($check_sewing_200) {
                                        ?>
                                        Rp 200.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                        <?php
                                    } else {
                                        ?>
                                        Rp 200.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xs-12 hor-clear">
				<div class="panel panel-primary">
					<div class="panel-heading-costume"><span>Tape(Inner Collar Stand & Lower Placket)</span></div>
					<div class="panel-body border-costume" style="margin-top: 13px;padding-bottom: 0 !important;">
						<div class="col-xs-10 hor-clear">
                            <?php
                            $check_tape = FALSE;
                            if ($value['option']->num_rows() > 0) {
                                foreach ($value['option']->result() as $row_option_tape) {
                                    if ($row_option_tape->category == 4 && $row_option_tape->xform == 'blue') {
                                        if ($row_option_tape->id == $value['order']->id_option_tape) {
                                            $check_tape = TRUE;
                                            $x70++;
                                        }
                                    ?>
                                    <!--
                                    <span><?php echo $row_option_tape->title; ?></span>
                                    -->
                                    <?php
                                    }
                                }
                            }
                            ?>
                        <hr style="border: none; border-bottom: 2px solid black;">
						</div>
						<div class="col-xs-2" style="padding-left:35px;">
							<div class="checkbox">
                                <?php
                                if ($check_tape) {
                                    ?>
                                    Rp 70.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/check2-60x60.png'); ?>">
                                    <?php
                                } else {
                                    ?>
                                    Rp 70.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-check" src="<?php echo base_url('assets/img/uncheck2-60x60.png'); ?>">
                                    <?php
                                }
                                ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-xs-6 hor-clear">
				<table class="table table-bordered">
					<thead>
				      <tr>
				      	<th></th>
				        <th>Option</th>
				        <th>Quantity</th>
				        <th>Total</th>
				      </tr>
				    </thead>
				    <tbody>
				      <tr>
				      	<td>A</td>
				        <td>30.000</td>
				        <td><?php echo $x30; ?></td>
				        <td><?php echo number_format($x30 * 30000,0,'.',','); ?></td>
				      </tr>
				      <tr>
				      	<td>B</td>
				        <td>50.000</td>
				        <td><?php echo $x50; ?></td>
				        <td><?php echo number_format($x50 * 50000,0,'.',','); ?></td>
				      </tr>
				      <tr>
				      	<td>C</td>
				        <td>70.000</td>
				        <td><?php echo $x70; ?></td>
				        <td><?php echo number_format($x70 * 70000,0,'.',','); ?></td>
				      </tr>
				      <tr>
				      	<td>D</td>
				        <td>100.000</td>
				        <td><?php echo $x100; ?></td>
				        <td><?php echo number_format($x100 * 100000,0,'.',','); ?></td>
				      </tr>
                      <tr>
				      	<td>E</td>
				        <td>200.000</td>
				        <td><?php echo $x200; ?></td>
				        <td><?php echo number_format($x200 * 200000,0,'.',','); ?></td>
				      </tr>
				    <tfoot>
				    	<tr>
				    		<td></td>
				    		<td></td>
				    		<td>Total</td>
				    		<td><?php echo number_format(($x30 * 30000) + ($x50 * 50000) + ($x70 * 70000) + ($x100 * 100000) + ($x200 * 200000),0,'.',','); ?></td>
				    	</tr>
				    </tfoot>
				    </tbody>
				</table>
			</div>

			<div class="clearfix"></div>

			<span style="color: red;">&#8903; please input option's total price into "OPTION" box of the order form.</span>
			<br><br>
			<span style="float: right"><b>KARUIZAWA SHIRT - TEL (021)590-2050/FAX:(021)590-2011</b></span>

	</div>



        <?php
    }
?>
</div>
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
            var imgData = canvas.toDataURL('image/png');
            $('.container').html('').append('<img class="img-canvas" style="width:100%;">');
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
