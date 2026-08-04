<style>
    .sidemenumem>li.active {
        background-color: #ec008c;
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
    }
    @media (max-width: 991px) {
        .sidemenumem{
            display: none;
        }
        .menu_productxs{
            display: block;
        }
        .sidemenumem li{
            padding: 3px 15px;
        }
        .sidemenumem{
            margin-bottom: 20px;
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
<div class="img_member"><img src="<?php echo base_frontend('images/img_member.jpg');?>" class="img-fluid"></div>

<ul class="sidemenumem">
    <li>
        <a href="<?php echo site_url('frontend/path/member1');?>">
             <i class="fa fa-user" aria-hidden="true"></i> My Account
        </a>
    </li>
    <li>
        <a href="<?php echo site_url('frontend/path/member2');?>">
             <i class="fa fa-list-ul" aria-hidden="true"></i> Personal Information
        </a>
    </li>
    <li>
        <a href="<?php echo site_url('frontend/path/member3');?>">
             <i class="fa fa-truck" aria-hidden="true"></i> Delivery Information
        </a>
    </li>
    <li>
        <a href="<?php echo site_url('frontend/path/member4');?>">
             <i class="fa fa-heart" aria-hidden="true"></i> My Wishlist
        </a>
    </li>
    <li>
        <a href="<?php echo site_url('frontend/path/member6');?>">
             <i class="fa fa-ticket" aria-hidden="true"></i> My Vouchers
        </a>
    </li>
    <li>
        <a href="<?php echo site_url('frontend/path/member7');?>">
             <i class="fa fa-refresh" aria-hidden="true"></i> My Returns
        </a>
    </li>
    <li>
        <a href="<?php echo site_url('frontend/path/member8');?>">
             <i class="fa fa-ban" aria-hidden="true"></i> Cancel
        </a>
    </li>
    <li>
        <a href="<?php echo site_url('frontend/path/member5');?>">
             <i class="fa fa-asterisk" aria-hidden="true"></i> Change Password
        </a>
    </li>
    <li>
        <a href="<?php echo site_url('frontend/path/index');?>">
             <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
        </a>
    </li>
</ul>

