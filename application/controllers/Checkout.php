<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';
class Checkout extends My_controller {
    function __construct() {
        parent::__construct();
        
        $this->CI = & get_instance();
        $this->load->helper('cookie');
        $this->Base_model->visitor_logs();
       
    }
    
    // public function imagesupload(){
    //     $files = glob('uploads/upimages/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    //     foreach($files as $file) {
    //         $file_name = str_replace('uploads/upimages/', '', $file);
    //         $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    //         $only_name = basename($file_name, ".".$ext);
    //         $product = $this->db->query("SELECT a.*, b.* FROM app_product_stocks a, app_products b WHERE a.sku = '$only_name' && b.id = a.product_id && b.thumbnail_img IS NULL");
    //             if($product->num_rows() > 0){
    //                 $product = $product->row_array();
    //                 $timestamp = strtotime(date('Y-m-d H:i:s'));
    //                 $product_id = $product['product_id'];
    //                 $img_file_name = 'product'.$product_id.'_thumbnail_'.$timestamp . '.'.$ext;
    //                 copy("uploads/upimages/".$file_name,"uploads/products/".$img_file_name);
    //                 $this->db->query("UPDATE app_products SET thumbnail_img = '$img_file_name', published='1' WHERE id = '{$product['product_id']}'");
    //                  echo $only_name.'<br>';
    //             }
         
    //     }
    // }
    
    // public function change_status(){
    //     $order_details = $this->db->query("SELECT * FROM app_order_details");
    //     foreach($order_details->result_array() as $row){
    //         $order = $this->db->query("SELECT * FROM app_orders WHERE id = '{$row['order_id']}'")->row_array();
    //         $this->db->query("UPDATE app_order_details SET cashback_sent = '{$order['cashback_sent']}', status = '{$order['status']}' WHERE id = '{$row['id']}'");
    //     }
    // }
    
    public function index()
{
    $data['view_scripts'] = [];
    $data['view_css'] = [];

    // 1. Get unified cart
    $data['cart'] = $this->get_cart_items();

    if (empty($data['cart'])) {
        redirect('cart');
    }

    // 2. Detect user type
    $is_logged_in = $this->session->userdata('user_loggedin') ? true : false;
    $data['is_guest'] = !$is_logged_in;

    // 3. Logged-in user data
    if ($is_logged_in) {

        $user_id = (int) $this->session->userdata('user_id');

        $data['user'] = $this->db
            ->where('id', $user_id)
            ->get('app_users')
            ->row_array();

        $data['billing'] = $this->db
            ->where(['user_id' => $user_id, 'type' => 1])
            ->order_by('id', 'DESC')
            ->get('app_address')
            ->row_array();

        $data['shipping'] = $this->db
            ->where(['user_id' => $user_id, 'type' => 2])
            ->order_by('id', 'DESC')
            ->get('app_address')
            ->row_array();
    }

    // 4. Calculate totals ONCE
    $totals = $this->calculate_cart_totals($data['cart']);
    $data = array_merge($data, $totals);

    $this->load_web('checkout', $data);
}
private function get_cart_items()
{
    if ($this->session->userdata('user_loggedin')) {

        $user_id = (int) $this->session->userdata('user_id');

        return $this->db
            ->select('c.*, p.name, p.slug, p.thumbnail_img')
            ->from('app_cart c')
            ->join('app_products p', 'p.id = c.product_id')
            ->where('c.user_id', $user_id)
            ->get()
            ->result_array();

    } else {
		$session_id = isset($_COOKIE['session_id']) ? $_COOKIE['session_id'] : '';
		if (!$session_id) return [];

		return $this->db
			->select('c.*, p.name, p.slug, p.thumbnail_img')
			->from('app_cart c')
			->join('app_products p', 'p.id = c.product_id')
			->where('c.session_id', $session_id)
			->get()
			->result_array();
    }
}
private function calculate_cart_totals($cart)
{
    $subtotal = 0;
    $vat_rate = 0.20;
	$shipping_cost = 0;

    foreach ($cart as $row) {
        $subtotal += $row['qty'] * $row['price'];
    }

    $vat = $subtotal * $vat_rate;
	$grand_total = $subtotal + $vat;

    return [
        'subtotal'      => $subtotal,
        'vat'           => $vat,
		'shipping_cost' => 0,
        'grand_total'   => $grand_total
    ];
}
public function getAreasByCity()
{
    $city_id = (int) $this->input->post('city_id');

    $areas = $this->db
        ->where(['status' => 1, 'city_id' => $city_id])
        ->order_by('name', 'ASC')
        ->get('app_areas')
        ->result_array();

    $html = '<option value="">Select Area</option>';

    foreach ($areas as $row) {
        $html .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }

    echo $html;
}


   
	// public function index()
	// {
	    
		
	// 	$data['view_scripts']=array();
	// 	$data['view_css']=array(
	// 	    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
	// 	);
		
