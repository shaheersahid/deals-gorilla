@extends('admin.layouts.master')
@section('page-title', 'Products')

@push('admin-styles')
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        @media (max-width: 768px) {
            .dt-responsive.nowrap {
                white-space: normal !important;
            }
            #products-table img {
                width: 40px !important;
                height: 40px !important;
            }
            .badge {
                padding: 0.35em 0.5em !important;
                font-size: 0.75rem !important;
            }
        }
        /* Custom styling for the responsive expand button */
        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control:before {
            background-color: #556ee6 !important;
            border: none !important;
            box-shadow: none !important;
        }
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }
        .select2-container .select2-selection--multiple {
            min-height: 38px;
        }
        .select2-container .select2-search--inline .select2-search__field {
            margin-top: 10px;
        }
    </style>
@endpush

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">


            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Category</label>
                                    <select id="filter-category" class="form-select">
                                        <option value="">All Categories</option>
                                        @foreach(\App\Models\Category::where('is_active', true)->get() as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Brand</label>
                                    <select id="filter-brand" class="form-select select2" multiple="multiple" data-placeholder="All Brands">
                                        <option value="all" selected>All Brands</option>
                                        @foreach(\App\Models\Brand::orderBy('name')->get() as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Stock Status</label>
                                    <select id="filter-stock" class="form-select">
                                        <option value="">All</option>
                                        <option value="in_stock">In Stock</option>
                                        <option value="out_of_stock">Out of Stock</option>
                                        <option value="low_stock">Low Stock (&lt;10)</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Deal Status</label>
                                    <select id="filter-deal" class="form-select">
                                        <option value="">All</option>
                                        <option value="on_deal">On Deal</option>
                                        <option value="no_deal">No Deal</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Status</label>
                                    <select id="filter-status" class="form-select">
                                        <option value="">All</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="button" id="reset-filters" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-redo me-1"></i> Reset Filters
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Products</h4>
                            <a href="{{ route('products.create') }}" class="btn btn-primary d-inline-flex align-items-center">
                                <i class="fa fa-plus-circle me-1"></i> Add New Product</a>
                        </div>
                        <div class="card-body">
                            <table id="products-table" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product Details</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Price Range</th>
                                        <th>Stock</th>
                                        <th>Deal</th>
                                        <th style="width: 80px;">Featured</th>
                                        <th style="width: 80px;">Active</th>
                                        <th>Created At</th>
                                        <th style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var brandSelect = $('#filter-brand');
            brandSelect.select2({
                placeholder: "All Brands",
                allowClear: true,
                width: '100%'
            });

            // Smart Multi-Select Logic
            brandSelect.on('select2:select', function (e) {
                var selectedValue = e.params.data.id;
                var currentValues = brandSelect.val(); // array of strings

                if (selectedValue === 'all') {
                    // User clicked "All Brands". Clear any other selections.
                    if (currentValues.length > 1) {
                        brandSelect.val(['all']).trigger('change');
                    }
                } else {
                    // User clicked a specific brand.
                    // If "all" is currently in the list, remove it.
                    if (currentValues.includes('all')) {
                        var newValues = currentValues.filter(v => v !== 'all');
                        brandSelect.val(newValues).trigger('change');
                    }
                }
                table.draw(); // Trigger table redraw
            });
            
            // Also redraw on unselect
            brandSelect.on('select2:unselect', function (e) {
                 if (brandSelect.val().length === 0) {
                     brandSelect.val(['all']).trigger('change');
                 }
                 table.draw();
            });

            var table = $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('products.index') }}",
                    data: function(d) {
                        d.category_id = $('#filter-category').val();
                        d.category_id = $('#filter-category').val();
                        d.brand_id = $('#filter-brand').val(); // This will now be an array
                        d.stock_status = $('#filter-stock').val();
                        d.deal_status = $('#filter-deal').val();
                        d.status = $('#filter-status').val();
                    }
                },
                columns: [
                    { data: 'name', name: 'name', responsivePriority: 2 },
                    { data: 'brand_name', name: 'brand_name', orderable: false, searchable: false, responsivePriority: 4 },
                    { data: 'category_name', name: 'category_name', orderable: false, searchable: false, responsivePriority: 4 },
                    { data: 'price_display', name: 'price', searchable: false, responsivePriority: 3 },
                    { data: 'stock_display', name: 'stock', responsivePriority: 5, className: 'text-center' },
                    { data: 'deal', name: 'deal', orderable: false, searchable: false, responsivePriority: 6, className: 'text-center' },
                    { data: 'featured', name: 'featured', orderable: false, searchable: false, responsivePriority: 7, className: 'text-center' },
                    { data: 'status', name: 'status', orderable: false, searchable: false, responsivePriority: 8, className: 'text-center' },
                    { data: 'created_at', name: 'created_at', visible: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, responsivePriority: 0, className: 'text-center' },
                ],
                order: [[8, 'desc']]
            });

            // Toggle Status/Featured
            $(document).on('change', '.toggle-status', function() {
                var id = $(this).data('id');
                var type = $(this).data('type');
                var value = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('products.toggle-status') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        type: type,
                        value: value
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                            table.draw(false);
                        }
                    },
                    error: function() {
                        toastr.error('Something went wrong!');
                        table.draw(false);
                    }
                });
            });

            // Filter event listeners
            $('#filter-category, #filter-brand, #filter-stock, #filter-deal, #filter-status').on('change', function() {
                table.draw();
            });

            // Reset filters
            $('#reset-filters').on('click', function() {
                $('#filter-category, #filter-stock, #filter-deal, #filter-status').val('');
                $('#filter-brand').val(['all']).trigger('change'); // Reset Select2 to All
                table.draw();
            });
        });
    </script>
@endpush