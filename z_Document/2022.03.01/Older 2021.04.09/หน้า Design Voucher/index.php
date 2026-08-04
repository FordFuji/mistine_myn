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
    .owl-two.owl-carousel .owl-nav button.owl-prev {
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

    .owl-two.owl-carousel .owl-nav button.owl-next {
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

    .wrap_slidecaption {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        text-align: center;
        -ms-transform: translate( 0, -50%);
        /* IE 9 */
        -webkit-transform: translate( 0, -50%);
        /* Safari */
        transform: translate( 0, -50%);
    }

    .flexslider-container,
    .flexslider .slides,
    .flex-viewport {
        height: 100%;
    }
    #flexslider_product .flex-control-paging li a.flex-active {
        background: #ec008c;
        width: 10px;
        height: 10px;
        line-height: 26px;
        box-shadow: none;
    }
    #flexslider_product .flex-control-nav {
        bottom: -40px;
    }
    #flexslider_product .flex-control-paging li a {
        width: 10px;
        height: 10px;
        background: none;
        line-height: 26px;
        box-shadow: none;
        border: 1.5px solid #ec008c;
    }
    .flexslider .slides>li {
        background-position: center;
        height: 100%;
        width: 100%;
        display: none;
        -webkit-backface-visibility: hidden;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        position: relative;
    }

    .slidecaption {
        position: relative;
        opacity: 0;
    }

    .slideleft.actioncaption {
        -webkit-animation-name: slideInLeft;
        -moz-animation-name: slideInLeft;
        -o-animation-name: slideInLeft;
        animation-name: slideInLeft;
        -webkit-animation-duration: 1.5s;
        -moz-animation-duration: 1.5s;
        -o-animation-duration: 1.5s;
        animation-duration: 1.5s;
        animation-timing-function: ease-in-out;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
    }

    .slideright.actioncaption {
        -webkit-animation-name: slideInRight;
        -moz-animation-name: slideInRight;
        -o-animation-name: slideInRight;
        animation-name: slideInRight;
        -webkit-animation-duration: 1.5s;
        -moz-animation-duration: 1.5s;
        -o-animation-duration: 1.5s;
        animation-duration: 1.5s;
        animation-timing-function: ease-in-out;
        animation-fill-mode: forwards;
        animation-iteration-count: 1;
        animation-delay: 0.5s;
    }

    @-webkit-keyframes slideInLeft {
        0% {
            left: -10%;
            opacity: 0;
        }
        100% {
            left: 0%;
            opacity: 1;
        }
    }

    @-moz-keyframes slideInLeft {
        0% {
            left: -10%;
            opacity: 0;
        }
        100% {
            left: 0%;
            opacity: 1;
        }
    }

    @-o-keyframes slideInLeft {
        0% {
            left: -10%;
            opacity: 0;
        }
        100% {
            left: 0%;
            opacity: 1;
        }
    }

    @keyframes slideInLeft {
        0% {
            left: -10%;
            opacity: 0;
        }
        100% {
            left: 0%;
            opacity: 1;
        }
    }

    @-webkit-keyframes slideInRight {
        0% {
            left: 10%;
            opacity: 0;
        }
        100% {
            left: 0%;
            opacity: 1;
        }
    }

    @-moz-keyframes slideInRight {
        0% {
            left: 10%;
            opacity: 0;
        }
        100% {
            left: 0%;
            opacity: 1;
        }
    }

    @-o-keyframes slideInRight {
        0% {
            left: 10%;
            opacity: 0;
        }
        100% {
            left: 0%;
            opacity: 1;
        }
    }

    @keyframes slideInRight {
        0% {
            left: 10%;
            opacity: 0;
        }
        100% {
            left: 0%;
            opacity: 1;
        }
    }

    .wrap_slidecaption h2 {
        color: #3a3b3e;
        font-size: 25px;
        margin-bottom: 10px;
        text-align: center;
        line-height: 50px;
        letter-spacing: 3px;
    }

    .wrap_slidecaption h1 {
        color: #000;
        font-size: 50px;
        line-height: 65px;
        text-align: center;
        letter-spacing: 2px;
        padding-bottom: 10px;
        font-weight: 600;
    }

    .wrap_slidecaption span {
        color: #ec008c;
    }

    .wrap_slidecaption p {
        text-align: center;
    }

    .wrap_slidecaption a {
        background: none;
        border: 1.5px solid #ec008c;
        color: #000;
        display: inline-block;
        padding: 2px 20px;
        height: 41px;
        line-height: 35px;
        transition: 0.5s;
        font-size: 20px;
        letter-spacing: 0.5px;
        border-radius: 35px;
    }

    .wrap_slidecaption a:hover {
        background-color: #ec008c;
        border: 1.5px solid #ec008c;
        color: #fff;
        text-decoration: none;
    }

    .flex-control-paging li a.flex-active {
        background: #fff;
        width: 10px;
        height: 10px;
        line-height: 28px;
        box-shadow: none;
    }

    .flex-direction-nav .flex-next {
        display: none;
    }

    .flex-direction-nav {
        display: none;
    }

    .flex-control-nav {
        bottom: 40px;
    }

    .flex-control-nav li {
        margin: 0 3px;
    }

    .flex-control-paging li a {
        width: 8px;
        height: 8px;
        background: #ffffff87;
        box-shadow: none;
    }
    @media (max-width: 1199px){
        .wrap_slidecaption h2{
            font-size: 15px;
            margin-bottom: 7px;
            line-height: 23px;
            letter-spacing: 1px;
        }
        .wrap_slidecaption h1{
            letter-spacing: 1px;
            padding-bottom: 7px;
            font-size: 28px;
            line-height: 33px;
        }
        .wrap_slidecaption a{
            font-size: 13px;
            padding: 2px 14px;
            height: 30px;
            line-height: 23px;
        }
    }
    @media (max-width: 991px) {

        .flex-control-nav {
            bottom: 0px;
        }
        .flex-control-paging li a.flex-active {
            width: 8px;
            height: 8px;
            line-height: 27px;
        }
        .flex-control-paging li a {
            width: 7px;
            height: 7px;
        }

    }

    @media (max-width: 767px) {
        .wrap_slidecaption h2{
            letter-spacing: 0.5px !important;
            font-size: 10px !important;
        }
        .wrap_slidecaption h1{
            font-size: 18px !important;
            line-height: 20px !important;
        }
        .wrap_slidecaption a{
            font-size: 9px !important;
            padding: 2px 11px !important;
            height: 22px !important;
            line-height: 16px !important;
            border: 1.1px solid #ec008c !important;
        }
        .owl-one.owl-carousel .owl-nav button.owl-next{
            width: 24px;
            height: 24px;
        }
        .owl-one.owl-carousel .owl-nav button.owl-prev{
            width: 24px;
            height: 24px;
        }
        .owl-two.owl-carousel .owl-nav button.owl-next{
            width: 24px;
            height: 24px;
        }
        .owl-two.owl-carousel .owl-nav button.owl-prev{
            width: 24px;
            height: 24px;
        }
        .flex-control-nav li {
            margin: 0px 2px;
        }
        .flex-control-nav {
            bottom: 0;
        }
        .flex-control-paging li a {
            width: 5px;
            height: 5px;
        }
        .flex-control-paging li a.flex-active {
            width: 6px;
            height: 6px;
            line-height: 25px;
        }

    }
