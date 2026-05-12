<script>

function generateKey() {

    const array = new Uint8Array(32);
    window.crypto.getRandomValues(array);

    let key = Array.from(array, byte =>
        ('0' + byte.toString(16)).slice(-2)
    ).join('');

    $("#api_key").val(key);

}

$(document).ready(function(){
	let old_state = "<?= set_value('school_state', isset($domain) ? $domain->school_state : '') ?>";

	let old_district = "<?= set_value('school_district', isset($domain) ? $domain->school_district : '') ?>";

	if(old_state != ''){
		loadDistricts(old_state, old_district);
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

// On state change
$(document).on('change', '#school_state', function () {

	let state_id = $(this).val();

	loadDistricts(state_id);

});
</script>