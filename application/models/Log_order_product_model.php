<?php
# @Author: Awan Tengah
# @Date:   2017-05-01T09:39:31+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-01T09:40:19+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Log_order_product_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'log_order_product';
        $this->primary_key = 'id';
    }

}
