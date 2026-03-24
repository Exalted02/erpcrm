<script>
var domain_id = <?= $this->session->flashdata('domain_id'); ?>
//alert(domain_id);
$(document).ready(function(){
	//alert('ok');
	//$('.admin-small-logo').hide();
	//$('.admin-logo').hide();
	
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

</script>