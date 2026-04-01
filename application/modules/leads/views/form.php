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
										<textarea  name="school_address" placeholder="Address" class="form-control">
											<?= isset($lead) ? $lead->school_address : '' ?>
										</textarea>
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
