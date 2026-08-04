<?php //pre($this->session->all_userdata());?>
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
                <div class="col-12 pad_account_1">
                    <div class="boxtext_help">
                        <h2>My Account</h2>
                    </div>
                    <div class="row pad_account">
                        <div class="col-12 col-md-12 col-lg-3">
                            <?php require('inc_account.php'); ?>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9 bg_payment">
                            <div class="text-myaccount">
                                <h5>My Vouchers</h5>
                            </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Valid(<span class="voucher_valid"><?php if(!empty($sumVoucherValid)) echo $sumVoucherValid;?></span>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Used</a>
                                </li>
                            </ul>
                            <br>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row pad_valid">
<?php
if(!empty($voucherMemberValidCtrl)) {
    foreach($voucherMemberValidCtrl as $r) {
?>
                                        <div class="col-12 col-md-6 pad_voucher" style="cursor:pointer;" id="voucher_id_<?php echo $r->voucher_id;?>" onclick="useVoucher('<?php echo $r->voucher_id;?>');">
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
                                                    <div class="text_voucher">
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
                                                        <p>Valid Till: <?php echo getDateMistine($r->voucher_expired_date);?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<?php
    }
}
/*
?>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher">
                                                        <div class="my_voucher">Free Shipping</div>
                                                        <div class="voucher_free"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher">
                                                        <h6>Free Shipping Voucher</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher">
                                                        <div class="my_voucher">Free Shipping</div>
                                                        <div class="voucher_free"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher">
                                                        <h6>Free Shipping Voucher</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher">
                                                        <div class="my_voucher">Free Shipping</div>
                                                        <div class="voucher_free"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher">
                                                        <h6>Free Shipping Voucher</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher">
                                                        <div class="my_voucher">Free Shipping</div>
                                                        <div class="voucher_free"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher">
                                                        <h6>Free Shipping Voucher</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<?php
*/
?>
                                    </div>
                                    <!-- <a href="javascript:cancelVoucher();">Cancel Voucher</a> -->
                                    <input type="button" value="Clear Voucher" onclick="cancelVoucher();">
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row pad_valid">
<?php
//pre($voucherMemberUseCtrl);
if(!empty($voucherMemberUseCtrl)) {
    foreach($voucherMemberUseCtrl as $r) {
?>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher used">
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
                                                        <div class="voucher_free used"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher">
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
                                                        <p>Valid Till: <?php echo getDateMistine($r->voucher_expired_date);?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<?php
    }
}
/*
?>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher used">
                                                        <div class="my_voucher">Free Shipping</div>
                                                        <div class="voucher_free used"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher">
                                                        <h6>Free Shipping Voucher</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher used">
                                                        <div class="my_voucher">Free Shipping</div>
                                                        <div class="voucher_free used"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher">
                                                        <h6>Free Shipping Voucher</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher used">
                                                        <div class="my_voucher">Free Shipping</div>
                                                        <div class="voucher_free used"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher">
                                                        <h6>Free Shipping Voucher</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 pad_voucher">
                                            <div class="row">
                                                <div class="col-12 col-md-4 voucher_r">
                                                    <div class="voucher used">
                                                        <div class="my_voucher">Free Shipping</div>
                                                        <div class="voucher_free used"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8 voucher_l">
                                                    <div class="text_voucher">
                                                        <h6>Free Shipping Voucher</h6>
                                                        <p>Valid Till: 31.05.2020</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
<?php
*/
?>
                                    </div>

                                </div>
                            </div>







                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(5) ').addClass('active');
        </script>

    </div>
<script>
function useVoucher(voucher_id) {
    if(confirm("Confirm Use Voucher") == true) {
        $.post('<?php echo site_url("frontend/path/ajaxUseVoucher");?>', { voucher_id: voucher_id }, function(data) {
            if(data != '') {
                alert(data);
            }
            window.location.href = '<?php echo site_url("frontend/path/member6");?>';
        });
    }
}

function cancelVoucher() {
    $.post('<?php echo site_url('frontend/path/ajaxCancelVoucher');?>', function(data) {
        window.location.href = '<?php echo site_url("frontend/path/member6");?>';
    });
}
</script>
</body>

</html>