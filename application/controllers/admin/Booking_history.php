<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-30T10:48:37+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_history extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_validation();

        $this->load->model('order_product_model');
        $this->load->model('user_model');
        $this->layout = 'template/admin';
        $this->page_title = 'Booking History';
    }

    public function get_data()
    {
        $data = $this->order_product_model->all(
            array(
                'fields' => "order_product.*, if(order_product.order_type = 1, 'Product', 'Custom') as order_type_text, user.name, order_product_status.title as status_text,
                custom_product.image as custom_product_image, custom_product.price as custom_price, custom_product.quantity, custom_product.embroidery_text,
                material_fabric.title as fabric_title, material_fabric.code_fabric as fabric_code, material_collar.title as collar_title, material_cuff.title as cuff_title,
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
                if(custom_product.id_cleric != '', material_cleric_category.title, '') as cleric_category,
                material_cleric.title as cleric_title, material_cleric.code_fabric as cleric_fabric_code,
                custom_product_size.neck, custom_product_size.shoulder, custom_product_size.chest, custom_product_size.waist, custom_product_size.hip, custom_product_size.arm_hole,
                custom_product_size.back_length_88, custom_product_size.back_length_89, custom_product_size.aloha_88, custom_product_size.aloha_89, custom_product_size.cuffs_circle,
                custom_product_size.short_sleeve, custom_product_size.sleeve_circle, sleeve.title AS sleeve_title,
                custom_product_size.around_neck_selection,
                custom_product_size.body_type_selection,
                custom_product_size.sleeve_type_selection,
                custom_product_size.sleeve_length_right_selection,
                custom_product_size.sleeve_length_left_selection",
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
                'order_by' => 'order_product.id DESC'
            )
        );
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

    public function index()
    {
        $data['on_section'] = 'List';
        $this->render('booking_history/list', $data);
    }

}
