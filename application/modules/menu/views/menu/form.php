		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- <ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Form Stuff</a></li>
				<li class="active">Form Elements</li>
			</ol> -->
			<!-- end breadcrumb -->
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
                            <!-- <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div> -->
                            <h4 class="panel-title"><?php if(!empty($title)) echo $title;?></h4>
                        </div>
                        <div class="panel-body">
<?php
if(!empty($id)) {
?>
							<form class="form-horizontal" id="form_menu" action="<?php echo site_url('menu/backend/save_update/'.$id);?>" method="post" enctype="multipart/form-data">
<?php
} else {
?>
							<form class="form-horizontal" id="form_menu" action="<?php echo site_url('menu/backend/save_update');?>" method="post" enctype="multipart/form-data">
<?php
}
?>                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Name" name="menu_name" id="menu_name" value="<?php if(!empty($row)) echo $row->menu_name;?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Path</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Path" name="menu_controller" id="menu_controller" value="<?php if(!empty($row)) echo $row->menu_controller;?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Sort</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Sort" name="menu_sort" id="menu_sort" value="<?php if(!empty($row)) echo $row->menu_sort;?>" />
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label">Department</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="department_id">
                                        	<option value="">Please Select</option>
<?php
if(!empty($rows_department)) {
	foreach($rows_department as $r) {
?>
											<option value="<?php echo $r->department_id;?>" <?php if(!empty($row)) { if($row->department_id == $r->department_id) echo ' selected'; }?>><?php echo $r->department_name;?></option>
<?php
	}
}
?>                                 
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enable</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="menu_enable" value="1" <?php if(!empty($row)) { if($row->menu_enable == '1') echo ' checked'; }?> />
                                                Enable
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="menu_enable" value="0" <?php if(!empty($row)) { if($row->menu_enable == '0') echo ' checked'; }?> />
                                                Disable
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Link</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Link" name="menu_link" id="menu_link" value="<?php if(!empty($row)) echo $row->menu_link;?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">&nbsp;</label>
                                    	<div class="col-md-9">
		                                	<button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
		                                    <button type="reset" class="btn btn-sm btn-default">Reset</button>
                                   	 </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-3 control-label">Disabled Input</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Disabled input" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Select</label>
                                    <div class="col-md-9">
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Select (multiple)</label>
                                    <div class="col-md-9">
                                        <select multiple class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Textarea</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" placeholder="Textarea" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Checkbox</label>
                                    <div class="col-md-9">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="" />
                                                Checkbox Label 1
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="" />
                                                Checkbox Label 2
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Inline Checkbox</label>
                                    <div class="col-md-9">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" />
                                            Checkbox Label 1
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="" />
                                            Checkbox Label 2
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Radio Button</label>
                                    <div class="col-md-9">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" value="option1" checked />
                                                Radio option 1
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" value="option2" />
                                                Radio option 2
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Inline Radio Button</label>
                                    <div class="col-md-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" value="option1" checked />
                                            Radio option 1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" value="option2" />
                                            Radio option 2
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group has-success has-feedback">
                                    <label class="col-md-3 control-label">Input with Success</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" />
                                        <span class="fa fa-check form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group has-warning has-feedback">
                                    <label class="col-md-3 control-label">Input with Warning</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" />
                                        <span class="fa fa-warning form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group has-error has-feedback">
                                    <label class="col-md-3 control-label">Input with Error</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" />
                                        <span class="fa fa-times form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Submit</label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-sm btn-success">Submit Button</button>
                                    </div>
                                </div> -->
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
                <!-- begin col-6 -->
                <!-- <div class="col-md-6"> -->
			        <!-- begin panel -->
                    <!-- <div class="panel panel-inverse" data-sortable-id="form-stuff-2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Input Sizes, Input Group</h4>
                        </div>
                        <div class="panel-body">
                            <h4 class="m-t-0">Input Sizing</h4>
                            <input class="form-control input-lg" type="text" placeholder=".input-lg" />
                            <p></p>
                            <input class="form-control" type="text" placeholder="Default input" />
                            <p></p>
                            <input class="form-control input-sm" type="text" placeholder=".input-sm" />
                            <p></p>
                            <select class="form-control input-lg">
                                <option>.input-lg</option>
                            </select>
                            <p></p>
                            <select class="form-control">
                                <option>default input</option>
                            </select>
                            <p></p>
                            <select class="form-control input-sm">
                                <option>.input-sm</option>
                            </select>
                            <h4 class="m-t-20">Input Group</h4>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Username" />
                            </div>
                            <p></p>
                            <div class="input-group">
                                <input type="text" class="form-control" />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control" />
                                <span class="input-group-addon">.00</span>
                            </div>
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" />
                                </span>
                                <input type="text" class="form-control" placeholder="Checkbox add on" />
                            </div>
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" />
                                </span>
                                <input type="text" class="form-control" placeholder="Radio button add on" />
                            </div>
                            <p></p>
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary">Action</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <input type="text" class="form-control" />
                                <div class="input-group-btn">
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                    </button>
                                    <button type="button" class="btn btn-success">Action</button>
                                </div>
                            </div>
                            <h4 class="m-t-20">Input Group Sizing</h4>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Username" />
                            </div>
                            <p></p>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Username" />
                            </div>
                            <p></p>
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Username" />
                            </div>
                        </div>
                    </div> -->
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
            </div>
            <!-- end row -->
            <!-- begin row -->
            <!-- <div class="row"> -->
			    <!-- begin col-6 -->
			    <!-- <div class="col-md-6"> -->
			        <!-- begin panel -->
                    <!-- <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Default Style</h4>
                        </div>
                        <div class="panel-body">
                            <form action="/" method="POST">
                                <fieldset>
                                    <legend>Legend</legend>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" />
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" /> Check me out
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary m-r-5">Login</button>
                                    <button type="submit" class="btn btn-sm btn-default">Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div> -->
                    <!-- end panel -->
                <!-- </div> -->
                <!-- end col-6 -->
			    <!-- begin col-6 -->
			    <!-- <div class="col-md-6"> -->
			        <!-- begin panel -->
                    <!-- <div class="panel panel-inverse" data-sortable-id="form-stuff-4">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Form Horizontal</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="/" method="POST">
                                <fieldset>
                                    <legend>Legend</legend>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Email address</label>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control" placeholder="Enter email" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Password</label>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control" placeholder="Password" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" /> Check me out
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Login</button>
                                            <button type="submit" class="btn btn-sm btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div> -->
                    <!-- end panel -->
                <!-- </div> -->
                <!-- end col-6 -->
            <!-- </div> -->
            <!-- end row -->
            <!-- begin row -->
            <!-- <div class="row"> -->
                <!-- begin col-12 -->
                <!-- <div class="col-12"> -->
                    <!-- begin panel -->
                    <!-- <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Inline Form</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-inline" action="/" method="POST">
								<div class="form-group m-r-10">
									<input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email" />
								</div>
								<div class="form-group m-r-10">
									<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" />
								</div>
								<div class="checkbox m-r-10">
									<label>
										<input type="checkbox" /> Remember me
									</label>
								</div>
								<button type="submit" class="btn btn-sm btn-primary m-r-5">Sign in</button>
								<button type="submit" class="btn btn-sm btn-default">Register</button>
							</form>
                        </div>
                    </div> -->
                    <!-- end panel -->
                <!-- </div> -->
                <!-- end col-6 -->
            <!-- </div> -->
            <!-- end row -->
		<!-- </div> -->
		<!-- end #content -->
		
        <!-- begin theme-panel -->
        <!-- <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">Color Theme</h5>
                <ul class="theme-list clearfix">
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Header Styling</div>
                    <div class="col-md-7">
                        <select name="header-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">inverse</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Header</div>
                    <div class="col-md-7">
                        <select name="header-fixed" class="form-control input-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Styling</div>
                    <div class="col-md-7">
                        <select name="sidebar-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">grid</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">Sidebar</div>
                    <div class="col-md-7">
                        <select name="sidebar-fixed" class="form-control input-sm">
                            <option value="1">fixed</option>
                            <option value="2">default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Sidebar Gradient</div>
                    <div class="col-md-7">
                        <select name="content-gradient" class="form-control input-sm">
                            <option value="1">disabled</option>
                            <option value="2">enabled</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">Content Styling</div>
                    <div class="col-md-7">
                        <select name="content-styling" class="form-control input-sm">
                            <option value="1">default</option>
                            <option value="2">black</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="fa fa-refresh m-r-3"></i> Reset Local Storage</a>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- end theme-panel -->
		
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
	</script>
</body>
</html>
