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
                        <a href="{{route('jenisMangga.index')}}" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('jenisMangga.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">Nama Jenis Mangga</label>
                            <input type="text" id="first-name-vertical" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-1 mb-1"><i class="mdi mdi-check"></i> Simpan</button>
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
