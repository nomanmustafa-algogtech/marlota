<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller
{
    public function __construct(){

     parent::__construct();

     // Load model
     $this->load->model('Base_model');
     // $this->load->library('gcm');
     $this->settings = array();
     $settings = $this->db->select("*")->from('app_settings')->get()->result_array();
	    foreach($settings as $row){
	        $this->settings[$row['name']] = $row['value'];
	    }
     
    }
    public function sendpassword_post(){
        if($this->post()){
            $phone = $this->post('number');
            
            if(!preg_match($this->settings['mobile_pattern'], $phone)){
                $msg = 'Please input correct mobile number.';
    				
        		$status = REST_Controller::HTTP_BAD_REQUEST;
                // Prepare the response
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
            }
            
            $phone = $this->Base_model->formatNumber($phone);
            
            $check_user = $this->db->query("SELECT * FROM app_users where phone = '$phone'");
            if($check_user->num_rows() == 0){
                $msg = 'No registered user found with this phone.';
    				
        		$status = REST_Controller::HTTP_BAD_REQUEST;
                // Prepare the response
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
            }
            
            $getLastMsg = $this->db->query("SELECT * FROM app_messages_logs WHERE number = '$phone' && message LIKE '%login password%' ORDER BY id DESC LIMIT 0,1");
            
            if($getLastMsg->num_rows() > 0){
                $sentDate = strtotime($getLastMsg->row()->datetime);
                $now = strtotime(date('Y-m-d H:i:s'));
                 
                  // Formulate the Difference between two dates
                $diff = abs($now - $sentDate);
                
                $hours = floor((($diff/60)/60));
                
                if($hours < 12){
                    $msg = "You have recently reset your password. You can perform this action again in ".(12-$hours)." Hours";
            		$status = REST_Controller::HTTP_BAD_REQUEST;
                    // Prepare the response
                    $response = ['status' => $status, 'msg' => $msg];
                    $this->set_response($response, $status);
                    return;
                }
                
                
            }
            
            $newpassword = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
            
            $password_hash = md5("dchannel_by_alisofttech".$newpassword);
            
            $sms = "Your new login password is : ".$newpassword;
            $this->Base_model->sendSMS("8584", $phone, $sms);
            
            $this->db->query("update app_users set password = '$password_hash' where phone = '$phone'");
            
            $msg = 'Your new password has been sent to your registered mobile number';
    				
    		$status = REST_Controller::HTTP_OK;
            // Prepare the response
            $response = ['status' => $status, 'msg' => $msg];
            $this->set_response($response, $status);
            return;
        }
    }
    
    
    public function login_post(){
	    $username = $this->post('number');
	    $orignalpass = $this->post('password');
	    
	    $password = md5("dchannel_by_alisofttech".$this->post('password'));
	    $username = $this->Base_model->formatNumber($username);
	    
	    $check_user = $this->db->query("SELECT * FROM app_users WHERE phone = '$username' && password = '$password'");
	    if($check_user->num_rows() > 0){
	        $user = $check_user->row_array();
	        $ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
	        $now = date('Y-m-d H:i:s');
	        
	        $this->db->query("UPDATE app_users SET last_login = '$now', last_ip = '$ip' where id = '{$user['id']}'");
	        $user['timestamp'] = now();
    		$token = AUTHORIZATION::generateToken($user);
    		
    		if($this->post('device_id')) {
                $this->db->query("UPDATE app_cart SET session_id = '0', user_id = '{$user['id']}' WHERE session_id = '".$this->post('device_id')."'");
            }
        
            $msg = 'You have been logged in to your account';
    				
    		$status = REST_Controller::HTTP_OK;
            // Prepare the response
            $response = ['status' => $status, 'msg' => $msg, 'token' => $token, 'user'=>$user];
            $this->set_response($response, $status);
            return;
	    }else{
	        $msg = 'Your mobile number or password is incorrect';
    				
    		$status = REST_Controller::HTTP_BAD_REQUEST;
            // Prepare the response
            $response = ['status' => $status, 'msg' => $msg];
            $this->set_response($response, $status);
            return;
	    }
	    
	}
    
    
    public function verifyOtp_post(){
        $full_name = $this->post('fullname');
		$password = $this->post('password');
		$phone = $this->post('number');
		$city = $this->post('city');
		$otp = $this->post('otp');
		$user_otp = $this->post('user_otp');
		$user_otp = md5("dchannel_by_alisofttech".$user_otp);
		if($otp != $user_otp){
		    $status = REST_Controller::HTTP_BAD_REQUEST;
            $msg = 'Invalid OTP Code. Please enter correct one';
            
            $response = ['status' => $status, 'msg' => $msg];
            $this->set_response($response, $status);
            return;
		}
		
		$now = date('Y-m-d H:i:s');
		
		$phone = $this->Base_model->formatNumber($phone);
		
		if($this->post('referral_code') && !empty($this->post('referral_code'))){
	        $referral = $this->post('referral_code');
	    }else{
	        $referral = "beaterspk";
	    }
	    
		$data['full_name'] = $full_name;
		$data['email'] = '';
		$data['password'] = md5("dchannel_by_alisofttech".$password);
		$data['phone'] = $phone;
		$data['city'] = $city;
		$data['email_verification'] = 0;
		$data['referral_code'] = $this->Base_model->randomString(8);
		$data['login_secret'] = $this->Base_model->randomString(64);
		$data['created_date'] = $now;
		$data['balance'] = 0;
		$this->db->insert('app_users', $data);
		$user_id = $this->db->insert_id();
		
		if($this->settings['mlm_system']==1){
		    $ruser = $this->db->query("SELECT * FROM app_users where referral_code = '$referral'")->row_array();
		    $this->db->query("INSERT INTO app_referrals SET user_id = '{$ruser['id']}', referral_id = '$user_id', level = '1', created_date = '$now'");
		    
		    $level_2 = $this->db->query("SELECT * FROM app_referrals where referral_id = '{$ruser['id']}' && level = 1");
		    if($level_2->num_rows() > 0){
		        $level_2 = $level_2->row_array();
		        $this->db->query("INSERT INTO app_referrals SET user_id = '{$level_2['user_id']}', referral_id = '$user_id', level = '2', created_date = '$now'");
		        $level_3 = $this->db->query("SELECT * FROM app_referrals where referral_id = '{$level_2['user_id']}' && level = 1");
		        if($level_3->num_rows() > 0){
		            $level_3 = $level_3->row_array();
		            $this->db->query("INSERT INTO app_referrals SET user_id = '{$level_3['user_id']}', referral_id = '$user_id', level = '3', created_date = '$now'");
		        }
		    }
		    
		}
		
		$ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
        $now = date('Y-m-d H:i:s');
        $data['id'] = $user_id;
        $this->db->query("UPDATE app_users SET last_login = '$now', last_ip = '$ip' where id = '$user_id'");
        $data['timestamp'] = now();
        $token = AUTHORIZATION::generateToken($data);
        if($this->post('device_id')) {
            $this->db->query("UPDATE app_cart SET session_id = '0', user_id = '$user_id' WHERE session_id = '".$this->post('device_id')."'");
        }
        $msg = 'Congratulations your account has been created and verified sucessfully.';
				
		$status = REST_Controller::HTTP_OK;
        // Prepare the response
        $response = ['status' => $status, 'msg' => $msg, 'token' => $token, 'user'=>$data];
        $this->set_response($response, $status);
        return;
    }
   
    
    public function register_post(){
        $data = array();
	    
	    if($this->post()){
    		
    		
    		$full_name = $this->post('fullname');
    // 		$email = $this->post('email');
    		$password = $this->post('password');
    		$phone = $this->post('number');
    		$city = $this->post('city');
    		
    		$now = date('Y-m-d H:i:s');
    		if(!preg_match($this->settings['mobile_pattern'], $phone)){
                $status = REST_Controller::HTTP_BAD_REQUEST;
                $msg = 'Please input correct mobile number.';
                
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
            }
            
            $phone = $this->Base_model->formatNumber($phone);
    		
    // 		$check_email = $this->db->query("SELECT * FROM app_users where email = '$email'")->num_rows();
    // 		if($check_email > 0){
    // 		    echo "You are already using this email in another account.";
    // 		    exit;
    // 		}
    		
    		$check_phone = $this->db->query("SELECT * FROM app_users where phone = '$phone'")->num_rows();
    		if($check_phone > 0){
    		    $status = REST_Controller::HTTP_BAD_REQUEST;
                $msg = 'You are already using this phone no in another account.';
                
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
    		}
    		
    		if($this->settings['mlm_system']==1){
    		    if(!empty($this->post('referral_code'))){
    		        $referral = $this->post('referral_code');
    		    }else{
    		        $referral = "beaterspk";
    		    }
        		$check_rcode = $this->db->query("SELECT * FROM app_users where referral_code = '$referral'")->num_rows();
        		if($check_rcode == 0){
        		    $status = REST_Controller::HTTP_BAD_REQUEST;
                    $msg = 'Your referral code is invalid.';
                    
                    $response = ['status' => $status, 'msg' => $msg];
                    $this->set_response($response, $status);
                    return;
        		}
    		}
    		
    		
    		$phonecode = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    		$sms = "Verification Code: ".$phonecode." Do not share this code with anyone";
    		
    		
    		$this->Base_model->sendSMS("8584", $phone, $sms);
    		
    		$data['phonecode'] = md5("dchannel_by_alisofttech".$phonecode);

    		
    		
    		$msg = 'Verification code sent to your mobile number.';
				
    		$status = REST_Controller::HTTP_OK;
            // Prepare the response
            $response = ['status' => $status, 'msg' => $msg, 'data' => $data];
            $this->set_response($response, $status);
            return;
    		
    		
	    }
	    
        
        
    }
    
    public function getProfile_get()
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                $user = array();
                $user_query = $this->db->query("SELECT * FROM app_users WHERE id = '$user_id'");
                $row = $user_query->row();
                
                $user = json_decode(json_encode($row), true);
                $user['password'] = '';
                
				   
                $response = ['status' => REST_Controller::HTTP_OK, 'data' => $user];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    public function getShippingAddress_get(){
        
        
        
         $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                $shipping = $this->db->query("SELECT * FROM app_address where user_id = '$user_id' && type = '2' ORDER BY id DESC");
                $data['num_rows'] = $shipping->num_rows();
                $data['address'] = $shipping->row();
                $data['cities'] = $this->db->query("SELECT * FROM app_cities where status = '1' Order by name asc")->result_array();
                
                if($shipping->num_rows() > 0){
                    $city_id = $shipping->row()->city_id;
                    $data['areas'] = $this->db->query("SELECT * FROM app_areas where status = '1' && city_id = '$city_id' Order by name asc")->result_array();
                }
                
                $cartData = $this->db->select("*")->from("app_cart")->where(array('user_id'=>$user_id))->get()->result_array();
                $cartReturn=array();
                $total_amount = 0;
                foreach($cartData as $cart){
                    $cart['product_details'] = $this->db->query("SELECT * FROM app_products where id = '{$cart['product_id']}'")->row_array();
                    $cart['qty'] = (int) $cart['qty'];
                    $total_amount += (int) ($cart['qty']*$cart['price']);
                    $cartReturn[] = $cart;
                }
                $data['cart'] = $cartReturn;
                $data['total_amount'] = (int) $total_amount;
                
                $data['balance'] = (int) $this->db->select('*')->from('app_users')->where('id', $user_id)->get()->row()->balance;   
                
                $shipping_fee = $this->db->query("SELECT shipping_cost FROM app_cart WHERE user_id = '$user_id' ORDER BY shipping_cost DESC LIMIT 0,1");
                if($shipping_fee->num_rows() > 0){
                    $data['shipping_fee'] = (int) $shipping_fee->row()->shipping_cost;
                }else{
                    $data['shipping_fee'] = (int) 0;
                }
                $msg = 'Data Returned.';
        				
        		$status = REST_Controller::HTTP_OK;
                // Prepare the response
                $response = ['status' => $status, 'msg' => $msg, 'data' => $data];
                $this->set_response($response, $status);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
    }
    
    public function getAreasByCity_post(){
	    $city_id = $this->post('city_id');
	    $areas = $this->db->query("SELECT * FROM app_areas where status = '1' && city_id = '$city_id' Order by name asc")->result_array();
	    $msg = 'Data Returned.';
        				
		$status = REST_Controller::HTTP_OK;
        // Prepare the response
        $response = ['status' => $status, 'msg' => $msg, 'data' => $areas];
        $this->set_response($response, $status);
        return;
	}
	
	public function placeOrder_post(){
	    
	    $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                $user = $this->db->select('*')->from('app_users')->where('id', $user_id)->get()->row_array();  
                $cart = $this->db->query("SELECT * FROM app_cart WHERE user_id = '$user_id'");
	            if($cart->num_rows() > 0){
        	        $billing['user_id'] = $user_id;
        	        $billing['type'] = 1;
        	        $billing['full_name'] = $this->post('full_name');
        	        $billing['city_id'] = $this->post('city_id');
        	        $billing['area_id'] = $this->post('area_id');
        	        $billing['address'] = $this->post('address');
        	        $billing['street'] = $this->post('street');
        	        $billing['zipcode'] = '';
        	        $billing['plus_code'] = $this->post('plus_code');
        	        $billing['phone'] = $this->post('phone');
        	        $billing['email'] = $this->post('email');
        	        
        	        $this->db->insert('app_address', $billing);
        	        $billing_address = $this->db->insert_id();
        	        
        	        
        	       
    	            $billing['type'] = 2;
    	            $this->db->insert('app_address', $billing);
    	            $shipping_address = $this->db->insert_id();
        	        
        	        
        	        
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
        	        $order['user_id'] = $user_id;
        	        $order['order_notes'] = '';
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
        	            
        	            $orderDet['user_id'] = $user_id;
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
                    $this->db->query("DELETE FROM app_cart where user_id = '$user_id'");
                    
                    $user = $this->db->query("SELECT * FROM app_users WHERE id = '$user_id'")->row_array();
                    $sms = "Dear ".$user['full_name'].", Thank you for shopping with Beaters.pk. Your Order No. $year$orderid is now being processed.";
                    $this->Base_model->storeSMS("BEATERS", $user['phone'], $sms);
                    $this->Base_model->storeSMS("BEATERS", "03000022500", "You have received new order. Order No.".$year.$orderid.". Check it out in Admin Panel Thanks");
                    $this->Base_model->storeSMS("BEATERS", "03126935630", "You have received new order. Order No.".$year.$orderid.". Check it out in Admin Panel Thanks");
                    // $this->Base_model->storeSMS("BEATERS", "03058501234", "You have received new order. Order No.".$year.$orderid.". Check it out in Admin Panel Thanks");
                   
                    $msg = 'Thank you for shopping with Beaters.pk. Your Order No. '.$year.$orderid.' is now being processed.';
            				
            		$status = REST_Controller::HTTP_OK;
                    // Prepare the response
                    $response = ['status' => $status, 'msg' => $msg];
                    $this->set_response($response, $status);
                    return;
    	        
	         }
                
                
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token. Login Again"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
	        
	   return;
	        
	}
    
    public function getOrders_get(){
	    
	    $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                $data = array();
	    
        	    $this->db->select('*')->from('app_orders as o');
        	    $this->db->where('o.user_id', $user_id);
        	    $this->db->order_by("o.id", "desc");
        	    
        	    if (isset($_GET['pageno'])  && !empty($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                
                $no_of_records_per_page = 10;
                
                $offset = ($pageno-1) * $no_of_records_per_page;
                
                $orders = $this->db->get();
                $total_rows = $orders->num_rows();
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                
                $query = $this->db->last_query();
                
                $orders = $this->db->query($query." LIMIT $offset, $no_of_records_per_page")->result_array();
        	    
        	    foreach($orders as $k=>$order){
        	        $orders[$k]['id'] = date('y', strtotime($order['created_date'])).$order['id'];
        	        $orders[$k]['created_date'] = date('d/M y H:i', strtotime($order['created_date']));
        	        $orderdts = $this->db->query("SELECT a.*, b.name as product_name, b.thumbnail_img FROM app_order_details as a, app_products as b where a.order_id = '{$order['id']}' && b.id = a.product_id")->result_array();
        	       
        	       $orders[$k]['order_details']=$orderdts;
        	    }
        	   
        		
        		
        		$data['orders'] = $orders;
        		$data['offset'] = $offset;
        		$data['pageno'] = $pageno;
        		$data['per_page'] = $no_of_records_per_page;
        		$data['total_rows'] = $total_rows;
        		$data['total_pages'] = $total_pages;
                
                $status = REST_Controller::HTTP_OK;
                $msg = 'Data Returned';
                
                $response = ['status' => $status, 'msg' => $msg, 'data'=>$data];
                $this->set_response($response, $status);
                return;
                
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
	        
	        
	        
	}
	
	public function getReferrals_get(){
	    
	    $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                
                $app_referrals = $this->db->query("SELECT * FROM app_referrals WHERE user_id = '$user_id'")->result_array();
                foreach($app_referrals as $key=>$row){
                    $app_referrals[$key]['user'] = $this->db->query("SELECT * FROM app_users where id = '{$row['referral_id']}'")->row_array();
                }
                
                $data=array();
                $data['referrals'] = $app_referrals;
                $data['referral_code'] = $this->db->query("SELECT * FROM app_users WHERE id = '$user_id'")->row()->referral_code;
                $data['cashback'] = $this->db->query("SELECT * FROM app_users where id = '$user_id'")->row()->balance;
                $status = REST_Controller::HTTP_OK;
                $msg = 'Data Returned';
                
                $response = ['status' => $status, 'msg' => $msg, 'data'=>$data];
                $this->set_response($response, $status);
                return;
                
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
	        
	        
	        
	}
	
	public function reOrder_post(){
	    
	    $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                $orderdt_id = $this->post('id');
                $oldorderdtl = $this->db->query("SELECT * FROM app_order_details WHERE id = '$orderdt_id'")->row_array();
                
                
                $dataInsert['user_id'] = $user_id;
                $dataInsert['session_id'] = 0;
                $dataInsert['product_id'] = $oldorderdtl['product_id'];
                $dataInsert['qty'] = $oldorderdtl['qty'];
                $dataInsert['created_date'] = date('Y-m-d H:i:s');
                
                $product  = $this->db->query("SELECT * FROM app_products WHERE id = '{$dataInsert['product_id']}'")->row_array();
                $product_stock  = $this->db->query("SELECT * FROM app_product_stocks WHERE sku = '{$oldorderdtl['sku']}' && product_id = '{$dataInsert['product_id']}' LIMIT 0,1")->row_array();
                
                $dataInsert['shipping_cost'] = $product['shipping_cost'];
                
                $dataInsert['sku'] = $oldorderdtl['sku'];
		        $dataInsert['variant'] = $oldorderdtl['variant'];
		        if($product_stock['discount'] > 0){
		            $dataInsert['price'] = $product_stock['discount'];
		            $dataInsert['total_amount'] = $dataInsert['qty']*$product_stock['discount'];
		        }else{
		            $dataInsert['price'] = $product_stock['price'];
		            $dataInsert['total_amount'] = $dataInsert['qty']*$product_stock['price'];
		        }
		      
		        
		        $wherecondition = "WHERE user_id='$user_id' ";
		        $checkcart = $this->db->query("SELECT * FROM app_cart $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
                if($checkcart->num_rows() > 0){
                    $this->db->query("UPDATE app_cart SET qty = qty + '{$dataInsert['qty']}', total_amount = total_amount + '{$dataInsert['total_amount']}' $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
                }else{
                    $this->db->insert('app_cart', $dataInsert);
                }
                
                                
                   
        	        
    	           
                $msg = 'Product has been added to you cart. Review Details and quantity on cart page to complate order.';
        				
        		$status = REST_Controller::HTTP_OK;
                // Prepare the response
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
                
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
	        
	        
	        
	}
	
	public function changePassword_post(){
	    
	    $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                $old_password = md5("dchannel_by_alisofttech".$this->post('old_password'));
                $new_password = md5("dchannel_by_alisofttech".$this->post('new_password'));
                $confirm_password = md5("dchannel_by_alisofttech".$this->post('confirm_password'));
                
                $user=$this->db->query("SELECT * FROM app_users where id='$user_id'")->row_array();
                if($user['password']!=$old_password){
                    $status = REST_Controller::HTTP_BAD_REQUEST;
                    $msg = 'Your old password is incorrect.';
                    
                    $response = ['status' => $status, 'msg' => $msg];
                    $this->set_response($response, $status);
                    return;
                }
                
                if($new_password!=$confirm_password){
                    $status = REST_Controller::HTTP_BAD_REQUEST;
                    $msg = 'Your confirm password does not equal to new password.';
                    
                    $response = ['status' => $status, 'msg' => $msg];
                    $this->set_response($response, $status);
                    return;
                }
                
                $this->db->query("UPDATE app_users SET password = '$new_password' where id='$user_id'");
                
                $status = REST_Controller::HTTP_OK;
                $msg = 'Your password changed successfully.';
                
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
                
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
	        
	        
	        
	}
    
    
}