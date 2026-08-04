<?php
class Model_coupon extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_list(){		
		$this->db->order_by("coupon_id","asc");
		$query = $this->db->get("ci_coupon");
			
		return $query->result();
	}
	
	function insert_data($data){
		$this->db->insert('ci_coupon', $data); 
	}
	
	function get_data_single($id){
		$this->db->where("coupon_id", $id);
		$query = $this->db->get("ci_coupon");
		return $query->row();	
	}
	
	function update_data($data,$id){
		$this->db->where('coupon_id', $id);
		$this->db->update('ci_coupon', $data);
	}
	
	function delete_data($val){
		$this->db->where_in('coupon_id', $val);
		return $this->db->delete('ci_coupon');
	}
}