<style>
    .sidemenumem>li.active {
        background-color:#ed1896;
    }

    .sidemenumem>li.active a {
        color: #fff;
        fill: #fff;
    }

    .sidemenumem li:nth-child(1) a {
        fill: #fff;
    }


    .sidemenumem {
        display: block;
        padding: 0;
        list-style: none;
        background-color: #f2f3f5;
    }

    .sidemenumem li {
        padding: 10px 15px;
        border-bottom: 1px solid #fff;
        background-color: #f2f3f5;
    }

    .sidemenumem li a {
        text-align: left;
        color: #000;
        fill: #777;
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
    }

    .sidemenumem i {
        width: 20px;
    }
    .menu_productxs{
        display:none
    }
    @media (max-width: 1199px){
        .sidemenumem li a{
            font-size: 14px;
        }
        .boxtext_help h2{
            font-size: 20px;
        }
    }
    @media (max-width: 991px) {
        .menu_productxs{
            display: block;
        }
        .sidemenumem li{
            padding: 3px 15px;
        }
        .sidemenumem{
            margin-bottom: 20px;
            display: none;
        }
        .menu_account {
            padding: 5px 10px 0;
            max-height: 250px;
            width: 100%;
            overflow-y: scroll;
        }
        .menuaccount_xs {
            background-color: #3d3d3d;
        }
    }
</style>
<ul class="sidemenumem">
    <li>
        <a href="<?php echo site_url('frontend/path/payment_confirmed');?>">
             <i class="fa fa-credit-card-alt" aria-hidden="true"></i> Payment
        </a>
    </li>
<?php
if($this->session->userdata('member_id') != '') {
?>
    <li>
        <a href="<?php echo site_url('frontend/path/profile_tracking');?>">
             <i class="fa fa-check-circle" aria-hidden="true"></i> Order Tracking
        </a>
    </li>
<?php
}
?>
    <li>
        <a href="<?php echo site_url('frontend/path/question');?>">
             <i class="fa fa-question-circle" aria-hidden="true"></i> Question
        </a>
    </li>
</ul>

