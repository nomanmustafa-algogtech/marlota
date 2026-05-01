<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_controller extends CI_Controller
{
    public $title = "Ali Softtech Pvt. LTD - A Complete IT Solution";

    public $Gen;

    public function __construct()
    {
        parent::__construct();
	
        $this->load->database();

        $this->load->helper(array('url','form'));

        $this->load->library(array('session' , 'user_agent', 'General'));

        $this->load->model('Base_model');

        $this->Gen = new General();
    }
    

    public function load_web($template,$data=array())
    {
        $data['css'] = array(
    		$this->Gen->get_web_url('css/bootstrap.css'),
    		$this->Gen->get_web_url('css/custom.css'),
    		$this->Gen->get_web_url('style.css'),
    		$this->Gen->get_web_url('css/owl-carousel.css'),
    		$this->Gen->get_web_url('css/animate.min.css'),
    		$this->Gen->get_web_url('royalslider/royalslider.css'),
    		$this->Gen->get_web_url('royalslider/skins/default-inverted/rs-default-inverted.css'),
    		$this->Gen->get_web_url('rs-plugin/css/settings.css')
		);
        $data['js'] = array(
            $this->Gen->get_web_url('js/jquery.js'),
            $this->Gen->get_web_url('js/bootstrap.min.js'),
            $this->Gen->get_web_url('js/menu.js'),
            $this->Gen->get_web_url('js/owl.carousel.min.js'),
            $this->Gen->get_web_url('js/jquery.parallax-1.1.3.js'),
            $this->Gen->get_web_url('js/jquery.simple-text-rotator.js'),
            $this->Gen->get_web_url('js/wow.min.js'),
            $this->Gen->get_web_url('js/custom.js'),
			$this->Gen->get_web_url('js/jquery.isotope.min.js'),
            $this->Gen->get_web_url('js/custom-portfolio.js'),
            $this->Gen->get_web_url('rs-plugin/js/jquery.themepunch.plugins.min.js'),
            $this->Gen->get_web_url('rs-plugin/js/jquery.themepunch.revolution.min.js'),
            $this->Gen->get_web_url('royalslider/jquery.easing-1.3.js'),
            $this->Gen->get_web_url('royalslider/jquery.royalslider.min.js'),
            $this->Gen->get_web_url('switcher/js/fswit.js'),
            $this->Gen->get_web_url('switcher/js/bootstrap-select.js'),
            
        );
        
        $header = "web/includes/header";
        $footer = "web/includes/footer";

        $this->load->view($header,$data);
        $this->load->view('web/'.$template,$data);
        $this->load->view($footer,$data);
    }
}
