<!-- Page Wrapper -->
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
						<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
							<li class="nav-item"><a class="nav-link <?= ($active_tab == 'registration' || empty($active_tab)) ? 'active' : '' ?>" href="#solid-rounded-justified-tab1" data-bs-toggle="tab">Registration Details</a></li>
							<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2" data-bs-toggle="tab">School Strengths</a></li>
							<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3" data-bs-toggle="tab">School Income</a></li>
							<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab4" data-bs-toggle="tab">School Expense</a></li>
							<li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab5" data-bs-toggle="tab">Plan Details</a></li>
							<li class="nav-item"><a class="nav-link <?= ($active_tab == 'login') ? 'active' : '' ?>" href="#solid-rounded-justified-tab6" data-bs-toggle="tab">Login Details</a></li>
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
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Pin Code <span class="text-danger">*</span></label>
												<input type="text" name="school_pin_code" class="form-control form-control-sm" value="<?= set_value('school_pin_code', isset($school) ? $school['school_pin_code'] : '') ?>">
												<span class="text-danger"><?= form_error('school_pin_code') ?></span>
											</div>
										</div>
									</div>
									<div class="text-end">
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</form>
							</div>
							<div class="tab-pane show" id="solid-rounded-justified-tab2">								
								<div class="row">
									<div class="col-md-3" id="session_list">
										<div class="input-block selectnew mb-3">
											<label class="col-form-label">Session</label>
											<select class="select form-control-sm school_session" data-type="strengths">
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
							<div class="tab-pane" id="solid-rounded-justified-tab3">
								<div class="row">
									<div class="col-md-3" id="session_list">
										<div class="input-block selectnew mb-3">
											<label class="col-form-label">Session</label>
											<select class="select form-control-sm school_session" data-type="income">
												<option value="">Please select</option>
												<?php foreach($school_sessions as $session_Val){ ?>
													<option value="<?= $session_Val['id'] ?>"><?= $session_Val['session'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div id="income_html">
								</div>
							</div>
							<div class="tab-pane" id="solid-rounded-justified-tab4">
								<div class="row">
									<div class="col-md-3" id="session_list">
										<div class="input-block selectnew mb-3">
											<label class="col-form-label">Session</label>
											<select class="select form-control-sm school_session" data-type="expense">
												<option value="">Please select</option>
												<?php foreach($school_sessions as $session_Val){ ?>
													<option value="<?= $session_Val['id'] ?>"><?= $session_Val['session'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div id="expense_html">
								</div>
							</div>
							<div class="tab-pane" id="solid-rounded-justified-tab5">
								Plan Details
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
												<label class="col-form-label"> Password</label>
												<input type="text" name="login_password" class="form-control form-control-sm" value="">
												<span class="text-danger"><?= form_error('login_password') ?></span>
											</div>
										</div>
									</div>
									<div class="text-end">
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</form>
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