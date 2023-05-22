<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-18T18:44:32+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_embroidery_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'material_embroidery';
        $this->primary_key = 'id';
    }

}
