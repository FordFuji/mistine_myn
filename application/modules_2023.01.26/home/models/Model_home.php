<?php
class Model_home extends CI_Model {

	function __construct() {
		parent::__construct();
        $this->load->database();	
	}

	// banner_slide	
	function insert_banner_slide($data){
		$this->db->insert('ci_banner_slide', $data); 
	}
	
	function get_banner_slide_single($id){
		$this->db->where("banner_slide_id", $id);
		$query = $this->db->get("ci_banner_slide");
		return $query->row();	
	}
	
	function update_banner_slide($data,$id){
		$this->db->where('banner_slide_id', $id);
		$this->db->update('ci_banner_slide', $data);
	}
	
	function delete_banner_slide($val){
		$this->db->where_in('banner_slide_id', $val);
		return $this->db->delete('ci_banner_slide');
	}
	// end banner_slide

	// tel_social_network
	function get_tel_social_network_single(){
		$this->db->where("tel_social_network_id", 1);
		$query = $this->db->get("ci_tel_social_network");
		return $query->row();	
	}
	
	function update_tel_social_network($data){
		$this->db->where('tel_social_network_id', 1);
		$this->db->update('ci_tel_social_network', $data);
	}
	// end tel_social_network

	// promotion_banner	
	function insert_promotion_banner($data){
		$this->db->insert('ci_promotion_banner', $data); 
	}
	
	function get_promotion_banner_single($id){
		$this->db->where("promotion_banner_id", $id);
		$query = $this->db->get("ci_promotion_banner");
		return $query->row();	
	}
	
	function update_promotion_banner($data,$id){
		$this->db->where('promotion_banner_id', $id);
		$this->db->update('ci_promotion_banner', $data);
	}
	
	function delete_promotion_banner($val){
		$this->db->where_in('promotion_banner_id', $val);
		return $this->db->delete('ci_promotion_banner');
	}
	// end promotion_banner

}