	// 	if($this->session->userdata('user_loggedin')){
    //         $user_id = $this->session->userdata('user_id');
    //         $data['cart'] = $this->db->query("SELECT * FROM app_cart where user_id = '$user_id'")->result_array();
    //     }else{
    //         $session_id = $_COOKIE['session_id'];
    //         $data['cart'] = $this->db->query("SELECT * FROM app_cart where session_id = '$session_id'")->result_array();
    //     } 
	
    //     $this->load_web('checkout',$data);
	// }
	
	// public function getAreasByCity(){
	//     $city_id = $this->input->post('city_id');
	//     $areas = $this->db->query("SELECT * FROM app_areas where status = '1' && city_id = '$city_id' Order by name asc")->result_array();
	//     $html = '<option value="" selected="selected">Select Area</option>';
    //     foreach($areas as $row){
    //         $html .= '<option value="'.$row['id'].'" >'.$row['name'].'</option>';
    //     }
    //     echo $html;
	// }
	
	
	public function process(){
	    if($this->input->post() && $this->session->userdata('user_loggedin')){
	        $user_id = $this->session->userdata('user_id');
	        $user = $this->db->select('*')->from('app_users')->where('id', $user_id)->get()->row_array();  
	        $cart = $this->db->query("SELECT * FROM app_cart WHERE user_id = '$user_id'");
	        if($cart->num_rows() > 0){
    	        $billing['user_id'] = $this->session->userdata('user_id');
    	        $billing['type'] = 1;
    	        $billing['full_name'] = $this->input->post('full_name');
    	        $billing['city_id'] = $this->input->post('city_id');
    	        $billing['area_id'] = $this->input->post('area_id');
    	        $billing['address'] = $this->input->post('address');
    	        $billing['street'] = $this->input->post('street');
    	        $billing['zipcode'] = '';
    	        $billing['plus_code'] = $this->input->post('plus_code');
    	        $billing['phone'] = $this->input->post('phone');
    	        $billing['email'] = $this->input->post('email');
    	        
    	        $this->db->insert('app_address', $billing);
    	        $billing_address = $this->db->insert_id();
    	        
    	        
    	       // if($this->input->post('shipping_toggle')){
    	       //     $shipping['user_id'] = $this->session->userdata('user_id');
        	   //     $shipping['type'] = 1;
        	   //     $shipping['full_name'] = $this->input->post('sfull_name');
        	   //     $shipping['city_id'] = $this->input->post('scity_id');
        	   //     $shipping['area_id'] = $this->input->post('sarea_id');
        	   //     $shipping['address'] = $this->input->post('saddress');
        	   //     $shipping['street'] = $this->input->post('sstreet');
        	   //     $shipping['zipcode'] = '';
        	   //     $shipping['plus_code'] = $this->input->post('splus_code');
        	   //     $shipping['phone'] = $this->input->post('sphone');
        	   //     $shipping['email'] = $this->input->post('semail');
        	   //     $this->db->insert('app_address', $shipping);
    	       //     $shipping_address = $this->db->insert_id();
    	       // }else{
    	            $billing['type'] = 2;
    	            $this->db->insert('app_address', $billing);
    	            $shipping_address = $this->db->insert_id();
    	       // }
    	        
    	        if($billing['city_id']==4 || $billing['city_id']==10){
    	            $shipping_fee = 0;
    	        }else{
    	            $shipping_fee = $this->db->query("SELECT shipping_cost FROM app_cart WHERE user_id = '$user_id' ORDER BY shipping_cost DESC LIMIT 0,1")->row()->shipping_cost;
    	        }
    	        
    	        
    	        $cart = $cart->result_array();
    	        
    	        $grand_total = $shipping_fee;
    	        
    	        foreach($cart as $row){
    	            $grand_total += $row['total_amount'];
    	        }
    	        
    	        
    	        $grand_total = $grand_total-$user['balance']; 
    	        if($grand_total < 0){ $grand_total = 0;}
    	        $order['user_id'] = $this->session->userdata('user_id');
    	        $order['order_notes'] = $this->input->post('order_notes');
    	        $order['created_date'] = date('Y-m-d H:i:s');
    	        $order['billing_address'] = $billing_address;
    	        $order['shipping_address'] = $shipping_address;
    	        $order['payment_method'] = 1;
    	        $order['total_amount'] = $grand_total;
    	        
    	        $this->db->insert('app_orders', $order);
    	        $orderid = $this->db->insert_id();
    	        $shipping_fee = round($shipping_fee/count($cart));
    	        
    	        $cashbask = $user['balance'];
    	        foreach($cart as $row){
    	            $total_amount = $row['total_amount']+$shipping_fee-$cashbask; 
    	            if($total_amount < 0){
    	                $total_amount = 0;
    	            }
    	            
    	            $cashbask -= $row['total_amount']+$shipping_fee;
    	            if($cashbask < 0){
    	                $cashbask = 0;
    	            }
    	            
    	            $product = $this->db->query("SELECT * FROM app_products where id = '{$row['product_id']}'")->row_array();
    	            $orderDet['vendor_id'] = $product['vendor_id'];
    	            $orderDet['user_id'] = $this->session->userdata('user_id');
    	            $orderDet['order_id'] = $orderid;
    	            $orderDet['product_id'] = $row['product_id'];
    	            $orderDet['variant'] = $row['variant'];
    	            $orderDet['sku'] = $row['sku'];
    	            $orderDet['qty'] = $row['qty'];
    	            $orderDet['price'] = $row['price'];
    	            $orderDet['total_amount'] = $total_amount;
    	            $orderDet['shipping_cost'] = $shipping_fee;
    	            $orderDet['status'] = 0;
    	            $this->db->insert('app_order_details', $orderDet);
    	            
    	        }
    	        
    	        $this->db->query("UPDATE app_users SET balance = '$cashbask' WHERE id = '$user_id'");
    	        
    	        $year = date('y');
    	        $user_id = $this->session->userdata('user_id');
                $this->db->query("DELETE FROM app_cart where user_id = '$user_id'");
                
                $user = $this->db->query("SELECT * FROM app_users WHERE id = '$user_id'")->row_array();
                $sms = "Dear ".$user['full_name'].", Thank you for shopping with Marlota. Your Order No. $year$orderid is now being processed.";
                // $this->Base_model->sendSMS("BEATERS", $user['phone'], $sms);
                // $this->Base_model->sendSMS("BEATERS", "03000022500", "You have received new order. Order No.".$year.$orderid.". Check it out in Admin Panel Thanks");
                // $this->Base_model->sendSMS("BEATERS", "03126935630", "You have received new order. Order No.".$year.$orderid.". Check it out in Admin Panel Thanks");
                // $this->Base_model->sendSMS("BEATERS", "03058501234", "You have received new order. Order No.".$year.$orderid.". Check it out in Admin Panel Thanks");
                $this->session->set_userdata(array('flash_message'=>'<div class="alert alert-success alert-inline show-code-action">Thank you for shopping with Marlota. Your Order No. '.$year.$orderid.' is now being processed.</div>'));
    	        redirect(base_url('user/orders'));
    	        exit;
    	        
	        }
	        
	        
	        
	    }
	    
	    redirect(base_url());
	    exit;
	}
	
