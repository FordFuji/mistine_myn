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
                                <h5>Cancel</h5>
                            </div>
                            <h6 style="padding-bottom: 20px;">* Please select a reason for cancellation.</h6>
                            <div class="md-radio md-radio-inline">
                                <input id="reason1" type="radio" name="g4">
                                <label for="reason1">
                                    <h6><?php if(!empty($reasonCtrl) and $reasonCtrl->reason_cancel_reason1 != '') echo $reasonCtrl->reason_cancel_reason1;?></h6>
                                </label>
                            </div>
                            
                            <div class="md-radio md-radio-inline">
                                <input id="reason2" type="radio" name="g4">
                                <label for="reason2">
                                    <h6><?php if(!empty($reasonCtrl) and $reasonCtrl->reason_cancel_reason2 != '') echo $reasonCtrl->reason_cancel_reason2;?></h6>
                                </label>
                            </div>
                            
                            <div class="md-radio md-radio-inline">
                                <input id="reason3" type="radio" name="g4" >
                                <label for="reason3">
                                    <h6><?php if(!empty($reasonCtrl) and $reasonCtrl->reason_cancel_reason3 != '') echo $reasonCtrl->reason_cancel_reason3;?></h6>
                                </label>
                            </div>
                            
                            <div class="btnsumma_sp"> 
                                   <a href="<?php echo site_frontend('member8.php');?>" class="button_btp">Back to page</a> 
                                   <a href="javascript:checkReason();" class="button_sub">Submit</a> 
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(7) ').addClass('active');
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

            function checkReason() {
                if($("#reason1").is(":checked") == false && $("#reason2").is(":checked") == false && $("#reason3").is(":checked") == false) {
                    alert('Please Select Reason');
                } else {
                    result = confirm('Confirm Cancel');

                    if(result == true) {
                        if($("#reason1").is(":checked") == true) {
                            reason = 'reason1';
                        } else if($("#reason2").is(":checked") == true) {
                            reason = 'reason2';
                        } else if($("#reason3").is(":checked") == true) {
                            reason = 'reason3';
                        }

                        $.post("<?php echo site_url('frontend/path/ajaxCancelReason');?>", { order_detail_id: '<?php echo $order_detail_id;?>', reason: reason }, function(data) {
                            window.location.href = '<?php echo site_url("frontend/path/cancel_step3");?>';
                        });
                    }
                }
            }
        </script>
    </div>

</body>

</html>