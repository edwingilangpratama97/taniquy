<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header text-center">
            <img src="{{asset('images/logo.png')}}" alt="" srcset="" style="width: 80%; height: auto;">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
                <li class="sidebar-item
                    {{ Request::is('v1/dashboard*') ? 'active' : false }}
                ">
                    <a href="index.html" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item has-sub
                    {{ Request::is('v1/kelompok*') ? 'active' : false }}
                    {{ Request::is('v1/retailer*') ? 'active' : false }}
                    {{ Request::is('v1/customer*') ? 'active' : false }}
                    {{ Request::is('v1/mangga*') ? 'active' : false }}
                    ">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="database" width="20"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu
                    {{ Request::is('v1/kelompok*') ? 'active' : false }}
                    {{ Request::is('v1/retailer*') ? 'active' : false }}
                    {{ Request::is('v1/customer*') ? 'active' : false }}
                    {{ Request::is('v1/mangga*') ? 'active' : false }}
                    ">

                        <li>
                            <a href="{{route('kelompok.index')}}">Kelompok Tani</a>
                        </li>

                        <li>
                            <a href="{{route('retailer.index')}}">Retailer</a>
                        </li>

                        <li>
                            <a href="{{route('customer.index')}}">Enduser</a>
                        </li>

                        <li>
                            <a href="{{route('mangga.index')}}">Mangga</a>
                        </li>

                        <li>
                            <a href="#">Jenis Mangga</a>
                        </li>

                        <li>
                            <a href="#">Grade</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="settings" width="20"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
