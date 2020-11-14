@extends('app.layouts.index')

@section('content')
<section id="basic-vertical-layouts">
<div class="row mb-2">
    <div class="col-7 col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item"><a href="{{route('kebutuhan.index')}}">Kebutuhan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="col-5 col-md-6">
        <span class="float-right">
            <a href="{{route('kebutuhan.index')}}" class="btn btn-sm icon btn-warning p-2"><i data-feather="arrow-left" class="mr-2"></i>Kembali</a>
        </span>
    </div>
</div>
<div class="row match-height">
    <div class="col-md-6 col-12 mx-auto">
        <div class="card">
            <div class="card-header">
            <h4 class="card-title">
                Edit Kebutuhan
            </h4>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('kebutuhan.update',$data->id)}}" method="post" enctype="multipart/form-data">
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
                        <input type="hidden" name="id_retailer" value="{{$data->id_retailer}}">
                        <input type="hidden" name="id_enduser" value="{{$data->id_enduser}}">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jenis-select">Jenis Mangga</label>
                                <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                                    @foreach($jenis as $p)
                                    <option value="{{$p->id}}">{{$p->nama}}</option>
                                    @endforeach
                                </select>
                                @error('jumlah')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
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
