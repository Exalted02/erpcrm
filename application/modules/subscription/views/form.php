<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->		
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title"><?= isset($subscription) ? 'Edit' : 'Add' ?> Subscription</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active"><?= isset($subscription) ? 'Edit' : 'Add' ?> Subscription</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= isset($subscription) ? base_url('subscription/edit/'.$subscription->id) : base_url('subscription/create') ?>">
							<div class="row">
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">Title <span class="text-danger">*</span></label>
										<input type="text" name="title" class="form-control" value="<?= isset($subscription) ? $subscription->title : '' ?>" required>
										<span class="text-danger"><?= form_error('title') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">Price <span class="text-danger">*</span></label>
										<input type="number" name="price" class="form-control" value="<?= isset($subscription) ? $subscription->price : '' ?>" required>
										<span class="text-danger"><?= form_error('price') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">Duration <span class="text-danger">*</span></label>
										<input type="text" name="duration" class="form-control" value="<?= isset($subscription) ? $subscription->duration : '' ?>" required>
										<span class="text-danger"><?= form_error('duration') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">Max Students <span class="text-danger">*</span></label>
										<input type="number" name="max_students" class="form-control" value="<?= isset($subscription) ? $subscription->max_students : '' ?>" required>
										<span class="text-danger"><?= form_error('max_students') ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">Description</label>
										<textarea id="editor1" name="description" placeholder="" type="text" class="form-control editor1" >
											<?= isset($subscription) ? $subscription->description : '' ?>
										</textarea>
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
