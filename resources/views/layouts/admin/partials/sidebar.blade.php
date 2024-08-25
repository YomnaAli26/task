<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route("admin.dashboard") }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="{{ route("admin.posts.index") }}" >
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Posts</span>
            </a>
        </li>

    </ul>
</nav>
