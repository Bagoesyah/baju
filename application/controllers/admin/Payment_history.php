<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-30T11:01:44+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_history extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('payment_history_model');
        $this->load->model('user_model');
        $this->layout = 'template/admin';
        $this->page_title = 'Payment history';
    }

    public function get_data()
    {
        $data = $this->payment_history_model->all(

            array(
                'fields' => 'payment_history.*, user.name',
                'join' => array(
                    'order_product' => 'payment_history.order_number = order_product.order_number',
                    'user' => 'user.id = order_product.id_user',
                ),
                'order_by' => 'payment_history.id DESC',
                'group_by' => 'order_product.order_number'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('payment_history/list', $data);
    }

}
