@extends('admin.layouts.master')
@section('page-title', 'Edit Attribute')

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Edit Attribute: {{ $attribute->name }}</h5>
                            <a href="{{ route('attributes.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('attributes.update', $attribute) }}" method="POST" id="attribute-form">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Attribute Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $attribute->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $attribute->slug) }}">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                            <option value="select" {{ old('type', $attribute->type) == 'select' ? 'selected' : '' }}>Select (Dropdown)</option>
                                            <option value="color" {{ old('type', $attribute->type) == 'color' ? 'selected' : '' }}>Color (Swatches)</option>
                                            <option value="text" {{ old('type', $attribute->type) == 'text' ? 'selected' : '' }}>Text (Free input)</option>
                                            <option value="number" {{ old('type', $attribute->type) == 'number' ? 'selected' : '' }}>Number</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                            <option value="">All Categories</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('category_id', $attribute->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_variant" name="is_variant" value="1" {{ old('is_variant', $attribute->is_variant) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_variant">Use for Variants</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_filterable" name="is_filterable" value="1" {{ old('is_filterable', $attribute->is_filterable) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_filterable">Filterable</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_visible" name="is_visible" value="1" {{ old('is_visible', $attribute->is_visible) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_visible">Visible</label>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="mb-3">Attribute Options</h6>
                                
                                <div id="options-container">
                                    @foreach($attribute->options as $i => $option)
                                    <div class="option-row row mb-2">
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="options[{{ $i }}][value]" value="{{ $option->value }}" placeholder="Value">
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="options[{{ $i }}][label]" value="{{ $option->getRawOriginal('label') }}" placeholder="Label">
                                        </div>
                                        <div class="col-3">
                                            <input type="text" class="form-control" name="options[{{ $i }}][color_code]" value="{{ $option->color_code }}" placeholder="#HEX">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-outline-danger remove-option">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-sm btn-outline-primary mb-4" id="add-option">
                                    <i class="fa fa-plus me-1"></i> Add Option
                                </button>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-1"></i> Update Attribute
                                    </button>
                                    <a href="{{ route('attributes.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="option-template">
        <div class="option-row row mb-2">
            <div class="col-4">
                <input type="text" class="form-control" name="options[__INDEX__][value]" placeholder="Value">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" name="options[__INDEX__][label]" placeholder="Label">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" name="options[__INDEX__][color_code]" placeholder="#HEX">
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
    let optionIndex = {{ $attribute->options->count() }};

    $('#add-option').on('click', function() {
        const template = $('#option-template').html();
        const html = template.replace(/__INDEX__/g, optionIndex);
        $('#options-container').append(html);
        optionIndex++;
    });

    $(document).on('click', '.remove-option', function() {
        $(this).closest('.option-row').remove();
    });
});
</script>
@endpush
