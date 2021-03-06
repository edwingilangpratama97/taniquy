@extends('app.layouts.index')

@section('content')
<style type="text/css">
    #map {
        width: 100%;
        height: 310px;
    }
    .form-group .label {
        font-size: 0.755rem;
        text-transform: uppercase;
        color: rgba(35, 28, 99, 0.7);
        font-weight: 500;
    }
</style>
{{--Start form Untuk Retailer --}}
    @if (Auth::user()->id_kelompok != null)
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <div class="float-left">
                                    <h4 class="card-title">Pilih Lokasi Anda</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                    <div class="card-body">
                        <div id="map"></div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label for="latitude-view">Latitude</label>
                                <input type="text" id="latitude-view" class="form-control @error('latitude') is-invalid @enderror" value="{{$kelompok->latitude}}"  readonly>
                                @error('latitude')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label for="longitude-view">Longitude</label>
                                <input type="text" id="longitude-view" class="form-control @error('longitude') is-invalid @enderror"  value="{{$kelompok->longitude}}" readonly>
                                @error('longitude')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" onclick="getLocation()">Lokasi Saya</button>
                        <small>*) Klik untuk mendapatkan lokasi anda saat ini</small>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <div class="float-left">
                                    <h4 class="card-title">Akun Aplikasi</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <a href="{{route('account')}}" class="btn btn-sm icon btn-warning p-2"><i data-feather="arrow-left" class="mr-2"></i> Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <form class="form form-vertical" action="{{route('updateAccountKelompok',$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label">Nama Akun</label>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                        <input type="text" id="first-name" class="form-control @error('name') is-invalid @enderror" name="name"
                                            placeholder="Nama Akun Aplikasi" value="{{$data->name}}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{{$message}}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label">Email Akun</label>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                        <input type="text" id="last-name" class="form-control @error('email') is-invalid @enderror" name="email"
                                            placeholder="Last Name" value="{{$data->email}}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{{$message}}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Data Diri
                        </div>
                    </div>
                    <div class="card-content">
                    <div class="card-body">
                            <div class="form-body">
                                <input id="latitude" type="hidden" name="latitude"  value="{{$kelompok->latitude}}"/>
                                <input id="longitude" type="hidden" name="longitude"  value="{{$kelompok->longitude}}"/>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                        <label for="nama-vertical">Nama Kelompok</label>
                                        <input type="text" id="nama-vertical" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                            placeholder="Nama Kelompok" value="{{$kelompok->nama}}">

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
                                        <input type="text" id="ketua-vertical" class="form-control @error('ketua') is-invalid @enderror" name="ketua" placeholder="Nama Ketua" value="{{$kelompok->ketua}}">
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
                                            placeholder="Kontak" value="{{$kelompok->kontak}}">
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
                                            <select class="form-select @error('provinsi') is-invalid @enderror" id="provinsi-select" name="provinsi">
                                                <option value="">-- Pilih Disini --</option>
                                                @foreach($provinsi as $p)
                                                <option value="{{$p->id}}">{{$p->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('provinsi')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{{$message}}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="kabupaten-select">Kabupaten</label>
                                            <select class="form-select @error('kabupaten') is-invalid @enderror" id="kabupaten-select" name="kabupaten">
                                                <option value="">-- Pilih Disini --</option>
                                            </select>
                                            @error('kabupaten')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{{$message}}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="kecamatan-select">Kecamatan</label>
                                            <select class="form-select @error('kecamatan') is-invalid @enderror" id="kecamatan-select" name="kecamatan">
                                                <option value="">-- Pilih Disini --</option>
                                            </select>
                                            @error('kecamatan')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{{$message}}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="desa-select">Desa</label>
                                            <select class="form-select @error('desa') is-invalid @enderror" id="desa-select" name="desa">
                                                <option value="">-- Pilih Disini --</option>
                                            </select>
                                            @error('desa')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{{$message}}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="alamat" class="form-label">Alamat Detail</label>
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3"> {{$kelompok->alamat}}</textarea>
                                            @error('alamat')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{{$message}}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1"><i class="md mdi-check"></i> Simpan</button>
                                        {{-- <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button> --}}
                                    </div>
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
    @elseif (Auth::user()->id_komunitas != null)
    @endif
{{-- End Untuk retailer --}}
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

    var latitudeNow = {{$kelompok->latitude}};
    var longitudeNow = {{$kelompok->longitude}}

    var map = new L.Map('map', {
      'center': [latitudeNow, longitudeNow],
      'zoom': 5,
      'layers': [streets]
    });

    var marker = L.marker([latitudeNow, longitudeNow],{
      draggable: true
    }).addTo(map);
    L.control.layers(baseLayers).addTo(map);

    marker.on('dragend', function (e) {
      document.getElementById('latitude').value = marker.getLatLng().lat;
      document.getElementById('longitude').value = marker.getLatLng().lng;
      document.getElementById('latitude-view').value = marker.getLatLng().lat;
      document.getElementById('longitude-view').value = marker.getLatLng().lng;
    });


    function getLocation(){

    // get users lat/long

    var getPosition = {
      enableHighAccuracy: false,
      timeout: 9000,
      maximumAge: 0
    };

    console.log(getPosition);

    function success(gotPosition) {
      var uLat = gotPosition.coords.latitude;
      var uLon = gotPosition.coords.longitude;
      // console.log(uLat,uLon);
      document.getElementById('latitude').value = uLat;
      document.getElementById('longitude').value = uLon;
      document.getElementById('latitude-view').value = uLat;
      document.getElementById('longitude-view').value = uLon;
      map.setView(new L.LatLng(uLat, uLon), 10);
      map.removeLayer(marker);
      marker = L.marker([uLat, uLon],{
          draggable: true
        }).addTo(map);
      marker.on('dragend', function (e) {
        document.getElementById('latitude').value = marker.getLatLng().lat;
        document.getElementById('longitude').value = marker.getLatLng().lng;
        document.getElementById('latitude-view').value = marker.getLatLng().lat;
        document.getElementById('longitude-view').value = marker.getLatLng().lng;
      });
      // console.log(`${uLat}`, `${uLon}`);

    };

    function error(err) {
      console.warn(`ERROR(${err.code}): ${err.message}`);
    };

    navigator.geolocation.getCurrentPosition(success, error, getPosition);
    };
</script>
@endpush
