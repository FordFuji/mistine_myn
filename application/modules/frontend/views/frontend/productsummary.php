<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>

<style>
    .stepwizard-row:before {
        border: 1.5px solid #ec008c;
    }
    
    .hr-stepw {
        top: 64px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 31%;
        height: 1px;
        border: 2px solid #e9702d;
        font-weight: bold;
        left: 53%;
    }
</style>
<body>
    <?php require('inc_menu.php'); ?>
        
    <div class="container-fluid ba_gary">
        <div class="container">
            <div class="row pad_cartshop">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 col-xl-8 bg_boxcart">
                            <div class="row cart_cartshop">
                                <div class="col-12 col-md-6 col-lg-6 cartpad-left">
                                    <div class="cart_cart">
                                        <h4>Shipping Address</h4>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="stepwizard">
                                <div class="stepwizard-row">
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-link"><img src="<?php echo base_frontend('images/icom-step1.png');?>"></button>
                                        <p><span class="shipping">Shipping Address</span></p>
                                    </div>
                                    
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" style="border: 2px solid #ec008c"><img src="<?php echo base_frontend('images/icom-step2-1.png');?>"></button>
                                        <p>Payment And Shipping</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" style="border: 2px solid #ec008c"><img src="<?php echo base_frontend('images/icom-step3-1.png');?>"></button>
                                        <p>Product Summary</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ShoppingCart">
                                <h5>Payment</h5>
                            </div>

                            <div class="row pad_textpayment">
                                <div class="col-4 col-md-4">
                                    <div class="personal-text-1">Name I Last Names : </div>
                                    <div class="personal-text-1">Phone : </div>
                                    <div class="personal-text-1">E-mail : </div>
                                    <div class="personal-text-1">Address : </div>
                                </div>
                                <div class="col-8 col-md-8">
                                    <div class="personal-text"><?php echo $this->session->userdata('order_detail_shipping_name').' '.$this->session->userdata('order_detail_shipping_last_name');?></div>
                                    <div class="personal-text"><?php echo $this->session->userdata('order_detail_shipping_phone');?></div>
                                    <div class="personal-text"><?php echo $this->session->userdata('order_detail_shipping_email');?></div>
                                    <div class="personal-text"><?php echo $this->session->userdata('order_detail_shipping_address').' '.$this->session->userdata('order_detail_shipping_sub_district').', '.$this->session->userdata('shipping_township').', '.$this->session->userdata('shipping_location').' '.$this->session->userdata('order_detail_shipping_postal_code');?></div>
                                </div>
                            </div>
                            <div class="ShoppingCart">
                                <h5>Payment</h5>
                            </div>
                            <div class="banking">
                                <h6><?php echo $this->session->userdata('order_detail_payment_method');?></h6>
<?php
if(!empty($bank)) {
?>
                                <p><img src="<?php echo base_url('uploads/bank_transfer/'.$bank->bank_transfer_image);?>" class="img-fluid"> <?php echo get2Lang($this->session->userdata('lang'), $bank->bank_transfer_name_lang1.' '.$bank->bank_transfer_branch_lang1.' '.$bank->bank_transfer_number, $bank->bank_transfer_name_lang2.' '.$bank->bank_transfer_branch_lang2.' '.$bank->bank_transfer_number);?></p>
<?php
}
?>
                            </div>
                        </div>
<?php 
$i = 0;
$sub_total = 0;
foreach($this->cart->contents() as $items) {
    $price = $items['qty'] * $items['price'];

    $sub_total += $price;

    $i++;
}

$discount = 0;
if($this->session->userdata('coupon_type') == '%') {
    $discount = $sub_total * $this->session->userdata('coupon_discount') / 100;
} elseif($this->session->userdata('coupon_type') == 'Baht') {
    $discount = $sub_total - $this->session->userdata('coupon_discount');
}

$voucher_price = 0;
if($this->session->userdata('voucher_price') != 'Free Shipping' or $this->session->userdata('voucher_price') != '') {
    $voucher_price = $this->session->userdata('voucher_price');
}

$all_discount = $discount + $voucher_price;

$shipping = $this->session->userdata('order_detail_shipping');

$total = $sub_total - $all_discount + $shipping;
?>
                        <div class="col-12 col-md-12 col-lg-4 col-xl-4 bg_boxsummary mobile_bg_boxsummary">
                            <div class="order_summary">
                                <h4>Order Summary</h4>
                            </div>
                            <div class="text_order">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="text-align: left;">Item <?php echo $i;?> </h6>
                                    </div>
                                    <div class="col-6">
                                        <h6><?php echo number_format($sub_total, 0, '.', ',');?></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="text-align: left; text-transform: uppercase;">Shipping</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6><?php echo number_format($shipping, 0, '.', ',');?></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="text-align: left; text-transform: uppercase;">Discount</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6><?php echo number_format($all_discount, 0, '.', ',');?></h6>
                                    </div>
                                </div>
                                <div class="row pad_total">
                                    <div class="col-6">
                                        <h6 style="text-align: left; text-transform: uppercase;">ToTal Payment</h6>
                                    </div>
                                    <div class="col-6">
                                    <h6><?php echo number_format($total, 0, '.', ',');?></h6>
                                    </div>
                                </div>
                                <div class="buttom_register"><a href="javascript:checkOut();">Confirm order</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
require('inc_footer.php'); 
if($this->session->userdata('order_detail_payment_method') == 'Credit / Debit Card') {
    $payment_method = 'credit';
} else {
    $payment_method = 'other';
}


