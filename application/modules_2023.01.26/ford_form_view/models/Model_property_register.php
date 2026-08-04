<?php
class Model_property_register extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_list(){		
		$this->db->order_by("property_register_id","asc");
		$query = $this->db->get("ci_property_register");
			
		return $query->result();
	}
	
	function insert_data($data){
		$this->db->insert('ci_property_register', $data); 
	}
	
	function get_data_single($id){
		$this->db->where("ci_property_register.property_register_id", $id);
		$this->db->join('ci_type', 'ci_property_register.type_id = ci_type.type_id', 'inner');
		$query = $this->db->get("ci_property_register");
		return $query->row();	
	}
	
	function update_data($data,$id){
		$this->db->where('property_register_id', $id);
		$this->db->update('ci_property_register', $data);
	}
	
	function delete_data($val){
		$this->db->where_in('property_register_id', $val);
		return $this->db->delete('ci_property_register');
	}
	
	function get_property_register_last_id() {
		$this->db->order_by('property_register_id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('ci_property_register');
		
		return $query->row();
	}
	
	function getGalleryList($property_register_id) {
		$this->db->order_by('property_register_gallery_id', 'asc');
		$this->db->where('property_register_id', $property_register_id);
		$query = $this->db->get('ci_property_register_gallery');
		
		return $query->result();
	}
	
	function getRegisterUnitList($property_register_id) {
		$this->db->order_by('ci_units_features.units_features_id', 'asc');
		$this->db->where('ci_property_register_unit.property_register_id', $property_register_id);
		$this->db->join('ci_units_features', 'ci_property_register_unit.units_features_id = ci_units_features.units_features_id', 'inner');
		$query = $this->db->get('ci_property_register_unit');
		
		return $query->result();
	}
	
	function getRegisterProjectList($property_register_id) {
		$this->db->order_by('ci_project_facilities.project_facilities_id', 'asc');
		$this->db->where('ci_property_register_project.property_register_id', $property_register_id);
		$this->db->join('ci_project_facilities', 'ci_property_register_project.project_facilities_id = ci_project_facilities.project_facilities_id', 'inner');
		$query = $this->db->get('ci_property_register_project');
		
		return $query->result();
	}
	
	function getRegisterGalleryList($property_register_id) {
		$this->db->order_by('ci_property_register_gallery.property_register_gallery_id', 'asc');
		$this->db->where('ci_property_register_gallery.property_register_id', $property_register_id);
		$query = $this->db->get('ci_property_register_gallery');
		return $query->result();
	}
}