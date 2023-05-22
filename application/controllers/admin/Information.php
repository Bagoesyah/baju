<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-26T11:16:56+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('information_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Information';
    }

    public function get_data()
    {
        $data = $this->information_model->all(
            array(
                'fields' => 'information.*',
                'order_by' => 'information.id DESC'
            )
        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('information/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $this->render('information/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'content' => $this->input->post('content', true),
                'created_at' => $this->now,
            );
            $action = $this->information_model->save($data);

            if ($action) {
                $activity = "Create Information ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/information');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');

        $data['information'] = $this->information_model->first(
            array('id' => $id)
        );
        if(!$data['information']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('information/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'content' => $this->input->post('content', true),
                'updated_at' => $this->now,
            );
            $action = $this->information_model->edit($id, $data);

            if ($action) {
                $activity = "Update Information ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/information');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->information_model->edit($id, $data);

        if ($action) {
            $title = $this->information_model->first($id);
            $activity = "Delete Information ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/information');
    }

}
