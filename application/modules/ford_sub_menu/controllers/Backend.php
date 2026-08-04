<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('data_property/model_data_property');
		$this->load->model('data_property/model_units_features_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/units_features/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	// units_features	
	public function units_features() {
		
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
		$this->load->view('data_property/units_features/list', $data);
		/* end body */
	}
	
	public function units_features_server_processing() {
		$list = $this->model_units_features_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $units_features) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $units_features->units_features_id;
            
            if($units_features->units_features_name_image1 != '') {
				$row[] = '<img src="'.base_url('uploads/units_features/'.$units_features->units_features_name_image1).'" width="38">';	
			} else {
				$row[] = '';
			}
			
			if($units_features->units_features_name_image2 != '') {
				$row[] = '<img src="'.base_url('uploads/units_features/'.$units_features->units_features_name_image2).'" width="85">';		
			} else {
				$row[] = '';
			}
			
            $row[] = $units_features->units_features_name_th;
            $row[] = $units_features->units_features_name_en;
            
			$row[] = '<a href="'.site_url('data_property/backend/units_features_form/'.$units_features->units_features_id).'">Edit</a> / <a href="'.site_url('data_property/backend/units_features_delete/'.$units_features->units_features_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_units_features_datatable->count_all(),
            "recordsFiltered" => $this->model_units_features_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function units_features_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_data_property->get_units_features_single($id);
		
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
		
		$this->load->view('data_property/units_features/form', $data);
	}
	
	public function units_features_save_update($id = ''){	
		
		$this->form_validation->set_rules('units_features_name_th', 'Units Features(Th)', "trim|required");
		$this->form_validation->set_rules('units_features_name_en', 'Units Features(En)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'units_features_name_th' => $this->input->post('units_features_name_th'),
				'units_features_name_en' =>  $this->input->post('units_features_name_en'),
				'units_features_username_update' => $this->session->userdata('session_username'),
				'units_features_datetime_update' => date('Y-m-d H:i:s'),
				'units_features_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			if(!empty($_FILES['units_features_name_image2'])) {
				$config['upload_path']          = FCPATH.'uploads/units_features/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('units_features_name_image2')) {
                    $data_image = $this->upload->data();
                    
                    $config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/units_features/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/units_features/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 1920;
					$config_resize['height'] = 520;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
					
					$data['units_features_name_image2'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_data_property->update_units_features($data, $id);
				
				redirect('data_property/backend/units_features', 'location');
				
			// insert
			} else {	
				$data['units_features_username_create'] = $this->session->userdata('session_username');
				$data['units_features_datetime_create'] = date('Y-m-d H:i:s');
				$data['units_features_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_data_property->insert_units_features($data);
				
				redirect('data_property/backend/units_features', 'location');
			}
		} else {
			$this->units_features_form($id);
		}
	}
	
	public function units_features_delete($id){
		$this->model_data_property->delete_units_features($id);

		redirect('data_property/backend/units_features','location');
	}
	// end units_features 
	
	
}
?>