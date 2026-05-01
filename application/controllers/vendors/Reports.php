<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends My_controller {
    
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
    
   
  
	public function visitor_logs()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    $this->title = "Visitor Logs || ".$this->admintitle;
		
		$data['view_scripts']=array(
		    $this->Gen->get_admin_url('libs/select2/js/select2.min.js'),
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
		    $this->Gen->get_admin_url('js/custom/all.js'),
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		);
	    
	    $data['history'] = $this->db->query("SELECT * FROM `app_visitor_logs` GROUP by visitor_id ORDER by id DESC")->result_array();
		
        $this->load_admin('reports/visitor_logs',$data);
	}
	
	

}
