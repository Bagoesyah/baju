<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-24T15:59:04+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_cleric_sub_category extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('material_cleric_sub_category_model');
        $this->load->model('material_cleric_category_model');
        $this->layout = 'template/admin';
        $this->page_title = 'Cleric sub category';
    }

    public function get_data()
    {
        $data = $this->material_cleric_sub_category_model->all(

            array(
                'fields' => 'material_cleric_sub_category.*, material_cleric_category.title as category',
                'join' => array(
                    'material_cleric_category' => 'material_cleric_category.id = material_cleric_sub_category.id_category',
                ),
                'order_by' => 'material_cleric_sub_category.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('material_cleric_sub_category/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_category', 'id_category', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $data['material_cleric_category'] = $this->material_cleric_category_model->all();
            $this->render('material_cleric_sub_category/edit', $data);
        } else {
            $data = array(
                'id_category' => $this->input->post('id_category', true),
                'title' => $this->input->post('title', true),
                'created_at' => $this->now,
            );
            $action = $this->material_cleric_sub_category_model->save($data);

            if ($action) {
                $activity = "Create Material cleric sub category ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-cleric-sub-category');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_category', 'id_category', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['material_cleric_sub_category'] = $this->material_cleric_sub_category_model->first(
                array('id' => $id)
            );
            $data['material_cleric_category'] = $this->material_cleric_category_model->all();
            $this->render('material_cleric_sub_category/edit', $data);
        } else {
            $data = array(
                'id_category' => $this->input->post('id_category', true),
                'title' => $this->input->post('title', true),
                'updated_at' => $this->now,
            );
            $action = $this->material_cleric_sub_category_model->edit($id, $data);

            if ($action) {
                $activity = "Update Material cleric sub category ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-cleric-sub-category');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->material_cleric_sub_category_model->edit($id, $data);

        if ($action) {
            $title = $this->material_cleric_sub_category_model->first($id);
            $activity = "Delete Material cleric sub category ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/material-cleric-sub-category');
    }

}
