<!-- Page Wrapper -->
<style>
/* ===== Plan Details (redesigned, full width) ===== */
.plan-overview-card {
	background: #fff;
	border: 1px solid #eef0f4;
	border-radius: 10px;
	box-shadow: 0 2px 10px rgba(0,0,0,0.04);
	overflow: hidden;
	margin-bottom: 24px;
}
.plan-overview-header {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: space-between;
	gap: 16px;
	padding: 24px 28px;
	background: linear-gradient(135deg, #1b2850 0%, #2f4a8c 100%);
	color: #fff;
}
.plan-name-block .plan-badge {
	display: inline-block;
	font-size: 11px;
	font-weight: 600;
	letter-spacing: .5px;
	text-transform: uppercase;
	background: rgba(255,255,255,0.18);
	padding: 4px 10px;
	border-radius: 20px;
	margin-bottom: 8px;
}
.plan-name-block h3 {
	margin: 0;
	color: #fff;
	font-weight: 700;
}
.plan-price-block {
	text-align: right;
}
.plan-price-block .plan-price {
	font-size: 28px;
	font-weight: 700;
	color: #fff;
}
.plan-price-block .plan-duration {
	font-size: 13px;
	opacity: .85;
}
.plan-stats-row {
	display: flex;
	flex-wrap: wrap;
	border-bottom: 1px solid #eef0f4;
}
.plan-stat-box {
	flex: 1 1 220px;
	display: flex;
	align-items: center;
	gap: 14px;
	padding: 20px 28px;
	border-right: 1px solid #eef0f4;
}
.plan-stat-box:last-child {
	border-right: none;
}
.plan-stat-box i {
	font-size: 20px;
	width: 42px;
	height: 42px;
	min-width: 42px;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 8px;
	background: #eef2ff;
	color: #2f4a8c;
}
.plan-stat-box .stat-label {
	display: block;
	font-size: 12px;
	color: #8a94a6;
	margin-bottom: 2px;
}
.plan-stat-box .stat-value {
	display: block;
	font-size: 16px;
	font-weight: 600;
	color: #1b2850;
}
.plan-desc-full {
	padding: 22px 28px;
}
.plan-desc-full h6 {
	font-weight: 600;
	margin-bottom: 10px;
	color: #1b2850;
}
.plan-desc {
    background: #f9f9f9;
    padding: 14px 16px;
    border-radius: 6px;
    margin-bottom: 0;
    max-height: 180px;
    overflow-y: auto;
	line-height: 1.6em !important;
	color: #555;
}

/* ===== Subscription Period form ===== */
.subscription-dates-section {
	background: #fff;
	border: 1px solid #eef0f4;
	border-radius: 10px;
	padding: 22px 28px;
}
.subscription-dates-section h5 {
	font-weight: 600;
	color: #1b2850;
	margin-bottom: 4px;
}
.subscription-dates-section .section-hint {
	font-size: 13px;
	color: #8a94a6;
	margin-bottom: 18px;
}

/* ===== Invoice history ===== */
.invoice-list-section {
	background: #fff;
	border: 1px solid #eef0f4;
	border-radius: 10px;
	padding: 22px 28px;
	margin-top: 24px;
}
.invoice-list-section h5 {
	font-weight: 600;
	color: #1b2850;
	margin-bottom: 4px;
}
.invoice-list-section .section-hint {
	font-size: 13px;
	color: #8a94a6;
	margin-bottom: 18px;
}
.invoice-table-wrap {
	max-height: 360px;
	overflow-y: auto;
}
.invoice-desc-cell {
	max-width: 220px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
	display: block;
}
.invoice-status-badge {
	font-size: 11px;
	font-weight: 600;
	padding: 4px 10px;
	border-radius: 20px;
	text-transform: uppercase;
	letter-spacing: .4px;
}
.invoice-status-badge.paid {
	background: #e6f7ed;
	color: #1e9e5a;
}
.invoice-status-badge.unpaid {
	background: #fdecec;
	color: #d9534f;
}
</style>
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">School Details</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">School ID  </li> 
						<li class="breadcrumb-item active"> #<?= $school['code_year'].$school['code_number'] ?></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<div class="row">
			<div class="col-md-12">
				<div class="card bg-white">
					<div class="card-body">
						<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
							<li class="nav-item"><a class="nav-link <?= ($active_tab == 'registration' || empty($active_tab)) ? 'active' : '' ?>" href="#solid-rounded-justified-tab1" data-bs-toggle="tab">Registration Details</a></li>
							<li class="nav-item"><a class="nav-link <?= ($active_tab == 'plan_dates') ? 'active' : '' ?>" href="#solid-rounded-justified-tab2" data-bs-toggle="tab">Plan Details</a></li>
							<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3" data-bs-toggle="tab">School Strengths</a></li>
							<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab4" data-bs-toggle="tab">School Income</a></li>
							<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab5" data-bs-toggle="tab">School Expense</a></li>
							<li class="nav-item"><a class="nav-link <?= ($active_tab == 'login') ? 'active' : '' ?>" href="#solid-rounded-justified-tab6" data-bs-toggle="tab">Login Details</a></li>
							<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab7" data-bs-toggle="tab">Services</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane <?= ($active_tab == 'registration' || empty($active_tab)) ? 'show active' : '' ?>" id="solid-rounded-justified-tab1">
								<form method="post" action="<?= base_url('settings/edit/'.$school['id']) ?>">
									<input type="hidden" name="sch_id" value="<?php echo $school_api['id'] ?? ''; ?>">
									<input type="hidden" name="form_type" value="registration">
									<div class="row">
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">School Name <span class="text-danger">*</span></label>
												<input type="text" name="name" class="form-control form-control-sm" value="<?= $school['name'] ?? '' ?>">
												<span class="text-danger"><?= form_error('name') ?></span>
											</div>
										</div>
										<div class="col-md-3">
											<div class="input-block mb-6">
												<label class="col-form-label">School Code <span class="text-danger">*</span></label>
												<input type="text" name="dise_code" class="form-control form-control-sm" value="<?= $school['dise_code'] ?? '' ?>">
												<span class="text-danger"><?= form_error('dise_code') ?></span>
											</div>
										</div>
										<div class="col-md-3">
											<div class="input-block mb-6">
												<label class="col-form-label">Affiliate No. <span class="text-danger">*</span></label>
												<input type="text" name="aff_no" class="form-control form-control-sm" value="<?= $school['aff_no'] ?? '' ?>">
												<span class="text-danger"><?= form_error('aff_no') ?></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-6">
												<label class="col-form-label">Address <span class="text-danger">*</span></label>
												<input type="text" name="address" class="form-control form-control-sm" value="<?= $school['address'] ?? '' ?>">
												<span class="text-danger"><?= form_error('address') ?></span>
											</div>
										</div>
										<div class="col-md-3">
											<div class="input-block mb-6">
												<label class="col-form-label">Phone <span class="text-danger">*</span></label>
												<input type="text" name="phone" class="form-control form-control-sm" value="<?= $school['phone'] ?? '' ?>">
												<span class="text-danger"><?= form_error('phone') ?></span>
											</div>
										</div>
										<div class="col-md-3">
											<div class="input-block mb-6">
												<label class="col-form-label">Alternate No. </label>
												<input type="text" name="alternate_no" class="form-control form-control-sm" value="<?= $school['alternate_no'] ?? '' ?>">
												<span class="text-danger"><?= form_error('alternate_no') ?></span>
											</div>
										</div>
										<div class="col-md-3">
											<div class="input-block mb-6">
												<label class="col-form-label">Email <span class="text-danger">*</span></label>
												<input type="text" name="email" class="form-control form-control-sm" value="<?= $school['email'] ?? '' ?>">
												<span class="text-danger"><?= form_error('email') ?></span>
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
												<select class="select form-control-sm" name="school_state" id="school_state" data-selected-district="<?= $school['school_district'] ?? '' ?>">
													<option value="">Please select</option>
													<?php foreach($getAllState as $stateVal){ ?>
													<option value="<?= $stateVal->id ?>" <?= ($school['school_state'] ?? '') == $stateVal->id ? 'selected' : '' ?>><?= $stateVal->state_name ?></option>
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
												<input type="text" name="school_city" class="form-control form-control-sm" value="<?= set_value('school_city', isset($school) ? $school['school_city'] : '') ?>">
												<span class="text-danger"><?= form_error('school_city') ?></span>
											</div>
										</div>
										<div class="col-md-2">
											<div class="input-block mb-3">
												<label class="col-form-label">Pin Code <span class="text-danger">*</span></label>
												<input type="text" name="school_pin_code" class="form-control form-control-sm" value="<?= set_value('school_pin_code', isset($school) ? $school['school_pin_code'] : '') ?>">
												<span class="text-danger"><?= form_error('school_pin_code') ?></span>
											</div>
										</div>
										<div class="col-md-4">
											<div class="input-block selectnew mb-3">
												<label class="col-form-label">Choose Plan <span class="text-danger">*</span></label>
												<select class="select form-control-sm" name="plan_id" id="plan_id">
													<option value="">Please select</option>
													<?php foreach($subscriptions as $subVal){ ?>
													<option value="<?= $subVal->id ?>" <?= ($school['plan_id'] ?? '') == $subVal->id ? 'selected' : '' ?>><?= $subVal->title ?></option>
													<?php } ?>
												</select>
												<span class="text-danger"><?= form_error('plan_id') ?></span>
											</div>
										</div>
										<div class="col-md-3">
											<div class="input-block mb-3">
												<label class="col-form-label">Extra Add-On Students </label>
												<input type="text" name="extra_add_on_students" class="form-control form-control-sm" value="<?= isset($school) ? $school['extra_add_on_students'] : '' ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
												<span class="text-danger"><?= form_error('extra_add_on_students') ?></span>
											</div>
										</div>
										<?php $selected_service_ids = (!empty($school['service_ids'])) ? explode(',', $school['service_ids']) : []; ?>
										<div class="col-md-4">
											<div class="input-block selectnew mb-3">
												<label class="col-form-label">Choose Services</label>
												<select class="select form-control-sm" name="service_ids[]" id="service_ids" multiple="multiple" style="width:100%;">
													<?php foreach($services as $serviceVal){ ?>
													<option value="<?= $serviceVal->id ?>" <?= in_array($serviceVal->id, $selected_service_ids) ? 'selected' : '' ?>><?= $serviceVal->title ?></option>
													<?php } ?>
												</select>
												<span class="text-danger"><?= form_error('service_ids') ?></span>
											</div>
										</div>
										<div class="col-md-2">
											<div class="input-block selectnew mb-3">
												<label class="col-form-label">School Type <span class="text-danger">*</span></label>
												<select class="select form-control-sm" name="school_type" id="school_type">
													<option value="">Please select</option>
													<?php foreach($school_type as $i=>$school_type_val){ ?>
													<option value="<?= $i ?>" <?= (set_value('school_type', $school['school_type'] ?? '') == $i) ? 'selected' : ''; ?>><?= $school_type_val ?></option>
													<?php } ?>
												</select>
												<span class="text-danger"><?= form_error('school_type') ?></span>
											</div>
										</div>
										<div class="col-md-3 seller_div" style="display:none;">
											<div class="input-block selectnew mb-3">
												<label class="col-form-label">Seller <span class="text-danger">*</span></label>
												<select class="select form-control-sm" name="seller_id" id="seller_id">
													<option value="">Select Seller</option>
													<?php foreach($sellers as $sellerVal){ ?>
													<option value="<?= $sellerVal->id ?>"
														<?= ($school['seller_id'] ?? '') == $sellerVal->id ? 'selected' : '' ?>>
														<?= $sellerVal->name ?>
													</option>
													<?php } ?>
												</select>
												<span class="text-danger"><?= form_error('seller_id') ?></span>
											</div>
										</div>
									</div>
									<div class="card" id="seller_info">
									</div>
									<div class="text-end">
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</form>
							</div>
							<div class="tab-pane <?= ($active_tab == 'plan_dates') ? 'show active' : '' ?>" id="solid-rounded-justified-tab2">
							<?php if(isset($plan_details) && !empty($plan_details)){?>
								<div class="plan-overview-card">
									<div class="plan-overview-header">
										<div class="plan-name-block">
											<span class="plan-badge">Current Plan</span>
											<h3><?= $plan_details->title ?? '' ?></h3>
										</div>
										<div class="plan-price-block">
											<span class="plan-price">₹<?= format_amount($plan_details->price ?? 0) ?></span>
											<span class="plan-duration d-block">/ <?= $plan_details->duration ?? '' ?> Month<?= ($plan_details->duration ?? 0) > 1 ? 's' : '' ?></span>
										</div>
									</div>
									<div class="plan-stats-row">
										<div class="plan-stat-box">
											<i class="fa-solid fa-user-graduate"></i>
											<div>
												<span class="stat-label">Student Limit</span>
												<span class="stat-value"><?= $plan_details->max_students ?? '-' ?></span>
											</div>
										</div>
										<?php if(isset($plan_details->add_on_students) && $plan_details->add_on_students > 0){ ?>
										<div class="plan-stat-box">
											<i class="fa-solid fa-user-plus"></i>
											<div>
												<span class="stat-label">Add-On Students</span>
												<span class="stat-value"><?= $plan_details->add_on_students ?></span>
											</div>
										</div>
										<?php } ?>
										<div class="plan-stat-box">
											<i class="fa-solid fa-calendar-days"></i>
											<div>
												<span class="stat-label">Plan Duration</span>
												<span class="stat-value"><?= $plan_details->duration ?? '' ?> Month<?= ($plan_details->duration ?? 0) > 1 ? 's' : '' ?></span>
											</div>
										</div>
									</div>
									<?php if(!empty($plan_details->description)){ ?>
									<div class="plan-desc-full">
										<h6>Plan Description</h6>
										<div class="plan-desc"><?= $plan_details->description ?></div>
									</div>
									<?php } ?>
								</div>
								
								<div class="subscription-dates-section">
									<h5>Subscription Period</h5>
									<p class="section-hint">Set or update this school's subscription validity dates.</p>
									<form method="post" action="<?= base_url('settings/edit/'.$school['id']) ?>">
										<input type="hidden" name="form_type" value="plan_dates">
										<div class="row align-items-end">
											<div class="col-md-3">
												<div class="input-block mb-3">
													<label class="col-form-label">Subscription Start Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input type="text" name="subscription_start_date" id="subscription_start_date" class="form-control form-control-sm datetimepicker" autocomplete="off" value="<?= !empty($school['subscription_start_date']) && strtotime($school['subscription_start_date']) ? date('d-m-Y', strtotime($school['subscription_start_date'])) : set_value('subscription_start_date') ?>">
													</div>
													<span class="text-danger"><?= form_error('subscription_start_date') ?></span>
												</div>
											</div>
											<div class="col-md-3">
												<div class="input-block mb-3">
													<label class="col-form-label">Subscription End Date <span class="text-danger">*</span></label>
													<div class="cal-icon">
														<input type="text" name="subscription_end_date" id="subscription_end_date" class="form-control form-control-sm datetimepicker" autocomplete="off" value="<?= !empty($school['subscription_end_date']) && strtotime($school['subscription_end_date']) ? date('d-m-Y', strtotime($school['subscription_end_date'])) : set_value('subscription_end_date') ?>">
													</div>
													<span class="text-danger"><?= form_error('subscription_end_date') ?></span>
												</div>
											</div>
											<div class="col-md-2">
												<div class="input-block mb-3">
													<button type="submit" class="btn btn-primary w-100">Submit</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							<?php 
							}else{
							?>
								<h4 class="text-center">No Plan Available</h4>
							<?php
							} ?>

								<div class="invoice-list-section">
									<h5>Invoice History</h5>
									<p class="section-hint">All invoices generated for this school.</p>
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0 datatable">
											<thead>
												<tr>
													<th>Invoice No.</th>
													<!--<th>Item Description</th>-->
													<th>Subscription Type</th>
													<th>Price</th>
													<th>Discount</th>
													<th>CGST</th>
													<th>IGST</th>
													<th>Total</th>
													<th>Date</th>
													<th class="text-end">Status</th>
													<!--<th class="text-end">Action</th>-->
												</tr>
											</thead>
											<tbody>
												<?php foreach($invoices as $row){ ?>
												<tr>
													<td><strong><?= $row->invoice_prefix . '-' . $row->invoice_number ?></strong></td>
													<!--<td><?= htmlspecialchars($row->item_description) ?></td>-->
													<td>
														<?php
															$sub_types = !empty($row->subscription_type) ? explode(',', $row->subscription_type) : [];
														?>
														<?php if(in_array('plan', $sub_types)){ ?>
															<span class="badge bg-primary">Plan</span>
														<?php } ?>
														<?php if(in_array('services', $sub_types)){ ?>
															<span class="badge bg-info">Services</span>
														<?php } ?>
														<?php if(empty($sub_types)){ ?>
															<span class="text-muted">-</span>
														<?php } ?>
													</td>
													<td><?= format_amount($row->price_amount) ?></td>
													<td><?= format_amount($row->discount) ?></td>
													<td>
														<?= format_amount($row->cgst) ?>
														<?php if(isset($row->cgst_pct) && $row->cgst_pct > 0){ ?>
															<small class="text-muted">(<?= $row->cgst_pct ?>%)</small>
														<?php } ?>
													</td>
													<td>
														<?= format_amount($row->igst) ?>
														<?php if(isset($row->igst_pct) && $row->igst_pct > 0){ ?>
															<small class="text-muted">(<?= $row->igst_pct ?>%)</small>
														<?php } ?>
													</td>
													<td><strong><?= format_amount($row->total) ?></strong></td>
													<td><?= date('d/m/Y', strtotime($row->created_at)) ?></td>
													<td class="text-center">
														<span class="invoice-status-badge <?= $row->status == 1 ? 'paid' : 'unpaid' ?>"><?= $row->status == 1 ? 'Paid' : 'Unpaid' ?></span>
													</td>
													<!--<td class="text-end">
														<div class="dropdown dropdown-action">
															<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a class="dropdown-item" href="<?= base_url('invoice/edit/'.$row->id) ?>">
																	<i class="fa-solid fa-pencil m-r-5"></i> Edit
																</a>
																<a class="dropdown-item print-invoice-btn" href="javascript:void(0);" data-id="<?= $row->id ?>">
																	<i class="fa-solid fa-print m-r-5"></i> Print Invoice
																</a>
																<a class="dropdown-item delete-btn" href="javascript:void(0);" data-id="<?= $row->id ?>" data-bs-toggle="modal" data-bs-target="#delete_invoice">
																	<i class="fa-regular fa-trash-can m-r-5"></i> Delete
																</a>
															</div>
														</div>
													</td>-->
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane show" id="solid-rounded-justified-tab3">								
								<div class="row">
									<div class="col-md-3" id="session_list">
										<div class="input-block selectnew mb-3">
											<label class="col-form-label">Session</label>
											<select class="select form-control-sm school_filter" data-type="strengths">
												<option value="">Please select</option>
												<?php foreach($school_sessions as $session_Val){ ?>
													<option value="<?= $session_Val['id'] ?>"><?= $session_Val['session'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div id="strengths_html">
								</div>
							</div>
							<div class="tab-pane" id="solid-rounded-justified-tab4">
								<div class="row">
									<div class="col-md-3" id="session_list">
										<div class="input-block selectnew mb-3">
											<label class="col-form-label">Session</label>
											<select class="select form-control-sm school_filter" data-type="income">
												<option value="">Please select</option>
												<?php foreach($school_sessions as $session_Val){ ?>
													<option value="<?= $session_Val['id'] ?>"><?= $session_Val['session'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-block mb-3">
											<label class="col-form-label">From Date</label>
											<div class="cal-icon">
											<input type="text" class="form-control form-control-sm from_date school_filter datetimepicker" data-type="income">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="input-block mb-3">
											<label class="col-form-label">To Date</label>
											<div class="cal-icon">
											<input type="text" class="form-control form-control-sm to_date school_filter datetimepicker" data-type="income">
											</div>
										</div>
									</div>
								</div>
								<div id="income_html">
								</div>
							</div>
							<div class="tab-pane" id="solid-rounded-justified-tab5">
								<div class="row">
									<div class="col-md-3" id="session_list">
										<div class="input-block selectnew mb-3">
											<label class="col-form-label">Session</label>
											<select class="select form-control-sm school_filter" data-type="expense">
												<option value="">Please select</option>
												<?php foreach($school_sessions as $session_Val){ ?>
													<option value="<?= $session_Val['id'] ?>"><?= $session_Val['session'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-block mb-3">
											<label class="col-form-label">From Date</label>
											<div class="cal-icon">
											<input type="text" class="form-control form-control-sm from_date school_filter datetimepicker" data-type="expense">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="input-block mb-3">
											<label class="col-form-label">To Date</label>
											<div class="cal-icon">
											<input type="text" class="form-control form-control-sm to_date school_filter datetimepicker" data-type="expense">
											</div>
										</div>
									</div>
								</div>
								<div id="expense_html">
								</div>
							</div>
							<div class="tab-pane <?= ($active_tab == 'login') ? 'show active' : '' ?>" id="solid-rounded-justified-tab6">
								<form method="post" action="<?= base_url('settings/edit/'.$school['id']) ?>">
									<input type="hidden" name="form_type" value="login">
									<div class="row">
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Login ID <span class="text-danger">*</span></label>
												<input type="text" name="login_id" class="form-control form-control-sm" value="<?= $login_data['email'] ?? '' ?>">
												<span class="text-danger"><?= form_error('login_id') ?></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-6">
												<label class="col-form-label"> Password <span class="text-danger">*</span></label>
												<input type="text" name="login_password" class="form-control form-control-sm" value="<?= $school['domain_login_password'] ?? '' ?>">
												<span class="text-danger"><?= form_error('login_password') ?></span>
												<?php if($school['domain_login_password']==null ){ ?>
												<label class="col-form-label"><small class="text-danger">(Your account is currently using the default password. Please change it for security reasons.)</small></label>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="text-end">
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</form>
							</div>
							<div class="tab-pane" id="solid-rounded-justified-tab7">							
								<h4 class="text-center">Coming Soon</h4>							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--<div class="card">	
			<div class="card-header">
				<h3 class="card-title mb-0"> <?php echo 'Image'; ?></h3>
			</div>
			<div class="card-body">	
				<div class="row">
					<div class="col-md-3">
						<div class="input-block mb-3">
							<label>Admin small logo</label>
							<input type="file" name="admin_small_logo" id="smalllogoInput" class="form-control">
						</div>
					</div>
					<div class="col-md-3">
						<div class="input-block mb-3">
							<label>Logo</label>
							<input type="file" name="admin_logo" id="logoinput" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 admin-small-logo" style="<?php echo isset($school['admin_small_logo']) ? 'display:block' :'display:none' ?>">
						<img id="smalllogoPreview" src="<?php echo isset($school['admin_small_logo'])  ? $domain_name .'/uploads/school_content/admin_small_logo/' . $school['admin_small_logo'] : ''; ?>" height="150" width="150" style="object-fit:cover; border:1px solid #ddd; border-radius:6px;">
					</div>
					
					<div class="col-md-3 admin-logo" style="<?php echo isset($school['admin_logo']) ? 'display:block' :'display:none' ?>">
						<img id="logoPreview" src="<?php echo isset($school['admin_logo'])  ? $domain_name . '/uploads/school_content/admin_logo/' . $school['admin_logo'] : ''; ?>" height="150" width="150" style="object-fit:cover; border:1px solid #ddd; border-radius:6px;">
					</div>
				</div>
				
				<div class="text-end">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</div>
		</div>-->
	</div>
	<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->