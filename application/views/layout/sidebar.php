<!-- Sidebar -->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul class="sidebar-vertical">
				<li class="menu-title"> 
					<span>Main</span>
				</li>
				<?php 
				$current_class = $this->router->fetch_class();
				$current_method = $this->router->fetch_method();
				// echo $current_class.'//'.$current_method;
				// is_active(['current_class'],['current_method'])
				?>
				<?php if($this->customlib->getLoginSessionData('user_role') == 0){ ?>
				<li class="<?php echo is_active(['dashboard'],['index']) ?>"> 
					<a href="<?php echo base_url('dashboard') ?>"><i class="la la-dashcube"></i> <span>Dashboard</span></a>
				</li>
				<li class="submenu"> 
					<a href="javascript:void(0)" class="<?php echo is_active(['subscription'],['index','create','edit']) ?>"><i class="la la-money-check"></i> <span>Manage Subscription</span><span class="menu-arrow"></span></a>
					<ul style="<?php echo is_block(['subscription'],['index','create','edit']) ?>;">
						<li><a href="<?php echo base_url('subscription') ?>" class="<?php echo is_active(['subscription'],['index','create','edit']) ?>">Add Plans</a></li>
					</ul>
				</li>
				<li class="submenu"> 
					<a href="javascript:void(0)" class="<?php echo is_active(['leads'],['index','create','edit','followup','convert_school','convert_school_edit']) ?>"><i class="la la-cubes"></i> <span>Leads Management</span><span class="menu-arrow"></span></a>
					<ul style="<?php echo is_block(['leads'],['index','create','edit','followup','convert_school','convert_school_edit']) ?>;">
						<?php //if($this->customlib->getLoginSessionData('user_role') == 1){ ?>
						<li><a href="<?php echo base_url('leads') ?>" class="<?php echo is_active(['leads'],['index','create','edit','followup','convert_school']) ?>">Add Leads</a></li>
						<?php //} ?>
					</ul>
				</li>
				<li class="submenu"> 
					<a href="javascript:void(0)" class="<?php echo is_active(['domain','settings'],['index','create','edit']) ?>"><i class="la la-school"></i> <span>Create Schools</span><span class="menu-arrow"></span></a>
					<ul style="<?php echo is_block(['domain','settings'],['index','create','edit']) ?>;">
						<li><a href="<?php echo base_url('api-domain') ?>" class="<?php echo is_active(['domain'],['index','create','edit']) ?>">Generate Domain Key</a></li>
						<li><a href="<?php echo base_url('settings') ?>" class="<?php echo is_active(['settings'],['index','edit']) ?>">School Registration</a></li> 
					</ul>
				</li>
				<li class="submenu"> 
					<a href="javascript:void(0)" class="<?php echo is_active(['school_newly_update'],['index','create','edit']) ?>"><i class="las la-chalkboard"></i> <span>School News Update</span><span class="menu-arrow"></span></a>
					<ul style="<?php echo is_block(['school_newly_update'],['index','create','edit']) ?>;">
						<li><a href="<?php echo base_url('school_newly_update') ?>" class="<?php echo is_active(['school_newly_update'],['index','create','edit']) ?>">ERP Updates</a></li> 
					</ul>
				</li>
				<li class="submenu"> 
					<a href="javascript:void(0)" class="<?php echo is_active(['seller'],['index','create','edit']) ?>"><i class="las la-user"></i> <span>Re-Seller Management</span><span class="menu-arrow"></span></a>
					<ul style="<?php echo is_block(['seller'],['index','create','edit']) ?>;">
						<li><a href="<?php echo base_url('seller') ?>" class="<?php echo is_active(['seller'],['index','create','edit']) ?>">Add Re-Seller</a></li> 
					</ul>
				</li>
				<li class="submenu"> 
					<a href="javascript:void(0)" class=""><i class="las la-ticket-alt"></i> <span>Ticket Management</span><span class="menu-arrow"></span></a>
					<ul style="">
						<li><a href="#" class="">All Tickets</a></li> 
					</ul>
				</li>
				<li class="submenu"> 
					<a href="javascript:void(0)" class="<?php echo is_active(['company_settings'],['index']) ?>"><i class="las la-cogs"></i> <span>Company Setting</span><span class="menu-arrow"></span></a>
					<ul style="<?php echo is_block(['company_settings'],['index']) ?>;">
						<li><a href="<?php echo base_url('company_settings') ?>" class="<?php echo is_active(['company_settings'],['index']) ?>">Company Details</a></li> 
					</ul>
				</li>
				<?php }else{ ?>
				
				<li class="submenu"> 
					<a href="javascript:void(0)" class="<?php echo is_active(['leads'],['index','create','edit','followup','convert_school','convert_school_edit']) ?>"><i class="la la-cubes"></i> <span>Leads Management</span><span class="menu-arrow"></span></a>
					<ul style="<?php echo is_block(['leads'],['index','create','edit','followup','convert_school','convert_school_edit']) ?>;">
						<?php //if($this->customlib->getLoginSessionData('user_role') == 1){ ?>
						<li><a href="<?php echo base_url('leads') ?>" class="<?php echo is_active(['leads'],['index','create','edit','followup','convert_school']) ?>">Add Leads</a></li>
						<?php //} ?>
					</ul>
				</li>
				<?php } ?>
			</ul>
			
		</div>
	</div>
</div>
<!-- /Sidebar -->