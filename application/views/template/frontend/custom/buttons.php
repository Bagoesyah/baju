<?php
# @Author: Awan Tengah
# @Date:   2017-03-21T11:19:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-31T00:29:50+07:00
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
                    Button <span class="pull-right"><?php echo $count_buttons; ?> Items</span>
                </div>
                <div class="panel-body padding-0">
                    <div class="category-custom">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills button-tab" role="tablist">
                            <li class="active"><a class="tab-menu-category" href="#button" data-toggle="tab" data-material="buttons" data-category="button">08 Button</a></li>
                            <li><a class="tab-menu-category" href="#button_hole" data-toggle="tab" data-material="buttons" data-category="button_hole">11 Button Hole</a></li>
                            <li><a class="tab-menu-category" href="#button_thread" data-toggle="tab" data-material="buttons" data-category="button_thread">12 Button Thread</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane list-material active" id="button"></div>
                            <div class="tab-pane list-material" id="button_hole"></div>
                            <div class="tab-pane list-material" id="button_thread"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/><br/>
    <div class="row">
        <div class="col-sm-7">
            <!-- <div class="footer-custom-nav">
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/pocket'); ?>" style="margin-left:34px;"><span class="ion-chevron-left"></span> Pocket</a>
                    <div>
                        <a href="<?php echo site_url('custom/pocket'); ?>"><img src="<?php echo base_url('assets/img/prev_btn.png'); ?>" style="width:80px;"></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    Button Selection
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/cleric'); ?>">Cleric <span class="ion-chevron-right"></span></a>
                    <div>
                        <a href="<?php echo site_url('custom/cleric'); ?>"><img src="<?php echo base_url('assets/img/next_btn.png'); ?>" style="width:80px;"></a>
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

<button id="change_button" data-src="" data-material="" style="display:none;"></button>
<button id="change_button_hole" data-src="" data-material="" style="display:none;"></button>
<button id="change_button_thread" data-src="" data-material="" style="display:none;"></button>

<script>
$(document).ready(function() {
    var material = 'buttons';
    var category = 'button';

    var param = {
        material: material,
        category: `${category}`,
    }
    show_all_materials(param);

        // menu category
        $(".tab-menu-category").click(function (e) {
          const category = $(e.target).attr("data-category");
          var param = {
            material: material,
            category: `${category}`,
        }
        show_all_materials(param);
        });

    <?php $this->load->view('template/frontend/custom/_js_objects'); ?>
});
</script>