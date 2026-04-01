<script>

let delete_id = 0;

$(document).on("click",".delete-btn",function(){

    delete_id = $(this).data("id");

    $("#delete_id").val(delete_id);

});

$("#confirm_delete").click(function(){

    let id = $("#delete_id").val();

    $.ajax({
        url: "<?= base_url('seller/delete') ?>",
        type: "POST",
        data: {id:id},
        dataType: "json",
        success:function(response){

            if(response.status == "success"){
                $("#delete_promotion").modal("hide");
				toastr_msg("Seller Deleted Successfully", "success");
				
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

        url: "<?= base_url('seller/change_status') ?>",
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
</script>