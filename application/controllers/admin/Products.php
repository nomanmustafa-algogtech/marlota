<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends My_controller {

public $Base_model;
public $CI;
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
		
		if($this->input->post()){
		   $product_ids = explode(',', $this->input->post('product_ids'));
		   if(count($product_ids) == 0 || empty($this->input->post('product_ids'))){
		       $this->set_message('error', "Please select atleast 1 product to change status.");
    		    redirect('admin/products/');
            	exit();
		   }
		   
		   $status = $this->input->post('status');
		   
		   foreach($product_ids as $product_id){
		       if($status == 'featured'){
    		       $data['featured'] = 1;
    		   }elseif($status == 'unfeatured'){
    		       $data['featured'] = 0;
    		   }elseif($status == 'published'){
    		       $data['published'] = 1;
    		   }elseif($status == 'unpublished'){
    		       $data['published'] = 0;
    		   }
    		   $this->db->where('id', $product_id);
    		   $this->db->update('app_products', $data);
		   }
		   
		   $this->set_message('success', "Product Status has been changed successfully.");
		    redirect('admin/products/');
        	exit();
		   
		}
		
	    $this->title = "Products || ".$this->admintitle;
		
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
	    
	    $data['products'] = $this->db->query("SELECT p.id, s.sku, s.price, p.featured, p.thumbnail_img, p.published, p.category_id, c.name FROM app_product_stocks s, app_products p, app_categories c WHERE p.id = s.product_id && c.id = p.category_id && p.vendor_id = '0' Order by p.id asc")->result_array();
		
        $this->load_admin('products/products',$data);
	}
	
	
	
	public function attributes()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if($this->input->post()){
		    $data['name'] = $this->input->post('name');
		    $data['created_date']   =   date('Y-m-d H:i:s');
		    
		    $check_name = $this->db->select('*')->from('app_attributes')->where(array('name'=>$data['name'], 'vendor_id'=>0))->get()->num_rows();
		    if($check_name > 0){
		        $this->set_message('error', "Attribute name already exists.");
    		    redirect('admin/products/attributes');
            	exit();
		    }
		    $this->db->insert('app_attributes', $data);
		    $this->set_message('success', "Attribute added successfully.");
		    redirect('admin/products/attributes');
        	exit();
		}
		
		$this->title = "Attributes || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
	    $data['attributes'] = $this->db->select("*")->from('app_attributes')->where(array('vendor_id'=>0))->order_by('name', 'ASC')->get()->result_array();
		
        $this->load_admin('products/attributes',$data);
	}
	
	public function attribute_delete($type, $id){
	    
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
	    
	  if ($type == 'name') {
			// First delete related product stocks
			$this->db->delete('app_product_stocks', array('attribute_id' => $id));
			
			// Then delete related attribute values
			$this->db->delete('app_attribute_values', array('attribute_id' => $id));
			
			// Finally delete the attribute itself
			$this->db->delete('app_attributes', array('id' => $id));

			$this->set_message('success', "Attribute deleted successfully.");
			redirect('admin/products/attributes');
			exit();
		}else if($type == 'value'){
	        $this->db->delete('app_attribute_values', array('id' => $id));
	        $this->set_message('success', "Attribute Value deleted successfully.");
		    redirect('admin/products/attribute_values/'.$_GET['att_id']);
        	exit();
	    }
	}
	
	public function attribute_edit($type, $id){
	    
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    if($type == 'name'){
	        
	        if($this->input->post()){
	            $data['name'] = $this->input->post('name');
	            
	            $check_name = $this->db->select('*')->from('app_attributes')->where(array('name'=>$data['name'], 'id!='=>$id, 'vendor_id'=>0))->get()->num_rows();
    		    if($check_name > 0){
    		        $this->set_message('error', "Attribute name already exists.");
        		    redirect("admin/products/attribute_edit/$type/$id");
                	exit();
    		    }
    		    $this->db->where('id', $id);
    		    $this->db->update('app_attributes', $data);
    		    $this->set_message('success', "Attribute updated successfully.");
    		    redirect('admin/products/attributes');
            	exit();
	        }
	        
	        
	        $this->title = "Edit Attribute || ".$this->admintitle;
		
    		$data['view_scripts']=array();
    		$data['view_css']=array();
    	    
    	    $data['attribute'] = $this->db->select("*")->from('app_attributes')->where(array('id'=>$id, 'vendor_id'=>0))->order_by('name', 'ASC')->get()->row_array();
    		
            $this->load_admin('products/edit_attribute',$data);
            
	    }else if($type == 'value'){
	         
	        if($this->input->post()){
	            $data['value'] = $this->input->post('value');
	            $attribute_id = $this->input->post('att_id');
	            $check_value = $this->db->select('*')->from('app_attribute_values')->where(array('value'=> $data['value'], 'attribute_id'=>$attribute_id, 'id!='=>$id))->get()->num_rows();
    		    if($check_value > 0){
    		        $this->set_message('error', "Attribute value already exists.");
        		    redirect("admin/products/attribute_edit/$type/$id");
                	exit();
    		    }
    		    $this->db->where('id', $id);
    		    $this->db->update('app_attribute_values', $data);
    		    $this->set_message('success', "Attribute value updated successfully.");
    		    redirect('admin/products/attribute_values/'.$attribute_id);
            	exit();
	        }
	        
	        
	        $this->title = "Edit Attribute Value || ".$this->admintitle;
		
    		$data['view_scripts']=array();
    		$data['view_css']=array();
    	    
    	    
    	    $data['attribute_value'] = $this->db->select("*")->from('app_attribute_values')->where('id', $id)->order_by('value', 'ASC')->get()->row_array();
    	    $data['attribute'] = $this->db->select("*")->from('app_attributes')->where(array('id'=>$data['attribute_value']['attribute_id'], 'vendor_id'=>0))->order_by('name', 'ASC')->get()->row_array();
    		
            $this->load_admin('products/edit_attribute_value',$data);
	    }
	}
	
// 	public function attribute_values($id = 0){
	    
// 	    if (!$this->auth->is_logged()) {
//             redirect('admin/authentication');
//             exit();
// 		}
		
// 	    $attribute = $this->db->select("*")->from('app_attributes')->where('id', $id)->get();
// 	    if($attribute->num_rows() < 1){
// 	        redirect('admin/products/attributes');
//             exit();
// 	    }
	    
	    
// 	    if($this->input->post()){
// 	        $data['attribute_id'] = $id;
// 		    $data['value'] = $this->input->post('value');
// 		    $data['created_date']   =   date('Y-m-d H:i:s');
		    
// 		    $check_value = $this->db->select('*')->from('app_attribute_values')->where(array('value'=> $data['value'], 'attribute_id'=>$data['attribute_id']))->get()->num_rows();
// 		    if($check_value > 0){
// 		        $this->set_message('error', "Attribute value already exists.");
//     		    redirect('admin/products/attribute_values/'.$id);
//             	exit();
// 		    }
// 		    $this->db->insert('app_attribute_values', $data);
// 		    $this->set_message('success', "Attribute value added successfully.");
// 		     redirect('admin/products/attribute_values/'.$id);
//         	exit();
// 		}
	    
// 	    $this->title = "Attribute Values || ".$this->admintitle;
		
// 		$data['view_scripts']=array();
// 		$data['view_css']=array();
		
// 	    $data['attribute'] = $attribute->row_array();
// 	    $data['attribute_values'] = $this->db->select("*")->from('app_attribute_values')->where('attribute_id', $id)->order_by('value', 'ASC')->get()->result_array();
		
//         $this->load_admin('products/attribute_values',$data);
	    
	    
	    
