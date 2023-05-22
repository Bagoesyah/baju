<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Karuizawa Newsletter</title>
    </head>
    <body>
        <img src="<?php echo base_url('assets/img/Logo.png'); ?>">
        <hr>
        <br/>
        <p>Hi, we've recieved an order with the details below: </p>
        <br/><br/>

        <?php
        $total = 0;
        foreach ($orders as $order) {
            $total = $total + (($order['base'] + $order['option'] + $order['tax'] + $order['delivery_cost']) * $order['quantity']);
        }
        ?>

        <strong>Order Number:</strong> #<?php echo isset($orders[0]['order_number']) ? $orders[0]['order_number'] : ''; ?><br/>
        <strong>Order Date:</strong> <?php echo isset($orders[0]['order_date']) ? date('d F Y H:i', strtotime($orders[0]['order_date'])) : ''; ?><br/>
        <strong>Customer Name:</strong> <?php echo isset($orders[0]['name']) ? $orders[0]['name'] : ''; ?><br/>
        <strong>Customer Address:</strong> <?php echo isset($orders[0]['address']) ? $orders[0]['address'] : ''; ?><br/>
        <strong>Customer Email:</strong> <?php echo isset($orders[0]['email']) ? $orders[0]['email'] : ''; ?><br/>
        <strong>Customer HP:</strong> <?php echo isset($orders[0]['hp']) ? $orders[0]['hp'] : ''; ?><br/>
        <strong>Customer Phone:</strong> <?php echo isset($orders[0]['phone']) ? $orders[0]['phone'] : ''; ?><br/>
        <strong>Total Item(s):</strong> <?php echo count($orders); ?><br/>
        <strong>Total Payable:</strong> Rp. <?php echo number_format($total, 0, ',', '.'); ?><br/><br/>

        <table width="100%" cellpadding="0" cellspacing="0" border="1" style="border-collapse: collapse;">
            <tbody>
                <?php
                foreach($orders as $order) {
                    $img = base_url('assets/img/no_image.png');
                    $cleric_type = 'None';
                    $cleric_fabric = 'None';
                    if (!empty($order['cleric_type']) && !empty($order['id_cleric']) && !empty($order['cleric_fabric_code'])) {
                        
                        if ($order['cleric_type'] == 1) {
                            $cleric_type = 'Collar &amp; Cuffs';
                        } else if ($order['cleric_type'] == 2) {
                            $cleric_type = 'Collar/Cuffs &amp; Front Placket';
                        } else if ($order['cleric_type'] == 3) {
                            $cleric_type = 'Inner Collar Stand &amp; Inner Cuffs';
                        } else if ($order['cleric_type'] == 4) {
                            $cleric_type = 'Inner Collar Stand/Inner Cuffs &amp; Lower Placket';
                        }

                        $cleric_fabric = $order['cleric_title'] . ' ('.$order['cleric_fabric_code'].')';
                    }
                    ?>
                    <tr>
                        <td valign="top" width="12%">
                            <?php
                            if ($order['order_type'] == 2) {
                                if (is_file('assets/img/img_order/' . $order['image_custom'])) {
                                    $img = base_url('assets/img/img_order/' . $order['image_custom']);
                                }
                            } else {
                                if (is_file('assets/img/upload/product_image/' . $order['image'])) {
                                    $img = base_url('assets/img/upload/product_image/' . $order['image']);
                                }
                            }
                            ?>
                            <img src="<?php echo $img; ?>" style="max-width:120px;">
                        </td>
                        <td valign="top" style="padding:20px;">
                            <span>Spec:</span><hr/>
                            <ol>
                                <li>Fabric: <?php echo !empty($order['fabric_title']) ? $order['fabric_title'] . ' ('.$order['fabric_code'].')' : 'None'; ?></li>
                                <li>Collar: <?php echo !empty($order['collar_title']) ? $order['collar_title'] : 'None'; ?></li>
                                <li>Cuff: <?php echo !empty($order['cuff_title']) ? $order['cuff_title'] : 'None'; ?></li>
                                <li>Sleeve: <?php echo !empty($order['id_sleeve']) ? $order['sleeve_title'] : 'Long Sleeve'; ?></li>
                                <li>Body Type: <br />Front: <?php echo !empty($order['body_type_front_title']) ? $order['body_type_front_title'] : 'None'; ?><br/>Back: <?php echo !empty($order['body_type_back_title']) ? $order['body_type_back_title'] : 'None'; ?><br/>Hem: <?php echo !empty($order['body_type_hem_title']) ? $order['body_type_hem_title'] : 'None'; ?></li>
                                <li>Button: <br />Button: <?php echo !empty($order['button_title']) ? $order['button_title'] : 'None'; ?><br/>Button Hole: <?php echo !empty($order['button_hole_title']) ? $order['button_hole_title'] : 'Match Fabric Color'; ?><br/>Button Thread: <?php echo !empty($order['button_thread_title']) ? $order['button_thread_title'] : 'Match Fabric Color'; ?></li>
                                <li>Cleric: <br />Type: <?php echo $cleric_type; ?><br />Fabric: <?php echo $cleric_fabric; ?></li>
                                <li>Embroidery: <br />Position: <?php echo !empty($order['embriodery_position']) ? $order['embriodery_position'] : 'None'; ?><br/>Font: <?php echo !empty($order['embriodery_font']) ? $order['embriodery_font'] : 'None'; ?><br/>Color: <?php echo !empty($order['embriodery_color']) ? $order['embriodery_color'] : 'None'; ?><br/>Text: <?php echo !empty($order['embroidery_text']) ? $order['embroidery_text'] : '-'; ?></li>
                                <li>Option: <br />Stitch Thread: <?php echo !empty($order['option_amf_title']) ? $order['option_amf_title'] : 'None'; ?><br/>Interlining: <?php echo !empty($order['option_interlining_title']) ? $order['option_interlining_title'] : 'Standard'; ?><br/>Sewing: <?php echo !empty($order['option_sewing_title']) ? $order['option_sewing_title'] : 'Standard'; ?><br/>Tape: <?php echo !empty($order['option_tape_title']) ? $order['option_tape_title'] : 'None'; ?></li>
                                <li>Special Request: <?php echo !empty($order['special_request_verify']) ? $order['special_request_verify'] : '-'; ?></li>
                            </ol>
                            <span>Main Size:</span><hr/>
                            <ol>
                                <li>Around Neck: <?php echo !empty($order['around_neck_selection']) ? $order['around_neck_selection'] : '-'; ?></li>
                                <li>Sleeve Length Right: <?php echo !empty($order['sleeve_length_right_selection']) ? $order['sleeve_length_right_selection'] : '-'; ?></li>
                                <li>Sleeve Length Left: <?php echo !empty($order['sleeve_length_left_selection']) ? $order['sleeve_length_left_selection'] : '-'; ?></li>
                                <li>Body Type: <?php echo !empty($order['body_type_selection']) ? $order['body_type_selection'] : '-'; ?></li>
                                <li>Sleeve Type: <?php echo !empty($order['sleeve_type_selection']) ? $order['sleeve_type_selection'] : '-'; ?></li>
                            </ol>
                            <span>Size:</span><hr/>
                            <ol>
                                <li>Neck: <?php echo !empty($order['neck']) ? $order['neck'] : '-'; ?></li>
                                <li>Shoulder: <?php echo !empty($order['shoulder']) ? $order['shoulder'] : '-'; ?></li>
                                <li>Chest: <?php echo !empty($order['chest']) ? $order['chest'] : '-'; ?></li>
                                <li>Waist: <?php echo !empty($order['waist']) ? $order['waist'] : '-'; ?></li>
                                <li>Hip: <?php echo !empty($order['hip']) ? $order['hip'] : '-'; ?></li>
                                <li>Arm Hole: <?php echo !empty($order['arm_hole']) ? $order['arm_hole'] : '-'; ?></li>
                                <li>Back Length (~88cm): <?php echo !empty($order['back_length_88']) ? $order['back_length_88'] : '-'; ?></li>
                                <li>Back Length (89cm~): <?php echo !empty($order['back_length_89']) ? $order['back_length_89'] : '-'; ?></li>
                                <li>Aloha (~88cm): <?php echo !empty($order['aloha_88']) ? $order['aloha_88'] : '-'; ?></li>
                                <li>Aloha (89cm~): <?php echo !empty($order['aloha_89']) ? $order['aloha_89'] : '-'; ?></li>
                                <li>Cuffs Circle: <?php echo !empty($order['cuffs_circle']) ? $order['cuffs_circle'] : '-'; ?></li>
                                <li>Short Sleeve: <?php echo !empty($order['short_sleeve']) ? $order['short_sleeve'] : '-'; ?></li>
                                <li>Sleeve Circle: <?php echo !empty($order['sleeve_circle']) ? $order['sleeve_circle'] : '-'; ?></li>
                            </ol>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
</html>