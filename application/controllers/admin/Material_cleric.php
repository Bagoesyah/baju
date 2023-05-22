<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T19:50:15+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_cleric extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('material_cleric_model');
        $this->load->model('material_cleric_category_model');
        $this->load->model('material_cleric_sub_category_model');
        $this->load->model('material_fabric_model');
        $this->layout = 'template/admin';
        $this->page_title = 'Material cleric';
    }

    public function get_data()
    {
        $data = $this->material_cleric_model->all(

            array(
                'fields' => 'material_cleric.*',
                'order_by' => 'material_cleric.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('material_cleric/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('id_category', 'id_category', 'required');
        $this->form_validation->set_rules('code_fabric', 'code_fabric', 'required');
        // $this->form_validation->set_rules('id_sub_category', 'id_sub_category', 'required');
        // $this->form_validation->set_rules('id_fabric', 'id_fabric', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('stock', 'stock', 'required');
        $this->form_validation->set_rules('need_stock_for_custom', 'need stock for custom', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $data['material_cleric_category'] = $this->material_cleric_category_model->all();$data['material_cleric_sub_category'] = $this->material_cleric_sub_category_model->all();$data['material_fabric'] = $this->material_fabric_model->all();
            $this->render('material_cleric/edit', $data);
        } else {

            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_cleric_path'))) {
                    if (!file_exists(path_image('material_cleric_path'))) {
                        create_folder(path_image('material_cleric_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('material_cleric_path'), $type, 100, 100, true, true, current_url());
            } else {
                $image = '';
            }

            $data = array(
                //'id_category' => 1,
                //'id_sub_category' => $this->input->post('id_sub_category', true),
                //'id_fabric' => $this->input->post('id_fabric', true),
                'title' => $this->input->post('title', true),
                'code_fabric' => $this->input->post('code_fabric', true),
                'price' => $this->input->post('price', true),
                'image' => $image,
                'stock' => $this->input->post('stock', true),
                'need_stock_for_custom' => $this->input->post('need_stock_for_custom', true),
                'created_at' => $this->now,
            );

            if ($this->input->post('additional_charge') && $this->input->post('additional_charge') == 1) {
                $data['additional_charge'] = 1;
            }

            if ($this->input->post('most_pick') && $this->input->post('most_pick') == 1) {
                $data['most_pick'] = 1;
            } else {
                $data['most_pick'] = 0;
            }

            $data['xform'] = $this->input->post('xform');

            $action = $this->material_cleric_model->save($data);

            if ($action) {
                $activity = "Create Material cleric ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-cleric');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('id_category', 'id_category', 'required');
        $this->form_validation->set_rules('code_fabric', 'code_fabric', 'required');
        //$this->form_validation->set_rules('id_sub_category', 'id_sub_category', 'required');
        //$this->form_validation->set_rules('id_fabric', 'id_fabric', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('stock', 'stock', 'required');
        $this->form_validation->set_rules('need_stock_for_custom', 'need stock for custom', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['material_cleric'] = $this->material_cleric_model->first(
                array('id' => $id)
            );
            $data['material_cleric_category'] = $this->material_cleric_category_model->all();$data['material_cleric_sub_category'] = $this->material_cleric_sub_category_model->all();$data['material_fabric'] = $this->material_fabric_model->all();
            $this->render('material_cleric/edit', $data);
        } else {

            $data = array(
                //'id_category' => $this->input->post('id_category', true),
                //'id_sub_category' => $this->input->post('id_sub_category', true),
                //'id_fabric' => $this->input->post('id_fabric', true),
                'title' => $this->input->post('title', true),
                'code_fabric' => $this->input->post('code_fabric', true),
                'price' => $this->input->post('price', true),
                'stock' => $this->input->post('stock', true),
                'need_stock_for_custom' => $this->input->post('need_stock_for_custom', true),
                'updated_at' => $this->now,
            );

            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                unlink_file(path_image('material_cleric_path') . $data['material_cleric']->image);
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_cleric_path'))) {
                    if (!file_exists(path_image('material_cleric_path'))) {
                        create_folder(path_image('material_cleric_path'));
                    }
                }
                $type = 'image';
                // $image = $this->upload_file->upload($name, path_image('material_fabric_path'), $type, 100, 100, true, true, current_url());
                $data['image'] = $this->upload_file->upload($name, path_image('material_cleric_path'), $type, 100, 100, true, true, current_url());
                $thumb = thumb_name($image);
            }

            $data['additional_charge'] = 0;
            if ($this->input->post('additional_charge') && $this->input->post('additional_charge') == 1) {
                $data['additional_charge'] = 1;
            }

            if ($this->input->post('most_pick') && $this->input->post('most_pick') == 1) {
                $data['most_pick'] = 1;
            } else {
                $data['most_pick'] = 0;
            }

            $data['xform'] = $this->input->post('xform');

            $action = $this->material_cleric_model->edit($id, $data);

            if ($action) {
                $activity = "Update Material cleric ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-cleric');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->material_cleric_model->edit($id, $data);

        if ($action) {
            $title = $this->material_cleric_model->first($id);
            $activity = "Delete Material cleric ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/material-cleric');
    }

}
