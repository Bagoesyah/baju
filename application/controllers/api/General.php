<?php
# @Author: Awan Tengah
# @Date:   2017-02-18T20:05:36+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T14:50:41+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class General extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function get_about_us() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('about_us_model');
            $get = $this->about_us_model->first();
            if($get) {
                foreach($get as $key => $value) {
                    $newget[strtoupper($key)] = $value;
                    $newget['PATH'] = path_image('about_us_path');
                }
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'ABOUT US';
                $datapi['DATA'] = $newget;
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_term_condition() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('term_condition_model');
            $get = $this->term_condition_model->all();
            if($get) {
                foreach($get as $key => $value) {
                    foreach($value as $childkey => $childvalue) {
                        $newget[$key][strtoupper($childkey)] = $childvalue;
                    }
                }
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'TERM & CONDITION';
                $datapi['DATA'] = $newget;
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_faq() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('faq_model');
            $get = $this->faq_model->all();
            if($get) {
                foreach($get as $key => $value) {
                    foreach($value as $childkey => $childvalue) {
                        $newget[$key][strtoupper($childkey)] = $childvalue;
                    }
                }
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'FAQ';
                $datapi['DATA'] = $newget;
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function send_contact_us() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('contact_us_model');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('EMAIL', 'EMAIL', 'trim|required|valid_email', array('valid_email' => 'YOUR %s NOT VALID'));
            $this->form_validation->set_rules('MESSAGE', 'MESSAGE', 'required');
            if($this->form_validation->run() == true) {
                $data = array(
                    'email' => $this->input->post('EMAIL', true),
                    'message' => $this->input->post('MESSAGE', true),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'image' => '',
                );

                if ($this->input->post('IMAGE') && $this->input->post('IMAGE') != '') {
                    $this->load->helper('string');
                    $custom_img_filename = random_string('alnum', 32).'.png';
                    $img_data = $this->input->post('IMAGE');
                    list($type, $img_data) = explode(';', $img_data);
                    list(, $img_data)      = explode(',', $img_data);
                    $img_data = base64_decode($img_data);
                    file_put_contents('assets/img/img_contact/' . $custom_img_filename, $img_data);
                    $data['image'] = $custom_img_filename;
                }

                $this->contact_us_model->save($data);
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'YOUR MESSAGE HAS BEEN SENT';
                $datapi['DATA'] = (object) $data;
            } else {
                if(validation_errors()) {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = validation_errors();
                    $datapi['DATA'] = (object)array();
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'PLEASE INPUT EMAIL AND PASSWORD';
                    $datapi['DATA'] = (object)array();
                }
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));

    }

    public function contact_us_read() {
        $id = $this->input->post('id', true);
        if($id) {
            $this->load->model('contact_us_model');
            $data = array(
                'read' => '1' //read
            );
            $this->contact_us_model->edit($id, $data);
        } else {
            return false;
        }
    }

    public function change_notif_on_off() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $get_id_user = $this->input->post('ID_USER', true);
            $get_notification = $this->input->post('NOTIFICATION', true);
            if(!is_null($get_id_user) && !is_null($get_notification)) {
                if(is_numeric($get_id_user)) {
                    $this->load->model('user_model');
                    $check = $this->user_model->first($get_id_user);
                    if($check) {
                        $change_notification = $get_notification == 'OFF' ? '0' : ($get_notification == 'ON' ? '1' : NULL);
                        if(!is_null($change_notification)) {
                            $data = array(
                                'notification' => $change_notification
                            );
                            $this->user_model->edit($get_id_user, $data);
                            $datapi['STATUS'] = 'SUCCESS';
                            $datapi['MESSAGE'] = "NOTIFICATION {$get_notification}";
                            $datapi['DATA'] = (object)array();
                        } else {
                            $datapi['STATUS'] = 'FAILED';
                            $datapi['MESSAGE'] = 'NOTIFICATION MUST ONLY ON/OFF';
                            $datapi['DATA'] = (object)array();
                        }
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'USER NOT FOUND';
                        $datapi['DATA'] = (object)array();
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'ID_USER MUST NUMERIC';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_USER AND NOTIFICATION ON/OFF';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_guide() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('guide_model');
            $this->load->model('product_category_model');
            $slug = $this->input->post('SLUG_CATEGORY', true);
            $slug_category = $this->input->post('CATEGORY_ID', true);
            $id_guide = $this->input->post('ID', true);
            if(!is_null($slug_category)) {
                $category_code = $this->product_category_model->first(
                    array(
                        'id' => $slug_category
                    )
                );
                if(!is_null($category_code)) {
                    $get = $this->guide_model->all(
                        array(
                            'where' => array(
                                'category' => $category_code->id
                            )
                        )
                    );
                    if($get) {
                        foreach($get as $key => $value) {
                            foreach($value as $childkey => $childvalue) {
                                $newget[$key][strtoupper($childkey)] = $childvalue;
                                $newget[$key]['PATH'] = path_image('guide_path');
                            }
                        }
                        $datapi['STATUS'] = 'SUCCESS';
                        $datapi['MESSAGE'] = 'GUIDE LIST';
                        $datapi['DATA'] = $newget;
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                        $datapi['DATA'] = (object)array();
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $where = NULL;
                if ($id_guide) {
                    $where = array(
                        'where' => array('id' => $id_guide)
                    );
                } else if ($slug) {
                    $where = array(
                        'where' => array('slug' => $slug)
                    );
                }
                $get = $this->guide_model->all($where);
                if($get) {
                    foreach($get as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                            $newget[$key]['PATH'] = path_image('guide_path');
                        }
                    }
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'GUIDE LIST';
                    $datapi['DATA'] = $newget;
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                    $datapi['DATA'] = (object)array();
                }
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_notification() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('notification_model');
            $get_notif_to = $this->input->post('NOTIF_TO', true);
            $get_id_user = $this->input->post('ID_USER', true);
            if(!is_null($get_notif_to) && !is_null($get_id_user)) {
                $notif_to_code = $get_notif_to == 'ADMIN' ? '1' : ($get_notif_to == 'MEMBER' ? '2' : NULL);
                if(!is_null($notif_to_code)) {
                    $get = $this->notification_model->all(
                        array(
                            'where' => array(
                                'notif_to' => $notif_to_code,
                                'id_user' => $get_id_user
                            )
                        )
                    );
                    if($get) {
                        foreach($get as $key => $value) {
                            foreach($value as $childkey => $childvalue) {
                                $newget[$key][strtoupper($childkey)] = $childvalue;
                            }
                        }
                        $datapi['STATUS'] = 'SUCCESS';
                        $datapi['MESSAGE'] = 'NOTIFICATION LIST';
                        $datapi['DATA'] = $newget;
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                        $datapi['DATA'] = (object)array();
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NOTIF_TO MUST ONLY ADMIN/MEMBER';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT NOTIF_TO AND ID_USER';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function insert_notification() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('notification_model');
            $get_notif_to = $this->input->post('NOTIF_TO', true);
            if(!is_null($get_notif_to)) {
                $notif_to_code = $get_notif_to == 'ADMIN' ? '1' : ($get_notif_to == 'MEMBER' ? '2' : NULL);
                if(!is_null($notif_to_code)) {
                    $data = array(
                        'notif_to' => $notif_to_code,
                        'id_user' => $this->input->post('ID_USER'),
                        'subject' => $this->input->post('SUBJECT'),
                        'notification' => $this->input->post('NOTIFICATION'),
                        'read' => '0', //no
                        'created_at' => $this->now
                    );
                    $this->notification_model->save($data);
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'NOTIFICATION SAVED';
                    $datapi['DATA'] = (object)array();
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NOTIF_TO MUST ONLY ADMIN/MEMBER';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT NOTIF_TO';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function login() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $email = $this->input->post('EMAIL', true);
            $password = $this->input->post('PASSWORD', true);
            if(!is_null($email) && !is_null($password)) {
                $this->load->model('user_model');
                $data_check = array(
                    'email' => $email,
                    'password' => sha1($password)
                );
                $validate = $this->user_model->validate($data_check);
                if ($validate != false) {
                    $data = array();
                    $data = $validate;
                    $data->user_token = sha1($validate->email.date("Ymd"));
                    $this->user_model->edit(
                        $validate->id, array('user_token' => $data->user_token)
                    );
                    if($data) {
                        foreach($data as $key => $value) {
                            $newget[strtoupper($key)] = $value;
                        }
                        $newget['PATH'] = path_image('photo_profile_path');
                        $datapi['STATUS'] = 'SUCCESS';
                        $datapi['MESSAGE'] = 'LOGIN SUCCESS';
                        $datapi['DATA'] = $newget;
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'EMAIL OR PASSWORD NOT CORRECT';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT EMAIL AND PASSWORD';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function update_profile()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);

        if($check['STAT'] == TRUE) {

            $user_id = $this->input->post('USER_ID');
            $name = $this->input->post('NAME', true);
            $phone = $this->input->post('PHONE', true);
            $email = $this->input->post('EMAIL', true);
            $address = $this->input->post('ADDRESS', true);
            $gender = $this->input->post('GENDER', true);
            $password = $this->input->post('PASSWORD', true);
            $confirm_password = $this->input->post('CONFIRM_PASSWORD', true);

            if(!is_null($user_id) && !is_null($email)) {

                $this->load->model('user_model');
                $check_email_exists = $this->db->query('SELECT id FROM user WHERE email = "'.$email.'" AND id != '. $user_id);

                if($check_email_exists->num_rows() > 0) {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'EMAIL ALREADY EXISTS, PLEASE USE ANOTHER EMAIL';
                    $datapi['DATA'] = (object)array();
                } else {

                    $data_save = array(
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'address' => $address,
                        'gender' => $gender
                    );

                    if(!is_null($password) && !is_null($confirm_password)) {
                        if ($password != $confirm_password) {
                            $datapi['STATUS'] = 'FAILED';
                            $datapi['MESSAGE'] = 'PASSWORD AND CONFIRM PASSWORD NOT MATCH';
                            $datapi['DATA'] = (object)array();
                        } else {
                            $data_save['password'] = sha1($password);

                            if ($this->input->post('IMAGE')) {
                                $this->load->helper('string');
                                $custom_img_filename = random_string('alnum', 32).'.png';
                                $img_data = $this->input->post('IMAGE');
                                list($type, $img_data) = explode(';', $img_data);
                                list(, $img_data)      = explode(',', $img_data);
                                $img_data = base64_decode($img_data);
                                file_put_contents(path_image('photo_profile_path').'/' . $custom_img_filename, $img_data);
                                
                                $data_save['photo'] = $custom_img_filename;
                            }

                            $this->db->update('user', $data_save, array('id' => $user_id));

                            $data_return = array(
                                'NAME' => $name,
                                'EMAIL' => $email,
                                'PHONE' => $phone,
                                'ADDRESS' => $address,
                                'GENDER' => $gender,
                                'ID_LEVEL' => '3', //member
                                'STATUS' => '1', //active
                            );

                            if (isset($custom_img_filename)) {
                                $data_return['PHOTO'] = $custom_img_filename;
                                $data_return['PATH'] = path_image('photo_profile_path');
                            }

                            $user_data = $this->db->query('SELECT * FROM user WHERE id = ' . $user_id);
                            foreach ($user_data->row() as $key => $value) {
                                if ($key != 'password') {
                                    $newget[strtoupper($key)] = $value;
                                }
                            }
                            $newget['PATH'] = path_image('photo_profile_path');

                            $datapi['STATUS'] = 'SUCCESS';
                            $datapi['MESSAGE'] = 'UPDATE PROFILE SUCCESSFULLY';
                            $datapi['DATA'] = (object) $newget;
                        }
                    } else {

                        if ($this->input->post('IMAGE')) {
                            $this->load->helper('string');
                            $custom_img_filename = random_string('alnum', 32).'.png';
                            $img_data = $this->input->post('IMAGE');
                            list($type, $img_data) = explode(';', $img_data);
                            list(, $img_data)      = explode(',', $img_data);
                            $img_data = base64_decode($img_data);
                            file_put_contents(path_image('photo_profile_path').'/' . $custom_img_filename, $img_data);
                            
                            $data_save['photo'] = $custom_img_filename;
                            
                        }

                        $this->db->update('user', $data_save, array('id' => $user_id));

                        $data_return = array(
                            'NAME' => $name,
                            'EMAIL' => $email,
                            'PHONE' => $phone,
                            'ADDRESS' => $address,
                            'GENDER' => $gender,
                            'ID_LEVEL' => '3', //member
                            'STATUS' => '1', //active
                        );

                        if (isset($custom_img_filename)) {
                            $data_return['PHOTO'] = $custom_img_filename;
                            $data_return['PATH'] = path_image('photo_profile_path');
                        }

                        $user_data = $this->db->query('SELECT * FROM user WHERE id = ' . $user_id);
                        foreach ($user_data->row() as $key => $value) {
                            if ($key != 'password') {
                                $newget[strtoupper($key)] = $value;
                            }
                        }
                        $newget['PATH'] = path_image('photo_profile_path');
                        
                        $datapi['STATUS'] = 'SUCCESS';
                        $datapi['MESSAGE'] = 'UPDATE PROFILE SUCCESSFULLY';
                        $datapi['DATA'] = (object) $newget;
                    }

                }

            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT THE REQUIRED FIELDS';
                $datapi['DATA'] = (object)array();
            }

            
        } else {
            $datapi = $check;
        }

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function register() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $name = $this->input->post('NAME', true);
            $email = $this->input->post('EMAIL', true);
            $phone = $this->input->post('PHONE', true);
            $password = $this->input->post('PASSWORD', true);
            $confirm_password = $this->input->post('CONFIRM_PASSWORD', true);
            $accept_term_service = $this->input->post('ACCEPT_TERMS_SERVICE', true);
            $is_socmed = $this->input->post('IS_SOCMED', true);
            $image_url = $this->input->post('IMAGE_URL', true);
            //if(!is_null($name) && !is_null($email) && !is_null($phone)) {
            if(!is_null($email)) {
                if(!is_null($password) && !is_null($confirm_password)) {
                    if($password == $confirm_password) {
                        if(!is_null($accept_term_service)) {
                            $this->load->model('user_model');
                            $check_email_exists = $this->user_model->count(
                                array(
                                    'email' => $email
                                )
                            );

                            if($check_email_exists == 0) {
                                $data_save = array(
                                    'name' => $name,
                                    'email' => $email,
                                    'phone' => $phone,
                                    'password' => sha1($password),
                                    'id_level' => '3', //member
                                    'status' => '1', //active
                                    'created_at' => $this->now
                                );
                                $data_return = array(
                                    'name' => $name,
                                    'email' => $email,
                                    'phone' => $phone,
                                    'id_level' => '3', //member
                                    'status' => '1', //active
                                );
                                $this->user_model->save($data_save);
                                $datapi['STATUS'] = 'SUCCESS';
                                $datapi['MESSAGE'] = 'REGISTER SUCCESSFULLY';
                                $datapi['DATA'] = (object) $data_return;
                            } else {
                                $datapi['STATUS'] = 'FAILED';
                                $datapi['MESSAGE'] = 'EMAIL ALREADY EXISTS, PLEASE USE ANOTHER EMAIL';
                                $datapi['DATA'] = (object)array();
                            }
                        } else {
                            $datapi['STATUS'] = 'FAILED';
                            $datapi['MESSAGE'] = 'ACCEPT THE TERMS OF SERVICE MUST BE CHECKED';
                            $datapi['DATA'] = (object)array();
                        }
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'CONFIRM PASSWORD NOT MATCH WITH PASSWORD';
                        $datapi['DATA'] = (object)array();
                    }
                } else {
                    if(!is_null($is_socmed) && $is_socmed == 1) {

                        $query_check = $this->db->query("SELECT * FROM user WHERE email = '$email'");
                        if ($query_check->num_rows() > 0) {

                            $data_save = array(
                                'name' => $name,
                                'phone' => $phone,
                                'id_level' => '3', //member
                            );

                            if (!is_null($image_url) && $image_url != '') {
                                $data = file_get_contents($image_url);
                                $rename = $this->generateRandomString(32).'.jpg';
                                $fileName = path_image('photo_profile_path') . $rename;
                                $file = fopen($fileName, 'w+');
                                fputs($file, $data);
                                fclose($file);
                                $data_save['photo'] = $rename;
                            }

                            $this->db->update('user', $data_save, array('id' => $query_check->row()->id));

                            $data_return = array(
                                'id' => $query_check->row()->id,
                                'name' => $name,
                                'email' => $email,
                                'phone' => $phone,
                                'id_level' => '3', //member
                                'status' => '1', //active,
                                'photo' => isset($fileName) ? $fileName : '',
                            );
                            $datapi['STATUS'] = 'SUCCESS';
                            $datapi['MESSAGE'] = 'LOGIN SUCCESS';
                            $datapi['DATA'] = (object) $data_return;

                        } else {

                            // NEW USER REGISTER
                            $random_pass = $this->generateRandomString(8);
                            $data_save = array(
                                'name' => $name,
                                'email' => $email,
                                'phone' => $phone,
                                'password' => sha1($random_pass),
                                'id_level' => '3', //member
                                'status' => '1', //active
                                'created_at' => $this->now
                            );

                            if (!is_null($image_url) && $image_url != '') {
                                $data = file_get_contents($image_url);
                                $rename = $this->generateRandomString(32).'.jpg';
                                $fileName = path_image('photo_profile_path') . $rename;
                                $file = fopen($fileName, 'w+');
                                fputs($file, $data);
                                fclose($file);
                                $data_save['photo'] = $rename;
                            }

                            $this->user_model->save($data_save);

                            $data_return = array(
                                'id' => $this->db->insert_id(),
                                'name' => $name,
                                'email' => $email,
                                'phone' => $phone,
                                'id_level' => '3', //member
                                'status' => '1', //active,
                                'photo' => isset($fileName) ? $fileName : '',
                            );
                            $datapi['STATUS'] = 'SUCCESS';
                            $datapi['MESSAGE'] = 'LOGIN SUCCESS';
                            $datapi['DATA'] = (object) $data_return;

                        }

                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'PLEASE INPUT PASSWORD AND CONFIRM_PASSWORD';
                        $datapi['DATA'] = (object)array();
                    }
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT THE REQUIRED FIELDS';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_privacy_policy()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('privacy_policy_model');
            $get = $this->privacy_policy_model->all();
            if($get) {
                foreach($get as $key => $value) {
                    foreach($value as $childkey => $childvalue) {
                        $newget[$key][strtoupper($childkey)] = $childvalue;
                    }
                }
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'PRIVACY POLICY';
                $datapi['DATA'] = $newget;
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function subscribes() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $email = $this->input->post('EMAIL', true);
            if(!is_null($email)) {
                $this->load->model('subscriber_model');
                $check_email_exists = $this->subscriber_model->count(
                    array('email' => $email)
                );

                if($check_email_exists == 0) {
                    $data_save = array('email' => $email, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'));
                    $this->subscriber_model->save($data_save);
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'REGISTER SUCCESSFULLY';
                    $datapi['DATA'] = (object)array();
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'EMAIL ALREADY EXISTS, PLEASE USE ANOTHER EMAIL';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT EMAIL ADDRESS';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_size_guide_view($slug = null)
    {
        $data['product_category'] = get_data_curl(base_url('api/product/get_list_product_category'));
        $data['slug'] = $slug;
        if(!is_null($slug)) {
            $this->load->model('product_category_model');
            $get = $this->product_category_model->first(
                array(
                    'slug' => $slug
                )
            );
            if ($get) {
                $where = array('CATEGORY_ID' => $get->id);
            } else {
                $where = null;
            }
        } else {
            $this->load->model('product_category_model');
            $get = $this->product_category_model->first(null, false);
            if($get) {
                $where = array('CATEGORY_ID' => $get->id);
            } else {
                $where = null;
            }
        }
        $data['guide'] = get_data_curl(base_url('api/general/get_guide'), $where);
        $this->load->view('template/size_guide_view', $data);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
