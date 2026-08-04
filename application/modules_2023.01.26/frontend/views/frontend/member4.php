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
        
    <div class="container-fluid ba_gary">
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
                                <h5>My Wishlist</h5>
                            </div>
                            <div class="row">
<?php
if(!empty($wishlistCtrl)) {
    foreach($wishlistCtrl as $r) {
?>
                                <div class="col-6 col-md-4 col-lg-4 col-xl-4" id="wishlist_<?php echo $r->product_id;?>">
                                        <div class="box_products">
                                            <div class="delete_wish"><a href="javascript:deleteWishlist('<?php echo $r->product_id;?>');">x</a></div>
                                                
                                            <div class="img_products">
                                                <div class="img_product">
                                                    <a href="<?php echo site_url('frontend/path/product_inside/'.$r->product_id);?>">
                                            <img src="<?php echo base_url('uploads/product/'.$r->product_image);?>" alt="Avatar" class="image_product">
                                            <div class="overlay_product">
                                                <a href="javascript:void(0);" class="icon_search">
                                                    <img src="<?php echo base_frontend('images/icon_heart_color.jpg');?>" class="img-fluid">
                                                </a>
                                                    <a href="<?php echo site_url('frontend/path/product_inside/'.$r->product_id);?>" class="icon_readmore">
                                                        <div>Readmore</div>
                                                    </a>
                                                    <a href="javascript:insertCart('<?php echo $r->product_id;?>');" class="icon_shopping">
                                                    <img src="<?php echo base_frontend('images/icon_shopping.png');?>" class="img-fluid">
                                                </a>
                                                </div>
                                                </a>
                                            </div>

                                            <h4><?php echo get2Lang($this->session->userdata('lang'), $r->product_name_lang1, $r->product_name_lang2);?></h4>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5><span>$<?php echo number_format($r->product_before_discount_price_type1, 0, '.', ',');?></span> $<?php echo number_format($r->product_price1, 0, '.', ',');?></h5>
                                                </div>
                                                <div class="col-6">
                                                    <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
<?php
    }
}
?>
                            
                            </div>                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(4) ').addClass('active');

            function deleteWishlist(product_id) {
                var result = confirm('Confirm Delete');

                if(result == true) {
                    $.post('<?php echo site_url("frontend/path/ajaxDeleteWishlist");?>', { product_id: product_id }, function(data) {
                        //alert('Delete Wishlist Success');

                        $("#wishlist_" + product_id).remove();
                    });
                }
            }

            function insertCart(product_id) {
                $.post('<?php echo site_url("frontend/path/ajaxInsertCartDirect");?>', { product_id: product_id, qty: 1 }, function(data) {
                    var data_split = data.split('!@#$%^&*()');

                    $(".cart_no").html(data_split[0]);
                    $(".sub_total").html(addCommas(data_split[1]));
                    $(".discount").html(addCommas(data_split[2]));
                    $(".total").html(addCommas(data_split[4]));
                    $(".cart1").html(data_split[5]);
                    $(".cart_right_tab").html(data_split[6]);
                });
            }
        </script>
        
    </div>

</body>

</html>