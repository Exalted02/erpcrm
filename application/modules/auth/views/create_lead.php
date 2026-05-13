<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-layout-style="default" data-layout-mode="blue" data-layout-width="fluid" data-layout-position="fixed">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamstechnologies - Bootstrap Admin Template">
        <title>Dashboard - HRMS admin template</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">
    	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/line-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/material.css">
		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
		
		<!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Datatable CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap4.min.css">
	
    </head>
    <body class="account-page">

		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="page-wrapper1">

				<!-- Page Content -->
				<div class="content container-fluid">
				
					<!-- Page Header -->		
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title"><?= 'Add Lead' ?> </h3>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<form method="post" action="<?= base_url('create-lead') ?>">
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
													<input type="text" name="no_of_students" class="form-control form-control-sm" value="<?= set_value('no_of_students', isset($lead) ? $lead->no_of_students : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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
													<input type="text" name="school_phone" class="form-control form-control-sm" value="<?= set_value('school_phone', isset($lead) ? $lead->school_phone : '') ?>" oninput="this.value = this.value.replace(/[^0-9,+\-\s]/g, '')">
													<span class="text-danger"><?= form_error('school_phone') ?></span>
												</div>
											</div>
											<div class="col-md-2">
												<div class="input-block mb-3">
													<label class="col-form-label">Alternate No. </label>
													<input type="text" name="alternate_no" class="form-control form-control-sm" value="<?= set_value('alternate_no', isset($lead) ? $lead->alternate_no : '') ?>" oninput="this.value = this.value.replace(/[^0-9,+\-\s]/g, '')">
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

		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Theme Settings JS -->
		<script src="<?php echo base_url(); ?>assets/js/layout.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/theme-settings.js"></script>

		<!-- Custom JS -->
		<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
		
		<!-- Editor JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
		
		<!-- Datatable js -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>
		
		<!-- Toastr CSS & JS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/toastr.min.css"/>
		<script src="<?php echo base_url(); ?>assets/js/toastr.min.js"></script>
		<script>
		$(document).ready(function () {

			function loadDistricts(state_id, selected_district = '') {
				if(state_id != ''){
					$.ajax({
						url: "<?= base_url('common/getDistricts') ?>",
						type: "POST",
						data: {state_id: state_id},

						success: function (response) {

							$('#school_district').html(response);

							if(selected_district != ''){
								$('#school_district').val(selected_district);
							}
						}
					});
				} else {

					$('#school_district').html(
						'<option value="">Please select</option>'
					);
				}
			}

			// On state change
			$('#school_state').change(function () {

				let state_id = $(this).val();

				loadDistricts(state_id);

			});

			// Old selected values after validation error
			let old_state = "<?= set_value('school_state', isset($lead) ? $lead->school_state : '') ?>";

			let old_district = "<?= set_value('school_district', isset($lead) ? $lead->school_district : '') ?>";

			if(old_state != ''){
				loadDistricts(old_state, old_district);
			}

		});

		</script>
		<script>
			<?php if($this->session->flashdata('success')){ ?>
				toastr_msg("<?php echo $this->session->flashdata('success'); ?>", "success");
			<?php } ?>

			<?php if($this->session->flashdata('error')){ ?>
				toastr_msg("<?php echo $this->session->flashdata('error'); ?>", "error");
			<?php } ?>

			<?php if($this->session->flashdata('info')){ ?>
				toastr_msg("<?php echo $this->session->flashdata('info'); ?>", "info");
			<?php } ?>

			<?php if($this->session->flashdata('warning')){ ?>
				toastr_msg("<?php echo $this->session->flashdata('warning'); ?>", "warning");
			<?php } ?>
			
			function toastr_msg(msg, type){
				toastr.options = {
					"closeButton": true,
					"progressBar": true
				};
				toastr[type](msg);
			}
			
			$(document).ready(function () {
				if (typeof CKEDITOR !== "undefined" && $('#editor1').length > 0) {
					CKEDITOR.replace('editor1', {
						allowedContent: true
					});
				}
			});
		</script>
		
		<?php if(isset($script)){$this->load->view($script);} ?>
    </body>
</html>