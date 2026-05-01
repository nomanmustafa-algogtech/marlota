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
     $this->settings = array();
     $settings = $this->db->select("*")->from('app_settings')->get()->result_array();
	    foreach($settings as $row){
	        $this->settings[$row['name']] = $row['value'];
	    }
     
    }
    
    public function getProducts_get()
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
               
                $products = $this->db->query("SELECT p.id, p.name, p.thumbnail_img, p.rating, c.name as category_name FROM app_products p, app_categories c WHERE c.id = p.category_id && p.vendor_id = '$user_id'")->result_array();
                foreach($products as $k=>$product){
                    $products[$k]['sold'] = $this->db->query("SELECT IFNULL(SUM(qty), 0) as qty FROM app_order_details WHERE product_id = '{$product['id']}' && status = '100'")->row()->qty;
                }
                
                $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Data Returned', 'data' => $products];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    public function getCategories_get()
    {
        
      
        $categories = array();
        $level0 = $this->db->query("SELECT * FROM app_categories WHERE level = 0 ORDER BY name")->result_array();
        foreach($level0 as $cat0){
            $categories[] = array('id'=>$cat0['id'], 'name'=>$cat0['name']);
            $level1 = $this->db->query("SELECT * FROM app_categories WHERE level = 1 && parent_id = '{$cat0['id']}' ORDER BY name")->result_array();
            foreach($level1 as $cat1){
                $categories[] = array('id'=>$cat1['id'], 'name'=>' - '.$cat1['name']);
                $level2 = $this->db->query("SELECT * FROM app_categories WHERE level = 2 && parent_id = '{$cat1['id']}' ORDER BY name")->result_array();
                foreach($level2 as $cat2){
                    $categories[] = array('id'=>$cat2['id'], 'name'=>' - - '.$cat2['name']);
                }
            }
        }
        
        $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Data Returned', 'data' => $categories];

        $this->set_response($response, REST_Controller::HTTP_OK);
        return;
           
    }
    
    public function getBrands_get()
    {
        
      
        $brands = $this->db->query("SELECT * FROM app_brands ORDER BY name")->result_array();
        
        $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Data Returned', 'data' => $brands];

        $this->set_response($response, REST_Controller::HTTP_OK);
        return;
           
    }
    
    public function getAttributes_get()
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
               
                $attributes = $this->db->query("SELECT * FROM app_attributes WHERE vendor_id = '$user_id' order by name asc")->result_array();
                foreach($attributes as $k=>$attribute){
                  $attributes[$k]['values'] =  $this->db->query("SELECT * FROM app_attribute_values WHERE attribute_id = '{$attribute['id']}'")->result_array();
                }
                $attribute_values = 
                $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Data Returned', 'data' => $attributes];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    public function getAttributeById_get($attr_id)
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
               
                $attributes = $this->db->query("SELECT * FROM app_attributes WHERE vendor_id = '$user_id' && id = '$attr_id' order by name asc")->row_array();
                
                $attributes['values'] =  $this->db->query("SELECT * FROM app_attribute_values WHERE attribute_id = '{$attributes['id']}'")->result_array();
                
                $attribute_values = 
                $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Data Returned', 'data' => $attributes];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    public function addAttributes_post()
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
               
                $attribute_name = $this->post('attribute_name');
                $attribute_values = $this->post('attribute_values');
                
                $data['name'] = $attribute_name;
    		    $data['vendor_id'] = $user_id;
    		    $data['created_date']   =   date('Y-m-d H:i:s');
    		    
    		    $check_name = $this->db->select('*')->from('app_attributes')->where(array('name', $data['name'], 'vendor_id'=>$user_id))->get()->num_rows();
    		    if($check_name > 0){
    		        $response = ['status' => REST_Controller::HTTP_BAD_REQUEST, 'msg'=> 'Attribute Name Already Found.'];

                    $this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);
                    return;
    		    }
    		    
    		    $this->db->insert('app_attributes', $data);
                $attribute_id = $this->db->insert_id();
                $data = array();
                foreach($attribute_values as $value){
                    $data['attribute_id'] = $attribute_id;
        		    $data['value'] = $value;
        		    $data['created_date']   =   date('Y-m-d H:i:s');
        		    $this->db->insert('app_attribute_values', $data);
                }
                $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Attribute added Successfully.'];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    public function updateAttributes_post()
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
                
                $attribute_id = $this->post('attribute_id');
                $attribute_name = $this->post('attribute_name');
                $attribute_values = $this->post('attribute_values');
                
                $data['name'] = $attribute_name;
    		    
    		    
    		    $check_name = $this->db->select('*')->from('app_attributes')->where(array('name'=>$data['name'], 'id!='=>$attribute_id, 'vendor_id'=>$user_id))->get()->num_rows();
    		    if($check_name > 0){
    		        $response = ['status' => REST_Controller::HTTP_BAD_REQUEST, 'msg'=> 'Attribute Name Already Found.'];

                    $this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);
                    return;
    		    }
    		    $this->db->where(array('id'=>$attribute_id, 'vendor_id'=>$user_id));
    		    $this->db->update('app_attributes', $data);
    		    
    		    $this->db->where("attribute_id", $attribute_id);
    		    $this->db->delete("app_attribute_values");
    		   
                $data = array();
                foreach($attribute_values as $value){
                    $data['attribute_id'] = $attribute_id;
        		    $data['value'] = $value;
        		    $data['created_date']   =   date('Y-m-d H:i:s');
        		    $this->db->insert('app_attribute_values', $data);
                }
                $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Attribute updated Successfully.'];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    public function deleteAttributes_post()
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
               
                $attribute_id = $this->post('id');
                $check_products = $this->db->select("*")->from("app_products")->like('attributes', '"'.$attribute_id.'"')->get();
                if($check_products->num_rows() > 0){
                    $response = ['status' => REST_Controller::HTTP_BAD_REQUEST, 'msg'=> 'This attribute is using some of your products.'];

                    $this->set_response($response, REST_Controller::HTTP_BAD_REQUEST);
                    return;
                }
                
                $this->db->where("attribute_id", $attribute_id);
                $this->db->delete("app_attribute_values");
                
                $this->db->where("id", $attribute_id);
                $this->db->delete("app_attributes");
                
                $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Attribute deleted Successfully.'];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    public function sku_combination_post()
    {
        $options = array();
        
        $colors_active = 0;
        
        $product_name = $this->post('product_name');
        // echo $product_name;
        // exit;
       
        if($this->post('choice_no')){
            foreach ($this->post('choice_no') as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                $valarray = $this->post($name);
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
        $data['colors_active'] = $colors_active;
        $data['unit_price'] = 0;
        $data['product_name'] = $product_name;
        $strdata = array();
        if(count($combinations) > 0) { if(count($combinations[0]) > 0){
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
		        array_push($strdata,$str);
		    }}
        }}
        
        $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Data Loaded', 'data'=>$strdata];

        $this->set_response($response, REST_Controller::HTTP_OK);
        return;
    }
    
    public function addProduct_post()
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
               
                
                
                $dataProduct['name'] = $this->post('name');
    		    $dataProduct['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($this->post('name')))).'-'.$this->Base_model->randomString(8).'-'.$this->Base_model->randomString(8);
    		    
    		    
    		    $dataProduct['vendor_id'] = $user_id;
    		    $dataProduct['user_id'] = $user_id;
    		    $dataProduct['brand_id'] = $this->post('brand_id');
    		    $dataProduct['category_id'] = $this->post('category_id');
    		    $dataProduct['supplier_id'] = 0;
    		    $dataProduct['tags'] = implode(', ', $this->post('tags'));
    		    $dataProduct['description'] = $this->post('description');
    		    $dataProduct['unit_price'] = $this->post('unit_price');
    		    $dataProduct['published'] = $this->post('published');
    		    $dataProduct['featured'] = 0;
    		    $timestamp = strtotime(date('Y-m-d H:i:s'));
    		    $imt = 'product';
    		    
    		    copy($this->post('thumbnail'), 'uploads/products_temp/'.$imt.'_thumbnail_'.$timestamp . '.jpeg');
    		    
                $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
            	$img_uploaded = $this->Base_model->resize_img('uploads/products_temp/'.$imt.'_thumbnail_'.$timestamp . '.jpeg', "uploads/products/".$img);
            	if($img_uploaded){
            	    $dataProduct['thumbnail_img'] = $img;
            	}else{
            	    $dataProduct['thumbnail_img'] = '';
            	    $dataProduct['published'] = 0;
            	}
            	
            	@unlink('uploads/products_temp/'.$imt.'_thumbnail_'.$timestamp . '.jpeg');
                $gphotos = '';
                $extension=array("jpeg","jpg","png","gif");
                foreach($this->post('gallery_images') as $key=>$tmp_name) {
                    // echo $tmp_name;
                    
                    if($tmp_name != 'undefined' && $tmp_name != ''){
                        copy($tmp_name, 'uploads/products_temp/'.$imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg');
                        $img_file_name = $imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg';
                        $img_uploaded = $this->Base_model->resize_img('uploads/products_temp/'.$imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg', "uploads/products/".$img_file_name);
                        if($img_uploaded){
                            $gphotos .= $img_file_name.',';
                        }
                        @unlink('uploads/products_temp/'.$imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg');
                    }
                    
                }
                $dataProduct['photos'] = rtrim($gphotos, ',');
                
                $dataProduct['shipping_cost'] = $this->post('shipping_cost');
                $dataProduct['discount'] = $this->post('discount');
                $dataProduct['meta_title'] =$this->post('name');
                $dataProduct['meta_description'] = $this->post('description');
                $dataProduct['approved'] = 0;
                
                
                $choice_options = array();
    
                if($this->post('choice_no')){
                    foreach ($this->post('choice_no') as $key => $no) {
                        $str = 'choice_options_'.$no;
        
                        $item['attribute_id'] = $no;
        
                        $data = array();
                        // foreach (json_decode($request[$str][0]) as $key => $eachValue) {
                        if($this->post($str)){
                            foreach ($this->post($str) as $key => $eachValue) {
                                // array_push($data, $eachValue->value);
                                array_push($data, $eachValue);
                            }
                        }
                        
        
                        $item['values'] = $data;
                        array_push($choice_options, $item);
                    }
                }
        
                if (!empty($this->post('choice_no'))) {
                    $dataProduct['attributes'] = json_encode($this->post('choice_no'));
                }
                else {
                    $dataProduct['attributes'] = json_encode(array());
                }
        
                $dataProduct['choice_options']= json_encode($choice_options, JSON_UNESCAPED_UNICODE);
    		    
    		    $this->db->insert('app_products', $dataProduct);
    		    $product_id = $this->db->insert_id();
    		    
    		    $options = array();
                
        
                if($this->post('choice_no')){
                    foreach ($this->post('choice_no') as $key => $no) {
                        $name = 'choice_options_'.$no;
                        $data = array();
                        if($this->post($name)){
                            foreach ($this->post($name) as $key => $eachValue) {
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
                        $product_stock['variant'] = $str;
                        $product_stock['price']= $this->post('price_'.str_replace('.', '_', $str));
                        $product_stock['sku'] = $this->post('sku_'.str_replace('.', '_', $str));
                        $product_stock['qty'] = $this->post('qty_'.str_replace('.', '_', $str));
                        $product_stock['discount'] = $this->post('discount_'.str_replace('.', '_', $str));
                        
                        
                        
                        $imt = 'product';
                        $imgpost = 'img_'.str_replace('.', '_', $str);
                        
                        
                        if($this->post($imgpost)){
                            if($this->post($imgpost) != 'undefined' && $this->post($imgpost) != ''){
                                copy($this->post($imgpost), 'uploads/products_temp/'.$imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg');
                                $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                                $img_uploaded = $this->Base_model->resize_img('uploads/products_temp/'.$imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg', "uploads/products/".$img);
                                if($img_uploaded){
                                    $product_stock['image'] = $img;
                                }
                                 @unlink('uploads/products_temp/'.$imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg');
                            }
                        }
                        
                        $this->db->insert('app_product_stocks', $product_stock);
                    }
                }else{
                    
                    $product_stock['product_id'] = $product_id;
                    $product_stock['variant'] = '';
                    $product_stock['price']= $this->post('unit_price');
                    $product_stock['sku'] = $this->post('sku');
                    $product_stock['qty'] = $this->post('qty');
                    $product_stock['discount'] = $this->post('discount');
                    $this->db->insert('app_product_stocks', $product_stock);
                    
                }}
                else{
                    $product_stock['product_id'] = $product_id;
                    $product_stock['variant'] = '';
                    $product_stock['price']= $this->post('unit_price');
                    $product_stock['sku'] = $this->post('sku');
                    $product_stock['qty'] = $this->post('qty');
                    $product_stock['discount'] = $this->post('discount');
                    $this->db->insert('app_product_stocks', $product_stock);
                }
                
                $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Product added successfully.'];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    public function getProductById_get($product_id)
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
               
                $data['product'] = $this->db->query("SELECT * FROM app_products WHERE id = '$product_id' && vendor_id = '$user_id'")->row_array();
                $data['product']['choice_options'] = json_decode($data['product']['choice_options']);
                $data['stocks'] = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '$product_id'")->result_array();
               
                $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Data Returned', 'data' => $data];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    
    public function updateProduct_post()
    {
        
       $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);

            // return response if token is valid
            if ($decodedToken != false) {
                $user_id = $decodedToken->id;
               
                $product_id = $this->post('product_id');
                
                $dataProduct['name'] = $this->post('name');
    		    $dataProduct['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($this->post('name')))).'-'.$this->Base_model->randomString(8).'-'.$this->Base_model->randomString(8);
    		    
    		    
    		    $dataProduct['brand_id'] = $this->post('brand_id');
    		    $dataProduct['category_id'] = $this->post('category_id');
    		    $dataProduct['supplier_id'] = 0;
    		    $dataProduct['tags'] = implode(', ', $this->post('tags'));
    		    $dataProduct['description'] = $this->post('description');
    		    $dataProduct['unit_price'] = $this->post('unit_price');
    		    $dataProduct['published'] = $this->post('published');
    		    $dataProduct['featured'] = 0;
    		    $timestamp = strtotime(date('Y-m-d H:i:s'));
    		    $imt = 'product';
    		    
    		    if (strpos($this->post('thumbnail'), 'beaters.pk') !== false) {
    		        
    		    }else{
    		        copy($this->post('thumbnail'), 'uploads/products_temp/'.$imt.'_thumbnail_'.$timestamp . '.jpeg');
    		    
                    $img = $imt.'_thumbnail_'.$timestamp . '.jpeg';
                	$img_uploaded = $this->Base_model->resize_img('uploads/products_temp/'.$imt.'_thumbnail_'.$timestamp . '.jpeg', "uploads/products/".$img);
                	if($img_uploaded){
                	    $dataProduct['thumbnail_img'] = $img;
                	}else{
                	    $dataProduct['thumbnail_img'] = '';
                	    $dataProduct['published'] = 0;
                	}
                	
                	@unlink('uploads/products_temp/'.$imt.'_thumbnail_'.$timestamp . '.jpeg');
    		    }
    		    
    		    
                $gphotos = '';
                $extension=array("jpeg","jpg","png","gif");
                foreach($this->post('gallery_images') as $key=>$tmp_name) {
                    // echo $tmp_name;
                    
                    if($tmp_name != 'undefined' && $tmp_name != ''){
                        if (strpos($tmp_name, 'beaters.pk') !== false) {
                            
                        }else{
                            copy($tmp_name, 'uploads/products_temp/'.$imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg');
                            $img_file_name = $imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg';
                            $img_uploaded = $this->Base_model->resize_img('uploads/products_temp/'.$imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg', "uploads/products/".$img_file_name);
                            if($img_uploaded){
                                $gphotos .= $img_file_name.',';
                            }
                            @unlink('uploads/products_temp/'.$imt.'_gallery_'.$key.'_'.$timestamp.'.jpeg');
                        }
                        
                    }
                    
                }
                $dataProduct['photos'] = rtrim($gphotos, ',');
                
                $dataProduct['shipping_cost'] = $this->post('shipping_cost');
                $dataProduct['discount'] = $this->post('discount');
                $dataProduct['meta_title'] =$this->post('name');
                $dataProduct['meta_description'] = $this->post('description');
                $dataProduct['approved'] = 0;
                
                
                $this->db->where('id', $product_id);
    		    $this->db->update('app_products', $dataProduct);
    		    
    		    
                
                if($this->post('variants')){
                    foreach ($this->post('variants') as $key => $str){
                        $product_stock = array();
                        $product_stock['price']= $this->post('price_'.str_replace('.', '_', $str));
                        $product_stock['sku'] = $this->post('sku_'.str_replace('.', '_', $str));
                        $product_stock['qty'] = $this->post('qty_'.str_replace('.', '_', $str));
                        $product_stock['discount'] = $this->post('discount_'.str_replace('.', '_', $str));
                        
                        
                        
                        $imt = 'product';
                        $imgpost = 'img_'.str_replace('.', '_', $str);
                        
                        
                        if($this->post($imgpost)){
                            if($this->post($imgpost) != 'undefined' && $this->post($imgpost) != ''){
                                if (strpos($this->post($imgpost), 'beaters.pk') !== false) {
                            
                                }else{
                                    copy($this->post($imgpost), 'uploads/products_temp/'.$imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg');
                                    $img = $imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg';
                                    $img_uploaded = $this->Base_model->resize_img('uploads/products_temp/'.$imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg', "uploads/products/".$img);
                                    if($img_uploaded){
                                        $product_stock['image'] = $img;
                                    }
                                    @unlink('uploads/products_temp/'.$imt.'_vari_'.$imgpost.'_'.$timestamp . '.jpeg');
                                }
                            }
                        }
                        
                        $this->db->where(array('product_id'=>$product_id, 'variant'=>$str));
                        $this->db->update('app_product_stocks', $product_stock);
                    }
                }else{
                    
                    $product_stock['product_id'] = $product_id;
                    $product_stock['variant'] = '';
                    $product_stock['price']= $this->post('unit_price');
                    $product_stock['sku'] = $this->post('sku');
                    $product_stock['qty'] = $this->post('qty');
                    $product_stock['discount'] = $this->post('discount');
                    
                    $this->db->where('product_id', $product_id);
                    $this->db->update('app_product_stocks', $product_stock);
                    
                }
                
                $response = ['status' => REST_Controller::HTTP_OK, 'msg'=> 'Product updated successfully.'];

                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
                
            }
        }
        
                // Prepare the response
        $response = ['status' => REST_Controller::HTTP_UNAUTHORIZED, 'msg' => "Unauthorised Token"];

        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
       
    }
    
    
}