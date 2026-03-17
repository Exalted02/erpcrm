<script>

$("#domain").change(function(){

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

});

</script>