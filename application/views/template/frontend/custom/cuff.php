<?php
# @Author: Awan Tengah
# @Date:   2017-03-21T11:19:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-31T00:30:02+07:00
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
                    Cuff <span class="pull-right"><?php echo $count_cuff; ?> Items</span>
                </div>
                <div class="panel-body padding-0">
                    <div class="form-group search-box-custom">
                        <input type="search" id="key_search" name="cuff_search" class="form-control" placeholder="Cuff Search">
                    </div>
                    <div class="list-material" id="cuff"></div>
                </div>
                <div class="panel-heading">
                    Sleeve <span class="pull-right"><?php echo $count_sleeve; ?> Items</span>
                </div>
                <div class="panel-body padding-0">
                    <div class="list-material" id="sleeve"></div>
                </div>
            </div>
        </div>
    </div>
    <br /><br />
    <div class="row">
        <div class="col-sm-7">
            <!-- <div class="footer-custom-nav">
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/collar'); ?>" style="margin-left:39px;"><span class="ion-chevron-left"></span> Collar</a>
                    <div>
                        <a href="<?php echo site_url('custom/collar'); ?>"><img src="<?php echo base_url('assets/img/prev_btn.png'); ?>" style="width:80px;"></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    Cuffs Selection
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/body-type'); ?>">Body <span class="ion-chevron-right"></span></a>
                    <div>
                        <a href="<?php echo site_url('custom/body-type'); ?>"><img src="<?php echo base_url('assets/img/next_btn.png'); ?>" style="width:80px;"></a>
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

<button id="change_cuff" data-objname="" data-src="" data-material="" style="display:none;"></button>
<button id="change_sleeve" data-objname="" data-src="" data-material="" style="display:none;"></button>

<script>
    $(document).ready(function() {
        var material = 'cuff';
        var category = 'cuff';
        var key = '';

        var param = {
            material: material,
            category: category,
            key: key
        }
        show_all_materials(param);

        var param = {
            material: 'sleeve',
            category: 'sleeve',
            key: key
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