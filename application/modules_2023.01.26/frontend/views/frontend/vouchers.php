<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>

<style>
</style>

<body>
    <?php require('inc_menu.php'); ?>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    
                    <div class="row pad_vouchers_more">
<?php
if(!empty($categoryVoucherCtrl) and $categoryVoucherCtrl->category_voucher_image != '') {
?>
                        <img src="<?php echo base_url('uploads/category_voucher/'.$categoryVoucherCtrl->category_voucher_image);?>" class="img-fluid">  
<?php
}
?>
                                    <div class="row pad_valid div_voucher">
<?php
if(!empty($voucherCtrl)) {
    foreach($voucherCtrl as $r) {
?>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher">
                                                        <div class="my_voucher">
<?php
        if($r->voucher_type == 'Free Shipping') {
            echo $r->voucher_type.' Voucher';
        } elseif($r->voucher_type == '%') {
            echo 'Discount '.$r->voucher_price.'% OFF';
        } elseif($r->voucher_type == 'KS') {
            echo 'Discount '.$r->voucher_price.' KS';
        }
?>
                                                        </div>
                                                        <div class="voucher_free"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher pad_text_voucher">
                                                        <h6>
<?php
        if($r->voucher_type == 'Free Shipping') {
            echo $r->voucher_type.' Voucher';
        } elseif($r->voucher_type == '%') {
            echo 'Discount '.$r->voucher_price.'% OFF';
        } elseif($r->voucher_type == 'KS') {
            echo 'Discount '.$r->voucher_price.' KS';
        }
?> 
                                                        </h6>
                                                        <p>Valid Till: <?php echo getDateMistine($r->voucher_expired_date);?>
                                                        </p>
                                                        <a href="javascript:claimVoucher('<?php echo $r->voucher_id;?>');">Claim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<?php
    }
}
?>
                                        
                                        <!-- <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher">
                                                        <div class="my_voucher">Free Shipping</div>
                                                        <div class="voucher_free"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher pad_text_voucher">
                                                        <h6>Free Shipping Voucher</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                        <a href="">Claim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher">
                                                        <div class="my_voucher">ลด<br>50% OFF</div>
                                                        <div class="voucher_free"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher pad_text_voucher">
                                                        <h6>ลด 50% OFF</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                        <a href="">Claim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher">
                                                        <div class="my_voucher">ลด<br>10% OFF</div>
                                                        <div class="voucher_free"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher pad_text_voucher">
                                                        <h6>ลด 10% OFF</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                        <a href="">Claim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher">
                                                        <div class="my_voucher">ลด<br>10 % OFF</div>
                                                        <div class="voucher_free"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher pad_text_voucher">
                                                        <h6>ลด 10% OFF</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                        <a href="">Claim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                        
                    </div>

                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        

    </div>
    <script>
        function claimVoucher(voucher_id) {
            //alert(voucher_id);
            $.post('<?php echo site_url('frontend/path/ajaxClaimVoucher');?>', { voucher_id: voucher_id}, function(data) {
                var data_split = data.split('!@#$%^&*()');

                if(data_split[1] != '') {
                    alert(data_split[0]);

                    $(".div_voucher").html(data_split[1]);
                } else {
                    alert(data_split[0]);
                }
                
            });
        }
    </script>
</body>

</html>