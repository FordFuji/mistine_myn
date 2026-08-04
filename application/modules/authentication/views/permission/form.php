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
							<form class="form-horizontal" id="form_profile" action="<?php echo site_url('authentication/backend/permission_save_update/'.$id);?>" method="post" enctype="multipart/form-data">
<?php
} else {
?>
							<form class="form-horizontal" id="form_profile" action="<?php echo site_url('authentication/backend/permission_save_update');?>" method="post" enctype="multipart/form-data">
<?php
}
?>                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Department</label>
                                    <div class="col-md-9">
                                        <?php if(!empty($row)) echo $row->department_name;?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Menu</label>
                                    <div class="col-md-9">
<?php
if(!empty($rows_menu)) {
	foreach($rows_menu as $menu) {
		$check = '';
?>                                
                                        <input type="checkbox" name="department_menu[]" value="<?php echo $menu->menu_id;?>" 
<?php 
		$menu_id = explode(', ', $row->department_menu);
		if(!empty($menu_id)) {
			foreach($menu_id as $r) {
				if($r == $menu->menu_id) {
					//echo $r;
					$check = ' checked';
				}
			}
		}
?> 
										<?php echo $check;?> /> <?php echo $menu->menu_name;?><br>
<?php   
		if(!empty($rows_sub_menu_authen)) {
			foreach($rows_sub_menu_authen as $sub_menu) {
				$sub_check = '';
				if($menu->menu_id == $sub_menu->menu_id) {
?>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="department_sub_menu[]" value="<?php echo $sub_menu->sub_menu_id;?>"
<?php 
					$sub_menu_id = explode(', ', $row->department_sub_menu);
					if(!empty($sub_menu_id)) {
						foreach($sub_menu_id as $r) {
							if($r == $sub_menu->sub_menu_id) {
								//echo $r;
								$sub_check = ' checked';
							}
						}
					}
?>										
										 <?php echo $sub_check;?> /> <?php echo $sub_menu->sub_menu_name;?><br>
<?php
				}
			}
		}                                     
	}
}
?>                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">&nbsp;</label>
                                    	<div class="col-md-9">
                                    		<input type="hidden" name="id" value="<?php if(!empty($id)) echo $id;?>">
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
		
		function change_collector_messenger() {
			//alert($("#department_id").val());
			if($("#department_id").val() == '3' || $("#department_id").val() == '4') {
				$.post('<?php echo site_url("profile/backend/sale_id");?>', function(data) {
					$("#div_sale_id").html(data);
				});
			} else {
				$("#div_sale_id").html('');
			}
		}
	</script>
</body>
</html>
