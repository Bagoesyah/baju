<?php
# @Author: Awan Tengah
# @Date:   2017-02-26T22:19:48+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-26T22:20:30+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_shipping_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'order_shipping';
        $this->primary_key = 'id';
    }

}
