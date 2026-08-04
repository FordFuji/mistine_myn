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

    .md-radio input[type="radio"]:checked+label:after {
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

    .md-radio label:before,
    .md-radio label:after {
        position: absolute;
        content: '';
        border-radius: 50%;
        transition: all .3s ease;
        transition-property: transform, border-color;
    }

    .md-radio input[type="radio"]:checked+label:before {
        border-color: #000;
        animation: ripple 0.2s linear forwards;
        background-color: #fff;
    }

    .md-radio label {
        display: inline-block;
        height: 20px;
        position: relative;
        padding: 0 0 0 30px;
        margin-bottom: 0;
        cursor: pointer;
        vertical-align: bottom;
        font-size: 16px;
    }

    .md-radio.md-radio-inline {
        display: flex;
    }

    .wrap_radioinsure {
        display: none;
        margin-top: 0;
    }

    .return_step h5 {
        text-align: center;
        padding: 10px 0;
    }

    
    .bgreturn .right {
        text-align: right;
    }

    .fontsize {
        font-size: 13px;
        margin-bottom: 5px;
    }
    .button_sub:hover{
        text-decoration: none;
        color: #fff;
    }
    .button_sub{
        color: #fff;
        background-color: #555555;
        border: 1px solid #555555;
        display: inline-block;
        line-height: 32px;
        transition: 0.5s;
        font-size: 14px;
        text-align: center;
        width: 40%;
        border-radius: 35px;
    }
    .button_btp{
        color: #fff;
        border: 1px solid #ec008c;
        background-color: #ec008c;
        display: inline-block;
        line-height: 32px;
        transition: 0.5s;
        font-size: 14px;
        text-align: center;
        width: 40%;
        border-radius: 35px;
    }
    .button_btp:hover{
        text-decoration: none;
        color: #fff;
    }
    .btnsumma{
        text-align: right;
        padding-bottom: 20px;
    }
    
    .pad_return{
        margin-bottom: 75px;
    }
    
    .btnsumma_sp{
        text-align: center;
        padding: 50px 0 0;
    }
    .return_step{
        text-align: center;
        
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
                                <img src="<?php echo base_frontend('images/step-return2.png');?>" class="img-fluid">
                                <h5>SELECT REFUND METHOD</h5>
                            </div>
                            <div class="md-radio md-radio-inline radiocheck">
                                <input id="return_credit_card" type="radio" name="g4" rel="complete_a">
                                <label for="return_credit_card">
                                    <h6>Credit Card</h6>
                                </label>
                            </div>
                            <div class="wrap_radioinsure complete_a">
                                <p>Store credit will be processed within 2-3 days after</p>
                            </div>
                            <div class="md-radio md-radio-inline radiocheck">
                                <input id="return_bank_transfer" type="radio" name="g4" rel="complete_b">
                                <label for="return_bank_transfer">
                                    <h6>Refund for Bank Transer</h6>
                                </label>
                            </div>
                            <div class="wrap_radioinsure complete_b">
                                <p>Funds will be directly refunded to the bank account you specified below.</p>
                            </div>
                            <div class="md-radio md-radio-inline radiocheck">
                                <input id="return_cod" type="radio" name="g4" rel="complete_c">
                                <label for="return_cod">
                                    <h6>Refund for COD</h6>
                                </label>
                            </div>
                            <div class="wrap_radioinsure complete_c">
                                <p>Funds will be directly refunded to the bank account you specified below.</p>
                            </div>
                            <div class="btnsumma_sp"> 
                                   <a href="<?php echo site_frontend('returns-step1.php');?>" class="button_btp">Back to page</a> 
                                   <a href="javascript:checkReturnStep3();" class="button_sub">Submit</a> 
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

            function checkReturnStep3() {
                if($("#return_credit_card").is(":checked") == false && $("#return_bank_transfer").is(":checked") == false && $("#return_cod").is(":checked") == false) {
                    alert('Please Select Refund Method');
                } else {
                    if($("#return_credit_card").is(":checked") == true) {
                        return_refund_method = 'Credit Card';
                    } else if($("#return_bank_transfer").is(":checked") == true) {
                        return_refund_method = 'Refund for Bank Transer';
                    } else if($("#return_cod").is(":checked") == true) {
                        return_refund_method = 'Refund for COD';
                    }

                    //alert(return_refund_method);

                    $.post('<?php echo site_url("frontend/path/ajaxRefund");?>', { return_refund_method: return_refund_method }, function(data) {
                        window.location.href = '<?php echo site_url("frontend/path/returns_step3");?>';
                    });
                }
            }
        </script>
    </div>

</body>

</html>