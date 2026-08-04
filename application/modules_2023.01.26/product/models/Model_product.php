<?php
class Model_product extends CI_Model {

	function __construct() {
		parent::__construct();
        $this->load->database();	
	}

	// category1	
	function insert_category1($data){
		$this->db->insert('ci_category1', $data); 
	}
	
	function get_category1_single($id){
		$this->db->where("category1_id", $id);
		$query = $this->db->get("ci_category1");
		return $query->row();	
	}
	
	function update_category1($data,$id){
		$this->db->where('category1_id', $id);
		$this->db->update('ci_category1', $data);
	}
	
	function delete_category1($val){
		$this->db->where_in('category1_id', $val);
		return $this->db->delete('ci_category1');
	}
	// end category1

	// category2	
	function insert_category2($data){
		$this->db->insert('ci_category2', $data); 
	}
	
	function get_category2_single($id){
		$this->db->where("category2_id", $id);
		$query = $this->db->get("ci_category2");
		return $query->row();	
	}
	
	function update_category2($data,$id){
		$this->db->where('category2_id', $id);
		$this->db->update('ci_category2', $data);
	}
	
	function delete_category2($val){
		$this->db->where_in('category2_id', $val);
		return $this->db->delete('ci_category2');
	}

	function getCategory1Result() {
		$this->db->order_by('category1_id', 'asc');
		$query = $this->db->get('ci_category1');

		return $query->result();
	}
	// end category2

	// category3	
	function insert_category3($data){
		$this->db->insert('ci_category3', $data); 
	}
	
	function get_category3_single($id){
		$this->db->where("ci_category3.category3_id", $id);
		$this->db->join("ci_category2", "ci_category3.category2_id = ci_category2.category2_id", "inner");
		$query = $this->db->get("ci_category3");
		return $query->row();	
	}
	
	function update_category3($data,$id){
		$this->db->where('category3_id', $id);
		$this->db->update('ci_category3', $data);
	}
	
	function delete_category3($val){
		$this->db->where_in('category3_id', $val);
		return $this->db->delete('ci_category3');
	}

	function getCategory2Result($category1_id) {
		$this->db->where('category1_id', $category1_id);
		$this->db->order_by('category2_id', 'asc');
		$query = $this->db->get('ci_category2');

		return $query->result();
	}
	// end category3

	// weight	
	function insert_weight($data){
		$this->db->insert('ci_weight', $data); 
	}
	
	function get_weight_single($id){
		$this->db->where("weight_id", $id);
		$query = $this->db->get("ci_weight");
		return $query->row();	
	}
	
	function update_weight($data,$id){
		$this->db->where('weight_id', $id);
		$this->db->update('ci_weight', $data);
	}
	
	function delete_weight($val){
		$this->db->where_in('weight_id', $val);
		return $this->db->delete('ci_weight');
	}
	// end weight

	// color	
	function insert_color($data){
		$this->db->insert('ci_color', $data); 
	}
	
	function get_color_single($id){
		$this->db->where("color_id", $id);
		$query = $this->db->get("ci_color");
		return $query->row();	
	}
	
	function update_color($data,$id){
		$this->db->where('color_id', $id);
		$this->db->update('ci_color', $data);
	}
	
	function delete_color($val){
		$this->db->where_in('color_id', $val);
		return $this->db->delete('ci_color');
	}
	// end color

	// collection	
	function insert_collection($data){
		$this->db->insert('ci_collection', $data); 
	}
	
	function get_collection_single($id){
		$this->db->where("collection_id", $id);
		$query = $this->db->get("ci_collection");
		return $query->row();	
	}
	
	function update_collection($data,$id){
		$this->db->where('collection_id', $id);
		$this->db->update('ci_collection', $data);
	}
	
	function delete_collection($val){
		$this->db->where_in('collection_id', $val);
		return $this->db->delete('ci_collection');
	}
	// end collection

	// product	
	function insert_product($data){
		$this->db->insert('ci_product', $data); 
	}
	
	function get_product_single($id){
		$this->db->where("ci_product.product_id", $id);
		$this->db->join("ci_category3", "ci_product.category3_id = ci_category3.category3_id", "inner");
		$query = $this->db->get("ci_product");
		return $query->row();	
	}
	
	function update_product($data,$id){
		$this->db->where('product_id', $id);
		$this->db->update('ci_product', $data);
	}
	
	function delete_product($val){
		$this->db->where_in('product_id', $val);
		return $this->db->delete('ci_product');
	}

	function getCategory3Result($category2_id) {
		$this->db->where('category2_id', $category2_id);
		$this->db->order_by('category3_id', 'asc');
		$query = $this->db->get('ci_category3');

		return $query->result();
	}

	function getWeightResult() {
		$this->db->order_by('weight_id', 'asc');
		$query = $this->db->get('ci_weight');

		return $query->result();
	}

	function getProductIdLasted() {
		$this->db->order_by('product_id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('ci_product');

		return $query->row()->product_id;
	}

	function getWeightIDResult($product_id) {
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('ci_product_stock');

		return $query->result();
	}

	function getWeightProductResult($product_id) {
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('ci_map_weight');

		return $query->result();
	}

	function getProductGalleryResult($product_stock_id) {
		$this->db->order_by('product_gallery_sort', 'asc');
		$this->db->where('product_stock_id', $product_stock_id);
		$query = $this->db->get('ci_product_gallery');

		return $query->result();
	}

	function getProductGalleryResultLimit2($product_stock_id) {
		$this->db->order_by('product_gallery_id', 'asc');
		$this->db->limit(2);
		$this->db->where('product_stock_id', $product_stock_id);
		$query = $this->db->get('ci_product_gallery');

		return $query->result();
	}

	function getColorResult() {
		$this->db->order_by('color_id', 'asc');
		$query = $this->db->get('ci_color');

		return $query->result();
	}

	function getCollectionResult() {
		$this->db->order_by('collection_id', 'asc');
		$query = $this->db->get('ci_collection');

		return $query->result();
	}

	function getMapWeightColorCollection($product_id) {
		$this->db->where('ci_map_weight.product_id', $product_id);
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$query = $this->db->get('ci_map_weight');

		return $query->result();
	}
	// end product

	// gallery
	function getProductStockRecord($product_stock_id) {
		$this->db->where('product_stock_id', $product_stock_id);
		$query = $this->db->get('ci_product_stock');

		return $query->row();
	}
	// end gallery
}