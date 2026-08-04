		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="javascript:;"><img src="<?php echo base_url('asset/backend/img/user-13.jpg');?>" alt="" /></a>
						</div>
						<div class="info">
							<?php if(!empty($row_user)) echo $row_user->user_name;?>
							<small><?php if(!empty($department)) echo $department->department_name;?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					<li class="has-sub active">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-th"></i>
						    <span>Data</span>
						</a>
						<ul class="sub-menu">
<?php
// Authentication
$this->load->model('model_template_main');

if(!empty($rows_menu)) {
	$i = 1;
	foreach($rows_menu as $r) {
		$has_sub = false;
		if(!empty($rows_sub_menu)) {
			foreach($rows_sub_menu as $r_sub) {
				if($r->menu_id == $r_sub->menu_id) {
					$has_sub = true;				
				}
			}
		}
		
		// Authentication
		$department_menu = $this->model_template_main->get_department_menu();
		$exp_department_menu = explode(', ', $department_menu);
		if(!empty($exp_department_menu)) {
			foreach($exp_department_menu as $exp_menu) {
				if($exp_menu == $r->menu_id) {
					if($has_sub == true) {
?>
										<li class="<?php if(!empty($has_sub)) { if($has_sub == true) echo 'has-sub';} ?> <?php if(!empty($active)) { if($active == $r->menu_controller) echo 'active'; }?>"><a href="javascript:check_menu('<?php echo $i;?>');"><?php echo $r->menu_name;?></a>
<?php
					} else {
?>
										<li class="<?php if(!empty($active)) { if($active == $r->menu_controller) echo 'active'; }?>"><a href="<?php echo site_url($r->menu_link);?>"><?php echo $r->menu_name;?></a>
<?php			
					}
?>
											<ul class="sub-menu sub_menu_<?php echo $i;?> <?php if(!empty($sub_menu_active) and !empty($r_sub)) { if($sub_menu_active == $r_sub->sub_menu_controller) echo 'active'; }?>">
<?php		
					if(!empty($rows_sub_menu)) {
						foreach($rows_sub_menu as $r_sub) {
							$has_sub_menu = false;
							if($r->menu_id == $r_sub->menu_id) {
								$sub_menu = $this->model_template_main->get_department_sub_menu();
								if(!empty($sub_menu)) {
									$exp_sub_menu = explode(', ', $sub_menu);
									if(!empty($exp_sub_menu)) {
										foreach($exp_sub_menu as $sm) {
											//echo $sm.' '.$r_sub->sub_menu_id.'<br>';
											if($sm == $r_sub->sub_menu_id) {
												$has_sub_menu = true;
											}
										}
									}
								}
								
								if($has_sub_menu == true) {
?>
										        <li 
<?php 
									if(!empty($sub_menu_active)) {
										$exp_sub_menu_active = explode(',', $r_sub->sub_menu_controller);
										foreach($exp_sub_menu_active as $sub_menu_active1) {
											if($sub_menu_active1 == $sub_menu_active) {
												echo 'class="active"';		
											}
										}
									}
?>
												><a href="<?php echo site_url($r_sub->sub_menu_link);?>"><?php echo $r_sub->sub_menu_name;?></a></li>
<?php							
								}
							}
						}
					}
?>
								</ul>
<?php			
				}
			}
		}
	}
}
?>
						</div>
			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->