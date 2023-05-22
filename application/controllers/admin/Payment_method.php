<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-23T14:50:32+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_method extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('payment_method_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Payment method';
    }

    public function get_data()
    {
        $data = $this->payment_method_model->all(

            array(
                'fields' => 'payment_method.*',
                'order_by' => 'payment_method.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('payment_method/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('payment_method/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'description' => $this->input->post('description', true),
                'created_at' => $this->now,
            );
            $action = $this->payment_method_model->save($data);

            if ($action) {
                $activity = "Create Payment method ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/payment-method');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['payment_method'] = $this->payment_method_model->first(
                array('id' => $id)
            );

            $this->render('payment_method/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'description' => $this->input->post('description', true),
                'updated_at' => $this->now,
            );
            $action = $this->payment_method_model->edit($id, $data);

            if ($action) {
                $activity = "Update Payment method ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/payment-method');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->payment_method_model->edit($id, $data);

        if ($action) {
            $title = $this->payment_method_model->first($id);
            $activity = "Delete Payment method ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/payment-method');
    }

}
