<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('member/model_member');
		$this->load->model('member/model_member_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/member/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	public function member_detail() {
		
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
		$this->load->view('member/member/list', $data);
		/* end body */
	}
	
	public function server_processing() {
		$list = $this->model_member_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $member) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $member->member_id;
            if($member->member_image != '') {
				$row[] = '<img src="'.base_url('uploads/member/'.$member->member_image).'" width="150">';	
			} else {
				$row[] = '';
			}
            $row[] = $member->member_first_name;
            $row[] = $member->member_last_name;
            $row[] = $member->member_phone;
            $row[] = $member->member_address;
            $row[] = $member->member_email;
            $row[] = $member->member_password;
 			$row[] = '<a href="'.site_url('member/backend/member_detail_form/'.$member->member_id).'">View</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_member_datatable->count_all(),
            "recordsFiltered" => $this->model_member_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function member_detail_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_member->get_data_single($id);

		$data['row_shipping'] = $this->model_member->getMemberAddressShipping($id);
		$data['row_billing'] = $this->model_member->getMemberBilling($id);
		
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
		
		$this->load->view('member/member/form', $data);
	}
	
	public function save_update($id = ''){	
		
		$this->form_validation->set_rules('member_name', 'Name', "trim|required");
		$this->form_validation->set_rules('member_select', 'Select', "trim|required");
		$this->form_validation->set_rules('member_ckeditor', 'CKEditor', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'member_name' => $this->input->post('member_name'),
				'member_select' =>  $this->input->post('member_select'),
				'member_ckeditor' =>  $this->input->post('member_ckeditor'),
				'member_username_update' => $this->session->userdata('session_username'),
				'member_datetime_update' => date('Y-m-d H:i:s'),
				'member_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			if(!empty($_FILES['member_image'])) {
				$config['upload_path']          = FCPATH.'uploads/member/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('member_image')) {
                    $data_image = $this->upload->data();
                    
                    /*$config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/member/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/member/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 1920;
					$config_resize['height'] = 520;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();*/
					
					$data['member_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_member->update_data($data, $id);
				
				redirect('member/backend/index', 'location');
				
			// insert
			} else {	
				$data['member_username_create'] = $this->session->userdata('session_username');
				$data['member_datetime_create'] = date('Y-m-d H:i:s');
				$data['member_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_member->insert_data($data);
				
				redirect('member/backend/index', 'location');
			}
		} else {
			$this->form($id);
		}
	}
	
	public function delete($id){
		$this->model_member->delete_data($id);

		redirect('member/backend/index','location');
	}

	public function wishlist() {
		
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
		$this->load->view('member/wishlist/list', $data);
		/* end body */
	}
	
	public function wishlist_server_processing() {
		$list = $this->model_member_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $member) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $member->member_id;
            if($member->member_image != '') {
				$row[] = '<img src="'.base_url('uploads/member/'.$member->member_image).'" width="150">';	
			} else {
				$row[] = '';
			}
            $row[] = $member->member_first_name;
            $row[] = $member->member_last_name;
 			$row[] = '<a href="'.site_url('member/backend/wishlist_form/'.$member->member_id).'">View Wishlist</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_member_datatable->count_all(),
            "recordsFiltered" => $this->model_member_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}

	public function wishlist_form($id = ''){	
		$data['id'] = $id;
		$data['rows'] = $this->model_member->getWishlistResult($id);
		
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
		
		$this->load->view('member/wishlist/form', $data);
	}
}
?>