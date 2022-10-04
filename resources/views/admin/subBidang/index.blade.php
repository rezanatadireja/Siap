@extends('layouts.masterAdmin')

@section('title_name')
    Sub Bidang Pengaduan
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Sub Bidang Pelayanan</h1>
    </div>
    <div class="section-body">
        <div class="card">
    <div class="card-header">
        <h4>Tabel Sub Bidang Pengaduan</h4>
            <div class="card-header-action">
                <a href="#addBidangModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i>Tambah Sub Bidang</a>
            </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Nama Sub Bidang</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($subBidang as $data)                        
                    <tr>
                        {{-- <td>{{ $data->firstItem()+$no }}</td> --}}
                        <td>{{ $data->nama}}</td>
                        <td>
                        <a class="btn btn-primary btn-action mr-1 btn-edit" href="#" data-id="{{ $data->id }}" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action swal-confirm" data-toggle="tooltip" title="" data-original-title="Delete" data-id="{{ $data->id }}"><i class="fas fa-trash"></i>
                            <form action="{{ route( 'subbidang.destroy', $data->id )}}" method="POST" id="delete{{ $data->id }}">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                        </td>
                    </tr>          
                    @endforeach 
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="addBidangModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Sub Bidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('subbidang.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label @error('nama') clas="text-danger"@enderror>Nama Sub Bidang @error('nama') | {{ $message}} @enderror</label>
                                <input type="text" name="nama" value="{{ old('nama')}}" placeholder="Masukkan Nama Sub Bagian Bidang" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('modal')
    <div class="modal fade" id="editSubBidangModal">
        <div class="modal-dialog">
            <div class="modal-content"">
            <form action="{{ url('subbidang.update')}}" method="PUT" id="form-edit">
                @csrf
            <div class="modal-header">	
                <h5 class="modal-title">Edit Sub Bidang Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
            
            </div>
            <div class="modal-footer bg-whitesmoke">
                <button type="button" class="btn btn-primary btn-update">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

@section('custom_script_footer')
<script>
	$('.btn-edit').on('click', function(){
		// console.log($(this).data('id'))
		let id = $(this).data('id')
		$.ajax({
			url:`/subbidang/${id}/edit`,
			method:"GET",
			success:function(data){
                $('#editSubBidangModal').find('.modal-body').html(data)
                $('#editSubBidangModal').modal('show')
			},
			error:function(error){
				console.log(error)
			}
		})
	})

    $('.btn-update').on('click', function(){
		// console.log($(this).data('id'))
	let id = $('#form-edit').find('#id_data').val()
    let formData = $('#form-edit').serialize()
    // console.log(formData)
		$.ajax({
			url:`/subbidang/${id}`,
			method:"PUT",
            data:formData,
			success:function(data){
				if(data.status == 1){
                    iziToast.error({
                        message: data.msg,
                        position: 'topRight',
                    })
                }else{
                    iziToast.success({
                        message: data.msg,
                        position: 'topRight',
                    })
                    $('#editSubBidangModal').modal('hide')
                    window.location.reload()
                }
			},
			error:function(error){
				console.log(error)
			}
		})
	})

    $(".swal-confirm").click(function(e) {
    id = e.target.dataset.id;
    swal({
        title:'Anda Yakin ?',
        text:'Data Yang Sudah Terhapus Tidak Akan Kembali.',
        icon:'warning',
        buttons:true,
        dangerMode:true,
    })
    .then((willDelete) => {
        if (willDelete) {
        $(`#delete${id}`).submit();
        } else {
        // swal('Your Data Berhasil Di Hapus.')
        }
    });
});
</script>
@endsection