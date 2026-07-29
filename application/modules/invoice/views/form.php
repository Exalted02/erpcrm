<?php
/**
 * Strips trailing zeros after decimal point.
 * 1000.00 → "1000"   9.50 → "9.5"   0.15 → "0.15"   0.00 → ""
 * Pass $zero_as_empty=false to keep "0" instead of ""
 */
function fmt_num($val, $zero_as_empty = true) {
    $f = (float) $val;
    if ($f == 0) return $zero_as_empty ? '' : '0';
    return rtrim(rtrim(number_format($f, 2, '.', ''), '0'), '.');
}

$subscription_types_selected = isset($invoice) && !empty($invoice->subscription_type)
    ? explode(',', $invoice->subscription_type)
    : ['plan']; // default to Plan checked for a brand-new invoice

$has_plan_selected     = in_array('plan', $subscription_types_selected);
$has_services_selected = in_array('services', $subscription_types_selected);

$existing_service_items = isset($existing_service_items) ? $existing_service_items : [];
$existing_service_ids   = isset($invoice) && !empty($invoice->service_ids) ? explode(',', $invoice->service_ids) : [];
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
						<form method="post" action="<?= isset($invoice) ? base_url('invoice/edit/'.$invoice->id) : base_url('invoice/create') ?>" id="invoice_form">

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
											<?php
											foreach($domains as $d){
												$CI =& get_instance();
												$CI->load->model('subscription/Subscription_model', 'subscription_model');
												$domain_price = '';
												if($d->plan_id != null){
													$domain_price = $CI->subscription_model->get($d->plan_id)->price;
												}
												$domain_service_ids = !empty($d->service_ids) ? $d->service_ids : '';
											?>
											<option value="<?= $d->id ?>"
												data-schoolid="<?= $d->code_year . $d->code_number ?>"
												data-schoolplanprice="<?= format_amount($domain_price) ?>"
												data-serviceids="<?= htmlspecialchars($domain_service_ids) ?>"
												data-domain="<?= htmlspecialchars($d->domain_name) ?>"
												<?= (isset($invoice) && $invoice->domain_id == $d->id) ? 'selected' : '' ?>>
												<?= $d->code_year . $d->code_number ?> (<?= $d->name ?>, <?= $d->school_city ?>)
											</option>
											<?php } ?>
										</select>
										<span class="text-danger"><?= form_error('domain_id') ?></span>
									</div>
								</div>

								<!-- ── Subscription Type ── -->
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">Subscription Type <span class="text-danger">*</span></label>
										<div class="d-flex gap-4">
											<div class="form-check">
												<input class="form-check-input subscription-type-check" type="checkbox" name="subscription_type[]" id="type_plan" value="plan" <?= $has_plan_selected ? 'checked' : '' ?>>
												<label class="form-check-label" for="type_plan">Plans</label>
											</div>
											<div class="form-check">
												<input class="form-check-input subscription-type-check" type="checkbox" name="subscription_type[]" id="type_services" value="services" <?= $has_services_selected ? 'checked' : '' ?>>
												<label class="form-check-label" for="type_services">Services</label>
											</div>
										</div>
									</div>
								</div>

								<!-- ══════════════════ PLAN ROW ══════════════════ -->
								<div class="col-md-12" id="plan_block" style="display:none;">
									<div class="card border mb-3">
										<div class="card-body">
											<h6 class="mb-3">Plan</h6>
											<div class="row">
												<div class="col-md-3">
													<div class="input-block mb-3">
														<label class="col-form-label">Plan Amount <span class="text-danger">*</span></label>
														<input type="text" name="plan_amount" id="plan_amount"
															class="form-control form-control-sm calc-input"
															value="<?= isset($invoice) ? fmt_num($invoice->plan_amount, false) : '' ?>"
															oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateAll();">
													</div>
												</div>
												<div class="col-md-3">
													<div class="input-block mb-3">
														<label class="col-form-label">Plan Discount</label>
														<input type="text" name="plan_discount" id="plan_discount"
															class="form-control form-control-sm calc-input"
															value="<?= isset($invoice) ? fmt_num($invoice->plan_discount) : '' ?>"
															placeholder="0"
															oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateAll();">
													</div>
												</div>
												<div class="col-md-2">
													<div class="input-block mb-3">
														<label class="col-form-label">Plan CGST %</label>
														<div class="input-group input-group-sm">
															<input type="text" name="plan_cgst_pct" id="plan_cgst_pct"
																class="form-control form-control-sm calc-input"
																value="<?= isset($invoice) ? fmt_num($invoice->plan_cgst_pct) : '' ?>"
																placeholder="0"
																oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateAll();">
															<span class="input-group-text">%</span>
														</div>
														<small class="text-muted">Amt: ₹<span id="plan_cgst_amount_display"><?= isset($invoice) ? fmt_num($invoice->plan_cgst, false) : '0' ?></span></small>
													</div>
												</div>
												<div class="col-md-2">
													<div class="input-block mb-3">
														<label class="col-form-label">Plan IGST %</label>
														<div class="input-group input-group-sm">
															<input type="text" name="plan_igst_pct" id="plan_igst_pct"
																class="form-control form-control-sm calc-input"
																value="<?= isset($invoice) ? fmt_num($invoice->plan_igst_pct) : '' ?>"
																placeholder="0"
																oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateAll();">
															<span class="input-group-text">%</span>
														</div>
														<small class="text-muted">Amt: ₹<span id="plan_igst_amount_display"><?= isset($invoice) ? fmt_num($invoice->plan_igst, false) : '0' ?></span></small>
													</div>
												</div>
												<div class="col-md-2">
													<div class="input-block mb-3">
														<label class="col-form-label">Plan Total</label>
														<input type="text" id="plan_total_display" class="form-control form-control-sm"
															value="<?= isset($invoice) ? fmt_num($invoice->plan_total, false) : '0' ?>"
															readonly style="background:#f5f5f5; font-weight:bold;">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- ══════════════════ SERVICES ══════════════════ -->
								<div class="col-md-12" id="services_block" style="display:none;">
									<div class="card border mb-3">
										<div class="card-body">
											<h6 class="mb-3">Services</h6>
											<div class="row">
												<div class="col-md-12">
													<div class="input-block selectnew mb-3">
														<label class="col-form-label">Select Services</label>
														<select class="select form-control-sm" name="service_ids[]" id="service_ids_select" multiple="multiple" style="width:100%;">
															<!-- populated by JS based on selected school -->
														</select>
													</div>
												</div>
											</div>
											<div id="service_rows">
												<!-- one row per selected service, generated by JS -->
											</div>
										</div>
									</div>
								</div>

								<!-- ══════════════════ FINAL ROW ══════════════════ -->
								<div class="col-md-12">
									<div class="card border mb-3" style="background:#f9fbff;">
										<div class="card-body">
											<h6 class="mb-3">Final</h6>
											<div class="row">
												<div class="col-md-3">
													<div class="input-block mb-3">
														<label class="col-form-label">Final Amount</label>
														<input type="text" id="final_amount_display" class="form-control form-control-sm" readonly style="background:#eef2ff; font-weight:bold;" value="0">
													</div>
												</div>
												<div class="col-md-3">
													<div class="input-block mb-3">
														<label class="col-form-label">Final Discount</label>
														<input type="text" id="final_discount_display" class="form-control form-control-sm" readonly style="background:#eef2ff; font-weight:bold;" value="0">
													</div>
												</div>
												<div class="col-md-2">
													<div class="input-block mb-3">
														<label class="col-form-label">Final CGST</label>
														<input type="text" id="final_cgst_display" class="form-control form-control-sm" readonly style="background:#eef2ff; font-weight:bold;" value="0">
													</div>
												</div>
												<div class="col-md-2">
													<div class="input-block mb-3">
														<label class="col-form-label">Final IGST</label>
														<input type="text" id="final_igst_display" class="form-control form-control-sm" readonly style="background:#eef2ff; font-weight:bold;" value="0">
													</div>
												</div>
												<div class="col-md-2">
													<div class="input-block mb-3">
														<label class="col-form-label">Sub Total</label>
														<input type="text" id="final_total_display" class="form-control form-control-sm" readonly style="font-weight:bold;" value="0">
													</div>
												</div>
											</div>
										</div>
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

