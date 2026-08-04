<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>

<body>
    <?php require('inc_menu.php'); ?>
    <div class="container-fluid">
        <div class="row pad-banner">
            <div class="col-12 nopan banner wow fadeInDown">
                <div class="text_banner">
                    <h2>News & Promotions</h2>
                    <p><a href="<?php echo site_frontend('index.php');?>">Home</a> l News & Promotions</p>
                </div>
                <img src="<?php echo base_frontend('images/banner/news_promotions.jpg');?>" class="img-fluid" style="width: 100%;">
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInDown">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                                <div class="taxt_new">
                                    <div class="img_taxt_new">
                                        <div class="hovereffect">
                                            <a href="<?php if(!empty($top)) echo site_url('frontend/path/readmore_new/'.$top->news_promotions_id);?>"><img src="<?php echo base_url('uploads/news_promotions/'.$top->news_promotions_image);?>" class="img-fluid"></a>
                                        </div>
                                        <div class="date_1">
<?php
if(!empty($top) and $top->news_promotions_date != '') {
    $date = explode('-', $top->news_promotions_date);

    $year = $date[0];
    $month = $date[1];
    $day = $date[2];
?>            
                                            <h5><?php echo $day;?><br><span><?php echo monthTextEn($month);?> ,<?php echo $year;?></span></h5>
<?php
}
?>                                
                                        </div>
                                    </div>
                                    <h3><?php if(!empty($top)) echo get2Lang($this->session->userdata('lang'), $top->news_promotions_name_lang1, $top->news_promotions_name_lang2);?></h3>
                                    <p><?php if(!empty($top)) echo get2Lang($this->session->userdata('lang'), $top->news_promotions_description_lang1, $top->news_promotions_description_lang2);?></p>
                                    <div class="button_new"><a href="<?php if(!empty($top)) echo site_url('frontend/path/readmore_new/'.$top->news_promotions_id);?>">Readmore</a></div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 col-xl-4">
                                <div class="events">
                                    <div class="topic_new">
                                        <h1>News</h1>
                                    </div>
<?php
if(!empty($newsRightCtrl)) {
    foreach($newsRightCtrl as $r) {
?>
                                    <div class="row box_events">
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="hovereffect">
                                                <a href="<?php echo site_url('frontend/path/readmore_new/'.$r->news_promotions_id);?>">
                                                    <img src="<?php echo base_url('uploads/news_promotions/'.$r->news_promotions_image);?>" class="img-fluid" style="width: 100%;">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                            <a href="<?php echo site_frontend('readmore_new.php');?>">
                                                <h6><?php echo get2Lang($this->session->userdata('lang'), $r->news_promotions_name_lang1, $r->news_promotions_name_lang2);?></h6>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i>
<?php
        $news_date = explode('-', $r->news_promotions_date);
        $year = $news_date[0];
        $month = $news_date[1];
        $day = $news_date[2];
?>
                                                <?php echo monthTextEn($month).' '.$day.','.$year;?></p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="line_new"></div>
<?php
    }
}

/*
?>
                                    <div class="row box_events">
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="hovereffect">
                                                <a href="<?php echo site_frontend('new_readmore.php');?>">
                                                    <img src="<?php echo base_frontend('images/new_promotion/new_3.jpg');?>" class="img-fluid" style="width: 100%;">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                            <a href="<?php echo site_frontend('readmore_new.php');?>">
                                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h6>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i> April 20,2019</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="line_new"></div>
                                    <div class="row box_events">
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="hovereffect">
                                                <a href="<?php echo site_frontend('new_readmore.php');?>">
                                                    <img src="<?php echo base_frontend('images/new_promotion/new_4.jpg');?>" class="img-fluid" style="width: 100%;">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                            <a href="<?php echo site_frontend('readmore_new.php');?>">
                                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h6>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i> April 20,2019</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="line_new"></div>
                                    <div class="row box_events">
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="hovereffect">
                                                <a href="<?php echo site_frontend('readmore_new.php');?>">
                                                    <img src="<?php echo base_frontend('images/new_promotion/new_5.jpg');?>" class="img-fluid" style="width: 100%;">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                            <a href="<?php echo site_frontend('readmore_new.php');?>">
                                                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h6>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i> April 20,2019</p>
                                            </a>
                                        </div>
                                    </div>
*/
?>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 wow fadeInDown">
                        <div class="row pad_homenew">
<?php
if(!empty($promotionCtrl)) {
    foreach($promotionCtrl as $r) {

?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="">
                                    <div class="box-homenew">
                                        <div class="hovereffect">
                                            <a href="<?php echo site_url('frontend/path/readmore_new/'.$r->news_promotions_id);?>">
                                                <img src="<?php echo base_url('uploads/news_promotions/'.$r->news_promotions_image);?>" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="text-box-homenew">
                                            <a href="<?php echo site_url('frontend/path/readmore_new/'.$r->news_promotions_id);?>">
                                                <h6><?php echo get2Lang($this->session->userdata('lang'), $r->news_promotions_name_lang1, $r->news_promotions_name_lang2);?></h6>
                                                <p><?php echo get2Lang($this->session->userdata('lang'), $r->news_promotions_description_lang1, $r->news_promotions_description_lang2);?></p>
                                            </a><a href="<?php echo site_url('frontend/path/readmore_new/'.$r->news_promotions_id);?>">Readmore <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </a>
                            </div>
<?php
    }
}

/*                            
                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="">
                                    <div class="box-homenew">
                                        <div class="hovereffect">
                                            <a href="<?php echo site_frontend('readmore_new.php');?>">
                                                <img src="<?php echo base_frontend('images/new_promotion/new_7.jpg');?>" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="text-box-homenew">
                                            <a href="<?php echo site_frontend('readmore_new.php');?>">
                                                <h6>Lorem Ipsum is simply</h6>
                                                <p>dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                            </a><a href="<?php echo site_frontend('new_readmore.php');?>">Readmore <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <a href="">
                                    <div class="box-homenew">
                                        <div class="hovereffect">
                                            <a href="<?php echo site_frontend('readmore_new.php');?>">
                                                <img src="<?php echo base_frontend('images/new_promotion/new_8.jpg');?>" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="text-box-homenew">
                                            <a href="<?php echo site_frontend('readmore_new.php');?>">
                                                <h6>Lorem Ipsum is simply</h6>
                                                <p>dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                            </a><a href="<?php echo site_frontend('new_readmore.php');?>">Readmore <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </a>
                            </div>
*/
?>
                        </div>

                        <div class="pad_pagination wow fadeInDown">
                            <?php echo $pagination;?>
                            <!-- <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href=""><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="page_2.php">2</a>
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

        <?php require('inc_footer.php'); ?>
        <style>
            ul li.active {
                background-color: #e83e8c !important;
            }
        </style>
    </div>
</body>

</html>