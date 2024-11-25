<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
require_once(APPPATH . 'core/MY_Front_Controller.php');

class About extends MY_Front_Controller{  


	function __construct(){ 
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->library('Sam','sam'); 
  	}
    

 
	function index()  
	{

		$meta['page_title'] = 'About Us - ';  
		$this->frontpage_construct('about/index', $meta, $this->data);
	}
    
} 