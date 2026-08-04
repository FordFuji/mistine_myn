<?php
class Model_rate_shipping extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_list(){		
		$this->db->order_by("rate_shipping_id","asc");
		$query = $this->db->get("ci_rate_shipping");
			
		return $query->result();
	}
	
	function insert_data($data){
		$this->db->insert('ci_rate_shipping', $data); 
	}
	
	function get_data_single($id){
		$this->db->where("rate_shipping_id", $id);
		$query = $this->db->get("ci_rate_shipping");
		return $query->row();	
	}
	
	function update_data($data,$id){
		$this->db->where('rate_shipping_id', $id);
		$this->db->update('ci_rate_shipping', $data);
	}
	
	function delete_data($val){
		$this->db->where_in('rate_shipping_id', $val);
		return $this->db->delete('ci_rate_shipping');
	}
	
}