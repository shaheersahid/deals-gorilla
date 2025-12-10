@extends('admin.layouts.master')
@section('page-title', 'Create Attribute')

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Create Attribute</h5>
                            <a href="{{ route('attributes.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('attributes.store') }}" method="POST" id="attribute-form">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Attribute Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Size, Color, Material" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Auto-generated">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                            <option value="select" {{ old('type') == 'select' ? 'selected' : '' }}>Select (Dropdown)</option>
                                            <option value="color" {{ old('type') == 'color' ? 'selected' : '' }}>Color (Swatches)</option>
                                            <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text (Free input)</option>
                                            <option value="number" {{ old('type') == 'number' ? 'selected' : '' }}>Number</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                            <option value="">All Categories</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Leave empty for global attribute</small>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_variant" name="is_variant" value="1" {{ old('is_variant') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_variant">Use for Variants</label>
                                        </div>
                                        <small class="text-muted">Size, Color for product variants</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_filterable" name="is_filterable" value="1" {{ old('is_filterable', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_filterable">Filterable</label>
                                        </div>
                                        <small class="text-muted">Show in product filters</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_visible" name="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_visible">Visible</label>
                                        </div>
                                        <small class="text-muted">Show on product page</small>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="mb-3">Attribute Options</h6>
                                <p class="text-muted small">Add predefined options for this attribute (for select/color types)</p>
                                
                                <div id="options-container">
                                    <!-- Options will be added here -->
                                </div>

                                <button type="button" class="btn btn-sm btn-outline-primary mb-4" id="add-option">
                                    <i class="fa fa-plus me-1"></i> Add Option
                                </button>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-1"></i> Create Attribute
                                    </button>
                                    <a href="{{ route('attributes.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Common Attributes</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small">Examples of attributes for different product types:</p>
                            <ul class="mb-0">
                                <li><strong>Fashion:</strong> Size, Color, Material, Style</li>
                                <li><strong>Electronics:</strong> Storage, RAM, Screen Size, Color</li>
                                <li><strong>Cosmetics:</strong> Shade, Finish, Skin Type</li>
                                <li><strong>Furniture:</strong> Material, Color, Dimensions</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="option-template">
        <div class="option-row row mb-2">
            <div class="col-4">
                <input type="text" class="form-control" name="options[__INDEX__][value]" placeholder="Value (e.g. S, M, L)">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" name="options[__INDEX__][label]" placeholder="Label (optional)">
            </div>
            <div class="col-3">
                <input type="text" class="form-control color-code" name="options[__INDEX__][color_code]" placeholder="#HEX (for colors)">
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-outline-danger remove-option">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </template>
@endsection

@push('admin-scripts')
<script>
$(function() {
    let optionIndex = 0;

    $('#add-option').on('click', function() {
        const template = $('#option-template').html();
        const html = template.replace(/__INDEX__/g, optionIndex);
        $('#options-container').append(html);
        optionIndex++;
    });

    $(document).on('click', '.remove-option', function() {
        $(this).closest('.option-row').remove();
    });

    // Add first option by default
    $('#add-option').click();
});
</script>
@endpush
