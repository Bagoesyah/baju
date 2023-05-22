<?php
# @Author: Awan Tengah
# @Date:   2017-03-21T11:19:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-31T00:30:11+07:00
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
                    Option
                </div>
                <div class="panel-body padding-0">
                    <div class="category-custom">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills option-tab" role="tablist">
                            <li class="active"><a href="#amf_stitch" data-toggle="tab" data-material="option" data-category="amf_stitch">13 Stitch Thread</a></li>
                            <li><a href="#interlining" data-toggle="tab" data-material="option" data-category="interlining">15 Interlining</a></li>
                            <li><a href="#sewing" data-toggle="tab" data-material="option" data-category="sewing">16 Sewing</a></li>
                            <li><a href="#tape" data-toggle="tab" data-material="option" data-category="tape">17 Tape</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane list-material active" id="amf_stitch"></div>
                            <div class="tab-pane list-material" id="interlining"></div>
                            <div class="tab-pane list-material" id="sewing"></div>
                            <div class="tab-pane list-material" id="tape"></div>
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
                    <a href="<?php echo site_url('custom/embroidery'); ?>" style="margin-left:8px;"><span class="ion-chevron-left"></span> Embroidery</a>
                    <div>
                        <a href="<?php echo site_url('custom/embroidery'); ?>"><img src="<?php echo base_url('assets/img/prev_btn.png'); ?>" style="width:80px;"></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    Option Selection
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/other'); ?>">Size <span class="ion-chevron-right"></span></a>
                    <div>
                        <a href="<?php echo site_url('custom/other'); ?>"><img src="<?php echo base_url('assets/img/next_btn.png'); ?>" style="width:80px;"></a>
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

<script>
$(document).ready(function() {
    var material = 'option';
    var category = 'amf_stitch';

    var param = {
        material: material,
        category: category
    }
    show_all_material(param);

    <?php $this->load->view('template/frontend/custom/_js_objects'); ?>
});
</script>
