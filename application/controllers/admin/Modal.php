<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

    private function _delete_by_id($id,$_table) {
        $d = ORM::for_table($_table)->where('id',$id)->find_one();
        if($d) {
            // change is_deleted to 1
            $d->is_deleted = '1';
            $d->save();
            echo TRUE;
        } else {
            echo FALSE;
        }
    }

    public function customer_add() {
        $d = ORM::for_table('sam_customers')->create();

        $d->name                    = isset($_POST['name']) ? $_POST['name'] : '';
        $d->dealer_id               = isset($_POST['dealer_id']) ? $_POST['dealer_id'] : '';
        $d->address                 = isset($_POST['address']) ? $_POST['address'] : '';
        $d->pin_code                = isset($_POST['pin_code']) ? $_POST['pin_code'] : '';
        $d->sap_code                = isset($_POST['sap_code']) ? $_POST['sap_code'] : '';
        $d->turnover                = isset($_POST['turnover']) ? $_POST['turnover'] : '';
        $d->gst_no                  = isset($_POST['gst_no']) ? $_POST['gst_no'] : '';
        $d->customer_type           = isset($_POST['customer_type']) ? implode(",", $_POST['customer_type']) : '';
        $d->machine_type            = isset($_POST['machine_type']) ? $_POST['machine_type'] : '';
        $d->machine_name            = isset($_POST['machine_name']) ? $_POST['machine_name'] : '';
        $d->fabric_type             = isset($_POST['fabric_type']) ? $_POST['fabric_type'] : '';        
        $d->capacity                = isset($_POST['capacity']) ? $_POST['capacity'] : '';
        $d->unit                    = isset($_POST['unit']) ? $_POST['unit'] : '';
        $d->zydex_rank_id           = isset($_POST['zydex_rank_id']) ? $_POST['zydex_rank_id'] : '';
        $d->brands_buyers           = isset($_POST['brands_buyers']) ? $_POST['brands_buyers'] : '';        
        $d->no_of_machines          = isset($_POST['no_of_machines']) ? $_POST['no_of_machines'] : '';
        $d->quotation_email     = isset($post['quotation_email']) ? $post['quotation_email'] : '';
        $d->invoice_email       = isset($post['invoice_email']) ? $post['invoice_email'] : '';      
        
        if(!empty($_POST['contact_persons']))
        {
                for($jj=0; $jj < count($_POST['contact_persons']); $jj++) 
                { 
                    if($_POST['title_id'][$jj] !== '')
                    {
                        $data1['contact_persons']  = @$_POST['contact_persons'][$jj];
                        $data1['title_id']          = @$_POST['title_id'][$jj];
                        $data1['education_id']   = @$_POST['education_id'][$jj];
                        $data1['owner_dob']       = @$_POST['owner_dob'][$jj];
                        $data1['mobile']       = @$_POST['mobile'][$jj];
                        $data1['email']       = @$_POST['email'][$jj];
                        $data_array1[] = $data1;                    
                    }
                }
                $d->contact                = @json_encode($data_array1);
        }
         
        if(!empty($_POST['brand']))
        {
                for($ii=0; $ii < count($_POST['brand']); $ii++)
                { 
                    if($_POST['brand'][$ii] !== '')
                    {
                        
                        
                        $data2['competition_customer_type']  = implode(',',@$_POST['competition_customer_type'][$ii]);
                        $data2['brand']          = @$_POST['brand'][$ii];
                        $data2['product_name']   = @$_POST['product_name'][$ii];
                        $data2['supplier']       = @$_POST['supplier'][$ii];
                        $data_array2[] = $data2;                    
                    }
                }
                $d->competitor                = @json_encode($data_array2);
        }
            
        
        
        
        $d->status                  = isset($_POST['status']) ? $_POST['status'] : 'active';
        $d->created_by_user_id     = $this->session->userdata('loginid');
        $d->inserted_time           = date('Y-m-d H:i:s');
        $d->save();


        
        echo $d->id;
    }

    public function customer_delete($id) {
        $this->_delete_by_id($id,'sam_customers');
    }


    /* ----------------------------------------------------------
    * ----------------Customer Modal End-------------------------*
    * ----------------------------------------------------------*/

 
    
    public function send_mail() { 
        
        $email = $_POST['email'];
        $Setting = ORM::for_table('sam_settings')->where('id','1')->find_one();
        $RegistrationTemplete = ORM::for_table('zyd_email_template')->where('id','1')->find_one();
        $Massage =  $RegistrationTemplete['email_body'];

        $Massage = str_replace ('[USER_NAME]',$_POST['fname'],$Massage);
        $Massage = str_replace ('[USER_EMAIL]',$_POST['email'],$Massage);
        $Massage = str_replace ('[USER_PASSWORD]',$_POST['pwd'],$Massage);
        $Massage = str_replace ('[SITE_NAME]',$Setting['sitename'],$Massage);
        
        $email_config = ORM::for_table('sam_settings')->where('id',1)->find_one();

        $config = array(
                'protocol'  => $email_config['smtp_name'],
                'smtp_host' => $email_config['smtp_host'],
                'smtp_port' => $email_config['smtp_port'],
                'smtp_user' => $email_config['smtp_username'],
                'smtp_pass' => $email_config['smtp_password'],
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );
    
          $this->load->library('email',$config);

          $this->email->from('no_reply@maahiit.in', 'Registration Mail');
          $this->email->to($email);
          $this->email->subject($RegistrationTemplete['subject']);
          $this->email->message($Massage);
          
          if($email_config['smtp_status'] == 'on')
          {
            $this->email->send();    
          }
      }
      

    public function user_delete($id) {
        $this->_delete_by_id($id,'sam_users');
    }


    /* ----------------------------------------------------------
    *------Start :  Sub Category From Category ( Multiple )------*
    * ----------------------------------------------------------*/

    public function ajax_get_subcategory_from_category() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $subcategory = [];
        if($_POST['categoty_ids'] != '')
        {    

            $w .= " AND categoty_ids in('" . implode("','",$_POST['categoty_ids']) . "')";  
            $query = "SELECT * FROM tech_product_sub_category WHERE $w ORDER BY id ASC";
            $subcategory  = ORM::for_table('tech_product_sub_category')->raw_query($query)->find_array();   
        }
        echo json_encode($subcategory);
    }

    /* ----------------------------------------------------------
    * -----End :  Sub Category From Category ---( Multiple )----*
    * ----------------------------------------------------------*/

    /* ----------------------------------------------------------
    *------Start :  Sub Category From Category ( Single )------*
    * ----------------------------------------------------------*/

    public function ajax_get_single_subcategory_from_category() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $subcategory = [];
        if($_POST['categoty_ids'] != '')
        {    
            $w .= " AND FIND_IN_SET('".$_POST['categoty_ids']."', categoty_ids)";
            $query = "SELECT * FROM tech_product_sub_category WHERE $w ORDER BY id ASC";
            $subcategory  = ORM::for_table('tech_product_sub_category')->raw_query($query)->find_array();   
        }
        echo json_encode($subcategory);
    }

    /* ----------------------------------------------------------
    * -----End :  Sub Category From Category ---( Single )----*
    * ----------------------------------------------------------*/

    public function get_attribute_row()
    {
            $existProdAttri = ORM::for_table('tech_product_attributes')
                ->where('categoty_ids',$_POST['category_ids'])
                ->where('subcategory_ids',$_POST['subcategory_ids'])
                ->where('status','active')
                ->where('is_deleted',0)
                ->find_one();
            if($existProdAttri)
            {
                $this->data['prod_attributes'] = ORM::for_table('tech_product_attributes_value')
                                                ->where('attribute_id',$existProdAttri->id)
                                                ->where('status','active')
                                                ->where('is_deleted',0)
                                                ->find_array();

                $html = $this->load->view('/admin/views/products/prod_attribute_row',$this->data,true);
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

    public function get_city_from_state() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $city = [];
        if($_POST['state_id'] != ''){          
            $w .= "AND state_id = '".$_POST['state_id']."'";
            $query = "SELECT * FROM zyd_city WHERE $w ORDER BY city ASC";
            $city  = ORM::for_table('zyd_city')->raw_query($query)->find_array();   
        }
        echo json_encode($city);
    }

   /* ----------------------------------------------------------
    *------Start :  Custoer Contact Single ------*
    * ----------------------------------------------------------*/

    public function ajax_get_contacts() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $contact = [];
        if($_POST['customer_id'] != ''){          
            $w .= " AND customer_id ='".$_POST['customer_id']."'";
            
            $query = "SELECT * FROM sam_customers_contact WHERE $w ORDER BY contact_persons ASC";
            $contact  = ORM::for_table('sam_customers_contact')->raw_query($query)->find_array();   

            $add_query = "SELECT * FROM sam_customers_address WHERE $w ORDER BY cust_address_name ASC";
            $address  = ORM::for_table('sam_customers_address')->raw_query($add_query)->find_array();   

            $amc_query = "SELECT id,start_date,end_date FROM tech_amc WHERE $w ORDER BY id ASC";
           
            $amcs  = ORM::for_table('tech_amc')->raw_query($amc_query)->find_array();   
        }
        $output['contact'] = $contact;
        $output['address'] = $address;
        $output['amcs'] = $amcs;
        echo json_encode($output);
    }
    
    /* ----------------------------------------------------------
    *------Start :  Custoer Contact Single ------*
    * ----------------------------------------------------------*/ 

    /* ----------------------------------------------------------
    *------Start :  Custoer Contact Single ------*
    * ----------------------------------------------------------*/

    public function get_description() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $description = '';
        if($_POST['item_id'] != ''){          
            $w .= " AND id ='".$_POST['item_id']."'";
            if($_POST['item_type'] == 'service') {
                $query = "SELECT * FROM tech_service WHERE $w";
                $contact  = ORM::for_table('tech_service')->raw_query($query)->find_one();       
            }else{
                $query = "SELECT * FROM zyd_products_mst WHERE $w";
                $contact  = ORM::for_table('zyd_products_mst')->raw_query($query)->find_one();       
            }
            $description = $contact->description;

        }
        $output['description'] = $description;
        echo json_encode($output);
    }

    
    /* ----------------------------------------------------------
    *------Start :  Custoer Contact Single ------*
    * ----------------------------------------------------------*/    

     public function get_term_condition() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $description = '';
        if($_POST['item_id'] != ''){          
            $w .= " AND id ='".$_POST['item_id']."'";
            $query = "SELECT * FROM tech_term_condition WHERE $w";
            $contact  = ORM::for_table('tech_term_condition')->raw_query($query)->find_one();  
            $description = $contact->description;

        }
        $output['description'] = $description;
        echo json_encode($output);
    }

    public function get_report_desciption() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $description = '';
        if($_POST['item_id'] != ''){          
            $w .= " AND id ='".$_POST['item_id']."'";
            $query = "SELECT * FROM tech_problem_report WHERE $w";
            $contact  = ORM::for_table('tech_problem_report')->raw_query($query)->find_one();  
            $description = $contact->description;

        }
        $output['description'] = $description;
        echo json_encode($output);
    }

    

   /* ----------------------------------------------------------
    *------Start :  Customer List by type ------*
    * ----------------------------------------------------------*/    

     public function get_customer_by_type() 
    {
        $w = "is_deleted = '0' AND status = 'active' AND customer_type = 'customer' ";
        $contact = [];
        if($_POST['type'] != ''){          
            $w .= " AND customer_category_id ='".$_POST['type']."'";
            
            $query = "SELECT * FROM sam_customers WHERE $w ORDER BY name ASC";
            $contact  = ORM::for_table('sam_customers')->raw_query($query)->find_array();   
        }
        $output['customers'] = $contact;
        echo json_encode($output);
    }
    /* ----------------------------------------------------------
    *------Start :  Customer List by type ------*
    * ----------------------------------------------------------*/    

    /* ----------------------------------------------------------
    *------Start :  Get Component ------*
    * ----------------------------------------------------------*/    

     public function get_component() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $records = [];
        $query = "SELECT * FROM tech_component WHERE $w ORDER BY title ASC";
        $records  = ORM::for_table('tech_component')->raw_query($query)->find_array();   
        echo json_encode($records);
    }
    /* ----------------------------------------------------------
    *------ End :  Get Component ------*
    * ----------------------------------------------------------*/    

    
    

    

  

    
   
        
    

}