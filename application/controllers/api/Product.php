<?php
# @Author: Awan Tengah
# @Date:   2017-02-07T10:13:49+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-25T15:40:10+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function get_product() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('product_model');
            $this->load->model('product_image_model');
            $this->load->model('color_model');
            $this->load->model('size_model');
            $this->load->model('promo_model');

            $get_by = $this->input->post('GET_BY', true);
            $value = $this->input->post('VALUE', true);
            $get_method = $this->input->post('GET_METHOD', true);

            $limit_start = $this->input->post('LIMIT_START', true);
            $limit_end = $this->input->post('LIMIT_END', true);

            $arr_order = $this->input->post('ARR_ORDER', true);
            $arr_like = $this->input->post('ARR_LIKE', true);

            $get_id_color = $this->input->post('ID_COLOR', true);
            $get_id_size = $this->input->post('ID_SIZE', true);
            $key        = $this->input->post('KEY', true);
            $promo_id        = $this->input->post('PROMO_ID', true);

            if(!is_null($get_by) && !is_null($value)) {
                $field_data = $this->db->field_data('product');
                $collect_name_field = array();
                foreach ($field_data as $row) {
                    $collect_name_field[] = $row->name;
                }
                if(in_array($get_by, $collect_name_field)) {
                    if(!is_null($get_method)) {
                        if($get_method == 'ONE') {
                            $get = $this->product_model->first(
                                array(
                                    "{$get_by}" => "{$value}"
                                )
                            );
                            if($get) {
                                $id_product = $get->id;
                                $get->PATH = path_image('product_image_path');
                                $get->IMAGE = $this->product_image_model->all(
                                    array(
                                        'fields' => 'product_image.image as IMAGE',
                                        'where' => array(
                                            'id_product' => $id_product
                                        )
                                    )
                                );
                                $get->COLOR = $this->color_model->all(
                                    array(
                                        'fields' => 'color.title as COLOR',
                                        'left_join' => array('product_color' => 'color.id = product_color.id_color'),
                                        'where' => array(
                                            'product_color.id_product' => $id_product
                                        )
                                    )
                                );
                                $get->SIZE = $this->size_model->all(
                                    array(
                                        'fields' => 'size.title as SIZE',
                                        'left_join' => array('product_size' => 'size.id = product_size.id_size'),
                                        'where' => array(
                                            'product_size.id_product' => $id_product
                                        )
                                    )
                                );

                                $get->PROMO = $this->promo_model->first(
                                    array(
                                        "id" => $get->promo_id,
                                        "status"=>1
                                    )
                                );

                                if(count($get->PROMO)){
                                    $get->PRICE_AFTER_PROMO = get_price_promo($get->price,$get->PROMO->value,($get->PROMO->id == 1)?false:true);
                                }else{
                                    $get->PRICE_AFTER_PROMO = array();
                                }

                                foreach($get as $key => $value) {
                                    $newget[strtoupper($key)] = $value;
                                }
                            }
                        } elseif($get_method == 'ALL') {
                            $set_where_method_all = array(
                                "{$get_by}" => "{$value}"
                            );
                            if(!empty($get_id_color) && !is_null($get_id_color)) {
                                $set_where_method_all = array_merge($set_where_method_all, array(
                                    'product_color.id_color' => $get_id_color
                                ));
                            }
                            if(!empty($get_id_size) && !is_null($get_id_size)) {
                                $set_where_method_all = array_merge($set_where_method_all, array(
                                    'product_size.id_size' => $get_id_size
                                ));
                            }

                            if(!empty($promo_id) && !is_null($promo_id)) {
                                $set_where_method_all = array_merge($set_where_method_all, array(
                                    'product.promo_id' => $promo_id
                                ));
                            }

                            $get = $this->product_model->all(
                                array(
                                    'fields' => 'product.*',
                                    'left_join' => array(
                                        'product_category' => 'product_category.id = product.id_product_category',
                                        'product_color' => 'product_color.id_product = product.id',
                                        'product_size' => 'product_size.id_product = product.id'
                                    ),
                                    'where' => $set_where_method_all,
                                    'like' => array(
                                        'product_category.title' => $arr_like,
                                        'product.title' => $key
                                    ),
                                    'order_by' => $arr_order,
                                    'group_by' => 'product.id',
                                    'limit' => array(
                                        'start' => $limit_start,
                                        'end' => $limit_end
                                    )
                                )
                            );

                            if($get) {
                                $tmp = $get;
                                $get = array();
                                foreach($tmp as $key => $value) {
                                    foreach($value as $key2 => $value2) {
                                        $get[$key][$key2] = $value2;
                                        $get[$key]['path'] = path_image('product_image_path');
                                        $get[$key]['image'] = $this->product_image_model->all(
                                            array(
                                                'fields' => 'product_image.image as IMAGE',
                                                'where' => array(
                                                    'id_product' => $value->id
                                                )
                                            )
                                        );
                                        $get[$key]['color'] = $this->color_model->all(
                                            array(
                                                'fields' => 'color.title as COLOR',
                                                'left_join' => array('product_color' => 'color.id = product_color.id_color'),
                                                'where' => array(
                                                    'product_color.id_product' => $value->id
                                                )
                                            )
                                        );
                                        $get[$key]['size'] = $this->size_model->all(
                                            array(
                                                'fields' => 'size.title as SIZE',
                                                'left_join' => array('product_size' => 'size.id = product_size.id_size'),
                                                'where' => array(
                                                    'product_size.id_product' => $value->id
                                                )
                                            )
                                        );
                                    }
                                }
                                foreach($get as $key => $value) {
                                    foreach($value as $childkey => $childvalue) {
                                        $newget[$key][strtoupper($childkey)] = $childvalue;
                                    }
                                }
                            }
                        } else {
                            $newget = array();
                        }
                    } else {
                        $datapi['STATUS'] = 'FAILED';
                        $datapi['MESSAGE'] = 'GET_METHOD REQUIRED, ONE OR ALL';
                        $datapi['DATA'] = (object)array();
                        return $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode($datapi));
                    }
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'KEY GET_BY WRONG, FIELD NOT FOUND';
                    $datapi['DATA'] = (object)array();
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($datapi));
                }
            } else {
                $set_where_method_all = array();
                if(!empty($get_id_color) && !is_null($get_id_color)) {
                    $set_where_method_all = array_merge($set_where_method_all, array(
                        'product_color.id_color' => $get_id_color
                    ));
                }
                if(!empty($get_id_size) && !is_null($get_id_size)) {
                    $set_where_method_all = array_merge($set_where_method_all, array(
                        'product_size.id_size' => $get_id_size
                    ));
                }

                if(!empty($promo_id) && !is_null($promo_id)) {
                    $set_where_method_all = array_merge($set_where_method_all, array(
                        'product.promo_id' => $promo_id
                    ));
                }

                $get = $this->product_model->all(
                    array(
                        'fields' => 'product.*',
                        'left_join' => array(
                            'product_category' => 'product_category.id = product.id_product_category',
                            'product_color' => 'product_color.id_product = product.id',
                            'product_size' => 'product_size.id_product = product.id'
                        ),
                        'where' => $set_where_method_all,
                        'like' => array(
                            'product_category.title' => $arr_like,
                            'product.title' => $key
                        ),
                        'order_by' => $arr_order,
                        'group_by' => 'product.id',
                        'limit' => array(
                            'start' => $limit_start,
                            'end' => $limit_end
                        )
                    )
                );
                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['PATH'] = path_image('product_image_path');
                        $get[$key]['IMAGE'] = $this->product_image_model->all(
                            array(
                                'fields' => 'product_image.image as IMAGE',
                                'where' => array(
                                    'id_product' => $value->id
                                )
                            )
                        );
                        $get[$key]['COLOR'] = $this->color_model->all(
                            array(
                                'fields' => 'color.title AS COLOR',
                                'left_join' => array('product_color' => 'color.id = product_color.id_color'),
                                'where' => array(
                                    'product_color.id_product' => $value->id
                                )
                            )
                        );
                        $get[$key]['SIZE'] = $this->size_model->all(
                            array(
                                'fields' => 'size.title as SIZE',
                                'left_join' => array('product_size' => 'size.id = product_size.id_size'),
                                'where' => array(
                                    'product_size.id_product' => $value->id
                                )
                            )
                        );
                    }
                }
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
                $datapi['MESSAGE'] = 'PRODUCT LIST';
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

    public function get_list_product_category() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('product_category_model');
            $get_slug_product_category = $this->input->post('SLUG_PRODUCT_CATEGORY', true);
            if(!is_null($get_slug_product_category)) {
                $get = $this->product_category_model->first(
                    array(
                        'slug' => $get_slug_product_category
                    )
                );
                if($get) {
                    foreach($get as $key => $value) {
                        $newget[strtoupper($key)] = $value;
                    }
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'PRODUCT CATEGORY';
                    $datapi['DATA'] = $newget;
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                    $datapi['DATA'] = (object)array();
                }
            } else {
                $get = $this->product_category_model->all(
                    array(
                        'fields' => 'product_category.*, product.price, product_image.image',
                        'left_join' => array(
                            'product' => 'product.id_product_category = product_category.id',
                            'product_image' => 'product_image.id_product = product.id'
                        ),
                        'group_by' => 'product_category.id'
                    )
                );
                if($get) {
                    foreach($get as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                        }
                    }
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'PRODUCT CATEGORY LIST';
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

    public function get_master_size() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('size_model');

            $get_id_size = $this->input->post('ID_SIZE', true);
            $template_size_chart = $this->input->post('TEMPLATE_SIZE_CHART', true);

            if(!is_null($get_id_size)) {
                if(is_numeric($get_id_size)) {
                    $get = $this->size_model->first($get_id_size);
                    if($get) {
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

                $neck_size = $this->input->post('neck_size', true);
                $sleeve_length_right = $this->input->post('sleeve_length_right', true);
                $sleeve_length_left = $this->input->post('sleeve_length_left', true);
                $body_type = $this->input->post('body_type', true);
                $sleeve_type = $this->input->post('sleeve_type', true);

                $where_param = array();
                if ($neck_size) {
                    $where_param['neck'] = $neck_size;
                }

                if ($body_type) {
                    $where_param['body_type'] = $body_type;
                }

                if ($sleeve_type) {
                    $where_param['sleeve_type'] = $sleeve_type;
                }

                $where = array(
                    'where' => $where_param
                );

                // Check For Hem
                if ($this->input->post('id_hem')) {
                    $hem_id = $this->input->post('id_hem');
                } else {
                    $hem_id = $this->session->userdata('id_body_type_hem');
                }
                $hem_title = '';
                if ($hem_id) {
                    $q = $this->db->query("
                        SELECT title FROM material_body_type WHERE category = 3 AND id = $hem_id
                    ");
                    if ($q->num_rows() > 0) {
                        $hem_title = strtolower($q->row()->title);
                    }
                }

                // Check for short sleeve
                if ($this->input->post('id_sleeve')) {
                    $sleeve_id = $this->input->post('id_sleeve');
                } else {
                    $sleeve_id = $this->session->userdata('id_sleeve');
                }
                if ($sleeve_id) {
                    $q_sleeve = $this->db->query("
                        SELECT title FROM material_cuff WHERE category = 2 AND id = $sleeve_id AND is_long_sleeve = 1
                    ");
                    if ($q_sleeve->num_rows() > 0) {
                        $sleeve_title = strtolower($q_sleeve->row()->title);
                    }
                }

                $get = $this->size_model->all($where);
                if($get) {
                    foreach($get as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                            if (strtoupper($childkey) == 'BACK_LENGTH_88' && $hem_title == 'straight bottom hem') {
                                $newget[$key][strtoupper($childkey)] = 0;
                            }
                            if (strtoupper($childkey) == 'ALOHA_88' && $hem_title == 'standard hem') {
                                $newget[$key][strtoupper($childkey)] = 0;
                            }
                            if (strtoupper($childkey) == 'SHORT_SLEEVE' && isset($sleeve_title)) {
                                $newget[$key][strtoupper($childkey)] = 0;
                            }
                        }
                    }

                    if(!is_null($template_size_chart) && !empty($template_size_chart)) {
                        $data['size_chart'] = json_decode(json_encode($newget));
                        $newget = $this->load->view('template/frontend/custom/_size_chart', $data, true);
                    }
                }
            }
            if($get) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'MASTER SIZE LIST';
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

    public function get_size_chart()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {

            $around_neck = ($this->input->post('around_neck') && $this->input->post('around_neck') != '') ? $this->input->post('around_neck') : 38;
            $q_size = $this->db->query("
                SELECT * FROM size WHERE neck = $around_neck GROUP BY body_type ORDER BY body_type ASC
            ");
            if ($q_size->num_rows() > 0) {
                foreach ($q_size->result() as $row) {
                    $size[$row->body_type] = array(
                        'neck' => $row->neck,
                        'shoulder' => $row->shoulder,
                        'chest' => $row->chest,
                        'waist' => $row->waist,
                        'hip' => $row->hip,
                        'arm_hole' => $row->arm_hole,
                        'back_length_88' => $row->back_length_88,
                        'back_length_89' => $row->back_length_89,
                        'aloha_88' => $row->aloha_88,
                        'aloha_89' => $row->aloha_89,
                        'cuffs_circle' => $row->cuffs_circle,
                        'short_sleeve' => $row->short_sleeve,
                        'sleeve_circle' => $row->sleeve_circle,
                        'sleeve_type' => $row->sleeve_type,
                        'fabric_needed' => $row->fabric_needed
                    );
                }

                $data = array(
                    'size' => $size,
                    'neck' => $around_neck
                );
                $newget = $this->load->view('template/frontend/custom/_size_chart', $data, true);

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'MASTER SIZE LIST';
                $datapi['DATA'] = $newget;

            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'NO DATA AVAILABLE FOR SIZE: ' . $around_neck;
                $datapi['DATA'] = (object)array();
            }

        } else {
            $datapi = $check;
        }

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_detail($id)
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        $date_now = date('Y-m-d');

        if($check['STAT'] == TRUE) {

            if ($id) {

                $this->load->model('product_image_model');
                $this->load->model('color_model');
                $this->load->model('size_model');

                $get = $this->db->query("
                    SELECT 
                        prod.*,
                        cat.title AS prod_category_title,
                        fab.title AS fabric_title,
                        fab.image AS fabric_image,
                        col.title AS collar_title,
                        col.image AS collar_image,
                        but.title AS button_title,
                        but.image AS button_image,
                        buthol.title AS button_hole_title,
                        buthol.image AS button_hole_image,
                        butthr.title AS button_thread_title,
                        butthr.image AS button_thread_image,
                        cuff.title AS cuff_title,
                        cuff.image AS cuff_image,
                        btf.title AS body_front_title,
                        btf.image AS body_front_image,
                        btb.title AS body_back_title,
                        btb.image AS body_back_image,
                        hem.title AS body_hem_title,
                        hem.image AS body_hem_image,
                        poc.title AS pocket_title,
                        poc.image AS pocket_image,
                        empos.title AS embroidery_position_title,
                        empos.image AS embroidery_position_image,
                        emfont.title AS embroidery_font_title,
                        emfont.image AS embroidery_font_image,
                        emcol.title AS embroidery_color_title,
                        emcol.image AS embroidery_color_image,
                        optamf.title AS option_amf_stitch_title,
                        optamf.image AS option_amf_stitch_image,
                        optint.title AS option_interlining_title,
                        optint.image AS option_interlining_image,
                        optsew.title AS option_sewing_title,
                        optsew.image AS option_sewing_image,
                        opttape.title AS option_tape_title,
                        opttape.image AS option_tape_image,
                        fabcleric.title AS cleric_fabric_title,
                        fabcleric.image AS cleric_fabric_image,
                        prom.promo_name AS promo_name,
                        prom.value AS promo_value,
                        prom.expired_at AS promo_expired_date
                    FROM product prod 
                    LEFT JOIN product_category cat ON cat.id = prod.id_product_category

                    -- FABRIC
                    LEFT JOIN material_fabric fab ON fab.id = prod.id_fabric

                    -- COLLAR
                    LEFT JOIN material_collar col ON col.id = prod.id_collar

                    -- BUTTONS
                    LEFT JOIN material_buttons but ON but.id = prod.id_button
                    LEFT JOIN material_buttons buthol ON buthol.id = prod.id_button_holes
                    LEFT JOIN material_buttons butthr ON butthr.id = prod.id_button_thread

                    -- CUFF
                    LEFT JOIN material_cuff cuff ON cuff.id = prod.id_cuff

                    -- BODY TYPE
                    LEFT JOIN material_body_type btf ON btf.id = prod.id_body_front
                    LEFT JOIN material_body_type btb ON btb.id = prod.id_body_back
                    LEFT JOIN material_body_type hem ON hem.id = prod.id_body_hem

                    -- POCKET
                    LEFT JOIN material_pocket poc ON poc.id = prod.id_pocket

                    -- EMBROIDERY
                    LEFT JOIN material_embroidery empos ON empos.id = prod.id_embroidery_position
                    LEFT JOIN material_embroidery emfont ON emfont.id = prod.id_embroidery_font
                    LEFT JOIN material_embroidery emcol ON emcol.id = prod.id_embroidery_color

                    -- OPTION
                    LEFT JOIN material_option optamf ON optamf.id = prod.id_option_amf_stitch
                    LEFT JOIN material_option optint ON optint.id = prod.id_option_interlining
                    LEFT JOIN material_option optsew ON optsew.id = prod.id_option_sewing
                    LEFT JOIN material_option opttape ON opttape.id = prod.id_option_tape

                    -- CLERIC
                    LEFT JOIN material_cleric clfab ON clfab.id = prod.id_cleric_fabric
                    LEFT JOIN material_fabric fabcleric ON fabcleric.id = clfab.id_fabric

                    -- PROMO
                    LEFT JOIN promo prom ON prod.promo_id = prom.id AND DATE(prom.expired_at) > DATE('$date_now')

                    WHERE prod.id = $id LIMIT 1
                ");

                if ($get->num_rows() > 0) {

                    foreach($get->result() as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                            $newget[$key]['PATH'] = path_image('product_image_path');
                            $newget[$key]['IMAGE'] = $this->product_image_model->all(
                                array(
                                    'fields' => 'product_image.image as IMAGE',
                                    'where' => array(
                                        'id_product' => $value->id
                                    )
                                )
                            );
                            $newget[$key]['COLOR'] = $this->color_model->all(
                                array(
                                    'fields' => 'color.title AS COLOR',
                                    'left_join' => array('product_color' => 'color.id = product_color.id_color'),
                                    'where' => array(
                                        'product_color.id_product' => $value->id
                                    )
                                )
                            );
                            $newget[$key]['SIZE'] = $this->size_model->all(
                                array(
                                    'fields' => 'size.title as SIZE',
                                    'left_join' => array('product_size' => 'size.id = product_size.id_size'),
                                    'where' => array(
                                        'product_size.id_product' => $value->id
                                    )
                                )
                            );
                        }
                    }

                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'PRODUCT DETAIL';
                    $datapi['DATA'] = $newget;
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'NO DATA AVAILABLE';
                    $datapi['DATA'] = (object)array();
                }

            } else {

                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'PRODUCT ID IS REQUIRED';
                $datapi['DATA'] = (object)array();

            }

        } else {
            $datapi = $check;
        }

        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($datapi));
    }

    public function get_best_seller()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);

        if($check['STAT'] == TRUE) {

            $this->load->model('product_image_model');
            $this->load->model('color_model');
            $this->load->model('size_model');
            $limit = $this->input->post('LIMIT', TRUE);
            if (is_null($limit)) {
                $limit = 10;
            }

            $q = $this->db->query("
                SELECT op.id_product, COUNT(op.id_product) AS total_product, p.*
                FROM order_product op 
                LEFT JOIN product p ON p.id = op.id_product
                GROUP BY op.id_product
                ORDER BY total_product DESC
                LIMIT $limit
            ");
            if ($q->num_rows() > 0) {
                foreach ($q->result() as $key => $value) {
                    foreach($value as $childkey => $childvalue) {
                        $newget[$key][strtoupper($childkey)] = $childvalue;
                        $newget[$key]['PATH'] = path_image('product_image_path');
                        $newget[$key]['IMAGE'] = $this->product_image_model->all(
                            array(
                                'fields' => 'product_image.image as IMAGE',
                                'where' => array(
                                    'id_product' => $value->id
                                )
                            )
                        );
                        $newget[$key]['COLOR'] = $this->color_model->all(
                            array(
                                'fields' => 'color.title AS COLOR',
                                'left_join' => array('product_color' => 'color.id = product_color.id_color'),
                                'where' => array(
                                    'product_color.id_product' => $value->id
                                )
                            )
                        );
                        $newget[$key]['SIZE'] = $this->size_model->all(
                            array(
                                'fields' => 'size.title as SIZE, size.id as ID_SIZE',
                                'left_join' => array('product_size' => 'size.id = product_size.id_size'),
                                'where' => array(
                                    'product_size.id_product' => $value->id
                                )
                            )
                        );
                    }
                }

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'GET BEST SELLER';
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

    public function get_special_offer()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);

        if($check['STAT'] == TRUE) {

            $this->load->model('product_image_model');
            $this->load->model('color_model');
            $this->load->model('size_model');
            $date_now = date('Y-m-d');
            $limit = $this->input->post('LIMIT', TRUE);
            if (is_null($limit)) {
                $limit = 4;
            }

            $q = $this->db->query("
                SELECT 
                    p.*,pr.value AS promo_value,pr.type_promo 
                FROM product p
                LEFT JOIN promo pr ON pr.id = p.promo_id
                WHERE DATE(pr.created_at) <= '$date_now' AND DATE(pr.expired_at) >= '$date_now' 
                AND pr.deleted_at IS NULL
                ORDER BY created_at DESC
            ");

            if ($q->num_rows() > 0) {
                foreach ($q->result() as $key => $value) {
                    foreach($value as $childkey => $childvalue) {
                        $newget[$key][strtoupper($childkey)] = $childvalue;
                        $newget[$key]['PATH'] = path_image('product_image_path');
                        $newget[$key]['IMAGE'] = $this->product_image_model->all(
                            array(
                                'fields' => 'product_image.image as IMAGE',
                                'where' => array(
                                    'id_product' => $value->id
                                )
                            )
                        );
                        $newget[$key]['COLOR'] = $this->color_model->all(
                            array(
                                'fields' => 'color.title AS COLOR',
                                'left_join' => array('product_color' => 'color.id = product_color.id_color'),
                                'where' => array(
                                    'product_color.id_product' => $value->id
                                )
                            )
                        );
                        $newget[$key]['SIZE'] = $this->size_model->all(
                            array(
                                'fields' => 'size.title as SIZE, size.id as ID_SIZE',
                                'left_join' => array('product_size' => 'size.id = product_size.id_size'),
                                'where' => array(
                                    'product_size.id_product' => $value->id
                                )
                            )
                        );
                    }
                }

                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'GET SPECIAL OFFER';
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

}
