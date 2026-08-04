<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>

<style>
    /*quantity*/

    .product-quantity-subtract,
    .product-quantity-add {
        background-color: #fff;
        width: 43px;
        height: 24px;
        color: #000;
        font-size: 8px;
        line-height: 22px;
        text-align: center;
        border: 1px solid #ced4da;
    }


    .product-quantity * {
        display: inline-block;
        vertical-align: middle;
    }
    
    #product-quantity-input {
        text-align: center;
        background-color: #fff;
        width: 43px;
        height: 24px;
        line-height: 37px;
        font-size: 12px;
        outline: none;
        border-radius: 0;
        border: 1px solid #ced4da;
    }

    .product-quantity-input {
        text-align: center;
        background-color: #fff;
        width: 30px;
        height: 24px;
        line-height: 37px;
        font-size: 12px;
        outline: none;
        border-radius: 0;
        border: 1px solid #ced4da;
    }

    /*quantity*/
    
    @media (max-width: 1199px){
        .product-quantity-subtract, .product-quantity-add{
            width: 36px;
        }
    }
    @media (max-width: 991px){
        .product-quantity-subtract, .product-quantity-add{
            width: 46px;
            line-height: 22px;
        }
    }
    @media (max-width: 767px){
        .product-quantity-subtract, .product-quantity-add{
             width: 22px;
        }
        #product-quantity-input{
            width: 30px;
        }
    }
</style>

<body>
    <?php require('inc_menu.php'); ?>
        
    <div class="container-fluid ba_gary">
        <div class="container">
            <div class="row pad_cartshop">
                <div class="col-12 pad_nopad">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 col-xl-8 p-r-box">
                            <div class="bg_boxcart">
                            <div class="row cart_cartshop">
                                <div class="col-6 col-md-6 col-lg-6 cartpad-left">
                                    <div class="cart_cart">
                                        <h4>Shopping Cart</h4>
                                    </div>
                                </div>
<?php
$i = 0;
foreach($this->cart->contents() as $items) {
    $i++;
}
?>
                                <div class="col-6 col-md-6 col-lg-6 cartpad-right">
                                    <div class="cart_pricr">
                                        <h4><span class="cart_no"><?php echo $i;?></span> <span>Item</span></h4>
                                    </div>
                                </div>
                            </div>
                            <span class="cart1">
<?php
$i = 0;
$sub_total = 0;
foreach($this->cart->contents() as $items) {
    $price = $items['qty'] * $items['price'];
    $sub_total += $price
?>            
                            <div class="row pad_bottom_summary">
                                <div class="col-12 col-md-5">
                                    <div class="cart_details">
                                        <h4 style="text-align: left;">Product Details</h4>
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="cartimg_product"><img src="<?php echo base_url('uploads/product/'.$items['options']['image']);?>" class="img-fluid"></div>
                                            </div>
                                            <div class="col-7">
                                                <div class="carttext_product">
                                                    <h5><?php echo $items['name'];?></h5>
                                                    <h6>#<?php echo $items['options']['product_code'];?></h6>
                                                    <p style="text-align: left;" onclick="deleteCart('<?php echo $items['rowid'];?>');">Remove</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-3">
                                    <div class="cart_details cart_details_xs">
                                        <h4 style="text-align: center;">Quantity</h4>
                                        <h6 style="text-align: center;">Quantity</h6>
                                        <div class="product-quantity">
                                            <div class="product-quantity-subtract" style="border: none; background: none;" onclick="decreaseQty('<?php echo $items['rowid'];?>');">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <input type="number" id="qty_<?php echo $items['rowid'];?>" placeholder="0" class="product-quantity-input" value="<?php echo $items['qty'];?>" onblur="blurQty('<?php echo $items['rowid'];?>', this.value);">
                                            </div>
                                            <div class="product-quantity-add" style="border: none; background: none; padding-left: 0;">
                                                <i class="fa fa-plus" aria-hidden="true" onclick="increaseQty('<?php echo $items['rowid'];?>');"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="cart_details cart_details_xs">
                                        <h4>Price</h4>
                                        <h6>Price</h6>
                                        <p>Ks <?php echo number_format($items['price'], 0, '.', ',');?></p>

                                    </div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="cart_details cart_details_xs">
                                        <h4>ToTal</h4>
                                        <h6>ToTal</h6>
                                        <p>Ks <?php echo number_format($items['price'] * $items['qty'], 0, '.', ',');?></p>
                                    </div>
                                </div>
                            </div>
<?php
    $i++;
}
?>
                            </span>
<?php
$discount = 0;
if($this->session->userdata('coupon_type') == '%') {
    $discount = $sub_total * $this->session->userdata('coupon_discount') / 100;
} elseif($this->session->userdata('coupon_type') == 'KS') {
    $discount = $this->session->userdata('coupon_discount');
}

