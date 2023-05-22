<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T19:20:21+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_cuff extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('material_cuff_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Cuff';
    }

    public function get_data()
    {
        $data = $this->material_cuff_model->all(

            array(
                'fields' => "*, if(category = 1, 'Cuff', 'Sleeve') as category_text",
                'order_by' => 'id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('material_cuff/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('stock', 'stock', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('need_stock_for_custom', 'need stock for custom', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';

            $this->render('material_cuff/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_cuff_path'))) {
                    if (!file_exists(path_image('material_cuff_path'))) {
                        create_folder(path_image('material_cuff_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('material_cuff_path'), $type, 183, 183, false, true, current_url());
            } else {
                $image = '';
            }

            if (!is_dir(path_image('material_cuff_obj_path'))) {
                if (!file_exists(path_image('material_cuff_obj_path'))) {
                    create_folder(path_image('material_cuff_obj_path'));
                }
            }

            $data = array(
                'category' => $this->input->post('category', true),
                'title' => $this->input->post('title', true),
                'price' => $this->input->post('price', true),
                'stock' => $this->input->post('stock', true),
                'need_stock_for_custom' => $this->input->post('need_stock_for_custom', true),
                'image' => $image,
                'object' => $obj,
                'mtl' => $mtl,
                'created_at' => $this->now,
            );

            if ($this->input->post('is_default') && $this->input->post('is_default') == 1) {
                $update_base_category = $this->db->update('material_cuff', array('is_default' => 0), array('category' => $this->input->post('category', true)));
                $data['is_default'] = 1;
            }

            if ($this->input->post('additional_charge') && $this->input->post('additional_charge') == 1) {
                $data['additional_charge'] = 1;
            }

            if ($this->input->post('most_pick') && $this->input->post('most_pick') == 1) {
                $data['most_pick'] = 1;
            } else {
                $data['most_pick'] = 0;
            }

            $data['xform'] = $this->input->post('xform');

            $data['is_long_sleeve'] = 0;
            if ($this->input->post('category', true) == 2) {
                if ($this->input->post('is_long_sleeve') && $this->input->post('is_long_sleeve') == 1) {
                    $data['is_long_sleeve'] = 1;
                }
            }

            // Added 13/05/17 - Andre
            // Adding object and mtl file upload for cuff
            $config['upload_path'] = path_image('material_cuff_obj_path');
            //$config['encrypt_name'] = true;
            $config['overwrite'] = TRUE;
            $this->load->library('upload');
            $this->upload->initialize($config);

            if ( $this->upload->do_upload('object')) {
                $data = $this->upload->data();
                $obj = $data['file_name'];
                $obj_raw = $data['raw_name'];

                $config_mtl['upload_path'] = path_image('material_cuff_obj_path');
                $config_mtl['filename'] = $obj_raw.'.mtl';
                $config_mtl['overwrite'] = TRUE;
                $this->load->library('upload');
                $this->upload->initialize($config);

                if ( $this->upload->do_upload('mtl')) {
                    $mtl_data = $this->upload->data();
                    $data['mtl'] = $mtl_data['file_name'];
                    $data['object'] = $data['file_name'];
                }
            }

            $action = $this->material_cuff_model->save($data);

            if ($action) {
                $activity = "Create Material Cuff ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-cuff');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('stock', 'stock', 'required');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('need_stock_for_custom', 'need stock for custom', 'required');

        $data['material_cuff'] = $this->material_cuff_model->first(
            array('id' => $id)
        );
        if(!$data['material_cuff']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $this->render('material_cuff/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                unlink_file(path_image('material_cuff_path') . $data['material_cuff']->image);
                $this->load->library('upload_file');
                if (!is_dir(path_image('material_cuff_path'))) {
                    if (!file_exists(path_image('material_cuff_path'))) {
                        create_folder(path_image('material_cuff_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('material_cuff_path'), $type, 183, 183, false, true, current_url());
            } else {
                $image = $data['material_cuff']->image;
            }

            $data = array(
                'category' => $this->input->post('category', true),
                'title' => $this->input->post('title', true),
                'price' => $this->input->post('price', true),
                'stock' => $this->input->post('stock', true),
                'need_stock_for_custom' => $this->input->post('need_stock_for_custom', true),
                'image' => $image,
                'updated_at' => $this->now,
            );

            $data['is_default'] = 0;
            if ($this->input->post('is_default') && $this->input->post('is_default') == 1) {
                $update_base_category = $this->db->update('material_cuff', array('is_default' => 0), array('category' => $this->input->post('category', true)));
                $data['is_default'] = 1;
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

            $data['is_long_sleeve'] = 0;
            if ($this->input->post('category', true) == 2) {
                if ($this->input->post('is_long_sleeve') && $this->input->post('is_long_sleeve') == 1) {
                    $data['is_long_sleeve'] = 1;
                }
            }

            // Added 13/05/17 - Andre
            // Adding object and mtl file upload for cuff
            if (!is_dir(path_image('material_cuff_obj_path'))) {
                if (!file_exists(path_image('material_cuff_obj_path'))) {
                    create_folder(path_image('material_cuff_obj_path'));
                }
            }

            $config["allowed_types"] ="*";
            $config['upload_path'] = path_image('material_cuff_obj_path');
            //$config['encrypt_name'] = true;
            $config['overwrite'] = TRUE;
            $this->load->library('upload');
            $this->upload->initialize($config);

            if ( $this->upload->do_upload('object')) {
                $data_obj_upload = $this->upload->data();
                $obj_raw = $data_obj_upload['raw_name'];

                $config_mtl['upload_path'] = path_image('material_cuff_obj_path');
                $config_mtl['file_name'] = $obj_raw.'.mtl';
                $config_mtl["allowed_types"] ="*";
                $config_mtl['overwrite'] = TRUE;
                $this->load->library('upload');
                $this->upload->initialize($config_mtl);

                if ( $this->upload->do_upload('mtl')) {
                    $mtl_data = $this->upload->data();
                    $data['mtl'] = $mtl_data['file_name'];
                    $data['object'] = $data_obj_upload['file_name'];
                }
            }

            $action = $this->material_cuff_model->edit($id, $data);

            if ($action) {
                $activity = "Update Material Cuff ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/material-cuff');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->material_cuff_model->edit($id, $data);

        if ($action) {
            $title = $this->material_cuff_model->first($id);
            $activity = "Delete Material Cuff ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/material-cuff');
    }

}
