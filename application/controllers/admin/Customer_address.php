<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer_address extends MY_Controller {


       function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_customer_address','mdl');
        $this->load->library('pagination');
        $this->load->library('Sam','sam');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('services_s_name');
        $this->session->unset_userdata('services_s_status');
        $this->session->unset_userdata('services_serach_data');
        redirect('admin/customer_address');
    } 

    public function index() {
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            // echo "<pre>";print_r($_POST);die();
            if(isset($_POST['customer_id']) AND $_POST['customer_id'] != ''){
                $w .= " AND customer_id ='".$_POST['customer_id']."'";
                $this->session->set_userdata('customer_id',$_POST['customer_id']);
            }
            if(isset($_POST['services_s_status']) AND $_POST['services_s_status'] != ''){
                $w .= " AND status ='".$_POST['services_s_status']."'";
                $this->session->set_userdata('services_s_status',$_POST['services_s_status']);
            }
            $_SESSION['services_serach_data'] = $w;
            $this->session->set_userdata('services_serach_data',$w);
        }

        if(isset($this->session->services_serach_data) AND $this->session->services_serach_data != '')
        {
             $w = $this->session->userdata('services_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/customer_address/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);
        $this->data['service_categories']       =  $this->maahi->get_active_data('tech_service_category');
        
        $this->data['customers']      =  $this->mdl->get_customer('sam_customers');
        //Export Excel Function Call
        if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

        $meta['page_title'] = 'Customer Address';
         $this->data['vendors']              =  $this->maahi->get_vendor_list();
        $this->page_construct('customer_address/view', $meta, $this->data);
    }

    // public function add_row() 
    // {
    //     $d = ORM::for_table('tech_service')->create();
    //     // $d->vendor_id                 = @$_POST['vendor_id'];
    //     $d->code                      = @$_POST['code'];
    //     $d->hsn_code                  = @$_POST['hsn_code'];
    //     $d->gst                       = @$_POST['gst'];
    //     $d->service_category_id       = @$_POST['service_category_id'];
    //     $d->title                     = @$_POST['title'];
    //     $d->price                     = @$_POST['price'];
    //     $d->description               = @$_POST['description'];
    //     $d->inserted_time             = date('Y-m-d H:i:s');        
    //     $d->user_id                   = $this->session->userdata('loginid');
    //     $d->created_by_user_id        = $this->session->userdata('loginid');

    //     if($_FILES['image']['name'] != ''){
    //           $randno = rand();
    //           if(is_uploaded_file($_FILES['image']['tmp_name'])) {
    //                 $this->sam->upload_image('image','themes/assets/images/upload_service',$randno);
    //                 $d->image = $randno.$_FILES['image']['name'];
    //             } 
    //         }
    //     $d->save();       
        
    // }

     public function edit($id) {
        
        $meta['page_title'] = 'Customer Address Master';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/customer_address');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/customer_address');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            // echo "<pre>"; print_r($this->data['row']);die();
            $this->data['states']       =  $this->maahi->get_active_data('zyd_state');
            $this->data['citys']       =  $this->maahi->get_active_data('zyd_city');
            $this->data['addresses']            =  $this->maahi->get_address($id);
            $this->data['customers']      =  $this->mdl->get_customer('sam_customers');
            $this->page_construct('customer_address/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `sam_customers_address` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('sam_customers_address')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'customer_address_'.$date;
    
      $this->load->library("excel");
      $object = new PHPExcel();
    
      $object->setActiveSheetIndex(0);
                            
      $table_columns = array("No","Customer Name","Address Name","Address","State","City","Pin Code");
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
        $row['customer_name'] = $this->sam->get_real_value('sam_customers','id',$row['customer_id'],'name');
        $row['customer_state'] = $this->sam->get_real_value('zyd_state','id',$row['cust_state_id'],'state');
        $row['customer_city'] = $this->sam->get_real_value('zyd_city','id',$row['cust_city_id'],'city');

        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key + 1);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['customer_name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['cust_address_name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['cust_address']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['customer_state']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['customer_city']);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['cust_zip_code']);
        $excel_row++; 
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }


    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'sam_customers_address');
    }

      function get_details_inmodel()
    {
            $this->data['row'] = ORM::for_table('sam_customers')->where('id',$_POST['id'])->find_one();
            $this->data['contacts']             =  $this->maahi->get_contacts($_POST['id']);
            $this->data['addresses']            =  $this->maahi->get_address($_POST['id']);
            $html = $this->load->view('/admin/views/customer/view_detail',$this->data,true);

            if($this->data['row'])
            {
            $output['status'] = 1;
            $output['msg'] = 'Successfully get';
            $output['html'] = $html;
            }else{
            $output['status'] = 0;
            $output['msg'] = 'Something Went Wrong';
            $output['html'] = '';
            }
            echo json_encode($output);
    }

    

    
}