<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:47+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-22T21:25:27+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('level_model');
        $this->load->model('user_model');
        $this->load->model('user_category_model');

        $this->layout = 'template/admin';
        $this->page_title = 'User';
    }

    public function get_data() {
        $data = $this->user_model->all(
            array(
                'fields' => 'user.*, level.title as level, user_category.title as user_category',
                'left_join' => array(
                    'level' => 'level.id = user.id_level',
                    'user_category' => 'user_category.id = user.id_user_category'
                )
            )
        );
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('user/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_user_category', 'user category', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('passconf', 'password confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('id_level', 'level', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $data['level'] = $this->level_model->all();
            $data['user_category'] = $this->user_category_model->all();
            $this->render('user/edit', $data);
        } else {
            $data = array(
                'id_user_category' => $this->input->post('id_user_category', true),
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'password' => sha1($this->input->post('password', true)),
                'id_level' => $this->input->post('id_level', true),
                'status' => $this->input->post('status', true),
                'created_at' => $this->now,
            );
            $action = $this->user_model->save($data);

            if ($action) {
                $activity = "Create User {$this->input->post('name', true)}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/user');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_user_category', 'user category', 'required');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', "required|valid_email|callback_check_unique_email[$id]");
        if (!empty($this->input->post('password', true))) {
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('passconf', 'password confirmation', 'required|matches[password]');
        }
        $this->form_validation->set_rules('id_level', 'level', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        $data['user'] = $this->user_model->first(
            array('id' => $id)
        );

        if(!$data['user']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['level'] = $this->level_model->all();
            $data['user_category'] = $this->user_category_model->all();
            $data['on_section'] = 'Edit';
            $this->render('user/edit', $data);
        } else {
            if (empty($this->input->post('password', true))) {
                $get_password = $this->user_model->first(
                    array(
                        'id' => $id
                    )
                )->password;
                $password = $get_password;
            } else {
                $password = sha1($this->input->post('password', true));
            }
            $data = array(
                'id_user_category' => $this->input->post('id_user_category', true),
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'password' => $password,
                'id_level' => $this->input->post('id_level', true),
                'status' => $this->input->post('status', true),
                'updated_at' => $this->now,
            );
            $action = $this->user_model->edit($id, $data);

            if ($action) {
                $activity = "Update User {$this->input->post('name', true)}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/user');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->user_model->edit($id, $data);

        if ($action) {
            $title = $this->user_model->first($id);
            $activity = "Delete User {$title->name}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/user');
    }

    public function check_unique_email($value, $id) {
        $this->form_validation->set_rules("email", "email", 'required');
        $check_user = $this->user_model->first(
            array(
                'id' => $id
            )
        );
        if($check_user->email == $value) {
            return true;
        } else {
            $check_exists = $this->user_model->count(
                array(
                    "email" => "{$value}"
                )
            );
            if($check_exists == 0) {
                return true;
            }
            $this->form_validation->set_message('check_unique_email', "{$value} already exists.");
            return false;
        }
    }

}
