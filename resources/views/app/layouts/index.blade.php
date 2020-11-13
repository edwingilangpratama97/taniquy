@include('app.layouts.header')
<body>
    <div id="app">
        @include('app.layouts.sidebar')
        <div id="main">
            @include('app.layouts.navbar')
            <div class="main-content container-fluid">
                @yield('content');
            </div>

            {{-- <footer>
                <div class="footer fixed clearfix mb-0 text-muted">
                    <div class="float-left">
                        <p>2020 &copy; Voler</p>
                    </div>
                    <div class="float-right">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="http://ahmadsaugi.com">Ahmad Saugi</a></p>
                    </div>
                </div>
            </footer> --}}
        </div>
    </div>
    @include('app.layouts.footer')
    @stack('script')
</body>
</html>
