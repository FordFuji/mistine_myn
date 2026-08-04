<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('model_login');
			
		$date = new DateTime();
	}
	
	/* start login */
	
	public function index() {

		$this->load->view('login/login/login');
	}
	
	public function ajax_login() {
		$row_admin = $this->model_login->chk_password_admin($this->input->post("username"), $this->input->post("password"));
		if(!empty($row_admin)) {
			$session_admin = array(
				'session_login' => true,
				'session_user_id' => $row_admin->user_id,
				'session_user_department' => $row_admin->department_id,
				'session_username' => $row_admin->user_username
			);
			$this->session->set_userdata($session_admin);
			echo $this->session->userdata('session_user_department');
		} else {
			echo '0';
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		
		redirect('login/backend','location');
	}
	
	/* end login */
	
	public function random() {
		// Random Product 1 Day
		ini_set('max_execution_time', 3600);
		
		$this->model_login->randomProduct();
		
		echo 'Random Success';
		
?>
		<script>
			window.close();
		</script>
<?php
	}
}