<!-- Row template used by JS to render a new Service row -->
<script type="text/template" id="service_row_template">
<div class="row service-row" data-service-id="__ID__">
	<div class="col-md-3">
		<div class="input-block mb-3">
			<label class="col-form-label">Amount (__TITLE__) <span class="text-danger">*</span></label>
			<input type="text" name="service_amount[__ID__]" class="form-control form-control-sm calc-input service-amount"
				value="__AMOUNT__" required oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateAll();">
		</div>
	</div>
	<div class="col-md-3">
		<div class="input-block mb-3">
			<label class="col-form-label">Discount (__TITLE__)</label>
			<input type="text" name="service_discount[__ID__]" class="form-control form-control-sm calc-input service-discount"
				value="__DISCOUNT__" placeholder="0" oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateAll();">
		</div>
	</div>
	<div class="col-md-2">
		<div class="input-block mb-3">
			<label class="col-form-label text-truncate d-block" style="font-size:12px;" title="__TITLE__ CGST %">CGST % (__TITLE__)</label>
			<div class="input-group input-group-sm">
				<input type="text" name="service_cgst_pct[__ID__]" class="form-control form-control-sm calc-input service-cgst-pct"
					value="__CGSTPCT__" placeholder="0" oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateAll();">
				<span class="input-group-text">%</span>
			</div>
			<small class="text-muted">Amt: ₹<span class="service-cgst-amount-display">0</span></small>
		</div>
	</div>
	<div class="col-md-2">
		<div class="input-block mb-3">
			<label class="col-form-label text-truncate d-block" style="font-size:12px;" title="__TITLE__ IGST %">IGST % (__TITLE__)</label>
			<div class="input-group input-group-sm">
				<input type="text" name="service_igst_pct[__ID__]" class="form-control form-control-sm calc-input service-igst-pct"
					value="__IGSTPCT__" placeholder="0" oninput="this.value=this.value.replace(/[^0-9.]/g,''); calculateAll();">
				<span class="input-group-text">%</span>
			</div>
			<small class="text-muted">Amt: ₹<span class="service-igst-amount-display">0</span></small>
		</div>
	</div>
	<div class="col-md-2">
		<div class="input-block mb-3">
			<label class="col-form-label">Total (__TITLE__)</label>
			<input type="text" class="form-control form-control-sm service-total-display" readonly style="background:#f5f5f5; font-weight:bold;" value="0">
		</div>
	</div>
	<input type="hidden" name="service_title[__ID__]" value="__TITLE__">
</div>
</script>

<!-- Data used by invoice/form_script.php to drive the Services UI -->
<script>
var invoiceServicesData = {
	allServices: <?php
		$allServicesMap = [];
		foreach($services as $s){
			$allServicesMap[$s->id] = ['title' => $s->title, 'price' => (float) $s->price];
		}
		// Merge in any services referenced by this invoice that may no longer be active,
		// so editing an old invoice still shows correct labels.
		foreach($existing_service_items as $item){
			if(!isset($allServicesMap[$item['id']])){
				$allServicesMap[$item['id']] = ['title' => $item['title'], 'price' => (float) $item['amount']];
			}
		}
		echo json_encode($allServicesMap);
	?>,
	existingServiceIds: <?= json_encode(array_values($existing_service_ids)) ?>,
	existingServiceItems: <?= json_encode($existing_service_items) ?>,
	isEdit: <?= isset($invoice) ? 'true' : 'false' ?>
};
</script>
