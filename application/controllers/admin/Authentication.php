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
	    if ($this->auth->is_logged()) {
            redirect('admin/home');
            exit();
		}
	    
	    if($this->input->post()){
	        $this->form_validation->set_rules('username', 'Username', 'required');
    		$this->form_validation->set_rules('password', 'Password', 'required');
            $error="";
    		if ($this->form_validation->run() == FALSE) {
    		    $this->set_message('error', validation_errors());
    		    redirect('admin/authentication');
    		    exit();
    		} else {
    		    
    		    
    			$username = $this->input->post('username');
                $password = $this->input->post('password');
                if ($this->auth->login($username, $password) === FALSE) {
                    $error = "Username or password incorrect.";
                }
                if ($error != '') {
                    $this->set_message('error', $error);
                    redirect('admin/authentication');
    		        exit();
                } else {
                   
                    // redirect('admin/home');
                    // echo 1;
                //     $user = $this->db->query("SELECT * FROM app_admins WHERE username = '$username'")->row_array();
                //     $uidd= $user['id'];
                    
                //     if(!empty($uidd)){
                //         // echo $uidd; 
                //         $rand_no=rand(1111111,9999999);
                //         $data = array(
                //             'user_id'=>$uidd,
                //             'rand_no'=>$rand_no
                //         );
                //         $this->db->insert('users_login',$data);
                // 		$this->session->set_userdata(IS_LOGIN);
                		$this->session->set_userdata(array('admin_password'=>md5($password)));
                		redirect('admin/home');
                		exit();
                    // }
    		        
                }
    		}
	    }
		$this->title = "Login || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
		
        $this->load_admin('authentication/login',$data, 'login');
	}
	

}
