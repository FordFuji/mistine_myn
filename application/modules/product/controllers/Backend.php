<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('product/model_product');
		$this->load->model('product/model_category1_datatable');
		$this->load->model('product/model_category2_datatable');
		$this->load->model('product/model_category3_datatable');
		$this->load->model('product/model_weight_datatable');
		$this->load->model('product/model_color_datatable');
		$this->load->model('product/model_collection_datatable');
		$this->load->model('product/model_product_datatable');
		$this->load->model('template_main/model_template_main');
		$this->load->model('product/model_product_gallery_datatable');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/category1/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	// category1	
	public function category1() {
		
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
		$this->load->view('product/category1/list', $data);
		/* end body */
	}
	
	public function category1_server_processing() {
		$list = $this->model_category1_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $category1) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $category1->category1_id;
            
            if($category1->category1_image != '') {
				$row[] = '<img src="'.base_url('uploads/category1/'.$category1->category1_image).'" width="150">';	
			} else {
				$row[] = '';
			}
			
            $row[] = $category1->category1_name_lang1;
            $row[] = $category1->category1_name_lang2;
            
			$row[] = '<a href="'.site_url('product/backend/category1_form/'.$category1->category1_id).'">Edit</a> / <a href="'.site_url('product/backend/category1_delete/'.$category1->category1_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_category1_datatable->count_all(),
            "recordsFiltered" => $this->model_category1_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function category1_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_product->get_category1_single($id);
		
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
		
		$this->load->view('product/category1/form', $data);
	}
	
	public function category1_save_update($id = ''){	
		
		$this->form_validation->set_rules('category1_name_lang1', 'Category 1 (En)', "trim|required");
		$this->form_validation->set_rules('category1_name_lang2', 'Category 1 (Myan)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'category1_name_lang1' => $this->input->post('category1_name_lang1'),
				'category1_name_lang2' =>  $this->input->post('category1_name_lang2'),
				'category1_username_update' => $this->session->userdata('session_username'),
				'category1_datetime_update' => date('Y-m-d H:i:s'),
				'category1_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			if(!empty($_FILES['category1_image'])) {
				$config['upload_path']          = FCPATH.'uploads/category1/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('category1_image')) {
                    $data_image = $this->upload->data();
                    
                    /*$config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/category1/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/category1/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 328;
					$config_resize['height'] = 321;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();*/
					
					$data['category1_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_product->update_category1($data, $id);
				
				redirect('product/backend/category1', 'location');
				
			// insert
			} else {	
				$data['category1_username_create'] = $this->session->userdata('session_username');
				$data['category1_datetime_create'] = date('Y-m-d H:i:s');
				$data['category1_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_product->insert_category1($data);
				
				redirect('product/backend/category1', 'location');
			}
		} else {
			$this->category1_form($id);
		}
	}
	
	public function category1_delete($id){
		$this->model_product->delete_category1($id);

		redirect('product/backend/category1','location');
	}
	// end category1 
	
	// category2	
	public function category2() {

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
		$this->load->view('product/category2/list', $data);
		/* end body */
	}
	
	public function category2_server_processing() {
		$list = $this->model_category2_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $category2) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $category2->category2_id;
			
            $row[] = $category2->category1_name_lang1.' / '.$category2->category1_name_lang2;
            $row[] = $category2->category2_name_lang1;
            $row[] = $category2->category2_name_lang2;
            
			$row[] = '<a href="'.site_url('product/backend/category2_form/'.$category2->category2_id).'">Edit</a> / <a href="'.site_url('product/backend/category2_delete/'.$category2->category2_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_category2_datatable->count_all(),
            "recordsFiltered" => $this->model_category2_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function category2_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_product->get_category2_single($id);

		$data['category1Ctrl'] = $this->model_product->getCategory1Result();
		
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
		
		$this->load->view('product/category2/form', $data);
	}
	
	public function category2_save_update($id = ''){	
		$this->form_validation->set_rules('category1_id', 'Category 1 (En) / (Myan)', "trim|required");
		$this->form_validation->set_rules('category2_name_lang1', 'Category 1 (En)', "trim|required");
		$this->form_validation->set_rules('category2_name_lang2', 'Category 1 (Myan)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'category1_id' => $this->input->post('category1_id'),
				'category2_name_lang1' => $this->input->post('category2_name_lang1'),
				'category2_name_lang2' =>  $this->input->post('category2_name_lang2'),
				'category2_username_update' => $this->session->userdata('session_username'),
				'category2_datetime_update' => date('Y-m-d H:i:s'),
				'category2_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			// update 
			if($id != '') {	
				$this->model_product->update_category2($data, $id);
				
				redirect('product/backend/category2', 'location');
				
			// insert
			} else {	
				$data['category2_username_create'] = $this->session->userdata('session_username');
				$data['category2_datetime_create'] = date('Y-m-d H:i:s');
				$data['category2_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_product->insert_category2($data);
				
				redirect('product/backend/category2', 'location');
			}
		} else {
			$this->category2_form($id);
		}
	}
	
	public function category2_delete($id){
		$this->model_product->delete_category2($id);

		redirect('product/backend/category2','location');
	}
	// end category2 

	// category3	
	public function category3() {

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
		$this->load->view('product/category3/list', $data);
		/* end body */
	}
	
	public function category3_server_processing() {
		$list = $this->model_category3_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $category3) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $category3->category3_id;
			
            $row[] = $category3->category1_name_lang1.' / '.$category3->category1_name_lang2;
            $row[] = $category3->category2_name_lang1.' / '.$category3->category2_name_lang2;
            $row[] = $category3->category3_name_lang1;
            $row[] = $category3->category3_name_lang2;
            $row[] = $category3->category3_weight;
            $row[] = $category3->category3_color;
            $row[] = $category3->category3_collection;
            
			$row[] = '<a href="'.site_url('product/backend/category3_form/'.$category3->category3_id).'">Edit</a> / <a href="'.site_url('product/backend/category3_delete/'.$category3->category3_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_category3_datatable->count_all(),
            "recordsFiltered" => $this->model_category3_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function category3_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_product->get_category3_single($id);

		$data['category1Ctrl'] = $this->model_product->getCategory1Result();

		if(!empty($data['row'])) {
			$data['category2Ctrl'] = $this->model_product->getCategory2Result($data['row']->category1_id);
		}
		
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
		
		$this->load->view('product/category3/form', $data);
	}
	
	public function category3_save_update($id = ''){	
		$this->form_validation->set_rules('category1_id', 'Category 1 (En) / (Myan)', "trim|required");
		$this->form_validation->set_rules('category2_id', 'Category 2 (En) / (Myan)', "trim|required");
		$this->form_validation->set_rules('category3_name_lang1', 'Category 3 (En)', "trim|required");
		$this->form_validation->set_rules('category3_name_lang2', 'Category 3 (Myan)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				//'category1_id' => $this->input->post('category1_id'),
				'category2_id' => $this->input->post('category2_id'),
				'category3_name_lang1' => $this->input->post('category3_name_lang1'),
				'category3_name_lang2' =>  $this->input->post('category3_name_lang2'),
				'category3_username_update' => $this->session->userdata('session_username'),
				'category3_datetime_update' => date('Y-m-d H:i:s'),
				'category3_ip_update' => $_SERVER['REMOTE_ADDR']
			);

			if($this->input->post('category3_weight') == 'Yes') {
				$data['category3_weight'] = $this->input->post('category3_weight');
			} else {
				$data['category3_weight'] = 'No';
			}

			if($this->input->post('category3_color') == 'Yes') {
				$data['category3_color'] = $this->input->post('category3_color');
			} else {
				$data['category3_color'] = 'No';
			}

			if($this->input->post('category3_collection') == 'Yes') {
				$data['category3_collection'] = $this->input->post('category3_collection');
			} else {
				$data['category3_collection'] = 'No';	
			}
			
			// update 
			if($id != '') {	
				$this->model_product->update_category3($data, $id);
				
				redirect('product/backend/category3', 'location');
				
			// insert
			} else {	
				$data['category3_username_create'] = $this->session->userdata('session_username');
				$data['category3_datetime_create'] = date('Y-m-d H:i:s');
				$data['category3_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_product->insert_category3($data);
				
				redirect('product/backend/category3', 'location');
			}
		} else {
			$this->category3_form($id);
		}
	}
	
	public function category3_delete($id){
		$this->model_product->delete_category3($id);

		redirect('product/backend/category3','location');
	}
	// end category3

	// weight	
	public function weight() {
		
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
		$this->load->view('product/weight/list', $data);
		/* end body */
	}
	
	public function weight_server_processing() {
		$list = $this->model_weight_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $weight) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $weight->weight_id;
			
            $row[] = $weight->weight_name_lang1;
            $row[] = $weight->weight_name_lang2;
            
			$row[] = '<a href="'.site_url('product/backend/weight_form/'.$weight->weight_id).'">Edit</a> / <a href="'.site_url('product/backend/weight_delete/'.$weight->weight_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_weight_datatable->count_all(),
            "recordsFiltered" => $this->model_weight_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function weight_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_product->get_weight_single($id);
		
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
		
		$this->load->view('product/weight/form', $data);
	}
	
	public function weight_save_update($id = ''){	
		
		$this->form_validation->set_rules('weight_name_lang1', 'Weight (En)', "trim|required");
		$this->form_validation->set_rules('weight_name_lang2', 'Weight (Myan)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'weight_name_lang1' => $this->input->post('weight_name_lang1'),
				'weight_name_lang2' =>  $this->input->post('weight_name_lang2'),
				'weight_username_update' => $this->session->userdata('session_username'),
				'weight_datetime_update' => date('Y-m-d H:i:s'),
				'weight_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			
			// update 
			if($id != '') {	
				$this->model_product->update_weight($data, $id);
				
				redirect('product/backend/weight', 'location');
				
			// insert
			} else {	
				$data['weight_username_create'] = $this->session->userdata('session_username');
				$data['weight_datetime_create'] = date('Y-m-d H:i:s');
				$data['weight_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_product->insert_weight($data);
				
				redirect('product/backend/weight', 'location');
			}
		} else {
			$this->weight_form($id);
		}
	}
	
	public function weight_delete($id){
		$this->model_product->delete_weight($id);

		redirect('product/backend/weight','location');
	}
	// end weight

	// color	
	public function color() {
		
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
		$this->load->view('product/color/list', $data);
		/* end body */
	}
	
	public function color_server_processing() {
		$list = $this->model_color_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $color) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $color->color_id;
            
            if($color->color_image != '') {
				$row[] = '<img src="'.base_url('uploads/color/'.$color->color_image).'" width="36">';	
			} else {
				$row[] = '';
			}
			
            $row[] = $color->color_name_lang1;
            $row[] = $color->color_name_lang2;
            
			$row[] = '<a href="'.site_url('product/backend/color_form/'.$color->color_id).'">Edit</a> / <a href="'.site_url('product/backend/color_delete/'.$color->color_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_color_datatable->count_all(),
            "recordsFiltered" => $this->model_color_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function color_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_product->get_color_single($id);
		
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
		
		$this->load->view('product/color/form', $data);
	}
	
	public function color_save_update($id = ''){	
		
		$this->form_validation->set_rules('color_name_lang1', 'Color (En)', "trim|required");
		$this->form_validation->set_rules('color_name_lang2', 'Color (Myan)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'color_name_lang1' => $this->input->post('color_name_lang1'),
				'color_name_lang2' =>  $this->input->post('color_name_lang2'),
				'color_username_update' => $this->session->userdata('session_username'),
				'color_datetime_update' => date('Y-m-d H:i:s'),
				'color_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			if(!empty($_FILES['color_image'])) {
				$config['upload_path']          = FCPATH.'uploads/color/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('color_image')) {
                    $data_image = $this->upload->data();
                    
                    /*$config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/color/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/color/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 36;
					$config_resize['height'] = 36;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();*/
					
					$data['color_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_product->update_color($data, $id);
				
				redirect('product/backend/color', 'location');
				
			// insert
			} else {	
				$data['color_username_create'] = $this->session->userdata('session_username');
				$data['color_datetime_create'] = date('Y-m-d H:i:s');
				$data['color_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_product->insert_color($data);
				
				redirect('product/backend/color', 'location');
			}
		} else {
			$this->color_form($id);
		}
	}
	
	public function color_delete($id){
		$this->model_product->delete_color($id);

		redirect('product/backend/color','location');
	}
	// end color

	// collection	
	public function collection() {
		
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
		$this->load->view('product/collection/list', $data);
		/* end body */
	}
	
	public function collection_server_processing() {
		$list = $this->model_collection_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $collection) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $collection->collection_id;
            
            /*if($collection->collection_image != '') {
				$row[] = '<img src="'.base_url('uploads/collection/'.$collection->collection_image).'" width="36">';	
			} else {
				$row[] = '';
			}*/
			
            $row[] = $collection->collection_name_lang1;
            $row[] = $collection->collection_name_lang2;
            
			$row[] = '<a href="'.site_url('product/backend/collection_form/'.$collection->collection_id).'">Edit</a> / <a href="'.site_url('product/backend/collection_delete/'.$collection->collection_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_collection_datatable->count_all(),
            "recordsFiltered" => $this->model_collection_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function collection_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_product->get_collection_single($id);
		
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
		
		$this->load->view('product/collection/form', $data);
	}
	
	public function collection_save_update($id = ''){	
		
		$this->form_validation->set_rules('collection_name_lang1', 'Collection (En)', "trim|required");
		$this->form_validation->set_rules('collection_name_lang2', 'Collection (Myan)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'collection_name_lang1' => $this->input->post('collection_name_lang1'),
				'collection_name_lang2' =>  $this->input->post('collection_name_lang2'),
				'collection_username_update' => $this->session->userdata('session_username'),
				'collection_datetime_update' => date('Y-m-d H:i:s'),
				'collection_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			/*if(!empty($_FILES['collection_image'])) {
				$config['upload_path']          = FCPATH.'uploads/collection/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('collection_image')) {
                    $data_image = $this->upload->data();
                    
                    $config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/collection/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/collection/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 36;
					$config_resize['height'] = 36;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();
					
					$data['collection_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}*/
			
			// update 
			if($id != '') {	
				$this->model_product->update_collection($data, $id);
				
				redirect('product/backend/collection', 'location');
				
			// insert
			} else {	
				$data['collection_username_create'] = $this->session->userdata('session_username');
				$data['collection_datetime_create'] = date('Y-m-d H:i:s');
				$data['collection_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_product->insert_collection($data);
				
				redirect('product/backend/collection', 'location');
			}
		} else {
			$this->collection_form($id);
		}
	}
	
	public function collection_delete($id){
		$this->model_product->delete_collection($id);

		redirect('product/backend/collection','location');
	}
	// end collection

	// product	
	public function product() {
		
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
		$this->load->view('product/product/list', $data);
		/* end body */
	}
	
	public function product_server_processing() {
		$list = $this->model_product_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $product) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $product->product_id;
            
            if($product->product_image != '') {
				$row[] = '<img src="'.base_url('uploads/product/'.$product->product_image).'" width="150">';	
			} else {
				$row[] = '';
			}
			
            $row[] = $product->category1_name_lang1.' / '.$product->category1_name_lang2;
            $row[] = $product->category2_name_lang1.' / '.$product->category2_name_lang2;
            $row[] = $product->category3_name_lang1.' / '.$product->category3_name_lang2;
            $row[] = $product->product_name_lang1;
            $row[] = $product->product_name_lang2;
            $row[] = $product->product_property_lang1;
            $row[] = $product->product_property_lang2;
			$row[] = $product->product_weight;
            $row[] = $product->category3_weight;
            $row[] = $product->category3_color;
            $row[] = $product->category3_collection;
			$row[] = '<a href="'.site_url('product/backend/product_form/'.$product->product_id).'">Edit</a> / <a href="'.site_url('product/backend/product_delete/'.$product->product_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_product_datatable->count_all(),
            "recordsFiltered" => $this->model_product_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function product_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_product->get_product_single($id);

		$data['weightProductCtrl'] = $this->model_product->getWeightProductResult($id);

		$data['weightCtrl'] = $this->model_product->getWeightResult();
		$data['colorCtrl'] = $this->model_product->getColorResult();
		$data['collectionCtrl'] = $this->model_product->getCollectionResult();

		$data['productWeightColorCollectionCtrl'] = $this->model_product->getMapWeightColorCollection($id);

		$data['category1Ctrl'] = $this->model_product->getCategory1Result();
		if(!empty($data['row'])) {
			$data['category2Ctrl'] = $this->model_product->getCategory2Result($data['row']->category1_id);
			$data['category3Ctrl'] = $this->model_product->getCategory3Result($data['row']->category2_id);
		}

		$data['weightCtrl'] = $this->model_product->getWeightResult();
		
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
		
		$this->load->view('product/product/form', $data);
	}
	
	public function product_save_update($id = ''){	
		
		$this->form_validation->set_rules('product_star', 'Product Star', "trim|required");
		$this->form_validation->set_rules('category1_id', 'Category 1', "trim|required");
		$this->form_validation->set_rules('category2_id', 'Category 2', "trim|required");
		$this->form_validation->set_rules('category3_id', 'Category 3', "trim|required");
		$this->form_validation->set_rules('product_name_lang1', 'Product Name (En)', "trim|required");
		$this->form_validation->set_rules('product_name_lang2', 'Product Name (Myan)', "trim|required");
		$this->form_validation->set_rules('product_property_lang1', 'Product Property (En)', "trim|required");
		$this->form_validation->set_rules('product_property_lang2', 'Product Property (Myan)', "trim|required");
		$this->form_validation->set_rules('product_description_lang1', 'Product Description (En)', "trim|required");
		$this->form_validation->set_rules('product_description_lang2', 'Product Description (Myan)', "trim|required");
		$this->form_validation->set_rules('product_weight', 'Product Weight', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'product_star' => $this->input->post('product_star'),
				'category1_id' => $this->input->post('category1_id'),
				'category2_id' => $this->input->post('category2_id'),
				'category3_id' => $this->input->post('category3_id'),
				'product_name_lang1' => $this->input->post('product_name_lang1'),
				'product_name_lang2' => $this->input->post('product_name_lang2'),
				'product_property_lang1' => $this->input->post('product_property_lang1'),
				'product_property_lang2' => $this->input->post('product_property_lang2'),
				'product_description_lang1' => $this->input->post('product_description_lang1'),
				'product_description_lang2' => $this->input->post('product_description_lang2'),
				'product_weight' => $this->input->post('product_weight'),
				'product_username_update' => $this->session->userdata('session_username'),
				'product_datetime_update' => date('Y-m-d H:i:s'),
				'product_ip_update' => $_SERVER['REMOTE_ADDR']
			);

			if($this->input->post('product_suggest') != '') {
				$data['product_suggest'] = 'Yes';
			} else {
				$data['product_suggest'] = 'No';
			}

			if($this->input->post('product_promotion') != '') {
				$data['product_promotion'] = 'Yes';
			} else {
				$data['product_promotion'] = 'No';
			}

			if($this->input->post('product_new') != '') {
				$data['product_new'] = 'Yes';
			} else {
				$data['product_new'] = 'No';
			}
			
			if(!empty($_FILES['product_image'])) {
				$config['upload_path']          = FCPATH.'uploads/product/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('product_image')) {
                    $data_image = $this->upload->data();
                    
                    /*$config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/product/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/product/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 328;
					$config_resize['height'] = 321;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();*/
					
					$data['product_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}

			// update 
			if($id != '') {	
				$this->model_product->update_product($data, $id);

				$product_id = $id;
				
			// insert
			} else {	
				$data['product_username_create'] = $this->session->userdata('session_username');
				$data['product_datetime_create'] = date('Y-m-d H:i:s');
				$data['product_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_product->insert_product($data);
				
				$product_id = $this->model_product->getProductIdLasted();
			}

			$weight_id = $this->input->post('weight_id');
			$color_id = $this->input->post('color_id');
			$collection_id = $this->input->post('collection_id');

			// ลบที่มี Product ID ที่มีอยู่ใน Product Stock ก่อน
			$where = array(
				'product_id' => $product_id
			);

			$this->db->delete('ci_map_weight', $where);

			if(!empty($weight_id) and !empty($color_id) and !empty($collection_id)) {
				$i = 1;
				foreach($weight_id as $weight) {
					$j = 1;
					foreach($color_id as $color) {
						$k = 1;
						foreach($collection_id as $collection) {
							if(($i == $j) and ($j == $k)) {
								$data_stock = array(
									'product_id' => $product_id,
									'weight_id' => $weight,
									'color_id' => $color,
									'collection_id' => $collection,
									'map_weight_username_create' => $this->session->userdata('session_username'),
									'map_weight_datetime_create' => date('Y-m-d H:i:s'),
									'map_weight_ip_create' => $_SERVER['REMOTE_ADDR']
								);

								$this->db->insert('ci_map_weight', $data_stock);

								$this->db->where('product_id', $product_id);
								$this->db->where('weight_id', $weight);
								$this->db->where('color_id', $color);
								$this->db->where('collection_id', $collection);
								$query = $this->db->get('ci_product_stock');

								$row = $query->row();

								// ถ้ามีให้เฉยๆ ถ้าไม่มีให้ Insert
								if(empty($row)) {
									$data_product_stock = array(
										'product_id' => $product_id,
										'weight_id' => $weight,
										'color_id' => $color,
										'collection_id' => $collection,
										'product_stock_amount' => 0,
										'product_stock_username_create' => $this->session->userdata('session_username'),
										'product_stock_datetime_create' => date('Y-m-d H:i:s'),
										'product_stock_ip_create' => $_SERVER['REMOTE_ADDR']
									);

									$this->db->insert('ci_product_stock', $data_product_stock);
								}
							}

							$k++;
						}

						$j++;
					}

					$i++;
				}
			} elseif(empty($weight_id) and !empty($color_id) and !empty($collection_id)) {
				$j = 1;
				foreach($color_id as $color) {
					$k = 1;
					foreach($collection_id as $collection) {
						if($j ==  $k) {
							$data_stock = array(
								'product_id' => $product_id,
								'weight_id' => 0,
								'color_id' => $color,
								'collection_id' => $collection,
								'map_weight_username_create' => $this->session->userdata('session_username'),
								'map_weight_datetime_create' => date('Y-m-d H:i:s'),
								'map_weight_ip_create' => $_SERVER['REMOTE_ADDR']
							);

							$this->db->insert('ci_map_weight', $data_stock);

							$this->db->where('product_id', $product_id);
							$this->db->where('weight_id', 0);
							$this->db->where('color_id', $color);
							$this->db->where('collection_id', $collection);
							$query = $this->db->get('ci_product_stock');

							$row = $query->row();

							// ถ้ามีให้เฉยๆ ถ้าไม่มีให้ Insert
							if(empty($row)) {
								$data_product_stock = array(
									'product_id' => $product_id,
									'weight_id' => 0,
									'color_id' => $color,
									'collection_id' => $collection,
									'product_stock_amount' => 0,
									'product_stock_username_create' => $this->session->userdata('session_username'),
									'product_stock_datetime_create' => date('Y-m-d H:i:s'),
									'product_stock_ip_create' => $_SERVER['REMOTE_ADDR']
								);

								$this->db->insert('ci_product_stock', $data_product_stock);
							}
						}

						$k++;
					}

					$j++;
				}
			} elseif(!empty($weight_id) and empty($color_id) and !empty($collection_id)) {
				$i = 1;
				foreach($weight_id as $weight) {
					$k = 1;
					foreach($collection_id as $collection) {
						if($i ==  $k) {
							$data_stock = array(
								'product_id' => $product_id,
								'weight_id' => $weight,
								'color_id' => 0,
								'collection_id' => $collection,
								'map_weight_username_create' => $this->session->userdata('session_username'),
								'map_weight_datetime_create' => date('Y-m-d H:i:s'),
								'map_weight_ip_create' => $_SERVER['REMOTE_ADDR']
							);

							$this->db->insert('ci_map_weight', $data_stock);

							$this->db->where('product_id', $product_id);
							$this->db->where('weight_id', $weight);
							$this->db->where('color_id', 0);
							$this->db->where('collection_id', $collection);
							$query = $this->db->get('ci_product_stock');

							$row = $query->row();

							// ถ้ามีให้เฉยๆ ถ้าไม่มีให้ Insert
							if(empty($row)) {
								$data_product_stock = array(
									'product_id' => $product_id,
									'weight_id' => $weight,
									'color_id' => 0,
									'collection_id' => $collection,
									'product_stock_amount' => 0,
									'product_stock_username_create' => $this->session->userdata('session_username'),
									'product_stock_datetime_create' => date('Y-m-d H:i:s'),
									'product_stock_ip_create' => $_SERVER['REMOTE_ADDR']
								);

								$this->db->insert('ci_product_stock', $data_product_stock);
							}
						}

						$k++;
					}

					$i++;
				}	
			} elseif(!empty($weight_id) and !empty($color_id) and empty($collection_id)) {
				$i = 1;
				foreach($weight_id as $weight) {
					$j = 1;
					foreach($color_id as $color) {
						if($i == $j) {
							$data_stock = array(
								'product_id' => $product_id,
								'weight_id' => $weight,
								'color_id' => $color,
								'collection_id' => 0,
								'map_weight_username_create' => $this->session->userdata('session_username'),
								'map_weight_datetime_create' => date('Y-m-d H:i:s'),
								'map_weight_ip_create' => $_SERVER['REMOTE_ADDR']
							);

							$this->db->insert('ci_map_weight', $data_stock);

							$this->db->where('product_id', $product_id);
							$this->db->where('weight_id', $weight);
							$this->db->where('color_id', $color);
							$this->db->where('collection_id', 0);
							$query = $this->db->get('ci_product_stock');

							$row = $query->row();

							// ถ้ามีให้เฉยๆ ถ้าไม่มีให้ Insert
							if(empty($row)) {
								$data_product_stock = array(
									'product_id' => $product_id,
									'weight_id' => $weight,
									'color_id' => $color,
									'collection_id' => 0,
									'product_stock_amount' => 0,
									'product_stock_username_create' => $this->session->userdata('session_username'),
									'product_stock_datetime_create' => date('Y-m-d H:i:s'),
									'product_stock_ip_create' => $_SERVER['REMOTE_ADDR']
								);

								$this->db->insert('ci_product_stock', $data_product_stock);
							}
						}

						$j++;
					}

					$i++;
				}
			} elseif(empty($weight_id) and empty($color_id) and !empty($collection_id)) {
				$k = 1;
				foreach($collection_id as $collection) {
					$data_stock = array(
						'product_id' => $product_id,
						'weight_id' => 0,
						'color_id' => 0,
						'collection' => $collection,
						'map_weight_username_create' => $this->session->userdata('session_username'),
						'map_weight_datetime_create' => date('Y-m-d H:i:s'),
						'map_weight_ip_create' => $_SERVER['REMOTE_ADDR']
					);

					$this->db->insert('ci_map_weight', $data_stock);

					$this->db->where('product_id', $product_id);
					$this->db->where('weight_id', 0);
					$this->db->where('color_id', 0);
					$this->db->where('collection_id', $collection);
					$query = $this->db->get('ci_product_stock');

					$row = $query->row();

					// ถ้ามีให้เฉยๆ ถ้าไม่มีให้ Insert
					if(empty($row)) {
						$data_product_stock = array(
							'product_id' => $product_id,
							'weight_id' => 0,
							'color_id' => 0,
							'collection_id' => $collection,
							'product_stock_amount' => 0,
							'product_stock_username_create' => $this->session->userdata('session_username'),
							'product_stock_datetime_create' => date('Y-m-d H:i:s'),
							'product_stock_ip_create' => $_SERVER['REMOTE_ADDR']
						);

						$this->db->insert('ci_product_stock', $data_product_stock);
					}

					$k++;
				}
			} elseif(empty($weight_id) and !empty($color_id) and empty($collection_id)) {
				$k = 1;
				foreach($color_id as $color) {
					$data_stock = array(
						'product_id' => $product_id,
						'weight_id' => 0,
						'color_id' => $color,
						'collection_id' => 0,
						'map_weight_username_create' => $this->session->userdata('session_username'),
						'map_weight_datetime_create' => date('Y-m-d H:i:s'),
						'map_weight_ip_create' => $_SERVER['REMOTE_ADDR']
					);

					$this->db->insert('ci_map_weight', $data_stock);

					$this->db->where('product_id', $product_id);
					$this->db->where('weight_id', 0);
					$this->db->where('color_id', $color);
					$this->db->where('collection_id', 0);
					$query = $this->db->get('ci_product_stock');

					$row = $query->row();

					// ถ้ามีให้เฉยๆ ถ้าไม่มีให้ Insert
					if(empty($row)) {
						$data_product_stock = array(
							'product_id' => $product_id,
							'weight_id' => 0,
							'color_id' => $color,
							'collection_id' => 0,
							'product_stock_amount' => 0,
							'product_stock_username_create' => $this->session->userdata('session_username'),
							'product_stock_datetime_create' => date('Y-m-d H:i:s'),
							'product_stock_ip_create' => $_SERVER['REMOTE_ADDR']
						);

						$this->db->insert('ci_product_stock', $data_product_stock);
					}

					$k++;
				}
			} elseif(!empty($weight_id) and empty($color_id) and empty($collection_id)) {
				$k = 1;
				foreach($weight_id as $weight) {
					$data_stock = array(
						'product_id' => $product_id,
						'weight_id' => $weight,
						'color_id' => 0,
						'collection_id' => 0,
						'map_weight_username_create' => $this->session->userdata('session_username'),
						'map_weight_datetime_create' => date('Y-m-d H:i:s'),
						'map_weight_ip_create' => $_SERVER['REMOTE_ADDR']
					);

					$this->db->insert('ci_map_weight', $data_stock);

					$this->db->where('product_id', $product_id);
					$this->db->where('weight_id', $weight);
					$this->db->where('color_id', 0);
					$this->db->where('collection_id', 0);
					$query = $this->db->get('ci_product_stock');

					$row = $query->row();

					// ถ้ามีให้เฉยๆ ถ้าไม่มีให้ Insert
					if(empty($row)) {
						$data_product_stock = array(
							'product_id' => $product_id,
							'weight_id' => $weight,
							'color_id' => 0,
							'collection_id' => 0,
							'product_stock_amount' => 0,
							'product_stock_username_create' => $this->session->userdata('session_username'),
							'product_stock_datetime_create' => date('Y-m-d H:i:s'),
							'product_stock_ip_create' => $_SERVER['REMOTE_ADDR']
						);

						$this->db->insert('ci_product_stock', $data_product_stock);
					}

					$k++;
				}
			}

			redirect('product/backend/product', 'location');
		} else {
			$this->product_form($id);
		}
	}
	
	public function product_delete($id){
		$this->model_product->delete_product($id);

		redirect('product/backend/product','location');
	}
	// end product

	// product_gallery	
	public function product_gallery() {
		if($this->input->post('submit') != '') {
			$product_id = $this->input->post('product_id');

			if(!empty($product_id)) {
				foreach($product_id as $id) {
					$data = array(
						'product_stock_active' => 'No'
					);

					$where = array(
						'product_id' => $id
					);

					$this->db->update('ci_product_stock', $data, $where);

					$active_id = $this->input->post('product_stock_active_'.$id);

					$data = array(
						'product_stock_active' => 'Yes'
					);

					$where = array(
						'product_stock_id' => $active_id
					);

					$this->db->update('ci_product_stock', $data, $where);
				}
			}
		}

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
		$this->load->view('product/product_gallery/list', $data);
		/* end body */
	}
	
	public function product_gallery_server_processing() {
		$list = $this->model_product_gallery_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $product_gallery) {
            $no++;
            $row = array();

            if($product_gallery->product_stock_active == 'Yes') {
            	$checked = ' checked';
            } else {
            	$checked = '';
            }

            $row[] = '<input type="radio" name="product_stock_active_'.$product_gallery->product_id.'" value="'.$product_gallery->product_stock_id.'" '.$checked.'><input type="hidden" name="product_id[]" value="'.$product_gallery->product_id.'">';
            
            $row[] = $no;
            //$row[] = $product_gallery->product_stock_id;
			
            $row[] = $product_gallery->product_name_lang1.' / '.$product_gallery->product_name_lang2.' Product ID('.$product_gallery->product_id.')';

            if(!empty($product_gallery->weight_id)) {
            	$row[] = $this->model_product->get_weight_single($product_gallery->weight_id)->weight_name_lang1.' / '.$this->model_product->get_weight_single($product_gallery->weight_id)->weight_name_lang2;
            } else {
            	$row[] = '-';
            }

            if(!empty($this->model_product->get_color_single($product_gallery->color_id)->color_name_lang1) and $this->model_product->get_color_single($product_gallery->color_id)->color_name_lang2) {
            	$row[] = $this->model_product->get_color_single($product_gallery->color_id)->color_name_lang1.
				' / '.$this->model_product->get_color_single($product_gallery->color_id)->color_name_lang2;
            } else {
            	$row[] = '-';
            }
            
            if(!empty($product_gallery->collection_id)) {
            	$row[] = $this->model_product->get_collection_single($product_gallery->collection_id)->collection_name_lang1.' / '.$this->model_product->get_collection_single($product_gallery->collection_id)->collection_name_lang2;
            } else {
            	$row[] = '-';
            }
            
            $row[] = $product_gallery->product_code;
            $row[] = $product_gallery->product_before_discount_price_type1;
            $row[] = $product_gallery->product_price1;
            $row[] = $product_gallery->product_stock_amount;

            $gallery = $this->model_product->getProductGalleryResultLimit2($product_gallery->product_stock_id);
            
            $gallery_ = '';
            if(!empty($gallery)) {
            	foreach($gallery as $g) {
            		$gallery_ .= '<img src="'.base_url('uploads/product_gallery/'.$g->product_gallery_image).'" width="50">';
            	}
            }

            $row[] = $gallery_;
            
			$row[] = '<a href="'.site_url('product/backend/product_gallery_form/'.$product_gallery->product_stock_id).'">Add Gallery & Edit Data</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_product_gallery_datatable->count_all(),
            "recordsFiltered" => $this->model_product_gallery_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function product_gallery_form($product_stock_id) {	
		$data['product_stock_id'] = $product_stock_id;
		$data['row'] = $this->model_product->getProductStockRecord($product_stock_id);

		$data['rows'] = $this->model_product->getProductGalleryResult($product_stock_id);
		
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
		
		$this->load->view('product/product_gallery/form', $data);
	}
	
	public function product_gallery_save_update($product_stock_id){	
		$this->form_validation->set_rules('product_code', 'Product Code', "trim|required");
		$this->form_validation->set_rules('product_stock_amount', 'Stock', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'product_code' => $this->input->post('product_code'),
				'product_before_discount_price_type1' => $this->input->post('product_before_discount_price_type1'),
				'product_price1' => $this->input->post('product_price1'),
				//'product_before_discount_price_type2' => $this->input->post('product_before_discount_price_type2'),
				//'product_price2' => $this->input->post('product_price2'),
				'product_stock_amount' => $this->input->post('product_stock_amount'),
				'product_stock_username_create' => $this->session->userdata('session_username'),
				'product_stock_datetime_create' => date('Y-m-d H:i:s'),
				'product_stock_ip_create' => $_SERVER['REMOTE_ADDR']
			);

			if($this->input->post('product_stock_enable') == 'Enable') {
				$data['product_stock_enable'] = 'Enable';
			} else {
				$data['product_stock_enable'] = 'Disable';
			}

			$where = array(
				'product_stock_id' => $product_stock_id
			);

			$this->db->update('ci_product_stock', $data, $where);

			//pre($_FILES['product_gallery_image']);
			if(!empty($_FILES['product_gallery_image']['tmp_name'])) {
				$i = 0;
				foreach($_FILES['product_gallery_image']['tmp_name'] as $tmp_name) {
					$foo = new upload($_FILES['product_gallery_image']['tmp_name'][$i]); 
					if ($foo->uploaded) {
						$md5 = md5(rand());
   						// resized to 100px wide
   						$foo->file_new_name_body = $md5;
   						$foo->image_resize = true;
   						
   						if($_FILES['product_gallery_image']['type'][$i] == 'image/jpeg') {
   							$ext = 'jpg';
   						} elseif($_FILES['product_gallery_image']['type'][$i] == 'image/gif') {
   							$ext = 'gif';
   						} elseif($_FILES['product_gallery_image']['type'][$i] == 'image/png') {
   							$ext = 'png';
   						}

   						$foo->image_convert = $ext;
   						$foo->image_x = 474;
   						$foo->image_y = 510;
   						$foo->process(FCPATH.'uploads/product_gallery/');
   						if ($foo->processed) {
     						//echo 'image renamed, resized x=100 and converted to GIF';
     						$foo->clean();

     						$data = array(
     							'product_stock_id' => $product_stock_id,
     							'product_gallery_image' => $md5.'.'.$ext,
     							'product_gallery_username_create' => $this->session->userdata('session_username'),
								'product_gallery_datetime_create' => date('Y-m-d H:i:s'),
								'product_gallery_ip_create' => $_SERVER['REMOTE_ADDR']
     						);

     						$this->db->insert('ci_product_gallery', $data);
   						} else {
     						echo 'error : ' . $foo->error;
   						} 
					}  

					$i++;
				}
			}
			
			redirect('product/backend/product_gallery');
		} else {
			$this->product_gallery_form($product_stock_id);
		}
	}

	public function deleteGallery($product_stock_id, $product_gallery_id) {
		$where = array(
			'product_gallery_id' => $product_gallery_id
		);

		$this->db->delete('ci_product_gallery', $where);

		redirect('product/backend/product_gallery_form/'.$product_stock_id);
	}
	
	/*public function product_gallery_delete($id){
		$this->model_product->delete_product_gallery($id);

		redirect('product/backend/product_gallery','location');
	}*/
	// end product_gallery

	// ajax
	public function ajaxChangeCategory1() {
		$this->db->where('category1_id', $this->input->post('category1_id'));
		$this->db->order_by('category2_id', 'asc');
		$query = $this->db->get('ci_category2');

		echo '<option value="">Please Select</option>';

		$rows = $query->result();

		if(!empty($rows)) {
			foreach($rows as $r) {
?>
				<option value="<?php echo $r->category2_id;?>"><?php echo $r->category2_name_lang1.' / '.$r->category2_name_lang2;?></option>
<?php
			}
		}
	}

	public function ajaxChangeCategory2() {
		$this->db->where('category2_id', $this->input->post('category2_id'));
		$this->db->order_by('category3_id', 'asc');
		$query = $this->db->get('ci_category3');

		echo '<option value="">Please Select</option>';

		$rows = $query->result();

		if(!empty($rows)) {
			foreach($rows as $r) {
?>
				<option value="<?php echo $r->category3_id;?>"><?php echo $r->category3_name_lang1.' / '.$r->category3_name_lang2;?></option>
<?php
			}
		}
	}

	public function ajaxChangeCategory3() {
		$this->db->where('category3_id', $this->input->post('category3_id'));
		$query = $this->db->get('ci_category3');

		$row = $query->row();

		if(!empty($row)) {
			echo $row->category3_weight;

			echo '!@#$%^&*()';

			echo $row->category3_color;

			echo '!@#$%^&*()';

			echo $row->category3_collection;
		}
	}

	public function ajaxSortGallery() {
		$data = array(
			'product_gallery_sort' => $this->input->post('product_gallery_sort')
		);

		$where = array(
			'product_gallery_id' => $this->input->post('product_gallery_id')
		);

		$this->db->update('ci_product_gallery', $data, $where);
	}
	// end ajax
}
?>