<!-- Page Wrapper -->
<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid pb-0">
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Welcome Admin!</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item active">Dashboard</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
	
		<div class="row">
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<a href="<?php echo base_url('subscription') ?>">
					<div class="card dash-widget">
						<div class="card-body">
							<span class="dash-widget-icon"><i class="fa-solid fa-money-bill"></i></span>
							<div class="dash-widget-info">
								<h3><?= $datas['no_of_plans']; ?></h3>
								<span>No. of Plans</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<a href="<?php echo base_url('leads') ?>">
					<div class="card dash-widget">
						<div class="card-body">
							<span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
							<div class="dash-widget-info">
								<h3><?= $datas['no_of_leads']; ?></h3>
								<span>No. of Leads</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<a href="<?php echo base_url('api-domain') ?>">
					<div class="card dash-widget">
						<div class="card-body">
							<span class="dash-widget-icon"><i class="fa-solid fa-school"></i></span>
							<div class="dash-widget-info">
								<h3><?= $datas['register_school']; ?></h3>
								<span>Register Domain</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
				<a href="<?php echo base_url('api-domain') ?>">
					<div class="card dash-widget">
						<div class="card-body">
							<span class="dash-widget-icon"><i class="fa-regular fa-x"></i></span>
							<div class="dash-widget-info">
								<h3><?= $datas['disable_school']; ?></h3>
								<span>Disable School</span>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		
		<!--<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6 text-center">
						<div class="card">
							<div class="card-body">
								<h3 class="card-title">Total Revenue</h3>
								<div id="bar-charts"></div>
							</div>
						</div>
					</div>
					<div class="col-md-6 text-center">
						<div class="card">
							<div class="card-body">
								<h3 class="card-title">Sales Overview</h3>
								<div id="line-charts"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="card-group m-b-30">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between mb-3">
								<div>
									<span class="d-block">New Employees</span>
								</div>
								<div>
									<span class="text-success">+10%</span>
								</div>
							</div>
							<h3 class="mb-3">10</h3>
							<div class="progress height-five mb-2">
								<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="mb-0">Overall Employees 218</p>
						</div>
					</div>
				
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between mb-3">
								<div>
									<span class="d-block">Earnings</span>
								</div>
								<div>
									<span class="text-success">+12.5%</span>
								</div>
							</div>
							<h3 class="mb-3">$1,42,300</h3>
							<div class="progress height-five mb-2">
								<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="mb-0">Previous Month <span class="text-muted">$1,15,852</span></p>
						</div>
					</div>
				
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between mb-3">
								<div>
									<span class="d-block">Expenses</span>
								</div>
								<div>
									<span class="text-danger">-2.8%</span>
								</div>
							</div>
							<h3 class="mb-3">$8,500</h3>
							<div class="progress height-five mb-2">
								<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="mb-0">Previous Month <span class="text-muted">$7,500</span></p>
						</div>
					</div>
				
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between mb-3">
								<div>
									<span class="d-block">Profit</span>
								</div>
								<div>
									<span class="text-danger">-75%</span>
								</div>
							</div>
							<h3 class="mb-3">$1,12,000</h3>
							<div class="progress height-five mb-2">
								<div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<p class="mb-0">Previous Month <span class="text-muted">$1,42,000</span></p>
						</div>
					</div>
				</div>
			</div>	
		</div>-->
		
		<!-- Statistics Widget -->
		<div class="row">
			<div class="col-lg-6 col-md-12">
				<div class="card flex-fill">
					<div class="card-body">
						<div class="statistic-header">
							<h4>No of Leads</h4>
							<!--<a href="<?php echo base_url('leads') ?>">
								All Leads
							</a>-->
						</div>
						<div class="attendance-list">
							<div class="row">
								<div class="col-md-4">
									<div class="attendance-details">
										<h4 class="text-primary"><?= $datas['no_of_leads']; ?></h4>
										<p>Total</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="attendance-details">
										<h4 class="text-pink"><?= $datas['get_total_followup_leads']; ?></h4>
										<p>Total Followup</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="attendance-details">
										<h4 class="text-success"><?= $datas['total_converted_leads']; ?></h4>
										<p>Total Converted</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="attendance-details">
										<h4 class="text-purple"><?= $datas['total_cancel_leads']; ?></h4>
										<p>Total Cancel</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="attendance-details">
										<h4 class="text-info"><?= $datas['total_transfer_leads']; ?></h4>
										<p>Total Transfer</p>
									</div>
								</div>
							</div>
						</div>
						<div class="view-attendance">
							<a href="<?php echo base_url('leads') ?>">
								All Leads
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="card flex-fill">
					<div class="card-body">
						<div class="statistic-header">
							<h4>No of Re-Seller Leads</h4>
						</div>
						<div class="attendance-list">
							<div class="row">
								<div class="col-md-4">
									<div class="attendance-details">
										<h4 class="text-primary"><?= $datas['no_of_reseller_leads']; ?></h4>
										<p>Total</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="attendance-details">
										<h4 class="text-pink"><?= $datas['get_total_followup_reseller_leads']; ?></h4>
										<p>Total Followup</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="attendance-details">
										<h4 class="text-success"><?= $datas['total_converted_reseller_leads']; ?></h4>
										<p>Total Converted</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="attendance-details">
										<h4 class="text-purple"><?= $datas['total_cancel_reseller_leads']; ?></h4>
										<p>Total Cancel</p>
									</div>
								</div>
							</div>
						</div>
						<div class="view-attendance">
							<a href="<?php echo base_url('leads') ?>">
								All Leads
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-md-12 col-lg-12 col-xl-4 d-flex">
				<div class="card flex-fill dash-statistics">
					<div class="card-body">
						<h5 class="card-title">School Renew</h5>
						<div class="stats-list">
							<div class="stats-info">
								<p>No of School Renew Today <strong>4 <small>/ 65</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-primary w-31" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>No of School Renew in Month <strong>15 <small>/ 92</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-success w-31" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>No of School Renew in Year <strong>85 <small>/ 112</small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-warning w-62" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Invoice Summary</h4>

						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<a href="<?php echo base_url('invoice') ?>">
										<div class="stats-box mb-4">
											<p>Total Invoice</p>
											<h3><?= format_amount($datas['invoice_summary']['total_invoice_generated']); ?></h3>
										</div>
									</a>
								</div>

								<!--<div class="col-md-6 col-6 text-center">
									<a href="<?php echo base_url('invoice') ?>">
										<div class="stats-box mb-4">
											<p>Paid Amount</p>
											<h3><?= format_amount($datas['invoice_summary']['total_paid']); ?></h3>
										</div>
									</a>
								</div>-->
								
								<div class="col-md-6 col-6 text-center">
									<a href="<?php echo base_url('invoice') ?>">
										<div class="stats-box mb-4">
											<p>This Month Revenue</p>
											<h3><?= format_amount($datas['invoice_monthly_summary']['total_paid_this_month'] ?? 0); ?></h3>
										</div>
									</a>
								</div>
							</div>
						</div>

						<?php
							$total = $datas['invoice_summary']['total_invoice_generated'];
							$paid = $datas['invoice_summary']['total_paid'];
							$unpaid = $datas['invoice_summary']['total_unpaid'];

							$paidPercent = ($total > 0) ? round(($paid / $total) * 100) : 0;
							$unpaidPercent = 100 - $paidPercent;
						?>

						<div class="progress mb-4">
							<div class="progress-bar bg-success"
								 style="width:<?= $paidPercent; ?>%">
								<?= $paidPercent; ?>%
							</div>
							<div class="progress-bar bg-danger"
								 style="width:<?= $unpaidPercent; ?>%">
								<?= $unpaidPercent; ?>%
							</div>
						</div>
						<div>
							<p>
								<i class="fa-regular fa-circle-dot text-success me-2"></i>
								Paid Amount
								<span class="float-end"><?= format_amount($datas['invoice_summary']['total_paid']); ?></span>
							</p>
							<p>
								<i class="fa-regular fa-circle-dot text-danger me-2"></i>
								Unpaid Amount
								<span class="float-end"><?= format_amount($datas['invoice_summary']['total_unpaid']); ?></span>
							</p>
							<p>
								<i class="fa-regular fa-circle-dot text-info me-2"></i>
								Total CGST
								<span class="float-end"><?= format_amount($datas['invoice_summary']['total_cgst']); ?></span>
							</p>
							<p>
								<i class="fa-regular fa-circle-dot text-warning me-2"></i>
								Total IGST
								<span class="float-end"><?= format_amount($datas['invoice_summary']['total_igst']); ?></span>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!--<div class="col-md-12 col-lg-6 col-xl-4 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Revenue</h4>
						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Total Revenue</p>
										<h3>100</h3>
									</div>
								</div>
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Received Amt</p>
										<h3>75</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="progress mb-4">
							<div class="progress-bar bg-success w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
							<div class="progress-bar bg-danger w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
						</div>
						<div>
							<p><i class="fa-regular fa-circle-dot text-purple me-2"></i>Total Revenue <span class="float-end">100</span></p>
							<p><i class="fa-regular fa-circle-dot text-success me-2"></i>Received Amt <span class="float-end">75</span></p>
							<p><i class="fa-regular fa-circle-dot text-danger me-2"></i>Pending Revenue <span class="float-end">25</span></p>
						</div>
					</div>
				</div>
			</div>-->	

			
			<div class="col-md-12 col-lg-12 col-xl-4 d-flex">
				<div class="card flex-fill dash-statistics">
					<div class="card-body">
						<h5 class="card-title">Ticket</h5>
						<div class="stats-list">
							<div class="stats-info">
								<?php
									$total_tickets = $datas['pending_tickets'] + $datas['open_tickets'] + $datas['close_tickets'];
									$pending_percentage = round(($datas['pending_tickets']/$total_tickets) * 100);
									$open_percentage = round(($datas['open_tickets']/$total_tickets) * 100);
									$close_percentage = round(($datas['close_tickets']/$total_tickets) * 100);
								?>
								<p>Ticket Pending <strong><?= $datas['pending_tickets']; ?> <small>/ <?= $total_tickets; ?></small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-primary w-<?= $pending_percentage; ?>" role="progressbar" aria-valuenow="<?= $pending_percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Ticket Open <strong><?= $datas['open_tickets']; ?> <small>/ <?= $total_tickets; ?></small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-success w-<?= $open_percentage; ?>" role="progressbar" aria-valuenow="<?= $open_percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="stats-info">
								<p>Ticket Closed <strong><?= $datas['close_tickets']; ?> <small>/ <?= $total_tickets; ?></small></strong></p>
								<div class="progress">
									<div class="progress-bar bg-warning w-<?= $close_percentage; ?>" role="progressbar" aria-valuenow="<?= $close_percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Statistics Widget -->
		
		<!--<div class="row">
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0">Invoices</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-nowrap custom-table mb-0">
								<thead>
									<tr>
										<th>Invoice ID</th>
										<th>Client</th>
										<th>Due Date</th>
										<th>Total</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><a href="invoice-view.html">#INV-0001</a></td>
										<td>
											<h2><a href="#">Global Technologies</a></h2>
										</td>
										<td>11 Mar 2019</td>
										<td>$380</td>
										<td>
											<span class="badge bg-inverse-warning">Partially Paid</span>
										</td>
									</tr>
									<tr>
										<td><a href="invoice-view.html">#INV-0002</a></td>
										<td>
											<h2><a href="#">Delta Infotech</a></h2>
										</td>
										<td>8 Feb 2019</td>
										<td>$500</td>
										<td>
											<span class="badge bg-inverse-success">Paid</span>
										</td>
									</tr>
									<tr>
										<td><a href="invoice-view.html">#INV-0003</a></td>
										<td>
											<h2><a href="#">Cream Inc</a></h2>
										</td>
										<td>23 Jan 2019</td>
										<td>$60</td>
										<td>
											<span class="badge bg-inverse-danger">Unpaid</span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="invoices.html">View all invoices</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0">Payments</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">	
							<table class="table custom-table table-nowrap mb-0">
								<thead>
									<tr>
										<th>Invoice ID</th>
										<th>Client</th>
										<th>Payment Type</th>
										<th>Paid Date</th>
										<th>Paid Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><a href="invoice-view.html">#INV-0001</a></td>
										<td>
											<h2><a href="#">Global Technologies</a></h2>
										</td>
										<td>Paypal</td>
										<td>11 Mar 2019</td>
										<td>$380</td>
									</tr>
									<tr>
										<td><a href="invoice-view.html">#INV-0002</a></td>
										<td>
											<h2><a href="#">Delta Infotech</a></h2>
										</td>
										<td>Paypal</td>
										<td>8 Feb 2019</td>
										<td>$500</td>
									</tr>
									<tr>
										<td><a href="invoice-view.html">#INV-0003</a></td>
										<td>
											<h2><a href="#">Cream Inc</a></h2>
										</td>
										<td>Paypal</td>
										<td>23 Jan 2019</td>
										<td>$60</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="payments.html">View all payments</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0">Clients</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table custom-table mb-0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Status</th>
										<th class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar"><img src="assets/img/profiles/avatar-19.jpg" alt="User Image"></a>
												<a href="client-profile.html">Barry Cuda <span>CEO</span></a>
											</h2>
										</td>
										<td>barrycuda@example.com</td>
										<td>
											<div class="dropdown action-label">
												<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
													<i class="fa-regular fa-circle-dot text-success"></i> Active
												</a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-success"></i> Active</a>
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-danger"></i> Inactive</a>
												</div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar"><img src="assets/img/profiles/avatar-19.jpg" alt="User Image"></a>
												<a href="client-profile.html">Tressa Wexler <span>Manager</span></a>
											</h2>
										</td>
										<td>tressawexler@example.com</td>
										<td>
											<div class="dropdown action-label">
												<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
													<i class="fa-regular fa-circle-dot text-danger"></i> Inactive
												</a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-success"></i> Active</a>
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-danger"></i> Inactive</a>
												</div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="client-profile.html" class="avatar"><img src="assets/img/profiles/avatar-07.jpg" alt="User Image"></a>
												<a href="client-profile.html">Ruby Bartlett <span>CEO</span></a>
											</h2>
										</td>
										<td>rubybartlett@example.com</td>
										<td>
											<div class="dropdown action-label">
												<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
													<i class="fa-regular fa-circle-dot text-danger"></i> Inactive
												</a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-success"></i> Active</a>
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-danger"></i> Inactive</a>
												</div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="client-profile.html" class="avatar"><img src="assets/img/profiles/avatar-06.jpg" alt="User Image"></a>
												<a href="client-profile.html"> Misty Tison <span>CEO</span></a>
											</h2>
										</td>
										<td>mistytison@example.com</td>
										<td>
											<div class="dropdown action-label">
												<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
													<i class="fa-regular fa-circle-dot text-success"></i> Active
												</a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-success"></i> Active</a>
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-danger"></i> Inactive</a>
												</div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="client-profile.html" class="avatar"><img src="assets/img/profiles/avatar-14.jpg" alt="User Image"></a>
												<a href="client-profile.html"> Daniel Deacon <span>CEO</span></a>
											</h2>
										</td>
										<td>danieldeacon@example.com</td>
										<td>
											<div class="dropdown action-label">
												<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
													<i class="fa-regular fa-circle-dot text-danger"></i> Inactive
												</a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-success"></i> Active</a>
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-danger"></i> Inactive</a>
												</div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="clients.html">View all clients</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 d-flex">
				<div class="card card-table flex-fill">
					<div class="card-header">
						<h3 class="card-title mb-0">Recent Projects</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table custom-table mb-0">
								<thead>
									<tr>
										<th>Project Name </th>
										<th>Progress</th>
										<th class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<h2><a href="project-view.html">Office Management</a></h2>
											<small class="block text-ellipsis">
												<span>1</span> <span class="text-muted">open tasks, </span>
												<span>9</span> <span class="text-muted">tasks completed</span>
											</small>
										</td>
										<td>
											<div class="progress progress-xs progress-striped">
												<div class="progress-bar w-65" role="progressbar" data-bs-toggle="tooltip" title="65%"></div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="project-view.html">Project Management</a></h2>
											<small class="block text-ellipsis">
												<span>2</span> <span class="text-muted">open tasks, </span>
												<span>5</span> <span class="text-muted">tasks completed</span>
											</small>
										</td>
										<td>
											<div class="progress progress-xs progress-striped">
												<div class="progress-bar w-15" role="progressbar" data-bs-toggle="tooltip" title="15%"></div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="project-view.html">Video Calling App</a></h2>
											<small class="block text-ellipsis">
												<span>3</span> <span class="text-muted">open tasks, </span>
												<span>3</span> <span class="text-muted">tasks completed</span>
											</small>
										</td>
										<td>
											<div class="progress progress-xs progress-striped">
												<div class="progress-bar w-50" role="progressbar" data-bs-toggle="tooltip" title="50%"></div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="project-view.html">Hospital Administration</a></h2>
											<small class="block text-ellipsis">
												<span>12</span> <span class="text-muted">open tasks, </span>
												<span>4</span> <span class="text-muted">tasks completed</span>
											</small>
										</td>
										<td>
											<div class="progress progress-xs progress-striped">
												<div class="progress-bar w-88" role="progressbar" data-bs-toggle="tooltip" title="88%"></div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<h2><a href="project-view.html">Digital Marketplace</a></h2>
											<small class="block text-ellipsis">
												<span>7</span> <span class="text-muted">open tasks, </span>
												<span>14</span> <span class="text-muted">tasks completed</span>
											</small>
										</td>
										<td>
											<div class="progress progress-xs progress-striped">
												<div class="progress-bar w-100" role="progressbar" data-bs-toggle="tooltip" title="100%"></div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="javascript:void(0)"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="projects.html">View all projects</a>
					</div>
				</div>
			</div>
		</div>-->
	
	</div>
	<!-- /Page Content -->

</div>
<!-- /Page Wrapper -->