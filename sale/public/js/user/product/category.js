$(function () {
    handleSubmitBrand();
    handleSubmitSort();
});

function handleSubmitBrand() {
    const form = $("#form-brand");
    const btnNameBrand = $(".shop__sidebar__brand a");
    btnNameBrand.on("click", function () {
        let nameBrand = $(this).data("brand");
        form.find('input[name="brand"]').val(nameBrand);
        form.submit();
    });
}

function handleSubmitSort() {
    const form = $('#form-sort');
    form.find('select[name="sort"]').on('change', function(){
        form.submit();
    });
}
