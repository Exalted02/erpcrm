<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->		
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">ERP Updates <?= isset($schoolnewly) ? 'Edit' : 'Add' ?> </h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">ERP Updates <?= isset($schoolnewly) ? 'Edit' : 'Add' ?> </li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= isset($schoolnewly) ? base_url('school_newly_update/edit/'.$schoolnewly->id) : base_url('school_newly_update/create') ?>">
							<div class="row">
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Title <span class="text-danger">*</span></label>
										<input type="text" name="title" class="form-control form-control-sm" value="<?= isset($schoolnewly) ? $schoolnewly->title : '' ?>">
										<span class="text-danger"><?= form_error('title') ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Release date <span class="text-danger">*</span></label>
										<div class="cal-icon">
										<input type="text" name="release_date" class="form-control form-control-sm datetimepicker"value="<?= !empty($schoolnewly->release_date) ? date('d-m-Y', strtotime($schoolnewly->release_date)) : '' ?>">
										</div>
										<span class="text-danger"><?= form_error('release_date') ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">Details <span class="text-danger">*</span></label>
										<textarea  name="details" placeholder="Details" class="form-control"><?= isset($schoolnewly) ? $schoolnewly->details : '' ?></textarea>
										<span class="text-danger"><?= form_error('details') ?></span>
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
