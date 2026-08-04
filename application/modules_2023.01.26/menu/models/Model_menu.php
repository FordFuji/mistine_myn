<?php
class Model_menu extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	function get_data_list(){		
		$this->db->order_by("menu_sort","asc");
		$query = $this->db->get("menu");
			
		return $query->result();
	}
	
	function insert_data($data){
		$this->db->insert('menu', $data); 
	}
	
	function get_data_single($id){
		$this->db->where("menu_id",$id);
		$query = $this->db->get("menu");
		return $query->row();	
	}
	
	function update_data($data,$id){
		$this->db->where('menu_id',$id);
		$this->db->update('menu',$data);
	}
	
	function delete_data($val){
		$this->db->where_in('menu_id',$val);
		return $this->db->delete('menu');
		return TRUE;
	}
	
	function get_department_list() {
		$this->db->order_by('department_id', 'asc');
		$query = $this->db->get('department');
		
		return $query->result();
	}
}
?>