<?php
class Model_member extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_list(){		
		$this->db->order_by("member_id","asc");
		$query = $this->db->get("ci_member");
			
		return $query->result();
	}
	
	function insert_data($data){
		$this->db->insert('ci_member', $data); 
	}
	
	function get_data_single($id){
		$this->db->where("member_id", $id);
		$query = $this->db->get("ci_member");
		return $query->row();	
	}
	
	function update_data($data,$id){
		$this->db->where('member_id', $id);
		$this->db->update('ci_member', $data);
	}
	
	function delete_data($val){
		$this->db->where_in('member_id', $val);
		return $this->db->delete('ci_member');
	}

	public function getMemberAddressShipping($member_id) {
		$this->db->where('member_id', $member_id);
		$query = $this->db->get('ci_member_shipping_address');

		return $query->row();
	}

	public function getMemberBilling($member_id) {
		$this->db->where('member_id', $member_id);
		$query = $this->db->get('ci_member_billing');

		return $query->row();
	}

	public function getWishlistResult($member_id) {
		$this->db->order_by('ci_wishlist.wishlist_id', 'desc');
		$this->db->where('ci_wishlist.member_id', $member_id);
		$this->db->join('ci_product', 'ci_wishlist.product_id = ci_product.product_id', 'inner');
		$query = $this->db->get('ci_wishlist');

		return $query->result();
	}
}