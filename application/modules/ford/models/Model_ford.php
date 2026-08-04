<?php
class Model_ford extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_list(){		
		$this->db->order_by("ford_id","asc");
		$query = $this->db->get("ci_ford");
			
		return $query->result();
	}
	
	function insert_data($data){
		$this->db->insert('ci_ford', $data); 
	}
	
	function get_data_single($id){
		$this->db->where("ford_id", $id);
		$query = $this->db->get("ci_ford");
		return $query->row();	
	}
	
	function update_data($data,$id){
		$this->db->where('ford_id', $id);
		$this->db->update('ci_ford', $data);
	}
	
	function delete_data($val){
		$this->db->where_in('ford_id', $val);
		return $this->db->delete('ci_ford');
	}
	
	function getProfileList() {
		$this->db->order_by('profile_id', 'asc');
		$query = $this->db->get('profile');
		
		return $query->result();
	}
}