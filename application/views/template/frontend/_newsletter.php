<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Karuizawa Newsletter</title>
    </head>
    <body>
        <img src="<?php echo base_url('assets/img/Logo.png'); ?>">
        <hr>
        
        <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            </td>
        <?php
        if ($type == 'product' || $type == 'both') {
            ?>
            <h3 style="display:block;border-bottom:1px dashed #ccc;padding-bottom:10px;margin-bottom:10px;">New Products</h3>
            <?php
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $product) {
                    ?>
                    <li style="background:#f3f3f3;width:30%;list-style:none;display:inline-block;vertical-align:top;min-height:310px;margin-bottom:20px;">
                        <div class="" style="padding:10px;">
                        <a href="<?php echo site_url('view/product/' . $product->slug); ?>">
                        <h3 style="display:block;margin-top:0px;padding-top:0px;"><?php echo $product->title; ?></h3>
                        </a>
                        <img style="width:100%;" src="<?php echo base_url($this->config->item('product_image_path') . $product->image); ?>"/>
                        <br/><strong><span style="margin-top:10px;display:block;font-size:15px;"><?php echo format_currency($product->price); ?></span></strong>
                        </div>
                    </li>
                    <?php
                }
            }

            if ($type == 'both') {
                ?>
                <h3 style="display:block;border-bottom:1px dashed #ccc;padding-bottom:10px;margin-bottom:10px;">New Promotions</h3>
                <?php
                if ($promo->num_rows() > 0) {
                    foreach($promo->result() as $promo) {
                        ?>
                        <li style="background:#f3f3f3;width:100%;list-style:none;display:inline-block;vertical-align:top;min-height:310px;margin-bottom:20px;">
                            <div class="" style="padding:10px;">
                            <a href="<?php echo site_url('promo/' . $promo->slug); ?>"><h3 style="display:block;margin-top:0px;padding-top:0px;"><?php echo $promo->promo_name; ?></h3></a>
                            <img style="width:100%;" src="<?php echo base_url(path_image('promo_path') . $promo->image); ?>"/>
                            </div>
                        </li>
                        <?php
                    }
                }
            }

        } else if ($type == 'promo') {
            ?>
            <h3 style="display:block;border-bottom:1px dashed #ccc;padding-bottom:10px;margin-bottom:10px;">New Promotions</h3>
            <?php
            if ($promo->num_rows() > 0) {
                foreach($promo->result() as $promo) {
                    ?>
                    <li style="background:#f3f3f3;width:100%;list-style:none;display:inline-block;vertical-align:top;min-height:310px;margin-bottom:20px;">
                        <div class="" style="padding:10px;">
                        <a href="<?php echo site_url('promo/' . $promo->slug); ?>"><h3 style="display:block;margin-top:0px;padding-top:0px;"><?php echo $promo->promo_name; ?></h3></a>
                        <img style="width:100%;" src="<?php echo base_url(path_image('promo_path') . $promo->image); ?>"/>
                        </div>
                    </li>
                    <?php
                }
            }
        }
        ?>
        </td></tr>
        </table>
        <hr>
        Best Regards,<br>
        Karuizawa
    </body>
</html>
