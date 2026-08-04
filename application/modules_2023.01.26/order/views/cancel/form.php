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
							<form action="<?php echo site_url('order/backend/order_save_update/'.$id);?>" method="post" enctype="multipart/form-data" class="form-horizontal">
							<div class="form-group">
					            <label class="col-md-3 control-label">Order No</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_no;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Member</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row) and $row->member_id == 0) echo 'No'; else echo 'Yes';?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Shipping Method</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_shipping_method;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Payment Method</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_payment_method;?>
					            </div>
					        </div>
<?php 
if(!empty($row) and $row->order_detail_payment_method == 'Transfer money / payment via bank channel') {
	$row_bank = $this->model_order->getBankRecord($id);
	if(!empty($row_bank)) {
?>					     
					        <div class="form-group">
					            <label class="col-md-3 control-label">Bank</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php echo $row_bank->bank_transfer_name_lang1.' '.$row_bank->bank_transfer_branch_lang1.' '.$row_bank->bank_transfer_number;?>
					            </div>
					        </div>	
<?php
	}
}
?>					    
							<div class="form-group">
					            <label class="col-md-3 control-label">Status</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_status;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Name</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_shipping_name;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Last Name</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_shipping_last_name;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Phone</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_shipping_phone;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Email</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_shipping_email;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Address</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_shipping_address;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Sub District</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_shipping_sub_district;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">District</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_shipping_district;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Province</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $this->model_order->getProvinceRecord($row->order_detail_shipping_province);?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Postal Code</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_shipping_postal_code;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Sub Total</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo number_format($row->order_detail_sub_total, 0, '.', ',');?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Shipping</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo number_format($row->order_detail_shipping, 0, '.', ',');?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Discount</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo number_format($row->order_detail_discount, 0, '.', ',');?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Total</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo number_format($row->order_detail_total, 0, '.', ',');?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">Datetime Create</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_datetime_create;?>
					            </div>
					        </div>	
							<div class="form-group">
					            <label class="col-md-3 control-label">IP Create</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<?php if(!empty($row)) echo $row->order_detail_ip_create;?>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Status</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<select name="order_detail_status" id="order_detail_status" class="form-control" onchange="changeStatusOrder(this.value, '<?php echo $id;?>');">
                       					<option value="Order" <?php if(!empty($row) and $row->order_detail_status == 'Order') echo 'selected';?>>Order</option>
                       					<option value="Processing" <?php if(!empty($row) and $row->order_detail_status == 'Processing') echo 'selected';?>>Processing</option>
                       					<option value="Shipped" <?php if(!empty($row) and $row->order_detail_status == 'Shipped') echo 'selected';?>>Shipped</option>
                       					<option value="Delivery" <?php if(!empty($row) and $row->order_detail_status == 'Delivery') echo 'selected';?>>Delivery</option>
                       					<option value="Complete" <?php if(!empty($row) and $row->order_detail_status == 'Complete') echo 'selected';?>>Complete</option>
                       					<option value="Cancel" <?php if(!empty($row) and $row->order_detail_status == 'Cancel') echo 'selected';?>>Cancel</option>
                       				</select>
					            </div>
					        </div>	
					        <!-- <div class="form-group">
					            <label class="col-md-3 control-label">Tracking No.</label>
					            <div class="col-md-9" style="padding-top: 7.25px;">
                       				<input type="text" name="order_detail_tracking_no" id="order_detail_tracking_no" value="<?php if(!empty($row)) echo $row->order_detail_tracking_no;?>" class="form-control" <?php if(!empty($row) and $row->order_detail_status != 'Delivery') echo 'readonly';?>>
					            </div>
					        </div> -->
					        <div class="form-group">
					        	<table class="table table-striped table-bordered">
					        		<tr>
					        			<th>Image</th>
					        			<th>Name</th>
					        			<th>Product Code</th>
					        			<th>Qty</th>
					        			<th>Price</th>
					        			<th>Weight</th>
					        			<th>Color</th>
					        			<th>Collection</th>
					        		</tr>
<?php
$order = $this->model_order->getOrderResult($id);
if(!empty($order)) {
	foreach($order as $r) {
?>
									<tr>
										<td><img src="<?php echo base_url('uploads/product/'.$r->order_image);?>" width="100"></td>
										<td><?php echo $r->order_name;?>
										<td><?php echo $r->order_code;?>
										<td><?php echo $r->order_qty;?>
										<td><?php echo $r->order_price;?>
										<td><?php echo $this->model_order->getWeightRecord($r->order_weight);?>
										<td><?php echo $this->model_order->getColorRecord($r->order_color);?>
										<td><?php echo $this->model_order->getCollectionRecord($r->order_collection);?>
									</tr>
<?php
	}
}
?>					  
					        	</table>
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
			CKEDITOR.instances.order_ckeditor.setData('');
		}

		function changeStatusOrder(order_detail_status, order_detail_id) {
			$.post('<?php echo site_url("order/backend/ajaxChangeStatus");?>', { order_detail_status: order_detail_status, order_detail_id: order_detail_id }, function(data) {
				alert('Change Status Success');

				/*if(data != 'Delivery') {
					$("#order_detail_tracking_no").attr('readonly', true);
				} else {
					$("#order_detail_tracking_no").attr('readonly', false);
				}*/
			});
		}
	</script>
</body>
</html>
