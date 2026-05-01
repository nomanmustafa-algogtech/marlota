<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends My_controller {
    
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
    
    public function view($id, $status = 0)
	{
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		$order=$this->db->query("SELECT * FROM app_orders where id = '$id'")->row_array();
		
	
		
		if(count($order) < 1){
		    redirect('admin/home');
		    exit;
		}
		
		if($status != 0){
		    $now = date('Y-m-d H:i:s');
		    $this->db->query("update app_orders set status = '$status', updated_date = '$now' where id = '$id'");
		    $this->set_message('success', "Order status has been updated");
		    redirect('admin/orders/view/'.$id);
        	exit();
		}
		
		
		if($this->input->post()){
		    if($order['status']!=0){
		        exit;
		    }
		    $orderdtids = $this->input->post("orderdt_id");
		    $qtys = $this->input->post("qty");
		    $total_amount = 0;
		    foreach($orderdtids as $k=>$orderdt_id){
		       if($qtys[$k] < 1){
		           $this->db->query("delete from app_order_details where id = '$orderdt_id' && order_id = '$id'");
		       }else{
		           $orderdt = $this->db->query("select * from app_order_details where id = '$orderdt_id' && order_id = '$id'")->row_array();
		           $tamount = $qtys[$k]*$orderdt['price'];
		           $this->db->query("update app_order_details set qty = '{$qtys[$k]}', total_amount = '$tamount' where id = '$orderdt_id'  && order_id = '$id'");
		           $total_amount += $tamount;
		       }
		    }
		    
		    $this->db->query("update app_orders set total_amount = '$total_amount' where id = '$id'");
		    
		    
		    if($total_amount > $order['total_amount']){
		        $amountDeduct = $total_amount-$order['total_amount'];
		        $this->db->query("update app_users set balance = balance - '$amountDeduct' where id = '{$order['user_id']}'");
		    }
		    
		    if($total_amount < $order['total_amount']){
		        $amountRefund = $order['total_amount']-$total_amount;
		        $this->db->query("update app_users set balance = balance + '$amountRefund' where id = '{$order['user_id']}'");
		    }
		    
		    $this->set_message('success', "Order details has been updated");
		    redirect('admin/orders/view/'.$id);
        	exit();
		}
		
	    $this->title = "Order # ".$id." - View Order || ".$this->admintitle;
		
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
	    
	    $data['order'] = $order;
		
        $this->load_admin('orders/view_order',$data);
	}
    
    public function new_orders()
	{
		if (!$this->auth->is_logged()) {
			redirect('admin/authentication');
			exit();
		}

		$this->title = "New Orders || " . $this->admintitle;

		$data['view_scripts'] = [
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
		];

		$data['view_css'] = [
			$this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		];

		// Fetch only new orders (guest + users)
		$data['orders'] = $this->db
			->order_by('id', 'ASC')
			->get_where('app_orders', ['status' => 0])
			->result_array();
			// echo 'data: <pre>' .print_r($data,true). '</pre>'; 

		$this->load_admin('orders/new_orders', $data);
	}
	// public function new_orders()
	// {
	//     if (!$this->auth->is_logged()) {
    //         redirect('admin/authentication');
    //         exit();
	// 	}
		
		
	// 	// 		if($this->input->post()){
	// 	// 		    $status = $this->input->post('status');
	// 	// 		    $orderids = $this->input->post('orderid');
	// 	// 		    if(count($orderids) < 1){
	// 	//                 $this->set_message('error', "Please select atleast on order to print.");
	// 	//     		    redirect('admin/orders/new_orders');
	// 	//             	exit();
	// 	//             }
					
	// 	//             foreach($orderids as $order){
	// 	//                     $this->db->where('id', $order);
	// 	//                     $this->db->update('app_order_details', array('status'=>$status));
	// 	//                     $order_detail = $this->db->query("SELECT * FROM app_order_details where id = '$order'")->row_array();
	// 	//                     $order = $this->db->query("SELECT * FROM app_orders where id = '{$order_detail['order_id']}'")->row_array();
	// 	//                     if($status==1){
	// 	//                         // $user = $this->db->query("SELECT * FROM app_users WHERE id = '{$order['user_id']}'")->row_array();
	// 	//                         // $sms = "Dear ".$user['full_name'].", We are pleased to inform you that your order # ".$order['id']." has been processed and it will be out for delivery soon as soon";
	// 	//                         // $this->Base_model->sendSMS("BEATERS", $user['phone'], $sms);
	// 	//                     }else{
	// 	//                         if($status == 11){
	// 	//                             $cancleReason = "Return for refund";
	// 	//                         }elseif($status == 12){
	// 	//                             $cancleReason = "Not Delivered";
	// 	//                         }elseif($status == 13){
	// 	//                             $cancleReason = "Cancelled by Customer";
	// 	//                         }elseif($status == 14){
	// 	//                             $cancleReason = "Out of Stock";
	// 	//                         }elseif($status == 15){
	// 	//                             $cancleReason = "Lost/Stolen";
	// 	//                         }
	// 	//                         $user = $this->db->query("SELECT * FROM app_users WHERE id = '{$order['user_id']}'")->row_array();
	// 	//                         $sms = "Dear ".$user['full_name'].", We are sorry to inform you that an item from your order # ".date('y', strtotime($order['created_date'])).$order['id']." has been canceled. ".PHP_EOL."Reason: $cancleReason";
	// 	//                         $this->Base_model->sendSMS("BEATERS", $user['phone'], $sms);
	// 	//                     }
	// 	//             }
					
	// 	//             if($status==1){
	// 	//                 require_once FCPATH.'vendor/autoload.php';
				
	// 	//                 $mpdf = new \Mpdf\Mpdf([
	// 	//                     'mode' => 'utf-8',
	// 	//                     'format' => 'A4',
	// 	//                     'margin_left' => 5,
	// 	//                     'margin_right' => 5,
	// 	//                     'margin_top' => 10,
	// 	//                     'margin_bottom' => 10,
	// 	//                     'margin_header' => 0,
	// 	//                     'margin_footer' => 0,
	// 	//                     ]);
	// 	//                 $mpdf->SetDisplayMode('fullpage');
						
						
	// 	//                 foreach($orderids as $order){
	// 	//                       $orderdt = $this->db->query("SELECT * FROM app_order_details where id = '$order'")->row_array();
	// 	//                       $html =  $this->load->view('print_templates/order_print', array('orderdt'=>$orderdt), TRUE);
								
	// 	//                         $mpdf->AddPage();
	// 	//                         $mpdf->WriteHTML(file_get_contents(base_url('adminfiles/css/kv-mpdf-bootstrap.css')), \Mpdf\HTMLParserMode::HEADER_CSS);
	// 	//                         $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
							
	// 	//                 }
	// 	//                 $mpdf->Output('Orders_'.date('Y-m-d H:i:s'),'I');
	// 	//             }
					
	// 	//             $this->set_message('success', "Selected orders status has been changed.");
	// 	// 		    redirect('admin/orders/new_orders');
	// 	//         	exit();
					
	// 	// 		}
	//     $this->title = "New Orders || ".$this->admintitle;
		
	// 	$data['view_scripts']=array(
	// 	    $this->Gen->get_admin_url('libs/datatables.net/js/jquery.dataTables.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive/js/dataTables.responsive.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/dataTables.buttons.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.html5.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.flash.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.print.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-keytable/js/dataTables.keyTable.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-select/js/dataTables.select.min.js'),
	// 	    $this->Gen->get_admin_url('js/custom/product.js'),
	// 	);
	// 	$data['view_css']=array(
	// 	    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
	// 	);
	    
	//     $data['orders'] = $this->db->select("*")->from('app_orders')->where('status', 0)->order_by('id', 'ASC')->get()->result_array();
		
    //     $this->load_admin('orders/new_orders',$data);
	// }
	
	// public function processing_orders()
	// {
	//     if (!$this->auth->is_logged()) {
    //         redirect('admin/authentication');
    //         exit();
	// 	}
		
		
	// 	// 		if($this->input->post()){
	// 	// 		    $status = $this->input->post('status');
	// 	// 		    $orderids = $this->input->post('orderid');
	// 	// 		    if(count($orderids) < 1){
	// 	//                 $this->set_message('error', "Please select atleast on order.");
	// 	//     		    redirect('admin/orders/processing_orders');
	// 	//             	exit();
	// 	//             }
					
					
	// 	//             foreach($orderids as $orderid){
						
	// 	//                 $data['status'] = $status;
	// 	//                  $order_detail = $this->db->query("SELECT * FROM app_order_details where id = '$orderid'")->row_array();
	// 	//                     $order = $this->db->query("SELECT * FROM app_orders where id = '{$order_detail['order_id']}'")->row_array();
	// 	//                 if($status == 100){
						
	// 	//                     $user_id = $order['user_id'];
	// 	//                     $total_amount = $order_detail['total_amount'];
							
	// 	//                     $cashback_total = ($total_amount/100);
							
	// 	//                     $user_cashback = ($cashback_total*10)/100;
	// 	//                     $level1_cashback = ($cashback_total*20)/100;
	// 	//                     $level2_cashback = ($cashback_total*30)/100;
	// 	//                     $level3_cashback = ($cashback_total*40)/100;
							
							
	// 	//                     $this->db->query("update app_users set balance = balance + '$user_cashback' WHERE id = '$user_id'");
							
	// 	//                     $referrals = $this->db->query("SELECT * FROM `app_referrals` WHERE referral_id = '$user_id'")->result_array();
	// 	//                     foreach($referrals as $ref){
	// 	//                         if($ref['level'] == 1){
	// 	//                             $this->db->query("update app_users set balance = balance + '$level1_cashback' WHERE id = '{$ref['user_id']}'");
	// 	//                         }elseif($ref['level'] == 2){
	// 	//                             $this->db->query("update app_users set balance = balance + '$level2_cashback' WHERE id = '{$ref['user_id']}'");
	// 	//                         }elseif($ref['level'] == 3){
	// 	//                             $this->db->query("update app_users set balance = balance + '$level3_cashback' WHERE id = '{$ref['user_id']}'");
	// 	//                         }
								
	// 	//                     }
							
	// 	//                     $data['cashback_sent'] = 1;
							
	// 	//                     $user = $this->db->query("SELECT * FROM app_users WHERE id = '{$order['user_id']}'")->row_array();
	// 	//                     $sms = "Dear ".$user['full_name'].", an item from your order no. ".date('y', strtotime($order['created_date'])).$order['id']." is delivered successfully by Beaters Express. Share your experience with Feedback";
	// 	//                     $this->Base_model->sendSMS("BEATERS", $user['phone'], $sms);
	// 	//                 }else if($status == 2){
	// 	//                     // exit;
	// 	//                     $user = $this->db->query("SELECT * FROM app_users WHERE id = '{$order['user_id']}'")->row_array();
	// 	//                     $sms = "Dear ".$user['full_name'].", an item from your order No. ".date('y', strtotime($order['created_date'])).$order['id']." is out for delivery and will be with you soon. Thank you.";
	// 	//                     $this->Base_model->sendSMS("BEATERS", $user['phone'], $sms);
	// 	//                 }else{
	// 	//                     if($status == 11){
	// 	//                         $cancleReason = "Return for refund";
	// 	//                     }elseif($status == 12){
	// 	//                         $cancleReason = "Not Delivered";
	// 	//                     }elseif($status == 13){
	// 	//                         $cancleReason = "Cancelled by Customer";
	// 	//                     }elseif($status == 14){
	// 	//                         $cancleReason = "Out of Stock";
	// 	//                     }elseif($status == 15){
	// 	//                         $cancleReason = "Lost/Stolen";
	// 	//                     }
	// 	//                     $user = $this->db->query("SELECT * FROM app_users WHERE id = '{$order['user_id']}'")->row_array();
	// 	//                     $sms = "Dear ".$user['full_name'].", We are sorry to inform you that an item from your order # ".date('y', strtotime($order['created_date'])).$order['id']." has been canceled. ".PHP_EOL."Reason: $cancleReason";
	// 	//                     $this->Base_model->sendSMS("BEATERS", $user['phone'], $sms);
	// 	//                 }
						
	// 	//                 $this->db->where('id', $orderid);
	// 	//                 $this->db->update('app_order_details', $data);
	// 	//             }
					
					
	// 	//             $this->set_message('success', "Selected orders status has been changed.");
	// 	// 		    redirect('admin/orders/processing_orders');
	// 	//         	exit();
					
	// 	// 		}
	//     $this->title = "In Prepration || ".$this->admintitle;
		
	// 	$data['view_scripts']=array(
	// 	    $this->Gen->get_admin_url('libs/datatables.net/js/jquery.dataTables.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive/js/dataTables.responsive.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/dataTables.buttons.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.html5.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.flash.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.print.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-keytable/js/dataTables.keyTable.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-select/js/dataTables.select.min.js'),
	// 	    $this->Gen->get_admin_url('js/custom/product.js'),
	// 	);
	// 	$data['view_css']=array(
	// 	    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
	// 	);
	    
	//    $data['orders'] = $this->db->select("*")->from('app_orders')->where('status', 1)->order_by('id', 'ASC')->get()->result_array();
		
    //     $this->load_admin('orders/processing_orders',$data);
	// }
	public function processing_orders()
	{
		if (!$this->auth->is_logged()) {
			redirect('admin/authentication');
			exit();
		}

		$this->title = "In Preparation || " . $this->admintitle;

		$data['view_scripts'] = [
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
		];

		$data['view_css'] = [
			$this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		];

		// Fetch processing orders
		$orders = $this->db
			->where('status', 1)
			->order_by('id', 'ASC')
			->get('app_orders')
			->result_array();

		// Attach buyer info (guest + registered)
		foreach ($orders as &$order) {

			if ((int)$order['guest_user'] === 1) {
					// Guest checkout → billing address
					$address = $this->db
						->select('full_name, email')
						->from('app_address')
						->where('id', $order['billing_address'])
						->get()
						->row_array();

					$order['buyer_name']  = $address['full_name'] ?? 'Guest';
					$order['buyer_email'] = $address['email'] ?? 'N/A';

				} else {
				// Logged-in user → app_users
				$user = $this->db
					->where('id', $order['user_id'])
					->get('app_users')
					->row_array();

				$order['buyer_name']  = $user['full_name'] ?? 'N/A';
				$order['buyer_email'] = $user['email'] ?? 'N/A';
			}
		}

		$data['orders'] = $orders;

		$this->load_admin('orders/processing_orders', $data);
	}

	
	// public function out_for_delivery()
	// {
	//     if (!$this->auth->is_logged()) {
    //         redirect('admin/authentication');
    //         exit();
	// 	}
		
	//     $this->title = "Out for Delivery || ".$this->admintitle;
		
	// 	$data['view_scripts']=array(
	// 	    $this->Gen->get_admin_url('libs/datatables.net/js/jquery.dataTables.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive/js/dataTables.responsive.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/dataTables.buttons.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.html5.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.flash.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.print.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-keytable/js/dataTables.keyTable.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-select/js/dataTables.select.min.js'),
	// 	    $this->Gen->get_admin_url('js/custom/product.js'),
	// 	);
	// 	$data['view_css']=array(
	// 	    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
	// 	);
	    
	//     $data['orders'] = $this->db->select("*")->from('app_orders')->where('status', 2)->order_by('id', 'ASC')->get()->result_array();
		
    //     $this->load_admin('orders/out_for_delivery',$data);
	// }
	public function out_for_delivery()
	{
		if (!$this->auth->is_logged()) {
			redirect('admin/authentication');
			exit();
		}

		$this->title = "Out for Delivery || " . $this->admintitle;

		$data['view_scripts'] = [
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
		];

		$data['view_css'] = [
			$this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		];

		// Fetch out-for-delivery orders
		$orders = $this->db
			->where('status', 2)
			->order_by('id', 'ASC')
			->get('app_orders')
			->result_array();

		// Attach buyer info (guest + registered)
		foreach ($orders as &$order) {

			if ((int)$order['guest_user'] === 1) {
					// Guest checkout → billing address
					$address = $this->db
						->select('full_name, email')
						->from('app_address')
						->where('id', $order['billing_address'])
						->get()
						->row_array();

					$order['buyer_name']  = $address['full_name'] ?? 'Guest';
					$order['buyer_email'] = $address['email'] ?? 'N/A';

			} else {
				// Logged-in user → app_users
				$user = $this->db
					->where('id', $order['user_id'])
					->get('app_users')
					->row_array();

				$order['buyer_name']  = $user['full_name'] ?? 'N/A';
				$order['buyer_email'] = $user['email'] ?? 'N/A';
			}
		}

		$data['orders'] = $orders;
		
		$this->load_admin('orders/out_for_delivery', $data);
	}
	
	// public function all_orders()
	// {
	//     if (!$this->auth->is_logged()) {
    //         redirect('admin/authentication');
    //         exit();
	// 	}
		
		
	// 	// 		if($this->input->post()){
	// 	// 		    $status = $this->input->post('status');
	// 	// 		    $orderids = $this->input->post('orderid');
	// 	// 		    if(count($orderids) < 1){
	// 	//                 $this->set_message('error', "Please select atleast on order.");
	// 	//     		    redirect('admin/orders/processing_orders');
	// 	//             	exit();
	// 	//             }
					
					
	// 	//             foreach($orderids as $order){
	// 	//                 $this->db->where('id', $order);
	// 	//                 $this->db->update('app_orders', array('status'=>$status));
	// 	//             }
					
					
	// 	//             $this->set_message('success', "Selected orders status has been changed.");
	// 	// 		    redirect('admin/orders/processing_orders');
	// 	//         	exit();
					
	// 	// 		}
	//     $this->title = "All Orders || ".$this->admintitle;
		
	// 	$data['view_scripts']=array(
	// 	    $this->Gen->get_admin_url('libs/datatables.net/js/jquery.dataTables.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive/js/dataTables.responsive.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/dataTables.buttons.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.html5.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.flash.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons/js/buttons.print.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-keytable/js/dataTables.keyTable.min.js'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-select/js/dataTables.select.min.js'),
	// 	    $this->Gen->get_admin_url('js/custom/product.js'),
	// 	);
	// 	$data['view_css']=array(
	// 	    $this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
	// 	    $this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
	// 	);
	// 	$data['orders'] = array();
	//     if($this->input->post()){
	        
	//         $whereQuery = "WHERE id > 0";
	//         if($this->input->post('from_date')){
	//             $whereQuery .= " && created_date>='".$this->input->post('from_date')." 00:00:00'";
	//         }
	//         if($this->input->post('to_date')){
	//             $whereQuery .= " && created_date<='".$this->input->post('to_date')." 23:59:59'";
	//         }
	//         if($this->input->post('order_id')){
	//              $whereQuery .= " && id='".$this->input->post('order_id')."'";
	//         }
	        
	//         $orders = $this->db->query("SELECT * FROM app_orders $whereQuery ORDER BY id ASC");
	//         $data['orders'] = $orders->result_array();
	//     }
	    
		
    //     $this->load_admin('orders/all_orders',$data);
	// }
	public function all_orders()
	{
		if (!$this->auth->is_logged()) {
			redirect('admin/authentication');
			exit();
		}

		$this->title = "All Orders || " . $this->admintitle;

		// Scripts
		$data['view_scripts'] = [
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
		];

		// CSS
		$data['view_css'] = [
			$this->Gen->get_admin_url('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'),
			$this->Gen->get_admin_url('libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')
		];

		$data['orders'] = [];

		if ($this->input->post()) {

			$where = "WHERE id > 0";

			if ($this->input->post('from_date')) {
				$where .= " AND created_date >= '" . $this->input->post('from_date') . " 00:00:00'";
			}
			if ($this->input->post('to_date')) {
				$where .= " AND created_date <= '" . $this->input->post('to_date') . " 23:59:59'";
			}
			if ($this->input->post('order_id')) {
				$where .= " AND id = '" . $this->input->post('order_id') . "'";
			}

			// 1. Fetch orders
			$orders = $this->db
				->query("SELECT * FROM app_orders $where ORDER BY id ASC")
				->result_array();

			// 2. Attach buyer info
			foreach ($orders as &$order) {

				if ((int)$order['guest_user'] === 1) {
					// Guest checkout → billing address
					$address = $this->db
						->select('full_name, email')
						->from('app_address')
						->where('id', $order['billing_address'])
						->get()
						->row_array();

					$order['buyer_name']  = $address['full_name'] ?? 'Guest';
					$order['buyer_email'] = $address['email'] ?? 'N/A';

				} else {
					// Logged-in user
					$user = $this->db
						->select('full_name, email')
						->from('app_users')
						->where('id', $order['user_id'])
						->get()
						->row_array();

					$order['buyer_name']  = $user['full_name'] ?? 'N/A';
					$order['buyer_email'] = $user['email'] ?? 'N/A';
				}
			}
			unset($order);

			$data['orders'] = $orders;
		}

		$this->load_admin('orders/all_orders', $data);
	}


	
// 	public function changestatus(){
// 	    if($this->input->post()){
// 		    $status = $this->input->post('status');
// 		    $orderids = $this->input->post('orderid');
// 		    if(count($orderids) < 1){
//                 $this->set_message('error', "Please select atleast on order.");
//     		    redirect('admin/orders/all_orders');
//             	exit();
//             }
            
            
//             if($status=='print'){
//                 require_once FCPATH.'vendor/autoload.php';
        
//                 $mpdf = new \Mpdf\Mpdf([
//                     'mode' => 'utf-8',
//                     'format' => 'A4',
//                     'margin_left' => 5,
//                     'margin_right' => 5,
//                     'margin_top' => 10,
//                     'margin_bottom' => 10,
//                     'margin_header' => 0,
//                     'margin_footer' => 0,
//                     ]);
//                 $mpdf->SetDisplayMode('fullpage');
                
                
//                 foreach($orderids as $order){
//                       $orderdt = $this->db->query("SELECT * FROM app_order_details where id = '$order'")->row_array();
//                       $html =  $this->load->view('print_templates/order_print', array('orderdt'=>$orderdt), TRUE);
                        
//                         $mpdf->AddPage();
//                         $mpdf->WriteHTML(file_get_contents(base_url('adminfiles/css/kv-mpdf-bootstrap.css')), \Mpdf\HTMLParserMode::HEADER_CSS);
//                         $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
                    
//                 }
//                 $mpdf->Output('Orders_'.date('Y-m-d H:i:s'),'I');
//             }else{
//                 foreach($orderids as $orderid){
//                     $data['status'] = $status;
//                     if($status == 100){
//                         $order_detail = $this->db->query("SELECT * FROM app_order_details where id = '$orderid'")->row_array();
//                         $order = $this->db->query("SELECT * FROM app_orders where id = '{$order_detail['order_id']}'")->row_array();
//                         $user_id = $order['user_id'];
//                         $total_amount = $order_detail['total_amount'];
                        
//                         $cashback_total = ($total_amount/100);
                        
//                         $user_cashback = ($cashback_total*10)/100;
//                         $level1_cashback = ($cashback_total*20)/100;
//                         $level2_cashback = ($cashback_total*30)/100;
//                         $level3_cashback = ($cashback_total*40)/100;
                        
                        
//                         $this->db->query("update app_users set balance = balance + '$user_cashback' WHERE id = '$user_id'");
                        
//                         $referrals = $this->db->query("SELECT * FROM `app_referrals` WHERE referral_id = '$user_id'")->result_array();
//                         foreach($referrals as $ref){
//                             if($ref['level'] == 1){
//                                 $this->db->query("update app_users set balance = balance + '$level1_cashback' WHERE id = '{$ref['user_id']}'");
//                             }elseif($ref['level'] == 2){
//                                 $this->db->query("update app_users set balance = balance + '$level2_cashback' WHERE id = '{$ref['user_id']}'");
//                             }elseif($ref['level'] == 3){
//                                 $this->db->query("update app_users set balance = balance + '$level3_cashback' WHERE id = '{$ref['user_id']}'");
//                             }
                            
//                         }
                        
//                         $data['cashback_sent'] = 1;
//                         $user = $this->db->query("SELECT * FROM app_users WHERE id = '{$order['user_id']}'")->row_array();
//                         $sms = "Dear ".$user['full_name'].", an item from your order no. ".date('y', strtotime($order['created_date'])).$order['id']." is delivered successfully by Beaters Express. Share your experience with Feedback";
//                         $this->Base_model->sendSMS("BEATERS", $user['phone'], $sms);
//                     }elseif($status == 11 || $status == 12 || $status == 13 || $status == 14 || $status == 15){
//                         $data['cashback_sent'] = 0;
//                         $order_detail = $this->db->query("SELECT * FROM app_order_details where id = '$orderid'")->row_array();
//                         $order = $this->db->query("SELECT * FROM app_orders where id = '{$order_detail['order_id']}'")->row_array();
//                         $user_id = $order['user_id'];
//                         $total_amount = $order_detail['total_amount'];
                        
//                         if($order['cashback_sent'] == 1){
//                             $cashback_total = ($total_amount/100);
                        
//                             $user_cashback = ($cashback_total*10)/100;
//                             $level1_cashback = ($cashback_total*20)/100;
//                             $level2_cashback = ($cashback_total*30)/100;
//                             $level3_cashback = ($cashback_total*40)/100;
                            
                            
//                             $this->db->query("update app_users set balance = balance - '$user_cashback' WHERE id = '$user_id'");
                            
//                             $referrals = $this->db->query("SELECT * FROM `app_referrals` WHERE referral_id = '$user_id'")->result_array();
//                             foreach($referrals as $ref){
//                                 if($ref['level'] == 1){
//                                     $this->db->query("update app_users set balance = balance - '$level1_cashback' WHERE id = '{$ref['user_id']}'");
//                                 }elseif($ref['level'] == 2){
//                                     $this->db->query("update app_users set balance = balance - '$level2_cashback' WHERE id = '{$ref['user_id']}'");
//                                 }elseif($ref['level'] == 3){
//                                     $this->db->query("update app_users set balance = balance - '$level3_cashback' WHERE id = '{$ref['user_id']}'");
//                                 }
                                
//                             }
//                         }
                        
//                         if($status == 11){
//                             $cancleReason = "Return for refund";
//                         }elseif($status == 12){
//                             $cancleReason = "Not Delivered";
//                         }elseif($status == 13){
//                             $cancleReason = "Cancelled by Customer";
//                         }elseif($status == 14){
//                             $cancleReason = "Out of Stock";
//                         }elseif($status == 15){
//                             $cancleReason = "Lost/Stolen";
//                         }
//                         $user = $this->db->query("SELECT * FROM app_users WHERE id = '{$order['user_id']}'")->row_array();
//                         $sms = "Dear ".$user['full_name'].", We are sorry to inform you an item from that your order # ".date('y', strtotime($order['created_date'])).$order['id']." has been canceled.".PHP_EOL."Reason: $cancleReason";
//                         $this->Base_model->sendSMS("BEATERS", $user['phone'], $sms);
                        
                        
//                     }
                     
//                     $this->db->where('id', $orderid);
//                     $this->db->update('app_order_details', $data);
//                 }
//             }
            
            
            
//             $this->set_message('success', "Selected orders status has been changed.");
// 		    redirect('admin/orders/all_orders');
//         	exit();
		    
// 		}
// 	}
	
	
	public function reviews_approval(){
	     if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
	    $this->title = "Reviews Approval || ".$this->admintitle;
		
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
	    
	    $data['reviews'] = $this->db->select("*")->from('app_product_reviews')->where('approved', 0)->order_by('id', 'ASC')->get()->result_array();
		
        $this->load_admin('orders/reviews_approval',$data);
	}
	
	public function approve_review($id){
	    if (!$this->auth->is_logged()) {
            redirect('admin/authentication');
            exit();
		}
		
		$this->db->query("UPDATE app_product_reviews SET approved = '1' where id = '$id'");
	    $this->set_message('success', "Review has been approved");
	    redirect('admin/orders/reviews_approval');
    	exit();
	}


}
