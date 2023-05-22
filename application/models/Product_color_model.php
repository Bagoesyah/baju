<?php
# @Author: Awan Tengah
# @Date:   2017-03-03T15:43:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-03T15:43:56+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_color_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'product_color';
        $this->primary_key = 'id';
    }

}
