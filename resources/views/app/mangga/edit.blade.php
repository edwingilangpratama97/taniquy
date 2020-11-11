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
            <h4 class="card-title">Create Data</h4>
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
                            <input type="number" min="0" id="first-name-vertical" class="form-control" name="harga" placeholder="Harga">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">Stok</label>
                            <input type="number" min="0" id="first-name-vertical" class="form-control" name="stok" placeholder="Stok">
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
                        <div class="col-12">
                                <div class="form-group">
                                <label for="first-name-vertical">Foto</label>
                                <input type="file" id="first-name-vertical" class="form-control" name="foto" placeholder="Foto">
                                </div>
                            </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Save</button>
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