	// public function processorder(){

	// 	if(!$this->input->post()){
	// 		show_error("Invalid request");
	// 	}
	//   //  if($this->input->post() && $this->session->userdata('user_loggedin')){

	// 		$isLoggedIn = $this->session->userdata('user_loggedin');
	// 		echo 'isLoggedIn: <pre>' .print_r($isLoggedIn,true). '</pre>';
	// 		$user_id    = $isLoggedIn ? $this->session->userdata('user_id') : null;
	// 		echo 'user_id: <pre>' .print_r($user_id,true). '</pre>';

	// 		// if logged in, get user
	// 		$user = [];
	// 		if($isLoggedIn){
	// 			$user = $this->db->select('*')
	// 					->from('app_users')
	// 					->where('id', $user_id)
	// 					->get()->row_array();
	// 		}

	// 		// get cart differently for guest vs logged in
	// 		if($isLoggedIn){
	// 			$cart = $this->db->query("SELECT * FROM app_cart WHERE user_id = '$user_id'");
	// 		} else {
	// 			// for guest you need to store cart in SESSION
	// 			$cart = $this->session->userdata('guest_cart'); 
	// 			echo 'cart: <pre>' .print_r($cart,true). '</pre>';

	// 		}

	// 		if($cart && count($cart) > 0){
	// 			echo 'next cart'; die;
	// 			if($this->input->post('payment_type')==2){

