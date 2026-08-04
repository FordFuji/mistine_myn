<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('config_email/model_config_email');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/config_email/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	public function index(){
		$data['row'] = $this->model_config_email->get_data_single();
		
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
		
		$this->load->view('config_email/config_email/form', $data);
	}
	
	public function save_update($id = ''){	
		
		$this->form_validation->set_rules('config_email_host', 'Host', "trim|required");
		$this->form_validation->set_rules('config_email_username', 'Username', "trim|required");
		$this->form_validation->set_rules('config_email_password', 'Password', "trim|required");
		$this->form_validation->set_rules('config_email_smtpsecure', 'SMTP Secure', "trim|required");
		$this->form_validation->set_rules('config_email_port', 'Port', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'config_email_host' => $this->input->post('config_email_host'),
				'config_email_username' =>  $this->input->post('config_email_username'),
				'config_email_password' =>  $this->input->post('config_email_password'),
				'config_email_smtpsecure' =>  $this->input->post('config_email_smtpsecure'),
				'config_email_port' =>  $this->input->post('config_email_port'),
				'config_email_username_update' => $this->session->userdata('session_username'),
				'config_email_datetime_update' => date('Y-m-d H:i:s'),
				'config_email_ip_update' => $_SERVER['REMOTE_ADDR']
			);
				
			$this->model_config_email->update_data($data, $id);
			
			redirect('config_email/backend/index');
		} else {
			$this->index($id);
		}
	}
}
?>