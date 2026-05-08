<script>
$(document).on('click', '.send_payment_request', function(){
	$('#send_payment_request').modal('show');
	
	var id = $(this).data('id');
	$.ajax({
        url: "<?= base_url('leads/convert_school_data') ?>",
        type: "POST",
        data: {id:id},
        dataType: "json",
        success:function(response){
            if(response.status == "success"){
                $("#delete_promotion").modal("hide");
                $("#total_student").text(response.total_student);
                $("#seller_percent").text(response.seller_percent);
                $("#payment_amount").text(response.payment_amount);
                $("#send_payment_amount").val(response.payment_amount);
                $("#converted_lead_id").val(id);
            }
        }
    });
});

let delete_id = 0;
$(document).on("click",".delete-btn",function(){

    delete_id = $(this).data("id");

    $("#delete_id").val(delete_id);

});
$("#confirm_delete").click(function(){

    let id = $("#delete_id").val();

    $.ajax({
        url: "<?= base_url('leads/convert_school_delete') ?>",
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
$("#sonfirm_send").click(function(){

    let id = $("#converted_lead_id").val();
    let amount = $("#send_payment_amount").val();

    $.ajax({
        url: "<?= base_url('leads/send_payment_request') ?>",
        type: "POST",
        data: {id:id, amount:amount},
        dataType: "json",
        success:function(response){

            if(response.status == "success"){
                $("#delete_promotion").modal("hide");
				toastr_msg("Payment Request Sent Successfully", "success");
				
				setTimeout(function(){
					location.reload();
				},5000);
            }

        }

    });

});
</script>
