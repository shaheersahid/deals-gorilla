@extends('admin.layouts.master')
@section('page-title', 'Dashboard')
@section('admin-content')
    <!-- Start page Content here -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fs-16 fw-semibold mb-1 mb-md-2">Good Morning, <span class="text-primary">{{ auth()->user()->name }}!</span></h4>
                            <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Clivax</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!--    end row -->

            <div class="row">
                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-cart-plus fs-14 text-muted"></i>
                            </div>
                            <h4 class="card-title mb-0">Overall Sales</h4>
                            <div class="dropdown card-addon">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-sidebar"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Total sales</p>
                                            <h5 class="mb-0">${{ number_format($totalSales, 2) }}</h5>
                                        </div>
                                        <div class="text-success float-end">
                                            <i class="mdi mdi-menu-up"> </i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Latest sales</p>
                                            <h5 class="mb-0">$34,254</h5>
                                        </div>
                                        <div class="text-success float-end">
                                            <i class="mdi mdi-menu-up"> </i>2.1%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Last sales</p>
                                            <h5 class="mb-0">$32,695</h5>
                                        </div>
                                        <div class="text-success float-end">
                                            <i class="mdi mdi-menu-up"> </i>1.8%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="sales_figures" data-colors='["--bs-info", "--bs-success"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card bg-danger-subtle" style="background: url('assets/images/dashboard/dashboard-shape-1.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="avatar avatar-sm avatar-label-danger">
                                            <i class="mdi mdi-buffer mt-1"></i>
                                        </div>
                                        <div class="ms-3">
                                            <p class="text-danger mb-1">Total Products</p>
                                            <h4 class="mb-0">{{ $totalProducts }}</h4>
                                        </div>
                                    </div>
                                    <div class="hstack gap-2 mt-3">
                                        <button class="btn btn-light">Transfer</button>
                                        <button class="btn btn-info">Request</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card bg-success-subtle" style="background: url('assets/images/dashboard/dashboard-shape-2.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="avatar avatar-sm avatar-label-success">
                                            <i class="mdi mdi-cart-outline mt-1"></i>
                                        </div>
                                        <div class="ms-3">
                                            <p class="text-success mb-1">Total Orders</p>
                                            <h4 class="mb-0">{{ $totalOrders }}</h4>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-2">
                                        <p class="mb-0">4 not confirmed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card bg-info-subtle" style="background: url('assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="avatar avatar-sm avatar-label-info">
                                            <i class="mdi mdi-account-group mt-1"></i>
                                        </div>
                                        <div class="ms-3">
                                            <p class="text-info mb-1">Total Customers</p>
                                            <h4 class="mb-0">{{ $totalCustomers }}</h4>
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-2">
                                        <p class="mb-0"><span class="text-primary me-2 fs-14"><i class="fas fa-caret-up me-1"></i>3.4%</span>vs last month</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-hockey-puck fs-14 text-muted"></i>
                                    </div>
                                    <h4 class="card-title mb-0">Sales by product category</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            @foreach($salesByCategory as $category)
                                            <div class="mb-2">
                                                <p>
                                                    <i class="mdi mdi-checkbox-blank-circle text-primary me-2"></i>
                                                    {{ $category->category }} 
                                                    <span class="text-muted fs-14 float-end">${{ number_format($category->total, 2) }}</span>
                                                </p>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="col-sm-6">
                                            <div>
                                                <div id="gradient_chart" data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-danger", "--bs-info", "--bs-dark", "--bs-purple", "--bs-orange"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="height: 495px; overflow: hidden auto;" data-simplebar="init">
                                <div class="card-header">
                                    <div class="card-icon text-muted"><i class="fas fa-sync-alt fs-14"></i></div>
                                    <h3 class="card-title">Order Progress</h3>
                                    <div class="card-addon dropdown">
                                        <button class="btn btn-label-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown"> <i class="fas fa-filter fs-12 align-middle ms-1"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                            <a class="dropdown-item" href="#">
                                                <div class="dropdown-icon"><i class="fa fa-poll"></i></div>
                                                <span class="dropdown-content">Today</span>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <div class="dropdown-icon"><i class="fa fa-chart-pie"></i></div>
                                                <span class="dropdown-content">Yesterday</span>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <div class="dropdown-icon"><i class="fa fa-chart-line"></i></div>
                                                <span class="dropdown-content">Week</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive-md">
                                        <table class="table text-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Status</th>
                                                    <th>Customer</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($recentOrders as $order)
                                                <tr>
                                                    <td class="align-middle">
                                                        <a href="{{ route('orders.show', $order) }}">#{{ $order->order_number }}</a>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span class="badge bg-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        @if($order->user)
                                                            {{ $order->user->name }}
                                                        @else
                                                            <span class="text-muted">Guest</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">${{ number_format($order->total_amount, 2) }}</td>
                                                    <td class="align-middle">{{ $order->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No recent orders found.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="row">
                        <div class="col-xxl-12 col-xl-6 order-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-end">
                                        <select class="form-select form-select-sm">
                                            <option selected>Apr</option>
                                            <option value="1">Mar</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Jan</option>
                                        </select>
                                    </div>
                                    <h4 class="card-title mb-4">Sales Analytics</h4>
                                    <div id="pattern_chart" data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-danger", "--bs-info"]' class="apex-charts" dir="ltr"></div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="text-center mt-4">
                                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary font-size-10 me-1"></i> Product A</p>
                                                <h5>42 %</h5>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-center mt-4">
                                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-success font-size-10 me-1"></i> Product B</p>
                                                <h5>26 %</h5>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="text-center mt-4">
                                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-warning font-size-10 me-1"></i> Product C</p>
                                                <h5>42 %</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 order-4 order-xxl-2">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-icon text-muted"><i class="fa fa-bell"></i></div>
                                    <h3 class="card-title">Notification</h3>
                                    <div class="card-addon">
                                        <div class="dropdown">
                                            <button class="btn btn-sm py-0 btn-label-primary dropdown-toggle" data-bs-toggle="dropdown">All <i class="mdi mdi-chevron-down fs-17 align-middle ms-1"></i></button>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                                <a class="dropdown-item" href="#"><span class="badge badge-label-primary">Personal</span> </a>
                                                <a class="dropdown-item" href="#"><span class="badge badge-label-info">Work</span> </a>
                                                <a class="dropdown-item" href="#"><span class="badge badge-label-success">Important</span> </a>
                                                <a class="dropdown-item" href="#"><span class="badge badge-label-danger">Company</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="rich-list rich-list-bordered rich-list-action">
                                        <div class="rich-list-item">
                                            <div class="rich-list-prepend">
                                                <div class="avatar avatar-xs avatar-label-info">
                                                    <div class=""><i class="fa fa-file-invoice"></i></div>
                                                </div>
                                            </div>
                                            <div class="rich-list-content">
                                                <h4 class="rich-list-title mb-1">New report has been received</h4>
                                                <p class="rich-list-subtitle mb-0">2 min ago</p>
                                            </div>
                                            <div class="rich-list-append">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-label-secondary btn-icon" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h fs-12"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                                        <a class="dropdown-item" href="#">
                                                            <div class="dropdown-icon"><i class="fa fa-check"></i></div>
                                                            <span class="dropdown-content">Mark as read</span>
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <div class="dropdown-icon"><i class="fa fa-trash-alt"></i></div>
                                                            <span class="dropdown-content">Delete</span>
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">
                                                            <div class="dropdown-icon"><i class="fa fa-cog"></i></div>
                                                            <span class="dropdown-content">Settings</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rich-list-item">
                                            <div class="rich-list-prepend">
                                                <div class="avatar avatar-xs avatar-label-success">
                                                    <div class=""><i class="fa fa-shopping-basket"></i></div>
                                                </div>
                                            </div>
                                            <div class="rich-list-content">
                                                <h4 class="rich-list-title mb-1">Last order was completed</h4>
                                                <p class="rich-list-subtitle mb-0">1 hrs ago</p>
                                            </div>
                                            <div class="rich-list-append">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-label-secondary btn-icon" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h fs-12"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                                        <a class="dropdown-item" href="#">
                                                            <div class="dropdown-icon"><i class="fa fa-check"></i></div>
                                                            <span class="dropdown-content">Mark as read</span>
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <div class="dropdown-icon"><i class="fa fa-trash-alt"></i></div>
                                                            <span class="dropdown-content">Delete</span>
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">
                                                            <div class="dropdown-icon"><i class="fa fa-cog"></i></div>
                                                            <span class="dropdown-content">Settings</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rich-list-item">
                                            <div class="rich-list-prepend">
                                                <div class="avatar avatar-xs avatar-label-danger">
                                                    <div class=""><i class="fa fa-users"></i></div>
                                                </div>
                                            </div>
                                            <div class="rich-list-content">
                                                <h4 class="rich-list-title mb-1">Company meeting canceled</h4>
                                                <p class="rich-list-subtitle mb-0">5 hrs ago</p>
                                            </div>
                                            <div class="rich-list-append">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-label-secondary btn-icon" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h fs-12"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                                        <a class="dropdown-item" href="#">
                                                            <div class="dropdown-icon"><i class="fa fa-check"></i></div>
                                                            <span class="dropdown-content">Mark as read</span>
                                                        </a>
                                                        <a class="dropdown-item" href="#">
                                                            <div class="dropdown-icon"><i class="fa fa-trash-alt"></i></div>
                                                            <span class="dropdown-content">Delete</span>
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">
                                                            <div class="dropdown-icon"><i class="fa fa-cog"></i></div>
                                                            <span class="dropdown-content">Settings</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 order-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Compaign Earnings</h4>
                                    <div class="dropdown card-addon">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-sidebar"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <div class="mb-3">
                                            <div id="semi_donut_chart" data-colors='["--bs-primary", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
                                        </div>

                                        <div class="row justify-content-center mt-n5">
                                            <div class="col-6">
                                                <div class="p-2 shadow">
                                                    <p class="text-muted text-truncate mb-2">Earnings</p>
                                                    <h5 class="mb-0">$15.5k <span class="fs-12 text-primary ms-2"><i class="mdi mdi-arrow-up"></i> 17%</span></h5>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="p-2 shadow">
                                                    <p class="text-muted text-truncate mb-2">Expenses</p>
                                                    <h5 class="mb-0">$11.4k <span class="fs-12 text-danger ms-2"><i class="mdi mdi-arrow-down"></i> 14%</span></h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div id="bar_chart" data-colors='["--bs-danger"]' class="apex-charts" dir="ltr"></div>
                                        </div>

                                        <div class="card" style="background: url('assets/images/widgets-shape2.png'); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                            <div class="bg-overlay bg-primary-subtle rounded"></div>
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-7">
                                                        <h4 class="fs-16 mb-1">Need more idea? </h4>
                                                        <p class="text-muted mb-0">Upgrade to pro max for added benefits.</p>
                                                        <button class="btn btn-primary mt-4">Upgarde Now</button>
                                                    </div>
                                                    <div class="col-5">
                                                        <img src="assets/images/dashboard/upgarde-1.png" alt="" class="img-fluid" style="height: 126px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-xl-6 order-2 order-xxl-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fas fa-calendar-alt fs-14 text-muted"></i>
                                    </div>
                                    <h4 class="card-title mb-0">Monthly Sales</h4>
                                </div>
                                <div class="card-body">
                                    <div id="monthly_states" data-colors='["--bs-success", "--bs-danger", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xxl-8 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-layer-group fs-14 text-muted"></i>
                            </div>
                            <h4 class="card-title mb-0">Top Selling</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-sm-8">
                                    <div id="products" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-centered table-nowrap mb-0">
                                            <tbody>
                                                @foreach($topSellingProducts as $product)
                                                <tr>
                                                    <td style="width: 20px;">
                                                        @php
                                                            $thumb = null;
                                                            if($product->images && $product->images->isNotEmpty()) {
                                                                $thumb = $product->images->where('is_primary', 1)->first();
                                                                if(!$thumb) $thumb = $product->images->first();
                                                            }
                                                        @endphp
                                                        @if($thumb && $thumb->thumb_path)
                                                            <img src="{{ Storage::url($thumb->thumb_path) }}" class="avatar-sm rounded-circle" alt="">
                                                        @else
                                                            <div class="avatar-sm d-flex align-items-center justify-content-center bg-light rounded-circle text-primary">
                                                                <i class="fas fa-box"></i>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <h6 class="font-size-15 mb-1 fw-normal">{{ $product->name }}</h6>
                                                    </td>
                                                    <td class="text-muted fw-semibold text-end">
                                                        <i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>
                                                        {{ $product->total_sold }} sold
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">

                <div class="col-xl-6">
                    <div class="card" style="height: 416px; overflow: hidden auto;" data-simplebar="init">
                        <div class="card-header card-header-bordered">
                            <div class="card-icon text-muted"><i class="fa fa-user-tag fs14"></i></div>
                            <h3 class="card-title">Recent Customers</h3>
                        </div>
                        <div class="card-body">
                            <div class="rich-list rich-list-flush">
                                @forelse($newCustomers as $user)
                                <div class="rich-list-item">
                                    <div class="rich-list-prepend">
                                        <div class="avatar avatar-xs">
                                            @if($user->avatar)
                                                <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="avatar-2xs rounded-circle" />
                                            @else
                                                <div class="avatar-2xs rounded-circle bg-primary text-white d-flex align-items-center justify-content-center">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="rich-list-content">
                                        <h4 class="rich-list-title mb-1">{{ $user->name }}</h4>
                                        <p class="rich-list-subtitle mb-0">{{ $user->email }}</p>
                                    </div>
                                    <div class="rich-list-append">
                                        <span class="text-muted">{{ $user->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                @empty
                                    <p class="text-center text-muted">No recent customers.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@push('admin-scripts')
    <script src="{{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        function getChartColorsArray(e) {
            if (null !== document.getElementById(e)) {
                var t = document.getElementById(e).getAttribute("data-colors");
                if (t) return (t = JSON.parse(t)).map(function(e) {
                    var t = e.replace(" ", "");
                    if (-1 === t.indexOf(",")) {
                        var o = getComputedStyle(document.documentElement).getPropertyValue(t);
                        return o || t
                    }
                    var r = e.split(",");
                    return 2 != r.length ? t : "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(r[0]) + "," + r[1] + ")"
                })
            }
        }

        // Sales by Category Chart
        var chartPieGradientColors = getChartColorsArray("gradient_chart");
        if (chartPieGradientColors) {
            var categories = @json($salesByCategory->pluck('category'));
            var totals = @json($salesByCategory->pluck('total'));
            
            var options = {
                series: totals,
                chart: {
                    height: 250,
                    type: "donut"
                },
                labels: categories,
                plotOptions: {
                    pie: {
                        startAngle: -90,
                        endAngle: 270
                    }
                },
                stroke: {
                    width: 5,
                    colors: ["#fff"]
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: "gradient"
                },
                legend: {
                    show: false
                },
                colors: chartPieGradientColors
            };
            (chart = new ApexCharts(document.querySelector("#gradient_chart"), options)).render();
        }

        // Monthly Sales Chart
        var chartNagetiveValuesColors = getChartColorsArray("monthly_states");
        if (chartNagetiveValuesColors) {
            var months = @json($monthlySales->pluck('month'));
            var monthlyTotals = @json($monthlySales->pluck('total'));

            var options = {
                series: [{
                    name: "Sales",
                    data: monthlyTotals
                }],
                chart: {
                    type: "bar",
                    height: 228,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        colors: {
                            ranges: [{
                                from: 0,
                                to: 1000000,
                                color: chartNagetiveValuesColors[0]
                            }]
                        },
                        columnWidth: "60%"
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: chartNagetiveValuesColors[0], // Use primary color
                yaxis: {
                    labels: {
                        formatter: function(e) {
                            return "$" + e.toFixed(0);
                        }
                    }
                },
                xaxis: {
                    type: "category",
                    categories: months,
                    labels: {
                        rotate: -90
                    }
                }
            };
            (chart = new ApexCharts(document.querySelector("#monthly_states"), options)).render();
        }
    </script>
@endpush