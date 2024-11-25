<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }

        $this->load->library('form_validation');
        $this->load->model('mdl_settings','mdl');
    }
    
	public function index() {
       
        $meta['page_title'] = lang('syssettings');

        // Form Validation
        $this->form_validation->set_rules('sitename', lang('sitename'), 'trim|required');
        $this->form_validation->set_rules('language', lang('language'), 'trim|required');
        $this->form_validation->set_rules('rows_per_page', lang('rows_per_page'), 'trim|required');

        if($this->form_validation->run() == true) {
            // update details
            $data = [
                        "sitename"                  => $this->input->post('sitename'),
                        "address"                  => $this->input->post('address'),
                        "mobile"                  => $this->input->post('mobile'),
                        "email"                  => $this->input->post('email'),
                        "pan_no"                  => $this->input->post('pan_no'),
                        "gst_no"                  => $this->input->post('gst_no'),
                        "language"                  => $this->input->post('language'),
                        "rows_per_page"             => $this->input->post('rows_per_page'),
                        "expense_lock_days"         => $this->input->post('expense_lock_days'),
                        "attendance_lock_days"      => $this->input->post('attendance_lock_days'),
                        "amount_per_km_for_car"     => $this->input->post('amount_per_km_for_car'),
                        "amount_per_km_for_bike"    => $this->input->post('amount_per_km_for_bike'),
                        "order_description"         => $this->input->post('order_description'),
                        "order_description"         => $this->input->post('order_description'),
                        "offer_signature_text"      => $this->input->post('offer_signature_text'),
                        "state_id"                  => $this->input->post('state_id'),
                        "timezone"                  => $this->input->post('timezone')
                    ];

            if($this->mdl->update_settings($data)) {
                $this->session->set_flashdata('success',lang('settingupdate'));
                redirect('settings');
            } else {
                $this->session->set_flashdata('error',lang('settingupdatef'));
                redirect('settings');
            }
        } else {
            $this->data['setting'] = $this->mdl->get(1);
            $this->data['languages'] = $this->sam->get_languages();
            $this->data['timezonelist'] = sam::timezoneList();
           $this->data['states']         =  $this->maahi->get_states();
            $this->page_construct('settings/index', $meta, $this->data);
        }
	}

}
