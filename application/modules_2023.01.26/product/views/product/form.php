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
							<form action="<?php echo site_url('product/backend/product_save_update/'.$id);?>" method="post" enctype="multipart/form-data" class="form-horizontal">
							<legend>Image</legend>
							<div class="form-group">
					            <label class="col-md-3 control-label">Image</label>
					            <div class="col-md-9">
                       				<input type="file" name="product_image" id="product_image" class="form-control"> Recommend 475 x 510 px
<?php
if(!empty($row)) {
	if($row->product_image != '') {
?>
									<br><img src="<?php echo base_url('uploads/product/'.$row->product_image);?>" width="150">							
<?php
	}
}
?>
                       				
					            </div>
					        </div>
					        <legend>Select</legend>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Star</label>
					            <div class="col-md-9">
                       				<input type="radio" name="product_star" id="product_star5" value="5" <?php if(!empty($row) and $row->product_star == '5') echo 'checked';?>> 5
                       				<input type="radio" name="product_star" id="product_star4" value="4" <?php if(!empty($row) and $row->product_star == '4') echo 'checked';?>> 4
                       				<input type="radio" name="product_star" id="product_star3" value="3" <?php if(!empty($row) and $row->product_star == '3') echo 'checked';?>> 3
                       				<input type="radio" name="product_star" id="product_star2" value="2" <?php if(!empty($row) and $row->product_star == '2') echo 'checked';?>> 2
                       				<input type="radio" name="product_star" id="product_star1" value="1" <?php if(!empty($row) and $row->product_star == '1') echo 'checked';?>> 1
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Suggest</label>
					            <div class="col-md-9">
                       				<input type="checkbox" name="product_suggest" id="product_suggest" value="Yes" <?php if(!empty($row) and $row->product_suggest == 'Yes') echo 'checked';?>>
					            </div>
					        </div>
							<div class="form-group">
					            <label class="col-md-3 control-label">Product Promotion</label>
					            <div class="col-md-9">
                       				<input type="checkbox" name="product_promotion" id="product_promotion" value="Yes" <?php if(!empty($row) and $row->product_promotion == 'Yes') echo 'checked';?>>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product New</label>
					            <div class="col-md-9">
                       				<input type="checkbox" name="product_new" id="product_new" value="Yes" <?php if(!empty($row) and $row->product_new == 'Yes') echo 'checked';?>>
					            </div>
					        </div>					   
					        <legend>Category</legend>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Category 1</label>
					            <div class="col-md-9">
                       				<select name="category1_id" id="category1_id" class="form-control" onchange="changeCategory1(this.value);">
                       					<option value="">Please Select</option>
<?php
if(!empty($category1Ctrl)) {
	foreach($category1Ctrl as $r) {
?>
										<option value="<?php echo $r->category1_id;?>" <?php if(!empty($row) and $row->category1_id == $r->category1_id) echo 'selected';?>><?php echo $r->category1_name_lang1.' / '.$r->category1_name_lang2;?></option>
<?php
	}
}
?>
                       				</select>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Category 2</label>
					            <div class="col-md-9">
                       				<select name="category2_id" id="category2_id" class="form-control" onchange="changeCategory2(this.value);">
                       					<option value="">Please Select</option>
<?php
if(!empty($category2Ctrl)) {
	foreach($category2Ctrl as $r) {
?>
										<option value="<?php echo $r->category2_id;?>" <?php if(!empty($row) and $row->category2_id == $r->category2_id) echo 'selected';?>><?php echo $r->category2_name_lang1.' / '.$r->category2_name_lang2;?></option>
<?php
	}
}
?>
                       				</select>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Category 3</label>
					            <div class="col-md-9">
                       				<select name="category3_id" id="category3_id" class="form-control" onchange="changeCategory3(this.value);">
                       					<option value="">Please Select</option>
