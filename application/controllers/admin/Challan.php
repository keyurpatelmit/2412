<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challan extends MY_Controller {

	function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_challan','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('challan_s_quotation');
        $this->session->unset_userdata('challan_serach_data');
        redirect('admin/city');
    } 


    public function index() {
        $w  = '';
        $paginationdata = $this->data['Settings']->rows_per_page;
        if($_POST) 
        {
            if(isset($_POST['challan_s_quotation']) AND $_POST['challan_s_quotation'] != '') 
            {
                $w .= " AND customer_id = '".$challan_s_quotation['challan_s_quotation']."'";
                $this->session->set_userdata('challan_s_quotation',$_POST['challan_s_quotation']);
            }
            $_SESSION['challan_serach_data'] = $w;
            $this->session->set_userdata('challan_serach_data',$w);
        }

        if(isset($this->session->challan_serach_data) AND $this->session->challan_serach_data != '')
        {
             $w = $this->session->userdata('challan_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/challan/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);

        $this->data['auto_quotation_no']  =  $this->maahi->get_autogenrate_no('tbl_quotation_challan');
        
        $meta['page_title'] = 'Challan ';
        $this->page_construct('challan/view', $meta, $this->data);
    }

      public function add_challan_form() 
    {
        $meta['page_title'] = 'Add Challan';
        $this->data['employees'] = $this->maahi->get_employees();
        $this->data['customers'] = $this->maahi->get_customer_list();
        $this->data['inquiry_sources']    =  $this->maahi->get_active_data('tech_inquiry_source');
        $this->data['designations']       =  $this->maahi->get_active_data('zyd_designation');
        $this->data['states']             =  $this->maahi->get_states();
        $this->data['cities']             =  $this->maahi->get_cities();
        $this->data['services']           =  $this->maahi->get_services();
        $this->data['products']           =  $this->maahi->get_products();
        $this->data['auto_challan_no']  =  $this->maahi->get_autogenrate_no('tech_challan');
        $this->data['auto_customers_no']  =  $this->maahi->get_autogenrate_no('sam_customers');
        $this->page_construct('challan/add_challan', $meta, $this->data);
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

     public function edit($id) {


        
        $meta['page_title'] = 'Challan Master';
        if($_POST && $_POST['id'] != '') {

            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/challan');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/challan');
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
            $this->data['inquiry_items'] =  $this->maahi->get_challan_item($id);
            
            $this->page_construct('challan/edit',$meta, $this->data);
        }
    }

     function export_data($w)
     {
         
       $query="SELECT * FROM `zyd_city` WHERE is_deleted = '0' $w ORDER BY id DESC";
       $d = ORM::for_table('zyd_city')->raw_query($query)->find_array();

       $date =  date('d-m-Y');
       $excelName = 'city_'.rand(10000,99999).'_'.$date;
       $this->load->library("excel");
       $object = new PHPExcel();
    
       $object->setActiveSheetIndex(0);
                             
       $table_columns = array("No","State name","City name");
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
        $zone_name = $this->sam->get_real_value('zyd_zone','id',$row['zone_id'],'zone');
        $state_name = $this->sam->get_real_value('zyd_state','id',$row['state_id'],'state');
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, $key + 1);
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, ucfirst($state_name));
        $object->getActiveSheet()->setCellValueByColumnAndRow($i++, $excel_row, ucfirst($row['city']));
        $excel_row++;
      }

      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
      $object_writer->save('php://output');
     }

   public function challan_pdf($challan_id)
    {
       $challan = ORM::for_table('tech_challan')->where('id',$challan_id)->find_one();  
       $Settings = ORM::for_table('sam_settings')->where('id',1)->find_one();  

       $this->data['challan_items'] =  $this->maahi->get_challan_item($challan->id);
       $this->load->library('Pdf');
  
       $tcpdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

       $cust_id = $challan->customer_id;
       $customer_name = $this->sam->get_real_value('sam_customers','id',$cust_id,'name');
       $customer_address = $this->sam->get_real_value('sam_customers','id',$cust_id,'address');
       $customer_mobile = $this->sam->get_real_value('sam_customers','id',$cust_id,'mobile');
       $customer_email = $this->sam->get_real_value('sam_customers','id',$cust_id,'email');

       $emp_sign = $this->sam->get_real_value('sam_users','id',$challan->assign_user_id,'sign');

       $emp_sign = $this->sam->get_real_value('sam_users','id',$challan->assign_user_id,'sign');
        $contact_person = $this->sam->get_real_value('sam_customers_contact','id',$challan->customer_contact_id,'contact_persons');

        // set document information
        $tcpdf->SetCreator(PDF_CREATOR);
        //$tcpdf->SetAuthor('Muhammad Saqlain Arif 1');
        
        $tcpdf->SetTitle('Challan Details');
        $tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

        $tcpdf->setFooterData(array(0,65,0), array(0,65,127));
        $tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $tcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $tcpdf->SetMargins(5, 5, 5); //PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
        $tcpdf->SetHeaderMargin(5);

        $tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')){
            require_once(dirname(__FILE__).'/lang/eng.php');
            $tcpdf->setLanguageArray($l);
        }
        $tcpdf->setFontSubsetting(true);
        $tcpdf->SetFont('dejavusans', '', 7, '', true);
        //$tcpdf->setPrintHeader(false);

      
      
        
        $total_qty = 0;
        $total_price = 0;
        $grandTotal = 0;
       
           $tbl_dynamic = '';   
            $tcpdf->AddPage();
        

        $top_tbl_header_original = '';
        $top_tbl_header_original = '<h3  style="text-align:right;">( Original )</h3>';
        $top_tbl_header_original .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $top_tbl_header_original .= '<tr>';
        $top_tbl_header_original .= '<td style="text-align:center;"><h3 ><b>DELIVERY CHALLAN <span style="text-align:right;"></span></b></h3></td>';
        $top_tbl_header_original .= '</tr>';
        $top_tbl_header_original .= '</table>';
        $top_tbl_header_original .= '';


        $top_tbl_header_duplicate = '';
        $top_tbl_header_duplicate = '<h3  style="text-align:right;">( Duplicate )</h3>';
        $top_tbl_header_duplicate .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $top_tbl_header_duplicate .= '<tr>';
        $top_tbl_header_duplicate .= '<td style="text-align:center;"><h3 ><b>DELIVERY CHALLAN <span style="text-align:right;"></span></b></h3></td>';
        $top_tbl_header_duplicate .= '</tr>';
        $top_tbl_header_duplicate .= '</table>';
        $top_tbl_header_duplicate .= '';


        $b_state = $this->sam->get_real_value('zyd_state','id',$challan->b_state,'state');
        $b_city = $this->sam->get_real_value('zyd_city','id',$challan->b_city,'city');
        $billing_address = $challan->b_address.' '.$b_state.' , '.$b_city.' , '.$challan->b_zip_code;

        $s_state = $this->sam->get_real_value('zyd_state','id',$challan->s_state,'state');
        $s_city = $this->sam->get_real_value('zyd_city','id',$challan->s_city,'city');
        $shiping_address = $challan->s_address.' , '.$s_state.' , '.$s_city.' , '.$challan->s_zip_code;


         $table_address = '';
        $table_address .= '<table width="100%"  cellpadding="3">';
        $table_address .= '<tr>';
        $table_address .= '<td width="40%"><b>Customer Name</b></td>';
        $table_address .= '<td  width="60%"><b>'.$customer_name.'</b></td>';
        $table_address .= '</tr>';

        $table_address .= '<tr>';
        $table_address .= '<td><b>Kind Atten</b></td>';
        $table_address .= '<td>'.$contact_person.'</td>';
        $table_address .= '</tr>';
        
        $table_address .= '<tr>';
        $table_address .= '<td><b>Shiping Address</b></td>';
        $table_address .= '<td>'.$shiping_address.'</td>';
        $table_address .= '</tr>';

        // $table_address .= '<tr>';
        // $table_address .= '<td><b>Billing Address</b></td>';
        // $table_address .= '<td>'.$billing_address.'</td>';
        // $table_address .= '</tr>';
        $table_address .= '</table>';
        
        $table_challan_details  = '';
        $table_challan_details .= '<table width="100%"  cellpadding="3">';
         
        $table_challan_details .= '<tr>';
        $table_challan_details .= '<td width="50%"><b>Challan No</b></td>';
        $table_challan_details .= '<td>'.@$challan->challan_no.'</td>';
        $table_challan_details .= '</tr>';

        $table_challan_details .= '<tr>';
        $table_challan_details .= '<td><b>Delivery Date</b></td>';
        $table_challan_details .= '<td>'.$this->maahi->date_format($challan->inserted_time).'</td>';
        $table_challan_details .= '</tr>';

        $table_challan_details .= '<tr>';
        $table_challan_details .= '<td><b>Quatation No</b></td>';
        $table_challan_details .= '<td>'.@$challan->quotation_no.'</td>';
        $table_challan_details .= '</tr>';

        $table_challan_details .= '<tr>';
        $table_challan_details .= '<td><b>Invoice No</b></td>';
        $table_challan_details .= '<td>'.@$challan->invoice_no.'</td>';
        $table_challan_details .= '</tr>';
        
        $table_challan_details .= '<tr>';
        $table_challan_details .= '<td><b>PO No</b></td>';
        $table_challan_details .= '<td>'.@$challan->po_no.'</td>';
        $table_challan_details .= '</tr>';

        $table_challan_details .= '<tr>';
        $table_challan_details .= '<td><b>Challan Status</b></td>';
        $table_challan_details .= '<td>'.@ucfirst(str_replace("_"," ", $challan->status)).'</td>';
        $table_challan_details .= '</tr>';


        $table_challan_details .= '</table>';



        $tbl_header = '';
        $tbl_header .= '<table cellspacing="0" cellpadding="10" width="100%" border="1">';
        $tbl_header .= '<tr>';
        $tbl_header .= '<td width="60%">'.$table_address.'</td>';
        $tbl_header .= '<td width="40%">'.$table_challan_details.'</td>';

        $tbl_header .= '</tr>';
        $tbl_header .= '</table>';
        $tbl_header .= '<br><br>';
       // $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header, 0, 1, 0, true, '', true);
       
          $grand_qty = 0;
          foreach ($this->data['challan_items'] as $key=>$row) 
          {

            $product_name = '';
            $prod_total = 0;   
            
            $prod_total = $row['item_qty'] * $row['item_price'];
            
            if($row['item_type'] == 'service'){
              $item_name = $this->sam->get_real_value('tech_service','id',$row['item_id'],'title');

              $product_hsn = $this->sam->get_real_value('tech_service','id',$item_name,'hsn_code');
              $product_part_no = $this->sam->get_real_value('tech_service','id',$item_name,'code');

              if($product_hsn != ''){
                $product_hsn = '<br>HSN Code : '.$product_hsn;
              }
              if($product_part_no != ''){
                $product_part_no = '<br>Code : '.$product_part_no;
              }
              

            }else{
              
              $prodID = $row['item_id'];
              $item_name = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'product_name');
              $product_hsn = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'hsn_code');
              $product_part_no = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'sku');
              $unit_of_measurement = $this->sam->get_real_value('zyd_products_mst','id',$prodID,'uom_id');
          $unit_of_measurement_name = $this->sam->get_real_value('tech_uom','id',$unit_of_measurement,'title');

              
              
              if($product_part_no != ''){
                $product_part_no = '( Part Code : '.$product_part_no.')';
              }

            }
            $key = $key + 1;
            $tbl_dynamic .= '<tr>';
            $tbl_dynamic .= '<td width="10%">'.$key.'</td>'; 
            $tbl_dynamic .= '<td width="75%"><b>'.$item_name.' '.ucfirst($product_part_no).'</b></td>'; 
            $tbl_dynamic .= '<td width="15%" style="text-align:right">'.$row['item_qty'].' ('.strtolower($unit_of_measurement_name).')</td>';
            $tbl_dynamic .= '</tr>';

            $grand_qty += $row['item_qty'];

            $emp_singl = '';

        }
        
        $tbl = '';  
        $tbl .= '<table cellspacing="0" cellpadding="5" width="100%" border="1" >';
        $tbl .= '<tr>';
        $tbl .= '<td width="10%"><b>No</b></td>'; 
        $tbl .= '<td width="75%"><b>Item name</b></td>';
        $tbl .= '<td width="15%"><b>Quantity</b></td>';
        $tbl .= '</tr>';
        
        $tbl .= $tbl_dynamic;

        for($i=0; $i < 6 ; $i++) { 
          $tbl .= '<tr>';
          $tbl .= '<td width="10%"></td>'; 
          $tbl .= '<td width="75%"></td>';
          $tbl .= '<td width="15%"></td>';
          $tbl .= '</tr>';
        }
        $tbl .= '<tr>';
        $tbl .= '<td colspan="2" style="text-align:right">Total Quantity</td>'; 
        $tbl .= '<td>'.$grand_qty.'</td>';
        $tbl .= '</tr>';
        $tbl .='</table>';

        $emp_singl = '';
        if(!empty($emp_sign))
        {
            $emp_singl =  '<img style="width:80px;margin-left : 50px;"  src="'.site_url().'themes/assets/images/usersign/'.$emp_sign.'" alt="" class="">';
        }

         $tbl  .= '<br><br><table cellspacing="0" cellpadding="5" width="100%" border="1" >';
        $tbl .= '<tr style="text-align:centar">';
        $tbl .= '<td colspan="2"><b>Receive the about mentioned goods<br>in good order & condition <br><br>
          &nbsp;&nbsp;&nbsp;'.$emp_singl.'<br>
          Authorised signatory & Stamp</b></td>';
        $tbl .= '<td colspan="2"><b>For TECH SERVICES<br><br><br><br><br><br>Authorised signatory & Stamp</b></td>';
        $tbl .= '</tr>';
        $tbl .='</table>';


        $tbl_marge = '';  
        $tbl_marge .= '<table cellspacing="0" cellpadding="5" width="100%" >';

        $tbl_marge .= '<tr>';
        $tbl_marge .= '<td><img src="https://i.ibb.co/mGTyvXW/header.jpg"></td>'; 
        $tbl_marge .= '<td><img src="https://i.ibb.co/mGTyvXW/header.jpg"></td>'; 
        $tbl_marge .= '</tr>';
        
        $tbl_marge .= '<tr>';
        $tbl_marge .= '<td>'.$top_tbl_header_original.'</td>'; 
        $tbl_marge .= '<td>'.$top_tbl_header_duplicate.'</td>'; 
        $tbl_marge .= '</tr>';

        $tbl_marge .= '<tr>';
        $tbl_marge .= '<td>'.$tbl_header.'</td>'; 
        $tbl_marge .= '<td>'.$tbl_header.'</td>'; 
        $tbl_marge .= '</tr>';
        $tbl_marge .= '<tr>';
        $tbl_marge .= '<td>'.$tbl.'</td>'; 
        $tbl_marge .= '<td>'.$tbl.'</td>'; 
        $tbl_marge .= '</tr>';

        $tbl_marge .= '<tr>';
        $tbl_marge .= '<td><img src="https://i.ibb.co/x6H5hwQ/footer.png"></td>'; 
        $tbl_marge .= '<td><img src="https://i.ibb.co/x6H5hwQ/footer.png"></td>'; 
        $tbl_marge .= '</tr>';

     
        $tbl_marge .='</table>';

        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_marge, 0, 1, 0, true, '', true);

       
        //$tcpdf->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);

        $tcpdf->Output('challan_details.pdf', 'I');


        
    }



    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'tech_challan');
    }

    

    
}