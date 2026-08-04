<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo base_url('asset/backend/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/css/animate.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/css/style.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/css/style-responsive.min.css');?>" rel="stylesheet" />
	<link href="<?php echo base_url('asset/backend/css/theme/default.css');?>" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url('asset/backend/plugins/pace/pace.min.js');?>"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>
		function checkForm() {
			if($("#username").val() == '') {
				alert('Please Enter Username');
				$("#username").focus();
			} else if($("#password").val() == '') {
				alert('Please Enter Password');
				$("#password").focus();
			} else {
				$.post("<?php echo site_url('login/backend/ajax_login');?>", { username : $("#username").val(), password : $("#password").val() }, function(data) {
					if(data == '0') {
						alert('Incorrect Username, Password');
					} else {
						window.location.href = "<?php echo site_url('authentication/backend/user');?>";
					}
				});
			}
		}
	</script>
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login bg-black animated fadeInDown">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> Mistine
                    <small>Power by Orange Technology Solution</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
              	<div class="form-group m-b-20">
               		<input type="text" class="form-control input-lg" placeholder="Username" name="username" id="username" />
            	</div>
              	<div class="form-group m-b-20">
           			<input type="password" class="form-control input-lg" placeholder="Password" name="password" id="password" />
              	</div>
              	<div class="login-buttons">
                 	<button class="btn btn-success btn-block btn-lg" onclick="checkForm();">Log in</button>
             	</div>
             	<div class="checkbox m-b-20">
               		<!-- <label>
                 		<input type="checkbox" /> Remember Me
              		</label> -->
             	</div>
            </div>
        </div>
        <!-- end login -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo base_url('asset/backend/plugins/jquery/jquery-1.9.1.min.js');?>"></script>
	<script src="<?php echo base_url('asset/backend/plugins/jquery/jquery-migrate-1.1.0.min.js');?>"></script>
	<script src="<?php echo base_url('asset/backend/plugins/jquery-ui/ui/minified/jquery-ui.min.js');?>"></script>
	<script src="<?php echo base_url('asset/backend/plugins/bootstrap/js/bootstrap.min.js');?>"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo base_url('asset/backend/crossbrowserjs/html5shiv.js');?>"></script>
		<script src="<?php echo base_url('asset/backend/crossbrowserjs/respond.min.js');?>"></script>
		<script src="<?php echo base_url('asset/backend/crossbrowserjs/excanvas.min.js');?>"></script>
	<![endif]-->
	<script src="<?php echo base_url('asset/backend/plugins/slimscroll/jquery.slimscroll.min.js');?>"></script>
	<script src="<?php echo base_url('asset/backend/plugins/jquery-cookie/jquery.cookie.js');?>"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo base_url('asset/backend/js/apps.min.js');?>"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>
