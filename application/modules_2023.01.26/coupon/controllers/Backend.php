<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('coupon/model_coupon');
		$this->load->model('coupon/model_coupon_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/coupon/';
		
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
		$this->load->view('coupon/coupon/list', $data);
		/* end body */
	}
	
	public function server_processing() {
		$list = $this->model_coupon_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $coupon) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $coupon->coupon_id;
            $row[] = $coupon->coupon_code;
            $row[] = $coupon->coupon_discount;
            $row[] = $coupon->coupon_type;
            $row[] = $coupon->coupon_limit;
            $row[] = $coupon->coupon_begin_datetime;
            $row[] = $coupon->coupon_end_datetime;
            $row[] = $coupon->coupon_member;
 			$row[] = '<a href="'.site_url('coupon/backend/form/'.$coupon->coupon_id).'">Edit</a> / <a href="'.site_url('coupon/backend/delete/'.$coupon->coupon_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_coupon_datatable->count_all(),
            "recordsFiltered" => $this->model_coupon_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_coupon->get_data_single($id);
		
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
		
		$this->load->view('coupon/coupon/form', $data);
	}
	
	public function save_update($id = ''){	
		
		$this->form_validation->set_rules('coupon_code', 'Code', "trim|required");
		$this->form_validation->set_rules('coupon_discount', 'Discount', "trim|required");
		$this->form_validation->set_rules('coupon_type', 'Type', "trim|required");
		$this->form_validation->set_rules('coupon_limit', 'Limit', "trim|required");
		$this->form_validation->set_rules('coupon_begin_datetime', 'Begin Datetime', "trim|required");
		$this->form_validation->set_rules('coupon_end_datetime', 'End Datetime', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'coupon_code' => $this->input->post('coupon_code'),
				'coupon_discount' => $this->input->post('coupon_discount'),
				'coupon_type' =>  $this->input->post('coupon_type'),
				'coupon_limit' =>  $this->input->post('coupon_limit'),
				'coupon_begin_datetime' =>  $this->input->post('coupon_begin_datetime'),
				'coupon_end_datetime' =>  $this->input->post('coupon_end_datetime'),
				'coupon_username_update' => $this->session->userdata('session_username'),
				'coupon_datetime_update' => date('Y-m-d H:i:s'),
				'coupon_ip_update' => $_SERVER['REMOTE_ADDR']
			);

			if($this->input->post('coupon_member') != '') {
				$data['coupon_member'] = 'Yes';
			} else {
				$data['coupon_member'] = 'No';
			}
			
			// update 
			if($id != '') {	
				$this->model_coupon->update_data($data, $id);
				
				redirect('coupon/backend/index', 'location');
				
			// insert
			} else {	
				$data['coupon_username_create'] = $this->session->userdata('session_username');
				$data['coupon_datetime_create'] = date('Y-m-d H:i:s');
				$data['coupon_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_coupon->insert_data($data);
				
				redirect('coupon/backend/index', 'location');
			}
		} else {
			$this->form($id);
		}
	}
	
	public function delete($id){
		$this->model_coupon->delete_data($id);

		redirect('coupon/backend/index','location');
	} 
}
?>