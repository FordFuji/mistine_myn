<?php
class Model_master_page extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_single(){
		$this->db->where("master_page_id", '1');
		$query = $this->db->get("ci_master_page");
		return $query->row();	
	}
	
	function update_data($data){
		$this->db->where('master_page_id', '1');
		$this->db->update('ci_master_page', $data);
	}
	
}