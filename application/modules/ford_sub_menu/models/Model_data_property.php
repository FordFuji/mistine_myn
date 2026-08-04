<?php
class Model_data_property extends CI_Model {

	function __construct() {
		parent::__construct();
        $this->load->database();	
	}

	// units_features	
	function insert_units_features($data){
		$this->db->insert('ci_units_features', $data); 
	}
	
	function get_units_features_single($id){
		$this->db->where("units_features_id", $id);
		$query = $this->db->get("ci_units_features");
		return $query->row();	
	}
	
	function update_units_features($data,$id){
		$this->db->where('units_features_id', $id);
		$this->db->update('ci_units_features', $data);
	}
	
	function delete_units_features($val){
		$this->db->where_in('units_features_id', $val);
		return $this->db->delete('ci_units_features');
	}
	// end units_features

}