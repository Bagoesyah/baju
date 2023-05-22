<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-21T18:05:58+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class About_us extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('about_us_model');

        $this->layout = 'template/admin';
        $this->page_title = 'About us';
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('sub_title', 'sub_title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');

        $data['about_us'] = $this->about_us_model->first();

        if ($this->form_validation->run() == false) {
            $this->render('about_us/edit', $data);
        } else {
            $name3 = "header_image";
            $check_upload = !empty($_FILES[$name3]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('about_us_path'))) {
                    if (!file_exists(path_image('about_us_path'))) {
                        create_folder(path_image('about_us_path'));
                    }
                }
                $type = 'image';
                $header_image = $this->upload_file->upload($name3, path_image('about_us_path'), $type, null, null, false, false, current_url());
                if(!is_null($data['about_us'])) {
                    if(!empty($data['about_us']->header_image)) {
                        unlink_file(path_image('about_us_path') . $data['about_us']->header_image);
                    }
                }
            } else {
                if(!is_null($data['about_us'])) {
                    $header_image = $data['about_us']->header_image;
                } else {
                    $header_image = '';
                }
            }

            $name1 = "image1";
            $check_upload = !empty($_FILES[$name1]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('about_us_path'))) {
                    if (!file_exists(path_image('about_us_path'))) {
                        create_folder(path_image('about_us_path'));
                    }
                }
                $type = 'image';
                $image1 = $this->upload_file->upload($name1, path_image('about_us_path'), $type, 498, 357, false, true, current_url());
                if(!is_null($data['about_us'])) {
                    if(!empty($data['about_us']->image1)) {
                        unlink_file(path_image('about_us_path') . $data['about_us']->image1);
                    }
                }
            } else {
                if(!is_null($data['about_us'])) {
                    $image1 = $data['about_us']->image1;
                } else {
                    $image1 = '';
                }
            }

            $name2 = "image2";
            $check_upload = !empty($_FILES[$name2]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('about_us_path'))) {
                    if (!file_exists(path_image('about_us_path'))) {
                        create_folder(path_image('about_us_path'));
                    }
                }
                $type = 'image';
                $image2 = $this->upload_file->upload($name2, path_image('about_us_path'), $type, 498, 357, false, true, current_url());
                if(!is_null($data['about_us'])) {
                    if(!empty($data['about_us']->image2)) {
                        unlink_file(path_image('about_us_path') . $data['about_us']->image2);
                    }
                }
            } else {
                if(!is_null($data['about_us'])) {
                    $image2 = $data['about_us']->image2;
                } else {
                    $image2 = '';
                }
            }

            $data_save = array(
                'header_image' => $header_image,
                'title' => $this->input->post('title', true),
                'sub_title' => $this->input->post('sub_title', true),
                'description' => $this->input->post('description', true),
                'phone' => $this->input->post('phone', true),
                'email' => $this->input->post('email', true),
                'image1' => $image1,
                'image2' => $image2
            );
            if(is_null($data['about_us'])) {
                $data_save['created_at'] = $this->now;
                $action = $this->about_us_model->save($data_save);

                $activity = "Create About Us";
            } else {
                $data_save['updated_at'] = $this->now;
                $action = $this->about_us_model->edit($data['about_us']->id, $data_save);

                $activity = "Update About Us";
            }

            if ($action) {
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/about-us');
        }
    }

}
