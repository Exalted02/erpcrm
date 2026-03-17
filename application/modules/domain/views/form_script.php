<script>

function generateKey() {

    const array = new Uint8Array(32);
    window.crypto.getRandomValues(array);

    let key = Array.from(array, byte =>
        ('0' + byte.toString(16)).slice(-2)
    ).join('');

    $("#api_key").val(key);

}

</script>