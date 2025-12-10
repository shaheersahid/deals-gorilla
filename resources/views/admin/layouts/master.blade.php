<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.header')
</head>

<body>
    <div id="layout-wrapper">
        @include('admin.layouts.topbar')
        @include('admin.layouts.sidebar')
        <div class="main-content">
            @yield('admin-content')
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Toast Messages start-->
    <div style="z-index: 1111" class="position-fixed top-0 end-0 p-3">
        <div id="successToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="align-items-center text-white bg-success border-0">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <div style="z-index: 1111" class="position-fixed top-0 end-0 p-3">
        <div id="errorToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="align-items-center text-white bg-danger border-0">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Toast Messages end-->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
    @stack('admin-scripts')

    @if (session('message') || session('error'))
        <script>
            const toastType = "{{ session('message') ? 'successToast' : 'errorToast' }}";
            const toastElement = document.getElementById(toastType);
            const toastBody = toastElement.querySelector('.toast-body');
            toastBody.textContent = "{{ session('message') ?? session('error') }}";
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        </script>
    @endif

    <!-- Sweet Alerts js -->
    <script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document.body).on("click", ".del_confirm", function(e) {
            var form = $(this).find("form");
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed3ca3",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed === true) form.submit();
            });
        });
    </script>
    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
</body>

</html>
