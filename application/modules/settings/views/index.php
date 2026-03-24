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
								<label class="col-form-label">Select Domain <span class="text-danger">*</span></label>
								<select class="select" name="domain" id="domain">
									<option>Select</option>
									<?php foreach($domains as $row){ ?>
									<option value="<?= $row->id ?>" <?= set_value('domain') == $row->id ? 'selected' : '' ?>><?= $row->domain_name ?></option>
									<?php } ?>
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
