<?php
defined('BASEPATH') OR exit('No direct script access allowed');  

class Home extends MY_Controller{ 

  function __construct(){
    parent::__construct();

    if (!$this->loggedIn) {
        $this->session->set_userdata('requested_page', $this->uri->uri_string());
        admin_redirect('login');
    }

    $this->load->library('form_validation');
    $this->load->model('Mdl_update','mdl');
    $this->load->library('pagination');
}

private $_table = 'tbl_update_fields';

public function index() {
    
    $meta['page_title'] = 'Home';
    $w  = '';
    $w .= " AND type ='home'";
    $this->data['rows'] = $this->mdl->get_all_with_pagi($w);
   
    $this->page_construct('home/index', $meta, $this->data); 
}

public function edit($id){
    $d = ORM::for_table($this->_table)->where('id',$_POST['id'])->find_one();
    
    $d->main_title          = $_POST['main_title'];
    $d->sub_title        = $_POST['sub_title'];
    $d->main_title_2          = $_POST['main_title_2'];
    $d->sub_title_2        = $_POST['sub_title_2'];

    if(is_uploaded_file($_FILES['image_1']['tmp_name'])) {
        $rand = rand();
        $this->sam->upload_image('image_1','themes/default/admin/assets/images/comman_image/',$rand);
        $d->image_1 = $rand.$_FILES['image_1']['name'];
    }
    if(is_uploaded_file($_FILES['image_2']['tmp_name'])) {
        $rand = rand();
        $this->sam->upload_image('image_2','themes/default/admin/assets/images/comman_image/',$rand);
        $d->image_2 = $rand.$_FILES['image_2']['name'];
    }

    if($d->save()) {
        $this->session->set_flashdata('success',lang('Update successfully'));
        redirect('admin/home');
    } else {
        $this->session->set_flashdata('error',lang('Update fail'));
        redirect('admin/home');
    }
}
} 
