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
										<label class="col-form-label">School ID <span class="text-danger">*</span></label>
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
								<div class="col-md-8">
									<label class="col-form-label">API Key <span class="text-danger">*</span></label>
									<div class="input-group">
										<input type="text" name="api_key" id="api_key" class="form-control form-control-sm" placeholder="API Key" value="<?= set_value('api_key', isset($domain) ? $domain->api_key : '') ?>" required>
										<button type="button" onclick="generateKey()" class="btn btn-success btn-sm">Generate Key</button>
									</div>
									<span class="text-danger"><?= form_error('api_key') ?></span>
								</div>		
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">School Name <span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control form-control-sm" value="<?= set_value('name', isset($domain) ? $domain->name : '') ?>">
										<span class="text-danger"><?= form_error('name') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-6">
										<label class="col-form-label">School Code <span class="text-danger">*</span></label>
										<input type="text" name="dise_code" class="form-control form-control-sm" value="<?= set_value('dise_code', isset($domain) ? $domain->dise_code : '') ?>">
										<span class="text-danger"><?= form_error('dise_code') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-6">
										<label class="col-form-label">Affiliate No. <span class="text-danger">*</span></label>
										<input type="text" name="aff_no" class="form-control form-control-sm" value="<?= set_value('aff_no', isset($domain) ? $domain->aff_no : '') ?>">
										<span class="text-danger"><?= form_error('aff_no') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-6">
										<label class="col-form-label">Address <span class="text-danger">*</span></label>
										<input type="text" name="address" class="form-control form-control-sm" value="<?= set_value('address', isset($domain) ? $domain->address : '') ?>">
										<span class="text-danger"><?= form_error('address') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-6">
										<label class="col-form-label">Phone <span class="text-danger">*</span></label>
										<input type="text" name="phone" class="form-control form-control-sm" value="<?= set_value('phone', isset($domain) ? $domain->phone : '') ?>">
										<span class="text-danger"><?= form_error('phone') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-6">
										<label class="col-form-label">Email <span class="text-danger">*</span></label>
										<input type="text" name="email" class="form-control form-control-sm" value="<?= set_value('email', isset($domain) ? $domain->email : '') ?>">
										<span class="text-danger"><?= form_error('email') ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">Country <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="school_country">
											<option value="1" selected>India</option>
										</select>
										<span class="text-danger"><?= form_error('school_country') ?></span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">State <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="school_state" id="school_state" data-selected-district="<?= $school['school_district'] ?? '' ?>">
											<option value="">Please select</option>
											<?php foreach($getAllState as $stateVal){ ?>
											<option value="<?= $stateVal->id ?>" <?= ($domain->school_state ?? '') == $stateVal->id ? 'selected' : '' ?>><?= $stateVal->state_name ?></option>
											<?php } ?>
										</select>
										<span class="text-danger"><?= form_error('school_state') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">District <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="school_district" id="school_district">
											<option value="">Please select</option>
										</select>
										<span class="text-danger"><?= form_error('school_district') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">City <span class="text-danger">*</span></label>
										<input type="text" name="school_city" class="form-control form-control-sm" value="<?= set_value('school_city', isset($domain) ? $domain->school_city : '') ?>">
										<span class="text-danger"><?= form_error('school_city') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Pin Code <span class="text-danger">*</span></label>
										<input type="text" name="school_pin_code" class="form-control form-control-sm" value="<?= set_value('school_pin_code', isset($domain) ? $domain->school_pin_code : '') ?>">
										<span class="text-danger"><?= form_error('school_pin_code') ?></span>
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
