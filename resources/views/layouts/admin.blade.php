<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">





    <title>Admin</title>


    <!-- Load Font Awesome BEFORE your custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Then your custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

    <!-- Remove conflicting Font Awesome 5 link -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->

    <!-- Scripts -->
    @vite(entrypoints: ['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    /* Add this to your existing styles */
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.5rem;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .card-header .btn {
        white-space: nowrap;
        margin-left: auto;
        /* Pushes the button to the right */
    }
</style>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-text">SURFSIDE MEDIA</div>
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
                    <li class="menu-item">
                        <a href="{{ route('dashboard') }}">
                            <i style="color: white" class="fas fa-tachometer-alt"></i>
                            <span style="color: white">Dashboard</span>

                        </a>
                    </li>
                    <li class="menu-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Analytics</span>
                    </li>
                </ul>

                <div class="menu-header">CATALOG</div>
                <ul>
                    <li class="menu-item {{ request()->is('admin/products*') ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-tshirt"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <a href="/categories" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-tags"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                </ul>

                <!-- Other menu sections remain the same -->
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
                    <!-- Nav items remain the same -->
                </div>
            </div>

            <!-- Content Section -->
            <div class="dashboard-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Toggle sidebar function
        document.querySelector('.toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
        });

        // Set active menu item based on current URL
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.menu-item a').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.closest('.menu-item').classList.add('active');
                }
            });
        });
    </script>


</body>

</html>
