		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin page-header -->
			<h1 class="page-header">Managed Tables <small><?php if(!empty($title)) echo $title;?></small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?php if(!empty($title)) echo $title;?></h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
								<table id="data-table" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Department Name</th>
											<th>Menu</th>
											<th>Sub Menu</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
<?php
if(!empty($rows)) {
	foreach($rows as $r) {
		$menu_name = '';
		$menu = explode(', ', $r->department_menu);
		foreach($menu as $menu_) {
			if(!empty($rows_menu)) {
				foreach($rows_menu as $r_menu) {
					if($menu_ == $r_menu->menu_id) {
						$menu_name .= $r_menu->menu_name.'<br>';
					}
				}
			}	
		}
		
		$menu_name = substr($menu_name, 0, -4);
?>
										<tr>
											<td><?php echo $r->department_name;?></td>
											<td><?php echo $menu_name;?></td>
<?php
		$sub_menu_name = '';
		$sub_menu = explode(', ', $r->department_sub_menu);
		foreach($sub_menu as $sub_menu_) {
			if(!empty($rows_sub_menu_authen)) {
				foreach($rows_sub_menu_authen as $r_sub_menu_) {
					if($sub_menu_ == $r_sub_menu_->sub_menu_id) {
						$sub_menu_name .= $r_sub_menu_->menu_name.' -> '.$r_sub_menu_->sub_menu_name.'<br>';
					}
				}
			}	
		}
		
		$sub_menu_name = substr($sub_menu_name, 0, -4);
?>
											<td><?php echo $sub_menu_name;?></td>
											<td><a href="<?php echo site_url('authentication/backend/permission_form/'.$r->department_id);?>">Edit</a></td>					
										</tr>
<?php
	}
}
?>
									</tbody>
								</table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
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
	<script src="<?php echo base_url('asset/backend/plugins/DataTables/js/jquery.dataTables.js');?>"></script>
	<script src="<?php echo base_url('asset/backend/js/table-manage-default.demo.min.js');?>"></script>
	<script src="<?php echo base_url('asset/backend/js/apps.min.js');?>"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageDefault.init();
		});
	</script>
</body>
</html>
