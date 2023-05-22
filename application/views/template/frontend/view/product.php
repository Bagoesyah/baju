<?php
# @Author: Awan Tengah
# @Date:   2017-04-12T12:43:12+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-20T11:53:06+07:00
?>

<div class="container custom text-justify">
    <div class="row">
        <div class="col-sm-7 text-center">
            <h4><strong><?php echo $product->DATA->TITLE; ?></strong></h4>
            <img src="<?php echo !empty($product->DATA->IMAGE) ? base_url(path_image('product_image_path') . $product->DATA->IMAGE[0]->IMAGE) : base_url('assets/img/no_image.png'); ?>" class="img-responsive col-centered">
        </div>
        <div class="col-sm-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Design Verification
                </div>
                <div class="panel-body padding-0">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFabric" aria-expanded="true" aria-controls="collapseFabric">
                                        Fabric
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFabric" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" data-material="fabric">
                                <div class="panel-body">
                                    <?php if(isset($fabric)): ?>
                                        <strong>Type</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_fabric_path') . $fabric->thumb); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $fabric->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_fabric')); ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_fabric')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCollar" aria-expanded="false" aria-controls="collapseCollar">
                                        Collar
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseCollar" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <?php if(isset($collar)): ?>
                                        <strong>Type</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_collar_path') . $collar->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $collar->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_collar')); ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_collar')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCuffs" aria-expanded="false" aria-controls="collapseCuffs">
                                        Cuffs
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseCuffs" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php if(isset($cuff)): ?>
                                        <strong>Type</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_cuff_path') . $cuff->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $cuff->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_cuff')); ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_cuff')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseBodyType" aria-expanded="false" aria-controls="collapseBodyType">
                                        Body Type
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseBodyType" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php if(isset($body_type_front)): ?>
                                        <strong>Type Front</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_body_type_path') . $body_type_front->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $body_type_front->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_body_type_front')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($body_type_back)): ?>
                                        <strong>Type Back</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_body_type_path') . $body_type_back->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $body_type_back->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_body_type_back')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($body_type_hem)): ?>
                                        <strong>Type Hem</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_body_type_path') . $body_type_hem->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $body_type_hem->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_body_type_hem')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_body_type_front') + get_session('price_id_body_type_back') + get_session('price_id_body_type_hem')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePocket" aria-expanded="false" aria-controls="collapsePocket">
                                        Pocket
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsePocket" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php if(isset($pocket)): ?>
                                        <strong>Type</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_pocket_path') . $pocket->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $pocket->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_pocket')); ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_pocket')); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseButtons" aria-expanded="false" aria-controls="collapseButtons">
                                        Buttons
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseButtons" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php if(isset($button)): ?>
                                        <strong>Type Button</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_buttons_path') . $button->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $button->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_button')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($button_hole)): ?>
                                        <strong>Type Button Hole</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_buttons_path') . $button_hole->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $button_hole->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_button_hole')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($button_thread)): ?>
                                        <strong>Type Button Thread</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_buttons_path') . $button_thread->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $button_thread->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_button_thread')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_button') + get_session('price_id_button_hole') + get_session('price_id_button_thread')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCleric" aria-expanded="false" aria-controls="collapseCleric">
                                        Cleric
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseCleric" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php if(isset($cleric_fabric)): ?>
                                        <strong>Type Fabric</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_fabric_path') . $cleric_fabric->thumb); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $cleric_fabric->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_cleric_fabric')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($cleric_stitch)): ?>
                                        <strong>Type Stitch</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_fabric_path') . $cleric_stitch->thumb); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $cleric_stitch->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_cleric_stitch')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_cleric_fabric') + get_session('price_id_cleric_stitch')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEmbroidery" aria-expanded="false" aria-controls="collapseEmbroidery">
                                        Embroidery
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEmbroidery" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php if(isset($embroidery_position)): ?>
                                        <strong>Type Position</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_embroidery_path') . $embroidery_position->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $embroidery_position->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_embroidery_position')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($embroidery_font)): ?>
                                        <strong>Type Font</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_embroidery_path') . $embroidery_font->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $embroidery_font->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_embroidery_font')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($embroidery_color)): ?>
                                        <strong>Type Color</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_embroidery_path') . $embroidery_color->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $embroidery_color->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_embroidery_color')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_embroidery_position') + get_session('price_id_embroidery_font') + get_session('price_id_embroidery_color')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOption" aria-expanded="false" aria-controls="collapseOption">
                                        Option
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOption" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php if(isset($option_amf_stitch)): ?>
                                        <strong>Type AMF Stitch</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_option_path') . $option_amf_stitch->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $option_amf_stitch->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_option_amf_stitch')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($option_interlining)): ?>
                                        <strong>Type Interlining</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_option_path') . $option_interlining->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $option_interlining->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_option_interlining')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($option_sewing)): ?>
                                        <strong>Type Sewing</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_option_path') . $option_sewing->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $option_sewing->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_option_sewing')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($option_tape)): ?>
                                        <strong>Type Tape</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_option_path') . $option_tape->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $option_tape->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_option_tape')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_option_amf_stitch') + get_session('price_id_option_interlining') + get_session('price_id_option_sewing') + get_session('price_id_option_tape')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOther" aria-expanded="false" aria-controls="collapseOther">
                                        Other
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOther" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="pull-right">
                    <label>Final Price</label>
                    <?php if(count($product->DATA->PROMO)){ ?>
                        <div>
                            <strong><strike><?php echo format_currency($product->DATA->PRICE); ?></strike></strong>&nbsp;
                            <strong><?php echo format_currency($product->DATA->PRICE_AFTER_PROMO); ?></strong>
                        </div>
                    <?php }else{ ?>
                        <div>
                            <strong><?php echo format_currency($product->DATA->PRICE); ?></strong>&nbsp;
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-6">
                <a href="<?php echo site_url('custom'); ?>" class="btn btn-primary btn-block">Custom Shirt</a>
            </div>
            <div class="col-sm-6">
                <a id="proceed-ready-to-wear" class="btn btn-primary btn-block" data-slug="<?php echo $product->DATA->SLUG; ?>">Proceed</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#proceed-ready-to-wear").click(function() {
        var slug = $(this).data('slug');
        $.post(base_url + '/cart/proceed', {SLUG: slug}, function(){})
        .done(function(response) {
            window.location = base_url + '/cart';
        })
        .fail(function(response) {
            window.location = base_url + '/cart';
            // alert('SOMETHING WENT WRONG, PLEASE CONTACT ADMINISTRATOR');
        });
    });
});
</script>
