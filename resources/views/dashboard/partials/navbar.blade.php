<div class="nav">
    <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
        <div class="d-flex justify-content-start align-items-center">
            <button id="toggle-navbar" onclick="toggleNavbar()">
                <img src="/assets/burger.svg" class="mb-2" alt="">
            </button>
            <h2 class="nav-title">{{ $title }}</h2>
        </div>
    </div>
    {{-- @auth
        <li class="main_nav_item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span class="text-dark">{{ auth()->user()->name }} &#9660;</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/dashboard/rooms"><i class="bi bi-layout-text-sidebar-reverse"></i> My
                        Dashboard</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>
                            Logout</button>
                    </form>
            </ul>
        </li>
    @else
        <li class="main_nav_item {{ Request::is('login') ? 'active' : '' }}">
            <a href="/login">Login</a>
        </li>
    @endauth --}}

    <div class="d-flex justify-content-between align-items-center nav-input-container">
        <div class="nav-input-group">
            <input type="text" class="nav-input" placeholder="Search people, team, project">
            <button class="btn-nav-input"><img src="/assets/search.svg" alt=""></button>
        </div>

        <button class="btn-notif d-none d-md-block"><img src="/assets/bell.svg" alt=""></button>
    </div>
</div>
