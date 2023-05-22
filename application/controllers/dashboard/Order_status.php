<?php
# @Author: Awan Tengah
# @Date:   2017-04-01T09:52:28+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T11:24:16+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_status extends Member_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->layout = 'template/dashboard';
        $this->page_title = 'Dashboard';
    }

    public function index() {
        $data_get_order_product = array(
            'ID_USER' => $this->_user_login->id
        );
        $headers = array(
            'USER_TOKEN' => $this->_user_login->user_token
        );
        $data['order_status'] = get_data_curl(base_url('api/order/get_order_product'), $data_get_order_product, $headers);

        $this->visited_title = 'Order Status';
        $this->sub_visited_title = 'My order status';
        $this->sidebar_menu = 'order_status';
        $this->render('order_status/index', $data);
    }

    public function confirmation_order() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('order_number', 'order number', 'required');
        $this->form_validation->set_rules('payment_date', 'payment date', 'required');
        $this->form_validation->set_rules('payment_method', 'payment method', 'required');
        $this->form_validation->set_rules('sender_account', 'sender account', 'required');
        $this->form_validation->set_rules('destination_account', 'destination account', 'required');
        $this->form_validation->set_rules('payment_amount', 'payment amount', 'required');
        if($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', array('message' => ucwords(strtolower('PLEASE INPUT THE REQUIRED FIELDS')), 'class' => 'alert-danger'));
            redirect('dashboard/order-status');
        } else {
            $order_number = $this->input->post('order_number', true);

            $data_get_order_product = array(
                'ID_USER' => $this->_user_login->id,
                'ORDER_NUMBER' => $order_number,
                'ORDER_STATUS' => '3' //Confirm order
            );
            $headers = array(
                'USER_TOKEN' => $this->_user_login->user_token
            );
            $get_order_product = get_data_curl(base_url('api/order/get_order_product'), $data_get_order_product, $headers);

            $data_get_price_total = array(
                'ID_USER' => $this->_user_login->id,
                'ORDER_NUMBER' => $order_number,
                'ORDER_STATUS' => '3', //Confirm order
                'NUMERIC_PRICE' => true
            );
            $get_price_total = get_data_curl(base_url('api/order/get_sum_price'), $data_get_price_total, $headers);

            if($get_price_total->STATUS == 'SUCCESS') {
                $price_total = $get_price_total->DATA->PRICE_TOTAL;
            } else {
                $price_total = 0;
            }

            if($get_order_product->STATUS == 'SUCCESS') {
                $data_save = array(
                    'ID_USER' => $this->_user_login->id,
                    'ORDER_NUMBER' => $order_number,
                    'PRICE_TOTAL' => $price_total,
                    'PAYMENT_DATE' => $this->input->post('payment_date', true),
                    'PAYMENT_METHOD' => $this->input->post('payment_method', true),
                    'SENDER_ACCOUNT' => $this->input->post('sender_account', true),
                    'DESTINATION_ACCOUNT' => $this->input->post('destination_account', true),
                    'PAYMENT_AMOUNT' => $this->input->post('payment_amount', true),
                    'INFORMATION' => $this->input->post('information', true)
                );
                $result = get_data_curl(base_url('api/order/insert_confirmation_order'), $data_save, $headers);

                //update order status to 'STATUS' => '4' => Check payment

                if($result->STATUS == 'SUCCESS') {
                    foreach($get_order_product->DATA as $row) {
                        $data_update_order_status = array(
                            'ID_ORDER_PRODUCT' => $row->ID,
                            'ID_USER' => $this->_user_login->id,
                            'ORDER_NUMBER' => $order_number,
                            'ORDER_TYPE' => $row->ORDER_TYPE,
                            'ID_CUSTOM_PRODUCT' => $row->ID_CUSTOM_PRODUCT,
                            'STATUS' => '4' //Check payment
                        );

                        $result = get_data_curl(base_url('api/order/update_order_product_by_id'), $data_update_order_status, $headers);
                    }

                    $this->session->set_flashdata('message', array('message' => ($result->STATUS == 'SUCCESS' ? ucwords(strtolower('CONFIRMATION ORDER HAS BEEN SUBMITED')) : ucwords(strtolower($result->MESSAGE))), 'class' => ($result->STATUS == 'SUCCESS' ? 'alert-success' : 'alert-danger') ));
                    redirect('dashboard/order-status');
                }
            } else {
                $this->session->set_flashdata('message', array('message' => 'SOMETHING WENT WRONG', 'class' => 'alert-danger'));
                redirect('dashboard/order-status');
            }
        }
    }

    public function already_received_product() {
        $order_number = $this->input->post('ORDER_NUMBER', true);

        if(!is_null($order_number)) {
            $data_get_order_product = array(
                'ID_USER' => $this->_user_login->id,
                'ORDER_NUMBER' => $order_number,
                'ORDER_STATUS' => '9' //On Shipping
            );
            $headers = array(
                'USER_TOKEN' => $this->_user_login->user_token
            );
            $get_order_product = get_data_curl(base_url('api/order/get_order_product'), $data_get_order_product, $headers);

            if($get_order_product->STATUS == 'SUCCESS') {
                //update order status to 'STATUS' => '10' => Completed

                foreach($get_order_product->DATA as $row) {
                    $data_update_order_status = array(
                        'ID_ORDER_PRODUCT' => $row->ID,
                        'ID_USER' => $this->_user_login->id,
                        'ORDER_NUMBER' => $order_number,
                        'ORDER_TYPE' => $row->ORDER_TYPE,
                        'ID_CUSTOM_PRODUCT' => $row->ID_CUSTOM_PRODUCT,
                        'STATUS' => '10' //Completed
                    );

                    $result = get_data_curl(base_url('api/order/update_order_product_by_id'), $data_update_order_status, $headers);
                }

                if($result) {
                    $data = array();
                    $template = $this->load->view('template/dashboard/order_status/_already_received', $data, true);

                    return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($template));
                } else {
                    $this->session->set_flashdata('message', array('message' => 'ACTION FAILED', 'class' => 'alert-danger'));
                    redirect('dashboard/order-status');
                }
            } else {
                return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(false));
            }
        }
    }

}
