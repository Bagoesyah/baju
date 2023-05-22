<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'coupons';
        $this->primary_key = 'id';
    }

}
