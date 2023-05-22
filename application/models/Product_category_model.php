<?php
# @Author: Awan Tengah
# @Date:   2017-02-09T21:28:35+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-12T11:18:36+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'product_category';
        $this->primary_key = 'id';
    }

}
