@php 
    $mangga = \App\Models\Mangga::all();
    $max = number_format($mangga->max('harga'),0,".",".");
    $min = number_format($mangga->min('harga'),0,".",".");
    $avg = number_format($mangga->avg('harga'),0,".",".");
    // dd($avg);
    $jmlPenawaran = \App\Models\Penawaran::where('status_pembayaran', 1)->get();
    $jmlPemesanan = \App\Models\Pemesanan::where('status_pembayaran', 1)->get();
    $jmpn = 0;
    foreach($jmlPenawaran as $p){
        $jmpn = $jmpn + $p->jumlah;
    }
    $jmpm = 0;
    foreach($jmlPemesanan as $p){
        $jmpm = $jmpm + $p->jumlah;
    }

    // dd($jmpn,$jmpm);
    $jumlah = $jmpn + $jmpm;
    $role = Auth::user()->role;
    if ($role == 'admin') {
        $latitudeBase = -1.605328;
        $longitudeBase = 117.451067;
    } elseif ($role == 'kelompok') {
        $latitudeBase = Auth::user()->kelompok->lantitude;
        $longitudeBase = Auth::user()->kelompok->longitude;
    } elseif ($role == 'retailer') {
        $latitudeBase = Auth::user()->retailer->lantitude;
        $longitudeBase = Auth::user()->retailer->longitude;
    } elseif ($role == 'enduser') {
        $latitudeBase = Auth::user()->enduser->lantitude;
        $longitudeBase = Auth::user()->enduser->longitude;
    }
@endphp
@extends('app.layouts.index')

@section('content')
<div class="page-title">
    <h1 class="text-title">Dashboard</h1>
    <p class="text-subtitle text-muted">Data Statistik Penjualan Mangga</p>
