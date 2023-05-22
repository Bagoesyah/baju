<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-20T13:59:49+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('faq_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Faq';
    }

    public function get_data()
    {
        $data = $this->faq_model->all(

            array(
                'fields' => 'faq.*',
                'order_by' => 'faq.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['page_title'] = 'List ' . $this->page_title;
        $this->render('faq/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('question', 'question', 'required');
        $this->form_validation->set_rules('answer', 'answer', 'required');

        if ($this->form_validation->run() == false) {
            $data['page_title'] = 'Add ' . $this->page_title;

            $this->render('faq/edit', $data);
        } else {
            $data = array(
                'question' => $this->input->post('question', true),
                'answer' => $this->input->post('answer', true),
                'created_at' => $this->now,
            );
            $action = $this->faq_model->save($data);

            if ($action) {
                $activity = "Create Faq ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/faq');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('question', 'question', 'required');
        $this->form_validation->set_rules('answer', 'answer', 'required');

        if ($this->form_validation->run() == false) {
            $data['page_title'] = 'Edit ' . $this->page_title;
            $data['faq'] = $this->faq_model->first(
                array('id' => $id)
            );

            $this->render('faq/edit', $data);
        } else {
            $data = array(
                'question' => $this->input->post('question', true),
                'answer' => $this->input->post('answer', true),
                'updated_at' => $this->now,
            );
            $action = $this->faq_model->edit($id, $data);

            if ($action) {
                $activity = "Update Faq ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/faq');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->faq_model->edit($id, $data);

        if ($action) {
            $title = $this->faq_model->first($id);
            $activity = "Delete Faq ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/faq');
    }

}
