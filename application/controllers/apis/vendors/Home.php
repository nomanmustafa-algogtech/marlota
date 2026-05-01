<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Home extends REST_Controller
{
    public function __construct(){

     parent::__construct();

     // Load model
     $this->load->model('Base_model');
     // $this->load->library('gcm');
     
    }
    
    public function getCities_get(){
        $cities = $this->db->query("SELECT name FROM app_cities ORDER BY name asc")->result_array();
        $status = REST_Controller::HTTP_OK;
        $msg = 'Data Returned';
        
        $response = ['status' => $status, 'msg' => $msg, 'data'=>$cities];
        $this->set_response($response, $status);
        return;
        
    }
    
    
}