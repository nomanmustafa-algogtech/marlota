<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Products extends REST_Controller
{
    public function __construct(){

     parent::__construct();

     // Load model
     $this->load->model('Base_model');
     // $this->load->library('gcm');
     
    }
    
   
    
    public function getProducts_get(){
        $data = array();
	    
	    $this->db->select('a.id, a.thumbnail_img, a.name, (SELECT s.price from app_product_stocks as s WHERE s.product_id = a.id ORDER by s.price ASC LIMIT 0,1) as price, (SELECT s.discount from app_product_stocks as s WHERE s.product_id = a.id ORDER by s.price ASC LIMIT 0,1) as discount')->from('app_products as a');
	    
	    
	    if(isset($_GET['category']) && !empty($_GET['category'])){
	        $category = $this->db->query("SELECT * FROM app_categories WHERE id = '{$_GET['category']}'")->row_array();
	        
	        $this->db->group_start();
	        $this->db->where('a.category_id', $category['id']);
	        $subcat = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '{$category['id']}'")->result_array();
	        foreach($subcat as $cat1){
	            $this->db->or_where('a.category_id', $cat1['id']);
	            $subcat1 = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '{$cat1['id']}'")->result_array();
    	        foreach($subcat1 as $cat2){
    	            $this->db->or_where('a.category_id', $cat2['id']);
    	        }
	        }
	        $this->db->group_end();
	    }
	    
	    if(isset($_GET['search']) && !empty($_GET['search'])){
	        $searchText = trim(preg_replace('/\s+/',' ', str_replace(',', ' ', $_GET['search'])));
	       
            $this->db->where("MATCH (`name`, `tags`) AGAINST ('$searchText')");
	        
	       
	        
	    }
	    
	    if(isset($_GET['brand']) && !empty($_GET['brand'])){
	        $this->db->where('a.brand_id', $_GET['brand']);
	    }
	    
	    if(isset($_GET['search']) && !empty($_GET['search'])){
	        $searchText = trim(preg_replace('/\s+/',' ', str_replace(',', ' ', $_GET['search'])));
	       
            $this->db->order_by("MATCH(name, tags) AGAINST('$searchText') DESC");
	        
	    }
	    
	    
	    if(isset($_GET['orderby']) && !empty($_GET['orderby'])){
	        if($_GET['orderby'] == 'popularity'){
	            $this->db->order_by("a.rating", "desc");
	        }
	        
	        if($_GET['orderby'] == 'date'){
	            $this->db->order_by("a.id", "desc");
	        }
	        
	       // if($_GET['orderby'] == 'price_low'){
	       //     $this->db->order_by("unit_price", "asc");
	       // }
	        
	       // if($_GET['orderby'] == 'price_high'){
	       //     $this->db->order_by("unit_price", "desc");
	       // }
	        
	    }
	    
	    $this->db->where('a.published', 1);
	    $this->db->where('a.approved', 1);
	    
	    
	    if (isset($_GET['pageno'])  && !empty($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        
        
        $no_of_records_per_page = 50;
        
        $offset = ($pageno-1) * $no_of_records_per_page;
        
        $products = $this->db->get();
        $total_rows = $products->num_rows();
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        
        $query = $this->db->last_query();
        //   echo $query;
        //   exit;
        $products = $this->db->query($query." LIMIT $offset, $no_of_records_per_page")->result_array();
	    
	   // $products=$this->db->get()->result_array();
	   // echo $this->db->last_query();
	   // exit;
		
		
		$data['products'] = $products;
		$data['offset'] = $offset;
		$data['pageno'] = $pageno;
		$data['per_page'] = $no_of_records_per_page;
		$data['total_rows'] = $total_rows;
		$data['total_pages'] = $total_pages;
// 		$data['category'] = $_GET['category'];
// 		$data['search'] = $_GET['search'];
        
        $status = REST_Controller::HTTP_OK;
        $msg = 'Data Returned';
        
        $response = ['status' => $status, 'msg' => $msg, 'data'=>$data];
        $this->set_response($response, $status);
        return;
    }
    
    public function view_post()
	{
	    $id=$this->post('id');
	    
	    
	    $this->db->select('*')->from('app_products');
	    $this->db->where('id', $id);
	    
	    
	    
	    $this->db->where('published', 1);
	    $this->db->where('approved', 1);
	    
	   
        
        $products = $this->db->get();
        
        $product = $products->row_array();
        
	    $low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}' ORDER BY price asc")->row();
	    $reviews = $this->db->query("SELECT r.rating, r.comment, DATE_FORMAT(r.created_date, '%M %d, %Y at %h:%i %p') as date, u.full_name FROM app_product_reviews as r, app_users as u WHERE u.id = r.user_id && r.approved = '1' && r.product_id = '{$product['id']}' order by r.id desc")->result_array();
	    $product['price'] = $low_price->price;
	    $product['discount'] = $low_price->discount;
	    $product['reviews'] = $reviews;
	    $product['brand_details'] = $this->db->query("SELECT * FROM app_brands WHERE id = '{$product['brand_id']}'")->row_array();
	    $product['category_details'] = $this->db->query("SELECT * FROM app_categories WHERE id = '{$product['category_id']}'")->row_array();
	    
	    if($product['variant_product'] == 1){
	        $product['choice_attr'] = array();
	        foreach (json_decode($product['choice_options']) as $key => $choice_option){
	            $choice=array();
	            $choice['choice_no'] = $choice_option->attribute_id;
	            $choice['choice_name'] = $this->db->query("select * from app_attributes where id='".$choice_option->attribute_id."'")->row()->name;
	            $choice['choice_values'] = $choice_option->values;
	            $product['choice_attr'][] = $choice;
	        }
	    }
	    
	    $status = REST_Controller::HTTP_OK;
        $msg = 'Data Returned';
        
        $response = ['status' => $status, 'msg' => $msg, 'data'=>$product];
        $this->set_response($response, $status);
        return;
	}
	
	public function get_sku_combination_post()
    {
        
        $options = array();
        $dataReturn['status'] = -1;
        $colors_active = 0;
        $product_id = $this->post('product_id');
        $product  = $this->db->query("SELECT * FROM app_products WHERE id = '$product_id'")->row_array();

        $product_name = $product['name'];
        
        // echo $product_name;
        // exit;
        if($this->post('choice_no')){
            foreach ($this->post('choice_no') as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                $val = $this->post($name);
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                if(!empty($val)){
                    array_push($data, $val);
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
        if(count($combinations) > 0){
             foreach ($combinations as $key => $combination){
                 $sku = '';
    // 			$str = '';
    			foreach (explode(' ', $product_name) as $key => $value) {
    				$sku .= substr($value, 0, 1);
    				// $str .= substr($value, 0, 1);
    			}
    
    			$str = '';
    			foreach ($combination as $key => $item){
    				if($key > 0 ){
    					$str .= '-'.str_replace(' ', '', $item);
    					$sku .='-'.str_replace(' ', '', $item);
    				}
    				else{
    					
    					$str .= str_replace(' ', '', $item);
    					$sku .='-'.str_replace(' ', '', $item);
    					
    				}
    			}
        		if(strlen($str) > 0){
        		    $data_stock = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '$product_id' && variant = '$str'")->row_array();
        		    if(count($data_stock) > 0){
        		        $dataReturn['status'] = 1;
        		        $dataReturn['sku'] = $data_stock['sku'];
        		        $dataReturn['price'] = $data_stock['price'];
        		        $dataReturn['discount'] = $data_stock['discount'];
        		        $dataReturn['image'] = $data_stock['image'];
        		    }else{
        		        $dataReturn['status'] = 0;
        		    }
        		    
        		}
        		
             }
             
        }
        
        $status = REST_Controller::HTTP_OK;
        $msg = 'Data Returned';
        
        $response = ['status' => $status, 'msg' => $msg, 'data'=>$dataReturn];
        $this->set_response($response, $status);
        return;
        
    }
    
    public function add_to_cart_post(){
        if($this->post('product_id') && $this->post('qty')){
            if($this->post('user_id')){
                $dataInsert['user_id'] = $this->post('user_id');
                $dataInsert['session_id'] = 0;
                $wherecondition = "WHERE user_id='".$this->post('user_id')."' ";
            }else{
                $dataInsert['user_id'] = 0;
                $dataInsert['session_id'] = $this->post('device_id');
                $wherecondition = "WHERE session_id='".$this->post('device_id')."'";
            }
            
            $dataInsert['product_id'] = $this->post('product_id');
            $dataInsert['qty'] = $this->post('qty');
            $dataInsert['created_date'] = date('Y-m-d H:i:s');
            
            $product  = $this->db->query("SELECT * FROM app_products WHERE id = '{$dataInsert['product_id']}'")->row_array();
            $dataInsert['shipping_cost'] = $product['shipping_cost'];
            if($product['variant_product']==1){
                $cart_variant = array();
                $options = array();
                $product_name = $product['name'];
                if($this->post('choice_no')){
                    foreach ($this->post('choice_no') as $key => $no) {
                        $name = 'choice_options_'.$no;
                        $data = array();
                        $val = $this->post($name);
                        $value_name = $this->db->query("select * from app_attributes where id='$no'")->row()->name;
                        // foreach (json_decode($request[$name][0]) as $key => $item) {
                        if(!empty($val)){
                            array_push($cart_variant, array('name'=>$value_name, 'value'=>$val));
                            array_push($data, $val);
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
                if(count($combinations) > 0){
                     foreach ($combinations as $key => $combination){
                         $sku = '';
            // 			$str = '';
            			foreach (explode(' ', $product_name) as $key => $value) {
            				$sku .= substr($value, 0, 1);
            				// $str .= substr($value, 0, 1);
            			}
            
            			$str = '';
            			foreach ($combination as $key => $item){
            				if($key > 0 ){
            					$str .= '-'.str_replace(' ', '', $item);
            					$sku .='-'.str_replace(' ', '', $item);
            				}
            				else{
            					
            					$str .= str_replace(' ', '', $item);
            					$sku .='-'.str_replace(' ', '', $item);
            					
            				}
            			}
                		if(strlen($str) > 0){
                		    $data_stock = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}' && variant = '$str'")->row_array();
                		    if(count($data_stock) > 0){
                		        $dataInsert['sku'] = $data_stock['sku'];
                		        $dataInsert['variant'] = json_encode($cart_variant);
                		        if($data_stock['discount'] > 0){
                		            $dataInsert['price'] = $data_stock['discount'];
                		            $dataInsert['total_amount'] = $dataInsert['qty']*$data_stock['discount'];
                		        }else{
                		            $dataInsert['price'] = $data_stock['price'];
                		            $dataInsert['total_amount'] = $dataInsert['qty']*$data_stock['price'];
                		        }
                		        
                		        
                		        $checkcart = $this->db->query("SELECT * FROM app_cart $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
                                if($checkcart->num_rows() > 0){
                                    $this->db->query("UPDATE app_cart SET qty = qty + '{$dataInsert['qty']}', total_amount = total_amount + '{$dataInsert['total_amount']}' $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
                                }else{
                                    $this->db->insert('app_cart', $dataInsert);
                                }
                                
                		    }
                		    
                		}
                		
                     }
                     
                }
            }else{
                $stock = $this->db->query("SELECT * FROM app_product_stocks where product_id = '{$product['id']}'")->row_array();
                $dataInsert['sku'] = $stock['sku'];
                $dataInsert['variant'] = json_encode(array());
                if($stock['discount'] > 0){
		            $dataInsert['price'] = $stock['discount'];
		            $dataInsert['total_amount'] = $dataInsert['qty']*$stock['discount'];
		        }else{
		            $dataInsert['price'] = $stock['price'];
		            $dataInsert['total_amount'] = $dataInsert['qty']*$stock['price'];
		        }
                $checkcart = $this->db->query("SELECT * FROM app_cart $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
                if($checkcart->num_rows() > 0){
                    $this->db->query("UPDATE app_cart SET qty = qty + '{$dataInsert['qty']}', total_amount = total_amount + '{$dataInsert['total_amount']}' $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
                }else{
                    $this->db->insert('app_cart', $dataInsert);
                }
            }
            
            $status = REST_Controller::HTTP_OK;
            
            $response = ['status' => $status, 'msg' => "Your Product has been added to cart."];
            $this->set_response($response, $status);
            return;
            
            
        }
    }
    
    public function getCart_post(){
       
        if($this->post('user_id')){
            $data['user_id'] = $this->post('user_id');
        }else{
             $data['session_id'] = $this->post('device_id');
        }
        
        $shipping_fee = 0;
        $cartData = $this->db->select("*")->from("app_cart")->where($data)->get()->result_array();
        $cartReturn=array();
        $total_amount = 0;
        foreach($cartData as $cart){
            $cart['product_details'] = $this->db->query("SELECT id, thumbnail_img, name FROM app_products where id = '{$cart['product_id']}'")->row_array();
            $cart['qty'] = (int) $cart['qty'];
            $total_amount += (int) ($cart['qty']*$cart['price']);
            $cartReturn[] = $cart;
        }
        
        if($this->post('user_id')){
            $shipping_fee = $this->db->query("SELECT shipping_cost FROM app_cart WHERE user_id = '".$this->post('user_id')."' ORDER BY shipping_cost DESC LIMIT 0,1");
            if($shipping_fee->num_rows() > 0){
                $shipping_fee = $shipping_fee->row()->shipping_cost;
            }
        }
        
        $status = REST_Controller::HTTP_OK;
        $msg = 'Data Returned';
        
        $response = ['status' => $status, 'msg' => $msg, 'data'=>$cartReturn, 'total_amount'=>$total_amount, 'shipping_fee'=>$shipping_fee];
        $this->set_response($response, $status);
        return;
    }
    
    public function emptyCart_post(){
        if($this->post('user_id')){
            $data['user_id'] = $this->post('user_id');
        }else{
             $data['session_id'] = $this->post('device_id');
        }
        
        $this->db->where($data);
        $this->db->delete('app_cart');
        
        
        $status = REST_Controller::HTTP_OK;
        $msg = 'All items from your cart has been deleted.';
        
        $response = ['status' => $status, 'msg' => $msg];
        $this->set_response($response, $status);
        return;
    }
    
    public function deleteCart_post(){
        if($this->post('user_id')){
            $data['user_id'] = $this->post('user_id');
        }else{
             $data['session_id'] = $this->post('device_id');
        }
        $data['id'] = $this->post('id');
        $this->db->where($data);
        $this->db->delete('app_cart');
        
        
        $status = REST_Controller::HTTP_OK;
        $msg = 'Item from your cart has been deleted.';
        
        $response = ['status' => $status, 'msg' => $msg];
        $this->set_response($response, $status);
        return;
    }
    
    public function updateCart_post(){
        if($this->post('user_id')){
            $data['user_id'] = $this->post('user_id');
        }else{
             $data['session_id'] = $this->post('device_id');
        }
        $data['id'] = $this->post('id');
        
        $price = $this->db->select('price')->from('app_cart')->where($data)->get()->row()->price;
        
        
        $this->db->where($data);
        $this->db->update('app_cart', array('qty'=>$this->post('qty'), 'total_amount'=>$price*$this->post('qty')));
        
        
        $status = REST_Controller::HTTP_OK;
        $msg = 'Cart Updated';
        
        $response = ['status' => $status, 'msg' => $msg];
        $this->set_response($response, $status);
        return;
    }
    
    
    
    
}