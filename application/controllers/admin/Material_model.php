<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-19T13:59:01+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_model extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('material_model_model');
        $this->load->model('product_category_model');
        $this->layout = 'template/admin';
        $this->page_title = 'Material model';
    }

    public function get_data()
    {
        $data = $this->material_model_model->all(

            array(
                'fields' => 'material_model.*, product_category.title as category',
                'join' => array(
                    'product_category' => 'product_category.id = material_model.id_product_category',
                ),
                'order_by' => 'material_model.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('material_model/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_product_category', 'product category', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $data['product_category'] = $this->product_category_model->all();
            $this->render('material_model/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_model_path'))) {
                    if (!file_exists(path_image('material_model_path'))) {
                        create_folder(path_image('material_model_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('material_model_path'), $type, 560, 840, false, true, current_url());
            } else {
                $image = '';
            }

            $data = array(
                'id_product_category' => $this->input->post('id_product_category', true),
                'image' => $image,
                'created_at' => $this->now,
            );
            $action = $this->material_model_model->save($data);

            if ($action) {
                $activity = "Create Material model ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-model');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_product_category', 'product category', 'required');

        $data['material_model'] = $this->material_model_model->first(
            array('id' => $id)
        );
        if(!$data['material_model']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['product_category'] = $this->product_category_model->all();
            $this->render('material_model/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                unlink_file(path_image('material_model_path') . $data['material_model']->image);
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_model_path'))) {
                    if (!file_exists(path_image('material_model_path'))) {
                        create_folder(path_image('material_model_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('material_model_path'), $type, 560, 840, false, true, current_url());
            } else {
                $image = $data['material_model']->image;
            }

            $data = array(
                'id_product_category' => $this->input->post('id_product_category', true),
                'image' => $image,
                'updated_at' => $this->now,
            );
            $action = $this->material_model_model->edit($id, $data);

            if ($action) {
                $activity = "Update Material model ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-model');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->material_model_model->edit($id, $data);

        if ($action) {
            $title = $this->material_model_model->first($id);
            $activity = "Delete Material model ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/material-model');
    }

}
