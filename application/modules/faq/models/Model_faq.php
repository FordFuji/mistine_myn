<?php
class Model_faq extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_list(){		
		$this->db->order_by("faq_id","asc");
		$query = $this->db->get("ci_faq");
			
		return $query->result();
	}
	
	function insert_data($data){
		$this->db->insert('ci_faq', $data); 
	}
	
	function get_data_single($id){
		$this->db->where("faq_id", $id);
		$query = $this->db->get("ci_faq");
		return $query->row();	
	}
	
	function update_data($data,$id){
		$this->db->where('faq_id', $id);
		$this->db->update('ci_faq', $data);
	}
	
	function delete_data($val){
		$this->db->where_in('faq_id', $val);
		return $this->db->delete('ci_faq');
	}
}