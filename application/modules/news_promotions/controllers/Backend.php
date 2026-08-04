<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('news_promotions/model_news_promotions');
		$this->load->model('news_promotions/model_news_promotions_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/news_promotions/';
		
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
		$this->load->view('news_promotions/news_promotions/list', $data);
		/* end body */
	}
	
	public function server_processing() {
		$list = $this->model_news_promotions_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $news_promotions) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $news_promotions->news_promotions_id;
            $row[] = $news_promotions->news_promotions_type;
            if($news_promotions->news_promotions_image != '') {
				$row[] = '<img src="'.base_url('uploads/news_promotions/'.$news_promotions->news_promotions_image).'" width="150">';	
			} else {
				$row[] = '';
			}
            $row[] = $news_promotions->news_promotions_name_lang1;
            $row[] = $news_promotions->news_promotions_name_lang2;
 			$row[] = '<a href="'.site_url('news_promotions/backend/form/'.$news_promotions->news_promotions_id).'">Edit</a> / <a href="'.site_url('news_promotions/backend/delete/'.$news_promotions->news_promotions_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_news_promotions_datatable->count_all(),
            "recordsFiltered" => $this->model_news_promotions_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_news_promotions->get_data_single($id);
		$data['rows'] = $this->model_news_promotions->getNewsPromotionsGallery($id);
		
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
		
		$this->load->view('news_promotions/news_promotions/form', $data);
	}
	
	public function save_update($id = ''){	
		
		$this->form_validation->set_rules('news_promotions_date', 'Date', "trim|required");
		$this->form_validation->set_rules('news_promotions_name_lang1', 'Name Lang(En)', "trim|required");
		$this->form_validation->set_rules('news_promotions_name_lang2', 'Name Lang(Myan)', "trim|required");
		$this->form_validation->set_rules('news_promotions_description_lang1', 'Description Lang(En)', "trim|required");
		$this->form_validation->set_rules('news_promotions_description_lang2', 'Description Lang(Myan)', "trim|required");
		$this->form_validation->set_rules('news_promotions_detail_lang1', 'Detail Lang(En)', "trim|required");
		$this->form_validation->set_rules('news_promotions_detail_lang2', 'Detail Lang(Myan)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'news_promotions_date' => $this->input->post('news_promotions_date'),
				'news_promotions_type' => $this->input->post('news_promotions_type'),
				'news_promotions_name_lang1' =>  $this->input->post('news_promotions_name_lang1'),
				'news_promotions_name_lang2' =>  $this->input->post('news_promotions_name_lang2'),
				'news_promotions_description_lang1' =>  $this->input->post('news_promotions_description_lang1'),
				'news_promotions_description_lang2' =>  $this->input->post('news_promotions_description_lang2'),
				'news_promotions_detail_lang1' =>  $this->input->post('news_promotions_detail_lang1'),
				'news_promotions_detail_lang2' =>  $this->input->post('news_promotions_detail_lang2'),
				'news_promotions_username_update' => $this->session->userdata('session_username'),
				'news_promotions_datetime_update' => date('Y-m-d H:i:s'),
				'news_promotions_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			if(!empty($_FILES['news_promotions_image'])) {
				$config['upload_path']          = FCPATH.'uploads/news_promotions/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('news_promotions_image')) {
                    $data_image = $this->upload->data();
                    
                    /*$config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/news_promotions/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/news_promotions/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 790;
					$config_resize['height'] = 541;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();*/
					
					$data['news_promotions_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_news_promotions->update_data($data, $id);
				
				$news_promotions_id = $id;	
			// insert
			} else {	
				$data['news_promotions_username_create'] = $this->session->userdata('session_username');
				$data['news_promotions_datetime_create'] = date('Y-m-d H:i:s');
				$data['news_promotions_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_news_promotions->insert_data($data);

				$id = $this->model_news_promotions->getNewsPromotionsID();

				$news_promotions_id = $id;
			}

			$this->load->library('upload');
			
			// upload		
			if(!empty($_FILES['news_promotions_gallery_image'])) {
				$i = 0;
				foreach($_FILES['news_promotions_gallery_image']['tmp_name'] as $f) {
					$foo = new upload($_FILES['news_promotions_gallery_image']['tmp_name'][$i]); 
					if ($foo->uploaded) {
						if($_FILES['news_promotions_gallery_image']['type'][$i] == 'image/jpeg') {
							$ext = 'jpg';
						} elseif($_FILES['news_promotions_gallery_image']['type'][$i] == 'image/png') {
							$ext = 'png';
						} elseif($_FILES['news_promotions_gallery_image']['type'][$i] == 'image/gif') {
							$ext = 'gif';
						}
						
					   	// save uploaded image with a new name,
					   	// resized to 100px wide
					   	$md5 = md5(rand());
					   	$foo->file_new_name_body = $md5;
					   	$foo->image_resize = true;
					   	$foo->image_convert = $ext;
					   	$foo->image_x = 790;
					   	$foo->image_y = 541;
					   	$foo->Process(FCPATH.'/uploads/news_promotions/');
					   	if ($foo->processed) {
					     	//echo 'image renamed, resized x=100 and converted to GIF';
					        $data_gallery = array(
					        	'news_promotions_id' => $news_promotions_id,
					        	'news_promotions_gallery_image' => $md5.'.'.$ext,
					        	'news_promotions_gallery_username_create' => $this->session->userdata('session_username'),
								'news_promotions_gallery_datetime_create' => date('Y-m-d H:i:s'),
								'news_promotions_gallery_ip_create' => $_SERVER['REMOTE_ADDR']
					        );

					        $this->db->insert('ci_news_promotions_gallery', $data_gallery);

					     	$foo->Clean();
					   	} else {
					     	echo 'error : ' . $foo->error;
					   	} 
					   	
					   	//echo '<img src="'.base_url('/uploads/car/'.$md5.'.gif').'">';
					   	//exit;
					}
					$i++;
				}
			}

			//pre($_FILES);

			//exit;

			redirect('news_promotions/backend/index', 'location');
				
		} else {
			$this->form($id);
		}
	}
	
	public function delete($id){
		$this->model_news_promotions->delete_data($id);

		redirect('news_promotions/backend/index','location');
	} 

	public function deleteGallery($news_promotions_gallery_id, $news_promotions_id) {
		$where = array(
			'news_promotions_gallery_id' => $news_promotions_gallery_id
		);

		$this->db->delete('ci_news_promotions_gallery', $where);

		redirect('news_promotions/backend/form/'.$news_promotions_id);
	}
}
?>