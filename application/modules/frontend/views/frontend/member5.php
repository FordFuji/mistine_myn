<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
    
</head>
<style>
    @media (max-width: 991px) {
        .img_member {
            display: none;
        }
    }
</style>
<body>
    <?php require('inc_menu.php'); ?>
        
    <div class="container-fluid">
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
                                <h5>Change Password</h5>
                            </div>
                            <div class="row text_confirmed">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" value="<?php if(!empty($memberCtrl)) echo $memberCtrl->member_email;?>" class="form-login" placeholder="E-mail" readonly>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="password" name="member_old_password" id="member_old_password" class="form-login" placeholder="Password">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="password" name="member_password" id="member_password" class="form-login" placeholder="New Password">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="password" name="member_confirm_password" id="member_confirm_password" class="form-login" placeholder="Confirm Password">
                                </div>
                            </div>
                            <button type="button" class="button_save_member" onclick="checkChangePassword();">Save</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(5) ').addClass('active');

            function checkChangePassword() {
                if($("#member_old_password").val() == '') {
                    alert('Please enter Password');

                    $("#member_old_password").focus();
                } else if($("#member_old_password").val() == '') {
                    alert('Please enter Password');

                    $("#member_old_password").focus();
                } else if($("#member_password").val() == '') {
                    alert('Please enter New Password');

                    $("#member_password").focus();
                } else if($("#member_confirm_password").val() == '') {
                    alert('Please enter Confirm Password');

                    $("#member_confirm_password").focus();
                } else if($("#member_password").val() != $("#member_confirm_password").val()) {
                    alert('Incorrect Confirm Password');

                    $("#member_password").focus();
                    $("#member_password").val('');
                    $("#member_confirm_password").val('');
                } else {
                    $.post('<?php echo site_url("frontend/path/ajaxCheckChangePassword");?>', { member_old_password: $("#member_old_password").val(), member_password: $("#member_password").val() }, function(data) {
                        alert(data);

                        $("#member_old_password").val('');
                        $("#member_password").val('');
                        $("#member_confirm_password").val('');
                    });
                }
            }
        </script>
    </div>

</body>

</html>