<?php
# @Author: Awan Tengah
# @Date:   2017-03-21T11:19:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-31T00:29:46+07:00
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
                    Body Type
                </div>
                <div class="panel-body padding-0">
                    <div class="category-custom">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills body-type-tab" role="tablist">
                            <li class="active"><a href="#front" data-toggle="tab" data-material="body_type" data-category="front">04 Front</a></li>
                            <li><a href="#hem" data-toggle="tab" data-material="body_type" data-category="hem">06 Hem</a></li>
                            <li><a href="#back" data-toggle="tab" data-material="body_type" data-category="back">07 Back</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane list-material active" id="front"></div>
                            <div class="tab-pane list-material" id="back"></div>
                            <div class="tab-pane list-material" id="hem"></div>
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
                    <a href="<?php echo site_url('custom/cuffs'); ?>" style="margin-left:41px;"><span class="ion-chevron-left"></span> Cuffs</a>
                    <div>
                        <a href="<?php echo site_url('custom/cuffs'); ?>"><img src="<?php echo base_url('assets/img/prev_btn.png'); ?>" style="width:80px;"></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    Body Selection
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/pocket'); ?>">Pocket <span class="ion-chevron-right"></span></a>
                    <div>
                        <a href="<?php echo site_url('custom/pocket'); ?>"><img src="<?php echo base_url('assets/img/next_btn.png'); ?>" style="width:80px;"></a>
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
    var material = 'body_type';
    var category = 'front';

    var param = {
        material: material,
        category: category
    }
    show_all_material(param);

    <?php $this->load->view('template/frontend/custom/_js_objects'); ?>
});
</script>
