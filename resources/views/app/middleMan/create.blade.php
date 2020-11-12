@extends('app.layouts.index')

@section('content')
<style type="text/css">
    #map {
        width: 100%;
        height: 400px;
    }
    .form-group .label {
        font-size: 0.755rem;
        text-transform: uppercase;
        color: rgba(35, 28, 99, 0.7);
        font-weight: 500;
    }
</style>
<section id="basic-vertical-layouts">
<div class="row mb-2">
    <div class="col-7 col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item"><a href="{{route('retailer.index')}}">Retailer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
    <div class="col-5 col-md-6">
        <span class="float-right">
            <a href="{{route('retailer.index')}}" class="btn btn-sm icon btn-warning p-2"><i data-feather="arrow-left" class="mr-2"></i>Kembali</a>
        </span>
    </div>
</div>
<div class="row match-height">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
            <h4 class="card-title">Pilih Lokasi</h4>
            </div>
            <div class="card-content">
            <div class="card-body">
                <div id="map"></div>
                <button class="btn btn-primary btn-block mt-4" onclick="getLocation()">Lokasi Saya</button>
                <small>*) Klik untuk mendapatkan lokasi anda saat ini</small>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
            <h4 class="card-title">
                Tambah Kelompok Tani
            </h4>
            </div>
            <div class="card-content">
            <div class="card-body">
                <form class="form form-vertical" action="{{route('kelompok.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <input id="latitude" type="hidden" name="latitude" />
                    <input id="longitude" type="hidden" name="longitude" />
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="nama-vertical">Nama Kelompok</label>
                            <input type="text" id="nama-vertical" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Nama Kelompok">

                            @error('nama')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{{$message}}}
                            </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                            <label for="ketua-vertical">Nama Ketua</label>
                            <input type="text" id="ketua-vertical" class="form-control @error('ketua') is-invalid @enderror" name="ketua" placeholder="Nama Ketua">
                            @error('ketua')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{{$message}}}
                            </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                            <label for="kontak-vertical">Kontak</label>
                            <input type="text" id="kontak-vertical" class="form-control @error('kontak') is-invalid @enderror" name="kontak"
                                placeholder="Kontak">
                            @error('kontak')
                            <div class="invalid-feedback">
                                <i class="bx bx-radio-circle"></i>
                                {{{$message}}}
                            </div>
                            @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <span class="label">Foto ketua</span>
                                <div class="form-file">
                                    <input type="file" class="form-file-input @error('foto_ketua') is-invalid @enderror" name="foto_ketua" id="foto_ketua">
                                    <label class="form-file-label" for="foto_ketua">
                                        <span class="form-file-text">Pilih Foto...</span>
                                        <span class="form-file-button">Browse</span>
                                    </label>
                                    @error('foto_ketua')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{{$message}}}
                                    </div>
                                    @enderror
                                </div>
                                {{-- <label for="foto_ketua">Foto Ketua</label>
                                <input type="file" class="form-file-input" id="foto_ketua">
                                <label class="form-file-label" for="foto_ketua">
                                    <span class="form-file-text">Pilih Foto...</span>
                                    <span class="form-file-button">Browse</span>
                                </label> --}}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="provinsi-select">Provinsi</label>
                                <select class="form-select" id="provinsi-select">
                                    <option value="">-- Pilih Disini --</option>
                                    @foreach($provinsi as $p)
                                    <option value="{{$p->id}}">{{$p->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kabupaten-select">Kabupaten</label>
                                <select class="form-select" id="kabupaten-select">
                                    <option value="">-- Pilih Disini --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kecamatan-select">Kecamatan</label>
                                <select class="form-select" id="kecamatan-select">
                                    <option value="">-- Pilih Disini --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="desa-select">Desa</label>
                                <select class="form-select" id="desa-select" name="id_desa">
                                    <option value="">-- Pilih Disini --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat Detail</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3"></textarea>
                                @error('alamat')
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
    $('#provinsi-select').change(function() {
        var valueProv = $('#provinsi-select').val();
        console.log('Provinsi Id : '+valueProv);
        getKabupaten(valueProv);
    });

    $('#kabupaten-select').change(function() {
        var valueKab = $('#kabupaten-select').val();
        console.log('Kabupaten Id : '+valueKab);
        getKecamatan(valueKab);
    });

    $('#kecamatan-select').change(function() {
        var valueKec = $('#kecamatan-select').val();
        console.log('Kecamatan Id : '+valueKec);
        getDesa(valueKec);
    });

    $('#desa-select').change(function() {
        var valueDesa = $('#desa-select').val();
        console.log('Desa Id : '+valueDesa);
    });

    function getKabupaten(id) {
        $.ajax({
          url: '/api/v1/getKabupaten/'+id,
          type: 'GET',
          cache: false,
          dataType: 'json',
          success: function(json) {
            // alert(json.data);
            // console.log(json.data);
              $("#kabupaten-select").html('');
              if (json.code == 200) {
                  for (i = 0; i < Object.keys(json.data).length; i++) {
                      // console.log(json.data[i].nama);
                      $('#kabupaten-select').append($('<option>').text(json.data[i].nama).attr('value', json.data[i].id));
                  }

              } else {
                  $('#kabupaten-select').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
              }
          }
        });
    }

    function getKecamatan(id) {
        $.ajax({
          url: '/api/v1/getKecamatan/'+id,
          type: 'GET',
          cache: false,
          dataType: 'json',
          success: function(json) {
            // alert(json.data);
            // console.log(json.data);
              $("#kecamatan-select").html('');
              if (json.code == 200) {
                  for (i = 0; i < Object.keys(json.data).length; i++) {
                      // console.log(json.data[i].nama);
                      $('#kecamatan-select').append($('<option>').text(json.data[i].nama).attr('value', json.data[i].id));
                  }

              } else {
                  $('#kecamatan-select').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
              }
          }
        });
    }

    function getDesa(id) {
        $.ajax({
          url: '/api/v1/getDesa/'+id,
          type: 'GET',
          cache: false,
          dataType: 'json',
          success: function(json) {
            // alert(json.data);
            // console.log(json.data);
              $("#desa-select").html('');
              if (json.code == 200) {
                  for (i = 0; i < Object.keys(json.data).length; i++) {
                      // console.log(json.data[i].nama);
                      $('#desa-select').append($('<option>').text(json.data[i].nama).attr('value', json.data[i].id));
                  }

              } else {
                  $('#desa-select').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
              }
          }
        });
    }

    var mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
    var satelite   = L.tileLayer(mbUrl, {id: 'mapbox/satellite-v9', tileSize: 512, zoomOffset: -1}),
        streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1});


    var baseLayers = {
        "Satelite": satelite,
        "Streets": streets
    };



    var map = new L.Map('map', {
      'center': [-1.605328, 117.451067],
      'zoom': 5,
      'layers': [streets]
    });

    var marker = L.marker([-1.605328, 117.451067],{
      draggable: true
    }).addTo(map);
    L.control.layers(baseLayers).addTo(map);

    marker.on('dragend', function (e) {
      document.getElementById('latitude').value = marker.getLatLng().lat;
      document.getElementById('longitude').value = marker.getLatLng().lng;
    });


    function getLocation(){

    // get users lat/long

    var getPosition = {
      enableHighAccuracy: false,
      timeout: 9000,
      maximumAge: 0
    };

    function success(gotPosition) {
      var uLat = gotPosition.coords.latitude;
      var uLon = gotPosition.coords.longitude;
      document.getElementById('latitude').value = uLat;
      document.getElementById('longitude').value = uLon;
      map.setView(new L.LatLng(uLat, uLon), 10);
      map.removeLayer(marker);
      marker = L.marker([uLat, uLon],{
          draggable: true
        }).addTo(map);
      // console.log(`${uLat}`, `${uLon}`);

    };

    function error(err) {
      console.warn(`ERROR(${err.code}): ${err.message}`);
    };

    navigator.geolocation.getCurrentPosition(success, error, getPosition);
    };
</script>
@endpush
