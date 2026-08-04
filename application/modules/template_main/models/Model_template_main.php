<?php
class Model_template_main extends CI_Model
{
	public function __construct()
	{
		$this->load->helper('url');
		$this->load->database();
	}
	
	public function get_uri() {
		return '1';
	}
	
	public function get_uri_sub_menu() {
		return '3';
	}
	
	public function get_title_menu() {
		$this->db->order_by('sub_menu_id', 'asc');
		$query = $this->db->get('sub_menu');
		
		$rows = $query->result();
		
		$title = '';
		if(!empty($rows)) {
			foreach($rows as $r) {
				$exp_sub_menu = explode(',', $r->sub_menu_controller);
				if(!empty($exp_sub_menu)) {
					foreach($exp_sub_menu as $rs) {
						if($rs == $this->uri->segment(3)) {
							$title .= $r->sub_menu_name;
						}
					}
				}
			}
		}
		
		if($title == '') {
			$this->db->order_by('menu_id', 'asc');
			$this->db->where('menu_controller', $this->uri->segment(1));
			$query = $this->db->get('menu');
			
			$row = $query->row();
			
			if(!empty($row)) {
				$title .= $row->menu_name;
			}
		}	
		
		return $title;
	}
	
	public function get_active_menu() {
		$active = $this->uri->segment($this->get_uri());
		
		return $active;
	}
	
	public function get_active_sub_menu() {
		$active = $this->uri->segment($this->get_uri_sub_menu());
		
		return $active;
	}
	
	public function get_user_single()
	{
		//if($this->session->userdata('session_user_department') == '1') {
			$this->db->where('user_id', $this->session->userdata('session_user_id'));
			$this->db->where('user_activated', 1);
			
			$query = $this->db->get('user');
			
			return $query->row();	
		//}
	}
	
	public function get_department_single() {
		$this->db->where('department_id', $this->session->userdata('session_user_department'));
		$query = $this->db->get('department');
		
		return $query->row();
	}
	
	public function get_menu_list() {
		$this->db->order_by('menu_sort', 'asc');
		$this->db->where('menu_enable', 1);
		
		$query = $this->db->get('menu');
		
		return $query->result();
	}
	
	public function get_sub_menu_list() {
		$this->db->order_by('sub_menu_sort', 'asc');
		$this->db->where('sub_menu_enable', 1);
		
		$query = $this->db->get('sub_menu');
		
		return $query->result();
	}
	
	public function get_department_menu() {
		$this->db->where('department_id', $this->session->userdata('session_user_department'));
		$query = $this->db->get('department');
		
		return $query->row()->department_menu;
	}
	
	public function get_department_sub_menu() {
		$this->db->where('department_id', $this->session->userdata('session_user_department'));
		$query = $this->db->get('department');
		
		return $query->row()->department_sub_menu;
	}
}
?>