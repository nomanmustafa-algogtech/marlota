<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_controller {
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

	
	public function index()
	{
		if(!isset($_SERVER['HTTP_REFERER'])){
		    exit;
		}
	}
	
	public function register()
	{
		if($this->session->userdata('user_loggedin')){
            redirect(base_url());
            exit;
        }

		$this->title = "Register || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
	
        $this->load_web('register',$data);
	}
	
	public function login()
	{
		$this->title = "Login || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		);
	
        $this->load_web('auth',$data);
	}

	public function forgotpassword()
	{
		$this->title = "Forgot Password || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		);
	
        $this->load_web('forgotpassword',$data);
	}
	
// 	public function store_request()
// 	{
	    
	    
// 		if($this->session->userdata('seller_loggedin')){
//             redirect(base_url());
//             exit;
//         }
        
//         if($this->input->post()){
//             $store_name = $this->input->post("store_name");
//             $owner_name = $this->input->post("owner_name");
//             $store_type = $this->input->post("store_type");
//             $email = $this->input->post("email");
//             $password = $this->input->post("password");
//             $phone = $this->input->post("phone");
//             $city = $this->input->post("city");
//             $address = $this->input->post("address");
            
//             if(!preg_match($this->settings['mobile_pattern'], $phone)){
//                 $this->session->set_userdata(array('flash_message'=>'<div class="alert alert-error alert-inline show-code-action">Please input correct mobile number.</div>'));
//         	    redirect(base_url('user/store_request'));
//         	    exit;
//             }
            
//             $phone = $this->Base_model->formatNumber($phone);
            
           
    		
    		
//     		$check_email = $this->db->query("SELECT * FROM app_vendors where email = '$email'")->num_rows();
//     		if($check_email > 0){
//     		    $this->session->set_userdata(array('flash_message'=>'<div class="alert alert-error alert-inline show-code-action">You are already using this email in another seller account.</div>'));
//         	    redirect(base_url('user/store_request'));
//         	    exit;
//     		}
    		
//     		$check_phone = $this->db->query("SELECT * FROM app_vendors where phone = '$phone'")->num_rows();
//     		if($check_phone > 0){
//     		    $this->session->set_userdata(array('flash_message'=>'<div class="alert alert-error alert-inline show-code-action">You are already using this phone no in another seller account.</div>'));
//         	    redirect(base_url('user/store_request'));
//         	    exit;
//     		}
//             $now = date('Y-m-d H:i:s');
            
//             $data['store_name'] = $store_name;
//     		$data['owner_name'] = $owner_name;
//     		$data['email'] = $email;
//     		$data['password'] = md5("dchannel_by_alisofttech".$password);
//     		$data['phone'] = $phone;
//     		$data['city'] = $city;
//     		$data['store_type'] = $store_type;
//     		$data['address'] = $address;
//     		$data['created_date'] = $now;
//     		$this->db->insert('app_vendors', $data);
    		
//     		 $this->session->set_userdata(array('flash_message'=>'<div class="alert alert-success alert-inline show-code-action">Your request for new store has been sent to approval authority.</div>'));
//     	    redirect(base_url('user/store_request'));
//     	    exit;
//         }

// 		$this->title = "Create Vendor Account || ".$this->title;
		
// 		$data['view_scripts']=array();
// 		$data['view_css']=array(
// 		    $this->Gen->get_web_url('css/ecommerce_web.min.css')
// 		);
	
//         $this->load_web('store_request',$data);
// 	}
	
	// public function setnewpassword()
	// {
	// 	if(!$this->session->userdata('user_loggedin')){
    //         redirect(base_url());
    //         exit;
    //     }
        
    //     if(!$this->session->userdata('passchange')){
    //         redirect(base_url('user/account'));
    //         exit;
    //     }
        
    //     if($this->input->post()){
    //         $newpassword = md5("dchannel_by_alisofttech".$this->input->post("newpassword"));
    //         $confirmpassword = md5("dchannel_by_alisofttech".$this->input->post("confirmpassword"));
            
    //         if($newpassword != $confirmpassword){
    //             $this->session->set_userdata(array('flash_message'=>'<div class="alert alert-error alert-inline show-code-action">Your confirm password did not match.</div>'));
    // 	        redirect(base_url('user/setnewpassword'));
    // 	        exit;
    //         }
            
    //         $this->db->where('id', $this->session->userdata('user_id'));
    //         $this->db->update('app_users', array('password'=>$newpassword));
    //         $this->session->unset_userdata(array('passchange'));
            
    //         $this->session->set_userdata(array('flash_message'=>'<div class="alert alert-success alert-inline show-code-action">Your password has been changed.</div>'));
    // 	    redirect(base_url('user/account'));
    // 	    exit;
    //     }

	// 	$this->title = "New Password || ".$this->title;
		
	// 	$data['view_scripts']=array();
	// 	$data['view_css']=array(
	// 	    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
	// 	);
	
    //     $this->load_web('new-set-password',$data);
	// }

	public function setnewpassword()
	{
		if(!$this->session->userdata('user_loggedin')){
			if($this->input->is_ajax_request()){
				echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
				return;
			}
			redirect(base_url());
			exit;
		}

		if(!$this->session->userdata('passchange')){
			if($this->input->is_ajax_request()){
				echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
				return;
			}
			redirect(base_url('user/account'));
			exit;
		}

		if($this->input->post()){
			$newpassword = md5($this->input->post("newpassword"));
			$confirmpassword = md5($this->input->post("confirmpassword"));

			if($newpassword != $confirmpassword){
				if($this->input->is_ajax_request()){
					echo json_encode(['status' => 'error', 'message' => 'Confirm password does not match.']);
					return;
				}
				$this->session->set_userdata(['flash_message'=>'<div class="alert alert-error">Your confirm password did not match.</div>']);
				redirect(base_url('user/setnewpassword'));
				exit;
			}

			$this->db->where('id', $this->session->userdata('user_id'));
			$this->db->update('app_users', ['password'=>$newpassword]);
			$this->session->unset_userdata(['passchange']);

			if($this->input->is_ajax_request()){
				echo json_encode(['status' => 'success', 'message' => 'Your password has been changed.']);
				return;
			}

			$this->session->set_userdata(['flash_message'=>'<div class="alert alert-success">Your password has been changed.</div>']);
			redirect(base_url('user/account'));
			exit;
		}

		$this->title = "New Password || ".$this->title;
		$data['view_scripts'] = [];
		$data['view_css'] = [];
		$this->load_web('new-set-password',$data);
	}

	
	public function account()
	{
	    if(!$this->session->userdata('user_loggedin')){
            redirect(base_url());
            exit;
        }

        // if($this->session->userdata('passchange')){
        //     redirect(base_url('user/setnewpassword'));
        //     exit;
        // }
        
		$this->title = "My Account || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
		$user_id = $this->session->userdata('user_id');
	    $data['orders'] = $this->db->query("SELECT * FROM app_orders where user_id = '$user_id' order by id desc")->result_array();
	
        $this->load_web('account',$data);
	}
	
	public function orders()
	{
	    if(!$this->session->userdata('user_loggedin')){
            redirect(base_url());
            exit;
        }

		$this->title = "My Orders || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
	    $user_id = $this->session->userdata('user_id');
	    $data['orders'] = $this->db->query("SELECT * FROM app_orders where user_id = '$user_id' order by id desc")->result_array();
        $this->load_web('orders',$data);
	}
	
	public function orderstemp()
	{
	    if(!$this->session->userdata('user_loggedin')){
            redirect(base_url());
            exit;
        }

		$this->title = "My Orders || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
	    $user_id = $this->session->userdata('user_id');
	    $data['orders'] = $this->db->query("SELECT * FROM app_orders where user_id = '$user_id' order by id desc")->result_array();
        $this->load_web('orderstemp',$data);
	}
	public function order($id)
	{
	    if(!$this->session->userdata('user_loggedin')){
            redirect(base_url());
            exit;
        }
        $user_id = $this->session->userdata('user_id');
        $order = $this->db->query("SELECT * FROM app_orders where user_id = '$user_id' && id = '$id'");
        if($order->num_rows() == 0){
            redirect(base_url('user/orders'));
	        exit;
        }
        $order = $order->row_array();
		$this->title = "Order # ".$order['id']." || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
	    $user_id = $this->session->userdata('user_id');
	    $data['order'] = $order;
	    $data['order_details'] = $this->db->query("SELECT * FROM app_order_details where user_id = '$user_id' && order_id = '$id' order by id asc")->result_array();
        $this->load_web('order_details',$data);
	}
	
	public function referrals()
	{
	    if(!$this->session->userdata('user_loggedin')){
            redirect(base_url());
            exit;
        }
        
		$this->title = "Referrals || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
	
        $this->load_web('referrals',$data);
	}
	
	public function logout(){
	    $this->session->unset_userdata(array('user_id', 'user_loggedin', 'login_secret'));
	    delete_cookie('remember_me');
	    redirect(base_url());
	    exit;
	}
	
	public function verify_email($code){
	    $user = $this->db->query("SELECT * FROM app_users where email_verification = '$code'");
	    if($user->num_rows() > 0){
	        $ip = $this->input->ip_address();
	        $now = date('Y-m-d H:i:s');
	        
	        $this->db->query("UPDATE app_users set email_verification = '0', last_login = '$now', last_ip = '$ip' WHERE email_verification = '$code'");
	        $user = $user->row_array();
	        
	        $this->db->query("UPDATE app_cart SET session_id = '0', user_id = '{$user['id']}' WHERE session_id = '{$_COOKIE['session_id']}'");
	        $this->session->set_userdata(array('user_id'=>$user['id'], 'user_loggedin'=>true, 'login_secret'=>$user['login_secret']));
	        $this->session->set_userdata(array('flash_message'=>'<div class="alert alert-success alert-inline show-code-action">Thanks for your email verification. Your account is activated now.</div>'));
	        redirect(base_url('user/account'));
	        exit;
	    }else{
	        redirect(base_url());
	        exit;
	    }
	}
	
	public function refqrcode(){
	    if(!$this->session->userdata('user_loggedin')){
            redirect(base_url());
            exit;
        }
        
        $user_id = $this->session->userdata('user_id');
        $user = $this->db->query("SELECT * FROM app_users WHERE id = '$user_id'")->row_array();
	    // Text content of the QRCode
        $data = base_url().'user/referral/'.$user['referral_code'];
        // QRCode size
        $size = '500x500';
        // Path to image (web or local)
        $logo = base_url().'uploads/settings/favicon_1640544018.png';
        
        // Get QR Code image from Google Chart API
        // http://code.google.com/apis/chart/infographics/docs/qr_codes.html
        $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));
        
        // START TO DRAW THE IMAGE ON THE QR CODE
        $logo = imagecreatefromstring(file_get_contents($logo));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        
        // Scale logo to fit in the QR Code
        $logo_qr_width = $QR_width/5;
        $scale = $logo_width/$logo_qr_width;
        $logo_qr_height = $logo_height/$scale;
        
        imagecopyresampled($QR, $logo, $QR_width/2.55, $QR_height/2.55, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        
        // END OF DRAW
        
        /**
         * As this example is a plain PHP example, return
         * an image response.
         *
         * Note: you can save the image if you want.
         */
        header('Content-type: image/png');
        imagepng($QR);
        imagedestroy($QR);
        
        // If you decide to save the image somewhere remove the header and use instead :
        // $savePath = "/path/to-my-server-images/myqrcodewithlogo.png";
        // imagepng($QR, $savePath);
	}
	
    public function referral($code){
        $user = $this->db->query("SELECT * FROM app_users where referral_code = '$code'");
        if($user->num_rows() > 0){
	           $cookieData= array(
                   'name'   => 'referral_code',
                   'value'  => $code,                            
                   'expire' =>  (300),                                                                                   
                   'secure' => TRUE
               );
               $this->input->set_cookie($cookieData);
               redirect(base_url('user/register'));
	        exit;
	    }else{
	        redirect(base_url());
	        exit;
	    }
    }
    
    public function getrefqrcode($referral_code){
	    // Text content of the QRCode
        $data = base_url().'user/referral/'.$referral_code;
        // QRCode size
        $size = '500x500';
        // Path to image (web or local)
        $logo = base_url().'uploads/settings/favicon_1640544018.png';
        
        // Get QR Code image from Google Chart API
        // http://code.google.com/apis/chart/infographics/docs/qr_codes.html
        $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));
        
        // START TO DRAW THE IMAGE ON THE QR CODE
        $logo = imagecreatefromstring(file_get_contents($logo));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);
        
        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);
        
        // Scale logo to fit in the QR Code
        $logo_qr_width = $QR_width/5;
        $scale = $logo_width/$logo_qr_width;
        $logo_qr_height = $logo_height/$scale;
        
        imagecopyresampled($QR, $logo, $QR_width/2.55, $QR_height/2.55, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        
        // END OF DRAW
        
        /**
         * As this example is a plain PHP example, return
         * an image response.
         *
         * Note: you can save the image if you want.
         */
        header('Content-type: image/png');
        imagepng($QR);
        imagedestroy($QR);
        
        // If you decide to save the image somewhere remove the header and use instead :
        // $savePath = "/path/to-my-server-images/myqrcodewithlogo.png";
        // imagepng($QR, $savePath);
	}
	
	
	
	
}
