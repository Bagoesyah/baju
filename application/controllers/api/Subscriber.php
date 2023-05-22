<?php

class Subscriber extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('subscriber_model');
    }

    public function blast()
    {
        $data = json_decode(file_get_contents("php://input"));
        $type = $data->type;
        $subscribers = $this->db->query("
            SELECT email FROM subscribers
        ");
        foreach ($subscribers->result() as $row) {
            $email_list[] = $row->email;
        }

        if ($type == 'product' || $type == 'both') {

            $this->load->model('product_model');
            $product_data = $this->db->query("
                SELECT prod.*, img.image
                FROM product prod 
                LEFT JOIN product_image img ON img.id_product = prod.id
                GROUP BY id_product
                ORDER BY prod.id DESC LIMIT 10
            ");

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

            $this->email->from($mail_support, 'Karuizawa Newsletter');
            $this->email->to(isset($email_list) ? $email_list : 'andreas.yunanto@gmail.com');
            $this->email->subject('Karuizawa Newsletter');
            $data_mail = [
                'data' => $product_data,
                'type' => 'product'
            ];

            if ($type == 'both') {
                $promo = $this->db->query("
                    SELECT * FROM promo ORDER BY id DESC LIMIT 5
                ");
                $data_mail['promo'] = $promo;
                $data_mail['type'] = 'both';
            }

            $template_newsletter = $this->load->view('template/frontend/_newsletter', $data_mail, true);

            $this->email->message($template_newsletter);
            $this->email->send();

            //echo json_encode(array('data' => $email_list));

        } else if ($type == 'promo') {

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

            $promo = $this->db->query("
                SELECT * FROM promo ORDER BY id DESC LIMIT 5
            ");
            $data_mail['promo'] = $promo;
            $data_mail['type'] = 'promo';

            $this->email->from($mail_support, 'Karuizawa Newsletter');
            $this->email->to(isset($email_list) ? $email_list : 'andreas.yunanto@gmail.com');
            $this->email->subject('Karuizawa Newsletter');

            $template_newsletter = $this->load->view('template/frontend/_newsletter', $data_mail, true);

            $this->email->message($template_newsletter);
            $this->email->send();

        }
    }
}