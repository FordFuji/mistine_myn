<style>
    #menu {
        position: fixed;
        left: 0%;
        height: 100%;
        z-index: 100;
        background-color: #ffffff;
        width: 100%;
        /*    margin: -150px 0 0 -130px;*/
        -webkit-box-shadow: 0px 2px 2px 0px rgba(50, 50, 50, 0.1);
        -moz-box-shadow: 0px 2px 2px 0px rgba(50, 50, 50, 0.1);
        box-shadow: 0px 2px 2px 0px rgba(50, 50, 50, 0.1);
    }

    #menu .menu-wrapper-inner {}

    #menu .menu-wrapper {
        position: relative;
        overflow-x: hidden;
    }

    #menu .menu {
        width: 320px;
        float: left;
    }

    #menu .menu-item {
        position: relative;
    }

    #menu .menu-item:hover {
        background-color: #fafafa;
    }

    #menu .menu-item a {
        font-size: 15px;
        padding: 15px 20px;
        /*    line-height: 18px;*/
        font-weight: normal;
        color: #252525;
        display: block;
        text-decoration: none;
        border-bottom: 1px solid #eeeeee;
    }

    #menu .menu-item .spt {
        position: absolute;
        right: 25px;
        top: 50%;
        margin-top: -5px;
    }

    #menu .menu-slider {
        position: relative;
        width: 2000px;
        left: 0;
    }

    #menu .submenu {
        display: none;
    }

    #menu .submenu-back {
        border-bottom: 1px solid #eeeeee;
    }

    #menu .submenu-back .spt {
        left: 25px;
    }

    #menu .submenu-back a {
        padding-left: 30px;
    }
</style>
<div id="nav">
    <ul class="main_menu">
<?php
$category1Ctrl = $this->model_frontend->getCategory1Result();
if(!empty($category1Ctrl)) {
    foreach($category1Ctrl as $r1) {       
?> 
        <li><a href="#"><?php echo get2Lang($this->session->userdata('lang'), $r1->category1_name_lang1, $r1->category1_name_lang2);?> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-container">
                <ul class="submenudrop">
                    <div class="row pad_sub">
                        <div class="col-md-3 col-xl-4 menu-pictop">
                            <a href="#"><img src="<?php echo base_url('uploads/category1/'.$r1->category1_image);?>" class="img-fluid"></a>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
<?php
        $i = 1;
        $category2 = $this->model_frontend->getCategory2Result($r1->category1_id);
        $count = count($category2);
        if(!empty($category2)) {
            foreach($category2 as $r2) {
                /*if($i % 2 == 1 and ($r2->category2_id != 33)) {
?>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
<?php
                }*/
?>
                                <div class="col-md-12 col-xl-6">                            
                                    <div class="sub-list">
                                        <h2><?php echo get2Lang($this->session->userdata('lang'), $r2->category2_name_lang1, $r2->category2_name_lang2);?></h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
<?php
                $category3 = $this->model_frontend->getCategory3Result($r2->category2_id);
                if(!empty($category3)) {
                    foreach($category3 as $r3) {
?>
                                            <li><a href="<?php echo site_url('frontend/path/products/category3/'.$r3->category3_id);?>"><?php echo get2Lang($this->session->userdata('lang'), $r3->category3_name_lang1, $r3->category3_name_lang2);?></a></li>
<?php
                    }
                }

?>
                                        </div>
                                    </ul>
                                </div>
<?php
                /*if(($i % 2 == 0 or $i == $count) and ($r2->category2_id != 34)) {
?>
                            </div>
                        </div>
<?php
                }*/

                $i++;
            }
        }
?>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </li>
<?php
    }
}
?>
        <li><a href="<?php echo site_url('frontend/path/news_promotions');?>">New & Promotion</a></li>
    </ul>
