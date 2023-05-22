<?php
# @Author: Awan Tengah
# @Date:   2017-03-17T14:01:19+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-31T00:29:29+07:00
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
                    Fabric <span class="pull-right"><?php echo $count_fabric; ?> Items</span>
                </div>
                <div class="panel-body padding-0">
                    <div class="form-group search-box-custom">
                        <input type="search" id="key_search" name="fabric_search" class="form-control" placeholder="Fabric Search">
                    </div>
                    <div class="category-custom">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills material-list fabric-tab" role="tablist">
                            <li class="active"><a href="#standard" data-toggle="tab" data-material="fabric" data-category="standard">Standard</a></li>
                            <li><a href="#premium" data-toggle="tab" data-material="fabric" data-category="premium">Premium</a></li>
                            <li><a href="#super_premium" data-toggle="tab" data-material="fabric" data-category="super_premium">Super Premium</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane list-material" id="standard"></div>
                            <div class="tab-pane list-material active" id="premium"></div>
                            <div class="tab-pane list-material" id="super_premium"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <br /><br />
    <div class="row">
        <div class="col-sm-7">
            <!-- <div class="footer-custom-nav">
                <div class="col-sm-4" id="mydiv"></div>
                <div class="col-sm-4">
                    Fabric Selection
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/collar'); ?>">Collar <span class="ion-chevron-right"></span></a>
                    <div>
                        <a href="<?php echo site_url('custom/collar'); ?>"><img src="<?php echo base_url('assets/img/next_btn.png'); ?>" style="width:80px;"></a>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="col-sm-5">
            <div class="pull-right">
                <label>Total Price</label>
                <div id="sub_price_fabric"></div>
            </div>
            <div class="footer-custom-detail">
                <h4><strong>Make your own shirt</strong></h4>
                <div id="fcd-fabric"></div>
            </div>
        </div>
    </div>
</div>

<button id="change_fabric" data-src="" data-material="" style="display:none;"></button>

<script>
    $(document).ready(function() {
        var material = 'fabric';
        var category = 'standard';
        var key = '';

        var param = {
            material: material,
            category: category,
            key: key,
            // material: 'fabric',
            // id: '1',
            // category: 'standard',
            // idcategory: '1',
            // idsubcategory: '1',
            // sub: '1'
        }
        show_all_materials(param);

        $("#key_search").keyup(function() {
            var category = $(".material-list li.active a").data('category');
            var param = {
                material: material,
                category: category,
                key: $(this).val()
            }
            show_all_materials(param);
        });

        <?php $this->load->view('template/frontend/custom/_js_objects'); ?>
    });
</script>