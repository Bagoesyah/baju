<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T13:37:29+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T02:58:29+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $layout = 'template';
    protected $now;

    public $_app_title;
    public $_user_login;
    public $_login_redirect;
    public $_container_fluid;
    public $_social_media;
    public $_other_page;
    public $_about_us;

    public function __construct() {
        parent::__construct();
        $this->load->model('level_model');
        $this->load->model('user_model');
        $this->load->model('social_media_model');
        $this->load->model('other_page_model');
        $this->load->model('about_us_model');

        $this->now = date('Y-m-d H:i:s');
        $this->_app_title = !is_null($this->config->item('app_title')) && !empty($this->config->item('app_title')) ? $this->config->item('app_title') : 'Awan Tengah';
        $this->_user_login = $this->user_model->first(
            array('id' => $this->session->userdata('id_user'))
        );

        $level = $this->level_model->first($this->session->userdata('level'));
        $this->_login_redirect = $level ? $level->redirect : show_404();
        $this->_container_fluid = true;
        $this->_social_media = $this->social_media_model->first();
        $this->_other_page = $this->other_page_model->all();
        $this->_about_us = $this->about_us_model->first();
    }

    public function render($page, $data = null) {

        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($properties as $prop) {
            $data[$prop->name] = $this->{$prop->name};
        }

        $data['_main_content'] = $this->load->view($this->layout . '/' . $page, $data, true);
        $this->load->view($this->layout . '/layout', $data);
    }

    public function check_app_token($headers = null) {
        $datapi['STAT'] = FALSE;
        if(!empty($headers['APP_TOKEN'])) {
            $this->load->model('app_token_model');
            $check = $this->app_token_model->count(
                array(
                    'app_token' => $headers['APP_TOKEN']
                )
            );
            if($check == 1) {
                $datapi['STAT'] = TRUE;
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'APP TOKEN INVALID';
                $datapi['DATA'] = array();
            }
        } else {
            $datapi['STATUS'] = 'FAILED';
            $datapi['MESSAGE'] = 'PLEASE INPUT APP TOKEN';
            $datapi['DATA'] = array();
        }
        return $datapi;
    }

    public function check_app_and_user_token($headers = null) {
        $datapi['STAT'] = FALSE;
        if(!empty($headers['APP_TOKEN'])) {
            $this->load->model('app_token_model');
            $check = $this->app_token_model->count(
                array(
                    'app_token' => $headers['APP_TOKEN']
                )
            );
            if($check == 1) {
                if(!empty($headers['USER_TOKEN'])) {
                    $this->load->model('user_model');
                    $check = $this->user_model->count(
                        array(
                            'user_token' => $headers['USER_TOKEN']
                        )
                    );
                    if($check == 1) {
                        $datapi['STAT'] = TRUE;
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'USER TOKEN INVALID';
                        $datapi['DATA'] = array();
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'PLEASE INPUT USER TOKEN';
                    $datapi['DATA'] = array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'APP TOKEN INVALID';
                $datapi['DATA'] = array();
            }
        } else {
            $datapi['STATUS'] = 'FAILED';
            $datapi['MESSAGE'] = 'PLEASE INPUT APP TOKEN';
            $datapi['DATA'] = array();
        }
        return $datapi;
    }

    public function check_is_login() {
        $level = $this->session->userdata('level');
        $status = $this->session->userdata('status');

        if(!is_null($level) && !is_null($status)) {
            if($status != '1') {
                //Check active or not
                $this->session->set_flashdata('message', array('message' => 'Your account not active..', 'class' => 'alert-info'));
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', array('message' => 'You must login to continue..', 'class' => 'alert-info'));
            redirect('login');
        }
    }
}

/* Member */
class Member_Controller extends CI_Controller {

    protected $layout = 'template';
    protected $now;

    public $_app_title;
    public $_user_login;
    public $_login_redirect;
    public $_container_fluid;
    public $_social_media;
    public $_other_page;
    public $_about_us;

    public $visited_title;
    public $sub_visited_title;
    public $sidebar_menu;

    public function __construct() {
        parent::__construct();
        $this->load->model('level_model');
        $this->load->model('user_model');
        $this->load->model('social_media_model');
        $this->load->model('other_page_model');
        $this->load->model('about_us_model');

        $this->now = date('Y-m-d H:i:s');
        $this->_app_title = !is_null($this->config->item('app_title')) && !empty($this->config->item('app_title')) ? $this->config->item('app_title') : 'Awan Tengah';
        $this->_user_login = $this->user_model->first(
            array('id' => $this->session->userdata('id_user'))
        );

        $level = $this->level_model->first($this->session->userdata('level'));
        $this->_login_redirect = $level ? $level->redirect : show_404();
        $this->_container_fluid = true;
        $this->_social_media = $this->social_media_model->first();
        $this->_other_page = $this->other_page_model->all();
        $this->_about_us = $this->about_us_model->first();
    }

    public function check_validation() {
        $level = $this->session->userdata('level');
        $status = $this->session->userdata('status');

        $this->load->model('level_model');
        $get_level = $this->level_model->first(
            array(
                'id' => $level,
                'redirect' => 'dashboard'
            )
        );

        if(!$get_level || $status != '1') {
            if(!is_null($status)) {
                if($status != '1') {
                    //Check active or not
                    $this->session->set_flashdata('message', array('message' => 'Your account not active..', 'class' => 'alert-info'));
                    redirect('login');
                }
            }
            redirect('login');
        }
    }

    public function render($page, $data = null) {

        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($properties as $prop) {
            $data[$prop->name] = $this->{$prop->name};
        }

        $data['_main_content'] = $this->load->view($this->layout . '/' . $page, $data, true);
        $this->load->view($this->layout . '/layout', $data);
    }

}

class Admin_Controller extends CI_Controller
{
    protected $auth = true;
    protected $layout = 'template';
    protected $now;
    protected $rules;

    public $ci;
    public $page_title;
    public $limit = 10;

    public $_app_title;
    public $_user_login;
    public $_photo_profile_path;
    public $_created;
    public $_updated;
    public $_deleted;

    public function _remap($method, $params = array())
    {
        if ($this->auth) {
            $this->load->model('menu_model');
            $this->load->model('privilege_model');

            $level = $this->session->userdata('level');
            $class_name = get_class($this);

            $menu = $this->menu_model->first(
                array(
                    'controller' => $class_name
                )
            );
            if (!empty($menu)) {
                $privilege = $this->privilege_model->first(
                    array(
                        'id_level' => $level,
                        'id_menu' => $menu->id
                    )
                );
                if (!is_null($privilege)) {
                    if ($privilege->view == 1) {
                        $this->rules[$level][] = 'index';
                        $this->rules[$level][] = 'lists';
                        $this->rules[$level][] = 'get_data';
                    }
                    if ($privilege->create == 1) {
                        $this->_created = 1;
                        $this->rules[$level][] = 'add';
                    }
                    if ($privilege->update == 1) {
                        $this->_updated = 1;
                        if (!empty($params)) {
                            $this->rules[$level][] = 'edit';
                        }
                    }
                    if ($privilege->delete == 1) {
                        $this->_deleted = 1;
                        if (!empty($params)) {
                            $this->rules[$level][] = 'delete';
                        }
                    }
                }
            }
            if (!isset($this->rules[$level])) {
                $this->rules[$level] = array();
            }
            $rules = $this->rules[$level];
            if (!empty($rules)) {
                if (in_array($method, $rules)) {
                    if (method_exists($this, $method)) {
                        return call_user_func_array(array($this, $method), $params);
                    }
                    show_404();
                    return;
                }
            }
            $data['message'] = 'You have no privilege to access it!';
            $this->render('error', $data);
        } else {
            if (method_exists($this, $method)) {
                return call_user_func_array(array($this, $method), $params);
            }

            show_404();
            return;
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('privilege_model');
        $this->load->model('user_model');
        date_default_timezone_set('Asia/Jakarta');
        $this->now = date('Y-m-d H:i:s');
        $this->ci = &get_instance();
        $this->_app_title = !is_null($this->config->item('app_title')) && !empty($this->config->item('app_title')) ? $this->config->item('app_title') : '<b>Ardra</b>ATS';
        $this->_user_login = $this->user_model->first(
            array('id' => $this->session->userdata('id_user'))
        );
        $this->_photo_profile_path = $this->config->item('photo_profile_path');
    }

    public function check_validation() {
        $level = $this->session->userdata('level');
        $status = $this->session->userdata('status');

        $this->load->model('level_model');
        $get_level = $this->level_model->first(
            array(
                'id' => $level,
                'redirect' => 'admin'
            )
        );

        if(!$get_level || $status != '1') {
            if(!is_null($status)) {
                if($status != '1') {
                    //Check active or not
                    $this->session->set_flashdata('message', array('message' => 'Your account not active..', 'class' => 'alert-info'));
                    redirect('admin/login');
                }
            }
            redirect('admin/login');
        }
    }

    public function render($page, $data = null)
    {

        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($properties as $prop) {
            $data[$prop->name] = $this->{$prop->name};
        }

        $data['_main_content'] = $this->load->view($this->layout . '/' . $page, $data, true);
        $this->load->view($this->layout . '/layout', $data);
    }

    public function parent_menu() {
        $sql = "SELECT id, title, url, icon, `order` FROM (SELECT menu.id, menu.title, menu.url, menu.icon, menu.order FROM menu WHERE menu.id_parent = '0' UNION SELECT menu.id, menu.title, menu.url, menu.icon, menu.order FROM menu JOIN privilege ON menu.id = privilege.id_menu WHERE privilege.id_level = {$this->session->userdata('level')} AND privilege.view = 1 AND menu.id_parent = 0 AND menu.deleted_at IS NULL) result ORDER BY `order` ASC";
        return $this->db->query($sql)->result();
    }

    public function has_child_menu($id)
    {
        $child_menu = $this->menu_model->all(
            array(
                'fields' => 'menu.*, privilege.view',
                'join' => array('privilege' => 'privilege.id_menu = menu.id'),
                'where' => array(
                    'privilege.id_level' => $this->session->userdata('level'),
                    'privilege.view' => 1,
                    'menu.id_parent' => $id
                ),
                'order_by' => 'menu.order asc'
                )
            );
            if ($child_menu) {
                return $child_menu;
            } else {
                return null;
            }
        }

    }
