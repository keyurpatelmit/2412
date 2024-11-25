<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
require_once(APPPATH . 'core/MY_Front_Controller.php');

class Services extends MY_Front_Controller{  


	function __construct(){ 
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->library('Sam','sam'); 
  	}
    

 
	function index()  
	{

		$meta['page_title'] = 'Service - ';  
		$this->frontpage_construct('services/index', $meta, $this->data);
	}
    
} 