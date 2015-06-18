$(document).ready(function() {
    $('#users_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'block_unblock.php',
            data: $(this).serialize(),
            success: function(data)
            {
                if (data.length > 0) {
                    document.getElementById('status').innerHTML = "Все сделано, сэр!";
                    location.reload();
                }
                else {
                    document.getElementById('status').innerHTML = "Что-то пошло не так!";
                }
            }
        });
    });
});