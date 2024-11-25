<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_accessrights extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }

        $this->load->library('form_validation');
        $this->load->model('mdl_user','mdl');
        // $this->load->model('mdl_accessrights','model');

        $this->load->library('pagination');
    }
    
	public function index() {
        
        $this->data['roles'] = $this->sam->get_roles();
        
        $pages = ['accessrights','system_settings'];
        
        foreach ($this->data['roles'] as $role_key => $role) {

            foreach ($pages as $key => $page) {
            
            $checkesist =  ORM::for_table('ch_accessrights')->where('role_id',$role_key)
                                              ->where('page_title',$page)
                                              ->find_one();
            if(empty($checkesist))
            {
                $d = ORM::for_table('ch_accessrights')->create();
                $d->role_id                = $role_key;
                $d->page_title             = ucfirst(str_replace('_',' ',$page_name));
                $d->page_name              = ucfirst(str_replace('_',' ',$page));
                $d->module                 = $page;
                $d->create_access          = 'yes';
                $d->edit_access            = 'yes';
                $d->view_access            = 'yes';
                $d->delete_access          = 'yes';
                $d->save();    
                }
            }
        }


    }


 

    

    






}
