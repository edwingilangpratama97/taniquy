@extends('app.layouts.index')

@section('content')
<div class="page-title">
    <h3>Dashboard</h3>
    <p class="text-subtitle text-muted">Data Statistik Penjualan Mangga</p>
</div>
<section class="section">
    <div class="row mb-2">
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
                                <p>423 </p>
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
    <div class="row mb-4 hidden">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class='card-heading p-1 pl-3'>Sales</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="pl-3">
                                <h1 class='mt-5'>$21,102</h1>
                                <p class='text-xs'><span class="text-green"><i data-feather="bar-chart" width="15"></i> +19%</span> than last month</p>
                                <div class="legends">
                                    <div class="legend d-flex flex-row align-items-center">
                                        <div class='w-3 h-3 rounded-full bg-info mr-2'></div><span class='text-xs'>Last Month</span>
                                    </div>
                                    <div class="legend d-flex flex-row align-items-center">
                                        <div class='w-3 h-3 rounded-full bg-blue mr-2'></div><span class='text-xs'>Current Month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <canvas id="bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Orders Today</h4>
                    <div class="d-flex ">
                        <i data-feather="download"></i>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class='table mb-0' id="table1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Graiden</td>
                                    <td>vehicula.aliquet@semconsequat.co.uk</td>
                                    <td>076 4820 8838</td>
                                    <td>Offenburg</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dale</td>
                                    <td>fringilla.euismod.enim@quam.ca</td>
                                    <td>0500 527693</td>
                                    <td>New Quay</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nathaniel</td>
                                    <td>mi.Duis@diam.edu</td>
                                    <td>(012165) 76278</td>
                                    <td>Grumo Appula</td>
                                    <td>
                                        <span class="badge bg-danger">Inactive</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Darius</td>
                                    <td>velit@nec.com</td>
                                    <td>0309 690 7871</td>
                                    <td>Ways</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ganteng</td>
                                    <td>velit@nec.com</td>
                                    <td>0309 690 7871</td>
                                    <td>Ways</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Oleg</td>
                                    <td>rhoncus.id@Aliquamauctorvelit.net</td>
                                    <td>0500 441046</td>
                                    <td>Rossignol</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kermit</td>
                                    <td>diam.Sed.diam@anteVivamusnon.org</td>
                                    <td>(01653) 27844</td>
                                    <td>Patna</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header">
                    <h4>Your Earnings</h4>
                </div>
                <div class="card-body">
                    <div id="radialBars"></div>
                    <div class="text-center mb-5">
                        <h6>From last month</h6>
                        <h1 class='text-green'>+$2,134</h1>
                    </div>
                </div>
            </div>
            <div class="card widget-todo">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title d-flex">
                        <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Progress
                    </h4>
            
                </div>
                <div class="card-body px-0 py-1">
                    <table class='table table-borderless'>
                        <tr>
                            <td class='col-3'>UI Design</td>
                            <td class='col-6'>
                                <div class="progress progress-info">
                                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td class='col-3 text-center'>60%</td>
                        </tr>
                        <tr>
                            <td class='col-3'>VueJS</td>
                            <td class='col-6'>
                                <div class="progress progress-success">
                                    <div class="progress-bar" role="progressbar" style="width: 35%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td class='col-3 text-center'>30%</td>
                        </tr>
                        <tr>
                            <td class='col-3'>Laravel</td>
                            <td class='col-6'>
                                <div class="progress progress-danger">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td class='col-3 text-center'>50%</td>
                        </tr>
                        <tr>
                            <td class='col-3'>ReactJS</td>
                            <td class='col-6'>
                                <div class="progress progress-primary">
                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td class='col-3 text-center'>80%</td>
                        </tr>
                        <tr>
                            <td class='col-3'>Go</td>
                            <td class='col-6'>
                                <div class="progress progress-secondary">
                                    <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td class='col-3 text-center'>65%</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id='map'></div>

</section>
@endsection
@push('script')
<script>

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

    var latitude = -1.205328
    var longitude = 113.451067

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

    L.marker([latitude+2, longitude], {icon: greenIcon}).bindPopup(isiGreen).addTo(map);
    L.marker([latitude-5, longitude-5], {icon: redIcon}).bindPopup(isiRed).addTo(map);

    L.control.layers(baseLayers).addTo(map);
    // L.marker([-1.605328, 117.451067]).addTo(map);
    
</script>

@endpush
