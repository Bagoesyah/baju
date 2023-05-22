<?php
# @Author: Awan Tengah
# @Date:   2017-03-10T14:31:36+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T01:11:21+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('guide_model');
    }

    public function all() {
        $get = $this->guide_model->all();
        foreach($get as $key => $value) {
            foreach($value as $childkey => $childvalue) {
                $newget[$key][strtoupper($childkey)] = $childvalue;
            }
        }
        $datapi['DATA'] = $newget;
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function first() {
        $get = $this->guide_model->first();
        foreach($get as $key => $value) {
            $newget[strtoupper($key)] = $value;
        }
        $datapi['DATA'] = $newget;
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    // public function template() {
    //     $this->load->helper('string');
    //     $data_mail['generate_password'] = random_string('alnum', 8);
    //     $data_mail['encrypt_id_user'] = encrypt_text(1);
    //
    //     $this->load->view('template/frontend/_forgot_password', $data_mail);
    // }


    public function test_notif()
    {
        $order_number = 'KXPFINJD';
        get_data_curl(base_url('api/order/send_order_notification/' . $order_number), null, null);
    }

}
