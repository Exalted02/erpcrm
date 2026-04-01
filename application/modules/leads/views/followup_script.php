<script>
function openAddModal() {
    $('#followupForm')[0].reset();
    $('#followup_id').val('');
    $('#followupModal').modal('show');
}

// EDIT
function editFollowup(id, remark, remark_val) {
    $('#followup_id').val(id);
    $('#remarks').val(remark);       // dropdown select
    $('#remark_val').val(remark_val); // text input
    $('#followupModal').modal('show');
}

// SAVE (ADD + UPDATE)
$('#followupForm').submit(function(e){
    e.preventDefault();

    $.ajax({
        url: "<?= base_url('leads/save_followup') ?>",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function(response){
            toastr_msg(response.message, response.status);
			setTimeout(function(){
				location.reload();
			},5000);
        }
    });
});

// DELETE
function deleteFollowup(id){
    if(confirm('Are you sure?')){
        $.ajax({
            url: "<?= base_url('leads/delete_followup/') ?>" + id,
            type: "POST",
			dataType: "json",
            success: function(response){
                if(response.status == "success"){
					toastr_msg('Deleted successfully', "success");
					
					setTimeout(function(){
						location.reload();
					},5000);
				}
            }
        });
    }
}
</script>