<?php
# @Author: Awan Tengah
# @Date:   2017-03-26T20:23:41+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-26T20:23:59+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_product_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'custom_product';
        $this->primary_key = 'id';
    }

}
