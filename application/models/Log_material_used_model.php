<?php
# @Author: Awan Tengah
# @Date:   2017-05-02T13:21:41+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T13:23:51+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Log_material_used_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'log_material_used';
        $this->primary_key = 'id';
    }

}
