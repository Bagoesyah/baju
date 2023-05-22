<?php
//header("Accept: application/json");
//header("Content-Type: application/json");

class Midtrans_payment extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->midtrans_client_key = $this->config->item('midtrans_client_key');
        $this->midtrans_server_key = $this->config->item('midtrans_server_key');

        $params = array('server_key' => $this->midtrans_server_key, 'production' => $this->config->item('is_production'));
        $this->load->library('veritrans');
        $this->veritrans->config($params);
    }

    public function notification()
    {
        $json_result = file_get_contents('php://input');
        $json_result = utf8_encode($json_result); 
        $result = json_decode($json_result);

        $order_number = substr($result->order_id, strrpos($result->order_id, "-")+1);

        $q_check = $this->db->query("
            SELECT id FROM payment_history WHERE order_number = '".$order_number."'
        ");

        if ($q_check->num_rows() > 0) {

            // UPDATE
            if (strtolower($result->fraud_status) == 'accept' && ($result->transaction_status == 'capture' || $result->transaction_status == 'settlement') && $result->status_code == 200) {
                $update_data = [
                    'payment_status' => 'success',
                    'created_at' => date('Y-m-d H:i:s'),
                    'payment_method' => ''.$result->payment_type.'',
                ];
                $update = $this->db->update('payment_history', $update_data, array(
                    'order_number' => $order_number
                ));

                if ($update) {
                    // UPDATE ORDER PRODUCT
                    $order_update = [
                        'status' => 5,
                    ];
                    $update_order_product = $this->db->update('order_product', $order_update, array(
                        'order_number' => $order_number
                    ));

                    // Send Order Notification
                    get_data_curl(base_url('api/order/send_order_notification/' . $order_number), null, null);
                }
            }

        } else {

            $status = 'pending';
            if (strtolower($result->fraud_status) == 'accept' && ($result->transaction_status == 'capture' || $result->transaction_status == 'settlement') && $result->status_code == 200) {
                $status = 'success';
            }

            // INSERT
            $insert = $this->db->insert('payment_history', [
                'order_number' => substr($result->order_id, strrpos($result->order_id, "-")+1),
                'midtrans_order_id' => ''.$result->order_id.'',
                'midtrans_gross_amount' => ''.$result->gross_amount.'',
                'payment_method' => ''.$result->payment_type.'',
                'payment_status' => $status,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if ($insert) {
                if ($status == 'success') {
                    // UPDATE ORDER PRODUCT
                    $order_update = [
                        'status' => 5,
                    ];
                    $update_order_product = $this->db->update('order_product', $order_update, array(
                        'order_number' => $order_number
                    ));

                    // Send Order Notification
                    get_data_curl(base_url('api/order/send_order_notification/' . $order_number), null, null);
                }
            }
        }
    }
}