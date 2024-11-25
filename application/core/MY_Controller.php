<?php 


class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('database');
		// get all setting from Database
		$this->Settings = ORM::for_table('sam_settings')->where('id',1)->find_one();
        $timezone = $this->Settings->timezone;
        date_default_timezone_set($timezone);
            
		// select language
		$this->config->set_item('language',$this->Settings->language);
		$this->lang->admin_load('sam', $this->Settings->language);
		$this->theme = $this->Settings->theme.'/admin/views/';
		if(is_dir(VIEWPATH.$this->Settings->theme.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR)) {
            $this->data['assets'] = base_url() . 'themes/' . $this->Settings->theme . '/assets/';
        } else {
            $this->data['assets'] = base_url() . 'themes/default/admin/assets/';
        }

        $this->data['Settings'] = $this->Settings;
        $this->loggedIn = $this->sam->logged_in();
        if($this->loggedIn) {
        	// if user is logged in do some thing here
        }
	}

	function page_construct($page, $meta = array(), $data = array()) {
        $meta['message'] = isset($data['message']) ? $data['message'] : $this->session->flashdata('message');
        $meta['error'] = isset($data['error']) ? $data['error'] : $this->session->flashdata('error');
        $meta['warning'] = isset($data['warning']) ? $data['warning'] : $this->session->flashdata('warning');
        $meta['ip_address'] = $this->input->ip_address();
        $meta['Settings'] = $data['Settings'];
        $meta['assets'] = $data['assets'];
        $meta['no_record_txt'] = "No Record Found";

        $loginid = $this->session->userdata('loginid');
        $meta['notifications'] = ORM::for_table('tech_notification')->where('assign_user_id',$loginid)->find_array();
        
        $this->load->view($this->theme . 'header', $meta);
        $this->load->view($this->theme . 'navigation');
        $this->load->view($this->theme . $page, $data);
        $this->load->view($this->theme . 'footer');
    }

}

?>