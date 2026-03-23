<div class="card">
<div class="card-body">
	<input type="hidden" name="sch_id" value="<?php echo $school['id'] ?? ''; ?>">
	<div class="row">
		<div class="col-md-3">
			<div class="input-block mb-3">
				<label>School Name</label>
				<input type="text" name="name" class="form-control" value="<?= $school['name'] ?? '' ?>">
			</div>
		</div>
	</div>
	<div class="text-end">
		<button type="submit" class="btn btn-primary">Update</button>
	</div>
</div>
</div>
