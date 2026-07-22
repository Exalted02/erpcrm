<script>

$(document).ready(function(){

	$('#payment_reminder_schools').select2({
		width: '100%',
		placeholder: 'Select School',
		allowClear: true,
		minimumResultsForSearch: 0   // always show the search box, even with few options
	});

	$('#popup_alert_schools').select2({
		width: '100%',
		placeholder: 'Select School',
		allowClear: true,
		minimumResultsForSearch: 0   // always show the search box, even with few options
	});

});
</script>
