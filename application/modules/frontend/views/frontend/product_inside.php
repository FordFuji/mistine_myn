<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_frontend('OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_frontend('OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css');?>" />

</head>
<style>
    
    .owl-one.owl-carousel .owl-nav button.owl-prev {
        position: absolute;
        background-repeat: no-repeat;
        background-size: cover;
        left: -5px;
        top: 32%;
        border-radius: 0;
        width: 34px;
        height: 34px;
        background-image: url(<?php echo base_frontend('images/owl-prev.png');?>);
    }
    
    .owl-one.owl-carousel .owl-nav button.owl-next {
        background-image: url(<?php echo base_frontend('images/owl-next.png)');?>);
        background-repeat: no-repeat;
        background-size: cover;
        position: absolute;
        right: -5px;
        top: 32%;
        border-radius: 0;
        width: 34px;
        height: 34px;
    }

    .flexslider img {
        border: 1px solid #a1a1a157;
    }

    .flexslider {
        margin: 0 0 5px;
    }

    .flex-direction-nav {
        display: none;
    }

    .glyphicon-plus:before {
        content: "\2b";
    }

    .glyphicon-minus:before {
        content: "\2212";
    }

    .glyphicon {
        font-size: 16px;
        color: #ec008c;
        font-style: normal;
        font-family: 'Poppins', sans-serif;
        line-height: 16px;
        font-weight: 600;
    }

    .more-less {
        float: right;
    }

    .nav {
        width: 100%;
    }

    .nav-tabs {
        border: none;
        float: right;
    }

    .nav-tabs .nav-item {
        margin-bottom: 0px;
        margin-right: 5px;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #000;
        background: #e5e5e5;
    }

    .nav-tabs .nav-link {
        color: #000;
        font-size: 12px;
        border-radius: 0;
        background: #fff;
        border: 1px solid #a1a1a13d;
        width: 100px;
        text-align: center;
        padding: 8px 0;
    }
    input[type=checkbox], input[type=radio]{
        display: none;
    }
    @media (max-width: 1199px){
        .nav-tabs .nav-link{
            width: 83px;
        }
    }
    @media (max-width: 991px){
        .nav-tabs .nav-link{
            width: 62px;
            padding: 5px 0;
            font-size: 9px;
        }
    }
    @media (max-width: 767px){
        .owl-one.owl-carousel .owl-nav button.owl-next {
            width: 24px;
            height: 24px;
        }
        .owl-one.owl-carousel .owl-nav button.owl-prev {
            width: 24px;
            height: 24px;
        }
    }

    .product_price1 {
        color: #ec008c !important;
        text-decoration: none !important;
        font-weight: bold !important;
    }

    .rating { 
      border: none;
      /*float: center;*/
      text-align: center;
    }

    .rating > input { display: none; } 
    .rating > label:before { 
      margin: 5px;
      font-size: 1.25em;
      font-family: FontAwesome;
      display: inline-block;
      content: "\f005";
    }

    /*.rating > .half:before { 
      content: "\f089";
      position: absolute;
    }*/

    .rating > label { 
      color: #ddd; 
     float: right; 
    }

    .center {
        text-align: center !important;
    }

    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating > input:checked ~ label, /* show gold star when clicked */
    .rating:not(:checked) > label:hover, /* hover current star */
    .rating:not(:checked) > label:hover ~ label { color: #e83e8c;  } /* hover previous stars in list */

    .rating > input:checked + label:hover, /* hover current star when changing rating */
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
    .rating > input:checked ~ label:hover ~ label { color: #e83e8c;  } 

    .rating > label {
        color: #ddd;
        float: initial;
    }
</style>

<body>
    <?php require('inc_menu.php'); ?>
    <div class="container-fluid">

        <div class="row">
            <div class="container">
                <div class="row">

                    <div class="col-12">

                        <div class="back"><a href="javascript:history.back();">Back</a></div>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-6 col-xl-6 pad_slider changegallery">
                                <div id="slider" class="flexslider">
                                    <ul class="slides">
<?php
if(!empty($galleryCtrl)) {
    foreach($galleryCtrl as $r) {

?>
                                        <li>
                                            <img src="<?php echo base_url('uploads/product_gallery/'.$r->product_gallery_image);?>" />
                                        </li>
<?php
    }
}
?>
                                    </ul>
                                </div>
                                <div id="carousel" class="flexslider">
                                    <ul class="slides">
<?php
if(!empty($galleryCtrl)) {
    foreach($galleryCtrl as $r) {

?>                        
                                        <li>
                                            <img src="<?php echo base_url('uploads/product_gallery/'.$r->product_gallery_image);?>" />
                                        </li>
<?php
    }
}
?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="box_product_inside">
                                    <h5><?php if(!empty($row)) echo get2Lang($this->session->userdata('lang'), $row->product_description_lang1, $row->product_description_lang2);?></h5>
                                    <h2><?php if(!empty($row)) echo get2Lang($this->session->userdata('lang'), $row->product_name_lang1, $row->product_name_lang2);?> <span id="color_name_"><?php if(!empty($color_name)) echo $color_name;?></h2></h2>
                                    <ul class="ul_box_product_inside">
                                        <li style="padding-left: 0;"><span><?php if(!empty($this->model_frontend->getAvgStar($product_id))) echo number_format($this->model_frontend->getAvgStar($product_id), 1, '.', ',');?></span> 
                                            <?php if(!empty($this->model_frontend->getAvgStar($product_id))) echo getStar($this->model_frontend->getAvgStar($product_id));?> 
                                        </li>
                                        <li><span><?php if(!empty($this->model_frontend->getAvgStar($product_id))) echo number_format($this->model_frontend->getAvgStar($product_id), 1, '.', ',');?> k</span> Ratings</li>
                                        <li style=""><span><?php echo $this->model_frontend->getNoAmount($product_id);?></span> Sold</li>
                                    </ul>
<h4><?php if(!empty($row) and $row->product_before_discount_price_type1 != '0') { ?><span class="product_before_discount_price_type1">KS <?php echo number_format($row->product_before_discount_price_type1, 0, '.', ',');?></span><br><?php } ?> <span class="product_price1">KS <?php if(!empty($row)) echo number_format($row->product_price1, 0, '.', ',');?> </span></h4>
                                    <h6>Product code <span class="product_code"><?php if(!empty($row)) echo $row->product_code;?></span></h6>
                                    <h3>Quantity</h3>
                                    <div class="product-quantity">
                                        <div class="product-quantity-subtract">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <input type="text" id="product-quantity-input" class="product-quantity-input-test" value="1">
                                        </div>
                                        <div class="product-quantity-add">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <h3><?php if(!empty($weightCtrl)) { echo 'Weight'; }?></h3>
                                    <div class="btn-group btn-group-toggle pad_group" data-toggle="buttons">
<?php
if(!empty($weightCtrl)) {
    $i = 0;
    foreach($weightCtrl as $r) {
        if($i == 0) {
            $weight_id = $r->weight_id;
        }
?>
                                        <label class="btn btn-primary <?php if($r->weight_id == $row->weight_id) echo 'active';?>" onclick="changeWeight('<?php echo $r->weight_id;?>');">
                                            <input type="radio" name="weight_id" id="weight_id_<?php echo $r->weight_id;?>" class="weight_id" <?php if($i == 0) echo 'checked';?> value="<?php echo $r->weight_id;?>"> <?php echo get2Lang($this->session->userdata('lang'), $r->weight_name_lang1, $r->weight_name_lang2);?>
                                        </label>
<?php
        $i++;
    }
} else {
    $weight_id = '';
}
?>                                      
                                    </div>
                                </div>
<?php
if(!empty($colorCtrl)) {
    $i = 0;
    foreach($colorCtrl as $r) {
        if($r->color_id == $row->color_id) {
            $color_name = get2Lang($this->session->userdata('lang'), $r->color_name_lang1, $r->color_name_lang2);
        }
        
        $i++;
    }
}

if(!empty($color_name)) {
?>
                                <h3 class="h3ColorName">Color : <span><?php echo $color_name;?></span></h3>
                                <!-- <h6>Standard size: High Shine finish</h6> -->
                                <ul class="ul_color btn-group btn-group-toggle pad_group ulColor" data-toggle="buttons">
<?php
    if(!empty($colorCtrl)) {
        $i = 0;
        foreach($colorCtrl as $r) {
            if($r->color_id == $row->color_id) {
                $color_id = $r->color_id;
                $active = 'active';
                $checked = 'checked';
            } else {
                $active = '';
                $checked = '';
            }
?>
                                    <li>
                                        <label class="btn btn-primary <?php echo $active;?>" style="padding: 2px; border: none;" onclick="changeColor('<?php echo $r->color_id;?>');">
                                        <input type="radio" name="color_id" id="color_id_<?php echo $r->color_id;?>" class="color_id" <?php echo $checked;?> value="<?php echo $r->color_id;?>"> <img src="<?php echo base_url('uploads/color/'.$r->color_image);?>" class="img-fluid">
                                      </label>
                                    </li>
<?php
            $i++;
        }
    }
} else {
    $color_id = '0';
}

if(empty($color_id)) {
    $color_id = 0;
}

$collection = $this->model_frontend->getProductCollectionResult($product_id, $weight_id, $color_id);
if(!empty($collection)) {
    $i = 0;
    foreach($collection as $r) {
        if($r->collection_id == $row->collection_id) {
            $collection_name = get2Lang($this->session->userdata('lang'), $r->collection_name_lang1, $r->collection_name_lang2);
        }

        $i++;
    }
}
?>
                                </ul>
                                <p>&nbsp;</p>
                                <ul class="ul_color btn-group btn-group-toggle pad_group ulCollection" data-toggle="buttons">
<?php
$collection = $this->model_frontend->getProductCollectionResult($product_id, $weight_id, $color_id);
if(!empty($collection)) {
    $i = 0;
    foreach($collection as $r) {
        if($r->collection_id == $row->collection_id) {
            $checked = 'checked';
        } else {
            $checked = '';
        }
?>
                                    <li>
                                        <label class="btn btn-primary <?php if($i == 0) echo 'active';?>" onclick="changeCollection('<?php echo $r->collection_id;?>');">
                                        <input type="radio" name="collection_id" id="collection_id_<?php echo $r->collection_id;?>" value="<?php echo $r->collection_id;?>" class="collection_id" autocomplete="off" <?php echo $checked;?>> <?php echo get2Lang($this->session->userdata('lang'), $r->collection_name_lang1, $r->collection_name_lang2);?>
                                        </label>
                                    </li>
<?php
        $i++;
    }
}
?>
                                </ul>                                    

                                <div class="panel-group pad_panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        
                                                        Property
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body pad_dropdown">
                                                <?php if(!empty($row)) echo get2Lang($this->session->userdata('lang'), $row->product_property_lang1, $row->product_property_lang2);?>
                                                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    Products review
                                                </a>
                                            </h4>
                                        </div>
                                        <form action="" method="post" enctype="multipart/form-data" onsubmit="return checkReviewForm();">
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body box_review">
                                                <h5>Review</h5>
                                                <h6>Leave your comment</h6>
                                                <h4>Give your rating</h4>
                                                <span class="center">
                                                    <fieldset class="rating">
                                                        <input type="radio" id="star5" name="review_star" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                        
                                                        <input type="radio" id="star4" name="review_star" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                        
                                                        <input type="radio" id="star3" name="review_star" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                        
                                                        <input type="radio" id="star2" name="review_star" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                        
                                                        <input type="radio" id="star1" name="review_star" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                        
                                                    </fieldset>
                                                </span>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <input type="text" class="form-login" placeholder="Name" name="review_name" id="review_name">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <input type="text" class="form-login" placeholder="Email" name="review_email" id="review_email">
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-login" id="review_message" name="review_message" rows="4" placeholder="Message"></textarea>
                                                    </div>
                                                </div>
                                                <div class="img_review">
                                                    <label class="add-photo-btn"><i class="fa fa-camera" aria-hidden="true"></i> <br>+ Add Picture<br> <span><input type="file" id="myfile" name="review_gallery_file[]" multiple="true"></span></label>
                                                </div>
                                                <button type="submit" name="submit_review" value="review" class="button_review">SEND</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="button_product">
                                    <div class="button_cart"><a href="javascript:void(0);" id="add_to_cart" <?php if(!empty($stockCtrl) and $stockCtrl->product_stock_amount > 0) echo 'onclick="insertCart('.$row->product_id.');"'; else echo 'onclick="alert(\'Out Of Stock\');"';?>><img src="<?php echo base_frontend('images/shopping_white.png');?>" class="img-fluid">Add to Cart</a></div>
                                    <div class="button_buynow"><a href="javascript:void(0);" id="buy_now" <?php if(!empty($stockCtrl) and $stockCtrl->product_stock_amount > 0) echo 'onclick="insertCartBuyNow('.$row->product_id.')"'; else echo 'onclick="alert(\'Out Of Stock\');"';?>><img src="<?php echo base_frontend('images/shopping_white.png');?>" class="img-fluid">Buy Now</a></div>
                                    <div class="button_wishlist"><a href="javascript:wishlist('<?php echo $product_id;?>');" class="aWishlist_<?php if(!empty($row)) echo $product_id;?>">
<?php
        $select_wishlist = $this->model_frontend->getWishlistColor($product_id);
        if(!empty($select_wishlist)) {
?>
                                            <img src="<?php echo base_frontend('images/icon_heart_color.jpg');?>" id="wishlist_<?php echo $product_id;?>" class="img-fluid" onclick="wishlist('<?php echo $product_id;?>');">
<?php
        } else {
?>
                                            <img src="<?php echo base_frontend('images/icon_heart.jpg');?>" id="wishlist_<?php echo $product_id;?>" class="img-fluid" onclick="wishlist('<?php echo $product_id;?>');">
<?php            
        }
?>
                                    </a></div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="alsolike">
                                    <h4>You may also like</h4>
                                </div>
                                <div class="pad_newproducts">
                                    <div class="owl-one owl-carousel owl-theme">
<?php
if(!empty($youMayAlsoLikeCtrl)) {
    foreach($youMayAlsoLikeCtrl as $r) {

?>                            
                                        <div class="item">
                                            <div class="box_products">
                                                <div class="img_products">

                                                    <div class="img_product">
                                                        <a href="<?php echo site_url('frontend/path/product_inside/'.$r->product_id);?>">
                                    <img src="<?php echo base_url('uploads/product/'.$r->product_image);?>" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="javascript:wishlist('<?php echo $r->product_id;?>');" class="icon_search">
                                            <img src="<?php echo base_frontend('images/icon_heart.jpg');?>" class="img-fluid">
                                        </a>
                                                        <a href="<?php echo site_url('frontend/path/product_inside/'.$r->product_id);?>" class="icon_readmore">
                                                            <div>Readmore</div>
                                                        </a>
<?php
        if($r->product_stock_amount > 0) {
?>
                                                        <a href="javascript:insertCart('<?php echo $r->product_id;?>');" class="icon_shopping">
<?php
        } else {
?>
                                                        <a href="javascript:alert('Out Of Stock');" class="icon_shopping">
<?php
        }
?>
                                            <img src="<?php echo base_frontend('images/icon_shopping.png');?>" class="img-fluid">
                                        </a>
                                                    </div>
                                                    </a>
                                                </div>

                                                <h4><?php echo get2Lang($this->session->userdata('lang'), $r->product_name_lang1, $r->product_name_lang2);?></h4>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5><?php if($r->product_before_discount_price_type1 != 0 or $r->product_before_discount_price_type1 != $r->product_price1) { ?><span>KS <?php echo number_format($r->product_before_discount_price_type1, 2, '.', ',');?></span><br><?php } ?> KS <?php echo number_format($r->product_price1, 2, '.', ',');?></h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h6><?php if(!empty($this->model_frontend->getAvgStar($r->product_id))) echo getStar($this->model_frontend->getAvgStar($r->product_id));?> </h6>
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
    <div class="col-12">
        <div class="alsolike">
            <h4>Product rating</h4>
        </div>
        <div class="row box_reviews">
            <div class="col-12 col-md-2">
                <div class="star_reviews">
                    <h4><?php if(!empty($this->model_frontend->getAverageStar($product_id))) echo number_format($this->model_frontend->getAverageStar($product_id), 1, '.', ','); else echo 0;?>/5</h4>
                    <h6>
<?php
$star_pink = floor($this->model_frontend->getAverageStar($product_id));
$star_gray = 5 - $star_pink;

if(!empty($star_pink)) {
    for($i = 1; $i <= $star_pink; $i++) {
?>
        <i class="fa fa-star" aria-hidden="true"></i>
<?php
    }
}

if(!empty($star_gray)) {
    for($i = 1; $i <= $star_gray; $i++) {
?>
        <span><i class="fa fa-star" aria-hidden="true"></i></span>
<?php
    }   
}
?>
                    </h6>
                </div>
            </div>
            <div class="col-12 col-md-10 pad_tab_reviews">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#allreviews">All </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#fivestar">5 Star (<?php echo $this->model_frontend->getStar5($product_id);?>)  </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#fourstar">4 Star (<?php echo $this->model_frontend->getStar4($product_id);?>) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#threestar">3 Star (<?php echo $this->model_frontend->getStar3($product_id);?>) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#twostar">2 Star (<?php echo $this->model_frontend->getStar2($product_id);?>) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#onestar">1 Star (<?php echo $this->model_frontend->getStar1($product_id);?>) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#reviews">Reviews (<?php echo $this->model_frontend->getReview($product_id);?>) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#picture">Picture (<?php echo $this->model_frontend->getReviewImageGallery($product_id);?>) </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="allreviews" class="tab-pane active">
<?php
$reviewAll = $this->model_frontend->getReviewAll($product_id);
if(!empty($reviewAll)) {
    foreach($reviewAll as $r) {
?>
                <div class="row text_reviews">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="<?php echo base_frontend('images/img_member.jpg');?>" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5><?php echo $r->review_name;?></h5>
                            <h6>
<?php
        $star_pink = $r->review_star;
        $star_gray = 5 - $star_pink;

        if(!empty($star_pink)) {
            for($i = 1; $i <= $star_pink; $i++) {
?>
                                <i class="fa fa-star" aria-hidden="true"></i>
<?php
            }
        }

        if(!empty($star_gray)) {
            for($i = 1; $i <= $star_gray; $i++) {
?>
                                <span><i class="fa fa-star" aria-hidden="true"></i></span>
<?php
            }
        }
?>
                            </h6>
                            <h3>Category : <span><?php if(!empty($this->model_frontend->getCategory1($product_id))) echo $this->model_frontend->getCategory1($product_id);?></span></h3>
                            <h4><?php echo $r->review_message;?></h4>
<?php
        $gallery = $this->model_frontend->getReviewGallery($r->review_id);
        if(!empty($gallery)) {
            foreach($gallery as $g) {

?>
                            <img src="<?php echo base_url('uploads/review/'.$g->review_gallery_file);?>" class="img-fluid">
<?php

            }
        }   
?>
                            <p><?php echo $r->review_datetime_create;?></p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
<?php
    }
}

/*
?>
                <div class="row text_reviews" style="border: none;">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="<?php echo base_frontend('images/img_member.jpg');?>" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5>S*****t</h5>
                            <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                            <h3>Category : <span>Make Up</span></h3>
                            <h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
                            <img src="<?php echo base_frontend('images/img_review_1.jpg');?>" class="img-fluid"> <img src="<?php echo base_frontend('images/img_review_2.jpg');?>" class="img-fluid"> <img src="<?php echo base_frontend('images/img_review_3.jpg');?>" class="img-fluid"> <img src="<?php echo base_frontend('images/img_review_4.jpg');?>" class="img-fluid">
                            <p>2020-03-05 22:05</p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
*/
?>
            </div>
            <div id="fivestar" class="tab-pane fade">
<?php
$review5 = $this->model_frontend->getReviewStar5($product_id);
if(!empty($review5)) {
    foreach($review5 as $r) {
?>
                <div class="row text_reviews">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="<?php echo base_frontend('images/img_member.jpg');?>" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5><?php echo $r->review_name;?></h5>
                            <h6>
<?php
        $star_pink = $r->review_star;
        $star_gray = 5 - $star_pink;

        if(!empty($star_pink)) {
            for($i = 1; $i <= $star_pink; $i++) {
?>
                                <i class="fa fa-star" aria-hidden="true"></i>
<?php
            }
        }

        if(!empty($star_gray)) {
            for($i = 1; $i <= $star_gray; $i++) {
?>
                                <span><i class="fa fa-star" aria-hidden="true"></i></span>
<?php
            }
        }
?>
                            </h6>
                            <h3>Category : <span><?php if(!empty($this->model_frontend->getCategory1($product_id))) echo $this->model_frontend->getCategory1($product_id);?></span></h3>
                            <h4><?php echo $r->review_message;?></h4>
<?php
        $gallery = $this->model_frontend->getReviewGallery($r->review_id);
        if(!empty($gallery)) {
            foreach($gallery as $g) {

?>
                            <img src="<?php echo base_url('uploads/review/'.$g->review_gallery_file);?>" class="img-fluid">
<?php

            }
        }   
?>
                            <p><?php echo $r->review_datetime_create;?></p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
<?php
    }
}
?>
            </div>

            <div id="fourstar" class="tab-pane fade">
<?php
$review4 = $this->model_frontend->getReviewStar4($product_id);
if(!empty($review4)) {
    foreach($review4 as $r) {
?>
                <div class="row text_reviews">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="<?php echo base_frontend('images/img_member.jpg');?>" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5><?php echo $r->review_name;?></h5>
                            <h6>
<?php
        $star_pink = $r->review_star;
        $star_gray = 5 - $star_pink;

        if(!empty($star_pink)) {
            for($i = 1; $i <= $star_pink; $i++) {
?>
                                <i class="fa fa-star" aria-hidden="true"></i>
<?php
            }
        }

        if(!empty($star_gray)) {
            for($i = 1; $i <= $star_gray; $i++) {
?>
                                <span><i class="fa fa-star" aria-hidden="true"></i></span>
<?php
            }
        }
?>
                            </h6>
                            <h3>Category : <span><?php if(!empty($this->model_frontend->getCategory1($product_id))) echo $this->model_frontend->getCategory1($product_id);?></span></h3>
                            <h4><?php echo $r->review_message;?></h4>
<?php
        $gallery = $this->model_frontend->getReviewGallery($r->review_id);
        if(!empty($gallery)) {
            foreach($gallery as $g) {

?>
                            <img src="<?php echo base_url('uploads/review/'.$g->review_gallery_file);?>" class="img-fluid">
<?php

            }
        }   
?>
                            <p><?php echo $r->review_datetime_create;?></p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
<?php
    }
}
?>
            </div>
            <div id="threestar" class="tab-pane fade">
<?php
$review3 = $this->model_frontend->getReviewStar3($product_id);
if(!empty($review3)) {
    foreach($review3 as $r) {
?>
                <div class="row text_reviews">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="<?php echo base_frontend('images/img_member.jpg');?>" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5><?php echo $r->review_name;?></h5>
                            <h6>
<?php
        $star_pink = $r->review_star;
        $star_gray = 5 - $star_pink;

        if(!empty($star_pink)) {
            for($i = 1; $i <= $star_pink; $i++) {
?>
                                <i class="fa fa-star" aria-hidden="true"></i>
<?php
            }
        }

        if(!empty($star_gray)) {
            for($i = 1; $i <= $star_gray; $i++) {
?>
                                <span><i class="fa fa-star" aria-hidden="true"></i></span>
<?php
            }
        }
?>
                            </h6>
                            <h3>Category : <span><?php if(!empty($this->model_frontend->getCategory1($product_id))) echo $this->model_frontend->getCategory1($product_id);?></span></h3>
                            <h4><?php echo $r->review_message;?></h4>
<?php
        $gallery = $this->model_frontend->getReviewGallery($r->review_id);
        if(!empty($gallery)) {
            foreach($gallery as $g) {

?>
                            <img src="<?php echo base_url('uploads/review/'.$g->review_gallery_file);?>" class="img-fluid">
<?php

            }
        }   
?>
                            <p><?php echo $r->review_datetime_create;?></p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
<?php
    }
}
?>
            </div>

            <div id="twostar" class="tab-pane fade">
<?php
$review2 = $this->model_frontend->getReviewStar2($product_id);
if(!empty($review2)) {
    foreach($review2 as $r) {
?>
                <div class="row text_reviews">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="<?php echo base_frontend('images/img_member.jpg');?>" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5><?php echo $r->review_name;?></h5>
                            <h6>
<?php
        $star_pink = $r->review_star;
        $star_gray = 5 - $star_pink;

        if(!empty($star_pink)) {
            for($i = 1; $i <= $star_pink; $i++) {
?>
                                <i class="fa fa-star" aria-hidden="true"></i>
<?php
            }
        }

        if(!empty($star_gray)) {
            for($i = 1; $i <= $star_gray; $i++) {
?>
                                <span><i class="fa fa-star" aria-hidden="true"></i></span>
<?php
            }
        }
?>
                            </h6>
                            <h3>Category : <span><?php if(!empty($this->model_frontend->getCategory1($product_id))) echo $this->model_frontend->getCategory1($product_id);?></span></h3>
                            <h4><?php echo $r->review_message;?></h4>
<?php
        $gallery = $this->model_frontend->getReviewGallery($r->review_id);
        if(!empty($gallery)) {
            foreach($gallery as $g) {

?>
                            <img src="<?php echo base_url('uploads/review/'.$g->review_gallery_file);?>" class="img-fluid">
<?php

            }
        }   
?>
                            <p><?php echo $r->review_datetime_create;?></p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
<?php
    }
}
?>
            </div>

            <div id="onestar" class="tab-pane fade">
<?php
$review1 = $this->model_frontend->getReviewStar1($product_id);
if(!empty($review1)) {
    foreach($review1 as $r) {
?>
                <div class="row text_reviews">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="<?php echo base_frontend('images/img_member.jpg');?>" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5><?php echo $r->review_name;?></h5>
                            <h6>
<?php
        $star_pink = $r->review_star;
        $star_gray = 5 - $star_pink;

        if(!empty($star_pink)) {
            for($i = 1; $i <= $star_pink; $i++) {
?>
                                <i class="fa fa-star" aria-hidden="true"></i>
<?php
            }
        }

        if(!empty($star_gray)) {
            for($i = 1; $i <= $star_gray; $i++) {
?>
                                <span><i class="fa fa-star" aria-hidden="true"></i></span>
<?php
            }
        }
?>
                            </h6>
                            <h3>Category : <span><?php if(!empty($this->model_frontend->getCategory1($product_id))) echo $this->model_frontend->getCategory1($product_id);?></span></h3>
                            <h4><?php echo $r->review_message;?></h4>
<?php
        $gallery = $this->model_frontend->getReviewGallery($r->review_id);
        if(!empty($gallery)) {
            foreach($gallery as $g) {

?>
                            <img src="<?php echo base_url('uploads/review/'.$g->review_gallery_file);?>" class="img-fluid">
<?php

            }
        }   
?>
                            <p><?php echo $r->review_datetime_create;?></p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
<?php
    }
}
?>
            </div>

            <div id="reviews" class="tab-pane fade">
<?php
$reviewAll = $this->model_frontend->getReviewAll($product_id);
if(!empty($reviewAll)) {
    foreach($reviewAll as $r) {
?>
                <div class="row text_reviews">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="<?php echo base_frontend('images/img_member.jpg');?>" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5><?php echo $r->review_name;?></h5>
                            <h6>
<?php
        $star_pink = $r->review_star;
        $star_gray = 5 - $star_pink;

        if(!empty($star_pink)) {
            for($i = 1; $i <= $star_pink; $i++) {
?>
                                <i class="fa fa-star" aria-hidden="true"></i>
<?php
            }
        }

        if(!empty($star_gray)) {
            for($i = 1; $i <= $star_gray; $i++) {
?>
                                <span><i class="fa fa-star" aria-hidden="true"></i></span>
<?php
            }
        }
?>
                            </h6>
                            <h3>Category : <span><?php if(!empty($this->model_frontend->getCategory1($product_id))) echo $this->model_frontend->getCategory1($product_id);?></span></h3>
                            <h4><?php echo $r->review_message;?></h4>
<?php
        $gallery = $this->model_frontend->getReviewGallery($r->review_id);
        if(!empty($gallery)) {
            foreach($gallery as $g) {

?>
                            <img src="<?php echo base_url('uploads/review/'.$g->review_gallery_file);?>" class="img-fluid">
<?php

            }
        }   
?>
                            <p><?php echo $r->review_datetime_create;?></p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
<?php
    }
}
?>
            </div>
            <div id="picture" class="tab-pane fade" style="padding-right: 10px; padding-bottom: 10px; padding-left: 10px; padding-top: 10px;">
<?php
if(!empty($this->model_frontend->getReviewGalleryResult($product_id))) {
    foreach($this->model_frontend->getReviewGalleryResult($product_id) as $r) {
?>
                <img src="<?php echo site_url('uploads/review/'.$r->review_gallery_file);?>" width="150">&nbsp;
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
    </div>
    </div>
    
    <?php require('inc_footer.php'); ?>
    </div>
    <script>
        $(window).on("load", function() {
            // The slider being synced must be initialized first
            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 110,
                itemMargin: 5,
                asNavFor: '#slider'
            });

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel"
            });
        });
    </script>
    <script>
        function toggleIcon(e) {
            $(e.target)
                .prev('.panel-heading')
                .find(".more-less")
                .toggleClass('glyphicon-plus glyphicon-minus');
        }
        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
        $('.panel-group').on('shown.bs.collapse', toggleIcon);
    </script>
    <script>
        //Reduce quantity by 1 if clicked
        $(document).on("click", ".product-quantity-subtract", function(e) {
            // var value = $("#product-quantity-input").val();
            // //console.log(value);
            // var newValue = parseInt(value) - 1;
            // if (newValue < 0) newValue = 0;
            // $("#product-quantity-input").val(newValue);
            // //CalcPrice(newValue);

            var value = $(".product-quantity-input-test").val();
            //console.log(value);
            var newValue = parseInt(value) - 1;
            if (newValue < 0) newValue = 0;
            $(".product-quantity-input-test").val(newValue);
        });

        //Increase quantity by 1 if clicked
        $(document).on("click", ".product-quantity-add", function() {
            
            var value = $(".product-quantity-input-test").val();
            //console.log(value);
            var newValue = parseInt(value) + 1;
            $(".product-quantity-input-test").val(newValue);
            // document.getElementById('product-quantity-input').value = newValue;

            // //alert($("#product-quantity-input").val());
            // //CalcPrice(newValue);
        });

        $(document).on("blur", "#product-quantity-input", function(e) {
            var value = $("#product-quantity-input").val();
            //console.log(value);
            //CalcPrice(value);
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
    </script>
    <script src="<?php echo base_frontend('OwlCarousel2-2.3.4/dist/owl.carousel.min.js');?>"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.owl-one').owlCarousel({
                loop: true,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                smartSpeed: 1000,
                nav: true,
                dots: false,
                navText: ['&nbsp;', '&nbsp;'],
                responsive: {
                    0: {
                        items: 2,
                        margin: 15,
                    },
                    640: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });

        });

        var weight_id_ = '';
        var color_id_ = '';
        var collection_id_ = '';

        function changeWeight(weight_id_click) {
            $("#weight_id_" + weight_id_click).prop(":checked", true);

            var weight_id = $("#weight_id_" + weight_id_click + ":checked").val();
            
            if(weight_id == undefined) {
                weight_id = weight_id_click;
            }

            weight_id_ = weight_id;

            $.post('<?php echo site_url('frontend/path/ajaxGallery');?>', { product_id: '<?php echo $product_id;?>', weight_id: weight_id }, function(data) {
                var data_split = data.split('!@#$%^&*()');

                $(".h3ColorName").html(data_split[0]);

                $(".ulColor").html(data_split[1]);

                $(".ulCollection").html(data_split[2]);

                $(".changegallery").html(data_split[3]);

                $(".product_before_discount_price_type1").html(data_split[4]);

                $(".product_price1").html(data_split[5]);

                $(".product_code").html(data_split[6]);

                $('#carousel').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    itemWidth: 110,
                    itemMargin: 5,
                    asNavFor: '#slider'
                });

                $('#slider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    sync: "#carousel"
                });
            });
        }

        function changeColor(color_id_click) {
            color_id_ = color_id_click;

            $.post('<?php echo site_url('frontend/path/ajaxGalleryColor');?>', { product_id: '<?php echo $product_id;?>', weight_id: $("input[name=weight_id]:checked").val(), color_id: color_id_ }, function(data) {

                //alert(color_id_);

                var data_split = data.split('!@#$%^&*()');

                $(".h3ColorName").html(data_split[0]);

                //$(".ulColor").html(data_split[1]);

                $(".ulCollection").html(data_split[2]);

                $(".changegallery").html(data_split[3]);

                $(".product_before_discount_price_type1").html(data_split[4]);

                $(".product_price1").html(data_split[5]);

                $(".product_code").html(data_split[6]);

                $("#color_name_").html(data_split[8]);

                $('#carousel').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    itemWidth: 110,
                    itemMargin: 5,
                    asNavFor: '#slider'
                });

                $('#slider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    sync: "#carousel"
                });
            });
        }

        function changeCollection(collection_id_click) {

            $.post('<?php echo site_url("frontend/path/ajaxGalleryCollection");?>', { product_id: '<?php echo $product_id;?>', weight_id: $("input[name=weight_id]:checked").val(), color_id: $("input[name=color_id]:checked").val(), collection_id: $("input[name=collection_id]:checked").val() }, function(data) {

                var data_split = data.split('!@#$%^&*()');

                //$(".h3ColorName").html(data_split[0]);

                //$(".ulColor").html(data_split[1]);

                //$(".ulCollection").html(data_split[2]);

                $(".changegallery").html(data_split[3]);

                $(".product_before_discount_price_type1").html(data_split[4]);

                $(".product_price1").html(data_split[5]);

                $(".product_code").html(data_split[6]);

                $('#carousel').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    itemWidth: 110,
                    itemMargin: 5,
                    asNavFor: '#slider'
                });

                $('#slider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    sync: "#carousel"
                });
            });
        }

        function insertCart(product_id) {

            var product_id = '<?php echo $product_id;?>';

            var weight_id = $("input[name='weight_id']:checked").val();

            if(weight_id == undefined) {
                weight_id = 0;
            }

            var color_id = $("input[name='color_id']:checked").val();

            if(color_id == undefined) {
                color_id = 0;
            }

            var collection_id = $("input[name='collection_id']:checked").val();

            if(collection_id == undefined) {
                collection_id = 0;
            }

            $.post('<?php echo site_url("frontend/path/ajaxInsertCart");?>', { product_id: product_id, qty: $(".product-quantity-input-test").val(), weight_id: weight_id, color_id: color_id, collection_id: collection_id }, function(data) {
                var data_split = data.split('!@#$%^&*()');

                $(".cart_no").html(data_split[0]);
                $(".sub_total").html(addCommas(data_split[1]));
                $(".discount").html(addCommas(data_split[2]));
                $(".total").html(addCommas(data_split[4]));
                $(".cart1").html(data_split[5]);
                $(".cart_right_tab").html(data_split[6]);
            });
        }

        function insertCartBuyNow(product_id) {
            var product_id = '<?php echo $product_id;?>';

            var weight_id = $("input[name='weight_id']:checked").val();

            if(weight_id == undefined) {
                weight_id = 0;
            }

            var color_id = $("input[name='color_id']:checked").val();

            if(color_id == undefined) {
                color_id = 0;
            }

            var collection_id = $("input[name='collection_id']:checked").val();

            if(collection_id == undefined) {
                collection_id = 0;
            }

            $.post('<?php echo site_url("frontend/path/ajaxInsertCart");?>', { product_id: product_id, qty: $("#product-quantity-input").val(), weight_id: weight_id, color_id: color_id, collection_id: collection_id }, function(data) {
                var data_split = data.split('!@#$%^&*()');

                var data_split = data.split('!@#$%^&*()');

                $(".cart_no").html(data_split[0]);
                $(".sub_total").html(addCommas(data_split[1]));
                $(".discount").html(addCommas(data_split[2]));
                $(".total").html(addCommas(data_split[4]));
                $(".cart1").html(data_split[5]);
                $(".cart_right_tab").html(data_split[6]);

                window.location.href = '<?php echo site_url("frontend/path/shippingaddress");?>';
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

        function checkReviewForm() {
            if($("#star1").is(':checked') == false && $("#star2").is(':checked') == false && $("#star3").is(':checked') == false && $("#star4").is(':checked') == false && $("#star5").is(':checked') == false) {
                alert('Please Select Star');

                $("#star5").focus();

                return false;
            } else if($("#review_name").val() == '') {
                alert('Please enter Name');

                $("#review_name").focus();

                return false;
            } else if($("#review_email").val() == '') {
                alert('Please enter Email');

                $("#review_email").focus();

                return false;
            } else if(!isEmail($("#review_email").val())) {
                alert('Invalid Email');

                $("#review_email").val('');

                $("#review_email").focus();

                return false;
            } else if($("#review_message").val() == '') {
                alert('Please enter Message');

                $("#review_message").focus();

                return false;
            } else {
                return true;
            }
        }

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
    </script>

</body>

</html>