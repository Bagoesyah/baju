<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-21T16:43:44+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Other_page extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('other_page_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Other page';
    }

    public function get_data()
    {
        $data = $this->other_page_model->all(

            array(
                'fields' => 'other_page.*',
                'order_by' => 'other_page.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('other_page/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('other_page/edit', $data);
        } else {
            $name = 'header_image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('other_page_path'))) {
                    if (!file_exists(path_image('other_page_path'))) {
                        create_folder(path_image('other_page_path'));
                    }
                }
                $type = 'image';
                $header_image = $this->upload_file->upload($name, path_image('other_page_path'), $type, null, null, false, false, current_url());
            } else {
                $header_image = '';
            }

            $data = array(
                'header_image' => $header_image,
                'title' => $this->input->post('title', true),
                'content' => $this->input->post('content', true),
                'created_at' => $this->now,
            );
            $action = $this->other_page_model->save($data);

            generate_slug('title', 'other_page_model');

            if ($action) {
                $activity = "Create Other page ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/other-page');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');

        $data['other_page'] = $this->other_page_model->first(
            array('id' => $id)
        );
        if(!$data['other_page']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('other_page/edit', $data);
        } else {
            $name = 'header_image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('other_page_path'))) {
                    if (!file_exists(path_image('other_page_path'))) {
                        create_folder(path_image('other_page_path'));
                    }
                }
                $type = 'image';
                $header_image = $this->upload_file->upload($name, path_image('other_page_path'), $type, null, null, false, false, current_url());
                unlink_file(path_image('other_page_path') . $data['other_page']->header_image);
            } else {
                $header_image = $data['other_page']->header_image;
            }

            $data = array(
                'header_image' => $header_image,
                'title' => $this->input->post('title', true),
                'content' => $this->input->post('content', true),
                'updated_at' => $this->now,
            );
            $action = $this->other_page_model->edit($id, $data);

            generate_slug('title', 'other_page_model', $id);

            if ($action) {
                $activity = "Update Other page ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/other-page');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->other_page_model->edit($id, $data);

        if ($action) {
            $title = $this->other_page_model->first($id);
            $activity = "Delete Other page ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/other-page');
    }

}
