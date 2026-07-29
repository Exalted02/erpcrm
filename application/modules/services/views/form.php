<div class="page-wrapper">

	<!-- Page Content -->
	<div class="content container-fluid">
	
		<!-- Page Header -->		
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title"><?= isset($service) ? 'Edit' : 'Add' ?> Service</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item active"><?= isset($service) ? 'Edit' : 'Add' ?> Service</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->
		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= isset($service) ? base_url('services/edit/'.$service->id) : base_url('services/create') ?>">
							<div class="row">
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">Service Name <span class="text-danger">*</span></label>
										<input type="text" name="title" class="form-control form-control-sm" value="<?= isset($service) ? $service->title : '' ?>" required>
										<span class="text-danger"><?= form_error('title') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">Duration <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="duration">
											<option>Select</option>
											<?php foreach($subscriptionDuration as $i=>$durationVal){ ?>
											<option value="<?= $i ?>" <?= isset($service) && ($service->duration == $i)  ? 'selected' : '' ?>><?= $durationVal ?></option>
											<?php } ?>
										</select>
										<span class="text-danger"><?= form_error('duration') ?></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">Service Cost <span class="text-danger">*</span></label>
										<input type="text" name="price" class="form-control form-control-sm" value="<?= isset($service) ? $service->price : '' ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
										<span class="text-danger"><?= form_error('price') ?></span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">Description</label>
										<textarea id="description" name="description" placeholder="" type="text" class="form-control editor1" ><?= isset($service) ? $service->description : '' ?></textarea>
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
