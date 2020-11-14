@extends('app.layouts.index')

@section('content')
<section id="basic-vertical-layouts">
<div class="row mb-2">
    <div class="col-7 col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item"><a href="{{route('penawaran.index')}}">Penawaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                Edit Postingan
            </h4>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('penawaran.update',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="kode_penawaran">Kode Penawaran</label>
                                <input type="text" name="kode_penawaran" value="{{$data->kode_penawaran}}" class="form-control" readonly="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="id_kebutuhan">Kode Kebutuhan</label>
                                <input type="text" name="id_kebutuhan" value="{{$data->kebutuhan->kode_kebutuhan}}" class="form-control" readonly="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                @if($data->id_kelompok != null)
                                <label for="id_kelompok">Penjual (Penawar)</label>
                                <input type="text" name="id_kelompok" value="{{$data->kelompok->nama}}" class="form-control" readonly="">
                                @elseif($data->id_retailer != null)
                                <label for="id_retailer">Penjual (Penawar)</label>
                                <input type="text" name="id_retailer" value="{{$data->retailer->nama}}" class="form-control" readonly="">
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mangga-select">Pilih Mangga</label>
                                <select class="form-select @error('id_mangga') is-invalid @enderror" id="mangga-select" name="id_mangga">
                                    <option value="">-- Pilih Disini --</option>
                                    @foreach($mangga as $m)
                                    <option value="{{$m->id}}">{{$m->jenis->nama}}</option>
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
                                <label for="status-pembayaran-select">Status Pembayaran</label>
                                <select class="form-select @error('status_pembayaran') is-invalid @enderror" id="status-pembayaran-select" name="status_pembayaran">
                                    <option value="0">Belum Dibayar</option>
                                    <option value="1">Sudah Dibayar</option>
                                </select>
                                @error('status_pembayaran')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="status-penerimaan-select">Status Penerimaan</label>
                                <select class="form-select @error('status_penerimaan') is-invalid @enderror" id="status-penerimaan-select" name="status_penerimaan">
                                    <option value="0">Belum Diterima</option>
                                    <option value="1">Sudah Diterima</option>
                                </select>
                                @error('status_penerimaan')
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
