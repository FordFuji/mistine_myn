<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('bank_transfer/model_bank_transfer');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/bank_transfer/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	public function index(){
		$data['rows'] = $this->model_bank_transfer->getBankDataResult();
		
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
		
		$this->load->view('bank_transfer/bank_transfer/form', $data);
	}
	
	public function save_update($id = ''){	
		
		//$this->form_validation->set_rules('bank_transfer_detail_th', 'Detail(Th)', "trim|required");
		//$this->form_validation->set_rules('bank_transfer_detail_en', 'Detail(En)', "trim|required");
		
		if($this->form_validation->run($this) == FALSE) {
			$bank_transfer_name_lang1 = $this->input->post('bank_transfer_name_lang1');
			$bank_transfer_name_lang2 = $this->input->post('bank_transfer_name_lang2');
			$bank_transfer_branch_lang1 = $this->input->post('bank_transfer_branch_lang1');
			$bank_transfer_branch_lang2 = $this->input->post('bank_transfer_branch_lang2');
			$bank_transfer_number = $this->input->post('bank_transfer_number');

			if(!empty($bank_transfer_name_lang1)) {
				$i = 0;
				foreach($bank_transfer_name_lang1 as $name_lang1) {
					$data = array(
						'bank_transfer_name_lang1' => $bank_transfer_name_lang1[$i],
						'bank_transfer_name_lang2' =>  $bank_transfer_name_lang2[$i],
						'bank_transfer_branch_lang1' => $bank_transfer_branch_lang1[$i],
						'bank_transfer_branch_lang2' => $bank_transfer_branch_lang2[$i],
						'bank_transfer_number' =>  $bank_transfer_number[$i],
						'bank_transfer_datetime_update' => date('Y-m-d H:i:s'),
						'bank_transfer_ip_update' => $_SERVER['REMOTE_ADDR']
					);

					if(!empty($_FILES['bank_transfer_image']['tmp_name'])) {
						$md5 = md5(rand());
						foreach($_FILES['bank_transfer_image']['tmp_name'] as $file) {
							if(move_uploaded_file($_FILES['bank_transfer_image']['tmp_name'][$i], FCPATH.'uploads/bank_transfer/'.$md5.'.gif')) {
								$data['bank_transfer_image'] = $md5.'.gif';
							}
						}	
					}

					$id = $i + 1;

					$this->model_bank_transfer->update_data($data, $id);

					$i++;
				}
			}
			
			redirect('bank_transfer/backend/index');
		} else {
			$this->index($id);
		}
	}

	public function deleteBankTransfer($bank_transfer_id) {
		$data = array(
			'bank_transfer_image' => ''
		);
		
		$where = array(
			'bank_transfer_id' => $bank_transfer_id
		);

		$this->db->update('ci_bank_transfer', $data, $where);

		redirect('bank_transfer/backend');
	}
}
?>