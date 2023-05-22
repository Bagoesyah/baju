<?php
# @Author: Awan Tengah
# @Date:   2017-03-21T11:19:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-26T12:45:38+07:00
?>

<?php $this->load->view('template/frontend/custom/_objects'); ?>

<div class="container custom text-justify">
    <div class="row">
        <!-- <div class="col-sm-7">
            <h4 id="progressbar" style="position:absolute;z-index:9999;margin-left:15px;">10%</h4>
        </div> -->
        <div class="clearfix"></div>

        <div class="col-sm-7 col-lg-7">
            <div class="row">
                <canvas class="col-sm-12 text-center" id="objcontainer"></canvas>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cleric
                </div>
                <div class="panel-body padding-0">
                    <div class="category-custom">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills cleric-tab" role="tablist">
                            <li class="active"><a href="#cleric-1" aria-controls="cleric-1" role="tab" class="category-cleric" data-toggle="tab" data-idcategory="1" data-material="cleric" data-header="cleric">Collar <br/>&amp; Cuffs</a></li>
                            <li><a href="#cleric-2" aria-controls="cleric-2" role="tab" class="category-cleric" data-toggle="tab" data-idcategory="2" data-material="cleric" data-header="cleric">Collar/Cuffs <br/>&amp; Front Placket</a></li>
                            <li><a href="#cleric-3" aria-controls="cleric-3" role="tab" class="category-cleric" data-toggle="tab" data-idcategory="3" data-material="cleric" data-header="cleric">Inner Collar Stand <br/>&amp; Inner Cuffs</a></li>
                            <li><a href="#cleric-4" aria-controls="cleric-4" role="tab" class="category-cleric" data-toggle="tab" data-idcategory="4" data-material="cleric" data-header="cleric">Inner Collar Stand/Inner Cuffs <br/>&amp; Lower Placket</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="cleric-1" style="padding:5px;">
                                <div class="category-cleric-img" style="padding: 0 0 10px 0;margin-bottom:5px;border-bottom:1px solid #dadada;margin-left:-5px;margin-right:-5px;"></div>
                                <div id="cleric-1-fabric"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="cleric-2" style="padding:5px;">
                                <div class="category-cleric-img" style="padding: 0 0 10px 0;margin-bottom:5px;border-bottom:1px solid #dadada;margin-left:-5px;margin-right:-5px;"></div>
                                <div id="cleric-2-fabric"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="cleric-3" style="padding:5px;">
                                <div class="category-cleric-img" style="padding: 0 0 10px 0;margin-bottom:5px;border-bottom:1px solid #dadada;margin-left:-5px;margin-right:-5px;"></div>
                                <div id="cleric-3-fabric"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="cleric-4" style="padding:5px;">
                                <div class="category-cleric-img" style="padding: 0 0 10px 0;margin-bottom:5px;border-bottom:1px solid #dadada;margin-left:-5px;margin-right:-5px;"></div>
                                <div id="cleric-4-fabric"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <!-- <div class="footer-custom-nav">
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/buttons'); ?>" style="margin-left:33px;"><span class="ion-chevron-left"></span> Button</a>
                    <div>
                        <a href="<?php echo site_url('custom/buttons'); ?>"><img src="<?php echo base_url('assets/img/prev_btn.png'); ?>" style="width:80px;"></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    Cleric Selection
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/embroidery'); ?>">Embroidery <span class="ion-chevron-right"></span></a>
                    <div>
                        <a href="<?php echo site_url('custom/embroidery'); ?>"><img src="<?php echo base_url('assets/img/next_btn.png'); ?>" style="width:80px;"></a>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="col-sm-5">
            <div class="pull-right">
                <label>Total Price</label>
                <div id="sub_price_fabric"></div>
            </div>
        </div>
    </div>
</div>

<!--
<button id="change_cleric_inner_collar" data-objname="" data-src="" data-material="" style="display:none;"></button>
<button id="change_cleric_cuffs" data-objname="" data-src="" data-material="" style="display:none;"></button>
<button id="change_cleric_front_placket" data-objname="" data-src="" data-material="" style="display:none;"></button>
<button id="change_cleric_lower_placket" data-objname="" data-src="" data-material="" style="display:none;"></button>
<button id="change_cleric_inner_cuffs" data-objname="" data-src="" data-material="" style="display:none;"></button>
<button id="change_cleric_collar" data-objname="" data-src="" data-material="" style="display:none;"></button>
-->

<script>
$(document).ready(function() {
    var param = {
        material: 'cleric',
        id: '1',
        category: 'collar',
        idcategory: '1',
        idsubcategory: '1',
        cleric_type: '1',
        sub: '1'
    }
    get_category_cleric(param);
    show_all_material_cleric(param);

    <?php $this->load->view('template/frontend/custom/_js_objects'); ?>
});
</script>
