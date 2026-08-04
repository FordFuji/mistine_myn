<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
    <!-- Include Bootstrap Datepicker -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

</head>

<style>
    
</style>

<body>
    <?php require('inc_menu.php'); ?>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="boxtext_help">
                        <h2>Help</h2>
                    </div>
                    <div class="row pad_account">
                        <div class="col-12 col-md-12 col-lg-3">
                            <?php require('inc_help.php'); ?>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9 bg_payment">
                            <div class="text-myaccount">
                                <h5>Payment</h5>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data" onsubmit="return checkFormPayment();">
                            <div class="row text_confirmed">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" name="order_no" id="order_no" class="form-login" placeholder="Order number">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="dropdown open show">
                                        <!-- <a class="dropdown-toggle btn-select-menu form-login" data-toggle="dropdown" href="#" aria-expanded="true">Payment Methods <b class="caret-menu"><i class="fa fa-angle-down" aria-hidden="true"></i></b>
                                            </a>
                                        <ul class="dropdown-menu dropdown-menu-form-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <li><a href="">Credit / Debit Card</a></li>
                                            <li><a href="">Pay Via ATM</a></li>
                                            <li><a href="">Transfer money / payment via bank channel</a></li>
                                            <li><a href="">Destination Payment</a></li>
                                        </ul> -->
                                        <select name="payment_method" id="payment_method" class="form-login">
                                            <option value="Credit / Debit Card">Credit / Debit Card</option>
                                            <option value="Pay Via ATM">Pay Via ATM</option>
                                            <option value="Transfer money / payment via bank channel">Transfer money / payment via bank channel</option>
                                            <option value="Destination Payment">Destination Payment</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="input-group input-append date" id="datePicker">
                                        <span class="input-group-addon add-on" style="border: none;"><span><i class="fa fa-calendar" aria-hidden="true"></i></span></span>
                                        <input type="text" name="payment_date" id="payment_date" class="from-c" placeholder="Date">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-login" placeholder="Time" name="payment_time" id="payment_time">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="number" class="form-login" placeholder="Money" name="payment_money" id="payment_money" step="0.01">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 pad_date">
                                    <input class="form-control-file is-invalid" type="file" name="payment_slip" id="payment_slip" data-fv-field="payment_slip">
                                </div>
                            </div>
                            <div class="text-myaccount">
                                <h5>Customer Details</h5>
                            </div>
                            <div class="row text_confirmed">
                                <div class="col-12">
                                    <input type="text" class="form-login" placeholder="Name" name="payment_name" id="payment_name">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-login" placeholder="Email" name="payment_email" id="payment_email">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" class="form-login" placeholder="Telephone" name="payment_telephone" id="payment_telephone">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-login" id="exampleTextarea" rows="5" placeholder="More Details" name="payment_more_detail" id="payment_more_detail"></textarea>
                                </div>
                            </div>
                            
                            <button type="submit" name="submit_payment" class="button_save" value="Save">Save</button>
                                
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(1) ').addClass('active');
        </script>
        <script>
            $(document).ready(function() {
                $('#datePicker')
                    .datepicker({
                        format: 'yyyy-mm-dd'
                    })
                    .on('changeDate', function(e) {
                        // Revalidate the date field
                        $('#eventForm').formValidation('revalidateField', 'date');
                    });

                /*$('#eventForm').formValidation({
                    framework: 'bootstrap',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        name: {
                            validators: {
                                notEmpty: {
                                    message: 'The name is required'
                                }
                            }
                        },
                        date: {
                            validators: {
                                notEmpty: {
                                    message: 'The date is required'
                                },
                                date: {
                                    format: 'YYYY-MM-DD',
                                    message: 'The date is not a valid'
                                }
                            }
                        }
                    }
                });*/
            });

            function checkFormPayment() {
                if($("#order_no").val() == '') {
                    alert('Please enter Order number');

                    $("#order_no").focus();

                    return false;
                } else if($("#payment_method").val() == '') {
                    alert('Please select Payment Method');

                    $("#payment_method").focus();

                    return false;
                } else if($("#payment_date").val() == '') {
                    alert('Please select Date');

                    $("#payment_date").focus();

                    return false;
                } else if($("#payment_time").val() == '') {
                    alert('Please enter Time');

                    $("#payment_time").focus();

                    return false;
                } else if($("#payment_money").val() == '') {
                    alert('Please enter Money');

                    $("#payment_money").focus();

                    return false;
                } else if($("#payment_slip").val() == '') {
                    alert('Please Upload Slip');

                    $("#payment_slip").focus();

                    return false;
                } else if($("#payment_name").val() == '') {
                    alert('Please enter Name');

                    $("#payment_name").focus();

                    return false;
                } else if($("#payment_email").val() == '') {
                    alert('Please enter Email');

                    $("#payment_email").focus();

                    return false;
                } else if(!isEmail($("#payment_email").val())) {
                    alert('Invalid Email');

                    $("#payment_email").focus();

                    $("#payment_email").val('');

                    return false;
                } else if($("#payment_telephone").val() == '') {
                    alert('Please enter Telephone');

                    $("#payment_telephone").focus();

                    return false;
                } else if($("#payment_more_detail").val() == '') {
                    alert('Please enter More Details');

                    $("#payment_more_detail").focus();

                    return false;
                } else {
                    return true;
                }
            }

            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }
        </script>
       
        
    </div>

</body>

</html>