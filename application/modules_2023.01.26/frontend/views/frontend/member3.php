<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php');?>
</head>

<style>
    .form-check-input{
        margin-top: 6px;
    }
    .form-check{
        padding: 15px 20px 0;
    }
    @media (max-width: 991px) {
        .img_member {
            display: none;
        }
    }
</style>

<body>
    <?php require('inc_menu.php'); ?>
        
    <div class="container-fluid ba_gary">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="boxtext_help">
                        <h2>My Account</h2>
                    </div>
                    <div class="row pad_account">
                        <div class="col-12 col-md-12 col-lg-3">
                            <?php require('inc_account.php'); ?>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9 bg_payment">
                            <div class="text-myaccount pad_myaccount">
                                <h5>Delivery Information</h5>
                            </div>
                            <form action="" method="post" onsubmit="return checkFormAddessShipping1();">
                            <span id="clone_new_address"> 
<?php
$address = 1;
if(!empty($shipping)) {
    foreach($shipping as $s) {      
?>
                            <!-- เริ่ม New Address ตรงนี้ -->
                            <br>
                            <div class="row text_confirmed address_<?php echo $address;?>">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <input type="radio" id="member_shipping_active" name="member_shipping_active" value="<?php echo $address;?>" <?php if($s->member_shipping_active == 'Yes') echo 'checked';?>> Active
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" id="member_shipping_address_address_<?php echo $address;?>" name="member_shipping_address_address[]" class="form-login" placeholder="Address" value="<?php echo $s->member_shipping_address_address;?>">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-login" name="member_shipping_address_sub_district[]" id="member_shipping_address_sub_district_<?php echo $address;?>" value="<?php echo $s->member_shipping_address_sub_district;?>" placeholder="Sub-district/ Sub-area">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <select class="form-login" name="shipping_location[]" id="shipping_location_<?php echo $address;?>" onchange="changeShippingLocation(this.value, '<?php echo $address;?>');">
                                        <option value="">Region/State</option>
<?php
        if(!empty($location)) {
            foreach($location as $r) {
?>
                                        <option value="<?php echo $r->rate_shipping_location;?>" <?php if($r->rate_shipping_location == $s->shipping_location) echo 'selected';?>><?php echo $r->rate_shipping_location;?></option>
<?php
            }
        }
?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <select class="form-login" name="shipping_township[]" id="shipping_township_<?php echo $address;?>">
                                        <option value="">Township</option>
<?php
        $township = $this->model_frontend->getShippingTownship($s->shipping_location);
        if(!empty($township)) {
            foreach($township as $r) {
?>
                                        <option value="<?php echo $r->rate_shipping_township;?>" <?php if($r->rate_shipping_township == $s->shipping_township) echo 'selected';?>><?php echo $r->rate_shipping_township;?></option>
<?php
            }
        }
?>
                                    </select>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6">
                                    <input type="text" class="form-login" name="member_shipping_address_postal_code[]" id="member_shipping_address_postal_code_<?php echo $address;?>" value="<?php echo $s->member_shipping_address_postal_code;?>" placeholder="Postal Code">
                                </div>
                                <div class="col-6 col-md-6 col-lg-6">
                                    <input type="button" onclick="deleteAddress('<?php echo $address;?>');" value="Delete">
                                </div>
                            </div>
<?php
        $address++;
    }
} else {
?>
                            <div class="row text_confirmed address_<?php echo $address;?>">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <input type="radio" id="member_shipping_active" name="member_shipping_active" value="<?php echo $address;?>"> Active
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" id="member_shipping_address_address_<?php echo $address;?>" name="member_shipping_address_address[]" class="form-login" placeholder="Address">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-login" name="member_shipping_address_sub_district[]" id="member_shipping_address_sub_district_<?php echo $address;?>" placeholder="Sub-district/ Sub-area">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <select class="form-login" name="shipping_location[]" id="shipping_location_<?php echo $address;?>" onchange="changeShippingLocation(this.value, '<?php echo $address;?>');">
                                        <option value="">Region/State</option>
<?php
        if(!empty($location)) {
            foreach($location as $r) {
?>
                                        <option value="<?php echo $r->rate_shipping_location;?>"><?php echo $r->rate_shipping_location;?></option>
<?php
            }
        }
?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <select class="form-login" name="shipping_township[]" id="shipping_township_<?php echo $address;?>">
                                        <option value="">Township</option>
<?php
        $township = $this->model_frontend->getShippingTownship($s->shipping_location);
        if(!empty($township)) {
            foreach($township as $r) {
?>
                                        <option value="<?php echo $r->rate_shipping_township;?>"><?php echo $r->rate_shipping_township;?></option>
<?php
            }
        }
?>
                                    </select>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6">
                                    <input type="text" class="form-login" name="member_shipping_address_postal_code[]" id="member_shipping_address_postal_code_<?php echo $address;?>" placeholder="Postal Code">
                                </div>
                                <div class="col-6 col-md-6 col-lg-6">
                                    <input type="button" onclick="deleteAddress('<?php echo $address;?>');" value="Delete">
                                </div>
                            </div>
<?php
}
?>
                            <!-- End เรื่ม New Address ตรงนี้ -->
                            </span>
                            <button type="submit" name="submit_shipping" class="button_save_member" value="Shipping">Save</button>
                            </form>
                            <a href="javascript:newAddress();">+ New Address</a><br>
                            <div class="text-myaccount pad_myaccount">
                                <h5>Tax invoice</h5>
                            </div>
                            <form action="" method="post" onsubmit="return checkBillingAddress();">
                            <div class="row text_confirmed">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-login" name="member_billing_name_surname" id="member_billing_name_surname" value="<?php if(!empty($billing)) echo $billing->member_billing_name_surname;?>" placeholder="Name">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" name="member_billing_tax_number" id="member_billing_tax_number" value="<?php if(!empty($billing)) echo $billing->member_billing_tax_number;?>" class="form-login" placeholder="Tax number">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" name="member_billing_branch_office" id="member_billing_branch_office" value="<?php if(!empty($billing)) echo $billing->member_billing_branch_office;?>" class="form-login" placeholder="Branch office">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" name="member_billing_phone" id="member_billing_phone" value="<?php if(!empty($billing)) echo $billing->member_billing_phone;?>" class="form-login" placeholder="Phone">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-login" rows="4" placeholder="Address" name="member_billing_address" id="member_billing_address"><?php if(!empty($billing)) echo $billing->member_billing_address;?></textarea>
                                </div>
                            </div>
                            <button type="submit" name="submit_billing" class="button_save_member" value="Billing">Save</button>
                            </form>   
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(3) ').addClass('active');
        </script>
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
    </script>
    </div>
