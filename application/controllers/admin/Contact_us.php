<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-22T21:18:18+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('contact_us_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Contact us';
    }

    public function get_data()
    {
        $data = $this->contact_us_model->all(

            array(
                'fields' => "contact_us.*, if(contact_us.read = 0, 'No', 'Yes') as read_text",
                'order_by' => 'contact_us.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('contact_us/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('message', 'message', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('contact_us/edit', $data);
        } else {
            $data = array(
                'email' => $this->input->post('email', true),
                'message' => $this->input->post('message', true),
                'created_at' => $this->now,
            );
            $action = $this->contact_us_model->save($data);

            if ($action) {
                $activity = "Create Contact us ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/contact-us');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('message', 'message', 'required');

        $data['contact_us'] = $this->contact_us_model->first(
            array('id' => $id)
        );
        if(!$data['contact_us']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('contact_us/edit', $data);
        } else {
            $data = array(
                'email' => $this->input->post('email', true),
                'message' => $this->input->post('message', true),
                'updated_at' => $this->now,
            );
            $action = $this->contact_us_model->edit($id, $data);

            if ($action) {
                $activity = "Update Contact us ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/contact-us');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->contact_us_model->edit($id, $data);

        if ($action) {
            $title = $this->contact_us_model->first($id);
            $activity = "Delete Contact us ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/contact-us');
    }

}
