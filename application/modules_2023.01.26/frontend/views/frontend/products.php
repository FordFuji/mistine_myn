<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>
<style>
    .dropdown-menu-1.show {
        display: block !important;
        width: 100%;
        border-radius: 0;
    }
    .dropdown-toggle{
        font-size: 14px;
        background-color: #fff;
        width: 100%;
        text-align: left;
        margin: 0;
        padding: 3px 15px;
        border: none;
        cursor: pointer;
    }
    .dropdown-toggle i{
        position: absolute;
        right: 15px;
        top: 6px;
    }
    .dropdown-item{
        font-size: 14px;
    }
    .dropdown-item.active, .dropdown-item:active {
        color: #000;
        text-decoration: none;
        background: none;
    }
    .new_1{
        font-size: 8px;
    }
    .img_products h4{
        font-size: 14px;
    }
    .img_products h5 span{
        font-size: 12px;
    }
    .icon_readmore div {
        padding: 7px 7px;
    }
    .img_products h6{
        font-size: 9px;
    }
    .img_products h5{
        font-size: 14px;
    }
    .icon_readmore div{
        padding: 7px 11px;
    }
    .icon_readmore{
        font-size: 12px;
        bottom: -1px;
    }
    .icon_search img{
        width: 80%;
    }
    .icon_shopping{
        right: 7px;
    }
    .icon_shopping img{
        width: 80%;
    }
    .page-link{
        margin: 0 3px;
        padding: 3px 11px;
        font-size: 13px;
    }
    .page-item.active .page-link{
        padding: 3px 13px;
    }
    @media (max-width: 1199px){
        .icon_search img {
            width: 75%;
        }
        .icon_shopping img {
            width: 72%;
        }
        .dropdown-toggle{
            font-size: 14px;
            padding: 2px 15px;
        }
        .dropdown-menu-form-menu a{
            padding: 7px 0px;
        }
        .icon_search {
            bottom: 5px;
            left: 4px;
        }
        .icon_search img {
            width: 70%;
        }
        .img_products h6 {
            font-size: 8px;
        }
        .icon_shopping img {
            width: 70%;
        }
        .icon_shopping {
            right: -8px;
            bottom: 5px;
        }
        .icon_readmore {
            font-size: 11px;
            bottom: -11px;
        }
        .img_products h5 {
            font-size: 12px;
        }
        .img_products h5 span {
            font-size: 10px;
        }
    }
    @media (max-width: 991px){
        .img_products h5 {
            font-size: 16px;
        }
        .img_products h5 span {
            font-size: 12px;
        }
        .img_products h6 {
            font-size: 10px;
        }
        .icon_shopping {
            right: 17px;
            bottom: 17px;
        }
        .icon_shopping img {
            width: 82%;
        }
        .icon_readmore {
            font-size: 13px;
            bottom: 0px;
        }
        .icon_search {
            bottom: 17px;
            left: 22px;
        }
        .icon_search img {
            width: 82%;
        }
        .img_products p{
            font-size: 12px;
        }
    }
    @media (max-width: 767px){
        .icon_search {
           left: 7px;
        }
        .icon_shopping {
            right: 0px;
        }
    }

    .active_product {
        background-color: #ec008c !important;
        color: #fff !important;
    }

    .none_product {
        background-color: #fff !important;
        color: #000 !important;
    }
