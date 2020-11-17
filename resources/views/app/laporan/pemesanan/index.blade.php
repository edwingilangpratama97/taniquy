@extends('app.layouts.index')

@section('content')
<div class="page-title">

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Laporan Pemesanan</h3>
            <p class="text-subtitle text-muted">Laporan Untuk Data Pemesanan</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section id="basic-vertical-layouts">
<div class="row match-height">
    <div class="col-md-12 col-12">
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
        <div class="card">
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('laporan.pemesanan.pdf')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="first-name-vertical">Tanggal Awal</label>
                            <input type="date" id="first-name-vertical" class="form-control @error('awal') is-invalid @enderror" name="awal" placeholder="awal" value="{{ old('awal') }}">
                            @error('awal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="first-name-vertical">Tanggal Akhir</label>
                                <input type="date" id="first-name-vertical" class="form-control @error('akhir') is-invalid @enderror" name="akhir" placeholder="akhir" value="{{ old('akhir') }}">
                                @error('akhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-vertical">Pilih Role</label>
                                <select name="role" id="" class="form-control">
                                    <option value="enduser">End User</option>
                                    <option value="retailer">Retailer</option>
                                </select>
                                @error('akhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1 mb-1"><i class="mdi mdi-download"></i> Download Laporan</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
@push('script')

@endpush
