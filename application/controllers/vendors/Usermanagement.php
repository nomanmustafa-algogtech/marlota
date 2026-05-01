<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanagement extends My_controller {
    
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
	   //print_r($this->session->userdata('permissions_allow'));
	   exit;
	}
	
	public function add_user()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if ($this->session->userdata('admin_id') != 1) {
            redirect('admin/home');
            exit();
		}
		
		
		if($this->input->post()){
	            $date = date('Y-m-d H:i:s');
                $timestamp = strtotime($date);
                $role_id = $this->input->post('role_id');
                $fullname = $this->input->post('fullname');
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $phone = $this->input->post('phone');
                
                
                
                $check_username = $this->db->query("select * from app_admins where username = '$username'")->num_rows();
                if($check_username > 0){
                    $this->set_message('error', "Username already exists in database.");
                    redirect('admin/usermanagement/add_user');
        		    exit();
                }
                
                $check_email = $this->db->query("select * from app_admins where email = '$email'")->num_rows();
                if($check_email > 0){
                    $this->set_message('error', "Email already exists in database.");
                    redirect('admin/usermanagement/add_user');
        		    exit();
                }
                
                if(file_exists($_FILES['profile_pic']['tmp_name']) && is_uploaded_file($_FILES['profile_pic']['tmp_name'])){
                    $imt = str_replace(' ', '-', $this->input->post('fullname'));
                	if($_FILES['profile_pic']["type"] == "image/jpeg" || $_FILES['profile_pic']["type"] == "image/JPEG"){
    
                        $img = $imt.'_'.$timestamp . '.jpeg';
                    
                    }else if($_FILES['profile_pic']["type"] == "image/png" || $_FILES['profile_pic']["type"] == "image/PNG"){
                    
                        $img = $imt.'_'.$timestamp . '.png';
                    
                    }else if($_FILES['profile_pic']["type"] == "image/jpg" || $_FILES['profile_pic']["type"] == "image/JPG"){
                
                        $img = $imt.'_'.$timestamp . '.jpg';
                        
                    }else if($_FILES['profile_pic']["type"] == "image/gif" || $_FILES['profile_pic']["type"] == "image/GIF"){
                
                        $img = $imt.'_'.$timestamp . '.gif';
                        
                    }else{
                        $this->set_message('error', "File upload type is not supported");
                		redirect('admin/usermanagement/add_user');
                		exit();
                	}
                	
                	$target = "uploads/profile_pics/admin/"; 
                    $target = $target . basename($img); 
                    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);
                    $data['profile_pic'] = $img;
                }
                
            	
            	
                $data['fullname'] = $fullname;
                $data['username'] = $username;
                $data['email'] = $email;
                $data['password'] = md5("dchannel_by_alisofttech".$password);
                $data['phone'] = $phone;
                $data['role_id'] = $role_id;
                
                
		        $this->db->insert('app_admins', $data);
                $this->set_message('success', "User has been added successfully.");
                
    		    redirect('admin/usermanagement/users');
        		exit();
	        }
	
	    
		$this->title = "Add User || ".$this->admintitle;
		
		$data['view_scripts']=array(
		     $this->Gen->get_admin_url('libs/select2/js/select2.min.js'),
		     $this->Gen->get_admin_url('js/custom/all.js'),
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/select2/css/select2.min.css'),
		);
	    $data['roles'] = $this->db->select("*")->from('app_roles')->where('deleted', 0)->get()->result_array();
		
        $this->load_admin('usermanagement/add_user',$data);
	}
	
	public function edit_user($user_id)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if ($this->session->userdata('admin_id') != 1) {
            redirect('admin/home');
            exit();
		}
		
		if($this->input->post()){
	            $date = date('Y-m-d H:i:s');
                $timestamp = strtotime($date);
                $role_id = $this->input->post('role_id');
                $fullname = $this->input->post('fullname');
                
                $phone = $this->input->post('phone');
                
                
               
                
                if(file_exists($_FILES['profile_pic']['tmp_name']) && is_uploaded_file($_FILES['profile_pic']['tmp_name'])){
                    $imt = str_replace(' ', '-', $this->input->post('fullname'));
                	if($_FILES['profile_pic']["type"] == "image/jpeg" || $_FILES['profile_pic']["type"] == "image/JPEG"){
    
                        $img = $imt.'_'.$timestamp . '.jpeg';
                    
                    }else if($_FILES['profile_pic']["type"] == "image/png" || $_FILES['profile_pic']["type"] == "image/PNG"){
                    
                        $img = $imt.'_'.$timestamp . '.png';
                    
                    }else if($_FILES['profile_pic']["type"] == "image/jpg" || $_FILES['profile_pic']["type"] == "image/JPG"){
                
                        $img = $imt.'_'.$timestamp . '.jpg';
                        
                    }else if($_FILES['profile_pic']["type"] == "image/gif" || $_FILES['profile_pic']["type"] == "image/GIF"){
                
                        $img = $imt.'_'.$timestamp . '.gif';
                        
                    }else{
                        $this->set_message('error', "File upload type is not supported");
                		redirect('admin/usermanagement/edit_user/'.$user_id);
                		exit();
                	}
                	
                	$target = "uploads/profile_pics/admin/"; 
                    $target = $target . basename($img); 
                    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);
                    $data['profile_pic'] = $img;
                }
                
            	
            	
                $data['fullname'] = $fullname;
                if($this->input->post('password')){
                     $data['password'] = md5("dchannel_by_alisofttech".$this->input->post('password'));
                }
               
                $data['phone'] = $phone;
                $data['role_id'] = $role_id;
                
                $this->db->where('id',$user_id);
		        $this->db->update('app_admins', $data);
                $this->set_message('success', "User has been updated successfully.");
                
    		    redirect('admin/usermanagement/users');
        		exit();
	        }
		
	
	    
		$this->title = "Edit User || ".$this->admintitle;
		
		$data['view_scripts']=array(
		     $this->Gen->get_admin_url('libs/select2/js/select2.min.js'),
		     $this->Gen->get_admin_url('js/custom/all.js'),
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/select2/css/select2.min.css'),
		);
		$data['roles'] = $this->db->select("*")->from('app_roles')->where('deleted', 0)->get()->result_array();
	    $data['user']   = $this->db->select("*")->from("app_admins")->where('id', $user_id)->get()->row_array();
		
        $this->load_admin('usermanagement/edit_user',$data);
	}
	
	public function delete_user($user_id)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if ($this->session->userdata('admin_id') != 1) {
            redirect('admin/home');
            exit();
		}
		
	    $data['status'] = 1;  
        $this->db->where('id',$user_id);
        $this->db->update('app_admins', $data);
        $this->set_message('success', "User deleted successfully.");
        redirect('admin/usermanagement/users');
		exit();
	}
	
	public function users()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if ($this->session->userdata('admin_id') != 1) {
            redirect('admin/home');
            exit();
		}
		
		$this->title = "Users List || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
	    $data['users'] = $this->db->select("*")->from('app_admins')->where(array('id>'=>1, 'status!='=>1))->get()->result_array();
		
        $this->load_admin('usermanagement/users',$data);
	}
	
	public function add_role()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if ($this->session->userdata('admin_id') != 1) {
            redirect('admin/home');
            exit();
		}
		
		if($this->input->post()){
		    
		    $name = trim($_POST['name']);
            $perm = implode(',', $_POST['perm']);
            
            $check_name = $this->db->query("select * from app_roles where name = '$name'")->num_rows();
            if($check_name > 0){
                $this->set_message('error', "Role name already exists in database.");
                redirect('admin/usermanagement/add_role');
    		    exit();
            }
            
            $data['name'] = $name;
            $data['permissions'] = $perm;
            $this->db->insert('app_roles', $data);
            $this->set_message('success', "Role added successfully.");
            redirect('admin/usermanagement/add_role');
    		exit();
	            
	   }
		
	
	    
		$this->title = "Add Role || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
		
        $this->load_admin('usermanagement/add_role',$data);
	}
	
    public function edit_role($role_id)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if ($this->session->userdata('admin_id') != 1) {
            redirect('admin/home');
            exit();
		}
		
		if($this->input->post()){
		    
		    $name = trim($_POST['name']);
            $perm = implode(',', $_POST['perm']);
            
            $check_name = $this->db->query("select * from app_roles where name = '$name' && id <> $role_id")->num_rows();
            if($check_name > 0){
                $this->set_message('error', "Role name already exists in database.");
                redirect('admin/usermanagement/edit_role/'.$role_id);
    		    exit();
            }
            
            $data['name'] = $name;
            $data['permissions'] = $perm;
            
            $this->db->where('id',$role_id);
            $this->db->update('app_roles', $data);
            $this->set_message('success', "Role updated successfully.");
            redirect('admin/usermanagement/role_list');
    		exit();
	            
	   }
		
	
	    
		$this->title = "Edit Role || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    $data['role']   = $this->db->select("*")->from("app_roles")->where('id', $role_id)->get()->row_array();
		
        $this->load_admin('usermanagement/edit_role',$data);
	}
	
	public function delete_role($role_id)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if ($this->session->userdata('admin_id') != 1) {
            redirect('admin/home');
            exit();
		}
		
	    $data['deleted'] = 1;  
        $this->db->where('id',$role_id);
        $this->db->update('app_roles', $data);
        $this->set_message('success', "Role deleted successfully.");
        redirect('admin/usermanagement/role_list');
		exit();
	}
	
	public function role_list()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if ($this->session->userdata('admin_id') != 1) {
            redirect('admin/home');
            exit();
		}
		
		$this->title = "Roles List || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
	    $data['roles'] = $this->db->select("*")->from('app_roles')->where('deleted', 0)->get()->result_array();
		
        $this->load_admin('usermanagement/role_list',$data);
	}
	
	


}
