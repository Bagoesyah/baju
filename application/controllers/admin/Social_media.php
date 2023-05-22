<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-21T10:51:21+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Social_media extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('social_media_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Social media';
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('facebook', 'facebook', 'required');
        $this->form_validation->set_rules('twitter', 'twitter', 'required');
        $this->form_validation->set_rules('pinterest', 'pinterest', 'required');
        $this->form_validation->set_rules('instagram', 'instagram', 'required');
        $this->form_validation->set_rules('linkedin', 'linkedin', 'required');
        $this->form_validation->set_rules('google_plus', 'google plus', 'required');

        $data['social_media'] = $this->social_media_model->first();

        if ($this->form_validation->run() == false) {
            $data['on_section'] = '';
            $this->render('social_media/edit', $data);
        } else {
            $get_facebook = $this->input->post('facebook', true);
            $get_twitter = $this->input->post('twitter', true);
            $get_pinterest = $this->input->post('pinterest', true);
            $get_instagram = $this->input->post('instagram', true);
            $get_linkedin = $this->input->post('linkedin', true);
            $get_google_plus = $this->input->post('google_plus', true);

            $facebook = $get_facebook != '#' ? prep_url($get_facebook) : $get_facebook;
            $twitter = $get_twitter != '#' ? prep_url($get_twitter) : $get_twitter;
            $pinterest = $get_pinterest != '#' ? prep_url($get_pinterest) : $get_pinterest;
            $instagram = $get_instagram != '#' ? prep_url($get_instagram) : $get_instagram;
            $linkedin = $get_linkedin != '#' ? prep_url($get_linkedin) : $get_linkedin;
            $google_plus = $get_google_plus != '#' ? prep_url($get_google_plus) : $get_google_plus;

            $data_save = array(
                'facebook' => $facebook,
                'twitter' => $twitter,
                'pinterest' => $pinterest,
                'instagram' => $instagram,
                'linkedin' => $linkedin,
                'google_plus' => $google_plus,
                'created_at' => $this->now,
            );

            if(is_null($data['social_media'])) {
                $data_save['created_at'] = $this->now;
                $action = $this->social_media_model->save($data_save);

                $activity = "Add Social Media";
            } else {
                $data_save['updated_at'] = $this->now;
                $action = $this->social_media_model->edit($data['social_media']->id, $data_save);

                $activity = "Update Social Media";
            }

            if ($action) {
                $activity = "Add social media";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/social-media');
        }
    }

}
