<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Converted Leads</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Leads</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">				
					<!-- Table -->
					<table class="table table-striped custom-table mb-0 datatable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Seller Name</th>
								<th>School Name</th>
								<th style="width:200px;">Code</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Total Student</th>
								<?php if($this->customlib->getLoginSessionData('user_role') == 0){ ?>
								<th>Subscription</th>
								<?php } ?>
								<th class="text-end">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($datas as $row)
							{
							?>
							<tr>
								<td><?= $row->id ?></td>
								<td><?= $this->customlib->getUserDetailsById($row->seller_id)->name ?></td>
								<td><?= $row->school_name ?? '' ?></td>
								<td><?= $row->school_code ?? '' ?></td>
								<td><?= $row->school_email ?? '' ?></td>
								<td><?= $row->school_phone  ?? ''?></td>
								<td><?= $row->total_student ?? '' ?></td>
								<?php if($this->customlib->getLoginSessionData('user_role') == 0){ ?>
								<td><button type="button" class="btn btn-primary btn-sm manage_subscription" data-id="<?= $row->id ?>">Manage</button></td>
								<?php } ?>
								<td class="text-end">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="<?= base_url('leads/edit/'.$row->id) ?>"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
											<a class="dropdown-item" href="<?= base_url('leads/followup/'.$row->id) ?>"><i class="fa-solid fa-phone m-r-5"></i> Followup</a>
											<a class="dropdown-item" href="<?= base_url('leads/convert_school/'.$row->id) ?>"><i class="fa-solid fa-home m-r-5"></i> Convert School</a>
											<a class="dropdown-item delete-btn" href="javascript:void(0);" data-id="<?= $row->id ?>" data-bs-toggle="modal" data-bs-target="#delete_promotion"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
											<!--<a href="<?= base_url('subscription/delete/'.$row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this record?')">Delete</a>-->
										</div>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<!-- /Table -->
					
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Content -->
	<!-- Delete Modal -->
	<div class="modal custom-modal fade" id="delete_promotion" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<div class="form-header">
						<h3>Delete Lead</h3>
						<p>Are you sure want to delete?</p>
					</div>
					<input type="hidden" id="delete_id">
					<div class="modal-btn delete-action">
						<div class="row">
							<div class="col-6">
								<a href="javascript:void(0);" id="confirm_delete" class="btn btn-primary continue-btn">Delete</a>
							</div>
							<div class="col-6">
								<a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Delete Modal -->
	
	<div class="modal custom-modal1 fade" id="manage_subscription" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form id="followupForm">
					<div class="modal-header">
						<h5 class="modal-title">Manage Subscription</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="lead_id" name="lead_id" value="">
						<div class="form-group">
							<label>Subscription</label>
							<select name="subscription_id" id="subscription_id" class="form-control" required>
								<option value="">Select Subscription</option>
								<?php foreach($subscriptions as $s_val){ ?>
									<option value="<?= $s_val->id ?>"><?= $s_val->title ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group mt-2">
							<label>Discount in percent (*)</label>
							<input type="number" name="discount_percent" id="discount_percent" class="form-control" placeholder="Discount in percent (*)">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Page Wrapper -->
