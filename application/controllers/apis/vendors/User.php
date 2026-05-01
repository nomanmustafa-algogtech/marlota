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
                $email = $this->post('email');
    			$phone = $this->post('phone');
                
                $vendor = $this->db->query("SELECT * FROM app_vendors where email = '$email' AND phone = '$phone' AND deleted = '0'");
                $error = '';
                if($vendor->num_rows() > 0){
                    $newpassword = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
            
                    $password_hash = md5("dchannel_by_alisofttech".$newpassword);
                    
                    $sms = "Your new store login password is : ".$newpassword;
                    $this->Base_model->sendSMS("8584", $phone, $sms);
                    
                    $this->db->query("update app_vendors set password = '$password_hash' where email = '$email' AND phone = '$phone'");
                }else{
                   $error = "This email or phone no has not been registered."; 
                }
                
                if ($error != '') {
    		        $msg = $error;
    				
            		$status = REST_Controller::HTTP_BAD_REQUEST;
                    // Prepare the response
                    $response = ['status' => $status, 'msg' => $msg];
                    $this->set_response($response, $status);
                    return;
                } else {
    		        $msg = 'Your password has been sent to registered phone no.';
    				
            		$status = REST_Controller::HTTP_OK;
                    // Prepare the response
                    $response = ['status' => $status, 'msg' => $msg];
                    $this->set_response($response, $status);
                    return;
                }
            
        }
    }
    
    
    public function login_post(){
	    $email = $this->post('email');
	    $orignalpass = $this->post('password');
	    
	    $password = md5("dchannel_by_alisofttech".$this->post('password'));
	    
	    $vendor = $this->db->query("SELECT * FROM app_vendors where email = '$email' AND password = '$password' AND deleted = '0'");
                
        if($vendor->num_rows() > 0){
            $vendor = $vendor->row_array();
            if($vendor['approved'] == 1){
                $msg = 'You have been logged in to your account';
    			
    			$vendor['timestamp'] = now();
    		    $token = AUTHORIZATION::generateToken($vendor);
        		$status = REST_Controller::HTTP_OK;
                // Prepare the response
                $response = ['status' => $status, 'msg' => $msg, 'token' => $token, 'user'=>$vendor];
                $this->set_response($response, $status);
                return;
            }else{
                $msg = 'Your account is not approved yet from approval authority.';
    				
        		$status = REST_Controller::HTTP_BAD_REQUEST;
                // Prepare the response
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
            }
        }else{
            $msg = 'Your email or password is incorrect';
    				
    		$status = REST_Controller::HTTP_BAD_REQUEST;
            // Prepare the response
            $response = ['status' => $status, 'msg' => $msg];
            $this->set_response($response, $status);
            return;
        }
	    
	}
    
    public function register_post(){
        $data = array();
	    
	    if($this->post()){
    		
    		
    		$store_name = $this->post("store_name");
            $owner_name = $this->post("owner_name");
            $store_type = $this->post("store_type");
            $email = $this->post("email");
            $password = $this->post("password");
            $phone = $this->post("phone");
            $city = $this->post("city");
            $address = $this->post("address");
            
            if(!preg_match($this->settings['mobile_pattern'], $phone)){
        	    $msg = 'Please input correct mobile number.';
    				
        		$status = REST_Controller::HTTP_BAD_REQUEST;
                // Prepare the response
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
            }
            
            $phone = $this->Base_model->formatNumber($phone);
            
           
    		
    		
    		$check_email = $this->db->query("SELECT * FROM app_vendors where email = '$email'")->num_rows();
    		if($check_email > 0){
        	    $msg = 'You are already using this email in another seller account.';
    				
        		$status = REST_Controller::HTTP_BAD_REQUEST;
                // Prepare the response
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
    		}
    		
    		$check_phone = $this->db->query("SELECT * FROM app_vendors where phone = '$phone'")->num_rows();
    		if($check_phone > 0){
        	    $msg = 'You are already using this phone no in another seller account.';
    				
        		$status = REST_Controller::HTTP_BAD_REQUEST;
                // Prepare the response
                $response = ['status' => $status, 'msg' => $msg];
                $this->set_response($response, $status);
                return;
    		}
            $now = date('Y-m-d H:i:s');
            
            $data['store_name'] = $store_name;
    		$data['owner_name'] = $owner_name;
    		$data['email'] = $email;
    		$data['password'] = md5("dchannel_by_alisofttech".$password);
    		$data['phone'] = $phone;
    		$data['city'] = $city;
    		$data['store_type'] = $store_type;
    		$data['address'] = $address;
    		$data['created_date'] = $now;
    		$this->db->insert('app_vendors', $data);
    		
    		$msg = 'Your request for new store has been sent to approval authority.';
    				
    		$status = REST_Controller::HTTP_OK;
            // Prepare the response
            $response = ['status' => $status, 'msg' => $msg];
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
                $user_query = $this->db->query("SELECT * FROM app_vendors WHERE id = '$user_id'");
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
    
    public function getAreasByCity_post(){
	    $city_id = $this->input->post('city_id');
	    $areas = $this->db->query("SELECT * FROM app_areas where status = '1' && city_id = '$city_id' Order by name asc")->result_array();
	    $msg = 'Data Returned.';
        				
		$status = REST_Controller::HTTP_OK;
        // Prepare the response
        $response = ['status' => $status, 'msg' => $msg, 'data' => $areas];
        $this->set_response($response, $status);
        return;
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
                
                $user=$this->db->query("SELECT * FROM app_vendors where id='$user_id'")->row_array();
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
                
                $this->db->query("UPDATE app_vendors SET password = '$new_password' where id='$user_id'");
                
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
	
	public function getDashboardData_get(){
	    
	    $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                
                $data['new_orders'] = $this->db->query("SELECT * FROM app_order_details a, app_orders b WHERE b.id = a.order_id && b.status = 0 && a.vendor_id = '$user_id' GROUP BY order_id;")->num_rows();
                $data['processed_orders'] = $this->db->query("SELECT * FROM app_order_details a, app_orders b WHERE b.id = a.order_id && b.status = 1 && a.vendor_id = '$user_id' GROUP BY order_id;")->num_rows();
                $data['out_for_delivery'] = $this->db->query("SELECT * FROM app_order_details a, app_orders b WHERE b.id = a.order_id && b.status = 2 && a.vendor_id = '$user_id' GROUP BY order_id;")->num_rows();
                $data['sale'] = $this->db->query("SELECT IFNULL(SUM(a.total_amount), 0) as total  FROM app_order_details a, app_orders b WHERE b.id = a.order_id && a.status = 100 && a.vendor_id = '$user_id' && YEAR(b.created_date) = YEAR(CURRENT_DATE()) AND MONTH(b.created_date) = MONTH(CURRENT_DATE())")->row()->total;
                
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
	
	public function getOrders_get(){
	    
	    $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                
                $data = array();
	    
        	    $orders = $this->db->query("SELECT a.*, b.name as product_name, b.thumbnail_img, o.created_date FROM app_order_details as a, app_products as b, app_orders o WHERE b.id = a.product_id && o.id = a.order_id && a.vendor_id = '$user_id' ORDER BY a.id DESC");
        	    
        	    
        	    if (isset($_GET['pageno'])  && !empty($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                
                $no_of_records_per_page = 10;
                
                $offset = ($pageno-1) * $no_of_records_per_page;
                
                
                $total_rows = $orders->num_rows();
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                
                $query = $this->db->last_query();
                
                $orders = $this->db->query($query." LIMIT $offset, $no_of_records_per_page")->result_array();
        	    
        	    foreach($orders as $k=>$order){
        	        $orders[$k]['id'] = date('y', strtotime($order['created_date'])).$order['id'];
        	        $orders[$k]['created_date'] = date('d/M y H:i', strtotime($order['created_date']));
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
    
    
}