<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('home/model_home');
		$this->load->model('home/model_promotion_banner_datatable');
		$this->load->model('home/model_banner_slide_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/banner_slide/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	// banner_slide	
	public function banner_slide() {
		
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
		$this->load->view('home/banner_slide/list', $data);
		/* end body */
	}
	
	public function banner_slide_server_processing() {
		$list = $this->model_banner_slide_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $banner_slide) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $banner_slide->banner_slide_id;
            
            if($banner_slide->banner_slide_image != '') {
				$row[] = '<img src="'.base_url('uploads/banner_slide/'.$banner_slide->banner_slide_image).'" width="250">';	
			} else {
				$row[] = '';
			}

			$row[] = $banner_slide->banner_slide_text_lang1;
			$row[] = $banner_slide->banner_slide_text_lang2;
            
            //if($banner_slide->banner_slide_id != 4) {
				$row[] = '<a href="'.site_url('home/backend/banner_slide_form/'.$banner_slide->banner_slide_id).'">Edit</a> / <a href="'.site_url('home/backend/banner_slide_delete/'.$banner_slide->banner_slide_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
			/*} else {
				$row[] = '';
			}*/
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_banner_slide_datatable->count_all(),
            "recordsFiltered" => $this->model_banner_slide_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function banner_slide_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_home->get_banner_slide_single($id);
		
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
		
		$this->load->view('home/banner_slide/form', $data);
	}
	
	public function banner_slide_save_update($id = ''){	
		
		/*$this->form_validation->set_rules('banner_slide_text_lang1', 'Text (En)', "trim|required");
		$this->form_validation->set_rules('banner_slide_text_lang2', 'Text (Myan)', "trim|required");*/
		
		if($this->form_validation->run($this) == FALSE) {
			$data = array(
				'banner_slide_text_lang1' => $this->input->post('banner_slide_text_lang1'),
				'banner_slide_text_lang2' => $this->input->post('banner_slide_text_lang2'),
				'banner_slide_username_update' => $this->session->userdata('session_username'),
				'banner_slide_datetime_update' => date('Y-m-d H:i:s'),
				'banner_slide_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			$this->load->library('upload');
				
			if(!empty($_FILES['banner_slide_image'])) {
				$config['upload_path']          = FCPATH.'uploads/banner_slide/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('banner_slide_image')) {
                    $data_image = $this->upload->data();
                    
                    $config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/banner_slide/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/banner_slide/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 1600;
					$config_resize['height'] = 647;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
					
					$data['banner_slide_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_home->update_banner_slide($data, $id);
				
				redirect('home/backend/banner_slide', 'location');
				
			// insert
			} else {	
				$data['banner_slide_username_create'] = $this->session->userdata('session_username');
				$data['banner_slide_datetime_create'] = date('Y-m-d H:i:s');
				$data['banner_slide_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_home->insert_banner_slide($data);
				
				redirect('home/backend/banner_slide', 'location');
			}
		} else {
			$this->banner_slide_form($id);
		}
	}
	
	public function banner_slide_delete($id){
		$this->model_home->delete_banner_slide($id);

		redirect('home/backend/banner_slide','location');
	}
	// end banner_slide 

	// tel_social_network
	public function tel_social_network($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_home->get_tel_social_network_single($id);
		
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
		
		$this->load->view('home/tel_social_network/form', $data);
	}
	
	public function tel_social_network_save_update(){	
		
		$this->form_validation->set_rules('tel_social_network_tel', 'Telephone', "trim|required");
		$this->form_validation->set_rules('tel_social_network_facebook', 'Facebook', "trim|required");
		$this->form_validation->set_rules('tel_social_network_line', 'Line', "trim|required");
		$this->form_validation->set_rules('tel_social_network_youtube', 'Youtube', "trim|required");
		$this->form_validation->set_rules('tel_social_network_instagram', 'Instagram', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'tel_social_network_tel' => $this->input->post('tel_social_network_tel'),
				'tel_social_network_facebook' => $this->input->post('tel_social_network_facebook'),
				'tel_social_network_youtube' => $this->input->post('tel_social_network_youtube'),
				'tel_social_network_line' => $this->input->post('tel_social_network_line'),
				'tel_social_network_instagram' => $this->input->post('tel_social_network_instagram'),
				'tel_social_network_username_update' => $this->session->userdata('session_username'),
				'tel_social_network_datetime_update' => date('Y-m-d H:i:s'),
				'tel_social_network_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			// update	
			$this->model_home->update_tel_social_network($data);
			
			redirect('home/backend/tel_social_network', 'location');
		} else {
			$this->tel_social_network();
		}
	}
	// end tel_social_network 

	// promotion_banner	
	public function promotion_banner() {
		
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
		$this->load->view('home/promotion_banner/list', $data);
		/* end body */
	}
	
	public function promotion_banner_server_processing() {
		$list = $this->model_promotion_banner_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $promotion_banner) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $promotion_banner->promotion_banner_id;
            
            if($promotion_banner->promotion_banner_image != '') {
				$row[] = '<img src="'.base_url('uploads/promotion_banner/'.$promotion_banner->promotion_banner_image).'" width="250">';	
			} else {
				$row[] = '';
			}
			
			$row[] = '<a href="'.site_url('home/backend/promotion_banner_form/'.$promotion_banner->promotion_banner_id).'">Edit</a> / <a href="'.site_url('home/backend/promotion_banner_delete/'.$promotion_banner->promotion_banner_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_promotion_banner_datatable->count_all(),
            "recordsFiltered" => $this->model_promotion_banner_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function promotion_banner_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_home->get_promotion_banner_single($id);
		
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
		
		$this->load->view('home/promotion_banner/form', $data);
	}
	
	public function promotion_banner_save_update($id = ''){	
		
		/*$this->form_validation->set_rules('promotion_banner_text_lang1', 'Text (En)', "trim|required");
		$this->form_validation->set_rules('promotion_banner_text_lang2', 'Text (Myan)', "trim|required");*/
		
		if($this->form_validation->run($this) == FALSE) {
			$data = array(
				'promotion_banner_username_update' => $this->session->userdata('session_username'),
				'promotion_banner_datetime_update' => date('Y-m-d H:i:s'),
				'promotion_banner_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			$this->load->library('upload');
				
			if(!empty($_FILES['promotion_banner_image'])) {
				$config['upload_path']          = FCPATH.'uploads/promotion_banner/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('promotion_banner_image')) {
                    $data_image = $this->upload->data();
                    
                    $config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/promotion_banner/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/promotion_banner/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 1110;
					$config_resize['height'] = 449;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
					
					$data['promotion_banner_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_home->update_promotion_banner($data, $id);
				
				redirect('home/backend/promotion_banner', 'location');
				
			// insert
			} else {	
				$data['promotion_banner_username_create'] = $this->session->userdata('session_username');
				$data['promotion_banner_datetime_create'] = date('Y-m-d H:i:s');
				$data['promotion_banner_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_home->insert_promotion_banner($data);
				
				redirect('home/backend/promotion_banner', 'location');
			}
		} else {
			$this->promotion_banner_form($id);
		}
	}
	
	public function promotion_banner_delete($id){
		$this->model_home->delete_promotion_banner($id);

		redirect('home/backend/promotion_banner','location');
	}
	// end promotion_banner
	
}
?>