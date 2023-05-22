<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-20T11:43:12+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_product_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'order_product';
        $this->primary_key = 'id';
    }

    public function edit_by_order_number($order_number, $data) {
        $this->db->where('order_number', $order_number);
        $this->db->update($this->table, $data);
    }

    public function edit_by_id_custom_product($id_custom_product, $data) {
        $this->db->where('id_custom_product', $id_custom_product);
        $this->db->update($this->table, $data);
    }

    public function get_data_by_id_custom_product($id_custom_product) {
        $this->db->select("order_product.*, user.user_token, custom_product.image, custom_product.price as custom_price, custom_product.quantity, order_product_status.title as status_text, if(order_product.order_type = '1', 'product', if(order_product.order_type = 2, 'custom', '-')) as order_type_text, material_fabric.price as price_fabric");
        $this->db->join('custom_product', 'custom_product.id = order_product.id_custom_product', 'left');
        $this->db->join('order_product_status', 'order_product_status.id = order_product.status', 'left');
        $this->db->join('material_fabric', 'material_fabric.id = custom_product.id_fabric', 'left');
        $this->db->join('user', 'user.id = order_product.id_user', 'left');
        $this->db->where('order_product.id_custom_product', $id_custom_product);
        return $this->db->get($this->table)->row();
    }

}
