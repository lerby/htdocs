$(document).ready(function() {
    $('#checkout_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'place_order.php',
            data: $(this).serialize(),
            success: function(data)
            {
                if (data.length > 0) {
                    document.getElementById('order_block').innerHTML = data;
                }
                else {
                    document.getElementById('error').innerHTML = "Ошибка выполнения заказа!";
                }
            }
        });
    });
});