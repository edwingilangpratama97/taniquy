@extends('app.layouts.index')

@section('content')
<div class="page-title">

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Penawaran</h3>
            <p class="text-subtitle text-muted">Data Penawaran dari Penjual (Kelompok Tani & Retailer)</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data Jual Beli</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Penawaran</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
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
		    <div class="row mb-2">
		    	<div class="col-6">

		    	</div>
		    	<div class="col-6">
				    <a href="{{route('penawaran.create')}}" class="btn btn-success float-right">
		            	<i data-feather="plus-circle"></i> Tambah
		            </a>
		    	</div>
		    </div>
            <table class='table table-striped' id="data_table">
                <thead>
                    <tr>
                    	<th>No</th>
                        <th>Kode Penawaran</th>
                        <th>Kode Kebutuhan</th>
                        <th>Penjual</th>
                        <th>Jumlah Kebutuhan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
<div class="modal-warning mr-1 mb-1 d-inline-block">
    <!--warning theme Modal -->
    <div class="modal fade text-left" id="warning" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel140" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
            <h5 class="modal-title white" id="titleModal"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        Kode Penawaran
                    </div>
                    <div class="col-6">
                        <span class="float-left">:</span>
                        <div id="kode_penawaran" class="float-right"></div>
                    </div>
                    <div class="col-6">
                        Kode Kebutuhan Rujukan
                    </div>
                    <div class="col-6">
                        <span class="float-left">:</span>
                        <div id="kode_kebutuhan" class="float-right"></div>
                    </div>
                    <div class="col-6" id="role-title">

                    </div>
                    <div class="col-6">
                        <span class="float-left">:</span>
                        <div id="role-name" class="float-right"></div>
                    </div>
                    <div class="col-6">
                        Harga/Kg
                    </div>
                    <div class="col-6">
                        <span class="float-left">:</span>
                        <div id="harga" class="float-right"></div>
                    </div>
                    <div class="col-6">
                        Jumlah Kebutuhan
                    </div>
                    <div class="col-6">
                        <span class="float-left">:</span>
                        <div id="jumlah" class="float-right"></div>
                    </div>
                    <div class="col-6">
                        Total Harga
                    </div>
                    <div class="col-6">
                        <span class="float-left">:</span>
                        <div id="total_harga" class="float-right"></div>
                    </div>
                    <div class="col-6">
                        Status Pembayaran
                    </div>
                    <div class="col-6">
                        <span class="float-left">:</span>
                        <div id="status_pembayaran" class="float-right"></div>
                    </div>
                    <div class="col-6">
                        Status Penerimaan
                    </div>
                    <div class="col-6">
                        <span class="float-left">:</span>
                        <div id="status_penerimaan" class="float-right"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
            </button>

            <button type="button" class="btn btn-warning ml-1" data-dismiss="modal">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Accept</span>
            </button>
            </div>
        </div>
        </div>
    </div>
</div>
<form action="" id="formDelete" method="POST">
    @csrf
    @method('DELETE')
</form>
@push('script')
<script>

let table = $('#data_table').DataTable({
    "stripeClasses": [ 'table-borderless' ],
    processing : true,
    serverSide : true,
    ordering : false,
    pageLength : 10,
    ajax : "{{ route('penawaran.index') }}",
    columns : [
        {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable:false,orderable:false},
        {data : 'kode_penawaran', name: 'kode_penawaran'},
        {data : 'kebutuhan.kode_kebutuhan', name: 'kebutuhan.kode_kebutuhan'},
        {data : 'penjual', name: 'penjual'},
        {data : 'kebutuhan.jumlah', name: 'kebutuhan.jumlah'},
        {data : 'status', name: 'status'},
        {data : 'action', name: 'action'}
    ]
});

function getPenawaran(id){
    $.ajax({
      url: '/api/v1/getPenawaran/'+id,
      type: 'GET',
      cache: false,
      dataType: 'json',
      success: function(json) {
          console.log(json);
          $("#kode_penawaran").text(json.data.kode_penawaran);
          $("#kode_kebutuhan").text(json.data.kebutuhan.kode_kebutuhan);
          $("#harga").text('Rp. '+json.data.mangga.harga);
          $("#jumlah").text(json.data.kebutuhan.jumlah);
          if (json.data.id_kelompok == null) {
            $("#titleModal").text('Detail Penawaran '+json.data.retailer.nama);
            $('#role-title').text('Nama Retailer');
            $('#role-name').text(json.data.retailer.nama);
          } else if (json.data.id_retailer == null) {
            $("#titleModal").text('Detail Penawaran '+json.data.kelompok.nama);
            $('#role-title').text('Nama Kelompok');
            $('#role-name').text(json.data.kelompok.nama);
          }
          var total_harga = json.data.kebutuhan.jumlah * json.data.mangga.harga;
          $("#total_harga").text('Rp. '+total_harga);
          if (json.data.status_pembayaran == 0) {
            $('#status_pembayaran').text('Belum Dibayar');
          } else {
            $('#status_pembayaran').text('Sudah Dibayar');
          }

          if (json.data.status_penerimaan == 0) {
            $('#status_penerimaan').text('Belum Diterima');
          } else {
            $('#status_penerimaan').text('Sudah Diterima');
          }
      }
    });
}

function sweet(id){
    const formDelete = document.getElementById('formDelete')
    formDelete.action = '/v1/penawaran/'+id

    console.log(formDelete.action)
    swal({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    buttons:{
        confirm: {
            text : 'Yes, delete it!',
            className : 'btn btn-success'
        },
        cancel: {
            visible: true,
            className: 'btn btn-danger'
        }
    }
    }).then((Delete) => {
        if (Delete) {
            formDelete.submit();
            swal({
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                icon: 'success',
                buttons : {
                    confirm: {
                        className : 'btn btn-success'
                    }
                }
            });
        } else {
            swal.close();
        }
    });
}

</script>
@endpush
@endsection
