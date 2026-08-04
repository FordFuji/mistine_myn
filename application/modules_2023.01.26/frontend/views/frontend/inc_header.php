<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="robot" content="index, follow" />
<meta name="generator" content="Brackets">
<meta name='copyright' content='Orange Technology Solution co.,ltd.'>
<meta name='designer' content='Sudarat Tu.'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link type="image/ico" rel="shortcut icon" href="<?php echo base_frontend('images/favicon.ico');?>">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins|Prompt&display=swap" rel="stylesheet">
<link href="<?php echo base_frontend('css/bootstrap.min.css');?>" rel="stylesheet">
<link href="<?php echo base_frontend('css/jquery-ui.min.css');?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_frontend('css/style.css');?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_frontend('font-awesome-4.7.0/css/font-awesome.css');?>">
<link rel="stylesheet" href="<?php echo base_frontend('flexslider/flexslider.css');?>" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo base_frontend('master/css/libs/animate.css');?>">

<script src="<?php echo base_frontend('js/jquery.min.js');?>"></script>
<script defer src="<?php echo base_frontend('flexslider/jquery.flexslider.js');?>"></script>
<script type="text/javascript" src="<?php echo base_frontend('flexslider/js/shCore.js');?>"></script>
<script type="text/javascript" src="<?php echo base_frontend('flexslider/js/shBrushJScript.js');?>"></script>
<script src="<?php echo base_frontend('flexslider/js/modernizr.js');?>"></script>
<script src="<?php echo base_frontend('js/popper.min.js');?>"></script>
<script src="<?php echo base_frontend('js/tether.min.js');?>"></script>
<script src="<?php echo base_frontend('js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_frontend('master/dist/wow.js');?>"></script>
<script>
    wow = new WOW({
        animateClass: 'animated',
        offset: 100,
        callback: function(box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
    });
    wow.init();
</script>
<?php
    if(empty($_title))    $_title ='Mistine';
?>
<title>
    <?php echo $_title;?>
</title>
<?php
$social_inc = $this->model_frontend->getLinkSocial();
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-224072627-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-224072627-1');
</script>
