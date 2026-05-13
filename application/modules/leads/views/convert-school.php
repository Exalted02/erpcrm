<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->		
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Convert School </h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Convert School </li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= base_url('leads/convert_school_edit/'.$lead->id); ?>" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">School Name <span class="text-danger">*</span></label>
										<input type="text" name="school_name" class="form-control" value="<?= isset($lead) ? $lead->school_name : '' ?>">
										<span class="text-danger"><?= form_error('school_name') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">School Code <span class="text-danger">*</span></label>
										<input type="text" name="school_code" class="form-control" value="<?= isset($lead) ? $lead->school_code : '' ?>">
										<span class="text-danger"><?= form_error('school_code') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">School Email <span class="text-danger">*</span></label>
										<input type="text" name="school_email" class="form-control" value="<?= isset($lead) ? $lead->school_email : '' ?>">
										<span class="text-danger"><?= form_error('school_email') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">School Phone <span class="text-danger">*</span></label>
										<input type="text" name="school_phone" class="form-control" value="<?= isset($lead) ? $lead->school_phone : '' ?>">
										<span class="text-danger"><?= form_error('school_phone') ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">Address <span class="text-danger">*</span></label>
										<textarea  name="school_address" placeholder="Address" class="form-control"><?= isset($lead) ? $lead->school_address : '' ?></textarea>
										<span class="text-danger"><?= form_error('school_address') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Total Student <span class="text-danger">*</span></label>
										<input type="text" name="total_student" class="form-control" value="<?= isset($lead->total_student) ? $lead->total_student : '' ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
										<span class="text-danger"><?= form_error('total_student') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Select Subscription <span class="text-danger">*</span></label>
										<select name="subscription_id" id="subscription_id" class="form-control" required>
											<option value="">Select Subscription</option>
											<?php foreach($subscriptions as $s_val){ ?>
												<option value="<?= $s_val->id ?>" <?= isset($lead->subscription_id) && ($lead->subscription_id == $s_val->id)  ? 'selected' : '' ?>><?= $s_val->title ?></option>
											<?php } ?>
										</select>
										<span class="text-danger"><?= form_error('total_student') ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label>School Logo</label>
										<input type="file" name="school_logo" id="schoollogoInput" class="form-control">
									</div>
									<?php 
									$school_logo = '';
									if(isset($lead->school_logo) && $lead->school_logo != null){
										$path1 = "uploads/convert_school/" . $lead->school_logo;
										$url = FCPATH . $path1;
										if (file_exists($url)) {
											$school_logo = $path1;
										}
									}
									?>
									<div class="school-logo" style="<?= $school_logo == '' ? 'display:none' : '' ?> ">
										<img id="schoollogoPreview" src="<?= base_url().$school_logo ?>" height="150" width="150" style="object-fit:cover; border:1px solid #ddd; border-radius:6px;">
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
