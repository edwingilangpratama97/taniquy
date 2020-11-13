@extends('app.layouts.index')

@section('content')
<div class="page-title">

    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Kebutuhan</h3>
            <p class="text-subtitle text-muted">Data Kebutuhan dari Pembeli (Pelanggan & Retailer)</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Data Jual Beli</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Kebutuhan</li>
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
				    <a href="{{route('kebutuhan.create')}}" class="btn btn-success float-right">
		            	<i data-feather="plus-circle"></i> Tambah
		            </a>
		    	</div>
		    </div>
            <table class='table table-striped' id="data_table">
                <thead>
                    <tr>
                    	<th>No</th>
                        <th>Kode Kebutuhan</th>
                        <th>Pembeli</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
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
    ajax : "{{ route('kebutuhan.index') }}",
    columns : [
        {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable:false,orderable:false},
        {data : 'kode_kebutuhan', name: 'kode_kebutuhan'},
        {data : 'pembeli', name: 'pembeli'},
        {data : 'jenis.nama', name: 'jenis'},
        {data : 'jumlah', name: 'jumlah'},
        {data : 'action', name: 'action'}
    ]
});

function sweet(id){
    const formDelete = document.getElementById('formDelete')
    formDelete.action = '/v1/kebutuhan/'+id

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
