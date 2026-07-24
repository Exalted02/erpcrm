<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Manage Alert</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Manage Alert</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<?php
		// Pre-select ids (as array of strings) for each side, so the select2 shows
		// the previously saved schools when the page reloads.
		$payment_selected_ids = (!empty($alert->payment_reminder_schools)) ? explode(',', $alert->payment_reminder_schools) : [];
		$popup_selected_ids   = (!empty($alert->popup_alert_schools)) ? explode(',', $alert->popup_alert_schools) : [];
		?>

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= base_url('manage_alert') ?>" enctype="multipart/form-data">
							<div class="row">

								<!-- Left Side : Payment Reminder -->
								<div class="col-md-6">
									<h5 class="mb-3">Payment Reminder</h5>

									<div class="input-block mb-3">
										<label class="col-form-label">Payment Reminder</label>
										<input type="text" name="payment_reminder" placeholder="Payment Reminder" class="form-control form-control-sm" value="<?= isset($alert) && !empty($alert->payment_reminder) ? set_value('payment_reminder', $alert->payment_reminder) : set_value('payment_reminder') ?>">
									</div>

									<div class="input-block mb-3">
										<label class="col-form-label">Select School</label>
										<select name="payment_reminder_schools[]" id="payment_reminder_schools" class="select form-control form-control-sm" multiple="multiple" style="width:100%;">
											<?php foreach ($schools as $school) { ?>
												<option value="<?= $school->id ?>" <?= in_array($school->id, $payment_selected_ids) ? 'selected' : '' ?>><?= $school->code_year.$school->code_number.' - '.$school->name ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<!-- /Left Side -->

								<!-- Right Side : Popup Alert -->
								<div class="col-md-6">
									<h5 class="mb-3">Popup Alert</h5>

									<div class="input-block mb-3">
										<label class="col-form-label">Popup Alert Image</label>
										<input type="file" name="popup_alert_image" accept="image/*" class="form-control form-control-sm">
										<small class="text-muted">jpg, jpeg, png, gif, webp — max 2MB</small>

										<?php if (!empty($alert->popup_alert_image)) { ?>
											<div class="mt-2 d-flex align-items-center" style="gap:10px;">
												<img src="<?= base_url('uploads/manage_alert/' . $alert->popup_alert_image) ?>" alt="Popup Alert Image" style="max-width:120px; max-height:120px; border:1px solid #ddd; border-radius:4px; padding:2px;">
												<div class="form-check">
													<input type="checkbox" class="form-check-input" name="remove_popup_alert_image" value="1" id="remove_popup_alert_image">
													<label class="form-check-label" for="remove_popup_alert_image">Remove current image</label>
												</div>
											</div>
										<?php } ?>
									</div>
									
									<div class="input-block mb-3">
										<label class="col-form-label">Popup Alert</label>
										<textarea name="popup_alert" placeholder="Popup Alert" class="form-control"><?= isset($alert) && !empty($alert->popup_alert) ? set_value('popup_alert', $alert->popup_alert) : set_value('popup_alert') ?></textarea>
									</div>

									<div class="input-block mb-3">
										<label class="col-form-label">Select School</label>
										<select name="popup_alert_schools[]" id="popup_alert_schools" class="select form-control form-control-sm" multiple="multiple" style="width:100%;">
											<?php foreach ($schools as $school) { ?>
												<option value="<?= $school->id ?>" <?= in_array($school->id, $popup_selected_ids) ? 'selected' : '' ?>><?= $school->code_year.$school->code_number.' - '.$school->name ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<!-- /Right Side -->

							</div>

							<div class="text-end">
								<button type="submit" class="btn btn-primary"><?= isset($alert) ? 'Update' : 'Submit' ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->
