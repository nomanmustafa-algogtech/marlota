<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends My_controller {
    
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
		
	    $this->title = "Store List || ".$this->admintitle;
		
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
	    
	    $data['vendors'] = $this->db->select("*")->from('app_vendors')->where('approved', 1)->order_by('id', 'ASC')->get()->result_array();
		
        $this->load_admin('vendors/list',$data);
	}
	
	public function requests(){
	     if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    $this->title = "Store Requests || ".$this->admintitle;
		
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
	    
	    $data['vendors'] = $this->db->select("*")->from('app_vendors')->where(array('approved'=>0, 'deleted'=>0))->order_by('id', 'ASC')->get()->result_array();
		
        $this->load_admin('vendors/requests',$data);
	}
	
	public function approve($id){
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    $this->db->query("UPDATE app_vendors SET approved = '1' where id = '$id'");
	    $this->set_message('success', "Seller account has been approved");
	    redirect('admin/vendors/requests');
    	exit();
	}
	
	public function vendors_products($id){
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	   $this->title = "Products || ".$this->admintitle;
		
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
		  //  $this->Gen->get_admin_url('js/custom/all.js'),
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		);
	    
	   // $data['products'] = $this->db->query("SELECT p.id, s.sku, s.price, p.featured, p.thumbnail_img, p.published, p.category_id, c.name FROM app_product_stocks s, app_products p, app_categories c WHERE  p.vendor_id = $id")->result_array();
		$data['products'] = $this->db->query("SELECT * FROM  app_products WHERE  vendor_id = $id")->result_array();
        $this->load_admin('vendors/products',$data);
	}
	
	public function delete($id){
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    $this->db->query("UPDATE app_vendors SET approved = '0', deleted = '1' where id = '$id'");
	    $this->db->query("UPDATE app_products SET published = '0' where vendor_id = '$id'");
	    $this->set_message('success', "Seller account has been deleted");
	    redirect('admin/vendors');
    	exit();
	}

	
	public function products_approval(){
	     if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    $this->title = "Products Approval || ".$this->admintitle;
		
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
		    $this->Gen->get_admin_url('js/custom/product.js'),
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		);
	    
	    $data['products'] = $this->db->select("*")->from('app_products')->where('approved', 0)->order_by('id', 'ASC')->get()->result_array();
		
        $this->load_admin('vendors/products_approval',$data);
	}
	
	public function approve_product($id){
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    $this->db->query("UPDATE app_products SET approved = '1' where id = '$id'");
	    $this->set_message('success', "Product has been approved and listed to website");
	    redirect('admin/vendors/products_approval');
    	exit();
	}
	
	

}
