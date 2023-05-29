<?php
# @Author: Awan Tengah
# @Date:   2017-03-17T13:59:01+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-26T20:41:36+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Custom extends MY_Controller {

    public $_nav_head;

    public function __construct() {
        parent::__construct();
        $this->load->model('material_fabric_model');
        $this->load->model('material_collar_model');
        $this->load->model('material_buttons_model');
        $this->load->model('material_cuff_model');
        $this->load->model('material_body_type_model');
        $this->load->model('material_pocket_model');
        $this->load->model('material_embroidery_model');
        $this->load->model('material_option_model');
        $this->load->model('material_cleric_model');

        $this->load->model('material_neck_size_model');
        $this->load->model('material_sleeve_type_model');
        $this->load->model('material_long_sleeve_model');
        $this->load->model('material_body_size_model');

        $this->load->model('material_shoulder_width_model');
        $this->load->model('material_chest_circumference_model');

        $this->layout = 'template/frontend';

        $url = site_url($this->uri->uri_string());
        $redirect_url = $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
        $this->session->set_userdata('redirect', $redirect_url);
        // warning
        $this->session->keep_flashdata('check_verify');
    }

    // public function menu()
    // {
    //     if (isset($_GET['p']) && $_GET['p'] == 'default') {
    //         $this->unset_custom_param();
    //     }

    //     $this->_nav_head = 'menu';
    //     $this->render('custom/menu', $data);
    // }

    public function index()
    {
        if (isset($_GET['p']) && $_GET['p'] == 'default') {
            $this->unset_custom_param();
        }

        $this->_nav_head = 'custom';
        $this->render('custom/index');
        // $this->load->view('template/frontend/custom/index');
    }


    public function fabric()
    {
        $data['material_fabric'] = get_data_curl(base_url('api/material/get_material_fabric?category=standard'));
        $data['count_fabric'] = $this->material_fabric_model->count();
        $this->_nav_head = 'fabric';
        $this->load->view('template/frontend/custom/fabric', $data);
        // $this->render('custom/fabric', $data);
    }
    
    public function collar()
    {
        $data['material_collar'] = get_data_curl(base_url('api/material/get_material_collar'));
        $data['count_collar'] = $this->material_collar_model->count();
        $this->_nav_head = 'collar';
        $this->load->view('template/frontend/custom/collar', $data);
        // $this->render('custom/collar', $data);
    }

    public function buttons() {
        $data['material_buttons'] = get_data_curl(base_url('api/material/get_material_buttons?category=button'));
        $data['count_buttons'] = $this->material_buttons_model->count();
        $this->_nav_head = 'buttons';
        $this->load->view('template/frontend/custom/buttons', $data);
    }

    public function cuffs()
    {
        $data['material_cuff'] = get_data_curl(base_url('api/material/get_material_cuff'));
        $data['material_sleeve'] = get_data_curl(base_url('api/material/get_material_sleeve'));
        $data['count_cuff'] = $this->material_cuff_model->count();
        $data['count_sleeve'] = $data['material_sleeve']->STATUS == 'FAILED' ? 0 : count($data['material_sleeve']->DATA);
        $this->_nav_head = 'cuff';
        $this->load->view('template/frontend/custom/cuff', $data);
        // $this->render('custom/cuff', $data);
    }

    public function body_type() {
        $data['material_body_type'] = get_data_curl(base_url('api/material/get_material_body_type?category=front'));
        $this->_nav_head = 'body_type';
        $this->load->view('template/frontend/custom/body_type', $data);
        // $this->render('custom/body_type', $data);
    }

    public function cleric() {
        // $this->session->set_flashdata('check_verify', 'Ccccccannot proceed to Verify, you must complete the order.');
        $data['material_cleric'] = get_data_curl(base_url('api/material/get_material_fabric'));
        $this->_nav_head = 'cleric';
        $this->load->view('template/frontend/custom/cleric', $data);
        // $this->render('custom/cleric', $data);
    }

    public function pocket() {
        $data['material_pocket'] = get_data_curl(base_url('api/material/get_material_pocket'));
        $this->_nav_head = 'pocket';
        $this->load->view('template/frontend/custom/pocket', $data);
        // $this->render('custom/pocket', $data);
    }

    public function embroidery() {
        $data['material_embroidery'] = get_data_curl(base_url('api/material/get_material_embroidery?category=position'));
        $this->_nav_head = 'embroidery';
        $this->load->view('template/frontend/custom/embroidery', $data);
        // $this->render('custom/embroidery', $data);
    }

    public function option() {
        $data['material_option'] = get_data_curl(base_url('api/material/get_material_option?category=amf_stitch'));
        $this->_nav_head = 'option';
        $this->load->view('template/frontend/custom/option', $data);
        // $this->render('custom/option', $data);
    }

    public function other() {
        $data['around_the_neck_size'] = get_data_curl(base_url('api/material/get_material_neck_size'));
        $data['sleeve_type'] = get_data_curl(base_url('api/material/get_material_sleeve_type'));
        $data['long_sleeve'] = get_data_curl(base_url('api/material/get_material_long_sleeve'));
        $data['body_size'] = get_data_curl(base_url('api/material/get_material_body_size'));
        $data['shoulder_width'] = get_data_curl(base_url('api/material/get_material_shoulder_width'));
        $data['chest_circumference'] = get_data_curl(base_url('api/material/get_material_chest_circumference'));
        $this->_nav_head = 'other';
        $this->load->view('template/frontend/custom/other', $data);
        // $this->render('custom/other', $data);
    }

    // public function verify() {
    //     $data = array();
    //     $this->_nav_head = 'verify';

    //     $data['embroidery_text'] = $this->session->userdata('sess_embroidery_text') && $this->session->userdata('sess_embroidery_text') != '' ? 
    //         $this->session->userdata('sess_embroidery_text') : NULL;
        
    //     if(is_null(get_session('around_neck_selection'))) {
    //         $this->session->set_flashdata('check_verify', 'Cannot proceed to Verify, you must complete the order.');
    //         redirect('custom/other', 'location');
    //     }

    //     // if(!is_null(get_session('id_size')) && !empty(get_session('id_size'))) {
    //     //     // $data['id_size'] = $this->material_neck_size_model->first(get_session('id_size'));
    //     // }else {
    //     //      $this->session->set_flashdata('check_verify', 'Cannot proceed to Verify, you must complete the order.');
    //     //      redirect('custom/other', 'location');
    //     // }

    //     if (
    //         (!is_null(get_session('id_embroidery_position')) && (is_null(get_session('id_embroidery_font')) || is_null(get_session('id_embroidery_color')))) ||
    //         (!is_null(get_session('id_embroidery_font')) && (is_null(get_session('id_embroidery_position')) || is_null(get_session('id_embroidery_color')))) ||
    //         (!is_null(get_session('id_embroidery_color')) && (is_null(get_session('id_embroidery_position')) || is_null(get_session('id_embroidery_color')))) ||
    //         ((!is_null(get_session('id_embroidery_color')) || !is_null(get_session('id_embroidery_position')) || !is_null(get_session('id_embroidery_font'))) && !$data['embroidery_text'])
    //     ) {
    //         $this->session->set_flashdata('check_verify', 'Cannot proceed to Verify, you must complete the order (Embroidery position, embroidery font, embroidery color and embroidery text).');
    //         redirect('custom/embroidery', 'location');
    //     }

    //     if(!is_null(get_session('id_fabric')) && !empty(get_session('id_fabric'))) {
    //         $data['fabric'] = $this->material_fabric_model->first(get_session('id_fabric'));
    //     }
    //     else {
    //          $this->session->set_flashdata('check_verify', 'Cannot proceed to Verify, you must complete the order.');
    //          redirect('custom/other', 'location');
    //     }
    //     if(!is_null(get_session('id_collar')) && !empty(get_session('id_collar'))) {
    //         $data['collar'] = $this->material_collar_model->first(get_session('id_collar'));
    //     }
    //     if(!is_null(get_session('id_cuff')) && !empty(get_session('id_cuff'))) {
    //         $data['cuff'] = $this->material_cuff_model->first(get_session('id_cuff'));
    //     }
    //     if(!is_null(get_session('id_sleeve')) && !empty(get_session('id_sleeve'))) {
    //         $data['sleeve'] = $this->material_cuff_model->first(get_session('id_sleeve'));
    //     }
    //     if(!is_null(get_session('id_body_type_front')) && !empty(get_session('id_body_type_front'))) {
    //         $data['body_type_front'] = $this->material_body_type_model->first(get_session('id_body_type_front'));
    //     }
    //     if(!is_null(get_session('id_body_type_back')) && !empty(get_session('id_body_type_back'))) {
    //         $data['body_type_back'] = $this->material_body_type_model->first(get_session('id_body_type_back'));
    //     }
    //     if(!is_null(get_session('id_body_type_hem')) && !empty(get_session('id_body_type_hem'))) {
    //         $data['body_type_hem'] = $this->material_body_type_model->first(get_session('id_body_type_hem'));
    //     }
    //     if(!is_null(get_session('id_pocket')) && !empty(get_session('id_pocket'))) {
    //         $data['pocket'] = $this->material_pocket_model->first(get_session('id_pocket'));
    //     }
    //     if(!is_null(get_session('id_button')) && !empty(get_session('id_button'))) {
    //         $data['button'] = $this->material_buttons_model->first(get_session('id_button'));
    //     }
    //     if(!is_null(get_session('id_button_hole')) && !empty(get_session('id_button_hole'))) {
    //         $data['button_hole'] = $this->material_buttons_model->first(get_session('id_button_hole'));
    //     }
    //     if(!is_null(get_session('id_button_thread')) && !empty(get_session('id_button_thread'))) {
    //         $data['button_thread'] = $this->material_buttons_model->first(get_session('id_button_thread'));
    //     }
    //     if(!is_null(get_session('id_cleric_fabric')) && !empty(get_session('id_cleric_fabric'))) {
    //         $data['cleric_fabric'] = $this->material_fabric_model->first(get_session('id_cleric_fabric'));
    //     }
    //     if(!is_null(get_session('id_cleric_stitch')) && !empty(get_session('id_cleric_stitch'))) {
    //         $data['cleric_stitch'] = $this->material_fabric_model->first(get_session('id_cleric_stitch'));
    //     }
    //     if(!is_null(get_session('id_embroidery_position')) && !empty(get_session('id_embroidery_position'))) {
    //         $data['embroidery_position'] = $this->material_embroidery_model->first(get_session('id_embroidery_position'));
    //     }
    //     if(!is_null(get_session('id_embroidery_font')) && !empty(get_session('id_embroidery_font'))) {
    //         $data['embroidery_font'] = $this->material_embroidery_model->first(get_session('id_embroidery_font'));
    //     }
    //     if(!is_null(get_session('id_embroidery_color')) && !empty(get_session('id_embroidery_color'))) {
    //         $data['embroidery_color'] = $this->material_embroidery_model->first(get_session('id_embroidery_color'));
    //     }
    //     if(!is_null(get_session('id_option_amf_stitch')) && !empty(get_session('id_option_amf_stitch'))) {
    //         $data['option_amf_stitch'] = $this->material_option_model->first(get_session('id_option_amf_stitch'));
    //     }
    //     if(!is_null(get_session('id_option_interlining')) && !empty(get_session('id_option_interlining'))) {
    //         $data['option_interlining'] = $this->material_option_model->first(get_session('id_option_interlining'));
    //     }
    //     if(!is_null(get_session('id_option_sewing')) && !empty(get_session('id_option_sewing'))) {
    //         $data['option_sewing'] = $this->material_option_model->first(get_session('id_option_sewing'));
    //     }
    //     if(!is_null(get_session('id_option_tape')) && !empty(get_session('id_option_tape'))) {
    //         $data['option_tape'] = $this->material_option_model->first(get_session('id_option_tape'));
    //     }

    //     if(!is_null(get_session('cleric_type_id')) && !empty(get_session('cleric_type_id'))) {
    //         if(!is_null(get_session('id_cleric')) && !empty(get_session('id_cleric'))) {
    //             $data['cleric'] = $this->material_cleric_model->all(
    //                 array(
    //                     'fields' => 'material_cleric.*',
    //                     'where' => array(
    //                         'material_cleric.id' => get_session('id_cleric')
    //                     )
    //                 ), false
    //             );
    //         }
    //     }
    // $this->load->view('template/frontend/custom/verify', $data);
    // }

    public function verify() {
        $data = array();
        $this->_nav_head = 'verify';

        $data['embroidery_text'] = $this->session->userdata('sess_embroidery_text') && $this->session->userdata('sess_embroidery_text') != '' ? 
            $this->session->userdata('sess_embroidery_text') : NULL;
        
        if(is_null(get_session('around_neck_selection'))) {
            $this->session->set_flashdata('check_verify', 'Cannot proceed to Verify, you must complete the order.');
            // redirect('custom/other', 'location');
        }

        if (
            (!is_null(get_session('id_embroidery_position')) && (is_null(get_session('id_embroidery_font')) || is_null(get_session('id_embroidery_color')))) ||
            (!is_null(get_session('id_embroidery_font')) && (is_null(get_session('id_embroidery_position')) || is_null(get_session('id_embroidery_color')))) ||
            (!is_null(get_session('id_embroidery_color')) && (is_null(get_session('id_embroidery_position')) || is_null(get_session('id_embroidery_color')))) ||
            ((!is_null(get_session('id_embroidery_color')) || !is_null(get_session('id_embroidery_position')) || !is_null(get_session('id_embroidery_font'))) && !$data['embroidery_text'])
        ) {
            $this->session->set_flashdata('check_verify', 'Cannot proceed to Verify, you must complete the order (Embroidery position, embroidery font, embroidery color and embroidery text).');
            redirect('custom/embroidery', 'location');
        }

        if(!is_null(get_session('id_fabric')) && !empty(get_session('id_fabric'))) {
            $data['fabric'] = $this->material_fabric_model->first(get_session('id_fabric'));
        } else {
            $this->session->set_flashdata('check_verify', 'Cannot proceed to Verify, you must complete the order.');
            redirect('custom/fabric', 'location');
        }
        if(!is_null(get_session('id_collar')) && !empty(get_session('id_collar'))) {
            $data['collar'] = $this->material_collar_model->first(get_session('id_collar'));
        }
        if(!is_null(get_session('id_cuff')) && !empty(get_session('id_cuff'))) {
            $data['cuff'] = $this->material_cuff_model->first(get_session('id_cuff'));
        }
        if(!is_null(get_session('id_sleeve')) && !empty(get_session('id_sleeve'))) {
            $data['sleeve'] = $this->material_cuff_model->first(get_session('id_sleeve'));
        }
        if(!is_null(get_session('id_body_type_front')) && !empty(get_session('id_body_type_front'))) {
            $data['body_type_front'] = $this->material_body_type_model->first(get_session('id_body_type_front'));
        }
        if(!is_null(get_session('id_body_type_back')) && !empty(get_session('id_body_type_back'))) {
            $data['body_type_back'] = $this->material_body_type_model->first(get_session('id_body_type_back'));
        }
        if(!is_null(get_session('id_body_type_hem')) && !empty(get_session('id_body_type_hem'))) {
            $data['body_type_hem'] = $this->material_body_type_model->first(get_session('id_body_type_hem'));
        }
        if(!is_null(get_session('id_pocket')) && !empty(get_session('id_pocket'))) {
            $data['pocket'] = $this->material_pocket_model->first(get_session('id_pocket'));
        }
        if(!is_null(get_session('id_button')) && !empty(get_session('id_button'))) {
            $data['button'] = $this->material_buttons_model->first(get_session('id_button'));
        }
        if(!is_null(get_session('id_button_hole')) && !empty(get_session('id_button_hole'))) {
            $data['button_hole'] = $this->material_buttons_model->first(get_session('id_button_hole'));
        }
        if(!is_null(get_session('id_button_thread')) && !empty(get_session('id_button_thread'))) {
            $data['button_thread'] = $this->material_buttons_model->first(get_session('id_button_thread'));
        }
        if(!is_null(get_session('id_cleric_fabric')) && !empty(get_session('id_cleric_fabric'))) {
            $data['cleric_fabric'] = $this->material_fabric_model->first(get_session('id_cleric_fabric'));
        }
        if(!is_null(get_session('id_cleric_stitch')) && !empty(get_session('id_cleric_stitch'))) {
            $data['cleric_stitch'] = $this->material_fabric_model->first(get_session('id_cleric_stitch'));
        }
        if(!is_null(get_session('id_embroidery_position')) && !empty(get_session('id_embroidery_position'))) {
            $data['embroidery_position'] = $this->material_embroidery_model->first(get_session('id_embroidery_position'));
        }
        if(!is_null(get_session('id_embroidery_font')) && !empty(get_session('id_embroidery_font'))) {
            $data['embroidery_font'] = $this->material_embroidery_model->first(get_session('id_embroidery_font'));
        }
        if(!is_null(get_session('id_embroidery_color')) && !empty(get_session('id_embroidery_color'))) {
            $data['embroidery_color'] = $this->material_embroidery_model->first(get_session('id_embroidery_color'));
        }
        if(!is_null(get_session('id_option_amf_stitch')) && !empty(get_session('id_option_amf_stitch'))) {
            $data['option_amf_stitch'] = $this->material_option_model->first(get_session('id_option_amf_stitch'));
        }
        if(!is_null(get_session('id_option_interlining')) && !empty(get_session('id_option_interlining'))) {
            $data['option_interlining'] = $this->material_option_model->first(get_session('id_option_interlining'));
        }
        if(!is_null(get_session('id_option_sewing')) && !empty(get_session('id_option_sewing'))) {
            $data['option_sewing'] = $this->material_option_model->first(get_session('id_option_sewing'));
        }
        if(!is_null(get_session('id_option_tape')) && !empty(get_session('id_option_tape'))) {
            $data['option_tape'] = $this->material_option_model->first(get_session('id_option_tape'));
        }

        if(!is_null(get_session('cleric_type_id')) && !empty(get_session('cleric_type_id'))) {
            if(!is_null(get_session('id_cleric')) && !empty(get_session('id_cleric'))) {
                $data['cleric'] = $this->material_cleric_model->all(
                    array(
                        'fields' => 'material_cleric.*',
                        'where' => array(
                            'material_cleric.id' => get_session('id_cleric')
                        )
                    ), false
                );
            }
        }
        $this->load->view('template/frontend/custom/verify', $data);
        // $this->render('custom/verify', $data);
    }

    public function unset_custom_param()
    {
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
            'special_request_custom',
            'cleric_type',
            'cleric_type_id',
            'id_cleric',
            //'id_cleric_2',
            //'id_cleric_3',
            'image',
            'price',
            'sess_embroidery_text',
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
            'id_size',
            'around_neck_selection',
            'body_type_selection',
            'sleeve_type_selection',
            'sleeve_length_right_selection',
            'sleeve_length_left_selection',

            // SIZE CORRECTION
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

        // SET DEFAULT SESSION

        // FABRIC: NONE
        // $q_fabric = $this->db->query("
        //     SELECT * FROM material_fabric WHERE 
        // ");
        // if ($q_fabric->num_rows() > 0) {
        //     $row_fabric = $q_fabric->row();
        //     $this->session->set_userdata('id_fabric', $row_fabric->id);
        //     $this->session->set_userdata('price_id_fabric', $row_fabric->price);
        //     // $this->session->set_userdata('skin_id_fabric', $row_fabric->image);
        // }
        // $q_fabric = $this->db->query("select * from material_fabric WHERE");

        // COLLAR
        $q_collar = $this->db->query("
            SELECT * FROM material_collar WHERE is_default = 1 AND deleted_at IS NULL LIMIT 1
        ");
        if ($q_collar->num_rows() > 0) {
            $row_collar = $q_collar->row();
            $this->session->set_userdata('id_collar', $row_collar->id);
            $this->session->set_userdata('price_id_collar', $row_collar->price);
            //$this->session->set_userdata('skin_id_collar', $row_collar->image);
            if (!empty($row_collar->object)) $this->session->set_userdata('obj_id_collar', $row_collar->object);
            if (!empty($row_collar->button_obj)) $this->session->set_userdata('obj_collar_button', $row_collar->button_obj);
            if (!empty($row_collar->button_hole_obj)) $this->session->set_userdata('obj_collar_button_hole', $row_collar->button_hole_obj);
            if (!empty($row_collar->button_thread_obj)) $this->session->set_userdata('obj_collar_button_thread', $row_collar->button_thread_obj);
        }
        // CUFFS
        $q_cuff = $this->db->query("
            SELECT * FROM material_cuff WHERE is_default = 1 AND deleted_at IS NULL
        ");
        if ($q_cuff->num_rows() > 0) {
            foreach ($q_cuff->result() as $row_cuff) {
                if ($row_cuff->category == 1) {
                    $this->session->set_userdata('id_cuff', $row_cuff->id);
                    $this->session->set_userdata('price_id_cuff', $row_cuff->price);
                    $this->session->set_userdata('skin_id_cuff', $row_cuff->image);
                    if (!empty($row_cuff->object)) $this->session->set_userdata('obj_id_cuff', $row_cuff->object);
                } else if ($row_cuff->category == 2) {
                    $this->session->set_userdata('id_sleeve', $row_cuff->id);
                    $this->session->set_userdata('price_id_sleeve', $row_cuff->price);
                    $this->session->set_userdata('skin_id_sleeve', $row_cuff->image);
                    if (!empty($row_cuff->object)) $this->session->set_userdata('obj_id_sleeve', $row_cuff->object);
                }
            }
        }

        // BODY TYPE
        $q_body_type = $this->db->query("
            SELECT * FROM material_body_type WHERE is_default = 1 AND deleted_at IS NULL
        ");
        if ($q_body_type->num_rows() > 0) {
            
            foreach($q_body_type->result() as $row_body_type) {
                // BODY TYPE FRONT
                if ($row_body_type->category == 1) {
                    $this->session->set_userdata('id_body_type_front', $row_body_type->id);
                    $this->session->set_userdata('price_id_body_type_front', $row_body_type->price);
                    //$this->session->set_userdata('skin_id_body_type_front', $row_cuff->image);
                }
                // BODY TYPE BACK
                else if ($row_body_type->category == 2) {
                    $this->session->set_userdata('id_body_type_back', $row_body_type->id);
                    $this->session->set_userdata('price_id_body_type_back', $row_body_type->price);
                    //$this->session->set_userdata('skin_id_body_type_front', $row_cuff->image);
                } 
                // BODY TYPE HEM
                else {
                    $this->session->set_userdata('id_body_type_hem', $row_body_type->id);
                    $this->session->set_userdata('price_id_body_type_hem', $row_body_type->price);
                    //$this->session->set_userdata('skin_id_body_type_front', $row_cuff->image);
                }
            }
        }
        
        // POCKET
        $q_pocket = $this->db->query("
            SELECT * FROM material_pocket WHERE is_default = 1 AND deleted_at IS NULL LIMIT 1
        ");
        if ($q_pocket->num_rows() > 0) {
            $row_pocket = $q_pocket->row();
            $this->session->set_userdata('id_pocket', $row_pocket->id);
            $this->session->set_userdata('price_id_pocket', $row_pocket->price);
            //$this->session->set_userdata('skin_id_pocket', $row_pocket->image);
            if (!empty($row_pocket->object)) $this->session->set_userdata('obj_id_pocket', $row_pocket->object);
        }

        // BUTTONS
        $q_buttons = $this->db->query("
            SELECT * FROM material_buttons WHERE is_default = 1 AND deleted_at IS NULL
        ");
        if ($q_buttons->num_rows() > 0) {
            
            foreach($q_buttons->result() as $row_buttons) {
                // BUTTON
                if ($row_buttons->category == 1) {
                    $this->session->set_userdata('id_button', $row_buttons->id);
                    $this->session->set_userdata('price_id_button', $row_buttons->price);
                    $this->session->set_userdata('skin_id_button', $row_buttons->image);
                }
                // BUTTON HOLE
                else if ($row_buttons->category == 2) {
                    $this->session->set_userdata('id_button_hole', $row_buttons->id);
                    $this->session->set_userdata('price_id_button_hole', $row_buttons->price);
                    $this->session->set_userdata('skin_id_button_hole', $row_buttons->image);
                } 
                // BUTTON THREAD
                else {
                    $this->session->set_userdata('id_button_thread', $row_buttons->id);
                    $this->session->set_userdata('price_id_button_thread', $row_buttons->price);
                    $this->session->set_userdata('skin_id_button_thread', $row_buttons->image);
                }
            }
        }
        // CLERIC: NONE
        // EMBRIODERY: NONE

        // OPTION
        $q_option = $this->db->query("
            SELECT * FROM material_option WHERE is_default = 1 AND deleted_at IS NULL
        ");
        if ($q_option->num_rows() > 0) {
            
            foreach($q_option->result() as $row_option) {
                // OPTION AMF
                if ($row_option->category == 1) {
                    $this->session->set_userdata('id_option_amf_stitch', $row_option->id);
                    $this->session->set_userdata('price_id_option_amf_stitch', $row_option->price);
                    $this->session->set_userdata('skin_id_option_amf_stitch', $row_option->image);
                }
                // OPTION INTERLINING
                else if ($row_option->category == 2) {
                    $this->session->set_userdata('id_option_interlining', $row_option->id);
                    $this->session->set_userdata('price_id_option_interlining', $row_option->price);
                    $this->session->set_userdata('skin_id_option_interlining', $row_option->image);
                } 
                // OPTION SEWING
                else if ($row_option->category == 3) {
                    $this->session->set_userdata('id_option_sewing', $row_option->id);
                    $this->session->set_userdata('price_id_option_sewing', $row_option->price);
                    $this->session->set_userdata('skin_id_option_sewing', $row_option->image);
                }
            }
        }
        // OPTION TAPE: NONE

        //echo json_encode(array('success' => true));
    }

    public function check_verify()
    {
        // Check Fabric
        if(!is_null(get_session('id_fabric')) && !empty(get_session('id_fabric'))) {
            // Check size
            if(!is_null(get_session('around_neck_selection')) && !empty(get_session('around_neck_selection'))) {
                echo json_encode(array('status' => 200));
            } else {
                echo json_encode(array('status' => 500));
            }
        } else {
            echo json_encode(array('status' => 500));
        }
        // print_r('test');
    }

}