<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:33:51+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T16:54:37+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('product_category_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Product category';
    }

    public function get_data()
    {
        $data = $this->product_category_model->all(

            array(
                'fields' => 'product_category.*',
                'order_by' => 'product_category.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('product_category/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('product_category/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'created_at' => $this->now,
            );
            $action = $this->product_category_model->save($data);

            generate_slug('title', 'product_category_model');

            if ($action) {
                $activity = "Create Product category ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/product-category');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['product_category'] = $this->product_category_model->first(
                array('id' => $id)
            );

            $this->render('product_category/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'updated_at' => $this->now,
            );
            $action = $this->product_category_model->edit($id, $data);

            generate_slug('title', 'product_category_model', $id);

            if ($action) {
                $activity = "Update Product category ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/product-category');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->product_category_model->edit($id, $data);

        if ($action) {
            $title = $this->product_category_model->first($id);
            $activity = "Delete Product category ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/product-category');
    }

}