if($_SERVER['SERVER_NAME'] == 'localhost' or $_SERVER['SERVER_NAME'] == 'ford.orangeworkshop.info') {
    //Merchant's account information
    $merchant_id = "104104000000427";          //Get MerchantID when opening account with 2C2P
    $secret_key = "E823BA377C9391F3BC68126EFFFEB2C9CEFDC8B63F4DD9D6C3AC436069A28275";   //Get SecretKey from 2C2P PGW Dashboard
} else {
    $merchant_id = "JT04";          //Get MerchantID when opening account with 2C2P
    $secret_key = "QnmrnH6QE23N";   //Get SecretKey from 2C2P PGW Dashboard
}

$sub_total = 0;
foreach($this->cart->contents() as $items) {
    $price = $items['qty'] * $items['price'];

    $sub_total += $price;
}

$discount = 0;
if($this->session->userdata('coupon_type') == '%') {
    $discount = $sub_total * $this->session->userdata('coupon_discount') / 100;
} elseif($this->session->userdata('coupon_type') == 'Baht') {
    $discount = $this->session->userdata('coupon_discount');
}

$voucher_price = 0;
if($this->session->userdata('voucher_price') != 'Free Shipping' or $this->session->userdata('voucher_price') != '') {
    $voucher_price = $this->session->userdata('voucher_price');
}

$all_discount = $discount + $voucher_price;

$total = $sub_total - $all_discount + $this->session->userdata('order_detail_shipping');

$total = str_replace('.', '', number_format($total, 2, '', ''));

//Transaction information
$payment_description  = 'Product Mistine Myanmar';
$order_id  = time();
$currency = "104";
//$amount  = '000000000100';

if(strlen($total) == 12) {
    $total_all = $total;
} elseif(strlen($total) == 11) {
    $total_all = '0'.$total;
} elseif(strlen($total) == 10) {
    $total_all = '00'.$total;
} elseif(strlen($total) == 9) {
    $total_all = '000'.$total;
} elseif(strlen($total) == 8) {
    $total_all = '0000'.$total;
} elseif(strlen($total) == 7) {
    $total_all = '00000'.$total;
} elseif(strlen($total) == 6) {
    $total_all = '000000'.$total;
} elseif(strlen($total) == 5) {
    $total_all = '0000000'.$total;
} elseif(strlen($total) == 4) {
    $total_all = '00000000'.$total;
} elseif(strlen($total) == 3) {
    $total_all = '000000000'.$total;
} elseif(strlen($total) == 2) {
    $total_all = '0000000000'.$total;
} elseif(strlen($total) == 1) {
    $total_all = '00000000000'.$total;
}

$amount = $total_all;

//Payment Options
$enable_store_card = "Y";       //Enable / Disable Tokenization
$request_3ds = "Y";             //Enable / Disable 3DS
$payment_option = "A";          //Customer Payment Options

//Request information
$version = "8.5";   
if($_SERVER['SERVER_NAME'] == 'localhost' or $_SERVER['SERVER_NAME'] == 'ford.orangeworkshop.info') {
    $payment_url = "https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment";
} else {
    $payment_url = "https://t.2c2p.com/RedirectV3/payment";
}

// $result_url_1 = site_url('frontend/path/confirmCreditCard');

// $result_url_2 = site_url('order/backend/confirmCreditCard');


$result_url_1 = site_url('order/frontend/index');

$result_url_2 = site_url('order/backend/index');


//Construct signature string
$params = $version . $merchant_id . $payment_description . $order_id .  
$currency . $amount . $result_url_1 . $result_url_2 . $enable_store_card . $request_3ds . $payment_option;
$hash_value = hash_hmac('sha256', $params, $secret_key, false); //Compute hash value
?>
    </div>
    <form id="myform" name="myform" method="post" action="<?php echo $payment_url; ?>">
        <input type="hidden" name="version" value="<?php echo $version; ?>"/>
        <input type="hidden" name="merchant_id" value="<?php echo $merchant_id; ?>"/>
        <input type="hidden" name="currency" value="<?php echo $currency; ?>"/>
        <input type="hidden" name="result_url_1" value="<?php echo $result_url_1; ?>"/>
        <input type="hidden" name="result_url_2" value="<?php echo $result_url_2; ?>"/>
        <input type="hidden" name="enable_store_card" value="<?php echo $enable_store_card; ?>"/>
        <input type="hidden" name="request_3ds" value="<?php echo $request_3ds; ?>"/>
        <input type="hidden" name="payment_option" value="<?php echo $payment_option; ?>"/>
        <input type="hidden" name="hash_value" value="<?php echo $hash_value; ?>"/>
        <input type="hidden" name="payment_description" value="<?php echo $payment_description;?>" readonly/><br/>
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"  readonly/><br/>
        <input type="hidden" name="amount" value="<?php echo $amount; ?>" readonly/><br/>
        <!-- <input type="submit" name="submit" value="Confirm" /> -->
    </form>  
    <script>
        var payment_method = '<?php echo $payment_method;?>';

        function checkOut() {
            $.post('<?php echo site_url('frontend/path/ajaxCheckout');?>', function(data) {
                $(".buttom_register").hide();
                
                if(payment_method == 'credit') {
                    $("#myform").submit();
                } else {
                    window.location.href = '<?php echo site_url('frontend/path/confirm');?>/' + data;
                }
            });
        }
    </script>    
</body>

</html>