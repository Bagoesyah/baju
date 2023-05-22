<?php
# @Author: Awan Tengah
# @Date:   2017-02-27T13:40:47+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-27T13:41:15+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'notification';
        $this->primary_key = 'id';
    }

}
