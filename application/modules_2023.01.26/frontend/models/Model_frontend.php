<?php
class Model_frontend extends CI_Model {
	
	public function __construct() {

		parent::__construct();

        $this->load->database();	
	}

	public function getBannerSlideResult() {
		$this->db->order_by('banner_slide_id', 'asc');
		$query = $this->db->get('ci_banner_slide');

		return $query->result();
	}

	public function getNewsAndPromotionsRecord() {
		$this->db->order_by('news_promotions_date', 'desc');
		$this->db->where('news_promotions_type', 'News');
		$this->db->limit(1, 0);
		$query = $this->db->get('ci_news_promotions');

		return $query->row();
	}

	public function getNewsAndPromotionSideRight() {
		$this->db->order_by('news_promotions_date', 'desc');
		$this->db->where('news_promotions_type', 'News');
		$this->db->limit(4, 1);
		$query = $this->db->get('ci_news_promotions');

		return $query->result();
	}

	public function getPromotionsResultAll() {
		$this->db->where('news_promotions_type', 'Promotions');
		$query = $this->db->get('ci_news_promotions');

		return $query->result();
	}

	public function getPromotionsResult($limit, $offset) {
		$this->db->limit($limit, $offset);
		$this->db->order_by('news_promotions_date', 'desc');
		$this->db->where('news_promotions_type', 'Promotions');
		$query = $this->db->get('ci_news_promotions');

		return $query->result();

	}

	public function getReadmoreNewRecord($news_promotions_id) {
		$this->db->where('news_promotions_id', $news_promotions_id);
		$query = $this->db->get('ci_news_promotions');

		return $query->row();
	}

	public function getGalleryResult($news_promotions_id) {
		$this->db->order_by('news_promotions_gallery_id', 'asc');
		$this->db->where('news_promotions_id', $news_promotions_id);
		$query = $this->db->get('ci_news_promotions_gallery');

		return $query->result();
	}

	public function getCategory1Result() {
		$this->db->order_by('category1_id', 'asc');
		$query = $this->db->get('ci_category1');

		return $query->result();
	}

	public function getCategory2Result($category1_id) {
		$this->db->order_by('category2_id', 'asc');
		$this->db->where('category1_id', $category1_id);
		$query = $this->db->get('ci_category2');

		return $query->result();
	}

	public function getCategory3Result($category2_id) {
		$this->db->order_by('category3_id', 'asc');
		$this->db->where('category2_id', $category2_id);
		$query = $this->db->get('ci_category3');

		return $query->result();
	}

