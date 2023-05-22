<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-21T13:01:10+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_fabric extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('material_fabric_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Fabric';
    }

    public function get_data()
    {
        $data = $this->material_fabric_model->all(

            array(
                'fields' => "material_fabric.*, if(material_fabric.category = 1, 'Standard', if(material_fabric.category = 2, 'Premium', if(material_fabric.category = 3, 'Super Premium', '-'))) as category_text",
                'order_by' => 'material_fabric.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('material_fabric/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('code_fabric', 'code_fabric', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('color_pattern', 'color and pattern', 'required');
        $this->form_validation->set_rules('mixing_ratio', 'mixing_ratio', 'required');
        $this->form_validation->set_rules('origin', 'origin', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('stock', 'stock', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('material_fabric/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_fabric_path'))) {
                    if (!file_exists(path_image('material_fabric_path'))) {
                        create_folder(path_image('material_fabric_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('material_fabric_path'), $type, 100, 100, true, true, current_url());
                $thumb = thumb_name($image);
            } else {
                $image = '';
                $thumb = '';
            }

            $data = array(
                'code_fabric' => $this->input->post('code_fabric', true),
                'title' => $this->input->post('title', true),
                'color_pattern' => $this->input->post('color_pattern', true),
                'mixing_ratio' => $this->input->post('mixing_ratio', true),
                'origin' => $this->input->post('origin', true),
                'price' => $this->input->post('price', true),
                'stock' => $this->input->post('stock', true),
                'category' => $this->input->post('category', true),
                'image' => $image,
                'thumb' => $thumb,
                'created_at' => $this->now,
            );
            $action = $this->material_fabric_model->save($data);

            if ($action) {
                $activity = "Create Material Fabric ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-fabric');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('code_fabric', 'code_fabric', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('color_pattern', 'color and pattern', 'required');
        $this->form_validation->set_rules('mixing_ratio', 'mixing_ratio', 'required');
        $this->form_validation->set_rules('origin', 'origin', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('stock', 'stock', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');

        $data['material_fabric'] = $this->material_fabric_model->first(
            array('id' => $id)
        );

        if(!$data['material_fabric']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('material_fabric/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                unlink_file(path_image('material_fabric_path') . $data['material_fabric']->image);
                unlink_file(path_image('material_fabric_path') . $data['material_fabric']->thumb);
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_fabric_path'))) {
                    if (!file_exists(path_image('material_fabric_path'))) {
                        create_folder(path_image('material_fabric_path'));
                    }
                }
                $type = 'image';
                // $image = $this->upload_file->upload($name, path_image('material_fabric_path'), $type, 100, 100, true, true, current_url());
                $image = $this->upload_file->upload($name, path_image('material_fabric_path'), $type, 100, 100, true, true, current_url());
                $thumb = thumb_name($image);
            } else {
                $image = $data['material_fabric']->image;
                $thumb = $data['material_fabric']->thumb;
            }

            $data = array(
                'code_fabric' => $this->input->post('code_fabric', true),
                'title' => $this->input->post('title', true),
                'color_pattern' => $this->input->post('color_pattern', true),
                'mixing_ratio' => $this->input->post('mixing_ratio', true),
                'origin' => $this->input->post('origin', true),
                'price' => $this->input->post('price', true),
                'stock' => $this->input->post('stock', true),
                'category' => $this->input->post('category', true),
                'image' => $image,
                'thumb' => $thumb,
                'updated_at' => $this->now,
            );
            $action = $this->material_fabric_model->edit($id, $data);

            if ($action) {
                $activity = "Update Material Fabric ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-fabric');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->material_fabric_model->edit($id, $data);

        if ($action) {
            $title = $this->material_fabric_model->first($id);
            $activity = "Delete Material Fabric ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/material-fabric');
    }

}
