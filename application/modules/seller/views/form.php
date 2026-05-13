<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->		
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title"><?= isset($seller) ? 'Edit' : 'Add' ?> Re-Seller</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active"><?= isset($seller) ? 'Edit' : 'Add' ?> Re-Seller</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= isset($seller) ? base_url('seller/edit/'.$seller->id) : base_url('seller/create') ?>">
							<div class="row">
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">Firm Name <span class="text-danger">*</span></label>
										<input type="text" name="firm_name" class="form-control form-control-sm" value="<?= set_value('firm_name', isset($seller->firm_name) ? $seller->firm_name : '') ?>">
										<span class="text-danger"><?= form_error('firm_name') ?></span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">Re-Seller Name <span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control form-control-sm" value="<?= set_value('name', isset($seller->name) ? $seller->name : '') ?>">
										<span class="text-danger"><?= form_error('name') ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">Mobile No <span class="text-danger">*</span></label>
										<input type="text" name="mobile_no" class="form-control form-control-sm" value="<?= set_value('mobile_no', isset($seller->mobile_no) ? $seller->mobile_no : '') ?>" oninput="this.value = this.value.replace(/[^0-9,+\-\s]/g, '')">
										<span class="text-danger"><?= form_error('mobile_no') ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">Alternate No</label>
										<input type="text" name="alternate_mobile_no" class="form-control form-control-sm" value="<?= set_value('alternate_mobile_no', isset($seller->alternate_mobile_no) ? $seller->alternate_mobile_no : '') ?>" oninput="this.value = this.value.replace(/[^0-9,+\-\s]/g, '')">
										<span class="text-danger"><?= form_error('alternate_mobile_no') ?></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">Email ID <span class="text-danger">*</span></label>
										<input type="email" name="email" class="form-control form-control-sm" value="<?= set_value('email', isset($seller->email) ? $seller->email : '') ?>">
										<span class="text-danger"><?= form_error('email') ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">GST <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="have_gst">
											<option value="">Please Select</option>
											<option value="1" <?= set_value('have_gst', isset($seller->have_gst) ? $seller->have_gst : '' ) == 1 ? 'selected' : '' ?>>Yes</option>
											<option value="0" <?= set_value('have_gst', isset($seller->have_gst) ? $seller->have_gst : '' ) == 0 ? 'selected' : '' ?>>No</option>
										</select>
										<span class="text-danger"><?= form_error('have_gst') ?></span>
									</div>
								</div>
								<div class="col-md-4 gst-field">
									<div class="input-block mb-3">
										<label class="col-form-label">GST NO <span class="text-danger">*</span></label>
										<input type="text" name="gst_no" class="form-control form-control-sm" value="<?= set_value('gst_no', isset($seller->gst_no) ? $seller->gst_no : '') ?>">
										<span class="text-danger"><?= form_error('gst_no') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">Working Experience <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="working_experience">
											<option value="">Please Select</option>
											<?php for($i = 0; $i <= 30; $i++){ ?>
											<option value="<?= $i ?>" <?= set_value('working_experience', isset($seller->working_experience) ? $seller->working_experience : '' ) == $i ? 'selected' : '' ?>><?= $i ?></option>
											<?php } ?>
										</select>
										<span class="text-danger"><?= form_error('working_experience') ?></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">Country <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="seller_country">
											<option value="1" selected>India</option>
										</select>
										<span class="text-danger"><?= form_error('seller_country') ?></span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">State <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="seller_state" id="seller_state">
											<option value="">Please select</option>
											<?php foreach($getAllState as $stateVal){ ?>
											<option value="<?= $stateVal->id ?>" <?= set_value('seller_state', isset($seller->seller_state) ? $seller->seller_state : '' ) == $stateVal->id ? 'selected' : '' ?>><?= $stateVal->state_name ?></option>
											<?php } ?>
										</select>
										<span class="text-danger"><?= form_error('seller_state') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">District <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="seller_district" id="seller_district">
											<option value="">Please select</option>
										</select>
										<span class="text-danger"><?= form_error('seller_district') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">City <span class="text-danger">*</span></label>
										<input type="text" name="seller_city" class="form-control form-control-sm" value="<?= set_value('seller_city', isset($seller->seller_city) ? $seller->seller_city : '') ?>">
										<span class="text-danger"><?= form_error('seller_city') ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">Pin Code <span class="text-danger">*</span></label>
										<input type="text" name="seller_pin_code" class="form-control form-control-sm" value="<?= set_value('seller_pin_code', isset($seller->seller_pin_code) ? $seller->seller_pin_code : '') ?>">
										<span class="text-danger"><?= form_error('seller_pin_code') ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">Seller Full Address </label>
										<textarea  name="seller_address" placeholder="Seller Full Address" class="form-control"><?= set_value('seller_address', isset($seller->seller_address) ? $seller->seller_address : '') ?></textarea>
										<span class="text-danger"><?= form_error('seller_address') ?></span>
									</div>
								</div>	
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">Password <span class="text-danger">*</span></label>
										<input type="password" name="password" class="form-control form-control-sm" value="" autocomplete="new-password">
										<span class="text-danger"><?= form_error('password') ?></span>
									</div>
								</div>	
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">Discount in percent <span class="text-danger">*</span></label>
										<input type="text" name="discount_percent" id="discount_percent" class="form-control form-control-sm" placeholder="Discount in percent" value="<?= isset($seller->discount_percent) ? $seller->discount_percent : '' ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
										<span class="text-danger"><?= form_error('discount_percent') ?></span>
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
