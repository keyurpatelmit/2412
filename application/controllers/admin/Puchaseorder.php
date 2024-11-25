<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puchaseorder extends MY_Controller {

    function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            admin_redirect('login');
        }
        $this->load->library('form_validation');
        $this->load->model('Mdl_puchaseorder','mdl');
        $this->load->library('pagination');
    }


    public function unset_session_value() {
        $this->session->unset_userdata('invoice_s_status');
        $this->session->unset_userdata('invoice_serach_data');
        redirect('admin/purchase_order');
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
            if(isset($_POST['invoice_s_status']) AND $_POST['invoice_s_status'] != ''){
                $w .= " AND status ='".$_POST['invoice_s_status']."'";
                $this->session->set_userdata('invoice_s_status',$_POST['invoice_s_status']);
            }

            if(isset($_POST['inquiry_s_invoice_no']) AND $_POST['inquiry_s_invoice_no'] != ''){
                $w .= " AND invoice_no ='".$_POST['inquiry_s_invoice_no']."'";
                $this->session->set_userdata('inquiry_s_invoice_no',$_POST['inquiry_s_invoice_no']);
            }

            if($_POST['invoice_s_start_date'] != '' AND $_POST['invoice_s_end_date'] == '') {
                $w .= "AND DATE(quotation_date) = '".$_POST['invoice_s_start_date']."'";
                $this->session->set_userdata('invoice_s_start_date',$_POST['invoice_s_start_date']);
            }
            
            if($_POST['invoice_s_start_date'] != '' AND $_POST['invoice_s_end_date'] != ''){
                $w .= "AND DATE(quotation_date) BETWEEN  '".$_POST['quotation_s_start_date']."' AND  '".$_POST['invoice_s_end_date']."'";
                $this->session->set_userdata('invoice_s_start_date',$_POST['invoice_s_start_date']);
                $this->session->set_userdata('invoice_s_end_date',$_POST['invoice_s_end_date']);
            }
            
            $_SESSION['invoice_serach_data'] = $w;
            $this->session->set_userdata('invoice_serach_data',$w);
        }

        if(isset($this->session->invoice_serach_data) AND $this->session->invoice_serach_data != ''){
             $w = $this->session->userdata('invoice_serach_data');
        }
        
        $Record = $this->mdl->get_record_count($w);

        $config = $this->sam->pagination_config();
        $config['base_url'] = site_url().'admin/puchaseorder/index';
        $config['total_rows'] = $Record;
        $config['per_page'] = $paginationdata;
        $this->pagination->initialize($config);
        $this->data['rows'] = $this->mdl->get_all_with_pagi('id',$config['per_page'],$this->uri->segment(4),$w);

        $meta['page_title'] = 'Puchase Order';
        
        $this->page_construct('purchase_order/view', $meta, $this->data);
    }


     public function add_po() 
    {
        $meta['page_title'] = 'Add Purchase order ';
        $this->data['employees'] = $this->maahi->get_employees();
        $this->data['customers'] = $this->maahi->get_customer_list();
        $this->data['inquiry_sources']    =  $this->maahi->get_active_data('tech_inquiry_source');
        $this->data['designations']       =  $this->maahi->get_active_data('zyd_designation');
        $this->data['states']             =  $this->maahi->get_states();
        $this->data['cities']             =  $this->maahi->get_cities();
        $this->data['services']           =  $this->maahi->get_services();
        $this->data['products']           =  $this->maahi->get_products();
        $this->data['terms_condition']    =  $this->maahi->get_active_data('tech_term_condition');
        $this->data['auto_quotation_no']  =  $this->maahi->get_autogenrate_no('tech_purchase_order');
         $this->data['vendors']          =  $this->maahi->get_vendor_list();
        $this->page_construct('purchase_order/add_po', $meta, $this->data);
    }

   
    public function add_row() 
    {
            $d = ORM::for_table('tech_purchase_order')->create();
            
            $d->purchase_no         = @$_POST['purchase_no'];
            $d->quotation_no        = @$_POST['quotation_no'];
            $d->quotation_id        = @$_POST['quotation_id'];
            $d->assign_user_id      = $_POST['assign_user_id'];
            $d->quotation_date      = $this->maahi->add_date_format($_POST['quotation_date']);
            $d->inquiry_source_id   = $_POST['inquiry_source_id'];
            $d->customer_id         = $_POST['customer_id']; 
            $d->total_amount        = $_POST['total_amount'];
            $d->total_margin        = $_POST['total_margin'];
            
            $d->b_address_name      = $_POST['b_address_name'];
            $d->b_address           = $_POST['b_address'];
            $d->b_state             = $_POST['b_state'];
            $d->b_city              = $_POST['b_city'];
            $d->b_zip_code          = $_POST['b_zip_code'];

            $d->s_address_name      = $_POST['s_address_name'];
            $d->s_address           = $_POST['s_address'];
            $d->s_state                     = $_POST['s_state'];
            $d->s_city                      = $_POST['s_city'];
            $d->s_zip_code                  = $_POST['s_zip_code'];
            $d->term_condition_id           = $this->maahi->implode_field($_POST['term_condition_id']);

            $d->customer_contact_id         = $_POST['customer_contact_id'];
            $d->contact_designation_id      = $_POST['contact_designation_id'];
            $d->contact_email               = $_POST['contact_email'];
            $d->contact_mobile              = $_POST['contact_mobile'];
            
            $d->inserted_time   = date('Y-m-d H:i:s');
            $d->create_by_id         = $this->session->userdata('loginid');
            $d->save();


            if(!empty($_POST['term_condition_id'])){
                  for($terms=0; $terms < count($_POST['term_condition_id']); $terms++) { 
                      if($_POST['term_condition_id'][$terms] !== ''){
                          $terms_data = ORM::for_table('tech_purchase_order_term_condition')->create();
                          $terms_data->purchase_order_id   = $d->id;
                          $terms_data->term_id             = @$_POST['term_condition_id'][$terms];
                          $terms_data->item_description    = @$_POST['term_condition_txt'][$terms];
                        $terms_data->save();
                      }
                  }
              } 
             $vendor_id_arrr = [];
            if(!empty($_POST['item_type'])){
                  for($i=0; $i < count($_POST['item_type']); $i++) { 
                      if($_POST['item_type'][$i] !== ''){
                          $items = ORM::for_table('tech_purchase_order_item')->create();
                          if($_POST['item_type'][$i] == 'service'){
                            $items->item_id        = @$_POST['item_service'][$i];
                          }else{
                            $items->item_id        = @$_POST['item_product'][$i];
                          }
                          $items->purchase_order_id          = $d->id;
                          $items->item_type           = @$_POST['item_type'][$i];
                          $items->vendor_id           = @$_POST['vendor_id'][$i];
                          $items->item_qty            = @$_POST['item_qty'][$i];
                          $items->item_price          = @$_POST['item_price'][$i];
                          $items->purchase_item_price = @$_POST['purchase_item_price'][$i];
                          $items->margin_item_price   = @$_POST['margin_item_price'][$i];
                          $items->item_description    = @$_POST['item_description'][$i];
                          $items->item_gst            = @$_POST['item_gst'][$i];
                          $items->save();
                          $vendor_id_arrr[]           = @$_POST['vendor_id'][$i];
                      }
                  }
              }

              $vendor_ids = array_filter(array_unique($vendor_id_arrr));
              $update = ORM::for_table('tech_purchase_order')->where('id',$d->id)->find_one();
              $update->vendor_ids = implode(',',$vendor_ids);
              $update->save();

              $login_name = $this->session->userdata('loginname');
              $type = 'Invoice';
              $item_id = $d->id;
              $assign_user_id = $_POST['assign_user_id'];
              $notification = 'New Purchase order create by '.$login_name;
              $this->sam->notification($type,$item_id,$assign_user_id,$notification); 

    }

     public function edit($id) {
        
        $meta['page_title'] = 'Edit Puchase order';
        if($_POST && $_POST['id'] != '') {

            //echo "<pre>";
            //print_r($_POST);
            //die();
            if($this->mdl->update_row($_POST)) 
            {
                $this->session->set_flashdata('success','Successfully Update ');
                redirect('admin/puchaseorder');

            } else {
                $this->session->set_flashdata('error',lang('cupdatef'));
                redirect('admin/puchaseorder');
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
            $this->data['inquiry_items']    =  $this->maahi->get_purchaseorder_item($id);
            $this->data['quotation_terms']  =  $this->maahi->get_purchase_order_terms($id);
            $this->data['terms_condition']  =  $this->maahi->get_active_data('tech_term_condition');
            $this->data['vendors']          =  $this->maahi->get_vendor_list();
            
            $this->page_construct('purchase_order/edit',$meta, $this->data);
        }
    }



    public function row_delete($id) {
        $this->maahi->_delete_by_id($id,'tech_purchase_order');
    }
    public function remove_items($id) {
        $this->maahi->_delete_by_id($id,'tech_purchase_order_item');
    }
    public function remove_puchase_order_terms($id) {
        $this->maahi->_delete_by_id($id,'tech_purchase_order_term_condition');
    }

    public function po_pdf($po_id,$selected_vendorid='')
    {
       $Settings = ORM::for_table('sam_settings')->where('id',1)->find_one();  
       $po_detail = ORM::for_table('tech_purchase_order')->where('id',$po_id)->find_one();  
       $terms = ORM::for_table('tech_purchase_order_term_condition')->where('purchase_order_id',$po_id)->find_array();  
       $this->data['quotation_items'] =  $this->maahi->get_purchaseorder_item($po_id);
       
       $this->load->library('Pdf');
  
       $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
       
       $term_condition_txt = '';

       if(!empty($terms)){
          foreach ($terms as $key => $term) {
            $term_condition_txt .= $term['item_description'];
          }
       }

       $cust_id = $po_detail->customer_id;
       $customer_name = $this->sam->get_real_value('sam_customers','id',$cust_id,'name');
       $customer_address = $this->sam->get_real_value('sam_customers','id',$cust_id,'address');
       $customer_mobile = $this->sam->get_real_value('sam_customers','id',$cust_id,'mobile');
       $customer_email = $this->sam->get_real_value('sam_customers','id',$cust_id,'email');

       $emp_sign = $this->sam->get_real_value('sam_users','id',$po_detail->assign_user_id,'sign');

        // set document information
        $tcpdf->SetCreator(PDF_CREATOR);
        //$tcpdf->SetAuthor('Muhammad Saqlain Arif 1');
        
        $tcpdf->SetTitle('Purchase Order Details');
        $tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

        $tcpdf->setFooterData(array(0,65,0), array(0,65,127));
        $tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $tcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $tcpdf->SetMargins(5, 40, 5); //PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT
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
        //$tcpdf->setPrintHeader(true);
        $tcpdf->AddPage();
      
       

        $top_tbl_header = '';
        $top_tbl_header .= '<table cellspacing="0" cellpadding="5" width="100%" border="1">';
        $top_tbl_header .= '<tr>';
        $top_tbl_header .= '<td style="text-align:centar;"><h3><b>PURCHASE ORDER</b></h3></td>';
        $top_tbl_header .= '</tr>';
        $top_tbl_header .= '</table>';
        $top_tbl_header .= '';
        $tcpdf->writeHTMLCell(0, 0, '', '', $top_tbl_header, 0, 1, 0, true, '', true);

        foreach (explode(',',$po_detail->vendor_ids) as $vendorid) {

          if(!empty($selected_vendorid)){
              if($vendorid != $selected_vendorid) { continue; }            
          }

        $vendor_name = $this->sam->get_real_value('sam_customers','id',$vendorid,'name');
        $vendor_payment_terms = $this->sam->get_real_value('sam_customers','id',$vendorid,'payment_terms');
        $vendor_address = $this->sam->get_real_value('sam_customers','id',$vendorid,'address');
        $vendor_mobile = $this->sam->get_real_value('sam_customers','id',$vendorid,'mobile');
        $vendor_email = $this->sam->get_real_value('sam_customers','id',$vendorid,'email');
        $vendor_gst = $this->sam->get_real_value('sam_customers','id',$vendorid,'gst_no');


         
        $tbl_dynamic = '';    
        $vendor_detail = '';
        $total_qty = 0;
        $total_price = 0;
        $grandTotal = 0;

         $vendor_detail =  '<b>'.$vendor_name.'</b><br>'.$vendor_address.'<br>Ph. No. '.$vendor_mobile.'<br>GSTIN/UIN:'.$vendor_gst.'<br>E-Mail. '.$vendor_email.'<br>';
                  

        $invoice_to = '
                  <b>TECH SERVICES </b><br>
                  G-8,Hira Baug Complex, <br>
                  Sussen Tarsali Road, <br>
                  Vadodara-390009 <br>
                  Ph. No. 0265-2641753,2636108,3042776 <br>
                  GSTIN/UIN: 24AALPD8312R1ZD <br>
                  State Name : Gujarat, Code : 24 <br>
                  E-Mail : accounts@techservices.net.in <br>';
                  
                  
                  
       $table_address = '';
        $table_address .= '<table width="100%" cellpadding="3">';
        $table_address .= '<tr>';
        $table_address .= '<td width="60%"><b>PO Number</b></td>';
        $table_address .= '<td><b> : '.$po_detail->purchase_no.'</b></td>';
        $table_address .= '</tr>';

        $table_address .= '<tr>';
        $table_address .= '<td><b>Date</b></td>';
        $table_address .= '<td> : '.$this->maahi->date_format($po_detail->inserted_time).'</td>';
        $table_address .= '</tr>';
      
        $table_address .= '<tr>';
        $table_address .= '<td><b>Reference No. & Date</b></td>';
        $table_address .= '<td>: '.$po_detail->purchase_no.'</td>';
        $table_address .= '</tr>';
        
        $table_address .= '<tr>';
        $table_address .= '<td><b>Mode/Terms of Payment</b></td>';
        $table_address .= '<td> : '.$vendor_payment_terms.'</td>';
        $table_address .= '</tr>';
        
        $table_address .= '<tr>';
        $table_address .= '<td><b>Dispatched through</b></td>';
        $table_address .= '<td></td>';
        $table_address .= '</tr>';
        $table_address .= '</table>';


        $tbl_header = '';
        $tbl_header .= '<table cellspacing="0" cellpadding="10" width="100%" border="1">';
        $tbl_header .= '<tr>';
        $tbl_header .= '<td ><b>Invoice To<br></b> '.$invoice_to.'</td>';
        $tbl_header .= '<td ><b>Supplier Bill<br></b> '.$vendor_detail.'</td>';
        $tbl_header .= '<td >'.$table_address.'</td>';
        $tbl_header .= '</tr>';
        $tbl_header .= '</table>';
        $tbl_header .= '</br></br>';
        $tcpdf->writeHTMLCell(0, 0, '', '', $tbl_header, 0, 1, 0, true, '', true);
          
      
        $grand_total = 0;
        $gst_grand_total   = 0;
        $grand_total_with_gst  = 0;
        foreach ($this->data['quotation_items'] as $key=>$row) 
        { 
          
          if($row['vendor_id'] != $vendorid) { continue; }

            $product_name = '';
            $prod_total = 0;   
            
            $prod_total = $row['item_qty'] * $row['purchase_item_price'];
            
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
            $total_amt         = 0;
            $gst_cal_amt       = 0;
            $gst               = 0;
            $item_grand_total  = 0;


            $total_amt         = $row['item_qty'] * $row['purchase_item_price'];
            $gst_cal_amt       = $total_amt * $row['item_gst'];
            $gst               = $gst_cal_amt / 100;
            $item_grand_total  =  $total_amt + $gst;

            $grand_total      += $total_amt;
            $gst_grand_total  += $gst;
            $grand_total_with_gst += $item_grand_total;

            $key = $key + 1;
            $tbl_dynamic .= '<tr>';
            $tbl_dynamic .= '<td width="5%">'.$key.'</td>'; 
            /*$tbl_dynamic .= '<td width="10%">'.ucfirst($row['item_type']).'</td>'; */
            $tbl_dynamic .= '<td width="45%"><b style="font-size:12px">'.$item_name.'</b><br> HSN Code : '.$product_hsn.'<br> '.$product_part_no.'<p><span style="font-size:10px">'.ucfirst($row['item_description']).'</span></p></td>';
            $tbl_dynamic .= '<td width="10%" tyle="text-align:right">'.$row['item_qty'].' ('.strtolower($unit_of_measurement_name).')</td>';
            $tbl_dynamic .= '<td width="10%" tyle="text-align:right">'.number_format($row['purchase_item_price']).' /-</td>';
            $tbl_dynamic .= '<td width="10%" tyle="text-align:right">'.number_format($gst).' /-</td>';
            $tbl_dynamic .= '<td width="10%" tyle="text-align:right">'.number_format($total_amt).' /-</td>';
            $tbl_dynamic .= '<td width="10%" tyle="text-align:right">'.number_format($item_grand_total).' /-</td>';
            $tbl_dynamic .= '</tr>';
        }
           
            
            $tbl = '';  
            $tbl .= '<table cellspacing="0" cellpadding="5" width="100%" border="1" >';
            $tbl .= '<tr style="text-align:center">';
            $tbl .= '<td width="5%"><b>No</b></td>'; 
            $tbl .= '<td width="45%"><b>Item name</b></td>';
            $tbl .= '<td width="10%"><b>Quantity</b></td>';
            $tbl .= '<td width="10%"><b>Rate</b></td>';
            $tbl .= '<td width="10%"><b>GST</b></td>';
            $tbl .= '<td width="10%"><b>Without GST</b></td>';
            $tbl .= '<td width="10%"><b>Grand Amount</b></td>';
            $tbl .= '</tr>';
            
            $tbl .= $tbl_dynamic;

            $tbl .= '<tr>';
            $tbl .= '<td colspan="4" rowspan="6"></td>';
            $tbl .= '<td colspan="5"></td>';
            $tbl .= '</tr>';
            $tbl .= '<tr>';
            $tbl .= '<td colspan="2"><b>Grand total</b></td>';
            $tbl .= '<td colspan="3">'.number_format($grand_total).' /-</td>';
            $tbl .= '</tr>';
            $tbl .= '<tr>';
            $tbl .= '<td colspan="2"><b>Tax Amount</b></td>';
            $tbl .= '<td colspan="3">'.number_format($gst_grand_total).' /-</td>';
            $tbl .= '</tr>';
            $tbl .= '<tr>';
            $tbl .= '<td colspan="2"><b>Total Amount(INR)</b></td>';
            $tbl .= '<td colspan="3">'.number_format($grand_total_with_gst).' /-</td>';
            $tbl .= '</tr>';
            $tbl .='</table>';
            $tcpdf->writeHTMLCell(0, 0, '', '', $tbl, 0, 1, 0, true, '', true);
            
             $term = '';
            $term .='<table width="100%" border="1" >';
            $term .='<tr><td><h3>Terms & Condition</h3><br>'.$term_condition_txt.'</td></tr>';
            $term .='</table>';
            $tcpdf->writeHTMLCell(0, 0, '', '', $term, 0, 1, 0, true, '', true);
            
            
            $tcpdf->AddPage();
          }
          
  

        $tcpdf->Output('quotation_details.pdf', 'I');
        
    }


    function get_vendor()
    {
        $this->data['row'] = ORM::for_table('tech_purchase_order')->where('id',$_POST['id'])->find_one();
        // echo "<pre>";print_r($this->data['row']);die();
        $html = $this->load->view('/admin/views/purchase_order/vendor',$this->data,true);  

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