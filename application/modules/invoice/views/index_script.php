<script>

// ── Delete ───────────────────────────────────────────────────────────────────
let delete_id = 0;

$(document).on("click", ".delete-btn", function() {
    delete_id = $(this).data("id");
    $("#delete_id").val(delete_id);
});

$("#confirm_delete").click(function() {
    let id = $("#delete_id").val();
    $.ajax({
        url: "<?= base_url('invoice/delete') ?>",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function(response) {
            if (response.status == "success") {
                $("#delete_invoice").modal("hide");
                toastr_msg("Invoice Deleted Successfully", "success");
                setTimeout(function() { location.reload(); }, 2000);
            }
        }
    });
});

// ── Status toggle ─────────────────────────────────────────────────────────────
$(document).on("change", ".status-toggle-btn", function() {
    let toggle = $(this);
    let id     = toggle.data("id");
    let status = toggle.is(":checked") ? 1 : 0;

    $.ajax({
        url: "<?= base_url('invoice/change_status') ?>",
        type: "POST",
        data: { id: id, status: status },
        dataType: "json",
        success: function(response) {
            if (response.status === "success") {
                toastr.success("Marked as " + (status ? "Paid" : "Unpaid"));
            } else {
                toggle.prop("checked", !status);
                toastr.error("Failed to update status");
            }
        },
        error: function() {
            toggle.prop("checked", !status);
            toastr.error("Server error");
        }
    });
});

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
