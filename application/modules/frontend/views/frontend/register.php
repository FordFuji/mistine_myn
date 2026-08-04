<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>

<body>
    <?php require('inc_menu.php'); ?>
    <div class="container-fluid">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="login">
                        <h2 style="text-align: center;">Register</h2>
                        <div class="registered">
                            <div class="row">
                                <div class="col-12 col-md-6 pad_so_r">
                                    <input type="text" class="form-login" name="member_first_name" id="member_first_name" placeholder="First name">
                                </div>
                                <div class="col-12 col-md-6 pad_so_l">
                                    <input type="text" class="form-login" name="member_last_name" id="member_last_name" placeholder="Last names">
                                </div>
                                <div class="col-12 col-md-6 pad_so_r">
                                    <input type="text" class="form-login" name="member_phone" id="member_phone" placeholder="Phone">
                                </div>
                                <div class="col-12 col-md-6 pad_so_l">
                                    <input type="text" class="form-login" name="member_email" id="member_email" placeholder="Email" onblur="checkEmailUnique(this.value);">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-login" name="member_address" id="member_address" rows="3" placeholder="Address"></textarea>
                                </div>
                                <div class="col-12 col-md-6 pad_so_r">
                                    <input type="password" name="member_password" id="member_password" class="form-login" placeholder="Password">
                                </div>
                                <div class="col-12 col-md-6 pad_so_l">
                                    <input type="password" name="member_confirm_password" id="member_confirm_password" class="form-login" placeholder="Confirm password">
                                </div>
                            </div>
                            <div class="register_a"><input type="checkbox" id="privacy" value="Yes"> I Agree <a href="<?php echo site_frontend('privacy_and_confidentaility.php');?>" style="background-color: #fff; border: 0; color: #ec008c;" target="_blank">Privacy & Confidentiallity</a>
                            </div>
                            <div class="register_a"><!-- <a href="javascript:insertMember();" class="isDisabled">Register</a> --><button type="button" class="button_register" id="button_register" onclick="insertMember();" style="width:100px;">Register</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php require('inc_footer.php'); ?>
    </div>

    <script>
        function insertMember() {
            if($("#member_first_name").val() == '') {
                alert("Please enter First Name");

                $("#member_first_name").focus();
            } else if($("#member_last_name").val() == '') {
                alert("Please enter Last Name");

                $("#member_last_name").focus();
            } else if($("#member_phone").val() == '') {
                alert("Please enter Phone");

                $("#member_phone").focus();
            } else if($("#member_email").val() == '') {
                alert("Please enter Email");

                $("#member_email").focus();
            } else if(!isEmail($("#member_email").val())) {
                alert("Invalid Email");

                $("#member_email").focus();

                $("#member_email").val('');
            } else if($("#member_address").val() == '') {
                alert("Please enter Address");

                $("#member_address").focus();
            } else if($("#member_password").val() == '') {
                alert("Please enter Password");

                $("#member_password").focus();
            } else if($("#member_confirm_password").val() == '') {
                alert("Please enter Confirm Password");

                $("#member_confirm_password").focus();
            } else if($("#member_confirm_password").val() == '') {
                alert("Please enter Confirm Password");

                $("#member_confirm_password").focus();
            } else if($("#member_password").val() != $("#member_confirm_password").val()) {
                alert("Password must be same Confirm Password");

                $("#member_password").focus();
                $("#member_password").val('');
                $("#member_confirm_password").val('');
            } else if($("#privacy").is(":checked") == false) {
                alert("Please Check I Agree");

                $("#privacy").focus();
            } else {
                $.post('<?php echo site_url("frontend/path/ajaxInsertMember");?>', { member_first_name: $("#member_first_name").val(), member_last_name: $("#member_last_name").val(), member_phone: $("#member_phone").val(), member_email: $("#member_email").val(), member_address: $("#member_address").val(), member_password: $("#member_password").val() }, function(data) {

                    window.location.href = '<?php echo site_url();?>';
                });
            }
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        function checkEmailUnique(member_email) {
            $.post('<?php echo site_url('frontend/path/ajaxCheckEmailUnique');?>', { member_email: member_email }, function(data) {
                if(data == 'true') {
                    alert('Email Already');

                    $("#member_email").val('');
                }
            });
        }
    </script>
</body>

</html>