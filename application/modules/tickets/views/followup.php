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
				<div class="ticket-detail-head">
					<div class="row">
						<div class="col-xxl-5 col-md-5">
							<div class="ticket-head-card">
								<span class="ticket-detail-icon bg-danger-lights"><i class="la la-user"></i></span>
								<div class="detail-info info-two">
									<h6>Created By</h6>
									<span><?= $get_ticket_details->school_name ?></span>
								</div>
							</div>
						</div>
						<div class="col-xxl-3 col-md-3">
							<div class="ticket-head-card">
								<span class="ticket-detail-icon bg-warning-lights"><i class="la la-calendar"></i></span>
								<div class="detail-info info-two">
									<h6>Created Date</h6>
									<span><?= !empty($get_ticket_details->created_at) ? date('d/m/Y', strtotime($get_ticket_details->created_at)) : '' ?></span>
								</div>
							</div>
						</div>
						<div class="col-xxl-2 col-md-2">
							<div class="ticket-head-card">
								<span class="ticket-detail-icon"><i class="la la-stop-circle"></i></span>
								<div class="detail-info">
									<h6>Status</h6>
									<?php
									if ($get_ticket_details->status == 1) {
										echo '<span class="badge badge-soft-warning">Pending</span>';
									} elseif ($get_ticket_details->status == 2) {
										echo '<span class="badge badge-soft-primary">Open</span>';
									} elseif ($get_ticket_details->status == 3) {
										echo '<span class="badge badge-soft-success">Close</span>';
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-xxl-2 col-md-2">
							<div class="ticket-head-card">
								<span class="ticket-detail-icon bg-purple-lights"><i class="la la-info-circle"></i></span>
								<div class="detail-info">
									<h6>Priority</h6>
									<span><?php echo ticket_type_array()[$get_ticket_details->ticket_type]; ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="ticket-purpose">
					<h4><?= $get_ticket_details->subject ?></h4>
					<p><?= $get_ticket_details->body ?></p>
				</div>
			</div>
			<?php if(!empty($ticket_files)) { ?>
			<div class="col-md-12">				
				<div class="attached-files-info mb-4">
					<div class="attached-files">
						<ul>
						<?php foreach ($ticket_files as $file) { ?>
								<?php
								$file_url = base_url('uploads/tickets/' . $file['file']);
								$ext = strtolower(pathinfo($file['file'], PATHINFO_EXTENSION));
								$image_ext = ['jpg','jpeg','png','gif','webp'];
								?>
							<li>
								<div class="d-flex align-items-center">
									<span class="file-icon"><i class="la la-file-pdf"></i></span>
									<p><?php echo $file_url; ?></p>
								</div>
								<div class="file-download">
								<?php if (in_array($ext, $image_ext)) { ?>
									<a href="<?php echo $file_url; ?>"><i class="la la-eye"></i>Preview</a>
								<?php } else { ?>
									<a href="<?php echo $file_url; ?>"><i class="la la-download"></i>Download</a>
								<?php } ?>	
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<?php } ?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<?php 
						if(!empty($ticket_followup)){
					?>
						<ul class="timeline">
						<?php 
							$is_user = false;
							foreach($ticket_followup as $row){
								$is_user = ($row->user_type == 1) ? false : true;
						?>
							<li class="<?= $is_user ? 'timeline-inverted' : ''; ?>">
								<div class="timeline-badge success">
								<?php if($is_user){ ?>
									<img src="<?php echo base_url(); ?>assets/img/favicon.png"></i>
								<?php }else{ ?>
								   <i class="fas fa-user"></i>
								<?php } ?>  
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
										<?php if($is_user){ ?>
										<div>
										<a href="javascript:void(0)" class="text-muted" onclick="editFollowup(
											<?= $row->id ?>,
											'<?= htmlspecialchars($row->message, ENT_QUOTES) ?>'
										)"><i class="la la-edit me-2"></i>Edit</a>
										
										<a href="javascript:void(0)" class="text-muted" onclick="deleteFollowup(<?= $row->id ?>)"><i class="la la-trash-alt me-2"></i>Delete</a>
										</div>
										<?php } ?>
									</div>
								</div>
							</li>
							<?php } ?>
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