<?php
if(!empty($category3Ctrl)) {
	foreach($category3Ctrl as $r) {
?>
										<option value="<?php echo $r->category3_id;?>" <?php if(!empty($row) and $row->category3_id == $r->category3_id) echo 'selected';?>><?php echo $r->category3_name_lang1.' / '.$r->category3_name_lang2;?></option>
<?php
	}
}
?>
                       				</select>
					            </div>
					        </div>
					        <legend>Data</legend>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Name (En)</label>
					            <div class="col-md-9">
                       				<input type="text" name="product_name_lang1" id="product_name_lang1" class="form-control" value="<?php if(!empty($row)) echo $row->product_name_lang1;?>">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Name (Myan)</label>
					            <div class="col-md-9">
                       				<input type="text" name="product_name_lang2" id="product_name_lang2" class="form-control" value="<?php if(!empty($row)) echo $row->product_name_lang2;?>">
					            </div>
					        </div>					   
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Property (En)</label>
					            <div class="col-md-9">
                       				<textarea name="product_property_lang1" id="product_property_lang1" class="form-control" rows="4"><?php if(!empty($row)) echo $row->product_property_lang1;?></textarea>                  
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Property (Myan)</label>
					            <div class="col-md-9">
                       				<textarea name="product_property_lang2" id="product_property_lang2" class="form-control" rows="4"><?php if(!empty($row)) echo $row->product_property_lang2;?></textarea>                  
					            </div>
					        </div>
					        
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Description (En)</label>
					            <div class="col-md-9">
                       				<textarea name="product_description_lang1" id="product_description_lang1" class="form-control" rows="4"><?php if(!empty($row)) echo $row->product_description_lang1;?></textarea>
                       				<?php //echo textarea_ckeditor('product_detail_lang1');?>                  
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="col-md-3 control-label">Product Description (Myan)</label>
					            <div class="col-md-9">
                       				<textarea name="product_description_lang2" id="product_description_lang2" class="form-control" rows="4"><?php if(!empty($row)) echo $row->product_description_lang2;?></textarea>
                       				<?php //echo textarea_ckeditor('product_detail_lang2');?>                  
					            </div>
					        </div>	
					        <div class="form-group">
					            <label class="col-md-3 control-label">Weight & Color & Collection</label>
					            <div class="col-md-9">
					            	<input type="button" onclick="clickAddWeightColorStock();" value=" + ">
					            </div>
					        </div>
					        <span id="span_weight_color_collection">
<?php
//pre($row);
if(!empty($productWeightColorCollectionCtrl)) {
	foreach($productWeightColorCollectionCtrl as $pwccc) {
?>					 
					        <div class="form-group" id="category3_id_1">
					        	<label class="col-md-3 control-label">&nbsp;</label>					  
					            <div class="col-md-2">
                       				<select name="weight_id[]" class="form-control weight" <?php if(!empty($row) and $row->category3_weight != 'Yes') echo 'disabled';?>>
                       					<option value="">Weight</option>
<?php
		if(!empty($weightCtrl)) {
			foreach($weightCtrl as $r) {
?>
										<option value="<?php echo $r->weight_id;?>" <?php if($pwccc->weight_id == $r->weight_id) echo 'selected';?>><?php echo $r->weight_name_lang1.' / '.$r->weight_name_lang2;?>
<?php
			}
		}
?>                      
                       				</select>               
					            </div>
					            <div class="col-md-2">
                       				<select name="color_id[]" class="form-control color" <?php if(!empty($row) and $row->category3_color != 'Yes') echo 'disabled';?>>
                       					<option value="">Color</option>
<?php
		if(!empty($colorCtrl)) {
			foreach($colorCtrl as $r) {
?>
										<option value="<?php echo $r->color_id;?>" <?php if($pwccc->color_id == $r->color_id) echo 'selected';?>><?php echo $r->color_name_lang1.' / '.$r->color_name_lang2;?>
<?php
			}
		}
?>                         					
                       				</select>          
					            </div>
					            <div class="col-md-2">
                       				<select name="collection_id[]" class="form-control collection" <?php if(!empty($row) and $row->category3_collection != 'Yes') echo 'disabled';?>>
                       					<option value="">Collection</option>
<?php
		if(!empty($collectionCtrl)) {
			foreach($collectionCtrl as $r) {
?>
										<option value="<?php echo $r->collection_id;?>" <?php if($pwccc->collection_id == $r->collection_id) echo 'selected';?>><?php echo $r->collection_name_lang1.' / '.$r->collection_name_lang2;?>
<?php
			}
		}
?>                        					
                       				</select>            
					            </div>
					            <div class="col-md-3">
					            	<input type="button" value=" - " onclick="clickDelete(1);">
					            </div>
					        </div>
<?php
	}
} else {
?>					 
					        <div class="form-group" id="category3_id_1">
					        	<label class="col-md-3 control-label">&nbsp;</label>					  
					            <div class="col-md-2">
                       				<select name="weight_id[]" class="form-control weight">
                       					<option value="">Weight</option>
<?php
	if(!empty($weightCtrl)) {
		foreach($weightCtrl as $r) {
?>
										<option value="<?php echo $r->weight_id;?>"><?php echo $r->weight_name_lang1.' / '.$r->weight_name_lang2;?>
<?php
		}
	}
?>                      
                       				</select>               
					            </div>
					            <div class="col-md-2">
                       				<select name="color_id[]" class="form-control color">
                       					<option value="">Color</option>
<?php
	if(!empty($colorCtrl)) {
		foreach($colorCtrl as $r) {
?>
										<option value="<?php echo $r->color_id;?>"><?php echo $r->color_name_lang1.' / '.$r->color_name_lang2;?>
<?php
		}
	}
?>                         					
                       				</select>          
					            </div>
					            <div class="col-md-2">
                       				<select name="collection_id[]" class="form-control collection">
                       					<option value="">Collection</option>
<?php
	if(!empty($collectionCtrl)) {
		foreach($collectionCtrl as $r) {
?>
										<option value="<?php echo $r->collection_id;?>"><?php echo $r->collection_name_lang1.' / '.$r->collection_name_lang2;?>
<?php
		}
	}
?>                        					
                       				</select>            
					            </div>
					            <div class="col-md-3">
					            	<input type="button" value=" - " onclick="clickDelete(1);">
					            </div>
					        </div>
<?php
}
?>					   	
					       	</span>	
							<legend>Weight</legend>
							<div class="form-group">
					            <label class="col-md-3 control-label">Product Weight (KG)</label>
					            <div class="col-md-9">
                       				<input type="number" step="0.01" name="product_weight" id="product_weight" value="<?php if(!empty($row)) echo $row->product_weight;?>" class="form-control">
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
			CKEDITOR.instances.product_ckeditor.setData('');
		}

		function changeCategory1(category1_id) {
			$.post('<?php echo site_url('product/backend/ajaxChangeCategory1');?>', { category1_id: category1_id }, function(data) {
				$("#category2_id").html(data);
			}); 
		}

		function changeCategory2(category2_id) {
			$.post('<?php echo site_url('product/backend/ajaxChangeCategory2');?>', { category2_id: category2_id }, function(data) {
				$("#category3_id").html(data);
			}); 
		}

		var weight = '';
		var color = '';
		var collection = '';

		function changeCategory3(category3_id) {
			$.post('<?php echo site_url('product/backend/ajaxChangeCategory3');?>', { category3_id: category3_id }, function(data) {
				var data_split = data.split('!@#$%^&*()');

				if(data_split[0] != 'Yes') {
					$(".weight").prop('disabled', true);

					weight = ' disabled';	
				} else {
					weight = '';
				}
				
				if(data_split[1] != 'Yes') {
					$(".color").prop('disabled', true);	

					color = ' disabled';
				} else {
					color = '';
				}

				if(data_split[2] != 'Yes') {
					$(".collection").prop('disabled', true);	

					collection = ' disabled';
				} else {
					collection = '';
				}
			}); 
		}

