<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_controller {
    
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
	    
	    if (!$this->session->userdata('vendor_loggedin')) {
            redirect('vendors/authentication');
            exit();
		}
	    
		$this->title = "Dashboard || ".$this->vendortitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
		
        $this->load_vendor('home',$data);
	}
	
	public function change_password()
	{
	    if (!$this->session->userdata('vendor_loggedin')) {
            redirect('vendors');
            exit();
		}
		
		if($this->input->post()){
		    $uid = $this->session->userdata('vendor_id');
		    $old_password = md5("dchannel_by_alisofttech".$this->input->post('old_password'));
		    $new_password = md5("dchannel_by_alisofttech".$this->input->post('new_password'));
		    $confirm_password = md5("dchannel_by_alisofttech".$this->input->post('confirm_password'));
		    $vendor_pass = $this->db->query("SELECT * FROM app_vendors WHERE id='$uid'")->row_array()['password'];
		    
		    if($old_password != $vendor_pass){
		        $this->set_message('error', "Your old password is incorrect.");
                redirect('vendors/home/change_password');
		        exit();
		    }
		    
		    if($new_password != $confirm_password){
		        $this->set_message('error', "Your new and confirm password are not matched.");
                redirect('vendors/home/change_password');
		        exit();
		    }
		    
		    
		    $this->db->query("update app_vendors set password = '$new_password' where id='$uid'");
		    
            $this->set_message('success', "Your password has been changes successfuly.");
            redirect('vendors/home/change_password');
            exit();
		    
		    
		}
	    
		$this->title = "Change Password || ".$this->vendortitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
		
        $this->load_vendor('change_password',$data);
	}
	

	
	public function logout(){
	    $this->session->unset_userdata(array('vendor_id', 'vendor_loggedin'));
	    redirect(base_url('vendors'));
	    exit;
	}

}
