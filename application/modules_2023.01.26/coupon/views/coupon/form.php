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
							<form action="<?php echo site_url('coupon/backend/save_update/'.$id);?>" method="post" enctype="multipart/form-data" class="form-horizontal">
					        <div class="form-group">
					            <label class="col-md-3 control-label">Code</label>
					            <div class="col-md-9">
                       				<input type="text" name="coupon_code" id="coupon_code" class="form-control" value="<?php if(!empty($row)) echo $row->coupon_code;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Discount</label>
					            <div class="col-md-9">
                       				<input type="number" name="coupon_discount" id="coupon_discount" class="form-control" value="<?php if(!empty($row)) echo $row->coupon_discount;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Type</label>
					            <div class="col-md-9">
                       				<select name="coupon_type" id="coupon_code" class="form-control">
                       					<option value="">Please Select</option>
                       					<option value="%" <?php if(!empty($row) and $row->coupon_type == '%') echo 'selected';?>>%</option>
                       					<option value="KS" <?php if(!empty($row) and $row->coupon_type == 'KS') echo 'selected';?>>KS</option>
                       				</select>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Limit</label>
					            <div class="col-md-9">
                       				<input type="number" name="coupon_limit" id="coupon_limit" class="form-control" value="<?php if(!empty($row)) echo $row->coupon_limit;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Begin Date</label>
					            <div class="col-md-9">
                       				<input type="text" name="coupon_begin_datetime" id="coupon_begin_datetime" class="form-control" value="<?php if(!empty($row)) echo $row->coupon_begin_datetime;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">End Date</label>
					            <div class="col-md-9">
                       				<input type="text" name="coupon_end_datetime" id="coupon_end_datetime" class="form-control" value="<?php if(!empty($row)) echo $row->coupon_end_datetime;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">&nbsp;</label>
					            <div class="col-md-9">
                       				<input type="checkbox" name="coupon_member" id="coupon_member" <?php if(!empty($row) and $row->coupon_member == 'Yes') echo 'checked';?>> Member
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
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/backend/datetimepicker-master/jquery.datetimepicker.css');?>"/>
	<script src="<?php echo base_url('asset/backend/datetimepicker-master/build/jquery.datetimepicker.full.js');?>"></script>

	<script>
	    /*jslint browser:true*/
	    /*global jQuery, document*/

	    jQuery(document).ready(function () {
	        'use strict';

	        jQuery('#coupon_begin_datetime, #coupon_end_datetime').datetimepicker({format: 'Y-m-d H:i'});
	    });
	</script>

	<script>
		$(document).ready(function() {
			App.init();
		});
		
		function resetForm() {
			$(".form-control").val('');
			CKEDITOR.instances.coupon_ckeditor.setData('');
		}
	</script>
</body>
</html>
