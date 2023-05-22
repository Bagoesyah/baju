<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-22T21:21:54+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_list extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('payment_list_model');
        
        $this->layout = 'template/admin';
        $this->page_title = 'Payment list';
    }

    public function get_data()
    {
        $data = $this->payment_list_model->all(
            
              array(
                  'fields' => 'payment_list.*
              ',
                'order_by' => 'payment_list.id DESC'
              )
            
        );
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('payment_list/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
$this->form_validation->set_rules('account_name', 'account_name', 'required');
$this->form_validation->set_rules('no_rek', 'no_rek', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            
            $this->render('payment_list/edit', $data);
        } else {
            $data = array(
                'bank_name' => $this->input->post('bank_name', true),
'account_name' => $this->input->post('account_name', true),
'no_rek' => $this->input->post('no_rek', true),
'created_at' => $this->now,
            );
            $action = $this->payment_list_model->save($data);

            if ($action) {
                $activity = "Create Payment list ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/payment-list');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('bank_name', 'bank_name', 'required');
$this->form_validation->set_rules('account_name', 'account_name', 'required');
$this->form_validation->set_rules('no_rek', 'no_rek', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['payment_list'] = $this->payment_list_model->first(
                array('id' => $id)
            );
            
            $this->render('payment_list/edit', $data);
        } else {
            $data = array(
                'bank_name' => $this->input->post('bank_name', true),
'account_name' => $this->input->post('account_name', true),
'no_rek' => $this->input->post('no_rek', true),
'updated_at' => $this->now,
            );
            $action = $this->payment_list_model->edit($id, $data);

            if ($action) {
                $activity = "Update Payment list ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/payment-list');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->payment_list_model->edit($id, $data);

        if ($action) {
            $title = $this->payment_list_model->first($id);
            $activity = "Delete Payment list ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/payment-list');
    }

}
