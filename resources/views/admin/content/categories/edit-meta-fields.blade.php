@extends('admin.layouts.master')
@section('page-title', 'Edit Category Meta Fields')

@push('admin-styles')
    <link href="{{ asset('admin/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('admin-content')
    <!-- Page content start -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('categories.update-meta-fields', $category->id) }}" enctype="multipart/form-data"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card shadow-lg border-0 mb-4">
                            <div
                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0"><i class="fa fa-plus-circle me-2"></i> Edit Category Meta Fields
                                    ({{ $category->name }})
                                </h3>
                            </div>

                            <div class="card-body p-4">
                                <div class="row g-3 mb-4">
                                    <h3>Meta Tags</h3>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Canonical</label>
                                        <input type="url" name="meta_fields[canonical]"
                                            value="{{ old('meta_fields.canonical', @$meta_fields['canonical']) }}"
                                            class="form-control" placeholder="Enter Meta Canonical">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Robots</label>
                                        <input type="text" name="meta_fields[robots]"
                                            value="{{ old('meta_fields.robots', @$meta_fields['robots']) }}"
                                            class="form-control" placeholder="Enter Meta Robots">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Keywords</label>
                                        <input type="text" name="meta_fields[keywords]"
                                            value="{{ old('meta_fields.keywords', @$meta_fields['keywords']) }}"
                                            class="form-control" placeholder="Enter Meta Keywords">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Description</label>
                                        <textarea name="meta_fields[description]" class="form-control" placeholder="Enter Meta Description" rows="3"
                                            cols="3">{{ old('meta_fields.description', @$meta_fields['description']) }}</textarea>
                                    </div>
                                    <h3>Open Graph Links</h3>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="open_graph_fields[title]"
                                            value="{{ old('open_graph_fields.title', @$open_graph_fields['title']) }}"
                                            class="form-control" placeholder="Enter graph title">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Type</label>
                                        <input type="text" name="open_graph_fields[type]"
                                            value="{{ old('open_graph_fields.type', @$open_graph_fields['type']) }}"
                                            class="form-control" placeholder="Enter graph type">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Image</label>
                                        <input type="url" name="open_graph_fields[image]"
                                            value="{{ old('open_graph_fields.image', @$open_graph_fields['image']) }}"
                                            class="form-control" placeholder="Enter graph image">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Url</label>
                                        <input type="url" name="open_graph_fields[url]"
                                            value="{{ old('open_graph_fields.url', @$open_graph_fields['url']) }}"
                                            class="form-control" placeholder="Enter graph url">
                                    </div>
                                    <h3>Twitter Cards Links</h3>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Card</label>
                                        <input type="text" name="twitter_cards[card]"
                                            value="{{ old('twitter_cards.card', @$twitter_cards['card']) }}"
                                            class="form-control" placeholder="Enter card summary">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Site</label>
                                        <input type="text" name="twitter_cards[site]"
                                            value="{{ old('twitter_cards.site', @$twitter_cards['site']) }}"
                                            class="form-control" placeholder="Enter card site">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="twitter_cards[title]"
                                            value="{{ old('twitter_cards.title', @$twitter_cards['title']) }}"
                                            class="form-control" placeholder="Enter card title">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="twitter_cards[description]"
                                            value="{{ old('twitter_cards.description', @$twitter_cards['description']) }}"
                                            class="form-control" placeholder="Enter card description">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Image</label>
                                        <input type="url" name="twitter_cards[image]"
                                            value="{{ old('twitter_cards.image', @$twitter_cards['image']) }}"
                                            class="form-control" placeholder="Enter card image">
                                    </div>
                                    <h3>Schemas</h3>
                                    <div class="mb-3">
                                        <textarea name="schemas" class="form-control" cols="5" rows="5" placeholder="Enter Schema">{{ old('schemas', $category->schemas) }}</textarea>
                                        @error('schemas')
                                            <div class="font-small-2 mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('categories.index') }}"
                                        class="btn btn-light d-inline-flex align-items-center px-4">
                                        <i class="fa fa-times me-2"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fa fa-save me-2"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content end -->
@endsection

@push('admin-scripts')
    <script src="{{ asset('admin/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom/index.js') }}"></script>
@endpush
