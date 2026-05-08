<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->		
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title"><?= isset($lead) ? 'Edit' : 'Add' ?> </h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active"><?= isset($lead) ? 'Edit' : 'Add' ?> </li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= isset($lead) ? base_url('leads/edit/'.$lead->id) : base_url('leads/create') ?>">
							<div class="row">
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">School Name <span class="text-danger">*</span></label>
										<input type="text" name="school_name" class="form-control form-control-sm" value="<?= set_value('school_name', isset($lead) ? $lead->school_name : '') ?>">
										<span class="text-danger"><?= form_error('school_name') ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">Affiliated with <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="affiliated_with">
											<option>Select</option>
											<?php foreach($schoolAffiliated as $i=>$affiliatedVal){ ?>
											<option value="<?= $i ?>" <?= isset($lead) && ($lead->affiliated_with == $i)  ? 'selected' : '' ?>><?= $affiliatedVal ?></option>
											<?php } ?>
										</select>
										<span class="text-danger"><?= form_error('affiliated_with') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">No of Students <span class="text-danger">*</span></label>
										<input type="number" name="no_of_students" class="form-control form-control-sm" value="<?= set_value('no_of_students', isset($lead) ? $lead->no_of_students : '') ?>">
										<span class="text-danger"><?= form_error('no_of_students') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">School Principal Name <span class="text-danger">*</span></label>
										<input type="text" name="school_principal_name" class="form-control form-control-sm" value="<?= set_value('school_principal_name', isset($lead) ? $lead->school_principal_name : '') ?>">
										<span class="text-danger"><?= form_error('school_principal_name') ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">Contact No. <span class="text-danger">*</span></label>
										<input type="number" name="school_phone" class="form-control form-control-sm" value="<?= set_value('school_phone', isset($lead) ? $lead->school_phone : '') ?>">
										<span class="text-danger"><?= form_error('school_phone') ?></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">Alternate No. </label>
										<input type="number" name="alternate_no" class="form-control form-control-sm" value="<?= set_value('alternate_no', isset($lead) ? $lead->alternate_no : '') ?>">
										<span class="text-danger"><?= form_error('alternate_no') ?></span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">Email ID <span class="text-danger">*</span></label>
										<input type="text" name="school_email" class="form-control form-control-sm" value="<?= set_value('school_email', isset($lead) ? $lead->school_email : '') ?>">
										<span class="text-danger"><?= form_error('school_email') ?></span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">School Website (If Any) </label>
										<input type="text" name="school_website" class="form-control form-control-sm" value="<?= set_value('school_website', isset($lead) ? $lead->school_website : '') ?>">
										<span class="text-danger"><?= form_error('school_website') ?></span>
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
										<select class="select form-control-sm" name="school_state" id="school_state">
											<option>Please select</option>
											<?php foreach($getAllState as $stateVal){ ?>
											<option value="<?= $stateVal->id ?>" <?= set_value('school_state', isset($lead) ? $lead->school_state : '' ) == $stateVal->id ? 'selected' : '' ?>><?= $stateVal->state_name ?></option>
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
										<input type="text" name="school_city" class="form-control form-control-sm" value="<?= set_value('school_city', isset($lead) ? $lead->school_city : '') ?>">
										<span class="text-danger"><?= form_error('school_city') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Pin Code <span class="text-danger">*</span></label>
										<input type="text" name="school_pin_code" class="form-control form-control-sm" value="<?= set_value('school_pin_code', isset($lead) ? $lead->school_pin_code : '') ?>">
										<span class="text-danger"><?= form_error('school_pin_code') ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">School Full Address </label>
										<textarea  name="school_address" placeholder="School Address" class="form-control"><?= set_value('school_address', isset($lead) ? $lead->school_address : '') ?></textarea>
										<span class="text-danger"><?= form_error('school_address') ?></span>
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
