<?php
class Model_other extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	// place
	function get_place(){
		$this->db->where("place_id", '1');
		$query = $this->db->get("ci_place");
		return $query->row();	
	}
	
	function update_place($data){
		$this->db->where('place_id', '1');
		$this->db->update('ci_place', $data);
	}
	// end place
}