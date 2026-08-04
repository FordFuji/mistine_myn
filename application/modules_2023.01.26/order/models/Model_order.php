<?php
class Model_order extends CI_Model {

	function __construct() {
		parent::__construct();
        $this->load->database();	
	}

	// order detail
	function get_order_single($id){
		$this->db->where("order_detail_id", $id);
		$query = $this->db->get("ci_order_detail");
		return $query->row();	
	}

	function getProvinceRecord($province_id) {
		$this->db->where('province_id', $province_id);
		$query = $this->db->get('province');

		return $query->row()->province_name_lang1;
	}

	function getOrderResult($order_detail_id) {
		$this->db->where('order_detail_id', $order_detail_id);
		$this->db->order_by('order_id', 'asc');
		$query = $this->db->get('ci_order');

		return $query->result();
	}

	function getColorRecord($color_id) {
		$this->db->where('color_id', $color_id);
		$query = $this->db->get('ci_color');

		if(!empty($query->row()->color_name_lang1)) {
			return $query->row()->color_name_lang1;
		} else {
			return '-';
		}
	}

	function getWeightRecord($weight_id) {
		$this->db->where('weight_id', $weight_id);
		$query = $this->db->get('ci_weight');

		if(!empty($query->row()->weight_name_lang1)) {
			return $query->row()->weight_name_lang1;
		} else {
			return '-';
		}
	}

	function getCollectionRecord($collection_id) {
		$this->db->where('collection_id', $collection_id);
		$query = $this->db->get('ci_collection');

		if(!empty($query->row()->collection_name_lang1)) {
			return $query->row()->collection_name_lang1;
		} else {
			return '-';
		}
	}
	// end order detail

	public function getBankRecord($bank_transfer_id) {
		$this->db->where('bank_transfer_id', $bank_transfer_id);
		$query = $this->db->get('ci_bank_transfer');

		return $query->row();
	}

	public function getConfigEmailRecord() {
		$this->db->where('config_email_id', 1);
		$query = $this->db->get('ci_config_email');

		return $query->row();
	}
}