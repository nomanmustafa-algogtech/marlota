<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends My_controller {
    function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
        $this->load->helper('cookie');
        $this->Base_model->visitor_logs();
        
        
         
    }
    
    function flash_message(){
        $flash_message = '';
        if($this->session->userdata('flash_message')) {
		   $flash_message = $this->session->userdata('flash_message');
		   $this->session->unset_userdata('flash_message');
		}
		return $flash_message;
    }


    // public function testMail(){
    //     echo $this->Base_model->sendEmail("alisoftware66@gmail.com", 'Email Verification - '.$this->settings['site_title'], "Test Code");
    // }
	
	public function index()
	{
		if(!isset($_SERVER['HTTP_REFERER'])){
		    exit;
		}
		
		$data['settings'] = $this->settings;

        $this->load->view('frontend/auth', $data);
        // $this->load->view('web/auth', $data);
	}
	


    public function sendpassword(){
        if($this->input->post()){
            $email = $this->input->post('email');
            // $phone = $this->input->post('phone');
            
            // if(!preg_match($this->settings['mobile_pattern'], $phone)){
            //     echo "Please input correct mobile number.";
            //     exit;
            // }
            
            // $phone = $this->Base_model->formatNumber($phone);
            
            $check_user = $this->db->query("SELECT * FROM app_users where email = '$email'");
            if($check_user->num_rows() == 0){
                echo "No registered user found with this email.";
                exit;
            }
            
            
            $newpassword = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    		$message = $this->load->view('email_templates/forgot_password',array('code'=>$newpassword),true);
	        $this->Base_model->sendEmail($email, 'Reset Password - '.$this->settings['site_title'], $message);
            
            
            $password_hash = md5($newpassword);
            
            $this->db->query("update app_users set password = '$password_hash' where email = '$email'");
            echo "SUCCESS";
        }
    }
	
	
	
	
	
	
	
// 	public function register(){
// 	   // exit;
// 	    if($this->input->post()){
// 	        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
//     		$this->form_validation->set_rules('email', 'Email', 'required');
//     		$this->form_validation->set_rules('password', 'Password', 'required');
//     		$this->form_validation->set_rules('phone', 'Phone', 'required');
//     		$this->form_validation->set_rules('country', 'Country', 'required');
    		
//     		if($this->form_validation->run() == FALSE){
//     		    echo validation_errors();
//     		    exit;
//     		}
    		
    		
    		
//     		$full_name = $this->input->post('full_name');
//     		$email = $this->input->post('email');
//     		$password = $this->input->post('password');
//     		$phone = $this->input->post('phone');
//     		$country = $this->input->post('country');
    		
    		
//     		  //echo "Full Name: $full_name, Email: $email, Password: $password, Phone: $phone, Country: $country";

    		
    		
//     		$now = date('Y-m-d H:i:s');
//     // 		if(!preg_match($this->settings['mobile_pattern'], $phone)){
//     //             echo "Please input correct mobile number.";
//     //             exit;
//     //         }
            
//     //         $phone = $this->Base_model->formatNumber($phone);
    		
//     		$check_email = $this->db->query("SELECT * FROM app_users where email = '$email'")->num_rows();
//     		if($check_email > 0){
//     		    echo "You are already using this email in another account.";
//     		    exit;
//     		}
    		
//     // 		$check_phone = $this->db->query("SELECT * FROM app_users where phone = '$phone'")->num_rows();
//     // 		if($check_phone > 0){
//     // 		    echo "You are already using this phone no in another account.";
//     // 		    exit;
//     // 		}
    		
//     		if($this->settings['mlm_system']==1){
//     		    if(!empty($this->input->post('referral'))){
//     		        $referral = $this->input->post('referral');
//     		    }else{
//     		        $referral = "beaterspk";
//     		        $_POST['referral'] = $referral;
//     		    }
//         		$check_rcode = $this->db->query("SELECT * FROM app_users where referral_code = '$referral'")->num_rows();
//         		if($check_rcode == 0){
//         		    echo "Your referral code is invalid.";
//         		    exit;
//         		}
//     		}
    		
    		
    	
