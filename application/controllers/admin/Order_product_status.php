<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-31T15:02:55+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_product_status extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('order_product_status_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Order status';
    }

    public function get_data()
    {
        $data = $this->order_product_status_model->all(

              array(
                  'fields' => 'order_product_status.*',
                'order_by' => 'order_product_status.id DESC'
              )

        );
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('order_product_status/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('order_product_status/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
'created_at' => $this->now,
            );
            $action = $this->order_product_status_model->save($data);

            if ($action) {
                $activity = "Create Order product status ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/order-product-status');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['order_product_status'] = $this->order_product_status_model->first(
                array('id' => $id)
            );

            $this->render('order_product_status/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
'updated_at' => $this->now,
            );
            $action = $this->order_product_status_model->edit($id, $data);

            if ($action) {
                $activity = "Update Order product status ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/order-product-status');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->order_product_status_model->edit($id, $data);

        if ($action) {
            $title = $this->order_product_status_model->first($id);
            $activity = "Delete Order product status ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/order-product-status');
    }

}
