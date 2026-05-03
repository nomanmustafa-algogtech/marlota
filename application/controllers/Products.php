<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends My_controller {
    function __construct() {
        parent::__construct();
        
        $this->CI = & get_instance();
        $this->load->helper('cookie');
        $this->Base_model->visitor_logs();
    
       
    }
    
    public function addreview(){
        if(!$this->session->userdata('user_loggedin')){
            redirect(base_url());
            exit;
        }
        
        if(!$this->input->post('order_id') || !$this->input->post('product_id') || !$this->input->post('rate') || !$this->input->post('comment')){
		    exit;
		}
		
		$order_id = $this->input->post('order_id');
		$product_id = $this->input->post('product_id');
		$user_id = $this->session->userdata('user_id');
		
		$rate = $this->input->post('rate');
		$comment = $this->input->post('comment');
		
		$check_order = $this->db->query("SELECT * FROM app_order_details where user_id = '$user_id' && order_id = '$order_id' && product_id = '$product_id'")->num_rows();
        if($check_order > 0){
            $check_review = $this->db->query("SELECT * FROM app_product_reviews WHERE user_id = '$user_id' && order_id = '$order_id' && product_id = '$product_id'")->num_rows();
            if($check_review == 0){
                $now = date('Y-m-d H:i:s');
                $this->db->query("INSERT INTO app_product_reviews SET product_id = '$product_id', order_id = '$order_id', user_id = '$user_id', rating = '$rate', comment = '$comment', approved = '0', created_date = '$now'");
            }
        }
        
        $this->session->set_userdata(array('flash_message'=>'<div class="alert alert-success alert-inline show-code-action">Your review has been submitted successfully.</div>'));
        redirect(base_url('user/order/'.$order_id));
        exit;
    }
    
    public function review_page()
	{
		if(!isset($_SERVER['HTTP_REFERER'])){
		    exit;
		}
		
		if(!$this->input->get('sn') || !$this->input->get('order_id') || !$this->input->get('product_id')){
		    exit;
		}
		
		
		$data['sn'] = $this->input->get('sn');
		$data['order_id'] = $this->input->get('order_id');
		$data['product_id'] = $this->input->get('product_id');
		
		$data['user_id'] = $this->session->userdata('user_id');
		
		$data['settings'] = $this->settings;

        $this->load->view('web/review_page', $data);
	}
    
   
	
	public function index()
	{
	    
	
	    if(isset($_GET['search']) && !empty($_GET['search'])){
	        $this->title = $_GET['search'] ." || ".$this->title;
	    }else if(isset($_GET['category']) && !empty($_GET['category'])){
	        $category = $this->db->query("SELECT * FROM app_categories WHERE slug = '{$_GET['category']}'");
	        if($category->num_rows() == 0){
	            redirect(base_url());
	            exit;
	        }else{
	            $category = $category->row_array();
	        }
	        $this->title = $category['name'] ." || ".$this->title;
	    }else if(isset($_GET['brand']) && !empty($_GET['brand'])){
	        $brand = $this->db->query("SELECT * FROM app_brands WHERE id = '{$_GET['brand']}'");
	        if($brand->num_rows() == 0){
	            redirect(base_url());
	            exit;
	        }else{
	            $brand = $brand->row_array();
	        }
	        $this->title = $brand['name'] ." || ".$this->title;
	    }
	    
	    
	    $this->db->select('*')->from('app_products');
	    
	    
	    if(isset($_GET['category']) && !empty($_GET['category'])){
	        $category = $this->db->query("SELECT * FROM app_categories WHERE slug = '{$_GET['category']}'")->row_array();
	        
	        $this->db->group_start();
	        $this->db->where('category_id', $category['id']);
	        $subcat = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '{$category['id']}'")->result_array();
	        foreach($subcat as $cat1){
	            $this->db->or_where('category_id', $cat1['id']);
	            $subcat1 = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '{$cat1['id']}'")->result_array();
    	        foreach($subcat1 as $cat2){
    	            $this->db->or_where('category_id', $cat2['id']);
    	        }
	        }
	        $this->db->group_end();
	    }
	    
	    if(isset($_GET['search']) && !empty($_GET['search'])){
	       // $this->db->group_start();
	        $searchText = trim(preg_replace('/\s+/',' ', str_replace(',', ' ', $_GET['search'])));
	       
            //   echo $match;
            //   exit;
              $this->db->where("MATCH (`name`, `tags`) AGAINST ('$searchText')");
	        
	       // $this->db->group_start();
	       // foreach(explode(' ', $searchText) as $text){
	       //     $this->db->like('name', "$text ", 'before');
	       //     $this->db->or_like('name', " $text ", 'both');
	       //     $this->db->or_like('name', " $text", 'after');
	       // }
	       // $this->db->group_end();
	        
	       // $this->db->or_group_start();
	       // foreach(explode(' ', $searchText) as $text){
	       //     $this->db->or_like('tags', "$text", 'both');
	       // }
	       // $this->db->group_end();
	       // $this->db->group_end();
	       
	        
	    }
	    
	    if(isset($_GET['brand']) && !empty($_GET['brand'])){
	        $this->db->where('brand_id', $_GET['brand']);
	    }
	    
	    if(isset($_GET['search']) && !empty($_GET['search'])){
	        $searchText = trim(preg_replace('/\s+/',' ', str_replace(',', ' ', $_GET['search'])));
	       
            $this->db->order_by("MATCH(name, tags) AGAINST('$searchText') DESC");
	        
	    }
	    
	    
	    if(isset($_GET['orderby']) && !empty($_GET['orderby'])){
	        if($_GET['orderby'] == 'popularity'){
	            $this->db->order_by("rating", "desc");
	        }
	        
	        if($_GET['orderby'] == 'date'){
	            $this->db->order_by("id", "desc");
	        }
	        
	        if($_GET['orderby'] == 'price_low'){
	            $this->db->order_by("unit_price", "asc");
	        }
	        
	        if($_GET['orderby'] == 'price_high'){
	            $this->db->order_by("unit_price", "desc");
	        }
	        
	    }
	    
	    $this->db->where('published', 1);
	    $this->db->where('approved', 1);
	    
	    
	    if (isset($_GET['pageno'])  && !empty($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        
        if (isset($_GET['count']) && !empty($_GET['count'])) {
            $no_of_records_per_page = $_GET['count'];
        }else{
            $no_of_records_per_page = 50;
        }
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
		$data['view_scripts']=array();
		$data['view_css']=array(
		    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
	
        $this->load_web('products',$data);
	}
	
	public function view($slug)
	{
	    
	           
    //   var_dump('test');
    //   return ;
	    
	    
	    $this->db->select('*')->from('app_products');
	    $this->db->where('slug', $slug);
	    
	    
	    
	    $this->db->where('published', 1);
	    $this->db->where('approved', 1);
	    
	   
        
        $products = $this->db->get();
        
        if($products->num_rows()==0){
            redirect(base_url());
            exit;
        }
        $product = $products->row_array();
        
	    $this->title = $product['name'] ." || ".$this->title;
	   // $products=$this->db->get()->result_array();
	   // echo $this->db->last_query();
	   // exit;
		
		
		$data['product'] = $product;
		
		$data['view_scripts']=array();
		$data['view_css']=array(
		    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
		);
		
		
	
        $this->load_web('product_view',$data);
	}
	
	public function get_sku_combination()
    {
		$options = array();
		$dataReturn = array('status' => -1);
		$product_id = (int)$this->input->post('product_id');

		if ($product_id <= 0) {
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode($dataReturn));
		}

		$product = $this->db->where('id', $product_id)->get('app_products')->row_array();
		if (!$product) {
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode($dataReturn));
		}

		$product_name = $product['name'];

		if ($this->input->post('choice_no')) {
			foreach ($this->input->post('choice_no') as $key => $no) {
				$name = 'choice_options_'.$no;
				$data = array();
				$val = $this->input->post($name);
				if (!empty($val)) {
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

		$combinations = $result;
		if (count($combinations) > 0) {
			foreach ($combinations as $key => $combination) {
				$sku = '';
				foreach (explode(' ', $product_name) as $key => $value) {
					$sku .= substr($value, 0, 1);
				}

				$str = '';
				foreach ($combination as $key => $item) {
					if ($key > 0) {
						$str .= '-'.str_replace(' ', '', $item);
						$sku .= '-'.str_replace(' ', '', $item);
					} else {
						$str .= str_replace(' ', '', $item);
						$sku .= '-'.str_replace(' ', '', $item);
					}
				}

				if (strlen($str) > 0) {
					$data_stock = $this->find_stock_by_variant($product_id, $str);

					if (!empty($data_stock)) {
						$dataReturn['status'] = 1;
						$dataReturn['sku'] = $data_stock['sku'];
						$dataReturn['price'] = $data_stock['price'];
						$dataReturn['discount'] = $data_stock['discount'];
						$dataReturn['qty'] = $data_stock['qty'];
						$dataReturn['image'] = $data_stock['image'];
					} else {
						$dataReturn['status'] = 0;
					}
				}
			}
		}

		return $this->output
			->set_content_type('application/json')
			->set_output(json_encode($dataReturn));
        // print_r($combinations);
        // $data['combinations'] = $combinations;
        // $data['unit_price'] = $unit_price;
        // $data['colors_active'] = $colors_active;
        // $data['product_name'] = $product_name;
        // $data['product_id'] = $product_id;
        // echo $this->load->view('admin/products/edit_sku_combinations', $data,true);
    }
    
    // public function add_to_cart()
    // {
	
    //     if($this->input->post('product_id') && $this->input->post('qty'))
    //     {
    //         if($this->session->userdata('user_loggedin'))
    //         {
    //             $dataInsert['user_id'] = $this->session->userdata('user_id');
    //             $dataInsert['session_id'] = 0;
    //             $wherecondition = "WHERE user_id='".$this->session->userdata('user_id')."' ";
    //         }
    //         else
    //         {
    //             $dataInsert['user_id'] = 0;
    //             $dataInsert['session_id'] = $_COOKIE["session_id"];
    //             $wherecondition = "WHERE session_id='".$_COOKIE["session_id"]."'";
    //         }
            
    //         $dataInsert['product_id'] = $this->input->post('product_id');
    //         $dataInsert['qty'] = $this->input->post('qty');
    //         $dataInsert['created_date'] = date('Y-m-d H:i:s');
            
    //         $product  = $this->db->query("SELECT * FROM app_products WHERE id = '{$dataInsert['product_id']}'")->row_array();
    //         $dataInsert['shipping_cost'] = $product['shipping_cost'];
    //         if($product['variant_product']==1){
    //             $cart_variant = array();
    //             $options = array();
    //             $product_name = $product['name'];
    //             if($this->input->post('choice_no')){
    //                 foreach ($this->input->post('choice_no') as $key => $no) {
    //                     $name = 'choice_options_'.$no;
    //                     $data = array();
    //                     $val = $this->input->post($name);
    //                     $value_name = $this->db->query("select * from app_attributes where id='$no'")->row()->name;
    //                     // foreach (json_decode($request[$name][0]) as $key => $item) {
    //                     if(!empty($val)){
    //                         array_push($cart_variant, array('name'=>$value_name, 'value'=>$val));
    //                         array_push($data, $val);
    //                     }
    //                     array_push($options, $data);
    //                 }
    //             }
    //             $result = array(array());
    //             foreach ($options as $property => $property_values) {
    //                 $tmp = array();
    //                 foreach ($result as $result_item) {
    //                     foreach ($property_values as $property_value) {
    //                         $tmp[] = array_merge($result_item, array($property => $property_value));
    //                     }
    //                 }
    //                 $result = $tmp;
    //             }
    //             $combinations =  $result;
    //             if(count($combinations) > 0){
    //                  foreach ($combinations as $key => $combination){
    //                      $sku = '';
    //         // 			$str = '';
    //         			foreach (explode(' ', $product_name) as $key => $value) {
    //         				$sku .= substr($value, 0, 1);
    //         				// $str .= substr($value, 0, 1);
    //         			}
    //         			$str = '';
    //         			foreach ($combination as $key => $item){
    //         				if($key > 0 ){
    //         					$str .= '-'.str_replace(' ', '', $item);
    //         					$sku .='-'.str_replace(' ', '', $item);
    //         				}
    //         				else{
    //         					$str .= str_replace(' ', '', $item);
    //         					$sku .='-'.str_replace(' ', '', $item);
    //         				}
    //         			}
    //             		if(strlen($str) > 0){
    //             		    $data_stock = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}' && variant = '$str'")->row_array();
    //             		    if(count($data_stock) > 0){
    //             		        $dataInsert['sku'] = $data_stock['sku'];
    //             		        $available_qty = $data_stock['qty'];
                		        
    //             		        if($available_qty < $dataInsert['qty']){
    //             		            echo 'ERROR_QTY';
    //             		            exit;
    //             		        }else{
    //             		            $dataInsert['variant'] = json_encode($cart_variant);
    //                 		        if($data_stock['discount'] > 0){
    //                 		            $dataInsert['price'] = $data_stock['discount'];
    //                 		            $dataInsert['total_amount'] = $dataInsert['qty']*$data_stock['discount'];
    //                 		        }else{
    //                 		            $dataInsert['price'] = $data_stock['price'];
    //                 		            $dataInsert['total_amount'] = $dataInsert['qty']*$data_stock['price'];
    //                 		        }
    //                 		        $checkcart = $this->db->query("SELECT * FROM app_cart $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
    //                                 if($checkcart->num_rows() > 0){
    //                                     $this->db->query("UPDATE app_cart SET qty = qty + '{$dataInsert['qty']}', total_amount = total_amount + '{$dataInsert['total_amount']}' $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
    //                                 }
    //                                 else
    //                                 {
    //                                     $this->db->insert('app_cart', $dataInsert);
    //                                 }
    //             		        }
    //             		    }
    //             		}
    //                  }
    //             }
    //         }else{
    //             $stock = $this->db->query("SELECT * FROM app_product_stocks where product_id = '{$product['id']}'")->row_array();
    //             $dataInsert['sku'] = $stock['sku'];
    //             $available_qty = $stock['qty'];
                		        
	// 	        if($available_qty < $dataInsert['qty']){
	// 	            echo 'ERROR_QTY';
	// 	            exit;
	// 	        }else{
    //                 $dataInsert['variant'] = json_encode(array());
    //                 if($stock['discount'] > 0){
    // 		            $dataInsert['price'] = $stock['discount'];
    // 		            $dataInsert['total_amount'] = $dataInsert['qty']*$stock['discount'];
    // 		        }else{
    // 		            $dataInsert['price'] = $stock['price'];
    // 		            $dataInsert['total_amount'] = $dataInsert['qty']*$stock['price'];
    // 		        }
    //                 $checkcart = $this->db->query("SELECT * FROM app_cart $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
    //                 if($checkcart->num_rows() > 0){
    //                     $this->db->query("UPDATE app_cart SET qty = qty + '{$dataInsert['qty']}', total_amount = total_amount + '{$dataInsert['total_amount']}' $wherecondition && product_id = '{$dataInsert['product_id']}' && sku = '{$dataInsert['sku']}' && price = '{$dataInsert['price']}'");
    //                 }else{
    //                     $this->db->insert('app_cart', $dataInsert);
    //                 }
	// 	        }
    //         }
    //     }
    // }
	public function add_to_cart()
	{
		// Ensure session library is available
		if (!isset($this->session)) {
			$this->load->library('session');
		}

		// Quick validation
		$product_id = $this->input->post('product_id');
		$qty = (int)$this->input->post('qty');

		if (!$product_id || $qty <= 0) {
			// Keep backward compatibility if front-end expects plain text
			echo json_encode(['status' => 'error', 'msg' => 'Invalid product or qty']);
			return;
		}

		$isLoggedIn = (bool)$this->session->userdata('user_loggedin');

		// Load product
		$product = $this->db->where('id', $product_id)->get('app_products')->row_array();
		if (!$product) {
			echo json_encode(['status' => 'error', 'msg' => 'Product not found']);
			return;
		}

		// Basic cart item skeleton (same keys as DB rows)
		$item = [
			'product_id'   => $product_id,
			'qty'          => $qty,
			'created_date' => date('Y-m-d H:i:s'),
			'shipping_cost'=> $product['shipping_cost'] ?? 0,
			'variant'      => json_encode([]),
			'sku'          => '',
			'price'        => 0,
			'total_amount' => 0,
		];

		// === determine stock/sku/price for variant or simple product ===
		if ($product['variant_product'] == 1) {
			// Build selected variant array (cart_variant)
			$cart_variant = [];
			if ($this->input->post('choice_no')) {
				foreach ($this->input->post('choice_no') as $no) {
					$name = 'choice_options_'.$no;
					$val = $this->input->post($name);
					if ($val !== null && $val !== '') {
						$attr = $this->db->where('id', $no)->get('app_attributes')->row_array();
						$attr_name = $attr['name'] ?? 'opt';
						$cart_variant[] = ['name' => $attr_name, 'value' => $val];
					}
				}
			}

			// Build variant string that matches app_product_stocks.variant
			$variant_values = array_map(function($v){ return str_replace(' ', '', $v['value']); }, $cart_variant);
			$variantStr = implode('-', $variant_values);

			$data_stock = $this->find_stock_by_variant($product['id'], $variantStr);

			if (!$data_stock) {
				echo 'ERROR_VARIANT'; // keep old behaviour
				return;
			}
			if ((int)$data_stock['qty'] < $item['qty']) {
				echo 'ERROR_QTY';
				return;
			}

			$item['sku'] = $data_stock['sku'];
			$item['variant'] = json_encode($cart_variant);
			$item['price'] = ((float)$data_stock['discount'] > 0) ? (float)$data_stock['discount'] : (float)$data_stock['price'];
			$item['total_amount'] = $item['qty'] * $item['price'];

		} else {
			// Simple product -> use stock row
			$stock = $this->db->where('product_id', $product['id'])->get('app_product_stocks')->row_array();
			if (!$stock) {
				echo json_encode(['status'=>'error','msg'=>'Stock not found']);
				return;
			}
			if ((int)$stock['qty'] < $item['qty']) {
				echo 'ERROR_QTY';
				return;
			}
			$item['sku'] = $stock['sku'];
			$item['price'] = ((float)$stock['discount'] > 0) ? (float)$stock['discount'] : (float)$stock['price'];
			$item['total_amount'] = $item['qty'] * $item['price'];
		}

		// === Persist: DB for logged-in, session for guest ===
		if ($isLoggedIn) {
			$user_id = $this->session->userdata('user_id');

			// Check existing item
			$exist = $this->db
				->where('user_id', $user_id)
				->where('product_id', $item['product_id'])
				->where('sku', $item['sku'])
				->where('price', $item['price'])
				->get('app_cart')
				->row_array();

			if ($exist) {
				// Update qty & total
				$this->db->where('id', $exist['id'])
						->set('qty', 'qty + ' . (int)$item['qty'], false)
						->set('total_amount', 'total_amount + ' . (float)$item['total_amount'], false)
						->update('app_cart');
			} else {
				$item['user_id'] = $user_id;
				$item['session_id'] = 0;
				$this->db->insert('app_cart', $item);
			}
		} else {
			// Guest: persist in DB by session_id to stay compatible with header/cart/checkout flows
			$session_id = isset($_COOKIE['session_id']) ? $_COOKIE['session_id'] : session_id();
			if (!$session_id) {
				$session_id = bin2hex(random_bytes(16));
			}

			$exist = $this->db
				->where('session_id', $session_id)
				->where('product_id', $item['product_id'])
				->where('sku', $item['sku'])
				->where('price', $item['price'])
				->get('app_cart')
				->row_array();

			if ($exist) {
				$this->db->where('id', $exist['id'])
						->set('qty', 'qty + ' . (int)$item['qty'], false)
						->set('total_amount', 'total_amount + ' . (float)$item['total_amount'], false)
						->update('app_cart');
			} else {
				$item['user_id'] = 0;
				$item['session_id'] = $session_id;
				$this->db->insert('app_cart', $item);
			}
		}

		// Return JSON success (front-end should read this)
		$cart_count = $this->get_cart_count();
		echo json_encode(['status'=>'success','cart_count' => $cart_count]);
	}
	private function get_cart_count()
	{
		$items = $this->get_cart_items();
		$count = 0;
		foreach ($items as $it) $count += (int)$it['qty'];
		return $count;
	}
	private function get_cart_items()
{
    if (!isset($this->session)) $this->load->library('session');

    if ($this->session->userdata('user_loggedin')) {
        $user_id = $this->session->userdata('user_id');
        $rows = $this->db->where('user_id', $user_id)->get('app_cart')->result_array();
        return $rows ?: [];
    } else {
		$session_id = isset($_COOKIE['session_id']) ? $_COOKIE['session_id'] : '';
		if (!$session_id) return [];
		$rows = $this->db->where('session_id', $session_id)->get('app_cart')->result_array();
		return $rows ?: [];
    }
}

private function normalize_variant_string($value)
{
	$value = strtolower((string)$value);
	$value = preg_replace('/[^a-z0-9]/', '', $value);
	return $value;
}

private function find_stock_by_variant($product_id, $variantStr)
{
	$stock = $this->db
		->where('product_id', $product_id)
		->where('variant', $variantStr)
		->get('app_product_stocks')
		->row_array();

	if (!empty($stock)) {
		return $stock;
	}

	$target = $this->normalize_variant_string($variantStr);
	if ($target === '') {
		return [];
	}

	$stocks = $this->db->where('product_id', $product_id)->get('app_product_stocks')->result_array();
	$best = [];
	$bestScore = -1;

	foreach ($stocks as $row) {
		$candidate = $this->normalize_variant_string($row['variant']);
		if ($candidate === '') {
			continue;
		}

		$score = -1;
		if ($candidate === $target) {
			$score = 1000;
		} elseif (strpos($candidate, $target) !== false || strpos($target, $candidate) !== false) {
			$score = 700 - abs(strlen($candidate) - strlen($target));
		}

		if ($score > $bestScore) {
			$bestScore = $score;
			$best = $row;
		}
	}

	return ($bestScore >= 0) ? $best : [];
}



	

    
}
