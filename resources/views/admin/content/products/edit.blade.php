@extends('admin.layouts.master')
@section('page-title', 'Edit Product')

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('products.update', $product) }}" method="POST" id="product-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                                        @error('sku')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $product->slug) }}">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="short_desc" class="form-label">Short Description</label>
                                        <textarea class="form-control @error('short_desc') is-invalid @enderror" id="short_desc" name="short_desc" rows="2">{{ old('short_desc', $product->short_desc) }}</textarea>
                                        @error('short_desc')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Images -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Product Images</h5>
                            </div>
                            <div class="card-body">
                                <!-- Main Thumbnail -->
                                @php
                                    $mainImage = $product->images->where('is_primary', true)->first();
                                    $galleryImages = $product->images->where('is_primary', false);
                                @endphp
                                
                                <div class="mb-4">
                                    <label for="thumbnail" class="form-label">Main Thumbnail</label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" onchange="ProductForm.handleThumbnailSelect(this)">
                                    <div class="mt-2" id="thumbnail-preview-container">
                                        <div class="position-relative d-inline-block" id="thumbnail-wrapper" style="{{ $mainImage ? '' : 'display: none;' }}">
                                            <img id="thumbnail-preview" src="{{ $mainImage ? asset('storage/' . $mainImage->thumb_path) : '' }}" alt="Thumbnail Preview" class="img-thumbnail" style="max-height: 200px;">
                                            <!-- Note: For main thumbnail in edit, we don't usually "delete" it to null, just replace. But if user wants to delete: -->
                                            <!-- Simple replace logic is standard. If they want to just delete, we'd need a delete flag. -->
                                            <!-- For now, assuming replace only for main thumbnail or keep existing. -->
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>

                                <!-- Gallery Images -->
                                <div class="mb-3">
                                    <label for="images" class="form-label">Gallery Images <span class="text-muted">(Max 9 Total)</span></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" onchange="ProductForm.handleGallerySelect(this)">
                                        <span class="input-group-text" id="gallery-count">0/9</span>
                                    </div>
                                    <small class="text-muted">Images will be appended. Click remove to delete.</small>

                                    <!-- Hidden inputs for deleted existing images -->
                                    <div id="deleted-images-container"></div>
                                    
                                    <!-- Combined Preview Container (Existing + New) -->
                                    <div class="row mt-2" id="gallery-preview-container">
                                        <!-- Existing Gallery Images -->
                                        @foreach($galleryImages as $image)
                                        <div class="col-md-3 col-6 mb-3 existing-image-card" data-id="{{ $image->id }}">
                                            <div class="card h-full border position-relative">
                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" onclick="ProductForm.removeExistingImage({{ $image->id }})" style="z-index: 5;">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <img src="{{ asset('storage/' . $image->thumb_path) }}" class="card-img-top" alt="Product Image" style="height: 100px; object-fit: cover;">
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                        <!-- New images will be appended here by JS -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="card" id="pricing-section">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Pricing</h5>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="has_variants" name="has_variants" value="1" {{ old('has_variants', $product->has_variants) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="has_variants">This product has variants</label>
                                </div>
                            </div>
                            <div class="card-body" id="simple-pricing">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}">
                                        </div>
                                        @error('price')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cost_price" class="form-label">Cost Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control @error('cost_price') is-invalid @enderror" id="cost_price" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}">
                                        </div>
                                        <small class="text-muted">For profit calculation</small>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label for="stock" class="form-label">Stock Quantity</label>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0">
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
                                    <!-- Existing variants will be populated here -->
                                </div>
                                <div class="text-center text-muted py-4 {{ $product->variants->count() > 0 ? 'd-none' : '' }}" id="no-variants-message">
                                    <p>No variants added yet. Click "Add Variant" to create product variations.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Specifications -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Specifications</h5>
                            </div>
                            <div class="card-body">
                                @php $spec = $product->specification; @endphp
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="weight" class="form-label">Weight</label>
                                        <div class="input-group">
                                            <input type="number" step="0.001" class="form-control" id="weight" name="weight" value="{{ old('weight', $spec?->weight) }}">
                                            <select class="form-select" name="weight_unit" style="max-width: 80px;">
                                                <option value="kg" {{ old('weight_unit', $spec?->weight_unit ?? 'kg') == 'kg' ? 'selected' : '' }}>kg</option>
                                                <option value="g" {{ old('weight_unit', $spec?->weight_unit) == 'g' ? 'selected' : '' }}>g</option>
                                                <option value="lb" {{ old('weight_unit', $spec?->weight_unit) == 'lb' ? 'selected' : '' }}>lb</option>
                                                <option value="oz" {{ old('weight_unit', $spec?->weight_unit) == 'oz' ? 'selected' : '' }}>oz</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="length" class="form-label">Length</label>
                                        <input type="number" step="0.01" class="form-control" id="length" name="length" value="{{ old('length', $spec?->length) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="width" class="form-label">Width</label>
                                        <input type="number" step="0.01" class="form-control" id="width" name="width" value="{{ old('width', $spec?->width) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="height" class="form-label">Height</label>
                                        <input type="number" step="0.01" class="form-control" id="height" name="height" value="{{ old('height', $spec?->height) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dimension_unit" class="form-label">Unit</label>
                                        <select class="form-select" name="dimension_unit">
                                            <option value="cm" {{ old('dimension_unit', $spec?->dimension_unit ?? 'cm') == 'cm' ? 'selected' : '' }}>cm</option>
                                            <option value="in" {{ old('dimension_unit', $spec?->dimension_unit) == 'in' ? 'selected' : '' }}>in</option>
                                            <option value="m" {{ old('dimension_unit', $spec?->dimension_unit) == 'm' ? 'selected' : '' }}>m</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="mb-3">Custom Specifications</h6>
                                <div id="specs-container">
                                    @if($spec && $spec->specs)
                                        @foreach($spec->specs as $key => $value)
                                        <div class="spec-row row mb-2">
                                            <div class="col-5">
                                                <input type="text" class="form-control" name="specs[{{ $loop->index }}][key]" placeholder="Specification name" value="{{ $key }}">
                                            </div>
                                            <div class="col-5">
                                                <input type="text" class="form-control" name="specs[{{ $loop->index }}][value]" placeholder="Value" value="{{ $value }}">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-outline-danger remove-spec">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="deal_enabled" name="deal_enabled" value="1" {{ old('deal_enabled', $product->deal_enabled) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="deal_enabled">Enable Deal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="deal_start" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="deal_start" name="deal_start" value="{{ old('deal_start', $product->deal_start?->format('Y-m-d')) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="deal_end" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="deal_end" name="deal_end" value="{{ old('deal_end', $product->deal_end?->format('Y-m-d')) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQs -->
                        <div class="card" id="faqs-section">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Product FAQs</h5>
                                <button type="button" class="btn btn-sm btn-primary" id="add-faq">
                                    <i class="fa fa-plus"></i> Add FAQ
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="faqs-container">
                                    @forelse($product->faqs as $index => $faq)
                                    <div class="row mb-3 faq-row border-bottom pb-3">
                                        <div class="col-md-11">
                                            <div class="mb-2">
                                                <label class="form-label">Question</label>
                                                <input type="text" class="form-control" name="faqs[{{ $index }}][question]" value="{{ $faq->question }}" placeholder="Enter question" required>
                                            </div>
                                            <div>
                                                <label class="form-label">Answer</label>
                                                <textarea class="form-control" name="faqs[{{ $index }}][answer]" rows="2" placeholder="Enter answer" required>{{ $faq->answer }}</textarea>
                                            </div>
                                            <!-- Hidden ID for updating existing -->
                                            <input type="hidden" name="faqs[{{ $index }}][id]" value="{{ $faq->id }}">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                            <button type="button" class="btn btn-outline-danger remove-faq">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="text-center text-muted p-3" id="no-faqs-message">
                                        No FAQs added yet.
                                    </div>
                                    @endforelse
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
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Featured Product</label>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-1"></i> Update Product
                                    </button>
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center">Cancel</a>
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
                                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-0">
                                    <label for="video" class="form-label">Video URL</label>
                                    <input type="text" class="form-control" id="video" name="video" value="{{ old('video', $product->video) }}" placeholder="YouTube or video URL">
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
            <input type="hidden" name="variants[__INDEX__][id]" value="">
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
                    <select class="form-select variant-attr-{{ $attr->id }}" name="variants[__INDEX__][attributes][{{ $attr->id }}]">
                        <option value="">Select {{ $attr->name }}</option>
                        @foreach($attr->options as $option)
                            <option value="{{ $option->id }}">{{ $option->label ?: $option->value }}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">SKU</label>
                    <input type="text" class="form-control variant-sku" name="variants[__INDEX__][sku]" placeholder="Variant SKU">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Price <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control variant-price" name="variants[__INDEX__][price]" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Stock</label>
                    <input type="number" class="form-control variant-stock" name="variants[__INDEX__][stock]" value="0" min="0">
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
<script src="{{ asset('admin/assets/js/products.js') }}"></script>
<script>
$(function() {
    ProductForm.init({
        variantIndex: {{ $product->variants->count() }},
        specIndex: {{ $spec && $spec->specs ? count($spec->specs) : 0 }},
        faqIndex: {{ $product->faqs->count() }},
        existingImageCount: {{ $galleryImages->count() }},
        redirectUrl: "{{ route('products.index') }}",
        maxImages: 9
    });

    // Load existing variants (Specific to Edit View)
    @if($product->has_variants && $product->variants->count() > 0)
        @foreach($product->variants as $i => $variant)
        (function() {
            const template = $('#variant-template').html();
            const html = template.replace(/__INDEX__/g, {{ $i }});
            $('#variants-container').append(html);
            const $row = $('#variants-container .variant-row:last');
            $row.find('.variant-number').text({{ $i + 1 }});
            $row.find('input[name="variants[{{ $i }}][id]"]').val('{{ $variant->id }}');
            $row.find('.variant-sku').val('{{ $variant->sku }}');
            $row.find('.variant-price').val('{{ $variant->price }}');
            $row.find('.variant-stock').val('{{ $variant->stock }}');
            @foreach($variant->attributeValues as $attrVal)
            $row.find('.variant-attr-{{ $attrVal->attribute_id }}').val('{{ $attrVal->attribute_option_id }}');
            @endforeach
        })();
        @endforeach
    @endif
});
</script>
@endpush

