<script>
$(document).ready(function () {

    function loadDistricts(state_id, selected_district = '') {
        if(state_id != ''){
            $.ajax({
				url: "<?= base_url('common/getDistricts') ?>",
                type: "POST",
                data: {state_id: state_id},

                success: function (response) {

                    $('#seller_district').html(response);

                    if(selected_district != ''){
                        $('#seller_district').val(selected_district);
                    }
                }
            });
        } else {

            $('#seller_district').html(
                '<option value="">Please select</option>'
            );
        }
    }

    // On state change
    $('#seller_state').change(function () {

        let state_id = $(this).val();
        loadDistricts(state_id);

    });

    // Old selected values after validation error
    let old_state = "<?= set_value('seller_state', isset($seller->seller_state) ? $seller->seller_state : '') ?>";

    let old_district = "<?= set_value('seller_district', isset($seller->seller_district) ? $seller->seller_district : '') ?>";

    if(old_state != ''){
        loadDistricts(old_state, old_district);
    }

});
function toggleGSTField(){

	let gstValue = $('select[name="have_gst"]').val();

	if(gstValue == '1'){

		$('.gst-field').slideDown();

	}else{

		$('.gst-field').slideUp();

		$('input[name="gst_no"]').val('');

	}
}

/*
|--------------------------------------------------------------------------
| On Change
|--------------------------------------------------------------------------
*/
$(document).on('change', 'select[name="have_gst"]', function(){

	toggleGSTField();

});

/*
|--------------------------------------------------------------------------
| On Page Load
|--------------------------------------------------------------------------
*/
$(document).ready(function(){

	toggleGSTField();

});
</script>