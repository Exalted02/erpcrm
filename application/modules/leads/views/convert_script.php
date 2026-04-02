<script>
$(document).on('change', '#schoollogoInput', function(){
	$('.school-logo').show();
    let input = this;
    if (input.files && input.files[0]) {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('#schoollogoPreview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }

});
</script>