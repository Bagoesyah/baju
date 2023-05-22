<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function check()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('CODE', 'CODE', 'required');
            $this->form_validation->set_rules('ORDER_NUMBER', 'ORDER NUMBER', 'required');
            if($this->form_validation->run() == true) {
                $this->load->model('coupon_model');
                $code = $this->input->post('CODE', true);
                $order_number = $this->input->post('ORDER_NUMBER', true);

                $q_check = $this->db->query("
                    SELECT opc.* FROM order_product_coupon opc WHERE opc.order_number = '$order_number' LIMIT 1
                ");

                if ($q_check->num_rows() == 0) {
                    $get = $this->coupon_model->first(
                        array('code' => $code)
                    );
                    if ($get) {

                        // INSERT COUPON
                        $data = array(
                            'order_number' => $order_number,
                            'coupon_code' => $get->code,
                            'coupon_discount' => $get->discount,
                            'coupon_type' => $get->num_type
                        );
                        $save = $this->db->insert('order_product_coupon', $data);

                        if ($save) {
                            $datapi['STATUS'] = 'SUCCESS';
                            $datapi['MESSAGE'] = 'COUPON CHECK';
                            $datapi['DATA'] = (object) $get;
                        } else {
                            $datapi['STATUS'] = 'FAILED';
                            $datapi['MESSAGE'] = 'ERROR WHEN PROCESSING YOUR REQUEST';
                            $datapi['DATA'] = (object) array();
                        }
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'INVALID COUPON CODE';
                        $datapi['DATA'] = (object)array();
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'YOU CAN ONLY HAVE ONE COUPON PER ORDER';
                    $datapi['DATA'] = (object) array();
                }
                
            } else {
                if(validation_errors()) {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = validation_errors();
                    $datapi['DATA'] = (object)array();
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'PLEASE INPUT COUPON CODE';
                    $datapi['DATA'] = (object)array();
                }
            }
        } else {
            $datapi = $check;
        }

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_coupon_order()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ORDER_NUMBER', 'ORDER NUMBER', 'required');
            if($this->form_validation->run() == true) {
                $order_number = $this->input->post('ORDER_NUMBER');
                $q = $this->db->query("
                    SELECT opc.* FROM order_product_coupon opc 
                    LEFT JOIN coupons c ON c.code = opc.coupon_code 
                    WHERE opc.order_number = '$order_number' LIMIT 1
                ");
                if ($q->num_rows() > 0) {
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'GET COUPON ORDER';
                    $datapi['DATA'] = (object) $q->result_array();
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NO COUPON FOR THIS ORDER NUMBER';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                if(validation_errors()) {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = validation_errors();
                    $datapi['DATA'] = (object)array();
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'PLEASE INPUT ORDER_NUMBER';
                    $datapi['DATA'] = (object)array();
                }
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }
}
