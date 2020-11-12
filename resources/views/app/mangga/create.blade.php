@extends('app.layouts.index')

@section('content')
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
            <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <div class="float-left">
                        <h4 class="card-title">Create Data</h4>
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-right">
                        <a href="{{route('mangga.index')}}" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('mangga.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">Harga</label>
                            <input type="number" min="0" id="first-name-vertical" class="form-control @error('harga') is-invalid @enderror" name="harga" placeholder="Harga">
                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">Stok</label>
                            <input type="number" min="0" id="first-name-vertical" class="form-control @error('stok') is-invalid @enderror" name="stok" placeholder="Stok">
                            @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">Jenis</label>
                            <select name="id_jenis" id="" class="form-control">
                                @foreach ($jenis as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">Jenis</label>
                            <select name="id_grade" id="" class="form-control">
                                @foreach ($grade as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                       @if (Auth::user()->role == "admin")
                       <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">User</label>
                            <select name="role" id="user" class="form-control">
                                <option value="">-- Pilih Role --</option>
                                <option value="kelompok">Kelompok Tani</option>
                                <option value="retailer">Retailer</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-12" id="show-kelompok">
                            <div class="form-group">
                            <label for="first-name-vertical">Kelompok Tani</label>
                            <select name="id_kelompok" id="" class="form-control">
                                    <option value="">-- Pilih kelompok Tani --</option>
                                @foreach ($kelompok as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-12" id="show-retailer">
                            <div class="form-group">
                            <label for="first-name-vertical">Retailer</label>
                            <select name="id_retailer" id="" class="form-control">
                                <option value="">-- Pilih retailer --</option>
                                @foreach ($retailer as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                       @endif
                        <div class="col-12">
                                <div class="form-group">
                                <label for="first-name-vertical">Foto</label>
                                <input type="file" id="first-name-vertical" class="form-control @error('foto') is-invalid @enderror" name="foto" placeholder="Foto">
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1 mb-1"><i class="mdi mdi-check"></i> Save</button>
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
    <script>
        $('#show-kelompok').hide();
        $('#show-retailer').hide();
        $('#user').change(function(event){
            var id = $(event.target).val();
            if (id == "") {
                $('#show-kelompok').hide();
                $('#show-retailer').hide();
            }
            if (id == "kelompok") {
                $('#show-kelompok').show();
                $('#show-retailer').hide();
            }
            if (id == "retailer") {
                $('#show-kelompok').hide();
                $('#show-retailer').show();
            }
        })
    </script>
@endpush
