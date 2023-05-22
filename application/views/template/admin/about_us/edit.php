<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-21T18:02:18+07:00
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
            <li><a href="<?php echo site_url('admin/about_us'); ?>"><?php echo ucwords('about us'); ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <?php echo form_open_multipart(); ?>
            <div class="box-body">
                <?php alert_message(); ?>

                <?php if(isset($about_us)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($about_us->header_image) ? base_url(path_image('about_us_path') . $about_us->header_image) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $about_us->title; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('header_image') ? 'has-error' : ''; ?>">
                    <label for="header_image">Header Image</label>
                    <input type="file" name="header_image" id="header_image" class="form-control" placeholder="Enter Header Image" value="<?php echo isset($about_us) ? $about_us->header_image : set_value('header_image'); ?>">
                    <?php echo form_error('header_image', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo isset($about_us) ? $about_us->title : set_value('title'); ?>">
                    <?php echo form_error('title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('sub_title') ? 'has-error' : ''; ?>">
                    <label for="sub_title">Sub title</label>
                    <input type="text" name="sub_title" id="sub_title" class="form-control" placeholder="Enter Sub Title" value="<?php echo isset($about_us) ? $about_us->sub_title : set_value('sub_title'); ?>">
                    <?php echo form_error('sub_title', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('description') ? 'has-error' : ''; ?>">
                    <label for="ckeditor">Description</label>
                    <textarea name="description" id="ckeditor" class="form-control" placeholder="Enter Description">
                        <?php echo isset($about_us) ? $about_us->description : set_value('description'); ?>
                    </textarea>
                    <?php echo form_error('description', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('phone') ? 'has-error' : ''; ?>">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone" value="<?php echo isset($about_us) ? $about_us->phone : set_value('phone'); ?>">
                    <?php echo form_error('phone', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <div class="form-group <?php echo form_error('email') ? 'has-error' : ''; ?>">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" value="<?php echo isset($about_us) ? $about_us->email : set_value('email'); ?>">
                    <?php echo form_error('email', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($about_us)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($about_us->image1) ? base_url(path_image('about_us_path') . $about_us->image1) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $about_us->title; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('image1') ? 'has-error' : ''; ?>">
                    <label for="image1">Image1 (498 x 357)px</label>
                    <input type="file" name="image1" id="image1" class="form-control" placeholder="Enter Image1" value="<?php echo isset($about_us) ? $about_us->image1 : set_value('image1'); ?>">
                    <?php echo form_error('image1', '<p class="help-block text-red">', '</p>'); ?>
                </div>

                <?php if(isset($about_us)): ?>
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="<?php echo !empty($about_us->image2) ? base_url(path_image('about_us_path') . $about_us->image2) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $about_us->title; ?>">
                    </div>
                <?php endif; ?>

                <div class="form-group <?php echo form_error('image2') ? 'has-error' : ''; ?>">
                    <label for="image2">Image2 (498 x 357)px</label>
                    <input type="file" name="image2" id="image2" class="form-control" placeholder="Enter Image2" value="<?php echo isset($about_us) ? $about_us->image2 : set_value('image2'); ?>">
                    <?php echo form_error('image2', '<p class="help-block text-red">', '</p>'); ?>
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
