<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Path extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		if($this->session->userdata('lang') == '') {
			$session_lang = array(
				'lang' => 'en'
			);

			$this->session->set_userdata($session_lang);
		} else {
			if($this->input->get('lang') == 'en') {
				$session_lang = array(
					'lang' => 'en'
				);

				$this->session->set_userdata($session_lang);
			} elseif($this->input->get('lang') == 'bur') {
				$session_lang = array(
					'lang' => 'bur'
				);

				$this->session->set_userdata($session_lang);
			}
		}

		//pre($this->session->all_userdata());
		
		$this->load->model('frontend/model_frontend');

		$this->load->library('cart');

		// Load google oauth library 
        //$this->load->library('google'); 

		//$this->session->sess_destroy();
	}
	
	public function index() {
		// Copy จากหน้า confirmCreditCard มา
		if(!empty($_REQUEST["payment_status"])) {
			$payment_status = $_REQUEST["payment_status"];

			if(!empty($_REQUEST["channel_response_code"]) and $_REQUEST["channel_response_code"] == 001) {
				$data_insert = array(
					'transaction_ref' => $_REQUEST['transaction_ref'],
					'transaction_datetime' => $_REQUEST['transaction_datetime'],
					'channel_response_code' => $_REQUEST['channel_response_code'],
					'channel_response_desc' => $_REQUEST['channel_response_desc'],
					'log_2c2p_123_datetime_create' => date('Y-m-d H:i:s'),
					'log_2c2p_123_ip_create' => $_SERVER['REMOTE_ADDR']
				);

				$this->db->insert('ci_log_2c2p_123');
			}

			if(!empty($payment_status) and $payment_status == 000) {
				$this->db->order_by('ci_check_order.order_detail_id', 'desc');
				$this->db->join('ci_order_detail', 'ci_check_order.order_detail_id = ci_order_detail.order_detail_id and ci_check_order.total_price = ci_order_detail.order_detail_total', 'inner');
				$this->db->where('ci_check_order.order_detail_status', 'Order');
				$this->db->where('ci_check_order.ip', $_SERVER['REMOTE_ADDR']);
				$this->db->where('ci_check_order.datetime_ <=', date('Y-m-d H:i:s'));
				$this->db->limit(1);
				$query = $this->db->get('ci_check_order');

				$row = $query->row();

				if(!empty($row)) {
					$data_update = array(
						'order_detail_status' => 'Processing',
						'order_detail_datetime_update' => date('Y-m-d H:i:s'),
						'order_detail_ip_update' => $_SERVER['REMOTE_ADDR']
					);

					$where_update = array(
						'order_detail_id' => $row->order_detail_id
					);

					$this->db->update('ci_order_detail', $data_update, $where_update);

					$data_update = array(
						'order_detail_status' => 'Processing'
					);

					$where_update = array(
						'order_detail_id' => $row->order_detail_id
					);

					$this->db->update('ci_check_order', $data_update, $where_update);

					//redirect(site_url('frontend/path/confirm_credit_card/'.$row->order_detail_id));

					redirect();
				}
			}
			// End Copy จากหน้า confirmCreditCard มา
		}
		

		$data['bannerSlideCtrl'] = $this->model_frontend->getBannerSlideResult();

		$data['productNewCtrl'] = $this->model_frontend->getProductNewResult();

		$data['productSuggestCtrl'] = $this->model_frontend->getProductSuggestResult();

		$data['topRanking'] = $this->model_frontend->getTopRanking();

		$data['category1Ctrl'] = $this->model_frontend->getCategory1Result();

		$data['categoryVoucherCtrl'] = $this->model_frontend->getCategoryVoucherActive();

		$data['promotionBannerCtrl'] = $this->model_frontend->getPromotionBannerList();

		if(!empty($data['categoryVoucherCtrl'])) {
			$data_sess = array(
				'category_voucher_id' => $data['categoryVoucherCtrl']->category_voucher_id
			);

			$this->session->set_userdata($data_sess);
		}
		
		$this->load->view('frontend/frontend/index', $data);
	} 

	public function service() {
		echo 'Service';
	}

	public function delete() {
		echo 'Delete';
	}

	public function about() {
		$data['test'] = 'Test';
		
		$this->load->view('frontend/frontend/about', $data);
	} 

	public function cart_shopping() {
		if(empty($this->cart->contents())) {
			redirect(site_url());
		}

		$this->db->where('ci_map_voucher.member_id', $this->session->userdata('member_id'));
		$this->db->where('ci_map_voucher.voucher_id', $this->session->userdata('voucher_id'));
		$this->db->where('ci_voucher.voucher_expired_date >=', date('Y-m-d'));
		$this->db->join('ci_voucher', 'ci_map_voucher.voucher_id = ci_voucher.voucher_id', 'inner');
		$query = $this->db->get('ci_map_voucher');

		$row = $query->row();

		$voucher_price = 0;
		if(!empty($row)) {
			if($row->voucher_type == 'KS') {
				$voucher_price = $row->voucher_price;
			} elseif($row->voucher_type == '%') {
				$sub_total = 0;
				foreach($this->cart->contents() as $items) {
					$price = $items['qty'] * $items['price'];

					$sub_total += $price;
				}

				$voucher_price = $sub_total * $row->voucher_price / 100;
			}

			$data_session_voucher_price = array(
				'voucher_price' => $voucher_price
			);

			$this->session->set_userdata($data_session_voucher_price);
		}

		$data['voucherMemberValidCtrl'] = $this->model_frontend->getMemberVoucher('valid');
		$data['test'] = 'Test';

		if($this->session->userdata('voucher_id') != '') {
			
		}
		
		$this->load->view('frontend/frontend/cart_shopping', $data);
	} 

	public function confirm($order_detail_id) {
		$data['row'] = $this->model_frontend->getOrderDetailRecord($order_detail_id);

		if(!empty($data['row'])) {
			$this->db->where('rate_shipping_township', $data['row']->shipping_township);
			$query = $this->db->get('ci_rate_shipping');

			$row = $query->row();
			if(!empty($row)) {
				$data['date'] = $row->rate_shipping_delivered_date;
			}
		}
		
		$this->load->view('frontend/frontend/confirm', $data);
	} 

	public function contact() {
		$this->load->helper('captcha');

		$vals = array(
	        //'word'          => 'Random word',
	        'img_path'      => './captcha/',
	        'img_url'       => base_url('captcha'),
	        'font_path'     => './path/to/fonts/texb.ttf',
	        'img_width'     => '150',
	        'img_height'    => 30,
	        'expiration'    => 7200,
	        'word_length'   => 8,
	        'font_size'     => 16,
	        'img_id'        => 'Imageid',
	        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

	        // White background and border, black text and red grid
	        'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
	        )
		);

		$cap = create_captcha($vals);
		$data = array(
	        'captcha_time'  => $cap['time'],
	        'ip_address'    => $this->input->ip_address(),
	        'word'          => $cap['word']
		);

		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
		
		$data['captcha'] = $cap['image'];

		$data['test'] = 'Test';
		
		$this->load->view('frontend/frontend/contact', $data);
	} 

	public function login() {
		if($this->session->userdata('member_id') != ''){ 
            redirect(); 
        }   
		
		$data['test'] = 'Test';

		$this->load->view('frontend/frontend/login', $data);
	}

	public function callback_google() {
		//Include Google Client Library for PHP autoload file
		require_once FCPATH.'vendor/autoload.php';

		// Google Project API Credentials
		$clientId = '766322749137-4vifcva65njviaagh376blv1d04ffqfk.apps.googleusercontent.com';
		$clientSecret = 'YQgFtTmBcGVYBDh0qgr-vm2f';
		$redirectUrl = site_url('frontend/path/callback_google');

		//Make object of Google API Client for call Google API
		$google_client = new Google_Client();

		//Set the OAuth 2.0 Client ID
		$google_client->setClientId($clientId);

		//Set the OAuth 2.0 Client Secret key
		$google_client->setClientSecret($clientSecret);

		//Set the OAuth 2.0 Redirect URI
		$google_client->setRedirectUri($redirectUrl);

		//
		$google_client->addScope('email');
		$google_client->addScope('profile');
		
		if(isset($_GET["code"]))
		{

			//It will Attempt to exchange a code for an valid authentication token.
			$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

			//pre($token);

			//This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
			if(!isset($token['error']))
			{
				//Set the access token used for requests
				$google_client->setAccessToken($token['access_token']);

				//Store "access_token" value in $_SESSION variable for future use.
				$_SESSION['access_token'] = $token['access_token'];

				//Create Object of Google Service OAuth 2 class
				$google_service = new Google_Service_Oauth2($google_client);

				//Get user profile data from google
				$data = $google_service->userinfo->get();

				//Below you can find Get profile data and store into $_SESSION variable
			 
				// Start
				$this->db->where('member_email', $data['email']);
				$query = $this->db->get('ci_member');

				$row = $query->row();

				if(!empty($row)) {
					// update
					$where = array(
						'member_email' => $data['email']
					);

					$data = array(
						'member_first_name' => $data['given_name'],
						'member_last_name' => $data['family_name'],
						'member_datetime_update'=> date('Y-m-d H:i:s'),
						'member_ip_update' => $_SERVER['REMOTE_ADDR']
					);

					$this->db->update('ci_member', $data, $where);

					$data_sess = array(
						'member_id' => $row->member_id
					);

					$this->session->set_userdata($data_sess);
				} else {
					// insert
					$data = array(
						'member_email' => $data['email'],
						'member_first_name' => $data['given_name'],
						'member_last_name' => $data['family_name'],
						'member_datetime_create'=> date('Y-m-d H:i:s'),
						'member_ip_create' => $_SERVER['REMOTE_ADDR'],
						'member_datetime_update'=> date('Y-m-d H:i:s'),
						'member_ip_update' => $_SERVER['REMOTE_ADDR']
					);

					$this->db->insert('ci_member', $data);

					$this->db->order_by('member_id', 'desc');
					$this->db->limit(1);
					$query = $this->db->get('ci_member');

					$row = $query->row();

					if(!empty($row)) {
						$data_sess = array(
							'member_id' => $row->member_id
						);

						$this->session->set_userdata($data_sess);
					}
				}

				redirect(site_url());
			}
		}

		if(isset($_GET['code'])){ 
             
            // Authenticate user with google 
            if($this->google->getAuthenticate()){ 
             
                // Get user info from google 
                $gpInfo = $this->google->getUserInfo(); 
                 
                // Preparing data for database insertion 
                $userData['oauth_provider'] = 'google'; 
                $userData['oauth_uid']         = $gpInfo['id']; 
                $userData['first_name']     = $gpInfo['given_name']; 
                $userData['last_name']         = $gpInfo['family_name']; 
                $userData['email']             = $gpInfo['email']; 
                $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:''; 
                $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:''; 
                $userData['picture']         = !empty($gpInfo['picture'])?$gpInfo['picture']:''; 
                 
                // Insert or update user data to the database 
                $userID = $this->user->checkUser($userData); 
                 
                // Store the status and user profile info into session 
                $this->session->set_userdata('loggedIn', true); 
                $this->session->set_userdata('userData', $userData); 
                 
                // Redirect to profile page 
                // Start
				$this->db->where('member_email', $userData['email']);
				$query = $this->db->get('ci_member');

				$row = $query->row();

				if(!empty($row)) {
					// update
					$where = array(
						'member_email' => $userData['email']
					);

					$data = array(
						'member_first_name' => $userData['given_name'],
						'member_last_name' => $userData['family_name'],
						'member_datetime_update'=> date('Y-m-d H:i:s'),
						'member_ip_update' => $_SERVER['REMOTE_ADDR']
					);

					$this->db->update('ci_member', $data, $where);

					$data_sess = array(
						'member_id' => $row->member_id
					);

					$this->session->set_userdata($data_sess);
				} else {
					// insert
					$data = array(
						'member_email' => $userData['email'],
						'member_first_name' => $userData['given_name'],
						'member_last_name' => $userData['family_name'],
						'member_datetime_create'=> date('Y-m-d H:i:s'),
						'member_ip_create' => $_SERVER['REMOTE_ADDR'],
						'member_datetime_update'=> date('Y-m-d H:i:s'),
						'member_ip_update' => $_SERVER['REMOTE_ADDR']
					);

					$this->db->insert('ci_member', $data);

					$this->db->order_by('member_id', 'desc');
					$this->db->limit(1);
					$query = $this->db->get('ci_member');

					$row = $query->row();

					if(!empty($row)) {
						$data_sess = array(
							'member_id' => $row->member_id
						);

						$this->session->set_userdata($data_sess);
					}
				}

				redirect(site_url());
            } 
        }
	}

	public function member1() {
		if($this->session->userdata('member_id') == '') {
			redirect('frontend/path/index');
		}

		$data['memberCtrl'] = $this->model_frontend->getMemberPersonal();

		$data['shipping1Ctrl'] = $this->model_frontend->getMemberShippingAddress1();

		$data['shipping'] = $this->model_frontend->getMemberShippingAddress();

		$data['billingCtrl'] = $this->model_frontend->getMemberBillingAddress();
		
		$this->load->view('frontend/frontend/member1', $data);
	} 

	public function member2() {
		if($this->session->userdata('member_id') == '') {
			redirect('frontend/path/index');
		}

		if($this->input->post('submit') != '') {
			$data = array(
				'member_first_name' => $this->input->post('member_first_name'),
				'member_last_name' => $this->input->post('member_last_name'),
				'member_phone' => $this->input->post('member_phone'),
				'member_email' => $this->input->post('member_email'),
				'member_address' => $this->input->post('member_address'),
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
					$config_resize['width'] = 992;
					$config_resize['height'] = 992;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();*/
					
					$data['member_image'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}

			$where = array(
				'member_id' => $this->session->userdata('member_id')
			);

			$this->db->update('ci_member', $data, $where);
		}

		$data['memberCtrl'] = $this->model_frontend->getMemberPersonal();
		
		$this->load->view('frontend/frontend/member2', $data);
	} 

	public function member3() {
		if($this->session->userdata('member_id') == '') {
			redirect('frontend/path/index');
		}

		if($this->input->post('submit_shipping') != '') {
			$where = array(
				'member_id' => $this->session->userdata('member_id')
			);

			$this->db->delete('ci_member_shipping_address', $where);

			$member_shipping_address_address = $this->input->post('member_shipping_address_address');
			$member_shipping_address_sub_district = $this->input->post('member_shipping_address_sub_district');
			$shipping_township = $this->input->post('shipping_township');
			$shipping_location = $this->input->post('shipping_location');
			$member_shipping_address_postal_code = $this->input->post('member_shipping_address_postal_code');

			if(!empty($member_shipping_address_address)) {
				$i = 0;
				$j = 1;
				foreach($member_shipping_address_address as $r) {

					$data_insert_or_update = array(
						'member_id' => $this->session->userdata('member_id'),
						'member_shipping_no' => $j,
						'member_shipping_address_address' => $member_shipping_address_address[$i],
						'member_shipping_address_sub_district' => $member_shipping_address_sub_district[$i],
						'shipping_township' => $shipping_township[$i],
						'shipping_location' => $shipping_location[$i],
						'member_shipping_address_postal_code' => $member_shipping_address_postal_code[$i],
						'member_shipping_address_datetime_update' => date('Y-m-d H:i:s'),
						'member_shipping_address_ip_update' => $_SERVER['REMOTE_ADDR'],
					);

					// insert
					$data_insert_or_update['member_shipping_address_datetime_create'] = date('Y-m-d H:i:s');
					$data_insert_or_update['member_shipping_address_ip_create'] = $_SERVER['REMOTE_ADDR'];
					$data_insert_or_update['member_id'] = $this->session->userdata('member_id');

					$this->db->insert('ci_member_shipping_address', $data_insert_or_update);

					$i++;
					$j++;
				}
			}

			$data = array(
				'member_shipping_active' => 'No'
			);

			$where = array(
				'member_id' => $this->session->userdata('member_id')
			);

			$this->db->update('ci_member_shipping_address', $data, $where);

			$data = array(
				'member_shipping_active' => 'Yes'
			);

			//$where_sub_query = "(select member_shipping_address_id from ci_member_shipping_address where member_id = ".$this->session->userdata('member_id')." order by member_shipping_address_id asc limit ".$j.", 1)";

			$this->db->where('member_id', $this->session->userdata('member_id'));
			$this->db->where('member_shipping_no', $this->input->post('member_shipping_active'));

			$this->db->update('ci_member_shipping_address', $data, $where);
		}

		if($this->input->post('submit_billing') != '') {
			$data_insert_or_update = array(
				'member_billing_name_surname' => $this->input->post('member_billing_name_surname'),
				'member_billing_tax_number' => $this->input->post('member_billing_tax_number'),
				'member_billing_branch_office' => $this->input->post('member_billing_branch_office'),
				'member_billing_phone' => $this->input->post('member_billing_phone'),
				'member_billing_address' => $this->input->post('member_billing_address'),
				'member_billing_datetime_update' => date('Y-m-d H:i:s'),
				'member_billing_ip_update' => $_SERVER['REMOTE_ADDR'],
			);

			$this->db->where('member_id', $this->session->userdata('member_id'));
			$query = $this->db->get('ci_member_billing');

			$row_insert_update = $query->row();

			if(!empty($row_insert_update)) {
				// update
				$where = array(
					'member_id' => $this->session->userdata('member_id')
				);

				$this->db->update('ci_member_billing', $data_insert_or_update, $where);
			} else {
				// insert
				$data_insert_or_update['member_billing_datetime_create'] = date('Y-m-d H:i:s');
				$data_insert_or_update['member_billing_ip_create'] = $_SERVER['REMOTE_ADDR'];
				$data_insert_or_update['member_id'] = $this->session->userdata('member_id');

				$this->db->insert('ci_member_billing', $data_insert_or_update);
			}
		}

		$data['shipping'] = $this->model_frontend->getMemberShippingAddress();
		//$data['shipping2'] = $this->model_frontend->getMemberShippingAddress2();

		$data['billing'] = $this->model_frontend->getMemberBillingAddress();

		$data['location'] = $this->model_frontend->getShippingLocation();

		$data['provinceCtrl'] = $this->model_frontend->getProvinceResult();
		
		$this->load->view('frontend/frontend/member3', $data);
	} 

	public function member4() {
		if($this->session->userdata('member_id') == '') {
			redirect('frontend/path/index');
		}

		$data['wishlistCtrl'] = $this->model_frontend->getWishlist();
		
		$this->load->view('frontend/frontend/member4', $data);
	} 

	public function member5() {
		if($this->session->userdata('member_id') == '') {
			redirect('frontend/path/index');
		}

		$data['memberCtrl'] = $this->model_frontend->getMemberPersonal();
		
		$this->load->view('frontend/frontend/member5', $data);
	} 

	public function member6() {
		if($this->session->userdata('member_id') == '') {
			redirect('frontend/path/index');
		}

		$data['memberCtrl'] = $this->model_frontend->getMemberPersonal();

		$data['sumVoucherValid'] = count($this->model_frontend->getMemberVoucher('valid'));
		$data['sumVoucherUse'] = count($this->model_frontend->getMemberVoucher('use'));

		$data['voucherMemberValidCtrl'] = $this->model_frontend->getMemberVoucher('valid');
		$data['voucherMemberUseCtrl'] = $this->model_frontend->getMemberVoucher('use');
		
		$this->load->view('frontend/frontend/member6', $data);
	}

	public function vouchers() {
		if($this->session->userdata('member_id') == '') {
			redirect('frontend/path/index');
		}
		
		$data['voucherCtrl'] = $this->model_frontend->getVoucherResult();

		$data['categoryVoucherCtrl'] = $this->model_frontend->getCategoryVoucherSessionResult();

		$this->load->view('frontend/frontend/vouchers', $data);
	}

	public function news_promotions() {
		$data['top'] = $this->model_frontend->getNewsAndPromotionsRecord();

		$data['newsRightCtrl'] = $this->model_frontend->getNewsAndPromotionSideRight();


		$this->load->library('pagination');
		
		// pagination
		$config['base_url'] = site_url('frontend/path/news_promotions');
		$config['total_rows'] = count($this->model_frontend->getPromotionsResultAll());
		
		$config['per_page'] = 3;
		
		$config['page_query_string'] = TRUE;
		
		// config
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['cur_tag_open'] = '<li class="page-item page-link active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li class="page-item page-link">';
		$config['num_tag_close'] = '</li>';
		
		$config['first_link'] = ' << ';
		$config['first_tag_open'] = '<li class="page-item page-link">';
		$config['first_tag_close'] = '</li>';
		
		$config['prev_link'] = ' < ';
		$config['prev_tag_open'] = '<li class="page-item page-link">';
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = ' > ';
		$config['next_tag_open'] = '<li class="page-item page-link">';
		$config['next_tag_close'] = '</li>';
		
		$config['last_link'] = ' >> ';
		$config['last_tag_open'] = '<li class="page-item page-link">';
		$config['last_tag_close'] = '</li>';
		
		// end config
		if($this->input->get('per_page') != '') {
			$limit = 3;
			$offset = $this->input->get('per_page');
		} else {
			$limit = 3;
			$offset = 0;
		}
		
		$data['promotionCtrl'] = $this->model_frontend->getPromotionsResult($limit, $offset);

		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		// End Controller
		
		$this->load->view('frontend/frontend/news_promotions', $data);
	} 

	public function payment_confirmed() {
		if($this->input->post('submit_payment') != '') {
			$data_payment = array(
				'order_no' => $this->input->post('order_no'),
				'payment_method' => $this->input->post('payment_method'),
				'payment_date' => $this->input->post('payment_date'),
				'payment_time' => $this->input->post('payment_time'),
				'payment_money' => $this->input->post('payment_money'),
				'payment_name' => $this->input->post('payment_name'),
				'payment_email' => $this->input->post('payment_email'),
				'payment_telephone' => $this->input->post('payment_telephone'),
				'payment_more_detail' => $this->input->post('payment_more_detail'),
				'payment_datetime_create' => date('Y-m-d H:i:s'),
				'payment_ip_create' => $_SERVER['REMOTE_ADDR'],
				'payment_datetime_update' => date('Y-m-d H:i:s'),
				'payment_ip_update' => $_SERVER['REMOTE_ADDR']
			);

			$file_name = md5(rand()).'.gif';

			if(!empty($_FILES['payment_slip']['tmp_name'])) {
				if(move_uploaded_file($_FILES['payment_slip']['tmp_name'], FCPATH.'uploads/payment/'.$file_name)) {
					$data_payment['payment_slip'] = $file_name;
				}
			}

			$this->db->insert('ci_payment', $data_payment);

			echo '<script>alert("Payment Success");</script>';
		}

		$data['test'] = 'Test';
		
		$this->load->view('frontend/frontend/payment-confirmed', $data);
	} 

	public function payment() {
		if(empty($this->cart->contents()) or $this->session->userdata('shipping_location') == '' or $this->session->userdata('shipping_township') == '') {
			echo '<script>alert("Please Select Region/State and Township");window.location.href="'.site_url('frontend/path/shippingaddress').'";</script>';
		}

		$data['bank'] = $this->model_frontend->getBankTransfer();
		
		$this->load->view('frontend/frontend/payment', $data);
	} 

	public function product_inside($product_id) {
		if($this->input->post('submit_review') != '') {
			//pre($_POST);
			$data_review = array(
				'product_id' => $product_id,
				'review_star' => $this->input->post('review_star'),
				'review_name' => $this->input->post('review_name'),
				'review_email' => $this->input->post('review_email'),
				'review_message' => $this->input->post('review_message'),
				'review_datetime_create' => date('Y-m-d H:i:s'),
				'review_ip_create' => $_SERVER['REMOTE_ADDR']
			);

			$this->db->insert('ci_review', $data_review);

			$this->db->order_by('review_id', 'desc');
			$this->db->limit(1);
			$query = $this->db->get('ci_review');

			$row = $query->row();

			if(!empty($row)) {
				if(!empty($_FILES['review_gallery_file']['tmp_name'])) {
					$i = 0;
					foreach($_FILES['review_gallery_file']['tmp_name'] as $tmp_name) {
						$md5 = md5(rand());
						if(move_uploaded_file($tmp_name, FCPATH.'uploads/review/'.$md5.'.gif')) {
							$data_review_gallery = array(
								'review_id' => $row->review_id,
								'review_gallery_file' => $md5.'.gif',
								'review_gallery_datetime_create' => date('Y-m-d H:i:s'),
								'review_gallery_ip_create' => $_SERVER['REMOTE_ADDR']
							);

							$this->db->insert('ci_review_gallery', $data_review_gallery);
						}
					}
				}
			}

			echo '<script>alert("Review Success");</script>';
		}

		$this->db->where('ci_map_weight.product_id', $product_id);
		$this->db->join('ci_map_weight', 'ci_color.color_id = ci_map_weight.color_id', 'inner');
		$this->db->order_by('ci_color.color_id', 'asc');
		$query_color = $this->db->get('ci_color');

		$row_color = $query_color->row();

		if(!empty($row_color)) {
			if($this->session->userdata('lang') == 'en') {
				$data['color_name'] = $row_color->color_name_lang1;
			} elseif($this->session->userdata('lang') == 'bur') {
				$data['color_name'] = $row_color->color_name_lang2;
			}
		}

		$data['product_id'] = $product_id;
		$data['row'] = $this->model_frontend->getProductDetail($product_id);

		//pre($data['row']);

		$data['weightCtrl'] = $this->model_frontend->getProductMapWeight($product_id);

		// เอา Weight แรกมา
		$weight_id = $this->model_frontend->getProductWeightLimit1($product_id);

		if(empty($weight_id)) {
			$weight_id = 0;
		}

		$data['colorCtrl'] = $this->model_frontend->getProductColorResult($product_id, $weight_id);

		if(!empty($data['colorCtrl'])) {
			$i = 0;
			foreach($data['colorCtrl'] as $r) {
				if($i == 0) {
					$color_id = $r->color_id;
				}

				$i++;
			}
		} else {
			$color_id = 0;
		}		

		$collection = $this->model_frontend->getProductCollectionResult($product_id, $weight_id, $color_id);

		if(!empty($collection)) {
			$i = 0;
			foreach($collection as $r) {
				if($i == 0) {
					if($r->collection_id != '') {
						$collection_id = $r->collection_id;
					}
				}

				$i++;
			}
		} else {
			$collection_id = '';
		}

		if(!empty($data['row'])) {
			$data['galleryCtrl'] = $this->model_frontend->getGalleryFirstResult($data['row']->product_id, $data['row']->weight_id, $data['row']->color_id, $data['row']->collection_id);	
		}

		if(!empty($data['row'])) {
			$data['youMayAlsoLikeCtrl'] = $this->model_frontend->getYouMayAlsoLikeResult($data['row']->category3_id, $product_id);
		}

		if(!empty($data['row'])) {
			$data['stockCtrl'] = $this->model_frontend->getProductStock($data['row']->product_id, $data['row']->weight_id, $data['row']->color_id, $data['row']->collection_id);	
		}
		
		$this->load->view('frontend/frontend/product_inside', $data);
	} 

	public function products($type, $category3_id) {
		$data['type'] = $type;
		$data['category3_id'] = $category3_id;

		if($type == 'category1' and $category3_id != '') {
			// pagination
			$this->load->library('pagination');

			$config['base_url'] = site_url('frontend/path/products/'.$type.'/'.$category3_id);
			$config['total_rows'] = count($this->model_frontend->getProductCategory1ResultAll($category3_id));
			
			$config['per_page'] = 16;
			
			$config['page_query_string'] = TRUE;
			
			// config
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '</span></li>';
			
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			
			$config['first_link'] = ' << ';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tag_close'] = '</span></li>';
			
			$config['prev_link'] = ' < ';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tag_close'] = '</span></li>';
			
			$config['next_link'] = ' > ';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tag_close'] = '</span></li>';
			
			$config['last_link'] = ' >> ';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tag_close'] = '</span></li>';
			
			// end config
			if($this->input->get('per_page') != '') {
				$limit = $config['per_page'];
				$offset = $this->input->get('per_page');
			} else {
				$limit = $config['per_page'];
				$offset = 0;
			}

			$this->pagination->initialize($config);
			
			$data['pagination'] = $this->pagination->create_links();

			$data['productCtrl'] = $this->model_frontend->getProductCategory1Result($category3_id, $limit, $offset);
		} elseif($type == 'category3' and $category3_id != '') {
			// pagination
			$this->load->library('pagination');

			$config['base_url'] = site_url('frontend/path/products/'.$type.'/'.$category3_id);
			$config['total_rows'] = count($this->model_frontend->getProductCategory3ResultAll($category3_id));
			
			$config['per_page'] = 16;
			
			$config['page_query_string'] = TRUE;
			
			// config
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '</span></li>';
			
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			
			$config['first_link'] = ' << ';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tag_close'] = '</span></li>';
			
			$config['prev_link'] = ' < ';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tag_close'] = '</span></li>';
			
			$config['next_link'] = ' > ';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tag_close'] = '</span></li>';
			
			$config['last_link'] = ' >> ';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tag_close'] = '</span></li>';
			
			// end config
			if($this->input->get('per_page') != '') {
				$limit = $config['per_page'];
				$offset = $this->input->get('per_page');
			} else {
				$limit = $config['per_page'];
				$offset = 0;
			}

			$this->pagination->initialize($config);
			
			$data['pagination'] = $this->pagination->create_links();

			$data['productCtrl'] = $this->model_frontend->getProductCategory3Result($category3_id, $limit, $offset);
		} elseif($type == 'category2' and $category3_id != '') {
			// pagination
			$this->load->library('pagination');

			$config['base_url'] = site_url('frontend/path/products/'.$type.'/'.$category3_id);
			$config['total_rows'] = count($this->model_frontend->getProductCategory2ResultAll($category3_id));
			
			$config['per_page'] = 16;
			
			$config['page_query_string'] = TRUE;
			
			// config
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close'] = '</span></li>';
			
			$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close'] = '</span></li>';
			
			$config['first_link'] = ' << ';
			$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['first_tag_close'] = '</span></li>';
			
			$config['prev_link'] = ' < ';
			$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['prev_tag_close'] = '</span></li>';
			
			$config['next_link'] = ' > ';
			$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['next_tag_close'] = '</span></li>';
			
			$config['last_link'] = ' >> ';
			$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
			$config['last_tag_close'] = '</span></li>';
			
			// end config
			if($this->input->get('per_page') != '') {
				$limit = $config['per_page'];
				$offset = $this->input->get('per_page');
			} else {
				$limit = $config['per_page'];
				$offset = 0;
			}

			$this->pagination->initialize($config);
			
			$data['pagination'] = $this->pagination->create_links();

			$data['productCtrl'] = $this->model_frontend->getProductCategory2Result($category3_id, $limit, $offset);
		}
		
		$this->load->view('frontend/frontend/products', $data);
	} 

	public function productsummary() {
		if(empty($this->cart->contents())) {
			redirect(site_url());
		}

		$data['bank'] = $this->model_frontend->getBankRecord();
		
		$this->load->view('frontend/frontend/productsummary', $data);
	} 

	public function profile_tracking() {
		$data['orderCtrl'] = $this->model_frontend->getOrderDetailResult();
		
		$this->load->view('frontend/frontend/profile-tracking', $data);
	} 

	public function question() {
		$data['questionCtrl'] = $this->model_frontend->getFAQResult();
		
		$this->load->view('frontend/frontend/question', $data);
	} 

	public function readmore_new($news_promotions_id) {
		$data['detailCtrl'] = $this->model_frontend->getReadmoreNewRecord($news_promotions_id);

		$data['galleryCtrl'] = $this->model_frontend->getGalleryResult($news_promotions_id);
		
		$this->load->view('frontend/frontend/readmore_new', $data);
	} 

	public function register() {
		$data['test'] = 'Test';
		
		$this->load->view('frontend/frontend/register', $data);
	} 

	public function shippingaddress() {
		if(empty($this->cart->contents())) {
			redirect(site_url());
		}

		$data['row'] = $this->model_frontend->getAddressMember();
		$data['rowShippingAddress'] = $this->model_frontend->getShippingAddressMember();

		$data['newAddress'] = $this->model_frontend->getProvinceResult();

		$data['shippingLocationCtrl'] = $this->model_frontend->getLocationShip();
		
		$this->load->view('frontend/frontend/shippingaddress', $data);
	}

	public function logout() {
		$data_unset = array(
			'member_id'
		);

		$this->session->unset_userdata($data_unset);

		redirect(site_url());
	} 

	public function ajaxInsertCartDirect() {
		$row = $this->model_frontend->getProductDetail($this->input->post('product_id'));

		if(!empty($row)) {
			$data = array(
		        'id'      => $this->input->post('product_id'),
		        'qty'     => $this->input->post('qty'),
		        'price'   => $row->product_price1,
		        'name'    => get2Lang($this->session->userdata('lang'), $row->product_name_lang1, $row->product_name_lang2),
		        'options' => array(
		        	'weight' => $row->weight_id, 
		        	'color' => $row->color_id,
		        	'collection' => $row->collection_id,
		        	'image' => $row->product_image,
		        	'product_before_discount_price' => $row->product_before_discount_price_type1,
					'product_code' => $row->product_code
		       	)
			);

			$this->cart->insert($data);
		}

		$this->ajaxCart();
	}

	public function ajaxInsertCart() {
		$row = $this->model_frontend->getProductDetail1($this->input->post('product_id'), $this->input->post('weight_id'), $this->input->post('color_id'), $this->input->post('collection_id'));

		if(!empty($row)) {
			$data = array(
		        'id'      => $this->input->post('product_id'),
		        'qty'     => $this->input->post('qty'),
		        'price'   => $row->product_price1,
		        'name'    => get2Lang($this->session->userdata('lang'), $row->product_name_lang1, $row->product_name_lang2),
		        'options' => array(
		        	'weight' => $this->input->post('weight_id'), 
		        	'color' => $this->input->post('color_id'),
		        	'collection' => $this->input->post('collection_id'),
		        	'image' => $row->product_image,
		        	'product_before_discount_price' => $row->product_before_discount_price_type1,
		        	'product_code' => $row->product_code
		       	)
			);

			$this->cart->insert($data);
		}

		$this->ajaxCart();
	}

	public function ajaxUpdateCart() {
		$data = array(
	        'rowid' => $this->input->post('rowid'),
	        'qty' => $this->input->post('qty')
		);

		$this->cart->update($data);

		$this->ajaxCart();
	}

	public function ajaxDeleteCart() {
		$data = array(
	        'rowid' => $this->input->post('rowid'),
	        'qty' => 0
		);

		$this->cart->update($data);

		$this->ajaxCart();
	}

	public function ajaxCart() {
		// [0] qty no
		$i = 0;
		$sub_total = 0;
		foreach($this->cart->contents() as $items) {
			$price = $items['qty'] * $items['price'];

			$sub_total += $price;

			$i++;
		}

		echo $i;

		echo '!@#$%^&*()';

		// [1] sub_total
		echo $sub_total;

		echo '!@#$%^&*()';

		// [2] discount
		$discount = 0;
		if($this->session->userdata('coupon_type') == '%') {
		    $discount = $sub_total * $this->session->userdata('coupon_discount') / 100;
		} elseif($this->session->userdata('coupon_type') == 'KS') {
		    $discount = $this->session->userdata('coupon_discount');
		}

		$voucher_price = 0;
		if($this->session->userdata('voucher') != 'Free Shipping' or $this->session->userdata('voucher') != '') {
			$voucher_price = $sub_total * $this->session->userdata('voucher') / 100;

			$data_sess = array(
				'voucher_price' => $voucher_price
			);

			$this->session->set_userdata($data_sess);
		}

		echo number_format($discount + $voucher_price, 0, '.', ',');

		echo '!@#$%^&*()';

		// [3] shipping
		$shipping = 0;

		echo number_format($shipping, 0, '.', ',');

		echo '!@#$%^&*()';

		// [4] total
		$total = $sub_total - $discount + $shipping;

		echo number_format($total, 0, '.', ',');

		echo '!@#$%^&*()';

		// [5] cart1
		$i = 0;
		$sub_total = 0;
		foreach($this->cart->contents() as $items) {
		    $price = $items['qty'] * $items['price'];
		    $sub_total += $price
?>            
                            <div class="row pad_bottom_summary">
                                <div class="col-12 col-md-5">
                                    <div class="cart_details">
                                        <h4 style="text-align: left;">Product Details</h4>
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="cartimg_product"><img src="<?php echo base_url('uploads/product/'.$items['options']['image']);?>" class="img-fluid"></div>
                                            </div>
                                            <div class="col-7">
                                                <div class="carttext_product">
                                                    <h5><?php echo $items['name'];?></h5>
                                                    <h6>#<?php echo $items['options']['product_code'];?></h6>
                                                    <p style="text-align: left;" onclick="deleteCart('<?php echo $items['rowid'];?>');">Remove</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-3">
                                    <div class="cart_details cart_details_xs">
                                        <h4 style="text-align: center;">Quantity</h4>
                                        <h6 style="text-align: center;">Quantity</h6>
                                        <div class="product-quantity">
                                            <div class="product-quantity-subtract" style="border: none; background: none;" onclick="decreaseQty('<?php echo $items['rowid'];?>');">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <input type="number" id="qty_<?php echo $items['rowid'];?>" placeholder="0" class="product-quantity-input" value="<?php echo $items['qty'];?>" onblur="blurQty('<?php echo $items['rowid'];?>', this.value);">
                                            </div>
                                            <div class="product-quantity-add" style="border: none; background: none; padding-left: 0;">
                                                <i class="fa fa-plus" aria-hidden="true" onclick="increaseQty('<?php echo $items['rowid'];?>');"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="cart_details cart_details_xs">
                                        <h4>Price</h4>
                                        <h6>Price</h6>
                                        <p>Ks <?php echo number_format($items['price'], 0, '.', ',');?></p>

                                    </div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="cart_details cart_details_xs">
                                        <h4>ToTal</h4>
                                        <h6>ToTal</h6>
                                        <p>Ks <?php echo number_format($items['price'] * $items['qty'], 0, '.', ',');?></p>
                                    </div>
                                </div>
                            </div>
<?php
		    $i++;
		}

		echo '!@#$%^&*()';

		// [6] cart_right_tab
		$sub_total = 0;
		foreach($this->cart->contents() as $items) {
		    $price = $items['qty'] * $items['price'];
		    $sub_total += $price;
?>
                        <div class="row" class="item_<?php echo $items['rowid'];?>">
                            <div class="col-5 col-md-4 col-lg-3">
                                <div class="bag_produt">
                                    <img src="<?php echo base_url('uploads/product/'.$items["options"]["image"]);?>" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-7 col-md-5 col-lg-6" style="padding-left:0px;">
                                <div class="new_item">
                                    <h5>#<?php echo $items['options']['product_code'];?></h5>
                                    <h3 class="mt-1"><?php echo $items['name'];?></h3>
                                    <li class="smtxt"> <div class="product-quantity" style="padding-bottom: 8px;">
                                        Quantity :
                                        <div class="product-quantity-subtract" style="border: none; background: none; width: 25px; height: 25px;" onclick="minus_basket('<?php echo $items['rowid'];?>');">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <input type="number" id="product-quantity-input" placeholder="0" value="<?php echo $items['qty'];?>" style="width: 25px; height: 25px; font-size: 13px;" class="qty_top_basket_<?php echo $items['rowid'];?>">
                                        </div>
                                        <div class="product-quantity-add" style="border: none; background: none; padding-left: 4px; width: 25px; height: 25px;" onclick="plus_basket('<?php echo $items['rowid'];?>');">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </div>
                                    </li>
                                    <!-- <li class="smtxt">Weight : <span class="lightgray">250 ml.</span></li> -->
                                </div>

                                <div class="d-block d-sm-block d-md-none d-lg-none d-xl-none">
                                    <p><?php echo number_format($items['price'] * $items['qty'], 0, '.', ',');?> USD</p>
                                    <a href="javascript:deleteCartInc('<?php echo $items["rowid"];?>');" class="remove">Remove</a>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 text-lg-right d-none d-sm-none d-md-block d-lg-block d-xl-block">
                                <p style="font-weight: 600;"><?php echo number_format($items['price'] * $items['qty'], 0, '.', ',');?> USD</p>
                                <a href="javascript:deleteCartInc('<?php echo $items["rowid"];?>');" class="remove">Remove</a>
                            </div>
                        </div>
                        <hr>
<?php
		}

		echo '!@#$%^&*()';
	}

	public function ajaxGallery() {
		$product_stock_amount = 0;

		$this->db->select('distinct ci_color.color_id, ci_color.color_name_lang1, ci_color.color_name_lang2, ci_color.color_image', false);
		//$this->db->order_by('ci_product_stock.product_stock_id', 'asc');
		$this->db->where('ci_map_weight.product_id', $this->input->post('product_id'));
		$this->db->where('ci_map_weight.weight_id', $this->input->post('weight_id'));
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->join('ci_color', 'ci_map_weight.color_id = ci_color.color_id', 'inner');
		//$this->db->group_by('ci_color.color_id');
		$query = $this->db->get('ci_map_weight');

		$rows = $query->result();

		//pre($rows);

		$data_split0 = '';
		$data_split1 = '';

		$color_id_first = 0;
		if(!empty($rows)) {
			$i = 0;
			foreach($rows as $r) {
				if($i == 0) {
					$data_split0 = get2Lang($this->session->userdata('lang'), 'Color : '.$r->color_name_lang1, 'Color : '.$r->color_name_lang2);

					$data_split1 .= '
					<li>
                        <label class="btn btn-primary active" style="padding: 2px; border: none;" onclick="changeColor('.$r->color_id.');">
                        	<input type="radio" name="ci_color_id" id="color_id_'.$r->color_id.'" class="color_id" value="'.$r->color_id.'" checked> <img src="'.base_url('uploads/color/'.$r->color_image).'" class="img-fluid">
                      	</label>
                    </li>';

					$color_id_first = $r->color_id;
					
					$product_stock_amount = $r->product_stock_amount;
				} else {
					$data_split1 .= '
					<li>
                        <label class="btn btn-primary" style="padding: 2px; border: none;" onclick="changeColor('.$r->color_id.');">
                        	<input type="radio" name="ci_color_id" id="color_id_'.$r->color_id.'" class="color_id" value="'.$r->color_id.'"> <img src="'.base_url('uploads/color/'.$r->color_image).'" class="img-fluid">
                      	</label>
                    </li>';
				}

				$i++;
			}
		}

		$data_split2 = '';

		$this->db->select('distinct ci_collection.collection_id, ci_collection.collection_name_lang1, ci_collection.collection_name_lang2', false);
		$this->db->where('ci_map_weight.product_id', $this->input->post('product_id'));
		$this->db->where('ci_map_weight.weight_id', $this->input->post('weight_id'));
		$this->db->where('ci_map_weight.color_id', $color_id_first);
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->join('ci_collection', 'ci_map_weight.collection_id = ci_collection.collection_id', 'inner');
		//$this->db->group_by('ci_collection.collection_id');
		$query = $this->db->get('ci_map_weight');

		$rows = $query->result();

		//pre($rows);

		$collection_id_first = 0;
		if(!empty($rows)) {
			$i = 0;
			foreach($rows as $r) {
				if($i == 0) {
					$data_split2 .= '
						<li>
                            <label class="btn btn-primary active" onclick="changeCollection('.$r->collection_id.');">
                            <input type="radio" name="ci_collection_id" id="collection_id_'.$r->collection_id.'" class="collection_id" value="'.$r->collection_id.'" checked> '.get2Lang($this->session->userdata('lang'), $r->collection_name_lang1, $r->collection_name_lang2).'
                            </label>
                        </li>';

					$collection_id_first = $r->collection_id;
					
					$product_stock_amount = $r->product_stock_amount;
				} else {
					$data_split2 .= '
						<li>
                            <label class="btn btn-primary" onclick="changeCollection('.$r->collection_id.');">
                            <input type="radio" name="ci_collection_id" id="collection_id" value="'.$r->collection_id.'"> '.get2Lang($this->session->userdata('lang'), $r->collection_name_lang1, $r->collection_name_lang2).'
                            </label>
                        </li>';
				}

				$i++;
			}
		}

		$data_split3 = '';

		$data_split4 = 0;

		$data_split5 = 0;

		$data_split6 = '';

		$this->db->where('ci_map_weight.product_id', $this->input->post('product_id'));
		$this->db->where('ci_map_weight.weight_id', $this->input->post('weight_id'));
		$this->db->where('ci_map_weight.color_id', $color_id_first);
		$this->db->where('ci_map_weight.collection_id', $collection_id_first);
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$query = $this->db->get('ci_map_weight');

		$row = $query->row();

		if(!empty($row)) {
			$data_split4 = '$'.number_format($row->product_before_discount_price_type1, 0, '.', ',');
			$data_split5 = number_format($row->product_price1, 0, '.', ',');
			$data_split6 = $row->product_code;

			$this->db->order_by('ci_product_gallery.product_gallery_sort', 'asc');
			$this->db->where('ci_product_gallery.product_stock_id', $row->product_stock_id);
			$query = $this->db->get('ci_product_gallery');

			$rows = $query->result();

			if(!empty($rows)) {
				$data_split3 .= '
					<div id="slider" class="flexslider">
                        <ul class="slides">';
    
    			foreach($rows as $r) {
                    $data_split3 .= '
                    		<li>
                                <img src="'.base_url('uploads/product_gallery/'.$r->product_gallery_image).'" />
                            </li>';
				}

				$data_split3 .= '
                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">';           
				
				foreach($rows as $r) {               
                    $data_split3 .= '        
	                  		<li>
	                            <img src="'.base_url('uploads/product_gallery/'.$r->product_gallery_image).'" />
	                        </li>';
				}

				$data_split3 .= '
						</ul>
                    </div>';
			}                   
		}

		echo $data_split0;

		echo '!@#$%^&*()';

		echo $data_split1;

		echo '!@#$%^&*()';

		echo $data_split2;

		echo '!@#$%^&*()';

		echo $data_split3;

		echo '!@#$%^&*()';

		echo $data_split4;

		echo '!@#$%^&*()';

		echo $data_split5;

		echo '!@#$%^&*()';

		echo $data_split6;

		echo '!@#$%^&*()';

		echo $product_stock_amount;
	}

	public function ajaxGalleryColor() {
		$product_stock_amount = 0;

		if($this->input->post('weight_id') != '') {
			$weight_id = $this->input->post('weight_id');
		} else {
			$weight_id = 0;
		}

		$this->db->select('distinct ci_color.color_id, ci_color.color_name_lang1, ci_color.color_name_lang2, ci_product_stock.product_stock_amount', false);
		//$this->db->order_by('ci_product_stock.product_stock_id', 'asc');
		$this->db->where('ci_map_weight.product_id', $this->input->post('product_id'));
		$this->db->where('ci_map_weight.weight_id', $weight_id);
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->join('ci_color', 'ci_map_weight.color_id = ci_color.color_id', 'inner');
		//$this->db->group_by('ci_color.color_id');
		$query = $this->db->get('ci_map_weight');

		$rows = $query->result();

		//pre($rows);

		$data_split0 = '';
		$data_split1 = '';

		$color_id = 0;
		if(!empty($rows)) {
			$i = 0;
			foreach($rows as $r) {
				if($r->color_id == $this->input->post('color_id')) {
					$data_split0 = get2Lang($this->session->userdata('lang'), 'Color : '.$r->color_name_lang1, 'Color : '.$r->color_name_lang2);

					$product_stock_amount = $r->product_stock_amount;
				}

				$i++;
			}
		}

		$data_split2 = '';

		$this->db->select('distinct ci_collection.collection_id, ci_collection.collection_name_lang1, ci_collection.collection_name_lang2, ci_product_stock.color_id', false);
		$this->db->where('ci_map_weight.product_id', $this->input->post('product_id'));
		$this->db->where('ci_map_weight.weight_id', $weight_id);
		$this->db->where('ci_map_weight.color_id', $this->input->post('color_id'));
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$this->db->join('ci_collection', 'ci_map_weight.collection_id = ci_collection.collection_id', 'inner');
		//$this->db->group_by('ci_collection.collection_id');
		$query = $this->db->get('ci_map_weight');

		$rows = $query->result();

		//pre($rows);

		$collection_id_first = 0;
		if(!empty($rows)) {
			$i = 0;
			foreach($rows as $r) {
				if($i == 0) {
					$data_split2 .= '
						<li>
                            <label class="btn btn-primary active" onclick="changeCollection('.$r->collection_id.');">
                            <input type="radio" name="collection_id" id="collection_id_'.$r->collection_id.'" class="collection_id" checked value="'.$r->color_id.'"> '.get2Lang($this->session->userdata('lang'), $r->collection_name_lang1, $r->collection_name_lang2).'
                            </label>
                        </li>';

					$collection_id_first = $r->collection_id;
					
					$product_stock_amount = $r->product_stock_amount;
				} else {
					$data_split2 .= '
						<li>
                            <label class="btn btn-primary" onclick="changeCollection('.$r->collection_id.');">
                            <input type="radio" name="collection_id" id="collection_id" value="'.$r->color_id.'" autocomplete="off"> '.get2Lang($this->session->userdata('lang'), $r->collection_name_lang1, $r->collection_name_lang2).'
                            </label>
                        </li>';
				}

				$i++;
			}
		}

		$data_split3 = '';

		$data_split4 = 0;

		$data_split5 = 0;

		$data_split6 = '';

		$this->db->where('ci_map_weight.product_id', $this->input->post('product_id'));
		$this->db->where('ci_map_weight.weight_id', $weight_id);
		$this->db->where('ci_map_weight.color_id', $this->input->post('color_id'));
		$this->db->where('ci_map_weight.collection_id', $collection_id_first);
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$query = $this->db->get('ci_map_weight');

		$row = $query->row();

		if(!empty($row)) {
			$data_split4 = '$'.number_format($row->product_before_discount_price_type1, 0, '.', ',');
			$data_split5 = number_format($row->product_price1, 0, '.', ',');
			$data_split6 = $row->product_code;

			$this->db->order_by('ci_product_gallery.product_gallery_sort', 'asc');
			$this->db->where('ci_product_gallery.product_stock_id', $row->product_stock_id);
			$query = $this->db->get('ci_product_gallery');

			$rows = $query->result();

			if(!empty($rows)) {
				$data_split3 .= '
					<div id="slider" class="flexslider">
                        <ul class="slides">';
    
    			foreach($rows as $r) {
                    $data_split3 .= '
                    		<li>
                                <img src="'.base_url('uploads/product_gallery/'.$r->product_gallery_image).'" />
                            </li>';
				}

				$data_split3 .= '
                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">';           
				
				foreach($rows as $r) {               
                    $data_split3 .= '        
	                  		<li>
	                            <img src="'.base_url('uploads/product_gallery/'.$r->product_gallery_image).'" />
	                        </li>';
				}

				$data_split3 .= '
						</ul>
                    </div>';
			}                   
		}

		echo $data_split0;

		echo '!@#$%^&*()';

		echo $data_split1;

		echo '!@#$%^&*()';

		echo $data_split2;

		echo '!@#$%^&*()';

		echo $data_split3;

		echo '!@#$%^&*()';

		echo $data_split4;

		echo '!@#$%^&*()';

		echo $data_split5;

		echo '!@#$%^&*()';

		echo $data_split6;

		echo '!@#$%^&*()';

		echo $product_stock_amount;

		echo '!@#$%^&*()';

		$this->db->where('color_id', $this->input->post('color_id'));
		$query = $this->db->get('ci_color');

		$row = $query->row();

		if(!empty($row)) {
			if($this->session->userdata('lang') == 'th') {
				$data_split7 = $row->color_name_lang1;
			} elseif($this->session->userdata('lang') == 'en') {
				$data_split7 = $row->color_name_lang2;
			}

			echo $data_split7;
		}
	}

	public function ajaxGalleryCollection() {
		$product_stock_amount = 0;

		if($this->input->post('weight_id') != '') {
			$weight_id = $this->input->post('weight_id');
		} else {
			$weight_id = 0;
		}

		if($this->input->post('color_id') != '') {
			$color_id = $this->input->post('color_id');
		} else {
			$color_id = 0;
		}

		$this->db->where('ci_map_weight.product_id', $this->input->post('product_id'));
		$this->db->where('ci_map_weight.weight_id', $weight_id);
		$this->db->where('ci_map_weight.color_id', $color_id);
		$this->db->where('ci_map_weight.collection_id', $this->input->post('collection_id'));
		$this->db->join('ci_product_stock', 'ci_map_weight.product_id = ci_product_stock.product_id and ci_map_weight.weight_id = ci_product_stock.weight_id and ci_map_weight.color_id = ci_product_stock.color_id and ci_map_weight.collection_id = ci_product_stock.collection_id', 'inner');
		$query = $this->db->get('ci_map_weight');

		$row = $query->row();

		$data_split0 = '';
		$data_split1 = '';
		$data_split2 = '';
		$data_split3 = '';
		if(!empty($row)) {
			$data_split4 = '$'.number_format($row->product_before_discount_price_type1, 0, '.', ',');
			$data_split5 = number_format($row->product_price1, 0, '.', ',');
			$data_split6 = $row->product_code;

			$product_stock_amount = $row->product_stock_amount;

			$this->db->order_by('ci_product_gallery.product_gallery_sort', 'asc');
			$this->db->where('ci_product_gallery.product_stock_id', $row->product_stock_id);
			$query = $this->db->get('ci_product_gallery');

			$rows = $query->result();

			if(!empty($rows)) {
				$data_split3 .= '
					<div id="slider" class="flexslider">
                        <ul class="slides">';
    
    			foreach($rows as $r) {
                    $data_split3 .= '
                    		<li>
                                <img src="'.base_url('uploads/product_gallery/'.$r->product_gallery_image).'" />
                            </li>';
				}

				$data_split3 .= '
                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">';           
				
				foreach($rows as $r) {               
                    $data_split3 .= '        
	                  		<li>
	                            <img src="'.base_url('uploads/product_gallery/'.$r->product_gallery_image).'" />
	                        </li>';
				}

				$data_split3 .= '
						</ul>
                    </div>';
			}                   
		}

		echo $data_split0;

		echo '!@#$%^&*()';

		echo $data_split1;

		echo '!@#$%^&*()';

		echo $data_split2;

		echo '!@#$%^&*()';

		echo $data_split3;

		echo '!@#$%^&*()';

		echo $data_split4;

		echo '!@#$%^&*()';

		echo $data_split5;

		echo '!@#$%^&*()';

		echo $data_split6;

		echo '!@#$%^&*()';

		echo $product_stock_amount;
	}

	public function ajaxCheckEmailUnique() {
		$this->db->where('member_email', $this->input->post('member_email'));
		$query = $this->db->get('ci_member');

		$row = $query->row();

		if(!empty($row)) {
			// มี Email นี้ อยู่แล้ว
			echo 'true';
		}
	}

	public function ajaxInsertMember() {
		$data_insert = array(
			'member_first_name' => $this->input->post('member_first_name'),
			'member_last_name' => $this->input->post('member_last_name'),
			'member_phone' => $this->input->post('member_phone'),
			'member_email' => $this->input->post('member_email'),
			'member_address' => $this->input->post('member_address'),
			'member_password' => $this->input->post('member_password'),
			'member_datetime_create' => date('Y-m-d H:i:s'),
			'member_ip_create' => $_SERVER['REMOTE_ADDR'],
			'member_datetime_update' => date('Y-m-d H:i:s'),
			'member_ip_update' => $_SERVER['REMOTE_ADDR']
		);

		$this->db->insert('ci_member', $data_insert);
	}

	public function ajaxForgotPassword() {
		$this->db->where('member_email', $this->input->post('member_email'));
		$query = $this->db->get('ci_member');

		$row = $query->row();

		if(empty($row)) {
			echo 'Not Found Email in System';
		} else {
			$this->load->helper('phpmailer');

			$sender = array($row->member_email);

			$subject = 'Mistine Myn : Forgot Password';

			$message = 'Password: '.$row->member_password;

			$cf_email = $this->model_frontend->getConfigEmailRecord();

			if(!empty($cf_email)) {
				$from_email = $cf_email->config_email_username;

				$from_name = 'Noreply Mistine';

				send_email($cf_email->config_email_host, $cf_email->config_email_username, $cf_email->config_email_password, $cf_email->config_email_smtpsecure, $cf_email->config_email_port, $sender, $subject, $message, $from_email, $from_name);
			}

			//pre($message);

			echo 'Send Password To Email Success. May be in junk mail';
		}
	}

	public function ajaxLogin() {
		$this->db->where('member_email', $this->input->post('member_email'));
		$this->db->where('member_password', $this->input->post('member_password'));
		$query = $this->db->get('ci_member');

		$row = $query->row();

		if(!empty($row)) {
			$data_sess = array(
				'member_id' => $row->member_id
			);

			$this->session->set_userdata($data_sess);

			echo true;
		} else {
			echo 'Username Or Password Incorrect';
		}
	}

	public function ajaxCheckEmail() {
		$this->db->where('member_id !=', $this->session->userdata('member_id'));
		$this->db->where('member_email', $this->input->post('member_email'));
		$query = $this->db->get('ci_member');

		$row = $query->row();

		if(!empty($row)) {
			echo true;
		}
	}

	public function ajaxCheckChangePassword() {
		$this->db->where('member_password', $this->input->post('member_old_password'));
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$query = $this->db->get('ci_member');

		$row = $query->row();

		if(!empty($row)) {
			$data = array(
				'member_password' => $this->input->post('member_password')
			);

			$where = array(
				'member_id' => $this->session->userdata('member_id')
			);

			$this->db->update('ci_member', $data, $where);
			
			echo 'Change Password Success';
		} else {
			echo 'Incorrect Password Old';
		}
	}

	public function ajaxWishlist() {
		if($this->session->userdata('member_id') != '') {
			$this->db->where('member_id', $this->session->userdata('member_id'));
			$this->db->where('product_id', $this->input->post('product_id'));
			$query = $this->db->get('ci_wishlist');

			$row = $query->row();

			if(empty($row)) {
				$data = array(
					'member_id' => $this->session->userdata('member_id'),
					'product_id' => $this->input->post('product_id'),
					'wishlist_datetime_create' => date('Y-m-d H:i:s'),
					'wishlist_ip_create' => $_SERVER['REMOTE_ADDR']
				);

				$this->db->insert('ci_wishlist', $data);
			}

		} else {
			echo 'Please Login';
		}
	}

	public function ajaxDeleteWishlist() {
		$where = array(
			'member_id' => $this->session->userdata('member_id'),
			'product_id' => $this->input->post('product_id')
		);

		$this->db->delete('ci_wishlist', $where);
	}

	public function ajaxCartShopping() {
		if($this->input->post('order_detail_shipping_method') == 'Normal') {
			$shipping_yjad = 10000;
		} elseif($this->input->post('order_detail_shipping_method') == 'EMS') {
			$shipping_yjad = 30000;
		}

		$data = array(
			'order_detail_shipping_method' => $this->input->post('order_detail_shipping_method'),
			'order_detail_shipping' => $shipping_yjad
		);

		$this->session->set_userdata($data);
	}

	public function ajaxShippingAddress() {
		if($this->input->post('order_detail_shipping_type') == 'true') {
			$row = $this->model_frontend->getMemberShippingAddress1();
			
			if(!empty($row)) {
				$data_sess = array( 
					'order_detail_shipping_name' => $row->member_first_name,
					'order_detail_shipping_last_name' => $row->member_last_name,
					'order_detail_shipping_phone' => $row->member_phone,
					'order_detail_shipping_email' => $row->member_email,
					'order_detail_shipping_address' => $row->member_shipping_address_address,
					'order_detail_shipping_sub_district' => $row->member_shipping_address_sub_district,
					'shipping_township' => $row->shipping_township,
					'shipping_location' => $row->shipping_location,
					'order_detail_shipping_postal_code' => $row->member_shipping_address_postal_code
				);

				$this->session->set_userdata($data_sess);	
			}
		} else {
			
			$data_sess = array( 
				'order_detail_shipping_name' => $this->input->post('order_detail_shipping_name'),
				'order_detail_shipping_last_name' => $this->input->post('order_detail_shipping_last_name'),
				'order_detail_shipping_phone' => $this->input->post('order_detail_shipping_phone'),
				'order_detail_shipping_email' => $this->input->post('order_detail_shipping_email'),
				'order_detail_shipping_address' => $this->input->post('order_detail_shipping_address'),
				'order_detail_shipping_sub_district' => $this->input->post('order_detail_shipping_sub_district'),
				'shipping_township' => $this->input->post('shipping_township'),
				'shipping_location' => $this->input->post('shipping_location'),
				'order_detail_shipping_postal_code' => $this->input->post('order_detail_shipping_postal_code')
			);

			$this->session->set_userdata($data_sess);
		}

		//echo $this->session->userdata('shipping_township');

		$this->db->where('rate_shipping_location', $this->session->userdata('shipping_location'));
		$this->db->where('rate_shipping_township', $this->session->userdata('shipping_township'));
		$query = $this->db->get('ci_rate_shipping');

		$row = $query->row();

		$product_weight = 0;

		if(!empty($row)) {
			// หาน้ำหนัก
			foreach($this->cart->contents() as $items) {
				$product = $this->model_frontend->getProductSingle($items['id']);
				
				if(!empty($product)) {
					$product_weight += ($product->product_weight * $items['qty']);
				}
			}

			$shipping_price = 0;

			if($row->rate_shipping_pre_weight > $product_weight) {
				// ถ้าน้ำหนักมากกว่าขั้นต่ำ
				$pre_price = $row->rate_shipping_amount;

				$post_price = 0;
				for($weight = $row->rate_shipping_pre_weight; $weight <= $row->rate_shipping_add_kg; $weight += $row->rate_shipping_add_kg) {
					$post_price += $row->rate_shipping_add_money;
				} 

				$shipping_price = $pre_price + $post_price;
			} else {
				// ถ้าน้ำหนักเท่ากับหรือน้อยกว่าขั้นต่ำ

				$shipping_price = $row->rate_shipping_amount;
			}

			//echo $shipping_price;

			if($this->session->userdata('voucher') == 'Free Shipping') {
				$data_sess = array(
					'order_detail_shipping' => 0
				);
	
				$this->session->set_userdata($data_sess);
			} else {
				$data_sess = array(
					'order_detail_shipping' => $shipping_price
				);
	
				$this->session->set_userdata($data_sess);
			}
		}
	}

	public function ajaxPaymentMethod() {
		if($this->input->post('order_detail_bank') != '') {
			$data_sess = array(
				'order_detail_bank' => $this->input->post('order_detail_bank')
			);

			$this->session->set_userdata($data_sess);
		} else {
			$data_un_sess = array(
				'order_detail_bank'
			);

			$this->session->unset_userdata($data_un_sess);
		}

		$data_sess = array(
			'order_detail_payment_method' => $this->input->post('order_detail_payment_method')
		);

		$this->session->set_userdata($data_sess);
	}

	public function ajaxCheckout() {
		$sub_total = 0;
		foreach($this->cart->contents() as $items) {
		    $price = $items['qty'] * $items['price'];

		    $sub_total += $price;
		}

		$total = $sub_total + $this->session->userdata('order_detail_shipping') - $this->session->userdata('order_detail_discount');

		if($this->session->userdata('member_id') != '') {
			$member_id = $this->session->userdata('member_id');
		} else {
			$member_id = 0;
		}

		$order_no = $this->model_frontend->genOrderNo();

		$data_order_detail = array(
			'order_detail_type' => 'Online',
			'member_id' => $member_id,
			'voucher_id' => $this->session->userdata('voucher_id'),
			'order_no' => $order_no,
			'order_detail_sub_total' => $sub_total,
			'order_detail_total' => $total,
			'order_detail_payment_method' => $this->session->userdata('order_detail_payment_method'),
			'order_detail_status' => 'Order',
			'order_detail_shipping_name' => $this->session->userdata('order_detail_shipping_name'),
			'order_detail_shipping_last_name' => $this->session->userdata('order_detail_shipping_last_name'),
			'order_detail_shipping_phone' => $this->session->userdata('order_detail_shipping_phone'),
			'order_detail_shipping_email' => $this->session->userdata('order_detail_shipping_email'),
			'order_detail_shipping_address' => $this->session->userdata('order_detail_shipping_address'),
			'order_detail_shipping_sub_district' => $this->session->userdata('order_detail_shipping_sub_district'),
			'shipping_township' => $this->session->userdata('shipping_township'),
			'shipping_location' => $this->session->userdata('shipping_location'),
			'order_detail_shipping_postal_code' => $this->session->userdata('order_detail_shipping_postal_code'),
			'order_detail_datetime_create' => date('Y-m-d H:i:s'),
			'order_detail_ip_create' => $_SERVER['REMOTE_ADDR'],
			'order_detail_datetime_update' => date('Y-m-d H:i:s'),
			'order_detail_ip_update' => $_SERVER['REMOTE_ADDR'] 
		);

		if($this->session->userdata('order_detail_shipping') == '' or $this->session->userdata('order_detail_shipping') == 0) {
			$data_order_detail['order_detail_shipping'] = 0;
		} else {
			$data_order_detail['order_detail_shipping'] = $this->session->userdata('order_detail_shipping');
		}

		if($this->session->userdata('order_detail_discount') != '') {
			$data_order_detail['order_detail_discount'] = $this->session->userdata('order_detail_discount');
		}

		if($this->session->userdata('order_detail_bank') != '') {
			$data_order_detail['order_detail_bank'] = $this->session->userdata('order_detail_bank');
		}

		$this->db->insert('ci_order_detail', $data_order_detail);

		$this->db->order_by('order_detail_id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('ci_order_detail');

		$row = $query->row();

		if(!empty($row)) {
			$data_sess_order_detail_id = array(
				'order_detail_id' => $row->order_detail_id
			);
			$this->session->set_userdata($data_sess_order_detail_id);

			foreach($this->cart->contents() as $items) {
				$data = array(
					'order_detail_id' => $row->order_detail_id,
					'order_image' => $items['options']['image'],
					'product_id' => $items['id'],
					'order_name' => $items['name'],
					'order_code' => $items['options']['product_code'],
					'order_qty' => $items['qty'],
					'order_price' => $items['price'],
					'order_weight' => $items['options']['weight'],
					'order_color' => $items['options']['color'],
					'order_collection' => $items['options']['collection'],
					'order_datetime_create' => date('Y-m-d H:i:s'),
					'order_ip_create' => $_SERVER['REMOTE_ADDR']
				);

				if($this->session->userdata('order_detail_payment_method') != 'Credit / Debit Card') {
					$date = strtotime("+2 day");
					$data['order_restock'] = date('Y-m-d H:i:s', $date);
				}
				
				$this->db->insert('ci_order', $data);

				// ตัดสต็อก
				$this->db->where('ci_product_stock.product_id', $items['id']);
				$this->db->where('ci_product_stock.weight_id', $items['options']['weight']);
				$this->db->where('ci_product_stock.color_id', $items['options']['color']);
				$this->db->where('ci_product_stock.collection_id', $items['options']['collection']);
				/*$this->db->join('ci_weight', 'ci_product_stock.weight_id = ci_weight.weight_id', 'inner');
				$this->db->join('ci_color', 'ci_product_stock.color_id = ci_color.color_id', 'inner');
				$this->db->join('ci_collection', 'ci_product_stock.collection_id = ci_collection.collection_id', 'inner');*/
				$query = $this->db->get('ci_product_stock');

				$row_stock = $query->row();

				if(!empty($row_stock)) {
					// ตัดสต็อค
					$data_stock = array(
						'product_stock_amount' => $row_stock->product_stock_amount - $items['qty']
					);

					$where_stock = array(
						'product_stock_id' => $row_stock->product_stock_id
					);

					$this->db->update('ci_product_stock', $data_stock, $where_stock);
				}
			}

			if($this->session->userdata('order_detail_payment_method') == 'Credit / Debit Card') {
				$data_check_order = array(
					'order_detail_id' => $row->order_detail_id,
					'total_price' => $total,
					'order_detail_status' => 'Order',
					'datetime_' => date('Y-m-d H:i:s'),
					'ip' => $_SERVER['REMOTE_ADDR']
				);

				$this->db->insert('ci_check_order', $data_check_order);
			}
		}

		if($this->session->userdata('coupon_limit') != '' and $this->session->userdata('coupon_code') != '') {
			$this->db->where('coupon_code', $this->session->userdata('coupon_code'));
			$query = $this->db->get('ci_coupon');

			$coupon = $query->row();

			if(!empty($coupon)) {
				$data = array(
					'coupon_limit' => $coupon->coupon_limit - 1
				);

				$where = array(
					'coupon_code' => $this->session->userdata('coupon_code')
				);

				$this->db->update('ci_coupon', $data, $where);
			}
		}

		// ทำให้ Voucher เป็น Use แก้ 2022.04.20
		if($this->session->userdata('voucher_id') != '') {
			$data_voucher = array(
				'map_voucher_valid_or_use' => 'use'
			);
			
			$where_voucher = array(
				'voucher_id' => $this->session->userdata('voucher_id'),
				'member_id' => $this->session->userdata('member_id')
			);

			$this->db->update('ci_map_voucher', $data_voucher, $where_voucher);
		}

		// Send Email
		$cf_email = $this->model_frontend->getConfigEmailRecord();

		$sender = array($this->session->userdata('order_detail_shipping_email'));

		$subject = 'Confirm Order No. '.$order_no;

		$discount = 0;
		if($this->session->userdata('coupon_type') == '%') {
			$discount = $sub_total * $this->session->userdata('coupon_discount') / 100;
		} elseif($this->session->userdata('coupon_type') == 'Baht') {
			$discount = $sub_total - $this->session->userdata('coupon_discount');
		}

		$message = '
			<html>
			<head>
				<meta charset="utf-8">
			</head>

			<body>
			<h2>Hi '.$this->session->userdata('order_detail_shipping_name').' '.$this->session->userdata('order_detail_shipping_last_name').' ,</h2><br>
			<p>
			Thanks for shopping with us! We are glad to inform you that your order #'.$order_no.' has been fully delivered with details as below. We hope you enjoy your purchase on Mistine Myanmar
			</p>
			<p>
			What\'s Next?<br>
			Please let us know what you think about the product. Your opinion will help us and our sellers improve.
			<br>
			Delivery Details 
			<table>
				<tr>
					<th align="left" width="150">Name</th>
					<td>'.$this->session->userdata('order_detail_shipping_name').' '.$this->session->userdata('order_detail_shipping_last_name').'</td>
				</tr>
				<tr>
					<th align="left">Address</th>
					<td>'.$this->session->userdata('order_detail_shipping_address').' '.$this->session->userdata('order_detail_shipping_sub_district').' '.$this->session->userdata('shipping_township').' '.$this->session->userdata('shipping_location').' '.$this->session->userdata('order_detail_shipping_postal_code').'</td>
				</tr>
				<tr>
					<th align="left">Email</th>
					<td>'.$this->session->userdata('order_detail_shipping_email').'</td>
				</tr>
				<tr>
					<th align="left">Phone</th>
					<td>'.$this->session->userdata('order_detail_shipping_phone').'</td>
				</tr>
				<tr>
					<th align="left">Email</th>
					<td>'.$this->session->userdata('order_detail_shipping_email').'</td>
				</tr>
			</table>

			<table>
				<tr>
					<th>No</th>
					<th>Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Total</th>
				</tr>
		';

		$i = 1;
		$sub_total = 0;
		foreach($this->cart->contents() as $items) {
			$price = $items['qty'] * $items['price'];
			$sub_total += $price;

			$message .= '
				<tr>
					<td>'.$i.'</td>
					<td><img src="'.base_url('uploads/product/'.$items['options']['image']).'" width="150"></td>
					<td>'.$items['name'].'</td>
					<td>'.number_format($items['price'], 0, '.', ',').'</td>
					<td>'.$items['qty'].'</td>
					<td>'.number_format($price, 0, '.', ',').'</td>
				</tr>
			';

			$i++;
		}
	
		$message .= '
				<tr>
					<td colspan="5" align="right">Sub Total</td>
					<td>'.number_format($sub_total, 0, '.', ',').'</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Discount</td>
					<td>';
		if($discount == '' or $discount == 0) {
			$message .= '0';
		} else {
			$message .= number_format($discount, 0, '.', ',');
		}

		$message .= '
					</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Shipping</td>
					<td>';
		if($this->session->userdata('order_detail_shipping') == '' or $this->session->userdata('order_detail_shipping') == 0) {
			$message .= '0';
		} else {
			$message .= number_format($this->session->userdata('order_detail_shipping'), 0, '.', ',');
		}

		$message .= '
					</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Total</td>
					<td>'.number_format($sub_total - $discount + $this->session->userdata('order_detail_shipping'), 0, '.', ',').'</td>
				</tr>
			</table>
			<p>
				Payment Method: '.$this->session->userdata('order_detail_payment_method').'
			</p>
			<p>
				Note
			<p>
			<p>
				Please keep your invoice and original packaging in case you need to return, replace, or claim your product\'s warranty.
				Returns are easy!
			</p>
			</body>
			</html>
		';

		$from_email = $cf_email->config_email_username;

		$from_name = 'NoReply Mistine';

		$this->load->helper('phpmailer');

		if(!empty($cf_email)) {
			send_email($cf_email->config_email_host, $cf_email->config_email_username, $cf_email->config_email_password, $cf_email->config_email_smtpsecure, $cf_email->config_email_port, $sender, $subject, $message, $from_email, $from_name);
		}
		// End Send Email

		// unset session
		/*$data_unset = array(
			'order_detail_shipping_method',
			'order_detail_shipping',
			'order_detail_shipping_name',
			'order_detail_shipping_last_name',
			'order_detail_shipping_phone',
			'order_detail_shipping_email',
			'order_detail_shipping_address',
			'order_detail_shipping_sub_district',
			'order_detail_shipping_district',
			'order_detail_shipping_province',
			'order_detail_shipping_postal_code',
			'order_detail_payment_method',
			'coupon_code',
			'coupon_discount',
			'coupon_type',
			'coupon_limit'
		);*/

		$data_unset = array(
			'voucher',
			'voucher_price',
			'voucher_id'
		);

		$this->session->unset_userdata($data_unset);
		
		$this->cart->destroy();

		echo $row->order_detail_id;
	}

	public function ajaxCoupon() {
		$this->db->where('coupon_code', $this->input->post('coupon_code'));
		if($this->session->userdata('member_id') == '') {
			$this->db->where('coupon_member', 'No');
		}
		$query = $this->db->get('ci_coupon');

		$row = $query->row();

		if(!empty($row)) {
			if($row->coupon_begin_datetime <= date('Y-m-d H:i:s') and $row->coupon_end_datetime >= date('Y-m-d H:i:s') and $row->coupon_limit > 0) {
				$data_sess = array(
					'coupon_code' => $this->input->post('coupon_code'),
					'coupon_discount' => $row->coupon_discount,
					'coupon_type' => $row->coupon_type,
					'coupon_limit' => $row->coupon_limit
				);

				$this->session->set_userdata($data_sess);

				echo true.'!@#$)';
			} elseif($row->coupon_end_datetime < date('Y-m-d H:i:s')) {
				$data_sess = array(
					'coupon_code',
					'coupon_discount',
					'coupon_type'
				);

				$this->session->unset_userdata($data_sess);

				echo 'Coupon Expired'.'!@#$)';
			} elseif($row->coupon_limit <= 0) {
				$data_sess = array(
					'coupon_code',
					'coupon_discount',
					'coupon_type'
				);

				$this->session->unset_userdata($data_sess);

				echo 'Coupon Over Limit'.'!@#$)';
			}
		} else {
			$data_sess = array(
				'coupon_code',
				'coupon_discount',
				'coupon_type'
			);

			$this->session->unset_userdata($data_sess);

			echo 'Incorrect Coupon'.'!@#$)';
		}

		$this->ajaxCart();
	}

	public function cronJobReturnStock() {
		$this->db->where('ci_order.order_restock <=', date('Y-m-d H:i:s'));
		$this->db->where('ci_order.order_restock !=', '0000-00-00 00:00:00');
		$query = $this->db->get('ci_order');

		$rows = $query->result();

		if(!empty($rows)) {
			$i = 0;
			foreach($rows as $r) {
				$this->db->where('product_id', $r->product_id);
				$this->db->where('weight_id', $r->order_weight);
				$this->db->where('color_id', $r->order_color);
				$query = $this->db->get('ci_product_stock');

				$row = $query->row();

				if(!empty($row)) {
					// สินค้าใน Stock
					$return_stock = $row->product_stock_amount + $r->order_qty;

					$data = array(
						'product_stock_amount' => $return_stock
					);

					$where = array(
						'product_id' => $r->product_id,
						'weight_id' => $r->order_weight,
						'color_id' => $r->order_color
					);

					$this->db->update('ci_product_stock', $data, $where);


					$data = array(
						'order_restock' => '0000-00-00 00:00:00'
					);

					$where = array(
						'product_id' => $row->product_id,
						'order_weight' => $row->weight_id,
						'order_color' => $row->color_id
					);

					$this->db->update('ci_order', $data, $where);

					echo $r->order_name.' / '.$r->product_id.' / '.$r->order_weight.' / '.$r->order_color.' / '.$return_stock.'<br>';

				}
			}
		}

		// test
		$data = array(
			'test_cronjob_name' => 'abc'
		);

		$this->db->insert('ci_test', $data);
	}

	public function ajaxContact() {
		$expiration = time() - 7200; // Two hour limit
		$this->db->where('captcha_time < ', $expiration)
		        ->delete('captcha');

		// Then see if a captcha exists:
		$sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
		$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count == 0) {
		    echo 'Incorrect Captcha';
		} else {
			$data = array(
				'contact_name' => $this->input->post('contact_name'),
				'contact_email_facebook_etc' => $this->input->post('contact_email_facebook_etc'),
				'contact_tel' => $this->input->post('contact_tel'),
				'contact_subject' => $this->input->post('contact_subject'),
				'contact_message' => $this->input->post('contact_message'),
				'contact_datetime_create' => date('Y-m-d H:i:s'),
				'contact_ip_create' => $_SERVER['REMOTE_ADDR']
			);

			$this->db->insert('ci_contact', $data);

			echo true;
		}
	}

	public function privacy_and_confidentaility() {

		$this->load->view('frontend/frontend/privacy_confidentiality');
	}

	public function terms_condition() {

		$this->load->view('frontend/frontend/terms_condition');
	}

	public function cancel_step2($order_detail_id) {

		$data['order_detail_id'] = $order_detail_id;

		$data['reasonCtrl'] = $this->model_frontend->getReasonCancelRecord();

		$data['order_id_explode'] = $this->model_frontend->getOrderIdExplode($order_detail_id);

		//pre($data['order_id_explode']);

		$this->load->view('frontend/frontend/cancel-step2', $data);
	}

	public function cancel_step3() {
		$data['cancelCtrl'] = $this->model_frontend->getOrderCancelResult();

		$this->load->view('frontend/frontend/cancel-step3', $data);
	}

	public function member7() {
		$data['test'] = 'Test';

		$this->load->view('frontend/frontend/member7', $data);
	}

	public function member8() {
		$data['cancelCtrl'] = $this->model_frontend->getCancelResult();

		$this->load->view('frontend/frontend/member8', $data);
	}

	public function returns_step1() {
		$data['returnsCtrl'] = $this->model_frontend->getOrderReturnResult();

		$this->load->view('frontend/frontend/returns-step1', $data);
	}

	public function remove() {
		echo 'remove';
	}

	public function returns_step2() {
		//pre($_POST);

		//echo $this->input->post('order_id').' ';

		$return_qty = $this->input->post('return_qty');

		$return_reason = $this->input->post('return_reason');

		if(!empty($return_qty)) {
			$i = 0;
			foreach($return_qty as $qty) {
				if($qty != 0) {
					//echo $qty.' '.$return_reason[$i];

					$data_return = array(
						'order_id' => $this->input->post('order_id'),
						'return_qty' => $qty,
						'return_reason' => $return_reason[$i]
					);

					$this->session->set_userdata($data_return);
				}

				$i++;
			}
		}

		$data['test'] = 'Test';

		$this->load->view('frontend/frontend/returns-step2', $data);
	}

	public function returns_step3() {
		$data['test'] = 'Test';

		$this->load->view('frontend/frontend/returns-step3', $data);
	}

	public function ajaxCancelReason() {
		if($this->input->post('order_detail_id') != '') {
			/*$exp_order_id = explode('&*(', $this->input->post('order_id'));

			if(!empty($exp_order_id)) {
				foreach($exp_order_id as $order_detail_id) {
					$data_reason = array(
						'member_id' => $this->session->userdata('member_id'),
						'order_detail_id' => $order_detail_id,
						'cancel_datetime_create' => date('Y-m-d H:i:s'),
						'cancel_ip_create' => $_SERVER['REMOTE_ADDR']
					);

					if($this->input->post('reason') == 'reason1') {
						$data_reason['cancel_reason'] = 'It is necessary to change the shipping address.';
					} else if($this->input->post('reason') == 'reason2') {
						$data_reason['cancel_reason'] = 'Need to add / change discount code';
					} else if($this->input->post('reason') == 'reason3') {
						$data_reason['cancel_reason'] = 'Want to edit the order (Change size, color, quantity, etc.)';
					}

					$this->db->insert('ci_cancel', $data_reason);
				}
			}*/

			$data_reason = array(
				'member_id' => $this->session->userdata('member_id'),
				'order_detail_id' => $this->input->post('order_detail_id'),
				'cancel_datetime_create' => date('Y-m-d H:i:s'),
				'cancel_ip_create' => $_SERVER['REMOTE_ADDR']
			);

			if($this->input->post('reason') == 'reason1') {
				$data_reason['cancel_reason'] = 'It is necessary to change the shipping address.';
			} else if($this->input->post('reason') == 'reason2') {
				$data_reason['cancel_reason'] = 'Need to add / change discount code';
			} else if($this->input->post('reason') == 'reason3') {
				$data_reason['cancel_reason'] = 'Want to edit the order (Change size, color, quantity, etc.)';
			}

			$this->db->insert('ci_cancel', $data_reason);

			// คืน Voucher
			$this->db->where('ci_order_detail.order_detail_id', $this->input->post('order_detail_id'));
			$this->db->where('ci_order_detail.member_id', $this->session->userdata('member_id'));
			$query = $this->db->get('ci_order_detail');

			$row = $query->row();

			if(!empty($row->voucher_id) and $row->voucher_id != 0) {
				$data = array(
					'map_voucher_valid_or_use' => 'valid'
				);

				$where = array(
					'voucher_id' => $row->voucher_id,
					'member_id' => $row->member_id
				);

				$this->db->update('ci_map_voucher', $data, $where);
			}
		}
	}

	public function ajaxRefund() {
		$data_sess = array(
			'order_id' => $this->session->userdata('order_id'),
			'return_qty' => $this->session->userdata('return_qty'), 
			'return_reason' => $this->session->userdata('return_reason'),
			'return_refund_method' => $this->input->post('return_refund_method'),
			'return_datetime_create' => date('Y-m-d H:i:s'),
			'return_ip_create' => $_SERVER['REMOTE_ADDR']
		);

		$this->db->insert('ci_return', $data_sess);

		/*$data_unset = array(
			'order_id',
			'return_qty',
			'return_reason'
		);

		$this->session->unset_userdata($data_unset);*/
	}

	public function confirmCreditCard() {
		$payment_status = $_REQUEST["payment_status"];

		if($_REQUEST["channel_response_code"] == 001) {
			$data_insert = array(
				'transaction_ref' => $_REQUEST['transaction_ref'],
				'transaction_datetime' => $_REQUEST['transaction_datetime'],
				'channel_response_code' => $_REQUEST['channel_response_code'],
				'channel_response_desc' => $_REQUEST['channel_response_desc'],
				'log_2c2p_123_datetime_create' => date('Y-m-d H:i:s'),
				'log_2c2p_123_ip_create' => $_SERVER['REMOTE_ADDR']
			);

			$this->db->insert('ci_log_2c2p_123');
		}

		if($payment_status == 000) {
			$this->db->order_by('ci_check_order.order_detail_id', 'desc');
			$this->db->join('ci_order_detail', 'ci_check_order.order_detail_id = ci_order_detail.order_detail_id and ci_check_order.total_price = ci_order_detail.order_detail_total', 'inner');
			$this->db->where('ci_check_order.order_detail_status', 'Order');
			$this->db->where('ci_check_order.ip', $_SERVER['REMOTE_ADDR']);
			$this->db->where('ci_check_order.datetime_ <=', date('Y-m-d H:i:s'));
			$this->db->limit(1);
			$query = $this->db->get('ci_check_order');

			$row = $query->row();

			if(!empty($row)) {
				$data_update = array(
					'order_detail_status' => 'Processing',
					'order_detail_datetime_update' => date('Y-m-d H:i:s'),
					'order_detail_ip_update' => $_SERVER['REMOTE_ADDR']
				);

				$where_update = array(
					'order_detail_id' => $row->order_detail_id
				);

				$this->db->update('ci_order_detail', $data_update, $where_update);

				$data_update = array(
					'order_detail_status' => 'Processing'
				);

				$where_update = array(
					'order_detail_id' => $row->order_detail_id
				);

				$this->db->update('ci_check_order', $data_update, $where_update);

				//redirect(site_url('frontend/path/confirm_credit_card/'.$row->order_detail_id));

				redirect();
			}
		}
	}

	public function confirm_credit_card($order_detail_id) {
		//pre($this->session->all_userdata());

		$data['row'] = $this->model_frontend->getOrderDetailRecord($order_detail_id);

		$this->load->view('frontend/frontend/confirmCreditCard', $data);
	}

	public function search() {
		$this->db->order_by('ci_product.product_id', 'desc');
		$this->db->where('(ci_product.product_name_lang1 like "%'.$this->input->post('search_txt').'%" or ci_product.product_name_lang2 like "%'.$this->input->post('search_txt').'%")');
		$this->db->join('ci_product_stock', 'ci_product.product_id = ci_product_stock.product_id', 'inner');
		$this->db->group_by('ci_product.product_id');
		$query = $this->db->get('ci_product');

		$data['rows'] = $query->result();

		$this->load->view('frontend/frontend/search', $data);
	}

	public function ajaxChangeShippingLocation() {
		$this->db->where('rate_shipping_location', $this->input->post('shipping_location'));
		$query = $this->db->get('ci_rate_shipping');

		$rows = $query->result();
		
		echo '<option value="">Township</option>';
		if(!empty($rows)) {
			foreach($rows as $r) {
				echo '<option value="'.$r->rate_shipping_township.'">'.$r->rate_shipping_township.'</option>';
			}
		}
	}

	public function privacy_policy() {
		$data['test'] = 'Test';
		
		$this->load->view('frontend/frontend/privacy_confidentiality', $data);
	}

	public function ajaxLoginFacebook() {
		$this->db->where('member_facebook_id', $this->input->post('id'));
		$query = $this->db->get('ci_member');

		$row = $query->row();

		if(!empty($row)) {
			// update
			$exp = explode(' ', $this->input->post('member_name'));

			if(!empty($exp)) {
				$data = array(
					'member_first_name' => $exp[0],
					'member_last_name' => $exp[1],
					'member_datetime_update' => date('Y-m-d H:i:s'),
					'member_ip_update' => $_SERVER['REMOTE_ADDR']
				);

				$where = array(
					'member_facebook_id' => $this->input->post('id')
				);

				$this->db->update('ci_member', $data, $where);

				$data_set = array(
					'member_id' => $row->member_id
				);

				$this->session->set_userdata($data_set);
			}
		} else {
			// insert
			$exp = explode(' ', $this->input->post('member_name'));

			if(!empty($exp)) {
				$data = array(
					'member_first_name' => $exp[0],
					'member_last_name' => $exp[1],
					'member_facebook_id' => $this->input->post('id'),
					'member_datetime_create' => date('Y-m-d H:i:s'),
					'member_ip_create' => $_SERVER['REMOTE_ADDR'],
					'member_datetime_update' => date('Y-m-d H:i:s'),
					'member_ip_update' => $_SERVER['REMOTE_ADDR']
				);

				$this->db->insert('ci_member', $data);

				$this->db->order_by('member_id', 'desc');
				$this->db->limit(1);
				$query = $this->db->get('ci_member');

				$row = $query->row();

				if(!empty($row)) {
					$data_set = array(
						'member_id' => $row->member_id
					);

					$this->session->set_userdata($data_set);

					echo true;
				}
			}
		}
	}

	public function ajaxLogout() {
		$data_unset = array(
			'member_id'
		);

		$this->session->unset_userdata($data_unset);
	}

	public function ajaxClaimVoucher() {
		$this->db->where('member_id', $this->session->userdata('member_id'));
		$this->db->where('voucher_id', $this->input->post('voucher_id'));
		$query = $this->db->get('ci_map_voucher');

		$row = $query->row();
		if(empty($row)) {
			$data = array(
				'member_id' => $this->session->userdata('member_id'),
				'voucher_id' => $this->input->post('voucher_id'),
				'map_voucher_datetime_create' => date('Y-m-d H:i:s'),
				'map_voucher_ip_create' => $_SERVER['REMOTE_ADDR']
			);
	
			$this->db->insert('ci_map_voucher', $data);
	
			$this->db->where('voucher_id', $this->input->post('voucher_id'));
			$query = $this->db->get('ci_voucher');
	
			$row = $query->row();
	
			if(!empty($row)) {
				$stock = $row->voucher_stock - 1;
				
				$data_stock = array(
					'voucher_stock' => $stock
				);
	
				$where_stock = array(
					'voucher_id' => $row->voucher_id
				);
	
				$this->db->update('ci_voucher', $data_stock, $where_stock);

				echo 'Claim Success';

				echo '!@#$%^&*()';

				$voucherCtrl = $this->model_frontend->getVoucherResult();
				if(!empty($voucherCtrl)) {
					foreach($voucherCtrl as $r) {
?>
														<div class="col-12 col-md-6 pad_voucher">
															<div class="row">
																<div class="col-12 col-md-4 voucher_r">
																	<div class="voucher">
																		<div class="my_voucher">
<?php
						if($r->voucher_type == 'Free Shipping') {
							echo $r->voucher_type.' Voucher';
						} elseif($r->voucher_type == '%') {
							echo 'Discount '.$r->voucher_price.'% OFF';
						} elseif($r->voucher_type == 'KS') {
							echo 'Discount '.$r->voucher_price.' KS';
						}
?>
																		</div>
																		<div class="voucher_free"></div>
																	</div>
																</div>
																<div class="col-12 col-md-8 voucher_l">
																	<div class="text_voucher pad_text_voucher">
																		<h6>
<?php
						if($r->voucher_type == 'Free Shipping') {
							echo $r->voucher_type.' Voucher';
						} elseif($r->voucher_type == '%') {
							echo 'Discount '.$r->voucher_price.'% OFF';
						} elseif($r->voucher_type == 'KS') {
							echo 'Discount '.$r->voucher_price.' KS';
						}
?> 
																		</h6>
																		<p>Valid Till: <?php echo getDateMistine($r->voucher_expired_date);?>
																		</p>
																		<a href="javascript:claimVoucher('<?php echo $r->voucher_id;?>');">Claim</a>
																	</div>
																</div>
															</div>
														</div>
				<?php
					}
				}
			}
		} else {
			echo 'This voucher has been used';
		}
	}

	public function ajaxUseVoucher() {
		if($this->session->userdata('voucher_id') != '') {
			$this->db->where('ci_map_voucher.member_id', $this->session->userdata('member_id'));
			$this->db->where('ci_map_voucher.voucher_id', $this->session->userdata('voucher_id'));
			$this->db->where('ci_voucher.voucher_expired_date >=', date('Y-m-d'));
			$this->db->join('ci_voucher', 'ci_map_voucher.voucher_id = ci_voucher.voucher_id', 'inner');
			$query = $this->db->get('ci_map_voucher');

			$row = $query->row();

			if(!empty($row)) {
				$data_session_use = array(
					'map_voucher_valid_or_use' => 'valid'
				);

				$where_session_use = array(
					'member_id' => $this->session->userdata('member_id'),
					'voucher_id' => $this->session->userdata('voucher_id')
				);

				$this->db->update('ci_map_voucher', $data_session_use, $where_session_use);
			}
		} 
		
		$this->db->where('ci_map_voucher.member_id', $this->session->userdata('member_id'));
		$this->db->where('ci_map_voucher.voucher_id', $this->input->post('voucher_id'));
		$this->db->where('ci_voucher.voucher_expired_date >=', date('Y-m-d'));
		$this->db->join('ci_voucher', 'ci_map_voucher.voucher_id = ci_voucher.voucher_id', 'inner');
		$query = $this->db->get('ci_map_voucher');

		$row = $query->row();

		if(!empty($row)) {
			$data = array(
				'map_voucher_valid_or_use' => 'use'
			);

			$where = array(
				'member_id' => $this->session->userdata('member_id'),
				'voucher_id' => $this->input->post('voucher_id'),
			);

			$this->db->update('ci_map_voucher', $data, $where);

			if($row->voucher_type == 'Free Shipping') {
				$voucher = 'Free Shipping';
			} else {
				$voucher = $row->voucher_price;
			}

			$data = array(
				'voucher' => $voucher,
				'voucher_id' => $this->input->post('voucher_id')
			);

			$this->session->set_userdata($data);
		} else {
			echo 'User is Expired or Not Use';
		}
	}

	public function ajaxCancelVoucher() {
		$data = array(
			'voucher',
			'voucher_id',
			'voucher_price'
		);

		$data_cancel = array(
			'map_voucher_valid_or_use' => 'valid'
		);

		$where_cancel = array(
			'member_id' => $this->session->userdata('member_id'),
			'voucher_id' => $this->session->userdata('voucher_id')
		);

		$this->db->update('ci_map_voucher', $data_cancel, $where_cancel);

		$this->session->unset_userdata($data);
	}

	public function testSendEmail() {	
		$this->load->helper('phpmailer');

		$sender = array('sitiporn@orange-thailand.com');

		$subject = 'Mistine Myn : Forgot Password';

		$message = 'test';

		$from_email = 'mistine.noreply@gmail.com';

		$from_name = 'Noreply Mistine';

		$cf_email = $this->model_frontend->getConfigEmailRecord();

		if(!empty($cf_email)) {
			send_email($cf_email->config_email_host, $cf_email->config_email_username, $cf_email->config_email_password, $cf_email->config_email_smtpsecure, $cf_email->config_email_port, $sender, $subject, $message, $from_email, $from_name);
		}
	}

	public function ajaxSendMailReturn() {
		// Send Email
		$order_id = $this->session->userdata('order_id');

		if(!empty($order_id)) {
			$this->db->join('ci_order_detail', 'ci_order.order_detail_id = ci_order_detail.order_detail_id', 'inner');
			$this->db->join('ci_return', 'ci_order.order_id = ci_return.order_id', 'inner');
			$this->db->where('ci_order.order_id', $order_id);
			$this->db->order_by('ci_return.return_id', 'desc');
			$query = $this->db->get('ci_order');

			$row = $query->row();

			if(!empty($row)) {
				$cf_email = $this->model_frontend->getConfigEmailRecord();

				$sender = array($this->input->post('email_send_return'));

				$subject = 'Return Order No. '.$row->order_no;

				/*$discount = 0;
				if($this->session->userdata('coupon_type') == '%') {
					$discount = $sub_total * $this->session->userdata('coupon_discount') / 100;
				} elseif($this->session->userdata('coupon_type') == 'USD') {
					$discount = $sub_total - $this->session->userdata('coupon_discount');
				}*/

				$message = '
					<html>
					<head>
						<meta charset="utf-8">
					</head>

					<body>
					<h2>Hi '.$row->order_detail_shipping_name.' '.$row->order_detail_shipping_last_name.' ,</h2><br>';
					/*
					<p>
					Thanks for shopping with us! We are glad to inform you that your order #'.$row->order_no.' has been fully delivered with details as below. We hope you enjoy your purchase on Mistine Myanmar
					</p>
					<p>
					What\'s Next?<br>
					Please let us know what you think about the product. Your opinion will help us and our sellers improve.
					<br>
					Delivery Details 
					*/
				
				$message .= '
					<table>
						<tr>
							<th align="left" width="150">Name</th>
							<td>'.$row->order_detail_shipping_name.' '.$row->order_detail_shipping_last_name.'</td>
						</tr>
						<tr>
							<th align="left">Address</th>
							<td>'.$row->order_detail_shipping_address.' '.$row->order_detail_shipping_sub_district.' '.$row->shipping_township.' '.$row->shipping_location.' '.$row->order_detail_shipping_postal_code.'</td>
						</tr>
						<tr>
							<th align="left">Email</th>
							<td>'.$row->order_detail_shipping_email.'</td>
						</tr>
						<tr>
							<th align="left">Phone</th>
							<td>'.$row->order_detail_shipping_phone.'</td>
						</tr>
					</table>

					<table>
						<tr>
							<th>No</th>
							<th>Image</th>
							<th>Name</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Total</th>
						</tr>
				';

				$i = 1;
				$sub_total = 0;

				$message .= '
					<tr>
						<td>'.$i.'</td>
						<td><img src="'.base_url('uploads/product/'.$row->order_image).'" width="150"></td>
						<td>'.$row->order_name.'</td>
						<td>'.number_format($row->order_price, 0, '.', ',').'</td>
						<td>'.$row->order_qty.'</td>
						<td>'.number_format($row->order_price * $row->order_qty, 0, '.', ',').'</td>
					</tr>
				';

				$i++;
			
				/*$message .= '
						<tr>
							<td colspan="5" align="right">Sub Total</td>
							<td>'.number_format($row->order_price * $row->order_qty, 0, '.', ',').'</td>
						</tr>
						<tr>
							<td colspan="5" align="right">Discount</td>
							<td>';
				if($discount == '' or $discount == 0) {
					$message .= '0';
				} else {
					$message .= number_format($discount, 0, '.', ',');
				}

				$message .= '
							</td>
						</tr>
						<tr>
							<td colspan="5" align="right">Shipping</td>
							<td>';
				if($this->session->userdata('order_detail_shipping') == '' or $this->session->userdata('order_detail_shipping') == 0) {
					$message .= '0';
				} else {
					$message .= number_format($this->session->userdata('order_detail_shipping'), 0, '.', ',');
				}

				$message .= '
							</td>
						</tr>
						<tr>
							<td colspan="5" align="right">Total</td>
							<td>'.number_format($sub_total - $discount + $this->session->userdata('order_detail_shipping'), 0, '.', ',').'</td>
						</tr>*/
				$message .= '
					</table>
					<p>
						Reason for return: '.$row->return_reason.'<br>
						Refund Method: '.$row->return_refund_method;
				if($row->return_account_bank != '') {
					$message .= '<br>Account Bank: '.$row->return_account_bank;
				}

				$message .= '
					</p>
					<p>
						Note
					<p>
					<p>
						Please keep your invoice and original packaging in case you need to return, replace, or claim your product\'s warranty.
						Returns are easy!
					</p>
					</body>
					</html>
				';

				$from_email = $cf_email->config_email_username;

				$from_name = 'NoReply Mistine';

				$this->load->helper('phpmailer');

				//echo $message;

				if(!empty($cf_email)) {
					send_email($cf_email->config_email_host, $cf_email->config_email_username, $cf_email->config_email_password, $cf_email->config_email_smtpsecure, $cf_email->config_email_port, $sender, $subject, $message, $from_email, $from_name);

					$data_unset = array(
						'order_id',
						'return_qty',
						'return_reason'
					);
			
					$this->session->unset_userdata($data_unset);
				}
			}
		}
		// End Send Email
	}
}
?>