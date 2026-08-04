<?php
class Test extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function test_cart() {
		$this->load->library('cart');
		
		$data = array(
	        'id'      => '3',
	        'qty'     => 1,
	        'price'   => 39.95,
	        'name'    => 'กกก๊',
	        'options' => array(
	        	'Size' => 'L', 
	        	'Color' => 'ขขข๊'
	        )
		);

		$this->cart->insert($data);
		
		pre($this->cart->contents());
		
	}

	public function testAddDate() {
		$date = strtotime("+2 day");
		echo date('Y-m-d H:i:s',$date);
	}

	public function testPlusDatetime2Day() {
		$date = date('Y-m-d H:i:s', strtotime('+2 day', strtotime(date('Y-m-d H:i:s'))));

		echo $date;
	}

	public function testSendMail() {
		$this->load->helper('phpmailer');

		$this->load->model('frontend/model_frontend', 'model_frontend');

		$sender = array('sitiporn@orange-thailand.com');

		$subject = 'Test Mail Mistine';

		$message = 'Test Message Mistine';

		$from_email = 'noreply@mistine-myanmar.com';

		$from_name = 'NoReply';

		$cf_email = $this->model_frontend->getConfigEmailRecord();

		if(!empty($cf_email)) {
			send_email($cf_email->config_email_host, $cf_email->config_email_username, $cf_email->config_email_password, $cf_email->config_email_smtpsecure, $cf_email->config_email_port, $sender, $subject, $message, $from_email, $from_name);
		}
	}

	public function testCurrency() {
		echo str_replace('.', '', number_format(1000.01, 2, '', ''));
	}

	public function testLoginGoogle() {
?>
		<!doctype html>
		<html>
		<html lang="en">
		<head>
		<!--  กำหนดขอบเขตท้อมูลการร้องขอ มี profile กับ email-->
			<meta name="google-signin-scope" content="profile email">
		<!--    กำหนด client ID ที่เราได้สร้างไว้-->
			<meta name="google-signin-client_id" content="766322749137-kkmup9fcu48h80pih79b4vpoiva02anj.apps.googleusercontent.com">
		<!--    ต้องมีการเรียกใช้งาน Google Platform Library ในหน้าที่มีการใช้งาน Google Sign In-->
			<script src="https://apis.google.com/js/platform.js" async defer></script>
		</head>
		<body>
		
		<!--  วางปุ่มล็อกอินด้วย Google ในตำแหน่งที่ต้องการ-->
			<div class="g-signin2" data-onsuccess="onSignIn" data-theme="light"></div>
			
		<br>
		<br>
		<!--ปุ่มล็อกเอ้าท์ออกจาก Google Sign In อย่างง่าย ที่ให้เราออกจากการล็อกอินผ่าน Google-->
		<a href="javascript:void(0);" onclick="signOut();">Sign out</a>   
			
			<script>
		/* สังเกตจากปุ่มล็อกอินด้านบน จะเห็นว่ามีการกำหนด data-onsuccess="onSignIn"
				ซึ่งก็คือเมื่อมีการล็อกอินผ่าน Google แล้วให้เรียกใช้งานฟังก์ชั่น ที่ชื่อ onSignIn*/
			function onSignIn(googleUser) {
				
				// ขอมูลของผู้ใช้งานที่ล็อกอิน ที่เราสามารถนำไปใช้งานได้ 
				var profile = googleUser.getBasicProfile();
				console.log("ID: " + profile.getId()); // google แนะนำว่าไม่ควรส่งคานี้ไปเก็บไว้บน server 
				// ค่า ID นี้เราสามรรถประยุกต์เพิ่มเติมตามต้องการ เช่นอาจจะเข้ารหัสก่อนบันทึกหรืออะไรก็ได้
				// แต่ในที่นี้จะใช้วิธีอยางง่่ายเพื่อเป็นแนวทาง
				console.log('Full Name: ' + profile.getName());
				console.log('Given Name: ' + profile.getGivenName());
				console.log('Family Name: ' + profile.getFamilyName());
				console.log("Image URL: " + profile.getImageUrl());
				console.log("Email: " + profile.getEmail());
		
				// google แนะนำให้ใช้ ID token สำหรับใช้ในการตรวจสอบการล็อกอิน
				var id_token = googleUser.getAuthResponse().id_token;
				console.log("ID Token: " + id_token);

				$.post('<?php echo site_url("frontend/path/ajaxLoginGoogle");?>', { member_first_name: profile.getGivenName(), member_last_name: profile.getFamilyName(), member_email: profile.getEmail() }, function(data) {
					window.location.href = '<?php echo site_url();?>';
				});
			};
			</script>
			
			
			<script>
		/* ฟังก์ชั่นล็อกเอาท์*/
			function signOut() {
				var auth2 = gapi.auth2.getAuthInstance();
				auth2.signOut().then(function () {
				console.log('User signed out.');
				window.location=window.location.href;
				});
			}
			</script>    
			
		</body>
		</html>
<?php
	}
}