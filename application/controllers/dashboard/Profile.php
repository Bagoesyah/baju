<?php
# @Author: Awan Tengah
# @Date:   2017-03-22T17:44:54+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-01T09:41:13+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Member_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();
        $this->load->model('user_model');

        $this->layout = 'template/dashboard';
        $this->page_title = 'Dashboard';
    }

    public function index() {
        $data['profile'] = get_data_curl(base_url('api/member/get_member/' . $this->_user_login->id));
        $this->visited_title = 'Edit Profile';
        $this->sub_visited_title = 'You can change your profile here!';
        $this->sidebar_menu = 'profile';
        $this->render('profile/index', $data);
    }

    public function edit_profile() {
        if($this->input->post()) {
            $data = array(
                'ID_USER' => $this->_user_login->id,
                'NAME' => $this->input->post('name', true),
                'EMAIL' => $this->input->post('email', true),
                'PHONE' => $this->input->post('phone', true),
                'ADDRESS' => $this->input->post('address', true),
                'GENDER' => $this->input->post('gender', true)
            );
            $get_user_token = $this->user_model->first(
                array(
                    'id' => $this->_user_login->id
                )
            );
            if($get_user_token) {
                $headers = array(
                    'USER_TOKEN' => $get_user_token->user_token
                );
                $result = get_data_curl(base_url('api/member/edit_profile'), $data, $headers);

                $this->session->set_flashdata('ep_message', array('message' => $result->MESSAGE, 'class' => ($result->STATUS == 'SUCCESS' ? 'alert-success' : 'alert-danger') ));
                redirect('dashboard/profile');
            } else {
                $this->session->set_flashdata('ep_message', array('message' => ucwords(strtolower('YOUR SESSION IS EXPIRED. PLEASE RE-LOGIN')), 'class' => 'alert-danger'));
                redirect('dashboard/profile');
            }
        }
    }

    public function change_password() {
        if($this->input->post()) {
            $data = array(
                'ID_USER' => $this->_user_login->id,
                'RECENT_PASSWORD' => $this->input->post('recent_password', true),
                'NEW_PASSWORD' => $this->input->post('new_password', true),
                'CONFIRM_PASSWORD' => $this->input->post('confirm_password', true)
            );
            $get_user_token = $this->user_model->first(
                array(
                    'id' => $this->_user_login->id
                )
            );
            if($get_user_token) {
                $headers = array(
                    'USER_TOKEN' => $get_user_token->user_token
                );
                $result = get_data_curl(base_url('api/member/change_password'), $data, $headers);

                $this->session->set_flashdata('cp_message', array('message' => $result->MESSAGE, 'class' => ($result->STATUS == 'SUCCESS' ? 'alert-success' : 'alert-danger') ));
                redirect('dashboard/profile');
            } else {
                $this->session->set_flashdata('cp_message', array('message' => ucwords(strtolower('YOUR SESSION IS EXPIRED. PLEASE RE-LOGIN')), 'class' => 'alert-danger'));
                redirect('dashboard/profile');
            }
        }
    }

}
