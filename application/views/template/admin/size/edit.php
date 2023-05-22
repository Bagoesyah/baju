<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-20T20:44:08+07:00
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
            <li><a href="<?php echo site_url('admin/size'); ?>"><?php echo ucwords('size'); ?></a></li>
            <li class="active"><?php echo $on_section . ' ' . $page_title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <?php echo form_open(); ?>
            <div class="box-body">
                <?php alert_message(); ?>

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($size) ? $size->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('neck') ? 'has-error' : ''; ?>">
                    <label for="neck">Neck</label>
                    <input type="text" name="neck" id="neck" class="form-control" placeholder="Enter Neck" value="<?php echo isset($size) ? $size->neck : set_value('neck'); ?>">
                    <?php echo form_error('neck', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('body_type') ? 'has-error' : ''; ?>">
                    <label for="body_type">Body Type</label>
                    <select name="body_type" class="form-control">
                        <option value="">Select body type</option>
                        <option value="PM2" <?php echo isset($size) ? set_select("body_type", 'PM2', $size->body_type == 'PM2' ? true : false)  : set_select("body_type", 'PM2'); ?>>Slim (PM2)</option>
                        <option value="PM3" <?php echo isset($size) ? set_select("body_type", 'PM3', $size->body_type == 'PM3' ? true : false)  : set_select("body_type", 'PM3'); ?>>Standard 1 (PM3)</option>
                        <option value="PM4" <?php echo isset($size) ? set_select("body_type", 'PM4', $size->body_type == 'PM4' ? true : false)  : set_select("body_type", 'PM4'); ?>>Standard 2 (PM4)</option>
                        <option value="PM5" <?php echo isset($size) ? set_select("body_type", 'PM5', $size->body_type == 'PM5' ? true : false)  : set_select("body_type", 'PM5'); ?>>Big 1 (PM7)</option>
                        <option value="PM7" <?php echo isset($size) ? set_select("body_type", 'PM7', $size->body_type == 'PM7' ? true : false)  : set_select("body_type", 'PM7'); ?>>Big 2 (PM7)</option>
                    </select>
                    <?php echo form_error('body_type', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('sleeve_type') ? 'has-error' : ''; ?>">
                    <label for="sleeve_type">Sleeve Type</label>
                    <select name="sleeve_type" class="form-control">
                        <option value="">Select sleeve type</option>
                        <option value="regular" <?php echo isset($size) ? set_select("sleeve_type", 'regular', $size->sleeve_type == 'regular' ? true : false)  : set_select("sleeve_type", 'regular'); ?>>Regular Sleeve</option>
                        <option value="slim" <?php echo isset($size) ? set_select("sleeve_type", 'slim', $size->sleeve_type == 'slim' ? true : false)  : set_select("sleeve_type", 'slim'); ?>>Slim Sleeve</option>
                    </select>
                    <?php echo form_error('sleeve_type', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('shoulder') ? 'has-error' : ''; ?>">
                    <label for="shoulder">Shoulder</label>
                    <input type="text" name="shoulder" id="shoulder" class="form-control" placeholder="Enter Shoulder" value="<?php echo isset($size) ? $size->shoulder : set_value('shoulder'); ?>">
                    <?php echo form_error('shoulder', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('chest') ? 'has-error' : ''; ?>">
                    <label for="chest">Chest</label>
                    <input type="text" name="chest" id="chest" class="form-control" placeholder="Enter Chest" value="<?php echo isset($size) ? $size->chest : set_value('chest'); ?>">
                    <?php echo form_error('chest', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('waist') ? 'has-error' : ''; ?>">
                    <label for="waist">Waist</label>
                    <input type="text" name="waist" id="waist" class="form-control" placeholder="Enter Waist" value="<?php echo isset($size) ? $size->waist : set_value('waist'); ?>">
                    <?php echo form_error('waist', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('hip') ? 'has-error' : ''; ?>">
                    <label for="hip">Hip</label>
                    <input type="text" name="hip" id="hip" class="form-control" placeholder="Enter Hip" value="<?php echo isset($size) ? $size->hip : set_value('hip'); ?>">
                    <?php echo form_error('hip', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('arm_hole') ? 'has-error' : ''; ?>">
                    <label for="arm_hole">Arm hole</label>
                    <input type="text" name="arm_hole" id="arm_hole" class="form-control" placeholder="Enter Arm Hole" value="<?php echo isset($size) ? $size->arm_hole : set_value('arm_hole'); ?>">
                    <?php echo form_error('arm_hole', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('back_length_88') ? 'has-error' : ''; ?>">
                    <label for="back_length_88">Back length (~88cm)</label>
                    <input type="text" name="back_length_88" id="back_length_88" class="form-control" placeholder="Enter Back Length 88" value="<?php echo isset($size) ? $size->back_length_88 : set_value('back_length_88'); ?>">
                    <?php echo form_error('back_length_88', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('back_length_89') ? 'has-error' : ''; ?>">
                    <label for="back_length_89">Back length (89cm~)</label>
                    <input type="text" name="back_length_89" id="back_length_89" class="form-control" placeholder="Enter Back Length 89" value="<?php echo isset($size) ? $size->back_length_89 : set_value('back_length_89'); ?>">
                    <?php echo form_error('back_length_89', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('aloha_88') ? 'has-error' : ''; ?>">
                    <label for="aloha_88">Aloha (~88cm)</label>
                    <input type="text" name="aloha_88" id="aloha_88" class="form-control" placeholder="Enter Aloha 88" value="<?php echo isset($size) ? $size->aloha_88 : set_value('aloha_88'); ?>">
                    <?php echo form_error('aloha_88', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('aloha_89') ? 'has-error' : ''; ?>">
                    <label for="aloha_89">Aloha (89cm~)</label>
                    <input type="text" name="aloha_89" id="aloha_89" class="form-control" placeholder="Enter Aloha 89" value="<?php echo isset($size) ? $size->aloha_89 : set_value('aloha_89'); ?>">
                    <?php echo form_error('aloha_89', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('cuffs_circle') ? 'has-error' : ''; ?>">
                    <label for="cuffs_circle">Cuffs circle</label>
                    <input type="text" name="cuffs_circle" id="cuffs_circle" class="form-control" placeholder="Enter Cuffs Circle" value="<?php echo isset($size) ? $size->cuffs_circle : set_value('cuffs_circle'); ?>">
                    <?php echo form_error('cuffs_circle', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('short_sleeve') ? 'has-error' : ''; ?>">
                    <label for="short_sleeve">Short sleeve</label>
                    <input type="text" name="short_sleeve" id="short_sleeve" class="form-control" placeholder="Enter Short Sleeve" value="<?php echo isset($size) ? $size->short_sleeve : set_value('short_sleeve'); ?>">
                    <?php echo form_error('short_sleeve', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('sleeve_circle') ? 'has-error' : ''; ?>">
                    <label for="sleeve_circle">Sleeve circle</label>
                    <input type="text" name="sleeve_circle" id="sleeve_circle" class="form-control" placeholder="Enter Sleeve Circle" value="<?php echo isset($size) ? $size->sleeve_circle : set_value('sleeve_circle'); ?>">
                    <?php echo form_error('sleeve_circle', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('fabric_needed') ? 'has-error' : ''; ?>">
                    <label for="fabric_needed">Fabric needed (dalam meter)</label>
                    <input type="text" name="fabric_needed" id="fabric_needed" class="form-control" placeholder="Enter Fabric Needed" value="<?php echo isset($size) ? $size->fabric_needed : set_value('fabric_needed'); ?>">
                    <?php echo form_error('fabric_needed', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
