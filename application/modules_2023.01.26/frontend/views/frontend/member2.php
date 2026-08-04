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
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return checkForm();">
                    <div class="row pad_account">
                        <div class="col-12 col-md-12 col-lg-3">
                            <?php require('inc_account.php'); ?>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9 bg_payment">
                            <div class="text-myaccount pad_myaccount">
                                <h5>Personal Information</h5>
                            </div>
                            <div class="img_member"><input type="file" id="member_image" name="member_image" accept="image/*">
<?php
if(!empty($memberCtrl) and $memberCtrl->member_image != '') {
?>
                                <img src="<?php echo base_url('uploads/member/'.$memberCtrl->member_image);?>" class="img-fluid">
<?php
} else {
?>
                                <img src="<?php echo base_frontend('images/img_member.jpg');?>" class="imag-fluid">
<?php
}
?>
                            </div>
                            <div class="row text_confirmed">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" name="member_first_name" id="member_first_name" class="form-login" placeholder="First name" value="<?php echo $memberCtrl->member_first_name;?>">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" name="member_last_name" id="member_last_name" class="form-login" placeholder="Last name" value="<?php echo $memberCtrl->member_last_name;?>">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" name="member_phone" id="member_phone" class="form-login" placeholder="Phone" value="<?php echo $memberCtrl->member_phone;?>">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" name="member_email" id="member_email" class="form-login" placeholder="Email" value="<?php echo $memberCtrl->member_email;?>" onblur="checkEmail(this.value);">
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <textarea name="member_address" id="member_address" class="form-login" rows="3"><?php echo $memberCtrl->member_address;?></textarea>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="button_save_member" value="Save">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(2) ').addClass('active');
        </script>
    </div>
    <script>
        function checkForm() {
            if($("#member_image").val() == '') {
                alert('Please Upload Image');

                $("#member_image").focus();

                return false;
            } else if($("#member_first_name").val() == '') {
                alert('Please enter First Name');

                $("#member_image").focus();

                return false;
            } else if($("#member_last_name").val() == '') {
                alert('Please enter Last Name');

                $("#member_last_name").focus();

                return false;
            } else if($("#member_phone").val() == '') {
                alert('Please enter Phone');

                $("#member_phone").focus();

                return false;
            } else if($("#member_email").val() == '') {
                alert('Please enter Email');

                $("#member_email").focus();

                return false;
            } else if($("#member_address").val() == '') {
                alert('Please enter Address');

                $("#member_address").focus();

                return false;
            } else {
                return true;
            }
        }

        function checkEmail(member_email) {
            $.post('<?php echo site_url("frontend/path/ajaxCheckEmail");?>', { member_email: member_email }, function(data) {
                if(data == true) {
                    alert('Email Already');

                    $("#member_email").val('');
                }
            });
        }
    </script>
</body>

</html>