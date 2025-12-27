<!-- ========== Left Sidebar Start ========== -->
<div class="sidebar-left">
    <div data-simplebar class="h-100">
        <!--- Sidebar-menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="left-menu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">Products</li>
                <li
                    class="{{ in_array(Route::currentRouteName(), ['products.index', 'products.create', 'products.edit']) ? 'mm-active' : '' }}">
                    <a href="{{ route('products.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['products.index', 'products.create', 'products.edit']) ? 'active' : '' }}">
                        <i class="fa fa-apple-alt"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li
                    class="{{ in_array(Route::currentRouteName(), ['categories.index', 'categories.create', 'categories.edit']) ? 'mm-active' : '' }}">
                    <a href="{{ route('categories.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['categories.index', 'categories.create', 'categories.edit']) ? 'active' : '' }}">
                        <i class="fa fa-shapes"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li
                    class="{{ in_array(Route::currentRouteName(), ['brands.index', 'brands.create', 'brands.edit']) ? 'mm-active' : '' }}">
                    <a href="{{ route('brands.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['brands.index', 'brands.create', 'brands.edit']) ? 'active' : '' }}">
                        <i class="fa fa-tag"></i>
                        <span>Brands</span>
                    </a>
                </li>
                <li
                    class="{{ in_array(Route::currentRouteName(), ['attributes.index', 'attributes.create', 'attributes.edit']) ? 'mm-active' : '' }}">
                    <a href="{{ route('attributes.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['attributes.index', 'attributes.create', 'attributes.edit']) ? 'active' : '' }}">
                        <i class="fa fa-sliders-h"></i>
                        <span>Attributes</span>
                    </a>
                </li>
                <li
                    class="{{ in_array(Route::currentRouteName(), ['collections.index', 'collections.create', 'collections.edit']) ? 'mm-active' : '' }}">
                    <a href="{{ route('collections.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['collections.index', 'collections.create', 'collections.edit']) ? 'active' : '' }}">
                        <i class="fa fa-layer-group"></i>
                        <span>Collections</span>
                    </a>
                </li>
                <li class="{{ in_array(Route::currentRouteName(), ['orders.index', 'orders.show']) ? 'mm-active' : '' }}">
                    <a href="{{ route('orders.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['orders.index', 'orders.show']) ? 'active' : '' }}">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="menu-title">Customers</li>
                <li class="{{ in_array(Route::currentRouteName(), ['customers.index']) ? 'mm-active' : '' }}">
                    <a href="{{ route('customers.index') }}"
                        class="{{ in_array(Route::currentRouteName(), ['customers.index']) ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li class="menu-title">Account</li>
                <li class="{{ in_array(Route::currentRouteName(), ['admin.profile.index']) ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.profile.index') }}" class="{{ in_array(Route::currentRouteName(), ['admin.profile.index']) ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
