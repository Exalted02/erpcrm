<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Company Setting</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Company Setting</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="card">
			<div class="card-body">
			<div class="row">
				<form method="post" action="<?= base_url('company_settings/store') ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo isset($company[0]->id) ? $company[0]->id : ''?>">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">Logo <span class="text-danger">*</span></label>
									<input type="file" name="logo"  id="logoInput" class="form-control">
									<span class="text-danger"><?= form_error('logo') ?></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">School name <span class="text-danger">*</span></label>
									<input type="text" name="school_name" class="form-control" value="<?php echo isset($company[0]->school_name) ? $company[0]->school_name : '' ?>">
									<span class="text-danger"><?= form_error('school_name') ?></span>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">Website url <span class="text-danger">*</span></label>
									<input type="text" name="website_url" class="form-control" value="<?php echo isset($company[0]->website_url) ? $company[0]->website_url : '' ?>">
									<span class="text-danger"><?= form_error('website_url') ?></span>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-4">
								<img id="logoPreview" src="<?= isset($company[0]->logo) ? base_url('uploads/company_settings/' . $company[0]->logo) : ''; ?>" height="200" width="200" style="object-fit:cover; border:1px solid #ddd; border-radius:6px;">
							</div>
						</div>
					</div>
					<div class="mt-2 text-end">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		  </div>
		</div>
	</div>
	<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->


