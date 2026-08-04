<?php
class Model_news_promotions extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	function get_data_list(){		
		$this->db->order_by("news_promotions_id","asc");
		$query = $this->db->get("ci_news_promotions");
			
		return $query->result();
	}
	
	function insert_data($data){
		$this->db->insert('ci_news_promotions', $data); 
	}
	
	function get_data_single($id){
		$this->db->where("news_promotions_id", $id);
		$query = $this->db->get("ci_news_promotions");
		return $query->row();	
	}
	
	function update_data($data,$id){
		$this->db->where('news_promotions_id', $id);
		$this->db->update('ci_news_promotions', $data);
	}
	
	function delete_data($val){
		$this->db->where_in('news_promotions_id', $val);
		return $this->db->delete('ci_news_promotions');
	}
	
	function getNewsPromotionsID() {
		$this->db->order_by('news_promotions_id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('ci_news_promotions');

		$row = $query->row();

		if(!empty($row)) {
			return $row->news_promotions_id;
		}
	}

	function getNewsPromotionsGallery($news_promotions_id) {
		$this->db->order_by('news_promotions_gallery_id', 'asc');
		$this->db->where('news_promotions_id', $news_promotions_id);
		$query = $this->db->get('ci_news_promotions_gallery');

		return $query->result();
	}
}