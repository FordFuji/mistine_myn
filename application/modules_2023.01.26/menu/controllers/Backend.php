<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('menu/model_menu');
		$this->load->model('menu/model_menu_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->path_upload= FCPATH. 'uploads/menu/';
		
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
		$this->load->view('menu/menu/list', $data);
		/* end body */
	}
	
	public function server_processing() {
		$list = $this->model_menu_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $menu) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $menu->menu_name;
            $row[] = $menu->menu_controller;
            $row[] = $menu->menu_sort;
            if($menu->menu_enable == '1') {
            	$menu_enable = 'Enable';
            } else {
            	$menu_enable = 'Disable';
            }
            $row[] = $menu_enable;
            $row[] = $menu->menu_link;
 			$row[] = '<a href="'.site_url('menu/backend/form/'.$menu->menu_id).'">Edit</a> / <a href="'.site_url('menu/backend/delete/'.$menu->menu_id).'" onclick="return confirm(\'Confirm Delete\');">Delete</a>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_menu_datatable->count_all(),
            "recordsFiltered" => $this->model_menu_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function form($msg = NULL){	
		$data['messages'] = $msg;
		$data['id'] = $msg;
		$data['row'] = $this->model_menu->get_data_single($msg);
		
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
		
		$this->load->view('menu/menu/form', $data);
	}
	
	public function save_update($id = ''){	
		
		$this->form_validation->set_rules('menu_name', 'Name', "trim|required");
		$this->form_validation->set_rules('menu_controller', 'Path', "trim|required");
		$this->form_validation->set_rules('menu_sort', 'Sort', "trim|required");
		$this->form_validation->set_rules('menu_enable', 'Enable', "trim|required");
		$this->form_validation->set_rules('menu_link', 'Link', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'menu_name' => $this->input->post('menu_name'),
				'menu_controller' =>  $this->input->post('menu_controller'),
				'menu_sort' =>  $this->input->post('menu_sort'),
				'menu_enable' =>  $this->input->post('menu_enable'),
				'menu_link' =>  $this->input->post('menu_link')
			);
			
			// start upload file 
			/*$config_EVE_imgdetail['upload_path'] = $this->path_upload;
			$config_EVE_imgdetail['allowed_types'] = 'gif|jpg|png';
			$config_EVE_imgdetail['max_size'] = '6000';
			$config_EVE_imgdetail['encrypt_name'] = TRUE;
				
			$this->upload->initialize($config_EVE_imgdetail);
				
			if($this->upload->do_upload('EVE_image')){
				$image_data = $this->upload->data();
													
				$config_thumb = array(
					'source_image' => $image_data['full_path'],
					'maintain_ratio' => FALSE,
					'width' => 108,
					'height' => 108
				);
										
				$this->image_lib->initialize($config_thumb);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$data['EVE_image'] = $image_data['file_name'];		
			} else {
				$msg = $this->upload->display_errors('<div class="notification error png_bg"><a href="#" class="close">
				<img src="'.base_url('asset/backoffice/images/icons/cross_grey_small.png').'" title="Close this notification" alt="close" /></a><div>',
				'</div></div>');
			}*/
			// end upload file 
			
			// update 
			if($id != '') {
				//$data['menu_update'] = $this->config->item('now');
				//$data['menu_userupdate'] = $this->session->userdata('session_user_department');
					
				$this->model_menu->update_data($data, $id);
				
				$this->session->set_flashdata('success','Update menu complete.');
				redirect('menu/backend/index','location');
				
			// insert
			} else {	
				//$data['menu_add'] = $this->config->item('now');
				//$data['menu_update'] = $this->config->item('now');
				//$data['menu_userupdate'] = $this->session->userdata('session_user_department');
					
				$this->model_menu->insert_data($data);
				
				$this->session->set_flashdata('success','Insert menu complete.');
				redirect('menu/backend/index','location');
				
			}
		} else {
			$this->form($id);
		}
	}
	
	public function delete($param1=NULL){
		$del_data = $param1;
		//$row = $this->model_menu->get_for_update($del_data);
		$this->model_menu->delete_data($del_data);
		$this->session->set_flashdata('success','Delete program and package complete');
		redirect('menu/backend/index','location');
	} 
}
?>