<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-20T20:36:41+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Size extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('size_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Size';
    }

    public function get_data()
    {
        $data = $this->size_model->all(

            array(
                'fields' => 'size.*',
                'order_by' => 'size.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('size/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('neck', 'neck', 'required');
        $this->form_validation->set_rules('shoulder', 'shoulder', 'required');
        $this->form_validation->set_rules('chest', 'chest', 'required');
        $this->form_validation->set_rules('waist', 'waist', 'required');
        $this->form_validation->set_rules('hip', 'hip', 'required');
        $this->form_validation->set_rules('arm_hole', 'arm_hole', 'required');
        $this->form_validation->set_rules('back_length_88', 'back_length_88', 'required');
        $this->form_validation->set_rules('back_length_89', 'back_length_89', 'required');
        $this->form_validation->set_rules('aloha_88', 'aloha_88', 'required');
        $this->form_validation->set_rules('aloha_89', 'aloha_89', 'required');
        $this->form_validation->set_rules('cuffs_circle', 'cuffs_circle', 'required');
        $this->form_validation->set_rules('short_sleeve', 'short_sleeve', 'required');
        $this->form_validation->set_rules('sleeve_circle', 'sleeve_circle', 'required');
        $this->form_validation->set_rules('fabric_needed', 'fabric_needed', 'required');
        $this->form_validation->set_rules('body_type', 'Body type', 'required');
        $this->form_validation->set_rules('sleeve_type', 'Sleeve Type', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('size/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'neck' => $this->input->post('neck', true),
                'shoulder' => $this->input->post('shoulder', true),
                'chest' => $this->input->post('chest', true),
                'waist' => $this->input->post('waist', true),
                'hip' => $this->input->post('hip', true),
                'arm_hole' => $this->input->post('arm_hole', true),
                'back_length_88' => $this->input->post('back_length_88', true),
                'back_length_89' => $this->input->post('back_length_89', true),
                'aloha_88' => $this->input->post('aloha_88', true),
                'aloha_89' => $this->input->post('aloha_89', true),
                'cuffs_circle' => $this->input->post('cuffs_circle', true),
                'short_sleeve' => $this->input->post('short_sleeve', true),
                'sleeve_circle' => $this->input->post('sleeve_circle', true),
                'fabric_needed' => $this->input->post('fabric_needed', true),
                'body_type' => $this->input->post('body_type', true),
                'sleeve_type' => $this->input->post('sleeve_type', true),
                'created_at' => $this->now,
            );
            $action = $this->size_model->save($data);

            generate_slug('title', 'size_model');

            if ($action) {
                $activity = "Create Size ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/size');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('neck', 'neck', 'required');
        $this->form_validation->set_rules('shoulder', 'shoulder', 'required');
        $this->form_validation->set_rules('chest', 'chest', 'required');
        $this->form_validation->set_rules('waist', 'waist', 'required');
        $this->form_validation->set_rules('hip', 'hip', 'required');
        $this->form_validation->set_rules('arm_hole', 'arm_hole', 'required');
        $this->form_validation->set_rules('back_length_88', 'back_length_88', 'required');
        $this->form_validation->set_rules('back_length_89', 'back_length_89', 'required');
        $this->form_validation->set_rules('aloha_88', 'aloha_88', 'required');
        $this->form_validation->set_rules('aloha_89', 'aloha_89', 'required');
        $this->form_validation->set_rules('cuffs_circle', 'cuffs_circle', 'required');
        $this->form_validation->set_rules('short_sleeve', 'short_sleeve', 'required');
        $this->form_validation->set_rules('sleeve_circle', 'sleeve_circle', 'required');
        $this->form_validation->set_rules('fabric_needed', 'fabric_needed', 'required');
        $this->form_validation->set_rules('body_type', 'Body type', 'required');
        $this->form_validation->set_rules('sleeve_type', 'Sleeve Type', 'required');

        $data['size'] = $this->size_model->first(
            array('id' => $id)
        );

        if(!$data['size']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('size/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'neck' => $this->input->post('neck', true),
                'shoulder' => $this->input->post('shoulder', true),
                'chest' => $this->input->post('chest', true),
                'waist' => $this->input->post('waist', true),
                'hip' => $this->input->post('hip', true),
                'arm_hole' => $this->input->post('arm_hole', true),
                'back_length_88' => $this->input->post('back_length_88', true),
                'back_length_89' => $this->input->post('back_length_89', true),
                'aloha_88' => $this->input->post('aloha_88', true),
                'aloha_89' => $this->input->post('aloha_89', true),
                'cuffs_circle' => $this->input->post('cuffs_circle', true),
                'short_sleeve' => $this->input->post('short_sleeve', true),
                'sleeve_circle' => $this->input->post('sleeve_circle', true),
                'body_type' => $this->input->post('body_type', true),
                'sleeve_type' => $this->input->post('sleeve_type', true),
                'fabric_needed' => $this->input->post('fabric_needed', true),
                'updated_at' => $this->now,
            );
            $action = $this->size_model->edit($id, $data);

            generate_slug('title', 'size_model', $id);

            if ($action) {
                $activity = "Update Size ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/size');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->size_model->edit($id, $data);

        if ($action) {
            $title = $this->size_model->first($id);
            $activity = "Delete Size ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/size');
    }

}
