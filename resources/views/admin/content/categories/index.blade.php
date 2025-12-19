@extends('admin.layouts.master')
@section('page-title', 'Categories')

@push('admin-styles')
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
@endpush

@section('admin-content')
    <!-- start Page content -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Categories</h4>
                            <a href="{{ route('categories.create') }}" class="btn btn-primary d-inline-flex align-items-center">
                                <i class="fa fa-plus-circle me-1"></i> Add New Category</a>
                        </div>
                        <div class="card-body">
                            <table id="categories-table"
                                class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Parent Category</th>
                                        <th>Total Products</th>
                                        <th>Shown on Home</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page content -->
@endsection

@push('admin-scripts')
    <script src="{{ asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'parentCategory',
                        name: 'parentCategory'
                    },
                    {
                        data: 'totalProducts',
                        name: 'totalProducts'
                    },
                    {
                        data: 'homepage',
                        name: 'homepage',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // Toggle Status/Homepage
            $(document).on('change', '.toggle-status', function() {
                var id = $(this).data('id');
                var type = $(this).data('type');
                var value = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('categories.toggle-status') }}",
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
                    error: function(xhr) {
                         let message = 'Something went wrong!';
                         if(xhr.responseJSON && xhr.responseJSON.message) {
                             message = xhr.responseJSON.message;
                         }
                        toastr.error(message);
                        table.draw(false);
                    }
                });
            });

        });
    </script>
@endpush
