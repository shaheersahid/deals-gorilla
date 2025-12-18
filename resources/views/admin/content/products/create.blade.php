@extends('admin.layouts.master')
@section('page-title', 'Create Product')

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" id="product-form" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <!-- Basic Info -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label for="name" class="form-label">Product Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="sku" class="form-label">SKU</label>
                                        <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ old('sku') }}" placeholder="Auto-generated if left empty">
                                        <small class="text-muted">Leave empty to auto-generate</small>
                                        @error('sku')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Auto-generated if left empty">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="short_desc" class="form-label">Short Description</label>
                                        <textarea class="form-control @error('short_desc') is-invalid @enderror" id="short_desc" name="short_desc" rows="2">{{ old('short_desc') }}</textarea>
                                        @error('short_desc')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="card" id="pricing-section">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Pricing</h5>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="has_variants" name="has_variants" value="1" {{ old('has_variants') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="has_variants">This product has variants</label>
                                </div>
                            </div>
                            <div class="card-body" id="simple-pricing">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
                                        </div>
                                        @error('price')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cost_price" class="form-label">Cost Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control @error('cost_price') is-invalid @enderror" id="cost_price" name="cost_price" value="{{ old('cost_price') }}">
                                        </div>
                                        <small class="text-muted">For profit calculation</small>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label for="stock" class="form-label">Stock Quantity</label>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0">
                                        @error('stock')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Variants Section -->
                        <div class="card d-none" id="variants-section">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Product Variants</h5>
                                <button type="button" class="btn btn-sm btn-primary" id="add-variant">
                                    <i class="fa fa-plus me-1"></i> Add Variant
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="variants-container">
                                    <!-- Variant rows will be added here -->
                                </div>
                                <div class="text-center text-muted py-4" id="no-variants-message">
                                    <p>No variants added yet. Click "Add Variant" to create product variations.</p>
                                </div>
                            </div>
                        </div>

                                                <!-- Product Images -->
                        <div class="card" id="product-images-section">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Images</h5>
                            </div>
                            <div class="card-body">
                                <!-- Main Thumbnail -->
                                <div class="mb-4">
                                    <label for="thumbnail" class="form-label">Main Thumbnail</label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" onchange="ProductForm.handleThumbnailSelect(this)">
                                    <div class="mt-2" id="thumbnail-preview-container" style="display: none;">
                                        <div class="position-relative d-inline-block">
                                            <img id="thumbnail-preview" src="" alt="Thumbnail Preview" class="img-thumbnail" style="max-height: 200px;">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" onclick="ProductForm.removeThumbnail()">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>

                                <!-- Gallery Images -->
                                <div class="mb-3">
                                    <label for="images" class="form-label">Gallery Images <span class="text-muted">(Max 9)</span></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" onchange="ProductForm.handleGallerySelect(this)">
                                        <span class="input-group-text" id="gallery-count">0/9</span>
                                    </div>
                                    <small class="text-muted">Images will be appended. Click remove on preview to delete.</small>
                                    <div class="row mt-2" id="gallery-preview"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Specifications -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Specifications</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="weight" class="form-label">Weight</label>
                                        <div class="input-group">
                                            <input type="number" step="0.001" class="form-control" id="weight" name="weight" value="{{ old('weight') }}">
                                            <select class="form-select" name="weight_unit" style="max-width: 80px;">
                                                <option value="kg" {{ old('weight_unit', 'kg') == 'kg' ? 'selected' : '' }}>kg</option>
                                                <option value="g" {{ old('weight_unit') == 'g' ? 'selected' : '' }}>g</option>
                                                <option value="lb" {{ old('weight_unit') == 'lb' ? 'selected' : '' }}>lb</option>
                                                <option value="oz" {{ old('weight_unit') == 'oz' ? 'selected' : '' }}>oz</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="length" class="form-label">Length</label>
                                        <input type="number" step="0.01" class="form-control" id="length" name="length" value="{{ old('length') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="width" class="form-label">Width</label>
                                        <input type="number" step="0.01" class="form-control" id="width" name="width" value="{{ old('width') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="height" class="form-label">Height</label>
                                        <input type="number" step="0.01" class="form-control" id="height" name="height" value="{{ old('height') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dimension_unit" class="form-label">Unit</label>
                                        <select class="form-select" name="dimension_unit">
                                            <option value="cm" {{ old('dimension_unit', 'cm') == 'cm' ? 'selected' : '' }}>cm</option>
                                            <option value="in" {{ old('dimension_unit') == 'in' ? 'selected' : '' }}>in</option>
                                            <option value="m" {{ old('dimension_unit') == 'm' ? 'selected' : '' }}>m</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="mb-3">Custom Specifications</h6>
                                <div id="specs-container">
                                    <!-- Spec rows will be added here -->
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-spec">
                                    <i class="fa fa-plus me-1"></i> Add Specification
                                </button>
                            </div>
                        </div>

                        <!-- Deal Settings -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Deal Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="deal_enabled" name="deal_enabled" value="1" {{ old('deal_enabled') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="deal_enabled">Enable Deal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="deal_start" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="deal_start" name="deal_start" value="{{ old('deal_start') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="deal_end" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="deal_end" name="deal_end" value="{{ old('deal_end') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="deal_price" class="form-label">Deal Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control @error('deal_price') is-invalid @enderror" id="deal_price" name="deal_price" value="{{ old('deal_price') }}">
                                        </div>
                                        <small class="text-muted">Discounted price for deals section</small>
                                        @error('deal_price')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="display_price" class="form-label">Display Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control @error('display_price') is-invalid @enderror" id="display_price" name="display_price" value="{{ old('display_price') }}">
                                        </div>
                                        <small class="text-muted">Override for display price</small>
                                        @error('display_price')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="percentage_off" class="form-label">Percentage Off</label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" class="form-control @error('percentage_off') is-invalid @enderror" id="percentage_off" name="percentage_off" value="{{ old('percentage_off') }}" min="0" max="100">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <small class="text-muted">Discount percentage for deals</small>
                                        @error('percentage_off')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Actions -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Publish</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', true))>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured'))>
                                    <label class="form-check-label" for="is_featured">Featured Product</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_out_of_stock" name="is_out_of_stock" value="1" @checked(old('is_out_of_stock'))>
                                    <label class="form-check-label" for="is_out_of_stock">Mark as Out of Stock</label>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-1"></i> Create Product
                                    </button>
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center justify-content-center">Cancel</a>
                                </div>
                            </div>
                        </div>

                        <!-- Category & Brand -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Organization</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="brand_id" class="form-label">Brand</label>
                                    <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                                        <option value="">No Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-0">
                                    <label for="video" class="form-label">Video URL</label>
                                    <input type="text" class="form-control" id="video" name="video" value="{{ old('video') }}" placeholder="YouTube or video URL">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Variant Template -->
    <template id="variant-template">
        <div class="variant-row card card-body bg-light mb-3">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h6 class="mb-0">Variant <span class="variant-number"></span></h6>
                <button type="button" class="btn btn-sm btn-outline-danger remove-variant">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
            <div class="row mb-3">
                @foreach($variantAttributes as $attr)
                <div class="col-md-4">
                    <label class="form-label">{{ $attr->name }}</label>
                    <select class="form-select" name="variants[__INDEX__][attributes][{{ $attr->id }}]">
                        <option value="">Select {{ $attr->name }}</option>
                        @foreach($attr->options as $option)
                            <option value="{{ $option->id }}">{{ $option->label ?: $option->value }}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">SKU</label>
                    <input type="text" class="form-control" name="variants[__INDEX__][sku]" placeholder="Variant SKU">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Price <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" name="variants[__INDEX__][price]" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Stock</label>
                    <input type="number" class="form-control" name="variants[__INDEX__][stock]" value="0" min="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Variant Image</label>
                    <input type="file" class="form-control variant-image-input" name="variants[__INDEX__][image]" accept="image/*">
                </div>
            </div>
        </div>
    </template>

    <!-- Spec Template -->
    <template id="spec-template">
        <div class="spec-row row mb-2">
            <div class="col-5">
                <input type="text" class="form-control" name="specs[__INDEX__][key]" placeholder="Specification name (e.g. Battery)">
            </div>
            <div class="col-5">
                <input type="text" class="form-control" name="specs[__INDEX__][value]" placeholder="Value (e.g. 4000mAh)">
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-outline-danger remove-spec">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </template>
@endsection

@push('admin-scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script src="{{ asset('admin/assets/js/products.js') }}"></script>
<script>
    $(function() {
        ProductForm.init({
            variantIndex: 0,
            specIndex: 0,
            faqIndex: 0,
            existingImageCount: 0,
            redirectUrl: "{{ route('products.index') }}",
            maxImages: 9
        });
        
        // Toggle product images section based on has_variants
        $('#has_variants').on('change', function() {
            if ($(this).is(':checked')) {
                $('#product-images-section').slideUp();
            } else {
                $('#product-images-section').slideDown();
            }
        });
        
        // Initial state on page load
        if ($('#has_variants').is(':checked')) {
            $('#product-images-section').hide();
        }
        
        // Initialize CKEditor for short description
        ClassicEditor
            .create(document.querySelector('#short_desc'), {
                toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList']
            })
            .catch(error => {
                console.error(error);
            });
        
        // Initialize CKEditor for description
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endpush

