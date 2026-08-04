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
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Name</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_name;?>
					            </div>
					        </div>
					        <br>
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Phone Number</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_phone;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Email</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_email;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Property Type</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->type_name_en;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Purpose</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_purpose;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Address</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_address;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Size</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_size;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">No. of Bedroom</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_no_of_bedroom;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">No. of Bathroom</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_no_of_bathroom;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Rental Price</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_rental_price;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Sale Price</label>
					            <div class="col-md-9">
                       				<?php if(!empty($row)) echo $row->property_register_sale_price;?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Units Features</label>
					            <div class="col-md-9">
<?php 
$unit_text = '';
if(!empty($unitCtrl)) {
	foreach($unitCtrl as $r) {
		$unit_text .= $r->units_features_name_en.', ';
	}
	
	if($unit_text != '') {
		echo substr($unit_text, 0, -2);
	}
}

?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Project Facilities</label>
					            <div class="col-md-9">
<?php 
$project_text = '';
if(!empty($projectCtrl)) {
	foreach($projectCtrl as $r) {
		$project_text .= $r->project_facilities_name_en.', ';
	}
	
	if($project_text != '') {
		echo substr($project_text, 0, -2);
	}
}

?>
					            </div>
					        </div>
					        <br>  
					        <div class="form-group">
					            <label class="col-md-3 control-label" align="right">Property Picture</label>
					            <div class="col-md-9">
<?php 
if(!empty($galleryCtrl)) {
	foreach($galleryCtrl as $r) {
		echo '<img src="'.base_url('uploads/property/'.$r->property_register_gallery_image).'" width="350"><p>&nbsp;</p>';
	}
}
?>
					            </div>
					        </div>
					        <br>                 
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
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
	<script>
		$(document).ready(function() {
			App.init();
		});
		
		$( function() {
    		$( "#property_register_date_update" ).datepicker({ dateFormat: 'yy-mm-dd' });
  		} );
		
		function resetForm() {
			$(".form-control").val('');
			CKEDITOR.instances.property_register_ckeditor.setData('');
		}
	</script>
</body>
</html>