</style>

<body>
    <?php require('inc_menu.php'); ?>

    <div class="container-fluid">
        <div class="row wow fadeInDown">
            <div class="col-12 nopan">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="wrap_slidecaption">
                                <div class="slidecaption slideleft">
                                    <h2>Cosmetic Destination</h2>
                                </div>
                                <div class="slidecaption slideright">
                                    <h1><span>Get 20%</span> Off on all <br>Cosmetic Cream Packs
                                    </h1>
                                    <p><a href="new_readmore.php">Browse Products <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
                                </div>
                            </div>
                            <img src="images/img_slidehome_1.jpg" class="img-fluid" style="width: 100%;" />
                        </li>
                        <li>
                            <div class="wrap_slidecaption">
                                <div class="slidecaption slideleft">
                                    <h2>Cosmetic Destination</h2>
                                </div>
                                <div class="slidecaption slideright">
                                    <h1><span>Get 20%</span> Off on all <br>Cosmetic Cream Packs
                                    </h1>
                                    <p><a href="new_readmore.php">Browse Products <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
                                </div>
                            </div>
                            <img src="images/img_slidehome_1.jpg" class="img-fluid" style="width: 100%;" />
                        </li>
                        <li>
                            <div class="wrap_slidecaption">
                                <div class="slidecaption slideleft">
                                    <h2>Cosmetic Destination</h2>
                                </div>
                                <div class="slidecaption slideright">
                                    <h1><span>Get 20%</span> Off on all <br>Cosmetic Cream Packs
                                    </h1>
                                    <p><a href="new_readmore.php">Browse Products <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
                                </div>
                            </div>
                            <img src="images/img_slidehome_1.jpg" class="img-fluid" style="width: 100%;" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="col-12 pad_categoryhome wow fadeInDown">
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-3 col-xl-3 pad_r_brands">
                            <div class="hovereffect img_brandshome">
                                <a href="products.php"><img src="images/brands_01.png" class="img-fluid"></a>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-3 col-xl-3 pad_l_brands">
                            <div class="hovereffect img_brandshome">
                                <a href="products.php"><img src="images/brands_02.png" class="img-fluid"></a>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-3 col-xl-3 pad_r_brands">
                            <div class="hovereffect img_brandshome">
                                <a href="products.php"><img src="images/brands_03.png" class="img-fluid"></a>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-3 col-xl-3 pad_l_brands">
                            <div class="hovereffect img_brandshome">
                                <a href="products.php"><img src="images/brands_01.png" class="img-fluid"></a>
                            </div>
                        </div>
                    </div>
                    <div class="view_category"><a href="products.php">View all category</a></div>
                </div>
                <div class="col-12 wow fadeInDown">
                    <div class="new_products">
                        <h3>New Products</h3>
                    </div>
                    <div class="row pad_newproducts">
                        <div class="owl-one owl-carousel owl-theme">
                            <div class="item">
                                <div class="box_products">
                                    <div class="img_products">
                                        <div class="new">NEW!<span></span></div>

                                        <div class="img_product">
                                            <a href="product_inside.php">
                                    <img src="images/product/product1.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                                    <img src="images/product/product2.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                                        <p>Sold 3k</p>
                                                
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
                                    <img src="images/product/product3.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                                        <a href="member4.php" class="icon_search">
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
                                    <img src="images/product/product5.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                                    <img src="images/product/product6.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
    </div>
    </div>

    <div class="col-12">
        <div class="new_products">
            <h3>Top Ranking</h3>
        </div>


    </div>


    </div>
    <div class="row">
        <div class="col-6 col-md-4 col-lg-3 col-xl-3 pad_r_brands">

            <div class="img_products">

                <div class="img_product">
                    <a href="product_inside.php">
                                    <img src="images/product/product8.jpg" alt="Avatar" class="img-fluid">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                        <p>Sold 3k</p>
                                                
                </div>
            </div>

        </div>

    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl-3 pad_l_brands">

        <div class="img_products">
            <div class="new_1">NEW!<span></span></div>

            <div class="img_product">
                <a href="product_inside.php">
                                    <img src="images/product/product7.jpg" alt="Avatar" class="img-fluid">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                    <p>Sold 156</p>
                                                
            </div>
        </div>

    </div>

    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl-3 pad_r_brands">

        <div class="img_products">

            <div class="img_product">
                <a href="product_inside.php">
                                    <img src="images/product/product6.jpg" alt="Avatar" class="img-fluid">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                    <p>Sold 33</p>
                                                
            </div>
        </div>

    </div>

    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl-3 pad_l_brands">

        <div class="img_products">

            <div class="img_product">
                <a href="product_inside.php">
                                    <img src="images/product/product5.jpg" alt="Avatar" class="img-fluid">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                <p>Sold 5k</p>
            </div>
        </div>

    </div>

    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl-3 pad_r_brands">

        <div class="img_products">

            <div class="img_product">
                <a href="product_inside.php">
                                    <img src="images/product/product4.jpg" alt="Avatar" class="img-fluid">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                <p>Sold 56</p>
            </div>
        </div>

    </div>

    </div>
    <div class="col-6 col-md-4 col-lg-3 col-xl-3 pad_l_brands">

        <div class="img_products">

            <div class="img_product">
                <a href="product_inside.php">
                                    <img src="images/product/product3.jpg" alt="Avatar" class="img-fluid">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
    <div class="col-6 col-md-4 col-lg-3 col-xl-3 pad_r_brands">

        <div class="img_products">

            <div class="img_product">
                <a href="product_inside.php">
                                    <img src="images/product/product2.jpg" alt="Avatar" class="img-fluid">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
    <div class="col-6 col-md-4 col-lg-3 col-xl-3 pad_l_brands">

        <div class="img_products">

            <div class="img_product">
                <a href="product_inside.php">
                                    <img src="images/product/product1.jpg" alt="Avatar" class="img-fluid">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
            
    <div class="row">
        <div class="col-12 pad_vouchers">
            <a href="vouchers.php"><img src="images/vouchers.png" class="img-fluid"></a>
        </div>
        <div class="col-12 pad_flexslider_product wow fadeInDown">
            <div id="flexslider_product" class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="images/imgslide_banner_1.jpg" class="img-fluid">
                        </li>
                        <li>
                            <img src="images/imgslide_banner_1.jpg" class="img-fluid">
                        </li>
                        <li>
                            <img src="images/imgslide_banner_1.jpg" class="img-fluid">
                        </li>
                    </ul>
                </div>
        </div>
    </div>
    <div class="col-12">
        <div class="new_products">
            <h3>Suggest items</h3>
        </div>
        <div class="row pad_suggest">
      <div class="owl-two owl-carousel owl-theme wow fadeInDown">
                            <div class="item">
                                <div class="box_products">
                                    <div class="img_products">
                                        <div class="new">NEW!<span></span></div>

                                        <div class="img_product">
                                            <a href="product_inside.php">
                                    <img src="images/product/product1.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                                    <img src="images/product/product2.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                                    <img src="images/product/product3.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                                        <a href="member4.php" class="icon_search">
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
                                    <img src="images/product/product5.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
                                    <img src="images/product/product6.jpg" alt="Avatar" class="image_product">
                                    <div class="overlay_product">
                                        <a href="member4.php" class="icon_search">
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
    </div>
    </div>


    </div>
    </div>
    </div>
    <?php require('inc_footer.php'); ?>
    </div>



    <script>
        $('.mainmenu li:nth-child(1) a').addClass('active');
    </script>
    <script>
        // Can also be used with $(document).ready()
        $(window).on("load", function(e) {
            $('#flexslider_product').flexslider({
                animation: "slide"
            });
        });
        $(window).on("load", function(e) {
            $('#flexslider_history').flexslider({
                animation: "slide"
            });
        });
    </script>
    <script type="text/javascript">
        $(window).on("load", function() {
            $('.flexslider').flexslider({
                animation: "slide",
                animationSpeed: 1500,
                slideshow: true,
                fade: true,
                //animationLoop: false,
                start: function(slider) {
                    $('.slidecaption, .btn_slide ').removeClass('actioncaption');
                    $('.flex-active-slide').find('.slidecaption, .btn_slide').addClass('actioncaption');
                },
                after: function(slider) {
                    $('.slidecaption, .btn_slide ').removeClass('actioncaption');
                    $('.flex-active-slide').find('.slidecaption, .btn_slide').addClass('actioncaption');
                }
            });
        });
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
            $('.owl-two').owlCarousel({
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