<?php
class Model_authentication extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->database();	
	}
	
	// department
	function get_department_list(){		
		$this->db->order_by("department_id","asc");
		$query = $this->db->get("department");
			
		return $query->result();
	}
	
	function insert_department($data){
		$this->db->insert('department', $data); 
	}
	
	function get_department_single($id){
		$this->db->where("department_id", $id);
		$query = $this->db->get("department");
		return $query->row();	
	}
	
	function update_department($data,$id){
		$this->db->where('department_id', $id);
		$this->db->update('department', $data);
	}
	
	function delete_department($val){
		$this->db->where_in('department_id', $val);
		return $this->db->delete('department');
	}
	// End department
	
	// permission
	function get_permission_list(){		
		$this->db->order_by("department_name","asc");
		$query = $this->db->get("department");
			
		return $query->result();
	}
	
	function insert_permission($data){
		$this->db->insert('department', $data); 
	}
	
	function get_permission_single($id){
		$this->db->where("department_id",$id);
		$query = $this->db->get("department");
		return $query->row();	
	}
	
	function update_permission($data, $id){
		$this->db->where('department_id', $id);
		$this->db->update('department', $data);
	}
	
	function delete_permission($val){
		$this->db->where_in('department_id',$val);
		return $this->db->delete('department');
		return TRUE;
	}
	
	function get_menu_list() {
		$this->db->order_by('menu_sort', 'asc');
		$this->db->where('menu_enable', '1');
		
		$query = $this->db->get('menu');
		
		return $query->result();
	}
	
	function get_sub_menu_list() {
		$this->db->order_by('sub_menu.sub_menu_sort', 'asc');
		$this->db->where('sub_menu.sub_menu_enable', '1');
		$this->db->join('menu', 'sub_menu.menu_id = menu.menu_id', 'inner');
		$query = $this->db->get('sub_menu');
		
		return $query->result();
	}

	function getMenuAndSubMenuList() {
		$this->db->order_by('sub_menu.sub_menu_sort', 'asc');
		$this->db->where('sub_menu.sub_menu_enable', '1');
		$this->db->where('menu.menu_enable', '1');
		$this->db->join('menu', 'sub_menu.menu_id = menu.menu_id', 'inner');
		$query = $this->db->get('sub_menu');
		
		return $query->result();
	}
	// End permission
	
	// user
	function get_user_list(){		
		$this->db->order_by("user_id","asc");
		$query = $this->db->get("user");
			
		return $query->result();
	}
	
	function insert_user($data){
		$this->db->insert('user', $data); 
	}
	
	function get_user_single($id){
		$this->db->where("user_id",$id);
		$query = $this->db->get("user");
		return $query->row();	
	}
	
	function update_user($data,$id){
		$this->db->where('user_id',$id);
		$this->db->update('user',$data);
	}
	
	function delete_user($val){
		$this->db->where_in('user_id',$val);
		return $this->db->delete('user');
		return TRUE;
	}
	
	function getBrandList() {
		$this->db->order_by('brand_id', 'asc');
		$query = $this->db->get('ci_brand');
		
		return $query->result();
	}
	// End user
}