<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T17:30:11+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T17:30:30+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_image_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'product_image';
        $this->primary_key = 'id';
    }

}
