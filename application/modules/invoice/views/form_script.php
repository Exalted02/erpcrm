<script>
// Strips trailing zeros: 1000.00→"1000", 9.50→"9.5", 0.15→"0.15"
function stripZeros(val) {
    var n = parseFloat(val);
    if (isNaN(n)) return '0';
    return parseFloat(n.toFixed(2)).toString();
}

var isInitialLoad = true;

// =============================================================================
// Subscription Type toggle (Plan / Services blocks)
// =============================================================================
function refreshTypeBlocks() {
    var planOn     = $('#type_plan').is(':checked');
    var servicesOn = $('#type_services').is(':checked');

    $('#plan_block').toggle(planOn);
    $('#services_block').toggle(servicesOn);

    calculateAll();
}

$(document).on('change', '.subscription-type-check', function() {
    refreshTypeBlocks();
});

// =============================================================================
// Master calculation — Plan row + every Service row + Final aggregate row
// =============================================================================
function calculateAll() {

    var finalAmount   = 0;
    var finalDiscount = 0;
    var finalCgst     = 0;
    var finalIgst     = 0;
    var finalTotal    = 0;

    // ---- Plan row ----
    if ($('#type_plan').is(':checked')) {

        var price    = parseFloat($('#plan_amount').val())    || 0;
        var discount = parseFloat($('#plan_discount').val())  || 0;
        var cgstPct  = parseFloat($('#plan_cgst_pct').val())  || 0;
        var igstPct  = parseFloat($('#plan_igst_pct').val())  || 0;

        var taxableBase = price - discount;
        var cgstAmount  = parseFloat((taxableBase * cgstPct / 100).toFixed(2));
        var igstAmount  = parseFloat((taxableBase * igstPct / 100).toFixed(2));
        var total       = taxableBase + cgstAmount + igstAmount;

        $('#plan_cgst_amount_display').text(stripZeros(cgstAmount));
        $('#plan_igst_amount_display').text(stripZeros(igstAmount));
        $('#plan_total_display').val(stripZeros(total));

        finalAmount   += price;
        finalDiscount += discount;
        finalCgst     += cgstAmount;
        finalIgst     += igstAmount;
        finalTotal    += total;
    }

    // ---- Service rows ----
    if ($('#type_services').is(':checked')) {

        $('.service-row').each(function() {

            var row = $(this);

            var price    = parseFloat(row.find('.service-amount').val())    || 0;
            var discount = parseFloat(row.find('.service-discount').val())  || 0;
            var cgstPct  = parseFloat(row.find('.service-cgst-pct').val())  || 0;
            var igstPct  = parseFloat(row.find('.service-igst-pct').val())  || 0;

            var taxableBase = price - discount;
            var cgstAmount  = parseFloat((taxableBase * cgstPct / 100).toFixed(2));
            var igstAmount  = parseFloat((taxableBase * igstPct / 100).toFixed(2));
            var total       = taxableBase + cgstAmount + igstAmount;

            row.find('.service-cgst-amount-display').text(stripZeros(cgstAmount));
            row.find('.service-igst-amount-display').text(stripZeros(igstAmount));
            row.find('.service-total-display').val(stripZeros(total));

            finalAmount   += price;
            finalDiscount += discount;
            finalCgst     += cgstAmount;
            finalIgst     += igstAmount;
            finalTotal    += total;
        });
    }

    // ---- Final aggregate row ----
    $('#final_amount_display').val(stripZeros(finalAmount));
    $('#final_discount_display').val(stripZeros(finalDiscount));
    $('#final_cgst_display').val(stripZeros(finalCgst));
    $('#final_igst_display').val(stripZeros(finalIgst));
    $('#final_total_display').val(stripZeros(finalTotal));
}

// =============================================================================
// Services: render one row per selected service in the multi-select
// =============================================================================
function buildServiceRow(id, title, amount, discount, cgstPct, igstPct) {

    var tpl = $('#service_row_template').html();

    tpl = tpl.split('__ID__').join(id)
              .split('__TITLE__').join(title)
              .split('__AMOUNT__').join(amount || '')
              .split('__DISCOUNT__').join(discount || '')
              .split('__CGSTPCT__').join(cgstPct || '')
              .split('__IGSTPCT__').join(igstPct || '');

    return tpl;
}

