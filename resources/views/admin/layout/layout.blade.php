<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>@yield('admin-page-title', 'Admin Dashboard') | Ecommerce Admin</title>

    <link href="{{ asset('adminassets/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('admin') }}">
                    <span class="align-middle">Ecommerce Admin</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Main
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle"> admin Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Category
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.category.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.category.create') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 50 50">
                                <path d="M25,2C12.317,2,2,12.317,2,25s10.317,23,23,23s23-10.317,23-23S37.683,2,25,2z M37,26H26v11h-2V26H13v-2h11V13h2v11h11V26z"></path>
                            </svg>
                            <span class="align-middle">Create</span>
                        </a>

                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.category.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.category.manage') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 13C6.6 5 17.4 5 21 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12 17C10.3431 17 9 15.6569 9 14C9 12.3431 10.3431 11 12 11C13.6569 11 15 12.3431 15 14C15 15.6569 13.6569 17 12 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Subcategory
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.subcategory.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.subcategory.create') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 50 50">
                                <path d="M25,2C12.317,2,2,12.317,2,25s10.317,23,23,23s23-10.317,23-23S37.683,2,25,2z M37,26H26v11h-2V26H13v-2h11V13h2v11h11V26z"></path>
                            </svg>
                            <span class="align-middle">Create</span>
                        </a>

                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.subcategory.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.subcategory.manage') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 13C6.6 5 17.4 5 21 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12 17C10.3431 17 9 15.6569 9 14C9 12.3431 10.3431 11 12 11C13.6569 11 15 12.3431 15 14C15 15.6569 13.6569 17 12 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Product
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.product.manage_product') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.product.manage_product') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                            </svg>
                            <span class="align-middle">Manage Products</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.product.manage_product_review') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.product.manage_product_review') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <span class="align-middle">Product Reviews</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Product Attributes
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.product_attributes.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.product_attributes.create') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 50 50">
                                <path d="M25,2C12.317,2,2,12.317,2,25s10.317,23,23,23s23-10.317,23-23S37.683,2,25,2z M37,26H26v11h-2V26H13v-2h11V13h2v11h11V26z"></path>
                            </svg>
                            <span class="align-middle">Create</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.product_attributes.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.product_attributes.manage') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Discount
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.discount.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.discount.create') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 50 50">
                                <path d="M25,2C12.317,2,2,12.317,2,25s10.317,23,23,23s23-10.317,23-23S37.683,2,25,2z M37,26H26v11h-2V26H13v-2h11V13h2v11h11V26z"></path>
                            </svg>
                            <span class="align-middle">Create</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.discount.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.discount.manage') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="8" cy="21" r="2"></circle>
                                <circle cx="20" cy="21" r="2"></circle>
                                <path d="M5.67 6H23l-1.68 8.39a2 2 0 0 1-1.97 1.61H9.75a2 2 0 0 1-1.97-1.61L5.23 4H4"></path>
                            </svg>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Admin Management
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.setting') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.setting') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1 1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                            </svg>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.manage.user') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.manage.user') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span class="align-middle">Manage Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.manage.store') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.manage.store') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9,22 9,12 15,12 15,22"></polyline>
                            </svg>
                            <span class="align-middle">Manage Store</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.cart.history') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.cart.history') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="8" cy="21" r="2"></circle>
                                <circle cx="20" cy="21" r="2"></circle>
                                <path d="M5.67 6H23l-1.68 8.39a2 2 0 0 1-1.97 1.61H9.75a2 2 0 0 1-1.97-1.61L5.23 4H4"></path>
                            </svg>
                            <span class="align-middle">Cart History</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('admin.order.history') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin.order.history') }}">
                            <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            </svg>
                            <span class="align-middle">Order History</span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="{{ asset('adminassets/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1" alt="Admin User" /> <span class="text-dark">Admin User</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="{{ route('admin.setting') }}"><i class="align-middle me-1" data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="align-middle me-1" data-feather="log-out"></i> Log out</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">@yield('admin-page-title', 'Admin Dashboard')</h1>

                    @yield('admin_layout')

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <strong>Ecommerce Admin Panel</strong> &copy; {{ date('Y') }}
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="{{ route('admin.setting') }}">Settings</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Help</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('adminassets/js/app.js') }}"></script>

</body>

</html>