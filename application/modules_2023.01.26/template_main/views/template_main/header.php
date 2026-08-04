<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<base href="<?php echo base_url();?>">
	<meta charset="utf-8" />
	<title>Mistine :: <?php if(!empty($title)) { echo str_replace("_", " ", $title); } ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo base_url('asset/backend/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css');?>" rel="stylesheet');?>" />
	<link href="<?php echo base_url('asset/backend/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/css/animate.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/css/style.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/css/style-responsive.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/css/theme/default.css');?>" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="<?php echo base_url('asset/backend/plugins/DataTables/css/data-table.css');?>" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url('asset/backend/plugins/pace/pace.min.js');?>"></script>
	<!-- ================== END BASE JS ================== -->

</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="<?php echo site_url();?>" class="navbar-brand"><span class="navbar-logo"></span> Mistine</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
	
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo base_url('asset/backend/img/user-13.jpg');?>" alt="" /> 
							<span class="hidden-xs"><?php if(!empty($row_user)) echo $row_user->user_name;?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
<?php
if($this->session->userdata('session_user_department') == '1') {
?>
							<li><a href="<?php echo site_url('user/backend/form/'.$this->session->userdata('session_user_id'));?>">Edit User</a></li>
							<li class="divider"></li>
<?php
}
?>
							<li><a href="<?php echo site_url('login/backend/logout');?>">Log Out</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->