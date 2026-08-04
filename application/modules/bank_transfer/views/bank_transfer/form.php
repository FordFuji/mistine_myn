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
							<form action="<?php echo site_url('bank_transfer/backend/save_update/');?>" method="post" enctype="multipart/form-data" class="form-horizontal">
<?php
if(!empty($rows)) {
	$i = 1;
	foreach($rows as $r) {
?>
							<legend>Bank <?php echo $i;?></legend>
							<div class="form-group">
					            <label class="col-md-3 control-label">Image</label>
					            <div class="col-md-9">
                       				<input type="file" name="bank_transfer_image[]" class="form-control">
<?php
		if($r->bank_transfer_image != '') {
?>
									<br><img src="<?php echo base_url('uploads/bank_transfer/'.$r->bank_transfer_image);?>" width="100"> <a href="<?php echo site_url('bank_transfer/backend/deleteBankTransfer/'.$i);?>" onclick="return confirm('Confrim Delete');">Delete</a>
<?php
		}
?>                   
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Name (En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="bank_transfer_name_lang1[]" value="<?php echo $r->bank_transfer_name_lang1;?>" class="form-control">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Name (Myan)</label>
					            <div class="col-md-9">
                       				<input type="text" name="bank_transfer_name_lang2[]" value="<?php echo $r->bank_transfer_name_lang2;?>" class="form-control">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Branch (En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="bank_transfer_branch_lang1[]" value="<?php echo $r->bank_transfer_branch_lang1;?>" class="form-control">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Branch (Myan)</label>
					            <div class="col-md-9">
                       				<input type="text" name="bank_transfer_branch_lang2[]" value="<?php echo $r->bank_transfer_branch_lang2;?>" class="form-control">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Number</label>
					            <div class="col-md-9">
                       				<input type="text" name="bank_transfer_number[]" value="<?php echo $r->bank_transfer_number;?>" class="form-control">
					            </div>
					        </div>
<?php
		$i++;
	}
}
?>					
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
			CKEDITOR.instances.ford_ckeditor.setData('');
		}
	</script>
</body>
</html>
