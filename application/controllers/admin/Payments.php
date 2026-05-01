<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends My_controller {
    
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
	
	public function add_payment()
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
                $user_id = $this->input->post('user_id');
                $trx_id = $this->input->post('trx_id');
                $amount = $this->input->post('amount');
                
                
                
                
                
            	
            	
                $data['user_id'] = $user_id;
                $data['trx_id'] = $trx_id;
                $data['amount'] = $amount;
                $data['method'] = 1;
                $data['order_id'] = 0;
                $data['datetime'] = $date;
                
               
                
                
		        $this->db->insert('app_payments', $data);
		        $this->db->query("UPDATE app_users SET balance = balance + '$amount' where id = '$user_id'");
                $this->set_message('success', "Payment has been added successfully.");
                
    		    redirect('admin/payments/add_payment');
        		exit();
	        }
	
	    
		$this->title = "Add Payment || ".$this->admintitle;
		
		$data['view_scripts']=array(
		     $this->Gen->get_admin_url('libs/select2/js/select2.min.js'),
		     $this->Gen->get_admin_url('js/custom/all.js'),
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/select2/css/select2.min.css'),
		);
	    $data['users'] = $this->db->select("*")->from('app_users')->get()->result_array();
		
        $this->load_admin('payments/add_payment',$data);
	}
	
	
	public function list()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if ($this->session->userdata('admin_id') != 1) {
            redirect('admin/home');
            exit();
		}
		
		$this->title = "Payments List || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
	    $data['payments'] = $this->db->select("*")->from('app_payments')->order_by('id', 'desc')->get()->result_array();
		
        $this->load_admin('payments/payment_list',$data);
	}
	
	


}
