<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ Route('dashboard') }}">Dashboard Buku</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ Route('dashboard') }}">DB</a>
        </div>
        <ul class="sidebar-menu">


            <li class="menu-header">Master</li>
            @if (Auth::user()->role == 'admin')
                <li class="{{ Route::is('buku.*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ Route('buku.index') }}"><i class="fas fa-book"></i>
                        <span>Buku</span></a></li>
                <li class="{{ Route::is('category.*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ Route('category.index') }}"><i class="fas fa-list"></i>
                        <span>Category</span></a></li>
                <li class="{{ Route::is('penerbit.*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ Route('penerbit.index') }}"><i class="fas fa-upload"></i>
                        <span>Penerbit</span></a></li>
                <li class="{{ Route::is('penulis.*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ Route('penulis.index') }}"><i class="fas fa-user-edit"></i>
                        <span>Penulis</span></a></li>
                <li class="{{ Route::is('laporan') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ Route('laporan') }}"><i class="fas fa-file-excel"></i>
                        <span>Laporan</span></a></li>
            @else
                <li class="{{ Route::is('writer-buku.*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ Route('writer-buku.index') }}"><i class="fas fa-book"></i>
                        <span>Buku</span></a></li>
            @endif

        </ul>

        <div class="p-3 mt-4 mb-4 hide-sidebar-mini">
            {{-- <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form> --}}
        </div>
    </aside>
</div>
