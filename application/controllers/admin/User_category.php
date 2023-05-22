<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-22T21:19:43+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class User_category extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('user_category_model');

        $this->layout = 'template/admin';
        $this->page_title = 'User category';
    }

    public function get_data()
    {
        $data = $this->user_category_model->all(

            array(
                'fields' => 'user_category.*',
                'order_by' => 'user_category.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('user_category/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('user_category/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'description' => $this->input->post('description', true),
                'created_at' => $this->now,
            );
            $action = $this->user_category_model->save($data);

            if ($action) {
                $activity = "Create User category ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/user-category');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['user_category'] = $this->user_category_model->first(
                array('id' => $id)
            );

            $this->render('user_category/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'description' => $this->input->post('description', true),
                'updated_at' => $this->now,
            );
            $action = $this->user_category_model->edit($id, $data);

            if ($action) {
                $activity = "Update User category ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/user-category');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->user_category_model->edit($id, $data);

        if ($action) {
            $title = $this->user_category_model->first($id);
            $activity = "Delete User category ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/user-category');
    }

}
