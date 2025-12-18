@extends('admin.layouts.master')
@section('page-title', 'Attributes')

@push('admin-styles')
    <link href="{{ asset('admin/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('admin-content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Attributes</h4>
                            <a href="{{ route('attributes.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-1"></i> Add Attribute
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="attributes-table" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Options</th>
                                        <th>Variant</th>
                                        <th>Actions</th>
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
    <script src="{{ asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#attributes-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('attributes.index') }}",
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'type_badge', name: 'type' },
                    { data: 'category_name', name: 'category_name' },
                    { data: 'options_count', name: 'options_count', orderable: false, searchable: false },
                    { data: 'variant', name: 'variant', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endpush