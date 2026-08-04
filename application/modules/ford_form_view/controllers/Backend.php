<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('property_register/model_property_register');
		$this->load->model('property_register/model_property_register_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/property_register/';
		
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
		$this->load->view('property_register/property_register/list', $data);
		/* end body */
	}
	
	public function server_processing() {
		$list = $this->model_property_register_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $property_register) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $property_register->property_register_id;
            $row[] = $property_register->property_register_name;
            $row[] = $property_register->property_register_phone;
            $row[] = $property_register->property_register_email;
            $row[] = $property_register->type_name_en;
            $row[] = $property_register->property_register_purpose;
 			$row[] = '<a href="'.site_url('property_register/backend/form/'.$property_register->property_register_id).'">View</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_property_register_datatable->count_all(),
            "recordsFiltered" => $this->model_property_register_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_property_register->get_data_single($id);
		
		$data['unitCtrl'] = $this->model_property_register->getRegisterUnitList($id);
		$data['projectCtrl'] = $this->model_property_register->getRegisterProjectList($id);
		$data['galleryCtrl'] = $this->model_property_register->getRegisterGalleryList($id);
		
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
		
		$this->load->view('property_register/property_register/form', $data);
	}
}
?>