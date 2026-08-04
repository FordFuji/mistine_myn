<style>
    .posstatic {
        position: static;
    }

    .wrapper_pad {
        width: 95%;
        margin: auto;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    .form_center{
        text-align: center;
    }
    .menu-box {
        overflow: auto;
        position: relative;
        height: 100%;
    }
    .pad_topnav_menu{
        padding-right: 0;
    }
    .detail i {
        
        position: absolute;
        top: 50%;
        right: 20px;
        margin-top: -5px;
    }

    .detail.back {
        left: 10px;
    }

    .styled-checkbox {
        position: absolute;
        opacity: 0;
    }

    .styled-checkbox+label {
        position: relative;
        cursor: pointer;
        padding: 0;
        font-size: 14px;
        color: #676767;
    }
    .text_login i{
        font-size: 13px;
    }
    .styled-checkbox+label:before {
        content: '';
        margin-right: 10px;
        display: inline-block;
        vertical-align: text-top;
        width: 18px;
        height: 18px;
        background: white;
        border: 1px solid #252525;
        border-radius: 3px;
    }

    .styled-checkbox:disabled+label {
        color: #b8b8b8;
        cursor: auto;
    }

    .styled-checkbox:disabled+label:before {
        box-shadow: none;
        background: #252525;
    }

    .styled-checkbox:checked+label:before {
        background-color: #252525;
    }

    .styled-checkbox:checked+label:after {
        content: '';
        position: absolute;
        left: 4px;
        top: 9px;
        background: #ffffff;
        width: 3px;
        height: 3px;
        box-shadow: 2px 0 0 #ffffff, 4px 0 0 #ffffff, 4px -2px 0 #ffffff, 4px -4px 0 #ffffff, 4px -6px 0 #ffffff, 4px -8px 0 #ffffff;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .topnav_menu ul {
        margin: 0;
    }

    .topnav_menu {
        font-size: 15px;
        text-align: right;
        padding: 2px 0px 0;
        letter-spacing: 0.5px;
    }

    .topnav_menu li {
        list-style: none;
        display: inline-block;
        border-left: 1px solid rgba(255, 255, 255, 0.4);
        line-height: 0px;
        padding: 10px 0 10px 10px;

    }

    .topnav_menu li:first-child {
        border-left: none;
    }

    .topnav_menu a {
        color: #000;
        font-size: 13px;
        letter-spacing: 0.3px;
        text-decoration: none;
    }

    .flag {
        width: 19px !important;
    }

    .topnav_menu a>img {
        width: 60%;
    }

    .topnav_menu a:hover {
        color: #000;
    }

    .border_mid {
        border-bottom: 1px solid;
        border-color: rgba(91, 91, 91, 0.2);
        height: 1px;
        width: 100%;
    }

    .sub-list h2 {
        font-size: 20px;
        text-align: left;
        font-weight: 600;
        padding-bottom: 5px;
    }

    .viewallprod,
    .sub-list-cl li a {
        color: #252525 !important;
        text-transform: none;
        font-size: 15px;
        text-decoration: none;
        font-weight: 300;
    }

    .sub-list-cl {
        text-align: left;
    }
    .left-bb{
        padding-bottom: 30px;
    }
    .left-bb li {
        display: block !important;
        position: relative;
        padding: 0px !important;
    }

    .sub-list-cl li {
        display: block;
        font-size: 1em;
        text-transform: none;
        letter-spacing: 0px;
        line-height: 25px;
        text-align: left;
        padding-left: 0px;
    }

    .main_logo a>img {
        width: 100%;
        padding: 10px 0;
    }

    #nav {
        margin-top: 40px;
        text-align: center;
    }

    .main_menu li {
        list-style: none;
        display: inline-block;
        padding: 0px 10px 10px;
    }

    .main_menu a {
        color: #000;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .main_menu a:hover {
        color: #000;
        text-decoration: none;
    }

    .wrap_menu {
        background-color: rgba(255, 255, 255, 0.95);
        position: relative;
        /*        z-index: 98;*/
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        border-bottom: 1px solid rgba(0, 0, 0, 0.07);
    }

    .wrap_menu.sticky {
        position: fixed;
        z-index: 98;
        background-color: rgba(255, 255, 255, 0.95);
        right: 0;
        top: 0;
        left: 0;
        padding: 0 1%;
        height: 70px;
    }

    .wrap_menu.sticky #nav {
        margin-top: 20px;
    }

    .wrap_menu.sticky .main_logo {
        margin-top: 6px;
    }

    .wrap_menu.sticky .main_logo a>img {
        width: 77%;
        padding: 0;
    }

    .wrap_menu.sticky .search-container {
        margin-top: 15px;
    }

    .wrap_menu.sticky .topnav_menu,
    .wrap_menu.sticky .text_top {
        font-size: 0.6em;
    }
    .text_top p{
        text-align: center;
        margin: 0;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .text_top i{
        padding-right: 5px;
    }
    .text_top span{
        color: #ec008c;
    }
    .text_top{
        letter-spacing: 0.5px;
        font-size: 13px;
        padding: 8px 0 8px;
    }
    .wrap_menu.sticky .topnav_menu,
    .wrap_menu.sticky .text_top {
        display: none;
    }

    .wrap_menu.sticky .main_menu li {
        font-size: 0.8em;
    }



    .dropdown-container {
        position: absolute;
        top: 100%;
        height: auto;
        background-color: #f2f3f5;
        left: 0;
        right: 0;
        z-index: 9;
        visibility: hidden;
        opacity: 0;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
        border-top: 1px solid #eeeeee;
        padding: 0px;
        overflow: hidden;
    }

    #nav ul li:hover div.dropdown-container {
        opacity: 1;
        visibility: visible;
    }

    /*-------SEARCH BAR --------*/

    .search-container {
        width: 100%;
        display: block;
        position: relative;
        margin-top: 40px;
        text-align: right;
    }
    .search-container img{
        width: 45px;
        padding-left: 20px;
        cursor: pointer;
    }
    .search-container a {
        color: black;
        font-size: 1em;
        color: white;
    }
    .search-container div{
        display: -webkit-inline-box;
    }
    input#search-bar {
        width: 100%;
        height: 30px;
        padding: 0px;
        font-size: 1em;
        border-left: 0px;
        border-right: 0px;
        border-top: 0px;
        border-bottom: 1px solid #e6e6e6;
        outline: none;
        background-color: transparent;
        color: white;
    }

    input#search-bar:focus {
        -webkit-transition: 0.35s ease;
        transition: 0.35s ease;
        border-bottom: 1px solid white;
        color: white;
    }

    input#search-bar:focus::-webkit-input-placeholder {
        -webkit-transition: opacity 0.45s ease;
        transition: opacity 0.45s ease;
        opacity: 0;
        color: white;
    }

    input#search-bar:focus::-moz-placeholder {
        -webkit-transition: opacity 0.45s ease;
        transition: opacity 0.45s ease;
        opacity: 0;
        color: white;
    }

    input#search-bar:focus:-ms-placeholder {
        -webkit-transition: opacity 0.45s ease;
        transition: opacity 0.45s ease;
        opacity: 0;
        color: white;
    }

    .search-icon {
        position: absolute;
        width: 22px;
        height: 18px;
        top: 0px;
        right: 0px;
    }
    


    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 320px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);


    }

    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }

    .modal.right .modal-body {
        padding: 15px 30px 80px;
    }

    .modal-backdrop {
        z-index: 0;
    }

    .modal-header .close {
        margin: -14px;
    }

    .close {
        text-shadow: none;
        opacity: 1;
        font-size: 30px;
    }
    
    .close:hover,
    .close:focus,
    button.close {
        color: #000;
    }

    /*Right*/

    .modal.right.fade .modal-dialog {
        right: -320px;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;

    }

    .modal.right.fade.show .modal-dialog {
        right: 0;
    }

    /* ----- MODAL STYLE ----- */

    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        border: none;
        background: none;
        color: #000;
        padding: 15px 28px 0;
        border-radius: 0px;
        background-color: #f2f3f5;
    }

    .modal-title {
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1em;
        padding-top: 2px;
        font-weight: 600;
    }
    .pad_r_logo{
        padding-right: 0;
    }
    .bot_bag {
        position: fixed;
        bottom: 10px;
        width: 91%;
        border-top: 1px solid #eeeeee;
        padding-top: 15px;
        left: 15px;
    }

    .cart_mobile {
        margin-top: 25px;
        text-align: right;
        color: #000;
        cursor: pointer;
    }

    .btn_selectlang button {
        background: none;
        font-size: 13px;
        border: 0;
        color: #000;
        cursor: pointer;
        outline: none;
        padding: 0;
    }

    .btn_selectlang .dropdown-item {
        font-size: 0.8em;
        color: #000;
        padding: 4px 8px;
        vertical-align: top;
    }

    .btn_selectlang .dropdown-item:hover {
        background-color: #fff;
        color:#000
        opacity: 0.9;
    }

    .btn_selectlang .dropdown-menu {
        background-color: #fff;
        width: auto;
        min-width: auto;
    }

    .join_us {
        display: none;
    }

    .bg_top {
        background-color: #f2f3f5;
    }

    .pad_sub {
        padding: 20px 0;
    }
    .dropdown-toggle::after{
        display: none;
    }
    
    .menu_web{
        list-style: none;
    }
    .menu_web li{
        padding: 15px 0;
        font-size: 20px;
    }
    .menu_web li a{
        color: #000;
        text-decoration: none;
    }
    .menu_web li a:hover{
        color: #000000cf;
    }
    .search{
        border-radius: 35px;
        background-color: #ec008c;
        border: 1px solid #ec008c;
        color: #fff;
        display: inline-block;
        padding: 0 18px;
        height: 36px;
        width: 40%;
        text-align: center;
        line-height: 35px;
        text-transform: uppercase;
        transition: 0.5s;
        font-size: 14px;
    }
    .form-search{
        display: block;
        margin-bottom: 20px;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    /*  RESPONSIVE  */

    @media (max-width: 1919px) {
        #nav {
            margin-top: 35px;
        }

        .search-container {
            margin-top: 20px;
        }
    }

    @media (max-width: 1550px) {
        .wrap_menu.sticky .main_logo a>img {
            width: 100%;
            padding: 0px 0;
        }
        .main_menu a{
            font-size: 15px
        }
        #nav {
            margin-top: 28px;
        }
        .wrap_menu.sticky .search-container {
            margin-top: 20px;
        }
        .search-container{
            margin-top: 27px;
        }
    }

    @media (max-width: 1500px) {
        .wrap_menu.sticky .main_logo {
            margin-top: 5px;
        }

        .wrap_menu.sticky .main_logo a>img {
            width: 35%;
        }
    }

    @media (max-width: 1300px) {
        .main_menu li {
            padding: 0px 10px;
        }

        #nav {
            margin-top: 25px;
        }
    }

    @media (max-width: 1199px) {
        .main_menu li {
            padding: 0px 4px;
        }
        .main_menu a{
            font-size: 11px;
            letter-spacing: 0.1px;
        }
        .search-container img{
            width: 28px;
            padding-left: 8px;
        }
        .search-container div{
            font-size: 10px;
        }
        #nav {
            margin-top: 15px;
        }
        .menu_web li {
            padding: 8px 0;
            font-size: 16px;
        }
        .search-container {
            margin-top: 13px;
        }
        .sub-list-cl li{
            line-height: 23px;
        }
        .wrap_menu.sticky .main_logo a>img {
            width: 100%;
            padding-top: 11px;
        }
        .sub-list h2{
            font-size: 16px;
        }
        .viewallprod, .sub-list-cl li a{
            font-size: 14px;
        }
        .pad_sub {
            padding: 20px 0 0;
        }
    }



    @media (max-width: 991px) {
        #menu .submenu-back a {
            padding-left: 40px !important;
        }
        .detail_back i{
            position: absolute;
            top: 50%;
            left: 20px;
            margin-top: -9px;
        }
        .wrap_slidecaption a{
            font-size: 12px;
            padding: 2px 11px;
            height: 27px;
            line-height: 21px;
            border: 1.3px solid #ec008c;
        }
        .wrap_slidecaption h1{
            font-size: 30px;
            line-height: 35px;
            padding-bottom: 0px;
        }
        .wrap_slidecaption h2{
            line-height: 15px;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .wrap_menu.sticky{
            height: 60px;
        }
        .modal-body .row {
            flex-wrap: inherit;
        }
        .text_top{
            font-size: 11px;
            padding: 5px 0 4px;
            background-color: #f2f3f5;
        }
        .mainlogo_mobile a img {
            width: 40%;
        }

        .wrap_menu.sticky .mainlogo_mobile a img {
            width: 30%;
        }

        .mainlogo_mobile,
        .wrap_menu.sticky .mainlogo_mobile {
            text-align: center;
        }

        .menumobileslide {
            display: inline-block;
        }

        .cart_mobile,
        .menumobileslide {
            margin-top: 30px;
        }

        .wrap_menu.sticky .cart_mobile,
        .wrap_menu.sticky .menumobileslide {
            margin-top: 15px;
        }

        .modal.right .modal-dialog {
            width: 320px;
        }

        .modal.left .modal-dialog {
            position: fixed;
            margin: auto;
            width: 320px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.left .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.left .modal-body {
            padding: 15px 15px 80px;
        }

        /*Left*/
        .modal.left.fade .modal-dialog {
            left: -320px;
            -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
            -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
        }

        .modal.left.fade.show .modal-dialog {
            left: 0;
        }

        .wrap_menu.sticky .search_mobile_1 {
            top: 16px;
        }

    }

    .menu li {
        list-style: none;
    }

    @media (max-width: 767px) {

        .wrap_menu.sticky .search_mobile_1 {
            top: 9px;
        }


        .mainlogo_mobile a img {
            width: 75%;
        }

        .wrap_menu.sticky .mainlogo_mobile a img {
            width: 60%;
        }

        .wrap_menu.sticky {
            height: auto;
        }

        .cart_mobile,
        .menumobileslide {
            margin-top: 15px;
        }

        .wrap_menu.sticky .cart_mobile,
        .wrap_menu.sticky .menumobileslide {
            margin-top: 10px;
        }




        /* ----- MODAL STYLE ----- */
        .modal-content {
            border-radius: 0;
            border: none;
        }

        .img_s {
            width: 20px;
        }


    }
</style>
<div class="pc_menu">
    <div class="navbg wrap_menu">
        <div class="container-fluid d-none d-sm-none d-md-none d-lg-block d-xl-block bg_top">
            <div class="wrapper_pad">
                <div class="row"><div class="col-12 text_top xl_display" style="border-bottom: 1px solid rgba(0, 0, 0, 0.07);"><p>Shop Events & save up to <span>65% off!</span></p></div></div>
                <div class="row">
                    <div class="col-lg-6 col-xl-4 text_top ">
                        <i class="fa fa-phone" aria-hidden="true"></i> Call Us : 02-657-1111
                    </div>
                    <div class="col-lg-4 text_top md_display">
                        <p>Shop Events & save up to <span>65% off!</span></p>
                    </div>
                    <div class="col-lg-6 col-xl-4 pad_topnav_menu">
                        <div class="topnav_menu">
                            <ul>
                                <li>
                                    <div class="text_login">
                                        <i class="fa fa-user" aria-hidden="true"></i> <a href="login.php">Login</a> &nbsp;I&nbsp; <a href="register.php">Rsegister</a> &nbsp;I&nbsp; <a href="payment-confirmed.php">Payment</a> &nbsp;I&nbsp; <a href="profile-tracking.php">Order tracking</a>
                                    </div>
                                </li>

                                <li>
                                    <div class="btn_selectlang dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> En <i class="fa fa-angle-down" aria-hidden="true"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#"><img src="images/flag_en.jpg" class="flag"> EN</a>
                                            <a class="dropdown-item" href="#"> <img src="images/flag_my.jpg" class="flag"> Bur</a> </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border_mid  d-none d-sm-none d-md-none d-lg-block d-xl-block"></div>
        <div class="wrapper_pad  d-none d-sm-none d-md-none d-lg-block d-xl-block">
            <div class="row">
                <div class="col-lg-1 pad_r_logo">
                    <div class="main_logo">
                        <a href="index.php"><img src="images/logo_mistine_myanmar.png" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-lg-9 posstatic">
                    <?php require('inc_menu_product.php'); ?>
                </div>
                <div class="col-lg-2">
                    <div class="search-container">
                        <img src="images/search.png" data-toggle="modal" data-target="#myModal4" class="img-fluid"> <a href="cart_shopping.php"><img src="images/shopping.png" class="img-fluid"></a> <div>0</div> <img src="images/menu.png" data-toggle="modal" data-target="#myModal3" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
        <div class="modal right fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel3"></h4>
                    </div>

                    <div class="modal-body">
                        <ul class="menu_web">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About us</a></li>
                            <li><a href="products.php">Products</a></li>
                            <li><a href="news_promotions.php">New & Promotion</a></li>
                            <li><a href="contact.php">Contact us</a></li>
                            <li><a href="payment-confirmed.php">Payment</a></li>
                            <li><a href="profile-tracking.php">Order tracking</a></li>
                        </ul>
                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->
    <!-- Modal -->
        <div class="modal right fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel3"></h4>
                    </div>

                    <div class="modal-body form_center">
                    <input class="form-search" type="text" placeholder="Search"><button class="search" type="submit">Search</button>
                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->

</div>
<div class="mobile_menu d-block d-sm-block d-md-block d-lg-none d-xl-none">
    <div class="navbg text_top">
        <p>Shop Events & save up to <span>65% off!</span></p>
    </div>
    <div class="border_mid"></div>
    <div class="navbg wrap_menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div data-toggle="modal" data-target="#myModal" class="menumobileslide">
                        <img src="images/menu.png" class="img_s">
                    </div>
                    <!-- Modal -->
                    <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <div class="modal-title" id="myModalLabel"><a href="index.php"><img src="images/logo_mistine_myanmar.png" style="width: 70px;
    margin-top: -10px;"></a></div>
                                </div>

                                <div class="modal-body" style="padding:0px;">
                                    <div id="menu" class="">
                                        <div class="menu-box">
                                            <div class="menu-wrapper-inner">
                                                <div class="menu-wrapper">
                                                    <div class="menu-slider">
                                                        <div class="menu">
                                                            <ul>
                                                                <li>
                                                                    <div class="login_guest">
                                                                        <div class="left_menu">
                                                                            <div class="pic_sos_welcome">
                                                                                <img src="images/img_member.jpg" class="img-fluid">
                                                                            </div>
                                                                        </div>

                                                                        <div class="menuguest">Hello, Guest
                                                                            <div class="loginmobile">
                                                                                <a href="login.php">Login |</a>
                                                                                <a href="register.php">Register </a>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="menu-item"><a href="#" class="menu-anchor" data-menu="7">My Account</a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>

                                                                <li>
                                                                    <div class="menu-item"><a href="#" class="menu-anchor" data-menu="8"><img src="images/flag_en.jpg" class="img-fluid smsize"> Language</a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="index.php" class="">Home</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="about.php" class="">About us</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#" class="menu-anchor" data-menu="1">Products</a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>
                                                                
                                                                
                                                                <li>
                                                                    <div class="menu-item"><a href="news_promotions.php" class="">News & Promotions</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="contact.php" class="">Contact us</a></div>
                                                                </li>
                                                                

                                                                <li>
                                                                    <div class="menu-item"><a href="payment-confirmed.php">Payment </a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="profile-tracking.php">Order tracking </a></div>
                                                                </li>
                                                                
                                                            </ul>
                                                        </div>
                                                        <div class="submenu menu" data-menu="1">
                                                            <div class="submenu-back">
                                                                <div class="menu-item"><div class="detail_back"><i class="fa fa-angle-left" aria-hidden="true"></i></div><a href="#" class="menu-back">Back</a></div>
                                                            </div>
                                                            <ul>
                                                                <li>
                                                                    <div class="menu-item"><a href="products.php">View all</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#" class="menu-anchor" data-menu="5">Make up</a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#" class="menu-anchor">Skin Care</a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#" class="menu-anchor">Fragrance</a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#" class="menu-anchor">Personal Care</a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#" class="menu-anchor">Bath & Body</a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#" class="menu-anchor">Hair </a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#" class="menu-anchor">Blush & Tools & Accessories</a><div class="detail"><i class="fa fa-angle-right" aria-hidden="true"></i></div></div>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                        


                                                        <div class="submenu menu" data-menu="5">
                                                            <div class="submenu-back">
                                                                <div class="menu-item"><div class="detail_back"><i class="fa fa-angle-left" aria-hidden="true"></i></div><a href="#" class="menu-back">Back</a></div>
                                                            </div>
                                                            <ul>
                                                                <li>
                                                                    <div class="menu-item"><a href="product_index.php">Shop all Make up</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#">face</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#">Lips</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#">Eye</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#">Palettes</a></div>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="submenu menu" data-menu="7">
                                                            <div class="submenu-back">
                                                                <div class="menu-item"><div class="detail_back"><i class="fa fa-angle-left" aria-hidden="true"></i></div><a href="#" class="menu-back">Back</a></div>
                                                            </div>
                                                            <ul>
                                                                <li>
                                                                    <div class="menu-item"><a href="member1.php"> My Account</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="member2.php"> Personal Information</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="member3.php"> Delivery Information</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="member4.php"> My Wishlist</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="member6.php"> My Vouchers</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="member7.php"> My Returns</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="member8.php"> Cancel</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="member5.php"> Change Password</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="index.php"> Logout</a></div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="submenu menu" data-menu="8">
                                                            <div class="submenu-back">
                                                                <div class="menu-item"><div class="detail_back"><i class="fa fa-angle-left" aria-hidden="true"></i></div><a href="#" class="menu-back">Back</a></div>
                                                            </div>
                                                            <ul>
                                                                <li>
                                                                    <div class="menu-item"><a href="#">En</a></div>
                                                                </li>
                                                                <li>
                                                                    <div class="menu-item"><a href="#">Bur</a></div>
                                                                </li>

                                                            </ul>
                                                        </div>


                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- modal-content -->
                        </div>
                        <!-- modal-dialog -->
                    </div>
                    <!-- modal -->


                    <div class="search_mobile_1">
                        <a data-fancybox data-src="#search_content" href="javascript:;" class="lightgray">
                            <img src="images/search.png" class="smsize">
                        </a>
                        <div style="display: none;" id="search_content">
                            <label>Search here</label>
                            <input type="text" class="form-control" placeholder="Search..">
                            <br>
                            <a href="#" class="btn btn-info">Search</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mainlogo_mobile">
                        <a href="index.php"> <img src="images/logo_mistine_myanmar.png"></a>
                    </div>

                </div>
                <div class="col-3">
                    <div data-toggle="modal" data-target="#myModal2" class="cart_mobile">
                        <img src="images/shopping.png" class="smsize"> 1
                    </div>
                </div>
            </div>
        </div>
         <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">Shopping Cart</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-5 col-md-4 col-lg-3">
                                <div class="bag_produt">
                                    <img src="images/product/product1.jpg" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-7 col-md-5 col-lg-6" style="padding-left:0px;">
                                <div class="new_item">
                                    <h5>#00001</h5>
                                    <h3 class="mt-1">Mystin XB.Duck Sunscreen Facial Care SPF</h3>
                                    <li class="smtxt"> <div class="product-quantity" style="padding-bottom: 8px;">
                                        Quantity :
                                            <div class="product-quantity-subtract" style="border: none; background: none; width: 25px; height: 25px;">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <input type="text" id="product-quantity-input" placeholder="0" value="0" style="width: 25px; height: 25px; font-size: 13px;">
                                            </div>
                                            <div class="product-quantity-add" style="border: none; background: none; padding-left: 4px; width: 25px; height: 25px;">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                        </div></li>
                                    <li class="smtxt">Weight : <span class="lightgray">250 ml.</span></li>
                                </div>

                                <div class="d-block d-sm-block d-md-none d-lg-none d-xl-none">
                                    <p>159 USD</p>
                                    <a href="#" class="remove">Remove</a>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 text-lg-right d-none d-sm-none d-md-block d-lg-block d-xl-block">
                                <p style="font-weight: 600;">159 USD</p>
                                <a href="#" class="remove">Remove</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-5 col-md-3">
                                <div class="bag_produt">
                                    <img src="images/product/product1.jpg" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-7 col-md-6" style="padding-left:0px;">
                                <div class="new_item">
                                    <h5>#00002</h5>
                                    <h3 class="mt-1">Mystin XB.Duck Sunscreen Facial Care SPF</h3>
                                    <li class="smtxt"> <div class="product-quantity" style="padding-bottom: 8px;">
                                        Quantity :
                                            <div class="product-quantity-subtract" style="border: none; background: none; width: 25px; height: 25px;">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <input type="text" id="product-quantity-input" placeholder="0" value="0" style="width: 25px; height: 25px; font-size: 13px;">
                                            </div>
                                            <div class="product-quantity-add" style="border: none; background: none; padding-left: 4px; width: 25px; height: 25px;">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                        </div></li>
                                    <li class="smtxt">Weight : <span class="lightgray">250 ml.</span></li>
                                </div>

                                <div class="d-block d-sm-block d-md-none d-lg-none d-xl-none">
                                    <p style="font-weight: 600;">159 USD</p>
                                    <a href="#" class="remove">Remove</a>
                                </div>
                            </div>
                            <div class="col-md-3 text-lg-right d-none d-sm-none d-md-block d-lg-block d-xl-block">
                                <p>159 USD</p>
                                <a href="#" class="remove">Remove</a>
                            </div>
                        </div>

                        <hr>
                        <div class="bot_bag">
                            <div class="row">
                                <div class="col-md-3">
                                    Total Price
                                </div>

                                <div class="col-md-9" style="font-weight: 600; text-align: right;">
                                    318 USD
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6" style="padding-right: 0;">
                                    <div class="buttun_cartcontinue"><a href="products.php">Continue Shopping</a></div>
                                </div>
                                <div class="col-md-6" style="padding-left: 0;">
                                    <div class="buttun_cartpayment"><a href="shippingaddress.php">Payment</a></div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->

    </div>
</div>


<script>
    $(window).scroll(function() {
        if ($(this).scrollTop() > 350) {
            $('.wrap_menu').addClass("sticky");
        } else {
            $('.wrap_menu').removeClass("sticky");
        }
    });
</script>

<script>
    var menu_width;

    jQuery(document).ready(
        function() {

            initMenu();

        });

    function initMenu() {
        menu_width = $("#menu .menu").width();

        $(".menu-back").click(function() {

            var _pos = $(".menu-slider").position().left + menu_width;
            var _obj = $(this).closest(".submenu");

            $(".menu-slider").stop().animate({
                left: _pos
            }, 300, function() {
                _obj.hide();
            });

            return false;
        });

        $(".menu-anchor").click(function() {
            var _d = $(this).data('menu');
            $(".submenu").each(function() {

                var _d_check = $(this).data('menu');

                if (_d_check == _d) {
                    $(this).show();
                    var _pos = $(".menu-slider").position().left - menu_width;

                    $(".menu-slider").stop(true, true).animate({
                        left: _pos
                    }, 300);
                    return false;
                }
            });

            return false;
        });

    }
</script>

<script>
    $(document).ready(function() {
        $('.btn_join_us').click(function(event) {
            $('.login').hide();
            $('.join_us').fadeIn();
            event.preventDefault();
        });
        $('.btn_login').click(function(event) {
            $('.join_us').hide();
            $('.login').fadeIn();
            event.preventDefault();
        });
    });
</script>