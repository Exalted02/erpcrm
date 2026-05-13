<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">School List</h3>
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
								<th>School ID</th>
								<th>Domain Name</th>
								<th>School Name</th>
								<th>State</th>
								<th>District</th>
								<th>City</th>
								<!--<th class="text-end">Status</th>-->
								<th class="text-end">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($domains as $row){ ?>
							<tr>
								<td><?= $row->code_year.$row->code_number ?></td>
								<td><?= $row->domain_name ?></td>
								<td><?= $row->name ?></td>
								<?php
								$state = $this->Country_state_district->get_state_name($row->school_state);
								?>
								<td><?= !empty($state) ? $state->state_name : '' ?></td>
								<?php
								$district = $this->Country_state_district->get_district_name($row->school_district);
								?>
								<td><?= !empty($district) ? $district->district_name : '' ?></td>
								<td><?= $row->school_city ?></td>
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
											<a class="dropdown-item" href="<?= base_url('settings/edit/'.$row->id) ?>"><i class="fa-solid fa-pencil m-r-5"></i> More Details</a>
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
