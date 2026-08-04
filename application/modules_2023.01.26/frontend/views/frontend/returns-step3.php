<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>

</head>
<style>
    .return_step{
        text-align: center;
    }
    .return_step p{
        font-size: 14px;
    }
    .return_step h5 {
        padding: 10px 0;
    }
    .btnsumma_sp{
        text-align: center;
        padding: 50px 0 0;
    }
    .getemail input {
        width: 97%;
        height: 55px;
        padding: 10px 0 10px 15px;
        background-color: white;
        border: 1px solid #eeeeee;
    }
    .getemail {
        overflow: hidden;
        height: 55px;
        width: 100%;
        position: relative;
        margin-top: 10px;
        font-size: 13px;
        margin-left: 0px;
    }
    .getemail button {
        letter-spacing: 2px;
        position: absolute;
        z-index: 999;
        right: 10px;
        top: 0px;
        height: 55px;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        border: none;
        background-color: #ec008c;
        -moz-transition: background-color 0.3s ease, width 0.3s ease;
        -o-transition: background-color 0.3s ease, width 0.3s ease;
        -webkit-transition: background-color 0.3s ease, width 0.3s ease;
        transition: background-color 0.3s ease, width 0.3s ease;
        color: #fff;
        padding: 0;
        margin: 0;
        font-weight: bold;
        text-transform: uppercase;
        width: 120px;
        font-size: 11px;
        text-align: center;
        cursor: pointer;
        @inlude transform(translateZ(0)): ;
    }
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
                                <h5>My Returns</h5>
                            </div>
                            <div class="return_step">
                                <img src="<?php echo base_frontend('images/step-return3.png');?>" class="img-fluid">
                                <h5>YOU HAVE SUCCESSFULLY SUBMITTED THE RETURN FORM</h5>
                                <p>Please print the forms based on your prefered Return Method. We sent them right to you email's inbox too, so you can easily access them.</p>
                                <h6>Didn't get it? We'll send it again :</h6>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-12 col-md-8">
                                        <div class="getemail">
                                        <input type="email" id="email_send_return" placeholder="Enter your email Address">
                                            <button onclick="sendMailReturn();">Send</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(6) ').addClass('active');
        </script>
        <script>
            $('.sidemenumem li:nth-child(6) ').addClass('active');

            function sendMailReturn() {
                $.post('<?php echo site_url("frontend/path/ajaxSendMailReturn");?>', { email_send_return: $("#email_send_return").val() },function(data) {
                    alert('Send Mail Success');
                });
            }
        </script>
    </div>

</body>

</html>