	// 				$stripe_intent_id = $this->input->post('stripe_intent_id');

	// 				if (empty($stripe_intent_id)) {
	// 					$res['status'] = 'error';
	// 					$res['msg'] = "Invalid Stripe Intent ID";
	// 					echo json_encode($res);
	// 					exit;
	// 				}

	// 				// (Optional) Verify the payment intent status with Stripe API
	// 				require_once FCPATH.'vendor/autoload.php';
	// 				\Stripe\Stripe::setApiKey($this->settings['stripe_sk']);

	// 				try {
	// 					$intent = \Stripe\PaymentIntent::retrieve($stripe_intent_id);

	// 					if ($intent->status !== 'succeeded') {
	// 						$res['status'] = 'error';
	// 						$res['msg'] = "Payment not successful. Status: " . $intent->status;
	// 						echo json_encode($res);
	// 						exit;
	// 					}

	// 					// Store transaction id
	// 					$transection_id = $stripe_intent_id;

	// 				} catch (Exception $e) {
	// 					$res['status'] = 'error';
	// 					$res['msg'] = $e->getMessage();
	// 					echo json_encode($res);
	// 					exit;
	// 				}
				
					
	// 			}
				
	// 			if($this->input->post('payment_type')==3){
	// 				if(empty($this->input->post('paypal_trx_id'))){
	// 					$res['status'] = 'error';
	// 					$res['msg'] = "Invalid Token";
	// 					echo json_encode($res);
	// 					exit;
	// 				}
					
					
	// 				$curl = curl_init();

	// 				curl_setopt_array($curl, array(
	// 				CURLOPT_URL => 'https://api-m.paypal.com/v1/oauth2/token',
	// 				CURLOPT_RETURNTRANSFER => true,
	// 				CURLOPT_ENCODING => '',
	// 				CURLOPT_MAXREDIRS => 10,
	// 				CURLOPT_TIMEOUT => 0,
	// 				CURLOPT_FOLLOWLOCATION => true,
	// 				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 				CURLOPT_CUSTOMREQUEST => 'POST',
	// 				CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
	// 				CURLOPT_HTTPHEADER => array(
	// 					'Authorization: Basic QWFSVjhJeTVnRmdvbG5zZ3dkRmF2TW9ick5CV0s4U0pWSEVwZU4yMDRNakJxR2dpaWIzZl91RFVHLWhENXJDYzZza1NVcHZJQ181Wm9pa2I6RUtqNFdwaVhuYWRqblZrM05fVERGUGRIZmpFbWlYdjRIbmM1cnhBb2RGOHdnT2NFYmFId2M3eGlXZzc0d25zeUVPODh0YlZIYUUtc1ppbXM=',
	// 					'Content-Type: application/x-www-form-urlencoded'
	// 				),
	// 				));
					
	// 				$response = curl_exec($curl);
	// 				$response = json_decode($response, true);
	// 				curl_close($curl);
	// 				if(!array_key_exists("access_token",$response)){
	// 					$res['status'] = 'error';
	// 					$res['msg'] = "Cannot Verify Payment.";
	// 					echo json_encode($res);
	// 					exit;
	// 				}
					
