<?php
class Model_about_us extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_single(){
		$this->db->where("about_us_id", '1');
		$query = $this->db->get("ci_about_us");
		return $query->row();	
	}
	
	function update_data($data){
		$this->db->where('about_us_id', '1');
		$this->db->update('ci_about_us', $data);
	}
	
}