<?php
# @Author: Awan Tengah
# @Date:   2017-02-22T22:13:05+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-07T19:00:28+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function get_member($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('user_model');
            $this->load->model('level_model');
            $this->load->model('user_category_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->user_model->first($id);
                    if($get) {
                        $get->STATUS_TEXT = $get->status == '1' ? 'Active' : ($get->status == '2' ? 'Non Active' : null);
                        $get->GENDER_TEXT = $get->gender == '1' ? 'Male' : ($get->gender == '2' ? 'Female' : null);
                        $get->NOTIFICATION_TEXT = $get->notification == '0' ? 'OFF' : ($get->notification == '1' ? 'ON' : null);
                        $get_level = $this->level_model->first($get->id_level);
                        $get->LEVEL_TEXT = $get_level ? $get_level->title : null;
                        $get_user_category = $this->user_category_model->first($get->id_user_category);
                        $get->USER_CATEGORY_TEXT = $get_user_category ? $get_user_category->title : null;
                        foreach($get as $key => $value) {
                            $newget[strtoupper($key)] = $value;
                        }
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'PARAMETER MUST NUMERIC';
                    $datapi['DATA'] = (object)array();
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($datapi));
                }
            } else {
                $get = $this->user_model->all(
                    array(
                        'fields' => "user.*, if(user.notification = 0 , 'OFF', if(user.notification = 1, 'ON', null)) as notification_text,
                        if(user.gender = 1, 'Male', if(user.gender = 2, 'Female', null)) as gender_text, level.title as level, user_category.title as user_category_text,
                        if(user.status = 1, 'Active', if(user.status = 2, 'Non Active', null)) as status_text",
                        'left_join' => array(
                            'level' => 'level.id = user.id_level',
                            'user_category' => 'user_category.id = user.id_user_category'
                        )
                    )
                );
                if($get) {
                    foreach($get as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                        }
                    }
                }
            }
            if($get) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'MEMBER LIST';
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

    public function get_member_category($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('user_category_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->user_category_model->first($id);
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'PARAMETER MUST NUMERIC';
                    $datapi['DATA'] = (object)array();
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($datapi));
                }
            } else {
                $get = $this->user_category_model->all();
            }
            if($get) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'MEMBER CATEGORY LIST';
                $datapi['DATA'] = $get;
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

    public function edit_profile() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('user_model');
            $get_id_user = $this->input->post('ID_USER', true);
            if(!is_null($get_id_user)) {
                $checking_user = $this->user_model->count(
                    array(
                        'id' => $get_id_user,
                        'user_token' => $headers['USER_TOKEN'],
                    )
                );
                if($checking_user == 1) {
                    $get_gender = $this->input->post('GENDER', true);
                    $gender = $get_gender == 'MALE' ? '1' : ($get_gender == 'FEMALE' ? '2' : '');
                    $get_email = $this->input->post('EMAIL', true);
                    if(!is_null($get_email) && !empty($get_email)) {
                        $data = array(
                            'name' => $this->input->post('NAME', true),
                            'email' => $get_email,
                            'phone' => $this->input->post('PHONE', true),
                            'address' => $this->input->post('ADDRESS', true),
                            'gender' => $gender,
                            'updated_at' => $this->now
                        );
                        $this->user_model->edit($get_id_user, $data);

                        $datapi['STATUS'] = 'SUCCESS';
                        $datapi['MESSAGE'] = 'PROFILE UPDATED';
                        $datapi['DATA'] = (object)array();
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'EMAIL CANNOT BE EMPTY';
                        $datapi['DATA'] = (object)array();
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'YOUR SESSION IS EXPIRED. PLEASE RE-LOGIN';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_USER';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function change_password() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('user_model');
            $get_id_user = $this->input->post('ID_USER', true);
            if(!is_null($get_id_user)) {
                $checking_user = $this->user_model->count(
                    array(
                        'id' => $get_id_user,
                        'user_token' => $headers['USER_TOKEN'],
                    )
                );
                if($checking_user == 1) {
                    $recent_password = $this->input->post('RECENT_PASSWORD', true);
                    $new_password = $this->input->post('NEW_PASSWORD', true);
                    $confirm_password = $this->input->post('CONFIRM_PASSWORD', true);
                    // Updated 22/05/17 - Andre
                    // Remove recent password based on apps journey
                    // Request by Mas Khairul
                    //if(!empty($recent_password) && !empty($new_password) && !empty($confirm_password)) {
                    if(!empty($new_password) && !empty($confirm_password)) {
                        /*
                        $check_resent_password = $this->user_model->count(
                            array(
                                'id' => $get_id_user,
                                'password' => sha1($recent_password),
                                'user_token' => $headers['USER_TOKEN'],
                            )
                        );
                        */
                        $check_resent_password = 1;
                        if($check_resent_password == 1) {
                            if($new_password === $confirm_password) {
                                $data = array(
                                    'password' => sha1($new_password),
                                    'updated_at' => $this->now
                                );
                                $this->user_model->edit($get_id_user, $data);

                                $datapi['STATUS'] = 'SUCCESS';
                                $datapi['MESSAGE'] = 'PASSWORD HAS BEEN CHANGED';
                                $datapi['DATA'] = (object)array();
                            } else {
                                $datapi['STATUS'] = 'FAILED';
                                $datapi['MESSAGE'] = 'CONFIRM PASSWORD NOT MATCH WITH NEW PASSWORD';
                                $datapi['DATA'] = (object)array();
                            }
                        } else {
                            $datapi['STATUS'] = 'FAILED';
                            $datapi['MESSAGE'] = 'YOUR RECENT PASSWORD NOT RIGHT';
                            $datapi['DATA'] = (object)array();
                        }
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'PLEASE INPUT THE REQUIRED FIELDS';
                        $datapi['DATA'] = (object)array();
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'YOUR SESSION IS EXPIRED. PLEASE RE-LOGIN';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_USER';
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
