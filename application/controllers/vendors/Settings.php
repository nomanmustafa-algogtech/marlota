<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends My_controller {
    
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
    
   
	public function general()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		if($this->input->post()){
		    $data['site_title'] = $this->input->post('site_title');
		    $data['meta_title'] = $this->input->post('meta_title');
		    $data['meta_description'] = $this->input->post('meta_description');
		    $data['top_message'] = $this->input->post('top_message');
		    $data['copyright_message'] = $this->input->post('copyright_message');
		    $data['site_phone'] = $this->input->post('site_phone');
		 
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    
		    if(file_exists($_FILES['site_icon']['tmp_name']) && is_uploaded_file($_FILES['site_icon']['tmp_name'])){
                $imt = 'favicon';
            	if($_FILES['site_icon']["type"] == "image/jpeg" || $_FILES['site_icon']["type"] == "image/JPEG"){

                    $img = $imt.'_'.$timestamp . '.jpeg';
                
                }else if($_FILES['site_icon']["type"] == "image/png" || $_FILES['site_icon']["type"] == "image/PNG"){
                
                    $img = $imt.'_'.$timestamp . '.png';
                
                }else if($_FILES['site_icon']["type"] == "image/jpg" || $_FILES['site_icon']["type"] == "image/JPG"){
            
                    $img = $imt.'_'.$timestamp . '.jpg';
                    
                }else if($_FILES['site_icon']["type"] == "image/gif" || $_FILES['site_icon']["type"] == "image/GIF"){
            
                    $img = $imt.'_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "File upload type is not supported");
            		redirect('admin/settings/general');
            		exit();
            	}
            	
            	$target = "uploads/settings/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['site_icon']['tmp_name'], $target);
                $data['site_icon'] = $img;
            }
            
            if(file_exists($_FILES['site_logo']['tmp_name']) && is_uploaded_file($_FILES['site_logo']['tmp_name'])){
                $imt = 'logo';
            	if($_FILES['site_logo']["type"] == "image/jpeg" || $_FILES['site_logo']["type"] == "image/JPEG"){

                    $img = $imt.'_'.$timestamp . '.jpeg';
                
                }else if($_FILES['site_logo']["type"] == "image/png" || $_FILES['site_logo']["type"] == "image/PNG"){
                
                    $img = $imt.'_'.$timestamp . '.png';
                
                }else if($_FILES['site_logo']["type"] == "image/jpg" || $_FILES['site_logo']["type"] == "image/JPG"){
            
                    $img = $imt.'_'.$timestamp . '.jpg';
                    
                }else if($_FILES['site_logo']["type"] == "image/gif" || $_FILES['site_logo']["type"] == "image/GIF"){
            
                    $img = $imt.'_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "File upload type is not supported");
            		redirect('admin/settings/general');
            		exit();
            	}
            	
            	$target = "uploads/settings/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['site_logo']['tmp_name'], $target);
                $data['site_logo'] = $img;
            }
            
            foreach($data as $name=>$value){
                $this->db->where('name', $name);
                $this->db->update('app_settings', array('value'=>$value));
            }
		  //  $this->db->insert('app_brands', $data);
		    $this->set_message('success', "Settings updated successfully.");
		    redirect('admin/settings/general');
        	exit();
		}
		
		$this->title = "General Settings || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
	    $settings = $this->db->select("*")->from('app_settings')->get()->result_array();
	    foreach($settings as $row){
	        $data[$row['name']] = $row['value'];
	    }
		
        $this->load_admin('settings/general',$data);
	}
	
	public function sliders()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		$this->title = "Slider Settings || ".$this->admintitle;
		
		$data['view_scripts']=array(
		    $this->Gen->get_url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'),
		);
		$data['view_css']=array();
	    
	    $data['sliders'] = $this->db->select("*")->from('app_sliders')->order_by('sorting', 'ASC')->get()->result_array();
		
        $this->load_admin('settings/sliders',$data);
	}
	
	public function add_slider()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if($this->input->post()){
		    $data['title'] = $this->input->post('title');
		    $data['subtitle'] = $this->input->post('sub_title');
		    $data['text'] = $this->input->post('text');
		    $data['button_title'] = $this->input->post('button_title');
		    $data['link'] = $this->input->post('button_link');
		    if($this->input->post('content_show')){
		        $data['content_show'] = 1;
		    }else{
		        $data['content_show'] = 0;
		    }
		    
		 
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    
		    if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
                $imt = 'slider';
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
            		redirect('admin/settings/add_slider');
            		exit();
            	}
            	
            	$target = "uploads/sliders/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $data['image'] = $img;
            }
            
            
            
          
		    $this->db->insert('app_sliders', $data);
		    $this->set_message('success', "Slider added successfully");
		    redirect('admin/settings/sliders');
        	exit();
		}
		
		
		$this->title = "Add Slider || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
		
        $this->load_admin('settings/add_slider',$data);
	}
	
	public function edit_slider($id)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		$slider = $this->db->select('*')->from('app_sliders')->where('id', $id)->get();
		if($slider->num_rows() == 0){
		    redirect('admin/settings/sliders');
		    exit;
		}
		
		if($this->input->post()){
		    $data['title'] = $this->input->post('title');
		    $data['subtitle'] = $this->input->post('sub_title');
		    $data['text'] = $this->input->post('text');
		    $data['button_title'] = $this->input->post('button_title');
		    $data['link'] = $this->input->post('button_link');
		    if($this->input->post('content_show')){
		        $data['content_show'] = 1;
		    }else{
		        $data['content_show'] = 0;
		    }
		    
		 
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    
		    if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
                $imt = 'slider';
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
            		redirect('admin/settings/add_slider');
            		exit();
            	}
            	
            	$target = "uploads/sliders/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $data['image'] = $img;
            }
            
            
            
            $this->db->where('id', $id);
		    $this->db->update('app_sliders', $data);
		    $this->set_message('success', "Slider updated successfully");
		    redirect('admin/settings/sliders');
        	exit();
		}
		
		
		$this->title = "Edit Slider || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
		$data['slider'] = $slider->row_array();
        $this->load_admin('settings/edit_slider',$data);
	}
	
	public function delete_slider($id){
	    $this->db->where('id', $id);
	    $this->db->delete('app_sliders');
	    $this->set_message('success', "Slider deleted successfully");
		redirect('admin/settings/sliders');
        exit();
	}
	
	public function reOrderSliders(){
	    $position = $this->input->post('position');
        $i=1;
        foreach($position as $k=>$v){
            $data = array('sorting'=>$i);
		    $this->db->where('id',$v);
		    $this->db->update('app_sliders',$data);
            $i++;
        }
        echo 'SUCCESS';
	}
	
	public function cities()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		$this->title = "Address Settings || ".$this->admintitle;
		
	    $data['view_scripts']=array(
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
		    $this->Gen->get_admin_url('js/custom/product.js'),
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		);
	    
	    $data['cities'] = $this->db->select("*")->from('app_cities')->order_by('name', 'ASC')->get()->result_array();
		
        $this->load_admin('settings/cities',$data);
	}
	
	public function disable_city($id){
	    $this->db->where('id', $id);
	    $this->db->update('app_cities', array('status'=>0));
	    $this->set_message('success', "City disabled successfully");
		redirect('admin/settings/cities');
        exit();
	}
	
	public function enable_city($id){
	    $this->db->where('id', $id);
	    $this->db->update('app_cities', array('status'=>1));
	    $this->set_message('success', "City enabled successfully");
		redirect('admin/settings/cities');
        exit();
	}
	
	public function zones()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		$this->title = "Zones Settings || ".$this->admintitle;
		
	    $data['view_scripts']=array(
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
		    $this->Gen->get_admin_url('js/custom/product.js'),
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		);
	    
	    $this->db->select("*")->from('app_zones')->order_by('name', 'ASC');
		
		if($this->input->get('city_id')){
		    $this->db->where('city_id', $this->input->get('city_id'));
		}
		
		$data['zones'] = $this->db->get()->result_array();
        $this->load_admin('settings/zones',$data);
	}
	
	public function add_zone()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if($this->input->post()){
		    $city_id = $this->input->post('city_id');
		    $name = $this->input->post('name');
		    
		    $check_zone = $this->db->query("SELECT * FROM app_zones where name = '$name' && city_id = '$city_id'");
		    if($check_zone->num_rows() > 0){
		        $this->set_message('error', "Zone name already found in this city.");
        		redirect('admin/settings/add_zone?city_id='.$city_id);
                exit();
		    }
		    
		    $data['city_id']=$city_id;
		    $data['name']=$name;
		    $data['status']=1;
		    
		    $this->db->insert('app_zones', $data);
		    $this->set_message('success', "Zone created successfully.");
    		redirect('admin/settings/zones?city_id='.$city_id);
            exit();
		    
		}
		
		$this->title = "Add New Zone || ".$this->admintitle;
		
		$data['view_scripts']=array(
		     $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.js'),
		     $this->Gen->get_admin_url('libs/select2/js/select2.min.js'),
		  //   $this->Gen->get_admin_url('libs/quill/quill.min.js'),
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
		  //   $this->Gen->get_admin_url('js/pages/form-quilljs.init.js'),
		     $this->Gen->get_admin_url('js/custom/all.js'),
		     $this->Gen->get_admin_url('js/custom/product.js'),
		     
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/select2/css/select2.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css'),
		    $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.snow.css'),
		);
	    
	    $data['cities'] = $this->db->select("*")->from('app_cities')->order_by('name', 'ASC')->get()->result_array();
		
        $this->load_admin('settings/add_zone',$data);
	}
	
	public function disable_zone($id, $city_id){
	    $this->db->where('id', $id);
	    $this->db->update('app_zones', array('status'=>0));
	    $this->set_message('success', "Zone disabled successfully");
		redirect('admin/settings/zones?city_id='.$city_id);
        exit();
	}
	
	public function enable_zone($id, $city_id){
	    $this->db->where('id', $id);
	    $this->db->update('app_zones', array('status'=>1));
	    $this->set_message('success', "Zone enabled successfully");
		redirect('admin/settings/zones?city_id='.$city_id);
        exit();
	}
	
	public function areas()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		$this->title = "Area Settings || ".$this->admintitle;
		
	    $data['view_scripts']=array(
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
		    $this->Gen->get_admin_url('js/custom/product.js'),
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		);
	    
	    $this->db->select("*")->from('app_areas')->order_by('name', 'ASC');
		
		if($this->input->get('city_id')){
		    $this->db->where('city_id', $this->input->get('city_id'));
		}
		
		if($this->input->get('zone_id')){
		    $this->db->where('zone_id', $this->input->get('zone_id'));
		}
		
		$data['areas'] = $this->db->get()->result_array();
        $this->load_admin('settings/areas',$data);
	}
	
	public function add_area()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if($this->input->post()){
		    $zone_id = $this->input->post('zone_id');
		    $name = $this->input->post('name');
		    
		    $city_id = $this->db->query("SELECT * FROM app_zones where id = '$zone_id'")->row_array()['city_id'];
		    
		    $check_area = $this->db->query("SELECT * FROM app_areas where name = '$name' && zone_id = '$zone_id'");
		    if($check_area->num_rows() > 0){
		        $this->set_message('error', "Area already found in this zone.");
        		redirect('admin/settings/add_area?zone_id='.$zone_id);
                exit();
		    }
		    
		    $data['city_id']=$city_id;
		    $data['zone_id']=$zone_id;
		    $data['name']=$name;
		    $data['status']=1;
		    
		    $this->db->insert('app_areas', $data);
		    $this->set_message('success', "Area created successfully.");
    		redirect('admin/settings/areas?zone_id='.$zone_id);
            exit();
		    
		}
		
		$this->title = "Add New Area || ".$this->admintitle;
		
		$data['view_scripts']=array(
		     $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.js'),
		     $this->Gen->get_admin_url('libs/select2/js/select2.min.js'),
		  //   $this->Gen->get_admin_url('libs/quill/quill.min.js'),
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
		  //   $this->Gen->get_admin_url('js/pages/form-quilljs.init.js'),
		     $this->Gen->get_admin_url('js/custom/all.js'),
		     $this->Gen->get_admin_url('js/custom/product.js'),
		     
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/select2/css/select2.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css'),
		    $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.snow.css'),
		);
	    
	    $this->db->select("*")->from('app_zones')->order_by('name', 'ASC');
		
		if($this->input->get('zone_id')){
		    $city_id = $this->db->query("SELECT * FROM app_zones where id = '{$_GET['zone_id']}'")->row_array()['city_id'];
		    $this->db->where('city_id', $city_id);
		}
		
		$data['zones'] = $this->db->get()->result_array();
		
        $this->load_admin('settings/add_area',$data);
	}
	
	public function disable_area($id, $zone_id){
	    $this->db->where('id', $id);
	    $this->db->update('app_areas', array('status'=>0));
	    $this->set_message('success', "Area disabled successfully");
		redirect('admin/settings/areas?zone_id='.$zone_id);
        exit();
	}
	
	public function enable_area($id, $zone_id){
	    $this->db->where('id', $id);
	    $this->db->update('app_areas', array('status'=>1));
	    $this->set_message('success', "Area enabled successfully");
		redirect('admin/settings/areas?zone_id='.$zone_id);
        exit();
	}
	


}
