$(document).ready(function() {
    $('#login_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'login.php',
            data: $(this).serialize(),
            success: function(data)
            {
                if (data.length > 0) {
                    document.getElementById('login_box').innerHTML = data;
                }
                else {
                    document.getElementById('error').innerHTML = "Вы не вошли!";
                }
            }
        });
    });
});

var delete_cookie = function(name) {
    document.cookie = name + '=; Path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
};

function logOut() {
    delete_cookie("id");
    delete_cookie("hash");
    document.getElementById('login_box').innerHTML = "Вы вышли!";
}