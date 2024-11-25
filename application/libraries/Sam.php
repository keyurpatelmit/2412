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

class Sam {

    public function __construct() {
    }


    public function __get($var) {
        return get_instance()->$var;
    }

    /* Start :: Delete Single Record */
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
    

    public function logged_in() {
        return (bool) $this->session->userdata('identity');
    }

     public function user_logged_in() {
        return (bool) $this->session->userdata('user_identity');
    }

     public function get_roles() {
        return [
                 'admin'             => 'Admin',
                 'staff'             => 'staff',
                 'sales'             => 'sales',
                 'service'           => 'service',
                 'account'           => 'account'
               ];
    }

    public function get_languages() {
        return [
                'english'       => 'English'
            ];
    }

    public function pagination_config($num_links = 2) {
        $config['num_links'] = $num_links;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='javascript:void(0);'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tag_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        return $config;
    }


   
    /*-----------------------------------------------------------
    * -----------------Image Upload Function--------------------*
    * ----------------------------------------------------------*/

    public function upload_image($name,$path,$tmp_name = '') {

        // File uploading
        $file_name = $tmp_name.$_FILES[$name]['name'];
        $file_tmpname = $_FILES[$name]['tmp_name'];
        
        move_uploaded_file($file_tmpname,$path.$file_name);
        return true;
    }
    
    public function upload_image_lowercase($name,$path,$tmp_name = '') {

        // File uploading
        $file_name = $tmp_name.strtolower(str_replace(' ', '_', $_FILES[$name]['name']));
        $file_tmpname = $_FILES[$name]['tmp_name'];
        
        move_uploaded_file($file_tmpname,$path.$file_name);
        return true;
    }
    
    
        public function upload_multiple_image($name,$path,$i,$tmp_name = '') {

        // Multiple File uploading
        $file_name = $tmp_name.$_FILES[$name]['name'][$i];
        $file_tmpname = $_FILES[$name]['tmp_name'][$i];
        
        move_uploaded_file($file_tmpname,$path.$file_name);
        return true;
    }


    public static function timezoneList()
    {
        $timezoneIdentifiers = DateTimeZone::listIdentifiers();
        $utcTime = new DateTime('now', new DateTimeZone('UTC'));

        $tempTimezones = array();
        foreach ($timezoneIdentifiers as $timezoneIdentifier) {
            $currentTimezone = new DateTimeZone($timezoneIdentifier);

            $tempTimezones[] = array(
                'offset' => (int)$currentTimezone->getOffset($utcTime),
                'identifier' => $timezoneIdentifier
            );
        }

        // Sort the array by offset,identifier ascending
        usort($tempTimezones, function($a, $b) {
            return ($a['offset'] == $b['offset'])
                ? strcmp($a['identifier'], $b['identifier'])
                : $a['offset'] - $b['offset'];
        });

        $timezoneList = array();
        foreach ($tempTimezones as $tz) {
            $sign = ($tz['offset'] > 0) ? '+' : '-';
            $offset = gmdate('H:i', abs($tz['offset']));
            $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
                $tz['identifier'];
        }

        return $timezoneList;
    }
   
    public function get_active_data($tablename) {
        $d = ORM::for_table($tablename)
                ->where('status','active')
                ->where('is_deleted','0')
                ->find_many();

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
	

    public function date_format($date)
    {
        if($date != '1970-01-01' && $date != '0000-00-00'  && $date != '' )
        {
            $converted_date = date('d-m-Y', strtotime($date));
        }else{
            $converted_date = '-';
        }
        return $converted_date;
    }

    public function amount_format($amount)
    {
        if($amount != '' && $amount != '0' )
        {  
           $amount =   number_format((int)$amount).'/-';
        }else{
            $amount = '0';
        }
        return $amount;
    }

     public function get_all_transaction_type() {
        return [
            'cash' =>'Cash',
            'upi' =>'UPI',
            'neft' =>'NEFT',
            'cheque' =>'Cheque'
        ];
    }

    function get_order_time_diff($date)
    {
        $mydate= date("Y-m-d H:i:s");
        $theDiff="";
        //echo $mydate;//2014-06-06 21:35:55
        $datetime1 = date_create($date);
        $datetime2 = date_create($mydate);
        $interval = date_diff($datetime1, $datetime2);
        //echo $interval->format('%s Seconds %i Minutes %h Hours %d days %m Months %y Year    Ago')."<br>";
        $min=$interval->format('%i');
        $sec=$interval->format('%s');
        $hour=$interval->format('%h');
        $mon=$interval->format('%m');
        $day=$interval->format('%d');
        $year=$interval->format('%y');
        if($interval->format('%i%h%d%m%y')=="00000") {
            //echo $interval->format('%i%h%d%m%y')."<br>";
            return $sec." Seconds";
        } else if($interval->format('%h%d%m%y')=="0000"){
            return $min." Minutes";
        } else if($interval->format('%d%m%y')=="000"){
            return $hour." Hours";
        } else if($interval->format('%m%y')=="00"){
            return $day." Days";
        } else if($interval->format('%y')=="0"){
            return $mon." Months";
        } else{
            return $year." Years";
        }    
    }

    public function notification($type,$item_id,$assign_user_id,$notification)
    {
        $db = ORM::for_table('tech_notification')->create(); 
        $db->item_type              = $type;
        $db->item_id                = $item_id;
        $db->created_id             = $this->session->userdata('loginid');;
        $db->assign_user_id         = $assign_user_id;
        $db->notification_message   = $notification;
        $db->inserted_time          = date('Y-m-d H:i:s');
        $db->save();
    }

    public function check_inquiry_converted($inquiry_id)
    {
        $check_inquiry_converted = ORM::for_table('tech_quotation')->where('inquiry_id',$inquiry_id)->where('is_deleted','0')->find_one(); 
        if($check_inquiry_converted){
            return true;
        }else{
            return false;
        }
    }
    public function check_quotation_converted($quotation_id){
        $check_quotation_converted = ORM::for_table('tech_invoice')->where('quotation_id',$quotation_id)->where('is_deleted','0')->find_one(); 
        if($check_quotation_converted){
            return true;
        }else{
            return false;
        }
       
    }
    

    

}