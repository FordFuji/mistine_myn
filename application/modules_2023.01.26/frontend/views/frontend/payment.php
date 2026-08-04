<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>

<style>
    .md-radio.md-radio-inline {
        display: inline-block;
    }
    .md-radio input[type="radio"] {
        display: none;
    }
    .md-radio label:after {
        top: 7.2px;
        left: 3.7px;
        width: 7px;
        height: 7px;
        transform: scale(0);
        background: #000;
    }
    .md-radio input[type="radio"]:checked + label:after {
        transform: scale(1);
    }
    .md-radio label:before {
        left: 0;
        top: 4px;
        width: 14px;
        height: 14px;
        border: 2px solid #000;
        background-color: #fff;
    }
    .md-radio label:before, .md-radio label:after {
        position: absolute;
        content: '';
        border-radius: 50%;
        transition: all .3s ease;
        transition-property: transform, border-color;
    }
    .md-radio input[type="radio"]:checked + label:before {
        border-color: #000;
        animation: ripple 0.2s linear forwards;
        background-color: #fff;
    }
    .md-radio label {
        display: inline-block;
        height: 20px;
        position: relative;
        padding: 0 30px;
        margin-bottom: 0;
        cursor: pointer;
        vertical-align: bottom;
        font-size: 16px;
    }
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
        border: 1.5px solid #959595;
        font-weight: bold;
        left: 53%;
    }

    .md-radio.md-radio-inline {
        display: flex;
    }

    @media (max-width: 767px) {
        .hr-stepw {
            top: 64px;
        }
        .hr-stepw {
            top: 54px;
        }
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
                                        <h4>Payment & Shipping</h4>
                                    </div>
                                </div>

                            </div>
                            <div class="stepwizard">
                                <div class="stepwizard-row">
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-link"><img src="<?php echo base_frontend('images/icom-step1.png');?>"></button>
                                        <p><span class="shipping">Shipping Address</span></p>
                                    </div>
                                    <div class="hr-stepw"></div>
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle" style="border: 2px solid #ec008c"><img src="<?php echo base_frontend('images/icom-step2-1.png');?>"></button>
                                        <p>Payment And Shipping</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <button type="button" class="btn btn-circle"><img src="<?php echo base_frontend('images/icom-step3.png');?>"></button>
                                        <p>Product Summary</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ShoppingCart">
                                <h5>Shipping Address</h5>
                            </div>

                            <div class="row pad_textpayment">
                                <div class="col-4 col-md-4">
                                    <div class="personal-text-1">Name | Last Names : </div>
                                    <div class="personal-text-1">Phone : </div>
                                    <div class="personal-text-1">E-mail : </div>
                                    <div class="personal-text-1">Address : </div>
                                </div>
                                <div class="col-8 col-md-8">
<?php

?>
                                    <div class="personal-text"><?php echo $this->session->userdata('order_detail_shipping_name').' '.$this->session->userdata('order_detail_shipping_last_name');?></div>
                                    <div class="personal-text"><?php echo $this->session->userdata('order_detail_shipping_phone');?></div>
                                    <div class="personal-text"><?php echo $this->session->userdata('order_detail_shipping_email');?></div>
                                    <div class="personal-text"><?php echo $this->session->userdata('order_detail_shipping_address').' '.$this->session->userdata('order_detail_shipping_sub_district').', '.$this->session->userdata('shipping_township').', '.$this->session->userdata('shipping_location').' '.$this->session->userdata('order_detail_shipping_postal_code');?></div>
<?php

?>
                                </div>
                            </div>
                            <div class="ShoppingCart">
                                <h5>Payment</h5>
                            </div>
                            <fieldset class="form-group">
                                <div class="md-radio md-radio-inline radiocheck">
                                    <input id="credit_debit_card" type="radio" name="order_detail_payment_method" <?php if($this->session->userdata('order_detail_payment_method') == 'Credit / Debit Card') echo 'checked';?>>
                                    <label for="credit_debit_card">Credit / Debit Card</label>
                                </div>
                                <div class="md-radio md-radio-inline radiocheck">
                                    <input id="atm" type="radio" name="order_detail_payment_method" <?php if($this->session->userdata('order_detail_payment_method') == 'Pay Via ATM') echo 'checked';?>>
                                    <label for="atm">Pay Via ATM</label>
                                </div>
                                <div class="md-radio md-radio-inline radiocheck">
                                    <input id="transfer_bank" type="radio" name="order_detail_payment_method" <?php if($this->session->userdata('order_detail_payment_method') == 'Transfer money / payment via bank channel') echo 'checked';?> rel="bank">
                                    <label for="transfer_bank">Transfer money / payment via bank channel</label>
                                </div>
                                <div class="wrap_radioinsure bank">
                                    <div class="col">
<?php
if(!empty($bank)) {
    foreach($bank as $r) {
?>                                        
                                        <div class="form-check">
                                            <div class="row">
                                                <div class="col-1">
                                                    <input class="form-check-input" type="radio" name="order_detail_bank" id="order_detail_bank_<?php echo $r->bank_transfer_id;?>" value="<?php echo $r->bank_transfer_id;?>" <?php if($this->session->userdata('order_detail_bank') == $r->bank_transfer_id) echo 'checked';?>>
                                                </div>
                                                <div class="col-11 nopan">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        <div class="personal-text"><img src="<?php echo base_url('uploads/bank_transfer/'.$r->bank_transfer_image);?>" width="150"> <?php echo get2Lang($this->session->userdata('lang'), $r->bank_transfer_name_lang1, $r->bank_transfer_name_lang2);?> <?php echo get2Lang($this->session->userdata('lang'), $r->bank_transfer_branch_lang1, $r->bank_transfer_branch_lang2);?> Account Number <?php echo $r->bank_transfer_number;?></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
<?php
    }
}
?>
                                    </div>
                                </div>
                                <div class="md-radio md-radio-inline radiocheck">
                                    <input id="cod" type="radio" name="order_detail_payment_method" <?php if($this->session->userdata('order_detail_payment_method') == 'Destination Payment') echo 'checked';?>>
                                    <label for="cod">Cash on delivery</label>
                                </div>
                                
                            </fieldset>
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

$total = $sub_total - $all_discount + $this->session->userdata('order_detail_shipping');
?>
                        <div class="col-12 col-md-12 col-lg-4 col-xl-4 bg_boxsummary mobile_bg_boxsummary">
                            <div class="order_summary">
                                <h4>Order Summary</h4>
                            </div>
                            <div class="text_order">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="text-align: left;">Item <?php echo $i;?></h6>
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
                                        <h6><?php echo number_format($this->session->userdata('order_detail_shipping'), 0, '.', ',');?></h6>
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
                                <div class="buttom_register"><a href="javascript:getPaymentMethod();">next</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var radiocheck = $('.radiocheck input:checked').attr('rel');
            $('.' + radiocheck).slideDown();
            $('.radiocheck input').click(function() {
                var radiocheck = $('.radiocheck input:checked').attr('rel');
                $('.wrap_radioinsure').slideUp();
                $('.' + radiocheck).slideDown();
            });

            var radiocheckbill = $('.radiocheckbill input:checked').attr('rel');
            $('.' + radiocheckbill).slideDown();
            $('.radiocheckbill input').click(function() {
                var radiocheckbill = $('.radiocheckbill input:checked').attr('rel');
                $('.wrap_radiobill').slideUp();
                $('.' + radiocheckbill).slideDown();
            });
        });

        function getPaymentMethod() {
            if($("#credit_debit_card").is(":checked") == false && $("#atm").is(":checked") == false && $("#transfer_bank").is(":checked") == false && $("#cod").is(":checked") == false) {
                alert('Please select Payment');
            } else if($("#transfer_bank").is(":checked") == true && $("#order_detail_bank_1").is(":checked") == false && $("#order_detail_bank_2").is(":checked") == false && $("#order_detail_bank_3").is(":checked") == false && $("#order_detail_bank_4").is(":checked") == false && $("#order_detail_bank_5").is(":checked") == false) {
                alert('Please select Bank');
            } else {
                if($("#credit_debit_card").is(":checked") == true) {
                    var order_detail_payment_method = 'Credit / Debit Card';
                } else if($("#atm").is(":checked") == true) {
                    var order_detail_payment_method = 'Pay Via ATM';
                } else if($("#transfer_bank").is(":checked") == true) {
                    var order_detail_payment_method = 'Transfer money / payment via bank channel';
                    if($("#order_detail_bank_1").is(":checked") == true) {
                        var order_detail_bank = '1';
                    } else if($("#order_detail_bank_2").is(":checked") == true) {
                        var order_detail_bank = '2';
                    } else if($("#order_detail_bank_3").is(":checked") == true) {
                        var order_detail_bank = '3';
                    } else if($("#order_detail_bank_4").is(":checked") == true) {
                        var order_detail_bank = '4';
                    } else if($("#order_detail_bank_5").is(":checked") == true) {
                        var order_detail_bank = '5';
                    }
                } else if($("#cod").is(":checked") == true) {
                    var order_detail_payment_method = 'Destination Payment';
                }

                $.post('<?php echo site_url("frontend/path/ajaxPaymentMethod");?>', { order_detail_payment_method: order_detail_payment_method, order_detail_bank: order_detail_bank }, function(data) {
                    window.location.href = '<?php echo site_url('frontend/path/productsummary');?>';
                });
            }
        }
    </script>
</body>

</html>