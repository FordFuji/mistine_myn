<style>
    .panel-group .panel {
        border-radius: 0;
        box-shadow: none;
        border-color: #EEEEEE;
    }

    .panel-default>.panel-heading {
        padding: 0;
        border-radius: 0;
        color: #212121;
        background-color: #FAFAFA;
        border-color: #EEEEEE;
    }

    .glyphicon-plus:before {
        content: "\2b";
    }

    .glyphicon-minus:before {
        content: "\2212";
    }

    .panel-title {
        font-size: 14px;
    }

    .panel-title>a {
        display: block;
        padding: 5px 0;
        text-decoration: none;
        font-size: 15px;
        color: #000;
    }

    .more-less {
        float: right;
        color: #212121;
    }

    .panel-default>.panel-heading {
        background: none;
        border: none;
    }

    .panel-default>.panel-heading+.panel-collapse>.panel-body {
        border-top-color: #EEEEEE;
    }

    .glyphicon {
        font-size: 16px;
        color: #ec008c;
        font-style: normal;
        font-family: 'Poppins', sans-serif;
        line-height: 16px;
        font-weight: 600;
    }

    .demo {
        padding-top: 60px;
        padding-bottom: 110px;
    }

    .demo-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        padding: 15px;
        background-color: #212121;
        text-align: center;
    }

    .demo-footer>a {
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
        color: #fff;
    }

    .category h5 {
        font-weight: 600;
        letter-spacing: 1px;
        border-bottom: 1px solid #d2cfcf;
        padding-bottom: 20px;
    }

    .pad_panel-group {
        padding-top: 10px;
    }

    .dropdown-menu.show {
        display: contents !important;
    }

    .dropdown-menu li {
        padding: 5px 20px;
    }

    .dropdown-menu li a {
        font-size: 14px;
    }

    .category_dropdown li {
        padding: 5px 20px;
    }

    .category_dropdown li a {
        color: #000;
        font-size: 14px;
        text-decoration: none;
        padding-left: 20px;
    }
    .category_dropdown li i{
        font-size: 5px;
        padding-right: 10px;
        position: absolute;
        top: 13px;
        left: 17px;
        color: #ec008c;
    }
    .category_dropdown {
        list-style: none;
    }
    .pad_category_dropdown{
        padding-bottom: 5px;
    }
    @media (max-width: 1199px){
        .category h5{
           font-size: 18px;
        }
    }
    @media (max-width: 767px){
        .category h5 {
            font-size: 16px;
            padding-bottom: 10px;
        }
        .pad_panel-group {
            padding-top: 0px;
        }
    }
</style>
<div class="category">
    <h5>Category</h5>
</div>
<div class="panel-group pad_panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php
$category1Ctrl = $this->model_frontend->getCategory1Result();
if(!empty($category1Ctrl)) {
    foreach($category1Ctrl as $r1) {
?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $r1->category1_id;?>" aria-expanded="true" aria-controls="collapse<?php echo $r1->category1_id;?>">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        <?php echo get2Lang($this->session->userdata('lang'), $r1->category1_name_lang1, $r1->category1_name_lang2);?>
                </a>
                

            </h4>
        </div>
        <div id="collapse<?php echo $r1->category1_id;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body pad_category_dropdown">
                <ul class="category_dropdown">
<?php
        $category2 = $this->model_frontend->getCategory2Result($r1->category1_id);
        if(!empty($category2)) {
            foreach($category2 as $r2) {
?>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="fa fa-circle" aria-hidden="true"></i> <?php echo get2Lang($this->session->userdata('lang'), $r2->category2_name_lang1, $r2->category2_name_lang2);?> <i class="icon-arrow"></i></a>
                        <ul class="dropdown-menu">
<?php
                $category3 = $this->model_frontend->getCategory3Result($r2->category2_id);
                if(!empty($category3)) {
                    foreach($category3 as $r3) {
?>
                            <li><a href="<?php echo site_url('frontend/path/products/category3/'.$r3->category3_id);?>"><?php echo get2Lang($this->session->userdata('lang'), $r3->category3_name_lang1, $r3->category3_name_lang2);?></a></li>
<?php
                    }
                }
/*
?>
                            <li><a href="#">Primer</a></li>
<?php
*/
?>
                        </ul>
                    </li>
<?php
            }
        }
/*
?>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="fa fa-circle" aria-hidden="true"></i> Face <i class="icon-arrow"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Blush</a></li>
                            <li><a href="#">Primer</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="fa fa-circle" aria-hidden="true"></i> Lips <i class="icon-arrow"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Lipstick</a></li>
                            <li><a href="#">Lip Balm</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"><i class="fa fa-circle" aria-hidden="true"></i> Eye <i class="icon-arrow"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Mascara</a></li>
                            <li><a href="#">Eyeliner</a></li>
                        </ul>
                    </li>
*/
?>
                </ul>
            </div>
        </div>
    </div>
<?php
    }
}
/*
?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Skin Care
                    </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Fragance  
                    </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFour">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Personal Care  
                    </a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
            <div class="panel-body">
                
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFive">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Bath & Bodt   
                    </a>
            </h4>
        </div>
        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
            <div class="panel-body">
                
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingSix">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Hair     
                    </a>
            </h4>
        </div>
        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
            <div class="panel-body">
                
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingSeven">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Blush & Tools & Accessories     
                    </a>
            </h4>
        </div>
        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
            <div class="panel-body">
                
            </div>
        </div>
    </div>
*/
?>
</div>
<!-- panel-group -->

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