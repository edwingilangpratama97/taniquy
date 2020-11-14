@extends('app.layouts.index')

@section('content')
<section id="basic-vertical-layouts">
<div class="row mb-2">
    <div class="col-7 col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item"><a href="{{route('penawaran.index')}}">Penawaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
    <div class="col-5 col-md-6">
        <span class="float-right">
            <a href="{{route('penawaran.index')}}" class="btn btn-sm icon btn-warning p-2"><i data-feather="arrow-left" class="mr-2"></i>Kembali</a>
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
                <form class="form form-vertical" action="{{route('penawaran.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">
                        @if(Auth::user()->role == 'admin')
                        <div class="col-12">
                            <div class="form-group">
                                <label for="role-select">Role Penjual</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role-select" name="role">
                                    <option value="">-- Pilih Disini --</option>
                                    <option value="retailer">Retailer</option>
                                    <option value="kelompok">Kelompok Tani</option>
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
                                <label for="penjual-select">Penjual</label>
                                <select class="form-select @error('penjual') is-invalid @enderror" id="penjual-select" name="penjual">
                                    <option value="">-- Pilih Disini --</option>
                                </select>
                                @error('penjual')
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
                                <label for="kebutuhan-select">Pilih Postingan Kebutuhan</label>
                                <select class="form-select @error('id_kebutuhan') is-invalid @enderror" id="kebutuhan-select" name="id_kebutuhan">
                                    <option value="">-- Pilih Disini --</option>
                                    {{-- @foreach($postingan as $p)
                                    @if($p->id_retailer != null)
                                    <option value="{{$p->id}}">Jenis Mangga : {{$p->mangga->jenis->nama}}, Retailer : {{($p->retailer->nama)}}, Jumlah : {{$p->mangga->stok}} Kg</option>
                                    @elseif($p->id_kelompok != null)
                                    <option value="{{$p->id}}">Jenis Mangga : {{$p->mangga->jenis->nama}}, Kelompok : {{($p->kelompok->nama)}}, Jumlah : {{$p->mangga->stok}} Kg</option>
                                    @endif
                                    @endforeach --}}
                                </select>
                                @error('id_kebutuhan')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mangga-select">Pilih Mangga</label>
                                <select class="form-select @error('id_mangga') is-invalid @enderror" id="mangga-select" name="id_mangga">
                                    <option value="">-- Pilih Disini --</option>
                                </select>
                                @error('id_mangga')
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
        getManggaPenawaran(value);
    });

    function getManggaPenawaran(value){
        $.ajax({
          url: '/api/v1/getManggaPenawaran/'+value,
          type: 'GET',
          cache: false,
          dataType: 'json',
          success: function(json) {
            $("#mangga-select").html('');
            $("#kebutuhan-select").html('');
            $("#penjual-select").html('');
            if (json.code == 200) {
              for (i = 0; i < Object.keys(json.data).length; i++) {
                  // console.log(json.data[i].nama);
                  $('#mangga-select').append($('<option>').text(json.data[i].jenis.nama).attr('value', json.data[i].id));
              }
              for (i = 0; i < Object.keys(json.kebutuhan).length; i++) {
                  // console.log(json.data[i].nama);
                  $('#kebutuhan-select').append($('<option>').text('Kode : '+json.kebutuhan[i].kode_kebutuhan).attr('value', json.kebutuhan[i].id));
              }
              for (i = 0; i < Object.keys(json.penjual).length; i++) {
                  // console.log(json.data[i].nama);
                  $('#penjual-select').append($('<option>').text('Nama : '+json.penjual[i].nama).attr('value', json.penjual[i].id));
              }

            } else {
              $('#mangga-select').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
              $('#kebutuhan-select').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
            }
          }
        });
    }
</script>
@endpush
