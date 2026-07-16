<script>

let delete_id = 0;

$(document).on("click",".delete-btn",function(){

    delete_id = $(this).data("id");

    $("#delete_id").val(delete_id);

});

$("#confirm_delete").click(function(){

    let id = $("#delete_id").val();

    $.ajax({
        url: "<?= base_url('leads/delete') ?>",
        type: "POST",
        data: {id:id},
        dataType: "json",
        success:function(response){

            if(response.status == "success"){
                $("#delete_promotion").modal("hide");
				toastr_msg("Record Deleted Successfully", "success");
				
				setTimeout(function(){
					location.reload();
				},5000);
            }

        }

    });

});
$(document).on("change",".status-toggle-btn",function(){
    let toggle = $(this);
    let id = toggle.data("id");

    let status = toggle.is(":checked") ? 1 : 0;

    $.ajax({

        url: "<?= base_url('leads/change_status') ?>",
        type: "POST",
        data: {
            id: id,
            status: status
        },
        dataType: "json",

        success:function(response){

            if(response.status === "success"){

                toastr.success("Status updated successfully");

            }else{

                toggle.prop("checked", !status);

                toastr.error("Failed to update status");

            }

        },

        error:function(){

            toggle.prop("checked", !status);

            toastr.error("Server error");

        }

    });

});

$(document).on('click', '.transfer_lead', function(){
	$('#transfer_lead').modal('show');
	
	var id = $(this).data('id');
	$.ajax({
		url: "<?= base_url('leads/get_lead_transfer') ?>",
		type: "POST",
		data: {id: id},
		success: function (response) {
			$('#seller_data').html(response);
			$('#transfer_lead_id').val(id);
		}
	});
});
$("#confirm_transfer").click(function(){

    let seller_id = $("#seller_data").val();
    let lead_id = $("#transfer_lead_id").val();
	if(seller_id == ''){
		$('.err-seller-data').text('Please select a Seller');
		return false;
	}
    $.ajax({
        url: "<?= base_url('leads/submit_transfer_lead') ?>",
        type: "POST",
        data: {seller_id:seller_id, lead_id:lead_id},
        dataType: "json",
        success:function(response){

            if(response.status == "success"){
                $("#transfer_lead").modal("hide");
				toastr_msg("Lead Transfered Successfully", "success");
				
				setTimeout(function(){
					location.reload();
				},5000);
            }

        }

    });

});
$(document).ready(function(){
	if ($.fn.DataTable.isDataTable('#example2')) {
		$('#example2').DataTable().destroy();
	}
	$('#example2').DataTable({
		order: [[1, 'desc']],
		columnDefs: [
        {
            targets: 0,        // 1st column
            orderable: true,  // allow manual ordering
            orderSequence: ['asc', 'desc'] // manual toggle only
        }
    ] 
	});
	// On state change
    $('#state').change(function () {

        let state_id = $(this).val();

        loadDistricts(state_id);

    });
	function loadDistricts(state_id, selected_district = '') {
        if(state_id != ''){
            $.ajax({
				url: "<?= base_url('common/getDistricts') ?>",
                type: "POST",
                data: {state_id: state_id},

                success: function (response) {

                    $('#district').html(response);

                    if(selected_district != ''){
                        $('#district').val(selected_district);
                    }
                }
            });
        } else {

            $('#district').html(
                '<option value="">Select District</option>'
            );
        }
    }
});
</script>