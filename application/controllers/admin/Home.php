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
	    
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
	    
		$this->title = "Dashboard || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
		
        $this->load_admin('home',$data);
	}
	
	public function change_password()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin');
            exit();
		}
		
		if($this->input->post()){
		    $uid = $this->session->userdata('admin_id');
		    $old_password = md5("dchannel_by_alisofttech".$this->input->post('old_password'));
		    $new_password = md5("dchannel_by_alisofttech".$this->input->post('new_password'));
		    $confirm_password = md5("dchannel_by_alisofttech".$this->input->post('confirm_password'));
		    $admin_pass = $this->db->query("SELECT * FROM app_admins WHERE id='$uid'")->row_array()['password'];
		    
		    if($old_password != $admin_pass){
		        $this->set_message('error', "Your old password is incorrect.");
                redirect('admin/home/change_password');
		        exit();
		    }
		    
		    if($new_password != $confirm_password){
		        $this->set_message('error', "Your new and confirm password are not matched.");
                redirect('admin/home/change_password');
		        exit();
		    }
		    
		    
		    $this->db->query("update app_admins set password = '$new_password' where id='$uid'");
		    
            $this->set_message('success', "Your password has been changes successfuly.");
            redirect('admin/home/change_password');
            exit();
		    
		    
		}
	    
		$this->title = "Change Password || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
		
        $this->load_admin('change_password',$data);
	}
	
	public function team_managment($type='', $id=0)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin');
            exit();
		}
	    
	    
	    if($type=='delete'){
	        
	        $this->db->where('id', $id);
            $this->db->delete('team'); 
	        $this->set_message('success', "Team memeber deleted successfully.");
            redirect('admin/team_managment');
	        exit();
	    }
	    
	    if($type=='add'){
	        
	        if($this->input->post()){
	            $date = date('Y-m-d H:i:s');
                $timestamp = strtotime($date);
            	$imt = str_replace(' ', '-', $this->input->post('name'));
            	if($_FILES['image']["type"] == "image/jpeg" || $_FILES['image']["type"] == "image/JPEG"){

                    $img = $imt.'_'.$timestamp . '.jpeg';
                
                }else if($_FILES['image']["type"] == "image/png" || $_FILES['image']["type"] == "image/PNG"){
                
                    $img = $imt.'_'.$timestamp . '.png';
                
                }else if($_FILES['image']["type"] == "image/jpg" || $_FILES['image']["type"] == "image/JPG"){
            
                    $img = $imt.'_'.$timestamp . '.jpg';
                    
                }else if($_FILES['image']["type"] == "image/gif" || $_FILES['image']["type"] == "image/GIF"){
            
                    $img = $imt.'_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "File upload type is not supported");
            		redirect('admin/team_managment/add');
            		exit();
            	}
            	
            	$target = "webfiles/images/team/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $sort = $this->db->query("select MAX(sorting) as sorting from team")->row()->sorting+1;
                $data['name'] = $this->input->post('name');
                $data['designation'] = $this->input->post('designation');
                $data['image'] = $img;
                if($this->input->post('featured')){
                    $data['featured'] = 1;
                }else{
                    $data['featured'] = 0;
                }
                
                $data['sorting'] = $sort;
                
                
		        $this->db->insert('team', $data);
                $this->set_message('success', "Team member added successfully.");
                if($this->input->post('submit_another')){
                    redirect('admin/team_managment/add');
    		        exit();
    		    }
    		    redirect('admin/team_managment');
        		exit();
	        }
	        
	        $this->title = "Add Team Member || ".$this->admintitle;
	        $data['view_scripts']=array();
	        $data['view_css']=array();
	        $this->load_admin('add_team',$data);
	        
	    }elseif($type=='edit'){
	        
	        $team = $this->db->select('*')->from('team')->where('id', $id)->get();
    		if($team->num_rows()<1){
    		    redirect('admin/dashboard');
                exit();
    		}
	        
	        if($this->input->post()){
	            
	            $data['name'] = $this->input->post('name');
                $data['designation'] = $this->input->post('designation');
                if($this->input->post('featured')){
                    $data['featured'] = 1;
                }else{
                    $data['featured'] = 0;
                }
                
                $this->db->where('id',$id);
		        $this->db->update('team',$data);
	            
	            if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
    	            $date = date('Y-m-d H:i:s');
                    $timestamp = strtotime($date);
                	$imt = str_replace(' ', '-', $this->input->post('name'));
                	if($_FILES['image']["type"] == "image/jpeg" || $_FILES['image']["type"] == "image/JPEG"){
    
                        $img = $imt.'_'.$timestamp . '.jpeg';
                    
                    }else if($_FILES['image']["type"] == "image/png" || $_FILES['image']["type"] == "image/PNG"){
                    
                        $img = $imt.'_'.$timestamp . '.png';
                    
                    }else if($_FILES['image']["type"] == "image/jpg" || $_FILES['image']["type"] == "image/JPG"){
                
                        $img = $imt.'_'.$timestamp . '.jpg';
                        
                    }else if($_FILES['image']["type"] == "image/gif" || $_FILES['image']["type"] == "image/GIF"){
                
                        $img = $imt.'_'.$timestamp . '.gif';
                        
                    }else{
                        $this->set_message('error', "File upload type is not supported");
                		redirect('admin/team_managment/edit/'.$id);
                		exit();
                	}
                	
                	$target = "webfiles/images/team/"; 
                    $target = $target . basename($img); 
                    move_uploaded_file($_FILES['image']['tmp_name'], $target);
                    $data['image'] = $img;
                
                    $this->db->where('id',$id);
    		        $this->db->update('team',$data);
                    
	            }
                $this->set_message('success', "Team member updated successfully.");
    		    redirect('admin/team_managment');
        		exit();
	        }
	        
	        $this->title = "Edit Team Member || ".$this->admintitle;
	        $data['view_scripts']=array();
	        $data['view_css']=array();
	        
	        $data['team'] = $team->row_array();
	        $this->load_admin('edit_team',$data);
	        
	    }else{
	    
	    
    		$this->title = "Team Management || ".$this->admintitle;
    		
    		$data['view_scripts']=array(
    		    $this->Gen->get_url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'),
    		    $this->Gen->get_url('https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net/js/jquery.dataTables.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-responsive/js/dataTables.responsive.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/dataTables.buttons.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.html5.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.flash.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.print.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-keytable/js/dataTables.keyTable.min.js'),
    		    $this->Gen->get_admin_url('libs/datatables.net-select/js/dataTables.select.min.js'),
    		    $this->Gen->get_admin_url('js/custom/team_managment.js'),
    		);
    		$data['view_css']=array(
    		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
    		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
    		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
    		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
    		);
    		
    		
    		$data['team'] = $this->db->select('*')->from('team')->order_by('sorting', 'asc')->get()->result_array();
    	    
    		
            $this->load_admin('team_managment',$data);
	    }
	}

	
	public function logout(){
	    if ($this->auth->logout()) {
            redirect('admin/authentication');
            exit();
		}
	}

}
