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
            <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"
                    style="text-decoration: none; color: white; display: flex; align-items: center;">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/analytics') ? 'active' : '' }}">
                <a href="/analytics/revenue"
                    style="text-decoration: none; color: white; display: flex; align-items: center;">

                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
                </a>


            </li>
        </ul>

        <div class="menu-header">CATALOG</div>
        <ul>
            <li class="menu-item {{ request()->is('admin/products*') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}"
                    style="text-decoration: none; color: white; display: flex; align-items: center;">
                    <i class="fas fa-tshirt"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
                <a href="{{ route('categories.index') }}"
                    style="text-decoration: none; color: white; display: flex; align-items: center;">
                    <i class="fas fa-tags"></i>
                    <span>Categories</span>
                </a>
            </li>
        </ul>

        <div class="menu-header">SALES</div>
        <ul>
            <li class="menu-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <a href="{{ route('admin.orders.index') }}"
                    style="text-decoration: none; color: white; display: flex; align-items: center;">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // TEST DATA - replace with your actual data later
        const testData = [{
                date: "2025-05-01",
                total: "100.00"
            },
            {
                date: "2025-05-02",
                total: "150.00"
            },
            {
                date: "2025-05-03",
                total: "200.00"
            }
        ];

        const ctx = document.getElementById('revenueChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: testData.map(item => item.date),
                datasets: [{
                    label: 'Daily Revenue ($)',
                    data: testData.map(item => parseFloat(item.total)),
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
