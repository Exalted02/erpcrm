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
				<li class="<?php echo is_active(['seller'],['index','create','edit']) ?>"> 
					<a href="<?php echo base_url('seller') ?>"><i class="la la-cubes"></i> <span>Seller</span></a>
				</li>
				<li class="<?php echo is_active(['domain'],['index','create','edit']) ?>"> 
					<a href="<?php echo base_url('api-domain') ?>"><i class="la la-key"></i> <span>Domain Key</span></a>
				</li>
				<li class="<?php echo is_active(['settings'],['index']) ?>"> 
					<a href="<?php echo base_url('settings') ?>"><i class="la la-cogs"></i> <span>School Setting</span></a>
				</li>
				<li class="<?php echo is_active(['company_settings'],['index']) ?>"> 
					<a href="<?php echo base_url('company_settings') ?>"><i class="la la-cog"></i> <span>Setting</span></a>
				</li>
				<li class="<?php echo is_active(['school_newly_update'],['index','create','edit']) ?>"> 
					<a href="<?php echo base_url('school_newly_update') ?>"><i class="la la-school"></i> <span>School newly update</span></a>
				</li>
				<li class="<?php echo is_active(['subscription'],['index','create','edit']) ?>"> 
					<a href="<?php echo base_url('subscription') ?>"><i class="la la-cubes"></i> <span>Manage Subscription</span></a>
				</li>
				<?php } ?>
				<li class="submenu"> 
					<a href="javascript:void(0)" class="<?php echo is_active(['leads'],['index','create','edit','followup','convert_school']) ?>"><i class="la la-cubes"></i> <span>Leads</span><span class="menu-arrow"></span></a>
					<ul style="<?php echo is_block(['leads'],['index','create','edit','followup','convert_school']) ?>;">
						<?php if($this->customlib->getLoginSessionData('user_role') == 1){ ?>
						<li><a href="<?php echo base_url('leads') ?>" class="<?php echo is_active(['leads'],['index','create','edit','followup','convert_school']) ?>">Leads</a></li>
						<?php } ?>
						<li><a href="<?php echo base_url('leads/convertedleads') ?>" class="<?php echo is_active(['leads'],['convertedleads']) ?>">Converted Leads</a></li> 
					</ul>
				</li>
			</ul>
			
		</div>
	</div>
</div>
<!-- /Sidebar -->