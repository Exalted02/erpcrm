<script>
$(document).on('change', '#logoInput' , function () {

    let input = this;
    if (input.files && input.files[0]) {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('#logoPreview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }

});

$(document).ready(function () {

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
                '<option value="">Please select</option>'
            );
        }
    }

    // On state change
    $('#state').change(function () {

        let state_id = $(this).val();
        loadDistricts(state_id);

    });

    // Old selected values after validation error
    let old_state = "<?= set_value('state', isset($company[0]->state) ? $company[0]->state : '') ?>";

    let old_district = "<?= set_value('district', isset($company[0]->district) ? $company[0]->district : '') ?>";

    if(old_state != ''){
        loadDistricts(old_state, old_district);
    }

});
</script>