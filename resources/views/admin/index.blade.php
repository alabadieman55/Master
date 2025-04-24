<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

</head>
<style>

</style>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-text">Admin Dashboard</div>
                </div>
                <div class="colored-dots">
                    <div class="dot dot-1"></div>
                    <div class="dot dot-2"></div>
                    <div class="dot dot-3"></div>
                    <div class="dot dot-4"></div>
                    <div class="dot dot-5"></div>
                </div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-header">DASHBOARD</div>
                <ul>
                    <li class="menu-item active">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Analytics</span>
                    </li>
                </ul>

                <div class="menu-header">CATALOG</div>
                <a href="/products" style="text-decoration: none;">
                    <ul>
                        <li class="menu-item">
                            <i class="fas fa-tshirt" style="color: white"></i>
                            <span style="color: white">Products</span>
                        </li>
                </a>


                <a href="/categories" style="text-decoration: none;">

                    <li class="menu-item">
                        <i class="fas fa-tags" style="color: white"></i>
                        <span style="color: white">Categories</span>
                    </li>
                </a>



                <li class="menu-item">
                    <i class="fas fa-layer-group"></i>
                    <span>Collections</span>
                </li>
                <li class="menu-item">
                    <i class="fas fa-percentage"></i>
                    <span>Discounts</span>
                </li>
                </ul>

                <div class="menu-header">SALES</div>
                <ul>
                    <li class="menu-item">
                        <a href="/orders" style="text-decoration: none;color:white">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Orders</span>
                        </a>

                    </li>
                    <li class="menu-item">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Returns</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-truck"></i>
                        <span>Shipping</span>
                    </li>
                </ul>

                <div class="menu-header">CONTENT</div>
                <!-- <ul>
                    <li class="menu-item">
                        <i class="fas fa-home"></i>
                        <span>Home Banner</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-blog"></i>
                        <span>Blog Posts</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Pages</span>
                    </li>
                </ul> -->

                <div class="menu-header">USERS</div>
                <!-- <ul>
                    <li class="menu-item">
                        <i class="fas fa-users"></i>
                        <span>Customers</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-user-shield"></i>
                        <span>Admin Users</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-user-cog"></i>
                        <span>Roles & Permissions</span>
                    </li>
                </ul> -->

                <div class="menu-header">SETTINGS</div>
                <!-- <ul>
                    <li class="menu-item">
                        <i class="fas fa-store"></i>
                        <span>Store Settings</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Payment Methods</span>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-cog"></i>
                        <span>General Settings</span>
                    </li>
                </ul> -->
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="top-navbar">
                <div class="left-section">
                    <button class="toggle-sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="nav-right">
                    <div class="nav-item">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </div>
                    <div class="nav-item">
                        <i class="fas fa-envelope"></i>
                        <span class="badge">5</span>
                    </div>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->is_admin)
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                                class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i
                                            class="fas fa-user-circle me-2"></i>My Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i> SIGN
                                IN</a>
                        </li>
                    @endauth
                </div>
            </div>

            <div class="dashboard-content">
                <div class="page-header">
                    <h1 class="page-title">Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li>Dashboard</li>
                    </ul>
                </div>

                <div class="stats-cards">
                    <div class="card stat-card">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="stat-details">
                            <h3>{{ $orders }}</h3>
                            <p>Total Orders</p>
                        </div>
                    </div>

                    <div class="card stat-card">
                        <div class="stat-icon bg-success">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-details">
                            <h3>${{ $revenue }}</h3>
                            <p>Total Revenue</p>
                        </div>
                    </div>

                    <div class="card stat-card">
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-details">
                            <h3>{{ $users }}</h3>
                            <p>Total Customers</p>
                        </div>
                    </div>

                    <div class="card stat-card">
                        <div class="stat-icon bg-info">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <div class="stat-details">
                            <h3>{{ $products }}</h3>
                            <p>Total Products</p>
                        </div>
                    </div>
                </div>

                <div class="dashboard-row">
                    <div class="card recent-orders">
                        <div class="card-header">
                            <h3>Recent Orders</h3>
                            <a href="/orders" class="card-header-action">View All</a>
                            {{-- <span class="card-header-action">View All</span> --}}
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordersMain as $orderMain)
                                    <tr>
                                        <td>#ORD-{{ $orderMain->id }}</td>
                                        <td>{{ $orderMain->name }}</td>
                                        <td>{{ $orderMain->created_at }}</td>
                                        <td>${{ $orderMain->total }}</td>
                                        <td><span class="status status-delivered">Delivered</span></td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3>Top Selling Products</h3>
                        </div>

                        <div class="top-products">
                            <div class="product-item">
                                <img src="/api/placeholder/50/50" alt="Green Dress" class="product-image">
                                <div class="product-details">
                                    <div class="product-name">Green Pattern Dress</div>
                                    <div class="product-price">$79.00</div>
                                </div>
                                <div class="product-sales">142 sold</div>
                            </div>

                            <div class="product-item">
                                <img src="/api/placeholder/50/50" alt="Leopard Hoodie" class="product-image">
                                <div class="product-details">
                                    <div class="product-name">Leopard Print Hoodie</div>
                                    <div class="product-price">$65.00</div>
                                </div>
                                <div class="product-sales">98 sold</div>
                            </div>

                            <div class="product-item">
                                <img src="/api/placeholder/50/50" alt="Black Jacket" class="product-image">
                                <div class="product-details">
                                    <div class="product-name">Black Modern Jacket</div>
                                    <div class="product-price">$89.99</div>
                                </div>
                                <div class="product-sales">87 sold</div>
                            </div>

                            <div class="product-item">
                                <img src="/api/placeholder/50/50" alt="Green Fashion" class="product-image">
                                <div class="product-details">
                                    <div class="product-name">Green Fashion Set</div>
                                    <div class="product-price">$129.00</div>
                                </div>
                                <div class="product-sales">76 sold</div>
                            </div>

                            <div class="product-item">
                                <img src="/api/placeholder/50/50" alt="Pink Dress" class="product-image">
                                <div class="product-details">
                                    <div class="product-name">Pink V-neck Dress</div>
                                    <div class="product-price">$69.99</div>
                                </div>
                                <div class="product-sales">63 sold</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.toggle-sidebar').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

            // Update all dropdown arrows
            document.querySelectorAll('.dropdown-arrow').forEach(arrow => {
                if (sidebar.classList.contains('collapsed')) {
                    arrow.classList.remove('fa-chevron-right');
                    arrow.classList.add('fa-chevron-down');
                } else {
                    arrow.classList.remove('fa-chevron-down');
                    arrow.classList.add('fa-chevron-right');
                }
            });
        });

        // Add active class to menu items on click
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                menuItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
