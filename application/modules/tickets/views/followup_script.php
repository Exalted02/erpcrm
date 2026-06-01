<script>

function openAddModal() {

    $('#followupForm')[0].reset();

    $('#followup_id').val('');
    $('#old_image').val('');
    $('.ticket_status_row').show();

    $('#image_preview_div').hide();
    $('#image_preview').attr('src', '');

    $('#followupModal').modal('show');
}

// EDIT
function editFollowup(id, message, image) {

    $('#followup_id').val(id);
    $('#message').val(message);

    $('#old_image').val(image);
    $('.ticket_status_row').hide();

    if(image != '' && image != null){

        let imageUrl = "<?= base_url('uploads/followups/') ?>" + image;

        $('#image_preview').attr('src', imageUrl);
        $('#image_preview_div').show();

    } else {

        $('#image_preview_div').hide();
    }

    $('#followupModal').modal('show');
}

// IMAGE PREVIEW
$('#followup_image').change(function(){

    let file = this.files[0];

    if(file){

        let reader = new FileReader();

        reader.onload = function(e){

            $('#image_preview').attr('src', e.target.result);
            $('#image_preview_div').show();
        }

        reader.readAsDataURL(file);
    }
});

// SAVE
$('#followupForm').submit(function(e){

    e.preventDefault();
	
	var message = $('#message').val();
	if(message == ''){
		$('#err_message').text('Please enter message');
		return false;
	}

    let formData = new FormData(this);

    $.ajax({
        url: "<?= base_url('tickets/save_followup') ?>",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",

        success: function(response){

            toastr_msg(response.message, response.status);

            if(response.status == 'success'){

                setTimeout(function(){
                    location.reload();
                }, 1000);
            }
        }
    });
});

// DELETE
function deleteFollowup(id){

    if(confirm('Are you sure?')){

        $.ajax({
            url: "<?= base_url('tickets/delete_followup/') ?>" + id,
            type: "POST",
            dataType: "json",

            success: function(response){

                if(response.status == "success"){

                    toastr_msg('Deleted successfully', "success");

                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
            }
        });
    }
}

</script>