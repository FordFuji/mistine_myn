<?php 
	//Merchant's account information
	$merchant_id = "JT04";			//Get MerchantID when opening account with 2C2P
	$secret_key = "QnmrnH6QE23N";	//Get SecretKey from 2C2P PGW Dashboard
	
	//Transaction information
	$payment_description  = 'Shipping - Pixels Hightlight';
	$order_id  = time();
	$currency = "764";
	$amount  = '000000000100';
	
	//Payment Options
	$enable_store_card = "Y";		//Enable / Disable Tokenization
	$request_3ds = "Y";				//Enable / Disable 3DS
	$payment_option = "A";			//Customer Payment Options
	
	//Request information
	$version = "8.5";	
	$payment_url = "https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment";
	$result_url_1 = "https://cchannelshopto.com/response.php";
	
	//Construct signature string
    $params =$version . $merchant_id . $payment_description . $order_id .  
	$currency . $amount . $result_url_1 . $enable_store_card . $request_3ds . $payment_option;
	$hash_value = hash_hmac('sha256', $params, $secret_key, false);	//Compute hash value
?>
<html> 
	
	<style type="text/css">
		body {
  background: #303030;
}

#dot {
  height: 20px;
  width: 20px;
  border-radius: 100%;
  
  position: absolute;
  margin: auto;
  right: 0;
  left: 0;
  top: 0;
  bottom: 0;
  
  background: #e74c3c;
}

#ring {
  height: 20px;
  width: 20px;
  border-radius: 100%;
  
  position: absolute;
  margin: auto;
  right: 0;
  left: 0;
  top: 0;
  bottom: 0;
  
  border: 2px solid #e74c3c;
  
  animation-name: bloop;
  animation-duration: 1s;
  animation-timing-function: ease-out;
  animation-iteration-count: infinite;
  animation-delay: 0.7s;
}

@keyframes bloop {
  0% {width: 10px; height: 10px; opacity: 1;}
  100% {width: 100px; height: 100px; opacity: 0;}
}

@keyframes move {
  0% {right: 0;
  left: 0;
  top: -190px;
  bottom: 0;}
  
  30% {transform: scale(1.0)}
  50% {transform: scale(0.5)}
  70% {transform: scale(1.0)}
  
  100% {right: 0;
  left: 0;
  top: 190px;
  bottom: 0;}
}

#move {
  position: absolute;
  margin: auto;
  animation-name: move;
  animation-duration: 1s;
  animation-direction: alternate;
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
}

#rotate {
  position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  animation-name: rotate;
  animation-duration: 20s;
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
}

@keyframes rotate {
  0% {transform: rotate(0deg);}
  100% {transform: rotate(360deg);}
}

p {
  text-align: center;
  color: white;
  font-family: sans-serif;
  font-size: 2em;
  margin-top: 60%;
}
	</style>

	<body>
	<form id="myform" name="myform" method="post" action="<?php echo $payment_url; ?>">
		<input type="hidden" name="version" value="<?php echo $version; ?>"/>
		<input type="hidden" name="merchant_id" value="<?php echo $merchant_id; ?>"/>
		<input type="hidden" name="currency" value="<?php echo $currency; ?>"/>
		<input type="hidden" name="result_url_1" value="<?php echo $result_url_1; ?>"/>
		<input type="hidden" name="enable_store_card" value="<?php echo $enable_store_card; ?>"/>
		<input type="hidden" name="request_3ds" value="<?php echo $request_3ds; ?>"/>
		<input type="hidden" name="payment_option" value="<?php echo $payment_option; ?>"/>
		<input type="hidden" name="hash_value" value="<?php echo $hash_value; ?>"/>
    	<input type="hidden" name="payment_description" value="<?php echo $payment_description;?>" readonly/><br/>
		<input type="hidden" name="order_id" value="<?php echo $order_id; ?>"  readonly/><br/>
		<input type="hidden" name="amount" value="<?php echo $amount; ?>" readonly/><br/>
		<!-- <input type="submit" name="submit" value="Confirm" /> -->
	</form>  

	<div id="rotate">
	  <div id="move">
	    <div id="dot"></div>
	  </div>
	  <div id="ring"></div>
	</div>
	<p></p>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">
		// document.forms.myform.submit();
		$(document).ready(function(){
		     $("#myform").submit();
		});
	</script>
	</body>
	</html>