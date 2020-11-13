@extends('app.layouts.index')

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i>
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i>
                {{ session()->get('failed') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <img class="card-img-top img-fluid" src="{{asset('assets/images/samples/aerial-panoramic-image-of-sansonvale-lake-X6TCENW.jpg')}}"
                        alt="Card image cap" />
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card to-image-account p-3">
                                    <div class="row">
                                        <div class="col-md-2 image-account">
                                            <img src="{{\Avatar::create(isset(Auth::user()->id_kelompok) ? Auth::user()->kelompok->nama :  (isset(Auth::user()->id_retailer) ? Auth::user()->retailer->nama :(isset(Auth::user()->id_enduser) ? Auth::user()->enduser->nama : Auth::user()->name)))->toBase64()}}" alt="" srcset="">
                                        </div>
                                        <div class="col-md-10 center-text">
                                                {{ isset(Auth::user()->id_kelompok) ? Auth::user()->kelompok->nama :  (isset(Auth::user()->id_retailer) ? Auth::user()->retailer->nama :(isset(Auth::user()->id_enduser) ? Auth::user()->enduser->nama : Auth::user()->name)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="float-left">
                                    <h4 class="card-title">Detail Akun-mu</h4>
                                    <p class="card-text">
                                        Nama : {{ isset(Auth::user()->id_kelompok) ? Auth::user()->kelompok->nama :  (isset(Auth::user()->id_retailer) ? Auth::user()->retailer->nama :(isset(Auth::user()->id_enduser) ? Auth::user()->enduser->nama : Auth::user()->name)) }}
                                    </p>
                                    <p class="card-text">
                                        Username : {{ Auth::user()->name }}
                                    </p>
                                    <p class="card-text">
                                        Email : {{Auth::user()->email}}
                                    </p>
                                    <p class="card-text">
                                        Alamat : {{ isset(Auth::user()->id_kelompok) ? Auth::user()->kelompok->alamat :  (isset(Auth::user()->id_retailer) ? Auth::user()->retailer->alamat :(isset(Auth::user()->id_enduser) ? Auth::user()->enduser->alamat : Auth::user()->name)) }}
                                    </p>
                                    <p class="card-text">
                                        Kontak : {{ isset(Auth::user()->id_kelompok) ? Auth::user()->kelompok->kontak :  (isset(Auth::user()->id_retailer) ? Auth::user()->retailer->kontak :(isset(Auth::user()->id_enduser) ? Auth::user()->enduser->kontak : Auth::user()->name)) }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <div class="row">
                                        @if (Auth::user()->id_retailer != null)
                                            <a href="{{ route('updateAkunRetailer') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-account-edit"></i> Update Account</a>
                                        @elseif (Auth::user()->id_kelompok != null)
                                            <a href="{{ route('updateAkunKelompok') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-account-edit"></i> Update Account</a>
                                        @elseif(Auth::user()->id_enduser != null)
                                            <a href="{{ route('updateAkunEnduser') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-account-edit"></i> Update Account</a>
                                        @elseif(Auth::user()->role == 'admin')
                                            <a href="{{ route('updateAkunAdmin') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-account-edit"></i> Update Account</a>
                                        @endif
                                    </div>
                                    <div class="row mt-2">
                                        <a href="{{ route('updatePassword') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-account-key"></i> Update Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('script')
<script>

</script>
@endpush
@endsection
