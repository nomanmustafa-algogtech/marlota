<?php
class General{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model(
		    array(
                'Base_model'
            )
        );
	}

	public function get_web_url($lib)
    {
        return base_url().'webfiles/'.$lib;
    }
    
	public function get_web_url_new($lib)
    {
        return base_url().'weblibrary/'.$lib;
    }
    
    public function get_url($lib)
    {
        return $lib;
    }
    
    public function get_admin_url($lib)
    {
        return base_url().'adminfiles/'.$lib;
    }
}
