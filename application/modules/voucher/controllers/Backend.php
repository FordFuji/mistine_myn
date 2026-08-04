<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('voucher/model_voucher');
		$this->load->model('voucher/model_category_voucher_datatable');
		$this->load->model('voucher/model_voucher_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/category_voucher/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	// category_voucher	
	public function category_voucher() {
		
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
		$this->load->view('voucher/category_voucher/list', $data);
		/* end body */
	}
	
	public function category_voucher_server_processing() {
		$list = $this->model_category_voucher_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $category_voucher) {
            //$no++;
            $row = array();
			//$row[] = $no;
			
			if($category_voucher->category_voucher_active == 'Yes') {
				$active = '<input type="radio" name="category_voucher_active" id="category_voucher_active_'.$category_voucher->category_voucher_id.'" value="'.$category_voucher->category_voucher_id.'" onclick="setActiveCategoryVoucher(this.value);" checked>';
			} else {
				$active = '<input type="radio" name="category_voucher_active" id="category_voucher_active_'.$category_voucher->category_voucher_id.'" value="'.$category_voucher->category_voucher_id.'" onclick="setActiveCategoryVoucher(this.value);">';
			}
			
			$row[] = $active;

            $row[] = $category_voucher->category_voucher_id;
			$row[] = '<img src="'.base_url('uploads/category_voucher/'.$category_voucher->category_voucher_image).'" width="200">';
			
			$row[] = $category_voucher->category_voucher_name;
            
			$row[] = '<a href="'.site_url('voucher/backend/category_voucher_form/'.$category_voucher->category_voucher_id).'">Edit</a> / <a href="'.site_url('voucher/backend/category_voucher_delete/'.$category_voucher->category_voucher_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_category_voucher_datatable->count_all(),
            "recordsFiltered" => $this->model_category_voucher_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function category_voucher_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_voucher->get_category_voucher_single($id);
		
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
		
		$this->load->view('voucher/category_voucher/form', $data);
	}
	
	public function category_voucher_save_update($id = ''){	

		$this->form_validation->set_rules('category_voucher_name', 'Campaign Name', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'category_voucher_name' => $this->input->post('category_voucher_name'),
				'category_voucher_username_update' => $this->session->userdata('session_username'),
				'category_voucher_datetime_update' => date('Y-m-d H:i:s'),
				'category_voucher_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			if(!empty($_FILES['category_voucher_image'])) {
				$config['upload_path']          = FCPATH.'uploads/category_voucher/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('category_voucher_image')) {
                    $data_image = $this->upload->data();
                    
                    /*$config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/category_voucher/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/category_voucher/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 1920;
					$config_resize['height'] = 520;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();*/
					
					$data['category_voucher_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_voucher->update_category_voucher($data, $id);
				
				redirect('voucher/backend/category_voucher', 'location');
				
			// insert
			} else {	
				$data['category_voucher_username_create'] = $this->session->userdata('session_username');
				$data['category_voucher_datetime_create'] = date('Y-m-d H:i:s');
				$data['category_voucher_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_voucher->insert_category_voucher($data);
				
				redirect('voucher/backend/category_voucher', 'location');
			}
		} else {
			$this->category_voucher_form($id);
		}
	}
	
	public function category_voucher_delete($id){
		$this->model_voucher->delete_category_voucher($id);

		redirect('voucher/backend/category_voucher','location');
	}

	public function ajaxSetActive() {
		$data = array(
			'category_voucher_active' => 'No'
		);

		$this->db->update('ci_category_voucher', $data, true);

		$data = array(
			'category_voucher_active' => 'Yes'
		);

		$where = array(
			'category_voucher_id' => $this->input->post('category_voucher_id')
		);

		$this->db->update('ci_category_voucher', $data, $where);
	}
	// end category_voucher 
	
	// voucher	
	public function voucher() {
		
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
		$this->load->view('voucher/voucher/list', $data);
		/* end body */
	}
	
	public function voucher_server_processing() {
		$list = $this->model_voucher_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $voucher) {
            //$no++;
            $row = array();
			//$row[] = $no;
            $row[] = $voucher->voucher_id;
			$row[] = $voucher->category_voucher_name;
			
			if($voucher->voucher_type == 'Free Shipping') {
				$row[] = 'Free Shipping';
			} elseif($voucher->voucher_type == '%') {
				$row[] = $voucher->voucher_price.'%';
			} elseif($voucher->voucher_type == 'KS') {
				$row[] = $voucher->voucher_price.' KS';
			}

			$row[] = $voucher->voucher_expired_date;
			$row[] = $voucher->voucher_stock;
			$row[] = '<a href="'.site_url('voucher/backend/voucher_form/'.$voucher->voucher_id).'">Edit</a> / <a href="'.site_url('voucher/backend/voucher_delete/'.$voucher->voucher_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_voucher_datatable->count_all(),
            "recordsFiltered" => $this->model_voucher_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function voucher_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_voucher->get_voucher_single($id);

		$data['categoryVoucherCtrl'] = $this->model_voucher->getCategoryVoucherResult();
		
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
		
		$this->load->view('voucher/voucher/form', $data);
	}
	
	public function voucher_save_update($id = ''){	
		
		$this->form_validation->set_rules('category_voucher_id', 'Campaign', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'category_voucher_id' => $this->input->post('category_voucher_id'),
				'voucher_type' => $this->input->post('voucher_type'),
				'voucher_expired_date' => $this->input->post('voucher_expired_date'),
				'voucher_stock' => $this->input->post('voucher_stock'),
				'voucher_username_update' => $this->session->userdata('session_username'),
				'voucher_datetime_update' => date('Y-m-d H:i:s'),
				'voucher_ip_update' => $_SERVER['REMOTE_ADDR']
			);

			if($this->input->post('voucher_price') != '') {
				$data['voucher_price'] = $this->input->post('voucher_price');
			} else {
				$data['voucher_price'] = 0;
			}
			
			// update 
			if($id != '') {	
				$this->model_voucher->update_voucher($data, $id);
				
				redirect('voucher/backend/voucher', 'location');
				
			// insert
			} else {	
				$data['voucher_username_create'] = $this->session->userdata('session_username');
				$data['voucher_datetime_create'] = date('Y-m-d H:i:s');
				$data['voucher_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_voucher->insert_voucher($data);

				// หา voucher ล่าสุด
				$this->db->order_by('voucher_id', 'desc');
				$query = $this->db->get('ci_voucher');

				$row = $query->row();

				if(!empty($row)) {
					// map voucher
					$this->db->order_by('member_id', 'asc');
					$query = $this->db->get('ci_member');

					$rows = $query->result();

					if(!empty($rows)) {
						foreach($rows as $r) {
							$data = array(
								'member_id' => $r->member_id,
								'voucher_id' => $row->voucher_id,
								'map_voucher_valid_or_use' => 'valid',
								'map_voucher_datetime_create' => date('Y-m-d H:i:s'),
								'map_voucher_ip_create' => $_SERVER['REMOTE_ADDR']
							);

							$this->db->insert('ci_map_voucher', $data);
						}
					}
				}
				
				redirect('voucher/backend/voucher', 'location');
			}
		} else {
			$this->voucher_form($id);
		}
	}
	
	public function voucher_delete($id){
		$this->model_voucher->delete_voucher($id);

		$where = array(
			'voucher_id' => $id
		);

		$this->db->delete('ci_voucher', $where);

		redirect('voucher/backend/voucher','location');
	}
	// end voucher
}
?>