	public function getProductCategory1ResultAll($category1_id) {
		if($this->input->get('type') == 'new') {
			$this->db->where('ci_product.product_new', 'Yes');
		} elseif($this->input->get('type') == 'bestsellers') {
			$this->db->where_in('ci_product.product_id', '(select product_id from ci_order co where co.product_id = ci_product.product_id and co.order_qty > 0)', false);
		}

		$this->db->select('distinct ci_product.product_id', false);
		$this->db->where('category1_id', $category1_id);
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product.product_id');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getProductCategory3ResultAll($category3_id) {
		if($this->input->get('type') == 'new') {
			$this->db->where('ci_product.product_new', 'Yes');
		} elseif($this->input->get('type') == 'bestsellers') {
			$this->db->where_in('ci_product.product_id', '(select product_id from ci_order co where co.product_id = ci_product.product_id and co.order_qty > 0)', false);
		}

		$this->db->select('distinct ci_product.product_id', false);
		$this->db->where('category3_id', $category3_id);
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product.product_id');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getProductCategory2ResultAll($category2_id) {
		if($this->input->get('type') == 'new') {
			$this->db->where('ci_product.product_new', 'Yes');
		} elseif($this->input->get('type') == 'bestsellers') {
			$this->db->where_in('ci_product.product_id', '(select product_id from ci_order co where co.product_id = ci_product.product_id and co.order_qty > 0)', false);
		}

		$this->db->where('ci_category3.category2_id', $category2_id);
		$this->db->select('distinct ci_product.product_id', false);
		//$this->db->where('category3_id', $category3_id);
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id', 'inner');
		$this->db->join('ci_category3', 'ci_product.category3_id = ci_category3.category3_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product.product_id');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getProductCategory3Result($category3_id, $limit, $offset) {
		if($this->input->get('type') == 'new') {
			$this->db->where('ci_product.product_new', 'Yes');
		} elseif($this->input->get('type') == 'bestsellers') {
			$this->db->where_in('ci_product.product_id', '(select product_id from ci_order co where co.product_id = ci_product.product_id and co.order_qty > 0)', false);
		}

		/*if($this->input->get('sort') != '') {
			if($this->input->get('sort') == 'price_z_a') {
				$this->db->order_by('product_price1', 'desc');
			} elseif($this->input->get('sort') == 'price_a_z') {
				$this->db->order_by('product_price1', 'asc');
			}
		} else {
			$this->db->order_by('ci_product.product_id', 'asc');
		}*/

		$this->db->limit($limit, $offset);
		$this->db->select('distinct ci_product.product_id, ci_product.product_new, ci_product.product_image, ci_product.product_name_lang1, ci_product.product_name_lang2, ci_product_stock.product_before_discount_price_type1, ci_product_stock.product_price1', false);
		$this->db->where('ci_product.category3_id', $category3_id);
		$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product.product_id');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getProductCategory1Result($category1_id, $limit, $offset) {
		if($this->input->get('type') == 'new') {
			$this->db->where('ci_product.product_new', 'Yes');
		} elseif($this->input->get('type') == 'bestsellers') {
			$this->db->where_in('ci_product.product_id', '(select product_id from ci_order co where co.product_id = ci_product.product_id and co.order_qty > 0)', false);
		}

		/*if($this->input->get('sort') != '') {
			if($this->input->get('sort') == 'price_z_a') {
				$this->db->order_by('product_price1', 'desc');
			} elseif($this->input->get('sort') == 'price_a_z') {
				$this->db->order_by('product_price1', 'asc');
			}
		} else {
			$this->db->order_by('ci_product.product_id', 'asc');
		}*/

		$this->db->limit($limit, $offset);
		$this->db->select('distinct ci_product.product_id, ci_product.product_new, ci_product.product_image, ci_product.product_name_lang1, ci_product.product_name_lang2, ci_product_stock.product_before_discount_price_type1, ci_product_stock.product_price1', false);
		$this->db->where('ci_product.category1_id', $category1_id);
		$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product.product_id');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getProductCategory2Result($category2_id, $limit, $offset) {
		if($this->input->get('type') == 'new') {
			$this->db->where('ci_product.product_new', 'Yes');
		} elseif($this->input->get('type') == 'bestsellers') {
			$this->db->where_in('ci_product.product_id', '(select product_id from ci_order co where co.product_id = ci_product.product_id and co.order_qty > 0)', false);
		}

		/*if($this->input->get('sort') != '') {
			if($this->input->get('sort') == 'price_z_a') {
				$this->db->order_by('product_price1', 'desc');
			} elseif($this->input->get('sort') == 'price_a_z') {
				$this->db->order_by('product_price1', 'asc');
			}
		} else {
			$this->db->order_by('ci_product.product_id', 'asc');
		}*/

		$this->db->limit($limit, $offset);
		$this->db->select('distinct ci_product.product_id, ci_product.product_new, ci_product.product_image, ci_product.product_name_lang1, ci_product.product_name_lang2, ci_product_stock.product_before_discount_price_type1, ci_product_stock.product_price1', false);
		$this->db->where('ci_category3.category2_id', $category2_id);
		$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id', 'inner');
		$this->db->join('ci_category3', 'ci_product.category3_id = ci_category3.category3_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product.product_id');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getProductNewResult() {
		$this->db->limit(8);
		$this->db->select('distinct ci_product_stock.product_stock_id, ci_product.product_id, ci_product.product_image, ci_product.product_name_lang1, ci_product.product_name_lang2, ci_product_stock.product_before_discount_price_type1, ci_product_stock.product_price1', false);
		//$this->db->order_by('ci_product.product_id', 'desc');
		$this->db->where('ci_product.product_new', 'Yes');
		$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product_stock.product_stock_id');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getProductSuggestResult() {
		$this->db->limit(8);
		//$this->db->order_by('ci_product.product_id', 'desc');
		$this->db->select('distinct ci_product_stock.product_stock_id, ci_product.product_id, ci_product.product_image, ci_product.product_name_lang1, ci_product.product_name_lang2, ci_product_stock.product_before_discount_price_type1, ci_product_stock.product_price1', false);
		$this->db->where('ci_product.product_suggest', 'Yes');
		$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product_stock.product_stock_id');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getProductDetail($product_id) {
		$this->db->select('distinct ci_product_stock.product_stock_id, ci_product_stock.product_before_discount_price_type1, ci_product_stock.product_price1, ci_product.product_name_lang1, ci_product.product_name_lang2, ci_map_weight.weight_id, ci_map_weight.color_id, ci_map_weight.collection_id, ci_product.product_image, ci_product.category3_id, ci_product.product_description_lang1, ci_product.product_description_lang2, ci_product_stock.product_code, ci_product.product_property_lang1, ci_product.product_property_lang2, ci_product.product_id, ci_product_stock.product_stock_amount, ci_product.product_id, ci_map_weight.weight_id', false);
		$this->db->where('ci_product.product_id', $product_id);
		$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product_stock.product_stock_id');
		$query = $this->db->get('ci_product');

		return $query->row();
	}

	public function getProductDetail1($product_id, $weight_id, $color_id, $collection_id) {
		$this->db->select('distinct ci_product_stock.product_stock_id, ci_product_stock.product_before_discount_price_type1, ci_product_stock.product_price1, ci_product.product_name_lang1, ci_product.product_name_lang2, ci_map_weight.weight_id, ci_map_weight.color_id, ci_map_weight.collection_id, ci_product.product_image, ci_product.category3_id, ci_product.product_description_lang1, ci_product.product_description_lang2, ci_product_stock.product_code, ci_product.product_property_lang1, ci_product.product_property_lang2, ci_product.product_id', false);
		$this->db->where('ci_product_stock.product_id', $product_id);
		$this->db->where('ci_product_stock.weight_id', $weight_id);
		$this->db->where('ci_product_stock.color_id', $color_id);
		$this->db->where('ci_product_stock.collection_id', $collection_id);
		//$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_product_stock.product_stock_id');
		$query = $this->db->get('ci_product');

		return $query->row();
	}

	public function getProductMapWeight($product_id) {
		$this->db->select('distinct ci_map_weight.weight_id, ci_weight.weight_name_lang1, ci_weight.weight_name_lang2', false);
		$this->db->where('ci_product.product_id', $product_id);
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.product_id = ci_product_stock.product_id', 'inner');
		$this->db->join('ci_weight', 'ci_map_weight.weight_id = ci_weight.weight_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_map_weight.weight_id');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getProductMapGallery($product_id) {
		$this->db->order_by('ci_map_weight.weight_id', 'asc');
		$this->db->where('ci_map_weight.product_id', $product_id);
		$this->db->where('ci_map_weight.weight_id !=', 0);
		$this->db->join('ci_product_stock', 'ci_map_weight.weight_id = ci_product_stock.weight_id', 'inner');
		$this->db->join('ci_product_gallery', 'ci_product_stock.product_stock_id = ci_product_gallery.product_stock_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		$query = $this->db->get('ci_map_weight');

		return $query->result();
	}

	public function getProductWeightLimit1($product_id) {
		$this->db->where('product_id', $product_id);
		$this->db->order_by('weight_id', 'asc');
		$this->db->limit(1);
		$query = $this->db->get('ci_map_weight');

		$row = $query->row();

		if(!empty($row)) {
			return $row->weight_id;
		}
	}

	public function getProductColorResult($product_id, $weight_id) {
		$this->db->select('distinct ci_map_weight.color_id, ci_color.color_name_lang1, ci_color.color_name_lang2, ci_color.color_image', false);
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->order_by('ci_color.color_id', 'asc');
		$this->db->where('ci_map_weight.product_id', $product_id);
		$this->db->where('ci_map_weight.weight_id', $weight_id);
		$this->db->join('ci_color', 'ci_map_weight.color_id = ci_color.color_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_map_weight.color_id');
		$query = $this->db->get('ci_map_weight');

		return $query->result();
	}

	public function getProductCollectionResult($product_id, $weight_id, $color_id) {
		$this->db->select('distinct ci_map_weight.collection_id, ci_map_weight.product_id, ci_collection.collection_name_lang1, ci_collection.collection_name_lang2', false);
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->order_by('ci_collection.collection_id', 'asc');
		$this->db->where('ci_map_weight.product_id', $product_id);
		$this->db->where('ci_map_weight.weight_id', $weight_id);
		$this->db->where('ci_map_weight.color_id', $color_id);
		$this->db->join('ci_collection', 'ci_map_weight.collection_id = ci_collection.collection_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		//$this->db->group_by('ci_map_weight.collection_id');
		$query = $this->db->get('ci_map_weight');

		return $query->result();
	}

	public function getGalleryFirstResult($product_id, $weight_id = '', $color_id = '', $collection_id = '') {
		if($weight_id == '') {
			$weight_id = 0;
		}

		if($color_id == '') {
			$color_id = 0;
		}

		if($collection_id == '') {
			$collection_id = 0;
		}

		$this->db->order_by('ci_product_gallery.product_gallery_sort', 'asc');
		$this->db->where('ci_map_weight.product_id', $product_id);
		$this->db->where('ci_map_weight.weight_id', $weight_id);
		$this->db->where('ci_map_weight.color_id', $color_id);
		$this->db->where('ci_map_weight.collection_id', $collection_id);
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->join('ci_product_gallery', 'ci_product_stock.product_stock_id = ci_product_gallery.product_stock_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		$query = $this->db->get('ci_map_weight');

		return $query->result();
	}

	public function getProductStock($product_id, $weight_id = '', $color_id = '', $collection_id = '') {
		if($weight_id == '') {
			$weight_id = 0;
		}

		if($color_id == '') {
			$color_id = 0;
		}

		if($collection_id == '') {
			$collection_id = 0;
		}

		$this->db->where('ci_map_weight.product_id', $product_id);
		$this->db->where('ci_map_weight.weight_id', $weight_id);
		$this->db->where('ci_map_weight.color_id', $color_id);
		$this->db->where('ci_map_weight.collection_id', $collection_id);
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		$query = $this->db->get('ci_map_weight');

		return $query->row();
	}

	public function getYouMayAlsoLikeResult($category3_id, $product_id) {
		$this->db->where('ci_product.category3_id', $category3_id);
		$this->db->where('ci_product.product_id !=', $product_id);
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		$query = $this->db->get('ci_product');

		return $query->result();
	}

	public function getMemberPersonal() {
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$query = $this->db->get('ci_member');

		return $query->row();
	}

	public function getMemberShippingAddress1() {
		$this->db->where('ci_member_shipping_address.member_id', $this->session->userdata('member_id'));
		$this->db->where('ci_member_shipping_address.member_shipping_active', 'Yes');
		$this->db->join('ci_member', 'ci_member_shipping_address.member_id = ci_member.member_id', 'inner');
		$query = $this->db->get('ci_member_shipping_address');

		return $query->row();
	}

	/*public function getMemberShippingAddress2() {
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$query = $this->db->get('ci_member_shipping_address2');

		return $query->row();
	}*/

	public function getShippingTownship($shipping_location) {
		$this->db->order_by('rate_shipping_township', 'asc');
		$this->db->where('rate_shipping_location', $shipping_location);
		$query = $this->db->get('ci_rate_shipping');

		return $query->result();
	}

	public function getMemberBillingAddress() {
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$query = $this->db->get('ci_member_billing');

		return $query->row();
	}

	public function getProvinceResult() {
		$this->db->order_by('province_id', 'asc');
		$query = $this->db->get('province');

		return $query->result();
	}

	public function getMemberShippingAddress() {
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$query = $this->db->get('ci_member_shipping_address');

		return $query->result();
	}

	public function getWishlist() {
		$this->db->where('ci_wishlist.member_id', $this->session->userdata('member_id'));
		$this->db->join('ci_product', 'ci_wishlist.product_id = ci_product.product_id', 'inner');

		$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		$query = $this->db->get('ci_wishlist');

		return $query->result();
	}

	public function getWishlistColor($product_id) {
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('ci_wishlist');

		return $query->row();
	}

	public function getTopRanking() {
		$this->db->order_by('sum_order_qty', 'desc');
		$this->db->limit(8, 0);
		$this->db->select('distinct ci_product.product_id, ci_product.product_image, ci_product.product_name_lang1, ci_product.product_name_lang2, ci_product_stock.product_before_discount_price_type1, ci_product_stock.product_price1, (select sum(co.order_qty) from ci_order co inner join ci_product cp on co.product_id = cp.product_id where ci_product.product_id = cp.product_id limit 1) as sum_order_qty', false);
		$this->db->where('ci_product_stock.product_stock_active', 'Yes');
		$this->db->join('ci_product', 'ci_order.product_id = ci_product.product_id', 'inner');
		$this->db->join('ci_map_weight', 'ci_product.product_id = ci_map_weight.product_id', 'inner');
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->where('ci_product_stock.product_stock_enable', 'Enable');
		
		$query = $this->db->get('ci_order');

		return $query->result();
	}

	public function getFAQResult() {
		$this->db->order_by('faq_id', 'asc');
		$query = $this->db->get('ci_faq');

		return $query->result();
	}

	public function getAddressMember() {
		$this->db->where('ci_member_shipping_address.member_id', $this->session->userdata('member_id'));
		$this->db->where('ci_member_shipping_address.member_shipping_active', 'Yes');
		$this->db->join('ci_member', 'ci_member_shipping_address.member_id = ci_member.member_id', 'inner');
		$query = $this->db->get('ci_member_shipping_address');

		return $query->row();
	}

	public function getShippingAddressMember() {
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$query = $this->db->get('ci_member_shipping_address');

		return $query->row();
	}

	public function genOrderNo() {
		$year = date('Y');

		$year_month = substr($year, 2, 2).date('m');

		$this->db->order_by('order_detail_id', 'desc');
		$this->db->limit(1);
		$this->db->like('order_no', $year_month, 'after');
		$query = $this->db->get('ci_order_detail');

		$row = $query->row();

		if(!empty($row)) {
			$order_no = substr($row->order_no, 4, 5);
			$order_no++;

			if(strlen($order_no) == 5) {
				$order_no_ = $year_month.$order_no;
			} elseif(strlen($order_no) == 4) {
				$order_no_ = $year_month.'0'.$order_no;
			} elseif(strlen($order_no) == 3) {
				$order_no_ = $year_month.'00'.$order_no;
			} elseif(strlen($order_no) == 2) {
				$order_no_ = $year_month.'000'.$order_no;
			} elseif(strlen($order_no) == 1) {
				$order_no_ = $year_month.'0000'.$order_no;
			}

			return $order_no_;
		} else {
			return $year_month.'00001';
		}
	}

	public function getOrderDetailRecord($order_detail_id) {
		$this->db->order_by('ci_order.order_id', 'asc');
		$this->db->limit(1);
		$this->db->where('ci_order_detail.order_detail_id', $order_detail_id);
		$this->db->join('ci_order', 'ci_order_detail.order_detail_id = ci_order.order_detail_id', 'inner');
		$query = $this->db->get('ci_order_detail');

		return $query->row();
	}

	public function getAverageStar($product_id) {
		$this->db->select('avg(review_star) as avg_star');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('ci_review');

		return $query->row()->avg_star;
	}

	public function getStar5($product_id) {
		$this->db->select('count(review_star) as count_star5');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 5);
		$query = $this->db->get('ci_review');

		return $query->row()->count_star5;
	}

	public function getStar4($product_id) {
		$this->db->select('count(review_star) as count_star4');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 4);
		$query = $this->db->get('ci_review');

		return $query->row()->count_star4;
	}

	public function getStar3($product_id) {
		$this->db->select('count(review_star) as count_star3');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 3);
		$query = $this->db->get('ci_review');

		return $query->row()->count_star3;
	}

	public function getStar2($product_id) {
		$this->db->select('count(review_star) as count_star2');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 2);
		$query = $this->db->get('ci_review');

		return $query->row()->count_star2;
	}

	public function getStar1($product_id) {
		$this->db->select('count(review_star) as count_star1');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 1);
		$query = $this->db->get('ci_review');

		return $query->row()->count_star1;
	}

	public function getReview($product_id) {
		$this->db->select('count(review_star) as count_review');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('ci_review');

		return $query->row()->count_review;
	}

	public function getReviewImageGallery($product_id) {
		$this->db->select('count(ci_review_gallery.review_gallery_id) as count_gallery');
		$this->db->where('ci_review.product_id', $product_id);
		$this->db->join('ci_review', 'ci_review_gallery.review_id = ci_review.review_id', 'inner');
		$query = $this->db->get('ci_review_gallery');

		return $query->row()->count_gallery;
	}

	public function getReviewAll($product_id) {
		$this->db->order_by('review_id', 'desc');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('ci_review');

		return $query->result();
	}

	public function getCategory1($product_id) {
		$this->db->where('ci_product.product_id', $product_id);
		$this->db->join('ci_category1', 'ci_product.category1_id = ci_category1.category1_id', 'inner');
		$query = $this->db->get('ci_product');

		$row = $query->row();

		if(!empty($row)) {
			return get2Lang($this->session->userdata('lang'), $row->category1_name_lang1, $row->category1_name_lang2);
		}
	}

	public function getReviewGallery($review_id) {
		$this->db->order_by('review_gallery_id', 'asc');
		$this->db->where('review_id', $review_id);
		$query = $this->db->get('ci_review_gallery');

		return $query->result();
	}

	public function getReviewStar5($product_id) {
		$this->db->order_by('review_id', 'desc');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 5);
		$query = $this->db->get('ci_review');

		return $query->result();
	}

