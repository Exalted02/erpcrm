<?php
/**
 * Strips trailing zeros after decimal point.
 * 1000.00 → "1000"   9.50 → "9.5"   0.15 → "0.15"   0.00 → ""
 * Pass $zero_as_empty=false to keep "0" instead of ""
 */
function fmt_num($val, $zero_as_empty = true) {
    $f = (float) $val;
    if ($f == 0) return $zero_as_empty ? '' : '0';
    // rtrim removes trailing zeros and unnecessary decimal point
    return rtrim(rtrim(number_format($f, 2, '.', ''), '0'), '.');
}
?>
<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title"><?= isset($invoice) ? 'Edit' : 'Add' ?> Invoice</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('invoice') ?>">Invoices</a></li>
						<li class="breadcrumb-item active"><?= isset($invoice) ? 'Edit' : 'Add' ?> Invoice</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?= isset($invoice) ? base_url('invoice/edit/'.$invoice->id) : base_url('invoice/create') ?>">

							<div class="row">

								<!-- ── Invoice Number (read-only display) ── -->
								<div class="col-md-12 mb-3">
									<div class="alert alert-light border d-flex align-items-center gap-3" style="background:#fff8f8; border-color:#f5c6c4 !important;">
										<i class="fa-solid fa-file-invoice" style="color:#e03c2f; font-size:18px;"></i>
										<span>
											<strong>Invoice Number:</strong>
											<span id="invoice_full_number" style="color:#e03c2f; font-size:15px; font-weight:700; margin-left:6px;">
												<?php
													if(isset($invoice)){
														echo $invoice->invoice_prefix . '-' . $invoice->invoice_number;
													} else {
														echo ($invoice_prefix ?? 'INV') . '-' . $invoice_number;
													}
												?>
											</span>
										</span>
									</div>
								</div>

								<!-- ── Invoice Prefix ── -->
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">Invoice Prefix <span class="text-danger">*</span></label>
										<input type="text" name="invoice_prefix" id="invoice_prefix"
											class="form-control form-control-sm text-uppercase"
											value="<?= isset($invoice) ? $invoice->invoice_prefix : 'INV' ?>"
											maxlength="10"
											<?= isset($invoice) ? 'readonly' : '' ?>
											placeholder="INV" readonly required>
										<span class="text-danger"><?= form_error('invoice_prefix') ?></span>
									</div>
								</div>

								<!-- ── Invoice Number (read-only) ── -->
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">Invoice #</label>
										<input type="text" name="invoice_number" id="invoice_number"
											class="form-control form-control-sm"
											value="<?= isset($invoice) ? $invoice->invoice_number : $invoice_number ?>"
											readonly style="background:#f5f5f5;">
									</div>
								</div>

								<!-- ── School Dropdown ── -->
								<div class="col-md-8">
									<div class="input-block selectnew mb-3">
										<label class="col-form-label">School ID <span class="text-danger">*</span></label>
										<select class="select form-control-sm" name="domain_id" id="domain_id" required>
											<option value="">-- Select School ID --</option>
											<?php foreach($domains as $d){ ?>
											<option value="<?= $d->id ?>"
												data-schoolid="<?= $d->code_year . $d->code_number ?>"
												data-domain="<?= htmlspecialchars($d->domain_name) ?>"
												<?= (isset($invoice) && $invoice->domain_id == $d->id) ? 'selected' : '' ?>>
												<?= $d->code_year . $d->code_number ?> (<?= $d->name ?>, <?= $d->school_city ?>)
											</option>
											<?php } ?>
										</select>
										<span class="text-danger"><?= form_error('domain_id') ?></span>
									</div>
								</div>

								<!-- ── Item Description ── -->
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">Item Description <span class="text-danger">*</span></label>
										<input type="text" name="item_description" class="form-control form-control-sm"
											value="<?= isset($invoice) ? htmlspecialchars($invoice->item_description) : '' ?>" required>
										<span class="text-danger"><?= form_error('item_description') ?></span>
									</div>
								</div>

								<!-- ── Price Amount ── -->
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">Price Amount <span class="text-danger">*</span></label>
										<input type="text" name="price_amount" id="price_amount"
											class="form-control form-control-sm"
											value="<?= isset($invoice) ? fmt_num($invoice->price_amount, false) : '' ?>"
											oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateTotal();" required>
										<span class="text-danger"><?= form_error('price_amount') ?></span>
									</div>
								</div>

								<!-- ── Discount (flat amount) ── -->
								<div class="col-md-3">
									<div class="input-block mb-3">
										<label class="col-form-label">Discount</label>
											<input type="text" name="discount" id="discount"
												class="form-control form-control-sm"
												value="<?= isset($invoice) ? fmt_num($invoice->discount) : '' ?>"
												placeholder="0"
												oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateTotal();">
										<span class="text-danger"><?= form_error('discount') ?></span>
									</div>
								</div>

								<!-- ── CGST % ── -->
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">CGST %</label>
										<div class="input-group input-group-sm">
											<input type="text" name="cgst_pct" id="cgst_pct"
												class="form-control form-control-sm"
												value="<?= isset($invoice) ? fmt_num($invoice->cgst_pct) : '' ?>"
												placeholder="0"
												oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateTotal();">
											<span class="input-group-text">%</span>
										</div>
										<small class="text-muted">Amt: ₹<span id="cgst_amount_display"><?= isset($invoice) ? fmt_num($invoice->cgst, false) : '0' ?></span></small>
										<span class="text-danger"><?= form_error('cgst_pct') ?></span>
									</div>
								</div>

								<!-- ── IGST % ── -->
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">IGST %</label>
										<div class="input-group input-group-sm">
											<input type="text" name="igst_pct" id="igst_pct"
												class="form-control form-control-sm"
												value="<?= isset($invoice) ? fmt_num($invoice->igst_pct) : '' ?>"
												placeholder="0"
												oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateTotal();">
											<span class="input-group-text">%</span>
										</div>
										<small class="text-muted">Amt: ₹<span id="igst_amount_display"><?= isset($invoice) ? fmt_num($invoice->igst, false) : '0' ?></span></small>
										<span class="text-danger"><?= form_error('igst_pct') ?></span>
									</div>
								</div>

								<!-- ── Total (read-only) ── -->
								<div class="col-md-2">
									<div class="input-block mb-3">
										<label class="col-form-label">Total</label>
											<input type="text" id="total_display" class="form-control form-control-sm"
												value="<?= isset($invoice) ? fmt_num($invoice->total, false) : '0' ?>"
												readonly style="background:#f5f5f5; font-weight:bold;">
									</div>
								</div>

							</div><!-- /.row -->

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
