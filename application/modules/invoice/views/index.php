<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Invoices</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Invoices</li>
					</ul>
				</div>
				<div class="col-auto float-end ms-auto">
					<a href="<?= base_url('invoice/create') ?>" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Invoice</a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped custom-table mb-0 datatable">
						<thead>
							<tr>
								<th>Invoice No.</th>
								<th>School ID</th>
								<th>Subscription Type</th>
								<th>Price</th>
								<th>Discount</th>
								<th>CGST</th>
								<th>IGST</th>
								<th>Total</th>
								<th>Date</th>
								<th class="text-end">Status</th>
								<th class="text-end">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($invoices as $row){ ?>
							<tr>
								<td><strong><?= $row->invoice_prefix . '-' . $row->invoice_number ?></strong></td>
								<td><?= $row->school_id ?></td>
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
								<td class="text-end">
									<div class="status-toggle">
										<input type="checkbox" class="check status-toggle-btn" data-id="<?= $row->id ?>" id="status_<?= $row->id ?>" <?= $row->status ? 'checked' : '' ?>>
										<label for="status_<?= $row->id ?>" class="checktoggle"></label>
									</div>
								</td>
								<td class="text-end">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="<?= base_url('invoice/edit/'.$row->id) ?>">
												<i class="fa-solid fa-pencil m-r-5"></i> Edit
											</a>
											<!-- Print Invoice → opens modal on same page -->
											<a class="dropdown-item print-invoice-btn" href="javascript:void(0);" data-id="<?= $row->id ?>">
												<i class="fa-solid fa-print m-r-5"></i> Print Invoice
											</a>
											<a class="dropdown-item delete-btn" href="javascript:void(0);" data-id="<?= $row->id ?>" data-bs-toggle="modal" data-bs-target="#delete_invoice">
												<i class="fa-regular fa-trash-can m-r-5"></i> Delete
											</a>
										</div>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Content -->

	<!-- Delete Modal -->
	<div class="modal custom-modal fade" id="delete_invoice" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<div class="form-header">
						<h3>Delete Invoice</h3>
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

</div>
<!-- /Page Wrapper -->
