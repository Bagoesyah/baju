<?php
# @Author: Awan Tengah
# @Date:   2017-03-30T13:39:48+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-03T03:47:40+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'template/frontend';
        $this->check_is_login();

        $this->load->model('custom_product_model');
        $this->load->model('order_product_model');
        $this->load->model('order_shipping_model');

        $this->load->model('product_model');
    }

    public function proceed() {
        $this->db->trans_start();

        $this->check_is_login();

        $get_slug = $this->input->post('SLUG', true);

        if(!is_null($get_slug)) {
            $post_get_product = array(
                'GET_BY' => 'slug',
                'VALUE' => $get_slug,
                'GET_METHOD' => 'ONE'
            );
            $check_slug = get_data_curl(base_url('api/product/get_product'), $post_get_product);

            if($check_slug->STATUS == 'FAILED') {
                show_404();
            }

            if(((!is_null($check_slug->DATA->ID_FABRIC) && !empty($check_slug->DATA->ID_FABRIC)) == false)) {
                show_404();
            }

            if(count($check_slug->DATA->PROMO)){
                $get_sum_price_custom = $check_slug->DATA->PRICE_AFTER_PROMO;
            }else{
                $get_sum_price_custom = $check_slug->DATA->PRICE;
            }
            

            $data_custom = array(
                'ID_USER' => $this->_user_login->id,
                'ID_FABRIC' => $check_slug->DATA->ID_FABRIC,
                'ID_COLLAR' => $check_slug->DATA->ID_COLLAR,
                'ID_BUTTON' => $check_slug->DATA->ID_BUTTON,
                'ID_BUTTON_HOLE' => $check_slug->DATA->ID_BUTTON_HOLES,
                'ID_BUTTON_THREAD' => $check_slug->DATA->ID_BUTTON_THREAD,
                'ID_CUFF' => $check_slug->DATA->ID_CUFF,
                'ID_SLEEVE' => $check_slug->DATA->ID_SLEEVE,
                'ID_BODY_TYPE_FRONT' => $check_slug->DATA->ID_BODY_FRONT,
                'ID_BODY_TYPE_BACK' => $check_slug->DATA->ID_BODY_BACK,
                'ID_BODY_TYPE_HEM' => $check_slug->DATA->ID_BODY_HEM,
                'ID_CLERIC_FABRIC' => $check_slug->DATA->ID_CLERIC_FABRIC,
                'ID_CLERIC_STITCH' => $check_slug->DATA->ID_CLERIC_STITCH,
                'ID_POCKET' => $check_slug->DATA->ID_POCKET,
                'ID_EMBROIDERY_POSITION' => $check_slug->DATA->ID_EMBROIDERY_POSITION,
                'ID_EMBROIDERY_FONT' => $check_slug->DATA->ID_EMBROIDERY_FONT,
                'ID_EMBROIDERY_COLOR' => $check_slug->DATA->ID_EMBROIDERY_COLOR,
                'ID_OPTION_AMF_STITCH' => $check_slug->DATA->ID_OPTION_AMF_STITCH,
                'ID_OPTION_INTERLINING' => $check_slug->DATA->ID_OPTION_INTERLINING,
                'ID_OPTION_SEWING' => $check_slug->DATA->ID_OPTION_SEWING,
                'ID_OPTION_TAPE' => $check_slug->DATA->ID_OPTION_TAPE,

                'EMBROIDERY_TEXT' => $this->session->userdata('sess_embroidery_text'),

                'CLERIC_TYPE' => '',
                'ID_CLERIC_1' => '',
                'ID_CLERIC_2' => '',
                'ID_CLERIC_3' => '',

                'IMAGE' => !empty($check_slug->DATA->IMAGE) ? $check_slug->DATA->IMAGE[0]->IMAGE : '',
                'PRICE' => $get_sum_price_custom,
                'QUANTITY' => '1'
            );
        } else {
            $get_sum_price_custom = $this->sum_price_custom();
            if($get_sum_price_custom == '0' || ((!is_null(get_session('id_fabric')) && !empty(get_session('id_fabric'))) == false)) {
                show_404();
            }

            $data_custom = array(
                'ID_USER' => $this->_user_login->id,
                'ID_FABRIC' => get_session('id_fabric'),
                'ID_COLLAR' => get_session('id_collar'),
                'ID_CUFF' => get_session('id_cuff'),
                'ID_SLEEVE' => get_session('id_sleeve'),
                'ID_BODY_TYPE_FRONT' => get_session('id_body_type_front'),
                'ID_BODY_TYPE_BACK' => get_session('id_body_type_back'),
                'ID_BODY_TYPE_HEM' => get_session('id_body_type_hem'),
                'ID_POCKET' => get_session('id_pocket'),
                'ID_BUTTON' => get_session('id_button'),
                'ID_BUTTON_HOLE' => get_session('id_button_hole'),
                'ID_BUTTON_THREAD' => get_session('id_button_thread'),
                'ID_CLERIC_FABRIC' => get_session('id_cleric_fabric'),
                'ID_CLERIC_STITCH' => get_session('id_cleric_stitch'),
                'ID_EMBROIDERY_POSITION' => get_session('id_embroidery_position'),
                'ID_EMBROIDERY_FONT' => get_session('id_embroidery_font'),
                'ID_EMBROIDERY_COLOR' => get_session('id_embroidery_color'),
                'ID_OPTION_AMF_STITCH' => get_session('id_option_amf_stitch'),
                'ID_OPTION_INTERLINING' => get_session('id_option_interlining'),
                'ID_OPTION_SEWING' => get_session('id_option_sewing'),
                'ID_OPTION_TAPE' => get_session('id_option_tape'),

                'EMBROIDERY_TEXT' => $this->session->userdata('sess_embroidery_text'),
                'IMAGE_CUSTOM' => $this->session->userdata('order_img'),

                'CLERIC_TYPE' => get_session('cleric_type_id'),
                'ID_CLERIC' => get_session('id_cleric'),
                //'ID_CLERIC_2' => get_session('id_cleric_2'),
                //'ID_CLERIC_3' => get_session('id_cleric_3'),

                'IMAGE' => get_session('image'),
                'PRICE' => $get_sum_price_custom,
                'SPECIAL_REQUEST_CUSTOM' => get_session('special_request_custom'),
                'SPECIAL_REQUEST_SIZE' => get_session('special_request_size'),
                'SPECIAL_REQUEST_VERIFY' => get_session('special_request_verify'),
                'QUANTITY' => '1'
            );

            $arr_main_array = get_session();
            $arr_result = array();
            foreach($arr_main_array as $key => $value) {
                $exp_key = explode('_', $key);
                if($exp_key[0] == 'price'){
                    $arr_result[$key] = $value;
                }
            }
            $data_custom['SESS_PRICE'] = json_encode($arr_result);
        }

        $result_curl_icp = get_data_curl(base_url('api/order/insert_custom_product'), $data_custom);

        if (isset($result_curl_icp->DATA->ID_CUSTOM_PRODUCT) && !is_null($result_curl_icp->DATA->ID_CUSTOM_PRODUCT))
        {

            $data_custom_product_size = array(
                'ID_CUSTOM_PRODUCT' => $result_curl_icp->DATA->ID_CUSTOM_PRODUCT,
                'ID_SIZE' => get_session('id_size'),
                'NECK' => get_session('neck_product_upsize'),
                'SHOULDER' => get_session('shoulder_product_upsize'),
                'CHEST' => get_session('chest_product_upsize'),
                'WAIST' => get_session('waist_product_upsize'),
                'HIP' => get_session('hip_product_upsize'),
                'ARM_HOLE' => get_session('arm_hole_product_upsize'),
                'BACK_LENGTH_88' => get_session('back_length_88_product_upsize'),
                'BACK_LENGTH_89' => get_session('back_length_89_product_upsize'),
                'ALOHA_88' => get_session('aloha_88_product_upsize'),
                'ALOHA_89' => get_session('aloha_89_product_upsize'),
                'CUFFS_CIRCLE' => get_session('cuffs_circle_product_upsize'),
                'SHORT_SLEEVE' => get_session('short_sleeve_product_upsize'),
                'SLEEVE_CIRCLE' => get_session('sleeve_circle_product_upsize'),

                // MAIN SIZE
                'BODY_TYPE_SELECTION' => get_session('body_type_selection'),
                'AROUND_NECK_SELECTION' => get_session('around_neck_selection'),
                'SLEEVE_TYPE_SELECTION' => get_session('sleeve_type_selection'),
                'SLEEVE_LENGTH_RIGHT_SELECTION' => get_session('sleeve_length_right_selection'),
                'SLEEVE_LENGTH_LEFT_SELECTION' => get_session('sleeve_length_left_selection'),
            );
            $insert_custom_product_size = get_data_curl(base_url('api/order/insert_custom_product_size'), $data_custom_product_size);

            $order_number = generate_order_number();
            if(!is_null(get_session('last_order_number')) && !empty(get_session('last_order_number'))) {
                $last_order_number = get_session('last_order_number');
            } else {
                set_session(array('last_order_number' => $order_number));
                $last_order_number = get_session('last_order_number');
            }

            $get_quantity = 1;
            if(!is_null($get_slug)) {
                $data_order = array(
                    'ID_USER' => $this->_user_login->id,
                    'ORDER_NUMBER' => $last_order_number,
                    'ORDER_TYPE' => '1', //product
                    'ID_CUSTOM_PRODUCT' => $result_curl_icp->DATA->ID_CUSTOM_PRODUCT,
                    'ID_PRODUCT' => $check_slug->DATA->ID,
                    'BASE' => get_session('price_id_fabric') * $get_quantity,
                    'OPTION' => ($get_sum_price_custom - get_session('price_id_fabric')) * $get_quantity,
                    'TAX' => ($get_sum_price_custom * $get_quantity) * 0.1,
                    'STATUS' => '1' //on cart
                );
                get_data_curl(base_url('api/order/insert_order_product'), $data_order);
            } else {
                $data_order = array(
                    'ID_USER' => $this->_user_login->id,
                    'ORDER_NUMBER' => $last_order_number,
                    'ORDER_TYPE' => '2', //custom
                    'ID_CUSTOM_PRODUCT' => $result_curl_icp->DATA->ID_CUSTOM_PRODUCT,
                    'BASE' => get_session('price_id_fabric') * $get_quantity,
                    'OPTION' => ($get_sum_price_custom - get_session('price_id_fabric')) * $get_quantity,
                    'TAX' => ($get_sum_price_custom * $get_quantity) * 0.1,
                    'STATUS' => '1' //on cart
                );
                get_data_curl(base_url('api/order/insert_order_product'), $data_order);
            }

            $this->unset_session_custom();

            $this->db->trans_complete();
            $trans_status = $this->db->trans_status();
            if ($trans_status === FALSE) {
                $this->db->trans_rollback();
            } else{
                $this->db->trans_commit();
            }
        } else {

            redirect('custom/verify', 'location');

        }

        if(!is_null($get_slug)) {
            return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(true));
        } else {
            redirect('cart');
        }
    }

    public function index() {
        if(is_null($this->_user_login)) {
            show_404();
        }

        if ($this->input->post('submit_promo_code')) {
            $this->load->model('coupon_model');
            $promo_code = $this->input->post('promo_code', true);
            $result = $this->coupon_model->first(
                array('code' => $promo_code,'status' => 1)
            );

            if ($result) {
                $now = strtotime(date('Y-m-d'));
                $date = strtotime($result->expired_at);

                if ($now <= $date) {
                    $this->session->set_userdata('promo_coupon', [
                        'code'  =>  $result->code,
                        'discount' => $result->discount,
                        'type' => $result->num_type,
                        'expired_at' => $result->expired_at
                    ]);

                    // Check if order has already have a coupon
                    $order_number = get_session('last_order_number');
                    $q = $this->db->query("SELECT id FROM order_product_coupon WHERE order_number = '$order_number'");
                    if ($q->num_rows() == 0) {
                        // Save To DB
                        $save_coupon = $this->db->insert('order_product_coupon', array(
                            'order_number' => get_session('last_order_number'),
                            'coupon_code' => $result->code,
                            'coupon_discount' => $result->discount,
                            'coupon_type' => $result->num_type
                        ));
                    } else {
                        // UPDATE EXISTING COUPON
                        $update_coupon = $this->db->update('order_product_coupon', array(
                            'order_number' => get_session('last_order_number'),
                            'coupon_code' => $result->code,
                            'coupon_discount' => $result->discount,
                            'coupon_type' => $result->num_type
                        ), array('order_number' => get_session('last_order_number')));
                    }
                    $this->session->set_flashdata('coupon_success', 'Coupon promo has been applied to your order.');
                } else {
                    $this->session->set_flashdata('coupon_error', 'Expired Coupon Code: ' . $promo_code);
                }
                
            } else {
                if ($promo_code == '') {
                    $this->session->set_flashdata('coupon_error', 'Type promo code');
                } else {
                    $this->session->set_flashdata('coupon_error', 'Invalid coupon code: <strong>'.$promo_code.'</strong>');
                }
            }

            redirect('cart');
        }

        $this->render('cart');
    }

    public function proceed_checkout() {
        $this->db->trans_start();

        $this->session->set_userdata('proceed_checkout', $this->_user_login->user_token);

        $data_get_order_product = array(
            'ID_USER' => $this->_user_login->id,
            'ORDER_STATUS' => '1' //on cart
        );
        $headers = array(
            'USER_TOKEN' => $this->_user_login->user_token
        );
        $get_order_on_cart = get_data_curl(base_url('api/order/get_order_product'), $data_get_order_product, $headers);

        foreach($get_order_on_cart->DATA as $row) {
            $data_order = array(
                'ID_ORDER_PRODUCT' => $row->ID,
                'ID_USER' => $this->_user_login->id,
                'ORDER_NUMBER' => get_session('last_order_number'),
                'ORDER_TYPE' => $row->ORDER_TYPE,
                'ID_CUSTOM_PRODUCT' => $row->ID_CUSTOM_PRODUCT,
                'BASE' => $row->BASE,
                'OPTION' => $row->OPTION,
                'DELIVERY_COST' => 0,
                'TAX' => $row->TAX,
                'STATUS' => '2' //waiting
            );
            get_data_curl(base_url('api/order/update_order_product_by_id_with_price'), $data_order);
        }

        $this->db->trans_complete();
        $trans_status = $this->db->trans_status();
        if ($trans_status === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            redirect('cart/shoping_bag');
        }
    }

    public function shoping_bag() {
        if(is_null(get_session('proceed_checkout'))) {
            show_404();
        }

        $this->session->unset_userdata('last_order_number');

        //
        $get_last_order_by_id_user = $this->order_product_model->first(
            array(
                'id_user' => $this->_user_login->id,
                'status' => '2' //waiting
            )
        );
        if($get_last_order_by_id_user) {
            $last_order_number = $get_last_order_by_id_user->order_number;
        } else {
            $last_order_number = '';
        }

        $post_order_shipping = array(
            'ID_USER' => $this->_user_login->id,
            'ORDER_NUMBER' => $last_order_number,
            'NUMERIC_PRICE' => true,
            'ORDER_STATUS' => '2' //waiting
        );
        $headers = array(
            'USER_TOKEN' => $this->_user_login->user_token
        );
        $data['order_shipping'] = get_data_curl(base_url('api/order/get_order_shipping'), $post_order_shipping);
        $data['sum_price_by_order_number'] = get_data_curl(base_url('api/order/get_sum_price'), $post_order_shipping, $headers);
        $this->render('shoping_bag', $data);
    }

    public function order_shipping() {
        if(is_null(get_session('proceed_checkout'))) {
            show_404();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('hp', 'hp', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('zip_code', 'zip code', 'required');

        if($this->form_validation->run() == false) {
            $this->shoping_bag();
        } else {
            $post_data = array(
                'ID_USER' => $this->_user_login->id,
                'NAME' => $this->input->post('name', true),
                'ADDRESS' => $this->input->post('address', true),
                'HP' => $this->input->post('hp', true),
                'EMAIL' => $this->input->post('email', true),
                'CITY' => $this->input->post('city', true),
                'PHONE' => $this->input->post('phone', true),
                'ZIP_CODE' => $this->input->post('zip_code', true)
            );
            $result = get_data_curl(base_url('api/order/insert_update_order_shipping'), $post_data);

            $this->session->set_flashdata('message', array('message' => ucwords(strtolower($result->MESSAGE)), 'class' => ($result->STATUS == 'SUCCESS' ? 'alert-success' : 'alert-danger') ));
            redirect('cart/shoping_bag');
        }
    }

    public function sum_price_custom() {
        $arr_main_array = get_session();
        $arr_result = array();
        foreach($arr_main_array as $key => $value) {
            $exp_key = explode('_', $key);
            if($exp_key[0] == 'price'){
                $arr_result[] = $value;
            }
        }
        if(!is_null($arr_result)) {
            $arr_sum = array_sum($arr_result);
        } else {
            $arr_sum = 0;
        }
        return $arr_sum;
    }

    public function unset_session_custom() {
        $unset_data = array(
            'id_fabric',
            'price_id_fabric',
            'id_collar',
            'price_id_collar',
            'id_cuff',
            'price_id_cuff',
            'id_sleeve',
            'price_id_sleeve',
            'id_body_type_front',
            'price_id_body_type_front',
            'id_body_type_back',
            'price_id_body_type_back',
            'id_body_type_hem',
            'price_id_body_type_hem',
            'id_pocket',
            'price_id_pocket',
            'id_button',
            'price_id_button',
            'id_button_hole',
            'price_id_button_hole',
            'id_button_thread',
            'price_id_button_thread',
            'id_cleric_fabric',
            'price_id_cleric_fabric',
            'id_cleric_stitch',
            'price_id_cleric_stitch',
            'id_embroidery_position',
            'price_id_embroidery_position',
            'id_embroidery_font',
            'price_id_embroidery_font',
            'id_embroidery_color',
            'price_id_embroidery_color',
            'id_option_amf_stitch',
            'price_id_option_amf_stitch',
            'id_option_interlining',
            'price_id_option_interlining',
            'id_option_sewing',
            'price_id_option_sewing',
            'id_option_tape',
            'price_id_option_tape',
            'image',
            'price',
            'special_request_custom',

            'cleric_type',
            'cleric_type_id',
            'id_cleric',
            //'id_cleric_2',
            //'id_cleric_3',

            'sess_embroidery_text',
            'order_img',
            'promo_coupon',

            'id_size',
            'neck_product_upsize',
            'shoulder_product_upsize',
            'chest_product_upsize',
            'waist_product_upsize',
            'hip_product_upsize',
            'arm_hole_product_upsize',
            'back_length_88_product_upsize',
            'back_length_89_product_upsize',
            'aloha_88_product_upsize',
            'aloha_89_product_upsize',
            'cuffs_circle_product_upsize',
            'short_sleeve_product_upsize',
            'sleeve_circle_product_upsize',

            'around_neck_selection',
            'body_type_selection',
            'sleeve_type_selection',
            'sleeve_length_right_selection',
            'sleeve_length_left_selection',

            // Correction Size
            'neck_correction',
            'shoulder_correction',
            'chest_correction',
            'waist_correction',
            'hip_correction',
            'arm_hole_correction',
            'back_length_88_correction',
            'back_length_89_correction',
            'aloha_88_correction',
            'cuffs_circle_correction',
            'short_sleeve_correction',
            'sleeve_circle_correction',

            'special_request_size',
            'special_request_verify',
            'quantity',
            // 'last_order_number',
            'proceed_checkout',

            // SKIN OBJECT
            'skin_id_fabric',
            'skin_id_collar',
            'skin_id_cuff',
            'skin_id_button',
            'skin_id_button_hole',
            'skin_id_button_thread',
            'skin_id_pocket',
            'obj_id_pocket',
            'obj_id_collar',
            'obj_id_cuff',
            'obj_id_sleeve',
            'skin_id_lower_placket',
            'skin_id_front_placket',
            'skin_id_inner_collar',
            'skin_id_inner_cuffs',
            'skin_id_cuffs',

            'skin_id_collar_cuff',
            'skin_id_collar_cuff_front_placket',
            'skin_id_inner_collar_cuff',
            'skin_id_inner_collar_cuff_lower_placket',

            'price_id_cleric',
            // Added Collar Button
            'obj_collar_button',
            'obj_collar_button_hole',
            'obj_collar_button_thread',
            //'price_id_cleric_2',
            //'price_id_cleric_3',
        );
        $this->session->unset_userdata($unset_data);
    }

    public function check_shipping()
    {
        $id = $this->input->post('id');
        if ($id) {
            $q = $this->db->query("
                SELECT id FROM order_shipping WHERE id_user = $id LIMIT 1
            ");
            if ($q->num_rows() > 0) {
                return json_encode(array('status' => 200));
            } else {
                return json_encode(array('status' => 500));
            }
        }
    }

    public function save_shipping()
    {
        $id = $this->input->post('id');
    }

    public function confirm_checkout()
    {
        $bank_list = $this->db->query("
            SELECT * FROM payment_list WHERE deleted_at IS NULL ORDER BY bank_name ASC
        ");

        $get_last_order_by_id_user = $this->order_product_model->first(
            array(
                'id_user' => $this->_user_login->id,
                'status' => '2' //waiting
            )
        );
        if($get_last_order_by_id_user) {
            $last_order_number = $get_last_order_by_id_user->order_number;
        }

        if (isset($last_order_number) && $last_order_number != '') {
            $post_order_shipping = array(
                'ID_USER' => $this->_user_login->id,
                'ORDER_NUMBER' => $last_order_number,
                'NUMERIC_PRICE' => true,
                'ORDER_STATUS' => '2' //waiting
            );
            $headers = array(
                'USER_TOKEN' => $this->_user_login->user_token
            );
            $data['order_shipping'] = get_data_curl(base_url('api/order/get_order_shipping'), $post_order_shipping);
            $data['sum_price_by_order_number'] = get_data_curl(base_url('api/order/get_sum_price'), $post_order_shipping, $headers);
            $data['order_products'] = get_data_curl(base_url('api/order/get_order_product'), [
                'ORDER_NUMBER' => $last_order_number,
                'ID_USER' => $this->_user_login->id
            ], $headers);
            //echo '<pre>';
            //print_r($data['order_products']);die();
            if ($data['sum_price_by_order_number']->DATA->ORDER_NUMBER) {
                $data['bank_list'] = $bank_list;
                $this->render('confirm_checkout', $data);
            }
        } else {
            redirect('', 'location');
        }
    }

    public function confirm_check_manual()
    {
        //$this->session->unset_userdata('last_order_number');
        $last_order_number = $this->session->userdata('last_order_number');
        $id_payment_list = $this->input->post('bank_name');
        $bank_list = $this->db->query("
            SELECT * FROM payment_list WHERE id = $id_payment_list
        ");

        if (is_null($last_order_number)) {
            $get_last_order_by_id_user = $this->order_product_model->first(
                array(
                    'id_user' => $this->_user_login->id,
                    'status' => '2' //waiting
                )
            );
            if($get_last_order_by_id_user) {
                $last_order_number = $get_last_order_by_id_user->order_number;
            }
        }

        if (isset($last_order_number) && $last_order_number != '') {
            $post_order_shipping = array(
                'ID_USER' => $this->_user_login->id,
                'ORDER_NUMBER' => $last_order_number,
                'NUMERIC_PRICE' => true,
                'ORDER_STATUS' => '2' //waiting
            );
            $headers = array(
                'USER_TOKEN' => $this->_user_login->user_token
            );
            $data['order_shipping'] = get_data_curl(base_url('api/order/get_order_shipping'), $post_order_shipping);
            $data['sum_price_by_order_number'] = get_data_curl(base_url('api/order/get_sum_price'), $post_order_shipping, $headers);
            $data['order_products'] = get_data_curl(base_url('api/order/get_order_product'), [
                'ORDER_NUMBER' => $last_order_number,
                'ID_USER' => $this->_user_login->id
            ], $headers);
            $data['order_number'] = $last_order_number;
            if ($data['sum_price_by_order_number']->DATA->ORDER_NUMBER) {

                // INSERT PAYMENT HISTORY
                $q_check_payment = $this->db->query("
                    SELECT id, expired_at FROM payment_history WHERE order_number = '".$data['sum_price_by_order_number']->DATA->ORDER_NUMBER."'
                ");
                if ($q_check_payment->num_rows() > 0) {
                    
                    $data['expired'] = $q_check_payment->row()->expired_at;

                } else {
                    // INSERT
                    $date_expired = date('Y-m-d H:i:s', strtotime('+2 hours'));
                    $data['expired'] = $date_expired;
                    $data_insert = array(
                        'id_user' => $this->_user_login->id,
                        'order_number' => $data['sum_price_by_order_number']->DATA->ORDER_NUMBER,
                        'payment_method' => 'manual_transfer',
                        'created_at' => date('Y-m-d H:i:s'),
                        'expired_at' => $date_expired,
                    );
                    $insert_history = $this->db->insert('payment_history', $data_insert);
                    if ($insert_history) {
                        $this->session->unset_userdata('last_order_number');
                        // UPDATE ORDER STATUS
                        $this->db->update('order_product', array('status' => 3), array('order_number' => $data['sum_price_by_order_number']->DATA->ORDER_NUMBER));
                    }
                }

                $data['bank_list'] = $bank_list;
                $this->render('confirm_check_manual', $data);
            }
        } else {
            redirect('', 'location');
        }
    }

    public function set_confirm_payment()
    {
        $acc_number = $this->input->post('acc_number');
        $payment_list = $this->input->post('payment_list');
        $pay_type = 1;
        $acc_name = $this->input->post('acc_name');
        $pay_amount = $this->input->post('pay_amount');
        $img_file = $this->input->post('img_file');
        $order_number = $this->input->post('order_num');
        $notes = $this->input->post('notes');

        if ($acc_name) {

            $headers = array(
                'USER_TOKEN' => $this->_user_login->user_token
            );
            $post_order_shipping = array(
                'ID_USER' => $this->_user_login->id,
                'ORDER_NUMBER' => $order_number,
                'NUMERIC_PRICE' => true,
                'ORDER_STATUS' => '3' //waiting
            );
            $price_total = get_data_curl(base_url('api/order/get_sum_price'), $post_order_shipping, $headers);
            
            $data = array(
                'id_user' => $this->_user_login->id,
                'order_number' => $order_number,
                'price_total' => $price_total->DATA->PRICE_TOTAL,
                'payment_date' => date('Y-m-d H:i:s'),
                'payment_method' => $pay_type,
                'sender_account' => $acc_number,
                'sender_acc_name' => $acc_name,
                'destination_account' => $payment_list,
                'payment_amount' => $pay_amount,
                'filename' => '',
                'information' => $notes
            );

            if ($this->input->post('img_file') && $this->input->post('img_file') != '') {
                $this->load->helper('string');
                $custom_img_filename = random_string('alnum', 32).'.png';
                $img_data = $this->input->post('img_file');
                list($type, $img_data) = explode(';', $img_data);
                list(, $img_data)      = explode(',', $img_data);
                $img_data = base64_decode($img_data);
                file_put_contents('assets/img/img_confirm_order/' . $custom_img_filename, $img_data);
                
                $config_gd['source_image'] = 'assets/img/img_confirm_order/' . $custom_img_filename;
                $config_gd['width'] = 400;
                $config_gd['maintain_ratio'] = TRUE;

                $this->load->library('image_lib');
                $this->image_lib->initialize($config_gd);
                $this->image_lib->resize();
                
                $data['filename'] = $custom_img_filename;
            }

            $insert = $this->db->insert('confirmation_order', $data);
            if ($insert) {

                // Update Order Status
                $order_update = $this->db->update('order_product', array('status' => 4), array('order_number' => $order_number));

                // Send Order Notification
                get_data_curl(base_url('api/order/send_order_notification/' . $order_number), null, null);
                
                echo json_encode(array('status' => 200));die();
            }

        }

        echo json_encode(array('status' => 500));

    }
}
