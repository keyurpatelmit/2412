<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Customer extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }

        $this->load->library('form_validation');
        $this->load->model('mdl_customer','mdl');
        $this->load->library('pagination');
    }
    
    public function unset_session_value() {
        $this->session->unset_userdata('cust_s_customer_categoy');
        $this->session->unset_userdata('s_phone');
        $this->session->unset_userdata('s_email');
        $this->session->unset_userdata('s_customer');
        $this->session->unset_userdata('customer_serach_data');
        redirect('admin/customer');
    
      }   
	public function index() {


        $paginationdata = $this->data['Settings']->rows_per_page;
        $w = $l = '';

        $w .= 'AND customer_type = "customer"';
        if($this->session->userdata('identity') !== 'admin'){
            $w .= "AND created_by_user_id ='".$this->session->userdata('loginid')."'";
        }
        
        if($_POST) {
            
            if(isset($_POST['cust_s_customer_categoy']) AND $_POST['cust_s_customer_categoy'] != '') {
                $w .= " AND customer_category_id ='".$_POST['cust_s_customer_categoy']."'";
                $this->session->set_userdata('cust_s_customer_categoy',$_POST['cust_s_customer_categoy']);
            }
            if(isset($_POST['s_phone']) AND $_POST['s_phone'] != '') {
                $w .= " AND mobile ='".$_POST['s_phone']."'";
                $this->session->set_userdata('s_phone',$_POST['s_phone']);
            }
            if(isset($_POST['s_email']) AND $_POST['s_email'] != '') {
                $w .= " AND email ='".$_POST['s_email']."'";
                $this->session->set_userdata('s_email',$_POST['s_email']);
            }
            if(isset($_POST['s_customer']) AND $_POST['s_customer'] != '') {
                $w .= " AND name like '%".$_POST['s_customer']."%'";
                $this->session->set_userdata('s_customer',$_POST['s_customer']);
            }
            if(isset($_POST['s_status']) AND $_POST['s_status'] != '') {
                $w .= " AND status ='".$_POST['s_status']."'";
                $this->session->set_userdata('s_status',$_POST['s_status']);
            }
            $_SESSION['customer_serach_data'] = $w;
            $this->session->set_userdata('customer_serach_data',$w);
        }
        
        if(isset($this->session->customer_serach_data) AND $this->session->customer_serach_data != ''){
             $w = $this->session->userdata('customer_serach_data');
        }

        $Record = $this->mdl->get_search_count($paginationdata,$w);
        if(isset($_POST['SearchValue'])){ if($_POST['SearchValue'] == 'excel'){ $this->export_data($w); } }
        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/customer/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);

		    $meta['page_title'] = lang('customer');
        $this->data['rows']                 = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(3),$w);
        $this->data['customer_categories']      =  $this->maahi->get_active_data('tech_customer_category');
        $this->data['services']      =  $this->maahi->get_active_data('tech_service_category');
        $this->data['products']      =  $this->maahi->get_active_data('zyd_product_category');
        $this->data['designations']             =  $this->maahi->get_active_data('zyd_designation');
        $this->data['industry_type']             =  $this->maahi->get_active_data('tech_industry_type');
        
        $this->data['states']                   =  $this->maahi->get_states();
        $this->data['auto_genrate_code']        =  $this->get_auto_customer_code();
		$this->page_construct('customer/view', $meta, $this->data);
	}

   public function add_row() {
        $d = ORM::for_table('sam_customers')->create();

        $d->customer_type         = 'customer';
        $d->customer_category_id  = @$_POST['customer_category_id'];
        $d->name                  = @$_POST['name'];
        $d->customer_code         = @$_POST['customer_code'];
        $d->address               = @$_POST['address'];
        $d->mobile                = @$_POST['cust_mobile'];
        $d->email                 = @$_POST['cust_email'];
        $d->password              = @md5($_POST['password']);
        $d->password_text         = $_POST['password'];
        $d->reference_by          = @$_POST['reference_by'];
        $d->gst_no                = @$_POST['gst_no'];
        $d->pin_code              = @$_POST['pin_code'];
        $d->pan_no                = @$_POST['pan_no'];
        $d->state_id              = @$_POST['state_id'];
        $d->city_id               = @$_POST['city_id'];
        $d->description_note      = @$_POST['description_note'];
        $d->industry              = @$_POST['industry'];

        $d->service_id            =  implode(',',@$_POST['service_id']);
        $d->product_id            =  implode(',',@$_POST['product_id']);
        
        $d->status                 = isset($_POST['status']) ? $_POST['status'] : 'active';
        $d->created_by_user_id     = $this->session->userdata('loginid');
        $d->inserted_time          = date('Y-m-d H:i:s');
        $d->save();

        if(!empty($_POST['contact_persons'])){
            for($contact=0; $contact < count($_POST['contact_persons']); $contact++) { 
                if($_POST['contact_persons'][$contact] !== ''){
                    $contact_obj = ORM::for_table('sam_customers_contact')->create();
                    $contact_obj->customer_id           = $d->id;
                    $contact_obj->contact_persons       = @$_POST['contact_persons'][$contact];
                    $contact_obj->designations_id       = @$_POST['designations_id'][$contact];
                    $contact_obj->mobile                = @$_POST['mobile'][$contact];
                    $contact_obj->email                 = @$_POST['email'][$contact];
                    $contact_obj->save();
                }
            }
        }

       
        
        if(!empty($_POST['cust_address_name'])){
            for($add=0; $add < count($_POST['cust_address_name']); $add++) { 
                if($_POST['cust_address_name'][$add] !== ''){
                    $add_obj = ORM::for_table('sam_customers_address')->create();
                    $add_obj->customer_id           = $d->id;
                    $add_obj->cust_address_name     = @$_POST['cust_address_name'][$add];
                    $add_obj->cust_address          = @$_POST['cust_address'][$add];
                    $add_obj->cust_state_id         = @$_POST['cust_state_id'][$add];
                    $add_obj->cust_city_id          = @$_POST['cust_city_id'][$add];
                    $add_obj->cust_zip_code         = @$_POST['cust_zip_code'][$add];
                    $add_obj->save();
                }
            }
        }


        echo $d->id;
    }

    public function edit($id) {
        $meta['page_title'] = lang('Edit Customer');
        if($_POST && $_POST['name'] != '') {
            if($this->mdl->update_customer($_POST)) {
                $this->session->set_flashdata('success',lang('cupdate'));
                redirect('customer');
            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('customer');
            }
        } else {
            $this->data['customer'] = $this->mdl->get($id);
            $this->data['customer_categories']  =  $this->maahi->get_active_data('tech_customer_category');
            $this->data['designations']         =  $this->maahi->get_active_data('zyd_designation');
            $this->data['states']               =  $this->maahi->get_states();
            $this->data['cities']               =  $this->maahi->get_cities();
            $this->data['contacts']             =  $this->maahi->get_contacts($id);
            $this->data['addresses']            =  $this->maahi->get_address($id);
            $this->data['industry_type']             =  $this->maahi->get_active_data('tech_industry_type');

            $this->data['services']      =  $this->maahi->get_active_data('tech_service_category');
            $this->data['products']      =  $this->maahi->get_active_data('zyd_product_category');
            // echo "<pre>";print_r($this->data['products']);die();
            
            $this->page_construct('customer/edit',$meta, $this->data);
        }
    }
    
    
  function export_data($w)
  {
         
       $query = "SELECT * FROM `sam_customers` WHERE is_deleted = '0' $w ORDER BY id DESC";
         $d = ORM::for_table('sam_customers')->raw_query($query)->find_array();
      
          
       $date =  date('d-m-Y');
       $excelName = 'Customer_'.$date;
    
        $this->load->library("excel");
        $object = new PHPExcel();
    
        $object->setActiveSheetIndex(0);
                            
        $table_columns = array("No","Customer Category","Name", "Customer Code", "Address","Mobile Number","Email Address","Reference by","GST No","Pin code","Pan Number");
                            
        $column = 0;
    
        foreach($table_columns as $field) 
        {

         $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
         $column++;
        }

        $excel_row = 2;

        foreach($d as $key=>$row)
        { 
          $i=0;
          $row['customer_category_id'] = $this->sam->get_real_value('tech_customer_category','id',$row['customer_category_id'],'title');
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key + 1);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['customer_category_id']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['name']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['customer_code']);     
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['address']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['mobile']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['email']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['reference_by']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['gst_no']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['pin_code']);
          $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['pan_no']);

          
          $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
        $object_writer->save('php://output');
  } 
  
  function get_details_inmodel()
    {
            $this->data['row'] = ORM::for_table('sam_customers')->where('id',$_POST['id'])->find_one();
            // echo "<pre>";print_r($this->data['row']);die();
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
     public function customer_address_delete($id) {
        $this->sam->_delete_by_id($id,'sam_customers_address');
    } 
    public function customer_contact_delete($id) {
        $this->sam->_delete_by_id($id,'sam_customers_contact');
    }

    function get_auto_customer_code()
    {
        $customer = ORM::for_table('sam_customers')->order_by_desc('id')->find_one();
        $last_code = 1;
        if(!empty($customer)){
            $last_code =  $customer->customer_code + 1;
        }
        $last_code = sprintf('%05d',sprintf('%05d',$last_code));    
        return $last_code;

    }


}
