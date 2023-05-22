<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T13:37:31+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-03T14:31:02+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriber_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'subscribers';
        $this->primary_key = 'id';
    }

    public function validate($data)
    {
        $this->db->where($data);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

}
