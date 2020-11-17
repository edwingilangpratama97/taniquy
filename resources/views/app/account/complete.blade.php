@include('app.layouts.header')
<style type="text/css">
    #map {
        height: 275px;
        width: 100%;
    }
</style>
<body>
    <div id="auth">        
    <div class="container">
        <div class="auth-logo">  
            <img src="{{asset('images/logo.png')}}" height="100" class='mb-4'><br>
        </div>
        <div class="row">
            <div class="col-6">
                <h5 class="py-2">Mohon Lengkapi Data Diri Anda</h5>
            </div>
            <div class="col-6">
                <div class="float-right">  
                    <a class="btn btn-warning" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('completeAccount', $auth->id) }}"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <input id="latitude" type="hidden" name="latitude" />
            <input id="longitude" type="hidden" name="longitude" />
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name-column">Username</label>
                                    <input id="name-column" type="name" class="form-control @error('name') is-invalid @enderror" name="text" value="{{$auth->name}}" readonly="">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email-column">Email</label>
                                    <input id="email-column" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$auth->email}}" readonly="">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="kontak-column">Kontak</label>
                                    @if($auth->id_kelompok != null)
                                    <input id="kontak-column" type="numeric" class="form-control @error('kontak') is-invalid @enderror" name="kontak" value="{{$auth->kelompok->kontak}}"  autocomplete="kontak" readonly="">
                                    @elseif($auth->id_retailer != null)
                                    <input id="kontak-column" type="numeric" class="form-control @error('kontak') is-invalid @enderror" name="kontak" value="{{$auth->retailer->kontak}}"  autocomplete="kontak" readonly="">
                                    @elseif($auth->id_enduser != null)
                                    <input id="kontak-column" type="numeric" class="form-control @error('kontak') is-invalid @enderror" name="kontak" value="{{$auth->enduser->kontak}}"  autocomplete="kontak" readonly="">
                                    @endif
                                    @error('kontak')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="role-column">Role</label>
                                    <input id="role-column" type="role" class="form-control @error('role') is-invalid @enderror" name="role" value="{{$auth->role}}" readonly="">
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="map"></div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label for="latitude-view">Latitude</label>
                                <input type="text" id="latitude-view" class="form-control @error('latitude') is-invalid @enderror" readonly>
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
                                <input type="text" id="longitude-view" class="form-control @error('longitude') is-invalid @enderror" readonly>
                                @error('longitude')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-block" onclick="getLocation()">Lokasi Saya</button>
                        <small>*) Klik untuk mendapatkan lokasi anda saat ini</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            @if($auth->id_kelompok != null)
                            <label>ID Kelompok Tani</label>
                            <input type="text" class="form-control" value="{{$auth->kelompok->kode_kelompok}}" readonly="">
                            @elseif($auth->id_retailer != null)
                            <label>ID Retailer</label>
                            <input type="text" class="form-control" value="{{$auth->retailer->kode_retailer}}" readonly="">
                            @elseif($auth->id_enduser != null)
                            <label>ID Customer</label>
                            <input type="text" class="form-control" value="{{$auth->enduser->kode_enduser}}" readonly="">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="nama-column">Nama Lengkap</label>
                            <input id="nama-column" type="numeric" class="form-control @error('nama') is-invalid @enderror" name="nama" >
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if($auth->id_kelompok != null)
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="ketua-column">Nama Ketua</label>
                            <input id="ketua-column" type="numeric" class="form-control @error('ketua') is-invalid @enderror" name="ketua" value="{{$auth->kelompok->ketua}}"  autocomplete="ketua">
                            @error('ketua')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="foto_ketua-column">Foto Ketua</label>
                            <input type="file"  id="foto_ketua-column" class="form-control @error('foto_ketua') is-invalid @enderror" name="foto_ketua">
                            @error('foto_ketua')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @elseif($auth->id_retailer != null)
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="jenis_usaha-column">Jenis Usaha</label>
                            <select id="jenis_usaha-column" class="form-control @error('jenis_usaha') is-invalid @enderror" name="jenis_usaha">
                                <option value="Perorangan">Perorangan</option>
                                <option value="CV">CV</option>
                                <option value="PT">PT</option>
                            </select>
                            @error('jenis_usaha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="foto-column">Foto</label>
                            <input id="foto-column" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @elseif($auth->id_enduser != null)
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="tgl_lahir-column">Tanggal Lahir</label>
                            <input id="tgl_lahir-column" type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{$auth->enduser->tgl_lahir}}"  autocomplete="tgl_lahir">
                            @error('tgl_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="jenis_kelamin-column">Jenis Kelamin</label>
                            <select id="jenis_kelamin-column" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                <option value="L">Pria</option>
                                <option value="P">Wanita</option>
                            </select>
                            @error('jenis_kelamin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="foto-column">Foto</label>
                            <input id="foto-column" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @endif
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
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3">
                                @if($auth->id_kelompok != null)
                                    {{$auth->kelompok->alamat}}
                                @elseif($auth->id_retailer != null)
                                    {{$auth->retailer->alamat}}
                                @elseif($auth->id_enduser != null)
                                    {{$auth->enduser->alamat}}
                                @endif
                            </textarea>
                            @error('alamat')
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
            <div class="clearfix mt-3">
                <button type="submit" class="btn btn-success float-right">Submit</button>
            </div>
        </div>
        </form>
    </div>

    @include('app.layouts.footer')
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

        function success(gotPosition) {
          var uLat = gotPosition.coords.latitude;
          var uLon = gotPosition.coords.longitude;
          // console.log(uLat,uLon);
          document.getElementById('latitude').value = uLat;
          document.getElementById('longitude').value = uLon;
          document.getElementById('latitude-view').value = uLat;
          document.getElementById('longitude-view').value = uLon;
          map.setView(new L.LatLng(uLat, uLon), 15);
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
</body>

</html>

