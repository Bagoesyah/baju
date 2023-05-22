<?php
# @Author: Awan Tengah
# @Date:   2017-03-21T11:19:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-31T00:30:07+07:00
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
                    Embroidery
                </div>
                <div class="panel-body padding-0">
                    <div class="list-material">
                        <strong>Input Character</strong>
                        <p>
                            Please write down your initial (font type 1, 2, 3) or long name (font type 4) into below boxes.
                        </p>
                        <div class="form-group">
                            <?php
                            if ($this->session->userdata('sess_embroidery_text')) $value_text = $this->session->userdata('sess_embroidery_text');
                            ?>
                            <input type="text" maxlength="12" value="<?php echo isset($value_text) ? $value_text : ''; ?>" id="embroidery_text" name="embroidery_text" class="form-control" placeholder="Input your character here">
                        </div>
                    </div>
                    <div class="category-custom">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills material-list embroidery-tab" role="tablist">
                            <li class="active"><a class="tab-menu-category" href="#position" data-toggle="tab" data-material="embroidery" data-category="position">Position</a></li>
                            <li><a class="tab-menu-category" href="#color" data-toggle="tab" data-material="embroidery" data-category="color">Color</a></li>
                            <li><a class="tab-menu-category" href="#font" data-toggle="tab" data-material="embroidery" data-category="font">Font</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane list-material active" id="position"></div>
                            <div class="tab-pane list-material" id="font"></div>
                            <div class="tab-pane list-material" id="color"></div>
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
                    <a href="<?php echo site_url('custom/cleric'); ?>" style="margin-left:39px;"><span class="ion-chevron-left"></span> Cleric</a>
                    <div>
                        <a href="<?php echo site_url('custom/cleric'); ?>"><img src="<?php echo base_url('assets/img/prev_btn.png'); ?>" style="width:80px;"></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    Embroidery Selection
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/option'); ?>">Option <span class="ion-chevron-right"></span></a>
                    <div>
                        <a href="<?php echo site_url('custom/option'); ?>"><img src="<?php echo base_url('assets/img/next_btn.png'); ?>" style="width:80px;"></a>
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
    var material = 'embroidery';
    var category = 'position';
    var key      = '';

    var param = {
        material: material,
        category: category,
        key: key
    }
    show_all_material(param);
    
        // menu category
        $(".tab-menu-category").click(function (e) {
          const category = $(e.target).attr("data-category");
          var param = {
            material: material,
            category: `${category}`,
            key: key
        }
        show_all_materials(param);
        });

    $('#embroidery_text').on('blur', function() {
        $.ajax({
            url: "<?php echo base_url('api/order/set_session_embroidery_text'); ?>",
            beforeSend: function(xhr){xhr.setRequestHeader('APP_TOKEN', app_token);},
            data: {
                text: $(this).val()
            },
            dataType: "json",
            type: "POST",
            success: function(d) { }
        });
    });

    /**
    $("#key_search").keyup(function(){
        var category    = $(".material-list li.active a").data('category');
        var param = {
            material: material,
            category: category,
            key: $(this).val()
        }
        show_all_materials(param);
    });
    **/

    <?php $this->load->view('template/frontend/custom/_js_objects'); ?>
});
</script>