</style>
<body>
    <?php require('inc_menu.php'); ?>
    <div class="container-fluid">
        <div class="row pad-banner">
            <div class="col-12 nopan banner wow fadeInDown">
                <div class="text_banner">
                    <h2>Products</h2>
                    <p><a href="<?php echo site_frontend('index.php');?>">Home</a> l Products</p>
                </div>
                <img src="<?php echo base_frontend('images/banner/products.jpg');?>" class="img-fluid" style="width: 100%;">
            </div>
        </div>
        <div class="row">
            
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInDown">
                        <div class="md_sorted_by_block sorted_by">
                                    <div class="row">
                                        <div class="col-12 col-md-2">
                                            <h6>Sorted by</h6>
                                        </div>
                                        <div class="col-6 col-md-1 <?php if($this->input->get('type') == 'new') echo 'pad_sorted_by pad_r_sorted'; elseif($this->input->get('type') == 'bestsellers') echo 'pad_l_sorted'; else echo 'pad_sorted_by pad_r_sorted';?>">
                                            <h5><a href="<?php echo site_url('frontend/path/products/'.$type.'/'.$category3_id.'?type=new');?>">NEW</a></h5>
                                        </div>
                                        <div class="col-6 col-md-2 col-6 col-md-2 <?php if($this->input->get('type') == 'bestsellers') echo 'pad_sorted_by pad_r_sorted'; elseif($this->input->get('type') == 'new') echo 'pad_l_sorted'; else echo 'pad_l_sorted';?>">
                                            <h4><a href="<?php echo site_url('frontend/path/products/'.$type.'/'.$category3_id.'?type=bestsellers');?>">Bestsellers</a></h4>
                                        </div>
                                        <div class="col-12 col-md-3 pad_sorted_by">
                                            <div class="dropdown open"> 
                                                <a class="dropdown-toggle btn-province" data-toggle="dropdown" href="#" aria-expanded="true">Price<b class="caret-menu"><i class="fa fa-angle-down" aria-hidden="true"></i></b>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-form-menu" role="menu">
                                                    <li><a href="<?php echo site_url('frontend/path/products/'.$type.'/'.$category3_id.'?type='.$this->input->get('type').'&sort=price_z_a');?>">Price high to low</a></li>
                                                    <li><a href="<?php echo site_url('frontend/path/products/'.$type.'/'.$category3_id.'?type='.$this->input->get('type').'&sort=price_z_a');?>">Price low to high</a></li>
                                                </ul>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-md-1"></div>
                                        <?php
$i = 0;
if(!empty($productCtrl)) {
    foreach($productCtrl as $r) {
        $i++;
    }
}
?>
                                        <?php $per_page = 16;?>
                                        <div class="col-md-3 pad_sorted_l">
                                            <p>Showing 
                                            <?php if($i == 0) echo 0; elseif($this->input->get('per_page') == 1 or $this->input->get('per_page') == '') echo 1; else echo ($this->input->get('per_page') * $per_page) - $per_page + 1;?>
                                            -
                                            <?php if($i == 0) echo 0; elseif($this->input->get('per_page') == 1 or $this->input->get('per_page') == '') echo $i; else echo ($this->input->get('per_page') * $per_page) - $per_page + $i + 1;?> of <?php if($i == 0) echo 0; else echo count($this->model_frontend->getProductCategory3ResultAll($category3_id));?> results</p>
                                        </div>
                                    </div>
                                </div>
                                
                        <div class="row">
                            <div class="col-md-3 wow fadeInDown">
                                <?php require('inc_category.php'); ?>
                            </div>
                            <div class="col-md-9 wow fadeInDown">
                                <div class="md_sorted_by sorted_by">
                                    <div class="row">
                                        <div class="col-2">
                                            <h6>Sorted by</h6>
                                        </div>
                                        <div class="col-1 pad_sorted_by <?php //if($this->input->get('type') == 'new') echo ' active_product '; elseif($this->input->get('type') == 'bestsellers') echo ' none_product ';?>">
                                            <h5><a href="<?php echo site_url('frontend/path/products/'.$type.'/'.$category3_id.'?type=new');?>">NEW</a></h5>
                                        </div>
                                        <div class="col-2 pad_sorted_by <?php //if($this->input->get('type') == 'bestsellers') echo ' active_product '; elseif($this->input->get('type') == 'new') echo ' none_product '; else echo ' none_product';?>">
                                            <h4><a href="<?php echo site_url('frontend/path/products/'.$type.'/'.$category3_id.'?type=bestsellers');?>"><a href="<?php echo site_url('frontend/path/products/'.$type.'/'.$category3_id.'?type=bestsellers');?>">Bestsellers</a></h4>
                                        </div>
                                        <div class="col-3 pad_sorted_by">
                                            <div class="dropdown open"> 
                                                <a class="dropdown-toggle btn-province" data-toggle="dropdown" href="#" aria-expanded="true">Price<b class="caret-menu"><i class="fa fa-angle-down" aria-hidden="true"></i></b>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-form-menu" role="menu">
                                                    <li><a href="<?php echo site_url('frontend/path/products/'.$type.'/'.$category3_id.'?type='.$this->input->get('type').'&sort=price_z_a');?>">Price high to low</a></li>
                                                    <li><a href="<?php echo site_url('frontend/path/products/'.$type.'/'.$category3_id.'?type='.$this->input->get('type').'&sort=price_z_a');?>">Price low to high</a></li>
                                                </ul>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-1"></div>
