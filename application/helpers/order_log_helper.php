<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('order_log')) {

    function order_log($label, $data = [])
    {
        $CI =& get_instance();

        $log = [
            'label'       => $label,
            'user_type'   => $data['user_type'] ?? 'guest',
            'user_id'     => $data['user_id'] ?? 0,
            'name'        => $data['name'] ?? null,
            'email'       => $data['email'] ?? null,
            'order_id'    => $data['order_id'] ?? null,
            'payment'     => $data['payment_method'] ?? null,
            'total'       => $data['total_amount'] ?? 0,
            'products'    => $data['products'] ?? [],
            'ip'          => $CI->input->ip_address(),
            'agent'       => $CI->input->user_agent(),
            'time'        => date('Y-m-d H:i:s')
        ];

        log_message('info', 'ORDER_LOG | ' . json_encode($log, JSON_UNESCAPED_UNICODE));
    }
}
