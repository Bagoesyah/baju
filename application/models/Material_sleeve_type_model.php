<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T16:37:34+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_sleeve_type_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'material_sleeve_type';
        $this->primary_key = 'id';
    }

}