function refreshServiceRows() {

    var selectedIds = $('#service_ids_select').val() || [];

    // Remove rows for services that are no longer selected
    $('.service-row').each(function() {
        var id = ($(this).attr('data-service-id') || '').toString();
        if (selectedIds.indexOf(id) === -1) {
            $(this).remove();
        }
    });

    // Add rows for newly selected services
    selectedIds.forEach(function(id) {

        if ($('.service-row[data-service-id="' + id + '"]').length > 0) {
            return; // already rendered
        }

        var service = invoiceServicesData.allServices[id] || { title: 'Service', price: 0 };

        // Prefill from the existing invoice's saved line items when editing
        var existingItem = null;
        if (invoiceServicesData.isEdit && invoiceServicesData.existingServiceItems) {
            existingItem = invoiceServicesData.existingServiceItems.find(function(item) {
                return item.id.toString() === id.toString();
            });
        }

        var amount   = existingItem ? existingItem.amount   : service.price;
        var discount = existingItem ? existingItem.discount : '';
        var cgstPct  = existingItem ? existingItem.cgst_pct : '';
        var igstPct  = existingItem ? existingItem.igst_pct : '';

        $('#service_rows').append(buildServiceRow(id, service.title, amount, discount, cgstPct, igstPct));
    });

    calculateAll();
}

$(document).on('change', '#service_ids_select', function() {
    refreshServiceRows();
});

// =============================================================================
// Services: (re)populate the "Select Services" dropdown for the chosen school
// =============================================================================
function populateServiceOptions(domainIds, preselectIds) {

    domainIds     = domainIds || [];
    preselectIds  = preselectIds || [];

    // Union of the school's configured services + anything already billed
    // on this invoice (covers services later deactivated / unassigned)
    var idSet = {};
    domainIds.forEach(function(id) { idSet[id] = true; });
    preselectIds.forEach(function(id) { idSet[id] = true; });

    var ids = Object.keys(idSet);

    var select = $('#service_ids_select');

    if (select.hasClass('select2-hidden-accessible')) {
        select.select2('destroy');
    }

    select.empty();

    ids.forEach(function(id) {
        var service = invoiceServicesData.allServices[id];
        if (!service) return;
        var selected = preselectIds.indexOf(id.toString()) !== -1 || preselectIds.indexOf(parseInt(id)) !== -1;
        select.append(new Option(service.title, id, selected, selected));
    });

    select.select2({ width: '100%', placeholder: 'Select Services', allowClear: true });

    refreshServiceRows();
}

// ── School dropdown → auto-fill Plan Amount + reload Services list ─────────
$('#domain_id').on('change', function() {

    var selected = $(this).find('option:selected');

    $('#plan_amount').val(selected.data('schoolplanprice') || '');

    var rawServiceIds = (selected.data('serviceids') || '').toString();
    var domainIds = rawServiceIds ? rawServiceIds.split(',').filter(Boolean) : [];

    // On a genuine user-driven school change (not the initial page load for
    // edit), we don't want to keep a stale pre-selection around.
    var preselect = isInitialLoad ? invoiceServicesData.existingServiceIds : [];

    populateServiceOptions(domainIds, preselect);

    calculateAll();
});

// ── Invoice prefix → regenerate invoice number via AJAX ─────────────────────
<?php if(!isset($invoice)){ // Only on create ?>
var prefixTimer = null;
$('#invoice_prefix').on('input', function() {
    clearTimeout(prefixTimer);
    var prefix = $(this).val().trim().toUpperCase();
    $(this).val(prefix);

    if (prefix.length === 0) return;

    prefixTimer = setTimeout(function() {
        $.ajax({
            url: "<?= base_url('invoice/get_next_number') ?>",
            type: "POST",
            data: { prefix: prefix },
            dataType: "json",
            success: function(res) {
                $('#invoice_number').val(res.invoice_number);
                $('#invoice_full_number').text(prefix + '-' + res.invoice_number);
            }
        });
    }, 400);
});

// Also update the display label whenever prefix field is typed
$('#invoice_prefix').on('keyup', function() {
    var prefix = $(this).val().trim().toUpperCase();
    var num    = $('#invoice_number').val();
    if(prefix && num) {
        $('#invoice_full_number').text(prefix + '-' + num);
    }
});
<?php } ?>

// ── On page load ─────────────────────────────────────────────────────────────
$(document).ready(function() {

    refreshTypeBlocks();

    // Populate the Services dropdown for whichever school is pre-selected
    // (either the first option, or the invoice's saved school on edit)
    $('#domain_id').trigger('change');

    isInitialLoad = false;

    calculateAll();
});
</script>
