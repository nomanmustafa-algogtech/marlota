<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_controller extends CI_Controller
{
    public $title = "";
    
    public $settings;
    
    public $admintitle = "";

    public $Gen;

    public function __construct()
    {
        parent::__construct();
	
        $this->load->database();

        $this->load->helper(array('url','form'));

        $this->load->library(array('session' , 'user_agent', 'General'));

        $this->load->model('Base_model');
        
        $settings = $this->db->select("*")->from('app_settings')->get()->result_array();
	    foreach($settings as $row){
	        $data[$row['name']] = $row['value'];
	    }
	    $this->settings = $data;
        $this->title = $data['meta_title'];
        $this->admintitle = 'Admin - '.$data['site_title'];
        $this->vendortitle = 'Vendor Panel - '.$data['site_title'];
        $this->Gen = new General();
        
        
    }
    
    public function set_message($type, $msg){
        if($type == 'success'){
            $this->session->set_userdata(array('flash_message' => "<div class='alert alert-success'>".$msg."</div>"));
        }else if($type == 'error'){
             $this->session->set_userdata(array('flash_message' => "<div class='alert alert-danger'>".$msg."</div>"));
        }else if($type == 'warning'){
             $this->session->set_userdata(array('flash_message' => "<div class='alert alert-warning'>".$msg."</div>"));
        }
           
    }
    
  

    public function load_web($template,$data=array())
    {
        $data['css'] = array(
    		$this->Gen->get_web_url('vendor/fontawesome-free/css/all.min.css'),
    		$this->Gen->get_web_url('vendor/animate/animate.min.css'),
    		$this->Gen->get_web_url('vendor/magnific-popup/magnific-popup.min.css'),
    		$this->Gen->get_web_url('vendor/swiper/swiper-bundle.min.css'),
    // 		$this->Gen->get_web_url('css/demo1.min.css'),
    		$this->Gen->get_web_url('css/style.min.css'),
		);
        $data['js'] = array(
            $this->Gen->get_web_url('vendor/jquery/jquery.min.js'),
            $this->Gen->get_web_url('vendor/jquery.plugin/jquery.plugin.min.js'),
            $this->Gen->get_web_url('vendor/imagesloaded/imagesloaded.pkgd.min.js'),
            $this->Gen->get_web_url('vendor/zoom/jquery.zoom.js'),
            $this->Gen->get_web_url('vendor/jquery.countdown/jquery.countdown.min.js'),
            $this->Gen->get_web_url('vendor/magnific-popup/jquery.magnific-popup.min.js'),
            $this->Gen->get_web_url('vendor/skrollr/skrollr.min.js'),
            $this->Gen->get_web_url('vendor/swiper/swiper-bundle.min.js'),
			$this->Gen->get_web_url('js/main.min.js')
            
        );
        
        $header = "web/includes/header";
        $footer = "web/includes/footer";

        $this->load->view($header,$data);
        $this->load->view('web/'.$template,$data);
        $this->load->view($footer,$data);
    }
    
    public function load_admin($template,$data=array(), $type='')
    {
        $data['css'] = array(
    		$this->Gen->get_admin_url('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css'),
    		$this->Gen->get_admin_url('css/default/bootstrap.min.css'),
    		$this->Gen->get_admin_url('css/default/app.min.css'),
      // 		$this->Gen->get_admin_url('css/default/bootstrap-dark.min.css'),
      // 		$this->Gen->get_admin_url('css/default/app-dark.min.css'),
    		$this->Gen->get_admin_url('css/icons.min.css')
		);
        $data['js'] = array(
            $this->Gen->get_admin_url('js/vendor.min.js'),
            $this->Gen->get_admin_url('libs/jquery-knob/jquery.knob.min.js'),
            $this->Gen->get_admin_url('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js'),
            $this->Gen->get_admin_url('libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js'),
            // $this->Gen->get_admin_url('js/pages/dashboard-sales.init.js'),
            $this->Gen->get_admin_url('js/app.min.js')
            
        );
        if($type=='login'){
            $header = "admin/includes/header_login";
            $footer = "admin/includes/footer_login";
        }else{
            $header = "admin/includes/header";
            $footer = "admin/includes/footer";
        }
       

        $this->load->view($header,$data);
        $this->load->view('admin/'.$template,$data);
        $this->load->view($footer,$data);
    }
    
    public function load_vendor($template,$data=array(), $type='')
    {
        $data['css'] = array(
    		$this->Gen->get_admin_url('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css'),
    		$this->Gen->get_admin_url('css/default/bootstrap.min.css'),
    		$this->Gen->get_admin_url('css/default/app.min.css'),
      // 		$this->Gen->get_admin_url('css/default/bootstrap-dark.min.css'),
      // 		$this->Gen->get_admin_url('css/default/app-dark.min.css'),
    		$this->Gen->get_admin_url('css/icons.min.css')
		);
        $data['js'] = array(
            $this->Gen->get_admin_url('js/vendor.min.js'),
            $this->Gen->get_admin_url('libs/jquery-knob/jquery.knob.min.js'),
            $this->Gen->get_admin_url('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js'),
            $this->Gen->get_admin_url('libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js'),
            // $this->Gen->get_admin_url('js/pages/dashboard-sales.init.js'),
            $this->Gen->get_admin_url('js/app.min.js')
            
        );
        if($type=='login'){
            $header = "vendors/includes/header_login";
            $footer = "vendors/includes/footer_login";
        }else{
            $header = "vendors/includes/header";
            $footer = "vendors/includes/footer";
        }
       

        $this->load->view($header,$data);
        $this->load->view('vendors/'.$template,$data);
        $this->load->view($footer,$data);
    }
}
