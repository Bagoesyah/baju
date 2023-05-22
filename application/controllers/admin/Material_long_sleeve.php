<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-22T21:21:54+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_long_sleeve extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('material_long_sleeve_model');
        
        $this->layout = 'template/admin';
        $this->page_title = 'Material long sleeve';
    }

    public function get_data()
    {
        $data = $this->material_long_sleeve_model->all(
            
              array(
                  'fields' => 'material_long_sleeve.*
              ',
                'order_by' => 'material_long_sleeve.id DESC'
              )
            
        );
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('material_long_sleeve/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
$this->form_validation->set_rules('price', 'price', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            
            $this->render('material_long_sleeve/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
'price' => $this->input->post('price', true),
'created_at' => $this->now,
            );
            $action = $this->material_long_sleeve_model->save($data);

            if ($action) {
                $activity = "Create Material long sleeve ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-long-sleeve');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
$this->form_validation->set_rules('price', 'price', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['material_long_sleeve'] = $this->material_long_sleeve_model->first(
                array('id' => $id)
            );
            
            $this->render('material_long_sleeve/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
'price' => $this->input->post('price', true),
'updated_at' => $this->now,
            );
            $action = $this->material_long_sleeve_model->edit($id, $data);

            if ($action) {
                $activity = "Update Material long sleeve ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-long-sleeve');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->material_long_sleeve_model->edit($id, $data);

        if ($action) {
            $title = $this->material_long_sleeve_model->first($id);
            $activity = "Delete Material long sleeve ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/material-long-sleeve');
    }

}
