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
				<?php if($this->customlib->getSessionUserRole() == 0){ ?>
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
				<?php if($this->customlib->getSessionUserRole() == 1){ ?>
				<li class="<?php echo is_active(['leads'],['index','create','edit','followup']) ?>"> 
					<a href="<?php echo base_url('leads') ?>"><i class="la la-cubes"></i> <span>Leads</span></a>
				</li>
				<?php } ?>
			</ul>
			
		</div>
	</div>
</div>
<!-- /Sidebar -->