	// 					$access_token = $response['access_token'];
						
	// 					$curl1 = curl_init();

	// 					curl_setopt_array($curl1, array(
	// 					CURLOPT_URL => 'https://api.paypal.com/v2/checkout/orders/'.$this->input->post('paypal_trx_id'),
	// 					CURLOPT_RETURNTRANSFER => true,
	// 					CURLOPT_ENCODING => '',
	// 					CURLOPT_MAXREDIRS => 10,
	// 					CURLOPT_TIMEOUT => 0,
	// 					CURLOPT_FOLLOWLOCATION => true,
	// 					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 					CURLOPT_CUSTOMREQUEST => 'GET',
	// 					CURLOPT_HTTPHEADER => array(
	// 						'Authorization: Bearer '.$access_token
	// 					),
	// 					));
						
	// 					$responseOrder = curl_exec($curl1);
	// 					$responseOrder = json_decode($responseOrder, true);
	// 					curl_close($curl1);
						
	// 					if(!array_key_exists("status",$responseOrder) || !array_key_exists("id",$responseOrder)){
	// 						$res['status'] = 'error';
	// 						$res['msg'] = "Cannot Verify Payment.";
	// 						echo json_encode($res);
	// 						exit;
	// 					}
	// 					if($responseOrder['status']!='COMPLETED'){
	// 						$res['status'] = 'error';
	// 						$res['msg'] = "Payment Status is not completed.";
	// 						echo json_encode($res);
	// 						exit;
	// 					}
						
	// 					$transection_id = $this->input->post('paypal_trx_id');
					
					
	// 			}
	// 			$order_total = $this->input->post('grand_total');
	// 			$checkout_type = $this->input->post('checkout_type');
	// 			if($checkout_type == 'user'){
	// 				$guestCheckout = 0;
	// 			}else{
	// 				$guestCheckout = 1;

	// 			}

	// 			$billing['user_id'] = $this->session->userdata('user_id');
	// 			$billing['type'] = 1;
	// 			$billing['full_name'] = $this->input->post('full_name');
	// 			$billing['city'] = $this->input->post('city');
	// 			$billing['country'] = $this->input->post('country');
	// 			$billing['address'] = $this->input->post('address');
	// 			$billing['street'] = $this->input->post('street');
	// 			$billing['zipcode'] = $this->input->post('zipcode');
	// 			$billing['plus_code'] = '';
	// 			$billing['phone'] = $this->input->post('phone');
	// 			$billing['email'] = $this->input->post('email');
				
	// 			$this->db->insert('app_address', $billing);
	// 			$billing_address = $this->db->insert_id();
	// 			$shipping_address = $billing_address;
				
			
	// 			$shipping_fee = 0;
				
				
				
				
	// 			$order['user_id'] = $this->session->userdata('user_id') ?? 0;
	// 			$order['order_notes'] = $this->input->post('order_notes') ?? null;
	// 			$order['created_date'] = date('Y-m-d H:i:s');
	// 			$order['billing_address'] = $billing_address;
	// 			$order['shipping_address'] = $shipping_address;
	// 			$order['payment_method'] = $this->input->post('payment_type');
	// 			$order['total_amount'] = $order_total;
	// 			$order['vat'] = $order_total * 0.20;
	// 			$order['shipping_cost'] = 4;
	// 			$order['guest_user'] = $guestCheckout;
			
	// 			$this->db->insert('app_orders', $order);
	// 			$orderid = $this->db->insert_id();
	// 			$shipping_fee = round($shipping_fee/count($cart));
				
	// 			$balance = $user['balance'];
	// 			foreach($cart as $row){ 
	// 				$total_amount = $row['total_amount']+$shipping_fee-$balance; 
	// 				if($total_amount < 0){
	// 					$total_amount = 0;
	// 				}
					
	// 				$balance -= $row['total_amount']+$shipping_fee;
	// 				if($balance < 0){
	// 					$balance = 0;
	// 				}
					
