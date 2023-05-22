<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-28T14:52:23+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_chest_circumference extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('material_chest_circumference_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Material chest circumference';
    }

    public function get_data()
    {
        $data = $this->material_chest_circumference_model->all(

            array(
                'fields' => "material_chest_circumference.*, if(category = 1, 'Dimensions', if(category = 2, 'Correction', if(category = 3, 'Product up dimension', '-'))) as category_text",
                'order_by' => 'material_chest_circumference.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('material_chest_circumference/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('material_chest_circumference/edit', $data);
        } else {
            $data = array(
                'category' => $this->input->post('category', true),
                'title' => $this->input->post('title', true),
                'price' => $this->input->post('price', true),
                'created_at' => $this->now,
            );
            $action = $this->material_chest_circumference_model->save($data);

            if ($action) {
                $activity = "Create Material chest circumference ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-chest-circumference');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['material_chest_circumference'] = $this->material_chest_circumference_model->first(
                array('id' => $id)
            );

            $this->render('material_chest_circumference/edit', $data);
        } else {
            $data = array(
                'category' => $this->input->post('category', true),
                'title' => $this->input->post('title', true),
                'price' => $this->input->post('price', true),
                'updated_at' => $this->now,
            );
            $action = $this->material_chest_circumference_model->edit($id, $data);

            if ($action) {
                $activity = "Update Material chest circumference ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-chest-circumference');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->material_chest_circumference_model->edit($id, $data);

        if ($action) {
            $title = $this->material_chest_circumference_model->first($id);
            $activity = "Delete Material chest circumference ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/material-chest-circumference');
    }

}
