<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-17T16:31:52+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'product';
        $this->primary_key = 'id';
    }

    public function count_product_search($search) {
        $this->db->join('product_category', 'product_category.id = product.id_product_category', 'left');
        $this->db->like('product_category.title', $search);
        return $this->db->count_all_results($this->table);
    }

}
