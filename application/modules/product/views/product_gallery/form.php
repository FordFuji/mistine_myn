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
							<form action="<?php echo site_url('product/backend/product_gallery_save_update/'.$product_stock_id);?>" method="post" enctype="multipart/form-data" class="form-horizontal">
							<div class="form-group">
					            <label class="col-md-3 control-label">Product Code</label>
					            <div class="col-md-9">
                       				<input type="text" name="product_code" id="product_code" class="form-control" value="<?php if(!empty($row)) echo $row->product_code;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Product Before Discount Price (Myan)</label>
					            <div class="col-md-9">
                       				<input type="number" name="product_before_discount_price_type1" id="product_before_discount_price_type1" class="form-control" value="<?php if(!empty($row)) echo $row->product_before_discount_price_type1;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Price (Myan)</label>
					            <div class="col-md-9">
                       				<input type="number" name="product_price1" id="product_price1" class="form-control" value="<?php if(!empty($row)) echo $row->product_price1;?>">
					            </div>
					        </div>
					        <!-- <div class="form-group">
					            <label class="col-md-3 control-label">Product Before Discount Price2</label>
					            <div class="col-md-9">
                       				<input type="number" name="product_before_discount_price_type2" id="product_before_discount_price_type2" class="form-control" value="<?php if(!empty($row)) echo $row->product_before_discount_price_type2;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Price2</label>
					            <div class="col-md-9">
                       				<input type="number" name="product_price2" id="product_price2" class="form-control" value="<?php if(!empty($row)) echo $row->product_price2;?>">
					            </div>
					        </div> -->
							<div class="form-group">
					            <label class="col-md-3 control-label">Stock</label>
					            <div class="col-md-9">
                       				<input type="number" name="product_stock_amount" id="product_stock_amount" class="form-control" value="<?php if(!empty($row)) echo $row->product_stock_amount;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Gallery</label>
					            <div class="col-md-9">
                       				<input type="file" name="product_gallery_image[]" id="product_gallery_image" class="form-control" multiple="true"> Recommend 474 x 510 px
<?php
$gallery = $this->model_product->getProductGalleryResult($product_stock_id);
if(!empty($gallery)) {
	foreach($gallery as $g) {
?>
									<br><img src="<?php echo base_url('uploads/product_gallery/'.$g->product_gallery_image);?>" width="150"> <a href="<?php echo site_url('product/backend/deleteGallery/'.$product_stock_id.'/'.$g->product_gallery_id);?>" onclick="return confirm('Confirm Delete');">Delete</a> Sort: <input type="number" name="product_gallery_sort_<?php echo $g->product_gallery_id;?>" value="<?php echo $g->product_gallery_sort;?>" style="width: 50px;" onblur="setSort(this.value, '<?php echo $g->product_gallery_id;?>');"><br>
<?php
	}
}
?>                     
					            </div>
					        </div>
							<legend>Active</legend>
							<div class="form-group">
					            <label class="col-md-3 control-label">Enable</label>
					            <div class="col-md-9">
                       				<input type="checkbox" name="product_stock_enable" id="product_stock_enable" value="Enable" <?php if(!empty($row) and $row->product_stock_enable == 'Enable') echo 'checked';?>>
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
			CKEDITOR.instances.weight_ckeditor.setData('');
		}

		function setSort(product_gallery_sort, product_gallery_id) {
			$.post('<?php echo site_url("product/backend/ajaxSortGallery");?>', { product_gallery_id: product_gallery_id, product_gallery_sort: product_gallery_sort }, function(data) {
				// No Comment
			});
		}
	</script>
</body>
</html>
