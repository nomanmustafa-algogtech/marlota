<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Orders extends REST_Controller
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
    
    public function getOrders_post(){
        $orderArray = array();
        if($this->input->post('fromTime') && $this->input->post('toTime')){
            
           $fromTime = date('Y-m-d H:i:s', strtotime($this->input->post('fromTime')));
           $totime = date('Y-m-d H:i:s', strtotime($this->input->post('toTime')));
           $orders =  $this->db->query("select * from app_orders WHERE updated_date >= '$fromTime' && updated_date <= '$totime' AND status > 0")->result_array();
           $orderArray = array();
           foreach($orders as $order)
               $orderArray[] = $this->getOrderDetail($order['id']);
           }
				
    		$status = REST_Controller::HTTP_OK;
            // Prepare the response
            $response = $orderArray;
            $this->set_response($response, $status);
            return;
           
    }
    
    function getOrderDetail($id){
        $orderdetails =  $this->db->query("select * from app_orders where id='$id'")->row_array();
       $customer =  $this->db->query("SELECT * FROM app_users WHERE id = '{$orderdetails['user_id']}'")->row_array();
       $orderdetails['customer_name'] = $customer['full_name'];
       $orderdetails['customer_email'] = $customer['email'];
       $billingdetails =  $this->db->query("select * from app_address where id='{$orderdetails['shipping_address']}'")->row_array();
       $details =  $this->db->query("select * from app_order_details where order_id='$id'")->result_array();
       $orderedproducts=array();
       
      foreach($details as $v){
           
          $productid = $v['product_id'];
          $orderquantity = $v['qty'];
          
          $products =  $this->db->query("select `app_products`.*,`app_categories`.`name` from app_products inner join app_categories on (`app_categories`.`id`=`app_products`.`category_id`) where app_products.id={$productid}")->row_array();
          $products['orderquantity'] =$orderquantity;
          
         
            $products['sku'] = $v['sku'];
          
          array_push($orderedproducts,$products);
       }
       
       $data = array(
                        "errors"=>0,
                        "orderdetails"=>$orderdetails,
                        "orderedproducts"=>$orderedproducts,
                        "billing_details"=>$billingdetails
                    );
       return $data; 
    }
    
    
    
}