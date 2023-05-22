<?php
# @Author: Awan Tengah
# @Date:   2017-03-21T11:19:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-26T20:33:19+07:00
?>

<?php $this->load->view('template/frontend/custom/_objects'); ?>

<div class="container custom text-justify">
    <div class="row">
        <!-- <div class="col-sm-7">
            <h4 id="progressbar" style="position:absolute;z-index:9999;margin-left:15px;">10%</h4>
        </div> -->
        <div class="clearfix"></div>

        <div class="col-sm-7 col-lg-7" style="position:relative;">
            <div class="" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:101;"></div>
            <div class="row">
                <canvas class="col-sm-12 text-center" id="objcontainer" style="position:relative;z-index:100;"></canvas>
            </div>
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
                                                        (<?php echo $fabric->code_fabric; ?>) <?php echo $fabric->title; ?>
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
                                        Cuffs &amp; Sleeve
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseCuffs" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <?php if(isset($cuff)): ?>
                                        <strong>Cuff Type:</strong>
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
                                                
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($sleeve)): ?>
                                        <strong>Sleeve Type:</strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <img src="<?php echo base_url(path_image('material_cuff_path') . $sleeve->image); ?>" class="img-thumbnail">
                                                    <div class="title-material">
                                                        <?php echo $sleeve->title; ?>
                                                    </div>
                                                    <div class="price-material">
                                                        <?php echo format_currency(get_session('price_id_sleeve')); ?>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <hr>
                                    Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_cuff') + get_session('price_id_sleeve')); ?></span>
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
                                    <?php endif; ?>
                                        <hr>
                                        Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_body_type_front') + get_session('price_id_body_type_back') + get_session('price_id_body_type_hem')); ?></span>
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
                                    <?php else:
                                    ?>
                                    <strong>Type Button Hole</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material">Match Fabric Color</div><br/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                     endif; ?>
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
                                    <?php else:
                                    ?>
                                    <strong>Type Button Thread</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material">Match Fabric Color</div><br/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                        <hr>
                                        Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_button') + get_session('price_id_button_hole') + get_session('price_id_button_thread')); ?></span>
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
                                    <?php if(isset($cleric)): ?>
                                        <div>
                                            <?php
                                            $cleric_type_id = get_session('cleric_type_id');
                                            if ($cleric_type_id == 1) {
                                                $cleric_cat = 'Collar &amp; Cuffs';
                                                $cleric_price = 50000;
                                            } else if ($cleric_type_id == 2) {
                                                $cleric_cat = 'Collar/Cuffs &amp; Front Placket';
                                                $cleric_price = 50000;
                                            } else if ($cleric_type_id == 3) {
                                                $cleric_cat = 'Inner Collar Stand &amp; Inner Cuffs';
                                                $cleric_price = 50000;
                                            } else if ($cleric_type_id == 4) {
                                                $cleric_cat = 'Inner Collar Stand/Inner Cuffs &amp; Lower Placket';
                                                $cleric_price = 100000;
                                            }
                                            ?>
                                            <strong>Type: <br/><?php echo $cleric_cat; ?></strong><br/>
                                        </div>
                                        <div class="box-material-verify">
                                            <img style="max-width:100px;" src="<?php echo base_url(path_image('material_cleric_path') . $cleric->image); ?>" class="img-thumbnail">
                                            <p><?php echo $cleric->title; ?> (<?php echo $cleric->code_fabric; ?>)</p>
                                            <div class="price-material">
                                                <?php echo format_currency($cleric_price); ?>
                                            </div>
                                        </div>
                                    <?php else:
                                    ?>
                                    <strong>None</strong>
                                    <?php endif; ?>
                                    <div class="clearfix"></div>
                                    <?php if(isset($cleric_2)): ?>
                                        <div class="col-lg-12">
                                        </div>
                                    <?php endif; ?>
                                            <hr>
                                            Total Price: <span class="pull-right"><?php echo isset($cleric_price) ? format_currency($cleric_price) : format_currency(0); ?></span>
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
                                    <?php if(isset($embroidery_text)): ?>
                                        <strong>Text: </strong>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="box-material-verify">
                                                    <div class="title-material">
                                                        <?php echo $embroidery_text; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else:
                                    ?>
                                    <strong>Text:</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material"></div><br/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endif; ?>
                                    <?php if(isset($embroidery_position)): ?>
                                        <strong>Position</strong>
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
                                    <?php else:
                                    ?>
                                    <strong>Position</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material">None</div><br/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endif; ?>
                                    <?php if(isset($embroidery_font)): ?>
                                        <strong>Font</strong>
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
                                    <?php 
                                    else:
                                    ?>
                                    <strong>Font</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material">None</div><br/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endif; ?>
                                    <?php if(isset($embroidery_color)): ?>
                                        <strong>Color</strong>
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
                                    <?php else:
                                    ?>
                                    <strong>Color</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material">None</div><br/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endif; ?>
                                        <hr>
                                        Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_embroidery_position') + get_session('price_id_embroidery_font') + get_session('price_id_embroidery_color')); ?></span>
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
                                        <strong>Stitch Thread</strong>
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
                                        </div><br/>
                                    <?php 
                                    else:
                                    ?>
                                    <strong>Stitch Thread</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material">None</div><br/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endif; 
                                    
                                    ?>
                                    <?php if(isset($option_interlining)): ?>
                                        <strong>Interlining</strong>
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
                                        </div><br/>
                                    <?php 
                                    else:
                                    ?>
                                    <strong>Interlining</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material">Standard</div><br/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endif; ?>
                                    <?php if(isset($option_sewing)): ?>
                                        <strong>Sewing</strong>
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
                                        </div><br/>
                                    <?php 
                                    else:
                                    ?>
                                    <strong>Sewing</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material">Standard</div><br/>
                                            </div>
                                        </div>
                                    </div>                    
                                    <?php
                                    endif; ?>
                                    <?php if(isset($option_tape)): ?>
                                        <strong>Tape</strong>
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
                                    <?php 
                                    else:
                                    ?>
                                    <strong>Tape</strong>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="box-material-verify">
                                                <div class="title-material">None</div>
                                            </div>
                                        </div>
                                    </div>    
                                    <?php
                                    endif; ?>
                                        <hr>
                                        Total Price: <span class="pull-right"><?php echo format_currency(get_session('price_id_option_amf_stitch') + get_session('price_id_option_interlining') + get_session('price_id_option_sewing') + get_session('price_id_option_tape')); ?></span>
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
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Neck</td>
                                                    <td><?php echo get_session('neck_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Shoulder</td>
                                                    <td><?php echo get_session('shoulder_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Chest</td>
                                                    <td><?php echo get_session('chest_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waist</td>
                                                    <td><?php echo get_session('waist_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Hip</td>
                                                    <td><?php echo get_session('hip_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Arm Hole</td>
                                                    <td><?php echo get_session('arm_hole_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Back Length (~88cm)</td>
                                                    <td><?php echo get_session('back_length_88_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Back Length (89cm~)</td>
                                                    <td><?php echo get_session('back_length_89_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Aloha (~88cm)</td>
                                                    <td><?php echo get_session('aloha_88_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Aloha (89cm~)</td>
                                                    <td><?php echo get_session('aloha_89_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Cuffs Circle</td>
                                                    <td><?php echo get_session('cuffs_circle_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Short Sleeve</td>
                                                    <td><?php echo get_session('short_sleeve_product_upsize'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sleeve Circle</td>
                                                    <td><?php echo get_session('sleeve_circle_product_upsize'); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Special Request?</label>
                <textarea name="special_request_verify" onchange="get_value_by_name('special_request_verify', this.value);" rows="4" cols="80" class="form-control" placeholder="Enter Additional Note.."></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <!-- <div class="footer-custom-nav">
                <div class="col-sm-4">
                    <a href="<?php echo site_url('custom/other'); ?>"><span class="ion-chevron-left"></span> Other</a>
                </div>
                <div class="col-sm-4">
                    Verify Selection
                </div>
                <div class="col-sm-4">
                </div>
            </div> -->
        </div>
        <div class="col-sm-5">
            <div class="pull-right">
                <label>Final Price</label>
                <div id="sub_price_fabric"></div>
                <a href="<?php echo site_url('cart/proceed'); ?>" class="btn btn-primary">Proceed</a>
            </div>
        </div>
    </div>
</div>
<div>
    <img id="test-img" src="">
</div>
<script>
$(document).ready(function() {
    get_price_material_custom();

    <?php $this->load->view('template/frontend/custom/_js_objects'); ?>
    setTimeout(function () {
        img = setSceneImageSession();
        $('#test-img').prop('src', img);
    }, 100);
});
</script>
