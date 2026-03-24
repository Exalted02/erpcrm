<div class="card">
<div class="card-body">
	<div class="box-header ptbnull">
		<h3 class="box-title titlefix"><i class="fa fa-gear"></i> <?php echo 'General settings'; ?></h3>
		<div class="box-tools pull-right">

		</div><!-- /.box-tools -->
	</div>
	<input type="hidden" name="sch_id" value="<?php echo $school['id'] ?? ''; ?>">
	<div class="row">
		<div class="col-md-6">
			<div class="input-block mb-3">
				<label>School Name</label>
				<input type="text" name="name" class="form-control" value="<?= $school['name'] ?? '' ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="input-block mb-3">
				<label>School Code</label>
				<input type="text" name="dise_code" class="form-control" value="<?= $school['dise_code'] ?? '' ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="input-block mb-6">
				<label>Address</label>
				<input type="text" name="address" class="form-control" value="<?= $school['address'] ?? '' ?>">
			</div>
		</div>
		<div class="col-md-3">
			<div class="input-block mb-6">
				<label>Phone</label>
				<input type="text" name="phone" class="form-control" value="<?= $school['phone'] ?? '' ?>">
			</div>
		</div>
		<div class="col-md-3">
			<div class="input-block mb-6">
				<label>Email</label>
				<input type="text" name="email" class="form-control" value="<?= $school['email'] ?? '' ?>">
			</div>
		</div>
		
	</div>
	
	<div class="box-header ptbnull">
		<h3 class="box-title titlefix"> <?php echo 'Image'; ?></h3>
		<div class="box-tools pull-right">

		</div><!-- /.box-tools -->
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="input-block mb-3">
				<label>Admin small logo</label>
				<input type="file" name="admin_small_logo" id="smalllogoInput" class="form-control">
			</div>
		</div>
		<div class="col-md-3">
			<div class="input-block mb-3">
				<label>Logo</label>
				<input type="file" name="admin_logo" id="logoinput" class="form-control">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 admin-small-logo" style="<?php echo isset($school['admin_small_logo']) ? 'display:block' :'display:none' ?>">
			<img id="smalllogoPreview" src="<?php echo isset($school['admin_small_logo'])  ? $domain_name .'/uploads/school_content/admin_small_logo/' . $school['admin_small_logo'] : ''; ?>" height="150" width="150" style="object-fit:cover; border:1px solid #ddd; border-radius:6px;">
		</div>
		
		<div class="col-md-3 admin-logo" style="<?php echo isset($school['admin_logo']) ? 'display:block' :'display:none' ?>">
			<img id="logoPreview" src="<?php echo isset($school['admin_logo'])  ? $domain_name . '/uploads/school_content/admin_logo/' . $school['admin_logo'] : ''; ?>" height="150" width="150" style="object-fit:cover; border:1px solid #ddd; border-radius:6px;">
		</div>
	</div>
	
	<div class="text-end">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</div>
</div>
