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
							<form action="<?php echo site_url('master_page/backend/save_update/');?>" method="post" enctype="multipart/form-data" class="form-horizontal">
							<legend>Header</legend>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Text Top(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_text_top_lang1" id="master_page_text_top_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_text_top_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Text Top(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_text_top_lang2" id="master_page_text_top_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_text_top_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Login(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_login_lang1" id="master_page_login_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_login_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Login(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_login_lang2" id="master_page_login_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_login_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Register(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_register_lang1" id="master_page_register_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_register_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Register(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_register_lang2" id="master_page_register_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_register_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Payment(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_payment_lang1" id="master_page_payment_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_payment_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Payment(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_payment_lang2" id="master_page_payment_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_payment_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">En(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_en_lang1" id="master_page_en_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_en_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">En(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_en_lang2" id="master_page_en_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_en_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Bur(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_bur_lang1" id="master_page_bur_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_bur_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Bur(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_bur_lang2" id="master_page_bur_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_bur_lang2;?>">
					            </div>
					        </div>
							<legend>Footer</legend>
							<div class="form-group">
					            <label class="col-md-3 control-label">Free Shipping(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_free_shipping_lang1" id="master_page_free_shipping_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_free_shipping_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Free Shipping(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_free_shipping_lang2" id="master_page_free_shipping_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_free_shipping_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Nationwide(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_nationwide_lang1" id="master_page_nationwide_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_nationwide_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Nationwide(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_nationwide_lang2" id="master_page_nationwide_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_nationwide_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Contact Center(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_contact_center_lang1" id="master_page_contact_center_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_contact_center_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Contact Center(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_contact_center_lang2" id="master_page_contact_center_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_contact_center_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Tel(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_tel_lang1" id="master_page_tel_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_tel_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Tel(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_tel_lang2" id="master_page_tel_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_tel_lang2;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Delivery(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_delivery_lang1" id="master_page_delivery_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_delivery_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Delivery(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_delivery_lang2" id="master_page_delivery_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_delivery_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Within(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_within_lang1" id="master_page_within_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_within_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Within(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_within_lang2" id="master_page_within_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_within_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Express(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_express_lang1" id="master_page_express_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_express_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Express(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_express_lang2" id="master_page_express_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_express_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Express Within(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_express_within_lang1" id="master_page_express_within_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_express_within_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Express Within(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_express_within_lang2" id="master_page_express_within_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_express_within_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Footer(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_footer_lang1" id="master_page_footer_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_footer_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Footer(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_footer_lang2" id="master_page_footer_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_footer_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Readmore(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_readmore_lang1" id="master_page_readmore_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_readmore_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Readmore(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_readmore_lang2" id="master_page_readmore_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_readmore_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Products(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_products_lang1" id="master_page_products_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_products_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Products(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_products_lang2" id="master_page_products_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_products_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">About Us(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_about_us_lang1" id="master_page_about_us_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_about_us_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">About Us(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_about_us_lang2" id="master_page_about_us_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_about_us_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">New & Promotion(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_new_promotion_lang1" id="master_page_new_promotion_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_new_promotion_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">New & Promotion(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_new_promotion_lang2" id="master_page_new_promotion_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_new_promotion_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Contact Us(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_contact_us_lang1" id="master_page_contact_us_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_contact_us_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Contact Us(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_contact_us_lang2" id="master_page_contact_us_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_contact_us_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Privacy(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_privacy_lang1" id="master_page_privacy_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_privacy_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Privacy(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_privacy_lang2" id="master_page_privacy_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_privacy_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Terms(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_terms_lang1" id="master_page_terms_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_terms_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Terms(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_terms_lang2" id="master_page_terms_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_terms_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Help(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_help_lang1" id="master_page_help_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_help_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Help(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_help_lang2" id="master_page_help_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_help_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">Question(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_question_lang1" id="master_page_question_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_question_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Question(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_question_lang2" id="master_page_question_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_question_lang2;?>">
					            </div>
					        </div><div class="form-group">
					            <label class="col-md-3 control-label">We can help you(En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_we_can_help_you_lang1" id="master_page_we_can_help_you_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_we_can_help_you_lang1;?>">
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">We can help you(Bur)</label>
					            <div class="col-md-9">
                       				<input type="text" name="master_page_we_can_help_you_lang2" id="master_page_we_can_help_you_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->master_page_we_can_help_you_lang2;?>">
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
			CKEDITOR.instances.ford_ckeditor.setData('');
		}
	</script>
</body>
</html>
