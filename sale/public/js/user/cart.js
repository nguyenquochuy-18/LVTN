$(function () {
    getCountCart();
    addToCart();
    deleteCart();
    addProductToCartInPageDetail();
});

function getCountCart() {
    let route = $("#route-get-count-cart").data("route");
    let countCart = $(".count-cart");
    let totalPriceCart = $(".price");
    $.ajax({
        type: "GET",
        url: route,
        success: function (response) {
            if (response.status === 200) {
                countCart.text(response.count);
                totalPriceCart.text(response.total + " vnd");
            } else if (response.status === 403) {
                countCart.text(0);
                totalPriceCart.text(0.0 + " vnd");
            }
        },
    });
}

function addToCart() {
    let btnAddToCart = $(".add-cart");
    let route = $("#route-add-to-cart").data("route");
    btnAddToCart.on("click", function () {
        btnAddToCart.prop("disabled", true);
        $.ajax({
            type: "POST",
            url: route,
            data: {
                quantity: 1,
                product_id: $(this).data("id"),
                total: $(this).data("price"),
            },
            success: function (response) {
                if (response.status === 200) {
                    toastr.success(response.message);
                    getCountCart();
                } else if (response.status === 403) {
                    window.location.href = response.route;
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (response) {
                toastr.error(response.message);
            },
            complete: function () {
                btnAddToCart.removeAttr("disabled");
            },
        });
    });
}

function deleteCart() {
    let btnDelete = $(".cart-delete");
    btnDelete.on("click", function () {
        let _this = $(this);
        $.ajax({
            type: "POST",
            url: $(this).data("route"),
            data: {
                _method: "DELETE",
            },
            success: function (response) {
                if (response.status === 200) {
                    toastr.success(response.message);
                    _this.parent().parent().remove();
                    checkCartEmptyHTML();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (response) {
                toastr.error(response.message);
            },
        });
    });
}

function addProductToCartInPageDetail() {
    let btnAdd = $("#add-cart-detail");
    let inputQuantity = $("body #quantity-input");
    let route = $("#route-add-to-cart").data("route");

    btnAdd.on("click", function () {
        btnAdd.prop("disabled", true);
        $.ajax({
            type: "POST",
            url: route,
            data: {
                quantity: inputQuantity.val(),
                product_id: $(this).data("id"),
                total: +inputQuantity.val() * +$(this).data("price"),
            },
            success: function (response) {
                if (response.status === 200) {
                    window.location.href = "/cart";
                } else if (response.status === 403) {
                    window.location.href = response.route;
                }
            },
            error: function (response) {
                toastr.error(response.message);
            },
            complete: function () {
                btnAdd.removeAttr("disabled");
            },
        });
    });
}


