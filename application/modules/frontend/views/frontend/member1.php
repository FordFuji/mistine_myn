<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>

<style>
    
</style>
<body>
    <?php require('inc_menu.php'); ?>
        
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 pad_account_1">
                    <div class="boxtext_help">
                        <h2>My Account</h2>
                    </div>
                    <div class="row pad_account">
                        <div class="col-12 col-md-12 col-lg-3">
                            <?php require('inc_account.php'); ?>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9 bg_payment">
                            <div class="text-myaccount">
                                <h5>My Account</h5>
                            </div>
                            <div class="id-number">
                                <p>Member Code : <?php echo $this->session->userdata('member_id');?></p>
                            </div>
                            <div class="row padding-user-1">
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="personal-text-1">Name : </div>
                                    <div class="personal-text-1">Last Names : </div>
                                    <div class="personal-text-1">Phone : </div>
                                    <div class="personal-text-1">E-mail :</div>
                                    <hr>
                                </div>
                                <div class="col-6 col-md-6 col-lg-7">
                                    <div class="personal-text"><?php if(!empty($memberCtrl) and $memberCtrl->member_first_name != '') echo $memberCtrl->member_first_name; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if(!empty($memberCtrl) and $memberCtrl->member_last_name != '') echo $memberCtrl->member_last_name; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if(!empty($memberCtrl) and $memberCtrl->member_phone != '') echo $memberCtrl->member_phone; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if(!empty($memberCtrl) and $memberCtrl->member_email != '') echo $memberCtrl->member_email; else echo '&nbsp;';?></div>
                                    <hr>
                                </div>
                                <div class="col-12 col-md-2 col-lg-2">
                                    <div class="modify">
                                        <a href="<?php echo site_frontend('member2.php');?>">Edit</a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-myaccount-1">
                                <h5>Delivery Information</h5>
                            </div>

                            <div class="row padding-user">
                                <div class="col-10 col-md-10 col-lg-10">

                                </div>
                                <div class="col-2 col-md-2 col-lg-2">
                                    <div class="modify">
                                        <a href="<?php echo site_frontend('member3.php');?>">Edit</a>
                                    </div>
                                </div>
<?php
if(!empty($shipping)) {
    foreach($shipping as $s) {
?>
                            
                                <div class="col-6 col-md-5 col-lg-4">
                                    <div class="personal-text-1">Address : </div>
                                    <div class="personal-text-1">District : </div>
                                    <div class="personal-text-1">Township : </div>
                                    <div class="personal-text-1">Region/State : </div>
                                    <div class="personal-text-1">Postal Code : </div>
                                    <hr>
                                </div>
                                <div class="col-6 col-md-7 col-lg-8">
                                    <div class="personal-text"><?php if($s->member_shipping_address_address != '') echo $s->member_shipping_address_address; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if($s->member_shipping_address_sub_district != '') echo $s->member_shipping_address_sub_district; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if($s->shipping_township != '') echo $s->shipping_township; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if($s->shipping_location != '') echo $s->shipping_location; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if($s->member_shipping_address_postal_code != '') echo $s->member_shipping_address_postal_code; else echo '&nbsp;';?></div>
                                    <hr>
                                </div>
<?php
    }
}
?>
                            </div>
                            
                            <div class="text-myaccount-1">
                                <h5>Tax invoice</h5>
                            </div>
                            <div class="row padding-user">
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="personal-text-1">Name : </div>
                                    <div class="personal-text-1">Tax number : </div>
                                    <div class="personal-text-1">Branch office : </div>
                                    <div class="personal-text-1">Phone : </div>
                                    <div class="personal-text-1">Address : </div>
                                    <hr>
                                </div>
                                <div class="col-6 col-md-6 col-lg-7">
                                    <div class="personal-text"><?php if(!empty($billingCtrl) and $billingCtrl->member_billing_name_surname != '') echo $billingCtrl->member_billing_name_surname; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if(!empty($billingCtrl) and $billingCtrl->member_billing_tax_number != '') echo $billingCtrl->member_billing_tax_number; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if(!empty($billingCtrl) and $billingCtrl->member_billing_branch_office != '') echo $billingCtrl->member_billing_branch_office; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if(!empty($billingCtrl) and $billingCtrl->member_billing_phone != '') echo $billingCtrl->member_billing_phone; else echo '&nbsp;';?></div>
                                    <div class="personal-text"><?php if(!empty($billingCtrl) and $billingCtrl->member_billing_address != '') echo $billingCtrl->member_billing_address; else echo '&nbsp;';?></div>
                                    <hr>
                                </div>
                                <div class="col-2 col-md-2 col-lg-2">
                                    <div class="modify">
                                        <a href="<?php echo site_frontend('member3.php');?>">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(1) ').addClass('active');
        </script>

    </div>

</body>

</html>