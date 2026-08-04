<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
</head>

<style>
    .panel-title>a,
    .panel-title>a:active {
        font-size: 16px;
    }

    .panel-heading.active a:before {
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .panel-heading a:before {
        font-family: 'FontAwesome';
        content: "\f107";
        float: right;
        transition: all 0.5s;
    }
    .panel-heading h4 a{
        font-weight: 300;
    }
    .text_panel p{
        margin-bottom: 5px;
        font-size: 14px;
        padding: 10px 0; 
        color: #666;
    }
    .panel-heading h4{
        font-size: 18px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.07);
        padding: 15px 0;
    }
    @media (max-width: 1199px) {
        .panel-title>a,
        .panel-title>a:active {
            font-size: 14px;
        }
        .panel-heading h4{
            padding: 10px 0;
            font-size: 16px;
        }
    }
</style>

<body>
    <?php require('inc_menu.php'); ?>

    <div class="container-fluid ba_gary">
        <div class="container">
            <div class="row">
                <div class="col-12 pad_account_1">
                    <div class="boxtext_help">
                        <h2>Help</h2>
                    </div>
                    <div class="row pad_account">
                        <div class="col-12 col-md-12 col-lg-3">
                            <?php require('inc_help.php'); ?>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9 bg_payment">
                            <div class="text-myaccount">
                                <h5>Question</h5>
                            </div>
                            <div class="wrapper center-block">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php
if(!empty($questionCtrl)) {
    $i = 0;
    foreach($questionCtrl as $r) {
?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading <?php if($i == 0) echo 'active';?>" role="tab" id="heading<?php echo $i;?>">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>" aria-expanded="<?php if($i == 0) echo 'true'; else echo 'false';?>" aria-controls="collapse<?php echo $i;?>">
                                                    <?php echo get2Lang($this->session->userdata('lang'), $r->faq_q_lang1, $r->faq_q_lang2);?>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse<?php echo $i;?>" class="panel-collapse collapse <?php if($i == 0) echo 'in show';?>" role="tabpanel" aria-labelledby="heading<?php echo $i;?>">
                                            <div class="panel-body">
                                                <div class="text_panel">
                                                    <p><?php echo get2Lang($this->session->userdata('lang'), $r->faq_a_lang1, $r->faq_a_lang2);?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<?php
        $i++;
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
        <?php require('inc_footer.php'); ?>
        <script>
            $('.sidemenumem li:nth-child(3) ').addClass('active');
        </script>
        <script>
            $('.panel-collapse').on('show.bs.collapse', function() {
                $(this).siblings('.panel-heading').addClass('active');
            });

            $('.panel-collapse').on('hide.bs.collapse', function() {
                $(this).siblings('.panel-heading').removeClass('active');
            });
        </script>
    </div>

</body>

</html>