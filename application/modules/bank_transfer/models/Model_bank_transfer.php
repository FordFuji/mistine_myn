<?php
class Model_bank_transfer extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}

	public function getBankDataResult() {
		$this->db->order_by('bank_transfer_id', 'asc');
		$this->db->limit(5);
		$query = $this->db->get('ci_bank_transfer');

		return $query->result();
	}
	
	function update_data($data, $bank_transfer_id){
		$this->db->where('bank_transfer_id', $bank_transfer_id);
		$this->db->update('ci_bank_transfer', $data);
	}
	
}