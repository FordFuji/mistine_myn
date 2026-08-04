<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
    
</head>
<style>
    .return{
        text-align: center;
        background-color: #fff;
        padding: 50px;
    }
    .return h5{
        font-size: 20px;
        margin: 0;
    }
    .return a:hover {
        background-color: #dc0e89;
    }
    .return a {
        background-color: #ec008c;
        border: 1px solid #ec008c;
        color: #fff;
        display: inline-block;
        height: 33px;
        line-height: 32px;
        transition: 0.5s;
        font-size: 16px;
        border-radius: 35px;
        text-decoration: none;
        text-align: center;
        padding: 0 60px;
        margin-bottom: 20px;
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
                                <h5>My Returns</h5>
                            </div>
                            <div class="return">
                                <a href="<?php echo site_frontend('returns-step1.php');?>">Create a Return</a>
                                <h5>YOU HAVE NOT RETURNED ANY ITEMS YET</h5>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(6) ').addClass('active');
        </script>
    </div>

</body>

</html>