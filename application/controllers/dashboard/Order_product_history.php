<?php
# @Author: Awan Tengah
# @Date:   2017-03-31T13:58:29+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-19T20:56:19+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_product_history extends Member_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->layout = 'template/dashboard';
        $this->page_title = 'Dashboard';
    }

    public function index() {
        $data_get_order_product = array(
            'ID_USER' => $this->_user_login->id,
            'HISTORY' => 1
        );
        $headers = array(
            'USER_TOKEN' => $this->_user_login->user_token
        );
        $data['order_product_history'] = get_data_curl(base_url('api/order/get_order_product'), $data_get_order_product, $headers);
        $this->visited_title = 'My Order Product History';
        $this->sub_visited_title = 'History Order!';
        $this->sidebar_menu = 'order_product_history';
        $this->render('order_product_history/index', $data);
    }

}