<?php
$i = 0;
if(!empty($productCtrl)) {
    foreach($productCtrl as $r) {
        $i++;
    }
}
?>
                                        <?php $per_page = 16;?>
                                        <div class="col-3 pad_sorted_l">
                                            <p>Showing 
                                            <?php if($i == 0) echo 0; elseif($this->input->get('per_page') == 1 or $this->input->get('per_page') == '') echo 1; else echo ($this->input->get('per_page') * $per_page) - $per_page + 1;?>
                                            -
                                            <?php if($i == 0) echo 0; elseif($this->input->get('per_page') == 1 or $this->input->get('per_page') == '') echo $i; else echo ($this->input->get('per_page') * $per_page) - $per_page + $i + 1;?> of <?php if($i == 0) echo 0; else echo count($this->model_frontend->getProductCategory3ResultAll($category3_id));?> results</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row wow fadeInDown">
<?php
if(!empty($productCtrl)) {
    foreach($productCtrl as $r) {
?>                                    
                                    <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                                        <div class="box_products">
                                            <div class="img_products">
                                                <?php if($r->product_new == 'Yes') { ?><div class="new_1">NEW!<span></span></div><?php } ?>
                                                <div class="img_product">
                                                    <a href="<?php echo site_url('frontend/path/product_inside/'.$r->product_id);?>">
                                            <img src="<?php echo base_url('uploads/product/'.$r->product_image);?>" alt="Avatar" class="image_product">
                                            <div class="overlay_product">
                                                <a href="javascript:wishlist('<?php echo $r->product_id;?>');" class="icon_search aWishlist_<?php echo $r->product_id;?>">
<?php
        $select_wishlist = $this->model_frontend->getWishlistColor($r->product_id);
        if(!empty($select_wishlist)) {
?>
                                            <img src="<?php echo base_frontend('images/icon_heart_color.jpg');?>" id="wishlist_<?php echo $r->product_id;?>" class="img-fluid" onclick="wishlist('<?php echo $r->product_id;?>');">
<?php
        } else {
?>
                                            <img src="<?php echo base_frontend('images/icon_heart.jpg');?>" id="wishlist_<?php echo $r->product_id;?>" class="img-fluid" onclick="wishlist('<?php echo $r->product_id;?>');">
<?php            
        }
?>
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
    <h5><?php if($r->product_before_discount_price_type1 != '0') { echo  '<span>KS '.number_format($r->product_before_discount_price_type1, 0, '.', ',');?></span><?php } ?> Ks <?php echo number_format($r->product_price1, 0, '.', ',');?></h5>
                                                </div>
                                                <div class="col-6">
                                                    <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                                                    <!-- <p>Sold 3k</p> -->
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
                                <div class="pad_pagination wow fadeInDown">
                                    <?php if(!empty($pagination)) echo $pagination;?>
                                    <!-- <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link" href=""><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo site_frontend('page_2.php');?>">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        </li>
                                    </ul> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php require('inc_footer.php'); ?>
        <script>
        function wishlist(product_id) {
            $.post('<?php echo site_url("frontend/path/ajaxWishlist");?>', { product_id: product_id }, function(data) {
                if(data == 'Please Login') {
                    alert(data);
                } else {
                    $(".aWishlist_" + product_id).html('<img src="<?php echo base_frontend('images/icon_heart_color.jpg');?>" class="img-fluid">');
                }
            });
        }

        function insertCart(product_id) {
            $.post('<?php echo site_url("frontend/path/ajaxInsertCartDirect");?>', { product_id: product_id, qty: 1 }, function(data) {
                var data_split = data.split('!@#$%^&*()');

                $(".cart_no").html(data_split[0]);
            });
        }

        function wishlist(product_id) {
            $.post('<?php echo site_url("frontend/path/ajaxWishlist");?>', { product_id: product_id }, function(data) {
                if(data == 'Please Login') {
                    alert(data);
                } else {
                    $(".aWishlist_" + product_id).html('<img src="<?php echo base_frontend('images/icon_heart_color.jpg');?>" class="img-fluid">');
                }
            });
        }
        </script>
    </div>
</body>

</html>