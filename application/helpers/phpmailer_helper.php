<?php
require_once "PHPMailer-5.2.26/class.phpmailer.php";
require_once "PHPMailer-5.2.26/class.smtp.php";

/*
define('SMTPSECURE', 'tls');
define('PORT', 587);
*/
//define('PORT', 25);

/*
define('HOST', 'mail.mistine-myanmar.com');
define('USERNAME', 'noreply@mistine-myanmar.com');
define('PASSWORD', 'vVATtug4(7(W');
define('SMTPSECURE', 'ssl');
define('PORT', 465);
*/

function send_email($host, $username, $password, $smtpsecure, $port, $sender = array(), $subject, $message, $from_email, $from_name, $file_attachment = array(), $addbcc = array()) {

	$mail = new PHPMailer; 

	$mail->SMTPOptions = array(
	    'ssl' => array(
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
	    )
	);

	//Enable SMTP debugging. 
	$mail->SMTPDebug = 0;                               
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();            
	//Set SMTP host name                          
	$mail->Host = $host;
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
	//Provide username and password     
	$mail->Username = $username;                 
	$mail->Password = $password;                           
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = $smtpsecure;                           
	//Set TCP port to connect to 
	$mail->Port = $port;   
	
	$mail->CharSet = 'utf-8';                                

	$mail->From = $from_email;
	$mail->FromName = $from_name;

	if(!empty($sender)) {
		foreach($sender as $arr) {
			if($arr != '') {
				$mail->addAddress($arr);     // Add a recipient			
			}
		}
	}
	
	if(!empty($addbcc)) {
		foreach($addbcc as $arr) {
			if($arr != '') {
				$mail->AddBCC($arr);     // Add a recipient			
			}
		}
	}
	
	/*if($_SERVER['SERVER_NAME'] == 'localhost') {
		$mail->AddBCC('sitiporn@orange-thailand.com', 'Ford');     // Add a recipient			
	} else {
		$mail->AddBCC('prow@tresfashion.co', 'K.Prow');     // Add a recipient
		$mail->AddBCC('ploy@tresfashion.co', 'K.Ploy');     // Add a recipient
	}*/
	
	if(!empty($file_attachment)) {
		foreach($file_attachment as $arr) {
			if($arr != '') {
				$mail->AddAttachment($arr);		
			}
		}	
	}

	$mail->isHTML(true);

	$mail->Subject = $subject;
	$mail->Body = $message;
	//$mail->AltBody = "This is the plain text version of the email content";

	
	if(!$mail->send()) {
		echo 'Message could not be sent<br>';
		echo 'Mailer Error: ' . $mail->ErrorInfo.'<br>';
	} else {
		//echo '<span style="color: white;">Message has been sent '.date('Y-m-d H:i:s').'<br></span>';
	}
	
	$mail->ClearAddresses();
}
?>