<?php
class Model_payment extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_list(){		
		$this->db->order_by("payment_id","asc");
		$query = $this->db->get("ci_payment");
			
		return $query->result();
	}
	
	function insert_data($data){
		$this->db->insert('ci_payment', $data); 
	}
	
	function get_data_single($id){
		$this->db->where("payment_id", $id);
		$query = $this->db->get("ci_payment");
		return $query->row();	
	}
	
	function update_data($data,$id){
		$this->db->where('payment_id', $id);
		$this->db->update('ci_payment', $data);
	}
	
	function delete_data($val){
		$this->db->where_in('payment_id', $val);
		return $this->db->delete('ci_payment');
	}
}