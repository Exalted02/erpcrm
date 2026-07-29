<?php
/*
 * print_invoice.php — rendered as an HTML FRAGMENT inside the list-page modal.
 * No <html>/<head>/<body> tags. No auto window.print() on load.
 * All styles are scoped so they don't bleed into the parent page.
 */

$subtotal       = (float) $invoice->price_amount - (float) $invoice->discount;
$full_inv_no    = $invoice->invoice_prefix . '-' . $invoice->invoice_number;
$status_label   = $invoice->status ? 'PAID' : 'UNPAID';
$status_class   = $invoice->status ? 'paid' : 'unpaid';

// Plan and Services can each carry their own CGST/IGST %. Kept for the
// legacy single-item fallback below (older invoices that predate the
// Plan/Services split, where only the invoice-level amounts exist).
$legacy_cgst_pct = $subtotal > 0 ? round(((float) $invoice->cgst / $subtotal) * 100, 2) : 0;
$legacy_igst_pct = $subtotal > 0 ? round(((float) $invoice->igst / $subtotal) * 100, 2) : 0;

// Build the line-items table: one row for the Plan (if billed) and one
// row per Service (if billed), each carrying its own CGST/IGST amount + %.
// Falls back to the single legacy row for older invoices that predate the
// Plan/Services split.
$line_items = [];

if (!empty($invoice->plan_amount)) {
	$line_items[] = [
		'label'    => 'Plan',
		'price'    => (float) $invoice->plan_amount,
		'discount' => (float) $invoice->plan_discount,
		'cgst'     => (float) $invoice->plan_cgst,
		'cgst_pct' => (float) $invoice->plan_cgst_pct,
		'igst'     => (float) $invoice->plan_igst,
		'igst_pct' => (float) $invoice->plan_igst_pct,
		'total'    => (float) $invoice->plan_total,
	];
}

if (!empty($invoice->service_items)) {
	$decoded = json_decode($invoice->service_items, true);
	if (is_array($decoded)) {
		foreach ($decoded as $item) {
			$line_items[] = [
				'label'    => $item['title'] ?? 'Service',
				'price'    => (float) ($item['amount'] ?? 0),
				'discount' => (float) ($item['discount'] ?? 0),
				'cgst'     => (float) ($item['cgst'] ?? 0),
				'cgst_pct' => (float) ($item['cgst_pct'] ?? 0),
				'igst'     => (float) ($item['igst'] ?? 0),
				'igst_pct' => (float) ($item['igst_pct'] ?? 0),
				'total'    => (float) ($item['total'] ?? 0),
			];
		}
	}
}

