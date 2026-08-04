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
if(empty($id)) {
	$id = '';
}
?>
							<form action="<?php echo site_url('data_property/backend/units_features_save_update/'.$id);?>" method="post" enctype="multipart/form-data" class="form-horizontal">
							<div class="form-group">
					            <label class="col-md-3 control-label">Image 1</label>
					            <div class="col-md-9">
                       				<input type="file" name="units_features_name_image1" id="units_features_name_image1" class="form-control"> Recommend 38 x 30 px
<?php
if(!empty($row)) {
	if($row->units_features_name_image1 != '') {
?>
									<br><img src="<?php echo base_url('uploads/units_features/'.$row->units_features_name_image1);?>" width="150">							
<?php
	}
}
?>
                       				
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Image 2</label>
					            <div class="col-md-9">
                       				<input type="file" name="units_features_name_image2" id="units_features_name_image2" class="form-control"> Recommend 85 x 87 px
<?php
if(!empty($row)) {
	if($row->units_features_name_image2 != '') {
?>
									<br><img src="<?php echo base_url('uploads/units_features/'.$row->units_features_name_image2);?>" width="150">							
<?php
	}
}
?>
                       				
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Units Features(Th)</label>
					            <div class="col-md-9">
                       				<input type="text" name="units_features_name_th" id="units_features_name_th" class="form-control" value="<?php if(!empty($row)) echo $row->units_features_name_th;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Units Features(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="units_features_name_en" id="units_features_name_en" class="form-control" value="<?php if(!empty($row)) echo $row->units_features_name_en;?>">
					            </div>
					        </div>
					        <div class="form-group">
								<label class="col-md-3 control-label"> </label>
								<div class="col-md-9">
									<button class="btn btn-sm btn-primary m-r-5" type="submit">Save</button>
									<button class="btn btn-sm btn-default" onclick="resetForm();" type="button">Reset</button>
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
		
		function resetForm() {
			$(".form-control").val('');
			CKEDITOR.instances.units_features_ckeditor.setData('');
		}
	</script>
</body>
</html>
