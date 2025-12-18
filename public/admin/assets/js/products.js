const ProductForm = (function () {
    // Private variables
    let config = {
        variantIndex: 0,
        specIndex: 0,
        faqIndex: 0,
        existingImageCount: 0,
        redirectUrl: '/admin/products',
        maxImages: 9
    };

    let galleryFiles = new DataTransfer();

    function init(userConfig) {
        config = { ...config, ...userConfig };
        bindEvents();
        updateGalleryCount();
    }

    function bindEvents() {
        // --- Variants ---
        $('#has_variants').on('change', function () {
            if ($(this).is(':checked')) {
                $('#simple-pricing').addClass('d-none');
                $('#variants-section').removeClass('d-none');
            } else {
                $('#simple-pricing').removeClass('d-none');
                $('#variants-section').addClass('d-none');
            }
        }).trigger('change');

        $('#add-variant').on('click', function () {
            const template = $('#variant-template').html();
            const html = template.replace(/__INDEX__/g, config.variantIndex);
            $('#variants-container').append(html);
            $('#variants-container .variant-row:last .variant-number').text($('#variants-container .variant-row').length);
            $('#no-variants-message').addClass('d-none');
            config.variantIndex++;
        });

        $(document).on('click', '.remove-variant', function () {
            $(this).closest('.variant-row').remove();
            if ($('#variants-container .variant-row').length === 0) {
                $('#no-variants-message').removeClass('d-none');
            }
            // Renumber variants
            $('#variants-container .variant-row').each(function (i) {
                $(this).find('.variant-number').text(i + 1);
            });
        });

        // --- Specs ---
        $('#add-spec').on('click', function () {
            const template = $('#spec-template').html();
            const html = template.replace(/__INDEX__/g, config.specIndex);
            $('#specs-container').append(html);
            config.specIndex++;
        });

        $(document).on('click', '.remove-spec', function () {
            $(this).closest('.spec-row').remove();
        });

        // --- FAQs ---
        if ($('#faqs-container').children().length === 0 && $('#faqs-container .faq-row').length === 0) {
            // Logic handled in init or view mainly, but checking here
        }

        $('#add-faq').on('click', function () {
            const template = `
                <div class="row mb-3 faq-row border-bottom pb-3">
                    <div class="col-md-11">
                        <div class="mb-2">
                            <label class="form-label">Question</label>
                            <input type="text" class="form-control" name="faqs[${config.faqIndex}][question]" placeholder="Enter question" required>
                        </div>
                        <div>
                            <label class="form-label">Answer</label>
                            <textarea class="form-control" name="faqs[${config.faqIndex}][answer]" rows="2" placeholder="Enter answer" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-outline-danger remove-faq">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            $('#faqs-container').append(template);
            $('#no-faqs-message').addClass('d-none');
            config.faqIndex++;
        });

        $(document).on('click', '.remove-faq', function () {
            $(this).closest('.faq-row').remove();
            if ($('#faqs-container .faq-row').length === 0) {
                $('#no-faqs-message').removeClass('d-none');
            }
        });

        // --- AJAX Submit ---
        $('#product-form').on('submit', handleFormSubmit);

        // --- Image Inputs (Global binding, though specific functions are exposed) ---
        // Note: Inline onchange="..." in HTML calls the exposed functions below.
    }

    function handleFormSubmit(e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalBtnText = submitBtn.text();

        submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

        const formData = new FormData(this);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message || 'Product saved successfully!');
                    setTimeout(function () {
                        window.location.href = config.redirectUrl;
                    }, 1500);
                }
            },
            error: function (xhr) {
                submitBtn.prop('disabled', false).text(originalBtnText);

                let errorMessage = 'Something went wrong.';
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    // Show first error only for cleaner toastr
                    const firstError = Object.values(errors).flat()[0];
                    errorMessage = firstError || 'Validation failed.';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                toastr.error(errorMessage);
            }
        });
    }

    // --- Image Handling ---

    function handleThumbnailSelect(input) {
        const wrapper = document.getElementById('thumbnail-wrapper');
        const img = document.getElementById('thumbnail-preview');
        const container = document.getElementById('thumbnail-preview-container'); // For Create view compatibility if ids differ, but looks like wrapper/img ids used in Edit. 
        // Create view used: thumbnail-preview-container (block vs none), thumbnail-preview (img)
        // Edit view used: thumbnail-wrapper (block vs none), thumbnail-preview (img)

        // Let's standardize or handle both.
        // In Create: <div id="thumbnail-preview-container" style="display:none"><img id="thumbnail-preview"></div>
        // In Edit: <div id="thumbnail-preview-container"><div id="thumbnail-wrapper"><img id="thumbnail-preview"></div></div>

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if (img) img.src = e.target.result;
                if (wrapper) wrapper.style.display = 'inline-block';
                if (container && !wrapper) container.style.display = 'block'; // Fallback for create view structure
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            if (wrapper) wrapper.style.display = 'none';
            if (container && !wrapper) container.style.display = 'none';
        }
    }

    function updateGalleryCount() {
        // If element doesn't exist, skip
        const el = document.getElementById('gallery-count');
        if (!el) return 0;

        const total = config.existingImageCount + galleryFiles.items.length;
        el.textContent = `${total}/${config.maxImages}`;
        return total;
    }

    function handleGallerySelect(input) {
        const totalCurrent = config.existingImageCount + galleryFiles.items.length;
        const newFiles = Array.from(input.files);

        if (totalCurrent + newFiles.length > config.maxImages) {
            alert(`You can only upload a maximum of ${config.maxImages} images (including existing ones).`);
            input.files = galleryFiles.files;
            return;
        }

        newFiles.forEach(file => {
            galleryFiles.items.add(file);
        });

        input.files = galleryFiles.files;
        renderNewPreviews();
        updateGalleryCount();

        // Also call legacy if specific to Create view (it used updateGalleryPreview vs renderNewPreviews)
        // We will unify to renderNewPreviews inside container
    }

    function renderNewPreviews() {
        // Remove old 'new' previews
        document.querySelectorAll('.new-image-preview').forEach(el => el.remove());

        // Find container. Create view: 'gallery-preview'. Edit view: 'gallery-preview-container'
        // Let's standardise or check both.
        let container = document.getElementById('gallery-preview-container');
        if (!container) container = document.getElementById('gallery-preview');

        if (!container) return;

        Array.from(galleryFiles.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const col = document.createElement('div');
                // Use a generic class for styling
                col.className = 'col-md-3 col-6 mb-3 new-image-preview';
                col.innerHTML = `
                    <div class="card h-full border position-relative">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" onclick="ProductForm.removeGalleryFile(${index})" style="z-index: 5;">
                            <i class="fa fa-times"></i>
                        </button>
                        <img src="${e.target.result}" class="card-img-top" style="height: 100px; object-fit: cover;">
                    </div>
                `;
                container.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }

    function removeGalleryFile(index) {
        const dt = new DataTransfer();
        const input = document.getElementById('images');
        const files = galleryFiles.files;

        for (let i = 0; i < files.length; i++) {
            if (i !== index) {
                dt.items.add(files[i]);
            }
        }

        galleryFiles = dt;
        input.files = galleryFiles.files;
        renderNewPreviews();
        updateGalleryCount();
    }

    function removeExistingImage(id) {
        const card = document.querySelector(`.existing-image-card[data-id="${id}"]`);
        if (card) {
            card.remove();

            const deletedContainer = document.getElementById('deleted-images-container');
            if (deletedContainer) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_image_ids[]';
                input.value = id;
                deletedContainer.appendChild(input);
            }

            config.existingImageCount--;
            updateGalleryCount();
        }
    }

    function removeThumbnail() {
        const input = document.getElementById('thumbnail');
        if (input) input.value = '';

        const wrapper = document.getElementById('thumbnail-wrapper');
        const container = document.getElementById('thumbnail-preview-container');

        if (wrapper) wrapper.style.display = 'none';
        if (container && !wrapper) container.style.display = 'none';
    }

    // Public API
    return {
        init: init,
        handleThumbnailSelect: handleThumbnailSelect,
        removeThumbnail: removeThumbnail,
        handleGallerySelect: handleGallerySelect,
        removeGalleryFile: removeGalleryFile,
        removeExistingImage: removeExistingImage
    };
})();