<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
require_once(APPPATH . 'core/MY_Front_Controller.php');

class Team extends MY_Front_Controller{  


	function __construct(){ 
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->library('Sam','sam'); 
  	}
    
   
	function index()  
	{

		$meta['page_title'] = 'Team - ';  
		$this->frontpage_construct('team/index', $meta, $this->data);
	}
    
} 