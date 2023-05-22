<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:47+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T16:09:29+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller
{

    protected $path;
    private $width = 200;
    private $height = 200;

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();
        $this->load->model('user_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Profile';
        $this->auth = false;
        $this->path = $this->config->item('photo_profile_path');
    }

    public function index()
    {
        $data['on_section'] = $this->page_title;
        $data['profile'] = $this->user_model->first(
            array(
                'user.id' => $this->_user_login->id
            )
        );
        $this->render('profile/index', $data);
    }

    public function edit($id)
    {
        if ($this->_user_login->id != $id) {
            redirect('admin/profile');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_check_unique[email]');

        $data['user'] = $this->user_model->first(
            array('id' => $id)
        );

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('profile/edit', $data);
        } else {
            $name = 'photo';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                unlink_file($this->path . $data['user']->photo);
                $this->load->library('upload_file');
                if (!is_dir($this->path)) {
                    if (!file_exists($this->path)) {
                        create_folder($this->path);
                    }
                }
                $type = 'image';
                $filename = $this->upload_file->upload($name, $this->path, $type, $this->width, $this->height, false, false, current_url());
            } else {
                $filename = $data['user']->photo;
            }
            if ($this->input->post('password', true) == $data['user']->password) {
                $password = $this->input->post('password', true);
            } else {
                $password = sha1($this->input->post('password', true));
            }
            $data = array(
                'name' => $this->input->post('name', true),
                'password' => $password,
                'email' => $this->input->post('email', true),
                'photo' => $filename,
                'updated_at' => $this->now,
            );
            $action = $this->user_model->edit($id, $data);

            if ($action) {
                $activity = "Update Profile {$this->_user_login->name}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/profile');
        }
    }

    public function check_unique($value, $field) {
        $this->form_validation->set_rules("{$field}", "{$field}", 'required');
        $check_user = $this->user_model->first(
            array(
                'id' => $this->_user_login->id
            )
        );
        if($check_user->{$field} == $value) {
            return true;
        } else {
            $check_exists = $this->user_model->count(
                array(
                    "{$field}" => "{$value}"
                )
            );
            if($check_exists == 0) {
                return true;
            }
            $this->form_validation->set_message('check_unique', "{$value} already exists.");
            return false;
        }
    }

}
