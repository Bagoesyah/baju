<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:48+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-12T11:40:21+07:00
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo isset($page_title) ? $page_title : ''; ?>
            <?php if (isset($sub_page_title)): ?>
                <small><?php echo $sub_page_title; ?></small>
            <?php endif; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo isset($page_title) ? $page_title : ''; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $count_user; ?></h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people-outline"></i>
                    </div>
                    <a href="<?php echo site_url('admin/user'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3><?php echo $count_product_man; ?></h3>

                        <p>Product Men</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-tshirt-outline"></i>
                    </div>
                    <a href="<?php echo site_url('admin/product'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3><?php echo $count_product_ladies; ?></h3>

                        <p>Product Ladies</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-tshirt-outline"></i>
                    </div>
                    <a href="<?php echo site_url('admin/product'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $count_order_product; ?></h3>

                        <p>Total Order Product</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?php echo site_url('admin/booking-history'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $count_order_custom; ?></h3>

                        <p>Total Order Custom Product</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?php echo site_url('admin/booking-history'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
