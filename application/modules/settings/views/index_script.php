<script>

$(document).ready(function(){
	
});

$("#domain").change(function(){

    let selected = $(this).find(':selected');
    let domain_id = selected.val();
    if(!domain_id) return;

    $.ajax({
        url: "<?= base_url('settings/settings/get_school_data') ?>",
        type: "POST",
		dataType: "json",
        data: {
            domain_id: domain_id
        },
        success: function(res){
            $("#school_form_area").html(res.html);
            $("#session_list").show();
            $("#school_session").html(res.session_html);
			$('.select').select2({
				width: '100%'
			});
			
			setTimeout(function(){

				let old_state = $('#school_state').val();

				let old_district = $('#school_state').data('selected-district');

				if(old_state != ''){
					loadDistricts(old_state, old_district);
				}

			}, 300);
        },
        error: function(){
            alert("Error loading data");
        }
    });

});

$(document).on('change', '#smalllogoInput', function(){
	$('.admin-small-logo').show();
    let input = this;
    if (input.files && input.files[0]) {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('#smalllogoPreview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }

});

$(document).on('change', '#logoinput', function(){
	$('.admin-logo').show();
    let input = this;
    if (input.files && input.files[0]) {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('#logoPreview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }

});
<?php if($this->session->flashdata('domain_id')){ ?>
	selecteddomain("<?php echo  $this->session->flashdata('domain_id'); ?>");
<?php } ?>
function selecteddomain(id)
{
	setTimeout(function(){
		$('.setting_domain_id').val(id).trigger('change');
	}, 500);
}


//$(document).ready(function () {

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

    // On state change
    $(document).on('change', '#school_state', function () {

        let state_id = $(this).val();

        loadDistricts(state_id);

    });
//});
</script>