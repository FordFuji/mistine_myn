<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>
<style>
    .flex-direction-nav .flex-next {
        background-image: url(<?php echo base_frontend('images/icon_buttom_r.png');?>)
        right: 40px;
        opacity: 1;
        line-height: 1;
        text-indent: -999px;
        text-align: left;
        width: 30px;
        background-size: contain;
        background-repeat: no-repeat;
    }

    .flex-direction-nav .flex-prev {
        background-image: url(<?php echo base_frontend('images/icon_buttom_l.png');?>)
        left: 40px;
        opacity: 1;
        line-height: 1;
        text-indent: -999px;
        text-align: left;
        width: 30px;
        background-size: contain;
        background-repeat: no-repeat;
    }

    .flexslider:hover .flex-direction-nav .flex-next {
        right: 40px;
    }

    .flexslider:hover .flex-direction-nav .flex-prev {
        left: 40px;
    }

    .flexslider {
        margin: 0 0 5px;
        border: 0px solid #fff;
    }

    @media (max-width: 767px) {
        .flex-direction-nav .flex-next {
            right: 20px;
            width: 20px;
            top: 60%;
        }
        .flex-direction-nav .flex-prev {
            left: 20px;
            width: 20px;
            top: 60%;
        }
    }
</style>

<body>
    <?php require('inc_menu.php'); ?>
    <div class="container-fluid">

        <div class="row">
            <div class="container">
                <div class="row">


                    <div class="col-12 pad_slidenew wow fadeInDown">
                        <!-- Place somewhere in the <body> of your page -->
                        <div class="back"><a href="<?php echo site_frontend('news_promotions.php');?>">Back</a></div>
                        <div id="slider" class="flexslider">
                            <ul class="slides">
<?php
if(!empty($galleryCtrl)) {
    foreach($galleryCtrl as $r) {

?>
                                <li>
                                    <img src="<?php echo base_url('uploads/news_promotions/'.$r->news_promotions_gallery_image);?>" />
                                </li>
<?php
    }
}

/*
?>
                                <li>
                                    <img src="<?php echo base_frontend('images/new_promotion/new_1.jpg');?>" />
                                </li>
                                <li>
                                    <img src="<?php echo base_frontend('images/new_promotion/new_1.jpg');?>" />
                                </li>
                                <li>
                                    <img src="<?php echo base_frontend('images/new_promotion/new_1.jpg');?>" />
                                </li>
*/
?>
                                <!-- items mirrored twice, total of 12 -->
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
<?php
if(!empty($galleryCtrl)) {
    foreach($galleryCtrl as $r) {

?>
                                <li>
                                    <img src="<?php echo base_url('uploads/news_promotions/'.$r->news_promotions_gallery_image);?>" />
                                </li>
<?php
    }
}

/*
                                <li>
                                    <img src="<?php echo base_frontend('images/new_promotion/new_1.jpg');?>" />
                                </li>
                                <li>
                                    <img src="<?php echo base_frontend('images/new_promotion/new_1.jpg');?>" />
                                </li>
                                <li>
                                    <img src="<?php echo base_frontend('images/new_promotion/new_1.jpg');?>" />
                                </li>
                                <!-- items mirrored twice, total of 12 -->
*/
?>
                            </ul>
                        </div>

                        <div class="text_readmorenew">
<?php
$date = explode('-', $detailCtrl->news_promotions_date);

$year = $date[0];
$month = $date[1];
$day = $date[2];

?>
                            <h6><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo monthTextEn($month);?> <?php echo $day;?>,<?php echo $year;?></h6>
                            <h4><?php if(!empty($detailCtrl)) echo get2Lang($this->session->userdata('lang'), $detailCtrl->news_promotions_name_lang1, $detailCtrl->news_promotions_name_lang2);?></h4>
                            <p><?php if(!empty($detailCtrl)) echo get2Lang($this->session->userdata('lang'), $detailCtrl->news_promotions_detail_lang1, $detailCtrl->news_promotions_detail_lang2);?></p>
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
                itemWidth: 120,
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
</body>

</html>