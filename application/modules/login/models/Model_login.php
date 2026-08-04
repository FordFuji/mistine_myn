<?php
class Model_login extends CI_Model
{
	function __construct() {
		$this->load->database();
	}
	
	public function chk_password_admin($user, $pass) {
		$this->db->where('user_username', $user);
		$this->db->where('user_password', $pass);
		$this->db->where('user_activated', 1);
        $query = $this->db->get('user');
		
		return $query->row();
	}
	
	public function checkUpdateExpireDate() {
		$this->db->order_by('document_id', 'asc');
		$this->db->where('document_expire_date <', date('Y-m-d'));
		$this->db->where('document_archive', 'No');
		$this->db->where('document_recycle_bin', 'No');
		$query = $this->db->get('ci_document');
		
		return $query->result();
	}
	
	public function getProductList() {
		$this->db->order_by('ci_product.product_sort', 'asc');
		$this->db->order_by('ci_product.product_id', 'asc');
		$this->db->where('ci_product.product_enable', '1');
		$this->db->join('ci_product_stock', 'ci_product.product_id = ci_product_stock.product_id', 'inner');
		$this->db->join('ci_brand', 'ci_product.brand_id = ci_brand.brand_id', 'inner');
		$this->db->group_by('ci_product.product_id');
		$query = $this->db->get('ci_product');
		
		return $query->result();
	}
	
	function randomProduct() {
		/* ไม่ใช้แล้ว
		$this->db->where('random_date_product_id', '1');
		$this->db->where('random_date_product_random !=', date('Y-m-d'));
		$query = $this->db->get('ci_random_date_product');
		
		$row = $query->row();
		
		// วันไม่ตรง ให้ Random
		if(!empty($row)) {
		*/
			$this->db->order_by('product_id', 'RANDOM');
			$query = $this->db->get('ci_product');
			
			$rows = $query->result();
			
			if(!empty($rows)) {
				$i = 0;
				foreach($rows as $r) {
					$data = array(
						'product_random' => $i
					);
					
					$where = array(
						'product_id' => $r->product_id
					);
					
					$this->db->update('ci_product', $data, $where);
					
					$i++;
				}
				
				$data_date = array(
					'random_date_product_random' => date('Y-m-d')
				);
				
				$where_date = array(
					'random_date_product_id' => '1'
				);
				
				$this->db->update('ci_random_date_product', $data_date, $where_date);
			}
		//}
	}
}
?>