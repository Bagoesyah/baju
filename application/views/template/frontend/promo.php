<?php
# @Author: Awan Tengah
# @Date:   2017-03-14T21:25:43+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-25T10:02:56+07:00
?>

<div class="container text-justify">
    <div class="row">
        <!--
        <div class="col-sm-3 ">
            
            <ul class="list-unstyled list-menu">
                <li><a class="shirt-for" data-val="men" style="cursor: pointer" onclick="window.location.href=<?php echo site_url('view/ready-to-wear?shirt=men'); ?>">Shirt For MEN</a></li>
                <li><a class="shirt-for" data-val="ladies" style="cursor: pointer" onclick="window.location.href=<?php echo site_url('view/ready-to-wear?shirt=ladies'); ?>">Shirt For WOMEN</a></li>
            </ul>

            <div class="form-group">
                <label for="sort-by"><h4>Search</h4></label>
                <?php $key = $this->input->get('key', true); ?>
                <input type="text" id="key" value="<?php echo $key; ?>" class="form-control" placeholder="Keyword..">
            </div>

            <div class="form-group">
                <a id="btnSearch" class="btn btn-default"/>Search</a>
            </div>

            <div class="form-group">
                <label for="sort-by"><h4>Sort By</h4></label>
                <?php $sort_by = $this->input->get('sort_by', true); ?>
                <select id="sort-by-price" class="form-control">
                    <option value="">Sort By</option>
                    <option value="cheap" <?php echo $sort_by == 'cheap' ? 'selected' : ''; ?>>Price low to high</option>
                    <option value="expensive" <?php echo $sort_by == 'expensive' ? 'selected' : ''; ?>>Price high to low</option>
                </select>
            </div>

            <div class="form-group">
                <label for="color"><h4>Color</h4></label>
                <?php $color = $this->input->get('color', true); ?>
                <select id="sort-by-color" class="form-control" name="">
                    <option value="all">All</option>
                    <?php foreach($master_color as $row): ?>
                        <option <?php echo $row->id == $color ? 'selected' : ''; ?> value="<?php echo $row->id; ?>"><?php echo $row->title; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="size"><h4>Size</h4></label>
                <?php $size = $this->input->get('size', true); ?>
                <select id="sort-by-size" class="form-control" name="">
                    <option value="all-size">All Size</option>
                    <?php foreach($master_size as $row): ?>
                        <option <?php echo $row->id == $size ? 'selected' : ''; ?> value="<?php echo $row->id; ?>"><?php echo $row->title; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        -->
        <div class="col-sm-12">
            <h4 style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px dashed #dedede;"><strong><?php echo $promo->promo_name; ?></strong></h4>
            <div class="row">
                <div class="col-md-12">
                    <img class="img-responsive" src="<?php echo !empty($promo->image) ? base_url(path_image('promo_path') . $promo->image) : base_url('assets/img/no_image.png'); ?>" alt="<?php echo $promo->promo_name; ?>">
                </div>
            </div>
            <div class="clearfix"></div><br/>
            <?php if($product): ?>
                <h4 style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px dashed #dedede;"><strong>Promo Products</strong></h4>
                <div class="row">
                <?php foreach($product->DATA as $row): ?>
                    <div class="col-sm-3 item ready-to-wear promo-product">
                        <a href="<?php echo site_url('view/product/' . $row->SLUG); ?>">
                            <div class="ready-to-wear-img">
                                <img src="<?php echo !empty($row->IMAGE) ? base_url(path_image('product_image_path') . $row->IMAGE[0]->IMAGE) : base_url('assets/img/no_image.png'); ?>" class="img-responsive img-width-100">
                            </div>
                            <div class="ready-to-wear-content">
                                <h5><strong><?php echo $row->TITLE; ?></strong></h5>
                                <span><strong><strike><?php echo format_currency($row->PRICE); ?></strike></strong> <strong><?php echo format_currency(get_price_promo($row->PRICE,$promo->value,$percent)); ?></strong></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
                </div>
                <div class="row">
                <div class="col-sm-12">
                    <?php echo $pagination; ?>
                </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
    