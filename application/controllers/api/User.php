<?php
# @Author: Awan Tengah
# @Date:   2017-02-26T22:35:08+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T06:34:00+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function reset_password($encrypt_id_user = null, $encrypt_generate_password = null) {
        if(is_null($encrypt_id_user) || is_null($encrypt_generate_password)) {
            show_404();
        }
        $decrypt_id_user = decrypt_text($encrypt_id_user);
        $decrypt_generate_password = decrypt_text($encrypt_generate_password);

        $this->load->model('user_model');
        $data_update = array(
            'password' => sha1($decrypt_generate_password)
        );
        $this->user_model->edit($decrypt_id_user, $data_update);
    }

    public function forgot_password() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('user_model');
            $get_email = $this->input->post('EMAIL', true);

            if(!is_null($get_email) && !empty($get_email)) {
                $check_email_exists = $this->user_model->first(
                    array(
                        'email' => $get_email
                    )
                );
                if($check_email_exists) {
                    $this->load->helper('string');
                    $data_mail['generate_password'] = random_string('alnum', 8);
                    $data_mail['encrypt_id_user'] = encrypt_text($check_email_exists->id);
                    $data_mail['encrypt_generate_password'] = encrypt_text($data_mail['generate_password']);

                    /* Send Email */
                    $config = array(
                        'protocol' => trim($this->config->item('mail_protocol')),
                        'smtp_host' => trim($this->config->item('mail_smtp_host')),
                        'smtp_port' => trim($this->config->item('mail_smtp_port')),
                        'smtp_user' => trim($this->config->item('mail_smtp_user')),
                        'smtp_pass' => trim($this->config->item('mail_smtp_pass')),
                        'mailtype' => 'html',
                        'validate' => TRUE,
                        'smtp_crypto' => 'ssl',
                        'newline'   => "\r\n"
                    );

                    $this->load->library('email', $config);

                    $mail_support = $this->config->item('mail_support');
                    $mail_support_name = $this->config->item('mail_support_name');

                    $this->email->from($mail_support, $mail_support_name);
                    $this->email->to($get_email);
                    $this->email->subject('Forgot Password');

                    $template_forgot_password = $this->load->view('template/frontend/_forgot_password', $data_mail, true);

                    $this->email->message($template_forgot_password);
                    $this->email->send();

                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'FORGOT PASSWORD SEND TO YOUR EMAIL';
                    $datapi['DATA'] = (object)array();
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'EMAIL NOT FOUND';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT EMAIL';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

}
