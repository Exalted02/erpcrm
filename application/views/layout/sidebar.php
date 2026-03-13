<!-- Sidebar -->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul class="sidebar-vertical">
				<li class="menu-title"> 
					<span>Main</span>
				</li>
				<li class="active"> 
					<a href="<?= base_url('dashboard') ?>"><i class="la la-dashcube"></i> <span>Dashboard</span></a>
				</li>
				<li class="submenu">
					<a href="#"><i class="la la-cubes"></i> <span> Manage Subscription</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a href="<?= base_url('subscription/create') ?>" class="active">Add</a></li>
						<li><a  href="<?= base_url('subscription') ?>">List</a></li>
					</ul>
				</li>
			</ul>
			
		</div>
	</div>
</div>
<!-- /Sidebar -->