<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-24T15:25:17+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_cleric_category extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('material_cleric_category_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Cleric category';
    }

    public function get_data()
    {
        $data = $this->material_cleric_category_model->all(

            array(
                'fields' => 'material_cleric_category.*
                ',
                'order_by' => 'material_cleric_category.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('material_cleric_category/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('material_cleric_category/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_cleric_category_path'))) {
                    if (!file_exists(path_image('material_cleric_category_path'))) {
                        create_folder(path_image('material_cleric_category_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('material_cleric_category_path'), $type, null, null, false, false, current_url());
            } else {
                $image = '';
            }

            $data = array(
                'title' => $this->input->post('title', true),
                'image' => $image,
                'created_at' => $this->now,
            );
            $action = $this->material_cleric_category_model->save($data);

            if ($action) {
                $activity = "Create Material cleric category ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-cleric-category');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');

        $data['material_cleric_category'] = $this->material_cleric_category_model->first(
            array('id' => $id)
        );
        if(!$data['material_cleric_category']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('material_cleric_category/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_cleric_category_path'))) {
                    if (!file_exists(path_image('material_cleric_category_path'))) {
                        create_folder(path_image('material_cleric_category_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('material_cleric_category_path'), $type, null, null, false, false, current_url());
                unlink_file(path_image('material_cleric_category_path') . $data['material_cleric_category']->image);
            } else {
                $image = $data['material_cleric_category']->image;
            }

            $data = array(
                'title' => $this->input->post('title', true),
                'image' => $image,
                'updated_at' => $this->now,
            );
            $action = $this->material_cleric_category_model->edit($id, $data);

            if ($action) {
                $activity = "Update Material cleric category ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-cleric-category');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->material_cleric_category_model->edit($id, $data);

        if ($action) {
            $title = $this->material_cleric_category_model->first($id);
            $activity = "Delete Material cleric category ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/material-cleric-category');
    }

}
