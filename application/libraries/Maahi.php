<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
 *  ==============================================================================
 *  Author    : SalmanKhan
 *  Email     : mailuser0011@gmail.com
 *  For       : Rent Serv
 *  Web       : 
 *  Copyright : SalmanKhan
 *  ==============================================================================
 */

class Maahi {

    public function __construct() {
    }


    public function __get($var) {
        return get_instance()->$var;
    }

    public function _delete_by_id($id,$_table) {
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
    
    public function get_zones() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        if($this->session->userdata('identity') != 'admin')
        {          
            $login_id = $this->session->userdata('loginid');
            $state_id = $this->sam->get_real_value('sam_users','id',$login_id,'state_id');
            $w .= " AND id  = '".$state_id. "'";  
        }
        $query = "SELECT * FROM zyd_zone WHERE $w ORDER BY zone ASC";
        $d  = ORM::for_table('zyd_zone')->raw_query($query)->find_array();
        if($d) { return $d; } else { return FALSE; }
    }

    public function get_states() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        /*if($this->session->userdata('identity') != 'admin'){          
            $login_id = $this->session->userdata('loginid');
            $state_id = $this->sam->get_real_value('sam_users','id',$login_id,'state_id');
            $w .= " AND id  = '".$state_id. "'";  
        }*/
        $query = "SELECT * FROM zyd_state WHERE $w ORDER BY state ASC";
        $d  = ORM::for_table('zyd_state')->raw_query($query)->find_array();
        if($d) { return $d; } else { return FALSE; }
    }

     public function get_cities() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        if($this->session->userdata('identity') != 'admin')
        {          
            $login_id = $this->session->userdata('loginid');
            $state_id = $this->sam->get_real_value('sam_users','id',$login_id,'state_id');
            $w .= " AND state_id  = '".$state_id. "'";  
        }
        $query = "SELECT * FROM zyd_city WHERE $w ORDER BY city ASC";
        $d  = ORM::for_table('zyd_city')->raw_query($query)->find_array();
        if($d) { return $d; } else { return FALSE; }
    }
    
    public function get_active_data($tablename) 
    {
        $d = ORM::for_table($tablename)->where('status','active')->where('is_deleted','0')->find_array();
        if($d) { return $d; } else { return FALSE; }
    }
    
    public function get_real_value($tablename,$columname,$columvalue,$columreturn)
    {
      $query = "SELECT `$columreturn` FROM `$tablename` WHERE `$columname` = '".$columvalue."'";
      $record = ORM::for_table($tablename)->raw_query($query)->find_one();
      if($record)
      {
          $d = $record->$columreturn;
          return $d;
      }else{
           return '';
      }
    }
    public function get_all_users($tablename) {
		$d = ORM::for_table($tablename)->where('status','active')
                                        ->where('is_deleted','0')
                                        //->where_not_equal('type','admin')
                                        ->find_many();
		if($d) {
			return $d;
		} else {
			return '';
		}
    }
    
    
    public function get_all_users_depot() {
		$d = ORM::for_table('sam_users')->where('status','active')->where('is_deleted','0')->where('type','depot')->find_many();
		if($d) {
			return $d;
		} else {
			return '0';
		}
	}

    public function get_typewise_user($tablename,$type) {
        $d = ORM::for_table($tablename)
                ->select('id')
                ->select('name')
                ->where('type',$type)
                ->where('status','active')
                ->where('is_deleted','0')
                ->find_many();

        if($d) { return $d; } else { return FALSE; }
    }
    public function add_date_format($date)
    {
        if($date != '1970-01-01' && $date != '0000-00-00' && $date != '')
        {
            $converted_date = date('Y-m-d', strtotime($date));
        }else{
            $converted_date = '';
        }
        return $converted_date;
    }
    public function date_format($date)
    {
        if($date != '1970-01-01' && $date != '0000-00-00' && $date != ''  && $date != '0000-00-00 00:00:00'  )
        {
            $converted_date = date('d-m-Y', strtotime($date));
        }else{
            $converted_date = '';
        }
        return $converted_date;
    }
    public function implode_field($field)
    {
        if($field != '' )
        {
            $field_implode = implode(',',$field);
        }else{
            $field_implode = '';
        }
        return $field_implode;
    }

    public function explode_field($fields,$tablename,$columnname)
    {
        $string_field = '';
        if(!empty($fields))
        {
            foreach(explode(',',$fields) as $id)
            {
               $string_field .= ucfirst($this->sam->get_real_value($tablename,'id',$id,$columnname)).' | ';  
            }
            $string_field = substr($string_field,0,-2);
        }
        return $string_field;
    }
   /* ----------------------------------------------------------
    * --------------Start : Zone List by user id---------------*
    * ----------------------------------------------------------*/
    public function get_zone_from_user($user_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $zones = [];
        if($user_id != '')
        {          
             $zone_id = $this->sam->get_real_value('sam_users','id',$user_id,'zone_id');
             if($zone_id != '')
             {
                $zone_id_arr = explode(',',$zone_id);
                $w .= "AND id in (". implode(",", $zone_id_arr).")";
                $query = "SELECT * FROM zyd_zone WHERE $w ORDER BY zone ASC";
                $zones  = ORM::for_table('zyd_zone')->raw_query($query)->find_array();   
             }
        }
        if($zones) { return $zones; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------Start : Zone List by user id---------------*
    * ----------------------------------------------------------*/

   /* ----------------------------------------------------------
    * --------------Start : State List by Zone id---------------*
    * ----------------------------------------------------------*/

    public function get_state_from_zone($zone_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $states = [];
        if($zone_id != '')
        {          
            $w .= "AND zone_id = '".$zone_id."'";
            $query = "SELECT * FROM zyd_state WHERE $w ORDER BY state ASC";
            $states  = ORM::for_table('zyd_state')->raw_query($query)->find_array();   
        }
        if($states) { return $states; } else { return FALSE; }
    }

    /* ----------------------------------------------------------
    * --------------End : State List by Zone id---------------*
    * ----------------------------------------------------------*/

     /* ----------------------------------------------------------
    * --------------Start : State List by user id---------------*
    * ----------------------------------------------------------*/

    public function get_state_from_user($user_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $states = [];
        if($user_id != '')
        {          
             $state_id = $this->sam->get_real_value('sam_users','id',$user_id,'state_id');
             if($state_id != '')
             {
                $state_id_arr = explode(',',$state_id);
                $w .= "AND id in (". implode(",", $state_id_arr).")";
                $query = "SELECT * FROM zyd_state WHERE $w ORDER BY state ASC";
                $states  = ORM::for_table('zyd_state')->raw_query($query)->find_array();   
             }
        }
        if($states) { return $states; } else { return FALSE; }
    }

    /* ----------------------------------------------------------
    * --------------Start : State List by user id---------------*
    * ----------------------------------------------------------*/
    /* ----------------------------------------------------------
    * --------------Start : City List by state id---------------*
    * ----------------------------------------------------------*/

    public function get_city_from_state($state_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $city = [];
        if($state_id != '')
        {          
            $w .= "AND state_id = '".$state_id."'";
            $query = "SELECT * FROM zyd_city WHERE $w ORDER BY city ASC";
            $city  = ORM::for_table('zyd_city')->raw_query($query)->find_array();   
        }
         if($city) { return $city; } else { return FALSE; }
    }

    /* ----------------------------------------------------------
    * --------------End : City List by state id---------------*
    * ----------------------------------------------------------*/

    

    /* ----------------------------------------------------------
    * --------------Start : Civil Eng List by state id---------------*
    * ----------------------------------------------------------*/

    public function get_civil_eng_from_state($state_id) 
    {
        $w = "is_deleted = '0' AND status = 'active' AND type = 'civil_engineer' ";
        $civil_engineer = [];
        if($state_id != '')
        {          
            $w .= " AND FIND_IN_SET('".$state_id."', state_id)";
            $query = "SELECT id,name FROM sam_users WHERE $w ORDER BY name ASC";
            $civil_engineer  = ORM::for_table('sam_users')->raw_query($query)->find_array();   
        }
        if($civil_engineer) { return $civil_engineer; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End : City List by state id---------------*
    * ----------------------------------------------------------*/


      function get_profile_percentage($id,$table_name,$default_field)
   {
        $query = "SHOW COLUMNS FROM $table_name";
        $total_columns = ORM::for_table($table_name)->raw_query($query)->find_array();
        
        $total_field = count($total_columns);
        $total_empty = 0;
        $total_note_empty = $default_field;
        $total_note_empty_per = 0;
        
        foreach($total_columns as $total_column)
        {
            $field_name = $total_column['Field'];
            $d = ORM::for_table($table_name)->where('id',$id)->find_one();
            if($d->$field_name != '' ||  $d->$field_name != null)
            {
                $total_note_empty++;    
            } else {
                $total_empty++;
            }
        }
        
        
        $total_note_empty_per = (100 * $total_note_empty) / $total_field;
        //return number_format((float)$total_note_empty_per, 2, '.', '');
        return round($total_note_empty_per);
        
   }


    public function below_employee($user_id,$employees=[])
    {
        $employees = $employees;
        $type = $this->get_real_value('sam_users','id',$user_id,'type');
        //echo $type;exit;

        
        //depot, zonal_manager, state_head, middle_manager, exective, field_assistant, agronomist_manager, agronomist

        if($type == 'depot'){
            $state_id = $this->get_real_value('sam_users','id',$user_id,'state_id');
            $state_id_array = explode(",", $state_id);
            // get zone Manager ids start            
            $zone_manager_w = "";
            foreach($state_id_array as $key => $state_id) {
                $zone_manager_w .= "FIND_IN_SET('".$state_id."', state_id) or ";
            }
            $zone_manager_w = substr($zone_manager_w,0,-3);
            if($zone_manager_w != ""){
                $zone_manager_query = "SELECT id FROM `sam_users` WHERE `status`='active' and `is_deleted`=0 and `type`='zonal_manager' and (".$zone_manager_w.")";
                

                $zone_manager_d = ORM::for_table('sam_users')->raw_query($zone_manager_query)->find_array();
                if($zone_manager_d){
                    //echo $zone_manager_query;
                    //echo '<pre>';
                    //print_r($zone_manager_d);
                    foreach ($zone_manager_d as $key => $zone_manager_id) {
                        
                        $employees[] = $zone_manager_id['id'];
                        $employees = $this->below_employee($zone_manager_id['id'],$employees);
                        //echo $zone_manager_id['id'];
                        //echo '<br>';
                    }
                }
            }
            // get zone Manager ids end                        

        }
        else if($type == 'zonal_manager'){
            $state_id = $this->get_real_value('sam_users','id',$user_id,'state_id');
            $state_id_array = explode(",", $state_id);
            //echo '<pre>';
            //echo "zonal_manager";
            //print_r($state_id_array);
            
            // get state_head ids start  
            $state_head_w = "";
            foreach($state_id_array as $key => $state_id) {
                $state_head_w .= "FIND_IN_SET('".$state_id."', state_id) or ";
            }
            $state_head_w = substr($state_head_w,0,-3);
            if($state_head_w != ""){
                $state_head_query = "SELECT id FROM `sam_users` WHERE `status`='active' and `is_deleted`=0 and `type`='state_head' and (".$state_head_w.") "; // and `zonal_manager_id`='".$user_id."' 
                

                $state_head_d = ORM::for_table('sam_users')->raw_query($state_head_query)->find_array();
                if($state_head_d){
                    //echo $state_head_query;
                    //echo '<pre>';
                    //print_r($state_head_d);
                    foreach ($state_head_d as $key => $state_head_id) {
                        
                        $employees[] = $state_head_id['id'];
                        $employees = $this->below_employee($state_head_id['id'],$employees);
                        //echo $state_head_id['id'];
                        //echo '<br>';
                    }
                }
            }
            // get state_head ids end

        }
        else if($type == 'state_head'){
            $state_id = $this->get_real_value('sam_users','id',$user_id,'state_id');
            $state_id_array = explode(",", $state_id);
            //echo '<pre>';
            //echo "state_head";
            //print_r($state_id_array);


            // get middle_manager/exective/field_assistant ids start  
            $middle_manager_w = "";
            foreach($state_id_array as $key => $state_id) {
                $middle_manager_w .= "FIND_IN_SET('".$state_id."', state_id) or ";
            }
            $middle_manager_w = substr($middle_manager_w,0,-3);
            
            if($middle_manager_w != ""){

                $middle_manager_query = "SELECT id FROM `sam_users` WHERE `status`='active' and `is_deleted`=0 and `type` in ('middle_manager','exective', 'field_assistant') and `state_head_id`='".$user_id."' and (".$middle_manager_w.")";
                
                $middle_manager_d = ORM::for_table('sam_users')->raw_query($middle_manager_query)->find_array();

                if($middle_manager_d){

                    //echo '<pre>';
                    //print_r($middle_manager_d);
                    foreach ($middle_manager_d as $key => $middle_manager_id) {
                        
                        $employees[] = $middle_manager_id['id'];
                        $employees = $this->below_employee($middle_manager_id['id'],$employees);
                        //echo $middle_manager_id['id'];
                        //echo '<br>';
                    }
                }

                $agronomist_query = "SELECT id FROM `sam_users` WHERE `status`='active' and `is_deleted`=0 and `type` in ('agronomist') and `state_head_id`='".$user_id."' and (".$middle_manager_w.")";
                $agronomist_query_d = ORM::for_table('sam_users')->raw_query($agronomist_query)->find_array();
                if($agronomist_query_d){
                    foreach ($agronomist_query_d as $key => $agronomist_id) {                        
                        $employees[] = $agronomist_id['id'];
                        //echo $middle_manager_id['id'];
                        //echo '<br>';
                    }
                }

                
            }
            // get middle_manager/exective/field_assistant ids end

        }
        else if($type == 'middle_manager'){
            $district_id = $this->get_real_value('sam_users','id',$user_id,'district_id');
            $district_id_array = explode(",", $district_id);
            //echo '<pre>';
            //echo "middle_manager";
            //print_r($district_id_array);

            // get exective ids start
            $exective_w = "";
            foreach($district_id_array as $key => $district_id) {
                $exective_w .= "FIND_IN_SET('".$district_id."', district_id) or ";
            }
            $exective_w = substr($exective_w,0,-3);
            if($exective_w != ""){
                $exective_query = "SELECT id FROM `sam_users` WHERE `status`='active' and `is_deleted`=0 and `type`='exective' and `middle_manager`='".$user_id."' and (".$exective_w.")";
                
                $exective_d = ORM::for_table('sam_users')->raw_query($exective_query)->find_array();
                if($exective_d){
                    //echo '<pre>';
                    //print_r($exective_d);
                    foreach ($exective_d as $key => $exective_id) {
                        
                        $employees[] = $exective_id['id'];
                        $employees = $this->below_employee($exective_id['id'],$employees);
                        //echo $exective_id['id'];
                        //echo '<br>';
                    }
                }
            }
            // get exective ids end


            // get field_assistant ids start            
            $field_assistant_query = "SELECT id FROM `sam_users` WHERE `status`='active' and `is_deleted`=0 and `type`='field_assistant' and (`middle_manager`='".$user_id."' or `reporting_to_middlemanager`='".$user_id."')";                
            $field_assistant_d = ORM::for_table('sam_users')->raw_query($field_assistant_query)->find_array();
            if($field_assistant_d){
                //echo '<pre>';
                //print_r($field_assistant_d);
                foreach ($field_assistant_d as $key => $field_assistant_id) {
                    $employees[] = $field_assistant_id['id'];
                    $employees = $this->below_employee($field_assistant_id['id'],$employees);
                    //echo $field_assistant_id['id'];
                    //echo '<br>';
                }
             }
             // get field_assistant ids end
        }
        else if($type == 'exective'){

            $taluka_id = $this->get_real_value('sam_users','id',$user_id,'taluka_id');
            $taluka_id_array = explode(",", $taluka_id);
            //echo '<pre>';
            //echo "middle_manager";
            //print_r($taluka_id_array);
            // get field_assistant ids start
            $field_assistant_w = "";
            foreach($taluka_id_array as $key => $taluka_id) {
                $field_assistant_w .= "FIND_IN_SET('".$taluka_id."', taluka_id) or ";
            }
            $field_assistant_w = substr($field_assistant_w,0,-3);
            if($field_assistant_w != ""){
                $field_assistant_query = "SELECT id FROM `sam_users` WHERE `status`='active' and `is_deleted`=0 and `type`='field_assistant' and `exective_id`='".$user_id."' and (".$field_assistant_w.")";
                
                $field_assistant_d = ORM::for_table('sam_users')->raw_query($field_assistant_query)->find_array();
                if($field_assistant_d){
                    //echo '<pre>';
                    //print_r($field_assistant_d);
                    foreach ($field_assistant_d as $key => $field_assistant_id) {
                        
                        $employees[] = $field_assistant_id['id'];
                        $employees = $this->below_employee($field_assistant_id['id'],$employees);
                        //echo $field_assistant_id['id'];
                        //echo '<br>';
                    }
                }
            }
            // get field_assistant ids end 


        }
       
        else if($type == 'agronomist'){

            $cluster_id = $this->get_real_value('sam_users','id',$user_id,'cluster_id');
            $cluster_id_array = explode(",", $cluster_id);

            $district_id_array[] = "0";
            $c_query = "SELECT id FROM `zyd_district` WHERE cluster_id in (". implode(",", $cluster_id_array).") and status='active' and is_deleted=0";
            $c = ORM::for_table('zyd_district')->raw_query($c_query)->find_array();
            if($c){
                foreach ($c as $key => $district_id) {
                    $district_id_array[] =  $district_id['id'];
                }
            }
            $district_id_w = "";
            foreach($district_id_array as $key => $district_id) {
                $district_id_w .= "FIND_IN_SET('".$district_id."', district_id) or ";
            }
            $district_id_w = substr($district_id_w,0,-3);
            $w = " and (".$district_id_w.")";

            $middle_manager_query = "SELECT id FROM `sam_users` WHERE `status`='active' and `is_deleted`=0 and `type`='middle_manager' ".$w;
            $middle_manager_d = ORM::for_table('sam_users')->raw_query($middle_manager_query)->find_array();
            if($middle_manager_d){
                //echo '<pre>';
                //print_r($middle_manager_d);
                foreach ($middle_manager_d as $key => $middle_manager_id) {                        
                    $employees[] = $middle_manager_id['id'];
                    $employees = $this->below_employee($middle_manager_id['id'],$employees);
                    //echo $middle_manager_id['id'];
                    //echo '<br>';
                }
            }
            // get middle_manager ids end


        }else{
            $query = "SELECT id FROM `sam_users` WHERE `status`='active' and `is_deleted`=0 and `type`!='admin'";
            $query_records = ORM::for_table('sam_users')->raw_query($query)->find_array();

            if($query_records){

                foreach ($query_records as $key => $query_record) {                        
                    $employees[] = $query_record['id'];
                }
            }

        }

           if($employees) {
            return $employees;
        } else {
            return [];
        }
    }

    public function get_employee_details($employees)
    {
        if(count($employees) <= 0){$employees[] = 0;}
        $d_query = "SELECT id,name,type,emp_code FROM `sam_users` WHERE id in (". implode(",", $employees).") order by name asc";
        $d = ORM::for_table('sam_users')->raw_query($d_query)->find_array();
        
        if($d) {
            return $d;
        } else {
            return [];
        }
    }


    /* ----------------------------------------------------------
    * --------Start :  Sub Category From Category (Multiple)-----*
    * ----------------------------------------------------------*/

    public function get_subcategory_from_category($categoty_ids) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $subcategory = [];
        if($categoty_ids != '')
        {    
            $categoty_ids_arr = explode(',',$categoty_ids);
            $w .= "AND categoty_ids in(". implode(",", $categoty_ids_arr).")";
            $query = "SELECT * FROM tech_product_sub_category WHERE $w ORDER BY id ASC";
            $subcategory  = ORM::for_table('tech_product_sub_category')->raw_query($query)->find_array();   
        }
        if($subcategory) {
            return $subcategory;
        } else {
            return [];
        }
    }

    /* ----------------------------------------------------------
    * -------End :  Sub Category From Category -----(Multiple)--*
    * ----------------------------------------------------------*/

    /* ----------------------------------------------------------
    * --------Start :  Sub Category From Category (single)-----*
    * ----------------------------------------------------------*/

    public function get_single_subcategory_from_category($categoty_ids) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $subcategory = [];
        if($categoty_ids != '')
        {    
            $w .= " AND FIND_IN_SET('".$categoty_ids."', categoty_ids)";
            $query = "SELECT * FROM tech_product_sub_category WHERE $w ORDER BY id ASC";
            $subcategory  = ORM::for_table('tech_product_sub_category')->raw_query($query)->find_array();   
        }
        if($subcategory) {
            return $subcategory;
        } else {
            return [];
        }
    }

    /* ----------------------------------------------------------
    * -------End :  Sub Category From Category -----(Multiple)--*
    * ----------------------------------------------------------*/

     /* ----------------------------------------------------------
    * --------------Start :  get Attribute value ---------*
    * ----------------------------------------------------------*/

    public function get_attribute_value($attri_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $attr_values = [];
        if($attri_id != '')
        {    
            $w .= " AND attribute_id ='".$attri_id."'";
            $query = "SELECT * FROM tech_product_attributes_value WHERE $w ORDER BY id ASC";
            $attr_values  = ORM::for_table('tech_product_attributes_value')->raw_query($query)->find_array();   
        }
        if($attr_values) {
            return $attr_values;
        } else {
            return [];
        }
    }

    /* ----------------------------------------------------------
    * --------------End :  get Attribute value ---------*
    * ----------------------------------------------------------*/


     public function get_selected_prod_attribute($category_ids,$subcategory_ids)
    {
            $existProdAttri = ORM::for_table('tech_product_attributes')
                ->where('categoty_ids',$category_ids)
                ->where('subcategory_ids',$subcategory_ids)
                ->where('status','active')
                ->where('is_deleted',0)
                ->find_one();
            if($existProdAttri){
                $prod_attributes = ORM::for_table('tech_product_attributes_value')
                                                ->where('attribute_id',$existProdAttri->id)
                                                ->where('status','active')
                                                ->where('is_deleted',0)
                                                ->find_array();
            }else{
                $prod_attributes = [];      
            }

            if($existProdAttri) {
                return $prod_attributes;
            } else {
                return [];
            }

    }

     /* ----------------------------------------------------------
    * --------------Start : Customer Contact list---------------*
    * ----------------------------------------------------------*/
    public function get_contacts($customer_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $contact = [];
        if($customer_id != ''){          
            $w .= " AND customer_id ='".$customer_id."'";
            $query = "SELECT * FROM sam_customers_contact WHERE $w ORDER BY id ASC";
            $contact  = ORM::for_table('sam_customers_contact')->raw_query($query)->find_array();   
        }
        if($contact) { return $contact; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Customer Contact list---------------*
    * ----------------------------------------------------------*/


 /* ----------------------------------------------------------
    * --------------Start : Customer Contact list---------------*
    * ----------------------------------------------------------*/
    public function get_vander_contacts($customer_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $contact = [];
        if($customer_id != ''){          
            $w .= " AND customer_id ='".$customer_id."'";
            $query = "SELECT * FROM sam_vandor_contact WHERE $w ORDER BY id ASC";
            $contact  = ORM::for_table('sam_customers_contact')->raw_query($query)->find_array();   
        }
        if($contact) { return $contact; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Customer Contact list---------------*
    * ----------------------------------------------------------*/

     /* ----------------------------------------------------------
    * --------------Start : Customer Address list---------------*
    * ----------------------------------------------------------*/
    public function get_address($customer_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $contact = [];
        if($customer_id != ''){          
            $w .= " AND customer_id ='".$customer_id."'";
            $query = "SELECT * FROM sam_customers_address WHERE $w ORDER BY id ASC";
            $contact  = ORM::for_table('sam_customers_address')->raw_query($query)->find_array();   
        }
        if($contact) { return $contact; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Customer Address list---------------*
    * ----------------------------------------------------------*/

    /* ----------------------------------------------------------
    * ----------------Start : Customer AMC list----------------*
    * ----------------------------------------------------------*/
    public function get_customer_amc($customer_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $amcs = [];
        if($customer_id != ''){          
            $w .= " AND customer_id ='".$customer_id."'";
            $query = "SELECT * FROM tech_amc WHERE $w ORDER BY id ASC";
            $amcs  = ORM::for_table('tech_amc')->raw_query($query)->find_array();   
        }
        if($amcs) { return $amcs; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Customer AMC list---------------*
    * ----------------------------------------------------------*/

      /* ----------------------------------------------------------
    * --------------Start : Customer AMC list---------------*
    * ----------------------------------------------------------*/
    public function get_tickets_problem_report($ticket_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $amcs = [];
        if($ticket_id != ''){          
            $w .= " AND ticket_id ='".$ticket_id."'";
            $query = "SELECT * FROM tech_tickets_problem_report WHERE $w ORDER BY id ASC";
            $amcs  = ORM::for_table('tech_tickets_problem_report')->raw_query($query)->find_array();   
        }
        if($amcs) { return $amcs; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Customer AMC list---------------*
    * ----------------------------------------------------------*/

    

     /* ----------------------------------------------------------
    * --------------Start : Employee list---------------*
    * ----------------------------------------------------------*/
    public function get_employees() 
    {
        $w = "is_deleted = '0' AND status = 'active' AND type != 'admin'";
            $employees = [];
            if($this->session->userdata('identity') != 'admin'){          
                $login_id = $this->session->userdata('loginid');
                $w .= " AND id  = '".$login_id. "'";  
            }
            $query = "SELECT * FROM sam_users WHERE $w ORDER BY id ASC";
            $employees  = ORM::for_table('sam_users')->raw_query($query)->find_array();   
        
        if($employees) { return $employees; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Employee list---------------*
    * ----------------------------------------------------------*/

    /* ----------------------------------------------------------
    * -------------- Start :  customer list---------------*
    * ----------------------------------------------------------*/

    public function get_customer_list() 
    {
        $w = "is_deleted = '0' AND status = 'active' AND customer_type = 'customer' ";
        if($this->session->userdata('identity') != 'admin')
        {          
            $login_id = $this->session->userdata('loginid');
            $state_id = $this->sam->get_real_value('sam_users','id',$login_id,'state_id');
            $w .= " AND created_by_user_id  = '".$login_id. "'";  
        }
        $query = "SELECT * FROM sam_customers WHERE $w ORDER BY name ASC";
        $d  = ORM::for_table('sam_customers')->raw_query($query)->find_array();
        if($d) { return $d; } else { return FALSE; }
    }

    public function get_vendor_list() 
    {
        $w = "is_deleted = '0' AND status = 'active' AND customer_type = 'vendor' ";
        if($this->session->userdata('identity') != 'admin')
        {          
            $login_id = $this->session->userdata('loginid');
            $state_id = $this->sam->get_real_value('sam_users','id',$login_id,'state_id');
            $w .= " AND created_by_user_id  = '".$login_id. "'";  
        }
        $query = "SELECT * FROM sam_customers WHERE $w ORDER BY name ASC";
        $d  = ORM::for_table('sam_customers')->raw_query($query)->find_array();
        if($d) { return $d; } else { return FALSE; }
    }
    
     /* ----------------------------------------------------------
    * --------------Start : text to slug Convert ---------------*
    * ----------------------------------------------------------*/

     /* ----------------------------------------------------------
    * -------------- Start :  Services list---------------*
    * ----------------------------------------------------------*/

    public function get_services() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $query = "SELECT * FROM tech_service WHERE $w ORDER BY title ASC";
        $d  = ORM::for_table('tech_service')->raw_query($query)->find_array();
        if($d) { return $d; } else { return FALSE; }
    }

     /* ----------------------------------------------------------
    * --------------End  : Services List  ---------------*
    * ----------------------------------------------------------*/

     /* ----------------------------------------------------------
    * -------------- Start :  Services list---------------*
    * ----------------------------------------------------------*/

    public function get_products() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $query = "SELECT * FROM zyd_products_mst WHERE $w ORDER BY product_name ASC";
        $d  = ORM::for_table('zyd_products_mst')->raw_query($query)->find_array();
        if($d) { return $d; } else { return FALSE; }
    }

     public function get_products_old() 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $query = "SELECT * FROM zyd_products_mst WHERE $w ORDER BY product_name ASC";
        $products  = ORM::for_table('zyd_products_mst')->raw_query($query)->find_array();

        $d = [];
        foreach ($products as $key => $product) {

            $attri_query = "SELECT *,
                      @attributes_name := (select title from tech_product_attributes_value where id=attribute_id) as attributes_name
                      FROM zyd_products_mst_attribute WHERE is_deleted = '0' AND product_id = '" .$product['id']. "' order by id desc"; 

            
            $product['prod_attributes'] =  ORM::for_table('zyd_products_mst_attribute')->raw_query($attri_query)->find_array();
       

            $d[] =   $product;

        }


        if($d) { return $d; } else { return FALSE; }
    }

     /* ----------------------------------------------------------
    * --------------End  : Services List  ---------------*
    * ----------------------------------------------------------*/

      /* ----------------------------------------------------------
    * --------------Start : Inquiry Items list---------------*
    * ----------------------------------------------------------*/
    public function get_inquiry_items($inquiry_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $inquiry = [];
        if($inquiry_id != ''){          
            $w .= " AND inquiry_id ='".$inquiry_id."'";
            $query = "SELECT * FROM tech_inquiry_item WHERE $w ORDER BY id ASC";
            $inquiry  = ORM::for_table('tech_inquiry_item')->raw_query($query)->find_array();   
        }
        if($inquiry) { return $inquiry; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Inquiry Items list---------------*
    * ----------------------------------------------------------*/

    /* ----------------------------------------------------------
    * --------------Start : Inquiry Items list---------------*
    * ----------------------------------------------------------*/
    public function get_quotation_item($quotation_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $quotation = [];
        if($quotation_id != ''){          
            $w .= " AND quotation_id ='".$quotation_id."'";
            $query = "SELECT * FROM tech_quotation_item WHERE $w ORDER BY id ASC";
            $quotation  = ORM::for_table('tech_quotation_item')->raw_query($query)->find_array();   
        }
        if($quotation) { return $quotation; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Inquiry Items list---------------*
    * ----------------------------------------------------------*/

     /* ----------------------------------------------------------
    * --------------Start : Sales Order  list---------------*
    * ----------------------------------------------------------*/
    public function get_salesorder_item($sales_order_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $quotation = [];
        if($sales_order_id != ''){          
            $w .= " AND sales_order_id ='".$sales_order_id."'";
            $query = "SELECT * FROM tech_sales_order_item WHERE $w ORDER BY id ASC";
            $quotation  = ORM::for_table('tech_sales_order_item')->raw_query($query)->find_array();   
        }
        if($quotation) { return $quotation; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Inquiry Items list---------------*
    * ----------------------------------------------------------*/

    /* ----------------------------------------------------------
    * --------------Start : Inquiry Items list---------------*
    * ----------------------------------------------------------*/
    public function get_challan_item($challan_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $challan = [];
        if($challan_id != ''){          
            $w .= " AND challan_id ='".$challan_id."'";
            $query = "SELECT * FROM tech_challan_item WHERE $w ORDER BY id ASC";
            $challan  = ORM::for_table('tech_challan_item')->raw_query($query)->find_array();   
        }
        if($challan) { return $challan; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Inquiry Items list---------------*
    * ----------------------------------------------------------*/

    /* ----------------------------------------------------------
    * --------------Start : Inquiry Items list---------------*
    * ----------------------------------------------------------*/
    public function get_purchaseorder_item($po_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $quotation = [];
        if($po_id != ''){          
            $w .= " AND purchase_order_id ='".$po_id."'";
            $query = "SELECT * FROM tech_purchase_order_item WHERE $w ORDER BY id ASC";
            $quotation  = ORM::for_table('tech_purchase_order_item')->raw_query($query)->find_array();   
        }
        if($quotation) { return $quotation; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Inquiry Items list---------------*
    * ----------------------------------------------------------*/

    

    /* ----------------------------------------------------------
    * --------------Start : Get quotation terms---------------*
    * ----------------------------------------------------------*/
    public function get_quotation_terms($quotation_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $quotation = [];
        if($quotation_id != ''){          
            $w .= " AND quotation_id ='".$quotation_id."'";
            $query = "SELECT * FROM tech_quotation_term_condition WHERE $w ORDER BY id ASC";
            $quotation  = ORM::for_table('tech_quotation_term_condition')->raw_query($query)->find_array();   
        }
        if($quotation) { return $quotation; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Get quotation terms---------------*
    * ----------------------------------------------------------*/

    /* ----------------------------------------------------------
    * --------------Start : Get Terms terms---------------*
    * ----------------------------------------------------------*/
    public function get_salesorder_terms($salesorder_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $salesorders = [];
        if($salesorder_id != ''){          
            $w .= " AND sales_order_id ='".$salesorder_id."'";
            $query = "SELECT * FROM tech_sales_order_item_term_condition WHERE $w ORDER BY id ASC";
            $salesorders  = ORM::for_table('tech_sales_order_item_term_condition')->raw_query($query)->find_array();   
        }
        if($salesorders) { return $salesorders; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Get quotation terms---------------*
    * ----------------------------------------------------------*/
    
    /* ---------------------------------------------------------
    * --------- Start :  Get Terms Condition for ticket---------*
    * ----------------------------------------------------------*/
    public function get_ticket_terms($ticket_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $ticket_terms = [];
        if($ticket_id != ''){          
            $w .= " AND ticket_id ='".$ticket_id."'";
            $query = "SELECT * FROM tech_ticket_term_condition WHERE $w ORDER BY id ASC";
            $ticket_terms  = ORM::for_table('tech_ticket_term_condition')->raw_query($query)->find_array();   
        }
        if($ticket_terms) { return $ticket_terms; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------- End :  Get Terms Condition for ticket---------*
    * ----------------------------------------------------------*/
    

    /* ----------------------------------------------------------
    * --------------Start : Get Invoice terms---------------*
    * ----------------------------------------------------------*/
    public function get_invoice_terms($invoice_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $quotation = [];
        if($invoice_id != ''){          
            $w .= " AND invoice_id ='".$invoice_id."'";
            $query = "SELECT * FROM tech_invoice_term_condition WHERE $w ORDER BY id ASC";
            $quotation  = ORM::for_table('tech_invoice_term_condition')->raw_query($query)->find_array();   
        }
        if($quotation) { return $quotation; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Get Invoice terms---------------*
    * ----------------------------------------------------------*/

    /* ----------------------------------------------------------
    * --------------Start : Get Invoice terms---------------*
    * ----------------------------------------------------------*/
    public function get_purchase_order_terms($po_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $quotation = [];
        if($po_id != ''){          
            $w .= " AND purchase_order_id ='".$po_id."'";
            $query = "SELECT * FROM tech_purchase_order_term_condition WHERE $w ORDER BY id ASC";
            $quotation  = ORM::for_table('tech_purchase_order_term_condition')->raw_query($query)->find_array();   
        }
        if($quotation) { return $quotation; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Get Invoice terms---------------*
    * ----------------------------------------------------------*/



    /* ----------------------------------------------------------
    * --------------Start : Inquiry Items list---------------*
    * ----------------------------------------------------------*/
    public function get_invoice_item($invoice_id) 
    {
        $w = "is_deleted = '0' AND status = 'active'";
        $invoice = [];
        if($invoice_id != ''){          
            $w .= " AND invoice_id ='".$invoice_id."'";
            $query = "SELECT * FROM tech_invoice_item WHERE $w ORDER BY id ASC";
            $invoice  = ORM::for_table('tech_invoice_item')->raw_query($query)->find_array();   
        }
        if($invoice) { return $invoice; } else { return FALSE; }
    }
    /* ----------------------------------------------------------
    * --------------End :  Inquiry Items list---------------*
    * ----------------------------------------------------------*/

    

    public function slugify($text)
    {

       $divider = '-';
      // replace non letter or digits by divider
      $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, $divider);

      // remove duplicate divider
      $text = preg_replace('~-+~', $divider, $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }

     /* ----------------------------------------------------------
    * --------------End : text to slug Convert ---------------*
    * ----------------------------------------------------------*/

     public function get_autogenrate_no($tablename)
     {

         $last_rec = ORM::for_table($tablename)->select('id')->order_by_desc('id')->find_one();
         // echo "<pre>";print_r($last_rec);die();
         $next_id = 1;
         if(!empty($last_rec))
         {
            $next_id = $last_rec->id + 1;
         }
         return str_pad($next_id, 5, '0', STR_PAD_LEFT);
     }


}