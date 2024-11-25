<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_attributes extends MY_Controller {

  function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_product_attributes','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('product_attributes_s_title');
        $this->session->unset_userdata('product_attributes_s_status');
        $this->session->unset_userdata('product_attributes_serach_data');
        redirect('admin/product_attributes');
    } 


    public function index() {
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if(isset($_POST['product_attributes_s_title']) AND $_POST['product_attributes_s_title'] != '') {
                $w .= " AND title like '%".$_POST['product_attributes_s_title']."%'";
                $this->session->set_userdata('product_attributes_s_title',$_POST['product_attributes_s_title']);
            }
            if(isset($_POST['product_attributes_s_status']) AND $_POST['product_attributes_s_status'] != '') 
            {
                $w .= " AND status ='".$_POST['product_attributes_s_status']."'";
                $this->session->set_userdata('product_attributes_s_status',$_POST['product_attributes_s_status']);
            }
            $_SESSION['product_attributes_serach_data'] = $w;
            $this->session->set_userdata('product_attributes_serach_data',$w);
        }

        if(isset($this->session->product_attributes_serach_data) AND $this->session->product_attributes_serach_data != '')
        {
             $w = $this->session->userdata('product_attributes_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/product_attributes/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
        $this->data['product_categories']       =  $this->maahi->get_active_data('zyd_product_category');
        if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

        $meta['page_title'] = 'Product Attributes';
        $this->page_construct('product_attributes/view', $meta, $this->data);
    }

    public function add_row() 
    {
        $d = ORM::for_table('tech_product_attributes')->create();
        $d->title           = $_POST['title'];
        $d->categoty_ids    = $this->maahi->implode_field($_POST['categoty_ids']);
        $d->subcategory_ids = $this->maahi->implode_field($_POST['subcategory_ids']);
        $d->slug            = $this->maahi->slugify($_POST['title']);
        $d->inserted_time   = date('Y-m-d H:i:s');
        $d->user_id         = $this->session->userdata('loginid');
        $d->save();

        if(count($_POST['attribute_value']) > 0)
        {
            for($i=0;$i<count($_POST['attribute_value']);$i++)
            {  
                $attr_value = ORM::for_table('tech_product_attributes_value')->create();
                $attr_value->attribute_id       = $d->id;
                $attr_value->title              = @$_POST['attribute_value'][$i];
                $attr_value->inserted_time      = date('Y-m-d H:i:s');
                $attr_value->user_id            = $this->session->userdata('loginid');
                $attr_value->save();
            }
        }
        echo $d->id;
    }

     public function edit($id) {
        
        $meta['page_title'] = 'Product Attributes';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/product_attributes');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/product_attributes');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            
            $this->data['attr_values']              =  $this->maahi->get_attribute_value($this->data['row']->id);
            $this->data['product_categories']       =  $this->maahi->get_active_data('zyd_product_category');
            $this->data['product_sub_categories']   =  $this->maahi->get_subcategory_from_category($this->data['row']->categoty_ids);
            $this->page_construct('product_attributes/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `tech_product_attributes` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('tech_product_attributes')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'product_attributes_'.rand(10000,99999).'_'.$date;
    
      $this->load->library("excel");
      $object = new PHPExcel();
    
      $object->setActiveSheetIndex(0);
                            
      $table_columns = array("No","Category","Sub category");
      $column = 0;
      foreach($table_columns as $field) 
       {
       $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
       $column++;
      }
      $excel_row = 2;
      foreach($d as $key=>$row)
      { 
        $i = 0;
        $row['categoty_ids'] = $this->maahi->explode_field($row['categoty_ids'],'zyd_product_category','title');
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key + 1);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['categoty_ids']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['title']);
        $excel_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }


    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'tech_product_attributes');
    }
  public function attr_delete($id) {
        $this->sam->_delete_by_id($id,'tech_product_attributes_value');
    }
    

    
}