	// 				$product = $this->db->query("SELECT * FROM app_products where id = '{$row['product_id']}'")->row_array();
	// 				$orderDet['vendor_id'] = $product['vendor_id'];
	// 				$orderDet['user_id'] = $this->session->userdata('user_id');
	// 				$orderDet['order_id'] = $orderid;
	// 				$orderDet['product_id'] = $row['product_id'];
	// 				$orderDet['variant'] = $row['variant'];
	// 				$orderDet['sku'] = $row['sku'];
	// 				$orderDet['qty'] = $row['qty'];
	// 				$orderDet['price'] = $row['price'];
	// 				$orderDet['total_amount'] = $row['total_amount'];
	// 				$orderDet['vat'] = $row['total_amount'] * 0.20;
	// 				$orderDet['shipping_cost'] = $shipping_cost/count($cart);
	// 				$orderDet['status'] = 0;
	// 				$this->db->insert('app_order_details', $orderDet);
					
	// 			}
				
				
	// 			if($this->input->post('payment_type') == 2 || $this->input->post('payment_type') == 3){
	// 				$payment = array();
	// 				$payment['user_id'] = $user_id;
	// 				$payment['order_id'] = $orderid;
	// 				$payment['method'] = $this->input->post('payment_type');
	// 				$payment['trx_id'] = $transection_id;
	// 				$payment['amount'] = $grand_total;
	// 				$payment['datetime'] = date('Y-m-d H:i:s');
	// 				$this->db->insert('app_payments', $payment);
	// 			}
				
				
	// 			$this->db->query("UPDATE app_users SET balance = '$balance' WHERE id = '$user_id'");
				
	// 			$year = date('y');
	// 			$user_id = $this->session->userdata('user_id');
	// 			$this->db->query("DELETE FROM app_cart where user_id = '$user_id'");
				
				
				
	// 			// $this->Base_model->sendSMS("BEATERS", "03058501234", "You have received new order. Order No.".$year.$orderid.". Check it out in Admin Panel Thanks");
	// 			$this->session->set_userdata(array('flash_message'=>'<div class="alert alert-success alert-inline show-code-action">Thank you for shopping with Martola Ltd. Your Order No. '.$year.$orderid.' is now being processed.</div>'));
	// 			$res['status'] = 'success';
	// 			$res['msg'] = "Order Completed";
	// 			echo json_encode($res);
	// 			exit;
			