<?php
		if(!empty($row)) {
			if($row->category3_weight == 'Yes') {
				$weight = '';
			} else {
				$weight = ' disabled';
			}

			if($row->category3_color == 'Yes') {
				$color = '';
			} else {
				$color = ' disabled';
			}

			if($row->category3_collection == 'Yes') {
				$collection = '';
			} else {
				$collection = ' disabled';
			}
		} else {
			$weight = '';
			$color = '';
			$collection = '';
		}
?>

		var return_weight = '<?php echo $weight;?>';
		var return_color = '<?php echo $color;?>';
		var return_collection = '<?php echo $collection;?>';

		var i = 0;

		function clickAddWeightColorStock() {
			if($("#category3_id").val() == '') {
				alert("Please Select Category 3");
			} else {
				i++;

				$('<div class="form-group" id="category3_id_' + i + '"><label class="col-md-3 control-label">&nbsp;</label><div class="col-md-2"><select name="weight_id[]" class="form-control weight" ' + weight + ' ' + return_weight + '><option value="">Weight</option><?php if(!empty($weightCtrl)) { foreach($weightCtrl as $r) { ?><option value="<?php echo $r->weight_id;?>"><?php echo $r->weight_name_lang1.' / '.$r->weight_name_lang2;?><?php } }?></select></div><div class="col-md-2"><select name="color_id[]" class="form-control color" ' + color + ' ' + return_color + '><option value="">Color</option><?php if(!empty($colorCtrl)) { foreach($colorCtrl as $r) { ?><option value="<?php echo $r->color_id;?>"><?php echo $r->color_name_lang1.' / '.$r->color_name_lang2;?><?php } } ?></select></div><div class="col-md-2"><select name="collection_id[]" class="form-control collection" ' + collection + ' ' + return_collection + '><option value="">Collection</option><?php if(!empty($collectionCtrl)) { foreach($collectionCtrl as $r) { ?><option value="<?php echo $r->collection_id;?>"><?php echo $r->collection_name_lang1.' / '.$r->collection_name_lang2;?><?php } } ?></select></div><div class="col-md-3"><input type="button" value=" - " onclick="clickDelete(i);"></div></div>').clone().appendTo("#span_weight_color_collection");
			}
		}

		function clickDelete(i) {
			$("#category3_id_" + i).remove();

			console.log(i);
		}
	</script>
</body>
</html>
