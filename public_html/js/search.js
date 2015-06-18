$(document).ready(function() {
    $('#search_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: 'find.php',
            data: $(this).serialize() + '&page=1',
            success: function(data)
            {
                document.getElementById('result').innerHTML = data;
                /*if (data.length > 0) {
                    document.getElementById('result').innerHTML = data;
                }
                else {
                    document.getElementById('result').innerHTML = "Ничего не найдено!";
                }*/
            }
        });
    });
});