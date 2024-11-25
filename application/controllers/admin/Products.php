<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) 
        {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_products','mdl');
        $this->load->library('pagination');
    }

     public function unset_session_value() {
        
        $this->session->unset_userdata('products_s_product_name');
        $this->session->unset_userdata('products_s_product_code');
        $this->session->unset_userdata('products_s_hsn');
        $this->session->unset_userdata('s_prodact_category');
        $this->session->unset_userdata('s_product_group');
        $this->session->unset_userdata('products_serach_data');
        redirect('admin/products');
    } 

    public function index() {

        
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) {

            if(isset($_POST['products_s_product_code']) AND $_POST['products_s_product_code'] != '') {
                $w .= " AND product_code ='".$_POST['products_s_product_code']."'";
                $this->session->set_userdata('products_s_product_code',$_POST['products_s_product_code']);
            }

            if(isset($_POST['products_s_hsn']) AND $_POST['products_s_hsn'] != '') {
                $w .= " AND hsn ='".$_POST['products_s_hsn']."'";
                $this->session->set_userdata('products_s_hsn',$_POST['products_s_hsn']);
            }
            
            if(isset($_POST['products_s_product_name']) AND $_POST['products_s_product_name'] != '') {
                $w .= " AND product_name like '%".$_POST['products_s_product_name']."%'";
                $this->session->set_userdata('products_s_product_name',$_POST['products_s_product_name']);
            }
            if(isset($_POST['s_prodact_category']) AND $_POST['s_prodact_category'] != '') 
            {
                $w .= " AND product_category_id in('" . implode("','",$_POST['s_prodact_category']) . "')";  
                $this->session->set_userdata('s_prodact_category',$_POST['s_prodact_category']);
            }
            if(isset($_POST['s_product_group']) AND $_POST['s_product_group'] != '') 
            {
                $w .= " AND product_group_id in('" . implode("','",$_POST['s_product_group']) . "')";  
                $this->session->set_userdata('s_product_group',$_POST['s_product_group']);
            }

            $_SESSION['products_serach_data'] = $w;
            $this->session->set_userdata('products_serach_data',$w);

        }

        if(isset($this->session->products_serach_data) AND $this->session->products_serach_data != '')
        {
             $w = $this->session->userdata('products_serach_data');
        }

        
        $Record = $this->mdl->get_search_count($paginationdata,$w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/products/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);

        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
        $meta['page_title'] = 'Products';
        $this->data['product_categories']   =  $this->maahi->get_active_data('zyd_product_category');
        $this->data['vendors']              =  $this->maahi->get_vendor_list();
        $this->data['uoms']             =  $this->maahi->get_active_data('tech_uom');
        $this->data['brands']           =  $this->maahi->get_active_data('zyd_product_brand');
        $this->data['product_code']     =  $this->maahi->get_autogenrate_no('zyd_products_mst');

        $this->page_construct('products/view', $meta, $this->data);
    }

    public function add_row() 
    {
        $d = ORM::for_table('zyd_products_mst')->create();
        $d->product_code            = @$_POST['product_code']; 
        $d->product_name            = @$_POST['product_name'];
        $d->vendor_id               = @$_POST['vendor_id'];
        $d->category_ids            = @$_POST['category_ids'];
        $d->brand_id                = @$_POST['brand_id']; 
        $d->price                   = @$_POST['price']; 
        $d->hsn_code                = @$_POST['hsn_code']; 
        $d->sku                     = @$_POST['sku']; 
        $d->gst                     = @$_POST['gst']; 
        $d->uom_id                  = @$_POST['uom_id']; 
        $d->description             = @$_POST['description'];
        $d->purchased_price         = @$_POST['purchased_price'];

        $d->status                  = isset($_POST['status']) ? $_POST['status'] : 'active';
        $d->user_id                 = $this->session->userdata('loginid');
        $d->inserted_time           = date('Y-m-d H:i:s');
      
        if($_FILES['image_name']['name'] != ''){
            $randno = rand();
            if(is_uploaded_file($_FILES['image_name']['tmp_name'])) {
                  $this->sam->upload_image('image_name','themes/assets/images/product_image/',$randno);
                  $d->image_name = $randno.$_FILES['image_name']['name'];
              } 
          }
            $d->save();
        echo $d->id;
    }
    

     public function edit($id) 
     {
        $meta['page_title'] = 'Products Master';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update Record ');
                redirect('admin/products');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/products');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['product_categories']       =  $this->maahi->get_active_data('zyd_product_category');
            $this->data['vendors']              =  $this->maahi->get_vendor_list();
            $this->data['uoms']             =  $this->maahi->get_active_data('tech_uom');
            $this->data['brands']           =  $this->maahi->get_active_data('zyd_product_brand');

            $this->page_construct('products/edit',$meta, $this->data);
        }
    }
    

    public function products_delete($id) {
        $this->sam->_delete_by_id($id,'zyd_products_mst');
    }
    public function attribute_products_delete($id) {
        $this->sam->_delete_by_id($id,'zyd_products_mst_attribute');
    }
    public function attribute_products_image_delete($id) {
         $d = ORM::for_table('zyd_products_img')->where('id',$id)->find_one();
         $d->delete();
    }

    

    
}