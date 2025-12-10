$(document).ready(function () {
    $(".select2").select2();

    tinymce.init({
        selector: "#product_description",
        height: 400,
        plugins: [
            "advlist", "autolink", "lists", "link",
            "image", "charmap", "preview", "anchor",
            "searchreplace", "visualblocks", "code",
            "fullscreen", "insertdatetime", "media",
            "table", "help", "wordcount",
        ],
        toolbar:
            "undo redo | blocks | " +
            "bold italic backcolor | alignleft aligncenter " +
            "alignright alignjustify | bullist numlist outdent indent | " +
            "removeformat | help",
        content_style:
            "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
    });

    initDynamicRows({
        wrapper: "#variants-wrapper",
        row: ".variant-row",
        addBtn: ".add-variant",
        removeBtn: ".remove-variant",
        container: "#variant-container",
        templateId: "#productVariant",
        fieldName: "variants",
        maxRows: 4
    });

    initDynamicRows({
        wrapper: "#images-wrapper",
        row: ".image-row",
        addBtn: ".add-image",
        removeBtn: ".remove-image",
        container: "#image-container",
        templateId: "#productImage",
        fieldName: "images",
        maxRows: 5,
    });

    // Reusable dynamic row manager
    function initDynamicRows(options) {
        let {
            wrapper, // main wrapper selector
            row, // row class (e.g. .variant-row, .image-row)
            addBtn, // add button class (e.g. .add-variant, .add-image)
            removeBtn, // remove button class (e.g. .remove-variant, .remove-image)
            container, // container where new rows append
            templateId, // hidden template selector
            fieldName, // field prefix (e.g. "variants" or "images")
            maxRows = 0, // optional max limit, 0 = unlimited
        } = options;


        function refreshButtons() {
            const rows = $(`${wrapper} ${row}`);
            const total = rows.length;

            // Hide all add buttons
            rows.find(addBtn).addClass("d-none");

            // Show add button on the last row if under limit
            if (!maxRows || total < maxRows) {
                rows.last().find(addBtn).removeClass("d-none");
            }

            // Show remove buttons except if only one row left
            rows.find(removeBtn).removeClass("d-none");
            if (total === 1) {
                rows.find(removeBtn).addClass("d-none");
            }
        }

        function addRow(values = {}) {
            let timestamp = values.id || Date.now();
            let newRow = $(templateId)
                .html()
                .replace(new RegExp(`${fieldName}\\[0\\]`, "g"),`${fieldName}[${timestamp}]`);

            newRow = $(newRow);

            // Fill row inputs if values are provided
            Object.keys(values).forEach((key) => {
                let objKey = key == "price" ? "original_price" : (key == "size" ? "weight" : key);
                let isImages = container === "#image-container";

                if (isImages && values.file_path) {
                    newRow.find(".wrapper").removeClass("d-none");
                    newRow.find(".wrapper img").attr("src", values.file_path);
                }

                let input = newRow.find(`[name^="${isImages ? 'product_' : ''}${fieldName}"][name$="[${objKey}]"]`);
                if (input.length) input.val(values[key]);
            });

            $(container).append(newRow);
        }

        // Add row
        $(document).on("click", addBtn, function () {
            addRow();
            refreshButtons();
        });

        // Remove row
        $(document).on("click", removeBtn, function () {
            $(this).closest(row).remove();
            refreshButtons();
        });

        // Initial render
        if ($(container).data('variants') !== undefined || $(container).data('images') !== undefined) {
            let data = container === "#variant-container" ? $(container).data('variants') : $(container).data('images');
            $.each(data, (index, item) => addRow(item));
        }

        // Initial
        refreshButtons();
    }

    // function toggleDealFields() {
    //     if ($('#has_deal').val() === '1') {
    //         $('.deal-fields').removeClass('d-none');
    //     } else {
    //         $('.deal-fields').addClass('d-none');
    //     }
    // }

    // On change
    // $('#has_deal').on('change', toggleDealFields);

    // Run once on page load
    // toggleDealFields();

    // get unique product sku
    $("#product_category").on("change", function () {
        let categoryId = $(this).val();
        let route = $(this).data("route");

        if (!categoryId) return;

        $.ajax({
            url: route,
            method: "POST",
            data: { categoryId },
            success: function (response) {
                if (response.sku) {
                    $("#product_sku").val(response.sku).attr("disabled", false);
                }
            },
            error: function () {
                toastr.error("Something went wrong. Please try again.");
            },
        });
    });
});