<?php
if(empty($address)) {
    --$address;
}
?>
    <script>
        var address = '<?php echo $address;?>';
        
        function checkFormAddessShipping1() {
            if($("#member_shipping_address_address").val() == '') {
                alert('Please enter Address');

                $("#member_shipping_address_address").focus();

                return false;
            } else if($("#member_shipping_address_sub_district").val() == '') {
                alert('Please enter Sub District');

                $("#member_shipping_address_sub_district").focus();

                return false;
            } else if($("#member_shipping_address_district").val() == '') {
                alert('Please enter District');

                $("#member_shipping_address_district").focus();

                return false;
            } else if($("#member_shipping_address_province").val() == '') {
                alert('Please Select Province');

                $("#member_shipping_address_province").focus();

                return false;
            } else if($("#member_shipping_address_postal_code").val() == '') {
                alert('Please enter Postal Code');

                $("#member_shipping_address_postal_code").focus();

                return false;
            } else {
                return true;
            }
        }

        function checkFormAddessShipping2() {
            if($("#member_shipping_address2_address").val() == '') {
                alert('Please enter Address');

                $("#member_shipping_address2_address").focus();

                return false;
            } else if($("#member_shipping_address2_sub_district").val() == '') {
                alert('Please enter Sub District');

                $("#member_shipping_address2_sub_district").focus();

                return false;
            } else if($("#member_shipping_address2_district").val() == '') {
                alert('Please enter District');

                $("#member_shipping_address2_district").focus();

                return false;
            } else if($("#member_shipping_address2_province").val() == '') {
                alert('Please Select Province');

                $("#member_shipping_address2_province").focus();

                return false;
            } else if($("#member_shipping_address2_postal_code").val() == '') {
                alert('Please enter Postal Code');

                $("#member_shipping_address2_postal_code").focus();

                return false;
            } else {
                return true;
            }   
        }

        function checkBillingAddress() {
            if($("#member_billing_name_surname").val() == '') {
                alert('Please enter Name');

                $("#member_billing_name_surname").focus();

                return false;
            } else if($("#member_billing_tax_number").val() == '') {
                alert('Please enter Tax Number');

                $("#member_billing_tax_number").focus();

                return false;
            } else if($("#member_billing_branch_office").val() == '') {
                alert('Please enter Branch Office');

                $("#member_billing_branch_office").focus();

                return false;
            } else if($("#member_billing_phone").val() == '') {
                alert('Please enter Phone');

                $("#member_billing_phone").focus();

                return false;
            } else if($("#member_billing_address").val() == '') {
                alert('Please enter Address');

                $("#member_billing_address").focus();

                return false;
            } else {
                return true;
            }
        }

        function changeShippingLocation(shipping_location, address) {
            $.post('<?php echo site_url("frontend/path/ajaxChangeShippingLocation");?>', { shipping_location: shipping_location, address: address }, function(data) {
                //alert(data);
                $("#shipping_township_" + address).html(data);
            });
        }

        function newAddress() {
            address++;

            $('<div class="row text_confirmed address_' + address + '"><div class="col-12 col-md-12 col-lg-12"><input type="radio" id="member_shipping_active" name="member_shipping_active" value="<?php echo $address;?>"> Active</div><div class="col-12 col-md-6 col-lg-6"><input type="text" id="member_shipping_address_address_' + address + '" name="member_shipping_address_address[]" class="form-login" placeholder="Address"></div><div class="col-12 col-md-6 col-lg-6"><input type="text" class="form-login" name="member_shipping_address_sub_district[]" id="member_shipping_address_sub_district_' + address + '" placeholder="Sub-district/ Sub-area"></div><div class="col-12 col-md-6 col-lg-6"><select class="form-login" name="shipping_location[]" id="shipping_location_' + address + '" onchange="changeShippingLocation(this.value, address);"><option value="">Region/State</option><?php if(!empty($location)) { foreach($location as $r) { ?><option value="<?php echo $r->rate_shipping_location;?>"><?php echo $r->rate_shipping_location;?></option><?php } } ?></select></div><div class="col-12 col-md-6 col-lg-6"><select class="form-login" name="shipping_township[]" id="shipping_township_' + address + '"><option value="">Township</option><?php if(!empty($township)) { foreach($township as $r) { ?><option value="<?php echo $r->rate_shipping_township;?>"><?php echo $r->rate_shipping_township;?></option><?php } } ?></select></div><div class="col-6 col-md-6 col-lg-6"><input type="text" class="form-login" name="member_shipping_address_postal_code[]" id="member_shipping_address_postal_code_' + address + '" placeholder="Postal Code"></div><div class="col-6 col-md-6 col-lg-6"><input type="button" onclick="deleteAddress(address);" value="Delete"></div></div>').clone().appendTo("#clone_new_address");
        }

        function deleteAddress(member_shipping_address_id) {
            $(".address_" + member_shipping_address_id).remove();
        }
    </script>
</body>

</html>