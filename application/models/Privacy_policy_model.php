<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_policy_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'privacy_policy';
        $this->primary_key = 'id';
    }

}
