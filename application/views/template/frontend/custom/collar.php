<?php
# @Author: Awan Tengah
# @Date:   2017-03-21T11:19:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-31T00:29:58+07:00
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
                    Collar <span class="pull-right"><?php echo $count_collar; ?> Items</span>
                </div>
                <div class="panel-body padding-0">
                    <div class="form-group search-box-custom">
                        <input type="search" id="key_search" name="collar_search" class="form-control" placeholder="Collar Search">
                    </div>
                    <div id="collar" class="list-material"></div>
                </div>
            </div>
        </div>
    </div>
    <br /><br />
    <div class="row">
        <div class="col-sm-7">
            <!-- <div class="footer-custom-nav">
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom'); ?>" style="margin-left:39px;"><span class="ion-chevron-left"></span> Fabric</a>
                    <div>
                        <a href="<?php echo site_url('custom'); ?>"><img src="<?php echo base_url('assets/img/prev_btn.png'); ?>" style="width:80px;"></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    Collar Selection
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/cuffs'); ?>">Cuffs <span class="ion-chevron-right"></span></a>
                    <div>
                        <a href="<?php echo site_url('custom/cuffs'); ?>"><img src="<?php echo base_url('assets/img/next_btn.png'); ?>" style="width:80px;"></a>
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

<button id="change_collar" data-objname="" data-button="" data-button_hole="" data-button_thread="" data-inner_collar="" data-src="" data-material="" style="display:none;"></button>

<script>
    $(document).ready(function() {
        var material = 'collar';
        var category = '';
        var key = '';

        var param = {
            material: material,
            category: category,
            key: key,
        }
        show_all_materials(param);

        $("#key_search").keyup(function() {
            var param = {
                material: material,
                category: '',
                key: $(this).val()
            }
            show_all_materials(param);
        });

        <?php $this->load->view('template/frontend/custom/_js_objects'); ?>
    });
</script>