<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('contact/model_contact_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/contact/';
		
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
		$this->load->view('contact/contact/list', $data);
		/* end body */
	}
	
	public function server_processing() {
		$list = $this->model_contact_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $contact) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $contact->contact_id;
            $row[] = $contact->contact_name;
            $row[] = $contact->contact_email_facebook_etc;
            $row[] = $contact->contact_tel;
            $row[] = $contact->contact_subject;
            $row[] = $contact->contact_message;
            $row[] = $contact->contact_datetime_create;
            $row[] = $contact->contact_ip_create;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_contact_datatable->count_all(),
            "recordsFiltered" => $this->model_contact_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
}
?>