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
            <div class="nav-item dropdown">
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
            </div>
        @endauth
    </div>
</div>
