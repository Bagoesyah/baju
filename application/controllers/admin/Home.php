<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:47+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-24T15:02:36+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->layout = 'template/admin';
        $this->page_title = 'Dashboard';
    }

    public function index() {
        $this->load->model('user_model');
        $this->load->model('product_model');
        $this->load->model('order_product_model');
        $data['count_user'] = $this->user_model->count();
        $data['count_product_man'] = $this->product_model->count_product_search('men');
        $data['count_product_ladies'] = $this->product_model->count_product_search('ladies');
        $data['count_order_product'] = $this->order_product_model->count(array('order_type' => '1'));
        $data['count_order_custom'] = $this->order_product_model->count(array('order_type' => '2'));
        $this->render('index', $data);
    }

}
