<script>
// Strips trailing zeros: 1000.00→"1000", 9.50→"9.5", 0.15→"0.15"
function stripZeros(val) {
    var n = parseFloat(val);
    if (isNaN(n)) return '0';
    return parseFloat(n.toFixed(2)).toString();
}

// ── Total calculator (CGST & IGST entered as percentages) ────────────────────
function calculateTotal() {
    var price    = parseFloat($('#price_amount').val()) || 0;
    var discount = parseFloat($('#discount').val())     || 0;
    var cgstPct  = parseFloat($('#cgst_pct').val())     || 0;
    var igstPct  = parseFloat($('#igst_pct').val())     || 0;

    var taxableBase  = price - discount;
    var cgstAmount   = parseFloat((taxableBase * cgstPct / 100).toFixed(2));
    var igstAmount   = parseFloat((taxableBase * igstPct / 100).toFixed(2));
    var total        = taxableBase + cgstAmount + igstAmount;

    // Update computed amount hints (strip trailing zeros)
    $('#cgst_amount_display').text(stripZeros(cgstAmount));
    $('#igst_amount_display').text(stripZeros(igstAmount));
    $('#total_display').val(stripZeros(total));
}

// ── School dropdown → auto-fill School ID display ───────────────────────────
$('#domain_id').on('change', function() {
    var selected = $(this).find('option:selected');
    // $('#school_id_display').val(selected.data('schoolid') || '');
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
    calculateTotal();
});
</script>