</div>
<section class="section">
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
        <div class="col-6 col-md-3">
            <div class="card card-statistic success-before">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3'>
                            <div class="row">
                                <div class="col-4 align-middle text-center text-success">
                                    <i data-feather="trending-down" class="dashboard-item"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <div class="row">
                                        <span class="dashboard-value float-right py-1">{{$min}}</span><br>
                                    </div>
                                    <div class="row">
                                        <small class="float-right">Harga Terendah (Rp)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="chart-wrapper">
                            <canvas id="canvas1" style="height:100px !important"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic danger-before">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3'>
                            <div class="row">
                                <div class="col-4 align-middle text-center text-danger">
                                    <i data-feather="trending-up" class="dashboard-item"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <div class="row">
                                        <span class="dashboard-value float-right py-1">{{$max}}</span><br>
                                    </div>
                                    <div class="row">
                                        <small class="float-right">Harga Tertinggi (Rp)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="chart-wrapper">
                            <canvas id="canvas2" style="height:100px !important"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic warning-before">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3'>
                            <div class="row">
                                <div class="col-4 align-middle text-center text-warning">
                                    <i data-feather="bar-chart-2" class="dashboard-item"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <div class="row">
                                        <span class="dashboard-value float-right py-1">{{$avg}}</span><br>
                                    </div>
                                    <div class="row">
                                        <small class="float-right">Harga Rata Rata (Rp)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="chart-wrapper">
                            <canvas id="canvas3" style="height:100px !important"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic primary-before">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3'>
                            <div class="row">
                                <div class="col-4 align-middle text-center text-primary">
                                    <i data-feather="shopping-bag" class="dashboard-item"></i>
                                </div>
                                <div class="col-8 text-right">
                                    <div class="row">
                                        <span class="dashboard-value float-right py-1">{{$jumlah}}</span><br>
                                    </div>
                                    <div class="row">
                                        <small class="float-right">Total Penjualan (Kg)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="chart-wrapper">
                            <canvas id="canvas4" style="height:100px !important"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="text-subtitle text-muted">Filter Postingan</p>
        </div>
        <div class="col-6 col-md-3">
            <div class="input-group mb-3">
                <label class="input-group-text success" for="inputGroupSelect01">Jarak</label>
                <select class="form-select" id="inputGroupSelect01">
                    <option selected>Pilih...</option>
                    <option value="1">< 1Km</option>
                    <option value="2">1Km - 10Km</option>
                    <option value="3">10Km - 20Km</option>
                </select>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="input-group mb-3">
                <label class="input-group-text danger" for="inputGroupSelect01">Jenis</label>
                <select class="form-select" id="inputGroupSelect01">
                    <option selected>Pilih...</option>
                    @foreach($jenis as $j)
                    <option value="{{$j->id}}">{{$j->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="input-group mb-3">
                <span class="input-group-text warning" id="inputGroup-sizing-default">Harga (Rp)</span>
                <input type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default">
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="input-group mb-3">
                <span class="input-group-text primary" id="inputGroup-sizing-default">Daerah (Rp)</span>
                <input type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" placeholder="Kab/Kota">
            </div>
        </div>
    </div>
    <div id='map'></div>
    <div class="float-right floating-group">
        @if(Auth::user()->role == 'kelompok')
        <div class="floating-postingan my-2" id="floating-postingan">
            <div class="row w-float">
                <div class="col-8 inline align-self-center">
                    <div class="card h-100 align-self-center">
                        <span class="floating-comment">Post Mangga</span>
                    </div>
                </div>
                <div class="col-4 py-2">
                    <button class="btn btn-warning btn-circle shadow" data-toggle="modal" data-target="#postingan">
                        <div class="d-flex justify-content-center">
                            <span class="plus-text text-center">
                                +
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->role == 'enduser')
        <div class="floating-kebutuhan my-2" id="floating-kebuthan">
            <div class="row w-float">
                <div class="col-8 inline align-self-center">
                    <div class="card h-100 align-self-center">
                        <span class="floating-comment">Post Kebutuhan</span>
                        <div class="triangle-right"></div>
                    </div>
                </div>
                <div class="col-4 py-2">
                    <button class="btn btn-success btn-circle shadow" data-toggle="modal" data-target="#kebutuhan">
                        <div class="d-flex justify-content-center">
                            <span class="plus-text text-center">
                                +
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->role == 'retailer')
        <div class="floating-postingan my-2" id="floating-postingan">
            <div class="row w-float">
                <div class="col-8 inline align-self-center">
                    <div class="card h-100 align-self-center">
                        <span class="floating-comment">Post Mangga</span>
                    </div>
                </div>
                <div class="col-4 py-2">
                    <button class="btn btn-warning btn-circle shadow" data-toggle="modal" data-target="#postingan">
                        <div class="d-flex justify-content-center">
                            <span class="plus-text text-center">
                                +
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <div class="floating-kebutuhan my-2" id="floating-kebuthan">
            <div class="row w-float">
                <div class="col-8 inline align-self-center">
                    <div class="card h-100 align-self-center">
                        <span class="floating-comment">Post Kebutuhan</span>
                    </div>
                </div>
                <div class="col-4 py-2">
                    <button class="btn btn-success btn-circle shadow" data-toggle="modal" data-target="#kebutuhan">
                        <div class="d-flex justify-content-center">
                            <span class="plus-text text-center">
                                +
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@if(Auth::user()->role == 'enduser')
<div class="modal fade text-left" id="kebutuhan" tabindex="0" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-success">
        <h5 class="modal-title white" id="myModalLabel110">Posting Kebutuhan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
        </div>
        <form action="{{route('kebutuhan.store')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            @if(Auth::user()->role == 'retailer')
                            <input type="hidden" name="pemesan" value="{{Auth::user()->id_retailer}}">
                            @elseif(Auth::user()->role == 'enduser')
                            <input type="hidden" name="pemesan" value="{{Auth::user()->id_enduser}}">
                            @endif
                            <input type="hidden" name="role" value="{{Auth::user()->role}}">
                            <div class="form-group">
                                <label for="jenis-select">Jenis Mangga</label>
                                <select id="jenis-select" class="form-select @error('id_jenis') is-invalid @enderror" id="jenis-select" name="id_jenis">
                                    <option value="">-- Pilih Disini --</option>
                                    @foreach($jenis as $p)
                                    <option value="{{$p->id}}">{{$p->nama}}</option>
                                    @endforeach
                                </select>
                                @error('id_jenis')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input id="jumlah" type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror">
                                @error('jumlah')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <span>Saran Postingan Berdasarkan Kebutuhan Anda :</span>
                    <hr>
                    {{-- <div class="row"> --}}
                        <div id="result-relevan"></div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>

        <button type="submit" class="btn btn-success ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block"><i data-feather="send"></i> Post</span>
        </button>
        </form>
        </div>
    </div>
    </div>
