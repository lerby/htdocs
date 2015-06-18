$(document).ready(function() {
    $('#orders_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'change_status.php',
            data: $(this).serialize(),
            success: function(data)
            {
                //document.getElementById('status').innerHTML = data;
                if (data.length > 0) {
                    document.getElementById('status').innerHTML = "Все сделано!";
                    location.reload();
                }
                else {
                    document.getElementById('status').innerHTML = "Что то не так!";
                }
            }
        });
    });
});
