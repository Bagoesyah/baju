<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-20T12:17:34+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Term_condition extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('term_condition_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Term condition';
    }

    public function get_data()
    {
        $data = $this->term_condition_model->all(

            array(
                'fields' => 'term_condition.*',
                'order_by' => 'term_condition.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['page_title'] = 'List ' . $this->page_title;
        $this->render('term_condition/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');

        if ($this->form_validation->run() == false) {
            $data['page_title'] = 'Add ' . $this->page_title;

            $this->render('term_condition/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'content' => $this->input->post('content', true),
                'created_at' => $this->now,
            );
            $action = $this->term_condition_model->save($data);

            if ($action) {
                $activity = "Create Term condition ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/term-condition');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');

        if ($this->form_validation->run() == false) {
            $data['page_title'] = 'Edit ' . $this->page_title;
            $data['term_condition'] = $this->term_condition_model->first(
                array('id' => $id)
            );

            $this->render('term_condition/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'content' => $this->input->post('content', true),
                'updated_at' => $this->now,
            );
            $action = $this->term_condition_model->edit($id, $data);

            if ($action) {
                $activity = "Update Term condition ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/term-condition');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->term_condition_model->edit($id, $data);

        if ($action) {
            $title = $this->term_condition_model->first($id);
            $activity = "Delete Term condition ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/term-condition');
    }

}