// 	}
// new code on replacement
public function attribute_values($id = 0) {
    if (!$this->auth->is_logged()) {
        redirect('admin/authentication');
        exit();
    }

    $attribute = $this->db->select("*")->from('app_attributes')->where('id', $id)->get();
    if ($attribute->num_rows() < 1) {
        redirect('admin/products/attributes');
        exit();
    }

    if ($this->input->post()) {
        $data['attribute_id'] = $id;
        $data['value'] = $this->input->post('value');
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['product_id'] = NULL; // Or set to default value if applicable

        // Insert the data with NULL product_id or default value
        $this->db->insert('app_attribute_values', $data);

        $this->set_message('success', "Attribute value added successfully.");
        redirect('admin/products/attribute_values/' . $id);
        exit();
    }

    $this->title = "Attribute Values || " . $this->admintitle;

    $data['view_scripts'] = array();
    $data['view_css'] = array();

    $data['attribute'] = $attribute->row_array();
    $data['attribute_values'] = $this->db->select("*")->from('app_attribute_values')->where('attribute_id', $id)->order_by('value', 'ASC')->get()->result_array();

    $this->load_admin('products/attribute_values', $data);
}




	
	public function brands()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		if($this->input->post()){
		    $data['name'] = $this->input->post('name');
		    $data['meta_title'] = $this->input->post('meta_title');
		    $data['meta_description'] = $this->input->post('meta_description');
		    $data['created_date']   =   date('Y-m-d H:i:s');
		    
		    $check_name = $this->db->select('*')->from('app_brands')->where('name', $data['name'])->get()->num_rows();
		    if($check_name > 0){
		        $this->set_message('error', "Brand name already exists.");
    		    redirect('admin/products/brands');
            	exit();
		    }
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    
		    if(file_exists($_FILES['logo']['tmp_name']) && is_uploaded_file($_FILES['logo']['tmp_name'])){
                $imt = str_replace(' ', '-', $this->input->post('name'));
            	if($_FILES['logo']["type"] == "image/jpeg" || $_FILES['logo']["type"] == "image/JPEG"){

                    $img = $imt.'_'.$timestamp . '.jpeg';
                
                }else if($_FILES['logo']["type"] == "image/png" || $_FILES['logo']["type"] == "image/PNG"){
                
                    $img = $imt.'_'.$timestamp . '.png';
                
                }else if($_FILES['logo']["type"] == "image/jpg" || $_FILES['logo']["type"] == "image/JPG"){
            
                    $img = $imt.'_'.$timestamp . '.jpg';
                    
                }else if($_FILES['logo']["type"] == "image/gif" || $_FILES['logo']["type"] == "image/GIF"){
            
                    $img = $imt.'_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "File upload type is not supported");
            		redirect('admin/products/brands');
            		exit();
            	}
            	
            	$target = "uploads/brands/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['logo']['tmp_name'], $target);
                $data['logo'] = $img;
            }
		    $this->db->insert('app_brands', $data);
		    $this->set_message('success', "Brand added successfully.");
		    redirect('admin/products/brands');
        	exit();
		}
		
		$this->title = "Brands || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
	    $data['brands'] = $this->db->select("*")->from('app_brands')->order_by('name', 'ASC')->get()->result_array();
		
        $this->load_admin('products/brands',$data);
	}
	
	public function edit_brand($id)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		if($this->input->post()){
		    $data['name'] = $this->input->post('name');
		    $data['meta_title'] = $this->input->post('meta_title');
		    $data['meta_description'] = $this->input->post('meta_description');
		    
		    $check_name = $this->db->select('*')->from('app_brands')->where(array('name', $data['name'], 'id<>'=>$id))->get()->num_rows();
		    if($check_name > 0){
		        $this->set_message('error', "Brand name already exists.");
    		    redirect('admin/products/edit_brand/'.$id);
            	exit();
		    }
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    
		    if(file_exists($_FILES['logo']['tmp_name']) && is_uploaded_file($_FILES['logo']['tmp_name'])){
                $imt = str_replace(' ', '-', $this->input->post('name'));
            	if($_FILES['logo']["type"] == "image/jpeg" || $_FILES['logo']["type"] == "image/JPEG"){

                    $img = $imt.'_'.$timestamp . '.jpeg';
                
                }else if($_FILES['logo']["type"] == "image/png" || $_FILES['logo']["type"] == "image/PNG"){
                
                    $img = $imt.'_'.$timestamp . '.png';
                
                }else if($_FILES['logo']["type"] == "image/jpg" || $_FILES['logo']["type"] == "image/JPG"){
            
                    $img = $imt.'_'.$timestamp . '.jpg';
                    
                }else if($_FILES['logo']["type"] == "image/gif" || $_FILES['logo']["type"] == "image/GIF"){
            
                    $img = $imt.'_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "File upload type is not supported");
            	    redirect('admin/products/edit_brand/'.$id);
            		exit();
            	}
            	
            	$target = "uploads/brands/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['logo']['tmp_name'], $target);
                $data['logo'] = $img;
            }
            $this->db->where('id', $id);
		    $this->db->update('app_brands', $data);
		    $this->set_message('success', "Brand updated successfully.");
		    redirect('admin/products/brands');
        	exit();
		}
		
		$this->title = "Edit Brand || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
	    $data['brand'] = $this->db->select("*")->from('app_brands')->where('id', $id)->get()->row_array();
		
        $this->load_admin('products/edit_brand',$data);
	}
	
	public function brand_delete($id){
	    
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
	  
        $this->db->delete('app_brands', array('id' => $id));
        $this->set_message('success', "Brand deleted successfully.");
	    redirect('admin/products/brands');
    	exit();
	    
	}
	
	public function suppliers()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		if($this->input->post()){
		    $data['name'] = $this->input->post('name');
		    $data['phone'] = $this->input->post('phone');
		    $data['email'] = $this->input->post('email');
		    
		    $check_name = $this->db->select('*')->from('app_suppliers')->where('name', $data['name'])->get()->num_rows();
		    if($check_name > 0){
		        $this->set_message('error', "Supplier name already exists.");
    		    redirect('admin/products/suppliers');
            	exit();
		    }
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    
		    if(file_exists($_FILES['logo']['tmp_name']) && is_uploaded_file($_FILES['logo']['tmp_name'])){
                $imt = str_replace(' ', '-', $this->input->post('name'));
            	if($_FILES['logo']["type"] == "image/jpeg" || $_FILES['logo']["type"] == "image/JPEG"){

                    $img = $imt.'_'.$timestamp . '.jpeg';
                
                }else if($_FILES['logo']["type"] == "image/png" || $_FILES['logo']["type"] == "image/PNG"){
                
                    $img = $imt.'_'.$timestamp . '.png';
                
                }else if($_FILES['logo']["type"] == "image/jpg" || $_FILES['logo']["type"] == "image/JPG"){
            
                    $img = $imt.'_'.$timestamp . '.jpg';
                    
                }else if($_FILES['logo']["type"] == "image/gif" || $_FILES['logo']["type"] == "image/GIF"){
            
                    $img = $imt.'_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "File upload type is not supported");
            		redirect('admin/products/suppliers');
            		exit();
            	}
            	
            	$target = "uploads/suppliers/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['logo']['tmp_name'], $target);
                $data['logo'] = $img;
            }
		    $this->db->insert('app_suppliers', $data);
		    $this->set_message('success', "Supplier added successfully.");
		    redirect('admin/products/suppliers');
        	exit();
		}
		
		$this->title = "Suppliers || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
	    $data['suppliers'] = $this->db->select("*")->from('app_suppliers')->order_by('name', 'ASC')->get()->result_array();
		
        $this->load_admin('products/suppliers',$data);
	}
	
	public function edit_supplier($id)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		if($this->input->post()){
		    $data['name'] = $this->input->post('name');
		    $data['phone'] = $this->input->post('phone');
		    $data['email'] = $this->input->post('email');
		    
		    $check_name = $this->db->select('*')->from('app_suppliers')->where(array('name', $data['name'], 'id<>'=>$id))->get()->num_rows();
		    if($check_name > 0){
		        $this->set_message('error', "Supplier name already exists.");
    		    redirect('admin/products/edit_supplier/'.$id);
            	exit();
		    }
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    
		    if(file_exists($_FILES['logo']['tmp_name']) && is_uploaded_file($_FILES['logo']['tmp_name'])){
                $imt = str_replace(' ', '-', $this->input->post('name'));
            	if($_FILES['logo']["type"] == "image/jpeg" || $_FILES['logo']["type"] == "image/JPEG"){

                    $img = $imt.'_'.$timestamp . '.jpeg';
                
                }else if($_FILES['logo']["type"] == "image/png" || $_FILES['logo']["type"] == "image/PNG"){
                
                    $img = $imt.'_'.$timestamp . '.png';
                
                }else if($_FILES['logo']["type"] == "image/jpg" || $_FILES['logo']["type"] == "image/JPG"){
            
                    $img = $imt.'_'.$timestamp . '.jpg';
                    
                }else if($_FILES['logo']["type"] == "image/gif" || $_FILES['logo']["type"] == "image/GIF"){
            
                    $img = $imt.'_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "File upload type is not supported");
            	    redirect('admin/products/edit_supplier/'.$id);
            		exit();
            	}
            	
            	$target = "uploads/suppliers/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['logo']['tmp_name'], $target);
                $data['logo'] = $img;
            }
            $this->db->where('id', $id);
		    $this->db->update('app_suppliers', $data);
		    $this->set_message('success', "Supplier updated successfully.");
		    redirect('admin/products/suppliers');
        	exit();
		}
		
		$this->title = "Edit Supplier || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	    
	    $data['supplier'] = $this->db->select("*")->from('app_suppliers')->where('id', $id)->get()->row_array();
		
        $this->load_admin('products/edit_supplier',$data);
	}
	
	public function supplier_delete($id){
	    
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
	  
        $this->db->delete('app_suppliers', array('id' => $id));
        $this->set_message('success', "Supplier deleted successfully.");
	    redirect('admin/products/suppliers');
    	exit();
	    
	}
	
	
	public function categories()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		if($this->input->post()){
		    $data['parent_id'] = $this->input->post('parent_id');
		    if($data['parent_id']!=0){
		        $data['level'] = $this->db->select('level')->from('app_categories')->where('id', $this->input->post('parent_id'))->get()->row()->level+1;
		    }
		    
		    $data['name'] = $this->input->post('name');
		    $data['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($this->input->post('slug'))));
		    $data['meta_title'] = $this->input->post('meta_title');
		    $data['meta_description'] = $this->input->post('meta_description');
		    
		    $check_name = $this->db->select('*')->from('app_categories')->where('name', $data['name'])->get()->num_rows();
		    if($check_name > 0){
		        $this->set_message('error', "Category name already exists.");
    		    redirect('admin/products/categories');
            	exit();
		    }
		    
		    $check_slug = $this->db->select('*')->from('app_categories')->where('slug', $data['slug'])->get()->num_rows();
		    if($check_slug > 0){
		        $this->set_message('error', "Slug already Exists already exists.");
    		    redirect('admin/products/categories');
            	exit();
		    }
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    
		    if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
                $imt = 'category';
            	if($_FILES['image']["type"] == "image/jpeg" || $_FILES['image']["type"] == "image/JPEG"){

                    $img = $imt.'_image_'.$timestamp . '.jpeg';
                
                }else if($_FILES['image']["type"] == "image/png" || $_FILES['image']["type"] == "image/PNG"){
                
                    $img = $imt.'_image_'.$timestamp . '.png';
                
                }else if($_FILES['image']["type"] == "image/jpg" || $_FILES['image']["type"] == "image/JPG"){
            
                    $img = $imt.'_image_'.$timestamp . '.jpg';
                    
                }else if($_FILES['image']["type"] == "image/gif" || $_FILES['image']["type"] == "image/GIF"){
            
                    $img = $imt.'_image_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "Image File upload type is not supported");
            		redirect('admin/products/categories');
            		exit();
            	}
            	
            	$target = "uploads/categories/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $data['image'] = $img;
            }
            
            if(file_exists($_FILES['icon']['tmp_name']) && is_uploaded_file($_FILES['icon']['tmp_name'])){
                $imt = str_replace(' ', '-', $this->input->post('name'));
            	if($_FILES['icon']["type"] == "image/jpeg" || $_FILES['icon']["type"] == "image/JPEG"){

                    $img = $imt.'_icon_'.$timestamp . '.jpeg';
                
                }else if($_FILES['icon']["type"] == "image/png" || $_FILES['icon']["type"] == "image/PNG"){
                
                    $img = $imt.'_icon_'.$timestamp . '.png';
                
                }else if($_FILES['icon']["type"] == "image/jpg" || $_FILES['icon']["type"] == "image/JPG"){
            
                    $img = $imt.'_icon_'.$timestamp . '.jpg';
                    
                }else if($_FILES['icon']["type"] == "image/gif" || $_FILES['icon']["type"] == "image/GIF"){
            
                    $img = $imt.'_icon_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "Icon File upload type is not supported");
            		redirect('admin/products/categories');
            		exit();
            	}
            	
            	$target = "uploads/categories/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['icon']['tmp_name'], $target);
                $data['icon'] = $img;
            }
		    $this->db->insert('app_categories', $data);
		    $this->set_message('success', "Category added successfully.");
		    redirect('admin/products/categories');
        	exit();
		}
		
		$this->title = "Categories || ".$this->admintitle;
		
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
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		);
	    
	    if(isset($_GET['parent_id'])){
	        $data['category_name'] = $this->db->query("SELECT * FROM app_categories where id = '{$_GET['parent_id']}'")->row()->name;
	        $data['categories'] = $this->db->select("*")->from('app_categories')->where('parent_id', $_GET['parent_id'])->order_by('name', 'ASC')->get()->result_array();
	    }else{
	        $data['categories'] = $this->db->select("*")->from('app_categories')->where('level', 0)->order_by('name', 'ASC')->get()->result_array();
	    }
	    
		
        $this->load_admin('products/categories',$data);
	}
	
	public function edit_category($id)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		
		
		if($this->input->post()){
		    $data['parent_id'] = $this->input->post('parent_id');
		    if($data['parent_id']!=0){
		        $data['level'] = $this->db->select('level')->from('app_categories')->where('id', $this->input->post('parent_id'))->get()->row()->level+1;
		    }
		    
		    $data['name'] = $this->input->post('name');
		    $data['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($this->input->post('slug'))));
		    $data['meta_title'] = $this->input->post('meta_title');
		    $data['meta_description'] = $this->input->post('meta_description');
		    
		    $check_name = $this->db->select('*')->from('app_categories')->where(array('name'=>$data['name'], 'id!='=>$id))->get()->num_rows();
		    if($check_name > 0){
		        $this->set_message('error', "Category name already exists.");
    		    redirect('admin/products/edit_category/'.$id);
            	exit();
		    }
		    
		    $check_slug = $this->db->select('*')->from('app_categories')->where(array('slug'=>$data['slug'], 'id!='=> $id))->get()->num_rows();
		    if($check_slug > 0){
		        $this->set_message('error', "Slug already Exists already exists.");
    		    redirect('admin/products/edit_category/'.$id);
            	exit();
		    }
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    
		    if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
                $imt = 'category';
            	if($_FILES['image']["type"] == "image/jpeg" || $_FILES['image']["type"] == "image/JPEG"){

                    $img = $imt.'_image_'.$timestamp . '.jpeg';
                
                }else if($_FILES['image']["type"] == "image/png" || $_FILES['image']["type"] == "image/PNG"){
                
                    $img = $imt.'_image_'.$timestamp . '.png';
                
                }else if($_FILES['image']["type"] == "image/jpg" || $_FILES['image']["type"] == "image/JPG"){
            
                    $img = $imt.'_image_'.$timestamp . '.jpg';
                    
                }else if($_FILES['image']["type"] == "image/gif" || $_FILES['image']["type"] == "image/GIF"){
            
                    $img = $imt.'_image_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "Image File upload type is not supported");
            		 redirect('admin/products/edit_category/'.$id);
            		exit();
            	}
            	
            	$target = "uploads/categories/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $data['image'] = $img;
            }
            
            if(file_exists($_FILES['icon']['tmp_name']) && is_uploaded_file($_FILES['icon']['tmp_name'])){
                $imt = str_replace(' ', '-', $this->input->post('name'));
            	if($_FILES['icon']["type"] == "image/jpeg" || $_FILES['icon']["type"] == "image/JPEG"){

                    $img = $imt.'_icon_'.$timestamp . '.jpeg';
                
                }else if($_FILES['icon']["type"] == "image/png" || $_FILES['icon']["type"] == "image/PNG"){
                
                    $img = $imt.'_icon_'.$timestamp . '.png';
                
                }else if($_FILES['icon']["type"] == "image/jpg" || $_FILES['icon']["type"] == "image/JPG"){
            
                    $img = $imt.'_icon_'.$timestamp . '.jpg';
                    
                }else if($_FILES['icon']["type"] == "image/gif" || $_FILES['icon']["type"] == "image/GIF"){
            
                    $img = $imt.'_icon_'.$timestamp . '.gif';
                    
                }else{
                    $this->set_message('error', "Icon File upload type is not supported");
            		 redirect('admin/products/edit_category/'.$id);
            		exit();
            	}
            	
            	$target = "uploads/categories/"; 
                $target = $target . basename($img); 
                move_uploaded_file($_FILES['icon']['tmp_name'], $target);
                $data['icon'] = $img;
            }
            $this->db->where('id', $id);
		    $this->db->update('app_categories', $data);
		    $this->set_message('success', "Category updated successfully.");
		    redirect('admin/products/categories');
        	exit();
		}
		
		$this->title = "Categories || ".$this->admintitle;
		
		$data['view_scripts']=array();
		$data['view_css']=array();
	   
	    $data['category'] = $this->db->select("*")->from('app_categories')->where('id', $id)->order_by('name', 'ASC')->get()->row_array();
	    $data['categories'] = $this->db->select("*")->from('app_categories')->where('id!=', $data['category']['id'])->order_by('name', 'ASC')->get()->result_array();
		
        $this->load_admin('products/edit_category',$data);
	}
	
	public function category_delete($id){
	    
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    $query = "SELECT * FROM app_products where category_id = '$id'";
	     $subcat = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '$id'")->result_array();
	        foreach($subcat as $cat1){
	            $query .= " || category_id = '{$cat1['id']}'";
	            $subcat1 = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '{$cat1['id']}'")->result_array();
    	        foreach($subcat1 as $cat2){
    	            $query .= " || category_id = '{$cat2['id']}'";
    	        }
	        }
	    $count_products = $this->db->query($query)->num_rows();
	    if($count_products > 0){
	        $this->set_message('error', "Products listed in this category or sub category. Please change product category before deletion");
    	    redirect('admin/products/categories');
        	exit();
	    }
	    
	    $subcat = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '$id'")->result_array();
        foreach($subcat as $cat1){
            
            $subcat1 = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '{$cat1['id']}'")->result_array();
	        foreach($subcat1 as $cat2){
	            $this->db->delete('app_categories', array('id' => $cat2['id']));
	        }
	        
	        $this->db->delete('app_categories', array('id' => $cat1['id']));
        }
	    
	    
        $this->db->delete('app_categories', array('id' => $id));
        $this->set_message('success', "Category deleted successfully.");
	    redirect('admin/products/categories');
    	exit();
	    
	}
	
	public function add_new()
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		if($this->input->post()){
		    $dataProduct['name'] = $this->input->post('name');
		    $dataProduct['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($this->input->post('name')))).'-'.$this->Base_model->randomString(8).'-'.$this->Base_model->randomString(8);
		    
		    $check_slug = $this->db->select('*')->from('app_products')->where('slug', $dataProduct['slug'])->get()->num_rows();
		    if($check_slug > 0){
		        $this->set_message('error', "Slug already Exists.");
    		    redirect('admin/products/add_new');
            	exit();
		    }
		    
		    $dataProduct['user_id'] = $this->session->userdata('admin_id');
		    $dataProduct['brand_id'] = $this->input->post('brand_id');
		    $dataProduct['category_id'] = $this->input->post('category_id');
		    $dataProduct['supplier_id'] = $this->input->post('supplier_id');
		    $dataProduct['tags'] = $this->input->post('tags');
		    $dataProduct['description'] = $this->input->post('description');
		    $dataProduct['unit_price'] = $this->input->post('unit_price');
		    $dataProduct['published'] = $this->input->post('published');
		    $dataProduct['featured'] = $this->input->post('featured');
		       $dataProduct['bestseller'] = $this->input->post('bestseller');
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    $imt = 'product';
		    if(file_exists($_FILES['thumbnail']['tmp_name']) && is_uploaded_file($_FILES['thumbnail']['tmp_name'])){
                
            	if($_FILES['thumbnail']["type"] == "image/jpeg" || $_FILES['thumbnail']["type"] == "image/JPEG"){

                    $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
                
                }else if($_FILES['thumbnail']["type"] == "image/png" || $_FILES['thumbnail']["type"] == "image/PNG"){
                
                    $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
                
                }else if($_FILES['thumbnail']["type"] == "image/jpg" || $_FILES['thumbnail']["type"] == "image/JPG"){
            
                    $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
                    
                }else if($_FILES['thumbnail']["type"] == "image/gif" || $_FILES['thumbnail']["type"] == "image/GIF"){
            
                    $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
                    
                }else{
                    $this->set_message('error', "Thumbnail File upload type is not supported");
            		redirect('admin/products/add_new');
            		exit();
            	}
            	
            	$img_uploaded = $this->Base_model->resize_img($_FILES['thumbnail']['tmp_name'], "uploads/products/".$img);
            	if($img_uploaded){
                    $dataProduct['thumbnail_img'] = $img;
                }else{
                    $this->set_message('error', "Thumbnail Image file is invalid.");
            		redirect('admin/products/add_new');
            		exit();
                }
                
            }
            $gphotos = '';
            $extension=array("jpeg","jpg","png","gif");
            foreach($_FILES["gallery_images"]["tmp_name"] as $key=>$tmp_name) {
                $file_name=$_FILES["gallery_images"]["name"][$key];
                $file_tmp=$_FILES["gallery_images"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);
            
                if(in_array($ext,$extension)) {
                        $img_file_name = $imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg';
                        // $filename=basename($img_file_name);
                        // move_uploaded_file($file_tmp=$_FILES["gallery_images"]["tmp_name"][$key],'uploads/products/'.$filename);
                        $img_uploaded = $this->Base_model->resize_img($file_tmp, "uploads/products/".$img_file_name);
                        if($img_uploaded){
                            $gphotos .= $img_file_name.',';
                        }
                }
            }
            $dataProduct['photos'] = rtrim($gphotos, ',');
            
            $dataProduct['shipping_cost'] = $this->input->post('shipping_cost');
            $dataProduct['discount'] = $this->input->post('discount');
            $dataProduct['meta_title'] =$this->input->post('meta_title');
            $dataProduct['meta_description'] = $this->input->post('meta_description');
            
            
            $choice_options = array();

            if($this->input->post('choice_no')){
                foreach ($this->input->post('choice_no') as $key => $no) {
                    $str = 'choice_options_'.$no;
    
                    $item['attribute_id'] = $no;
    
                    $data = array();
                    // foreach (json_decode($request[$str][0]) as $key => $eachValue) {
                    if($this->input->post($str)){
                        foreach ($this->input->post($str) as $key => $eachValue) {
                            // array_push($data, $eachValue->value);
                            array_push($data, $eachValue);
                        }
                    }
                    
    
                    $item['values'] = $data;
                    array_push($choice_options, $item);
                }
            }
    
            if (!empty($this->input->post('choice_no'))) {
                $dataProduct['attributes'] = json_encode($this->input->post('choice_no'));
            }
            else {
                $dataProduct['attributes'] = json_encode(array());
            }
    
            $dataProduct['choice_options']= json_encode($choice_options, JSON_UNESCAPED_UNICODE);
		    
		    $this->db->insert('app_products', $dataProduct);
		    $product_id = $this->db->insert_id();
		    
		    $options = array();
            
    
            if($this->input->post('choice_no')){
                foreach ($this->input->post('choice_no') as $key => $no) {
                    $name = 'choice_options_'.$no;
                    $data = array();
                    if($this->input->post($name)){
                        foreach ($this->input->post($name) as $key => $eachValue) {
                            array_push($data, $eachValue);
                        }
                    }
                    
                    array_push($options, $data);
                }
            }
            
            $result = array(array());
            foreach ($options as $property => $property_values) {
                $tmp = array();
                foreach ($result as $result_item) {
                    foreach ($property_values as $property_value) {
                        $tmp[] = array_merge($result_item, array($property => $property_value));
                    }
                }
                $result = $tmp;
            }
            $combinations =  $result;
            
            if(count($combinations) > 0) { if(count($combinations[0]) > 0){
                $this->db->update('app_products', array('variant_product'=>1), "id = $product_id");
                foreach ($combinations as $key => $combination){
                    $str = '';
                    foreach ($combination as $key => $item){
                        if($key > 0 ){
                            $str .= '-'.str_replace(' ', '', $item);
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                    
                    
                    $product_stock['product_id'] = $product_id;
                    $product_stock['attribute_id'] = $this->input->post('choice_attributes')[0];
                    $product_stock['variant'] = $str;
                    $product_stock['price']= $this->input->post('price_'.str_replace('.', '_', $str));
                    $product_stock['sku'] = $this->input->post('sku_'.str_replace('.', '_', $str));
                    $product_stock['qty'] = $this->input->post('qty_'.str_replace('.', '_', $str));
                    $product_stock['discount'] = $this->input->post('discount_'.str_replace('.', '_', $str));
                    
                    
                    
                    $imt = 'product';
                    $imgpost = 'img_'.str_replace('.', '_', $str);
        		    if(file_exists($_FILES[$imgpost]['tmp_name']) && is_uploaded_file($_FILES[$imgpost]['tmp_name'])){
                        
                    	if($_FILES[$imgpost]["type"] == "image/jpeg" || $_FILES[$imgpost]["type"] == "image/JPEG"){
        
                            $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                            $img_uploaded = $this->Base_model->resize_img($_FILES[$imgpost]['tmp_name'], "uploads/products/".$img);
                            if($img_uploaded){
                                $product_stock['image'] = $img;
                            }
                        
                        }else if($_FILES[$imgpost]["type"] == "image/png" || $_FILES[$imgpost]["type"] == "image/PNG"){
                        
                            $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                            $img_uploaded = $this->Base_model->resize_img($_FILES[$imgpost]['tmp_name'], "uploads/products/".$img);
                            if($img_uploaded){
                                $product_stock['image'] = $img;
                            }
                        
                        }else if($_FILES[$imgpost]["type"] == "image/jpg" || $_FILES[$imgpost]["type"] == "image/JPG"){
                    
                            $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                            $img_uploaded = $this->Base_model->resize_img($_FILES[$imgpost]['tmp_name'], "uploads/products/".$img);
                            if($img_uploaded){
                                $product_stock['image'] = $img;
                            }
                            
                        }else if($_FILES[$imgpost]["type"] == "image/gif" || $_FILES[$imgpost]["type"] == "image/GIF"){
                    
                            $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                            $img_uploaded = $this->Base_model->resize_img($_FILES[$imgpost]['tmp_name'], "uploads/products/".$img);
                            if($img_uploaded){
                                $product_stock['image'] = $img;
                            }
                            
                        }
                    	
                    	
                    }
                    
                    $this->db->insert('app_product_stocks', $product_stock);
                }
            }else{
                
                $product_stock['product_id'] = $product_id;
                $product_stock['attribute_id'] = $this->input->post('choice_attributes')[0];
                $product_stock['variant'] = '';
                $product_stock['price']= $this->input->post('unit_price');
                $product_stock['sku'] = $this->input->post('sku');
                $product_stock['qty'] = $this->input->post('qty');
                $product_stock['discount'] = $this->input->post('discount');
                $this->db->insert('app_product_stocks', $product_stock);
                
            }}
            else{
                $product_stock['product_id'] = $product_id;
                $product_stock['attribute_id'] = $this->input->post('choice_attributes')[0];
                $product_stock['variant'] = '';
                $product_stock['price']= $this->input->post('unit_price');
                $product_stock['sku'] = $this->input->post('sku');
                $product_stock['qty'] = $this->input->post('qty');
                $product_stock['discount'] = $this->input->post('discount');
                $this->db->insert('app_product_stocks', $product_stock);
            }
            
            $this->set_message('success', "Product has been created successfully.");
    	    redirect('admin/products/add_new');
        	exit();
		    
		}
		
		
		$this->title = "Add New Product || ".$this->admintitle;
		
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
		     $this->Gen->get_admin_url('js/tagsinput.js'),
		     $this->Gen->get_admin_url('js/custom/all.js'),
		     $this->Gen->get_admin_url('js/custom/product.js'),
		     
		);
		$data['view_css']=array(
		    $this->Gen->get_admin_url('libs/select2/css/select2.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css'),
		    $this->Gen->get_admin_url('css/tagsinput.css'),
		    $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.snow.css'),
		);
	    
	    $data['categories'] = $this->db->select("*")->from('app_categories')->order_by('name', 'ASC')->get()->result_array();
	    $data['brands'] = $this->db->select("*")->from('app_brands')->order_by('name', 'ASC')->get()->result_array();
	    $data['suppliers'] = $this->db->select("*")->from('app_suppliers')->order_by('name', 'ASC')->get()->result_array();
	    $data['attributes'] = $this->db->select("*")->from('app_attributes')->order_by('name', 'ASC')->get()->result_array();
		
        $this->load_admin('products/add_new',$data);
	}
	
	
	
	
	public function get_more_choice_option(){
	    $attr_id = $this->input->post('attribute_id');
	    $attribute_values = $this->db->select("*")->from('app_attribute_values')->where('attribute_id',$attr_id)->order_by('value', 'ASC')->get()->result_array();
	    $options = '';
	    foreach($attribute_values as $row){
	        $options .= '<option value="'.$row['value'].'">'.$row['value'].'</option>';
	    }
	    echo json_encode($options);
	    exit();
	}
	
	public function get_more_edit_choice_option(){
	    $attr_id = $this->input->post('attribute_id');
	    $product_id = $this->input->post('product_id');
	    $productData = $this->db->query("SELECT * FROM app_products WHERE id = '$product_id'")->row_array();
	    
	    $attribute_values = $this->db->select("*")->from('app_attribute_values')->where('attribute_id',$attr_id)->order_by('value', 'ASC')->get()->result_array();
	   
	    $options = '';
	    foreach($attribute_values as $row){
	        if(count(json_decode($productData['choice_options'])) > 0){
	            foreach (json_decode($productData['choice_options']) as $key => $choice_option){
    	            if($attr_id == $choice_option->attribute_id && in_array($row['value'], $choice_option->values)){
    	               $options .= '<option value="'.$row['value'].'" selected>'.$row['value'].'</option>';
    	            }else{
    	                $options .= '<option value="'.$row['value'].'">'.$row['value'].'</option>';
    	            }
    	          
    	        }
	        }else{
	            $options .= '<option value="'.$row['value'].'">'.$row['value'].'</option>';
	        }
	        
	        
	    }
	    echo json_encode($options);
	}
	
	public function sku_combination()
    {
        $options = array();
        
        $colors_active = 0;
        
        

        $unit_price = $this->input->post('unit_price');
        $product_name = $this->input->post('name');
        // echo $product_name;
        // exit;
       
        if($this->input->post('choice_no')){
            foreach ($this->input->post('choice_no') as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                $valarray = $this->input->post($name);
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                if($valarray){
                    foreach ($valarray as $key => $item) {
                    // array_push($data, $item->value);
                        // $item = $this->db->select('value')->from('app_attribute_values')->where('id', $item)->get()->row()->value;
                        array_push($data, $item);
                    }
                }
                
                array_push($options, $data);
            }
        }
        $result = array(array());
        foreach ($options as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        $combinations =  $result;
        $data['combinations'] = $combinations;
        $data['unit_price'] = $unit_price;
        $data['colors_active'] = $colors_active;
        $data['product_name'] = $product_name;
        echo $this->load->view('admin/products/sku_combinations', $data,true);
    }
    
    public function edit_sku_combination($product_id)
    {
        
        $options = array();
        
        $colors_active = 0;
        
        

        $unit_price = $this->input->post('unit_price');
        $product_name = $this->input->post('name');
        
        // echo $product_name;
        // exit;
       
        if($this->input->post('choice_no')){
            foreach ($this->input->post('choice_no') as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                $valarray = $this->input->post($name);
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                if($valarray){
                    foreach ($valarray as $key => $item) {
                    // array_push($data, $item->value);
                        // $item = $this->db->select('value')->from('app_attribute_values')->where('id', $item)->get()->row()->value;
                        array_push($data, $item);
                    }
                }
                
                array_push($options, $data);
            }
        }
        $result = array(array());
        foreach ($options as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        $combinations =  $result;
        $data['combinations'] = $combinations;
        $data['unit_price'] = $unit_price;
        $data['colors_active'] = $colors_active;
        $data['product_name'] = $product_name;
        $data['product_id'] = $product_id;
        echo $this->load->view('admin/products/edit_sku_combinations', $data,true);
    }
    
    public function delete_product($id){
        if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		    $check_order = $this->db->query("SELECT * FROM app_order_details where product_id ='$id'");
		    
		    if($check_order->num_rows() > 0){
		        $this->set_message('error', "This product cannot be deleted due to found orders in database. You can still unpublish it to remove from website.");
    		    redirect('admin/products/');
            	exit();
		    }
		    $this->db->delete('app_attribute_values', array('product_id' => $id)); // deleting "app_attribute_values" at first to delete product from "app_products"
            $this->db->delete('app_products', array('id' => $id));
            $this->db->delete('app_product_stocks', array('product_id' => $id));
	        
	        
	        $this->set_message('success', "Product deleted successfully.");
		    redirect('admin/products/');
        	exit();
	   
	}
	
	public function edit($id)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		$product = $this->db->select("*")->from('app_products')->where('id', $id)->get();
		if($product->num_rows() == 0){
		    redirect('admin/products');
		    exit;
		}
		
		
		$product = $product->row_array();
		if($this->input->post()){
		    $dataProduct['name'] = $this->input->post('name');
		    $dataProduct['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($this->input->post('name')))).'-'.$this->Base_model->randomString(8).'-'.$this->Base_model->randomString(8);
		    
		    $check_slug = $this->db->select('*')->from('app_products')->where(array('slug'=>$dataProduct['slug'], 'id!='=>$id))->get()->num_rows();
		    if($check_slug > 0){
		        $this->set_message('error', "Slug already Exists.");
    		    redirect('admin/products/edit/'.$id);
            	exit();
		    }
		    
		    
		    $dataProduct['brand_id'] = $this->input->post('brand_id');
		    $dataProduct['category_id'] = $this->input->post('category_id');
		    $dataProduct['supplier_id'] = $this->input->post('supplier_id');
		    $dataProduct['tags'] = $this->input->post('tags');
		    $dataProduct['description'] = $this->input->post('description');
		    $dataProduct['unit_price'] = $this->input->post('unit_price');
		    $dataProduct['published'] = $this->input->post('published');
		    $dataProduct['featured'] = $this->input->post('featured');
		      $dataProduct['bestseller'] = $this->input->post('bestseller');
		    $timestamp = strtotime(date('Y-m-d H:i:s'));
		    $imt = 'product';
		    if(file_exists($_FILES['thumbnail']['tmp_name']) && is_uploaded_file($_FILES['thumbnail']['tmp_name'])){
                
            	if($_FILES['thumbnail']["type"] == "image/jpeg" || $_FILES['thumbnail']["type"] == "image/JPEG"){

                    $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
                
                }else if($_FILES['thumbnail']["type"] == "image/png" || $_FILES['thumbnail']["type"] == "image/PNG"){
                
                    $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
                
                }else if($_FILES['thumbnail']["type"] == "image/jpg" || $_FILES['thumbnail']["type"] == "image/JPG"){
            
                    $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
                    
                }else if($_FILES['thumbnail']["type"] == "image/gif" || $_FILES['thumbnail']["type"] == "image/GIF"){
            
                    $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
                    
                }else{
                    $this->set_message('error', "Thumbnail File upload type is not supported");
            		redirect('admin/products/edit/'.$id);
            		exit();
            	}
            	$img_uploaded = $this->Base_model->resize_img($_FILES['thumbnail']['tmp_name'], "uploads/products/".$img);
            	
            	if($img_uploaded){
                    $dataProduct['thumbnail_img'] = $img;
                }else{
                    $this->set_message('error', "Thumbnail Image file is invalid.");
            		redirect('admin/products/edit/'.$id);
            		exit();
                }
            }
            $gphotos = '';
            if(!empty($this->input->post('old_gallery_images'))){
                $gphotos .= $this->input->post('old_gallery_images').',';
            }
            
            $extension=array("jpeg","jpg","png","gif");
            foreach($_FILES["gallery_images"]["tmp_name"] as $key=>$tmp_name) {
                $file_name=$_FILES["gallery_images"]["name"][$key];
                $file_tmp=$_FILES["gallery_images"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);
            
                if(in_array($ext,$extension)) {
                        $img_file_name = $imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg';
                        // $filename=basename($img_file_name);
                        // move_uploaded_file($file_tmp=$_FILES["gallery_images"]["tmp_name"][$key],'uploads/products/'.$filename);
                        $img_uploaded = $this->Base_model->resize_img($file_tmp, "uploads/products/".$img_file_name);
                        if($img_uploaded){
                            $gphotos .= $img_file_name.',';
                        }
                }
            }
            $dataProduct['photos'] = rtrim($gphotos, ',');
            
            $dataProduct['shipping_cost'] = $this->input->post('shipping_cost');
            $dataProduct['discount'] = $this->input->post('discount');
            $dataProduct['meta_title'] =$this->input->post('meta_title');
            $dataProduct['meta_description'] = $this->input->post('meta_description');
            
            
            $choice_options = array();

            if($this->input->post('choice_no')){
                foreach ($this->input->post('choice_no') as $key => $no) {
                    $str = 'choice_options_'.$no;
    
                    $item['attribute_id'] = $no;
    
                    $data = array();
                    // foreach (json_decode($request[$str][0]) as $key => $eachValue) {
                    if($this->input->post($str)){
                        foreach ($this->input->post($str) as $key => $eachValue) {
                            // array_push($data, $eachValue->value);
                            array_push($data, $eachValue);
                        }
                    }
                    
    
                    $item['values'] = $data;
                    array_push($choice_options, $item);
                }
            }
    
            if (!empty($this->input->post('choice_no'))) {
                $dataProduct['attributes'] = json_encode($this->input->post('choice_no'));
            }
            else {
                $dataProduct['attributes'] = json_encode(array());
            }
    
            $dataProduct['choice_options']= json_encode($choice_options, JSON_UNESCAPED_UNICODE);
		    $this->db->where('id', $id);
		    $this->db->update('app_products', $dataProduct);
		    $product_id = $id;
		    
		    
		    
		    $this->db->query("DELETE FROM app_product_stocks WHERE product_id = '$product_id'");
		    $options = array();
            
    
            if($this->input->post('choice_no')){
                foreach ($this->input->post('choice_no') as $key => $no) {
                    $name = 'choice_options_'.$no;
                    $data = array();
                    if($this->input->post($name)){
                        foreach ($this->input->post($name) as $key => $eachValue) {
                            array_push($data, $eachValue);
                        }
                    }
                    
                    array_push($options, $data);
                }
            }
            
            $result = array(array());
            foreach ($options as $property => $property_values) {
                $tmp = array();
                foreach ($result as $result_item) {
                    foreach ($property_values as $property_value) {
                        $tmp[] = array_merge($result_item, array($property => $property_value));
                    }
                }
                $result = $tmp;
            }
            $combinations =  $result;
            
            if(count($combinations) > 0) { if(count($combinations[0]) > 0){
                $this->db->update('app_products', array('variant_product'=>1), "id = $product_id");
                foreach ($combinations as $key => $combination){
                    $str = '';
                    foreach ($combination as $key => $item){
                        if($key > 0 ){
                            $str .= '-'.str_replace(' ', '', $item);
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                    
                    $product_stock['product_id'] = $product_id;
                    $product_stock['attribute_id'] = $this->input->post('choice_attributes')[0];
                    $product_stock['variant'] = $str;
                    $product_stock['price']= $this->input->post('price_'.str_replace('.', '_', $str));
                    $product_stock['sku'] = $this->input->post('sku_'.str_replace('.', '_', $str));
                    $product_stock['qty'] = $this->input->post('qty_'.str_replace('.', '_', $str));
                    $product_stock['discount'] = $this->input->post('discount_'.str_replace('.', '_', $str));
                    
                    
                    $imt = 'product';
                    $imgpost = 'img_'.str_replace('.', '_', $str);
        		    if(file_exists($_FILES[$imgpost]['tmp_name']) && is_uploaded_file($_FILES[$imgpost]['tmp_name'])){
                        
                    	if($_FILES[$imgpost]["type"] == "image/jpeg" || $_FILES[$imgpost]["type"] == "image/JPEG"){
        
                            $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                            $img_uploaded = $this->Base_model->resize_img($_FILES[$imgpost]['tmp_name'], "uploads/products/".$img);
                            if($img_uploaded){
                                $product_stock['image'] = $img;
                            }
                        
                        }else if($_FILES[$imgpost]["type"] == "image/png" || $_FILES[$imgpost]["type"] == "image/PNG"){
                        
                            $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                            $img_uploaded = $this->Base_model->resize_img($_FILES[$imgpost]['tmp_name'], "uploads/products/".$img);
                            if($img_uploaded){
                                $product_stock['image'] = $img;
                            }
                        
                        }else if($_FILES[$imgpost]["type"] == "image/jpg" || $_FILES[$imgpost]["type"] == "image/JPG"){
                    
                            $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                            $img_uploaded = $this->Base_model->resize_img($_FILES[$imgpost]['tmp_name'], "uploads/products/".$img);
                            if($img_uploaded){
                                $product_stock['image'] = $img;
                            }
                            
                        }else if($_FILES[$imgpost]["type"] == "image/gif" || $_FILES[$imgpost]["type"] == "image/GIF"){
                    
                            $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                            $img_uploaded = $this->Base_model->resize_img($_FILES[$imgpost]['tmp_name'], "uploads/products/".$img);
                            if($img_uploaded){
                                $product_stock['image'] = $img;
                            }
                            
                        }
                    	
                    	
                    }else{
                        $product_stock['image'] = $this->input->post('oldimg_'.str_replace('.', '_', $str));
                    }
                    
                    $this->db->insert('app_product_stocks', $product_stock);
                }
            }else{
                
                $product_stock['product_id'] = $product_id;
                $product_stock['attribute_id'] = $this->input->post('choice_attributes')[0];
                $product_stock['variant'] = '';
                $product_stock['price']= $this->input->post('unit_price');
                $product_stock['sku'] = $this->input->post('sku');
                $product_stock['qty'] = $this->input->post('qty');
                $product_stock['discount'] = $this->input->post('discount');
                $this->db->insert('app_product_stocks', $product_stock);
                
            }}
            else{
                $product_stock['product_id'] = $product_id;
                $product_stock['attribute_id'] = $this->input->post('choice_attributes')[0];
                $product_stock['variant'] = '';
                $product_stock['price']= $this->input->post('unit_price');
                $product_stock['sku'] = $this->input->post('sku');
                $product_stock['qty'] = $this->input->post('qty');
                $product_stock['discount'] = $this->input->post('discount');
                $this->db->insert('app_product_stocks', $product_stock);
            }
            
            $this->set_message('success', "Product has been updated successfully.");
    	    redirect('admin/products/');
        	exit();
		    
		}
		
		
		$this->title = "Edit Product || ".$this->admintitle;
		
		$data['view_scripts']=array(
		     $this->Gen->get_admin_url('libs/select2/js/select2.min.js'),
		     $this->Gen->get_url('https://cdn.quilljs.com/1.3.6/quill.js'),
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
		    $this->Gen->get_admin_url('js/tagsinput.js'),
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
		    $this->Gen->get_admin_url('css/tagsinput.css'),
		  //  $this->Gen->get_admin_url('libs/quill/quill.core.css'),
		  //  $this->Gen->get_admin_url('libs/quill/quill.bubble.css'),
		  //  $this->Gen->get_admin_url('libs/quill/quill.snow.css'),
		);
		
		$data['product'] = $product;
	    
	    $data['categories'] = $this->db->select("*")->from('app_categories')->order_by('name', 'ASC')->get()->result_array();
	    $data['brands'] = $this->db->select("*")->from('app_brands')->order_by('name', 'ASC')->get()->result_array();
	    $data['suppliers'] = $this->db->select("*")->from('app_suppliers')->order_by('name', 'ASC')->get()->result_array();
	    $data['attributes'] = $this->db->select("*")->from('app_attributes')->order_by('name', 'ASC')->get()->result_array();
		
        $this->load_admin('products/edit',$data);
	}
	
// 	public function add_products_img(){
// 	    if (!$this->auth->is_logged()) {
//             redirect('admin/authentication');
//             exit();
// 		}
		
// 	    $extension=array("jpeg","jpg","png","gif");
// 	    $isError1 = false;
// 	    $isError2 = false;
// 	    $errorsNotFound = 'Following SKUs Not Found in Database or Already Uploaded Images : ';
// 	   // $wrongType = 'Following SKUs Not Uploaded due to invalid image file : ';
	    
// 	    $imt = 'product';
//             foreach($_FILES["sku_images"]["tmp_name"] as $key=>$tmp_name) {
//                 $file_name=$_FILES["sku_images"]["name"][$key];
//                 $file_tmp=$_FILES["sku_images"]["tmp_name"][$key];
//                 $ext=pathinfo($file_name,PATHINFO_EXTENSION);
//                 $only_name = basename($file_name, ".".$ext);
//                 // echo $only_name.'<br>';
                
//                 $product = $this->db->query("SELECT a.*, b.* FROM app_product_stocks a, app_products b WHERE a.sku = '$only_name' && b.id = a.product_id && b.thumbnail_img IS NULL");
//                 if($product->num_rows() > 0){
                    
//                     if(in_array($ext,$extension)) {
//                         $product = $product->row_array();
//                         $timestamp = strtotime(date('Y-m-d H:i:s'));
//                         $product_id = $product['product_id'];
//                         $img_file_name = $imt.$product_id.'_thumbnail_'.$timestamp . '.jpeg';
//                         $filename=basename($img_file_name);
//                         move_uploaded_file($file_tmp=$_FILES["sku_images"]["tmp_name"][$key],'uploads/products/'.$filename);
//                         $this->db->query("UPDATE app_products SET thumbnail_img = '$filename', published='1' WHERE id = '{$product['product_id']}'");
//                     }else{
                        
//                     }
                    
//                 }else{
//                      $isError1 = true;
//                     $errorsNotFound .= $only_name.', ';
//                 }
//                 // 
//             }
//             if($isError1){
//                 $error = '';
//                 if($isError1){
//                     $error .= $errorsNotFound;
//                 }
//                 // if($isError2){
//                 //     $error .= $wrongType;
//                 // }
//                 $this->set_message('error', $error);
//             }else{
//                 $this->set_message('success', "Images uploded successfully.");
//             }
            
//             redirect('admin/products/add_new');
//             exit();
// 	}
	
	public function add_csv(){
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    if(file_exists($_FILES['csv_file']['tmp_name']) && is_uploaded_file($_FILES['csv_file']['tmp_name'])){
            $ext = pathinfo($_FILES['csv_file']['name'], PATHINFO_EXTENSION);
            $allowed = array('csv');
            if(in_array( $ext, $allowed ) ) {
                
                $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');
        
        
                fgetcsv($csvFile);
               
                $user_id = $this->session->userdata('admin_id');
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    $category_id   = trim($line[0]);
                    $brand_id   = trim($line[1]);
                    $name   = trim($line[2]);
                    $tags   = str_replace(' ', ',', $line[3]);
                    $description   = $line[4];
                    $supplier_id   = $line[5];
                    $meta_title   = trim($line[6]);
                    $meta_description   = $line[7];
                    $sku   = trim($line[8]);
                    $price   = trim($line[9]);
                    $qty   = trim($line[10]);
                    
                    
                    $dataProduct['name'] = $name;
		            $dataProduct['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($name))).'-'.$this->Base_model->randomString(8).'-'.$this->Base_model->randomString(8);
                    $dataProduct['user_id'] = $user_id;
        		    $dataProduct['brand_id'] = $brand_id;
        		    $dataProduct['category_id'] = $category_id;
        		    $dataProduct['tags'] = $tags;
        		    $dataProduct['description'] = $description;
        		    $dataProduct['unit_price'] = $price;
        		    $dataProduct['published'] = 0;
        		    $dataProduct['featured'] = 0;
        		    $dataProduct['bestseller'] = 0;
        		    $dataProduct['supplier_id'] = $supplier_id;
        		    
        		    $dataProduct['shipping_cost'] = 0;
                    $dataProduct['discount'] = 0;
                    $dataProduct['meta_title'] = $meta_title;
                    $dataProduct['meta_description'] = $meta_description;
                    $dataProduct['variant_product'] = 0;
                    $dataProduct['attributes'] = json_encode(array());
            
    
                    $dataProduct['choice_options']= json_encode(array());
        		    
        		    $this->db->insert('app_products', $dataProduct);
        		    $product_id = $this->db->insert_id();
        		    $product_stock['product_id'] = $product_id;
                    $product_stock['variant'] = '';
                    $product_stock['price']= $price;
                    $product_stock['sku'] = $sku;
                    $product_stock['qty'] = $qty;
                    $this->db->insert('app_product_stocks', $product_stock);
                    
                }
                    $this->set_message('success', "Products from csv has been created successfully.");
            	    
                
                
            }
        }
        
        redirect('admin/products/add_new');
        exit();
	}
	
	public function update_csv(){
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
	    if(file_exists($_FILES['csv_file']['tmp_name']) && is_uploaded_file($_FILES['csv_file']['tmp_name'])){
            $ext = pathinfo($_FILES['csv_file']['name'], PATHINFO_EXTENSION);
            $allowed = array('csv');
            if(in_array( $ext, $allowed ) ) {
                
                $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');
        
        
                fgetcsv($csvFile);
               
                $user_id = $this->session->userdata('admin_id');
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    $category_id   = trim($line[0]);
                    $brand_id   = trim($line[1]);
                    $name   = trim($line[2]);
                    $tags   = str_replace(' ', ',', $line[3]);
                    $description   = $line[4];
                    $supplier_id   = $line[5];
                    $meta_title   = trim($line[6]);
                    $meta_description   = $line[7];
                    $sku   = trim($line[8]);
                    $price   = trim($line[9]);
                    $qty   = trim($line[10]);
                    
                    $checkSKU = $this->db->query("SELECT * FROM app_product_stocks where sku = '$sku'");
                    if($checkSKU->num_rows() > 0){
                        $product_id = $checkSKU->row()->product_id;
                        $updateProduct = false;
                        if(!empty($name) && strlen($name) > 0){
                            $updateProduct = true;
                            $dataProduct['name'] = $name;
    		                $dataProduct['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($name))).'-'.$this->Base_model->randomString(8).'-'.$this->Base_model->randomString(8);
                        }
                        
                        
                        if(!empty($brand_id) && strlen($brand_id) > 0){
                            $updateProduct = true;
                            $dataProduct['brand_id'] = $brand_id;
                        }
            		   
            		    if(!empty($category_id) && strlen($category_id) > 0){
            		        $updateProduct = true;
            		        $dataProduct['category_id'] = $category_id;
            		    }
            		    
            		    if(!empty($tags) && strlen($tags) > 0){
            		        $updateProduct = true;
            		        $dataProduct['tags'] = $tags;
            		    }
            		    
            		    if(!empty($description) && strlen($description) > 0){
            		        $updateProduct = true;
            		        $dataProduct['description'] = $description;
            		    }
            		    
            		    
            		    if(!empty($price) && strlen($price) > 0){
            		        $updateProduct = true;
            		        $dataProduct['unit_price'] = $price;
            		    }
            		    
            		    if(!empty($supplier_id) && strlen($supplier_id) > 0){
            		        $updateProduct = true;
            		        $dataProduct['supplier_id'] = $supplier_id;
            		    }
            		    
            		    if(!empty($meta_title) && strlen($meta_title) > 0){
            		        $updateProduct = true;
            		        $dataProduct['meta_title'] = $meta_title;
            		    }
            		    
            		    if(!empty($meta_description) && strlen($meta_description) > 0){
            		        $updateProduct = true;
            		        $dataProduct['meta_description'] = $meta_description;
            		    }
            		    
            		    if($updateProduct){
            		        $this->db->where('id', $product_id);
                            $this->db->update('app_products', $dataProduct);
            		    }
            		    
            		    $updateStock = false;
            		    
                        if(!empty($price) && strlen($price) > 0){
            		        $updateStock = true;
            		        $product_stock['price'] = $price;
            		    }
            		    
            		    if(!empty($qty) && strlen($qty) > 0){
            		        $updateStock = true;
            		        $product_stock['qty'] = $qty;
            		    }
                        
                        if($updateStock){
                            $this->db->where('sku', $sku);
                            $this->db->update('app_product_stocks', $product_stock);
                        }
                        
                        
                        
                    }
                    
                    
        		    
                    
                }
                    $this->set_message('success', "Products from csv has been updated successfully.");
            	    
                
                
            }
        }
        
        redirect('admin/products/add_new');
        exit();
	}


}
