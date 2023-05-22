<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:47+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T14:31:19+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('menu_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Menu';
    }

    public function get_data()
    {
        $sql = "SELECT a.id, a.title, IF(a.id_parent = 0, 'Main Menu', (SELECT b.title FROM menu b WHERE b.id = a.id_parent)) AS parent, a.url, a.order, a.created_at FROM menu a WHERE a.deleted_at IS NULL";
        $data = $this->menu_model->query($sql)->result();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('menu/list', $data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('id_parent', 'id_parent', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');

        if ($this->form_validation->run() == false) {
            $data['on_section'] = 'Add';
            $data['parent'] = $this->menu_model->all();
            $this->render('menu/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'id_parent' => $this->input->post('id_parent', true),
                'controller' => $this->input->post('controller', true),
                'url' => $this->input->post('url', true),
                'order' => $this->input->post('order', true),
                'icon' => $this->input->post('icon', true),
                'created_at' => $this->now,
            );
            $action = $this->menu_model->save($data);

            if ($action) {
                $activity = "Create Menu {$this->input->post('title', true)}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/menu');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('id_parent', 'id_parent', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');

        if ($this->form_validation->run() == false) {
            $data['menu'] = $this->menu_model->first(
                array('id' => $id)
            );
            $data['parent'] = $this->menu_model->all();
            $data['on_section'] = 'Edit';
            $this->render('menu/edit', $data);
        } else {
            $data = array(
                'title' => $this->input->post('title', true),
                'id_parent' => $this->input->post('id_parent', true),
                'controller' => $this->input->post('controller', true),
                'url' => $this->input->post('url', true),
                'order' => $this->input->post('order', true),
                'icon' => $this->input->post('icon', true),
                'updated_at' => $this->now,
            );
            $action = $this->menu_model->edit($id, $data);

            if ($action) {
                $activity = "Update Menu {$this->input->post('title', true)}";
                insert_log_activity($this->_user_login->id, $activity);
            }

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/menu');
        }
    }

    public function delete($id)
    {
        $data = array(
            'deleted_at' => $this->now
        );
        $action = $this->menu_model->edit($id, $data);

        if ($action) {
            $title = $this->menu_model->first($id);
            $activity = "Delete Menu {$title->title}";
            insert_log_activity($this->_user_login->id, $activity);
        }

        $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
        redirect('admin/menu');
    }

    public function get_parent($id_parent)
    {
        $parent = $this->menu_model->first(
            array('id' => $id_parent)
        )->title;
        return $parent;
    }

}
