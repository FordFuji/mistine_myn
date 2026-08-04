<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css" />

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
        background-image: url(images/owl-prev.png);
    }
    
    .owl-one.owl-carousel .owl-nav button.owl-next {
        background-image: url(images/owl-next.png);
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
</style>

<body>
    <?php require('inc_menu.php'); ?>
    <div class="container-fluid">

        <div class="row">
            <div class="container">
                <div class="row">

                    <div class="col-12">

                        <div class="back"><a href="products.php">Back</a></div>
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-6 col-xl-6 pad_slider">
                                <div id="slider" class="flexslider">
                                    <ul class="slides">
                                        <li>
                                            <img src="images/product/product2.jpg" />
                                        </li>
                                        <li>
                                            <img src="images/product/product2.jpg" />
                                        </li>
                                        <li>
                                            <img src="images/product/product2.jpg" />
                                        </li>
                                    </ul>
                                </div>
                                <div id="carousel" class="flexslider">
                                    <ul class="slides">
                                        <li>
                                            <img src="images/product/product2.jpg" />
                                        </li>
                                        <li>
                                            <img src="images/product/product2.jpg" />
                                        </li>
                                        <li>
                                            <img src="images/product/product2.jpg" />
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="box_product_inside">
                                    <h5>Mystin XB.Duck Sunscreen Facial Care SPF 50 PA +++</h5>
                                    <h2>Mystic Tin B. Duck</h2>
                                    <ul class="ul_box_product_inside">
                                        <li style="padding-left: 0;"><span>4.6</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span>
                                        </li>
                                        <li><span>2.8 k</span> Ratings</li>
                                        <li style=""><span>13.8 k</span> Sold</li>
                                    </ul>
                                    <h4><span>$200</span> $159</h4>
                                    <h6>Product code #00001</h6>
                                    <h3>Quantity</h3>
                                    <div class="product-quantity">
                                        <div class="product-quantity-subtract">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <input type="text" id="product-quantity-input" placeholder="0" value="0">
                                        </div>
                                        <div class="product-quantity-add">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <h3>Weight</h3>
                                    <div class="btn-group btn-group-toggle pad_group" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                        <input type="radio" name="options" id="option1" autocomplete="off" checked=""> 250 ml
                                      </label>
                                        <label class="btn btn-primary">
                                        <input type="radio" name="options" id="option2" autocomplete="off"> 200 ml
                                      </label>
                                        <label class="btn btn-primary">
                                        <input type="radio" name="options" id="option3" autocomplete="off"> 150 ml
                                      </label>
                                    </div>
                                    
                                    <h3>Color : <span>Clear</span></h3>
                                    <h6>Standard size: High Shine finish</h6>
                                    <ul class="ul_color btn-group btn-group-toggle pad_group" data-toggle="buttons">
                                        <li>
                                            <label class="btn btn-primary active" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/1.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/2.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/3.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/4.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/5.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/6.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/7.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/8.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/1.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/1.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/1.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/1.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/1.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/1.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                        <li>
                                            <label class="btn btn-primary" style="padding: 2px; border: none;">
                                            <input type="radio" name="options" id="option1" autocomplete="off" checked=""> <img src="images/color/1.jpg" class="img-fluid">
                                          </label>
                                        </li>
                                    </ul>
                                    
                                </div>
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
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
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
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body box_review">
                                                <h5>Review</h5>
                                                <h6>Leave your comment</h6>
                                                <h4>Give your rating</h4>
                                                <p><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></p>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <input type="email" class="form-login" placeholder="Name">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <input type="email" class="form-login" placeholder="Email">
                                                    </div>
                                                    <div class="col-12">
                                                        <textarea class="form-login" id="exampleTextarea" rows="4" placeholder="Message"></textarea>
                                                    </div>
                                                </div>
                                                <div class="img_review">
                                                    <label class="add-photo-btn"><i class="fa fa-camera" aria-hidden="true"></i> <br>+ Add Picture<br> <span><input type="file" id="myfile" name="myfile"></span></label>
                                                </div>
                                                <button type="button" class="button_review">SEND</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button_product">
                                    <div class="button_cart"><a href=""><img src="images/shopping_white.png" class="img-fluid">Add to Cart</a></div>
                                    <div class="button_buynow"><a href="shippingaddress.php"><img src="images/shopping_white.png" class="img-fluid">Buy Now</a></div>
                                    <div class="button_wishlist"><a href="member4.php"><img src="images/icon_heart.jpg" class="img-fluid"></a></div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="alsolike">
                                    <h4>You may also like</h4>
                                </div>
                                <div class="pad_newproducts">
                                    <div class="owl-one owl-carousel owl-theme">
                                        <div class="item">
                                            <div class="box_products">
                                                <div class="img_products">

                                                    <div class="img_product">
                                                        <a href="product_inside.php">
                                    <img src="images/product/product1.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="" class="icon_search">
                                            <img src="images/icon_heart.jpg" class="img-fluid">
                                        </a>
                                                        <a href="product_inside.php" class="icon_readmore">
                                                            <div>Readmore</div>
                                                        </a>
                                                        <a href="" class="icon_shopping">
                                            <img src="images/icon_shopping.png" class="img-fluid">
                                        </a>
                                                    </div>
                                                    </a>
                                                </div>

                                                <h4>Mystin XB.Duck Sunscreen Facial Care SPF</h4>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5><span>$200</span> $159</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="box_products">
                                            <div class="img_products">

                                                <div class="img_product">
                                                    <a href="product_inside.php">
                                    <img src="images/product/product2.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="" class="icon_search">
                                            <img src="images/icon_heart.jpg" class="img-fluid">
                                        </a>
                                                    <a href="product_inside.php" class="icon_readmore">
                                                        <div>Readmore</div>
                                                    </a>
                                                    <a href="" class="icon_shopping">
                                            <img src="images/icon_shopping.png" class="img-fluid">
                                        </a>
                                                </div>
                                                </a>
                                            </div>

                                            <h4>Mystin XB.Duck Sunscreen Facial Care SPF</h4>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5><span>$200</span> $159</h5>
                                                </div>
                                                <div class="col-6">
                                                    <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="box_products">
                                        <div class="img_products">

                                            <div class="img_product">
                                                <a href="product_inside.php">
                                    <img src="images/product/product3.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="" class="icon_search">
                                            <img src="images/icon_heart.jpg" class="img-fluid">
                                        </a>
                                                <a href="product_inside.php" class="icon_readmore">
                                                    <div>Readmore</div>
                                                </a>
                                                <a href="" class="icon_shopping">
                                            <img src="images/icon_shopping.png" class="img-fluid">
                                        </a>
                                            </div>
                                            </a>
                                        </div>

                                        <h4>Mystin XB.Duck Sunscreen Facial Care SPF</h4>
                                        <div class="row">
                                            <div class="col-6">
                                                <h5><span>$200</span> $159</h5>
                                            </div>
                                            <div class="col-6">
                                                <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="box_products">
                                    <div class="img_products">
                                        <div class="new">NEW!<span></span></div>

                                        <div class="img_product">
                                            <a href="product_inside.php">
                                    <img src="images/product/product4.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="" class="icon_search">
                                            <img src="images/icon_heart.jpg" class="img-fluid">
                                        </a>
                                            <a href="" class="icon_readmore">
                                                <div>Readmore</div>
                                            </a>
                                            <a href="" class="icon_shopping">
                                            <img src="images/icon_shopping.png" class="img-fluid">
                                        </a>
                                        </div>
                                        </a>
                                    </div>

                                    <h4>Mystin XB.Duck Sunscreen Facial Care SPF</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <h5><span>$200</span> $159</h5>
                                        </div>
                                        <div class="col-6">
                                            <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="box_products">
                                <div class="img_products">
                                    <div class="new">NEW!<span></span></div>

                                    <div class="img_product">
                                        <a href="product_inside.php">
                                    <img src="images/product/product5.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="" class="icon_search">
                                            <img src="images/icon_heart.jpg" class="img-fluid">
                                        </a>
                                        <a href="" class="icon_readmore">
                                            <div>Readmore</div>
                                        </a>
                                        <a href="" class="icon_shopping">
                                            <img src="images/icon_shopping.png" class="img-fluid">
                                        </a>
                                    </div>
                                    </a>
                                </div>

                                <h4>Mystin XB.Duck Sunscreen Facial Care SPF</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <h5><span>$200</span> $159</h5>
                                    </div>
                                    <div class="col-6">
                                        <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="box_products">
                            <div class="img_products">
                                <div class="new">NEW!<span></span></div>

                                <div class="img_product">
                                    <a href="product_inside.php">
                                    <img src="images/product/product6.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="" class="icon_search">
                                            <img src="images/icon_heart.jpg" class="img-fluid">
                                        </a>
                                    <a href="" class="icon_readmore">
                                        <div>Readmore</div>
                                    </a>
                                    <a href="" class="icon_shopping">
                                            <img src="images/icon_shopping.png" class="img-fluid">
                                        </a>
                                </div>
                                </a>
                            </div>

                            <h4>Mystin XB.Duck Sunscreen Facial Care SPF</h4>
                            <div class="row">
                                <div class="col-6">
                                    <h5><span>$200</span> $159</h5>
                                </div>
                                <div class="col-6">
                                    <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
                    <h4>4.6/5</h4>
                    <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                </div>
            </div>
            <div class="col-12 col-md-10 pad_tab_reviews">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#allreviews">All </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#fourstar">5 Star (1.2k)  </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#fourstar">4 Star (102) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#threestar">3 Star (2) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#twostar">2 Star (102) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#onestar">1 Star (10) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#reviews">Reviews (2) </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#picture">Picture (22) </a>
                    </li>
                </ul>


            </div>
        </div>
        <div class="tab-content">
            <div id="allreviews" class="tab-pane active">
                <div class="row text_reviews">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="images/img_member.jpg" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5>S*****t</h5>
                            <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                            <h3>Category : <span>Make Up</span></h3>
                            <h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
                            <img src="images/img_review_1.jpg" class="img-fluid"> <img src="images/img_review_2.jpg" class="img-fluid"> <img src="images/img_review_3.jpg" class="img-fluid"> <img src="images/img_review_4.jpg" class="img-fluid">
                            <p>2020-03-05 22:05</p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
                <div class="row text_reviews" style="border: none;">
                    <div class="col-md-2 col-lg-2 col-xl-1">
                        <div class="img_member_reviews"><img src="images/img_member.jpg" class="img-fluid"></div>
                    </div>
                    <div class="col-md-10 col-lg-10 col-xl-11">
                        <div class="text_member_reviewstext">
                            <h5>S*****t</h5>
                            <h6><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span><i class="fa fa-star" aria-hidden="true"></i></span></h6>
                            <h3>Category : <span>Make Up</span></h3>
                            <h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
                            <img src="images/img_review_1.jpg" class="img-fluid"> <img src="images/img_review_2.jpg" class="img-fluid"> <img src="images/img_review_3.jpg" class="img-fluid"> <img src="images/img_review_4.jpg" class="img-fluid">
                            <p>2020-03-05 22:05</p>
                            <h2><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> 1</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div id="fourstar" class="tab-pane fade">5 Star (1.2k)</div>
            <div id="fourstar" class="tab-pane fade">4 Star (102)</div>
            <div id="threestar" class="tab-pane fade">3 Star (2)</div>
            <div id="twostar" class="tab-pane fade">2 Star (102)</div>
            <div id="onestar" class="tab-pane fade">1 Star (10)</div>
            <div id="reviews" class="tab-pane fade">Reviews (2)</div>
            <div id="picture" class="tab-pane fade">Picture (22)</div>
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
        });

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
    </script>
    <script src="OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>

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
    </script>

</body>

</html>