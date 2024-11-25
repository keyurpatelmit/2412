<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    function login($m = NULL) {
        if ($this->loggedIn) {
            $this->session->set_flashdata('error', $this->session->flashdata('error'));
            admin_redirect('welcome');
        }
        $this->data['title'] = lang('login');

        if ($this->form_validation->run($this->my_rules())) {
            $d = ORM::for_table('sam_users')->where('email',$this->input->post('uname'))
                                ->where('password',md5($this->input->post('pwd')))
                                ->where('status','active')
                                ->find_one();
          
            if($d) {
                    // admin
                    $this->session->set_flashdata('message', lang('logintrue'));
                    $this->session->set_userdata('user_state',$d->state_id);
                    $this->session->set_userdata('identity',$d->type);
                    $this->session->set_userdata('loginid', $d->id);
                    $this->session->set_userdata('loginname', $d->name);
                    redirect('admin');
               
            } else {
                $this->session->set_flashdata('error', lang('loginfalse'));
                admin_redirect('login');
            }
            
        } else {
            $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
            $this->data['message'] = $this->session->flashdata('message');
            $this->load->view($this->theme . 'auth/login', $this->data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        admin_redirect('/');
    }

    private function my_rules() {
        $this->form_validation->set_rules('uname','UserName','required|trim');
        $this->form_validation->set_rules('pwd','Password','required|trim');
    }

}
