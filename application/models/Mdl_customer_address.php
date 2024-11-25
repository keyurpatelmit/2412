<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once('traits/common_function.php');

class Mdl_customer_address extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('database');
    }

    use common_db_functions;

    private $_table = 'sam_customers_address';

    public function get_all_with_pagi($id,$limit = 10,$start = 0,$w="") 
    {
        if($start == ''){ $start = 0; }
    
        $l = '';                    
        $limit = $limit;
        $offset = $start;

        $l = "LIMIT $offset,$limit";                    
        $query = "SELECT * FROM `sam_customers_address` WHERE is_deleted = '0' $w ORDER BY id DESC $l";
        $d = ORM::for_table('sam_customers_address')->raw_query($query)->find_array();

        if($d) { return $d; } else { return FALSE; }
    }

    public function get_record_count($w = null) {

            $query = "SELECT * FROM `sam_customers_address` WHERE is_deleted = '0' $w ORDER BY id DESC ";
            $TotalData = ORM::for_table('sam_customers_address')->raw_query($query)->find_array();
            $d = count($TotalData);

        if($d) { return $d; } else { return FALSE; }
    }

    public function update_row($post) {
        // echo "<pre>";print_r($post);die();
        $d = ORM::for_table('sam_customers_address')->where('id',$post['id'])->find_one();
        if($d) {

                $d->cust_address_name       = @$post['cust_address_name'];
                $d->cust_address                     = @$post['cust_address'];
                $d->cust_state_id                     = @$post['cust_state_id'];
                $d->cust_city_id               = @$post['cust_city_id'];
                $d->status                    = isset($post['status']) ? $post['status'] : 'active';
                $d->updated_time              = date('Y-m-d H:i:s');
                
                if($d->save()) { return $d; } else { return FALSE; }
            }

    }
 public function get_customer() {

            $query = "SELECT * FROM `sam_customers` WHERE customer_type ='customer' AND is_deleted = '0'  ORDER BY id DESC ";
            $TotalData = ORM::for_table('sam_customers')->raw_query($query)->find_array();
            $d = $TotalData;

        if($d) { return $d; } else { return FALSE; }
    }



}