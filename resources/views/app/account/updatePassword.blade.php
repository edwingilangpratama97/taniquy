@extends('app.layouts.index')

@section('content')
<section id="basic-vertical-layouts">
<div class="row match-height">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <div class="float-left">
                        <h4 class="card-title">Update Password</h4>
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-right">
                        <a href="{{route('account')}}" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('updateAccountAdmin',$data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">Nama User</label>
                            <input type="text" id="first-name-vertical" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama User !" value="{{$data->name}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            <label for="first-name-vertical">E-mail</label>
                            <input type="email" id="first-name-vertical" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="email User !" value="{{$data->email}}">
                            @error('email')
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
