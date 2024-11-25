<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
require_once(APPPATH . 'core/MY_Front_Controller.php');

class Certificate extends MY_Front_Controller{  


	function __construct(){ 
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->library('Sam','sam'); 
  	}
    

 
	function index()  
	{

		$meta['page_title'] = 'Certificate - ';  
		$this->frontpage_construct('certificate/index', $meta, $this->data);
	}
    
} 