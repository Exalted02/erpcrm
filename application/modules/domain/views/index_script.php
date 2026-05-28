<script>

let delete_id = 0;

$(document).on("click",".delete-btn",function(){

    delete_id = $(this).data("id");

    $("#delete_id").val(delete_id);

});

$("#confirm_delete").click(function(){

    let id = $("#delete_id").val();

    $.ajax({
        url: "<?= base_url('api-domain/delete') ?>",
        type: "POST",
        data: {id:id},
        dataType: "json",
        success:function(response){

            if(response.status == "success"){
                $("#delete_promotion").modal("hide");
				toastr_msg("Domain Deleted Successfully", "success");
				
				setTimeout(function(){
					location.reload();
				},5000);
            }

        }

    });

});
let currentToggle = null;

$(document).on("change", ".status-toggle-btn", function () {

    let toggle = $(this);
    let id = toggle.data("id");

    // CHECKED = ENABLE
    if (toggle.is(":checked")) {

        updateStatus(id, 1, '', toggle);

    } 
    // UNCHECKED = DISABLE
    else {

        // Keep checkbox checked temporarily
        toggle.prop("checked", true);

        currentToggle = toggle;

        $("#disable_id").val(id);
        $("#disable_reason").val('');
        $("#reason_error").addClass("d-none");

        $("#disableReasonModal").modal("show");
    }

});


$("#submitDisableReason").on("click", function () {

    let id = $("#disable_id").val();
    let reason = $("#disable_reason").val().trim();

    if (reason == '') {

        $("#reason_error").removeClass("d-none");
        return;
    }

    $("#reason_error").addClass("d-none");

    updateStatus(id, 0, reason, currentToggle);

    $("#disableReasonModal").modal("hide");

});


function updateStatus(id, status, reason, toggle) {

    $.ajax({

        url: "<?= base_url('api-domain/change_status') ?>",
        type: "POST",
        data: {
            id: id,
            status: status,
            reason: reason
        },
        dataType: "json",

        success: function (response) {

            if (response.status === "success") {

                toggle.prop("checked", status == 1);

                toastr.success(response.message);

            } else {

                toastr.error(response.message);

            }

        },

        error: function () {

            toastr.error("Server error");

        }

    });

}
</script>