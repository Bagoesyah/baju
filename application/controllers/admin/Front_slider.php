<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-12T22:46:25+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_slider extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('front_slider_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Front slider';
    }

    public function get_data()
    {
        $data = $this->front_slider_model->all(

            array(
                'fields' => 'front_slider.*',
                'order_by' => 'front_slider.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('front_slider/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $this->render('front_slider/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('front_slider_path'))) {
                    if (!file_exists(path_image('front_slider_path'))) {
                        create_folder(path_image('front_slider_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('front_slider_path'), $type, null, null, false, false, current_url());
            } else {
                $image = '';
            }

            $data = array(
                'title' => $this->input->post('title', true),
                'image' => $image,
                'created_at' => $this->now,
            );
            $action = $this->front_slider_model->save($data);

            if ($action) {
                $activity = "Create Front slider ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/front-slider');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        $data['front_slider'] = $this->front_slider_model->first(
            array('id' => $id)
        );
        if(!$data['front_slider']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('front_slider/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                unlink_file(path_image('front_slider_path') . $data['front_slider']->image);
                $this->load->library('upload_file');
                if (!is_dir(path_image('front_slider_path'))) {
                    if (!file_exists(path_image('front_slider_path'))) {
                        create_folder(path_image('front_slider_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('front_slider_path'), $type, null, null, false, false, current_url());
            } else {
                $image = $data['front_slider']->image;
            }

            $data = array(
                'title' => $this->input->post('title', true),
                'image' => $image,
                'updated_at' => $this->now,
            );
            $action = $this->front_slider_model->edit($id, $data);

            if ($action) {
                $activity = "Update Front slider ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/front-slider');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->front_slider_model->edit($id, $data);

        if ($action) {
            $title = $this->front_slider_model->first($id);
            $activity = "Delete Front slider ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/front-slider');
    }

}