/*
?>                            
                            <div class="row pad_bottom_summary">
                                <div class="col-12 col-md-5">
                                    <div class="cart_details">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="cartimg_product"><img src="<?php echo base_frontend('images/product/product1.jpg');?>" class="img-fluid"></div>
                                            </div>
                                            <div class="col-7">
                                                <div class="carttext_product">
                                                    <h5>Mystin XB.Duck Sunscreen Facial Care SPF</h5>
                                                    <h6>Product code #00001</h6>
                                                    <p style="text-align: left;">Remove</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-3">
                                    <div class="cart_details cart_details_xs">
                                        <h6 style="text-align: center;">Quantity</h6>
                                        <div class="product-quantity">
                                            <div class="product-quantity-subtract" style="border: none; background: none;">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <input type="text" id="product-quantity-input" placeholder="0" value="0">
                                            </div>
                                            <div class="product-quantity-add" style="border: none; background: none; padding-left: 0;">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="cart_details cart_details_xs">
                                        <h6>Price</h6>
                                        <p>$159</p>

                                    </div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="cart_details cart_details_xs">
                                        <h6>ToTal</h6>
                                        <p>$318</p>
                                    </div>
                                </div>
                            </div>
<?php
*/
?>                            
                            <div class="continue_shopping"><a href="<?php echo site_url('frontend/path/products/category3/1');?>"><img src="<?php echo base_frontend('images/icon_leftarrow.png');?>"> Continue Shopping</a></div>
                            </div>
                            </div>
<?php 
$i = 0;
$sub_total = 0;
foreach($this->cart->contents() as $items) {
    $price = $items['qty'] * $items['price'];

    $sub_total += $price;

    $i++;
}

$voucher_price = 0;
if($this->session->userdata('voucher_price') == 'Free Shipping' or $this->session->userdata('voucher_price') != '') {
    $voucher_price = $this->session->userdata('voucher_price');
}

$all_discount = $discount + $voucher_price;

$total = $sub_total - $all_discount;
?>
                        <div class="col-12 col-md-12 col-lg-4 col-xl-4 p-l-box">
                            <div class="bg_boxsummary">
                            <div class="order_summary">
                                <h4>Order Summary</h4>
                            </div>
                            <div class="text_order">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="text-align: left;">Item <span class="cart_no"><?php echo $i;?></span> </h6>
                                    </div>
                                    <div class="col-6">
                                        <h6><span class="sub_total"><?php echo number_format($sub_total, 0, '.', ',');?></span></h6>
                                    </div>
                                </div>
