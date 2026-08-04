<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>

<style>
    .table-responsive>.table>thead>tr>th,
    .table-responsive>.table>tbody>tr>th,
    .table-responsive>.table>tfoot>tr>th,
    .table-responsive>.table>thead>tr>td,
    .table-responsive>.table>tbody>tr>td,
    .table-responsive>.table>tfoot>tr>td {
        white-space: nowrap;
    }
</style>

<body>
    <?php require('inc_menu.php'); ?>
        
    <div class="container-fluid ba_gary">
        <div class="container">
            <div class="row">
                <div class="col-12 pad_account_1">
                    <div class="boxtext_help">
                        <h2>Help</h2>
                    </div>
                    <div class="row pad_account">
                        <div class="col-12 col-md-12 col-lg-3">
                            <?php require('inc_help.php'); ?>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9 bg_payment">
                            <div class="text-myaccount">
                                <h5>Order Tracking</h5>
                            </div>
                            <form action="" method="post">
                            <div class="row text_confirmed">
                                <div class="col-12 col-md-10 col-lg-10 p_md_r_confirmed">
                                    <input type="text" class="form-login" name="order_no" placeholder="Order number">
                                </div>
                                <!-- <div class="col-12 col-md-5 col-lg-5 p_md_l_confirmed">
                                    <input type="text" class="form-login" name="" placeholder="Or Order Number">
                                </div> -->
                                <div class="col-12 col-md-2 col-lg-2 pad_submit p_md_submit">
                                    <button class="button_submit" type="submit" name="submit" value="Search">Search</button>
                                </div>
                            </div>
                            </form>
                            <div class="table_xs table-responsive pad_table">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="bghistorycart">
                                            <td>Number</td>
                                            <td>Item</td>
                                            <td>Qty</td>
                                            <td>Price</td>
                                            <td>Sub Total</td>
                                            <td>Order Status</td>
                                            <td>Payment Status</td>
                                            <td>Delivery Status</td>
                                        </tr>
<?php
if(!empty($orderCtrl)) {
    foreach($orderCtrl as $r) {
?>
                                        <tr class="carttable">
                                            <td><?php echo $r->order_no;?></td>
                                            <td><?php echo $r->order_name;?></td>
                                            <td><?php echo $r->order_qty;?></td>
                                            <td><?php echo number_format($r->order_price, 0, '.', ',');?></td>
                                            <td><?php echo number_format($r->order_price * $r->order_qty, 0, '.', ',');?></td>
                                            <td><?php echo $r->order_detail_status;?></td>
                                            <td><?php echo $r->order_detail_payment_method;?></td>
                                            <td><?php echo $r->order_detail_shipping_method;?></td>
                                        </tr>
<?php
    }
} else {
?>
                                        <tr class="carttable">
                                            <td colspan="6">Not Found Data</td>
                                        </tr>
<?php
}
/*
?>
                                        <tr class="carttable">
                                            <td>001</td>
                                            <td>Mystic Tin B. Duck</td>
                                            <td>$318</td>
                                            <td>Achieve </td>
                                            <td>Complete payment</td>
                                            <td>In transit</td>
                                        </tr>
<?php
*/
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(2) ').addClass('active');
        </script>

    </div>

</body>

</html>