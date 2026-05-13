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
								<h3 class="page-title"><?= 'Register Re-Seller' ?> </h3>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<form method="post" action="<?= base_url('reseller-registration') ?>">
										<div class="row">
											<div class="col-md-4">
												<div class="input-block mb-3">
													<label class="col-form-label">Firm Name <span class="text-danger">*</span></label>
													<input type="text" name="firm_name" class="form-control form-control-sm" value="<?= set_value('firm_name', isset($seller) ? $seller->firm_name : '') ?>">
													<span class="text-danger"><?= form_error('firm_name') ?></span>
												</div>
											</div>
											<div class="col-md-4">
												<div class="input-block mb-3">
													<label class="col-form-label">Re-Seller Name <span class="text-danger">*</span></label>
													<input type="text" name="name" class="form-control form-control-sm" value="<?= set_value('name', isset($seller) ? $seller->name : '') ?>">
													<span class="text-danger"><?= form_error('name') ?></span>
												</div>
											</div>
											<div class="col-md-2">
												<div class="input-block mb-3">
													<label class="col-form-label">Mobile No <span class="text-danger">*</span></label>
													<input type="text" name="mobile_no" class="form-control form-control-sm" value="<?= set_value('mobile_no', isset($seller) ? $seller->mobile_no : '') ?>" oninput="this.value = this.value.replace(/[^0-9,+\-\s]/g, '')">
													<span class="text-danger"><?= form_error('mobile_no') ?></span>
												</div>
											</div>
											<div class="col-md-2">
												<div class="input-block mb-3">
													<label class="col-form-label">Alternate No</label>
													<input type="text" name="alternate_mobile_no" class="form-control form-control-sm" value="<?= set_value('alternate_mobile_no', isset($seller) ? $seller->alternate_mobile_no : '') ?>" oninput="this.value = this.value.replace(/[^0-9,+\-\s]/g, '')">
													<span class="text-danger"><?= form_error('alternate_mobile_no') ?></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="input-block mb-3">
													<label class="col-form-label">Email ID <span class="text-danger">*</span></label>
													<input type="email" name="email" class="form-control form-control-sm" value="<?= set_value('email', isset($seller) ? $seller->email : '') ?>">
													<span class="text-danger"><?= form_error('email') ?></span>
												</div>
											</div>
											<div class="col-md-2">
												<div class="input-block selectnew mb-3">
													<label class="col-form-label">GST <span class="text-danger">*</span></label>
													<select class="select form-control-sm" name="have_gst">
														<option value="">Please Select</option>
														<option value="1" <?= set_value('have_gst', isset($seller) ? $seller->have_gst : '' ) == 1 ? 'selected' : '' ?>>Yes</option>
														<option value="0" <?= set_value('have_gst', isset($seller) ? $seller->have_gst : '' ) == 0 ? 'selected' : '' ?>>No</option>
													</select>
													<span class="text-danger"><?= form_error('have_gst') ?></span>
												</div>
											</div>
											<div class="col-md-4 gst-field">
												<div class="input-block mb-3">
													<label class="col-form-label">GST NO <span class="text-danger">*</span></label>
													<input type="text" name="gst_no" class="form-control form-control-sm" value="<?= set_value('gst_no', isset($seller) ? $seller->gst_no : '') ?>">
													<span class="text-danger"><?= form_error('gst_no') ?></span>
												</div>
											</div>
											<div class="col-md-3">
												<div class="input-block selectnew mb-3">
													<label class="col-form-label">Working Experience <span class="text-danger">*</span></label>
													<select class="select form-control-sm" name="working_experience">
														<option value="">Please Select</option>
														<?php for($i = 0; $i <= 30; $i++){ ?>
														<option value="<?= $i ?>" <?= set_value('working_experience', isset($seller) ? $seller->working_experience : '' ) == $i ? 'selected' : '' ?>><?= $i ?></option>
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
														<option>Please select</option>
														<?php foreach($getAllState as $stateVal){ ?>
														<option value="<?= $stateVal->id ?>" <?= set_value('seller_state', isset($seller) ? $seller->seller_state : '' ) == $stateVal->id ? 'selected' : '' ?>><?= $stateVal->state_name ?></option>
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
													<input type="text" name="seller_city" class="form-control form-control-sm" value="<?= set_value('seller_city', isset($seller) ? $seller->seller_city : '') ?>">
													<span class="text-danger"><?= form_error('seller_city') ?></span>
												</div>
											</div>
											<div class="col-md-2">
												<div class="input-block mb-3">
													<label class="col-form-label">Pin Code <span class="text-danger">*</span></label>
													<input type="text" name="seller_pin_code" class="form-control form-control-sm" value="<?= set_value('seller_pin_code', isset($seller) ? $seller->seller_pin_code : '') ?>">
													<span class="text-danger"><?= form_error('seller_pin_code') ?></span>
												</div>
											</div>
											<div class="col-md-12">
												<div class="input-block mb-3">
													<label class="col-form-label">Seller Full Address </label>
													<textarea  name="seller_address" placeholder="Seller Full Address" class="form-control"><?= set_value('seller_address', isset($seller) ? $seller->seller_address : '') ?></textarea>
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
													<input type="text" name="discount_percent" id="discount_percent" class="form-control form-control-sm" placeholder="Discount in percent" value="<?= isset($seller) ? $seller->discount_percent : '' ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '')">
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

							$('#seller_district').html(response);

							if(selected_district != ''){
								$('#seller_district').val(selected_district);
							}
						}
					});
				} else {

					$('#seller_district').html(
						'<option value="">Please select</option>'
					);
				}
			}

			// On state change
			$('#seller_state').change(function () {

				let state_id = $(this).val();

				loadDistricts(state_id);

			});

			// Old selected values after validation error
			let old_state = "<?= set_value('seller_state', isset($seller) ? $seller->seller_state : '') ?>";

			let old_district = "<?= set_value('seller_district', isset($seller) ? $seller->seller_district : '') ?>";

			if(old_state != ''){
				loadDistricts(old_state, old_district);
			}

		});
		function toggleGSTField(){

			let gstValue = $('select[name="have_gst"]').val();

			if(gstValue == '1'){

				$('.gst-field').slideDown();

			}else{

				$('.gst-field').slideUp();

				$('input[name="gst_no"]').val('');

			}
		}

		/*
		|--------------------------------------------------------------------------
		| On Change
		|--------------------------------------------------------------------------
		*/
		$(document).on('change', 'select[name="have_gst"]', function(){

			toggleGSTField();

		});

		/*
		|--------------------------------------------------------------------------
		| On Page Load
		|--------------------------------------------------------------------------
		*/
		$(document).ready(function(){

			toggleGSTField();

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