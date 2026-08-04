<?php
class Model_voucher extends CI_Model {

	function __construct() {
		parent::__construct();
        $this->load->database();	
	}

	// category_voucher	
	function insert_category_voucher($data){
		$this->db->insert('ci_category_voucher', $data); 
	}
	
	function get_category_voucher_single($id){
		$this->db->where("category_voucher_id", $id);
		$query = $this->db->get("ci_category_voucher");
		return $query->row();	
	}
	
	function update_category_voucher($data,$id){
		$this->db->where('category_voucher_id', $id);
		$this->db->update('ci_category_voucher', $data);
	}
	
	function delete_category_voucher($val){
		$this->db->where_in('category_voucher_id', $val);
		return $this->db->delete('ci_category_voucher');
	}
	// end category_voucher

	// voucher	
	function insert_voucher($data){
		$this->db->insert('ci_voucher', $data); 
	}
	
	function get_voucher_single($id){
		$this->db->where("voucher_id", $id);
		$query = $this->db->get("ci_voucher");
		return $query->row();	
	}
	
	function update_voucher($data,$id){
		$this->db->where('voucher_id', $id);
		$this->db->update('ci_voucher', $data);
	}
	
	function delete_voucher($val){
		$this->db->where_in('voucher_id', $val);
		return $this->db->delete('ci_voucher');
	}

	function getCategoryVoucherResult() {
		$this->db->order_by('category_voucher_id', 'asc');
		$query = $this->db->get('ci_category_voucher');

		return $query->result();
	}
	// end voucher

}