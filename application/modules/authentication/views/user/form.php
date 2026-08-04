		<!-- begin #content -->
		<div id="content" class="content">
			
			<!-- begin page-header -->
			<h1 class="page-header">Managed Form <small><?php if(!empty($title)) echo $title;?></small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
<?php
	$this->form_validation->set_error_delimiters('<div style="color:red; padding-bottom:5px;" class="form-control parsley-error">', '</div><br>'); 
	echo validation_errors(); 
?>
                <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?php if(!empty($title)) echo $title;?></h4>
                        </div>
                        <div class="panel-body">
<?php
if(!empty($id)) {
?>
							<form class="form-horizontal" id="form_user" action="<?php echo site_url('authentication/backend/user_save_update/'.$id);?>" method="post" enctype="multipart/form-data">
<?php
} else {
?>
							<form class="form-horizontal" id="form_user" action="<?php echo site_url('authentication/backend/user_save_update');?>" method="post" enctype="multipart/form-data">
<?php
}
?>                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Username</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Username" name="user_username" id="user_username" value="<?php if(!empty($row)) echo $row->user_username;?>" onblur="checkUsername(this.value);" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Password" name="user_password" id="user_password" value="<?php if(!empty($row)) echo $row->user_password;?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Name" name="user_name" id="user_name" value="<?php if(!empty($row)) echo $row->user_name;?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Email" name="user_email" id="user_email" value="<?php if(!empty($row)) echo $row->user_email;?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Department</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="department_id" id="department_id" onchange="changeDepartment(this.value);">
                                        	<option value="">Please Select</option>
<?php
if(!empty($rows_department)) {
	foreach($rows_department as $r) {
?>
											<option value="<?php echo $r->department_id;?>" <?php if(!empty($row)) { if($row->department_id == $r->department_id) echo ' selected'; }?>><?php echo $r->department_name;?></option>
<?php
	}
}
?>                                 
                                        </select>
                                    </div>
                                </div> 
                                <span id="ajaxBrand">
<?php
if(!empty($row)) {
	if($row->department_id == 4) {
		$rows = $this->model_authentication->getBrandList();
?>
								<div class="form-group">
                                    <label class="col-md-3 control-label">Brand</label>
                                    <div class="col-md-9">
<?php
		if(!empty($rows)) {
			foreach($rows as $r) {
				$checked = false;
				$exp = explode(', ', $row->user_brand);
				if(!empty($exp)) {
					foreach($exp as $e) {
						if($e == $r->brand_id) {
							$checked = true;
						}
					}
				}
?>
										<input type="checkbox" name="user_brand[]" id="user_brand" value="<?php echo $r->brand_id;?>" <?php if($checked == true) echo 'checked';?> /> <?php echo $r->brand_name_th.' / '.$r->brand_name_en;?><br>
<?php
			}
		}	
?>
                                    </div>
                                </div>
<?php
	}
}
?>
                                </span>                               
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Activated</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="user_activated" value="1" <?php if(!empty($row)) { if($row->user_activated == '1') echo ' checked'; }?> />
                                                Enable
                                            </label>
                                        </div>                                     
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="user_activated" value="0" <?php if(!empty($row)) { if($row->user_activated == '0') echo ' checked'; }?> />
                                                Disable
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">&nbsp;</label>
                                    	<div class="col-md-9">
		                                	<button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
		                                    <button type="reset" class="btn btn-sm btn-default">Reset</button>
                                   	 </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
            </div>
            <!-- end row -->
            
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	<!-- </div> -->
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
		
		function checkUsername(user_username) {
			$.post('<?php echo site_url("user/backend/ajaxCheckUsername");?>', { user_username: user_username, user_id: '<?php echo $messages;?>' }, function(data) {
				if(data == true) {
					alert('Username Already');
					
					$("#user_username").val('');
					$("#user_username").focus();		
				}
			});
		}
		
		function changeDepartment(department_id) {
			if(department_id == 4) {
				$.post('<?php echo site_url("authentication/backend/ajaxBrand");?>', function(data) {
					$("#ajaxBrand").html(data);	
				});
			}
		}
	</script>
</body>
</html>
