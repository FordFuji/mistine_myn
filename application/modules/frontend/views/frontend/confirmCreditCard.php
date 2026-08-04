<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>


<body>
    <?php require('inc_menu.php'); ?>
        
    <div class="container-fluid ba_gary">
        <div class="container">
            <div class="row">
                <div class="col-12 bg_boxlogin">
                    <div class="">
                        <div class="confirm_waiting">
                            <img src="<?php echo base_frontend('images/icon_fast.png');?>" class="img-fluid">
                            <h4>Waiting for payment</h4>
                            <!-- <p>Order number 001</p> -->
                            <p>You can track and manage your orders in my account.<?php if($this->session->userdata('member_id') != '') { ?> > <a href="<?php echo site_frontend('profile-tracking.php');?>" style="font-weight: 600;">Ordering</a><?php } ?></p>
                            <!-- <p>The reference number will expire in</p> -->
                            <p>Order No</p>
                            <!-- <h3>48 : 00 : 00</h3> -->
                            <h3><?php if(!empty($row)) echo $row->order_no;?></h3>
                            <h6>Complete payment before <?php if(!empty($row)) echo $row->order_restock;?></h6>
                            <a href="<?php echo site_frontend('index.php');?>" style="text-decoration: underline;">Home</a>
                        </div>
                        <div class="confirm_note">
                            <h6>Note ***</h6>
                            <p><i class="fa fa-envelope" aria-hidden="true"></i> : We have sent a confirmation email to noreply@mistine-myanmar.com With order details</p>
                            <p><i class="fa fa-truck" aria-hidden="true"></i> : Your order will be delivered between Sat 12 May - Thu 17 May.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
    </div>

</body>

</html>