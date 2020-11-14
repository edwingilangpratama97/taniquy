@extends('app.layouts.index')

@section('content')
<section id="basic-vertical-layouts">
<div class="row mb-2">
    <div class="col-7 col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item"><a href="{{route('pemesanan.index')}}">Pemesanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="col-5 col-md-6">
        <span class="float-right">
            <a href="{{route('pemesanan.index')}}" class="btn btn-sm icon btn-warning p-2"><i data-feather="arrow-left" class="mr-2"></i>Kembali</a>
        </span>
    </div>
</div>
<div class="row match-height">
    <div class="col-md-6 col-12 mx-auto">
        <div class="card">
            <div class="card-header">
            <h4 class="card-title">
                Edit Pemesanan
            </h4>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('pemesanan.update',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        @if(Auth::user()->role == 'admin')
                        <div class="col-12">
                            <div class="form-group">
                                <label for="role-select">Role Pemesan</label>
                                <input type="text" class="form-control" name="role" value="{{$role}}" readonly="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pemesan-select">Pemesan</label>
                                <input type="text" class="form-control" name="pemesan" value="{{$pemesan->nama}}" readonly="">
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="form-group">
                                <label for="postingan-select">Postingan</label>
                                <input type="text" class="form-control" name="postingan" value="{{$postingan->kode_postingan}}" readonly="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="postingan-select">Jumlah (Kg)</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{$data->jumlah}}">
                                @error('jumlah')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status-select">Status Pembayaran</label>
                                <select class="form-control" name="status_pembayaran">
                                    <option value="0">Belum Dibayar</option>
                                    <option value="1">Sudah Dibayar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status-select">Status Penerimaan</label>
                                <select class="form-control" name="status_penerimaan">
                                    <option value="0">Belum Diterima</option>
                                    <option value="1">Sudah Diterima</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-1 mb-1"><i class="mdi mdi-check"></i> Save</button>
                        {{-- <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button> --}}
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
<script type="text/javascript">
</script>
@endpush
