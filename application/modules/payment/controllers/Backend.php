<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('payment/model_payment');
		$this->load->model('payment/model_payment_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/payment/';
		
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
		$this->load->view('payment/payment/list', $data);
		/* end body */
	}
	
	public function server_processing() {
		$list = $this->model_payment_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $payment) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $payment->payment_id;
            if($payment->payment_image != '') {
				$row[] = '<img src="'.base_url('uploads/payment/'.$payment->payment_image).'" width="150">';	
			} else {
				$row[] = '';
			}
            $row[] = $payment->payment_name;
            $row[] = $payment->payment_ckeditor;
 			$row[] = '<a href="'.site_url('payment/backend/form/'.$payment->payment_id).'">Edit</a> / <a href="'.site_url('payment/backend/delete/'.$payment->payment_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_payment_datatable->count_all(),
            "recordsFiltered" => $this->model_payment_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_payment->get_data_single($id);
		$data['profiles'] = $this->model_payment->getProfileList($id);
		
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
		
		$this->load->view('payment/payment/form', $data);
	}
	
	public function save_update($id = ''){	
		
		$this->form_validation->set_rules('payment_name', 'Name', "trim|required");
		$this->form_validation->set_rules('payment_select', 'Select', "trim|required");
		$this->form_validation->set_rules('payment_ckeditor', 'CKEditor', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'payment_name' => $this->input->post('payment_name'),
				'payment_select' =>  $this->input->post('payment_select'),
				'payment_ckeditor' =>  $this->input->post('payment_ckeditor'),
				'payment_username_update' => $this->session->userdata('session_username'),
				'payment_datetime_update' => date('Y-m-d H:i:s'),
				'payment_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			if(!empty($_FILES['payment_image'])) {
				$config['upload_path']          = FCPATH.'uploads/payment/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('payment_image')) {
                    $data_image = $this->upload->data();
                    
                    /*$config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/payment/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/payment/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 1920;
					$config_resize['height'] = 520;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();*/
					
					$data['payment_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_payment->update_data($data, $id);
				
				redirect('payment/backend/index', 'location');
				
			// insert
			} else {	
				$data['payment_username_create'] = $this->session->userdata('session_username');
				$data['payment_datetime_create'] = date('Y-m-d H:i:s');
				$data['payment_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_payment->insert_data($data);
				
				redirect('payment/backend/index', 'location');
			}
		} else {
			$this->form($id);
		}
	}
	
	public function delete($id){
		$this->model_payment->delete_data($id);

		redirect('payment/backend/index','location');
	} 
}
?>