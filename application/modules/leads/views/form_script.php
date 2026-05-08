<script>

$(document).ready(function () {

    function loadDistricts(state_id, selected_district = '') {

        if(state_id != ''){

            $.ajax({
				url: "<?= base_url('leads/getDistricts') ?>",
                type: "POST",
                data: {state_id: state_id},

                success: function (response) {

                    $('#school_district').html(response);

                    if(selected_district != ''){
                        $('#school_district').val(selected_district);
                    }
                }
            });

        } else {

            $('#school_district').html(
                '<option value="">Please select</option>'
            );
        }
    }

    // On state change
    $('#school_state').change(function () {

        let state_id = $(this).val();

        loadDistricts(state_id);

    });

    // Old selected values after validation error
    let old_state = "<?= set_value('school_state', isset($lead) ? $lead->school_state : '') ?>";

    let old_district = "<?= set_value('school_district', isset($lead) ? $lead->school_district : '') ?>";

    if(old_state != ''){
        loadDistricts(old_state, old_district);
    }

});

</script>