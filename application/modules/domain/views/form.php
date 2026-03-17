<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->		
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title"><?= isset($domain) ? 'Edit' : 'Add' ?> Domain</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active"><?= isset($domain) ? 'Edit' : 'Add' ?> Domain</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-sm-12">
				<form method="post" action="<?= isset($domain) ? base_url('domain/update/'.$domain->id) : base_url('domain/store') ?>">
					<div class="row">
						<div class="col-md-3">
							<div class="input-block mb-3">
								<label class="col-form-label">Domain Name</label>
								<input type="text" name="domain_name" id="domain_name" class="form-control" placeholder="Domain Name" value="<?= isset($domain) ? $domain->domain_name : '' ?>" required>
							</div>
						</div>
						<div class="col-md-7">
							<div class="input-block mb-3">
								<label class="col-form-label">API Key</label>
								<input type="text" name="api_key" id="api_key" class="form-control" placeholder="API Key" value="<?= isset($domain) ? $domain->api_key : '' ?>" required>
							</div>
						</div>		
						<div class="col-md-2">
							<div class="input-block mb-3">
								<button type="button" onclick="generateKey()" class="btn btn-success">Generate Key</button>
							</div>
						</div>					
					</div>
					<div class="text-end">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>		
			</div>			
		</div>			
	</div>					
</div>
