<script>
$(document).ready(function(){
	let old_state = "<?= set_value('school_state', isset($school) ? $school['school_state'] : '') ?>";

	let old_district = "<?= set_value('school_district', isset($school) ? $school['school_district'] : '') ?>";
	if(old_state != ''){
		loadDistricts(old_state, old_district);
	}
	
	let school_type = "<?= set_value('school_type', isset($school) ? $school['school_type'] : '') ?>";
	if(school_type == 1){
		$('.seller_div').show();
		
		let seller_id = "<?= set_value('seller_id', isset($school) ? $school['seller_id'] : '') ?>";
		if(seller_id!=''){
			loadSellerDetails(seller_id);
		}
	}else{
		$('.seller_div').hide();
	}
});

$(document).on('change', '#school_type', function () {
	let school_type = $(this).val();
	if(school_type == 1){
		$('.seller_div').show();
	}else{
		$('.seller_div').hide();
	}
});
$(document).on('change', '#seller_id', function () {
	let seller_id = $(this).val();
	if(seller_id!=''){
		loadSellerDetails(seller_id);
	}else{
		$("#seller_info").html('');
	}
});
function loadDistricts(state_id, selected_district = '') {
	if(state_id != ''){
		$.ajax({
			url: "<?= base_url('common/getDistricts') ?>",
			type: "POST",
			data: {state_id: state_id},
			success: function (response) {
				// Destroy old select2
				if ($('#school_district').hasClass("select2-hidden-accessible")) {
					$('#school_district').select2('destroy');
				}
				
				$('#school_district').html(response);

				if(selected_district != ''){
					$('#school_district').val(selected_district);
				}
				
				// Reinitialize select2
				$('#school_district').select2({
					width: '100%'
				});

				$('#school_district').trigger('change');
			}
		});
	} else {
		$('#school_district').html(
			'<option value="">Please select</option>'
		);
	}
}
function loadSellerDetails(seller_id) {
	if(seller_id != ''){
		$.ajax({
			url: "<?= base_url('seller/seller/get_seller_details') ?>",
			type: "POST",
			dataType: "json",
			data: {seller_id: seller_id},
			success: function (response) {
				$("#seller_info").html(response.html);
			},
			error: function(){
				alert("Error loading data");
			}
		});
	} else {
		$('#school_district').html(
			'<option value="">Please select</option>'
		);
	}
}

// Subscription Start/End Date guard
$(document).on('dp.change', '#subscription_start_date', function () {
	let start_date = $(this).val();
	let end_date = $('#subscription_end_date').val();

	if (start_date !== '' && end_date !== '') {
		let start = moment(start_date, "DD-MM-YYYY");
		let end = moment(end_date, "DD-MM-YYYY");

		if (start.isAfter(end)) {
			$('#subscription_end_date').val(start_date);
		}
	}
});

$(document).on('dp.change', '#subscription_end_date', function () {
	let start_date = $('#subscription_start_date').val();
	let end_date = $(this).val();

	if (start_date !== '' && end_date !== '') {
		let start = moment(start_date, "DD-MM-YYYY");
		let end = moment(end_date, "DD-MM-YYYY");

		if (end.isBefore(start)) {
			$(this).val(start_date);
		}
	}
});

// On state change
$(document).on('change', '#school_state', function () {

	let state_id = $(this).val();

	loadDistricts(state_id);

});
// On session change
let domain_id = "<?= $school['id'] ?>";

// Session Change
$(document).on('change', 'select.school_filter', function () {
    loadSchoolDetails($(this));
});

// Datetimepicker Change
$(document).on('dp.change', '.datetimepicker.school_filter', function () {
    loadSchoolDetails($(this));
});

function loadSchoolDetails($element)
{
    let form_type = $element.data('type');
    let row = $element.closest('.row');

    let session_id = row.find('select.school_filter').val() || '';
    let from_date  = row.find('.from_date').val() || '';
    let to_date    = row.find('.to_date').val() || '';

    // Only for Income & Expense tabs (where date fields exist)
    if (row.find('.from_date').length > 0) {

        // From Date Changed
        if ($element.hasClass('from_date')) {

            // If To Date is blank, set it equal to From Date
            if (to_date === '') {
                row.find('.to_date').val(from_date);
                to_date = from_date;
            }
            // If From Date > To Date
            else {
                var from = moment(from_date, "DD-MM-YYYY");
                var to   = moment(to_date, "DD-MM-YYYY");

                if (from.isAfter(to)) {
                    row.find('.to_date').val(from_date);
                    to_date = from_date;
                }
            }
        }

        // To Date Changed
        if ($element.hasClass('to_date')) {

            if (from_date !== '') {

                var from = moment(from_date, "DD-MM-YYYY");
                var to   = moment(to_date, "DD-MM-YYYY");

                // Prevent To Date before From Date
                if (to.isBefore(from)) {
                    row.find('.to_date').val(from_date);
                    to_date = from_date;
                }
            }
        }
    }

    $.ajax({
        url: "<?= base_url('settings/settings/get_school_details') ?>",
        type: "POST",
        dataType: "json",
        data: {
            form_type: form_type,
            session_id: session_id,
            from_date: from_date,
            to_date: to_date,
            domain_id: domain_id
        },
        success: function (res) {
            $("#" + form_type + "_html").html(res.html);
        },
        error: function () {
            alert("Error loading data");
        }
    });
}

// ── Print Invoice — fetch content then open print dialog directly ─────────────
$(document).on("click", ".print-invoice-btn", function() {
    var id = $(this).data("id");

    $.ajax({
        url: "<?= base_url('invoice/print_invoice') ?>/" + id,
        type: "GET",
		success: function(html) {
			$("#inv-print-frame").remove();

			var $frame = $('<div id="inv-print-frame"></div>').html(html);
			$("body").append($frame);
			$("body").addClass("inv-printing");

			var $imgs = $frame.find("img");

			if ($imgs.length === 0) {
				printInvoice();
				return;
			}

			var loaded = 0;

			$imgs.each(function () {
				if (this.complete) {
					loaded++;
					if (loaded === $imgs.length) {
						printInvoice();
					}
				} else {
					$(this).one("load error", function () {
						loaded++;
						if (loaded === $imgs.length) {
							printInvoice();
						}
					});
				}
			});

			function printInvoice() {
				window.print();

				setTimeout(function () {
					$("body").removeClass("inv-printing");
					$("#inv-print-frame").remove();
				}, 1000);
			}
		},
        error: function() {
            toastr.error("Failed to load invoice. Please try again.");
        }
    });
});
</script>
<style>
/* Hidden off-screen by default */
#inv-print-frame {
    display: none;
}

/* When printing: show only the invoice frame, hide everything else */
@media print {
    body.inv-printing > *:not(#inv-print-frame) {
        display: none !important;
    }
    body.inv-printing #inv-print-frame {
        display: block !important;
    }
    /* Force background colours to print */
    body.inv-printing * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    body.inv-printing .items-table thead tr {
        background: #e03c2f !important;
        color: #fff !important;
    }
    body.inv-printing .summary-table tr.total-row td {
        background: #e03c2f !important;
        color: #fff !important;
    }
}
</style>