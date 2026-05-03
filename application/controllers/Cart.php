<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends My_controller {
    function __construct() {
        parent::__construct();
        
        $this->CI = & get_instance();
        $this->load->helper('cookie');
       $this->Base_model->visitor_logs();
    }
    
    
   public function index()
{
    $data['view_scripts'] = array();
    $data['view_css'] = array(
        // $this->Gen->get_web_url('css/ecommerce_web.min.css')
    );

    // ✅ Use the unified helper
    $data['cart'] = $this->get_cart_items();
	// echo 'data: <pre>' .print_r($data,true). '</pre>'; die;
    $this->load_web('cart', $data);
}

/**
 * Get cart items for both logged-in users (DB) and guests (Session)
 */
// private function get_cart_items()
// {
//     if ($this->session->userdata('user_loggedin')) {
//         $user_id = $this->session->userdata('user_id');
//         return $this->db
//             ->where('user_id', $user_id)
//             ->get('app_cart')
//             ->result_array();
			
//     } else {
//         $guest_cart = $this->session->userdata('guest_cart');
// 		// echo 'guest_cart: <pre>' .print_r($guest_cart,true). '</pre>';
//         return is_array($guest_cart) ? $guest_cart : [];
//     }
// }
private function get_cart_items()
{
    $items = [];

    if ($this->session->userdata('user_loggedin')) {

        $user_id = (int) $this->session->userdata('user_id');

        $items = $this->db
            ->select('c.*, p.name, p.slug, p.thumbnail_img')
            ->from('app_cart c')
            ->join('app_products p', 'p.id = c.product_id')
            ->where('c.user_id', $user_id)
            ->get()
            ->result_array();

    } else {
        $session_id = isset($_COOKIE['session_id']) ? $_COOKIE['session_id'] : '';
        if ($session_id) {
            $items = $this->db
                ->select('c.*, p.name, p.slug, p.thumbnail_img')
                ->from('app_cart c')
                ->join('app_products p', 'p.id = c.product_id')
                ->where('c.session_id', $session_id)
                ->get()
                ->result_array();
        }
    }

    return $items;
}
	public function deleteGuestItem($row_key = null) {
        if ($row_key === null) {
            redirect('cart'); // If no key, just redirect
        }

        $guest_cart = $this->session->userdata('guest_cart') ?? [];

        if (isset($guest_cart[$row_key])) {
            unset($guest_cart[$row_key]); // Remove the item
            $guest_cart = array_values($guest_cart); // Re-index array
            $this->session->set_userdata('guest_cart', $guest_cart); // Update session
        }

        redirect('cart'); // Redirect back to cart page
    }

	// public function index()
	// {
		
	// 	$data['view_scripts']=array();
	// 	$data['view_css']=array(
	// 	    // $this->Gen->get_web_url('css/ecommerce_web.min.css')
	// 	);
		
	// 	if($this->session->userdata('user_loggedin')){
    //         $user_id = $this->session->userdata('user_id');
    //         $data['cart'] = $this->db->query("SELECT * FROM app_cart where user_id = '$user_id'")->result_array();
    //     }else{
    //         $session_id = $_COOKIE['session_id'];
    //         $data['cart'] = $this->db->query("SELECT * FROM app_cart where session_id = '$session_id'")->result_array();
    //     } 
	
    //     $this->load_web('cart',$data);
	// }
	
	public function clearCart(){
	   if($this->session->userdata('user_loggedin')){
            $user_id = $this->session->userdata('user_id');
            $this->db->query("DELETE FROM app_cart where user_id = '$user_id'");
        }else{
            $session_id = $_COOKIE['session_id'];
            $this->db->query("DELETE FROM app_cart where session_id = '$session_id'");
        }
        redirect(base_url('cart'));
        exit;
	}
	
	public function deleteCart($id){
	    if($this->session->userdata('user_loggedin')){
            $user_id = $this->session->userdata('user_id');
            $this->db->query("DELETE FROM app_cart where user_id = '$user_id' && id = '$id'");
        }else{
            $session_id = $_COOKIE['session_id'];
            $this->db->query("DELETE FROM app_cart where session_id = '$session_id'  && id = '$id'");
        }
        redirect(base_url('cart'));
        exit;
	}
	
	public function updateCart(){
	    if($this->input->post()){
	        
            
            foreach($_POST['cart_id'] as $key=>$id){
                if($this->session->userdata('user_loggedin')){
                    $user_id = $this->session->userdata('user_id');
                    $this->db->query("update app_cart set qty = '{$_POST['qty'][$key]}', total_amount = price * '{$_POST['qty'][$key]}' WHERE id = '$id' && user_id = '$user_id'");
                }else{
                    $session_id = $_COOKIE['session_id'];
                    $this->db->query("update app_cart set qty = '{$_POST['qty'][$key]}', total_amount = price * '{$_POST['qty'][$key]}' WHERE id = '$id' && session_id = '$session_id'");
                }
                
            }
            // print_r($_POST);
            // exit;
	    }
	    
        
        
        redirect(base_url('cart'));
        exit;
	}
	
	public function updateCartAjax()
	{
		if ($this->input->is_ajax_request()) {
			$cart_id = $this->input->post('cart_id');
			$qty     = (int) $this->input->post('qty');

			if ($qty < 1) { $qty = 1; } // prevent 0 or negative qty

			if ($this->session->userdata('user_loggedin')) {
				$user_id = $this->session->userdata('user_id');
				$this->db->query("UPDATE app_cart 
								SET qty = '{$qty}', total_amount = price * '{$qty}' 
								WHERE id = '$cart_id' AND user_id = '$user_id'");
			} else {
				$session_id = $_COOKIE['session_id'];
				$this->db->query("UPDATE app_cart 
								SET qty = '{$qty}', total_amount = price * '{$qty}' 
								WHERE id = '$cart_id' AND session_id = '$session_id'");
			}

			// fetch updated cart data
			$cart = [];
			if ($this->session->userdata('user_loggedin')) {
				$user_id = $this->session->userdata('user_id');
				$cart = $this->db->query("SELECT * FROM app_cart WHERE user_id = '$user_id'")->result_array();
			} else {
				$session_id = $_COOKIE['session_id'];
				$cart = $this->db->query("SELECT * FROM app_cart WHERE session_id = '$session_id'")->result_array();
			}

			$subtotal = 0;
			$totalItems = 0;
			foreach ($cart as $item) {
				$subtotal   += $item['price'] * $item['qty'];
				$totalItems += $item['qty'];
			}

			// send JSON response
			echo json_encode([
				'success'     => true,
				'cart_count'  => $totalItems,
				'row_total'   => number_format($qty * $this->input->post('price'), 2),
				'subtotal'    => number_format($subtotal, 2)
			]);
			exit;
		}
	}

	
	
	
	
	
}
