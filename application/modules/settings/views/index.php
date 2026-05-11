<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">School Setting</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">School Setting</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<form method="post" action="<?= base_url('settings/store') ?>" enctype="multipart/form-data">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							<div class="input-block mb-3">
								<label class="col-form-label">Select School <span class="text-danger">*</span></label>
								<select class="select setting_domain_id" name="domain" id="domain">
									<option value="">Select</option>
									<?php foreach($domains as $row){ ?>
									<option value="<?= $row->id ?>"><?= $row->code_year.$row->code_number ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-3" style="display:none;" id="session_list">
							<div class="input-block selectnew mb-3">
								<label class="col-form-label">Session</label>
								<select class="select form-control-sm" name="school_session" id="school_session">
									
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12" id="school_form_area">
				
				</div>
			</form>
		</div>
	</div>
	<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->
