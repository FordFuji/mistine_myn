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
                    <h2>About us</h2>
                    <p><a href="index.php">Home</a> l About us</p>
                </div>
                <img src="<?php echo base_frontend('images/banner/about.jpg');?>" class="img-fluid" style="width: 100%;">
            </div>
        </div>
<?php
$nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
?>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInDown">
                        <div class="row text_about">
                            <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                                <!-- <div class="topic_about">
                                    <h4>Lorem Ipsum is simply dummy</h4>
                                </div> -->
                                <p>
                                <?php echo $nbsp;?>Thiri Cosmetic Co., Ltd. is the sole distributor of "Mistine" cosmetics No. (1) in Thailand, the sole distributor in Myanmar.
                                </p>
                                <p>
                                <?php echo $nbsp;?>Thiri Cosmetic Co., Ltd. It was established in 2002 and is now in its 20th year.
                                </p>
                                <p>
                                <?php echo $nbsp;?>There are no side effects on the skin as all cosmetics from Thailand are tested and produced after laboratory testing. A complete range of Personal Care, Skin Care, Make-Up & Perfume.
                                </p>
                                <p>
                                <?php echo $nbsp;?>"Mistine" cosmetics are selected from the types that are suitable for the skin of the people of Myanmar and are sold at wholesale, retail prices.
                                </p>
                                <p>
                                <?php echo $nbsp;?>"Mistine" cosmetics are safe to use for all children, adults, men and women, so only FDA approved products can be purchased with confidence.
                                </p>
                            </div>
                            <div class="col-12 col-md-12 col-lg-6 col-xl-6 pad_img_about">
                                <img src="<?php echo base_frontend('images/img_about_1.jpg');?>" class="img-fluid">
                            </div>
                            
                            
                            <div class="col-12 col-md-12 col-lg-6 col-xl-6 p_md_img_about">
                                <img src="<?php echo base_frontend('images/img_about_2.jpg');?>" class="img-fluid">
                            </div>
                            <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                                <p>
                                <?php echo $nbsp;?>Gold stickers are used to warn you of the similarities between Mistine Beauty products that are directly distributed by the company. Only the gold sticker is the real thing, so the quality is fully guaranteed.
                                </p>
                                <p>
                                <?php echo $nbsp;?>If you want to buy mistine cosmetics, you can go to the store in every city. You can buy it at minimarts and supermarkets.
                                </p>
                                <p>
                                <?php echo $nbsp;?>For those who want to buy directly from the company, we are launching "Mistine Beauty Shop" Hledan branch.
                                </p>
                                <p>
                                <?php echo $nbsp;?>There are plans to open more branches in other townships as well.
                                </p>
                                <p>
                                <?php echo $nbsp;?>Special thanks to all the customers who have always been loyal to Mistine Cosmetics.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require('inc_footer.php'); ?>
    </div>
</body>

</html>