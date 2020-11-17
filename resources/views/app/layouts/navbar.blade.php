@php
    $notif = App\Models\Notification::where('status','=','0')->get();
    // dd($notif);
@endphp
<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
            <li class="dropdown nav-icon">
                @if ($notif->count() > 0)
                <button type="button" style="color:red" class="btn btn-default mdi mdi-bell-outline mdi-24px close" id="bell" onclick="getNotif()" data-toggle="modal" data-target="#small">
                        {{-- <span class="badge badge-danger">{{ $notif->count() }}</span> --}}
                </button>
                @else
                <button type="button" style="color:black" class="btn btn-default mdi mdi-bell-outline mdi-bg-primary mdi-24px close" id="bell" onclick="getNotif()" data-toggle="modal" data-target="#small">
                </button>
                @endif
                    <!--small size modal -->
                    <div class="modal fade text-left" id="small" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12" id="loading">
                                    <div id="kode"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown nav-icon mr-2">
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                    <a class="dropdown-item" href="#"><i data-feather="mail"></i> Messages</a>
                    <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i data-feather="log-out"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="avatar mr-1">
                        <img src="{{\Avatar::create(isset(Auth::user()->id_kelompok) ? Auth::user()->kelompok->nama :  (isset(Auth::user()->id_retailer) ? Auth::user()->retailer->nama :(isset(Auth::user()->id_enduser) ? Auth::user()->enduser->nama : Auth::user()->name)))->toBase64()}}" alt="" srcset="">
                    </div>
                    <div class="d-none d-md-block d-lg-inline-block">Hi, {{ isset(Auth::user()->id_kelompok) ? Auth::user()->kelompok->nama :  (isset(Auth::user()->id_retailer) ? Auth::user()->retailer->nama :(isset(Auth::user()->id_enduser) ? Auth::user()->enduser->nama : Auth::user()->name)) }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('account') }}"><i data-feather="user"></i> Account</a>
                    <a class="dropdown-item" href="#"><i data-feather="mail"></i> Messages</a>
                    <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i data-feather="log-out"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
@push('script')
    <script>
        // setInterval(function(){
        //     $.get('/api/v1/getStatus',{},function(results){
        //         if ($(results).length) {
        //             $("#bell").each(function(){

        //             })
        //         }
        //     })
        // })
        function getBell(){
            $.ajax({
                type:'GET',
                url:'/api/v1/getStatus',
                dataType:'json',
                    success:function(bell){
                        // console.log(bell)
                        if (bell.data.length > 0) {
                            $('#bell').css({"color":"red"})
                        } else{
                            $('#bell').css({"color":"black"})
                        }
                    }
            });
        }
        var getMessage = function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: '{{route('clickNotifikasi')}}',
                dataType:'json',
                    success:function(data){
                    // console.log(data); //Please share cosnole data
                    if(data.msg) //Check the data.msg isset?
                    {
                        $("#msg").html(data.msg); //replace html by data.msg
                    }

                }
            });
        }

       function getNotif(){
        getMessage();
        $('#loading').append(`
            <center>
                <div class="spinner-grow" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </center>
        `)
        $('#kode').html("")
            $.ajax({
            url: '/api/v1/getNotif',
            type: 'GET',
            cache: false,
            dataType: 'json',
            success: function(response) {
                // console.log(response);

                $.each(response.data, function(a,b){
                    if (b.id_pemesanan != null) {
                        $('#kode').append(`
                            <div class="row">
                                <div class="col-12">
                                        Notifikasi Pemesanan !
                                        Tanggal Pemesanan : ${b.waktu}
                                        <p style="font-size:13px;"> Kode Pemesanan : ${b.pemesanan.kode_pemesanan} <hr></p>
                                    </div>
                                </div>
                            </div>
                        `);
                    }else if (b.id_penawaran != null) {
                        $('#kode').append(`
                            <div class="row">
                                <div class="col-12">
                                        Notifikasi Penawaran !
                                        Tanggal Penawaran : ${b.waktu}
                                        <p style="font-size:13px;"> Kode Penawaran : ${b.penawaran.kode_penawaran} <hr></p>
                                    </div>
                                </div>
                            </div>
                        `);

                    }
                })
                $('.spinner-grow').remove()
                }
            });
       }
       setInterval(() => {
        getBell()
       }, 5000);
    </script>
@endpush
