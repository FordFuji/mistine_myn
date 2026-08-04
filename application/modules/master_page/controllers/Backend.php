<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('master_page/model_master_page');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/master_page/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	public function index(){
		$data['row'] = $this->model_master_page->get_data_single();
		
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
		
		$this->load->view('master_page/master_page/form', $data);
	}
	
	public function save_update($id = ''){	
		
		/*$this->form_validation->set_rules('master_page_detail_th', 'Detail(Th)', "trim|required");
		$this->form_validation->set_rules('master_page_detail_en', 'Detail(En)', "trim|required");*/
		
		if($this->form_validation->run($this) == FALSE) {
			$data = array(
				'master_page_text_top_lang1' => $this->input->post('master_page_text_top_lang1'), 
				'master_page_text_top_lang2' => $this->input->post('master_page_text_top_lang2'), 
				'master_page_login_lang1' => $this->input->post('master_page_login_lang1'), 
				'master_page_login_lang2' => $this->input->post('master_page_login_lang2'), 
				'master_page_register_lang1' => $this->input->post('master_page_register_lang1'), 
				'master_page_register_lang2' => $this->input->post('master_page_register_lang2'), 
				'master_page_payment_lang1' => $this->input->post('master_page_payment_lang1'), 
				'master_page_payment_lang2' => $this->input->post('master_page_payment_lang2'), 
				'master_page_en_lang1' => $this->input->post('master_page_en_lang1'), 
				'master_page_en_lang2' => $this->input->post('master_page_en_lang2'), 
				'master_page_bur_lang1' => $this->input->post('master_page_bur_lang1'), 
				'master_page_bur_lang2' => $this->input->post('master_page_bur_lang2'), 
				'master_page_free_shipping_lang1' => $this->input->post('master_page_free_shipping_lang1'), 
				'master_page_free_shipping_lang2' => $this->input->post('master_page_free_shipping_lang2'), 
				'master_page_nationwide_lang1' => $this->input->post('master_page_nationwide_lang1'), 
				'master_page_nationwide_lang2' => $this->input->post('master_page_nationwide_lang2'), 
				'master_page_contact_center_lang1' => $this->input->post('master_page_contact_center_lang1'), 
				'master_page_contact_center_lang2' => $this->input->post('master_page_contact_center_lang2'), 
				'master_page_tel_lang1' => $this->input->post('master_page_tel_lang1'), 
				'master_page_tel_lang2' => $this->input->post('master_page_tel_lang2'), 
				'master_page_delivery_lang1' => $this->input->post('master_page_delivery_lang1'), 
				'master_page_delivery_lang2' => $this->input->post('master_page_delivery_lang2'), 
				'master_page_within_lang1' => $this->input->post('master_page_within_lang1'), 
				'master_page_within_lang2' => $this->input->post('master_page_within_lang2'), 
				'master_page_express_lang1' => $this->input->post('master_page_express_lang1'), 
				'master_page_express_lang2' => $this->input->post('master_page_express_lang2'), 
				'master_page_express_within_lang1' => $this->input->post('master_page_express_within_lang1'), 
				'master_page_express_within_lang2' => $this->input->post('master_page_express_within_lang2'), 
				'master_page_footer_lang1' => $this->input->post('master_page_footer_lang1'), 
				'master_page_footer_lang2' => $this->input->post('master_page_footer_lang2'), 
				'master_page_readmore_lang1' => $this->input->post('master_page_readmore_lang1'), 
				'master_page_readmore_lang2' => $this->input->post('master_page_readmore_lang2'), 
				'master_page_information_lang1' => $this->input->post('master_page_information_lang1'), 
				'master_page_information_lang2' => $this->input->post('master_page_information_lang2'), 
				'master_page_products_lang1' => $this->input->post('master_page_products_lang1'), 
				'master_page_products_lang2' => $this->input->post('master_page_products_lang2'), 
				'master_page_about_us_lang1' => $this->input->post('master_page_about_us_lang1'), 
				'master_page_about_us_lang2' => $this->input->post('master_page_about_us_lang2'), 
				'master_page_new_promotion_lang1' => $this->input->post('master_page_new_promotion_lang1'), 
				'master_page_new_promotion_lang2' => $this->input->post('master_page_new_promotion_lang2'), 
				'master_page_contact_us_lang1' => $this->input->post('master_page_contact_us_lang1'), 
				'master_page_contact_us_lang2' => $this->input->post('master_page_contact_us_lang2'), 
				'master_page_privacy_lang1' => $this->input->post('master_page_privacy_lang1'), 
				'master_page_privacy_lang2' => $this->input->post('master_page_privacy_lang2'), 
				'master_page_terms_lang1' => $this->input->post('master_page_terms_lang1'), 
				'master_page_terms_lang2' => $this->input->post('master_page_terms_lang2'), 
				'master_page_help_lang1' => $this->input->post('master_page_help_lang1'), 
				'master_page_help_lang2' => $this->input->post('master_page_help_lang2'), 
				'master_page_question_lang1' => $this->input->post('master_page_question_lang1'), 
				'master_page_question_lang2' => $this->input->post('master_page_question_lang2'), 
				'master_page_we_can_help_you_lang1' => $this->input->post('master_page_we_can_help_you_lang1'), 
				'master_page_we_can_help_you_lang2' => $this->input->post('master_page_we_can_help_you_lang2'),
				'master_page_username_update' => $this->session->userdata('session_username'),
				'master_page_datetime_update' => date('Y-m-d H:i:s'),
				'master_page_ip_update' => $_SERVER['REMOTE_ADDR']
			);
				
			$this->model_master_page->update_data($data, $id);
			
			redirect('master_page/backend/index');
		} else {
			$this->index($id);
		}
	}
}
?>