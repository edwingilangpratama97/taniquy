@extends('app.layouts.index')

@section('content')
<div class="page-title">
    <p class="text-subtitle text-muted">Data Statistik Penjualan Mangga</p>
</div>
<section class="section">
    <div class="row mb-2">
        <div class="col-12">
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
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic success-before">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>BALANCE</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>$50 </p>
                            </div>
                        </div>
                        {{-- <div class="chart-wrapper">
                            <canvas id="canvas1" style="height:100px !important"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic danger-before">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>Revenue</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>$532,2 </p>
                            </div>
                        </div>
                        {{-- <div class="chart-wrapper">
                            <canvas id="canvas2" style="height:100px !important"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic warning-before">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>ORDERS</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>1,544 </p>
                            </div>
                        </div>
                        {{-- <div class="chart-wrapper">
                            <canvas id="canvas3" style="height:100px !important"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic primary-before">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>Sales Today</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>500 </p>
                            </div>
                        </div>
                        {{-- <div class="chart-wrapper">
                            <canvas id="canvas4" style="height:100px !important"></canvas>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='map'></div>
    <div class="float-right floating-group">
        @if(Auth::user()->role == 'kelompok')
        <div class="floating-postingan my-2" id="floating-postingan">
            <div class="row w-float">
                <div class="col-8 inline align-self-center">
                    <div class="card h-100 align-self-center">
                        <span class="floating-comment">Post Mangga</span>
                    </div>
                </div>
                <div class="col-4 py-2">
                    <button class="btn btn-warning btn-circle shadow" data-toggle="modal" data-target="#postingan">
                        <div class="d-flex justify-content-center">
                            <span class="plus-text text-center">
                                +
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->role == 'enduser')
        <div class="floating-kebutuhan my-2" id="floating-kebuthan">
            <div class="row w-float">
                <div class="col-8 inline align-self-center">
                    <div class="card h-100 align-self-center">
                        <span class="floating-comment">Post Kebutuhan</span>
                        <div class="triangle-right"></div>
                    </div>
                </div>
                <div class="col-4 py-2">
                    <button class="btn btn-success btn-circle shadow" data-toggle="modal" data-target="#kebutuhan">
                        <div class="d-flex justify-content-center">
                            <span class="plus-text text-center">
                                +
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->role == 'retailer')
        <div class="floating-postingan my-2" id="floating-postingan">
            <div class="row w-float">
                <div class="col-8 inline align-self-center">
                    <div class="card h-100 align-self-center">
                        <span class="floating-comment">Post Mangga</span>
                    </div>
                </div>
                <div class="col-4 py-2">
                    <button class="btn btn-warning btn-circle shadow" data-toggle="modal" data-target="#postingan">
                        <div class="d-flex justify-content-center">
                            <span class="plus-text text-center">
                                +
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <div class="floating-kebutuhan my-2" id="floating-kebuthan">
            <div class="row w-float">
                <div class="col-8 inline align-self-center">
                    <div class="card h-100 align-self-center">
                        <span class="floating-comment">Post Kebutuhan</span>
                    </div>
                </div>
                <div class="col-4 py-2">
                    <button class="btn btn-success btn-circle shadow" data-toggle="modal" data-target="#kebutuhan">
                        <div class="d-flex justify-content-center">
                            <span class="plus-text text-center">
                                +
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<div class="modal fade text-left" id="kebutuhan" tabindex="0" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-success">
        <h5 class="modal-title white" id="myModalLabel110">Posting Kebutuhan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
        </div>
        <form action="{{route('kebutuhan.store')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            @if(Auth::user()->role == 'retailer')
                            <input type="hidden" name="pemesan" value="{{Auth::user()->id_retailer}}">
                            @elseif(Auth::user()->role == 'enduser')
                            <input type="hidden" name="pemesan" value="{{Auth::user()->id_enduser}}">
                            @endif
                            <input type="hidden" name="role" value="{{Auth::user()->role}}">
                            <div class="form-group">
                                <label for="jenis-select">Jenis Mangga</label>
                                <select id="jenis-select" class="form-select @error('id_jenis') is-invalid @enderror" id="jenis-select" name="id_jenis">
                                    <option value="">-- Pilih Disini --</option>
                                    @foreach($jenis as $p)
                                    <option value="{{$p->id}}">{{$p->nama}}</option>
                                    @endforeach
                                </select>
                                @error('id_jenis')
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
                                <input id="jumlah" type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror">
                                @error('jumlah')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{{$message}}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <span>Saran Postingan Berdasarkan Kebutuhan Anda :</span>
                    <hr>
                    {{-- <div class="row"> --}}
                        <div id="result-relevan"></div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>

        <button type="submit" class="btn btn-success ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block"><i data-feather="send"></i> Post</span>
        </button>
        </form>
        </div>
    </div>
    </div>
</div>
<div class="modal fade text-left" id="postingan" tabindex="0" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header bg-warning">
        <h5 class="modal-title white" id="myModalLabel110">Posting/Jual Mangga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
        </div>
        <form action="{{route('postingan.store')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    @if(Auth::user()->role == 'retailer')
                    <input type="hidden" name="penjual" value="{{Auth::user()->id_retailer}}">
                    @elseif(Auth::user()->role == 'kelompok')
                    <input type="hidden" name="penjual" value="{{Auth::user()->id_kelompok}}">
                    @endif
                    <input type="hidden" name="role" value="{{Auth::user()->role}}">
                    <div class="form-group">
                        <label for="jenis-select">Mangga</label>
                        <select id="jenis-select" class="form-select @error('id_mangga') is-invalid @enderror" id="jenis-select" name="id_mangga">
                            <option value="">-- Pilih Disini --</option>
                            @foreach($mangga as $p)
                            <option value="{{$p->id}}">{{$p->jenis->nama}}</option>
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
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea id="keterangan" class="form-select @error('keterangan') is-invalid @enderror" name="keterangan" rows="6"></textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            <i class="bx bx-radio-circle"></i>
                            {{{$message}}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
        </button>

        <button type="submit" class="btn btn-warning ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block"><i data-feather="send"></i> Post</span>
        </button>
        </form>
        </div>
    </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $('#jenis-select').change(function() {
        var valueJenis = $('#jenis-select').val();
        console.log('Jenis ID : '+valueJenis);
        getByJenis(valueJenis,{{Auth::user()->id}});
    });

    function getByJenis(id,user_id) {
        $('#result-relevan').html(`
            <div class="d-flex justify-content-center my-4">
                <div class="spinner-grow text-success" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-success" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-success" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
            </div>
        `);
        $.ajax({
          url: '/api/v1/getByJenis/'+id,
          type: 'GET',
          data: {user:user_id},
          cache: false,
          dataType: 'json',
          success: function(json) {
            // alert(json.data);
            $('#result-relevan').html('');
            var postingan = json.data;
            if(postingan.length < 1){
                $('#result-relevan').html(`
                    <div class="d-flex justify-content-center my-4">
                        <h6 classs="text-center">~ Tidak Ada Postingan Yang Relevan ~</h6>
                    </div>
                `);
            } else {
                postingan.forEach(element => 
                    $('#result-relevan').append(`
                        <div class="row">
                        <div class="col-6">
                            ID Postingan
                        </div>
                        <div class="col-6">
                            <span class="float-left">:</span>
                            <span class="float-right">
                                ${element.kode_postingan}
                            </span>
                        </div>
                        <div class="col-6">
                            Jenis Mangga
                        </div>
                        <div class="col-6">
                            <span class="float-left">:</span>
                            <span class="float-right">
                                ${element.mangga.jenis.nama}
                            </span>
                        </div>
                        <div class="col-6">
                            Harga
                        </div>
                        <div class="col-6">
                            <span class="float-left">:</span>
                            <span class="float-right">
                                Rp. ${element.mangga.harga}
                            </span>
                        </div>
                        <div class="col-6">
                            Stok
                        </div>
                        <div class="col-6">
                            <span class="float-left">:</span>
                            <span class="float-right">
                                ${element.mangga.stok} Kg
                            </span>
                        </div>  
                        <div class="col-12 mt-2">
                            <a href="#" class="float-right">
                                <button type="button" class="btn btn-success">Pesan</button>
                            </a>
                        </div>
                        </div>
                        <hr>
                    `)
                );
            }
              // $("#kabupaten-select").html('');
              // if (json.code == 200) {
              //     for (i = 0; i < Object.keys(json.data).length; i++) {
              //         // console.log(json.data[i].nama);
              //         $('#kabupaten-select').append($('<option>').text(json.data[i].nama).attr('value', json.data[i].id));
              //     }

              // } else {
              //     $('#kabupaten-select').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
              // }
          }
        });
    }

    var mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

    var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1}),
        streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1});

    var map = L.map('map', {
        center: [-1.605328, 117.451067],
        zoom: 5,
        layers: [streets]
    });

    var baseLayers = {
        "Grayscale": grayscale,
        "Streets": streets
    };

    // var LeafIcon = L.Icon.extend({
    //     options: {
    //         shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    //         iconSize: [50, 82],
    //         iconAnchor: [25, 82],
    //         popupAnchor: [1, -74],
    //         shadowSize: [30, 30]
    //     }
    // });

    var greenIcon = new L.Icon({
      iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
    });

    var redIcon = new L.Icon({
      iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
    });


    // var greenIcon = new LeafIcon({iconUrl: '{{asset('images/green-marker.svg')}}'}),
    //     redIcon = new LeafIcon({iconUrl: '{{asset('images/red-marker.svg')}}'});

    // var latitude = -1.205328
    // var longitude = 113.451067
    @if(Auth::user()->role == 'kelompok')
    var kebutuhanRetailer = `{{$kebutuhanRetailer}}`
    @elseif(Auth::user()->role == 'retailer')
    var postinganKelompok = JSON.parse("{{json_encode($postinganKelompok)}}");
    var kebutuhanEnduser = `{{$kebutuhanEnduser}}`
    for (var i = 0; i < postinganKelompok.length; i++) {
        console.log(postinganKelompok)
    }
    // postinganKelompok.forEach(element => console.log(element))
    function postinganKelompokMarker(data, index) {
        var isiGreen = `
            <div class="row">
                <div class="col-12">
                    <h4>Kios Bu Yati</h4>
                </div>
                <div class="col-6">
                    <span>Menjual</span>
                </div>
                <div class="col-6">
                    <span class="float-left">:</span>
                    <span class="float-right">Mangga Harumanis</span>
                </div>
                <div class="col-6">
                    <span>Harga/Kg</span>
                </div>
                <div class="col-6">
                    <span class="float-left">:</span>
                    <span class="float-right">10.500</span>
                </div>
                <div class="col-6">
                    <span>Stok</span>
                </div>
                <div class="col-6">
                    <span class="float-left">:</span>
                    <span class="float-right">500 Kg</span>
                </div>
            </div>
        `
        L.marker([data.kelompok.latitude, data.kelompok.longitude], {icon: greenIcon}).bindPopup(isiGreen).addTo(map)
    }

    var isiRed = `
        <div class="row">
            <div class="col-12">
                <h4>Pa Dadang</h4>
            </div>
            <div class="col-6">
                <span>Membutuhkan</span>
            </div>
            <div class="col-6">
                <span class="float-left">:</span>
                <span class="float-right">Mangga Muda</span>
            </div>
            <div class="col-6">
                <span>Jumlah</span>
            </div>
            <div class="col-6">
                <span class="float-left">:</span>
                <span class="float-right">10 Kg</span>
            </div>
        </div>
    `

    L.marker([latitude-5, longitude-5], {icon: redIcon}).bindPopup(isiRed).addTo(map);

    @elseif(Auth::user()->role == 'enduser')
    var postinganRetailer = `{{$potinganRetailer}}`;
    @endif

    L.control.layers(baseLayers).addTo(map);
    // L.marker([-1.605328, 117.451067]).addTo(map);
    
</script>

@endpush
