<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry_type extends MY_Controller {

  function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_industry_type','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('industry_type_s_title');
        $this->session->unset_userdata('industry_type_s_status');
        $this->session->unset_userdata('industry_type_serach_data');
        redirect('admin/industry_type');
    } 


    public function index() {
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if(isset($_POST['industry_type_s_title']) AND $_POST['industry_type_s_title'] != '') {
                $w .= " AND title like '%".$_POST['industry_type_s_title']."%'";
                $this->session->set_userdata('industry_type_s_title',$_POST['industry_type_s_title']);
            }
            if(isset($_POST['industry_type_s_status']) AND $_POST['industry_type_s_status'] != '') 
            {
                $w .= " AND status ='".$_POST['industry_type_s_status']."'";
                $this->session->set_userdata('industry_type_s_status',$_POST['industry_type_s_status']);
            }
            $_SESSION['industry_type_serach_data'] = $w;
            $this->session->set_userdata('industry_type_serach_data',$w);
        }

        if(isset($this->session->industry_type_serach_data) AND $this->session->industry_type_serach_data != '')
        {
             $w = $this->session->userdata('industry_type_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/industry_type/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);

        //Export Excel Function Call
        if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

        $meta['page_title'] = 'Industry type';
        $this->page_construct('industry_type/view', $meta, $this->data);
    }

    public function add_row() 
    {
        $d = ORM::for_table('tech_industry_type')->create();
        $d->title           = $_POST['title'];
        $d->slug            = $this->maahi->slugify($_POST['title']);
        $d->inserted_time   = date('Y-m-d H:i:s');
        $d->user_id         = $this->session->userdata('loginid');
        $d->save();
    }

     public function edit($id) {
        
        $meta['page_title'] = 'Industry type';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/industry_type');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/industry_type');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->page_construct('industry_type/edit',$meta, $this->data);
        }
    }

    


    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'tech_industry_type');
    }

    

    
}