<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-21T16:43:44+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('promo_model');
        $this->load->model('type_promo_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Promo';
    }

    public function get_data()
    {
        $data = $this->promo_model->all(

            array(
                'fields' => 'promo.*, type_promo.type_name',
                'join' => array(
                    'type_promo' =>  'type_promo.id = promo.type_promo'
                ),
                'order_by' => 'promo.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('promo/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('promo_name', 'promo_name', 'required');
        $this->form_validation->set_rules('type_promo', 'type_promo', 'required');
        $this->form_validation->set_rules('exp_date', 'Expire date', 'required');
        $this->form_validation->set_rules('value', 'value', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section']         = 'Add';
            $data['type_promo']         = $this->type_promo_model->all();
            $this->render('promo/edit', $data);
        } else {

            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('promo_path'))) {
                    if (!file_exists(path_image('promo_path'))) {
                        create_folder(path_image('promo_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('promo_path'), $type, null, null, false, false, current_url());
            } else {
                $image = '';
            }

            $xdate = explode('/', $this->input->post('exp_date'));
            $xdate = $xdate[2].'-'.$xdate[1].'-'.$xdate[0];

            $data = array(
                'image' => $image,
                'promo_name' => $this->input->post('promo_name', true),
                'type_promo' => $this->input->post('type_promo', true),
                'value' => $this->input->post('value', true),
                'expired_at' => $xdate,
                'status' => $this->input->post('status', true),
                'created_at' => $this->now,
            );
            $action = $this->promo_model->save($data);

            generate_slug('promo_name', 'promo_model');

            if ($action) {
                $activity = "Create Promo ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/promo');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('promo_name', 'promo_name', 'required');
        $this->form_validation->set_rules('type_promo', 'type_promo', 'required');
        $this->form_validation->set_rules('value', 'value', 'required');
        $this->form_validation->set_rules('exp_date', 'Expire date', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        $data['promo'] = $this->promo_model->first(
            array('id' => $id)
        );
        if(!$data['promo']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['type_promo']         = $this->type_promo_model->all();
            $this->render('promo/edit', $data);
        } else {

            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('promo_path'))) {
                    if (!file_exists(path_image('promo_path'))) {
                        create_folder(path_image('promo_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('promo_path'), $type, null, null, false, false, current_url());
            } else {
                $image = $data['promo']->image;
            }

            $xdate = explode('/', $this->input->post('exp_date'));
            $xdate = $xdate[2].'-'.$xdate[1].'-'.$xdate[0];

            $data = array(
                'image' => $image,
                'promo_name' => $this->input->post('promo_name', true),
                'type_promo' => $this->input->post('type_promo', true),
                'value' => $this->input->post('value', true),
                'expired_at' => $xdate,
                'status' => $this->input->post('status', true),
                'updated_at' => $this->now,
            );
            $action = $this->promo_model->edit($id, $data);

            generate_slug('promo_name', 'promo_model', $id);

            if ($action) {
                $activity = "Update Promo ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/promo');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->promo_model->edit($id, $data);

        if ($action) {
            $title = $this->promo_model->first($id);
            $activity = "Delete Promo ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/promo');
    }

}