</div>
<?php
/*
?>
        <li> <a href="#">Skin Care <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-container">
                <ul class="submenudrop">
                    <div class="row pad_sub">
                        <div class="col-md-3 col-xl-4 menu-pictop">
                            <a href="#"><img src="<?php echo base_frontend('images/brands_02.png');?>" class="img-fluid"></a>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="sub-list">
                                        <h2>Cleanser</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Face Wash</a></li>
                                            <li><a href="#">Makeup Removers</a></li>
                                        </div>
                                    </ul>

                                    <div class="sub-list">
                                        <h2>Moisturizers</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Day Cream</a></li>
                                            <li><a href="#">Night Cream</a></li>
                                            <li><a href="#">Mineral spray</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="sub-list">
                                        <h2>Treatment</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Essence</a></li>
                                            <li><a href="#">Toner</a></li>
                                            <li><a href="#">Blemish & Acme Treatment</a></li>
                                            <li><a href="#">Facial anti_Aging Serum</a></li>
                                        </div>
                                    </ul>
                                    <div class="sub-list">
                                        <h2>Mask & Black Head</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Sheet Masks</a></li>
                                            <li><a href="#">Black Head</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="sub-list">
                                        <h2>Eye Care</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Eye Cream & Treatment</a></li>
                                            <li><a href="#">Eye Serum</a></li>
                                            <li><a href="#">Eye Roller Serum</a></li>
                                            <li><a href="#">Eye Masks</a></li>
                                        </div>
                                    </ul>
                                    <div class="sub-list">
                                        <h2>Sun Care</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Facial Sun Screen</a></li>
                                            <li><a href="#">After Sun Care</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="sub-list">
                                        <h2>Acne</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Acne Cleanser</a></li>
                                            <li><a href="#">Acne Serum</a></li>
                                            <li><a href="#">Acne Cleansing Water</a></li>
                                            <li><a href="#">Acne Body Wash</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </li>
        <li> <a href="#">Fragrance <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-container">
                <ul class="submenudrop">
                    <div class="row pad_sub">
                        <div class="col-md-3 col-xl-4 menu-pictop">
                            <a href="#"><img src="<?php echo base_frontend('images/brands_03.png');?>" class="img-fluid"></a>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Women</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Perfume</a></li>
                                            <li><a href="#">Deodorant</a></li>
                                            <li><a href="#">Cream & Lotion</a></li>
                                            <li><a href="#">Foundation</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Man</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Perfume</a></li>
                                            <li><a href="#">Deodorant</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </li>
        <li> <a href="#">Personal Care <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-container">
                <ul class="submenudrop">
                    <div class="row pad_sub">
                        <div class="col-md-3 col-xl-4 menu-pictop">
                            <a href="#"><img src="<?php echo base_frontend('images/brands_01.png');?>" class="img-fluid"></a>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Oral Care</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Toothpaste</a></li>
                                            <li><a href="#">Toothbrush</a></li>
                                            <li><a href="#">Whitening Treatment</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Arm Pit</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Deo Stick</a></li>
                                            <li><a href="#">Deo Roll-on</a></li>
                                            <li><a href="#">Deo Spray</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Mother & Baby</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Body Powder</a></li>
                                            <li><a href="#">Bady shower</a></li>
                                            <li><a href="#">Bady Lotion</a></li>
                                            <li><a href="#">Bady Wipe</a></li>
                                        </div>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </li>
        <li> <a href="#">Bath & Body <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-container">
                <ul class="submenudrop">
                    <div class="row pad_sub">
                        <div class="col-md-3 col-xl-4 menu-pictop">
                            <a href="#"><img src="<?php echo base_frontend('images/brands_01.png');?>" class="img-fluid"></a>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Moistuer</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Hand</a></li>
                                            <li><a href="#">Body</a></li>
                                            <li><a href="#">Foot</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Bath & shower</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Body Wash</a></li>
                                            <li><a href="#">Body Scrub</a></li>
                                            <li><a href="#">Feminine Wash</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Baby Sun</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Sun Protection</a></li>
                                            <li><a href="#">After Sun</a></li>
                                            <li><a href="#">Alvera Gel</a></li>
                                        </div>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </li>
        <li> <a href="#">Hair <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-container">
                <ul class="submenudrop">
                    <div class="row pad_sub">
                        <div class="col-md-3 col-xl-4 menu-pictop">
                            <a href="#"><img src="<?php echo base_frontend('images/brands_01.png');?>" class="img-fluid"></a>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Shampoo & Conditioner</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Shampoo</a></li>
                                            <li><a href="#">Conditioner</a></li>
                                            <li><a href="#">Dry Shampoo</a></li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Treatment</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Oil & Serum</a></li>
                                            <li><a href="#">Har Fall Treatment</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Color</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Cream Type</a></li>
                                            <li><a href="#">Foam Type</a></li>
                                        </div>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </li>
        <li> <a href="#">Blush & Tools & Accessories <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <div class="dropdown-container">
                <ul class="submenudrop">
                    <div class="row pad_sub">
                        <div class="col-md-3 col-xl-4 menu-pictop">
                            <a href="#"><img src="<?php echo base_frontend('images/brands_01.png');?>" class="img-fluid"></a>
                        </div>
                        <div class="col-md-3 col-xl-4">
                            <div class="row">
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Makeup Accessories</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#"></a></li>
                                            
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-12 col-xl-6">
                                    <div class="sub-list">
                                        <h2>Brushes & Applicator</h2>
                                    </div>
                                    <ul class="sub-list-cl">
                                        <div class="left-bb">
                                            <li><a href="#">Makeup Brush Set</a></li>
                                            <li><a href="#">Face Brushes</a></li>
                                            <li><a href="#">Blush Brushes</a></li>
                                            <li><a href="#">Spoong & Applicators</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </ul>
            </div>
        </li>

    </ul>
</div>
*/
?>