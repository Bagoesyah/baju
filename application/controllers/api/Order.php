<?php
# @Author: Awan Tengah
# @Date:   2017-02-26T22:09:09+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-03T13:47:35+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function insert_update_order_shipping() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('order_shipping_model');
            $get_id_user = $this->input->post('ID_USER', true);
            if(!is_null($get_id_user)) {
                $check = $this->order_shipping_model->first(
                    array(
                        'id_user' => $get_id_user
                    )
                );
                $data = array(
                    'id_user' => $get_id_user,
                    'name' => $this->input->post('NAME', true),
                    'address' => $this->input->post('ADDRESS', true),
                    'hp' => $this->input->post('HP', true),
                    'email' => $this->input->post('EMAIL', true),
                    'city' => $this->input->post('CITY', true),
                    'phone' => $this->input->post('PHONE', true),
                    'zip_code' => $this->input->post('ZIP_CODE', true)
                );
                if($check) {
                    $data['updated_at'] = $this->now;
                    $datapi['MESSAGE'] = 'ORDER SHIPPING UPDATED';
                    $this->order_shipping_model->edit($check->id, $data);
                    $shipping_id = $check->id;
                } else {
                    $data['created_at'] = $this->now;
                    $datapi['MESSAGE'] = 'ORDER SHIPPING SAVED';
                    $this->order_shipping_model->save($data);
                    $shipping_id = $this->db->insert_id();
                }

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['DATA'] = (object) array(
                    'SHIPPING_ID' => $shipping_id
                );
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

    public function get_order_shipping() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('order_shipping_model');
            $get_id_user = $this->input->post('ID_USER', true);
            if(!is_null($get_id_user)) {
                $get = $this->order_shipping_model->first(
                    array(
                        'id_user' => $get_id_user
                    )
                );
                if($get) {
                    foreach($get as $key => $value) {
                        $newget[strtoupper($key)] = $value;
                    }
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'ORDER SHIPPING';
                    $datapi['DATA'] = $newget;
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
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

    public function insert_custom_product() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('custom_product_model');
            $get_id_user = $this->input->post('ID_USER', true);
            if(!is_null($get_id_user)) {
                $check = $this->custom_product_model->first(
                    array(
                        'id_user' => $get_id_user
                    )
                );

                // Working on image
                $custom_img_filename = '';
                $device_type = $this->input->post('DEVICE_TYPE');
                if ($this->input->post('IMAGE_CUSTOM') && $this->input->post('IMAGE_CUSTOM') != '') {
                    $this->load->helper('string');
                    $custom_img_filename = random_string('alnum', 32).'.png';
                    $img_data = $this->input->post('IMAGE_CUSTOM');
                    list($type, $img_data) = explode(';', $img_data);
                    list(, $img_data)      = explode(',', $img_data);
                    $img_data = base64_decode($img_data);
                    file_put_contents('assets/img/img_order/' . $custom_img_filename, $img_data);

                    if (is_null($device_type) || $device_type == '0') {
                        $config['source_image'] = 'assets/img/img_order/' . $custom_img_filename;
                        $config['x_axis'] = 140;
                        $config['y_axis'] = 0;
                        $config['width'] = 412;
                        $config['height'] = 569;
                        $config['maintain_ratio'] = FALSE;

                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config);
                        $this->image_lib->crop();
                    }
                }

                $data = array(
                    'id_user' => $get_id_user,
                    'id_fabric' => $this->input->post('ID_FABRIC', true),
                    'id_collar' => $this->input->post('ID_COLLAR', true),
                    'id_cuff' => $this->input->post('ID_CUFF', true),
                    'id_sleeve' => $this->input->post('ID_SLEEVE', true),
                    'id_body_type_front' => $this->input->post('ID_BODY_TYPE_FRONT', true),
                    'id_body_type_back' => $this->input->post('ID_BODY_TYPE_BACK', true),
                    'id_body_type_hem' => $this->input->post('ID_BODY_TYPE_HEM', true),
                    'id_pocket' => $this->input->post('ID_POCKET', true),
                    'id_button' => $this->input->post('ID_BUTTON', true),
                    'id_button_hole' => $this->input->post('ID_BUTTON_HOLE', true),
                    'id_button_thread' => $this->input->post('ID_BUTTON_THREAD', true),
                    'id_embroidery_position' => $this->input->post('ID_EMBROIDERY_POSITION', true),
                    'id_embroidery_font' => $this->input->post('ID_EMBROIDERY_FONT', true),
                    'id_embroidery_color' => $this->input->post('ID_EMBROIDERY_COLOR', true),
                    'id_option_amf_stitch' => $this->input->post('ID_OPTION_AMF_STITCH', true),
                    'id_option_interlining' => $this->input->post('ID_OPTION_INTERLINING', true),
                    'id_option_sewing' => $this->input->post('ID_OPTION_SEWING', true),
                    'id_option_tape' => $this->input->post('ID_OPTION_TAPE', true),

                    'embroidery_text' => $this->input->post('EMBROIDERY_TEXT', true),
                    'image_custom' => $custom_img_filename,

                    'cleric_type' => $this->input->post('CLERIC_TYPE', true),
                    'id_cleric' => $this->input->post('ID_CLERIC', true),
                    //'id_cleric_1' => $this->input->post('ID_CLERIC_1', true),
                    //'id_cleric_2' => $this->input->post('ID_CLERIC_2', true),
                    //'id_cleric_3' => $this->input->post('ID_CLERIC_3', true),

                    'image' => $this->input->post('IMAGE', true),
                    'price' => $this->input->post('PRICE', true),
                    'special_request_custom' => $this->input->post('SPECIAL_REQUEST_CUSTOM', true),
                    'special_request_size' => $this->input->post('SPECIAL_REQUEST_SIZE', true),
                    'special_request_verify' => $this->input->post('SPECIAL_REQUEST_VERIFY', true),
                    'quantity' => $this->input->post('QUANTITY', true),
                    'sess_price' => $this->input->post('SESS_PRICE', true),
                );
                // if($check) {
                //     $data['updated_at'] = $this->now;
                //     $datapi['MESSAGE'] = 'CUSTOM PRODUCT UPDATED';
                //     $this->custom_product_model->edit($check->id, $data);
                // } else {
                $data['created_at'] = $this->now;
                $datapi['MESSAGE'] = 'CUSTOM PRODUCT SAVED';
                $last_id = $this->custom_product_model->save($data);
                // }

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['DATA'] = array(
                    'ID_CUSTOM_PRODUCT' => $last_id
                );
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

    public function get_custom_product() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('custom_product_model');
            $get_id_custom_product = $this->input->post('ID_CUSTOM_PRODUCT', true);
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function insert_order_product() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('log_order_product_model');
            $this->load->model('order_product_model');
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_type = $this->input->post('ORDER_TYPE', true);
            if(!is_null($get_id_user)) {
                $data = array(
                    'id_user' => $get_id_user,
                    'order_number' => $this->input->post('ORDER_NUMBER', true),
                    'order_type' => $get_order_type,
                    'id_custom_product' => $this->input->post('ID_CUSTOM_PRODUCT', true),
                    'id_product' => $this->input->post('ID_PRODUCT', true),
                    'base' => floor($this->input->post('BASE', true)),
                    'option' => floor($this->input->post('OPTION', true)),
                    'tax' => floor($this->input->post('TAX', true)),
                    'status' => $this->input->post('STATUS', true),
                    'repeat_order' => $this->input->post('REPEAT_ORDER', true) ? $this->input->post('REPEAT_ORDER', true) : 0,
                    'created_at' => $this->now
                );
                $id_order_product = $this->order_product_model->save($data);

                $data_log = array(
                    'id_order_product' => $id_order_product,
                    'status' => $this->input->post('STATUS', true),
                    'created_at' => $this->now
                );
                $this->log_order_product_model->save($data_log);

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'ORDER PRODUCT SAVED';
                $datapi['DATA'] = (object)array();
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

    public function update_order_product_by_id() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('log_order_product_model');
            $this->load->model('order_product_model');
            $id_order_product = $this->input->post('ID_ORDER_PRODUCT', true);
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_type = $this->input->post('ORDER_TYPE', true);
            if(!is_null($id_order_product)) {
                if(!is_null($get_id_user)) {
                    $data = array(
                        'id_user' => $get_id_user,
                        'order_number' => $this->input->post('ORDER_NUMBER', true),
                        'order_type' => $get_order_type,
                        'id_custom_product' => $this->input->post('ID_CUSTOM_PRODUCT', true),
                        'status' => $this->input->post('STATUS', true),
                        'updated_at' => $this->now
                    );
                    $this->order_product_model->edit($id_order_product, $data);

                    $data_log = array(
                        'id_order_product' => $id_order_product,
                        'status' => $this->input->post('STATUS', true),
                        'created_at' => $this->now
                    );
                    $this->log_order_product_model->save($data_log);

                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'ORDER PRODUCT UPDATED';
                    $datapi['DATA'] = (object)array();
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'PLEASE INPUT ID_USER';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'ID_ORDER_PRODUCT REQUIRED';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function update_order_product_by_id_with_price() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('log_order_product_model');
            $this->load->model('order_product_model');
            $id_order_product = $this->input->post('ID_ORDER_PRODUCT', true);
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_type = $this->input->post('ORDER_TYPE', true);
            if(!is_null($id_order_product)) {
                if(!is_null($get_id_user)) {
                    $data = array(
                        'id_user' => $get_id_user,
                        'order_number' => $this->input->post('ORDER_NUMBER', true),
                        'order_type' => $get_order_type,
                        'id_custom_product' => $this->input->post('ID_CUSTOM_PRODUCT', true),
                        'base' => floor($this->input->post('BASE', true)),
                        'option' => floor($this->input->post('OPTION', true)),
                        'delivery_cost' => $this->input->post('DELIVERY_COST', true),
                        'tax' => floor($this->input->post('TAX', true)),
                        'arrival_date' => $this->input->post('ARRIVAL_DATE', true),
                        'status' => $this->input->post('STATUS', true),
                        'updated_at' => $this->now
                    );
                    $this->order_product_model->edit($id_order_product, $data);

                    $data_log = array(
                        'id_order_product' => $id_order_product,
                        'status' => $this->input->post('STATUS', true),
                        'created_at' => $this->now
                    );
                    $this->log_order_product_model->save($data_log);

                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'ORDER PRODUCT UPDATED';
                    $datapi['DATA'] = (object)array();
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'PLEASE INPUT ID_USER';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'ID_ORDER_PRODUCT REQUIRED';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function update_order_product_by_order_number() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('log_order_product_model');
            $this->load->model('order_product_model');
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_number = $this->input->post('ORDER_NUMBER', true);
            $get_order_type = $this->input->post('ORDER_TYPE', true);
            $get_status = $this->input->post('STATUS', true);
            if(!is_null($get_order_number)) {
                if (!is_null($get_id_user)) {
                    $data['id_user'] = $get_id_user;
                }
                if (!is_null($get_order_type)) {
                    $data['order_type'] = $get_order_type;
                }
                if (!is_null($get_status)) {
                    $data['status'] = $get_status;
                }
                $data['updated_at'] = $this->now;

                if ($this->input->post('BASE', true)) {
                    $data['base'] = $this->input->post('BASE', true);
                }

                if ($this->input->post('OPTION', true)) {
                    $data['option'] = $this->input->post('OPTION', true);
                }

                if ($this->input->post('TAX', true)) {
                    $data['tax'] = $this->input->post('TAX', true);
                }

                if ($this->input->post('STATUS', true)) {
                    $data['status'] = $this->input->post('STATUS', true);
                }

                /*
                $data = array(
                    'id_user' => $get_id_user,
                    'order_number' => $get_order_number,
                    'order_type' => $get_order_type,
                    'status' => $get_status,
                    'updated_at' => $this->now
                );
                */
                $update = $this->order_product_model->edit_by_order_number($get_order_number, $data);

                if ($update || $this->input->post('QTY', true)) {
                    if ($this->input->post('QTY', true)) {
                        $data_custom['quantity'] = $this->input->post('QTY', true);
                    }
                    if ($this->input->post('PRICE', true)) {
                        $data_custom['price'] = $this->input->post('PRICE', true);
                    }

                    if (isset($data_custom)) {
                        $this->db->update('custom_product', $data_custom, array('id' => $this->input->post('ID_CUSTOM_PRODUCT', true)));
                    }
                }

                $get_by_order_number = $this->order_product_model->all(
                    array(
                        'where' => array(
                            'id_user' => $get_id_user,
                            'order_number' => $get_order_number,
                            'status' => $get_status
                        )
                    )
                );

                if($get_by_order_number) {
                    foreach($get_by_order_number as $row) {
                        $data_log = array(
                            'id_order_product' => $row->id,
                            'status' => $get_status,
                            'created_at' => $this->now
                        );
                        $this->log_order_product_model->save($data_log);
                    }
                }

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'ORDER PRODUCT UPDATED';
                $datapi['DATA'] = (object)array();
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

    public function get_order_product() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('order_product_model');
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_status = $this->input->post('ORDER_STATUS', true);
            $get_order_type = $this->input->post('ORDER_TYPE', true);
            $get_order_number = $this->input->post('ORDER_NUMBER', true);
            $get_template_cart_list = $this->input->post('TEMPLATE_CART_LIST', true);
            $get_history = $this->input->post('HISTORY', true);
            if(!is_null($get_id_user)) {
                if(!is_null($get_order_status) && is_null($get_order_number)) {
                    $where = array(
                        'order_product.id_user' => $get_id_user,
                        'order_product.status' => $get_order_status
                    );
                } else if(!is_null($get_order_number) && is_null($get_order_status)) {
                    $where = array(
                        'order_product.id_user' => $get_id_user,
                        'order_product.order_number' => $get_order_number
                    );
                } else if(!is_null($get_order_number) && !is_null($get_order_status)) {
                    $where = array(
                        'order_product.id_user' => $get_id_user,
                        'order_product.order_number' => $get_order_number,
                        'order_product.status' => $get_order_status
                    );
                } else {
                    $where = array(
                        'order_product.id_user' => $get_id_user
                    );
                }

                if (!is_null($get_order_type)) {
                    $where['order_product.order_type'] = $get_order_type;
                }

                // COMPLETE STATUS FOR HISTORY (10)
                if (!is_null($get_history) && $get_history == 1) {
                    $where['order_product.status'] = 10;
                } else {
                    $where['order_product.status !='] = 10;
                }

                $get = $this->order_product_model->all(
                    array(
                        'fields' => "order_product.*, user.user_token, custom_product.image, custom_product.image_custom, custom_product.price as custom_price, custom_product.quantity, order_product_status.title as status_text, if(order_product.order_type = '1', 'product', if(order_product.order_type = 2, 'custom', '-')) as order_type_text, material_fabric.price as price_fabric",
                        'left_join' => array(
                            'custom_product' => 'custom_product.id = order_product.id_custom_product',
                            'order_product_status' => 'order_product_status.id = order_product.status',
                            'material_fabric' => 'material_fabric.id = custom_product.id_fabric',
                            'user' => 'user.id = order_product.id_user'
                        ),
                        'where' => $where,
                        'order_by' => 'order_product.id DESC'
                    )
                );

                if($get) {
                    foreach($get as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                            $newget[$key]['PATH'] = path_image('product_image_path');
                        }
                    }

                    if(!is_null($get_template_cart_list)) {
                        $data['order_product_on_cart'] = json_decode(json_encode($newget));
                        $price_total = 0;
                        $sub_total = 0;
                        $option_total = 0;
                        $tax_total = 0;
                        foreach($data['order_product_on_cart'] as $row) {
                            $price_total += (floor($row->BASE) + floor($row->OPTION) + floor($row->TAX));
                            $sub_total += (floor($row->BASE));
                            $option_total += floor($row->OPTION);
                            $tax_total += floor($row->TAX);
                        }
                        // Check for any coupon applied
                        $c_order_number = ($get_order_number) ? $get_order_number : get_session('last_order_number');
                        $q_coupon = $this->db->query("
                            SELECT * FROM order_product_coupon WHERE order_number = '$c_order_number'
                        ");
                        if ($q_coupon->num_rows() > 0) {
                            $row_coupon = $q_coupon->row();
                            $datapi['COUPON'] = (object) array(
                                'coupon_code' => $row_coupon->coupon_code,
                                'coupon_discount' => ($row_coupon->coupon_type == 'v') ? '- '.format_currency($row_coupon->coupon_discount) : '- '.$row_coupon->coupon_discount.' %',
                                'coupon_type' => $row_coupon->coupon_type
                            );
                            if ($row_coupon->coupon_type == 'v') {
                                $price_total = floor($price_total - $row_coupon->coupon_discount);
                                if ($price_total < 0) $price_total = 0;
                            } else {
                                $disc = ($price_total * $row_coupon->coupon_discount) / 100;
                                $price_total = floor($price_total - $disc);
                            }
                        }

                        $price_total = format_currency($price_total);
                        $sub_total = format_currency($sub_total);
                        $option_total = format_currency($option_total);
                        $tax_total = format_currency($tax_total);

                        $template = $this->load->view('template/frontend/_cart_list', $data, true);
                        $datapi['STATUS'] = 'SUCCESS';
                        $datapi['MESSAGE'] = 'ORDER PRODUCT LIST';
                        $datapi['DATA'] = array(
                            'TEMPLATE' => $template,
                            'SUB_TOTAL_CART' => $sub_total,
                            'OPTION_TOTAL_CART' => $option_total,
                            'TAX_TOTAL_CART' => $tax_total,
                            'PRICE_TOTAL_CART' => $price_total
                        );
                    } else {
                        $datapi['STATUS'] = 'SUCCESS';
                        $datapi['MESSAGE'] = 'ORDER PRODUCT LIST';
                        $datapi['DATA'] = $newget;
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
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

    public function save_to_session() {
        $type = $this->input->post('type', true);
        $value = $this->input->post('value', true);
        $skin = $this->input->post('skin', true);
        $src = $this->input->post('src', true);

        if ($skin == 'skin_id_collar') {
            if (!is_file('assets/img/upload/material_fabric/' . $src)) {
                $src = get_session('skin_id_fabric');
            }
        }

        if ($this->input->post('collar_button')) {
            $this->session->set_userdata($this->input->post('collar_button'));
        }

        $set_session = $this->session->set_userdata(array($type => $value, $skin => $src));

        if ($this->input->post('id_object') && $this->input->post('id_object') != '' && $this->input->post('id_object') != null) {
            $_SESSION['obj_' . $this->input->post('type', true)] = $this->input->post('id_object');
        } else {
            if ($this->input->post('type', true) == 'id_pocket') {
                $this->session->unset_userdata('obj_id_pocket');
            }
        }

        if ($type == 'id_sleeve') {
            // Unset Cuffs
            $this->session->unset_userdata('id_cuff');
            $this->session->unset_userdata('price_id_cuff');
            $this->session->unset_userdata('skin_id_cuff');

            // Reset Cleric
            $this->session->unset_userdata('skin_id_collar_cuff');
            $this->session->unset_userdata('skin_id_collar_cuff_front_placket');
            $this->session->unset_userdata('skin_id_inner_collar_cuff');
            $this->session->unset_userdata('skin_id_inner_collar_cuff_lower_placket');
            $this->session->unset_userdata('cleric_type');
            $this->session->unset_userdata('id_cleric');
            $this->session->unset_userdata('cleric_type_id');

        } else if ($type == 'id_cuff') {
            // Unset Sleeve
            $this->session->unset_userdata('id_sleeve');
            $this->session->unset_userdata('price_id_sleeve');
            $this->session->unset_userdata('skin_id_sleeve');
            $this->session->unset_userdata('obj_id_sleeve');
            
            // Reset Cleric
            $this->session->unset_userdata('skin_id_collar_cuff');
            $this->session->unset_userdata('skin_id_collar_cuff_front_placket');
            $this->session->unset_userdata('skin_id_inner_collar_cuff');
            $this->session->unset_userdata('skin_id_inner_collar_cuff_lower_placket');
            $this->session->unset_userdata('cleric_type');
            $this->session->unset_userdata('id_cleric');
            $this->session->unset_userdata('cleric_type_id');
            
        } else if ($type == 'price_id_fabric' && $this->input->post('src')) {
            $this->session->set_userdata('skin_id_sleeve', $this->input->post('src'));
            $this->session->set_userdata('skin_id_pocket', $this->input->post('src'));
            $this->session->set_userdata('skin_id_collar', $this->input->post('src'));

            // Reset Cleric
            $this->session->unset_userdata('skin_id_collar_cuff');
            $this->session->unset_userdata('skin_id_collar_cuff_front_placket');
            $this->session->unset_userdata('skin_id_inner_collar_cuff');
            $this->session->unset_userdata('skin_id_inner_collar_cuff_lower_placket');
            $this->session->unset_userdata('cleric_type');
            $this->session->unset_userdata('id_cleric');
            $this->session->unset_userdata('cleric_type_id');

        } else if ($type == 'price_id_cleric') {

            $this->session->unset_userdata('skin_id_collar_cuff');
            $this->session->unset_userdata('skin_id_collar_cuff_front_placket');
            $this->session->unset_userdata('skin_id_inner_collar_cuff');
            $this->session->unset_userdata('skin_id_inner_collar_cuff_lower_placket');
            $this->session->unset_userdata('cleric_type_id');

            $this->session->set_userdata($skin, $this->input->post('src'));
            if ($skin == 'skin_id_collar_cuff') {
                $cleric_type_id = 1;
                $this->session->set_userdata('cleric_type_id', 1);
            } else if ($skin == 'skin_id_collar_cuff_front_placket') {
                $cleric_type_id = 2;
                $this->session->set_userdata('cleric_type_id', 2);
            } else if ($skin == 'skin_id_inner_collar_cuff') {
                $cleric_type_id = 3;
                $this->session->set_userdata('cleric_type_id', 3);
            } else if ($skin == 'skin_id_inner_collar_cuff_lower_placket') {
                $cleric_type_id = 4;
                $this->session->set_userdata('cleric_type_id', 4);
            }

            if (isset($cleric_type_id)) {
                $q = $this->db->query("SELECT additional_price FROM material_cleric_category WHERE id = $cleric_type_id");
                if ($q->num_rows() > 0) {
                    $this->session->set_userdata('price_id_cleric', $q->row()->additional_price);
                }
            }
        }

        if($set_session) {
            return true;
        }
        return false;
    }

    public function unset_session() {
        $type = $this->input->post('type', true);
        $unset_session = $this->session->unset_userdata($type);
        if($unset_session) {
            return true;
        }
        return false;
    }

    public function get_session($session) {
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(get_session($session)));
    }

    public function get_sum_price_material_custom() {
        $arr_main_array = get_session();
        $arr_result = array();
        foreach($arr_main_array as $key => $value) {
            $exp_key = explode('_', $key);
            if($exp_key[0] == 'price'){
                $arr_result[] = $value;
            }
        }

        if(!is_null($arr_result)) {
            $arr_sum = format_currency(array_sum($arr_result));
        } else {
            $arr_sum = 0;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($arr_sum));
    }

    public function get_detail_order_custom_history() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $id_custom_product = $this->input->POST('ID_CUSTOM_PRODUCT', true);
            $template = $this->input->POST('TEMPLATE', true);
            if(!is_null($id_custom_product)) {
                $data = array();
                $this->load->model('order_product_model');
                $get = $this->order_product_model->all(
                    array(
                        'fields' => "order_product.*, user.user_token, order_product_status.title as status_text, custom_product.price as custom_price, material_fabric.title as fabric_title, material_fabric.code_fabric as fabric_code,
                        material_collar.title as collar_title, material_cuff.title as cuff_title,
                        (SELECT material_body_type.title FROM material_body_type WHERE material_body_type.id = custom_product.id_body_type_front) AS body_type_front_title,
                        (SELECT material_body_type.title FROM material_body_type WHERE material_body_type.id = custom_product.id_body_type_back) AS body_type_back_title,
                        (SELECT material_body_type.title FROM material_body_type WHERE material_body_type.id = custom_product.id_body_type_hem) AS body_type_hem_title,
                        material_pocket.title as pocket_title,
                        (SELECT material_buttons.title FROM material_buttons WHERE material_buttons.id = custom_product.id_button) AS button_title,
                        (SELECT material_buttons.title FROM material_buttons WHERE material_buttons.id = custom_product.id_button_hole) AS button_hole_title,
                        (SELECT material_buttons.title FROM material_buttons WHERE material_buttons.id = custom_product.id_button_thread) AS button_thread_title,
                        (SELECT material_embroidery.title FROM material_embroidery WHERE material_embroidery.id = custom_product.id_embroidery_position) AS embroidery_position_title,
                        (SELECT material_embroidery.title FROM material_embroidery WHERE material_embroidery.id = custom_product.id_embroidery_font) AS embroidery_font_title,
                        (SELECT material_embroidery.title FROM material_embroidery WHERE material_embroidery.id = custom_product.id_embroidery_color) AS embroidery_color_title,
                        (SELECT material_option.title FROM material_option WHERE material_option.id = custom_product.id_option_amf_stitch) AS option_amf_stitch_title,
                        (SELECT material_option.title FROM material_option WHERE material_option.id = custom_product.id_option_interlining) AS option_interlining_title,
                        (SELECT material_option.title FROM material_option WHERE material_option.id = custom_product.id_option_sewing) AS option_sewing_title,
                        (SELECT material_option.title FROM material_option WHERE material_option.id = custom_product.id_option_tape) AS option_tape_title,
                        custom_product.special_request_size, custom_product.special_request_verify,
                        custom_product_size.neck, custom_product_size.shoulder, custom_product_size.chest, custom_product_size.waist, custom_product_size.hip, custom_product_size.arm_hole,
                        custom_product_size.back_length_88, custom_product_size.back_length_89, custom_product_size.aloha_88, custom_product_size.aloha_89, custom_product_size.cuffs_circle,
                        custom_product_size.short_sleeve, custom_product_size.sleeve_circle,
                        custom_product_size.around_neck_selection,custom_product_size.body_type_selection,custom_product_size.sleeve_type_selection,
                        custom_product_size.sleeve_length_right_selection,custom_product_size.sleeve_length_left_selection,
                        custom_product.image,custom_product.image_custom, sleeve.title AS sleeve_title,
                        material_cleric.title AS cleric_title, material_cleric.code_fabric AS cleric_code_fabric,custom_product.cleric_type, material_cleric_category.title AS cleric_category_title,
                        custom_product.embroidery_text",
                        'left_join' => array(
                            'custom_product' => 'custom_product.id = order_product.id_custom_product',
                            'material_fabric' => 'material_fabric.id = custom_product.id_fabric',
                            'material_collar' => 'material_collar.id = custom_product.id_collar',
                            'material_cuff' => 'material_cuff.id = custom_product.id_cuff',
                            'material_cuff sleeve' => 'sleeve.id = custom_product.id_sleeve',
                            'material_pocket' => 'material_pocket.id = custom_product.id_pocket',
                            'order_product_status' => 'order_product_status.id = order_product.status',
                            'user' => 'user.id = order_product.id_user',
                            'custom_product_size' => 'custom_product_size.id_custom_product = custom_product.id',
                            'material_cleric_category' => 'material_cleric_category.id = custom_product.cleric_type',
                            'material_cleric' => 'material_cleric.id = custom_product.id_cleric'
                        ),
                        'where' => array(
                            'order_product.id_custom_product' => $id_custom_product
                        )
                    ),
                    false
                );

                foreach($get as $key => $value) {
                    $newget[strtoupper($key)] = $value;
                }

                $newget['PATH'] = path_image('product_image_path');
                $newget['PATH_CUSTOM'] = 'assets/img/img_order/';

                if(!is_null($template)) {
                    $object = new stdClass();
                    foreach ($newget as $key => $value)
                    {
                        $object->$key = $value;
                    }
                    $data['order_product'] = $object;
                    $template = $this->load->view("template/dashboard/{$template}/_detail_order.php", $data, true);
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'DETAIL ORDER VIEW';
                    $datapi['DATA'] = $template;
                } else {
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'DETAIL ORDER LIST';
                    $datapi['DATA'] = $newget;
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_CUSTOM_PRODUCT';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_sum_price() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_number = $this->input->post('ORDER_NUMBER', true);
            $get_order_status = $this->input->post('ORDER_STATUS', true);
            $get_numeric_price = $this->input->post('NUMERIC_PRICE', true);
            if(!is_null($get_id_user) && !is_null($get_order_number)) {
                $this->load->model('order_product_model');
                if(!is_null($get_order_status)) {
                    $where = array(
                        'order_product.id_user' => $get_id_user,
                        'order_product.order_number' => $get_order_number,
                        'order_product.status' => $get_order_status
                    );
                } else {
                    $where = array(
                        'order_product.id_user' => $get_id_user,
                        'order_product.order_number' => $get_order_number
                    );
                }
                $get = $this->order_product_model->all(
                    array(
                        'fields' => '(sum(FLOOR(order_product.base)) + sum(FLOOR(order_product.option)) + sum(FLOOR(order_product.tax))) as price_total',
                        'where' => $where
                    )
                );
                if($get) {
                    // Check for any coupon applied
                    $price_total = $get[0]->price_total;
                    $c_order_number = ($get_order_number) ? $get_order_number : get_session('last_order_number');
                    $q_coupon = $this->db->query("
                        SELECT * FROM order_product_coupon WHERE order_number = '$c_order_number'
                    ");
                    if ($q_coupon->num_rows() > 0) {
                        $row_coupon = $q_coupon->row();
                        $datapi['COUPON'] = (object) array(
                            'coupon_code' => $row_coupon->coupon_code,
                            'coupon_discount' => ($row_coupon->coupon_type == 'v') ? '- '.format_currency($row_coupon->coupon_discount) : $row_coupon->coupon_discount.' %',
                            'coupon_type' => $row_coupon->coupon_type
                        );
                        if ($row_coupon->coupon_type == 'v') {
                            $price_total = floor($price_total - $row_coupon->coupon_discount);
                            if ($price_total < 0) $price_total = 0;
                        } else {
                            $disc = ($price_total * $row_coupon->coupon_discount) / 100;
                            $price_total = floor($price_total - $disc);
                        }
                    }

                    if(!is_null($get_numeric_price)) {
                        $newget = array(
                            'ORDER_NUMBER' => $get_order_number,
                            'PRICE_TOTAL' => $price_total
                        );
                    } else {
                        $newget = array(
                            'ORDER_NUMBER' => $get_order_number,
                            'PRICE_TOTAL' => format_currency($price_total)
                        );
                    }
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'SUM PRICE ON SHOPING BAG';
                    $datapi['DATA'] = $newget;
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_USER AND ORDER_NUMBER';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_confirmation_order_step_one() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_number = $this->input->POST('ORDER_NUMBER', true);
            $template = $this->input->POST('TEMPLATE', true);
            if(!is_null($get_id_user) && !is_null($get_order_number)) {
                $this->load->model('order_product_model');
                $this->load->model('payment_method_model');
                $this->load->model('payment_list_model');
                $get = $this->order_product_model->all(
                    array(
                        'fields' => "order_product.*, user.user_token, custom_product.image, custom_product.quantity, custom_product.price as custom_price, order_product_status.title as status_text",
                        'left_join' => array(
                            'custom_product' => 'custom_product.id = order_product.id_custom_product',
                            'order_product_status' => 'order_product_status.id = order_product.status',
                            'user' => 'user.id = order_product.id_user'
                        ),
                        'where' => array(
                            'order_product.id_user' => $get_id_user,
                            'order_product.order_number' => $get_order_number
                        )
                    ),
                    false
                );

                $get->payment_method = $this->payment_method_model->all(
                    array(
                        'fields' => 'id as ID, title as TITLE'
                    )
                );
                $get->payment_list = $this->payment_list_model->all(
                    array(
                        'fields' => 'id as ID, bank_name as BANK_NAME, account_name as ACCOUNT_NAME, no_rek as NO_REK'
                    )
                );

                foreach($get as $key => $value) {
                    $newget[strtoupper($key)] = $value;
                }
                if(!is_null($template)) {
                    $object = new stdClass();
                    foreach ($newget as $key => $value)
                    {
                        $object->$key = $value;
                    }
                    $data['order_product'] = $object;
                    if($object->STATUS == '1') {
                        $template = $this->load->view("template/dashboard/order_status/_check_cart", $data, true);
                    } else if($object->STATUS == '2') {
                        $template = $this->load->view("template/dashboard/order_status/_please_complete_payment", $data, true);
                    } else if($object->STATUS == '3') {
                        $template = $this->load->view("template/dashboard/order_status/_confirmation_order_step_one", $data, true);
                    } else if($object->STATUS >= '4') {
                        $template = $this->load->view("template/dashboard/order_status/_confirmation_order_completed", null, true);
                    } else {
                        $template = array();
                    }
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'CONFIRMATION ORDER VIEW';
                    $datapi['DATA'] = $template;
                } else {
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'CONFIRMATION ORDER LIST';
                    $datapi['DATA'] = $newget;
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_USER AND ORDER_NUMBER';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_bank_account_list()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $q = $this->db->query("
                SELECT * FROM payment_list ORDER BY bank_name ASC
            ");
            if ($q->num_rows() > 0) {
                foreach ($q->result() as $key => $value) {
                    foreach($value as $childkey => $childvalue) {
                        $newget[$key][strtoupper($childkey)] = $childvalue;
                    }
                }

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'GET BANK ACCOUNT LIST';
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

    public function insert_confirmation_order() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_number = $this->input->post('ORDER_NUMBER', true);
            $get_price_total = $this->input->post('PRICE_TOTAL', true);
            $get_payment_date = $this->input->post('PAYMENT_DATE', true);
            $get_payment_method = $this->input->post('PAYMENT_METHOD', true);
            $get_sender_account = $this->input->post('SENDER_ACCOUNT', true);
            $get_destination_account = $this->input->post('DESTINATION_ACCOUNT', true);
            $get_payment_amount = $this->input->post('PAYMENT_AMOUNT', true);
            $get_information = $this->input->post('INFORMATION', true);
            if(!is_null($get_id_user) && !is_null($get_order_number) && !is_null($get_price_total) && !is_null($get_payment_date)
            && !is_null($get_payment_method) && !is_null($get_sender_account) && !is_null($get_destination_account) && !is_null($get_payment_amount)) {
                $this->load->model('confirmation_order_model');
                
                // Working on image
                $confirm_filename = '';
                if ($this->input->post('IMAGE') && $this->input->post('IMAGE') != '') {
                    $this->load->helper('string');
                    $confirm_filename = random_string('alnum', 8).'_'.$get_order_number.'.png';
                    $img_data = $this->input->post('IMAGE');
                    list($type, $img_data) = explode(';', $img_data);
                    list(, $img_data)      = explode(',', $img_data);
                    $img_data = base64_decode($img_data);
                    file_put_contents('assets/img/img_confirm_order/' . $confirm_filename, $img_data);
                }

                $data = array(
                    'id_user' => $get_id_user,
                    'order_number' => $get_order_number,
                    'price_total' => $get_price_total,
                    'payment_date' => $get_payment_date,
                    'payment_method' => $get_payment_method,
                    'sender_account' => $get_sender_account,
                    'destination_account' => $get_destination_account,
                    'payment_amount' => $get_payment_amount,
                    'information' => $get_information,
                    'created_at' => $this->now,
                    'filename' => $confirm_filename,
                );
                $insert = $this->confirmation_order_model->save($data);

                // UPDATE ORDER PRODUCT STATUS TO 4
                if ($insert) {
                    $this->db->update('order_product', array('status' => 4), array('order_number' => $get_order_number));
                }

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = "CONFIRMATION ORDER SAVED FOR INVOICE {$get_order_number}. THANK YOU..";
                $datapi['DATA'] = (object) array();
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT THE REQUIRED FIELDS.';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_my_order_status() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_number = $this->input->POST('ORDER_NUMBER', true);
            $template = $this->input->POST('TEMPLATE', true);
            if(!is_null($get_id_user) && !is_null($get_order_number)) {
                $this->load->model('order_product_model');
                $get = $this->order_product_model->all(
                    array(
                        'fields' => 'order_product.*, order_product_status.title as status_text, user.user_token',
                        'left_join' => array(
                            'order_product_status' => 'order_product_status.id = order_product.status',
                            'user' => 'user.id = order_product.id_user'
                        ),
                        'where' => array(
                            'order_product.id_user' => $get_id_user,
                            'order_product.order_number' => $get_order_number
                        )
                    ),
                    false
                );

                foreach($get as $key => $value) {
                    $newget[strtoupper($key)] = $value;
                }
                if(!is_null($template)) {
                    $object = new stdClass();
                    foreach ($newget as $key => $value)
                    {
                        $object->$key = $value;
                    }
                    $data['order_product'] = $object;
                    if($data['order_product']->STATUS != '10') { //COMPLETED
                        $template = $this->load->view("template/dashboard/order_status/_my_order_status", $data, true);
                    } else {
                        $template = $this->load->view('template/dashboard/order_status/_already_received', $data, true);
                    }
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'MY ORDER STATUS VIEW';
                    $datapi['DATA'] = $template;
                } else {
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'MY ORDER STATUS VIEW';
                    $datapi['DATA'] = $newget;
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_USER AND ORDER_NUMBER';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_detail_process_order() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_number = $this->input->POST('ORDER_NUMBER', true);
            $template = $this->input->POST('TEMPLATE', true);
            if(!is_null($get_id_user) && !is_null($get_order_number)) {
                $this->load->model('order_product_model');
                $get = $this->order_product_model->all(
                    array(
                        'where' => array(
                            'order_product.id_user' => $get_id_user,
                            'order_product.order_number' => $get_order_number
                        )
                    ),
                    false
                );

                foreach($get as $key => $value) {
                    $newget[strtoupper($key)] = $value;
                }
                if(!is_null($template)) {
                    $object = new stdClass();
                    foreach ($newget as $key => $value)
                    {
                        $object->$key = $value;
                    }
                    $data['order_product'] = $object;
                    $template = $this->load->view("template/dashboard/order_status/_detail_process_order", $data, true);
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'DETAIL PROCESS ORDER VIEW';
                    $datapi['DATA'] = $template;
                } else {
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'DETAIL PROCESS ORDER VIEW';
                    $datapi['DATA'] = $newget;
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_USER AND ORDER_NUMBER';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_order_product_status() {
        $this->load->model('order_product_status_model');
        $get = $this->order_product_status_model->all();
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($get));
    }

    public function update_order_product_status_on_admin() {
        $this->load->model('log_material_used_model');
        $this->load->model('log_order_product_model');
        $this->load->model('order_product_model');
        $id_order_product_status = $this->input->get('id_order_product_status', true);
        $id_order_product = $this->input->get('id_order_product', true);
        $order_number = $this->input->get('order_number', true);

        $this->db->trans_start();

        $data = array(
            'status' => $id_order_product_status
        );
        $update = $this->order_product_model->edit($id_order_product, $data);
        if($update) {
            $data_log = array(
                'id_order_product' => $id_order_product,
                'status' => $id_order_product_status,
                'created_at' => $this->now
            );
            $this->log_order_product_model->save($data_log);

            if($id_order_product_status == '5') { //aprove
                $this->load->model('material_fabric_model');
                $this->load->model('material_collar_model');
                $this->load->model('material_buttons_model');
                $this->load->model('material_cuff_model');
                $this->load->model('material_body_type_model');
                $this->load->model('material_pocket_model');
                $this->load->model('material_embroidery_model');
                $this->load->model('material_option_model');
                $this->load->model('material_cleric_model');

                $this->load->model('custom_product_model');
                $this->load->model('custom_product_size_model');
                $this->load->model('size_model');

                $checking = $this->log_material_used_model->count(
                    array(
                        'id_order_product' => $id_order_product
                    )
                );

                if($checking >= 1) {
                    return false;
                }


                $get_order_product = $this->order_product_model->first($id_order_product);

                if($get_order_product) {
                    $get_custom_product = $this->custom_product_model->first($get_order_product->id_custom_product);
                    $get_custom_product_size = $this->custom_product_size_model->first(
                        array(
                            'id_custom_product' => $get_order_product->id_custom_product
                        )
                    );
                    if($get_custom_product_size) {
                        $get_size = $this->size_model->first($get_custom_product_size->id_size);
                        if($get_size) {
                            $fabric_needed = $get_size->fabric_needed;
                        } else {
                            $fabric_needed = 0;
                        }
                    } else {
                        $fabric_needed = 0;
                    }
                    if($get_custom_product) {
                        $get_fabric = !is_null($get_custom_product->id_fabric) ? $this->material_fabric_model->first($get_custom_product->id_fabric) : 0;
                        $get_collar = !is_null($get_custom_product->id_collar) ? $this->material_collar_model->first($get_custom_product->id_collar) : 0;
                        $get_cuff = !is_null($get_custom_product->id_cuff) ? $this->material_cuff_model->first($get_custom_product->id_cuff) : 0;

                        $get_body_type_front = !is_null($get_custom_product->id_body_type_front) ? $this->material_body_type_model->first($get_custom_product->id_body_type_front) : 0;
                        $get_body_type_back = !is_null($get_custom_product->id_body_type_back) ? $this->material_body_type_model->first($get_custom_product->id_body_type_back) : 0;
                        $get_body_type_hem = !is_null($get_custom_product->id_body_type_hem) ? $this->material_body_type_model->first($get_custom_product->id_body_type_hem) : 0;

                        $get_pocket = !is_null($get_custom_product->id_pocket) ? $this->material_pocket_model->first($get_custom_product->id_pocket) : 0;

                        $get_button = !is_null($get_custom_product->id_button) ? $this->material_buttons_model->first($get_custom_product->id_button) : 0;
                        $get_button_hole = !is_null($get_custom_product->id_button_hole) ? $this->material_buttons_model->first($get_custom_product->id_button_hole) : 0;
                        $get_button_thread = !is_null($get_custom_product->id_button_thread) ? $this->material_buttons_model->first($get_custom_product->id_button_thread) : 0;

                        $get_embroidery_position = !is_null($get_custom_product->id_embroidery_position) ? $this->material_embroidery_model->first($get_custom_product->id_embroidery_position) : 0;
                        $get_embroidery_font = !is_null($get_custom_product->id_embroidery_font) ? $this->material_embroidery_model->first($get_custom_product->id_embroidery_font) : 0;
                        $get_embroidery_color = !is_null($get_custom_product->id_embroidery_color) ? $this->material_embroidery_model->first($get_custom_product->id_embroidery_color) : 0;

                        $get_option_amf_stitch = !is_null($get_custom_product->id_option_amf_stitch) ? $this->material_option_model->first($get_custom_product->id_option_amf_stitch) : 0;
                        $get_option_interlining = !is_null($get_custom_product->id_option_interlining) ? $this->material_option_model->first($get_custom_product->id_option_interlining) : 0;
                        $get_option_sewing = !is_null($get_custom_product->id_option_sewing) ? $this->material_option_model->first($get_custom_product->id_option_sewing) : 0;
                        $get_option_tape = !is_null($get_custom_product->id_option_tape) ? $this->material_option_model->first($get_custom_product->id_option_tape) : 0;

                        $get_cleric_1 = $this->material_cleric_model->first(
                            array(
                                'id_category' => $get_custom_product->cleric_type,
                                'id_sub_category' => $get_custom_product->id_cleric_1
                            )
                        );
                        $get_cleric_2 = $this->material_cleric_model->first(
                            array(
                                'id_category' => $get_custom_product->cleric_type,
                                'id_sub_category' => $get_custom_product->id_cleric_2
                            )
                        );
                        $get_cleric_3 = $this->material_cleric_model->first(
                            array(
                                'id_category' => $get_custom_product->cleric_type,
                                'id_sub_category' => $get_custom_product->id_cleric_3
                            )
                        );

                        $fabric_minus = $fabric_needed;
                        $collar_minus = isset($get_collar->need_stock_for_custom) && !is_null($get_collar->need_stock_for_custom) ? $get_collar->need_stock_for_custom : 0;
                        $cuff_minus = isset($get_cuff->need_stock_for_custom) && !is_null($get_cuff->need_stock_for_custom) ? $get_cuff->need_stock_for_custom : 0;
                        $body_type_front_minus = isset($get_body_type_front->need_stock_for_custom) && !is_null($get_body_type_front->need_stock_for_custom) ? $get_body_type_front->need_stock_for_custom : 0;
                        $body_type_back_minus = isset($get_body_type_back->need_stock_for_custom) && !is_null($get_body_type_back->need_stock_for_custom) ? $get_body_type_back->need_stock_for_custom : 0;
                        $body_type_hem_minus = isset($get_body_type_hem->need_stock_for_custom) && !is_null($get_body_type_hem->need_stock_for_custom) ? $get_body_type_hem->need_stock_for_custom : 0;
                        $pocket_minus = isset($get_pocket->need_stock_for_custom) && !is_null($get_pocket->need_stock_for_custom) ? $get_pocket->need_stock_for_custom : 0;
                        $button_minus = isset($get_button->need_stock_for_custom) && !is_null($get_button->need_stock_for_custom) ? $get_button->need_stock_for_custom : 0;
                        $button_hole_minus = isset($get_button_hole->need_stock_for_custom) && !is_null($get_button_hole->need_stock_for_custom) ? $get_button_hole->need_stock_for_custom : 0;
                        $button_thread_minus = isset($get_button_thread->need_stock_for_custom) && !is_null($get_button_thread->need_stock_for_custom) ? $get_button_thread->need_stock_for_custom : 0;
                        $embroidery_position_minus = isset($get_embroidery_position->need_stock_for_custom) && !is_null($get_embroidery_position->need_stock_for_custom) ? $get_embroidery_position->need_stock_for_custom : 0;
                        $embroidery_font_minus = isset($get_embroidery_font->need_stock_for_custom) && !is_null($get_embroidery_font->need_stock_for_custom) ? $get_embroidery_font->need_stock_for_custom : 0;
                        $embroidery_color_minus = isset($get_embroidery_color->need_stock_for_custom) && !is_null($get_embroidery_color->need_stock_for_custom) ? $get_embroidery_color->need_stock_for_custom : 0;
                        $option_amf_stitch_minus = isset($get_option_amf_stitch->need_stock_for_custom) && !is_null($get_option_amf_stitch->need_stock_for_custom) ? $get_option_amf_stitch->need_stock_for_custom : 0;
                        $option_interlining_minus = isset($get_option_interlining->need_stock_for_custom) && !is_null($get_option_interlining->need_stock_for_custom) ? $get_option_interlining->need_stock_for_custom : 0;
                        $option_sewing_minus = isset($get_option_sewing->need_stock_for_custom) && !is_null($get_option_sewing->need_stock_for_custom) ? $get_option_sewing->need_stock_for_custom : 0;
                        $option_tape_minus = isset($get_option_tape->need_stock_for_custom) && !is_null($get_option_tape->need_stock_for_custom) ? $get_option_tape->need_stock_for_custom : 0;

                        $cleric_1_minus = isset($get_cleric_1->need_stock_for_custom) && !is_null($get_cleric_1->need_stock_for_custom) ? $get_cleric_1->need_stock_for_custom : 0;
                        $cleric_2_minus = isset($get_cleric_2->need_stock_for_custom) && !is_null($get_cleric_2->need_stock_for_custom) ? $get_cleric_2->need_stock_for_custom : 0;
                        $cleric_3_minus = isset($get_cleric_3->need_stock_for_custom) && !is_null($get_cleric_3->need_stock_for_custom) ? $get_cleric_3->need_stock_for_custom : 0;

                        $cleric_minus = $cleric_1_minus + $cleric_2_minus + $cleric_3_minus;

                        $data_log_material_used = array(
                            'id_order_product' => $id_order_product,
                            'fabric' => $fabric_minus,
                            'collar' => $collar_minus,
                            'cuff' => $cuff_minus,
                            'body_type_front' => $body_type_front_minus,
                            'body_type_back' => $body_type_back_minus,
                            'body_type_hem' => $body_type_hem_minus,
                            'pocket' => $pocket_minus,
                            'button' => $button_minus,
                            'button_hole' => $button_hole_minus,
                            'button_thread' => $button_thread_minus,
                            'embroidery_position' => $embroidery_position_minus,
                            'embroidery_font' => $embroidery_font_minus,
                            'embroidery_color' => $embroidery_color_minus,
                            'option_amf_stitch' => $option_amf_stitch_minus,
                            'option_interlining' => $option_interlining_minus,
                            'option_sewing' => $option_sewing_minus,
                            'option_tape' => $option_tape_minus,
                            'cleric' => $cleric_minus,
                            'created_at' => $this->now
                        );
                        $this->log_material_used_model->save($data_log_material_used);

                        $update_stok_fabric = array(
                            'stock' => $get_fabric->stock - $fabric_needed
                        );
                        $this->material_fabric_model->edit($get_fabric->id, $update_stok_fabric);

                        $update_stok_collar = array(
                            'stock' => $get_collar->stock - $collar_minus
                        );
                        $this->material_collar_model->edit($get_collar->id, $update_stok_collar);

                        $update_stok_cuffs = array(
                            'stock' => $get_cuff->stock - $cuff_minus
                        );
                        $this->material_cuff_model->edit($get_cuff->id, $update_stok_cuffs);

                        $update_stok_body_type_front = array(
                            'stock' => $get_body_type_front->stock - $body_type_front_minus
                        );
                        $this->material_body_type_model->edit($get_body_type_front->id, $update_stok_body_type_front);

                        $update_stok_body_type_back = array(
                            'stock' => $get_body_type_back->stock - $body_type_back_minus
                        );
                        $this->material_body_type_model->edit($get_body_type_back->id, $update_stok_body_type_back);

                        $update_stok_body_type_hem = array(
                            'stock' => $get_body_type_hem->stock - $body_type_hem_minus
                        );
                        $this->material_body_type_model->edit($get_body_type_hem->id, $update_stok_body_type_hem);

                        $update_stok_pocket = array(
                            'stock' => $get_pocket->stock - $pocket_minus
                        );
                        $this->material_pocket_model->edit($get_pocket->id, $update_stok_pocket);

                        $update_stok_button = array(
                            'stock' => $get_button->stock - $button_minus
                        );
                        $this->material_buttons_model->edit($get_button->id, $update_stok_button);

                        $update_stok_button_hole = array(
                            'stock' => $get_button_hole->stock - $button_hole_minus
                        );
                        $this->material_buttons_model->edit($get_button_hole->id, $update_stok_button_hole);

                        $update_stok_button_thread = array(
                            'stock' => $get_button_thread->stock - $button_thread_minus
                        );
                        $this->material_buttons_model->edit($get_button_thread->id, $update_stok_button_thread);

                        $update_stok_cleric_1 = array(
                            'stock' => $get_cleric_1->stock - $cleric_1_minus
                        );
                        $this->material_cleric_model->edit($get_cleric_1->id, $update_stok_cleric_1);

                        $update_stok_cleric_2 = array(
                            'stock' => $get_cleric_2->stock - $cleric_2_minus
                        );
                        $this->material_cleric_model->edit($get_cleric_2->id, $update_stok_cleric_2);

                        $update_stok_cleric_3 = array(
                            'stock' => $get_cleric_3->stock - $cleric_3_minus
                        );
                        $this->material_cleric_model->edit($get_cleric_3->id, $update_stok_cleric_3);

                        $update_stok_embroidery_position = array(
                            'stock' => $get_embroidery_position->stock - $embroidery_position_minus
                        );
                        $this->material_embroidery_model->edit($get_embroidery_position->id, $update_stok_embroidery_position);

                        $update_stok_embroidery_font = array(
                            'stock' => $get_embroidery_font->stock - $embroidery_font_minus
                        );
                        $this->material_embroidery_model->edit($get_embroidery_font->id, $update_stok_embroidery_font);

                        $update_stok_embroidery_color = array(
                            'stock' => $get_embroidery_color->stock - $embroidery_color_minus
                        );
                        $this->material_embroidery_model->edit($get_embroidery_color->id, $update_stok_embroidery_color);

                        $update_stok_option_amf_stitch = array(
                            'stock' => $get_option_amf_stitch->stock - $option_amf_stitch_minus
                        );
                        $this->material_option_model->edit($get_option_amf_stitch->id, $update_stok_option_amf_stitch);

                        $update_stok_option_interlining = array(
                            'stock' => $get_option_interlining->stock - $option_interlining_minus
                        );
                        $this->material_option_model->edit($get_option_interlining->id, $update_stok_option_interlining);

                        $update_stok_option_sewing = array(
                            'stock' => $get_option_sewing->stock - $option_sewing_minus
                        );
                        $this->material_option_model->edit($get_option_sewing->id, $update_stok_option_sewing);

                        $update_stok_option_tape = array(
                            'stock' => $get_option_tape->stock - $option_tape_minus
                        );
                        $this->material_option_model->edit($get_option_tape->id, $update_stok_option_tape);
                    }
                }
            }
            $this->db->trans_complete();
            $trans_status = $this->db->trans_status();
            if ($trans_status === FALSE) {
                $this->db->trans_rollback();
            } else{
                $this->db->trans_commit();
            }

            return true;
        } else {
            return false;
        }
    }

    public function change_quantity_product_and_update_order_product_price() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('custom_product_model');
            $get_id_custom_product = $this->input->post('ID_CUSTOM_PRODUCT', true);
            $get_quantity = $this->input->post('QUANTITY', true);

            if(!is_null($get_id_custom_product) && !is_null($get_quantity)) {
                $check = $this->custom_product_model->first(
                    array(
                        'id' => $get_id_custom_product
                    )
                );
                if($check) {
                    $data_update = array(
                        'quantity' => $get_quantity
                    );
                    $update_quantity = $this->custom_product_model->edit($get_id_custom_product, $data_update);
                    if($update_quantity) {
                        $id_custom_product = $check->id;
                        $this->load->model('order_product_model');
                        $get_order_on_cart = $this->order_product_model->get_data_by_id_custom_product($id_custom_product);

                        if($get_order_on_cart) {
                            $data_update_order_product = array(
                                'BASE' => floor($get_order_on_cart->price_fabric) * $get_quantity,
                                'OPTION' => (floor($get_order_on_cart->custom_price) - $get_order_on_cart->price_fabric) * $get_quantity,
                                'TAX' => (floor($get_order_on_cart->custom_price) * $get_quantity) * 0.1
                            );
                            $update_order_product_price = $this->order_product_model->edit_by_id_custom_product($id_custom_product, $data_update_order_product);
                            $datapi['STATUS'] = 'SUCCESS';
                            $datapi['MESSAGE'] = 'CHANGE SUCCESS';
                            $datapi['DATA'] = (object)array();
                        } else {
                            $datapi['STATUS'] = 'FAILED';
                            $datapi['MESSAGE'] = 'DATA ORDER PRODUCT NOT FOUND';
                            $datapi['DATA'] = (object)array();
                        }
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'CHANGE QUANTITY FAILED';
                        $datapi['DATA'] = (object)array();
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'DATA NOT FOUND';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_CUSTOM_PRODUCT AND QUANTITY';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function insert_custom_product_size() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('custom_product_size_model');
            $get_id_custom_product = $this->input->post('ID_CUSTOM_PRODUCT', true);
            if(!is_null($get_id_custom_product)) {
                $data_save = array(
                    'id_custom_product' => $this->input->post('ID_CUSTOM_PRODUCT', true),
                    'id_size' => $this->input->post('ID_SIZE', true),
                    'neck' => $this->input->post('NECK', true),
                    'shoulder' => $this->input->post('SHOULDER', true),
                    'chest' => $this->input->post('CHEST', true),
                    'waist' => $this->input->post('WAIST', true),
                    'hip' => $this->input->post('HIP', true),
                    'arm_hole' => $this->input->post('ARM_HOLE', true),
                    'back_length_88' => $this->input->post('BACK_LENGTH_88', true),
                    'back_length_89' => $this->input->post('BACK_LENGTH_89', true),
                    'aloha_88' => $this->input->post('ALOHA_88', true),
                    'aloha_89' => $this->input->post('ALOHA_89', true),
                    'cuffs_circle' => $this->input->post('CUFFS_CIRCLE', true),
                    'short_sleeve' => $this->input->post('SHORT_SLEEVE', true),
                    'sleeve_circle' => $this->input->post('SLEEVE_CIRCLE', true),

                    // MAIN SIZE
                    'around_neck_selection' => $this->input->post('AROUND_NECK_SELECTION', true),
                    'body_type_selection' => $this->input->post('BODY_TYPE_SELECTION', true),
                    'sleeve_type_selection' => $this->input->post('SLEEVE_TYPE_SELECTION', true),
                    'sleeve_length_right_selection' => $this->input->post('SLEEVE_LENGTH_RIGHT_SELECTION', true),
                    'sleeve_length_left_selection' => $this->input->post('SLEEVE_LENGTH_LEFT_SELECTION', true),

                    'created_at' => $this->now
                );
                $this->custom_product_size_model->save($data_save);

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'CUSTOM PRODUCT SIZE SAVED';
                $datapi['DATA'] = (object)array();
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_CUSTOM_PRODUCT';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function insert_payment_history() {
        $headers = apache_request_headers();
        $check = $this->check_app_and_user_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('payment_history_model');

            $get_id_user = $this->input->post('ID_USER', true);
            $get_order_number = $this->input->post('ORDER_NUMBER', true);
            $get_midtrans_order_id = $this->input->post('MIDTRANS_ORDER_ID', true);
            $get_midtrans_gross_amount = $this->input->post('MIDTRANS_GROSS_AMOUNT', true);
            $get_payment_method = $this->input->post('PAYMENT_METHOD', true);
            //$get_transaction_time = $this->input->post('TRANSACTION_TIME', true);
            $get_payment_status = $this->input->post('PAYMENT_STATUS', true);

            if(!is_null($get_id_user) && !is_null($get_order_number) && !is_null($get_payment_method)) {
                $date_created = date('Y-m-d H:i:s', strtotime('+2 hours'));
                $data_save = array(
                    'id_user' => $get_id_user,
                    'order_number' => $get_order_number,
                    'midtrans_order_id' => $get_midtrans_order_id,
                    'midtrans_gross_amount' => $get_midtrans_gross_amount,
                    'payment_method' => $get_payment_method,
                    'payment_status' => $get_payment_status,
                    'expired_at' => date('Y-m-d H:i:s', strtotime('+2 hours')),
                    'created_at' => date('Y-m-d H:i:s')
                );
                $insert = $this->payment_history_model->save($data_save);

                // UPDATE ORDER PRODUCT TO 3
                if ($insert) {
                    $this->db->update('order_product', array('status' => 3), array('order_number' => $get_order_number));
                }

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'PAYMENT HISTORY SAVED';
                $datapi['DATA'] = (object) array(
                    'COUNTDOWN' => $date_created
                );
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT REQUIRED FIELDS';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function cancel_item_on_cart() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $get_id_custom_product = $this->input->post('ID_CUSTOM_PRODUCT', true);
            if(!is_null($get_id_custom_product) && !empty($get_id_custom_product)) {
                $this->load->model('custom_product_model');
                $this->load->model('custom_product_size_model');
                $this->load->model('order_product_model');

                $q = $this->db->query("
                    SELECT image, image_custom FROM custom_product WHERE id = $get_id_custom_product
                ");
                if ($q->num_rows() > 0) {
                    $row = $q->row();
                    if (!empty($row->image_custom)) {
                        @unlink('assets/img/img_order/' . $row->image_custom);
                    }
                }

                $this->custom_product_model->delete($get_id_custom_product);
                $this->custom_product_size_model->delete(
                    array(
                        'id_custom_product' => $get_id_custom_product
                    )
                );
                $this->order_product_model->delete(
                    array(
                        'id_custom_product' => $get_id_custom_product
                    )
                );

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'CANCEL ITEM SUCCESS';
                $datapi['DATA'] = (object)array();
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_CUSTOM_PRODUCT';
                $datapi['DATA'] = (object)array();
            }
        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function set_session_embroidery_text()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        $text = $this->input->post('text', true);
        if ($text == '') {
            $this->session->unset_userdata('sess_embroidery_text');
        } else {
            $this->session->set_userdata('sess_embroidery_text', $text);
        }

        $datapi['STATUS'] = 'SUCCESS';
        $datapi['MESSAGE'] = 'CANCEL ITEM SUCCESS';
        $datapi['DATA'] = (object)array('text' => $text);

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function set_session_image()
    {
        $img = $this->input->post('image');
        if ($img != '') {
            $this->session->set_userdata('order_img', $img);
        }

        $datapi['STATUS'] = 'SUCCESS';
        $datapi['MESSAGE'] = 'CANCEL ITEM SUCCESS';
        $datapi['DATA'] = (object)array('image' => $this->session->userdata('order_img'));

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_order_number()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {

            $code = generate_order_number();
            while ($this->db->query("SELECT id FROM order_product WHERE order_number = '$code'")->num_rows() > 0) {
                $code = generate_order_number();
            }

            $datapi['STATUS'] = 'SUCCESS';
            $datapi['MESSAGE'] = 'GET ORDER NUMBER';
            $datapi['DATA'] = (object) array('ORDER_NUMBER' => $code);

        } else {
            $datapi = $check;
        }
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_order_status()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('order_product_status_model');
            $get = $this->order_product_status_model->all();

            $datapi['STATUS'] = 'SUCCESS';
            $datapi['MESSAGE'] = 'GET ORDER STATUS';
            $datapi['DATA'] = $get;
        } else {
            $datapi = $check;
        }
        
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function print_out()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $id_custom = $this->input->post('ID_CUSTOM_PRODUCT');
            if (!is_null($id_custom)) {
                // GET CUSTOM ORDER
                $q_order = $this->db->query("
                    SELECT 
                        cp.*,
                        cp.price AS custom_price,
                        op.*,
                        cps.*,
                        mf.*
                    FROM custom_product cp 
                    LEFT JOIN custom_product_size cps ON cps.id_custom_product = cp.id
                    LEFT JOIN order_product op ON op.id_custom_product = cp.id 
                    LEFT JOIN material_fabric mf ON mf.id = cp.id_fabric 
                    WHERE cp.id = $id_custom
                ");

                if ($q_order->num_rows() > 0) {

                    $row_order = $q_order->row();

                    $q_collar = $this->db->query("
                        SELECT id, image, title FROM material_collar WHERE deleted_at IS NULL ORDER BY id ASC
                    ");

                    $q_cuff = $this->db->query("
                        SELECT id, image, title, category FROM material_cuff WHERE deleted_at IS NULL ORDER BY id ASC
                    ");

                    $q_body_type = $this->db->query("
                        SELECT id, image, title, category FROM material_body_type WHERE deleted_at IS NULL ORDER BY id ASC
                    ");

                    $q_button = $this->db->query("
                        SELECT id, image, title, category FROM material_buttons WHERE deleted_at IS NULL ORDER BY id ASC
                    ");

                    $q_pocket = $this->db->query("
                        SELECT id, image, title FROM material_pocket WHERE deleted_at IS NULL ORDER BY id ASC
                    ");

                    $q_shipping = $this->db->query("
                        SELECT 
                            os.* 
                        FROM order_shipping os 
                        WHERE id_user = ".$row_order->id_user." 
                    ");

                    $size_check = FALSE;
                    $q_size = NULL;
                    if (!empty($row_order->id_size)) {
                        $q_size = $this->db->query("
                            SELECT * FROM size WHERE id = ".$row_order->id_size."
                        ");
                        $size_check = TRUE;
                    }

                    // Check Repeat Order
                    $repeat_order = FALSE;
                    $q_check_repeat = $this->db->query("
                        SELECT id FROM order_product WHERE id_user = ".$row_order->id_user." AND order_number != '".$row_order->order_number."'
                    ");
                    if ($q_check_repeat->num_rows() > 0) {
                        $repeat_order = TRUE;
                    }

                    $data = [
                        'collar' => $q_collar,
                        'cuff' => $q_cuff,
                        'body_type' => $q_body_type,
                        'button' => $q_button,
                        'pocket' => $q_pocket,
                        'order' => $q_order,
                        'shipping' => $q_shipping,
                        'size_check' => $size_check,
                        'real_size' => $q_size,
                        'repeat_order' => $repeat_order,
                    ];

                    $view = $this->load->view('template/karuizawa_invoice', $data, TRUE);

                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'GET ORDER STATUS';
                    $datapi['DATA'] = $view;
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'DATA CUSTOM NOT FOUND';
                    $datapi['DATA'] = (object) array();
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PLEASE INPUT ID_CUSTOM_PRODUCT';
                $datapi['DATA'] = (object) array();
            }
        } else {
            $datapi = $check;
        }

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_midtrans_token()
    {
        $trans_details = $this->input->post('TRANS_DETAILS');
        $item_details = $this->input->post('ITEM_DETAILS');
        $customers = $this->input->post('CUST_DETAILS');
        $order_number = $this->input->post('ORDER_NUMBER');

        $trans_details['order_id'] = rand().'-'.$order_number;

        $trans_data = [
            'transaction_details' => $trans_details,
            'item_details' => $item_details,
            'customer_details' => $customers
        ];

        $this->load->library('Midtrans');
        $server_key = $this->config->item('midtrans_server_key');
        $is_production = $this->config->item('is_production');

        $this->midtrans->config(array(
            'server_key' => $server_key,
            'production' => $is_production
        ));

        try {
            $response = $this->midtrans->getSnapToken($trans_data);
        } catch (Exception $e) {
            $error_msg = $e->getMessage();
        }

        if (isset($error_msg)) {
            $datapi['STATUS'] = 'FAILED';
            $datapi['MESSAGE'] = $error_msg;
            $datapi['DATA'] = (object) array();
        } else {
            $datapi['STATUS'] = 'SUCCESS';
            $datapi['MESSAGE'] = 'GET MIDTRANS TOKEN';
            $datapi['DATA'] = (object) array(
                'TOKEN' => $response,
                'DATA' => $trans_data
            );
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($datapi));
    }

    public function get_midtrans_payment_url()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $user_id = $this->input->post('USER_ID', TRUE);
            if(!is_null($user_id)) {

                $q_user = $this->db->query("
                    SELECT * FROM user WHERE id = $user_id
                ");
                if ($q_user->num_rows() > 0) {
                    // check shipping
                    $q_shipping = $this->db->query("
                        SELECT * FROM order_shipping WHERE id_user = ".$user_id."
                    ");
                    if ($q_shipping->num_rows() > 0) {

                        $get_order_number = $this->input->post('ORDER_NUMBER', true);

                        if(!is_null($get_order_number)) {

                            $midtrans_client_key = $this->config->item('midtrans_client_key');
                            $midtrans_server_key = $this->config->item('midtrans_server_key');

                            $params = array('server_key' => $midtrans_server_key, 'production' => $this->config->item('is_production'));
                            $this->load->library('veritrans');
                            $this->veritrans->config($params);

                            $data_get_order_product = array(
                                'ID_USER' => $user_id,
                                'ORDER_NUMBER' => $get_order_number
                            );
                            $headers = array(
                                'USER_TOKEN' => $q_user->row()->user_token
                            );
                            $get_by_order_number = get_data_curl(base_url('api/order/get_order_product'), $data_get_order_product, $headers);

                            // Check for any coupon applied
                            $q_coupon = $this->db->query("
                                SELECT * FROM order_product_coupon WHERE order_number = '$get_order_number'
                            ");
                            if ($q_coupon->num_rows() > 0) {
                                $row_coupon = $q_coupon->row();
                            }

                            $item_details = array();
                            $total_pay = 0;
                            foreach($get_by_order_number->DATA as $key => $value) {
                                $sum_order_price = ($value->CUSTOM_PRICE + ($value->TAX / $value->QUANTITY));
                                $item_details[$key] = array(
                                    'id' => $value->ID_CUSTOM_PRODUCT,
                                    'price' => (int) $sum_order_price,
                                    'quantity' => $value->QUANTITY,
                                    'name' => $value->ORDER_TYPE_TEXT
                                );
                                $total_pay += (int) $sum_order_price * $value->QUANTITY;
                            }

                            if (isset($row_coupon)) {
                                if ($row_coupon->coupon_type == 'v') {
                                    $coupon_discount = $row_coupon->coupon_discount * -1;
                                } else {
                                    $disc = ($total_pay * $row_coupon->coupon_discount) / 100;
                                    $coupon_discount = floor($disc) * -1;
                                }

                                $item_details[] = array(
                                    'id' => $row_coupon->id,
                                    'price' => $coupon_discount,
                                    'quantity' => 1,
                                    'name' => 'Coupon discount (' . $row_coupon->coupon_code.')'
                                );
                            }

                            $transaction_details = array(
                                'order_id' => rand().'-'.$get_order_number,
                                'gross_amount' => floor((isset($coupon_discount)) ? $total_pay + $coupon_discount : $total_pay), // no decimal allowed for creditcard
                            );

                            $shipping_address = array(
                                'first_name'        => $q_shipping->row()->name,
                                'address'           => $q_shipping->row()->address,
                                'city'              => $q_shipping->row()->city,
                                'postal_code'       => $q_shipping->row()->zip_code,
                                'phone'             => $q_shipping->row()->hp,
                                'country_code'      => 'IDN'
                            );

                            $customer_details = array(
                                'first_name'       => $q_user->row()->name,
                                'email'            => $q_user->row()->email,
                                'phone'            => $q_user->row()->phone,
                                'shipping_address' => $shipping_address
                            );

                            $transaction_data = array(
                                'payment_type' 			=> 'vtweb',
                                'vtweb' 						=> array(
                                    'credit_card_3d_secure' => true
                                ),
                                'transaction_details'=> $transaction_details,
                                'item_details' 			 => $item_details,
                                'customer_details' 	 => $customer_details
                            );

                            try {
                                $vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
                                $datapi['STATUS'] = 'SUCCESS';
                                $datapi['MESSAGE'] = 'GET PAYMENT URL';
                                $datapi['DATA'] = (object) array(
                                    'PAYMENT_URL' => $vtweb_url
                                );
                            } catch (Exception $e) {
                                $datapi['STATUS'] = 'FAILED';
                                $datapi['MESSAGE'] = $e->getMessage();
                                $datapi['DATA'] = (object) $transaction_data;
                            }

                        } else {
                            $datapi['STATUS'] = 'FAILED';
                            $datapi['MESSAGE'] = 'ORDER NUMBER IS REQUIRED';
                            $datapi['DATA'] = (object) array();
                        }

                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'PLEASE INPUT SHIPPING INFORMATION';
                        $datapi['DATA'] = (object) array();
                    }
                } else {

                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'USER NOT FOUND';
                    $datapi['DATA'] = (object) array();

                }
            } else {

                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'USER ID IS REQUIRED';
                $datapi['DATA'] = (object) array();

            }            
        } else {
            $datapi = $check;
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($datapi));
    }

    public function print_view($order_number)
    {
        // GET CUSTOM ORDER
        $q_order = $this->db->query("
            SELECT 
                cp.*,
                cp.price AS custom_price,
                op.*,
                op.created_at AS order_date,
                cps.*,
                mf.*,
                mcl.code_fabric AS code_fabric_cleric,
                mf.title AS fabric_title
            FROM custom_product cp 
            LEFT JOIN custom_product_size cps ON cps.id_custom_product = cp.id
            LEFT JOIN order_product op ON op.id_custom_product = cp.id 
            LEFT JOIN material_fabric mf ON mf.id = cp.id_fabric 
            LEFT JOIN material_cleric mcl ON mcl.id = cp.id_cleric
            WHERE cp.id = op.id_custom_product AND op.order_number = '$order_number'
        ");

        if ($q_order->num_rows() > 0) {

            foreach ($q_order->result() as $row_order) {
                $q_collar = $this->db->query("
                    SELECT price, id, image, title, xform, most_pick, additional_charge FROM material_collar WHERE deleted_at IS NULL ORDER BY id ASC
                ");

                $q_cuff = $this->db->query("
                    SELECT price, id, image, title, category, xform, most_pick, additional_charge FROM material_cuff WHERE deleted_at IS NULL ORDER BY id ASC
                ");

                $q_body_type = $this->db->query("
                    SELECT price, id, image, title, category, xform, most_pick, additional_charge FROM material_body_type WHERE deleted_at IS NULL ORDER BY id ASC
                ");

                $q_button = $this->db->query("
                    SELECT price, id, image, title, category, xform, most_pick, additional_charge FROM material_buttons WHERE category = 1 AND deleted_at IS NULL ORDER BY id ASC
                ");

                $q_button_hole = $this->db->query("
                    SELECT price, id, image, title, category, xform, most_pick, additional_charge FROM material_buttons WHERE category = 2 AND deleted_at IS NULL ORDER BY id ASC
                ");

                $q_button_thread = $this->db->query("
                    SELECT price, id, image, title, category, xform, most_pick, additional_charge FROM material_buttons WHERE category = 3 AND deleted_at IS NULL ORDER BY id ASC
                ");

                $q_pocket = $this->db->query("
                    SELECT price, id, image, title, xform, most_pick, additional_charge FROM material_pocket WHERE deleted_at IS NULL ORDER BY id DESC
                ");

                $q_option = $this->db->query("
                    SELECT price, id, category, image, title, xform, most_pick, additional_charge FROM material_option WHERE deleted_at IS NULL ORDER BY id ASC
                ");

                $q_embroidery = $this->db->query("
                    SELECT id, category, image, title, xform, most_pick, additional_charge FROM material_embroidery WHERE deleted_at IS NULL ORDER BY id ASC
                ");

                $q_shipping = $this->db->query("
                    SELECT 
                        os.* 
                    FROM order_shipping os 
                    WHERE id_user = ".$row_order->id_user." 
                ");

                $size_check = FALSE;
                $q_size = NULL;
                if (!empty($row_order->id_size)) {
                    $q_size = $this->db->query("
                        SELECT * FROM size WHERE id = ".$row_order->id_size."
                    ");
                    $size_check = TRUE;
                }

                $data['orders'][] = [
                    'collar' => $q_collar,
                    'cuff' => $q_cuff,
                    'body_type' => $q_body_type,
                    'button' => $q_button,
                    'button_hole' => $q_button_hole,
                    'button_thread' => $q_button_thread,
                    'pocket' => $q_pocket,
                    'option' => $q_option,
                    'embroidery' => $q_embroidery,
                    'order' => $row_order,
                    'shipping' => $q_shipping,
                    'size_check' => $size_check,
                    'real_size' => $q_size
                ];
            }

            $this->load->view('template/karuizawa_invoice', $data);
        }
    }

    public function send_order_notification($order_num = null)
    {
        if ($order_num) {
            $q_configs = $this->db->query('SELECT * FROM configurations WHERE name = "configs"');
            $email_to = json_decode($q_configs->row()->values)->order_notification_email;
    
            $q = $this->db->query("
                SELECT cp.*,op.*,os.*,
                op.created_at AS order_date,
                mf.title AS fabric_title, mf.code_fabric as fabric_code,
                mc.title AS collar_title,
                mcuff.title AS cuff_title,
                msleeve.title AS sleeve_title,
                (SELECT title FROM material_body_type WHERE id = cp.id_body_type_front) AS body_type_front_title,
                (SELECT title FROM material_body_type WHERE id = cp.id_body_type_back) AS body_type_back_title,
                (SELECT title FROM material_body_type WHERE id = cp.id_body_type_hem) AS body_type_hem_title,
                (SELECT title FROM material_buttons WHERE id = cp.id_button) AS button_title,
                (SELECT title FROM material_buttons WHERE id = cp.id_button_hole) AS button_hole_title,
                (SELECT title FROM material_buttons WHERE id = cp.id_button_thread) AS button_thread_title,
                mcl.code_fabric AS cleric_fabric_code, mcl.title AS cleric_title,
                (SELECT title FROM material_embroidery WHERE id = cp.id_embroidery_position) AS embroidery_position,
                (SELECT title FROM material_embroidery WHERE id = cp.id_embroidery_color) AS embroidery_color,
                (SELECT title FROM material_embroidery WHERE id = cp.id_embroidery_font) AS embroidery_font,
                (SELECT title FROM material_option WHERE id = cp.id_option_amf_stitch) AS option_amf_title,
                (SELECT title FROM material_option WHERE id = cp.id_option_interlining) AS option_interlining_title,
                (SELECT title FROM material_option WHERE id = cp.id_option_sewing) AS option_sewing_title,
                (SELECT title FROM material_option WHERE id = cp.id_option_tape) AS option_tape_title,
                cps.*
                FROM custom_product cp 
                LEFT JOIN order_product op ON op.id_custom_product = cp.id 
                LEFT JOIN order_shipping os ON os.id_user = op.id_user 
                LEFT JOIN material_fabric mf ON mf.id = cp.id_fabric
                LEFT JOIN material_collar mc ON mc.id = cp.id_collar
                LEFT JOIN material_cuff mcuff ON mcuff.id = cp.id_cuff
                LEFT JOIN material_cuff msleeve ON msleeve.id = cp.id_sleeve 
                LEFT JOIN material_cleric mcl ON mcl.id = cp.id_cleric
                LEFT JOIN custom_product_size cps ON cps.id_custom_product = cp.id
                WHERE op.order_number = '$order_num'
            ");
    
            $data = [
                'orders' => $q->result_array()
            ];
            $email_tpl = $this->load->view('template/emails/tpl_order_notification', $data, TRUE);
    
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
            $this->email->to($email_to);
            $this->email->subject('#' . $order_num . ' Order Notification');
    
            $this->email->message($email_tpl);
            $send = $this->email->send();

            if ($send) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'EMAIL SENT';
                $datapi['DATA'] = (object) array();
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'FAILED TO SEND EMAIL';
                $datapi['DATA'] = (object) array();
            }

            return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($datapi));
        }
    }

    public function get_user_size_history()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {

            $user_id = $this->input->post('USER_ID', TRUE);
            if (!is_null($user_id)) {

                $q = $this->db->query("
                    SELECT op.id AS order_product_id, cp.id AS custom_product_id, cps.* FROM order_product op 
                    LEFT JOIN custom_product cp ON cp.id = op.id_custom_product 
                    LEFT JOIN custom_product_size cps ON cps.id_custom_product = cp.id
                    WHERE op.order_type = 2 AND op.id_user = $user_id AND cps.id_size != ''
                    ORDER BY op.id DESC
                    LIMIT 5
                ");
                if ($q->num_rows() > 0) {
                    foreach($q->result() as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                        }
                    }

                    if (isset($newget)) {

                        foreach ($newget as $newget_key => $value_key) {
                            $original_size = $this->db->query("
                                SELECT * FROM size WHERE id = ".$newget[$newget_key]['ID_SIZE']."
                            ");
                            if ($original_size->num_rows() > 0) {
                                foreach($original_size->result() as $key_ori => $value_ori) {
                                    foreach($value_ori as $childkey_ori => $childvalue_ori) {
                                        $newget_ori[strtoupper($childkey_ori)] = $childvalue_ori;
                                    }
                                }
                            }

                            if (isset($newget_ori)) {
                                $newget[$newget_key]['ORIGINAL_SIZE'] = $newget_ori;
                            }
                        }
                        

                        $datapi['STATUS'] = 'SUCCESS';
                        $datapi['MESSAGE'] = 'USER SIZE HISTORY DATA';
                        $datapi['DATA'] = $newget;
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'DATA NOT FOUND';
                        $datapi['DATA'] = (object) array();
                    }
                    

                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'DATA NOT FOUND';
                    $datapi['DATA'] = (object) array();
                }

            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'USER_ID IS REQUIRED';
                $datapi['DATA'] = (object) array();
            }

        } else {
            $datapi = $check;
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($datapi));
    }

}
