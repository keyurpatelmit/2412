<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('mdl_home','mdl');
    }
    
	public function index()
	{
        $this->data['customers'] = $this->mdl->get_customer_count();
        $this->data['inquiry'] = $this->mdl->get_inquiry_count();
        $this->data['quotation'] = $this->mdl->get_quotation_count();
        $this->data['invoice'] = $this->mdl->get_invoice_count();
        $this->data['ticket'] = $this->mdl->get_ticket_count();
        
        $this->data['staff'] = $this->mdl->get_staff_count();
        $this->data['serivces'] = $this->mdl->get_services_count();
		
		$meta['page_title'] = 'Dashboard';
        $this->load->model('mdl_customer');
        $this->data['customersdata'] = $this->mdl_customer->get_all();
		$this->page_construct('dashboard', $meta, $this->data);
	}
}
