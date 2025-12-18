@extends('admin.layouts.master')
@section('page-title', 'Manage Product FAQs - ' . $product->name)

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col">
                    <h4 class="mb-0">Manage FAQs: {{ $product->name }}</h4>
                    <p class="text-muted">Add frequently asked questions about this product</p>
                </div>
                <div class="col-auto">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Back to Products
                    </a>
                </div>
            </div>

            <form action="{{ route('products.faqs.store', $product) }}" method="POST">
                @csrf

                <div class="card">
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
                                        <label class="form-label">Question <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="faqs[{{ $index }}][question]" value="{{ $faq->question }}" placeholder="Enter question" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="faqs[{{ $index }}][answer]" rows="2" placeholder="Enter answer" required>{{ $faq->answer }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                    <button type="button" class="btn btn-outline-danger remove-faq">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-muted p-3" id="no-faqs-message">
                                No FAQs added yet. Click "Add FAQ" to create one.
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-1"></i> Save FAQs
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- FAQ Template -->
    <template id="faq-template">
        <div class="row mb-3 faq-row border-bottom pb-3">
            <div class="col-md-11">
                <div class="mb-2">
                    <label class="form-label">Question <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="faqs[__INDEX__][question]" placeholder="Enter question" required>
                </div>
                <div>
                    <label class="form-label">Answer <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="faqs[__INDEX__][answer]" rows="2" placeholder="Enter answer" required></textarea>
                </div>
            </div>
            <div class="col-md-1 d-flex align-items-center justify-content-center">
                <button type="button" class="btn btn-outline-danger remove-faq">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </template>
@endsection

@push('admin-scripts')
<script>
$(function() {
    let faqIndex = {{ $product->faqs->count() }};

    // Add FAQ
    $('#add-faq').on('click', function() {
        const template = $('#faq-template').html();
        const html = template.replace(/__INDEX__/g, faqIndex);
        $('#faqs-container').append(html);
        $('#no-faqs-message').remove();
        faqIndex++;
    });

    // Remove FAQ
    $(document).on('click', '.remove-faq', function() {
        $(this).closest('.faq-row').remove();
        if ($('.faq-row').length === 0) {
            $('#faqs-container').html('<div class="text-center text-muted p-3" id="no-faqs-message">No FAQs added yet. Click "Add FAQ" to create one.</div>');
        }
    });
});
</script>
@endpush
