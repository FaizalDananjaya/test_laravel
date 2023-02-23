<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="/admin" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->employee->nama }}</h6><!-- nama admin-->
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="/admin" class="nav-item nav-link {{ Request::is('admin') ? 'active':''}}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="/pesans" class="nav-item nav-link {{ Request::is('pesans') ? 'active':''}}"><i class="fa fa-envelope me-2"></i>Message</a>
            <a href="/notifs" class="nav-item nav-link {{ Request::is('notifs') ? 'active':''}}"><i class="fa fa-bell me-2"></i>Notification</a>
            <a href="/schedules" class="nav-item nav-link {{ Request::is('schedules') ? 'active':''}}"><i class="fa fa-table me-2"></i>Schedule</a>
            <a href="/sales" class="nav-item nav-link {{ Request::is('sales') ? 'active':''}}"><i class="fa fa-chart-bar me-2"></i>Sales</a>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('formulir*') ? 'active':''}}" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Formulir</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/formulir/services" class="dropdown-item {{ Request::is('formulir/services*') ? 'active':''}}">Service</a>
                    <a href="/formulir/products" class="dropdown-item {{ Request::is('formulir/products*') ? 'active':''}}">Product</a>
                    <a href="/formulir/blogs" class="dropdown-item {{ Request::is('formulir/blogs*') ? 'active':''}}">Post</a>
                    <a href="/formulir/employees" class="dropdown-item {{ Request::is('formulir/employees*') ? 'active':''}}">Employee</a>
                    <a href="/formulir/faqs" class="dropdown-item {{ Request::is('formulir/faqs*') ? 'active':''}}">FAQs & Help</a>
                    <a href="/formulir/categories" class="dropdown-item {{ Request::is('formulir/categories*') ? 'active':''}}">Category</a>
                </div>
            </div>

        </div>
    </nav>
</div>


<script>
    // const activePage = window.location.pathname;
    // const navLinks = document.querySelectorAll('nav a').forEach(link => {
    //     if (link.href.includes(`${activePage}`)) {
    //         link.classList.add('active');
    //         console.log(link);
    //     }
    // })
</script>