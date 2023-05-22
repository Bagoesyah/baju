<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T14:10:47+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T15:01:36+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('level_model');
        $this->load->model('menu_model');
        $this->load->model('privilege_model');

        $this->layout = 'template/admin';
        $this->page_title = 'Privilege';
    }

    public function index()
    {
        if (!$_POST) {
            $data['on_section'] = 'List';
            $data['level'] = $this->level_model->all(
                array(
                    'where' => array(
                        'redirect' => 'admin' 
                    )
                )
            );
            $this->render('privilege/index', $data);
        } else {
            $id_level = $this->input->post('id_level', true);
            $this->privilege_model->delete(
                array('id_level' => $id_level)
            );
            $menu = $this->input->post('menu', true);
            foreach ($menu as $key => $value) {
                $view = isset($value['view']) ? 1 : 0;
                $create = isset($value['create']) ? 1 : 0;
                $update = isset($value['update']) ? 1 : 0;
                $delete = isset($value['delete']) ? 1 : 0;

                $data = array(
                    'id_level' => $id_level,
                    'id_menu' => $key,
                    'view' => $view,
                    'create' => $create,
                    'update' => $update,
                    'delete' => $delete,
                    'created_at' => $this->now
                );
                $this->privilege_model->save($data);
            }

            $activity = "Update Privilege {$this->_user_login->name}";
            insert_log_activity($this->_user_login->id, $activity);

            $this->session->set_flashdata('message', array('message' => 'Action Successfully..', 'class' => 'alert-success'));
            redirect('admin/privilege');
        }
    }

    public function get_privilege($id_level, $id_menu)
    {
        $privilege = $this->privilege_model->first(
            array(
                'id_level' => $id_level,
                'id_menu' => $id_menu
            )
        );
        return $privilege;
    }

    public function lists($id_level = null)
    {
        if ($id_level != null) {
            $data['id_level'] = $id_level;
            $data['menu'] = $this->menu_model->all(
                array(
                    'where' => array(
                        'controller !=' => ''
                    )
                )
            );
            echo $this->load->view('template/admin/privilege/list', $data, true);
        } else {
            show_404();
        }
    }

}
