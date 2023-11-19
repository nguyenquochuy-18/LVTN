$(function () {
    updateStatusOrder();
});

function updateStatusOrder() {
    const dropDown = $("#dropdown-status > a");
    const btnStatus = $("#btn-status");

    dropDown.on("click", function () {
        const id = $(this).data("id");
        const status = $(this).data("status");
        const url = $("#route-update-status").data("route");
        const text = $(this).text();
        $.ajax({
            type: "POST",
            url: url,
            data: { id, status },
            success: function (response) {
                if(response.status === 200) {
                    toastr.success(response.message);
                    btnStatus.find("span").text(text);
                }
            },
            error: function(response) {

            }
        });
    });
}
