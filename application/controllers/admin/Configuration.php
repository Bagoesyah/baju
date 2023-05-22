<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->layout = 'template/admin';
        $this->page_title = 'Configuration';
    }

    public function index()
    {
        if ($this->input->post('notification_email')) {
            $data_config = json_encode([
                'order_notification_email' => $this->input->post('notification_email')
            ]);
            $update = $this->db->update('configurations', array('values' => $data_config), array('name' => 'configs'));
            if ($update) {
                $this->session->set_flashdata('message', array('message' => 'Configuration successfully updated..', 'class' => 'alert-success'));
                redirect('admin/configuration','location');
            }
        }

        $configs = $this->db->query('SELECT * FROM configurations WHERE name = "configs"');
        $data['configs'] = json_decode($configs->row()->values);
        $data['on_section'] = 'List';
        $this->render('configuration/index', $data);
    }
}
