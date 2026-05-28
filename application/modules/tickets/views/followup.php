<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Ticket Followup</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Ticket Followup</li>
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
						if(!empty($ticket_followup)){
					?>
						<ul class="timeline">
						<?php 
							$i = 0;
							foreach($ticket_followup as $row){
								$class = ($i % 2 == 0) ? '' : 'timeline-inverted';
						?>
							<li class="<?= $class ?>">
								<div class="timeline-badge success">
								   <i class="fas fa-user"></i>
								</div>
								<div class="timeline-panel">
									<!--<div class="timeline-heading">
										<h4 class="timeline-title"><?= $row->message ?></h4>
									</div>-->
									<div class="timeline-body">
										<span><?= $row->message ?></span>
									</div>
									<div class="edit-delete-merge d-flex justify-between mt-2">
										<small class="text-muted">
										<?php echo isset($row->created_at) ? date('d/m/Y', strtotime($row->created_at)) : '' ?>
										</small>
										<div>
										<a href="javascript:void(0)" class="text-muted" onclick="editFollowup(
											<?= $row->id ?>,
											'<?= htmlspecialchars($row->message, ENT_QUOTES) ?>'
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
	<!-- Followup Modal -->
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
						<input type="hidden" name="ticket_id" value="<?= $ticket_id ?>">
						<div class="form-group mt-2">
							<label>Message</label>
							<input type="text" name="message" id="message" class="form-control form-control-sm" placeholder="Enter message">
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
	<!-- /Followup Modal -->
</div>
<!-- /Page Wrapper -->
