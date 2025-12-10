$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let formTouched = false;
    $("#ajaxForm, .ajaxForm").on("submit", function (e) {
        e.preventDefault();
        if (formTouched === false) {
            const formData = new FormData(this);
            formTouched = true;
            $.ajax({
                url: $(this).attr('action'),
                type: "post",
                dataType: "json",
                success: function success(e) {
                    console.log("success", e);
                    formTouched = true;
                    if (e['redirect']) {
                        window.location.href = e.redirect;
                    } else {
                        window.location.reload(true);
                    }
                },
                error: function error(e) {
                    var resp = $.parseJSON(e.responseText);
                    formTouched = false;
                    if (e.status === 422) {
                        var errors = resp.errors;
                        $.each(errors, function (x, y) {
                            if (y != null && y !== "") {
                                toastr.error(y);
                            }
                        });
                    } else if (resp.message) {
                        toastr.error(resp.message);
                    } else {
                        toastr.error("Something went wrong. Please try again.");
                    }
                },
                // Form data
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
            });
        }
    });

    // generate slug
    $("#product_name, #category_name").on("input", function () {
        const title = $(this).val();
        const slug = title.toLowerCase().replace(/[^a-z0-9]+/g, "-").replace(/^-|-$/g, "");
        const isProductInp = $(this).attr("id") === "product_name";
        $(isProductInp ? "#product_slug" : "#category_slug").val(slug);

        if (!isProductInp) $("#category_title").val(title);
    });
})