	public function getReviewStar4($product_id) {
		$this->db->order_by('review_id', 'desc');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 4);
		$query = $this->db->get('ci_review');

		return $query->result();
	}

	public function getReviewStar3($product_id) {
		$this->db->order_by('review_id', 'desc');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 3);
		$query = $this->db->get('ci_review');

		return $query->result();
	}

	public function getReviewStar2($product_id) {
		$this->db->order_by('review_id', 'desc');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 2);
		$query = $this->db->get('ci_review');

		return $query->result();
	}

	public function getReviewStar1($product_id) {
		$this->db->order_by('review_id', 'desc');
		$this->db->where('product_id', $product_id);
		$this->db->where('review_star', 1);
		$query = $this->db->get('ci_review');

		return $query->result();
	}

	public function getReviewGalleryResult($product_id) {
		$this->db->where('ci_review.product_id', $product_id);
		$this->db->order_by('ci_review_gallery.review_gallery_id', 'desc');
		$this->db->join('ci_review_gallery', 'ci_review.review_id = ci_review_gallery.review_id', 'inner');
		$query = $this->db->get('ci_review');

		return $query->result();
	}

	public function getBankTransfer() {
		$this->db->where('bank_transfer_name_lang1 !=', '');
		$this->db->where('bank_transfer_name_lang2 !=', '');
		$query = $this->db->get('ci_bank_transfer');

		return $query->result();
	}

	public function getLinkSocial() {
		$this->db->where('tel_social_network_id', 1);
		$query = $this->db->get('ci_tel_social_network');

		return $query->row();
	}

	public function getBankRecord() {
		$this->db->where('bank_transfer_id', $this->session->userdata('order_detail_bank'));
		$query = $this->db->get('ci_bank_transfer');

		return $query->row();
	}

	public function getProductFirstCategory3() {
		$this->db->order_by('category3_id', 'asc');
		$this->db->limit(1);
		$query = $this->db->get('ci_category3');
		
		return $query->row();
	}

	public function getCategory3ByCategory1($category1_id) {
		$this->db->order_by('ci_category3.category3_id', 'asc');
		$this->db->limit(1);
		$this->db->where('ci_category1.category1_id', $category1_id);
		$this->db->join('ci_category2', 'ci_category3.category2_id = ci_category2.category2_id', 'inner');
		$this->db->join('ci_category1', 'ci_category2.category1_id = ci_category1.category1_id', 'inner');
		$query = $this->db->get('ci_category3');

		return $query->row();
	}

	public function getOrderDetailResult() {
		if($this->input->post('order_no') != '') {
			$this->db->like('ci_order_detail.order_no', $this->input->post('order_no'), 'match');
		}

		$this->db->where('ci_order_detail.member_id', $this->session->userdata('member_id'));
		$this->db->join('ci_order', 'ci_order_detail.order_detail_id = ci_order.order_detail_id', 'inner');
		$query = $this->db->get('ci_order_detail');

		return $query->result();
	}

	public function getAvgStar($product_id) {
		$this->db->select('avg(review_star) as avg_star');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('ci_review');

		if($query->row()->avg_star == null) {
			return 5;
		} else {
			return $query->row()->avg_star;
		}
	}

	public function getNoAmount($product_id) {
		$this->db->select('sum(order_qty) as qty');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('ci_order');

		return $query->row()->qty;
	}

	public function getConfigEmailRecord() {
		$this->db->where('config_email_id', 1);
		$query = $this->db->get('ci_config_email');

		return $query->row();
	}

	public function getCancelResult() {
		$this->db->order_by('order_detail_id', 'desc');
		$this->db->where('ci_order_detail.member_id', $this->session->userdata('member_id'));
		$this->db->where('(ci_order_detail.order_detail_status = "Order" or ci_order_detail.order_detail_status = "Processing" or ci_order_detail.order_detail_status = "Shipped")');

		$query = $this->db->get('ci_order_detail');

		return $query->result();
	}

	public function getCancelOrderResult($order_detail_id) {
		$this->db->where('order_detail_id', $order_detail_id);
		$this->db->order_by('order_id', 'asc');
		$query = $this->db->get('ci_order');

		return $query->result();
	}

	public function getCancelByCICancel($order_detail_id) {
		$this->db->where('ci_cancel.member_id', $this->session->userdata('member_id'));
		$this->db->where('ci_cancel.order_detail_id', $order_detail_id);
		//$this->db->join('ci_order', 'ci_cancel.order_id = ci_order.order_id', 'inner');
		$this->db->join('ci_order_detail', 'ci_cancel.order_detail_id = ci_order_detail.order_detail_id', 'inner');
		$query = $this->db->get('ci_cancel');

		return $query->row();
	}

	public function getWeightRecord($weight_id) {
		$this->db->where('weight_id', $weight_id);
		$query = $this->db->get('ci_weight');

		return $query->row();
	}

	public function getColorRecord($color_id) {
		$this->db->where('color_id', $color_id);
		$query = $this->db->get('ci_color');

		return $query->row();
	}

	public function getCollectionRecord($collection_id) {
		$this->db->where('collection_id', $collection_id);
		$query = $this->db->get('ci_collection');

		return $query->row();
	}

	public function getReasonCancelRecord() {
		$this->db->where('reason_cancel_id', 1);
		$query = $this->db->get('ci_reason_cancel');

		return $query->row();
	}

	public function getOrderIdExplode($order_detail_id) {
		$this->db->where('order_detail_id', $order_detail_id);
		$query = $this->db->get('ci_order');

		$rows = $query->result();

		$exp = '';

		if(!empty($rows)) {
			foreach($rows as $r) {
				$exp .= $r->order_detail_id.'&*(';
			}
		}

		if($exp != '') {
			$exp = substr($exp, 0, -3);
		}

		return $exp;
	}

	public function getOrderCancelResult() {
		$this->db->where('ci_cancel.member_id', $this->session->userdata('member_id'));
		$this->db->join('ci_order', 'ci_cancel.order_id = ci_order.order_id', 'inner');
		$this->db->join('ci_order_detail', 'ci_order.order_detail_id = ci_order_detail.order_detail_id', 'inner');
		$query = $this->db->get('ci_cancel');

		return $query->result();
	}

	public function getOrderReturnResult() {
		$this->db->order_by('order_detail_id', 'desc');
		$this->db->where('ci_order_detail.member_id', $this->session->userdata('member_id'));
		$this->db->where('(ci_order_detail.order_detail_status = "Delivery" or ci_order_detail.order_detail_status = "Complete")');

		$query = $this->db->get('ci_order_detail');

		return $query->result();
	}

	public function getOrderItemReturnResult($order_detail_id) {
		$this->db->order_by('order_id', 'asc');
		$this->db->where('order_detail_id', $order_detail_id);
		$query = $this->db->get('ci_order');

		return $query->result();
	}

	public function getLocationShip() {
		$this->db->select('distinct ci_rate_shipping.rate_shipping_location', false);
		$this->db->order_by('rate_shipping_location', 'asc');
		//$this->db->group_by('rate_shipping_location');
		$query = $this->db->get('ci_rate_shipping');

		return $query->result();
	}

	public function getShippingLocation() {
		$this->db->select('distinct ci_rate_shipping.rate_shipping_location', false);
		$this->db->order_by('rate_shipping_location', 'asc');
		$query = $this->db->get('ci_rate_shipping');

		return $query->result();
	}

	public function getProductSingle($product_id) {
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('ci_product');

		return $query->row();
	}

	public function getMasterPageRecord() {
		$this->db->where('master_page_id', 1);
		$query = $this->db->get('ci_master_page');

		return $query->row();
	}

	public function getCategoryVoucherActive() {
		$this->db->where('category_voucher_active', 'Yes');
		$query = $this->db->get('ci_category_voucher');

		return $query->row();
	}

	public function getVoucherResult() {
		$this->db->order_by('voucher_id', 'asc');
		$this->db->where('category_voucher_id', $this->session->userdata('category_voucher_id'));
		$this->db->where('voucher_stock >', 0);
		$this->db->where('voucher_expired_date >=', date('Y-m-d'));
		$query = $this->db->get('ci_voucher');

		return $query->result();
	}

	public function getCategoryVoucherSessionResult() {
		$this->db->where('category_voucher_id', $this->session->userdata('category_voucher_id'));
		$query = $this->db->get('ci_category_voucher');

		return $query->row();
	}

	public function getMemberVoucher($type) {
		$this->db->where('ci_map_voucher.member_id', $this->session->userdata('member_id'));
		$this->db->where('ci_map_voucher.map_voucher_valid_or_use', $type);
		$this->db->join('ci_voucher', 'ci_map_voucher.voucher_id = ci_voucher.voucher_id', 'inner');
		$query = $this->db->get('ci_map_voucher');

		return $query->result();
	}

	public function getOrderIdCancel($order_id) {
		$this->db->where('order_id', $order_id);
		$query = $this->db->get('ci_order');

		return $query->row();
	}

	public function getPromotionBannerList() {
		$this->db->order_by('promotion_banner_id', 'asc');
		$query = $this->db->get('ci_promotion_banner');

		return $query->result();
	}
}