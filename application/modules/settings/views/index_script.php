<script>

$(document).ready(function(){
	
});

$("#domain").change(function(){

    let selected = $(this).find(':selected');
    let domain_id = selected.val();
	//alert(domain_id);
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
</script>