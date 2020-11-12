@extends('app.layouts.index')

@section('content')
<div class="page-title">

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Kelompok Tani</h3>
            <p class="text-subtitle text-muted">Data Kelompok Tani yang menjual Mangga</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelompok Tani</li>
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
		    	<div class="col-12 col-md-10">
		    		
		    	</div>
		    	<div class="col-12 col-md-2">
				    <a href="{{route('kelompok.create')}}" class="btn btn-success btn-block">
		            	<i data-feather="plus-circle"></i>Tambah
		            </a>
		    	</div>
		    </div>
            <div class="row">
                <div class="col-12 overflow-auto">
                    <table class='table table-stripped' id="data_table">
                        <thead>
                            <tr>
                            	<th>No</th>
                                <th>Nama Kelompok</th>
                                <th>Ketua</th>
                                <th>Kontak</th>
                                <th>Desa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
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
                    <div class="col-12">
                        <div id="foto_ketua"></div>
                    </div>
                    <div class="col-6">
                        
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
    ajax : "{{ route('kelompok.index') }}",
      columns : [
        {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable:false,orderable:false},
        {data : 'nama', name: 'nama'},
        {data : 'ketua', name: 'ketua'},
        {data : 'kontak', name: 'kontak'},
        {data : 'desa.nama', name: 'id_desa'},
        {data : 'action', name: 'action'}
      ]
});

function getKelompok(id){
    $.ajax({
      url: '/api/v1/getKelompok/'+id,
      type: 'GET',
      cache: false,
      dataType: 'json',
      success: function(json) {
          $("#titleModal").text('Detail '+json.data.nama);
          $("#kode_kelompok").text(json.data.kode_kelompok);
          $("#nama_kelompok").text(json.data.nama);
          $("#ketua").text(json.data.ketua);
          $("#kontak").text(json.data.kontak);
          $("#latitude").text(json.data.latitude);
          $("#longitude").text(json.data.longitude);
          $("#alamat").text(json.data.alamat);
          $("#desa").text(json.data.desa.nama);
          $("#kecamatan").text(json.data.desa.kecamatan.nama);
          $("#kabupaten").text(json.data.desa.kecamatan.kabupaten.nama);
          $("#provinsi").text(json.data.desa.kecamatan.kabupaten.provinsi.nama);
          $("#foto_ketua").html(`<img src="{{asset('${json.data.foto_ketua}')}}">`);
          console.log(json.data);
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
function sweet(id){
    const formDelete = document.getElementById('formDelete')
    formDelete.action = '/v1/kelompok/'+id

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