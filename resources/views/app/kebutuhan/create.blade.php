@extends('app.layouts.index')

@section('content')
<section id="basic-vertical-layouts">
<div class="row mb-2">
    <div class="col-7 col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item"><a href="{{route('kebutuhan.index')}}">Kebutuhan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
            <h4 class="card-title">
                Tambah Kebutuhan
            </h4>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('kebutuhan.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">
                        @if(Auth::user()->role == 'admin')
                        <div class="col-12">
                            <div class="form-group">
                                <label for="role-select">Role Pemesan</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role-select" name="role">
                                    <option value="">-- Pilih Disini --</option>
                                    <option value="retailer">Retailer</option>
                                    <option value="enduser">Pelanggan(Enduser)</option>
                                </select>
                                @error('role')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pemesan-select">Pemesan</label>
                                <select class="form-select @error('pemesan') is-invalid @enderror" id="pemesan-select" name="pemesan">
                                    <option value="">-- Pilih Disini --</option>
                                </select>
                                @error('pemesan')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jenis-select">Jenis Mangga</label>
                                <select class="form-select @error('id_jenis') is-invalid @enderror" id="jenis-select" name="id_jenis">
                                    <option value="">-- Pilih Disini --</option>
                                    @foreach($jenis as $p)
                                    <option value="{{$p->id}}">Jenis Mangga : {{$p->nama}}</option>
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
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror">
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
    $('#role-select').change(function() {
        var value = $('#role-select').val();
        getPemesan(value);
    });

    function getPemesan(value){
        $.ajax({
          url: '/api/v1/getPemesan/'+value,
          type: 'GET',
          cache: false,
          dataType: 'json',
          success: function(json) {
            $("#pemesan-select").html('');
            if (json.code == 200) {
              for (i = 0; i < Object.keys(json.data).length; i++) {
                  // console.log(json.data[i].nama);
                  $('#pemesan-select').append($('<option>').text(json.data[i].nama).attr('value', json.data[i].id));
              }

            } else {
              $('#pemesan-select').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
            }
          }
        });
    }
</script>
@endpush
