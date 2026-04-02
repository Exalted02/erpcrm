<script>
$(document).on('click', '.manage_subscription', function(){
	$('#manage_subscription').modal('show');
	
	var lead_id = $(this).data('id');
	$('#lead_id').val(lead_id);
});
</script>