<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Velora</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">VL</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="/dashboard"><i
                        class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class="{{ Request::is('barang') ? 'active' : '' }}"><a class="nav-link" href="/barang"><i
                        class="fas fa-wrench"></i> <span>Barang</span></a></li>
            <li class="{{ Request::is('user') ? 'active' : '' }}"><a class="nav-link" href="/user"><i
                        class="fas fa-user"></i> <span>User</span></a></li>
            <li class="{{ Request::is('orders*') ? 'active' : '' }}"><a class="nav-link" href="/orders"><i
                        class="fa fa-money-bill"></i><span>Orders</span></a></li>
        </ul>


    </aside>
</div>
