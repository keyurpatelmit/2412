<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
require_once(APPPATH . 'core/MY_Front_Controller.php');


class Home extends MY_Front_Controller{  
    function __construct(){ 
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->library('Sam','sam'); 
    }
 
    function index()  
    {

        $meta['page_title']  = ' Home - ';
        $meta['home_banner'] = ORM::for_table('tbl_update_fields')->where('id',1)->find_one();
        $meta['system_details'] = ORM::for_table('sam_settings')->where('id',1)->find_one();
        // echo "<pre>";print_r($meta['system_details']);die();
        $this->frontpage_construct('index', $meta, $this->data);
    }

    
    


    
} 