//     		$emailcode = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
//     		$message = $this->load->view('email_templates/email_verification',array('email_verification'=>$emailcode),true);
// 	        $this->Base_model->sendEmail($email, 'Email Verification - '.$this->settings['site_title'], $message);
    		
    		
//     // 		$_POST['phonecode'] = $phonecode;
//     		$_POST['emailcode'] = $emailcode;
//     		$this->session->set_userdata($_POST);
//     // 		$data['full_name'] = $full_name;
//     // 		$data['email'] = $email;
//     // 		$data['password'] = md5("dchannel_by_alisofttech".$password);
//     // 		$data['phone'] = $phone;
//     // 		$data['city'] = $city;
//     // 		$data['email_verification'] = $this->Base_model->randomString(64);
//     // 		$data['referral_code'] = $this->Base_model->randomString(8);
//     // 		$data['login_secret'] = $this->Base_model->randomString(64);
//     // 		$data['created_date'] = $now;
//     // 		$this->db->insert('app_users', $data);
//     // 		$user_id = $this->db->insert_id();
    		
    		
    		
//     // 		if($this->settings['mlm_system']==1){
//     // 		    $ruser = $this->db->query("SELECT * FROM app_users where referral_code = '$referral'")->row_array();
//     // 		    $this->db->query("INSERT INTO app_referrals SET user_id = '{$ruser['id']}', referral_id = '$user_id', level = '1', created_date = '$now'");
    		    
//     // 		    $level_2 = $this->db->query("SELECT * FROM app_referrals where referral_id = '{$ruser['id']}' && level = 1");
//     // 		    if($level_2->num_rows() > 0){
//     // 		        $level_2 = $level_2->row_array();
//     // 		        $this->db->query("INSERT INTO app_referrals SET user_id = '{$level_2['user_id']}', referral_id = '$user_id', level = '2', created_date = '$now'");
//     // 		        $level_3 = $this->db->query("SELECT * FROM app_referrals where referral_id = '{$level_2['user_id']}' && level = 1");
//     // 		        if($level_3->num_rows() > 0){
//     // 		            $level_3 = $level_3->row_array();
//     // 		            $this->db->query("INSERT INTO app_referrals SET user_id = '{$level_3['user_id']}', referral_id = '$user_id', level = '3', created_date = '$now'");
//     // 		        }
//     // 		    }
    		    
