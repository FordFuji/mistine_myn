<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('rate_shipping/model_rate_shipping');
		$this->load->model('rate_shipping/model_rate_shipping_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/rate_shipping/';
		
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
		$this->load->view('rate_shipping/rate_shipping/list', $data);
		/* end body */
	}
	
	public function server_processing() {
		$list = $this->model_rate_shipping_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rate_shipping) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $rate_shipping->rate_shipping_id;
            $row[] = $rate_shipping->rate_shipping_location;
			$row[] = $rate_shipping->rate_shipping_township;
			$row[] = $rate_shipping->rate_shipping_amount;
			$row[] = $rate_shipping->rate_shipping_pre_weight;
			$row[] = $rate_shipping->rate_shipping_add_kg;
			$row[] = $rate_shipping->rate_shipping_add_money;
			$row[] = $rate_shipping->rate_shipping_delivered_date;
 			$row[] = '<a href="'.site_url('rate_shipping/backend/form/'.$rate_shipping->rate_shipping_id).'">Edit</a> / <a href="'.site_url('rate_shipping/backend/delete/'.$rate_shipping->rate_shipping_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_rate_shipping_datatable->count_all(),
            "recordsFiltered" => $this->model_rate_shipping_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_rate_shipping->get_data_single($id);
		
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
		
		$this->load->view('rate_shipping/rate_shipping/form', $data);
	}
	
	public function save_update($id = ''){	
		
		$this->form_validation->set_rules('rate_shipping_location', 'Region/State', "trim|required");
		$this->form_validation->set_rules('rate_shipping_township', 'Township', "trim|required");
		$this->form_validation->set_rules('rate_shipping_amount', 'ค่าขนส่ง น้ำหนักขั้นต่ำ (KS)', "trim|required");
		$this->form_validation->set_rules('rate_shipping_pre_weight', 'จำนวนน้ำหนักขั้นต่ำ (KG)', "trim|required");
		$this->form_validation->set_rules('rate_shipping_add_kg', 'เพิ่มทุกกี่กิโล (KG)', "trim|required");
		$this->form_validation->set_rules('rate_shipping_add_money', 'ค่าขนส่งเพิ่มขึ้นทีละ (KS)', "trim|required");
		$this->form_validation->set_rules('rate_shipping_delivered_date', 'ระยะเวลาการขนส่ง(วัน)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'rate_shipping_location' => $this->input->post('rate_shipping_location'),
				'rate_shipping_township' =>  $this->input->post('rate_shipping_township'),
				'rate_shipping_amount' =>  $this->input->post('rate_shipping_amount'),
				'rate_shipping_pre_weight' =>  $this->input->post('rate_shipping_pre_weight'),
				'rate_shipping_add_kg' =>  $this->input->post('rate_shipping_add_kg'),
				'rate_shipping_add_money' =>  $this->input->post('rate_shipping_add_money'),
				'rate_shipping_delivered_date' =>  $this->input->post('rate_shipping_delivered_date'),
				'rate_shipping_username_update' => $this->session->userdata('session_username'),
				'rate_shipping_datetime_update' => date('Y-m-d H:i:s'),
				'rate_shipping_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			// update 
			if($id != '') {	
				$this->model_rate_shipping->update_data($data, $id);
				
				redirect('rate_shipping/backend/index', 'location');
				
			// insert
			} else {	
				$data['rate_shipping_username_create'] = $this->session->userdata('session_username');
				$data['rate_shipping_datetime_create'] = date('Y-m-d H:i:s');
				$data['rate_shipping_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_rate_shipping->insert_data($data);
				
				redirect('rate_shipping/backend', 'location');
			}
		} else {
			$this->form($id);
		}
	}
	
	public function delete($id){
		$this->model_rate_shipping->delete_data($id);

		redirect('rate_shipping/backend/index','location');
	} 
}
?>