	// 		//}
	//     }
	// }
	public function processorder()
	{
		if (!$this->input->post()) {
			show_error('Invalid request');
		}

		$isLoggedIn = $this->session->userdata('user_loggedin') ? true : false;
		$user_id    = $isLoggedIn ? (int)$this->session->userdata('user_id') : 0;

		// 1. Get cart (same source for guest and logged-in users)
		$cart = $this->get_cart_items();

		if (empty($cart)) {
			echo json_encode(['status' => 'error', 'msg' => 'Cart is empty']);
			exit;
		}

		// 2. Calculate totals server-side
		$totals = $this->calculate_cart_totals($cart);
		$subtotal = (float)$totals['subtotal'];
		$vat = (float)$totals['vat'];
		$shipping_cost = (float)$totals['shipping_cost'];
		$grand_total = (float)$totals['grand_total'];
		$expected_amount_pence = (int) round($grand_total * 100);

		// 3. Payment verification
		$payment_type    = (int)$this->input->post('payment_type');
		$transaction_id  = null;

		// 🔹 LOG: Order started
		order_log('ORDER_STARTED', [
			'user_type'      => $isLoggedIn ? 'user' : 'guest',
			'user_id'        => $user_id,
			'name'           => $this->input->post('full_name', true),
			'email'          => $this->input->post('email', true),
			'payment_method' => $payment_type,
			'products'       => $cart,
			'total_amount'   => $grand_total
		]);

		// Stripe Payment
		if ($payment_type === 2) {
			$stripe_intent_id = $this->input->post('stripe_intent_id');
			if (empty($stripe_intent_id)) {
				echo json_encode(['status' => 'error', 'msg' => 'Invalid Stripe Intent ID']);
				exit;
			}
			require_once FCPATH . 'vendor/autoload.php';
			\Stripe\Stripe::setApiKey($this->settings['stripe_sk']);
			try {
				$intent = \Stripe\PaymentIntent::retrieve($stripe_intent_id);
				if ($intent->status !== 'succeeded') {
					echo json_encode(['status' => 'error', 'msg' => "Payment not successful. Status: {$intent->status}"]);
					exit;
				}
				$paid_amount = isset($intent->amount_received) && $intent->amount_received > 0
					? (int)$intent->amount_received
					: (int)$intent->amount;
				if ($paid_amount !== $expected_amount_pence) {
					echo json_encode(['status' => 'error', 'msg' => 'Payment amount mismatch. Please try again.']);
					exit;
				}
				$transaction_id = $stripe_intent_id;
				order_log('STRIPE_SUCCESS', [
					'trx_id' => $transaction_id,
					'email'  => $this->input->post('email', true)
				]);
			} catch (Exception $e) {
				echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
				order_log('STRIPE_Fail', [
					'error' => $e->getMessage(),
				]);
				exit;
			}
		}

		// PayPal Payment
		if ($payment_type === 3) {
			$paypal_trx_id = $this->input->post('paypal_trx_id');
			if (empty($paypal_trx_id)) {
				echo json_encode(['status' => 'error', 'msg' => 'Invalid PayPal Transaction ID']);
				exit;
			}

			// PayPal OAuth
			$curl = curl_init();
			curl_setopt_array($curl, [
				CURLOPT_URL            => 'https://api-m.paypal.com/v1/oauth2/token',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST           => true,
				CURLOPT_POSTFIELDS     => 'grant_type=client_credentials',
				CURLOPT_HTTPHEADER     => [
					'Authorization: Basic QWFSVjhJeTVnRmdvbG5zZ3dkRmF2TW9ick5CV0s4U0pWSEVwZU4yMDRNakJxR2dpaWIzZl91RFVHLWhENXJDYzZza1NVcHZJQ181Wm9pa2I6RUtqNFdwaVhuYWRqblZrM05fVERGUGRIZmpFbWlYdjRIbmM1cnhBb2RGOHdnT2NFYmFId2M3eGlXZzc0d25zeUVPODh0YlZIYUUtc1ppbXM=',
					'Content-Type: application/x-www-form-urlencoded'
				],
			]);
			$response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($response, true);
			if (!isset($response['access_token'])) {
				echo json_encode(['status' => 'error', 'msg' => 'Cannot verify PayPal payment']);
				exit;
			}
			$access_token = $response['access_token'];

			// Verify order
			$curl1 = curl_init();
			curl_setopt_array($curl1, [
				CURLOPT_URL            => 'https://api.paypal.com/v2/checkout/orders/' . $paypal_trx_id,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTPGET        => true,
				CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $access_token]
			]);
			$responseOrder = curl_exec($curl1);
			curl_close($curl1);
			$responseOrder = json_decode($responseOrder, true);
			if (!isset($responseOrder['status']) || $responseOrder['status'] !== 'COMPLETED') {
				echo json_encode(['status' => 'error', 'msg' => 'PayPal payment not completed']);
				exit;
			}
			$paypal_paid = 0;
			if (isset($responseOrder['purchase_units'][0]['amount']['value'])) {
				$paypal_paid = (float)$responseOrder['purchase_units'][0]['amount']['value'];
			}
			if (abs($paypal_paid - $grand_total) > 0.01) {
				echo json_encode(['status' => 'error', 'msg' => 'PayPal amount mismatch. Please try again.']);
				exit;
			}
			$transaction_id = $paypal_trx_id;
		}

		// 4. Start DB transaction
		$this->db->trans_begin();

		// 5. Save billing address
		$billing = [
			'user_id'   => $user_id,
			'type'      => 1,
			'full_name' => $this->input->post('full_name', true),
			'city'      => $this->input->post('city', true),
			'country'   => $this->input->post('country', true),
			'address'   => $this->input->post('address', true),
			'street'    => $this->input->post('street', true),
			'zipcode'   => $this->input->post('zipcode', true),
			'phone'     => $this->input->post('phone', true),
			'email'     => $this->input->post('email', true),
		];
		$this->db->insert('app_address', $billing);
		$billing_address = $this->db->insert_id();

