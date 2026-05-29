<?php
$CI =& get_instance();

$CI->load->model('seller/Seller_model');
?>
<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Tickets</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Tickets</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		<!-- Search Filter -->
		<form method="POST" action="">
			<div class="row filter-row1 mb-2">

				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-4 col-12">  
					<div class="input-block mb-3">
						<input type="text" name="school_name" placeholder="School Name" class="form-control form-control-sm" value="<?= set_value('school_name') ?>">
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
					<div class="input-block mb-3">
						<input type="text" name="school_code_id" placeholder="School ID" class="form-control form-control-sm" value="<?= set_value('school_code_id') ?>">
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
					<div class="input-block selectnew mb-3">
						<select class="select form-control form-control-sm" name="ticket_type"> 
							<option value="">Select Type</option>
							<?php foreach(ticket_type_array() as $t=>$val){ ?>
							<option value="<?= $t ?>"
								<?= (string)set_value('ticket_type') === (string)$t ? 'selected' : '' ?>>
								<?= $val ?>
							</option>
							<?php } ?>

						</select>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
					<div class="input-block selectnew mb-3">
						<select class="select form-control form-control-sm" name="ticket_status"> 
							<option value="" <?= set_value('ticket_status') == '' ? 'selected' : '' ?>>Select Status</option>
							<option value="1" <?= set_value('ticket_status') == 1 ? 'selected' : '' ?>>Pending</option>
							<option value="2" <?= set_value('ticket_status') == 2 ? 'selected' : '' ?>>Open</option>
							<option value="3" <?= set_value('ticket_status') == 3 ? 'selected' : '' ?>>Close</option>
							
						</select>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
					<button type="submit" class="btn btn-success w-100">Search</button>
				</div>

			</div>
		</form>
		<!-- /Search Filter -->
		
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">				
					<!-- Table -->
					<table class="table table-striped custom-table mb-0 datatable" id="example2">
						<thead>
							<tr>
								<th>ID</th>
								<th>Created Date</th>
								<th>School Code</th>
								<th style="width: 300px;">School Name</th>
								<th>Subject</th>
								<th>Type</th>
                                <th>Status</th>
								<th class="text-end">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($datas as $row)
							{
							?>
							<tr>
								<td><?= $row->id ?></td>
								<td><span style="display: none;"><?= $row->created_at ?></span><?= !empty($row->created_at) ? date('d/m/Y', strtotime($row->created_at)) : '' ?></td>
								<td><?= $row->school_code_id ?></td>
								<td style="width: 300px;"><?= $row->school_name ?></td>
								<td><?= $row->subject ?></td>
								<td>
									<?php echo ticket_type_array()[$row->ticket_type]; ?>
								</td>
								<td>
									<?php

									if ($row->status == 1) {

										echo '<span class="badge bg-warning">Pending</span>';

									} elseif ($row->status == 2) {

										echo '<span class="badge bg-primary">Open</span>';

									} elseif ($row->status == 3) {

										echo '<span class="badge bg-success">Close</span>';
									}

									?>
								</td>
								<td class="text-end">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="<?= base_url('tickets/followup/'.$row->id) ?>"><i class="fa-solid fa-phone m-r-5"></i> Followup</a>
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
</div>
<!-- /Page Wrapper -->
