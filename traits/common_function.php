<?php

trait common_db_functions {

	public function get_all($type = 'id',$limit = 10,$start = 0) {
		$d = ORM::for_table($this->_table)->where('is_deleted','0')
							->order_by_desc($type)
							->limit($limit)
							->offset($start)
							->find_many();

		if($d) { return $d; } else { return FALSE; }
	}

	public function get_all_asc($type = 'id',$limit = 10,$start = 0) {
		$d = ORM::for_table($this->_table)->where('is_deleted','0')
							->order_by_asc($type)
							->limit($limit)
							->offset($start)
							->find_many();

		if($d) { return $d; } else { return FALSE; }
	}

	public function get_all_table($t,$type = 'id') {
		$d = ORM::for_table($t)->where('is_deleted','0')
							->where('status','active')
							->order_by_asc($type)
							->find_many();

		if($d) { return $d; } else { return FALSE; }
	}

	public function get($id) {
		$d = ORM::for_table($this->_table)
							->where('id',$id)
							->find_one();

		if($d) { return $d; } else { return FALSE; }
	}

	public function get_count() {
		$d = ORM::for_table($this->_table)
			
				->where('is_deleted','0')
				->count();
		if($d) { return $d; } else { return FALSE; }
	}

	public function get_inspector_list() {
		$d = ORM::for_table('sam_users')->select(['id','first_name','last_name'])
				->where('role','2')->where('status','active')
				->where('is_deleted','0')->find_many();
		if($d) { return $d; } else { return FALSE; }
	}

	public function get_customer_list() {
		$d = ORM::for_table('sam_customers')->select(['id','organization_name'])
				->where('status','active')
				->where('is_deleted','0')->find_many();
		if($d) { return $d; } else { return FALSE; }
	}
}