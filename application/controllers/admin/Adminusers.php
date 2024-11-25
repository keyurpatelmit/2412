<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminusers extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }

        $this->load->library('form_validation');
        $this->load->model('Mdl_adminuser','mdl');
        $this->load->library('pagination');
    }

    public function unset_session_value() {

    $this->session->unset_userdata('admin_s_status');
    $this->session->unset_userdata('admin_s_mobile');
    $this->session->unset_userdata('admin_s_email');
    $this->session->unset_userdata('admin_s_name');
    $this->session->unset_userdata('adminusers_serach_data');
    redirect('admin/adminusers');
  } 
    
    public function index() {
        // Pagination Start
       
     
        // Pagination End
        $w = '';

        $paginationdata = $this->data['Settings']->rows_per_page;

        if($_POST) {
            
            if(isset($_POST['admin_s_mobile']) AND $_POST['admin_s_mobile'] != '') {
                $w .= " AND mobile ='".$_POST['admin_s_mobile']."'";
                $this->session->set_userdata('admin_s_mobile',$_POST['admin_s_mobile']);
            }
            
            if(isset($_POST['admin_s_email']) AND $_POST['admin_s_email'] != '') {
                $w .= " AND email ='".$_POST['admin_s_email']."'";
                $this->session->set_userdata('admin_s_email',$_POST['admin_s_email']);
            }
            if(isset($_POST['admin_s_name']) AND $_POST['admin_s_name'] != '') {
                $w .= " AND name like '%".$_POST['admin_s_name']."'";
                $this->session->set_userdata('admin_s_name',$_POST['admin_s_name']);
            }
            if(isset($_POST['admin_s_status']) AND $_POST['admin_s_status'] != '') {
                $w .= " AND status ='".$_POST['admin_s_status']."'";
                $this->session->set_userdata('admin_s_status',$_POST['admin_s_status']);
            }

            $_SESSION['adminusers_serach_data'] = $w;
            $this->session->set_userdata('adminusers_serach_data',$w);
        }

        if(isset($this->session->adminusers_serach_data) AND $this->session->adminusers_serach_data != '')
        {
             $w = $this->session->userdata('adminusers_serach_data');
        }
        $Record = $this->mdl->get_search_count($paginationdata,$w);
        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/adminusers/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        
        $meta['page_title'] = 'Admin User';
        $this->data['rows']           =  $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
        $this->data['states']         =  $this->maahi->get_states();
        $this->page_construct('adminusers/view', $meta, $this->data);
    }

      public function add_row() {
        
        $checkexist = ORM::for_table('sam_users')->where('email',$_POST['email'])->where('is_deleted','0')->find_one();
        if(!empty($checkexist))
        {
            $output['status'] = 2;
            $output['msg'] = 'this email id already exist';
            echo json_encode($output); 
        }else{

            $d = ORM::for_table('sam_users')->create();
            $d->name                    = @$_POST['name'];
            $d->email                   = @$_POST['email'];
            $d->mobile                  = @$_POST['mobile'];
            $d->address                 = @$_POST['address'];
            $d->state_id                = @$_POST['state_id'];
            $d->city_id                 = @$_POST['city_id'];
            $d->zipcode                 = @$_POST['zipcode'];
            $d->type                    = 'admin';
            $d->password_txt            = ($_POST['pwd']!= "") ? $_POST['pwd'] : $d->password_txt;
            $d->password                = ($_POST['pwd']!= "") ? md5($_POST['pwd']) : $d->password;
            $d->status                  = isset($_POST['status']) ? $_POST['status'] : 'active';
            $d->created_by              = $this->session->userdata('loginid');
            $d->inserted_time           = date('Y-m-d H:i:s');
            if($d->save())
            {
                $output['status'] = 1;
                $output['msg'] = 'Successfully add Record';    
            }else{
                $output['status'] = 0;
                $output['msg'] = 'somthing wrong !';
            }
            echo json_encode($output); 
        }
    }

    public function adminuser_delete($id) {
         $this->sam->_delete_by_id($id,'sam_users');
    }

    public function edit($id) {
        $meta['page_title'] = 'Admin User';
        if($_POST) {
            if($this->mdl->row_update($_POST)) {
                $this->session->set_flashdata('success',lang('Admin Update successfully'));
                redirect('admin/adminusers');
            } else {
                $this->session->set_flashdata('error',lang('Admin Update fail'));
                redirect('admin/adminusers');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['states']         =  $this->maahi->get_states();
            $this->data['cities']               =  $this->maahi->get_cities();
            $this->page_construct('adminusers/edit',$meta, $this->data);
        }
    }

}
