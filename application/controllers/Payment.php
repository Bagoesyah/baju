<?php
# @Author: Awan Tengah
# @Date:   2017-04-26T13:37:58+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T20:52:08+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller
{

    public $midtrans_client_key;
    public $midtrans_server_key;

    public function __construct()
    {
        parent::__construct();

        $this->midtrans_client_key = $this->config->item('midtrans_client_key');
        $this->midtrans_server_key = $this->config->item('midtrans_server_key');

        $params = array('server_key' => $this->midtrans_server_key, 'production' => $this->config->item('is_production'));
        $this->load->library('veritrans');
        $this->veritrans->config($params);

        $this->layout = 'template/frontend';
    }

    public function proceed() {

        $this->check_is_login();

        // check shipping
        $q_shipping = $this->db->query("
            SELECT id FROM order_shipping WHERE id_user = ".$this->_user_login->id."
        ");
        if ($q_shipping->num_rows() == 0) {
            $this->session->set_flashdata('error_shipping', 'Please input and save your shipping information.');
            redirect('cart/shoping_bag');
        }

        $get_order_number = $this->input->get('ORDER_NUMBER', true);
        $get_price = $this->input->get('PRICE', true);

        if(!is_null($get_order_number) && !is_null($get_price)) {
            if(!empty($get_order_number) && !empty($get_price)) {

                //
                $data_get_order_product = array(
                    'ID_USER' => $this->_user_login->id,
                    'ORDER_NUMBER' => $get_order_number
                );
                $headers = array(
                    'USER_TOKEN' => $this->_user_login->user_token
                );
                $get_by_order_number = get_data_curl(base_url('api/order/get_order_product'), $data_get_order_product, $headers);

                // Check for any coupon applied
                $c_order_number = ($get_order_number) ? $get_order_number : get_session('last_order_number');
                $q_coupon = $this->db->query("
                    SELECT * FROM order_product_coupon WHERE order_number = '$c_order_number'
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

                //echo '<pre>';
                //echo $total_pay;
                //print_r($transaction_details);
                //print_r($item_details);die();

                $get_order_shipping = get_data_curl(base_url('api/order/get_order_shipping'), array('ID_USER' => $this->_user_login->id));

                

                if($get_order_shipping->STATUS == 'SUCCESS') {
                    (!empty($get_order_shipping->DATA->HP)) ? $phone_ss = $get_order_shipping->DATA->HP : $phone_ss = $get_order_shipping->DATA->PHONE;
                    $shipping_address = array(
                        'first_name'       => $get_order_shipping->DATA->NAME,
                        'address'      => $get_order_shipping->DATA->ADDRESS,
                        'city'         => $get_order_shipping->DATA->CITY,
                        'postal_code'  => $get_order_shipping->DATA->ZIP_CODE,
                        'phone'        => $phone_ss,
                        'country_code' => 'IDN'
                    );
                } else {
                    $shipping_address = array();
                }

                $customer_details = array(
                    'first_name'       => $this->_user_login->name,
                    'email'            => $this->_user_login->email,
                    'phone'            => $this->_user_login->phone,
                    'shipping_address' => $shipping_address
                );

                //print_r($customer_details);die();

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
                    header('Location: ' . $vtweb_url);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }

    /*
    public function notification_handling() {

        header("Access-Control-Allow-Origin: *");
        header("Accept: application/json");
        //header("Content-Type: application/json");

        echo 'Notification works!';

        /*
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if($result){
            $notif = $this->veritrans->status($result->order_id);
        }

        //error_log(print_r($result,TRUE));

        //notification handler sample
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id ." is challenged by FDS";
                }
                else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
                }
            }
        }
        else if ($transaction == 'settlement'){
            // TODO set payment status in merchant's database to 'Settlement'
            echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
        }
        else if($transaction == 'pending'){
            // TODO set payment status in merchant's database to 'Pending'
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        }
        else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        }
    }
    */

    public function finish() {
        
        /*
        $get_gross_amount = $this->input->get('gross_amount', true);
        $get_payment_type = $this->input->get('payment_type', true);
        $get_transaction_time = $this->input->get('transaction_time', true);

        $headers = array(
            'USER_TOKEN' => $this->_user_login->user_token
        );

        $post_payment_history = array(
            'ID_USER' => $this->_user_login->id,
            'ORDER_NUMBER' => substr($get_order_id, strrpos($get_order_id, "-")+1),
            'MIDTRANS_ORDER_ID' => $get_order_id,
            'MIDTRANS_GROSS_AMOUNT' => $get_gross_amount,
            'PAYMENT_METHOD' => $get_payment_type,
            'TRANSACTION_TIME' => $get_transaction_time
        );
        $save_payment_history = get_data_curl(base_url('api/order/insert_payment_history'), $post_payment_history, $headers);

        if ($save_payment_history) {
            // UPDATE ORDER STATUS
            $data_update = [
                'status' => 5
            ];
            $update = $this->db->update('order_product', $data_update, array(
                'order_number' => substr($get_order_id, strrpos($get_order_id, "-")+1)
            ));
        }
        */

        $data['message'] = "Thank you for completing the payment process";
        $data['status'] = 'SUCCESS';
        $this->render('payment_response', $data);
    }

    public function unfinish() {
        $data['message'] = "Sorry we couldn't process your payment";
        $data['status'] = 'UNFINISH';
        $this->render('payment_response', $data);
    }

    public function error() {
        $data['message'] = "An error occurred on the transaction data sent";
        $data['status'] = 'ERROR';
        $this->render('payment_response', $data);
    }
}