<?php
/*                                
                                <div class="kerry_express">
                                    <h5>shipping</h5>
                                    <div class="menu_product">
                                    <div class="dropdown open">
                                        <!-- <a class="dropdown-toggle btn-province" data-toggle="dropdown" href="#" aria-expanded="true">EMS delivery time 2-3 days<b class="caret-menu"><i class="fa fa-angle-down" aria-hidden="true"></i></b>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-form-menu" role="menu" style="border-radius: 0px;">
                                            <li><a href="">EMS delivery time 2-3 days</a></li>
                                        </ul> -->
                                        <select class="form-control" id="order_detail_shipping_method">
                                            <option value="Normal" <?php if($this->session->userdata('order_detail_shipping_method') == 'Normal') echo 'selected';?>><?php echo get2Lang($this->session->userdata('lang'), 'ปกติ', 'Normal');?></option>
                                            <option value="EMS" <?php if($this->session->userdata('order_detail_shipping_method') == 'EMS') echo 'selected';?>><?php echo get2Lang($this->session->userdata('lang'), 'EMS', 'EMS');?></option>
                                        </select>
                                    </div>
                                </div>
*/
?>
                                </div>
                                <h5>Promo Code</h5>
                                <input type="text" id="coupon_code" class="form-mail" placeholder="Enter your code" value="<?php echo $this->session->userdata('coupon_code');?>">
                                <div class="button_code"><a href="javascript:checkCoupon();">APPLY</a></div>
                                <br>Voucher Click <a href="<?php echo site_frontend('member6.php');?>">Here</a>
                                <div class="row pad_total">
                                    <div class="col-6">
                                        <h6 style="text-align: left; text-transform: uppercase;">Discount</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 align="right"><span class="discount"><?php echo number_format($all_discount, 0, '.', ',');?></span></h6>
                                    </div>
                                </div>
                                <div class="row pad_total">
                                    <div class="col-6">
                                        <h6 style="text-align: left; text-transform: uppercase;">ToTal Payment</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 align="right"><span class="total"><?php echo number_format($total, 0, '.', ',');?></span></h6>
                                    </div>
                                </div>
                                <div class="buttom_register"><a href="javascript:cartShopping();">Payment</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
    </div>
    <script>
        //Reduce quantity by 1 if clicked
        /*$(document).on("click", ".product-quantity-subtract", function(e) {
            var value = $("#product-quantity-input").val();
            //console.log(value);
            var newValue = parseInt(value) - 1;
            if (newValue < 0) newValue = 0;
            $("#product-quantity-input").val(newValue);
            CalcPrice(newValue);
        });

        //Increase quantity by 1 if clicked
        $(document).on("click", ".product-quantity-add", function(e) {
            var value = $("#product-quantity-input").val();
            //console.log(value);
            var newValue = parseInt(value) + 1;
            $("#product-quantity-input").val(newValue);
            CalcPrice(newValue);
        });*/

        $(document).on("blur", "#product-quantity-input", function(e) {
            var value = $("#product-quantity-input").val();
            //console.log(value);
            CalcPrice(value);
        });


        function AddToCart(e) {
            e.preventDefault();
            var qty = $("#product-quantity-input").val();
            if (qty === '0') {
                return;
            }
            var toast = '<div class="toast toast-success">Added ' + qty + ' to cart.</div>';
            $("body").append(toast);
            setTimeout(function() {
                $(".toast").addClass("toast-transition");
            }, 100);
            setTimeout(function() {
                $(".toast").remove();
            }, 3500);
        }

        function increaseQty(rowid) {
            var qty = $("#qty_" + rowid).val();

            qty++;

            $.post("<?php echo site_url('frontend/path/ajaxUpdateCart');?>", { rowid: rowid, qty: qty }, function(data) {
                $("#qty_" + rowid).val(qty);

                var data_split = data.split('!@#$%^&*()');

                $(".cart_no").html(data_split[0]);
                $(".sub_total").html(addCommas(data_split[1]));
                $(".discount").html(addCommas(data_split[2]));
                $(".total").html(addCommas(data_split[4]));
                $(".cart1").html(data_split[5]);
                $(".cart_right_tab").html(data_split[6]);
            });
        }

        function decreaseQty(rowid) {
            var qty = $("#qty_" + rowid).val();

            if(qty > 1) {
                qty--;

                $.post("<?php echo site_url('frontend/path/ajaxUpdateCart');?>", { rowid: rowid, qty: qty }, function(data) {
                    $("#qty_" + rowid).val(qty);

                    var data_split = data.split('!@#$%^&*()');

                    $(".cart_no").html(data_split[0]);
                    $(".sub_total").html(addCommas(data_split[1]));
                    $(".discount").html(addCommas(data_split[2]));
                    $(".total").html(addCommas(data_split[4]));
                    $(".cart1").html(data_split[5]);
                    $(".cart_right_tab").html(data_split[6]);
                });
            }
        }

        function blurQty(rowid, qty) {
            $.post("<?php echo site_url('frontend/path/ajaxUpdateCart');?>", { rowid: rowid, qty: qty }, function(data) {
                $("#qty_" + rowid).val(qty);

                var data_split = data.split('!@#$%^&*()');

                $(".cart_no").html(data_split[0]);
                $(".sub_total").html(addCommas(data_split[1]));
                $(".discount").html(addCommas(data_split[2]));
                $(".total").html(addCommas(data_split[4]));
                $(".cart1").html(data_split[5]);
                $(".cart_right_tab").html(data_split[6]);
            });
        }

        function deleteCart(rowid) {
            if(confirm("Confirm Delete") == true) {
                $.post("<?php echo site_url('frontend/path/ajaxDeleteCart');?>", { rowid: rowid }, function(data) {

                    var data_split = data.split('!@#$%^&*()');

                    $(".cart_no").html(data_split[0]);
                    $(".sub_total").html(addCommas(data_split[1]));
                    $(".discount").html(addCommas(data_split[2]));
                    $(".total").html(addCommas(data_split[4]));
                    $(".cart1").html(data_split[5]);
                    $(".cart_right_tab").html(data_split[6]);
                });
            }
        }

        function cartShopping() {
            $.post('<?php echo site_url("frontend/path/ajaxCartShopping");?>', { order_detail_shipping_method: $("#order_detail_shipping_method").val() }, function(data) {
                window.location.href = '<?php echo site_url("frontend/path/shippingaddress");?>';
            })
        }

        function checkCoupon() {
            //alert($("#coupon_code").val());
            $.post('<?php echo site_url("frontend/path/ajaxCoupon");?>', { coupon_code: $("#coupon_code").val() }, function(data) {

                var pre_data_split = data.split('!@#$)');
                var data_split = pre_data_split[1].split('!@#$%^&*()');

                //alert(data_split);

                if(pre_data_split[0] == true) {
                    $(".cart_no").html(data_split[0]);
                    $(".sub_total").html(addCommas(data_split[1]));
                    $(".discount").html(addCommas(data_split[2]));
                    $(".total").html(addCommas(data_split[4]));
                    $(".cart1").html(data_split[5]);
                } else {
                    $("#coupon_code").val('');
                    $(".cart_no").html(data_split[0]);
                    $(".sub_total").html(addCommas(data_split[1]));
                    $(".discount").html(addCommas(data_split[2]));
                    $(".total").html(addCommas(data_split[4]));
                    $(".cart1").html(data_split[5]);

                    alert(pre_data_split[0]);
                }

                $(".cart_right_tab").html(data_split[6]);
            });
        }
    </script>
</body>

</html>