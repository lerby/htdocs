$(document).ready(function() {
    $('#categories_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'remove.php',
            data: $(this).serialize(),
            success: function(data)
            {
                if (data.length > 0) {
                    document.getElementById('status').innerHTML = "Все удалено!";
                    location.reload();
                }
                else {
                    document.getElementById('status').innerHTML = "Почему то не удалено!";
                }
            }
        });
    });
});

$(document).ready(function() {
    $('#add_category').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'add.php',
            data: $(this).serialize(),
            success: function(data)
            {
                if (data.length > 0) {
                    document.getElementById('status').innerHTML = "Категория добавлена!";
                    location.reload();
                }
                else {
                    document.getElementById('status').innerHTML = "Почему то не добавлено!";
                }
            }
        });
    });
});