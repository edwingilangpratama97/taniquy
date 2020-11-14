@extends('app.layouts.index')

@section('content')
<section id="basic-vertical-layouts">
<div class="row mb-2">
    <div class="col-7 col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item"><a href="{{route('postingan.index')}}">Postingan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
    <div class="col-5 col-md-6">
        <span class="float-right">
            <a href="{{route('postingan.index')}}" class="btn btn-sm icon btn-warning p-2"><i data-feather="arrow-left" class="mr-2"></i>Kembali</a>
        </span>
    </div>
</div>
<div class="row match-height">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
            <h4 class="card-title">
                Tambah Postingan
            </h4>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('postingan.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mangga-select">Mangga</label>
                                <select class="form-select @error('id_mangga') is-invalid @enderror" id="mangga-select" name="id_mangga">
                                    <option value="">-- Pilih Disini --</option>
                                    @foreach($mangga as $p)
                                    @if($p->id_retailer != null)
                                    <option value="{{$p->id}}">Jenis Mangga : {{$p->jenis->nama}}, Retailer : {{($p->retailer->nama)}}</option>
                                    @elseif($p->id_kelompok != null)
                                    <option value="{{$p->id}}">Jenis Mangga : {{$p->jenis->nama}}, Kelompok : {{($p->kelompok->nama)}}</option>
                                    @endif
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
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="5"></textarea>
                                @error('keterangan')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
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
@endpush
