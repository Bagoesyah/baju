<?php
# @Author: Awan Tengah
# @Date:   2017-02-20T19:13:16+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-20T19:14:54+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class App_token_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'app_token';
        $this->primary_key = 'id';
    }

}
