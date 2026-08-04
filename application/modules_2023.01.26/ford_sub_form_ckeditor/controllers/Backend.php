<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('other/model_other');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	// place
	public function place(){
		$data['row'] = $this->model_other->get_place();
		
		/* start header, menu */
		$data['title'] = $this->model_template_main->get_title_menu();
		$data['active'] = $this->model_template_main->get_active_menu();
		$data['sub_menu_active'] = $this->model_template_main->get_active_sub_menu();
		$data['row_user'] = $this->model_template_main->get_user_single();
		$data['department'] = $this->model_template_main->get_department_single();
		$data['rows_menu'] = $this->model_template_main->get_menu_list();
		$data['rows_sub_menu'] = $this->model_template_main->get_sub_menu_list();
		
		$this->load->view('template_main/template_main/header', $data);
		$this->load->view('template_main/template_main/menu_sidebar', $data);
		/* end header, menu */
		
		$this->load->view('other/place/form', $data);
	}
	
	public function place_save_update(){	
		
		$this->form_validation->set_rules('place_detail_th', 'Detail(Th)', "trim|required");
		$this->form_validation->set_rules('place_detail_en', 'Detail(En)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'place_detail_th' => $this->input->post('place_detail_th'),
				'place_detail_en' =>  $this->input->post('place_detail_en'),
				'place_username_update' => $this->session->userdata('session_username'),
				'place_datetime_update' => date('Y-m-d H:i:s'),
				'place_ip_update' => $_SERVER['REMOTE_ADDR']
			);
				
			$this->model_other->update_place($data);
			
			redirect('other/backend/place');
		} else {
			$this->place();
		}
	}
	// end place
}
?>