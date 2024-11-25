<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apidoc extends MY_Controller {  

    function __construct()  
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }

        $this->load->library('form_validation');
        $this->load->model('Mdl_apidoc','mdl');
        $this->load->library('pagination');
    }


   public function unset_session_value() {

    
    $this->session->unset_userdata('apidoc_s_title'); 
    
    $this->session->unset_userdata('apidoc_serach_data');
    redirect('admin/apidoc');

  }   

    public function index() {

    $w  = '';

    if($this->session->userdata('identity') != 'admin'){
        $login_id = $this->session->userdata('loginid');
       $below_emp = $this->sam->below_employee($login_id);
       $w .= " AND created_by_user_id in('" . implode("','",$below_emp) . "')";      
    }

    $paginationdata = $this->data['Settings']->rows_per_page;

    if($_POST){ 

        if(isset($_POST['apidoc_s_title']) AND $_POST['apidoc_s_title'] != ''){
            $w .= " AND title like '%".$_POST['apidoc_s_title']."%'";
            $this->session->set_userdata('apidoc_s_title',$_POST['apidoc_s_title']); 
        }       
        
            
        $_SESSION['apidoc_serach_data'] = $w;
        $this->session->set_userdata('apidoc_serach_data',$w);
    }

    if(isset($this->session->apidoc_serach_data) AND $this->session->apidoc_serach_data != ''){
        $w = $this->session->userdata('apidoc_serach_data');
    }
    
    if($_POST){ 
        $Record = $this->mdl->get_search_count($paginationdata,$w);
    }else{
            if(isset($this->session->apidoc_serach_data) AND $this->session->apidoc_serach_data != ''){
                $w = $this->session->userdata('apidoc_serach_data');
                $Record = $this->mdl->get_search_count($paginationdata,$w);
            }
            else{   
                    $Record =  $this->mdl->get_count();   
            }
        }

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/apidoc/index';   
        $config['total_rows'] = $Record; 
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        
         
        
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);       

          
        
       
        $meta['page_title'] = 'Apidoc Master';
        $this->page_construct('apidoc/view', $meta, $this->data);
    }
    
    public function add_row() {
        
        $d = ORM::for_table('apidoc')->create();

        $d->title                   = @$_POST['title'];
        $d->method                  = @$_POST['method'];        
        $d->action_url              = @$_POST['action_url'];
        $d->params                  = @$_POST['params'];
        $d->mendetory_fileds        = @$_POST['mendetory_fileds'];
        $d->description             = @$_POST['description'];        
       
        $d->created_by                = @$_POST['created_by'];        
        $d->inserted_time               = date('Y-m-d H:i:s');

        $rand = rand(999999,000000);
        if(is_uploaded_file($_FILES['image']['tmp_name'])) {
            $this->sam->upload_image('image','themes/assets/images/product_image/',$rand);
            $d->image = $rand.$_FILES['image']['name'];
        }

        for($i=0;$i<count($_FILES['images']['name']);$i++)
        {
            if($_FILES['images']['tmp_name'][$i] != ''){
            {
                    if(is_uploaded_file($_FILES['images']['tmp_name'][$i])) 
                    {
                        $this->sam->upload_multiple_image('images','themes/assets/images/product_image/',$i,$rand);
                        $d->images   = $rand.$_FILES['images']['name'][$i];
                    }    
                }
            }
        } 

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

     public function edit($id) {

        /*echo $id;
        die();*/
        
        $meta['page_title'] = 'Apidoc Master';

        if($_POST && $_POST['id'] != '') {

            /*echo "<pre>";
            print_r($_POST);
            print_r($_POST['id']);
            die();*/

            /*echo "string111";
            die();*/

            if($this->mdl->update_apidoc($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update Record ');
                redirect('admin/apidoc');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/apidoc');
            }
        } else {

           /* echo $id;
            die();*/

            $this->data['row'] = $this->mdl->get($id); 

            /*echo "<pre>";
            print_r($this->data['row']);
            die();*/
            
            $this->page_construct('apidoc/edit',$meta, $this->data);
        }
    }
    
     public function delete_row($id) {
        $this->sam->_delete_by_id($id,'apidoc');
    } 


 function get_view_details()
    {
        $this->data['row'] = ORM::for_table('apidoc')->where('id',$_POST['id'])->find_one();
        $html = $this->load->view('/admin/views/apidoc/view_details',$this->data,true);  

        if($this->data['row'])
        {
            $output['status']     = 1;
            $output['msg']        = 'Successfully get';
            $output['html']       = $html;
        }else{
            $output['status']     = 0;
            $output['msg']        = 'Something Went Wrong';
            $output['html']       = '';
        }
        echo json_encode($output);   
    }

    
}