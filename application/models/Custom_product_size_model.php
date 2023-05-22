<?php
# @Author: Awan Tengah
# @Date:   2017-04-26T19:38:11+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-26T19:38:36+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_product_size_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'custom_product_size';
        $this->primary_key = 'id';
    }

}
