function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function addToCart(id) {
    cart = getCookie("cart");
    if (cart === undefined) {
        cart = id.toString();
    }
    else {
        arr = cart.split(',');
        if (arr.indexOf(id.toString()) == -1)
            cart = cart + "," + id.toString();
    }

    if (cart.length > 0)
        document.cookie = "cart=" + cart + "; Path=/;";
    else
        removeFromCart('cart');

    location.reload();
}

function removeFromCart(id) {
    cart = getCookie("cart");
    if (cart !== undefined) {
        arr = cart.split(',');
        cart = "";
        for (i = 0; i < arr.length; ++i) {
            if (arr[i].toString() !== id.toString())
                cart = cart + "," + arr[i].toString();
        }

        if (cart[0] === ',')
            cart = cart.substr(1, cart.length - 1);
    }

    if (cart.length > 0)
        document.cookie = "cart=" + cart + "; Path=/;";
    else
        delete_cookie('cart');
    location.reload();
}