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
                                <input id="3" type="radio" name="g4" rel="complete_y" checked="">
                                <label for="3">Original Shipping Address</label>
                            </div>
                            <div class="md-radio md-radio-inline radiocheck">
                                <input id="4" type="radio" name="g4" rel="complete_n">
                                <label for="4">New Address</label>
                            </div>
                            <div class="wrap_radioinsure complete_y" style="display: block;">
                                <div class="row padding-bottom-com">
                                    <div class="col-4 col-md-3 col-lg-3">
                                        <div class="personal-text-1">Name : </div>
                                        <div class="personal-text-1">Last Names : </div>
                                        <div class="personal-text-1">Phone : </div>
                                        <div class="personal-text-1">E-mail : </div>
                                        <div class="personal-text-1">Address : </div>
                                        <div class="personal-text-1">Sub-district/ Sub-area : </div>
                                        <div class="personal-text-1">District / Area : </div>
                                        <div class="personal-text-1">Province : </div>
                                        <div class="personal-text-1">Postal Code : </div>
                                    </div>
                                    <div class="col-4 col-md-4 col-lg-4">
                                        <div class="personal-text">Sudarat</div>
                                        <div class="personal-text">Yodjan</div>
                                        <div class="personal-text">099 0516 006</div>
                                        <div class="personal-text">sudarat@gmail.com</div>
                                        <div class="personal-text">256/344 Moo.4</div>
                                        <div class="personal-text">Tambon Klongkum</div>
                                        <div class="personal-text">Amphur Bungkum</div>
                                        <div class="personal-text">Bangkok</div>
                                        <div class="personal-text">90150</div>
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
                            <div class="wrap_radioinsure complete_n padding-bottom-lo">
                                <div class="row pad_wrap_radioinsure">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="" class="form-shipping" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="" class="form-shipping" placeholder="Last names">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="" class="form-shipping" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="" class="form-shipping" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="ma-top-foemember">
                                            <textarea class="form-shipping" id="exampleTextarea" rows="4" placeholder="Address" style="height: inherit;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="" class="form-shipping" placeholder="Sub-district/ Sub-area">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="" class="form-shipping" placeholder="District / Area">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="menu_product">
                                            <div class="dropdown open"> 
                                                <a class="dropdown-toggle btn-province" data-toggle="dropdown" href="#" aria-expanded="true">Please select province.<b class="caret-menu"><i class="fa fa-angle-down" aria-hidden="true"></i></b>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-form-menu" role="menu">
                                                    <li><a href="">Bangkok</a></li>
                                                    <li><a href="">Lampang</a></li>
                                                    <li><a href="">Songkhla</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="ma-top-foemember">
                                            <input id="" class="form-shipping" placeholder="Postal Code">
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-12 col-md-12 col-lg-4 col-xl-4 bg_boxsummary mobile_bg_boxsummary">
                            <div class="order_summary">
                                <h4>Order Summary</h4>
                            </div>
                            <div class="text_order">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="text-align: left;">Iteme 2 </h6>
                                    </div>
                                    <div class="col-6">
                                        <h6>$318</h6>
                                    </div>
                                </div>
                                <div class="kerry_express">
                                    <h5>SHIPPING</h5>
                                    <p>EMS delivery time 2-3 days</p>
                                </div>

                                <div class="row pad_total">
                                    <div class="col-6">
                                        <h6 style="text-align: left; text-transform: uppercase;">ToTal Cost</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6>$318</h6>
                                    </div>
                                </div>
                                <div class="buttom_register"><a href="<?php echo site_frontend('payment.php');?>">next</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
    </div>
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
</body>

</html>