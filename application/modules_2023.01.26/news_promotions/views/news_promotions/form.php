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
							<form action="<?php echo site_url('news_promotions/backend/save_update/'.$id);?>" method="post" enctype="multipart/form-data" class="form-horizontal">
							<div class="form-group">
					            <label class="col-md-3 control-label">Image</label>
					            <div class="col-md-9">
                       				<input type="file" name="news_promotions_image" id="news_promotions_image" class="form-control">
                       				Reccommend 790 x 541 px
<?php
if(!empty($row)) {
	if($row->news_promotions_image != '') {
?>
									<br><img src="<?php echo base_url('uploads/news_promotions/'.$row->news_promotions_image);?>" width="150">
<?php
	}
}
?>           
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">News Promotions Type</label>
					            <div class="col-md-9">
                       				<select name="news_promotions_type" id="news_promotions_type" class="form-control">
                       					<option value="News" <?php if(!empty($row)) { if($row->news_promotions_type == 'News') echo 'selected'; } ?>>News</option>
                       					<option value="Promotions" <?php if(!empty($row)) { if($row->news_promotions_type == 'Promotions') echo 'selected'; } ?>>Promotions</option>
                       				</select>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Date</label>
					            <div class="col-md-9">
                       				<input type="text" name="news_promotions_date" id="news_promotions_date" class="form-control" value="<?php if(!empty($row)) echo $row->news_promotions_date;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Name Lang(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="news_promotions_name_lang1" id="news_promotions_name_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->news_promotions_name_lang1;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Name Lang(Myan)</label>
					            <div class="col-md-9">
                       				<input type="text" name="news_promotions_name_lang2" id="news_promotions_name_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->news_promotions_name_lang2;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Description Lang(En)</label>
					            <div class="col-md-9">
                       				<textarea name="news_promotions_description_lang1" id="news_promotions_description_lang1" class="form-control" rows="4"><?php if(!empty($row)) echo $row->news_promotions_description_lang1;?></textarea>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Description Lang(Myan)</label>
					            <div class="col-md-9">
                       				<textarea name="news_promotions_description_lang2" id="news_promotions_description_lang2" class="form-control" rows="4"><?php if(!empty($row)) echo $row->news_promotions_description_lang2;?></textarea>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Detail Lang(En)</label>
					            <div class="col-md-9">
                       				<textarea name="news_promotions_detail_lang1" id="news_promotions_detail_lang1" class="form-control"><?php if(!empty($row)) echo $row->news_promotions_detail_lang1;?></textarea>
                       				<?php echo textarea_ckeditor('news_promotions_detail_lang1');?>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Detail Lang(Myan)</label>
					            <div class="col-md-9">
                       				<textarea name="news_promotions_detail_lang2" id="news_promotions_detail_lang2" class="form-control"><?php if(!empty($row)) echo $row->news_promotions_detail_lang2;?></textarea>
                       				<?php echo textarea_ckeditor('news_promotions_detail_lang2');?>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Gallery Image</label>
					            <div class="col-md-9">
                       				<input type="file" name="news_promotions_gallery_image[]" id="news_promotions_gallery_image" class="form-control" multiple="true">
                       				Recsommend 790 x 541 px
<?php
if(!empty($rows)) {
	foreach($rows as $r) {
		if($r->news_promotions_gallery_image != '') {
?>
									<br><img src="<?php echo base_url('uploads/news_promotions/'.$r->news_promotions_gallery_image);?>" width="150"> <a href="<?php echo site_url('news_promotions/backend/deleteGallery/'.$r->news_promotions_gallery_id.'/'.$r->news_promotions_id);?>" onclick="return confirm('Confirm Delete');">Delete</a><br>
<?php
		}
	}
}
?>           
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
	  	$( function() {
	    	$( "#news_promotions_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  	} );
  	</script>

	<script>
		$(document).ready(function() {
			App.init();
		});
		
		function resetForm() {
			$(".form-control").val('');
			CKEDITOR.instances.news_promotions_ckeditor.setData('');
		}
	</script>
</body>
</html>
