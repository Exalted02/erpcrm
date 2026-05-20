<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Company Details</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Company Details</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="card">
			<div class="card-body">
			<div class="row">
				<form method="post" action="<?= base_url('company_settings') ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo isset($company[0]->id) ? $company[0]->id : ''?>">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="input-block mb-3">
									<label class="col-form-label">Company Name <span class="text-danger">*</span></label>
									<input type="text" name="company_name" class="form-control form-control-sm" value="<?php echo isset($company[0]->school_name) ? $company[0]->school_name : '' ?>">
									<span class="text-danger"><?= form_error('company_name') ?></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">Product Name <span class="text-danger">*</span></label>
									<input type="text" name="product_name" class="form-control form-control-sm" value="<?php echo isset($company[0]->product_name) ? $company[0]->product_name : '' ?>">
									<span class="text-danger"><?= form_error('product_name') ?></span>
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-block selectnew mb-3">
									<label class="col-form-label">Country <span class="text-danger">*</span></label>
									<select class="select form-control-sm" name="country">
										<option value="1" selected>India</option>
									</select>
									<span class="text-danger"><?= form_error('country') ?></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-block selectnew mb-3">
									<label class="col-form-label">State <span class="text-danger">*</span></label>
									<select class="select form-control-sm" name="state" id="state">
										<option value="">Please select</option>
										<?php foreach($getAllState as $stateVal){ ?>
										<option value="<?= $stateVal->id ?>" <?= set_value('state', isset($company[0]->state) ? $company[0]->state : '' ) == $stateVal->id ? 'selected' : '' ?>><?= $stateVal->state_name ?></option>
										<?php } ?>
									</select>
									<span class="text-danger"><?= form_error('state') ?></span>
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-block selectnew mb-3">
									<label class="col-form-label">District <span class="text-danger">*</span></label>
									<select class="select form-control-sm" name="district" id="district">
										<option value="">Please select</option>
									</select>
									<span class="text-danger"><?= form_error('district') ?></span>
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-block mb-3">
									<label class="col-form-label">City <span class="text-danger">*</span></label>
									<input type="text" name="city" class="form-control form-control-sm" value="<?= set_value('city', isset($company[0]->city) ? $company[0]->city : '') ?>">
									<span class="text-danger"><?= form_error('city') ?></span>
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-block mb-3">
									<label class="col-form-label">Pin Code <span class="text-danger">*</span></label>
									<input type="text" name="pin_code" class="form-control form-control-sm" value="<?= set_value('pin_code', isset($company[0]->pin_code) ? $company[0]->pin_code : '') ?>">
									<span class="text-danger"><?= form_error('pin_code') ?></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-block mb-3">
									<label class="col-form-label">Address </label>
									<textarea  name="address" placeholder="Address" class="form-control"><?= set_value('address', isset($company[0]->address) ? $company[0]->address : '') ?></textarea>
									<span class="text-danger"><?= form_error('address') ?></span>
								</div>
							</div>	
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">PAN NO <span class="text-danger">*</span></label>
									<input type="text" name="pan_no" class="form-control form-control-sm" value="<?php echo isset($company[0]->pan_no) ? $company[0]->pan_no : '' ?>">
									<span class="text-danger"><?= form_error('pan_no') ?></span>
								</div>
							</div>	
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">GST No <span class="text-danger">*</span></label>
									<input type="text" name="gst_no" class="form-control form-control-sm" value="<?php echo isset($company[0]->gst_no) ? $company[0]->gst_no : '' ?>">
									<span class="text-danger"><?= form_error('gst_no') ?></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">Contact No <span class="text-danger">*</span></label>
									<input type="text" name="contact_no" class="form-control form-control-sm" value="<?php echo isset($company[0]->contact_no) ? $company[0]->contact_no : '' ?>" oninput="this.value = this.value.replace(/[^0-9,+\-\s]/g, '')">
									<span class="text-danger"><?= form_error('contact_no') ?></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">Email ID <span class="text-danger">*</span></label>
									<input type="email" name="email" class="form-control form-control-sm" value="<?php echo isset($company[0]->email) ? $company[0]->email : '' ?>">
									<span class="text-danger"><?= form_error('email') ?></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">Support No <span class="text-danger">*</span></label>
									<input type="text" name="support_no" class="form-control form-control-sm" value="<?php echo isset($company[0]->support_no) ? $company[0]->support_no : '' ?>" oninput="this.value = this.value.replace(/[^0-9,+\-\s]/g, '')">
									<span class="text-danger"><?= form_error('support_no') ?></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">Relationship Manager No. <span class="text-danger">*</span></label>
									<input type="text" name="relationship_manager_no" class="form-control form-control-sm" value="<?php echo isset($company[0]->relationship_manager_no) ? $company[0]->relationship_manager_no : '' ?>" oninput="this.value = this.value.replace(/[^0-9,+\-\s]/g, '')">
									<span class="text-danger"><?= form_error('relationship_manager_no') ?></span>
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-block mb-3">
									<label class="col-form-label">Bank Name <span class="text-danger">*</span></label>
									<input type="text" name="bank_name" class="form-control form-control-sm" value="<?php echo isset($company[0]->bank_name) ? $company[0]->bank_name : '' ?>">
									<span class="text-danger"><?= form_error('bank_name') ?></span>
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-block mb-3">
									<label class="col-form-label">Account No <span class="text-danger">*</span></label>
									<input type="text" name="account_no" class="form-control form-control-sm" value="<?php echo isset($company[0]->account_no) ? $company[0]->account_no : '' ?>">
									<span class="text-danger"><?= form_error('account_no') ?></span>
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-block mb-3">
									<label class="col-form-label">IFSC Code <span class="text-danger">*</span></label>
									<input type="text" name="ifsc_code" class="form-control form-control-sm" value="<?php echo isset($company[0]->ifsc_code) ? $company[0]->ifsc_code : '' ?>">
									<span class="text-danger"><?= form_error('ifsc_code') ?></span>
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-block mb-3">
									<label class="col-form-label">Branch Name <span class="text-danger">*</span></label>
									<input type="text" name="branch_name" class="form-control form-control-sm" value="<?php echo isset($company[0]->branch_name) ? $company[0]->branch_name : '' ?>">
									<span class="text-danger"><?= form_error('branch_name') ?></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">Logo <span class="text-danger">*</span></label>
									<input type="file" name="logo"  id="logoInput" class="form-control form-control-sm">
									<span class="text-danger"><?= form_error('logo') ?></span>
								</div>
							</div>
							<!--<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">School name <span class="text-danger">*</span></label>
									<input type="text" name="school_name" class="form-control form-control-sm" value="<?php echo isset($company[0]->school_name) ? $company[0]->school_name : '' ?>">
									<span class="text-danger"><?= form_error('school_name') ?></span>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="input-block mb-3">
									<label class="col-form-label">Website url <span class="text-danger">*</span></label>
									<input type="text" name="website_url" class="form-control form-control-sm" value="<?php echo isset($company[0]->website_url) ? $company[0]->website_url : '' ?>">
									<span class="text-danger"><?= form_error('website_url') ?></span>
								</div>
							</div>-->
							
						</div>
						<div class="row">
							<div class="col-md-4">
								<img id="logoPreview" src="<?= isset($company[0]->logo) ? base_url('uploads/company_settings/' . $company[0]->logo) : ''; ?>" height="200" width="200" style="object-fit:cover; border:1px solid #ddd; border-radius:6px;">
							</div>
						</div>
					</div>
					<div class="mt-2 text-end">
						<button type="submit" class="btn btn-primary btn-sm">Submit</button>
					</div>
				</form>
			</div>
		  </div>
		</div>
	</div>
	<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->


