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
                    {{ Request::is('v1/jenisMangga*') ? 'active' : false }}
                    {{ Request::is('v1/grade*') ? 'active' : false }}
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
                    {{ Request::is('v1/jenisMangga*') ? 'active' : false }}
                    {{ Request::is('v1/grade*') ? 'active' : false }}
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
                            <a href="{{route('jenisMangga.index')}}">Jenis Mangga</a>
                        </li>

                        <li>
                            <a href="{{route('grade.index')}}">Grade</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item has-sub
                    {{ Request::is('v1/postingan*') ? 'active' : false }}
                    {{ Request::is('v1/pemesanan*') ? 'active' : false }}
                    {{ Request::is('v1/kebutuhan*') ? 'active' : false }}
                    {{ Request::is('v1/penawaran*') ? 'active' : false }}
                    ">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="file-text" width="20"></i>
                        <span>Data Jual Beli</span>
                    </a>
                    <ul class="submenu
                    {{ Request::is('v1/postingan*') ? 'active' : false }}
                    {{ Request::is('v1/pemesanan*') ? 'active' : false }}
                    {{ Request::is('v1/kebutuhan*') ? 'active' : false }}
                    {{ Request::is('v1/penawaran*') ? 'active' : false }}
                    ">

                        <li>
                            <a href="{{route('postingan.index')}}">Postingan Penjual</a>
                        </li>

                        <li>
                            <a href="{{route('pemesanan.index')}}">Pemesanan Pembeli</a>
                        </li>

                        <li>
                            <a href="{{route('kebutuhan.index')}}">Kebutuhan Pembeli</a>
                        </li>

                        <li>
                            <a href="{{route('penawaran.index')}}">Penawaran Penjual</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('setApp.index')}}" class='sidebar-link'>
                        <i data-feather="settings" width="20"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
