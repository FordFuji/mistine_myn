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
    .return_step{
        text-align: center;
        
    }
    .return_step h5 {
        padding: 10px 0;
    }

    

    .bgreturn .right {
        text-align: right;
    }

    .fontsize {
        font-size: 13px;
        margin-bottom: 5px;
    }
    
    .button_sub:hover {
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
        margin-bottom: 100px;
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
                    <form action="<?php echo site_url('frontend/path/returns_step2');?>" method="post">
                    <div class="row pad_account">
                        <div class="col-12 col-md-12 col-lg-3">
                            <?php require('inc_account.php'); ?>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9 bg_payment">
                            <div class="text-myaccount pad_myaccount">
                                <h5>My Returns</h5>
                            </div>
                            <div class="return_step">
                                <img src="<?php echo base_frontend('images/step-return1.png');?>" class="img-fluid">
                                <h5>SELECT ITEMS TO RETURN</h5>
                            </div>
<?php
if(!empty($returnsCtrl)) {
    foreach($returnsCtrl as $r) {
?>
                            <div class="bgreturn">
                                <div class="row">
                                    <div class="col-xs-5 col-sm-6"> <?php echo dateCancelMistine($r->order_detail_datetime_create);?> </div>
                                    <div class="col-xs-7 col-sm-6 right"> ORDER No. <?php echo $r->order_no;?> </div>
                                </div>
                            </div>
<?php
        $order = $this->model_frontend->getOrderItemReturnResult($r->order_detail_id);
        if(!empty($order)) {
            foreach($order as $o) {
                $weight = $this->model_frontend->getWeightRecord($o->order_weight);
                $color = $this->model_frontend->getColorRecord($o->order_color);
                $collection = $this->model_frontend->getCollectionRecord($o->order_collection);
?>
                            <div class="md-radio md-radio-inline radiocheck pad_return">
                                <input id="returns_<?php echo $o->order_id;?>" type="radio" name="order_id" rel="returns_<?php echo $o->order_id;?>" value="<?php echo $o->order_id;?>" onclick="clickOrderId('<?php echo $o->order_id;?>');">
                                <label for="returns_<?php echo $o->order_id;?>">
                                    <div class="row return_product" style="height: 300px;">
                                        <div class="col-2">
                                            <img src="<?php echo base_url('uploads/product/'.$o->order_image);?>" class="img-fluid">
                                        </div>
                                        <div class="col-6">
                                            <h5><?php echo $o->order_name;?></h5>
                                            <ul class="ul_return_product">
                                                <li>Quantity : <?php echo $o->order_qty;?></li>
                                                <li>Weight : <?php if(!empty($weight)) echo $weight->weight_name_lang1; else echo '-';?></li>
                                                <li>Color : <?php if(!empty($color)) echo $color->color_name_lang1; else echo '-';?></li>
                                                <li>Collection : <?php if(!empty($collection)) echo $collection->collection_name_lang1; else echo '-';?></li>
                                            </ul>
                                        </div>
                                        <div class="col-4">
                                            <h4><!-- <span>$200</span> --> $<?php echo number_format($o->order_price, 0, '.', ',');?></h4>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="wrap_radioinsure returns_<?php echo $o->order_id;?>">
                                <div class="row form-tres">
                                    <div class="col-sm-6">
                                        <br>
                                        <p class="fontsize">Quantity</p>
                                        <input id="return_qty_<?php echo $o->order_id;?>" name="return_qty[]" type="text" placeholder="0" value="0" class="form-login"> 
                                    </div>
                                    <div class="col-sm-6">
                                        <br>
                                        <p class="fontsize"> Reason for return ? </p>
                                        <div class="dropdown-product">
                                            <div class="dropdown open show">
                                                <!-- <a class="dropdown-toggle btn-select-menu form-login" data-toggle="dropdown" href="#" aria-expanded="true">All Status <b class="caret-menu"><i class="fa fa-angle-down" aria-hidden="true"></i></b>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-form-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <li><a href="">Payment Confirmed</a></li>
                                                    <li><a href="">Order Submitted</a></li>
                                                    <li><a href="">Order Cancelled</a></li>
                                                </ul> -->
                                                <select class="form-control" name="return_reason[]" id="return_reason">
                                                    <!-- <option value="Payment Confirmed">Payment Confirmed</option>
                                                    <option value="Order Submitted">Order Submitted</option>
                                                    <option value="Order Cancelled">Order Cancelled</option> -->
                                                    <option value="Incomplete products or incomplete parts.">Incomplete products or incomplete parts.</option>
                                                    <option value="Received the wrong product, such as wrong site, wrong color, wrong product.">Received the wrong product, such as wrong site, wrong color, wrong product.</option>
                                                    <option value="The product is in bad condition or the product is damaged.">The product is in bad condition or the product is damaged.</option>
                                                    <option value="Expired product.">Expired product.</option>
                                                    <option value="The product is different from the details.">The product is different from the details.</option>
                                                    <option value="Other.">Other.</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="btnsumma"> 
                                            
                                            <a href="<?php echo site_frontend('member7.php');?>" class="button_btp">Back to page</a> 
                                            <input type="submit" name="submit" class="button_sub" value="Submit">
                                        
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
<?php
            }
        }
    }
}
?>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(6) ').addClass('active');
        </script>
        <script type="text/javascript">
            var order_id_ = 0;

            function clickOrderId(order_id) {
                order_id_ = order_id;
            }

            $(document).ready(function() {
                var radiocheck = $('.radiocheck input:checked').attr('rel');
                $('.' + radiocheck).slideDown();
                $('.radiocheck input').click(function() {
                    var radiocheck = $('.radiocheck input:checked').attr('rel');
                    $('.wrap_radioinsure').slideUp();
                    $('.' + radiocheck).slideDown();

                    $('#return_qty_' + order_id_).val(1);
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

</body>

</html>