<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends My_controller {
    public $benchmark ;
	public $db;
    public $Base_model;
    public $general;
    public $form_validation;
    public $auth;
    public $CI;
    public $session;
	public $format;
	public $agent ;

    function __construct() {
        parent::__construct();
        
        $this->CI = & get_instance();
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
		$data['view_scripts']=array(
		    'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js',
		);
		$data['view_css']=array();
		// echo 'data: <pre>' .print_r($data,true). '</pre>';
        $this->load_web('home',$data);
	}
	public function privacy_policy()
	{
		$this->title = "Privacy Policy || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
		
		$data['content'] = $this->db->query("SELECT * FROM app_pages where slug = 'privacy_policy'")->row()->content;
	
        $this->load_web('page',$data);
	}
	public function terms_conditions()
	{
		$this->title = "Terms & Conditions";
	
		$data['title'] = $this->title;
		$data['content'] = $this->db->query("SELECT * FROM app_pages where slug = 'terms-and-conditions'")->row()->content;
	echo 'Data: <pre>' .print_r($data,true). '</pre>';
        $this->load_web('page',$data);
	}

	public function shipping_policy()
	{
		$this->title = "Shipping Policy";
	
		$data['title'] = $this->title;
		$data['content'] = $this->db->query("SELECT * FROM app_pages where slug = 'shipping-policy'")->row()->content;
	
        $this->load_web('page',$data);
	}
	
	
	
	
		public function contact()
	{
		$this->title = "Contact || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
		
// 		$data['content'] = $this->db->query("SELECT * FROM app_pages where slug = 'contact'")->row()->content;
	
        $this->load_web('contact',$data);
	}
	
		public function career()
	{
		$this->title = "Career || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
		
// 		$data['content'] = $this->db->query("SELECT * FROM app_pages where slug = 'contact'")->row()->content;
	
        $this->load_web('career',$data);
	}
	
	
		
		public function  about()
	{
		$this->title = "About ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
		
// 		$data['content'] = $this->db->query("SELECT * FROM app_pages where slug = 'contact'")->row()->content;
	
        $this->load_web('about',$data);
	}
	
	
	
	public function ErrorNotFound()
	{
	    $this->output->set_status_header('404');
		$this->title = "404 Not Found || ".$this->title;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
		
        $this->load_web('404_error',$data);
	}
	
// 	public function storeCity(){
// 	    $ids = array('R3780130', 'R357968', 'R358004', 'R80302264', 'R358002', 'R3780131', 'R357988', 'R357981');
// 	    foreach($ids as $cityID){
// 	        $data = file_get_contents("https://member.daraz.pk/locationtree/api/getSubAddressList?countryCode=PK&addressId=".$cityID);
//     	    $data = json_decode($data, true);
//     	    $data = $data['module'];
//     	    foreach($data as $dtRow){
//     	        $id =  $dtRow['id'];
//     	        $name = str_replace("\u0020", " ", $dtRow['name']);
//     	        $name = str_replace("'", "", $name);
    	        
//                 $name = rtrim($name);
//     	        $parentId = $dtRow['parentId'];
    	        
//     	        $check_name =$this->db->query("SELECT * FROM d_cities WHERE name = '$name'");
//     	        if($check_name->num_rows() == 0){
//     	            $this->db->query("INSERT INTO d_cities SET d_id = '$id', name = '$name', parentId = '$parentId'");
//     	        }
//     	    }
// 	    }
	    
// 	    echo "Done";
// 	}
	
// 	public function storeAreas(){
// 	    $getCities = $this->db->query("SELECT * FROM d_cities")->result_array();
// 	    foreach($getCities as $city){
// 	        if (strpos($city['name'], '-') !== false) { 
//                 $name = explode(" - ", $city['name'])[0];
//                 $zone = explode(" - ", $city['name'])[1];
//                 $name = str_replace("'", "", $name);
//                 $zone = str_replace("'", "", $zone);
//                 $name = rtrim($name);
//                 $zone = rtrim($zone);
                
//             }else{
//                 $name = $city['name'];
//                 $zone = "ZONE-1";
//                 $name = str_replace("'", "", $name);
//                 $zone = str_replace("'", "", $zone);
//                 $name = rtrim($name);
//             }
            
//             $check_city = $this->db->query("SELECT * FROM app_cities WHERE name = '$name'");
//             if($check_city->num_rows() > 0){
//                 $mycity = $check_city->row_array();
//                 $check_zone = $this->db->query("SELECT * FROM app_zones WHERE city_id = '{$mycity['id']}' && name = '$zone'");
//                 if($check_zone->num_rows() > 0){
//                     $myzone = $check_zone->row_array();
//                     $zone_id = $myzone['id'];
//                 }else{
//                     $this->db->query("INSERT INTO app_zones SET city_id = '{$mycity['id']}', name = '$zone', status = '1'");
//                     $zone_id = $this->db->insert_id();
//                 }
                
//                 $areas = file_get_contents("https://member.daraz.pk/locationtree/api/getSubAddressList?countryCode=PK&addressId=".$city['d_id']);
//         	    $areas = json_decode($areas, true);
//         	    $areas = $areas['module'];
//         	    if(count($areas) > 0){
//         	        foreach($areas as $dtRow){
//             	        $id =  $dtRow['id'];
//             	        $name = str_replace("\u0020", " ", $dtRow['name']);
//             	        $name = str_replace("'", "", $name);
            	        
//                         $name = rtrim($name);
//             	        $parentId = $dtRow['parentId'];
//             	        if($zone != 'ZONE-1'){
//             	            $name = $zone.' - '.$name;
//             	        }
//             	        $check_name =$this->db->query("SELECT * FROM app_areas WHERE zone_id = '$zone_id' && city_id = '{$mycity['id']}' && name = '$name'");
//             	        if($check_name->num_rows() == 0){
//             	            $this->db->query("INSERT INTO app_areas SET zone_id = '$zone_id', city_id = '{$mycity['id']}', name = '$name', status = '1'");
//             	            echo $mycity['name'].' - '.$zone.' - '.$name.'<br>';
//             	        }
//             	    }
//         	    }
        	    
                
                
//             }
// 	    }
	    
// 	   // echo "<script>
//     //     	    setTimeout(function() {
//     //         window.location.href='https://beaters.pk/web/storeAreas?page_id=$limit';
//     //     }, 2000);</script>";
// 	}
}
