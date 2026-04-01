<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Lead Followup</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Lead Followup</li>
					</ul>
				</div>
				<div class="col-auto float-end ms-auto">
					<a href="javascript:void(0);" class="btn btn-primary" onclick="openAddModal()"><i class="fa-solid fa-plus"></i> Add Followup</a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<?php 
						if(!empty($lead_followup)){
					?>
						<ul class="timeline">
						<?php 
							$i = 0;
							foreach($lead_followup as $row){
								$class = ($i % 2 == 0) ? '' : 'timeline-inverted';
						?>
							<li class="<?= $class ?>">
								<div class="timeline-badge success">
								   <i class="fas fa-user"></i>
								</div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title"><?= $row->followup_remarks ?></h4>
									</div>
									<div class="timeline-body">
										<span><?= $row->remark_val ?></span>
									</div>
									<div class="edit-delete-merge d-flex justify-between mt-2">
										<small class="text-muted">
										<?php echo isset($row->created_at) ? date('d/m/Y', strtotime($row->created_at)) : '' ?>
										</small>
										<div>
										<a href="javascript:void(0)" class="text-muted" onclick="editFollowup(
											<?= $row->id ?>,
											'<?= htmlspecialchars($row->followup_remarks, ENT_QUOTES) ?>',
											'<?= htmlspecialchars($row->remark_val, ENT_QUOTES) ?>'
										)"><i class="la la-edit me-2"></i>Edit</a>
										
										<a href="javascript:void(0)" class="text-muted" onclick="deleteFollowup(<?= $row->id ?>)"><i class="la la-trash-alt me-2"></i>Delete</a>
										</div>
									</div>
								</div>
							</li>
							<?php $i++; } ?>
						</ul>
						<?php 
						}else{
						?>
						<h4 class="text-center">No Followup</h4>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Content -->
	<!-- Delete Modal -->
	<div class="modal custom-modal1 fade" id="followupModal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form id="followupForm">
					<div class="modal-header">
						<h5 class="modal-title">Followup</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id" id="followup_id">
						<input type="hidden" name="lead_id" value="<?= $lead_id ?>">
						<div class="form-group">
							<label>Followup Remark</label>
							<select name="followup_remarks" id="remarks" class="form-control" required>
								<option value="">Select Remark</option>
								<?php foreach($remarks as $r){ ?>
									<option value="<?= $r->name ?>"><?= $r->name ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group mt-2">
							<label>Remark Value</label>
							<input type="text" name="remark_val" id="remark_val" class="form-control" placeholder="Enter remark value">
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
	<!-- /Delete Modal -->
</div>
<!-- /Page Wrapper -->
