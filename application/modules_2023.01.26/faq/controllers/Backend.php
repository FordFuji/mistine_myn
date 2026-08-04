<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('faq/model_faq');
		$this->load->model('faq/model_faq_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/faq/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	public function index() {
		
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
		
		/* start body */
		$this->load->view('faq/faq/list', $data);
		/* end body */
	}
	
	public function server_processing() {
		$list = $this->model_faq_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $faq) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $faq->faq_id;
            
            $row[] = $faq->faq_q_lang1;
            $row[] = $faq->faq_q_lang2;
            $row[] = $faq->faq_a_lang1;
            $row[] = $faq->faq_a_lang2;
 			$row[] = '<a href="'.site_url('faq/backend/form/'.$faq->faq_id).'">Edit</a> / <a href="'.site_url('faq/backend/delete/'.$faq->faq_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_faq_datatable->count_all(),
            "recordsFiltered" => $this->model_faq_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_faq->get_data_single($id);
		
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
		
		$this->load->view('faq/faq/form', $data);
	}
	
	public function save_update($id = ''){	
		
		$this->form_validation->set_rules('faq_q_lang1', 'Question (En)', "trim|required");
		$this->form_validation->set_rules('faq_q_lang2', 'Question (Myan)', "trim|required");
		$this->form_validation->set_rules('faq_a_lang1', 'Answer (En)', "trim|required");
		$this->form_validation->set_rules('faq_a_lang2', 'Answer (Myan)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'faq_q_lang1' => $this->input->post('faq_q_lang1'),
				'faq_q_lang2' =>  $this->input->post('faq_q_lang2'),
				'faq_a_lang1' => $this->input->post('faq_a_lang1'),
				'faq_a_lang2' =>  $this->input->post('faq_a_lang2'),
				'faq_username_update' => $this->session->userdata('session_username'),
				'faq_datetime_update' => date('Y-m-d H:i:s'),
				'faq_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			// update 
			if($id != '') {	
				$this->model_faq->update_data($data, $id);
				
				redirect('faq/backend/index', 'location');
				
			// insert
			} else {	
				$data['faq_username_create'] = $this->session->userdata('session_username');
				$data['faq_datetime_create'] = date('Y-m-d H:i:s');
				$data['faq_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_faq->insert_data($data);
				
				redirect('faq/backend/index', 'location');
			}
		} else {
			$this->form($id);
		}
	}
	
	public function delete($id){
		$this->model_faq->delete_data($id);

		redirect('faq/backend/index','location');
	} 
}
?>