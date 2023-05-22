<?php
# @Author: Awan Tengah
# @Date:   2017-02-07T10:13:49+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-25T15:40:10+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function get_promo() {
        $headers    = apache_request_headers();
        $check      = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('promo_model');

            $get = $this->promo_model->all(
                                array(
                                    'fields' => 'promo.*',
                                    'where' => array('promo.status'=>1),
                                    'order_by' => 'promo.id',
                                )
                            );
            $datapi['STATUS'] = 'SUCCESS';
            $datapi['MESSAGE'] = 'SUCCESS GET PROMO';
            $datapi['DATA'] = (object)$get;
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

}
