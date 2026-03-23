<script>

$('#logoInput').on('change', function () {

    let input = this;
    if (input.files && input.files[0]) {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('#logoPreview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }

});

/*$("#domain").change(function(){

    let selected = $(this).find(':selected');
    let domain_id = selected.val();

    if(!domain_id) return;

    $.ajax({
        url: "<?= base_url('settings/settings/get_school_data') ?>",
        type: "POST",
        data: {
            domain_id: domain_id
        },
        success: function(res){
            $("#school_form_area").html(res);
        },
        error: function(){
            alert("Error loading data");
        }
    });

});*/

</script>