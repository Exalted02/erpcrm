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
		
		<div class="row">
			<form method="post" action="<?= base_url('company_settings/store') ?>" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo isset($company[0]->id) ? $company[0]->id : ''?>">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							<div class="input-block mb-3">
								<label class="col-form-label">Logo <span class="text-danger">*</span></label>
								<input type="file" name="logo">
								<span class="text-danger"><?= form_error('logo') ?></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="input-block mb-3">
								<label class="col-form-label">School name <span class="text-danger">*</span></label>
								<input type="text" name="school_name" class="form-control" value="<?php echo isset($company[0]->school_name) ? $company[0]->school_name : '' ?>">
								<span class="text-danger"><?= form_error('school_name') ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->
