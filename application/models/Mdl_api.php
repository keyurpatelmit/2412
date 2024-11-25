<?php defined('BASEPATH') OR exit('No direct script access allowed');
    
require_once APPPATH.'third_party/PHPMailer.php';

class Mdl_api extends CI_Model {

     public function __construct() 
     {
         parent::__construct();
         $this->load->library('database');        
     }

    public function request_log($post)
    {
        $d = ORM::for_table('zyd_request_log')->create();
        $d->data             =  json_encode($post);
        $d->inserted_time    =  date("Y-m-d H:i:s");
        $d->save();
        if($d->id) {
            return $d->id;
        } else {
            return FALSE;
        }
    }

    public function CheckUserExist($Userdata)
    {
        $d = ORM::for_table('sam_users')
                                //->where('email',$Userdata['email_id'])
                                ->where('emp_code',$Userdata['email_id'])
                                ->where('password',md5($Userdata['password']))
                                ->where('status','active')->where('is_deleted','0')
                                ->find_array();
        if($d) {

            $output['IsExist'] = true;
            $output['userdata'] = $d;
            $output['msg'] = 'Successfully Data Get';
            
        } else {

            $output['IsExist'] = false;
            $output['userdata'] = '';
            $output['msg'] = 'Fail';
        }
        return $output;
        //echo json_encode($output);                        
    }

    public function UserDeviceAuth($Userdata,$UserId)
    {
     
        $d = ORM::for_table('sam_users')->where('is_deleted','0')->where('id',$UserId)->find_one();
        $d->imei                = @$Userdata['imei'];
        $d->device_name         = @$Userdata['device_name'];
        $d->device_varifi       = 'pending';
        $d->save();
        if($d->id) {
            return $d->id;
        } else {
            return FALSE;
        }
    }

    public function UserDeviceToken($Userdata,$UserId)
    {
        $d = ORM::for_table('sam_users')->where('id',$UserId)->find_one();
        $d->version          = @$Userdata['version'];
        $d->token_id         = @$Userdata['token_id'];
        $d->current_login    = date("Y-m-d H:i:s");
        $d->save();
        if($d->id) {
            return $d->id;
        } else {
            return FALSE;
        }
    }

    public function UpdateUserToken($Userdata,$UserId)
    {
        $d = ORM::for_table('sam_users')->where('id',$UserId)->find_one();
        $d->token_id         = @$Userdata['token_id'];
        $d->save();
        if($d->id) {
            return $d->id;
        } else {
            return FALSE;
        }
    }

    public function add_start_stop_log($post) 
     {
        $d = ORM::for_table('zyd_start_stop_log')->create();
        $d->user_id                  = $post['user_id'];
        $d->start_stop_status        = $post['start_stop_status'];
        $d->latitude                 = $post['latitude'];
        $d->longitude                = $post['longitude'];
        $d->address                  = $post['address'];
        $d->km                       = $post['km'];
        $d->time                     = $post['time'];
        $d->gps_status               = $post['gps_status'];
        $d->date                     = date('Y-m-d');
        $d->inserted_time            = date('Y-m-d H:i:s');
        $d->save();
        if($d->id) {
            return $d->id;
        } else {
            return FALSE;
        }
    }

    public function get_dashboard($post)
    {
        $w = "is_deleted = 0";

        if (@$post['user_id'] != '') 
        {
            $w .= " and id = '".$post['user_id']."'";
        }

        $query = "SELECT * FROM sam_users WHERE $w";

        $d = ORM::for_table('sam_users')->raw_query($query)->find_array();
        
        $attendence = $this->get_emp_today_atendance($post);
        
        $d[0]['attendance_date'] = @$attendence->attendance_date;
        $d[0]['attendance_state'] = @$attendence->attendance_status;
        $d[0]['attendance_start_time'] = @$attendence->attendance_start_time;
        $d[0]['attendance_end_time'] = @$attendence->attendance_end_time;
        $d[0]['today_activity'] = $this->get_today_activity($post);
        
        if ($d) {
            return $d;
        }else{
            return [];
        }
    }

    public function get_emp_today_atendance($post){
        $CurrentData = date('Y-m-d');
        $d = ORM::for_table('zyd_attendance')
                                    ->where('attendance_date',$CurrentData)
                                    ->where('user_id',$post['user_id'])->find_one();
   
        if ($d) {
            return $d;
        }else{
            return [];
        }
    }


     public function get_today_activity($post)
    {
        $w = " is_deleted=0 ";
        $today_date = date('Y-m-d');
        // search start
        if(@$post['date'] != ''){
            $w .= " and date(inserted_time) = '".$post['date']."'";    
        }else{
            $w .= " and date(inserted_time) = '".$today_date."'";    
        }
        
        if(@$post['user_id'] != ''){
            $w .= " and user_id = '".$post['user_id']."'";    
        }
        
        $query = "SELECT * FROM zyd_activity WHERE $w";
        $d = ORM::for_table('zyd_activity')->raw_query($query)->find_array();
        if($d) { return $d; } else { return []; }
    }


    public function get_zone($post)
    {
        $w = " is_deleted= 0 AND status = 'active' order by zone desc";
        if (@$post['id'] != '') {
            $w .= " and id = '".$post['id']. "'";
        }
        $query = "SELECT id,zone FROM zyd_zone WHERE $w";
        $d = ORM::for_table('zyd_zone')->raw_query($query)->find_array();

        if ($d) {
            return $d;
        }else{
            return [];
        }
    }


    public function get_state($post)
    {
        $w = " is_deleted= 0 AND status = 'active' order by state desc";

        if (@$post['id'] != '') {
            $w .= " and id = '".$post['id']."' ";
        }

        if (@$post['zone_id'] != '') {
            $w .= "   and zone_id= '" .$post['zone_id']. "'    ";
        }

        $query = "SELECT id,state,zone_id,
                      @zone_name := (select zone from zyd_zone where id=zone_id) as zone_name
                       FROM zyd_state WHERE $w order by state ASC"; 
        $d = ORM::for_table('zyd_state')->raw_query($query)->find_array();

        if ($d) {
            return $d;
        }else{
            return [];
        }
    }

    public function get_city($post)
    {
        $w = " is_deleted= 0 AND status = 'active' order by id desc";

        if (@$post['id'] != '') {
            $w .= " and id = '".$post['id']."' ";
        }
        if (@$post['state_id'] != '') {
            $w .= " and state_id = '".$post['state_id']."' ";
        }
        if (@$post['zone_id'] != '') {
            $w .= "   and zone_id= '" .$post['zone_id']. "'    ";
        }
        $query = "SELECT id,state_id,zone_id,city,
                      @state_name := (select state from zyd_state where id=state_id) as state_name,
                      @zone_name := (select zone from zyd_zone where id=zone_id) as zone_name
                       FROM zyd_city WHERE $w order by id ASC"; 
        $d = ORM::for_table('zyd_city')->raw_query($query)->find_array();

        if ($d) {
            return $d;
        }else{
            return [];
        }
    }
    
    
    
    
    
    

    

    // kra end
 


}