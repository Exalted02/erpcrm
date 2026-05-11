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
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= isset($domain) ? base_url('domain/edit/'.$domain->id) : base_url('domain/create') ?>">
							<div class="row">
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">School Code <span class="text-danger">*</span></label>
										<input type="text"
											   class="form-control form-control-sm"
											   value="<?= $school_code_data['school_code'] ?>"
											   readonly>

										<input type="hidden"
											   name="code_year"
											   value="<?= substr($school_code_data['school_code'],0,4) ?>">

										<input type="hidden"
											   name="code_number"
											   value="<?= substr($school_code_data['school_code'],4) ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">Domain Name <span class="text-danger">*</span></label>
										<input type="text" name="domain_name" id="domain_name" class="form-control form-control-sm" placeholder="Domain Name" value="<?= set_value('domain_name', isset($domain) ? $domain->domain_name : '') ?>" required>
										<span class="text-danger"><?= form_error('domain_name') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">API Key <span class="text-danger">*</span></label>
										<input type="text" name="api_key" id="api_key" class="form-control form-control-sm" placeholder="API Key" value="<?= set_value('api_key', isset($domain) ? $domain->api_key : '') ?>" required>
										<span class="text-danger"><?= form_error('api_key') ?></span>
									</div>
								</div>		
								<div class="col-md-2">
									<div class="input-block mb-3">
										<button type="button" onclick="generateKey()" class="btn btn-success btn-sm mt-4">Generate Key</button>
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
	</div>					
</div>
