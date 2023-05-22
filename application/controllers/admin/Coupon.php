<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('coupon_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Coupon';
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('coupon/list', $data);
    }

    public function get_data()
    {
        $data = $this->coupon_model->all(

            array(
                'order_by' => 'id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'Coupon code', 'required');
        $this->form_validation->set_rules('discount', 'Discount value', 'required');
        $this->form_validation->set_rules('num_type', 'Value type', 'required');
        $this->form_validation->set_rules('exp_date', 'Coupon expire date', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section']         = 'Add';
            $this->render('coupon/edit', $data);
        } else {

            $xdate = explode('/', $this->input->post('exp_date'));
            $xdate = $xdate[2].'-'.$xdate[1].'-'.$xdate[0];
            
            $data = array(
                'code' => $this->input->post('code', true),
                'discount' => $this->input->post('discount', true),
                'num_type' => $this->input->post('num_type', true),
                'expired_at' => $xdate,
                'status' => $this->input->post('status', true),
                'created_at' => $this->now,
            );
            $action = $this->coupon_model->save($data);

            if ($action) {
                $activity = "Create New Coupon ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/coupon');

        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'Coupon code', 'required');
        $this->form_validation->set_rules('discount', 'Discount value', 'required');
        $this->form_validation->set_rules('num_type', 'Value type', 'required');
        $this->form_validation->set_rules('exp_date', 'Coupon expire date', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        $data['coupon'] = $this->coupon_model->first(
            array('id' => $id)
        );
        if(!$data['coupon']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('coupon/edit', $data);
        } else {

            $xdate = explode('/', $this->input->post('exp_date'));
            $xdate = $xdate[2].'-'.$xdate[1].'-'.$xdate[0];
            
            $data = array(
                'code' => $this->input->post('code', true),
                'discount' => $this->input->post('discount', true),
                'num_type' => $this->input->post('num_type', true),
                'expired_at' => $xdate,
                'status' => $this->input->post('status', true)
            );
            $action = $this->coupon_model->edit($id, $data);

            if ($action) {
                $activity = "Update Coupon ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/coupon');
        }
    }

    public function delete($id)
    {
        $action = $this->coupon_model->delete($id, $data);

        if ($action) {
            $activity = "Delete Coupon ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/coupon');
    }
}