<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
    
</head>
<style>
    
    .buttom_cancel a{
        color: #fff;
        border: 1px solid #ec008c;
        background-color: #ec008c;
        display: inline-block;
        line-height: 27px;
        transition: 0.5s;
        font-size: 14px;
        text-align: center;
        width: 45%;
        border-radius: 35px;
    }
    .buttom_cancel{
        text-align: right;
        padding-top: 54px;
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
<?php
//pre($cancelCtrl);
if(!empty($cancelCtrl)) {
    foreach($cancelCtrl as $r) {
        $cancel = $this->model_frontend->getCancelByCICancel($r->order_detail_id);
        //pre($cancel);
        if(empty($cancel)) {
?>
                            <div class="bgreturn">
                                <div class="row">
                                    <div class="col-xs-5 col-sm-6"> <?php echo dateCancelMistine($r->order_detail_datetime_create);?> </div>
                                    <div class="col-xs-7 col-sm-6 right"> ORDER No. <?php echo $r->order_no;?> </div>
                                </div>
                            </div>
<?php
            $order = $this->model_frontend->getCancelOrderResult($r->order_detail_id);

            $count_order = count($order);
            $i = 1;

            if(!empty($order)) {
                foreach($order as $c) {
                    $weight = $this->model_frontend->getWeightRecord($c->order_weight);
                    $color = $this->model_frontend->getColorRecord($c->order_color);
                    $collection = $this->model_frontend->getCollectionRecord($c->order_collection);
?>
                            <div class="row return_product">
                                <div class="col-2">
                                    <img src="<?php echo base_url('uploads/product/'.$c->order_image);?>" class="img-fluid">
                                </div>
                                <div class="col-6">
                                    <h5><?php echo $c->order_name;?></h5>
                                    <ul class="ul_return_product">
                                        <li>Quantity : <?php echo $c->order_qty;?></li>
                                        <li>Weight : <?php if(!empty($weight)) echo $weight->weight_name_lang1; else echo '-';?></li>
                                        <li>Color : <?php if(!empty($color)) echo $color->color_name_lang1; else echo '-';?></li>
                                        <li>Collection : <?php if(!empty($collection)) echo $collection->collection_name_lang1; else echo '-';?></li>
                                    </ul>
                                </div>
                                <div class="col-4">
                                    <h4><!-- <span>$200</span> --> <?php echo $c->order_price;?> KS</h4>
                                    <div class="buttom_cancel"><?php if($count_order == $i) { ?><a href="<?php echo site_url('frontend/path/cancel_step2/'.$c->order_detail_id);?>">Cancel</a><?php } ?></div>
                                </div>
                            </div>
<?php
                    $i++;
                }
            }
        }
    }
}
?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(7)').addClass('active');
        </script>
    </div>

</body>

</html>