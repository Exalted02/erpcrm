<script>
if (typeof CKEDITOR !== "undefined" && $('#description').length > 0) {

    CKEDITOR.replace('description', {
        allowedContent: true,

        toolbar: [
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            }
        ],

        removeButtons: '',
        height: 100
    });

}
</script>