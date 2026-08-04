<?php
class Model_config_email extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_single(){
		$this->db->where("config_email_id", '1');
		$query = $this->db->get("ci_config_email");
		return $query->row();	
	}
	
	function update_data($data){
		$this->db->where('config_email_id', '1');
		$this->db->update('ci_config_email', $data);
	}
	
}