//     // 		}
    		
    		
    		
    		
//     // 		$this->session->set_userdata(array('user_id'=>$user_id, 'user_loggedin'=>true, 'login_secret'=>$data['login_secret']));
//     		echo "SUCCESS";
    		
    		
// 	    }
// 	}
	
	public function register(){
    if($this->input->post()){
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
            exit;
        }
        
        $full_name = $this->input->post('full_name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $country = $this->input->post('country');
        
        // Check if email already exists
        $check_email = $this->db->query("SELECT * FROM app_users where email = '$email'")->num_rows();
        if($check_email > 0){
            echo "You are already using this email in another account.";
            exit;
        }
        
        // Check referral code if MLM system is enabled
        if($this->settings['mlm_system']==1){
            if(!empty($this->input->post('referral'))){
                $referral = $this->input->post('referral');
            } else {
                $referral = "beaterspk";
                $_POST['referral'] = $referral;
            }
            $check_rcode = $this->db->query("SELECT * FROM app_users where referral_code = '$referral'")->num_rows();
            if($check_rcode == 0){
                echo "Your referral code is invalid.";
                exit;
            }
        }
        
        // Insert user data into database
        $now = date('Y-m-d H:i:s');
        $data['full_name'] = $full_name;
        $data['email'] = $email;
        $data['password'] = md5($password);
        $data['phone'] = $phone;
        $data['city'] = '';
        $data['country'] = $country;
        $data['email_verification'] = 0; // Assuming email verification is not required initially
        $data['referral_code'] = $this->Base_model->randomString(8);
        $data['login_secret'] = $this->Base_model->randomString(64);
        $data['created_date'] = $now;
        $data['balance'] = 0;
        
        $this->db->insert('app_users', $data);
        $user_id = $this->db->insert_id();
        
        // Perform MLM related operations if enabled
        
        // Set session data or perform any other necessary actions
        
        // Respond with success message
        echo "SUCCESS";
      
    }
}

	
	public function verify_otp(){
	    $email_otp = trim($this->input->post('email_otp'));
	   // $phone_otp = trim($this->input->post('phone_otp'));
	    
	    if($this->session->userdata('emailcode') != $email_otp){
	        echo "Your Email Verification code is Incorrect.";
	        exit;
	    }
	    
	   // if($this->session->userdata('phonecode') != $phone_otp){
	   //     echo "Your Phone Verification code is Incorrect.";
	   //     exit;
	   // }
	    
	    $_POST = $_SESSION;
	    $full_name = $this->input->post('full_name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$phone = $this->input->post('phone');
		$country = $this->input->post('country');
		$now = date('Y-m-d H:i:s');
		
		if($this->settings['mlm_system']==1){
    		    $referral = $this->input->post('referral');
		}
		
// 		$phone = $this->Base_model->formatNumber($phone);
		
		$data['full_name'] = $full_name;
		$data['email'] = $email;
		$data['password'] = md5($password);
		$data['phone'] = $phone;
		$data['city'] = '';
		$data['country'] = $country;
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
		
		$this->session->unset_userdata('full_name','email', 'password', 'phone', 'city', 'referral');
    		
    		
    		
		$ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
        $now = date('Y-m-d H:i:s');
        
        $this->db->query("UPDATE app_users SET last_login = '$now', last_ip = '$ip' where id = '$user_id'");
        
        if(isset($_COOKIE["session_id"])) {
            $this->db->query("UPDATE app_cart SET session_id = '0', user_id = '$user_id' WHERE session_id = '{$_COOKIE['session_id']}'");
        }
    		
    	$this->session->set_userdata(array('user_id'=>$user_id, 'user_loggedin'=>true, 'login_secret'=>$data['login_secret']));
    	echo "SUCCESS";
	}
	
	public function login(){
	    $username = $this->input->post('username');
	    $orignalpass = $this->input->post('password');
	    
	    $password = md5($this->input->post('password'));
	   // $username = $this->Base_model->formatNumber($username);
	    
	    $check_user = $this->db->query("SELECT * FROM app_users WHERE email = '$username' && password = '$password'");
	    if($check_user->num_rows() > 0){
	        $user = $check_user->row_array();
	       // if($user['email_verification']!='0'){
	       //     echo "Please verify your email before login.";
	       //     exit;
	       // }
	        
	        $ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
	        $now = date('Y-m-d H:i:s');
	        
	        $this->db->query("UPDATE app_users SET last_login = '$now', last_ip = '$ip' where id = '{$user['id']}'");
	        $this->session->set_userdata(array('user_id'=>$user['id'], 'user_loggedin'=>true, 'login_secret'=>$user['login_secret']));
	        if(isset($_COOKIE["session_id"])) {
	            $this->db->query("UPDATE app_cart SET session_id = '0', user_id = '{$user['id']}' WHERE session_id = '{$_COOKIE['session_id']}'");
	        }
	        
	        if (!preg_match("/[\p{L}]/u",$orignalpass)) {
                    $this->session->set_userdata(array('passchange'=>true));
            }
            
	        if($this->input->post('remember')){
	            $cookieData= array(
                   'name'   => 'remember_me',
                   'value'  => json_encode(array('user_id'=>$user['id'], 'login_secret'=>$user['login_secret'])),                            
                   'expire' =>  (86400 * 30 * 30 * 12),                                                                                   
                   'secure' => TRUE
               );
               $this->input->set_cookie($cookieData);
	        }
    		echo "SUCCESS";
	    }else{
	        echo "Please input correct login credentials.";
	        exit;
	    }
	    
	}
	
}
