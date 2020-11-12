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
                        <h4>Create Data</h4>
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-right">
                        <a href="#" class="text-primary"><i class ="mdi-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical">
                <div class="form-body">
                    <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                        <label for="first-name-vertical">First Name</label>
                        <input type="text" id="first-name-vertical" class="form-control" name="fname"
                            placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                        <label for="email-id-vertical">Email</label>
                        <input type="email" id="email-id-vertical" class="form-control" name="email-id"
                            placeholder="Email">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="customFile">Foto</label>
                            <input type="file" class="form-control" id="customFile" name="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Desa</label>
                            <select name="id_desa" id="" class="form-control">
                                <option value="">Hii</option>
                                {{-- @foreach ($desa as $item)
                                    <option value="{{$item->id}}">{{ $item->nama }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                        <label for="contact-info-vertical">Mobile</label>
                        <input type="number" id="contact-info-vertical" class="form-control" name="contact"
                            placeholder="Mobile">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                        <label for="password-vertical">Password</label>
                        <input type="password" id="password-vertical" class="form-control" name="contact"
                            placeholder="Password">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class='form-check'>
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox3" class='form-check-input' checked>
                                <label for="checkbox3">Remember Me</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1">save</button>
                        <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
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
