<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=960, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/stylesheets/style.min.css'); ?>">
    <style>
    @media screen {
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
    }    
    </style>
    <script>
    var base_url = "<?php echo base_url(); ?>";
    </script>
    <title>Invoice #<?php echo $orders[0]['order']->order_number; ?></title>
</head>
<body>
<div class="container" style="min-width:960px;padding-top:20px;padding-bottom:20px;">
    <div class="col-xs-4">
        <img src="<?php echo base_url("assets/img/Logo.png");?>" alt="">
    </div>
    <div class="col-xs-4">
        <h4 class="text-center">PATTERN ORDER SHIRT (FOR MEN) <br> ⯁ Order Form ⯁ </h4>
    </div>
    <div class="col-xs-4">
        <h4 class="text-right"> Order No.: #<?php echo $orders[0]['order']->order_number; ?><br> Order Date.: <?php echo date('d',strtotime($orders[0]['order']->created_at)); ?>/<?php echo date('m',strtotime($orders[0]['order']->created_at)); ?> Option <input type="radio" name="option1" value="" placeholder=""></h4>
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
                            <td>&nbsp;</td>
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
                                    <div class="col-xs-2 material-list">
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
            <div class="col-xs-8">
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
                    </div>
                </div>
            </div><!-- End div col-xs-8 Cuff -->
            <div class="col-xs-4">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">04 Front Body </div>
                    <div class="panel-body">
                            <?php
                            if ($value['body_type']->num_rows() > 0) {
                                foreach ($value['body_type']->result() as $row_body_type) {
                                    if ($row_body_type->category == 1 && $row_body_type->xform == 'green') {
                                        ?>
                                        <div class="col-xs-6 material-list">
                                            <img src="<?php echo base_url("assets/img/upload/material_body_type/" . $row_body_type->image);?>" alt="">
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
            <div class="col-xs-8">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">05 Pocket </div>
                    <div class="panel-body">
                            <?php
                            if ($value['pocket']->num_rows() > 0) {
                                foreach ($value['pocket']->result() as $row_pocket) {
                                    if ($row_pocket->xform == 'green') {
                                    ?>
                                    <div class="col-xs-4 material-list">
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
            <div class="col-xs-4">
                <div class="panel panel-success">
                    <div class="panel-heading" style="color:black">06 Hem </div>
                    <div class="panel-body">
                            <?php
                            if ($value['body_type']->num_rows() > 0) {
                                foreach ($value['body_type']->result() as $row_body_type_hem) {
                                    if ($row_body_type_hem->category == 3 && $row_body_type_hem->xform == 'green') {
                                    ?>
                                    <div class="col-xs-6 material-list">
                                        <img src="<?php echo base_url("assets/img/upload/material_body_type/" . $row_body_type_hem->image);?>" alt="">
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
                                    <div class="col-xs-1 material-list">
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
        html2canvas(document.body).then(function(canvas) {
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
