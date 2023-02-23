<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    @yield('admin_pencarian')
    <!-- <form class="d-none d-md-flex ms-4">
        <input class="form-control bg-dark border-0" type="search" placeholder="Search">
    </form> -->
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-envelope me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Message</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <!-- bagian ini yang bakal diulang -->
                <!-- <a href="#" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0">Lorem, ipsum dolor.</h6>
                            <small>15 minutes ago</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider"> -->
                <!-- sampai sini -->
                <a href="/pesans" class="dropdown-item text-center">See all message</a>
            </div>
        </div>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notification</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <!-- diulang -->
                <!-- <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Profile updated</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider"> -->
                <!-- sampe sini -->
                <a href="/notifs" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="d-none d-lg-inline-flex">Setting</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <!-- <a href="#" class="dropdown-item">My Profile</a>
                <a href="#" class="dropdown-item">Settings</a> -->
                <form action="/logOut" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">Log Out
                </form>
                </button>
            </div>
        </div>
    </div>
</nav>