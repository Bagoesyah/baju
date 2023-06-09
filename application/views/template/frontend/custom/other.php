<?php
# @Author: Awan Tengah
# @Date:   2017-03-21T11:19:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-03T03:43:31+07:00
?>
<div class="container custom text-justify">
    <?php $this->load->view('template/frontend/custom/_header'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="other-custom">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#choose_size_by_your_self" aria-controls="choose_size_by_your_self" role="tab" data-toggle="tab" data-material="other">CHOOSE A SIZE YOURSELF</a></li>
                    <!--<li><a href="#make_with_auto" aria-controls="make_with_auto" role="tab" data-toggle="tab" data-material="other">MAKE WITH AUTOMATIC MEASURING MEASUREMENT</a></li>-->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="choose_size_by_your_self">
                        <br>
                        <a href="<?php echo site_url('view/guide'); ?>" class="btn btn-default" target="_blank">Men's shirt size guide</a>
                        <!--
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#size-cart-modal"><i class="ion-ios-keypad-outline"></i> View size chart</button>
                        -->
                        <div class="table-responsive">
                            <h4><i class="ion-scissors"></i> Size</h4>
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Dimensions (cm)</th>
                                        <!--
                                        <th style="min-width: 120px;">Option fee</th>
                                        -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Around Neck
                                        </td>
                                        <td>
                                            <select class="form-control" id="around_neck">
                                                <option value="">Please select</option>
                                                <?php
                                                $arround_neck_session = $this->session->userdata('around_neck_selection');
                                                for ($i = 35; $i <= 55; $i++) {
                                                ?>
                                                    <option <?php echo ($i == $arround_neck_session) ? 'selected="selected"' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <!--
                                        <td class="form-horizontal">
                                            
                                            <label class="col-sm-3 control-label">Option fee</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Rp. </div>
                                                    <input type="text" name="option_fee_1" class="form-control" placeholder="0">
                                                </div>
                                            </div>
                                        </td>
                                        -->
                                        <td style="text-align:right;">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#size-cart-modal"><i class="ion-ios-keypad-outline"></i> View size chart</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sleeve Length (right)
                                        </td>
                                        <td>
                                            <select class="form-control" id="select_sleeve_length_right">
                                                <option value="">Please select</option>
                                                <?php
                                                $sleeve_length_right_session = $this->session->userdata('sleeve_length_right_selection');
                                                for ($i = 65; $i <= 95; $i++) {
                                                ?>
                                                    <option <?php echo ($i == $sleeve_length_right_session) ? 'selected="selected"' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <!--
                                        <td class="form-horizontal">
                                            <label class="col-sm-3 control-label">Option fee</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Rp. </div>
                                                    <input type="text" name="option_fee_2" class="form-control" placeholder="0">
                                                </div>
                                            </div>
                                        </td>
                                        -->
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sleeve Length (left)
                                        </td>
                                        <td>
                                            <select class="form-control" id="select_sleeve_length_left">
                                                <option value="">Please select</option>
                                                <?php
                                                $sleeve_length_left_session = $this->session->userdata('sleeve_length_left_selection');
                                                for ($i = 65; $i <= 95; $i++) {
                                                ?>
                                                    <option <?php echo ($i == $sleeve_length_left_session) ? 'selected="selected"' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <!--<td></td>-->
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Body Type
                                        </td>
                                        <td>
                                            <select class="form-control" id="select_body_type">
                                                <?php $body_type_session = $this->session->userdata('body_type_selection'); ?>
                                                <option value="">Please select</option>
                                                <option <?php echo ($body_type_session == 'PM2') ? 'selected="selected"' : ''; ?> value="PM2">Slim (PM2)</option>
                                                <option <?php echo ($body_type_session == 'PM3') ? 'selected="selected"' : ''; ?> value="PM3">Standard 1 (PM3)</option>
                                                <option <?php echo ($body_type_session == 'PM4') ? 'selected="selected"' : ''; ?> value="PM4">Standard 2 (PM4)</option>
                                                <option <?php echo ($body_type_session == 'PM5') ? 'selected="selected"' : ''; ?> value="PM5">Big 1 (PM5)</option>
                                                <option <?php echo ($body_type_session == 'PM7') ? 'selected="selected"' : ''; ?> value="PM7">Big 2 (PM7)</option>
                                            </select>
                                        </td>
                                        <!--<td></td>-->
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Sleeve Type
                                        </td>
                                        <td>
                                            <select class="form-control" id="select_sleeve_type">
                                                <?php
                                                $sleeve_type_session = $this->session->userdata('sleeve_type_selection');
                                                ?>
                                                <option value="">Please select</option>
                                                <option <?php echo ($sleeve_type_session == 'regular') ? 'selected="selected"' : ''; ?> value="regular">Regular Sleeve</option>
                                                <option <?php echo ($sleeve_type_session == 'slim') ? 'selected="selected"' : ''; ?> value="slim">Slim Sleeve</option>
                                            </select>
                                        </td>
                                        <!--<td></td>-->
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center">
                            <a class="link-collapse-size-adjustment collapsed" role="button" data-toggle="collapse" href="#collapseDetailSizeAdjustment" aria-expanded="false" aria-controls="collapseDetailSizeAdjustment">
                                <span><i class="ion-android-arrow-dropdown-circle"></i> Show detailed size adjustment</span>
                            </a>
                            <div class="collapse" id="collapseDetailSizeAdjustment">
                                <div class="table-responsive text-justify">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Dimensions (cm)</th>
                                                <th>Correction (cm)</th>
                                                <th>Product upsize</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Neck</td>
                                                <td>
                                                    <input type="number" name="neck_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="neck_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('neck_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="neck_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('neck_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shoulder</td>
                                                <td>
                                                    <input type="number" name="shoulder_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="shoulder_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('shoulder_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="shoulder_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('shoulder_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Chest</td>
                                                <td>
                                                    <input type="number" name="chest_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="chest_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('chest_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="chest_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('chest_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Waist</td>
                                                <td>
                                                    <input type="number" name="waist_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="waist_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('waist_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="waist_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('waist_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <input type="hidden" name="id_size">
                                                <td>Hip</td>
                                                <td>
                                                    <input type="number" name="hip_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="hip_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('hip_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="hip_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('hip_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Arm hole</td>
                                                <td>
                                                    <input type="number" name="arm_hole_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="arm_hole_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('arm_hole_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="arm_hole_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('arm_hole_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Back Length (~88cm)</td>
                                                <td>
                                                    <input type="number" name="back_length_88_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="back_length_88_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('back_length_88_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="back_length_88_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('back_length_88_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Back Length (89cm~)</td>
                                                <td>
                                                    <input type="number" name="back_length_89_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="back_length_89_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('back_length_89_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="back_length_89_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('back_length_89_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Aloha (~88cm)</td>
                                                <td>
                                                    <input type="number" name="aloha_88_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="aloha_88_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('aloha_88_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="aloha_88_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('aloha_88_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Aloha (89cm~)</td>
                                                <td>
                                                    <input type="number" name="aloha_89_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="aloha_89_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('aloha_89_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="aloha_89_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('aloha_89_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cuffs Circle</td>
                                                <td>
                                                    <input type="number" name="cuffs_circle_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="cuffs_circle_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('cuffs_circle_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="cuffs_circle_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('cuffs_circle_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Short Sleeve</td>
                                                <td>
                                                    <input type="number" name="short_sleeve_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="short_sleeve_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('short_sleeve_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="short_sleeve_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('short_sleeve_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sleeve Circle</td>
                                                <td>
                                                    <input type="number" name="sleeve_circle_dimensions" class="form-control" placeholder="0" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="sleeve_circle_correction" class="form-control element_correction" placeholder="0" value="<?php echo $this->session->userdata('sleeve_circle_correction'); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="sleeve_circle_product_upsize" class="form-control" placeholder="0" value="<?php echo $this->session->userdata('sleeve_circle_product_upsize'); ?>" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a id="btnSizeCalculation" class="btn btn-brown" onclick="size_calculation();">Size calculation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="make_with_auto">...</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="pull-right">
                <label></label>
                <div id="sub_price_fabric"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="size-cart-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-chart-size" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Size Chart</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="list-view-chart">
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    @media (min-width: 768px) {
        .modal-chart-size {
            width: 760px;
        }
    }

    table#list-view-chart tr td:first-child {
        text-align: left;
        font-weight: bold;
    }

    table#list-view-chart tr td.head-neck {
        text-align: center;
    }
</style>
<script>
    function calculationSize() {
        var id_size = !isNaN(get_element_by_name('id_size')) && get_element_by_name('id_size') != '' ? get_element_by_name('id_size') : 0;

        // MAIN SIZE
        var around_neck = $('#around_neck').val() || 0;
        var body_type = $('#select_body_type').val() || 0;
        var sleeve_type = $('#select_sleeve_type').val() || 0;
        var sleeve_length_right = $('#select_sleeve_length_right').val() || 0;
        var sleeve_length_left = $('#select_sleeve_length_left').val() || 0;

        //Dimensions
        var neck_dimensions = !isNaN(get_element_by_name('neck_dimensions')) && get_element_by_name('neck_dimensions') != '' ? get_element_by_name('neck_dimensions') : 0;
        var shoulder_dimensions = !isNaN(get_element_by_name('shoulder_dimensions')) && get_element_by_name('shoulder_dimensions') != '' ? get_element_by_name('shoulder_dimensions') : 0;
        var chest_dimensions = !isNaN(get_element_by_name('chest_dimensions')) && get_element_by_name('chest_dimensions') != '' ? get_element_by_name('chest_dimensions') : 0;
        var waist_dimensions = !isNaN(get_element_by_name('waist_dimensions')) && get_element_by_name('waist_dimensions') != '' ? get_element_by_name('waist_dimensions') : 0;
        var hip_dimensions = !isNaN(get_element_by_name('hip_dimensions')) && get_element_by_name('hip_dimensions') != '' ? get_element_by_name('hip_dimensions') : 0;
        var arm_hole_dimensions = !isNaN(get_element_by_name('arm_hole_dimensions')) && get_element_by_name('arm_hole_dimensions') != '' ? get_element_by_name('arm_hole_dimensions') : 0;
        var back_length_88_dimensions = !isNaN(get_element_by_name('back_length_88_dimensions')) && get_element_by_name('back_length_88_dimensions') != '' ? get_element_by_name('back_length_88_dimensions') : 0;
        var back_length_89_dimensions = !isNaN(get_element_by_name('back_length_89_dimensions')) && get_element_by_name('back_length_89_dimensions') != '' ? get_element_by_name('back_length_89_dimensions') : 0;

        if (parseInt(sleeve_length_right) < 89) {
            back_length_89_dimensions = 0;
        }

        var aloha_88_dimensions = !isNaN(get_element_by_name('aloha_88_dimensions')) && get_element_by_name('aloha_88_dimensions') != '' ? get_element_by_name('aloha_88_dimensions') : 0;
        var aloha_89_dimensions = !isNaN(get_element_by_name('aloha_89_dimensions')) && get_element_by_name('aloha_89_dimensions') != '' ? get_element_by_name('aloha_89_dimensions') : 0;

        if (parseInt(sleeve_length_right) < 89) {
            aloha_89_dimensions = 0;
        }

        var cuffs_circle_dimensions = !isNaN(get_element_by_name('cuffs_circle_dimensions')) && get_element_by_name('cuffs_circle_dimensions') != '' ? get_element_by_name('cuffs_circle_dimensions') : 0;
        var short_sleeve_dimensions = !isNaN(get_element_by_name('short_sleeve_dimensions')) && get_element_by_name('short_sleeve_dimensions') != '' ? get_element_by_name('short_sleeve_dimensions') : 0;
        var sleeve_circle_dimensions = !isNaN(get_element_by_name('sleeve_circle_dimensions')) && get_element_by_name('sleeve_circle_dimensions') != '' ? get_element_by_name('sleeve_circle_dimensions') : 0;

        //Correction
        var neck_correction = !isNaN(get_element_by_name('neck_correction')) && get_element_by_name('neck_correction') != '' ? get_element_by_name('neck_correction') : 0;
        var shoulder_correction = !isNaN(get_element_by_name('shoulder_correction')) && get_element_by_name('shoulder_correction') != '' ? get_element_by_name('shoulder_correction') : 0;
        var chest_correction = !isNaN(get_element_by_name('chest_correction')) && get_element_by_name('chest_correction') != '' ? get_element_by_name('chest_correction') : 0;
        var waist_correction = !isNaN(get_element_by_name('waist_correction')) && get_element_by_name('waist_correction') != '' ? get_element_by_name('waist_correction') : 0;
        var hip_correction = !isNaN(get_element_by_name('hip_correction')) && get_element_by_name('hip_correction') != '' ? get_element_by_name('hip_correction') : 0;
        var arm_hole_correction = !isNaN(get_element_by_name('arm_hole_correction')) && get_element_by_name('arm_hole_correction') != '' ? get_element_by_name('arm_hole_correction') : 0;
        var back_length_88_correction = !isNaN(get_element_by_name('back_length_88_correction')) && get_element_by_name('back_length_88_correction') != '' ? get_element_by_name('back_length_88_correction') : 0;
        var back_length_89_correction = !isNaN(get_element_by_name('back_length_89_correction')) && get_element_by_name('back_length_89_correction') != '' ? get_element_by_name('back_length_89_correction') : 0;
        var aloha_88_correction = !isNaN(get_element_by_name('aloha_88_correction')) && get_element_by_name('aloha_88_correction') != '' ? get_element_by_name('aloha_88_correction') : 0;
        var aloha_89_correction = !isNaN(get_element_by_name('aloha_89_correction')) && get_element_by_name('aloha_89_correction') != '' ? get_element_by_name('aloha_89_correction') : 0;
        var cuffs_circle_correction = !isNaN(get_element_by_name('cuffs_circle_correction')) && get_element_by_name('cuffs_circle_correction') != '' ? get_element_by_name('cuffs_circle_correction') : 0;
        var short_sleeve_correction = !isNaN(get_element_by_name('short_sleeve_correction')) && get_element_by_name('short_sleeve_correction') != '' ? get_element_by_name('short_sleeve_correction') : 0;
        var sleeve_circle_correction = !isNaN(get_element_by_name('sleeve_circle_correction')) && get_element_by_name('sleeve_circle_correction') != '' ? get_element_by_name('sleeve_circle_correction') : 0;

        //sum size
        var sum_neck = parseInt(neck_dimensions) + parseInt(neck_correction);
        var sum_shoulder = parseInt(shoulder_dimensions) + parseInt(shoulder_correction);
        var sum_chest = parseInt(chest_dimensions) + parseInt(chest_correction);
        var sum_waist = parseInt(waist_dimensions) + parseInt(waist_correction);
        var sum_hip = parseInt(hip_dimensions) + parseInt(hip_correction);
        var sum_arm_hole = parseInt(arm_hole_dimensions) + parseInt(arm_hole_correction);
        var sum_back_length_88 = parseInt(back_length_88_dimensions) + parseInt(back_length_88_correction);
        var sum_back_length_89 = parseInt(back_length_89_dimensions) + parseInt(back_length_89_correction);
        var sum_aloha_88 = parseInt(aloha_88_dimensions) + parseInt(aloha_88_correction);
        var sum_aloha_89 = parseInt(aloha_89_dimensions) + parseInt(aloha_89_correction);
        var sum_cuffs_circle = parseInt(cuffs_circle_dimensions) + parseInt(cuffs_circle_correction);
        var sum_short_sleeve = parseInt(short_sleeve_dimensions) + parseInt(short_sleeve_correction);
        var sum_sleeve_circle = parseInt(sleeve_circle_dimensions) + parseInt(sleeve_circle_correction);

        //Product upsize
        $('input[name="neck_product_upsize"]').val(sum_neck);
        $('input[name="shoulder_product_upsize"]').val(sum_shoulder);
        $('input[name="chest_product_upsize"]').val(sum_chest);
        $('input[name="waist_product_upsize"]').val(sum_waist);
        $('input[name="hip_product_upsize"]').val(sum_hip);
        $('input[name="arm_hole_product_upsize"]').val(sum_arm_hole);
        $('input[name="back_length_88_product_upsize"]').val(sum_back_length_88);
        $('input[name="back_length_89_product_upsize"]').val(sum_back_length_89);
        $('input[name="aloha_88_product_upsize"]').val(sum_aloha_88);
        $('input[name="aloha_89_product_upsize"]').val(sum_aloha_89);
        $('input[name="cuffs_circle_product_upsize"]').val(sum_cuffs_circle);
        $('input[name="short_sleeve_product_upsize"]').val(sum_short_sleeve);
        $('input[name="sleeve_circle_product_upsize"]').val(sum_sleeve_circle);

        var set_session = [
            // MAIN SIZE
            ['around_neck_selection', around_neck],
            ['body_type_selection', body_type],
            ['sleeve_type_selection', sleeve_type],
            ['sleeve_length_right_selection', sleeve_length_right],
            ['sleeve_length_left_selection', sleeve_length_left],

            // Upsize
            ['id_size', id_size],
            ['neck_product_upsize', sum_neck],
            ['shoulder_product_upsize', sum_shoulder],
            ['chest_product_upsize', sum_chest],
            ['waist_product_upsize', sum_waist],
            ['hip_product_upsize', sum_hip],
            ['arm_hole_product_upsize', sum_arm_hole],
            ['back_length_88_product_upsize', sum_back_length_88],
            ['back_length_89_product_upsize', sum_back_length_89],
            ['aloha_88_product_upsize', sum_aloha_88],
            ['aloha_89_product_upsize', sum_aloha_89],
            ['cuffs_circle_product_upsize', sum_cuffs_circle],
            ['short_sleeve_product_upsize', sum_short_sleeve],
            ['sleeve_circle_product_upsize', sum_sleeve_circle],

            // Correction
            ['neck_correction', neck_correction],
            ['shoulder_correction', shoulder_correction],
            ['chest_correction', chest_correction],
            ['waist_correction', waist_correction],
            ['hip_correction', hip_correction],
            ['arm_hole_correction', arm_hole_correction],
            ['back_length_88_correction', back_length_88_correction],
            ['back_length_89_correction', back_length_89_correction],
            ['aloha_88_correction', aloha_88_correction],
            ['cuffs_circle_correction', cuffs_circle_correction],
            ['short_sleeve_correction', short_sleeve_correction],
            ['sleeve_circle_correction', sleeve_circle_correction],
        ];

        for (var i = 0; i < set_session.length; i++) {
            $.post(base_url + '/api/order/save_to_session', {
                type: set_session[i][0],
                value: set_session[i][1]
            }, function(response) {});
        }
    }
    // Correction on change
    const correctionElement = document.querySelectorAll('.element_correction');
    let typing;
    correctionElement.forEach((element, idx) => {
        if (correctionElement[idx] === element) {
            correctionElement[idx].addEventListener('keyup', (e) => {
                if (typing) {
                    clearTimeout(typing)
                }
                typing = setTimeout(() => {
                    calculationSize()
                    console.log('hit')
                }, 1000)
            })
        }
    })



    $(function() {

        getSizeCalculation();

        $('#around_neck').change(function() {
            getSizeCalculation();
        });

        $('#select_sleeve_length_right').change(function() {
            var $valRight = $(this).val();
            $('#select_sleeve_length_left option[value=' + $valRight + ']').prop('selected', true);
            getSizeCalculation();
        });

        $('#select_sleeve_length_left').change(function() {
            var $valLeft = $(this).val();
            $('#select_sleeve_length_right option[value=' + $valLeft + ']').prop('selected', true);
            getSizeCalculation();
        });

        $('#select_body_type').change(function() {
            getSizeCalculation();
        });

        $('#select_sleeve_type').change(function() {
            getSizeCalculation();
        });

        function getSizeCalculation() {
            if ($('#around_neck').val() != '' && $('#select_sleeve_length_right').val() != '' && $('#select_sleeve_length_left').val() != '' && $('#select_body_type').val() != '' && $('#select_sleeve_type').val() != '') {
                $.ajax({
                    url: base_url + '/api/product/get_master_size',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('APP_TOKEN', app_token);
                    },
                    data: {
                        neck_size: $('#around_neck').val(),
                        body_type: $('#select_body_type').val(),
                        sleeve_type: $('#select_sleeve_type').val(),
                        sleeve_length_right: $('#select_sleeve_length_right').val(),
                        sleeve_length_left: $('#select_sleeve_length_left').val(),
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function(d) {
                        if (d.STATUS == 'SUCCESS') {
                            console.log(d.DATA);
                            $("input[name=id_size]").val(d.DATA[0].ID);
                            $("input[name=neck_dimensions]").val(d.DATA[0].NECK);
                            $("input[name=shoulder_dimensions]").val(d.DATA[0].SHOULDER);
                            $("input[name=chest_dimensions]").val(d.DATA[0].CHEST);
                            $("input[name=waist_dimensions]").val(d.DATA[0].WAIST);
                            $("input[name=hip_dimensions]").val(d.DATA[0].HIP);
                            $("input[name=arm_hole_dimensions]").val(d.DATA[0].ARM_HOLE);
                            $("input[name=back_length_88_dimensions]").val(d.DATA[0].BACK_LENGTH_88);

                            if (parseInt($('#select_sleeve_length_right').val()) < 89) {
                                $("input[name=back_length_89_dimensions]").val(0);
                                $("input[name=aloha_89_dimensions]").val(0);
                            } else {
                                $("input[name=back_length_89_dimensions]").val(d.DATA[0].BACK_LENGTH_89);
                                $("input[name=aloha_89_dimensions]").val(d.DATA[0].ALOHA_89);
                            }

                            $("input[name=aloha_88_dimensions]").val(d.DATA[0].ALOHA_88);
                            $("input[name=cuffs_circle_dimensions]").val(d.DATA[0].CUFFS_CIRCLE);
                            $("input[name=short_sleeve_dimensions]").val(d.DATA[0].SHORT_SLEEVE);
                            $("input[name=sleeve_circle_dimensions]").val(d.DATA[0].SLEEVE_CIRCLE);
                            if (!$('#collapseDetailSizeAdjustment').hasClass('in')) {
                                $('.link-collapse-size-adjustment').click();
                            }
                        } else {
                            $("input[name=id_size]").val('');
                            $("input[name=neck_dimensions]").val('');
                            $("input[name=shoulder_dimensions]").val('');
                            $("input[name=chest_dimensions]").val('');
                            $("input[name=waist_dimensions]").val('');
                            $("input[name=hip_dimensions]").val('');
                            $("input[name=arm_hole_dimensions]").val('');
                            $("input[name=back_length_88_dimensions]").val('');
                            $("input[name=back_length_89_dimensions]").val('');
                            $("input[name=aloha_88_dimensions]").val('');
                            $("input[name=aloha_89_dimensions]").val('');
                            $("input[name=cuffs_circle_dimensions]").val('');
                            $("input[name=short_sleeve_dimensions]").val('');
                            $("input[name=sleeve_circle_dimensions]").val('');
                        }
                    }
                })
            }
        }
    })
</script>