<!-- navbar section -->
<nav class="navbar navbar-expand-lg bg-nav navbar-light position-fixed w-100">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/img/ic/salon_logo.png" alt="" width="40" class="d-inline-block align-text-top me-3">
            Kirei Hair Beauty</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" aria-current="page" href="{{ $link_home }}">HOME</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="/{{ $link_layanan }}">SERVICES</a>
                </li>

                <li class="nav-item mx-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      PAGES
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="/{{ $link_paket }}">PACKAGE</a></li>
                      <li><a class="dropdown-item" href="/books/create">MAKE A RESERVATION</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="/shop">SHOP</a></li>
                    </ul>
                  </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="/{{ $link_galeri }}">GALLERY</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="/{{ $link_blog }}">BLOG</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="/{{ $link_kontak }}">CONTACT</a>
                </li>
            </ul>

            <div>
                <a href="/signIn"><button class="button-primary">ADMIN</button></a>
            </div>
        </div>
    </div>
</nav>