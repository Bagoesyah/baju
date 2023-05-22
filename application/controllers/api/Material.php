<?php
# @Author: Awan Tengah
# @Date:   2017-02-18T20:07:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-24T21:44:17+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function get_material_model($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_model_model');
            $this->load->model('product_category_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_model_model->first($id);
                    if($get) {
                        $get->path = path_image('material_model_path');
                        $get->product_category = $this->product_category_model->first($get->id_product_category)->title;
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
                $get = $this->material_model_model->all(
                    array(
                        'fields' => 'material_model.*, product_category.title as product_category',
                        'join' => array(
                            'product_category' => 'product_category.id = material_model.id_product_category',
                        ),
                    )
                );
                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_model_path');
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
                $datapi['MESSAGE'] = 'MATERIAL MODEL LIST';
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

    public function get_material_fabric($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_fabric_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_fabric_model->first($id);
                    if($get) {
                        $get->path = path_image('material_fabric_path');
                        if ($get->category == 1) {
                            $get->category_text = 'Standard';
                        } else if ($get->category == 2) {
                            $get->category_text = 'Premium';
                        } else {
                            $get->category_text = 'Super Premium';
                        }
                        //$get->category_text = $get->category == '1' ? 'standard' : 'premium';
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
                $filter_category = $this->input->get('category', true);
                $key            = $this->input->get('key', true);
                if(!is_null($filter_category)) {
                    $code_category = $filter_category == 'standard' ? '1' : ($filter_category == 'premium' ? '2' : ($filter_category == 'super_premium' ? '3' : ''));
                    if(!empty($code_category)) {
                        $where['material_fabric.category']  =  $code_category;
                        if($key!="")
                        {
                            $where['material_fabric.title']  =  $key;
                        }

                        $get    = $this->material_fabric_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then 'Standard'
                                    when 2 then 'Premium'
                                    when 3 then 'Super Premium'
                                end as category_text",
                                'where' => $where
                            )
                        );
                    } else {
                        $get = $this->material_fabric_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then 'Standard'
                                    when 2 then 'Premium'
                                    when 3 then 'Super Premium'
                                end as category_text"
                            )
                        );
                    }
                } else {
                    $get = $this->material_fabric_model->all(
                        array(
                            'fields' => "*,
                            case category
                                when 1 then 'Standard'
                                when 2 then 'Premium'
                                when 3 then 'Super Premium'
                            end as category_text"
                        )
                    );
                }

                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_fabric_path');
                    }
                }
                if($get) {
                    foreach($get as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                            if ($childkey == 'price') {
                                $newget[$key]['PRICE_FORMAT'] = format_currency($childvalue);
                            }
                        }
                    }
                }
            }
            if($get) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'MATERIAL FABRIC LIST';
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

        // echo "<script>console.log('{$datapi}' );</script>"; //console log
        // var_dump($datapi);
    }

    public function get_material_collar($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_collar_model');
            $key            = $this->input->get('key', true);
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_collar_model->first($id);
                    if($get) {
                        $get->path = path_image('material_collar_path');
                        $get->obj_path = path_image('material_collar_path').'object/';
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
                if($key!="")
                {
                    $where['material_collar.title']  =  $key;
                    $get = $this->material_collar_model->all(array(
                            'where' => $where
                            ));
                }else{
                    $get = $this->material_collar_model->all();
                }
                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_collar_path');
                        $get[$key]['obj_path'] = path_image('material_collar_path').'object/';
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
                $datapi['MESSAGE'] = 'MATERIAL COLLAR LIST';
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

    public function get_material_buttons($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_buttons_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_buttons_model->first($id);
                    if($get) {
                        $get->path = path_image('material_buttons_path');
                        $get->obj_path = path_image('material_buttons_path').'object/';
                        //$get->category_text = $get->category == '1' ? 'button' : ($get->category == '2' ? 'button hole' : 'button thread');
                        if ($get->category == 1) {
                            $get->category_text = '08 Button';
                        } else if ($get->category == 2) {
                            $get->category_text = '11 Button Hole';
                        } else {
                            $get->category_text = '12 Button Thread';
                        }
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
                $filter_category = $this->input->get('category', true);
                if(!is_null($filter_category)) {
                    $code_category = $filter_category == 'button' ? '1' : ($filter_category == 'button_hole' ? '2' : ($filter_category == 'button_thread' ? '3' : ''));
                    if(!empty($code_category)) {
                        $get = $this->material_buttons_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then '08 Button'
                                    when 2 then '11 Button Hole'
                                    when 3 then '12 Button Thread'
                                end as category_text",
                                'where' => array(
                                    'material_buttons.category' => $code_category
                                )
                            )
                        );
                    } else {
                        $get = $this->material_buttons_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then '08 Button'
                                    when 2 then '11 Button Hole'
                                    when 3 then '12 Button Thread'
                                end as category_text"
                            )
                        );
                    }
                } else {
                    $get = $this->material_buttons_model->all(
                        array(
                            'fields' => "*, 
                            case category
                                when 1 then '08 Button'
                                when 2 then '11 Button Hole'
                                when 3 then '12 Button Thread'
                            end as category_text"
                        )
                    );
                }

                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_buttons_path');
                        $get[$key]['obj_path'] = path_image('material_buttons_path').'object/';
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
                $datapi['MESSAGE'] = 'MATERIAL BUTTONS LIST';
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

    public function get_material_cuff($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_cuff_model');
            $key = $this->input->get('key', true);
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_cuff_model->first($id);
                    if($get) {
                        $get->path = path_image('material_cuff_path');
                        $get->obj_path = path_image('material_cuff_path').'object/';
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
                //$get = $this->material_cuff_model->all();
                if($key!="")
                {
                    //$where['material_cuff.title']  =  $key;
                    $where['material_cuff.category'] = 1;
                    $get = $this->material_cuff_model->all(array(
                            'where' => $where,
                            'like' => array('title' => $key)
                            ));
                }else{
                    $get = $this->material_cuff_model->all(array(
                        'where' => array('category' => 1)
                    ));
                }
                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_cuff_path');
                        $get[$key]['obj_path'] = path_image('material_cuff_path').'object/';
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
                $datapi['MESSAGE'] = 'MATERIAL CUFF LIST';
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

    public function get_material_sleeve($id = NULL)
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_cuff_model');
            $key = $this->input->get('key', true);
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_cuff_model->first($id);
                    if($get) {
                        $get->path = path_image('material_cuff_path');
                        $get->obj_path = path_image('material_cuff_path').'object/';
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
                //$get = $this->material_cuff_model->all();
                if($key!="")
                {
                    $where['material_cuff.title']  =  $key;
                    $where['material_cuff.category'] = 2;
                    $get = $this->material_cuff_model->all(array(
                            'where' => $where
                            ));
                }else{
                    $get = $this->material_cuff_model->all(array(
                        'where' => array('category' => 2)
                    ));
                }
                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_cuff_path');
                        $get[$key]['obj_path'] = path_image('material_cuff_path').'object/';
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
                $datapi['MESSAGE'] = 'MATERIAL SLEEVE LIST';
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

    public function get_material_body_type($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_body_type_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_body_type_model->first($id);
                    if($get) {
                        $get->path = path_image('material_body_type_path');
                        $get->obj_path = path_image('material_body_type_path').'object/';
                        //$get->category_text = $get->category == '1' ? 'front' : ($get->category == '2' ? 'back' : 'hem');
                        if ($get->category == 1) {
                            $get->category_text = '04 Front';
                            $get->category_sort = 1;
                        } else if ($get->category == 2) {
                            $get->category_text = '07 Back';
                            $get->category_sort = 3;
                        } else {
                            $get->category_text = '06 Hem';
                            $get->category_sort = 2;
                        }
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
                $filter_category = $this->input->get('category', true);
                if(!is_null($filter_category)) {
                    $code_category = $filter_category == 'front' ? '1' : ($filter_category == 'back' ? '2' : ($filter_category == 'hem' ? '3' : ''));
                    if(!empty($code_category)) {
                        $get = $this->material_body_type_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then '04 Front'
                                    when 2 then '07 Back'
                                    when 3 then '06 Hem'
                                end as category_text,
                                case category
                                    when 1 then 1
                                    when 2 then 3
                                    when 3 then 2
                                end as category_sort",
                                'where' => array(
                                    'material_body_type.category' => $code_category
                                )
                            )
                        );
                    } else {
                        $get = $this->material_body_type_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then '04 Front'
                                    when 2 then '07 Back'
                                    when 3 then '06 Hem'
                                end as category_text,
                                case category
                                    when 1 then 1
                                    when 2 then 3
                                    when 3 then 2
                                end as category_sort"
                            )
                        );
                    }
                } else {
                    $get = $this->material_body_type_model->all(
                        array(
                            'fields' => "*, 
                            case category
                                when 1 then '04 Front'
                                when 2 then '07 Back'
                                when 3 then '06 Hem'
                            end as category_text,
                            case category
                                when 1 then 1
                                when 2 then 3
                                when 3 then 2
                            end as category_sort"
                        )
                    );
                }

                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_body_type_path');
                        $get[$key]['obj_path'] = path_image('material_body_type_path').'object/';
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
                $datapi['MESSAGE'] = 'MATERIAL BODY TYPE LIST';
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

    public function get_material_pocket($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_pocket_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_pocket_model->first($id);
                    if($get) {
                        $get->path = path_image('material_pocket_path');
                        $get->obj_path = path_image('material_pocket_path').'object/';
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
                $get = $this->material_pocket_model->all();
                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_pocket_path');
                        $get[$key]['obj_path'] = path_image('material_pocket_path').'object/';
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
                $datapi['MESSAGE'] = 'MATERIAL POCKET LIST';
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

    public function get_material_embroidery($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_embroidery_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_embroidery_model->first($id);
                    if($get) {
                        $get->path = path_image('material_embroidery_path');
                        $get->obj_path = path_image('material_embroidery_path').'object/';
                        //$get->category_text = $get->category == '1' ? 'position' : ($get->category == '2' ? 'font' : 'color');
                        if ($get->category == 1) {
                            $get->category_text = 'Position';
                            $get->category_sort = 1;
                        } else if ($get->category == 2) {
                            $get->category_text = 'Font';
                            $get->category_sort = 3;
                        } else {
                            $get->category_text = 'Color';
                            $get->category_sort = 2;
                        }
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
                $filter_category = $this->input->get('category', true);
                $key            = $this->input->get('key', true);
                if(!is_null($filter_category)) {
                    $code_category = $filter_category == 'position' ? '1' : ($filter_category == 'font' ? '2' : ($filter_category == 'color' ? '3' : ''));
                    if(!empty($code_category)) {
                        $where['material_embroidery.category']  =  $code_category;
                        if($key!="")
                        {
                            $where['material_embroidery.title']  =  $key;
                        }
                        $get = $this->material_embroidery_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then 'Position'
                                    when 2 then 'Font'
                                    when 3 then 'Color'
                                end as category_text,
                                case category
                                    when 1 then 1
                                    when 2 then 3
                                    when 3 then 2
                                end as category_sort",
                                'where' => $where
                            )
                        );
                    } else {
                        $get = $this->material_embroidery_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then 'Position'
                                    when 2 then 'Font'
                                    when 3 then 'Color'
                                end as category_text,
                                case category
                                    when 1 then 1
                                    when 2 then 3
                                    when 3 then 2
                                end as category_sort"
                            )
                        );
                    }
                } else {
                    $get = $this->material_embroidery_model->all(
                        array(
                            'fields' => "*,
                            case category
                                when 1 then 'Position'
                                when 2 then 'Font'
                                when 3 then 'Color'
                            end as category_text,
                            case category
                                when 1 then 1
                                when 2 then 3
                                when 3 then 2
                            end as category_sort"
                        )
                    );
                }

                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_embroidery_path');
                        $get[$key]['obj_path'] = path_image('material_embroidery_path').'object/';
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
                $datapi['MESSAGE'] = 'MATERIAL EMBROIDERY LIST';
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

    public function get_material_option($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_option_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_option_model->first($id);
                    if($get) {
                        $get->path = path_image('material_option_path');
                        $get->obj_path = path_image('material_option_path').'object/';
                        //$get->category_text = $get->category == '1' ? 'AMF Stitch' : ($get->category == '2' ? 'Interlining' : ($get->category == '3' ? 'sewing' : 'tape'));
                        if ($get->category == 1) {
                            $get->category_text = '13 Stitch Thread';
                        } else if ($get->category == 2) {
                            $get->category_text = '15 Interlining';
                        } else if ($get->category == 3) {
                            $get->category_text = '16 Sewing';
                        } else {
                            $get->category_text = '17 Tape';
                        }
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
                $filter_category = $this->input->get('category', true);
                if(!is_null($filter_category)) {
                    $code_category = $filter_category == 'amf_stitch' ? '1' : ($filter_category == 'interlining' ? '2' : ($filter_category == 'sewing' ? '3' : ($filter_category == 'tape' ? '4' : '')));
                    if(!empty($code_category)) {
                        $get = $this->material_option_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then '13 Stitch Thread'
                                    when 2 then '15 Interlining'
                                    when 3 then '16 Sewing'
                                    when 4 then '17 Tape'
                                end as category_text",
                                'where' => array(
                                    'material_option.category' => $code_category
                                )
                            )
                        );
                    } else {
                        $get = $this->material_option_model->all(
                            array(
                                'fields' => "*, 
                                case category
                                    when 1 then '13 Stitch Thread'
                                    when 2 then '15 Interlining'
                                    when 3 then '16 Sewing'
                                    when 4 then '17 Tape'
                                end as category_text"
                            )
                        );
                    }
                } else {
                    $get = $this->material_option_model->all(
                        array(
                            'fields' => "*, 
                            case category
                                when 1 then '13 Stitch Thread'
                                when 2 then '15 Interlining'
                                when 3 then '16 Sewing'
                                when 4 then '17 Tape'
                            end as category_text"
                        )
                    );
                }

                $tmp = $get;
                $get = array();
                foreach($tmp as $key => $value) {
                    foreach($value as $key2 => $value2) {
                        $get[$key][$key2] = $value2;
                        $get[$key]['path'] = path_image('material_option_path');
                        $get[$key]['obj_path'] = path_image('material_option_path').'object/';
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
                $datapi['MESSAGE'] = 'MATERIAL OPTION LIST';
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

    public function get_material_neck_size($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_neck_size_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_neck_size_model->first($id);
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
                $get = $this->material_neck_size_model->all();
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
                $datapi['MESSAGE'] = 'AROUND THE NECK SIZE LIST';
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

    public function get_material_sleeve_type($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_sleeve_type_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_sleeve_type_model->first($id);
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
                $get = $this->material_sleeve_type_model->all();
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
                $datapi['MESSAGE'] = 'SLEEVE TYPE LIST';
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

    public function get_material_long_sleeve($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_long_sleeve_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_long_sleeve_model->first($id);
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
                $get = $this->material_long_sleeve_model->all();
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
                $datapi['MESSAGE'] = 'LONG SLEEVE LIST';
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

    public function get_material_body_size($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_body_size_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_body_size_model->first($id);
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
                $get = $this->material_body_size_model->all();
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
                $datapi['MESSAGE'] = 'BODY SIZE LIST';
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

    public function get_material_shoulder_width($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_shoulder_width_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_shoulder_width_model->first($id);
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
                $get = $this->material_shoulder_width_model->all();
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
                $datapi['MESSAGE'] = 'SHOULDER WIDTH LIST';
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

    public function get_material_chest_circumference($id = null) {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_chest_circumference_model');
            if(!is_null($id)) {
                if(is_numeric($id)) {
                    $get = $this->material_chest_circumference_model->first($id);
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
                $get = $this->material_chest_circumference_model->all();
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
                $datapi['MESSAGE'] = 'CHEST CIRCUMFERENCE LIST';
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

    public function get_material_cleric() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_cleric_model');
            $this->load->model('material_fabric_model');
            $get_id_cleric = $this->input->post('ID_CLERIC', true);
            $get_id_category = $this->input->post('ID_CATEGORY', true);
            $get_id_sub_category = $this->input->post('ID_SUB_CATEGORY', true);
            if(!is_null($get_id_cleric)) {
                if(is_numeric($get_id_cleric)) {
                    $get = $this->material_cleric_model->first($get_id_cleric);
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
            } else if(!is_null($get_id_category) || !is_null($get_id_sub_category)) {
                $where = array();
                if(!is_null($get_id_category) && !empty($get_id_category)) {
                    /*
                    $where = array_merge($where, array(
                        'material_cleric.id_category' => $get_id_category
                    ));
                    */
                }
                if(!is_null($get_id_sub_category) && !empty($get_id_sub_category)) {
                    /*
                    $where = array_merge($where, array(
                        'material_cleric.id_sub_category' => $get_id_sub_category
                    ));
                    */
                }
                if(!empty($where)) {
                    $get = $this->material_cleric_model->all(
                        array(
                            'fields' => 'material_cleric.*',
                            'where' => $where
                        )
                    );
                } else {
                    $get = $this->material_cleric_model->all(
                        array(
                            'fields' => 'material_cleric.*',
                        )
                    );
                }

                if($get) {
                    foreach($get as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                            $newget[$key]['PATH'] = path_image('material_cleric_path');
                            if ($childkey == 'price') {
                                $newget[$key]['PRICE_FORMAT'] = format_currency($childvalue);
                            }
                        }
                    }
                }
            } else {
                $get = $this->material_cleric_model->all(
                    array(
                        'fields' => 'material_cleric.*',
                    )
                );
                if($get) {
                    foreach($get as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                            $newget[$key]['PATH'] = path_image('material_cleric_path');
                            if ($childkey == 'price') {
                                $newget[$key]['PRICE_FORMAT'] = format_currency($childvalue);
                            }
                        }
                    }
                }
            }

            if($get) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'CLERIC LIST';
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

    public function get_material_cleric_category() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_cleric_category_model');
            $get_id_category = $this->input->post('ID_CATEGORY', true);
            if(!is_null($get_id_category)) {
                if(is_numeric($get_id_category)) {
                    $get = $this->material_cleric_category_model->first($get_id_category);
                    if($get) {
                        $get->path = path_image('material_cleric_category_path');
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
                $get = $this->material_cleric_category_model->all();
                if($get) {
                    foreach($get as $key => $value) {
                        foreach($value as $childkey => $childvalue) {
                            $newget[$key][strtoupper($childkey)] = $childvalue;
                            $newget[$key]['PATH'] = path_image('material_cleric_category_path');
                        }
                    }
                }
            }

            if($get) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'CLERIC CATEGORY LIST';
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

    /*
    public function get_material_cleric_sub_category() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_cleric_sub_category_model');
            $get_id_category = $this->input->post('ID_CATEGORY', true);
            if(!is_null($get_id_category)) {
                if(is_numeric($get_id_category)) {
                    $get = $this->material_cleric_sub_category_model->all(
                        array(
                            'where' => array(
                                'id_category' => $get_id_category
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
                } else {
                    $datapi['STATUS'] = 'FAILED';
                    $datapi['MESSAGE'] = 'PARAMETER MUST NUMERIC';
                    $datapi['DATA'] = (object)array();
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($datapi));
                }
            } else {
                $datapi['STATUS'] = 'FAILED';
                $datapi['MESSAGE'] = 'ID_CATEGORY IS REQUIRED';
                $datapi['DATA'] = (object)array();
                return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($datapi));
            }

            if($get) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'CLERIC SUB CATEGORY LIST';
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
    */

    public function get_material_cleric_sub_category() {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {
            $this->load->model('material_cleric_sub_category_model');
            $get_id_category = $this->input->post('ID_CATEGORY', true);

            $where = NULL;
            if ($get_id_category && is_numeric($get_id_category)) {
                $where = array(
                    'where' => array('id_category' => $get_id_category)
                );
            }

            $get = $this->material_cleric_sub_category_model->all($where);
            if($get) {
                foreach($get as $key => $value) {
                    foreach($value as $childkey => $childvalue) {
                        $newget[$key][strtoupper($childkey)] = $childvalue;
                    }
                }
            }

            if($get) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'CLERIC SUB CATEGORY LIST';
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

    public function fn_check_long_sleeve()
    {
        $headers = apache_request_headers();
        $check = $this->check_app_token($headers);
        if($check['STAT'] == TRUE) {

            $id_sleeve = $this->input->post('sleeve_id');
            $q = $this->db->query("
                SELECT id FROM material_cuff WHERE category = 2 AND id = $id_sleeve AND is_long_sleeve = 1
            ");
            if ($q->num_rows() > 0) {
                $datapi['STATUS'] = 'SUCCESS';
                $datapi['MESSAGE'] = 'CHECK LONG SLEEVE';
                $datapi['DATA'] = (object) array();
            } else {

                // SHORT SLEEVE DETECTED
                // UNSET ALL SESSION FROM CUFF MATERIAL
                $this->session->unset_userdata('id_cuff');
                $this->session->unset_userdata('price_id_cuff');

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

    public function reset_material_selection($material = NULL) {
        if ($material) {
            switch($material) {
                case 'cleric':
                    $this->session->unset_userdata('skin_id_collar_cuff');
                    $this->session->unset_userdata('skin_id_collar_cuff_front_placket');
                    $this->session->unset_userdata('skin_id_inner_collar_cuff');
                    $this->session->unset_userdata('skin_id_inner_collar_cuff_lower_placket');
                    $this->session->unset_userdata('cleric_type');
                    $this->session->unset_userdata('id_cleric');
                    $this->session->unset_userdata('cleric_type_id');
                break;
                case 'embroidery_position':
                    $this->session->unset_userdata('id_embroidery_position');
                    $this->session->unset_userdata('price_id_embroidery_position');
                break;
                case 'embroidery_font':
                    $this->session->unset_userdata('id_embroidery_font');
                    $this->session->unset_userdata('price_id_embroidery_font');
                break;
                case 'embroidery_color':
                    $this->session->unset_userdata('id_embroidery_color');
                    $this->session->unset_userdata('price_id_embroidery_color');
                break;
                case 'option_amf_stitch':
                    $this->session->unset_userdata('id_option_amf_stitch');
                    $this->session->unset_userdata('price_id_option_amf_stitch');
                break;
                case 'option_tape':
                    $this->session->unset_userdata('id_option_tape');
                    $this->session->unset_userdata('price_id_option_tape');
                break;
                case 'option_interlining':
                    $this->session->unset_userdata('id_option_interlining');
                    $this->session->unset_userdata('price_id_option_interlining');
                break;
                case 'option_sewing':
                    $this->session->unset_userdata('id_option_sewing');
                    $this->session->unset_userdata('price_id_option_sewing');
                break;
            }
        }
    }

}
