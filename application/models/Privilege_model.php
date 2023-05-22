<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T13:37:31+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-03T14:31:10+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'privilege';
        $this->primary_key = 'id';
    }

}
