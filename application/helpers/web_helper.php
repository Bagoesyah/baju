<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T13:37:29+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T19:45:09+07:00

function profile_photo($id = null)
{
    $ci = &get_instance();
    if ($id == null) {
        $id = $ci->_user_login->id;
    }
    $ci->load->model('user_model');
    $photo = $ci->user_model->first(
        array(
            'id' => $id
        )
        )->photo;
        if ($photo != null) {
            return base_url($ci->config->item('photo_profile_path') . $photo);
        }
        return base_url('assets/img/user.png');
    }

    function to_date_format($datetime, $to = 'M d, Y')
    {
        $format = date_format(date_create($datetime), $to);
        return $format;
    }

    function thumb_name($filename)
    {
        $extension_pos = strrpos($filename, '.'); // find position of the last dot, so where the extension starts
        $thumb = substr($filename, 0, $extension_pos) . '_thumb' . substr($filename, $extension_pos);
        return $thumb;
    }

    function generate_slug($field, $model, $id = null)
    {
        $ci = &get_instance();
        $get = $ci->{$model}->first($id);
        $created_at = $get->created_at;
        $slug = url_title(strtolower($ci->input->post($field, true)) . '-' . to_date_format($created_at, 'His'));
        $data_update = array(
            'slug' => $slug
        );
        $ci->{$model}->edit($get->id, $data_update);
    }

    function insert_log_activity($id_user, $activity)
    {
        $ci = &get_instance();
        $now = date('Y-m-d H:i:s');
        $ci->load->model('log_activity_model');
        $data = array(
            'id_user' => $id_user,
            'ip_address' => $ci->input->ip_address(),
            'activity' => $activity,
            'created_at' => $now
        );
        $ci->log_activity_model->save($data);
    }

    function error_upload_message($edit_url = null, $error = null) {
        if(!is_null($edit_url) && !is_null($error)) {
            $ci = &get_instance();
            $ci->session->set_flashdata('message', array('message' => $error, 'class' => 'alert-danger'));
            redirect($edit_url);
        }
        return false;
    }

    function unlink_file($location = null) {
        if(!is_null($location)) {
            if(!is_dir($location)) {
                if (is_file($location)) {
                    unlink($location);
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    function path_image($config = null) {
        if(!is_null($config)) {
            $ci = &get_instance();
            return $ci->config->item($config);
        }
        return false;
    }

    function format_currency($number = 0) {
        return 'Rp. ' . number_format($number, 0, ",", ".");
    }

    function get_price_promo($price,$disc,$precent=true)
    {
        if($precent){
            $result = $price - ($disc/100*$price);
        }else{
            $result = $price - $disc;
        }
        return $result;
    }

    function get_data_curl($url, $post = null, $get_headers = null) {
        if($ch = curl_init($url)) {
            $ci = &get_instance();
            $ci->load->model('app_token_model');
            $app_token = $ci->app_token_model->first();
            if($app_token) {
                $headers = array(
                    "APP_TOKEN: {$app_token->app_token}"
                );
                if(!is_null($get_headers)) {
                    array_push($headers, "USER_TOKEN: {$get_headers['USER_TOKEN']}");
                }
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                if(!is_null($post)) {
                    $fields = is_array($post) ? http_build_query($post) : $post;
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                }
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $json = curl_exec($ch);
                curl_close($ch);
                return json_decode($json);
            }
        } else {
            return false;
        }
    }

    function get_session($name = null) {
        $ci = &get_instance();
        return $ci->session->userdata($name);
    }

    function set_session($arr) {
        $ci = &get_instance();
        return $ci->session->set_userdata($arr);
    }

    function generate_order_number() {
        $ci = &get_instance();
        $ci->load->helper('string');
        $order_number = random_string('alnum', 8);
        $order_number = strtoupper($order_number);
        return $order_number;
    }

    function create_folder($path) {
        $oldmask = umask(0);
        $create = mkdir($path, 0777, true);
        umask($oldmask);
    }

    function get_app_token() {
        $ci = &get_instance();
        $ci->load->model('app_token_model');
        $app_token = $ci->app_token_model->first();
        if($app_token) {
            $app_token = $app_token->app_token;
        } else {
            $app_token = '';
        }
        return $app_token;
    }

    function encrypt_text($text) {
        $ci = &get_instance();
        return str_replace(array('+', '/', '='), array('-', '_', '~'), $ci->encryption->encrypt($text));
    }

    function decrypt_text($text) {
        $ci = &get_instance();
        return $ci->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $text));
    }
