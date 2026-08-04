<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('order/model_order');
		$this->load->model('order/model_order_datatable');
		$this->load->model('order/model_cancel_datatable');
		$this->load->model('order/model_return_datatable');
		$this->load->model('order/model_payment_datatable');
		$this->load->model('template_main/model_template_main');
		//$this->load->library('datatables');
		$this->load->library('table');
		$this->load->helper('form');
		$this->path_upload = FCPATH.'uploads/order/';
		
		if($this->session->userdata('session_login') != true) {
			redirect(site_url());
		}
	}
	
	// order	
	public function order() {
		
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
		$this->load->view('order/order/list', $data);
		/* end body */
	}
	
	public function order_server_processing() {
		$list = $this->model_order_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $order->order_no;
            $row[] = $order->order_detail_type;
			
			if($order->member_id != 0) {
				$row[] = 'Member';		
			} else {
				$row[] = 'Not Member';
			}
			
            $row[] = $order->order_detail_payment_method;
            $row[] = $order->order_detail_shipping_name.' '.$order->order_detail_shipping_last_name;
            $row[] = $order->order_detail_shipping_phone;
            $row[] = $order->order_detail_shipping_email;
            $row[] = number_format($order->order_detail_total, 0, '.', ',');
            $row[] = $order->order_detail_status;
            
			$row[] = '<a href="'.site_url('order/backend/order_form/'.$order->order_detail_id).'">View</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_order_datatable->count_all(),
            "recordsFiltered" => $this->model_order_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	
	public function order_form($id = ''){	
		$data['id'] = $id;
		$data['row'] = $this->model_order->get_order_single($id);
		
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
		
		$this->load->view('order/order/form', $data);
	}
	
	public function order_save_update($id = ''){	
		
		$this->form_validation->set_rules('order_name_th', 'Units Features(Th)', "trim|required");
		$this->form_validation->set_rules('order_name_en', 'Units Features(En)', "trim|required");
		
		if($this->form_validation->run($this) == TRUE) {
			$data = array(
				'order_name_th' => $this->input->post('order_name_th'),
				'order_name_en' =>  $this->input->post('order_name_en'),
				'order_username_update' => $this->session->userdata('session_username'),
				'order_datetime_update' => date('Y-m-d H:i:s'),
				'order_ip_update' => $_SERVER['REMOTE_ADDR']
			);
			
			if(!empty($_FILES['order_name_image2'])) {
				$config['upload_path']          = FCPATH.'uploads/order/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
				
                $this->load->library('upload', $config);
                
                $this->upload->initialize($config);

                if($this->upload->do_upload('order_name_image2')) {
                    $data_image = $this->upload->data();
                    
                    /*$config_resize['image_library'] = 'gd2';
					$config_resize['source_image'] = FCPATH.'uploads/order/'.$data_image['file_name'];
					$config_resize['new_image'] = FCPATH.'uploads/order/'.$data_image['file_name'];
					$config_resize['create_thumb'] = FALSE;
					$config_resize['maintain_ratio'] = FALSE;
					$config_resize['width'] = 1920;
					$config_resize['height'] = 520;

					$this->load->library('image_lib', $config_resize);
					$this->image_lib->initialize($config_resize);
					$this->image_lib->resize();*/
					
					$data['order_name_image2'] = $data_image['file_name'];
                } else {
					$error = array('error' => $this->upload->display_errors());
					//pre($error);
				}
			}
			
			// update 
			if($id != '') {	
				$this->model_order->update_order($data, $id);
				
				redirect('order/backend/order', 'location');
				
			// insert
			} else {	
				$data['order_username_create'] = $this->session->userdata('session_username');
				$data['order_datetime_create'] = date('Y-m-d H:i:s');
				$data['order_ip_create'] = $_SERVER['REMOTE_ADDR'];
					
				$this->model_order->insert_order($data);
				
				redirect('order/backend/order', 'location');
			}
		} else {
			$this->order_form($id);
		}
	}
	
	public function order_delete($id){
		$this->model_order->delete_order($id);

		redirect('order/backend/order','location');
	}
	// end order 
	
	// payment	
	public function payment() {
		
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
		$this->load->view('order/payment/list', $data);
		/* end body */
	}
	
	public function payment_server_processing() {
		$list = $this->model_payment_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $payment) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $payment->order_no;
            $row[] = $payment->payment_method;
            $row[] = $payment->payment_date;
            $row[] = $payment->payment_time;
            $row[] = $payment->payment_money;
            $row[] = '<a href="'.base_url('uploads/payment/'.$payment->payment_slip).'" target="_blank"><img src="'.base_url('uploads/payment/'.$payment->payment_slip).'" width="100"></a>';
            $row[] = $payment->payment_name;
            $row[] = $payment->payment_email;
            $row[] = $payment->payment_telephone;
            $row[] = $payment->payment_more_detail;
            $row[] = $payment->payment_datetime_create;
            $row[] = $payment->payment_ip_create;

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
	// end payment

	public function ajaxChangeStatus() {
		$this->db->where('order_detail_id', $this->input->post('order_detail_id'));
		$query = $this->db->get('ci_order_detail');

		$row = $query->row();

		if(!empty($row)) {
			if(($row->order_detail_status == 'Order' or $row->order_detail_status == 'Processing' or $row->order_detail_status == 'Shipped' or $row->order_detail_status == 'Delivery' or $row->order_detail_status == 'Complete') and $this->input->post('order_detail_status') == 'Cancel') {
				$this->db->where('order_detail_id', $this->input->post('order_detail_id'));
				$query = $this->db->get('ci_order');

				$rows = $query->result();

				if(!empty($rows)) {
					foreach($rows as $r) {
						$this->db->where('product_id', $r->product_id);
						$this->db->where('weight_id', $r->order_weight);
						$this->db->where('color_id', $r->order_color);
						$this->db->where('collection_id', $r->order_collection);
						$query = $this->db->get('ci_product_stock');

						$row = $query->row();

						if(!empty($row)) {
							$product_stock_amount = $row->product_stock_amount + $r->order_qty;

							$data = array(
								'product_stock_amount' => $product_stock_amount
							);

							$where = array(
								'product_id' => $r->product_id,
								'weight_id' => $r->order_weight,
								'color_id' => $r->order_color,
								'collection_id' => $r->order_collection
							);

							$this->db->update('ci_product_stock', $data, $where);
						}
					}
				}
			}

			if($row->order_detail_status == 'Cancel' and ($this->input->post('order_detail_status') == 'Order' or $this->input->post('order_detail_status') == 'Processing' or $this->input->post('order_detail_status') == 'Shipped' or $this->input->post('order_detail_status') == 'Delivery' or $this->input->post('order_detail_status') == 'Complete')) {
				$this->db->where('order_detail_id', $this->input->post('order_detail_id'));
				$query = $this->db->get('ci_order');

				$rows = $query->result();

				if(!empty($rows)) {
					foreach($rows as $r) {
						$this->db->where('product_id', $r->product_id);
						$this->db->where('weight_id', $r->order_weight);
						$this->db->where('color_id', $r->order_color);
						$this->db->where('collection_id', $r->order_collection);
						$query = $this->db->get('ci_product_stock');

						$row = $query->row();

						if(!empty($row)) {
							$product_stock_amount = $row->product_stock_amount - $r->order_qty;

							$data = array(
								'product_stock_amount' => $product_stock_amount
							);

							$where = array(
								'product_id' => $r->product_id,
								'weight_id' => $r->order_weight,
								'color_id' => $r->order_color,
								'collection_id' => $r->order_collection
							);

							$this->db->update('ci_product_stock', $data, $where);
						}
					}
				}
			}

			$data = array(
				'order_detail_status' => $this->input->post('order_detail_status')
			);

			$where = array(
				'order_detail_id' => $this->input->post('order_detail_id'),
			);

			$this->db->update('ci_order_detail', $data, $where);
		}
			

		echo $this->input->post('order_detail_status');
	}

	// cancel	
	public function cancel() {
		
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
		$this->load->view('order/cancel/list', $data);
		/* end body */
	}
	
	public function cancel_server_processing() {
		$list = $this->model_cancel_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cancel) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $cancel->order_no;
            $row[] = $cancel->member_first_name.' '.$cancel->member_last_name;
            $row[] = $cancel->member_phone;
            $row[] = $cancel->member_email;
            $row[] = '<img src="'.base_url('uploads/product/'.$cancel->order_image).'" width="150">';
			$row[] = $cancel->order_name;
            $row[] = $cancel->order_qty;

			//$row[] = '<a href="'.site_url('order/backend/cancel_form/'.$cancel->cancel_detail_id).'">View</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_cancel_datatable->count_all(),
            "recordsFiltered" => $this->model_cancel_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	// end cancel

	// return	
	public function return_() {
		
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
		$this->load->view('order/return/list', $data);
		/* end body */
	}
	
	public function return_server_processing() {
		$list = $this->model_return_datatable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $return) {
            //$no++;
            $row = array();
            //$row[] = $no;
            $row[] = $return->order_no;
            $row[] = $return->member_first_name.' '.$return->member_last_name;
            $row[] = $return->member_phone;
            $row[] = $return->member_email;
            $row[] = '<img src="'.base_url('uploads/product/'.$return->order_image).'" width="150">';
			$row[] = $return->order_name;
            $row[] = $return->order_qty;

			//$row[] = '<a href="'.site_url('order/backend/return_form/'.$return->return_detail_id).'">View</a>';	
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_return_datatable->count_all(),
            "recordsFiltered" => $this->model_return_datatable->count_filtered(),
            "data" => $data,
    	);
        //output to json format
        echo json_encode($output);
	}
	// end return

	public function confirmCreditCard() {
		pre($_REQUEST);

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

				redirect(site_url('frontend/path/confirm_credit_card/'.$row->order_detail_id));
			}
		}
	}

	public function ajaxSendEmailTrackingNo() {
		$data_update = array(
			'order_detail_tracking_no' => $this->input->post('order_detail_tracking_no')
		);

		$where_update = array(
			'order_detail_id' => $this->input->post('order_detail_id')
		);

		$this->db->update('ci_order_detail', $data_update, $where_update);

		$this->db->where('order_detail_id', $this->input->post('order_detail_id'));
		$query = $this->db->get('ci_order_detail');

		$row_order_detail = $query->row();

		$this->db->order_by('order_id', 'asc');
		$this->db->where('order_detail_id', $this->input->post('order_detail_id'));
		$query = $this->db->get('ci_order');

		$row_order = $query->result();

		// Send Email
		if(!empty($row_order_detail)) {
			$cf_email = $this->model_order->getConfigEmailRecord();

			$sender = array($row_order_detail->order_detail_shipping_email);

			$subject = 'Order No '.$row_order_detail->order_no.' Tracking No';

			$message = 'Your Tracking No '.$this->input->post('order_detail_tracking_no');
			/*$discount = $row_order_detail->order_detail_discount;

			$message = '
				<html>
				<head>
					<meta charset="utf-8">
				</head>

				<body>
				<h2>Hi '.$row_order_detail->order_detail_shipping_name.' '.$row_order_detail->order_detail_shipping_last_name.' ,</h2><br>
				<p>
				Thanks for shopping with us! We are glad to inform you that your order #313032552279258 has been fully delivered with details as below. We hope you enjoy your purchase on Mistine Myanmar
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
						<td>'.number_format($sub_total + $discount - $this->session->userdata('order_detail_shipping'), 0, '.', ',').'</td>
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
			*/
			$from_email = $cf_email->config_email_username;

			$from_name = 'NoReply Mistine';

			$this->load->helper('phpmailer');

			if(!empty($cf_email)) {
				send_email($cf_email->config_email_host, $cf_email->config_email_username, $cf_email->config_email_password, $cf_email->config_email_smtpsecure, $cf_email->config_email_port, $sender, $subject, $message, $from_email, $from_name);
			}
			
			echo true;
		}
		// End Send Email
	}
}
?>