</div>
@elseif(Auth::user()->role == 'kelompok')
<div class="modal fade text-left" id="postingan" tabindex="0" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-warning">
        <h5 class="modal-title white" id="myModalLabel110">Posting/Jual Mangga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
        </div>
        <form action="{{route('postingan.store')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    @if(Auth::user()->role == 'retailer')
                    <input type="hidden" name="penjual" value="{{Auth::user()->id_retailer}}">
                    @elseif(Auth::user()->role == 'kelompok')
                    <input type="hidden" name="penjual" value="{{Auth::user()->id_kelompok}}">
                    @endif
                    <input type="hidden" name="role" value="{{Auth::user()->role}}">
                    <div class="form-group">
                        <label for="jenis-select">Mangga</label>
                        <select id="jenis-select" class="form-select @error('id_mangga') is-invalid @enderror" id="jenis-select" name="id_mangga">
                            <option value="">-- Pilih Disini --</option>
                            @foreach($mangga as $p)
                            <option value="{{$p->id}}">{{$p->jenis->nama}}</option>
                            @endforeach
                        </select>
                        @error('id_mangga')
                        <div class="invalid-feedback">
                            <i class="bx bx-radio-circle"></i>
                            {{{$message}}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea id="keterangan" class="form-select @error('keterangan') is-invalid @enderror" name="keterangan" rows="6"></textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            <i class="bx bx-radio-circle"></i>
                            {{{$message}}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>

        <button type="submit" class="btn btn-warning ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block"><i data-feather="send"></i> Post</span>
        </button>
        </form>
        </div>
    </div>
    </div>
</div>
@elseif(Auth::user()->role == 'retailer')
<div class="modal fade text-left" id="kebutuhan" tabindex="0" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-success">
        <h5 class="modal-title white" id="myModalLabel110">Posting Kebutuhan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
        </div>
        <form action="{{route('kebutuhan.store')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            @if(Auth::user()->role == 'retailer')
                            <input type="hidden" name="pemesan" value="{{Auth::user()->id_retailer}}">
                            @elseif(Auth::user()->role == 'enduser')
                            <input type="hidden" name="pemesan" value="{{Auth::user()->id_enduser}}">
                            @endif
                            <input type="hidden" name="role" value="{{Auth::user()->role}}">
                            <div class="form-group">
                                <label for="jenis-select">Jenis Mangga</label>
                                <select id="jenis-select" class="form-select @error('id_jenis') is-invalid @enderror" id="jenis-select" name="id_jenis">
                                    <option value="">-- Pilih Disini --</option>
                                    @foreach($jenis as $p)
                                    <option value="{{$p->id}}">{{$p->nama}}</option>
                                    @endforeach
                                </select>
                                @error('id_jenis')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input id="jumlah" type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror">
                                @error('jumlah')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <span>Saran Postingan Berdasarkan Kebutuhan Anda :</span>
                    <hr>
                    {{-- <div class="row"> --}}
                        <div id="result-relevan"></div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>

        <button type="submit" class="btn btn-success ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block"><i data-feather="send"></i> Post</span>
        </button>
        </form>
        </div>
    </div>
    </div>
</div>
<div class="modal fade text-left" id="postingan" tabindex="0" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-warning">
        <h5 class="modal-title white" id="myModalLabel110">Posting/Jual Mangga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
        </div>
        <form action="{{route('postingan.store')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    @if(Auth::user()->role == 'retailer')
                    <input type="hidden" name="penjual" value="{{Auth::user()->id_retailer}}">
                    @elseif(Auth::user()->role == 'kelompok')
                    <input type="hidden" name="penjual" value="{{Auth::user()->id_kelompok}}">
                    @endif
                    <input type="hidden" name="role" value="{{Auth::user()->role}}">
                    <div class="form-group">
                        <label for="jenis-select">Mangga</label>
                        <select id="jenis-select" class="form-select @error('id_mangga') is-invalid @enderror" id="jenis-select" name="id_mangga">
                            <option value="">-- Pilih Disini --</option>
                            @foreach($mangga as $p)
                            <option value="{{$p->id}}">{{$p->jenis->nama}}</option>
                            @endforeach
                        </select>
                        @error('id_mangga')
                        <div class="invalid-feedback">
                            <i class="bx bx-radio-circle"></i>
                            {{{$message}}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea id="keterangan" class="form-select @error('keterangan') is-invalid @enderror" name="keterangan" rows="6"></textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            <i class="bx bx-radio-circle"></i>
                            {{{$message}}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>

        <button type="submit" class="btn btn-warning ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block"><i data-feather="send"></i> Post</span>
        </button>
        </form>
        </div>
    </div>
    </div>
</div>
<div class="modal fade text-left" id="pemesanan" tabindex="0" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-success">
        <h5 class="modal-title white" id="myModalLabel110">Pesan Mangga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
        </div>
        <form action="{{route('pemesanan.store')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="id_postingan" id="id_postingan_modal">
                    @if(Auth::user()->role == 'retailer')
                    <input type="hidden" name="pemesan" value="{{Auth::user()->id_retailer}}">
                    @elseif(Auth::user()->role == 'enduser')
                    <input type="hidden" name="pemesan" value="{{Auth::user()->id_enduser}}">
                    @endif
                    <input type="hidden" name="role" value="{{Auth::user()->role}}">
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input id="jumlah" type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror">
                        @error('jumlah')
                        <div class="invalid-feedback">
                            <i class="bx bx-radio-circle"></i>
                            {{{$message}}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>

        <button type="submit" class="btn btn-success ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block"><i data-feather="send"></i> Post</span>
        </button>
        </form>
        </div>
    </div>
    </div>
</div>
<div class="modal fade text-left" id="penawaran" tabindex="0" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-warning">
        <h5 class="modal-title white" id="myModalLabel110">Tawarkan Mangga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
        </div>
        <form action="{{route('penawaran.store')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="id_kebutuhan" id="id_kebutuhan_modal">
                    @if(Auth::user()->role == 'retailer')
                    <input type="hidden" name="penjual" value="{{Auth::user()->id_retailer}}">
                    @elseif(Auth::user()->role == 'kelompok')
                    <input type="hidden" name="penjual" value="{{Auth::user()->id_kelompok}}">
                    @endif
                    <input type="hidden" name="role" value="{{Auth::user()->role}}">
                    <div class="form-group">
                        <label for="jenis-select">Mangga</label>
                        <select id="jenis-select" class="form-select @error('id_mangga') is-invalid @enderror" id="jenis-select" name="id_mangga">
                            <option value="">-- Pilih Disini --</option>
                            @foreach($mangga as $p)
                            <option value="{{$p->id}}">{{$p->jenis->nama}}</option>
                            @endforeach
                        </select>
                        @error('id_mangga')
                        <div class="invalid-feedback">
                            <i class="bx bx-radio-circle"></i>
                            {{{$message}}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>

        <button type="submit" class="btn btn-warning ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block"><i data-feather="send"></i> Post</span>
        </button>
        </form>
        </div>
    </div>
    </div>
</div>
@endif
@endsection
@push('script')
<script>
    function fillPenawaran(id){
        console.log('ID Kebutuhan '+id);
        $('#id_kebutuhan_modal').val(id);
    }
    function fillPemesanan(id){
        $('#id_postingan_modal').val(id);
        console.log('ID Postingan '+id);
    }
    var auth = `{{Auth::user()->role}}`;
    // console.log(auth);
    $('#jenis-select').change(function() {
        var valueJenis = $('#jenis-select').val();
        console.log('Jenis ID : '+valueJenis);
        getByJenis(valueJenis,{{Auth::user()->id}});
    });

    function getByJenis(id,user_id) {
        $('#result-relevan').html(`
            <div class="d-flex justify-content-center my-4">
                <div class="spinner-grow text-success" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-success" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-success" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
        `);
        $.ajax({
          url: '/api/v1/getByJenis/'+id,
          type: 'GET',
          data: {user:user_id},
          cache: false,
          dataType: 'json',
          success: function(json) {
            // alert(json.data);
            $('#result-relevan').html('');
            var postingan = json.data;
            if(postingan.length < 1){
                $('#result-relevan').html(`
                    <div class="d-flex justify-content-center my-4">
                        <h6 classs="text-center">~ Tidak Ada Postingan Yang Relevan ~</h6>
                    </div>
                `);
            } else {
                postingan.forEach(element =>
                    $('#result-relevan').append(`
                        <div class="row">
                        <div class="col-6">
                            ID Postingan
                        </div>
                        <div class="col-6">
                            <span class="float-left">:</span>
                            <span class="float-right">
                                ${element.kode_postingan}
                            </span>
                        </div>
                        <div class="col-6">
                            Jenis Mangga
                        </div>
                        <div class="col-6">
                            <span class="float-left">:</span>
                            <span class="float-right">
                                ${element.mangga.jenis.nama}
                            </span>
                        </div>
                        <div class="col-6">
                            Harga
                        </div>
                        <div class="col-6">
                            <span class="float-left">:</span>
                            <span class="float-right">
                                Rp. ${element.mangga.harga}
                            </span>
                        </div>
                        <div class="col-6">
                            Stok
                        </div>
                        <div class="col-6">
                            <span class="float-left">:</span>
                            <span class="float-right">
                                ${element.mangga.stok} Kg
                            </span>
                        </div>
                        <div class="col-12 mt-2">
                            <a href="#" class="float-right">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pemesanan" onclick="fillPemesanan(${element.id})" data-dismiss="modal">Pesan</button>
                            </a>
                        </div>
                        </div>
                        <hr>
                    `)
                );
            }
              // $("#kabupaten-select").html('');
              // if (json.code == 200) {
              //     for (i = 0; i < Object.keys(json.data).length; i++) {
              //         // console.log(json.data[i].nama);
              //         $('#kabupaten-select').append($('<option>').text(json.data[i].nama).attr('value', json.data[i].id));
              //     }

              // } else {
              //     $('#kabupaten-select').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
              // }
          }
        });
    }

    var mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

    var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1}),
        streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1});

    var latitudeBase = `{{$latitudeBase}}`;
    var longitudeBase = `{{$longitudeBase}}`;
    var map = L.map('map', {
        center: [latitudeBase, longitudeBase],
        zoom: 8,
        layers: [streets]
    });

    var baseLayers = {
        "Grayscale": grayscale,
        "Streets": streets
    };

    // var LeafIcon = L.Icon.extend({
    //     options: {
    //         shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    //         iconSize: [50, 82],
    //         iconAnchor: [25, 82],
    //         popupAnchor: [1, -74],
    //         shadowSize: [30, 30]
    //     }
    // });

    var greenIcon = new L.Icon({
      iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
    });

    var redIcon = new L.Icon({
      iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
    });


    // var greenIcon = new LeafIcon({iconUrl: '{{asset('images/green-marker.svg')}}'}),
    //     redIcon = new LeafIcon({iconUrl: '{{asset('images/red-marker.svg')}}'});
    if(auth == 'kelompok'){
        var kebutuhanRetailer = {!! json_encode($kebutuhanRetailer ?? '') !!}
        var idBeforeRed = 0;
        var isiRed = '';
        kebutuhanRetailer.forEach(kebutuhanRetailerMarker)
        function kebutuhanRetailerMarker(data, index) {
            if (data.id_retailer == idBeforeRed) {
                console.log(isiRed)
                isiRed += `
                <hr>
                <div class="row">
                    <div class="col-3">
                        <span>Membutuhkan</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.jenis.nama}</span>
                    </div>
                    <div class="col-3">
                        <span>Jumlah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.jumlah}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Daerah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.retailer.desa.kecamatan.nama}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Desa</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.retailer.desa.nama}</span>
                    </div>
                    <div class="col-12 pt-2 text-center">
                        <button data-toggle="modal" data-target="#penawaran" onclick="fillPenawaran(${data.id})" class="btn btn-sm btn-success" style="width: 50%;">Tawarkan</button>
                    </div>
                </div>
                    `
                L.marker([data.retailer.latitude, data.retailer.longitude], {icon: redIcon}).bindPopup(isiRed).addTo(map)
                isiRed = ''
                // console.log(isiGreen)
            } else {
            isiRed = `
            <div id="rowKel-${data.id_retailer}">
                <div class="row">
                    <div class="col-12">
                        <h4>${data.retailer.nama}</h4>
                    </div>
                    <div class="col-3">
                        <span>Membutuhkan</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.jenis.nama}</span>
                    </div>
                    <div class="col-3">
                        <span>Jumlah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.jumlah}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Daerah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.retailer.desa.kecamatan.nama}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Desa</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.retailer.desa.nama}</span>
                    </div>
                    <div class="col-12 pt-2 text-center">
                        <button data-toggle="modal" data-target="#penawaran" onclick="fillPenawaran(${data.id})" class="btn btn-sm btn-success" style="width: 50%;">Tawarkan</button>
                    </div>
                </div>
            </div>
            `

            idBeforeRed = data.id_retailer
            L.marker([data.retailer.latitude, data.retailer.longitude], {icon: redIcon}).bindPopup(isiRed).addTo(map)
            }
        }

    } else if(auth == 'retailer') {

        var postinganKelompok = {!! json_encode($postinganKelompok ?? '') !!};
        console.log(postinganKelompok);
        var idBefore = 0;
        var isiGreen = '';
        postinganKelompok.forEach(postinganKelompokMarker)
        function postinganKelompokMarker(data, index) {
            if (data.id_kelompok == idBefore) {
                // console.log('ini kedua')
                isiGreen += `
                <hr>
                <div class="row">
                    <div class="col-3">
                        <span>Menjual</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.jenis.nama}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Harga/Kg</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.harga}</span>
                    </div>
                    <div class="col-3">
                        <span>Stok</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.stok}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Daerah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.kelompok.desa.kecamatan.nama}</span>
                    </div>
                    <div class="col-3">
                        <span>Keterangan</span>
                    </div>
                    <div class="col-9">
                        <span class="float-left">:</span>
                        <span class="float-right text-right">${data.keterangan}</span>
                    </div>
                    <div class="col-12 pt-2 text-center">
                        <button data-toggle="modal" data-target="#pemesanan" onclick="fillPemesanan(${data.id})" class="btn btn-sm btn-success" style="width: 50%;">Pesan</button>
                    </div>
                </div>
                    `
                L.marker([data.kelompok.latitude, data.kelompok.longitude], {icon: greenIcon}).bindPopup(isiGreen).addTo(map)
                isiGreen = ''
                // console.log(isiGreen)
            } else {
            isiGreen = `
            <div id="rowKel-${data.id_kelompok}">
                <div class="row">
                    <div class="col-12">
                        <h4>${data.kelompok.nama}</h4>
                    </div>
                    <div class="col-3">
                        <span>Menjual</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.jenis.nama}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Harga/Kg</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.harga}</span>
                    </div>
                    <div class="col-3">
                        <span>Stok</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.stok}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Daerah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.kelompok.desa.kecamatan.nama}</span>
                    </div>
                    <div class="col-3">
                        <span>Keterangan</span>
                    </div>
                    <div class="col-9">
                        <span class="float-left">:</span>
                        <span class="float-right text-right">${data.keterangan}</span>
                    </div>
                    <div class="col-12 pt-2 text-center">
                        <button data-toggle="modal" data-target="#pemesanan" onclick="fillPemesanan(${data.id})" class="btn btn-sm btn-success" style="width: 50%;">Pesan</button>
                    </div>
                </div>
            </div>
            `

            idBefore = data.id_kelompok
            L.marker([data.kelompok.latitude, data.kelompok.longitude], {icon: greenIcon}).bindPopup(isiGreen).addTo(map)
            }
        }
        var kebutuhanEnduser = {!! json_encode($kebutuhanEnduser ?? '') !!}
        var idBeforeRed = 0;
        var isiRed = '';
        kebutuhanEnduser.forEach(kebutuhanEnduserMarker)
        function kebutuhanEnduserMarker(data, index) {
            if (data.id_enduser == idBeforeRed) {
                // console.log('ini kedua')
                isiRed += `
                <hr>
                <div class="row">
                    <div class="col-3">
                        <span>Membutuhkan</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.jenis.nama}</span>
                    </div>
                    <div class="col-3">
                        <span>Jumlah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.jumlah}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Daerah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.enduser.desa.kecamatan.nama}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Desa</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.enduser.desa.nama}</span>
                    </div>
                    <div class="col-12 pt-2 text-center">
                        <button data-toggle="modal" data-target="#penawaran" onclick="fillPenawaran(${data.id})" class="btn btn-sm btn-success" style="width: 50%;">Tawarkan</button>
                    </div>
                </div>
                    `
                L.marker([data.enduser.latitude, data.enduser.longitude], {icon: redIcon}).bindPopup(isiRed).addTo(map)
                isiRed = ''
                // console.log(isiGreen)
            } else {
            isiRed = `
            <div id="rowKel-${data.id_enduser}">
                <div class="row">
                    <div class="col-12">
                        <h4>${data.enduser.nama}</h4>
                    </div>
                    <div class="col-3">
                        <span>Membutuhkan</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.jenis.nama}</span>
                    </div>
                    <div class="col-3">
                        <span>Jumlah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.jumlah}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Daerah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.enduser.desa.kecamatan.nama}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Desa</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.enduser.desa.nama}</span>
                    </div>
                    <div class="col-12 pt-2 text-center">
                        <button data-toggle="modal" data-target="#penawaran" onclick="fillPenawaran(${data.id})" class="btn btn-sm btn-success" style="width: 50%;">Tawarkan</button>
                    </div>
                </div>
            </div>
            `

            idBeforeRed = data.id_enduser
            L.marker([data.enduser.latitude, data.enduser.longitude], {icon: redIcon}).bindPopup(isiRed).addTo(map)
            }
        }
        // console.log(isiGreen)


    } else if(auth == 'enduser'){
        var postinganRetailer = {!! json_encode($postinganRetailer ?? '') !!};
        console.log(postinganRetailer);
        var idBefore = 0;
        var isiGreen = '';
        postinganRetailer.forEach(postinganRetailerMarker)
        function postinganRetailerMarker(data, index) {
            if (data.id_retailer == idBefore) {
                // console.log('ini kedua')
                isiGreen += `
                <hr>
                <div class="row">
                    <div class="col-3">
                        <span>Menjual</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.jenis.nama}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Harga/Kg</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.harga}</span>
                    </div>
                    <div class="col-3">
                        <span>Stok</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.stok}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Daerah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.retailer.desa.kecamatan.nama}</span>
                    </div>
                    <div class="col-3">
                        <span>Keterangan</span>
                    </div>
                    <div class="col-9">
                        <span class="float-left">:</span>
                        <span class="float-right text-right">${data.keterangan}</span>
                    </div>
                    <div class="col-12 pt-2 text-center">
                        <button data-toggle="modal" data-target="#pemesanan" onclick="fillPemesanan(${data.id})" class="btn btn-sm btn-success" style="width: 50%;">Pesan</button>
                    </div>
                </div>
                    `
                L.marker([data.retailer.latitude, data.retailer.longitude], {icon: greenIcon}).bindPopup(isiGreen).addTo(map)
                isiGreen = ''
                // console.log(isiGreen)
            } else {
            isiGreen = `
            <div id="rowKel-${data.id_retailer}">
                <div class="row">
                    <div class="col-12">
                        <h4>${data.retailer.nama}</h4>
                    </div>
                    <div class="col-3">
                        <span>Menjual</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.jenis.nama}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Harga/Kg</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.harga}</span>
                    </div>
                    <div class="col-3">
                        <span>Stok</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.mangga.stok}</span>
                    </div>
                    <div class="col-3 border-left">
                        <span>Daerah</span>
                    </div>
                    <div class="col-3">
                        <span class="float-left">:</span>
                        <span class="float-right">${data.retailer.desa.kecamatan.nama}</span>
                    </div>
                    <div class="col-3">
                        <span>Keterangan</span>
                    </div>
                    <div class="col-9">
                        <span class="float-left">:</span>
                        <span class="float-right text-right">${data.keterangan}</span>
                    </div>
                    <div class="col-12 pt-2 text-center">
                        <button data-toggle="modal" data-target="#pemesanan" onclick="fillPemesanan(${data.id})" class="btn btn-sm btn-success" style="width: 50%;">Pesan</button>
                    </div>
                </div>
            </div>
            `

            idBefore = data.id_retailer
            L.marker([data.retailer.latitude, data.retailer.longitude], {icon: greenIcon}).bindPopup(isiGreen).addTo(map)
            }
        }
    } 

    // var isiRed = `
    //     <div class="row">
    //         <div class="col-12">
    //             <h4>Pa Dadang</h4>
    //         </div>
    //         <div class="col-6">
    //             <span>Membutuhkan</span>
    //         </div>
    //         <div class="col-6">
    //             <span class="float-left">:</span>
    //             <span class="float-right">Mangga Muda</span>
    //         </div>
    //         <div class="col-6">
    //             <span>Jumlah</span>
    //         </div>
    //         <div class="col-6">
    //             <span class="float-left">:</span>
    //             <span class="float-right">10 Kg</span>
    //         </div>
    //     </div>
    // `;

    // L.marker([latitude-5, longitude-5], {icon: redIcon}).bindPopup(isiRed).addTo(map);
    L.control.layers(baseLayers).addTo(map);
    // L.marker([-1.605328, 117.451067]).addTo(map);

</script>

@endpush
