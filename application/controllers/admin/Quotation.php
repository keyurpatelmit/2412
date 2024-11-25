<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_quotation','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('quotation_s_subject');
        $this->session->unset_userdata('quotation_s_start_date');
        $this->session->unset_userdata('quotation_s_end_date');
        $this->session->unset_userdata('quotation_s_status');
        $this->session->unset_userdata('quotation_s_cust');
        $this->session->unset_userdata('quotation_serach_data');
        redirect('admin/quotation');
    } 


    public function index() {
        $w  = '';
        if($this->session->userdata('identity') !== 'admin'){
            $loginId = $this->session->userdata('loginid');
            $w .= "AND ( assign_user_id ='".$loginId."' OR create_by_id ='".$loginId."' )";
        }
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if(isset($_POST['quotation_s_cust']) AND $_POST['quotation_s_cust'] != ''){
                $w .= " AND customer_id ='".$_POST['quotation_s_cust']."'";
                $this->session->set_userdata('quotation_s_cust',$_POST['quotation_s_cust']);
            }
            
            if(isset($_POST['quotation_s_subject']) AND $_POST['quotation_s_subject'] != ''){
                $w .= " AND ( quotation_subject like'%".$_POST['quotation_s_subject']."%' OR quotation_no ='".$_POST['quotation_s_subject']."' ) ";
                $this->session->set_userdata('quotation_s_subject',$_POST['quotation_s_subject']);
            }
            
            
            if($_POST['quotation_s_start_date'] != '' AND $_POST['quotation_s_end_date'] == '') {
                $w .= "AND DATE(quotation_date) = '".$_POST['quotation_s_start_date']."'";
                $this->session->set_userdata('quotation_s_start_date',$_POST['quotation_s_start_date']);
            }
            
            if($_POST['quotation_s_start_date'] != '' AND $_POST['quotation_s_end_date'] != ''){
                $w .= "AND DATE(quotation_date) BETWEEN  '".$_POST['quotation_s_start_date']."' AND  '".$_POST['quotation_s_end_date']."'";
                $this->session->set_userdata('quotation_s_start_date',$_POST['quotation_s_start_date']);
                $this->session->set_userdata('quotation_s_end_date',$_POST['quotation_s_end_date']);
            }
            
            if(isset($_POST['quotation_s_status']) AND $_POST['quotation_s_status'] != ''){
                $w .= " AND status ='".$_POST['quotation_s_status']."'";
                $this->session->set_userdata('quotation_s_status',$_POST['quotation_s_status']);
            }
            $_SESSION['quotation_serach_data'] = $w;
            $this->session->set_userdata('quotation_serach_data',$w);
        }

        if(isset($this->session->quotation_serach_data) AND $this->session->quotation_serach_data != ''){
             $w = $this->session->userdata('quotation_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/quotation/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);

        //Export Excel Function Call
        if(isset($_POST['SearchValue']))
        {
          if($_POST['SearchValue'] == 'excel') { $this->export_data($w);}    
        }

        $meta['page_title'] = 'Proposal / Quotation';
         $this->data['customers'] = $this->maahi->get_customer_list();
         $this->data['sys_state'] = $this->mdl->get_sys_state();
                     // echo "<pre>"; print_r($this->data['sys_state']);die();
        $this->page_construct('quotation/view', $meta, $this->data);
    }

    public function add_quotation() 
    {
        $meta['page_title'] = 'Add Proposal / Quotation ';
        $this->data['employees'] = $this->maahi->get_employees();
        $this->data['customers'] = $this->maahi->get_customer_list();
        // echo "<pre>"; print_r($this->data['sys_state']);die();
        $this->data['inquiry_sources']    =  $this->maahi->get_active_data('tech_inquiry_source');
        $this->data['designations']       =  $this->maahi->get_active_data('zyd_designation');
        $this->data['states']             =  $this->maahi->get_states();
        $this->data['cities']             =  $this->maahi->get_cities();
        $this->data['services']           =  $this->maahi->get_services();
        // echo "<pre>";print_r($this->data['services']);die();
        $this->data['products']           =  $this->maahi->get_products();
        $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
        $this->data['auto_quotation_no']  =  $this->maahi->get_autogenrate_no('tech_quotation');
        $this->data['auto_customers_no']  =  $this->maahi->get_autogenrate_no('sam_customers');
        $this->data['industry_type']             =  $this->maahi->get_active_data('tech_industry_type');
        $this->data['sys_state'] = $this->mdl->get_sys_state();
        $this->page_construct('quotation/add_quotation', $meta, $this->data);
    }

    public function add_new_customer() {

         $checkexist = ORM::for_table('sam_customers')->where('email',$_POST['cust_email'])->where('is_deleted','0')->find_one();
        if(!empty($checkexist))
        {
            $output['status'] = 2;
            $output['msg'] = 'this email id already exist';
            echo json_encode($output); 
        }else{

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
            $output['status']   = 1;
            $output['customer_id']  = $d->id;
            $output['customers']    =     $this->maahi->get_customer_list();
            $output['msg'] = 'Successfull add new Customer';
            echo json_encode($output); 
        }
    }
    
    public function add_row() 
    {
        $d = ORM::for_table('tech_quotation')->create();
        $d->quotation_subject   = @$_POST['quotation_subject'];
        $d->inquiry_id          = @$_POST['inquiry_id'];
        // $d->assign_user_id      = $_POST['assign_user_id'];
        $d->quotation_date        = $this->maahi->add_date_format($_POST['quotation_date']);
        $d->inquiry_source_id   = $_POST['inquiry_source_id'];
        $d->customer_id         = $_POST['customer_id']; 
        $d->total_amount        = $_POST['total_amount']; 
        $d->total_margin        = $_POST['total_margin']; 


        $d->quotation_no        = $_POST['quotation_no']; 
        $d->valid_till          = $_POST['valid_till']; 
        $d->reference           = $_POST['reference']; 
        
        // $d->customer_contact_id         = $_POST['customer_contact_id'];
        $d->contact_designation_id      = $_POST['contact_designation_id'];
        $d->contact_email               = $_POST['contact_email'];
        $d->contact_mobile              = $_POST['contact_mobile'];
        
        $d->b_address_name      = $_POST['b_address_name'];
        $d->b_address           = $_POST['b_address'];
        $d->b_state             = $_POST['b_state'];
        $d->b_city              = $_POST['b_city'];
        $d->b_zip_code          = $_POST['b_zip_code'];

        $d->s_address_name      = $_POST['s_address_name'];
        $d->s_address           = $_POST['s_address'];
        $d->s_state             = $_POST['s_state'];
        $d->s_city              = $_POST['s_city'];
        $d->s_zip_code          = $_POST['s_zip_code'];

        $d->team_conditions      = $_POST['team_conditions'];
        // $d->term_condition_id   = $this->maahi->implode_field($_POST['term_condition_id']);
        // $d->remark         = $_POST['remark'];   
        $d->inserted_time   = date('Y-m-d H:i:s');
        $d->create_by_id         = $this->session->userdata('loginid');
        $d->save();

        if(!empty($_POST['term_condition_id'])){
              for($terms=0; $terms < count($_POST['term_condition_id']); $terms++) { 
                  if($_POST['term_condition_id'][$terms] !== ''){
                      $terms_data = ORM::for_table('tech_quotation_term_condition')->create();
                      $terms_data->quotation_id         = $d->id;
                      $terms_data->term_id             = @$_POST['term_condition_id'][$terms];
                      $terms_data->item_description    = @$_POST['term_condition_txt'][$terms];
                      $terms_data->save();
                  }
              }
          } 

        if(!empty($_POST['item_type'])){

              for($i=0; $i < count($_POST['item_type']); $i++) { 
                  if($_POST['item_type'][$i] !== ''){
                      $items = ORM::for_table('tech_quotation_item')->create();
                      $items->quotation_id         = $d->id;
                      $items->item_type           = @$_POST['item_type'][$i];
                     
                      if($_POST['item_type'][$i] == 'service'){
                           $items->item_id       = @$_POST['item_service'][$i];
                           $items->item_gst      = $this->sam->get_real_value('zyd_products_mst','id',@$_POST['item_service'][$i],'gst');
                        }else{
                           $items->item_id        = @$_POST['item_product'][$i];
                           $items->item_gst      = $this->sam->get_real_value('zyd_products_mst','id',@$_POST['item_product'][$i],'gst');
                        }

                      $items->item_qty              = @$_POST['item_qty'][$i];
                      $items->item_tax              = @$_POST['item_tax'][$i];
                      $items->item_rate             = @$_POST['item_rate'][$i];
                      $items->item_amount           = @$_POST['item_amount'][$i];
                      $items->item_igst             = @$_POST['item_igst'][$i];
                      $items->item_cgst             = @$_POST['item_cgst'][$i];
                      $items->item_sgst             = @$_POST['item_sgst'][$i];
                      $items->item_final_total      = @$_POST['item_final_total'][$i];
                      // $items->item_price          = @$_POST['item_price'][$i];
                      // $items->item_gst            = @$_POST['item_gst'][$i];
                      // $items->purchase_item_price = @$_POST['purchase_item_price'][$i];
                      // $items->margin_item_price   = @$_POST['margin_item_price'][$i];
                      // $items->item_description    = @$_POST['item_description'][$i];
                      $items->save();
                  }
              }
          } 

          $login_name = $this->session->userdata('loginname');
          $type = 'Quotation';
          $item_id = $d->id;
          $assign_user_id = $_POST['assign_user_id'];
          $notification = 'New Quotation create by '.$login_name;
          $this->sam->notification($type,$item_id,$assign_user_id,$notification); 

    }

     public function edit($id) {
        
        $meta['page_title'] = 'Inquiry';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/quotation');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/quotation');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['employees']        = $this->maahi->get_employees();
            $this->data['customers']        = $this->maahi->get_customer_list();
            $this->data['inquiry_sources']  =  $this->maahi->get_active_data('tech_inquiry_source');
            $this->data['designations']     =  $this->maahi->get_active_data('zyd_designation');
            $this->data['states']           =  $this->maahi->get_states();
            $this->data['cities']           =  $this->maahi->get_cities();

            $this->data['services']      =  $this->maahi->get_services();
            $this->data['products']      =  $this->maahi->get_products();
            $this->data['contacts']      =  $this->maahi->get_contacts($this->data['row']->customer_id);
            $this->data['addresses']     =  $this->maahi->get_address($this->data['row']->customer_id);
            $this->data['inquiry_items'] =  $this->maahi->get_quotation_item($id);
            $this->data['quotation_terms'] =  $this->maahi->get_quotation_terms($id);
            $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
            $this->data['sys_state'] = $this->mdl->get_sys_state();
            
            
            $this->page_construct('quotation/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `tech_inquiry` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('tech_inquiry')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'inquiry_source_'.rand(10000,99999).'_'.$date;
    
      $this->load->library("excel");
      $object = new PHPExcel();
    
      $object->setActiveSheetIndex(0);
                            
      $table_columns = array("No","Title");
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
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key + 1);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $row['title']);
        $excel_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }


    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'tech_quotation');
    }
    public function remove_items($id) {
        $this->maahi->_delete_by_id($id,'tech_quotation_item');
    }
    public function remove_quotation_terms($id) {
        $this->maahi->_delete_by_id($id,'tech_quotation_term_condition');
    }

   public function quotation_pdf($quotation_id)
    {
       $Settings = ORM::for_table('sam_settings')->where('id',1)->find_one();
       $quotation = ORM::for_table('tech_quotation')->where('id',$quotation_id)->find_one();
       $logo_url = site_url().'themes/default/admin/assets/upload/logos/'.$Settings->pdf_back_image;
       $query = "SELECT item_description FROM tech_quotation_term_condition WHERE quotation_id = '$quotation_id' AND is_deleted = '0'";
       $quotation_terms = ORM::for_table('tech_quotation_term_condition')->raw_query($query)->find_one();
       // echo "<pre>";print_r($quotation_terms);die();

       $this->data['quotation_items'] =  $this->maahi->get_quotation_item($quotation_id);
       $this->load->library('Pdf');
       $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
       $term_condition_txt = '';

       if(!empty($Quotation_terms)){
          foreach ($Quotation_terms as $key => $Quotation_term) {
            $term_condition_txt .= $Quotation_term['item_description'];
          }
       }
       
       $customer_address = $quotation->b_address;
       $customer_state = $this->sam->get_real_value('zyd_state','id',$quotation->b_state,'state');
       $customer_city = $this->sam->get_real_value('zyd_city','id',$quotation->b_city,'city');
       $customer_pin = $this->sam->get_real_value('tech_quotation','id',$quotation_id,'b_zip_code');

       $cust_id = $quotation->customer_id;
       $customer = ORM::for_table('sam_customers')->where('id', $cust_id)->find_one();
       $custmoter_state_id = $customer->state_id;
       $system_state_id = $Settings->state_id;

       $customer_name = $this->sam->get_real_value('sam_customers','id',$cust_id,'name');
       $customer_mobile = $this->sam->get_real_value('sam_customers','id',$cust_id,'mobile');
       $customer_email = $this->sam->get_real_value('sam_customers','id',$cust_id,'email');
       $customer_gst = $this->sam->get_real_value('sam_customers','id',$cust_id,'gst_no');
       $customer_pan = $this->sam->get_real_value('sam_customers','id',$cust_id,'pan_no');

       $emp_sign = $this->sam->get_real_value('sam_users','id',$quotation->assign_user_id,'sign');
       $contact_person = $this->sam->get_real_value('sam_customers_contact','id',$quotation->customer_contact_id,'contact_persons');
       $preperd_by = $this->sam->get_real_value('sam_users','id',$quotation->assign_user_id,'name');

        // set document information
        $tcpdf->SetCreator(PDF_CREATOR);
        //$tcpdf->SetAuthor('Muhammad Saqlain Arif 1');
        
        $tcpdf->SetTitle('Quotation Details');
        $tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

        $tcpdf->setFooterData(array(0,65,0), array(0,65,127));
        $tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $tcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $tcpdf->SetMargins(5, 20, 5); //PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
        // $tcpdf->SetHeaderMargin(5);

        $tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')){
            require_once(dirname(__FILE__).'/lang/eng.php');
            $tcpdf->setLanguageArray($l);
        }
        $tcpdf->setFontSubsetting(true);
        $tcpdf->SetFont('dejavusans', '', 8, '', true);
        $tcpdf->AddPage();
      
        $tbl_dynamic = '';    
        $total_qty = 0;
        $total_price = 0;
        $grandTotal = 0;

        $top_tbl_header = '';
        $top_tbl_header .= '<table cellspacing="0" cellpadding="5" width="100%">';
        $top_tbl_header .= '<tr>';
        $top_tbl_header .= '<td style="text-align: center; color: green;"><h1>Quotation</h1></td>';
        $top_tbl_header .= '</tr>';
        $top_tbl_header .= '<tr>';
        $top_tbl_header .= '<td style="width:30%;"><img style="width:100px" src="' . $logo_url . '" alt=""></td>';
        $top_tbl_header .= '<td style="width:70%; text-align:right;">';
        $top_tbl_header .= '<p>Quotation No: <b>' . $quotation->quotation_no . '</b></p>';
        $top_tbl_header .= '<p>Quotation Date: <b>' . $this->maahi->date_format($quotation->quotation_date) . '</b></p>';
        $top_tbl_header .= '<p>Created By: <b>' . $Settings->sitename . '</b></p>';
        $top_tbl_header .= '</td>';
        $top_tbl_header .= '</tr>';
        $top_tbl_header .= '</table>';
        $top_tbl_header .= '';
        $tcpdf->writeHTMLCell(0, 0, '', '', $top_tbl_header, 0, 1, 0, true, '', true);
        
        
        
        $table_address = '';
        $table_address .= '<table width="100%"  cellpadding="3">';
        $table_address .= '<tr>';
        $table_address .= '<td style="color: green;"><h2>Quotation From</h2></td>';
        $table_address .=  '</tr>';
        $table_address .=  '<tr>';
        $table_address .= '<td>'.$Settings->sitename.'</td>';
        $table_address .= '</tr>';
        $table_address .=  '<tr>';
        $table_address .= '<td>'.$Settings->address.'</td>';
        $table_address .= '</tr>';
        $table_address .= '<tr>';
        $table_address .= '<td width="25%"><b>GST :</b></td>';
        $table_address .= '<td>'.$Settings->gst_no.'</td>';
        $table_address .= '</tr>';
        
        $table_address .= '<tr>';
        $table_address .= '<td><b>Pan : </b></td>';
        $table_address .= '<td>'.$Settings->pan_no.'.</td>';
        $table_address .= '</tr>';

        $table_address .= '<tr>';
        $table_address .= '<td><b>Email : </b></td>';
        $table_address .= '<td>'.$Settings->email.'</td>';
        $table_address .= '</tr>';

        $table_address .= '<tr>';
        $table_address .= '<td><b>Phone : </b></td>';
        $table_address .= '<td>'.$Settings->mobile.'</td>';
        $table_address .= '</tr>';
        $table_address .= '</table>';
        
        
        $table_header_rigiht = '';
        $table_header_rigiht .= '<table width="100%" cellpadding="3" >';
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td style="color: green;"><h2>Quotation For</h2></td>';
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td>'.$customer_name.'</td>';
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td>'.$customer_address.' - '.$customer_city.' - '.$customer_state.' - '.$customer_pin.'</td>'; 
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="35%"><b>GST :</b></td>';
        $table_header_rigiht .= '<td>'.$customer_gst.'</td>';
        $table_header_rigiht .= '</tr>';
        
        $table_header_rigiht .= '<tr>';
        $table_header_rigiht .= '<td width="35%"><b>PAN :</b></td>';
        $table_header_rigiht .= '<td>'.$customer_pan.'</td>';
        $table_header_rigiht .= '</tr>';
     
        $table_header_rigiht .= '</table>';
        
        
        $tbl_header = '';
        $tbl_header .= '<table cellspacing="0" cellpadding="10" width="100%" style="background-color: #e2f7dc;  ">';
        $tbl_header .= '<tr>';
        $tbl_header .= '<td width="50%" style="font-size:10px; border-right: 6px solid white;">'.$table_address.'</td>';
        $tbl_header .= '<td width="50%" style="font-size:10px;">'.$table_header_rigiht.'</td>';
        $tbl_header .= '</tr>';
        $tbl_header .= '</table>';
        $tbl_header .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header, 0, 1, 0, true, '', true);
        
        $top_tbl_supply = '';
        $top_tbl_supply .= '<table cellspacing="0" cellpadding="5" width="100%" >';
        $top_tbl_supply .= '<tr>';
        $top_tbl_supply .= '<td style="text-align:left;"><h3><b>Country Of Supply - </b><span style="font-weight:normal;">'.$Settings->country.'</span></h3></td>';
        $top_tbl_supply .= '<td style="text-align:right;"><h3><b>Place Of Supply - </b><span style="font-weight:normal;">'.$customer_state.'</span></h3></td>';
        $top_tbl_supply .= '</tr>';
        $top_tbl_supply .= '</table>';
        $top_tbl_supply .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $top_tbl_supply, 0, 1, 0, true, '', true);

       
        $grand_total = 0;
        $gst_igst_total   = 0;
        $gst_cgst_total  = 0;
        $gst_sgst_total  = 0;
        $cgst_sgct_total  = 0;
        $grand_total_with_igst = 0;
        $grand_total_with_cs  = 0;
        $sub_total_with_cs = 0;

     foreach ($this->data['quotation_items'] as $key=>$row) 
     {
         
        $product_name = '';
        $prod_total = 0;  
        $grand_total += $row['item_rate'];
        $gst_igst_total += $row['item_igst'];
        $gst_cgst_total += $row['item_cgst'];
        $gst_sgst_total += $row['item_sgst'];
        $cgst_sgct_total = $gst_cgst_total + $gst_sgst_total;
        $sub_total_with_cs = $cgst_sgct_total + $grand_total;
        $grand_total_with_igst = $gst_igst_total + $grand_total;
        $grand_total_with_cs = $sub_total_with_cs;
        
        $prod_total = $row['item_qty'] * $row['item_price'];
        
        if($row['item_type'] == 'service'){
          $item_name = $this->sam->get_real_value('tech_service','id',$row['item_id'],'title');
          $item_category_id = $this->sam->get_real_value('tech_service','id',$row['item_id'],'service_category_id');
          $item_category_name = $this->sam->get_real_value('tech_service_category','id',$item_category_id,'title');

        }else{
          
          $prodID = $row['item_id'];
          $item_name = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'product_name');
          $product_hsn = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'hsn_code');
          $product_part_no = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'sku');
          $unit_of_measurement = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'uom_id');
          $unit_of_measurement_name = $this->sam->get_real_value('tech_uom','id',$unit_of_measurement,'title');

          if($product_part_no != ''){
            $product_part_no = 'Part Code : '.$product_part_no.'';
          }

        }

        $key = $key + 1;
        $tbl_dynamic .= '<tr style="text-align:center; background-color: #e2f7dc; color: black;">';
        $tbl_dynamic .= '<td width="5%">'.$key.'</td>'; 
        $tbl_dynamic .= '<td width="32%" style="font-size:12px"> '.$item_name.'('.$item_category_name.')'.'</td>'; 
        $tbl_dynamic .= '<td width="6%"  style="text-align:center">'.$row['item_qty'].'</td>';
        $tbl_dynamic .= '<td width="6%"  style="text-align:center">'.$row['item_tax'].'%</td>';
        $tbl_dynamic .= '<td width="15%"  style="text-align:center">₹'.number_format($row['item_rate']).'</td>';
        $tbl_dynamic .= '<td width="10%"  style="text-align:center">₹'.number_format($row['item_amount']).'</td>';
        if($system_state_id == $custmoter_state_id){
        $tbl_dynamic .= '<td width="16%"  style="text-align:center">₹'.number_format($row['item_igst']).'</td>';
        }else{
        $tbl_dynamic .= '<td width="8%"  style="text-align:center">₹'.number_format($row['item_cgst']).'</td>';
        $tbl_dynamic .= '<td width="8%"  style="text-align:center">₹'.number_format($row['item_sgst']).'</td>';
        }
        $tbl_dynamic .= '<td width="10%"  style="text-align:center">₹'.number_format($row['item_final_total']).'</td>';
        $tbl_dynamic .= '</tr>';
    }
       
        
        $tbl = '';  
        $tbl .= '<table cellspacing="0" cellpadding="5" width="100%" style="border-collapse: collapse;">';
        $tbl .= '<tr style="text-align:center; background-color: green; color: white;">';
        $tbl .= '<td  width="5%"><b>No</b></td>'; 
        $tbl .= '<td width="32%" style="text-align:center;"><b>Item name</b></td>';
        $tbl .= '<td width="6%" style="text-align:center;"><b>Qty</b></td>';
        $tbl .= '<td width="6%" style="text-align:center;"><b>GST Rate</b></td>';
        $tbl .= '<td width="15%" style="text-align:center;"><b>Rate</b></td>';
        $tbl .= '<td width="10%" style="text-align:center;"><b>Amount</b></td>';
        if($system_state_id == $custmoter_state_id){
        $tbl .= '<td width="16%" style="text-align:center;"><b>IGST</b></td>';
        }else{
        $tbl .= '<td width="8%" style="text-align:center;"><b>CGST</b></td>';
        $tbl .= '<td width="8%" style="text-align:center;"><b>SGST</b></td>';
        }
        $tbl .= '<td width="10%" style="text-align:center;"><b>Total</b></td>';
        $tbl .= '</tr>';

        $tbl .= $tbl_dynamic;
        $tbl .= '<tr>';
        $tbl .= '<td colspan="10"></td>';
        $tbl .= '</tr>';
        $tbl .= '<tr>';
         $tbl .= '<td colspan="4" ></td>';
        $tbl .= '<td colspan="2"  style="text-align:right"><b>Amount</b></td>';
        $tbl .= '<td colspan="3"  style="text-align:right">₹'.number_format($grand_total).'</td>';
        $tbl .= '</tr>';
        if($system_state_id == $custmoter_state_id){
        $tbl .= '<tr>';
        $tbl .= '<td colspan="4" ></td>';
        $tbl .= '<td colspan="2"  style="text-align:right">IGST</td>';
        $tbl .= '<td colspan="3"  style="text-align:right">₹'.number_format($gst_igst_total).'</td>';
        $tbl .= '</tr>';
        }else{
        $tbl .= '<tr>';
        $tbl .= '<td colspan="4" ></td>';
        $tbl .= '<td colspan="2"  style="text-align:right">CSGT</td>';
        $tbl .= '<td colspan="3"  style="text-align:right">₹'.number_format($gst_cgst_total).'</td>';
        $tbl .= '</tr>';
        $tbl .= '<tr>';
        $tbl .= '<td colspan="4" ></td>';
        $tbl .= '<td colspan="2"  style="text-align:right">SGST</td>';
        $tbl .= '<td colspan="3"  style="text-align:right">₹'.number_format($gst_sgst_total).'</td>';
        $tbl .= '</tr>';
        }
        $tbl .= '<tr style="border-top: 1px solid black; border-bottom: 1px solid black;">';
        $tbl .= '<td colspan="4" ></td>';
        $tbl .= '<td colspan="2"  style="text-align:right"><b>Total Amount(INR)</b></td>';
        $tbl .= '<td colspan="3"  style="text-align:right">₹'.number_format($grand_total_with_cs).'</td>';
        $tbl .= '</tr>';
        $tbl .= '';
        $tbl .='</table>';
        
       

        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);
        
        
        $term ='';
        $term .='<table width="100%" cellpadding="10" colspan="10">';
        $term .= '<tr>';
        $term .= '<td colspan="10"></td>';
        $term .= '</tr>';
        $term .='<tr><td colspan="10"><h2 style="color: green;" >Terms & Condition</h2><br>'.$quotation_terms->item_description.'<br>'.'</td></tr>';
        $term .='</table>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $term, 0, 1, 0, true, '', true);
        
        // $term_company_info ='';
        // $term_company_info .='<br><table width="100%" border="1"  cellpadding="5">';
        // $term_company_info .='<tr><td colspan="4"><h3>company Details</h3></td></tr>';
        // $term_company_info .='<tr>';
        // $term_company_info .='<td><b>Tan no</b></td>';
        // $term_company_info .='<td>BRDM06175B</td>';
        // $term_company_info .='<td><b>ESIC No</b></td>';
        // $term_company_info .='<td>38000241050000999</td>';
        // $term_company_info .='</tr>';
        
        // $term_company_info .='<tr>';
        // $term_company_info .='<td><b>Pan no</b></td>';
        // $term_company_info .='<td>AALPD8312R</td>';
        // $term_company_info .='<td><b>PF No</b></td>';
        // $term_company_info .='<td>VDBRD1377735000</td>';
        // $term_company_info .='</tr>';
        
        // $term_company_info .='<tr>';
        // $term_company_info .='<td><b>GST no </b></td>';
        // $term_company_info .='<td>24AALPD8312R1ZD</td>';
        // $term_company_info .='</tr>';
        
        // $term_company_info .='</table>';
        // $tcpdf->writeHTMLCell(0, 0, '', '', $term_company_info, 0, 1, 0, true, '', true);
        
        
        //  $term_company_info ='';
        // $term_company_info .='<br><table width="100%" border="1"  cellpadding="5">';
        // $term_company_info .='<tr><td colspan="4"><h3>Bank Details </h3></td></tr>';
        // $term_company_info .='<tr>';
        // $term_company_info .='<td><b>Bank Name</b></td>';
        // $term_company_info .='<td>Bank of Baroda</td>';
        // $term_company_info .='<td><b>Account No</b></td>';
        // $term_company_info .='<td>01890500000106</td>';
        // $term_company_info .='</tr>';
        
        // $term_company_info .='<tr>';
        // $term_company_info .='<td><b>Branch ISFC Code</b></td>';
        // $term_company_info .='<td>AALPD8312R</td>';
        // $term_company_info .='<td><b>Address</b></td>';
        // $term_company_info .='<td>I. E. Gorwa Branch, P. B. No. 130,Industrial Estate,<br> Bidc Bldg, Gorwa Road,Baroda, 390016</td>';
        // $term_company_info .='</tr>';
        // $term_company_info .='</table>';
        // $tcpdf->writeHTMLCell(0, 0, '', '', $term_company_info, 0, 1, 0, true, '', true);
        

        // $footer_company_info ='';
        // $footer_company_info .='<br><table width="100%"  cellpadding="5">';
        // $footer_company_info .='<tr>';
        // $footer_company_info .= '<td colspan="10">Quotation NO<br>'.$quotation->quotation_no.'<br>'.'</td>';
        // $footer_company_info .= '<td colspan="10">Quotation Date<br>'.$quotation->quotation_date.'<br>'.'</td>';
        // $footer_company_info .= '<td colspan="10">Quotation For<br>'.$customer_name.'<br>'.'</td>';
        // $footer_company_info .='</tr>';
        // $footer_company_info .='</table>';
        // $tcpdf->writeHTMLCell(0, 0, '', '', $footer_company_info, 0, 1, 0, true, '', true);
        
   /* if(!empty($emp_sign))
    {
        
    
        $tbl_terms_sign = '';
        $tbl_terms_sign .= '<table cellspacing="0" cellpadding="10" width="100%">';
        $tbl_terms_sign .= '<tr>';
        $tbl_terms_sign .= '<td style="text-align:right"><img width="150px" src="'.site_url().'themes/assets/images/usersign/'.$emp_sign.'"></td>';
        $tbl_terms_sign .= '</tr>';
        $tbl_terms_sign .= '</table>';
        $tbl_terms_sign .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_terms_sign, 0, 1, 0, true, '', true);
    }*/
        
      

        $tcpdf->Output('quotation_details.pdf', 'I');
        
    }


    public function convert_quotation_to_invoice($id) {
        
        $meta['page_title'] = 'Invoice';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/convert_quotation_to_invoice');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/convert_quotation_to_invoice');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['employees']        = $this->maahi->get_employees();
            $this->data['customers']        = $this->maahi->get_customer_list();
            $this->data['inquiry_sources']  =  $this->maahi->get_active_data('tech_inquiry_source');
            $this->data['designations']     =  $this->maahi->get_active_data('zyd_designation');
            $this->data['states']           =  $this->maahi->get_states();
            $this->data['cities']           =  $this->maahi->get_cities();

            $this->data['services']      =  $this->maahi->get_services();
            $this->data['products']      =  $this->maahi->get_products();
            $this->data['contacts']      =  $this->maahi->get_contacts($this->data['row']->customer_id);
            $this->data['addresses']     =  $this->maahi->get_address($this->data['row']->customer_id);
            $this->data['inquiry_items'] =  $this->maahi->get_quotation_item($id);
            $this->data['quotation_terms'] =  $this->maahi->get_quotation_terms($id);
            $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
            $this->data['auto_invoice_no']  =  $this->maahi->get_autogenrate_no('tech_invoice');
            
            
            $this->page_construct('quotation/convert_quotation_to_invoice',$meta, $this->data);
        }
    }


    public function revise_quotation($id) {
        
        $meta['page_title'] = 'Quotation Revise';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/revise_quotation');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/revise_quotation');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['employees']        = $this->maahi->get_employees();
            $this->data['customers']        = $this->maahi->get_customer_list();
            $this->data['inquiry_sources']  =  $this->maahi->get_active_data('tech_inquiry_source');
            $this->data['designations']     =  $this->maahi->get_active_data('zyd_designation');
            $this->data['states']           =  $this->maahi->get_states();
            $this->data['cities']           =  $this->maahi->get_cities();

            $this->data['services']      =  $this->maahi->get_services();
            $this->data['products']      =  $this->maahi->get_products();
            

            $this->data['contacts']      =  $this->maahi->get_contacts($this->data['row']->customer_id);
            $this->data['addresses']     =  $this->maahi->get_address($this->data['row']->customer_id);
            $this->data['inquiry_items'] =  $this->maahi->get_quotation_item($id);
            $this->data['quotation_terms'] =  $this->maahi->get_quotation_terms($id);
            $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
            $this->data['auto_quotation_no']  =  $this->maahi->get_autogenrate_no('tech_quotation');
            
            $this->page_construct('quotation/revise_quotation',$meta, $this->data);
        }
    }

    public function sales($id) {
        
        $meta['page_title'] = 'Convert Quotation to Sales';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/quotation');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/quotation');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['employees']        = $this->maahi->get_employees();
            $this->data['customers']        = $this->maahi->get_customer_list();
            $this->data['inquiry_sources']  =  $this->maahi->get_active_data('tech_inquiry_source');
            $this->data['designations']     =  $this->maahi->get_active_data('zyd_designation');
            $this->data['states']           =  $this->maahi->get_states();
            $this->data['cities']           =  $this->maahi->get_cities();

            $this->data['services']         =  $this->maahi->get_services();
            $this->data['products']         =  $this->maahi->get_products();
            $this->data['contacts']         =  $this->maahi->get_contacts($this->data['row']->customer_id);
            $this->data['addresses']        =  $this->maahi->get_address($this->data['row']->customer_id);
            $this->data['inquiry_items']    =  $this->maahi->get_quotation_item($id);
            $this->data['quotation_terms']  =  $this->maahi->get_quotation_terms($id);
            $this->data['terms_condition']  =  $this->maahi->get_active_data('tech_term_condition');
            $this->data['auto_invoice_no']  =  $this->maahi->get_autogenrate_no('tech_sales_order');
            $this->data['vendors']          =  $this->maahi->get_vendor_list();

            $this->page_construct('quotation/sales',$meta, $this->data);
        }
    }

    public function add_sales_order() {
        
        $d = ORM::for_table('tech_sales_order')->create();
        $d->sales_order_date    = $this->maahi->add_date_format($_POST['sales_order_date']);
        
        $d->po_no               = @$_POST['po_no'];
        $d->sales_order_no      = @$_POST['sales_order_no'];
        $d->assign_user_id      = @$_POST['assign_user_id'];
        $d->inquiry_source_id   = @$_POST['inquiry_source_id'];
        $d->customer_id         = @$_POST['customer_id']; 
        $d->total_amount        = @$_POST['total_amount']; 
        $d->total_margin        = @$_POST['total_margin']; 
        $d->quotation_no        = @$_POST['quotation_no']; 
        
        $d->customer_contact_id         = @$_POST['customer_contact_id'];
        $d->contact_designation_id      = @$_POST['contact_designation_id'];
        $d->contact_email               = @$_POST['contact_email'];
        $d->contact_mobile              = @$_POST['contact_mobile'];

        $d->delivery_date          = @$_POST['delivery_date'];
        $d->delivery_note          = @$_POST['delivery_note'];
        $d->shipping_address_pdf   = @$_POST['shipping_address_pdf'];
        $d->payment_terms        = @$_POST['payment_terms'];
        
        $d->b_address_name      = @$_POST['b_address_name'];
        $d->b_address           = @$_POST['b_address'];
        $d->b_state             = @$_POST['b_state'];
        $d->b_city              = @$_POST['b_city'];
        $d->b_zip_code          = @$_POST['b_zip_code'];

        $d->s_address_name      = @$_POST['s_address_name'];
        $d->s_address           = @$_POST['s_address'];
        $d->s_state             = @$_POST['s_state'];
        $d->s_city              = @$_POST['s_city'];
        $d->s_zip_code          = @$_POST['s_zip_code'];
        $d->term_condition_id   = $this->maahi->implode_field($_POST['term_condition_id']);
        $d->remark              = @$_POST['remark'];   
        $d->inserted_time       = date('Y-m-d H:i:s');
        $d->create_by_id        = $this->session->userdata('loginid');
        $d->save();

        if(!empty($_POST['term_condition_id'])){
              for($terms=0; $terms < count($_POST['term_condition_id']); $terms++) { 
                  if($_POST['term_condition_id'][$terms] !== ''){
                      $terms_data = ORM::for_table('tech_sales_order_item_term_condition')->create();
                      $terms_data->sales_order_id         = $d->id;
                      $terms_data->term_id             = @$_POST['term_condition_id'][$terms];
                      $terms_data->item_description    = @$_POST['term_condition_txt'][$terms];
                      $terms_data->save();
                  }
              }
          } 

        if(!empty($_POST['item_type'])){

              for($i=0; $i < count($_POST['item_type']); $i++) { 
                  if($_POST['item_type'][$i] !== ''){
                      $items = ORM::for_table('tech_sales_order_item')->create();
                      $items->sales_order_id         = $d->id;
                      $items->item_type           = @$_POST['item_type'][$i];
                     
                      if($_POST['item_type'][$i] == 'service'){
                           $items->item_id       = @$_POST['item_service'][$i];
                           $items->item_gst      = $this->sam->get_real_value('zyd_products_mst','id',@$_POST['item_service'][$i],'gst');
                        }else{
                           $items->item_id        = @$_POST['item_product'][$i];
                           $items->item_gst      = $this->sam->get_real_value('zyd_products_mst','id',@$_POST['item_product'][$i],'gst');
                        }

                      $items->item_qty            = @$_POST['item_qty'][$i];
                      $items->item_price          = @$_POST['item_price'][$i];
                      $items->item_gst            = @$_POST['item_gst'][$i];
                      $items->purchase_item_price = @$_POST['purchase_item_price'][$i];
                      $items->margin_item_price   = @$_POST['margin_item_price'][$i];
                      $items->item_description    = @$_POST['item_description'][$i];
                      $items->save();
                  }
              }
          } 

          $login_name = $this->session->userdata('loginname');
          $type = 'Quotation';
          $item_id = $d->id;
          $assign_user_id = $_POST['assign_user_id'];
          $notification = 'New Quotation create by '.$login_name;
          $this->sam->notification($type,$item_id,$assign_user_id,$notification); 
    }

    public function challan($id) {
        
        $meta['page_title'] = 'Challan';
        if($id == '') {
              redirect('admin/quotation');
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['employees']        = $this->maahi->get_employees();
            $this->data['customers']        = $this->maahi->get_customer_list();
            $this->data['inquiry_sources']  =  $this->maahi->get_active_data('tech_inquiry_source');
            $this->data['designations']     =  $this->maahi->get_active_data('zyd_designation');
            $this->data['states']           =  $this->maahi->get_states();
            $this->data['cities']           =  $this->maahi->get_cities();

            $this->data['services']      =  $this->maahi->get_services();
            $this->data['products']      =  $this->maahi->get_products();
            

            $this->data['contacts']      =  $this->maahi->get_contacts($this->data['row']->customer_id);
            $this->data['addresses']     =  $this->maahi->get_address($this->data['row']->customer_id);
            $this->data['inquiry_items'] =  $this->maahi->get_quotation_item($id);
            $this->data['quotation_terms'] =  $this->maahi->get_quotation_terms($id);
            $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
            $this->data['auto_quotation_no']  =  $this->maahi->get_autogenrate_no('tech_challan');
            
            $this->page_construct('quotation/challan',$meta, $this->data);
        }
    }

    public function add_challan() {
        
         $d = ORM::for_table('tech_challan')->create();
        $d->challan_no                  = @$_POST['challan_no'];
        $d->invoice_no                  = @$_POST['invoice_no'];
        $d->po_no                       = @$_POST['po_no'];
        

        $d->quotation_subject           = @$_POST['quotation_subject'];
        $d->quotation_no                = @$_POST['quotation_no'];
        $d->assign_user_id              = @$_POST['assign_user_id'];
        $d->quotation_date              = $this->maahi->add_date_format($_POST['quotation_date']);
        $d->inquiry_source_id           = @$_POST['inquiry_source_id'];
        $d->customer_id                 = @$_POST['customer_id']; 
        $d->total_amount                = @$_POST['total_amount']; 
        $d->total_margin                = @$_POST['total_margin']; 
                
        $d->customer_contact_id         = @$_POST['customer_contact_id'];
        $d->contact_designation_id      = @$_POST['contact_designation_id'];
        $d->contact_email               = @$_POST['contact_email'];
        $d->contact_mobile              = @$_POST['contact_mobile'];
        $d->b_address_name              = @$_POST['b_address_name'];
        $d->b_address                   = @$_POST['b_address'];
        $d->b_state                     = @$_POST['b_state'];
        $d->b_city                      = @$_POST['b_city'];
        $d->b_zip_code                  = @$_POST['b_zip_code'];
        $d->s_address_name              = @$_POST['s_address_name'];
        $d->s_address                   = @$_POST['s_address'];
        $d->s_state                     = @$_POST['s_state'];
        $d->s_city                      = @$_POST['s_city'];
        $d->s_zip_code                  = @$_POST['s_zip_code'];
        $d->temporary_status            = @$_POST['temporary_status'];
        $d->status                      = @$_POST['status'];
        $d->remark                      = @$_POST['remark'];   
        $d->inserted_time               = date('Y-m-d H:i:s');
        $d->create_by_id                = $this->session->userdata('loginid');
        $d->save();

        if(!empty($_POST['item_type'])){
              for($i=0; $i < count($_POST['item_type']); $i++) { 
                  if($_POST['item_type'][$i] !== ''){
                      $items = ORM::for_table('tech_challan_item')->create();
                      if($_POST['item_type'][$i] == 'service'){
                        $items->item_id        = @$_POST['item_service'][$i];
                      }else{
                        $items->item_id        = @$_POST['item_product'][$i];
                      }
                      $items->challan_id         = $d->id;
                      $items->item_type           = @$_POST['item_type'][$i];
                      $items->item_qty            = @$_POST['item_qty'][$i];
                      $items->save();
                  }
              }
          } 

          $login_name = $this->session->userdata('loginname');
          $type = 'Quotation';
          $item_id = $d->id;
          $assign_user_id = $_POST['assign_user_id'];
          $notification = 'New Challan create by '.$login_name;
          $this->sam->notification($type,$item_id,$assign_user_id,$notification); 
    }

    public function convert_quotation_to_po($id) {
        
        $meta['page_title'] = 'Convert Quotation to Purchase order';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/convert_quotation_to_po');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/convert_quotation_to_po');
            }
        } else {
            $this->data['row'] = $this->mdl->get($id);
            $this->data['employees']        = $this->maahi->get_employees();
            $this->data['customers']        = $this->maahi->get_customer_list();
            $this->data['inquiry_sources']  =  $this->maahi->get_active_data('tech_inquiry_source');
            $this->data['designations']     =  $this->maahi->get_active_data('zyd_designation');
            $this->data['states']           =  $this->maahi->get_states();
            $this->data['cities']           =  $this->maahi->get_cities();

            $this->data['services']         =  $this->maahi->get_services();
            $this->data['products']         =  $this->maahi->get_products();
            $this->data['contacts']         =  $this->maahi->get_contacts($this->data['row']->customer_id);
            $this->data['addresses']        =  $this->maahi->get_address($this->data['row']->customer_id);
            $this->data['inquiry_items']    =  $this->maahi->get_quotation_item($id);
            $this->data['quotation_terms']  =  $this->maahi->get_quotation_terms($id);
            $this->data['terms_condition']  =  $this->maahi->get_active_data('tech_term_condition');
            $this->data['auto_invoice_no']  =  $this->maahi->get_autogenrate_no('tech_purchase_order');
            $this->data['vendors']          =  $this->maahi->get_vendor_list();


            
            $this->page_construct('quotation/convert_quotation_to_po',$meta, $this->data);
        }
    }

    

    

    
}