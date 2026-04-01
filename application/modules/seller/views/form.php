<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->		
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title"><?= isset($seller) ? 'Edit' : 'Add' ?> Seller</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active"><?= isset($seller) ? 'Edit' : 'Add' ?> Seller</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= isset($seller) ? base_url('seller/edit/'.$seller->id) : base_url('seller/create') ?>">
							<div class="row">
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">Name <span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control" value="<?= isset($seller) ? $seller->name : '' ?>" required>
										<span class="text-danger"><?= form_error('name') ?></span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">Email <span class="text-danger">*</span></label>
										<input type="email" name="email" class="form-control" value="<?= isset($seller) ? $seller->email : '' ?>" required>
										<span class="text-danger"><?= form_error('email') ?></span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-block mb-3">
										<label class="col-form-label">Password <span class="text-danger">*</span></label>
										<input type="password" name="password" class="form-control" value="">
										<span class="text-danger"><?= form_error('password') ?></span>
									</div>
								</div>					
							</div>
							<div class="text-end">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>		
					</div>			
				</div>			
			</div>			
		</div>			
	</div>					
</div>
