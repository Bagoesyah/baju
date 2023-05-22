<?php
# @Author: Awan Tengah
# @Date:   2017-04-12T12:04:39+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-22T01:12:21+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class View extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('material_fabric_model');
        $this->load->model('material_collar_model');
        $this->load->model('material_buttons_model');
        $this->load->model('material_cuff_model');
        $this->load->model('material_body_type_model');
        $this->load->model('material_pocket_model');
        $this->load->model('material_embroidery_model');
        $this->load->model('material_option_model');

        $this->load->model('product_model');
        $this->load->model('color_model');
        $this->load->model('size_model');
        $this->load->model('promo_model');
        $this->load->model('other_page_model');

        $this->layout = 'template/frontend';
    }

    public function product($slug = null) {

        $url = site_url($this->uri->uri_string());
        $redirect_url = $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
        $this->session->set_userdata('redirect', $redirect_url);

        if(is_null($slug)) {
            show_404();
        }
        $post = array(
            'GET_BY' => 'slug',
            'VALUE' => $slug,
            'GET_METHOD' => 'ONE'
        );
        $data['product'] = get_data_curl(base_url('api/product/get_product'), $post);

        if($data['product']->STATUS == 'FAILED') {
            show_404();
        }

        $data['fabric'] = $this->material_fabric_model->first($data['product']->DATA->ID_FABRIC);
        $data['collar'] = $this->material_collar_model->first($data['product']->DATA->ID_COLLAR);
        $data['cuff'] = $this->material_cuff_model->first($data['product']->DATA->ID_CUFF);
        $data['body_type_front'] = $this->material_body_type_model->first($data['product']->DATA->ID_BODY_FRONT);
        $data['body_type_back'] = $this->material_body_type_model->first($data['product']->DATA->ID_BODY_BACK);
        $data['body_type_hem'] = $this->material_body_type_model->first($data['product']->DATA->ID_BODY_HEM);
        $data['pocket'] = $this->material_pocket_model->first($data['product']->DATA->ID_POCKET);
        $data['button'] = $this->material_buttons_model->first($data['product']->DATA->ID_BUTTON);
        $data['button_hole'] = $this->material_buttons_model->first($data['product']->DATA->ID_BUTTON_HOLES);
        $data['button_thread'] = $this->material_buttons_model->first($data['product']->DATA->ID_BUTTON_THREAD);
        $data['cleric_fabric'] = $this->material_fabric_model->first($data['product']->DATA->ID_CLERIC_FABRIC);
        $data['cleric_stitch'] = $this->material_fabric_model->first($data['product']->DATA->ID_CLERIC_STITCH);
        $data['embroidery_position'] = $this->material_embroidery_model->first($data['product']->DATA->ID_EMBROIDERY_POSITION);
        $data['embroidery_font'] = $this->material_embroidery_model->first($data['product']->DATA->ID_EMBROIDERY_FONT);
        $data['embroidery_color'] = $this->material_embroidery_model->first($data['product']->DATA->ID_EMBROIDERY_COLOR);
        $data['option_amf_stitch'] = $this->material_option_model->first($data['product']->DATA->ID_OPTION_AMF_STITCH);
        $data['option_interlining'] = $this->material_option_model->first($data['product']->DATA->ID_OPTION_INTERLINING);
        $data['option_sewing'] = $this->material_option_model->first($data['product']->DATA->ID_OPTION_SEWING);
        $data['option_tape'] = $this->material_option_model->first($data['product']->DATA->ID_OPTION_TAPE);

        $set_data = array(
            'id_fabric' => !is_null($data['fabric']) ? $data['fabric']->id : '',
            'price_id_fabric' => !is_null($data['fabric']) ? $data['fabric']->price : '',
            'id_collar' => !is_null($data['collar']) ? $data['collar']->id : '',
            'price_id_collar' => !is_null($data['collar']) ? $data['collar']->price : '',
            'id_cuff' => !is_null($data['cuff']) ? $data['cuff']->id : '',
            'price_id_cuff' => !is_null($data['cuff']) ? $data['cuff']->price : '',
            'id_body_type_front' => !is_null($data['body_type_front']) ? $data['body_type_front']->id : '',
            'price_id_body_type_front' => !is_null($data['body_type_front']) ? $data['body_type_front']->price : '',
            'id_body_type_back' => !is_null($data['body_type_back']) ? $data['body_type_back']->id : '',
            'price_id_body_type_back' => !is_null($data['body_type_back']) ? $data['body_type_back']->price : '',
            'id_body_type_hem' => !is_null($data['body_type_hem']) ? $data['body_type_hem']->id : '',
            'price_id_body_type_hem' => !is_null($data['body_type_hem']) ? $data['body_type_hem']->price : '',
            'id_pocket' => !is_null($data['pocket']) ? $data['pocket']->id : '',
            'price_id_pocket' => !is_null($data['pocket']) ? $data['pocket']->price : '',
            'id_button' => !is_null($data['button']) ? $data['button']->id : '',
            'price_id_button' => !is_null($data['button']) ? $data['button']->price : '',
            'id_button_hole' => !is_null($data['button_hole']) ? $data['button_hole']->id : '',
            'price_id_button_hole' => !is_null($data['button_hole']) ? $data['button_hole']->price : '',
            'id_button_thread' => !is_null($data['button_thread']) ? $data['button_thread']->id : '',
            'price_id_button_thread' => !is_null($data['button_thread']) ? $data['button_thread']->price : '',
            'id_cleric_fabric' => !is_null($data['cleric_fabric']) ? $data['cleric_fabric']->id : '',
            'price_id_cleric_fabric' => !is_null($data['cleric_fabric']) ? $data['cleric_fabric']->price : '',
            'id_cleric_stitch' => !is_null($data['cleric_stitch']) ? $data['cleric_stitch']->id : '',
            'price_id_cleric_stitch' => !is_null($data['cleric_stitch']) ? $data['cleric_stitch']->price : '',
            'id_embroidery_position' => !is_null($data['embroidery_position']) ? $data['embroidery_position']->id : '',
            'price_id_embroidery_position' => !is_null($data['embroidery_position']) ? $data['embroidery_position']->price : '',
            'id_embroidery_font' => !is_null($data['embroidery_font']) ? $data['embroidery_font']->id : '',
            'price_id_embroidery_font' => !is_null($data['embroidery_font']) ? $data['embroidery_font']->price : '',
            'id_embroidery_color' => !is_null($data['embroidery_color']) ? $data['embroidery_color']->id : '',
            'price_id_embroidery_color' => !is_null($data['embroidery_color']) ? $data['embroidery_color']->price : '',
            'id_option_amf_stitch' => !is_null($data['option_amf_stitch']) ? $data['option_amf_stitch']->id : '',
            'price_id_option_amf_stitch' => !is_null($data['option_amf_stitch']) ? $data['option_amf_stitch']->price : '',
            'id_option_interlining' => !is_null($data['option_interlining']) ? $data['option_interlining']->id : '',
            'price_id_option_interlining' => !is_null($data['option_interlining']) ? $data['option_interlining']->price : '',
            'id_option_sewing' => !is_null($data['option_sewing']) ? $data['option_sewing']->id : '',
            'price_id_option_sewing' => !is_null($data['option_sewing']) ? $data['option_sewing']->price : '',
            'id_option_tape' => !is_null($data['option_tape']) ? $data['option_tape']->id : '',
            'price_id_option_tape' => !is_null($data['option_tape']) ? $data['option_tape']->price : '',
            'image' => !empty($data['product']->DATA->IMAGE) ? $data['product']->DATA->IMAGE[0]->IMAGE : '',
            'price' => $data['product']->DATA->PRICE,
            // 'special_request_custom',
            'id_shoulder_width_dimensions' => $data['product']->DATA->ID_SHOULDER_WIDTH_DIMENSIONS,
            'id_shoulder_width_correction' => $data['product']->DATA->ID_SHOULDER_WIDTH_CORRECTION,
            'id_shoulder_width_product_ud' => $data['product']->DATA->ID_SHOULDER_WIDTH_PRODUCT_UD,
            'id_chest_c_dimensions' => $data['product']->DATA->ID_CHEST_C_DIMENSIONS,
            'id_chest_c_correction' => $data['product']->DATA->ID_CHEST_C_CORRECTION,
            'id_chest_c_product_ud' => $data['product']->DATA->ID_CHEST_C_PRODUCT_UD,
            // 'special_request_size',
            // 'special_request_verify',
            // 'quantity',
            // 'last_order_number',
            // 'proceed_checkout'
        );
        $this->session->set_userdata($set_data);

        // Added: 13/05/17 - Andre
        // Set default fabric based on product for custom purpose
        if (isset($data['fabric']->image)) {
            $_SESSION['skin_id_fabric'] = $data['fabric']->image;
        }

        $this->render('view/product', $data);
    }
    public function about_us() {
        $data['about_us'] = get_data_curl(base_url('api/general/get_about_us'));
        $this->_container_fluid = false;
        $this->render('about_us', $data);
    }

    public function guide($slug = null) {
        $data['product_category'] = get_data_curl(base_url('api/product/get_list_product_category'));
        $data['slug'] = $slug;
        if(!is_null($slug)) {
            $where = array('SLUG_CATEGORY' => $slug);
        } else {
            $this->load->model('product_category_model');
            $get = $this->product_category_model->first(null, false);
            if($get) {
                $where = array('SLUG_CATEGORY' => $get->slug);
            } else {
                $where = null;
            }
        }
        $data['guide'] = get_data_curl(base_url('api/general/get_guide'), $where);
        $this->_container_fluid = false;
        $this->render('guide', $data);
    }

    public function ready_to_wear($slug_category = null) {
        $sort_by        = $this->input->get('sort_by', true);
        $shirt          = $this->input->get('shirt', true);
        $sort_by_color  = $this->input->get('color', true);
        $sort_by_size   = $this->input->get('size', true);
        $key            = $this->input->get('key', true);

        $post_product = array();

        //params
        $arr_order = '';
        $arr_like = '';

        if(!is_null($sort_by)) {
            $code_sort_by = $sort_by == 'cheap' ? '1' : ($sort_by == 'expensive' ? '2' : '');
            if(!empty($code_sort_by)) {
                if($code_sort_by == '1') {
                    $arr_order .= 'product.price ASC';
                } else if($code_sort_by == '2') {
                    $arr_order .= 'product.price DESC';
                }
            }
        }
        if(!is_null($shirt)) {
            if(!empty($shirt)) {
                if(!empty($arr_like)) {
                    $arr_like .= $shirt;
                } else {
                    $arr_like = $shirt;
                }
            }
        }
        if(!is_null($sort_by_color) && !empty($sort_by_color) && $sort_by_color != 'all') {
            $post_product['ID_COLOR'] = $sort_by_color;
        }
        if(!is_null($sort_by_size) && !empty($sort_by_size) && $sort_by_size != 'all-size') {
            $post_product['ID_SIZE'] = $sort_by_size;
        }

        if(!is_null($key) && !empty($key)) {
            $post_product['KEY'] = $key;
        }

        if(!empty($arr_order)) {
            $post_product['ARR_ORDER'] = $arr_order;
        }

        if(!empty($arr_like)) {
            $post_product['ARR_LIKE'] = $arr_like;
        }

        if(!is_null($slug_category) && !is_numeric($slug_category)) {
            $post_product_category = array(
                'SLUG_PRODUCT_CATEGORY' => $slug_category
            );
            $get_product_category = get_data_curl(base_url('api/product/get_list_product_category'), $post_product_category);
            if($get_product_category->STATUS == 'FAILED') {
                show_404();
            }
            $post_product['GET_BY'] = 'id_product_category';
            $post_product['VALUE'] = $get_product_category->DATA->ID;
            $post_product['GET_METHOD'] = 'ALL';

            $segment = 4;
        } else {
            $segment = 3;
        }

        $this->load->library('create_pagination');
        $base_url = base_url('view/ready-to-wear');
        $total_rows = !empty($post_product) ? count(get_data_curl(base_url("api/product/get_product"), $post_product)->DATA) : count(get_data_curl(base_url("api/product/get_product"))->DATA);
        $per_page = 8;
        $page = $this->create_pagination->page($base_url, $total_rows, $per_page, $segment);
        if ($page < 0) {
            redirect(site_url());
        }
        $data['pagination'] = $this->pagination->create_links();

        $post_product['LIMIT_START'] = $page;
        $post_product['LIMIT_END'] = $per_page;

        $data['product'] = get_data_curl(base_url("api/product/get_product"), $post_product);
        $data['master_color'] = $this->color_model->all();
        $data['master_size'] = $this->size_model->all();
        $this->render('ready_to_wear', $data);
    }

    public function promo($slug_promo = null,$slug_category=null) {
        $promo  = $this->promo_model->first(
                                array('promo.status'=>1,
                                        'promo.slug'=>$slug_promo)
                            );
        if(count($promo))
        {
            $sort_by        = $this->input->get('sort_by', true);
            $shirt          = $this->input->get('shirt', true);
            $sort_by_color  = $this->input->get('color', true);
            $sort_by_size   = $this->input->get('size', true);
            $key            = $this->input->get('key', true);

            $post_product   = array();
            if($promo->type_promo != 3){
                $post_product['PROMO_ID']   = $promo->id;
            }
            
            if($promo->type_promo == 1){
                $data['percent']    = true;
            }else{
                $data['percent']    = false;
            }

            //params
            $arr_order = '';
            $arr_like = '';

            if(!is_null($sort_by)) {
                $code_sort_by = $sort_by == 'cheap' ? '1' : ($sort_by == 'expensive' ? '2' : '');
                if(!empty($code_sort_by)) {
                    if($code_sort_by == '1') {
                        $arr_order .= 'product.price ASC';
                    } else if($code_sort_by == '2') {
                        $arr_order .= 'product.price DESC';
                    }
                }
            }

            if(!is_null($shirt)) {
                if(!empty($shirt)) {
                    if(!empty($arr_like)) {
                        $arr_like .= $shirt;
                    } else {
                        $arr_like = $shirt;
                    }
                }
            }

            if(!is_null($sort_by_color) && !empty($sort_by_color)) {
                $post_product['ID_COLOR'] = $sort_by_color;
            }

            if(!is_null($sort_by_size) && !empty($sort_by_size)) {
                $post_product['ID_SIZE'] = $sort_by_size;
            }

            if(!is_null($key) && !empty($key)) {
                $post_product['KEY'] = $key;
            }

            if(!empty($arr_order)) {
                $post_product['ARR_ORDER'] = $arr_order;
            }

            if(!empty($arr_like)) {
                $post_product['ARR_LIKE'] = $arr_like;
            }

            if(!is_null($slug_category) && !is_numeric($slug_category)) {
                $post_product_category = array(
                    'SLUG_PRODUCT_CATEGORY' => $slug_category
                );
                $get_product_category = get_data_curl(base_url('api/product/get_list_product_category'), $post_product_category);
                if($get_product_category->STATUS == 'FAILED') {
                    show_404();
                }
                $post_product['GET_BY'] = 'id_product_category';
                $post_product['VALUE'] = $get_product_category->DATA->ID;
                $post_product['GET_METHOD'] = 'ALL';

                $segment = 4;
            } else {
                $segment = 3;
            }

            $this->load->library('create_pagination');
            $base_url = base_url('view/ready-to-wear');
            $total_rows = !empty($post_product) ? count(get_data_curl(base_url("api/product/get_product"), $post_product)->DATA) : count(get_data_curl(base_url("api/product/get_product")));
            $per_page = 8;
            $page = $this->create_pagination->page($base_url, $total_rows, $per_page, $segment);
            if ($page < 0) {
                //redirect(site_url());
            }
            $data['pagination'] = $this->pagination->create_links();

            $post_product['LIMIT_START'] = $page;
            $post_product['LIMIT_END'] = $per_page;

            $data['product'] = get_data_curl(base_url("api/product/get_product"), $post_product);
            $data['master_color'] = $this->color_model->all();
            $data['master_size'] = $this->size_model->all();
            $data['promo']      = $promo;
            $this->render('promo', $data);
        
        }else{

            show_404();
        }
    }

    public function page($slug = null) {
        if(is_null($slug)) {
            show_404();
        }
        $data['page'] = $this->other_page_model->first(
            array(
                'slug' => $slug
            )
        );
        if(!$data['page']) {
            show_404();
        }
        $this->_container_fluid = false;
        $this->render('view/page', $data);
    }

}