		// 6. Create order
		$order = [
			'user_id'          => $user_id ?? 0,
			'guest_user'       => $isLoggedIn ? 0 : 1,
			'billing_address'  => $billing_address,
			'shipping_address' => $billing_address,
			'payment_method'   => $payment_type,
			'total_amount'     => $grand_total,
			'vat'              => $vat,
			'shipping_cost'    => $shipping_cost,
			'created_date'     => date('Y-m-d H:i:s'),
			'order_notes'      => $this->input->post('order_notes', true),
		];
		$this->db->insert('app_orders', $order);
		$order_id = $this->db->insert_id();

		 // 🔹 LOG: Order created
		order_log('ORDER_CREATED', [
			'order_id' => $order_id,
			'email'    => $this->input->post('email', true),
			'amount'   => $grand_total
		]);

		// 7. Insert order details
		foreach ($cart as $item) {
			$product = $this->db->where('id', $item['product_id'])->get('app_products')->row_array();
			$item_total = (float)$item['qty'] * (float)$item['price'];
			$item_vat = $item_total * 0.20;
			$this->db->insert('app_order_details', [
				'order_id'      => $order_id,
				'vendor_id'     => $product['vendor_id'],
				'product_id'    => $item['product_id'],
				'sku'           => $item['sku'],
				'variant'       => $item['variant'] ?? null,
				'qty'           => $item['qty'],
				'price'         => $item['price'],
				'total_amount'  => $item_total,
				'vat'           => $item_vat,
				'shipping_cost' => 0,
				'status'        => 0
			]);
		}

		// 8. Record payment if online
		if (in_array($payment_type, [2, 3])) {
			$this->db->insert('app_payments', [
				'user_id'  => $user_id ?? 0,
				'order_id' => $order_id,
				'method'   => $payment_type,
				'trx_id'   => $transaction_id,
				'amount'   => $grand_total,
				'datetime' => date('Y-m-d H:i:s')
			]);
		}

		// 9. Clear cart
		if ($isLoggedIn) {
			$this->db->where('user_id', $user_id)->delete('app_cart');
		} else {
			$session_id = isset($_COOKIE['session_id']) ? $_COOKIE['session_id'] : '';
			if (!empty($session_id)) {
				$this->db->where('session_id', $session_id)->delete('app_cart');
			}
			$this->session->unset_userdata('guest_cart');
		}

		// 10. Commit or rollback
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();

			 order_log('ORDER_DB_FAILED', [
				'order_id' => $order_id ?? null,
				'email'    => $this->input->post('email', true)
			]);
			echo json_encode(['status' => 'error', 'msg' => 'Order failed']);
			exit;
		}
		$this->db->trans_commit();

		// 🔹 LOG: Order completed
		order_log('ORDER_COMPLETED', [
			'order_id' => $order_id,
			'email'    => $this->input->post('email', true)
		]);
		$year = date('y');
		$this->session->set_flashdata(
			'flash_message',
			"Thank you for shopping. Your Order No. {$year}{$order_id} is being processed."
		);

		echo json_encode(['status' => 'success', 'order_id' => $order_id]);
		exit;
	}


	public function create_payment_intent()
	{
		require_once FCPATH . 'vendor/autoload.php'; // ✅ load composer stripe
		$cart = $this->get_cart_items();
		if (empty($cart)) {
			echo json_encode(['error' => 'Cart is empty']);
			return;
		}
		$totals = $this->calculate_cart_totals($cart);
		$grand_total = (float)$totals['grand_total'];
		
		\Stripe\Stripe::setApiKey($this->settings['stripe_sk']);
		try {
			$amount = round($grand_total * 100);
			$currency = "gbp";

			$intent = \Stripe\PaymentIntent::create([
				'amount' => $amount,
				'currency' => $currency,
				'automatic_payment_methods' => ['enabled' => true],
			]);

			echo json_encode(['clientSecret' => $intent->client_secret]);

		} catch (Exception $e) {
			echo json_encode(['error' => $e->getMessage()]);
		}	
	}
	
	public function stripe_card()
	{
		if(!isset($_SERVER['HTTP_REFERER'])){
		    exit;
		}
		
		$data['settings'] = $this->settings;

        $this->load->view('frontend/stripe_card', $data);
        // $this->load->view('web/stripe_card', $data);
	}
	
	
}
