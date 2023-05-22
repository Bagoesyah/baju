<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriber extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('subscriber_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Subscriber';
    }

    public function get_data()
    {
        $data = $this->subscriber_model->all(

            array(
                'fields' => '*',
                'order_by' => 'id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('subscriber/list', $data);
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->subscriber_model->edit($id, $data);

        if ($action) {
            $title = $this->subscriber_model->first($id);
            $activity = "Delete Subscriber ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/subscriber');
    }

    public function blast()
    {
        //
    }
}
