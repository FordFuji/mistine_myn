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
							<form action="<?php echo site_url('voucher/backend/voucher_save_update/'.$id);?>" method="post" enctype="multipart/form-data" class="form-horizontal">
							<div class="form-group">
					            <label class="col-md-3 control-label">Campaign</label>
					            <div class="col-md-9">
                       				<select name="category_voucher_id" id="category_voucher_id" class="form-control">
										<option value="">Please Select</option>
<?php
if(!empty($categoryVoucherCtrl)) {
	foreach($categoryVoucherCtrl as $r) {
?>
										<option value="<?php echo $r->category_voucher_id;?>" <?php if(!empty($row) and $row->category_voucher_id == $r->category_voucher_id) echo  'selected';?>><?php echo $r->category_voucher_name;?></option>
<?php
	}
}
?>
									</select>
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Type</label>
					            <div class="col-md-9">
                       				<input type="radio" name="voucher_type" id="voucher_type" value="Free Shipping" <?php if(!empty($row) and $row->voucher_type == 'Free Shipping') echo 'checked';?> onclick="checkFreeShipping();"> Free Shipping
									<input type="radio" name="voucher_type" id="voucher_type" value="%" <?php if(!empty($row) and $row->voucher_type == '%') echo 'checked';?> onclick="checkPercent();"> %
									<input type="radio" name="voucher_type" id="voucher_type" value="KS" <?php if(!empty($row) and $row->voucher_type == 'KS') echo 'checked';?> onclick="checkKS();"> KS
					            </div>
					        </div>
<?php
if(!empty($row) and ($row->voucher_type == '%' or $row->voucher_type == 'KS')) {
	$display = 'block';
} else {
	$display = 'none';
}
?>
							<div class="form-group percent" style="display:<?php echo $display;?>;">
					            <label class="col-md-3 control-label type_text"><?php if(!empty($row)) echo $row->voucher_type;?></label>
					            <div class="col-md-9">
                       				<input type="number" name="voucher_price" id="voucher_price" value="<?php if(!empty($row)) echo $row->voucher_price;?>" class="form-control">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Expired</label>
					            <div class="col-md-9">
                       				<input type="text" name="voucher_expired_date" id="voucher_expired_date" value="<?php if(!empty($row)) echo $row->voucher_expired_date;?>" class="form-control">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Stock</label>
					            <div class="col-md-9">
                       				<input type="number" name="voucher_stock" id="voucher_stock" value="<?php if(!empty($row)) echo $row->voucher_stock;?>" class="form-control">
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
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$(function() {
		$("#voucher_expired_date").datepicker({ dateFormat: 'yy-mm-dd' });
	});
	</script>

	<script>
		$(document).ready(function() {
			App.init();
		});
		
		function resetForm() {
			$(".form-control").val('');
			CKEDITOR.instances.voucher_ckeditor.setData('');
		}

		function checkFreeShipping() {
			$(".percent").hide();
		}

		function checkPercent() {
			$(".percent").show();

			$(".type_text").html('%');
		}

		function checkKS() {
			$(".percent").show();

			$(".type_text").html('KS');
		}
	</script>
</body>
</html>