if (empty($line_items)) {
	// Legacy single-item invoice
	$line_items[] = [
		'label'    => $invoice->item_description,
		'price'    => (float) $invoice->price_amount,
		'discount' => (float) $invoice->discount,
		'cgst'     => (float) $invoice->cgst,
		'cgst_pct' => $legacy_cgst_pct,
		'igst'     => (float) $invoice->igst,
		'igst_pct' => $legacy_igst_pct,
		'total'    => (float) $invoice->price_amount,
	];
}
?>
<style>
@page { margin: 10mm 0; }
/* Scoped to .inv-page so modal parent styles don't conflict */
.inv-page * { box-sizing: border-box; margin: 0; padding: 0; }
.inv-page {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    color: #222;
    background: #fff;
    width: 100%;
    padding: 6mm 6mm 6mm 6mm;
}
/* ── Header ── */
.inv-page .inv-header {
    display: flex; justify-content: space-between; align-items: flex-start;
    border-bottom: 3px solid #0253CC; padding-bottom: 10px; margin-bottom: 14px;
}
.inv-page .invoice-label { font-size: 22px; font-weight: 700; color: #222; }
.inv-page .invoice-number { font-size: 15px; font-weight: 700; color: #0253CC; margin-top: 2px; }
.inv-page .logo-text { font-size: 24px; font-weight: 900; color: #222; text-align: right; }
.inv-page .logo-block { text-align: right; }
.inv-page .company-logo { max-height: 60px; max-width: 180px; object-fit: contain; }

/* ── Addresses ── */
.inv-page .address-row { display: flex; justify-content: space-between; margin-bottom: 14px; gap: 20px; }
.inv-page .bill-to-box {
    background: #f5fbff; border-left: 4px solid #0253CC;
    padding: 10px 12px; width: 48%; border-radius: 2px;
}
.inv-page .bill-to-box .label { font-size: 12px; font-weight: 700; color: #0253CC; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 5px; }
.inv-page .bill-to-box .name { font-size: 15px; font-weight: 700; color: #222; margin-bottom: 3px; }
.inv-page .bill-to-box .address-lines { color: #444; line-height: 1.6; }
.inv-page .seller-box { width: 48%; text-align: right; padding: 10px 0; }
.inv-page .seller-box .company-name { font-size: 16px; font-weight: 700; color: #222; margin-bottom: 5px; }
.inv-page .seller-box .seller-detail { color: #555; line-height: 1.7; }
.inv-page .seller-box .tax-highlight { color: #0253CC; font-weight: 600; }

/* ── Status Bar ── */
.inv-page .status-bar {
    display: flex; justify-content: space-between; align-items: center;
    background: #f9f9f9; border: 1px solid #eee; border-radius: 3px;
    padding: 7px 12px; margin-bottom: 14px;
}
.inv-page .status-item { display: flex; align-items: center; gap: 6px; }
.inv-page .s-label { font-size: 12px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 0.6px; }
.inv-page .s-value { font-size: 13px; font-weight: 600; color: #222; }
.inv-page .s-value.unpaid { color: #0253CC; background: #ffeaea; padding: 1px 7px; border-radius: 10px; font-size: 12px; font-weight: 700; }
.inv-page .s-value.paid   { color: #1a7f37; background: #e6f4ea; padding: 1px 7px; border-radius: 10px; font-size: 12px; font-weight: 700; }

/* ── Item Description ── */
.inv-page .desc-box {
    background: #f5fbff; border-left: 4px solid #0253CC;
    padding: 10px 12px; border-radius: 2px; margin-bottom: 14px;
}
.inv-page .desc-box .label { font-size: 12px; font-weight: 700; color: #0253CC; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 5px; }
.inv-page .desc-box .desc-text { color: #444; line-height: 1.6; }

/* ── Items Table ── */
.inv-page .items-table { width: 100%; border-collapse: collapse; margin-bottom: 14px; }
.inv-page .items-table thead tr { background-color: #0253CC !important; color: #fff !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
.inv-page .items-table thead th { padding: 8px 10px; text-align: left; font-size: 12.5px; font-weight: 700; text-transform: uppercase; }
.inv-page .items-table thead th.right { text-align: right; }
.inv-page .items-table tbody tr { border-bottom: 1px solid #f0f0f0; }
.inv-page .items-table tbody td { padding: 9px 10px; vertical-align: top; }
.inv-page .items-table tbody td.right { text-align: right; }
.inv-page .item-name { font-weight: 700; color: #222; margin-bottom: 2px; }
.inv-page .item-meta { color: #0253CC; font-size: 12px; font-weight: 600; }

/* ── Summary ── */
.inv-page .bottom-row { display: flex; justify-content: flex-end; gap: 20px; margin-bottom: 16px; }
.inv-page .summary-table { width: 44%; border-collapse: collapse; }
.inv-page .summary-table tr td { padding: 5px 8px; font-size: 13px; }
.inv-page .summary-table tr td:last-child { text-align: right; font-weight: 600; }
.inv-page .summary-table tr.discount-row td { color: #0253CC; }
.inv-page .summary-table tr.subtotal-row td { border-top: 1px solid #ddd; padding-top: 7px; color: #333; }
.inv-page .summary-table tr.tax-row td { color: #555; }
.inv-page .summary-table tr.total-row td {
    background: #0253CC !important; color: #fff !important; font-size: 15px; font-weight: 700;
    padding: 7px 8px; border-radius: 2px;
    -webkit-print-color-adjust: exact; print-color-adjust: exact;
}

/* ── Footer ── */
.inv-page .inv-footer { border-top: 1px solid #eee; padding-top: 10px; text-align: center; color: #999; font-size: 11.5px; line-height: 1.7; }
</style>

<div class="inv-page">

  <!-- Header -->
  <div class="inv-header">
    <div class="header-left">
      <div class="invoice-label">Invoice</div>
      <div class="invoice-number">#<?= $full_inv_no ?></div>
    </div>
    <div class="logo-block">
      <?php if(!empty($company->logo)){ ?>
      <img src="<?= base_url('uploads/company_settings/' . $company->logo) ?>" alt="<?= htmlspecialchars($company->school_name ?? '') ?>" class="company-logo" style=" max-height: 60px; max-width: 180px; object-fit: cover;"> 
      <?php } else { ?>
      <div class="logo-text"><?= htmlspecialchars($company->school_name ?? 'COMPANY') ?></div>
      <?php } ?>
    </div>
  </div>

  <!-- Addresses -->
  <div class="address-row">
    <div class="bill-to-box">
      <div class="label">Bill to</div>
      <?php if(!empty($invoice->name)){ ?>
      <div class="name"><?= htmlspecialchars($invoice->name) ?></div>
      <?php } ?>
      <div class="address-lines">
        <strong>School ID:</strong> <?= htmlspecialchars($invoice->school_id) ?><br>
        <strong>Domain:</strong> <?= htmlspecialchars($invoice->domain_name) ?>
        <?php if(!empty($invoice->address)){ ?>
        <br><?= nl2br(htmlspecialchars($invoice->address)) ?>
        <?php } ?>
        <?php if(!empty($invoice->email)){ ?>
        <br><?= htmlspecialchars($invoice->email) ?>
        <?php } ?>
        <?php if(!empty($invoice->phone)){ ?>
        <br>Ph: <?= htmlspecialchars($invoice->phone) ?>
        <?php if(!empty($invoice->alternate_no)){ ?> / <?= htmlspecialchars($invoice->alternate_no) ?><?php } ?>
        <?php } ?>
        <?php if(!empty($invoice->dise_code)){ ?>
        <br>DISE Code: <?= htmlspecialchars($invoice->dise_code) ?>
        <?php } ?>
        <?php if(!empty($invoice->aff_no)){ ?>
        <br>Aff. No: <?= htmlspecialchars($invoice->aff_no) ?>
        <?php } ?>
      </div>
    </div>
    <div class="seller-box">
      <div class="company-name"><?= htmlspecialchars($company->school_name ?? '') ?></div>
      <div class="seller-detail">
        <?php if(!empty($company->gst_no)){ ?>
        <span class="tax-highlight">GSTIN: <?= htmlspecialchars($company->gst_no) ?></span><br>
        <?php } ?>
        <?php if(!empty($company->pan_no)){ ?>
        PAN: <?= htmlspecialchars($company->pan_no) ?><br>
        <?php } ?>
        <?php if(!empty($company->address)){ ?>
        <?= nl2br(htmlspecialchars($company->address)) ?><br>
        <?php } ?>
        <?php if(!empty($company->city)){ ?>
        <?= htmlspecialchars($company->city) ?>
        <?php if(!empty($company->pin_code)){ ?> - <?= htmlspecialchars($company->pin_code) ?><?php } ?><br>
        <?php } ?>
        <?php if(!empty($company->email)){ ?>
        <?= htmlspecialchars($company->email) ?><br>
        <?php } ?>
        <?php if(!empty($company->contact_no)){ ?>
        Ph: <?= htmlspecialchars($company->contact_no) ?>
        <?php if(!empty($company->support_no)){ ?> | Support: <?= htmlspecialchars($company->support_no) ?><?php } ?><br>
        <?php } ?>
        <?php if(!empty($company->website_url)){ ?>
        <?= htmlspecialchars($company->website_url) ?>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- Status Bar -->
  <div class="status-bar">
    <div class="status-item">
      <span class="s-label">Issued</span>
      <span class="s-value"><?= date('M d, Y', strtotime($invoice->created_at)) ?></span>
    </div>
    <div class="status-item">
      <span class="s-label">Invoice No</span>
      <span class="s-value"><?= $full_inv_no ?></span>
    </div>
    <div class="status-item">
      <span class="s-label">Status</span>
      <span class="s-value <?= $status_class ?>"><?= $status_label ?></span>
    </div>
  </div>

  <!-- Item Description -->
  <?php if(!empty($invoice->item_description)){ ?>
  <div class="desc-box">
    <div class="label">Item Description</div>
    <div class="desc-text"><?= nl2br(htmlspecialchars($invoice->item_description)) ?></div>
  </div>
  <?php } ?>

  <!-- Items Table -->
  <table class="items-table">
    <thead>
      <tr>
        <th style="background-color: #0253CC !important;">Item Description</th>
        <th style="background-color: #0253CC !important;" class="right">Price (INR)</th>
        <th style="background-color: #0253CC !important;" class="right">Discount</th>
        <th style="background-color: #0253CC !important;" class="right">CGST</th>
        <th style="background-color: #0253CC !important;" class="right">IGST</th>
        <th style="background-color: #0253CC !important;" class="right">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($line_items as $i => $item){ ?>
      <tr>
        <td>
          <div class="item-name"><?= htmlspecialchars($item['label']) ?></div>
          <?php if($i === 0){ ?>
          <div class="item-meta">School ID: <?= htmlspecialchars($invoice->school_id) ?> </div>
          <?php } ?>
        </td>
        <td class="right">&#8377;<?= format_amount($item['price']) ?></td>
        <td class="right">&#8377;<?= format_amount($item['discount']) ?></td>
        <td class="right">
          &#8377;<?= format_amount($item['cgst']) ?>
          <?php if($item['cgst_pct'] > 0){ ?>
          <div class="item-meta"><?= rtrim(rtrim(number_format($item['cgst_pct'], 2), '0'), '.') ?>%</div>
          <?php } ?>
        </td>
        <td class="right">
          &#8377;<?= format_amount($item['igst']) ?>
          <?php if($item['igst_pct'] > 0){ ?>
          <div class="item-meta"><?= rtrim(rtrim(number_format($item['igst_pct'], 2), '0'), '.') ?>%</div>
          <?php } ?>
        </td>
        <td class="right">&#8377;<?= format_amount($item['total']) ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <!-- Summary -->
  <div class="bottom-row">
    <table class="summary-table">
      <tr>
        <td>Final Amount</td>
        <td>&#8377;<?= format_amount($invoice->price_amount) ?></td>
      </tr>
      <tr class="discount-row">
        <td>Final Discount</td>
        <td>-&#8377;<?= format_amount($invoice->discount) ?></td>
      </tr>
      <tr class="tax-row">
        <td>CGST+IGST</td>
        <td>&#8377;<?= format_amount((float) $invoice->cgst + (float) $invoice->igst) ?></td>
      </tr>
      <tr class="total-row">
        <td style="background-color: #0253CC !important;">Sub Total</td>
        <td style="background-color: #0253CC !important;">&#8377;<?= format_amount($invoice->total) ?></td>
      </tr>
    </table>
  </div>

  <!-- Footer -->
  <div class="inv-footer">
    <div>This is a computer-generated invoice. No signature required.</div>
    <div style="color:#555; margin-top:4px; font-size:9.5px;">
      Supply Meant For Export Under Letter of Undertaking Without Payment Of Integrated Goods and Service Tax (IGST).
    </div>
    <div style="color:#888; margin-top:3px;">By accepting this invoice, you agree to our Terms of Service.</div>
  </div>

</div>
