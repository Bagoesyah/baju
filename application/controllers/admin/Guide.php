<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-24T15:24:34+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Guide extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('guide_model');
        $this->load->model('product_category_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Guide';
    }

    public function get_data()
    {
        $data = $this->guide_model->all(

            array(
                'fields' => "guide.*, product_category.title as category_text",
                'left_join' => array(
                    'product_category' => 'product_category.id = guide.category'
                ),
                'order_by' => 'guide.id DESC'
            )

        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('guide/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $data['product_category'] = $this->product_category_model->all();
            $this->render('guide/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('guide_path'))) {
                    if (!file_exists(path_image('guide_path'))) {
                        create_folder(path_image('guide_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('guide_path'), $type, null, null, false, true, current_url());
            } else {
                $image = '';
            }

            $data = array(
                'category' => $this->input->post('category', true),
                'title' => $this->input->post('title', true),
                'description' => $this->input->post('description', true),
                'image' => $image,
                'created_at' => $this->now,
            );
            $action = $this->guide_model->save($data);

            generate_slug('title', 'guide_model');

            if ($action) {
                $activity = "Create Guide ID {$action}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/guide');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        $data['guide'] = $this->guide_model->first(
            array('id' => $id)
        );
        if(!$data['guide']) {
            show_404();
        }

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Edit';
            $data['product_category'] = $this->product_category_model->all();
            $this->render('guide/edit', $data);
        } else {
            $name = 'image';
            $check_upload = !empty($_FILES[$name]['name']);
            if ($check_upload) {
                $this->load->library('upload_file');
                if (!is_dir(path_image('guide_path'))) {
                    if (!file_exists(path_image('guide_path'))) {
                        create_folder(path_image('guide_path'));
                    }
                }
                $type = 'image';
                $image = $this->upload_file->upload($name, path_image('guide_path'), $type, null, null, false, true, current_url());
                unlink_file(path_image('guide_path') . $data['guide']->image);
            } else {
                $image = $data['guide']->image;
            }

            $data_save = array(
                'category' => $this->input->post('category', true),
                'title' => $this->input->post('title', true),
                'description' => $this->input->post('description', true),
                'image' => $image,
                'updated_at' => $this->now,
            );
            $action = $this->guide_model->edit($id, $data_save);

            generate_slug('title', 'guide_model', $id);

            if ($action) {
                $activity = "Update Guide ID {$id}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/guide');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->guide_model->edit($id, $data);

        if ($action) {
            $title = $this->guide_model->first($id);
            $activity = "Delete Guide ID {$id}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/guide');
    }

}
