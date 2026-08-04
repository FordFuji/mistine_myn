<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('about_us/model_about_us');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/about_us/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	public function index(){
		$data['row'] = $this->model_about_us->get_data_single();
		
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
		
		$this->load->view('about_us/about_us/form', $data);
	}
	
	public function save_update($id = ''){	
		
		$this->form_validation->set_rules('about_us_detail_th', 'Detail(Th)', "trim|required");
		$this->form_validation->set_rules('about_us_detail_en', 'Detail(En)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'about_us_detail_th' => $this->input->post('about_us_detail_th'),
				'about_us_detail_en' =>  $this->input->post('about_us_detail_en'),
				'about_us_username_update' => $this->session->userdata('session_username'),
				'about_us_datetime_update' => date('Y-m-d H:i:s'),
				'about_us_ip_update' => $_SERVER['REMOTE_ADDR']
			);
				
			$this->model_about_us->update_data($data, $id);
			
			redirect('about_us/backend/index');
		} else {
			$this->index($id);
		}
	}
}
?>