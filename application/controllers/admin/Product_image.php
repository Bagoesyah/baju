<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T17:23:26+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T17:26:02+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_image extends Admin_Controller
{

    public $product_image_path;

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('product_image_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Product';
        $this->product_image_path = $this->config->item('product_image_path');
    }

    public function delete($id) {
        $product_image = $this->product_image_model->first($id);
        unlink_file($this->product_image_path . $product_image->image);
        $this->product_image_model->delete($id);
    }
}
