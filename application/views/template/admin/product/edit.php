<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:51:08+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-26T11:28:46+07:00
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <?php if (isset($sub_page_title)): ?>
                <small><?php echo $sub_page_title; ?></small>
            <?php endif; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/product'); ?>"><?php echo ucwords('product'); ?></a></li>
            <li class="active"><?php echo $on_section . ' ' . $page_title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <?php echo form_open_multipart(); ?>
            <div class="box-body">
                <?php alert_message(); ?>

                <div class="form-group <?php echo form_error('id_product_category') ? 'has-error' : ''; ?>">
                    <label for="id_product_category">Kategori</label>
                    <select name="id_product_category" id="id_product_category" class="form-control">
                        <option value="">Choose</option>
                        <?php foreach($product_category as $row): ?>
                            <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_product_category", $row->id, $product->id_product_category == $row->id ? true : false)  : set_select("id_product_category", $row->id); ?>><?php echo $row->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_product_category', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($product) ? $product->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('description') ? 'has-error' : ''; ?>">
                    <label for="ckeditor">Description</label>
                    <textarea name="description" id="ckeditor" class="form-control" placeholder="Enter Description">
                        <?php echo isset($product) ? $product->description : set_value('description'); ?>
                    </textarea>
                    <?php echo form_error('description', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('price') ? 'has-error' : ''; ?>">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price" value="<?php echo isset($product) ? $product->price : set_value('price'); ?>">
                    <?php echo form_error('price', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('stock') ? 'has-error' : ''; ?>">
                    <label for="stock">Stock</label>
                    <input type="text" name="stock" id="stock" class="form-control" placeholder="Enter Stock" value="<?php echo isset($product) ? $product->stock : set_value('stock'); ?>">
                    <?php echo form_error('stock', '<p class="help-block text-red">', '</p>'); ?>
                </div>
                <hr>
                <div class="form-group">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#fabric" aria-controls="fabric" role="tab" data-toggle="tab">Fabric</a></li>
                        <li role="presentation"><a href="#collar" aria-controls="collar" role="tab" data-toggle="tab">Collar</a></li>
                        <li role="presentation"><a href="#buttons" aria-controls="buttons" role="tab" data-toggle="tab">Buttons</a></li>
                        <li role="presentation"><a href="#cuff" aria-controls="cuff" role="tab" data-toggle="tab">Cuff</a></li>
                        <li role="presentation"><a href="#body_type" aria-controls="body_type" role="tab" data-toggle="tab">Body Type</a></li>
                        <!-- <li role="presentation"><a href="#cleric" aria-controls="cleric" role="tab" data-toggle="tab">Cleric</a></li> -->
                        <li role="presentation"><a href="#pocket" aria-controls="pocket" role="tab" data-toggle="tab">Pocket</a></li>
                        <li role="presentation"><a href="#embroidery" aria-controls="embroidery" role="tab" data-toggle="tab">Embroidery</a></li>
                        <li role="presentation"><a href="#option" aria-controls="option" role="tab" data-toggle="tab">Option</a></li>
                        <!-- <li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">Other</a></li> -->
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="fabric">
                            <div class="form-group <?php echo form_error('id_fabric') ? 'has-error' : ''; ?>">
                                <label for="id_fabric">Fabric</label>
                                <select name="id_fabric" id="id_fabric" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($fabric as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_fabric", $row->id, $product->id_fabric == $row->id ? true : false)  : set_select("id_fabric", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_fabric', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="collar">
                            <div class="form-group <?php echo form_error('id_collar') ? 'has-error' : ''; ?>">
                                <label for="id_collar">Collar</label>
                                <select name="id_collar" id="id_collar" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($collar as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_collar", $row->id, $product->id_collar == $row->id ? true : false)  : set_select("id_collar", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_collar', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="buttons">
                            <div class="form-group <?php echo form_error('id_button') ? 'has-error' : ''; ?>">
                                <label for="id_button">Button</label>
                                <select name="id_button" id="id_button" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($button as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_button", $row->id, $product->id_button == $row->id ? true : false)  : set_select("id_button", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_button', '<p class="help-block text-red">', '</p>'); ?>
                            </div>

                            <div class="form-group <?php echo form_error('id_button_holes') ? 'has-error' : ''; ?>">
                                <label for="id_button_holes">Button Holes</label>
                                <select name="id_button_holes" id="id_button_holes" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($button_holes as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_button_holes", $row->id, $product->id_button_holes == $row->id ? true : false)  : set_select("id_button_holes", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_button_holes', '<p class="help-block text-red">', '</p>'); ?>
                            </div>

                            <div class="form-group <?php echo form_error('id_button_thread') ? 'has-error' : ''; ?>">
                                <label for="id_button_thread">Button Thread</label>
                                <select name="id_button_thread" id="id_button_thread" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($button_thread as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_button_thread", $row->id, $product->id_button_thread == $row->id ? true : false)  : set_select("id_button_thread", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_button_thread', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="cuff">
                            <div class="form-group <?php echo form_error('id_cuff') ? 'has-error' : ''; ?>">
                                <label for="id_cuff">Cuff</label>
                                <select name="id_cuff" id="id_cuff" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($cuff as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_cuff", $row->id, $product->id_cuff == $row->id ? true : false)  : set_select("id_cuff", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_cuff', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="body_type">
                            <div class="form-group <?php echo form_error('id_body_front') ? 'has-error' : ''; ?>">
                                <label for="id_body_front">Body Front</label>
                                <select name="id_body_front" id="id_body_front" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($body_front as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_body_front", $row->id, $product->id_body_front == $row->id ? true : false)  : set_select("id_body_front", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_body_front', '<p class="help-block text-red">', '</p>'); ?>
                            </div>

                            <div class="form-group <?php echo form_error('id_body_back') ? 'has-error' : ''; ?>">
                                <label for="id_body_back">Body Back</label>
                                <select name="id_body_back" id="id_body_back" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($body_back as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_body_back", $row->id, $product->id_body_back == $row->id ? true : false)  : set_select("id_body_back", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_body_back', '<p class="help-block text-red">', '</p>'); ?>
                            </div>

                            <div class="form-group <?php echo form_error('id_body_hem') ? 'has-error' : ''; ?>">
                                <label for="id_body_hem">Body Hem</label>
                                <select name="id_body_hem" id="id_body_hem" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($body_hem as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_body_hem", $row->id, $product->id_body_hem == $row->id ? true : false)  : set_select("id_body_hem", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_body_hem', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="cleric">
                            <div class="form-group <?php echo form_error('id_cleric_fabric') ? 'has-error' : ''; ?>">
                                <label for="id_cleric_fabric">Cleric Fabric</label>
                                <select name="id_cleric_fabric" id="id_cleric_fabric" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($cleric_fabric as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_cleric_fabric", $row->id, $product->id_cleric_fabric == $row->id ? true : false)  : set_select("id_cleric_fabric", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_cleric_fabric', '<p class="help-block text-red">', '</p>'); ?>
                            </div>

                            <div class="form-group <?php echo form_error('id_cleric_stitch') ? 'has-error' : ''; ?>">
                                <label for="id_cleric_stitch">Cleric Stitch</label>
                                <select name="id_cleric_stitch" id="id_cleric_stitch" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($cleric_stitch as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_cleric_stitch", $row->id, $product->id_cleric_stitch == $row->id ? true : false)  : set_select("id_cleric_stitch", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_cleric_stitch', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="pocket">
                            <div class="form-group <?php echo form_error('id_pocket') ? 'has-error' : ''; ?>">
                                <label for="id_pocket">Pocket</label>
                                <select name="id_pocket" id="id_pocket" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($pocket as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_pocket", $row->id, $product->id_pocket == $row->id ? true : false)  : set_select("id_pocket", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_pocket', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="embroidery">
                            <div class="form-group <?php echo form_error('id_embroidery_position') ? 'has-error' : ''; ?>">
                                <label for="id_embroidery_position">Embroidery Position</label>
                                <select name="id_embroidery_position" id="id_embroidery_position" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($embroidery_position as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_embroidery_position", $row->id, $product->id_embroidery_position == $row->id ? true : false)  : set_select("id_embroidery_position", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_embroidery_position', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                            <div class="form-group <?php echo form_error('id_embroidery_font') ? 'has-error' : ''; ?>">
                                <label for="id_embroidery_font">Embroidery Font</label>
                                <select name="id_embroidery_font" id="id_embroidery_font" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($embroidery_font as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_embroidery_font", $row->id, $product->id_embroidery_font == $row->id ? true : false)  : set_select("id_embroidery_font", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_embroidery_font', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                            <div class="form-group <?php echo form_error('id_embroidery_color') ? 'has-error' : ''; ?>">
                                <label for="id_embroidery_color">Embroidery Color</label>
                                <select name="id_embroidery_color" id="id_embroidery_color" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($embroidery_color as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_embroidery_color", $row->id, $product->id_embroidery_color == $row->id ? true : false)  : set_select("id_embroidery_color", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_embroidery_color', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="option">
                            <div class="form-group <?php echo form_error('id_option_amf_stitch') ? 'has-error' : ''; ?>">
                                <label for="id_option_amf_stitch">AMF Stitch</label>
                                <select name="id_option_amf_stitch" id="id_option_amf_stitch" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($option_amf_stitch as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_option_amf_stitch", $row->id, $product->id_option_amf_stitch == $row->id ? true : false)  : set_select("id_option_amf_stitch", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_option_amf_stitch', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                            <div class="form-group <?php echo form_error('id_option_interlining') ? 'has-error' : ''; ?>">
                                <label for="id_option_interlining">Interlining</label>
                                <select name="id_option_interlining" id="id_option_interlining" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($option_interlining as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_option_interlining", $row->id, $product->id_option_interlining == $row->id ? true : false)  : set_select("id_option_interlining", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_option_interlining', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                            <div class="form-group <?php echo form_error('id_option_sewing') ? 'has-error' : ''; ?>">
                                <label for="id_option_sewing">Sewing</label>
                                <select name="id_option_sewing" id="id_option_sewing" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($option_sewing as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_option_sewing", $row->id, $product->id_option_sewing == $row->id ? true : false)  : set_select("id_option_sewing", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_option_sewing', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                            <div class="form-group <?php echo form_error('id_option_tape') ? 'has-error' : ''; ?>">
                                <label for="id_option_tape">Tape</label>
                                <select name="id_option_tape" id="id_option_tape" class="form-control">
                                    <option value="">Choose</option>
                                    <?php foreach($option_tape as $row): ?>
                                        <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_option_tape", $row->id, $product->id_option_tape == $row->id ? true : false)  : set_select("id_option_tape", $row->id); ?>><?php echo $row->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_option_tape', '<p class="help-block text-red">', '</p>'); ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="other">
                            <label>Shoulder Width (cm)</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group <?php echo form_error('id_shoulder_width_dimensions') ? 'has-error' : ''; ?>">
                                        <label for="id_shoulder_width_dimensions">Dimensions</label>
                                        <select name="id_shoulder_width_dimensions" id="id_shoulder_width_dimensions" class="form-control">
                                            <option value="">Choose</option>
                                            <?php foreach($shoulder_dimensions as $row): ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_shoulder_width_dimensions", $row->id, $product->id_shoulder_width_dimensions == $row->id ? true : false)  : set_select("id_shoulder_width_dimensions", $row->id); ?>><?php echo $row->title; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('id_shoulder_width_dimensions', '<p class="help-block text-red">', '</p>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group <?php echo form_error('id_shoulder_width_correction') ? 'has-error' : ''; ?>">
                                        <label for="id_shoulder_width_correction">Correction</label>
                                        <select name="id_shoulder_width_correction" id="id_shoulder_width_correction" class="form-control">
                                            <option value="">Choose</option>
                                            <?php foreach($shoulder_correction as $row): ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_shoulder_width_correction", $row->id, $product->id_shoulder_width_correction == $row->id ? true : false)  : set_select("id_shoulder_width_correction", $row->id); ?>><?php echo $row->title; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('id_shoulder_width_correction', '<p class="help-block text-red">', '</p>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group <?php echo form_error('id_shoulder_width_product_ud') ? 'has-error' : ''; ?>">
                                        <label for="id_shoulder_width_product_ud">Product up dimension</label>
                                        <select name="id_shoulder_width_product_ud" id="id_shoulder_width_product_ud" class="form-control">
                                            <option value="">Choose</option>
                                            <?php foreach($shoulder_product_ud as $row): ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_shoulder_width_product_ud", $row->id, $product->id_shoulder_width_product_ud == $row->id ? true : false)  : set_select("id_shoulder_width_product_ud", $row->id); ?>><?php echo $row->title; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('id_shoulder_width_product_ud', '<p class="help-block text-red">', '</p>'); ?>
                                    </div>
                                </div>
                            </div>

                            <label>Chest Circumference</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group <?php echo form_error('id_chest_c_dimensions') ? 'has-error' : ''; ?>">
                                        <label for="id_chest_c_dimensions">Dimensions</label>
                                        <select name="id_chest_c_dimensions" id="id_chest_c_dimensions" class="form-control">
                                            <option value="">Choose</option>
                                            <?php foreach($chest_dimensions as $row): ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_chest_c_dimensions", $row->id, $product->id_chest_c_dimensions == $row->id ? true : false)  : set_select("id_chest_c_dimensions", $row->id); ?>><?php echo $row->title; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('id_chest_c_dimensions', '<p class="help-block text-red">', '</p>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group <?php echo form_error('id_chest_c_correction') ? 'has-error' : ''; ?>">
                                        <label for="id_chest_c_correction">Correction</label>
                                        <select name="id_chest_c_correction" id="id_chest_c_correction" class="form-control">
                                            <option value="">Choose</option>
                                            <?php foreach($chest_correction as $row): ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_chest_c_correction", $row->id, $product->id_chest_c_correction == $row->id ? true : false)  : set_select("id_chest_c_correction", $row->id); ?>><?php echo $row->title; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('id_chest_c_correction', '<p class="help-block text-red">', '</p>'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group <?php echo form_error('id_chest_c_product_ud') ? 'has-error' : ''; ?>">
                                        <label for="id_chest_c_product_ud">Product up dimension</label>
                                        <select name="id_chest_c_product_ud" id="id_chest_c_product_ud" class="form-control">
                                            <option value="">Choose</option>
                                            <?php foreach($chest_product_ud as $row): ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select("id_chest_c_product_ud", $row->id, $product->id_chest_c_product_ud == $row->id ? true : false)  : set_select("id_chest_c_product_ud", $row->id); ?>><?php echo $row->title; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('id_chest_c_product_ud', '<p class="help-block text-red">', '</p>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>

                <div class="form-group">
                    <label for="color">Color</label>
                    <select name="color[]" id="color" class="form-control select2" multiple="multiple" data-placeholder="Select Color">
                        <?php foreach ($master_color as $row): ?>
                            <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select('color[]', $row->id, in_array($row->id, $product_color) ? true : false) : set_select('color[]', $row->id); ?>><?php echo $row->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="size">Size</label>
                    <select name="size[]" id="size" class="form-control select2" multiple="multiple" data-placeholder="Select size">
                        <?php foreach ($master_size as $row): ?>
                            <option value="<?php echo $row->id; ?>" <?php echo isset($product) ? set_select('size[]', $row->id, in_array($row->id, $product_size) ? true : false) : set_select('size[]', $row->id); ?>><?php echo $row->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <table class="table" id="table-box">
                        <tr>
                            <td colspan="2">
                                <a href="#" id="table-add" class="btn btn-success btn-xs"><i class="fa fa-plus"></i>
                                    Add
                                </a>
                                <span class="help-block">Minimum image size: 500px &times; 647px with jpg, gif or png extention.</span>
                            </td>
                        </tr>
                        <?php if (isset($product_image)): ?>
                            <?php $i = 1; ?>
                            <?php foreach ($product_image as $row): ?>
                                <tr id="table-row">
                                    <td width="280">
                                        <img class="img-responsive"
                                        src="<?php echo base_url($product_image_path . $row->image); ?>"
                                        alt="<?php echo $product->title; ?>"
                                        width="200">
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <a href="<?php echo site_url('admin/product_image/delete/' . $row->id); ?>"
                                            class="btn btn-danger btn-xs table-remove">
                                            <i class="fa fa-remove"></i> Remove
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr id="table-row">
                                <td>
                                    <input type="file" name="image1" id="image" class="form-control"
                                    placeholder="Enter image">
                                </td>
                                <td style="vertical-align: middle;">
                                    <a href="#" class="btn btn-danger btn-xs table-remove"><i
                                        class="fa fa-remove"></i>
                                        Remove
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>

                <div class="form-group <?php echo form_error('promo_id') ? 'has-error' : ''; ?>">
                    <label for="promo_id">Add to Promo</label>
                    <select name="promo_id" id="promo_id" class="form-control">
                        <option value="">Choose</option>
                        <?php foreach($promo as $row): ?>
                            <option value="<?php echo $row->id; ?>" <?php echo (isset($promo) && isset($product)) ? set_select("promo_id", $row->id, $product->promo_id == $row->id ? true : false)  : set_select("promo_id", $row->id); ?>><?php echo $row->promo_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('promo_id', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
$(function () {
    var click = 1;
    var totalTr = $("tr[id=table-row]").length;
    if (totalTr === 4) {
        $("#table-add").hide();
    }
    listenAddAnswer();
    listenRemoveAnswer();
    function listenAddAnswer() {
        $("#table-add").unbind('click').on('click', function (e) {
            e.preventDefault();
            var table = $("#table-box");
            var totalTr = $("tr[id=table-row]").length;
            if (totalTr < 4) {
                click++;
                $("#table-box").append(
                    '<tr id="table-row">' +
                    '<td>' +
                    '<input type="file" name="image' + click + '" id="image" class="form-control" placeholder="Enter image">' +
                    '</td>' +
                    '<td style="vertical-align: middle;">' +
                    '<a href="#" class="btn btn-danger btn-xs table-remove"><i class="fa fa-remove"></i> Remove</a> ' +
                    '</td>' +
                    '</tr>'
                );
            }
            if (totalTr === 3) {
                $("#table-add").hide();
            }
            listenRemoveAnswer();
        });
    }

    function listenRemoveAnswer() {
        $(".table-remove").unbind('click').on('click', function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            console.log(href);
            if (href !== '#') {
                $.get(href, function () {
                });
            }
            var td = $(this).parent("td");
            var tr = td.parent("tr");
            tr.remove();
            $("#table-add").show();
        });
    }
});
</script>
