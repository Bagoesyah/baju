<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:47+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T14:31:14+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('level_model');

        $this->layout = 'template/admin';
        $this->page_title = 'level';
    }

    public function get_data()
    {
        $data = $this->level_model->all();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('level/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('redirect', 'redirect', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $this->render('level/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'redirect' => $this->input->post('redirect', true),
                'created_at' => $this->now,
            );
            $action = $this->level_model->save($data);

            if ($action) {
                $activity = "Create Level {$this->input->post('title', true)}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/level');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('redirect', 'redirect', 'required');

        if ($this->form_validation->run() == false) {
            $data['level'] = $this->level_model->first(
                array('id' => $id)
            );
            $data['on_section'] = 'Edit';
            $this->render('level/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'redirect' => $this->input->post('redirect', true),
                'updated_at' => $this->now,
            );
            $action = $this->level_model->edit($id, $data);

            if ($action) {
                $activity = "Update Level {$this->input->post('title', true)}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/level');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->level_model->edit($id, $data);

        if ($action) {
            $title = $this->level_model->first($id);
            $activity = "Delete Level {$title->title}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/level');
    }

}
