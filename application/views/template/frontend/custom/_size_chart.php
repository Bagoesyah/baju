<?php
# @Author: Awan Tengah
# @Date:   2017-04-25T13:33:41+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-03T03:42:10+07:00
?>

<?php
if (isset($size)) {
    ?>
    <tbody>
        <tr>
            <td>Neck Size</td>
            <td class="head-neck" colspan="5" style="text-align:center;">
                <?php echo $neck; ?>
            </td>
        </tr>
        <tr>
            <td width="200">Body Type</td>
            <td width="150" style="text-align:center;">PM2 (Slim)</td>
            <td width="150" style="text-align:center;">PM3 (Standard 1)</td>
            <td width="150" style="text-align:center;">PM4 (Standard 2)</td>
            <td width="150" style="text-align:center;">PM5 (Big 1)</td>
            <td width="150" style="text-align:center;">PM7 (Big 2)</td>
        </tr>
        <tr>
            <td>Neck</td>
            <td><?php echo isset($size['PM2']['neck']) ? $size['PM2']['neck'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['neck']) ? $size['PM3']['neck'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['neck']) ? $size['PM4']['neck'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['neck']) ? $size['PM5']['neck'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['neck']) ? $size['PM7']['neck'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Shoulder</td>
            <td><?php echo isset($size['PM2']['shoulder']) ? $size['PM2']['shoulder'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['shoulder']) ? $size['PM3']['shoulder'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['shoulder']) ? $size['PM4']['shoulder'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['shoulder']) ? $size['PM5']['shoulder'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['shoulder']) ? $size['PM7']['shoulder'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Chest</td>
            <td><?php echo isset($size['PM2']['chest']) ? $size['PM2']['chest'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['chest']) ? $size['PM3']['chest'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['chest']) ? $size['PM4']['chest'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['chest']) ? $size['PM5']['chest'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['chest']) ? $size['PM7']['chest'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Waist</td>
            <td><?php echo isset($size['PM2']['waist']) ? $size['PM2']['waist'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['waist']) ? $size['PM3']['waist'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['waist']) ? $size['PM4']['waist'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['waist']) ? $size['PM5']['waist'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['waist']) ? $size['PM7']['waist'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Hip</td>
            <td><?php echo isset($size['PM2']['hip']) ? $size['PM2']['hip'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['hip']) ? $size['PM3']['hip'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['hip']) ? $size['PM4']['hip'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['hip']) ? $size['PM5']['hip'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['hip']) ? $size['PM7']['hip'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Arm Hole</td>
            <td><?php echo isset($size['PM2']['arm_hole']) ? $size['PM2']['arm_hole'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['arm_hole']) ? $size['PM3']['arm_hole'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['arm_hole']) ? $size['PM4']['arm_hole'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['arm_hole']) ? $size['PM5']['arm_hole'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['arm_hole']) ? $size['PM7']['arm_hole'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Back Length (~88cm)</td>
            <td><?php echo isset($size['PM2']['back_length_88']) ? $size['PM2']['back_length_88'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['back_length_88']) ? $size['PM3']['back_length_88'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['back_length_88']) ? $size['PM4']['back_length_88'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['back_length_88']) ? $size['PM5']['back_length_88'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['back_length_88']) ? $size['PM7']['back_length_88'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Back Length (89cm~)</td>
            <td><?php echo isset($size['PM2']['back_length_89']) ? $size['PM2']['back_length_89'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['back_length_89']) ? $size['PM3']['back_length_89'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['back_length_89']) ? $size['PM4']['back_length_89'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['back_length_89']) ? $size['PM5']['back_length_89'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['back_length_89']) ? $size['PM7']['back_length_89'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Aloha (~88cm)</td>
            <td><?php echo isset($size['PM2']['aloha_88']) ? $size['PM2']['aloha_88'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['aloha_88']) ? $size['PM3']['aloha_88'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['aloha_88']) ? $size['PM4']['aloha_88'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['aloha_88']) ? $size['PM5']['aloha_88'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['aloha_88']) ? $size['PM7']['aloha_88'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Aloha (89cm~)</td>
            <td><?php echo isset($size['PM2']['aloha_89']) ? $size['PM2']['aloha_89'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['aloha_89']) ? $size['PM3']['aloha_89'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['aloha_89']) ? $size['PM4']['aloha_89'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['aloha_89']) ? $size['PM5']['aloha_89'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['aloha_89']) ? $size['PM7']['aloha_89'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Cuffs Circle</td>
            <td><?php echo isset($size['PM2']['cuffs_circle']) ? $size['PM2']['cuffs_circle'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['cuffs_circle']) ? $size['PM3']['cuffs_circle'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['cuffs_circle']) ? $size['PM4']['cuffs_circle'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['cuffs_circle']) ? $size['PM5']['cuffs_circle'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['cuffs_circle']) ? $size['PM7']['cuffs_circle'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Short Sleeve</td>
            <td><?php echo isset($size['PM2']['short_sleeve']) ? $size['PM2']['short_sleeve'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['short_sleeve']) ? $size['PM3']['short_sleeve'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['short_sleeve']) ? $size['PM4']['short_sleeve'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['short_sleeve']) ? $size['PM5']['short_sleeve'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['short_sleeve']) ? $size['PM7']['short_sleeve'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Sleeve Circle</td>
            <td><?php echo isset($size['PM2']['sleeve_circle']) ? $size['PM2']['sleeve_circle'] : '-'; ?></td>
            <td><?php echo isset($size['PM3']['sleeve_circle']) ? $size['PM3']['sleeve_circle'] : '-'; ?></td>
            <td><?php echo isset($size['PM4']['sleeve_circle']) ? $size['PM4']['sleeve_circle'] : '-'; ?></td>
            <td><?php echo isset($size['PM5']['sleeve_circle']) ? $size['PM5']['sleeve_circle'] : '-'; ?></td>
            <td><?php echo isset($size['PM7']['sleeve_circle']) ? $size['PM7']['sleeve_circle'] : '-'; ?></td>
        </tr>
        <tr>
            <td>Sleeve Type</td>
            <td><?php echo isset($size['PM2']['sleeve_type']) ? ucwords($size['PM2']['sleeve_type']) : '-'; ?></td>
            <td><?php echo isset($size['PM3']['sleeve_type']) ? ucwords($size['PM3']['sleeve_type']) : '-'; ?></td>
            <td><?php echo isset($size['PM4']['sleeve_type']) ? ucwords($size['PM4']['sleeve_type']) : '-'; ?></td>
            <td><?php echo isset($size['PM5']['sleeve_type']) ? ucwords($size['PM5']['sleeve_type']) : '-'; ?></td>
            <td><?php echo isset($size['PM7']['sleeve_type']) ? ucwords($size['PM7']['sleeve_type']) : '-'; ?></td>
        </tr>
    </tbody>
    <?php
}
?>

<?php /*
<?php if(isset($size_chart)): ?>
    <?php foreach($size_chart as $row): ?>
        <tbody class="text-justify">
            <tr>
                <th rowspan="14" width="150">
                    <?php echo $row->TITLE; ?><!--<a href="#" class="btn btn-default btn-xs btn-select-size-on-chart" data-idsize="<?php echo $row->ID; ?>">Select</a>-->
                </th>
            </tr>
            <tr>
                <td>Around Neck</td>
                <td><?php echo $row->NECK; ?></td>
            </tr>
            <tr>
                <td>Body Type</td>
                <td>
                    <?php
                    if ($row->BODY_TYPE == 'PM2') {
                        $body_type = 'PM2 (Slim)';
                    } else if ($row->BODY_TYPE == 'PM3') {
                        $body_type = 'PM3 (Standard 1)';
                    } else if ($row->BODY_TYPE == 'PM4') {
                        $body_type = 'PM4 (Standard 2)';
                    } else if ($row->BODY_TYPE == 'PM5') {
                        $body_type = 'PM5 (Big 1)';
                    } else if ($row->BODY_TYPE == 'PM7') {
                        $body_type = 'PM7 (Big 2)';
                    }
                    ?>
                    <?php echo $body_type; ?>
                </td>
            </tr>
            <tr>
                <td>Sleeve Type</td>
                <td><?php echo ucwords($row->SLEEVE_TYPE); ?> Sleeve</td>
            </tr>
            <tr>
                <td>Neck</td>
                <td><?php echo $row->NECK; ?></td>
            </tr>
            <tr>
                <td>Shoulder</td>
                <td><?php echo $row->SHOULDER; ?></td>
            </tr>
            <tr>
                <td>Chest</td>
                <td><?php echo $row->CHEST; ?></td>
            </tr>
            <tr>
                <td>Waist</td>
                <td><?php echo $row->WAIST; ?></td>
            </tr>
            <tr>
                <td>Hip</td>
                <td><?php echo $row->HIP; ?></td>
            </tr>
            <tr>
                <td>Arm Hole</td>
                <td><?php echo $row->ARM_HOLE; ?></td>
            </tr>
            <tr>
                <td>Back Length (~88cm)</td>
                <td><?php echo $row->BACK_LENGTH_88; ?></td>
            </tr>
            <tr>
                <td>Back Length (89cm~)</td>
                <td><?php echo $row->BACK_LENGTH_89; ?></td>
            </tr>
            <tr>
                <td>Aloha (~88cm)</td>
                <td><?php echo $row->ALOHA_88; ?></td>
            </tr>
            <tr>
                <td>Aloha (89cm~)</td>
                <td><?php echo $row->ALOHA_89; ?></td>
            </tr>
            <tr>
                <td>Cuffs Circle</td>
                <td><?php echo $row->CUFFS_CIRCLE; ?></td>
            </tr>
            <tr>
                <td>Short Sleeve</td>
                <td><?php echo $row->SHORT_SLEEVE; ?></td>
            </tr>
            <tr>
                <td>Sleeve Circle</td>
                <td><?php echo $row->SLEEVE_CIRCLE; ?></td>
            </tr>
        </tbody>
    <?php endforeach; ?>
<?php endif; ?>

<script>
$(document).ready(function() {
    $(".btn-select-size-on-chart").click(function(e) {
        e.preventDefault();
        var idsize = $(this).data('idsize');
        $.ajax({
            url: base_url + '/api/product/get_master_size',
            type: "POST",
            beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
            data: {ID_SIZE: idsize},
            success: function(response) {
                if(response.STATUS == 'SUCCESS') {
                    $('input[name="id_size"]').val(idsize);
                    $('input[name="neck_dimensions"]').val(response.DATA.NECK);
                    $('input[name="shoulder_dimensions"]').val(response.DATA.SHOULDER);
                    $('input[name="chest_dimensions"]').val(response.DATA.CHEST);
                    $('input[name="waist_dimensions"]').val(response.DATA.WAIST);
                    $('input[name="hip_dimensions"]').val(response.DATA.HIP);
                    $('input[name="arm_hole_dimensions"]').val(response.DATA.ARM_HOLE);
                    $('input[name="back_length_88_dimensions"]').val(response.DATA.BACK_LENGTH_88);
                    $('input[name="back_length_89_dimensions"]').val(response.DATA.BACK_LENGTH_89);
                    $('input[name="aloha_88_dimensions"]').val(response.DATA.ALOHA_88);
                    $('input[name="aloha_89_dimensions"]').val(response.DATA.ALOHA_89);
                    $('input[name="cuffs_circle_dimensions"]').val(response.DATA.CUFFS_CIRCLE);
                    $('input[name="short_sleeve_dimensions"]').val(response.DATA.SHORT_SLEEVE);
                    $('input[name="sleeve_circle_dimensions"]').val(response.DATA.SLEEVE_CIRCLE);
                }
            }
        });
    });
});
</script>
**/ ?>
