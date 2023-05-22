<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-03T15:34:06+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Color extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('color_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Color';
    }

    public function get_data()
    {
        $data = $this->color_model->all(

            array(
                'fields' => 'color.*',
                'order_by' => 'color.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('color/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('color/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'created_at' => $this->now,
            );
            $action = $this->color_model->save($data);

            generate_slug('title', 'color_model');

            if ($action) {
                $activity = "Create Color ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/color');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['color'] = $this->color_model->first(
                array('id' => $id)
            );

            $this->render('color/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'updated_at' => $this->now,
            );
            $action = $this->color_model->edit($id, $data);

            generate_slug('title', 'color_model', $id);

            if ($action) {
                $activity = "Update Color ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/color');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->color_model->edit($id, $data);

        if ($action) {
            $title = $this->color_model->first($id);
            $activity = "Delete Color ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/color');
    }

}
