<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-03-03T16:15:12+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Admin_Controller
{

    public $product_image_path;

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('material_fabric_model');
        $this->load->model('material_collar_model');
        $this->load->model('material_buttons_model');
        $this->load->model('material_cuff_model');
        $this->load->model('material_body_type_model');
        $this->load->model('material_pocket_model');
        $this->load->model('material_embroidery_model');
        $this->load->model('material_option_model');
        $this->load->model('material_shoulder_width_model');
        $this->load->model('material_chest_circumference_model');

        $this->load->model('product_model');
        $this->load->model('product_category_model');
        $this->load->model('product_image_model');
        $this->load->model('product_size_model');
        $this->load->model('size_model');
        $this->load->model('product_color_model');
        $this->load->model('color_model');
        $this->load->model('promo_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Product';
        $this->product_image_path = $this->config->item('product_image_path');
    }

    public function get_data()
    {
        $data = $this->product_model->all(

            array(
                'fields' => 'product.*, product_category.title as category',
                'left_join' => array(
                    'product_category' =>  'product_category.id = product.id_product_category'
                ),
                'order_by' => 'product.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $data['product_category'] = $this->product_category_model->all();
        $this->render('product/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_product_category', 'id_product_category', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('stock', 'stock', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $data['product_category'] = $this->product_category_model->all();
            $data['master_color'] = $this->color_model->all(array('order_by' => 'title asc'));
            $data['master_size'] = $this->size_model->all(array('order_by' => 'id asc'));
            $data['fabric'] = $this->material_fabric_model->all();
            $data['collar'] = $this->material_collar_model->all();
            $data['button'] = $this->material_buttons_model->all(array('where' => array('category' => '1')));
            $data['button_holes'] = $this->material_buttons_model->all(array('where' => array('category' => '2')));
            $data['button_thread'] = $this->material_buttons_model->all(array('where' => array('category' => '3')));
            $data['cuff'] = $this->material_cuff_model->all();
            $data['body_front'] = $this->material_body_type_model->all(array('where' => array('category' => '1')));
            $data['body_back'] = $this->material_body_type_model->all(array('where' => array('category' => '2')));
            $data['body_hem'] = $this->material_body_type_model->all(array('where' => array('category' => '3')));
            $data['cleric_fabric'] = $this->material_fabric_model->all();
            $data['cleric_stitch'] = $this->material_fabric_model->all();
            $data['pocket'] = $this->material_pocket_model->all();
            $data['embroidery_position'] = $this->material_embroidery_model->all(array('where' => array('category' => '1')));
            $data['embroidery_font'] = $this->material_embroidery_model->all(array('where' => array('category' => '2')));
            $data['embroidery_color'] = $this->material_embroidery_model->all(array('where' => array('category' => '3')));
            $data['option_amf_stitch'] = $this->material_option_model->all(array('where' => array('category' => '1')));
            $data['option_interlining'] = $this->material_option_model->all(array('where' => array('category' => '2')));
            $data['option_sewing'] = $this->material_option_model->all(array('where' => array('category' => '3')));
            $data['option_tape'] = $this->material_option_model->all(array('where' => array('category' => '4')));
            $data['shoulder_dimensions'] = $this->material_shoulder_width_model->all(array('where' => array('category' => '1')));
            $data['shoulder_correction'] = $this->material_shoulder_width_model->all(array('where' => array('category' => '2')));
            $data['shoulder_product_ud'] = $this->material_shoulder_width_model->all(array('where' => array('category' => '3')));
            $data['chest_dimensions'] = $this->material_chest_circumference_model->all(array('where' => array('category' => '1')));
            $data['chest_correction'] = $this->material_chest_circumference_model->all(array('where' => array('category' => '2')));
            $data['chest_product_ud'] = $this->material_chest_circumference_model->all(array('where' => array('category' => '3')));
            $data['promo']              = $this->promo_model->all();
            $this->render('product/edit', $data);
        } else {
            $data = array(
                'id_product_category' => $this->input->post('id_product_category', true),
                'title' => $this->input->post('title', true),
                'description' => $this->input->post('description', true),
                'price' => $this->input->post('price', true),
                'stock' => $this->input->post('stock', true),
                'id_fabric' => $this->input->post('id_fabric', true),
                'id_collar' => $this->input->post('id_collar', true),
                'id_button' => $this->input->post('id_button', true),
                'id_button_holes' => $this->input->post('id_button_holes', true),
                'id_button_thread' => $this->input->post('id_button_thread', true),
                'id_cuff' => $this->input->post('id_cuff', true),
                'id_body_front' => $this->input->post('id_body_front', true),
                'id_body_back' => $this->input->post('id_body_back', true),
                'id_body_hem' => $this->input->post('id_body_hem', true),
                'id_cleric_fabric' => $this->input->post('id_cleric_fabric', true),
                'id_cleric_stitch' => $this->input->post('id_cleric_stitch', true),
                'id_pocket' => $this->input->post('id_pocket', true),
                'id_embroidery_position' => $this->input->post('id_embroidery_position', true),
                'id_embroidery_font' => $this->input->post('id_embroidery_font', true),
                'id_embroidery_color' => $this->input->post('id_embroidery_color', true),
                'id_option_amf_stitch' => $this->input->post('id_option_amf_stitch', true),
                'id_option_interlining' => $this->input->post('id_option_interlining', true),
                'id_option_sewing' => $this->input->post('id_option_sewing', true),
                'id_option_tape' => $this->input->post('id_option_tape', true),
                'id_shoulder_width_dimensions' => $this->input->post('id_shoulder_width_dimensions', true),
                'id_shoulder_width_correction' => $this->input->post('id_shoulder_width_correction', true),
                'id_shoulder_width_product_ud' => $this->input->post('id_shoulder_width_product_ud', true),
                'id_chest_c_dimensions' => $this->input->post('id_chest_c_dimensions', true),
                'id_chest_c_correction' => $this->input->post('id_chest_c_correction', true),
                'id_chest_c_product_ud' => $this->input->post('id_chest_c_product_ud', true),
                'promo_id' => $this->input->post('promo_id', true),
                'created_at' => $this->now,
            );
            $action = $this->product_model->save($data);

            generate_slug('title', 'product_model');

            $product_color = $this->input->post('color', true);
            if ($product_color) {
                $data_color = array();
                foreach ($product_color as $row) {
                    $data_color[] = array(
                        'id_product' => $action,
                        'id_color' => $row,
                        'created_at' => $this->now
                    );
                }
                $this->product_color_model->save_batch($data_color);
            }

            $product_size = $this->input->post('size', true);
            if ($product_size) {
                $data_size = array();
                foreach ($product_size as $row) {
                    $data_size[] = array(
                        'id_product' => $action,
                        'id_size' => $row,
                        'created_at' => $this->now
                    );
                }
                $this->product_size_model->save_batch($data_size);
            }

            $id_product = $action;
            $keys = array_keys($_FILES);
            foreach ($keys as $key) {
                $name = $key;
                $check_upload = !empty($_FILES[$name]['name']);
                if ($check_upload) {
                    $this->load->library('upload_file');
                    if (!is_dir($this->product_image_path)) {
                        if (!file_exists($this->product_image_path)) {
                            create_folder($this->product_image_path);
                        }
                    }
                    $type = 'image';
                    $image = $this->upload_file->upload($name, $this->product_image_path, $type, 500, 647, false, false, 'admin/product/edit/' . $id_product);
                    $thumb = thumb_name($image);

                    $data_product_image = array(
                        'id_product' => $id_product,
                        'image' => $image,
                        'created_at' => $this->now,
                        'updated_at' => $this->now
                    );
                    $this->product_image_model->save($data_product_image);
                }
            }

            if ($action) {
                $activity = "Create Product ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/product');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_product_category', 'id_product_category', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('stock', 'stock', 'required');

        $data['product'] = $this->product_model->first(
            array('id' => $id)
        );

        if(!$data['product']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['product_category'] = $this->product_category_model->all();
            $data['product_image'] = $this->product_image_model->all(
                array(
                    'where' => array(
                        'id_product' => $id
                    )
                )
            );

            $data['master_color'] = $this->color_model->all(array('order_by' => 'title asc'));
            $product_color = $this->color_model->all(
                array(
                    'fields' => 'color.id, color.title',
                    'left_join' => array('product_color' => 'color.id = product_color.id_color'),
                    'where' => array(
                        'product_color.id_product' => $id
                    )
                )
            );
            $data['product_color'] = array();
            foreach ($product_color as $row) {
                $data['product_color'][] = $row->id;
            }

            $data['master_size'] = $this->size_model->all(array('order_by' => 'id asc'));
            $product_size = $this->size_model->all(
                array(
                    'fields' => 'size.id, size.title',
                    'left_join' => array('product_size' => 'size.id = product_size.id_size'),
                    'where' => array(
                        'product_size.id_product' => $id
                    )
                )
            );
            $data['product_size'] = array();
            foreach ($product_size as $row) {
                $data['product_size'][] = $row->id;
            }

            $data['fabric'] = $this->material_fabric_model->all();
            $data['collar'] = $this->material_collar_model->all();
            $data['button'] = $this->material_buttons_model->all(array('where' => array('category' => '1')));
            $data['button_holes'] = $this->material_buttons_model->all(array('where' => array('category' => '2')));
            $data['button_thread'] = $this->material_buttons_model->all(array('where' => array('category' => '3')));
            $data['cuff'] = $this->material_cuff_model->all();
            $data['body_front'] = $this->material_body_type_model->all(array('where' => array('category' => '1')));
            $data['body_back'] = $this->material_body_type_model->all(array('where' => array('category' => '2')));
            $data['body_hem'] = $this->material_body_type_model->all(array('where' => array('category' => '3')));
            $data['cleric_fabric'] = $this->material_fabric_model->all();
            $data['cleric_stitch'] = $this->material_fabric_model->all();
            $data['pocket'] = $this->material_pocket_model->all();
            $data['embroidery_position'] = $this->material_embroidery_model->all(array('where' => array('category' => '1')));
            $data['embroidery_font'] = $this->material_embroidery_model->all(array('where' => array('category' => '2')));
            $data['embroidery_color'] = $this->material_embroidery_model->all(array('where' => array('category' => '3')));
            $data['option_amf_stitch'] = $this->material_option_model->all(array('where' => array('category' => '1')));
            $data['option_interlining'] = $this->material_option_model->all(array('where' => array('category' => '2')));
            $data['option_sewing'] = $this->material_option_model->all(array('where' => array('category' => '3')));
            $data['option_tape'] = $this->material_option_model->all(array('where' => array('category' => '4')));
            $data['shoulder_dimensions'] = $this->material_shoulder_width_model->all(array('where' => array('category' => '1')));
            $data['shoulder_correction'] = $this->material_shoulder_width_model->all(array('where' => array('category' => '2')));
            $data['shoulder_product_ud'] = $this->material_shoulder_width_model->all(array('where' => array('category' => '3')));
            $data['chest_dimensions'] = $this->material_chest_circumference_model->all(array('where' => array('category' => '1')));
            $data['chest_correction'] = $this->material_chest_circumference_model->all(array('where' => array('category' => '2')));
            $data['chest_product_ud'] = $this->material_chest_circumference_model->all(array('where' => array('category' => '3')));
            $data['promo']              = $this->promo_model->all();
            $this->render('product/edit', $data);
        } else {
            $data = array(
                'id_product_category' => $this->input->post('id_product_category', true),
                'title' => $this->input->post('title', true),
                'description' => $this->input->post('description', true),
                'price' => $this->input->post('price', true),
                'stock' => $this->input->post('stock', true),
                'id_fabric' => $this->input->post('id_fabric', true),
                'id_collar' => $this->input->post('id_collar', true),
                'id_button' => $this->input->post('id_button', true),
                'id_button_holes' => $this->input->post('id_button_holes', true),
                'id_button_thread' => $this->input->post('id_button_thread', true),
                'id_cuff' => $this->input->post('id_cuff', true),
                'id_body_front' => $this->input->post('id_body_front', true),
                'id_body_back' => $this->input->post('id_body_back', true),
                'id_body_hem' => $this->input->post('id_body_hem', true),
                'id_cleric_fabric' => $this->input->post('id_cleric_fabric', true),
                'id_cleric_stitch' => $this->input->post('id_cleric_stitch', true),
                'id_pocket' => $this->input->post('id_pocket', true),
                'id_embroidery_position' => $this->input->post('id_embroidery_position', true),
                'id_embroidery_font' => $this->input->post('id_embroidery_font', true),
                'id_embroidery_color' => $this->input->post('id_embroidery_color', true),
                'id_option_amf_stitch' => $this->input->post('id_option_amf_stitch', true),
                'id_option_interlining' => $this->input->post('id_option_interlining', true),
                'id_option_sewing' => $this->input->post('id_option_sewing', true),
                'id_option_tape' => $this->input->post('id_option_tape', true),
                'id_shoulder_width_dimensions' => $this->input->post('id_shoulder_width_dimensions', true),
                'id_shoulder_width_correction' => $this->input->post('id_shoulder_width_correction', true),
                'id_shoulder_width_product_ud' => $this->input->post('id_shoulder_width_product_ud', true),
                'id_chest_c_dimensions' => $this->input->post('id_chest_c_dimensions', true),
                'id_chest_c_correction' => $this->input->post('id_chest_c_correction', true),
                'id_chest_c_product_ud' => $this->input->post('id_chest_c_product_ud', true),
                'promo_id' => $this->input->post('promo_id', true),
                'updated_at' => $this->now,
            );
            $action = $this->product_model->edit($id, $data);

            generate_slug('title', 'product_model', $id);

            $product_color = $this->input->post('color', true);
            if ($product_color) {
                $this->product_color_model->delete(
                    array(
                        'id_product' => $id
                    )
                );
                $data_color = array();
                foreach ($product_color as $row) {
                    $data_color[] = array(
                        'id_product' => $id,
                        'id_color' => $row,
                        'created_at' => $this->now
                    );
                }
                $this->product_color_model->save_batch($data_color);
            }

            $product_size = $this->input->post('size', true);
            if ($product_size) {
                $this->product_size_model->delete(
                    array(
                        'id_product' => $id
                    )
                );
                $data_size = array();
                foreach ($product_size as $row) {
                    $data_size[] = array(
                        'id_product' => $id,
                        'id_size' => $row,
                        'created_at' => $this->now
                    );
                }
                $this->product_size_model->save_batch($data_size);
            }

            $id_product = $id;
            $keys = array_keys($_FILES);
            foreach ($keys as $key) {
                $name = $key;
                $check_upload = !empty($_FILES[$name]['name']);
                if ($check_upload) {
                    $this->load->library('upload_file');
                    if (!is_dir($this->product_image_path)) {
                        if (!file_exists($this->product_image_path)) {
                            create_folder($this->product_image_path);
                        }
                    }
                    $type = 'image';
                    $image = $this->upload_file->upload($name, $this->product_image_path, $type, 500, 647, false, false, current_url());
                    $thumb = thumb_name($image);

                    $data_product_image = array(
                        'id_product' => $id_product,
                        'image' => $image,
                        'created_at' => $this->now,
                        'updated_at' => $this->now
                    );
                    $this->product_image_model->save($data_product_image);
                }
            }

            if ($action) {
                $activity = "Update Product ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/product');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->product_model->delete($id);

        if ($action) {
            $title = $this->product_model->first($id);
            $activity = "Delete Product ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/product');
    }

}
