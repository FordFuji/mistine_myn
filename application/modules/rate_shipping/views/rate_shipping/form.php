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
							<form action="<?php echo site_url('rate_shipping/backend/save_update/'.$id);?>" method="post" enctype="multipart/form-data" class="form-horizontal">
					        <div class="form-group">
					            <label class="col-md-3 control-label">State/Region</label>
					            <div class="col-md-9">
                       				<input type="text" name="rate_shipping_location" id="rate_shipping_location" class="form-control" value="<?php if(!empty($row)) echo $row->rate_shipping_location;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Township</label>
					            <div class="col-md-9">
                       				<input type="text" name="rate_shipping_township" id="rate_shipping_township" class="form-control" value="<?php if(!empty($row)) echo $row->rate_shipping_township;?>">
					            </div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">ค่าขนส่ง น้ำหนักขั้นต่ำ (KS)</label>
								<div class="col-md-1">
                       				<input type="number" name="rate_shipping_amount" id="rate_shipping_amount" class="form-control" value="<?php if(!empty($row)) echo $row->rate_shipping_amount;?>">
					            </div>
								<label class="col-md-2 control-label">จำนวนน้ำหนักขั้นต่ำ (KG)</label>
								<div class="col-md-1">
                       				<input type="number" name="rate_shipping_pre_weight" id="rate_shipping_pre_weight" class="form-control" value="<?php if(!empty($row)) echo $row->rate_shipping_pre_weight;?>">
					            </div>
								<label class="col-md-2 control-label">เพิ่มทุกกี่กิโล (KG)</label>
								<div class="col-md-1">
                       				<input type="number" name="rate_shipping_add_kg" id="rate_shipping_add_kg" class="form-control" value="<?php if(!empty($row)) echo $row->rate_shipping_add_kg;?>">
					            </div>
								<label class="col-md-1 control-label">ค่าขนส่งเพิ่มขึ้นทีละ (KS)</label>
								<div class="col-md-1">
                       				<input type="number" name="rate_shipping_add_money" id="rate_shipping_add_money" class="form-control" value="<?php if(!empty($row)) echo $row->rate_shipping_add_money;?>">
					            </div>
					        </div>
							<div class="form-group">
								<label class="col-md-3 control-label">ระยะเวลาการขนส่ง(วัน)</label>
								<div class="col-md-3">
                       				<input type="text" name="rate_shipping_delivered_date" id="rate_shipping_delivered_date" class="form-control" value="<?php if(!empty($row)) echo $row->rate_shipping_delivered_date;?>">
					            </div>
								<div class="col-md-6">&nbsp;</div>
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
			CKEDITOR.instances.rate_shipping_ckeditor.setData('');
		}
	</script>
</body>
</html>
