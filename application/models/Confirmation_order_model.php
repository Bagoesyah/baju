<?php
# @Author: Awan Tengah
# @Date:   2017-04-07T19:05:30+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-07T21:19:29+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Confirmation_order_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'confirmation_order';
        $this->primary_key = 'id';
    }

}
