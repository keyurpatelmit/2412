<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
require_once(APPPATH . 'core/MY_Front_Controller.php');

class Privacy_policy extends MY_Front_Controller{  


    function __construct(){ 
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->library('Sam','sam'); 
    }
    

 
    function index()  
    {

        $meta['page_title'] = 'Privacy policy - ';  
        $this->frontpage_construct('Privacy_policy/index', $meta, $this->data);
    }
    
} 