<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Leads</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Leads</li>
					</ul>
				</div>
				<div class="col-auto float-end ms-auto">
					<a href="<?= base_url('leads/create') ?>" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</a>
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
								<th>School Name</th>
								<th style="width:200px;">Code</th>
								<th>Email</th>
								<th>Phone</th>
								<!--<th class="text-end">Status</th>-->
								<th class="text-end">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($datas as $row)
							{
							?>
							<tr>
								<td><?= $row->id ?></td>
								<td><?= $row->school_name ?></td>
								<td><?= $row->school_code ?></td>
								<td><?= $row->school_email ?></td>
								<td><?= $row->school_phone ?></td>
								<!--<td class="text-end">
									<div class="status-toggle">
										<input type="checkbox" class="check status-toggle-btn" data-id="<?= $row->id ?>" id="status_<?= $row->id ?>" <?= $row->status ? 'checked' : '' ?>>
										<label for="status_<?= $row->id ?>" class="checktoggle"></label>
									</div>
								</td>-->
								<td class="text-end">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="<?= base_url('leads/edit/'.$row->id) ?>"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
											<a class="dropdown-item" href="<?= base_url('leads/followup/'.$row->id) ?>"><i class="fa-solid fa-phone m-r-5"></i> Followup</a>
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
</div>
<!-- /Page Wrapper -->
