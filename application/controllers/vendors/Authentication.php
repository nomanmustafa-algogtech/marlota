<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends My_controller {
    
    function __construct() {
        parent::__construct();
        
        $this->CI = & get_instance();
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
		if ($this->session->userdata('vendor_loggedin')) {
            redirect('vendors/home');
            exit();
		}
	    
	    if($this->input->post()){
	        $this->form_validation->set_rules('email', 'Email', 'required');
    		$this->form_validation->set_rules('password', 'Password', 'required');
            $error="";
    		if ($this->form_validation->run() == FALSE) {
    		    $this->set_message('error', validation_errors());
    		    redirect('vendors/authentication');
    		    exit();
    		} else {
    		    
    		    
    			$email = $this->input->post('email');
                $password = md5("dchannel_by_alisofttech".$this->input->post('password'));
                
                $vendor = $this->db->query("SELECT * FROM app_vendors where email = '$email' AND password = '$password' AND deleted = '0'");
                
                if($vendor->num_rows() > 0){
                    $vendor = $vendor->row_array();
                    if($vendor['approved'] == 1){
                         $this->session->set_userdata(array('vendor_id'=>$vendor['id'], 'vendor_loggedin'=>true));
                    }else{
                        $error = "Your account is not approved yet from approval authority."; 
                    }
                }else{
                   $error = "Email or password is incorrect."; 
                }
                
                if ($error != '') {
                    $this->set_message('error', $error);
                    redirect('vendors/authentication');
    		        exit();
                } else {
                   
                    redirect('vendors/home');
    		        exit();
                }
    		}
	    }
		$this->title = "Login || ".$this->vendortitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
		
        $this->load_vendor('authentication/login',$data, 'login');
	}
	
	
	public function reset_password()
	{
		if ($this->session->userdata('vendor_loggedin')) {
            redirect('vendors/home');
            exit();
		}
	    
	    if($this->input->post()){
	        $this->form_validation->set_rules('email', 'Email', 'required');
    		$this->form_validation->set_rules('phone', 'Phone', 'required');
            $error="";
    		if ($this->form_validation->run() == FALSE) {
    		    $this->set_message('error', validation_errors());
    		    redirect('vendors/authentication/reset_password');
    		    exit();
    		} else {
    		    
    		    
    			$email = $this->input->post('email');
    			$phone = $this->input->post('phone');
                
                $vendor = $this->db->query("SELECT * FROM app_vendors where email = '$email' AND phone = '$phone' AND deleted = '0'");
                
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
                    $this->set_message('error', $error);
                    redirect('vendors/authentication/reset_password');
    		        exit();
                } else {
                    $this->set_message('success', "Your password has been sent to registered phone no.");
                    redirect('vendors/authentication');
    		        exit();
                }
    		}
	    }
		$this->title = "Reset Password || ".$this->vendortitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
		
        $this->load_vendor('authentication/reset_password',$data, 'login');
	}
	

}
