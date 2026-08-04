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
    @media (max-width: 1199px){
        .md-radio label{
            font-size: 15px;
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
                                        <button type="button" class="btn btn-circle"><img src="<?php echo base_frontend('images/icom-step2.png');?>"></button>
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
                            <div class="md-radio md-radio-inline radiocheck">
                                <input id="order_detail_shipping_type_original" type="radio" name="order_detail_shipping_type" rel="complete_y" <?php if($this->session->userdata('member_id') != '' and !empty($row)) echo 'checked'; else echo 'disabled';?>>
                                <label for="order_detail_shipping_type_original">Original Shipping Address</label>
                            </div>
                            <div class="md-radio md-radio-inline radiocheck">
                                <input id="order_detail_shipping_type_new_address" type="radio" name="order_detail_shipping_type" rel="complete_n" <?php if($this->session->userdata('member_id') == '') echo 'checked';?>>
                                <label for="order_detail_shipping_type_new_address">New Address</label>
                            </div>
                            <div class="wrap_radioinsure complete_y" style="display: <?php if($this->session->userdata('member_id') != '') echo 'block'; else echo 'none';?>;">
                                <div class="row padding-bottom-com">
                                    <div class="col-4 col-md-4 col-lg-3">
                                        <div class="personal-text-1">Name : </div>
                                        <div class="personal-text-1">Last Names : </div>
                                        <div class="personal-text-1">Phone : </div>
                                        <div class="personal-text-1">E-mail : </div>
                                        <div class="personal-text-1">Address : </div>
                                        <div class="personal-text-1">Sub District : </div>
                                        <div class="personal-text-1">Township : </div>
                                        <div class="personal-text-1">Region/State : </div>
                                        <div class="personal-text-1">Postal Code : </div>
                                    </div>
                                    <div class="col-4 col-md-4 col-lg-4">
                                        <div class="personal-text"><?php if($this->session->userdata('member_id') != '' and !empty($row) and $row->member_first_name != '') echo $row->member_first_name; else echo '-';?></div>
                                        <div class="personal-text"><?php if($this->session->userdata('member_id') != '' and !empty($row) and $row->member_last_name != '') echo $row->member_last_name; else echo '-';?></div>
                                        <div class="personal-text"><?php if($this->session->userdata('member_id') != '' and !empty($row) and $row->member_phone != '') echo $row->member_phone; else echo '-';?></div>
                                        <div class="personal-text"><?php if($this->session->userdata('member_id') != '' and !empty($row) and $row->member_email != '') echo $row->member_email; else echo '-';?></div>
                                        <div class="personal-text"><?php if($this->session->userdata('member_id') != '' and !empty($row)) echo $row->member_shipping_address_address; else echo '-';?></div>
                                        <div class="personal-text"><?php if($this->session->userdata('member_id') != '' and !empty($row)) echo $row->member_shipping_address_sub_district; else echo '-';?></div>
                                        <div class="personal-text"><?php if($this->session->userdata('member_id') != '' and !empty($row)) echo $row->shipping_township; else echo '-';?></div>
                                        <div class="personal-text check_province"><?php if($this->session->userdata('member_id') != '' and !empty($row)) echo $row->shipping_location; else echo '-';?></div>
                                        <div class="personal-text"><?php if($this->session->userdata('member_id') != '' and !empty($row)) echo $row->member_shipping_address_postal_code; else echo '-';?></div>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input class="form-check-input collapsed" type="checkbox" value="">
                                      Need tax invoices
                                    </label>
                                  </div>
                                </fieldset>
                            </div>
                            <div class="wrap_radioinsure complete_n padding-bottom-lo" <?php if($this->session->userdata('member_id') != '') echo 'none'; else echo 'block';?>>
                                <div class="row pad_wrap_radioinsure">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="order_detail_shipping_name" class="form-shipping" placeholder="Name" value="<?php echo $this->session->userdata('order_detail_shipping_name');?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="order_detail_shipping_last_name" class="form-shipping" placeholder="Last names" value="<?php echo $this->session->userdata('order_detail_shipping_last_name');?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="order_detail_shipping_phone" class="form-shipping" placeholder="Phone" value="<?php echo $this->session->userdata('order_detail_shipping_phone');?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="order_detail_shipping_email" class="form-shipping" placeholder="Email" value="<?php echo $this->session->userdata('order_detail_shipping_email');?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="ma-top-foemember">
                                            <textarea class="form-shipping" id="order_detail_shipping_address" rows="4" placeholder="Address" style="height: inherit;"><?php echo $this->session->userdata('order_detail_shipping_address');?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="ma-top-foemember">
                                            <input id="order_detail_shipping_sub_district" class="form-shipping" placeholder="Sub District" value="<?php echo $this->session->userdata('order_detail_shipping_sub_district');?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="menu_product">
                                            <div class="dropdown open"> 
                                                <!-- <a class="dropdown-toggle btn-province" data-toggle="dropdown" href="#" aria-expanded="true">Please select province.<b class="caret-menu"><i class="fa fa-angle-down" aria-hidden="true"></i></b>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-form-menu" role="menu">
                                                    <li><a href="">Bangkok</a></li>
                                                    <li><a href="">Lampang</a></li>
                                                    <li><a href="">Songkhla</a></li>
                                                </ul> -->
                                                <select id="shipping_location" name="shipping_location" class="form-control" onchange="changeShippingLocation(this.value);">
                                                    <option value="">Region/State</option>
<?php
$shipping_location = $this->model_frontend->getShippingLocation();
if(!empty($shipping_location)) {
    foreach($shipping_location as $r) {
?>
                                                    <option value="<?php echo $r->rate_shipping_location;?>" <?php if($r->rate_shipping_location == $this->session->userdata('shipping_location')) echo 'selected';?>><?php echo $r->rate_shipping_location;?></option>
<?php
    }
} 
?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="menu_product">
                                            <div class="dropdown open"> 
                                                <!-- <a class="dropdown-toggle btn-province" data-toggle="dropdown" href="#" aria-expanded="true">Please select province.<b class="caret-menu"><i class="fa fa-angle-down" aria-hidden="true"></i></b>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-form-menu" role="menu">
                                                    <li><a href="">Bangkok</a></li>
                                                    <li><a href="">Lampang</a></li>
                                                    <li><a href="">Songkhla</a></li>
                                                </ul> -->
                                                <select id="shipping_township" name="shipping_township" class="form-control">
                                                    <option value="">Township</option>
<?php
$shipping_township = $this->model_frontend->getShippingTownship($this->session->userdata('shipping_location'));
if(!empty($shipping_township)) {
    foreach($shipping_township as $r) {
?>
                                                    <option value="<?php echo $r->rate_shipping_township;?>" <?php if($r->rate_shipping_township == $this->session->userdata('shipping_township')) echo 'selected';?>><?php echo $r->rate_shipping_township;?></option>
<?php
    }
}
?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="ma-top-foemember">
                                            <input id="order_detail_shipping_postal_code" class="form-shipping" placeholder="Postal Code" value="<?php echo $this->session->userdata('order_detail_shipping_postal_code');?>">
                                        </div>
                                    </div>
                                </div>
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
<?php
/*
                                <div class="kerry_express">
                                    <h5>SHIPPING</h5>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="text-align: left; text-transform: uppercase;"><?php echo $this->session->userdata('order_detail_shipping_method');?></h6>
                                    </div>
                                    <div class="col-6">
                                        <h6><?php echo number_format($this->session->userdata('order_detail_shipping'), 0, '.', ',');?></h6>
                                    </div>
                                    <!-- <a class="dropdown-toggle btn-select-menu form-login" data-toggle="dropdown" href="#" aria-expanded="true">Free Shipping <b class="caret-menu"><i class="fa fa-angle-down" aria-hidden="true"></i></b>
                                        </a>
                                    <ul class="dropdown-menu dropdown-menu-form-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <li><a href="">EMS delivery time 2-3 days</a></li>
                                    </ul> -->
                                </div>
*/
?>
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
                                <div class="buttom_register"><a href="javascript:checkShippingAddress();">next</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
    </div>
<?php
if($this->session->userdata('member_id') != '') {
    $member_id = true;
} else {
    $member_id = false;
}
?>
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

        function checkShippingAddress() {
            var member_id = '<?php echo $member_id;?>';

            console.log(member_id);

            if(member_id == true && $(".check_province").text() == '-' && $("#order_detail_shipping_type_original").is(":checked") == true) {
                alert('Please enter Your Address or Select New Address');
            } else if($("#order_detail_shipping_name").val() == '' && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Please enter Name');

                $("#order_detail_shipping_name").focus();
            } else if($("#order_detail_shipping_last_name").val() == '' && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Please enter Last Name');

                $("#order_detail_shipping_last_name").focus();
            } else if($("#order_detail_shipping_phone").val() == '' && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Please enter Phone');

                $("#order_detail_shipping_phone").focus();
            } else if($("#order_detail_shipping_email").val() == '' && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Please enter Email');

                $("#order_detail_shipping_email").focus();
            } else if(!isEmail($("#order_detail_shipping_email").val()) && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Invalid Email');

                $("#order_detail_shipping_email").focus();

                $("#order_detail_shipping_email").val('');
            } else if($("#order_detail_shipping_address").val() == '' && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Please enter Address');

                $("#order_detail_shipping_address").focus();
            }/* else if($("#order_detail_shipping_sub_district").val() == '' && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Please enter Sub-district/ Sub-area');

                $("#order_detail_shipping_sub_district").focus();
            }*/ else if($("#shipping_township").val() == '' && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Please enter Township');

                $("#shipping_township").focus();
            } else if($("#shipping_location").val() == '' && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Please enter Location');

                $("#shipping_location").focus();
            }/* else if($("#order_detail_shipping_postal_code").val() == '' && $("#order_detail_shipping_type_new_address").is(":checked") == true) {
                alert('Please enter Postal Code');

                $("#order_detail_shipping_postal_code").focus();
            }*/ else if($("#order_detail_shipping_type_original").is(":checked") == false && $("#order_detail_shipping_type_new_address").is(":checked") == false) {
                alert('Please select Original Shipping Address Or New Address');

                $("#order_detail_shipping_type_new_address").focus();
            } else {
                if($("#order_detail_shipping_type_original").is(":checked") == true) {
                    // เอาที่พิมพ์เข้าไป
                    var order_detail_shipping_type = 'true';
                } else if($("#order_detail_shipping_type_new_address").is(":checked") == true) {
                    var order_detail_shipping_type = 'false';
                }

                $.post('<?php echo site_url("frontend/path/ajaxShippingAddress");?>', { order_detail_shipping_type: order_detail_shipping_type, order_detail_shipping_name: $("#order_detail_shipping_name").val(), order_detail_shipping_last_name: $("#order_detail_shipping_last_name").val(), order_detail_shipping_phone: $("#order_detail_shipping_phone").val(), order_detail_shipping_email: $("#order_detail_shipping_email").val(), order_detail_shipping_address: $("#order_detail_shipping_address").val(), order_detail_shipping_sub_district: $("#order_detail_shipping_sub_district").val(), shipping_township: $("#shipping_township").val(), shipping_location: $("#shipping_location").val(), order_detail_shipping_postal_code: $("#order_detail_shipping_postal_code").val() }, function(data) {
                    window.location.href = '<?php echo site_url('frontend/path/payment');?>';
                });
            }
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        function changeShippingLocation(shipping_location) {
            $.post('<?php echo site_url("frontend/path/ajaxChangeShippingLocation");?>', { shipping_location: shipping_location }, function(data) {
                $("#shipping_township").html(data);
            });
        }
        
    </script>
</body>

</html>