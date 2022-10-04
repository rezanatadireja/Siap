@extends('layouts.masterAdmin')

@section('title_name')
    Bidang Pengaduan
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Bidang Pengaduan</h1>
    </div>
    <div class="section-body">
        <div class="card">
    <div class="card-header">
        <h4>Tabel Bidang Pengaduan</h4>
        @if (sizeof($bidang) !== 2)
            <div class="card-header-action">
                <a href="#addBidangModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i>Tambah Bidang</a>
            </div>
        @endif
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Nama Bidang</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($bidang as $data)                        
                    <tr>
                        {{-- <td>{{ $data->firstItem()+$no }}</td> --}}
                        <td>{{ $data->name }}</td>
                        <td>
                        <a class="btn btn-primary btn-action mr-1 btn-edit" href="#" data-id="{{ $data->id }}" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i>
		                </a>
                        <a class="btn btn-danger btn-action swal-confirm" data-toggle="tooltip" title="" data-original-title="Delete" data-id="{{ $data->id }}"><i class="fas fa-trash"></i>
                            <form action="{{ route( 'bidangpengaduan.destroy', $data->id )}}" method="POST" id="delete{{ $data->id }}">
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
            <h5 class="modal-title">Tambah Bidang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('bidangpengaduan.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label @error('name') clas="text-danger"@enderror>Nama Bidang @error('name') | {{ $message}} @enderror</label>
                                <input type="text" name="name" value="{{ old('name')}}" placeholder="Masukkan Nama Bidang Pengaduan" class="form-control">
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
    <div class="modal fade" id="editBidangModal">
        <div class="modal-dialog">
            <div class="modal-content"">
            <form action="{{ url('bidangpengaduan.update')}}" method="PUT" id="form-edit">
                @csrf
            <div class="modal-header">	
                <h5 class="modal-title">Edit Bidang Pengaduan</h5>
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
			url:`/bidangpengaduan/${id}/edit`,
			method:"GET",
			success:function(data){
				$('#editBidangModal').find('.modal-body').html(data)
				$('#editBidangModal').modal('show')
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
			url:`/bidangpengaduan/${id}`,
			method:"PUT",
            data:formData,
			success:function(data){
				// $('#editUserModal').find('.modal-body').html(data)
				$('#editBidangModal').modal('hide')
            window.location.assign('/bidangpengaduan')
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
        // swal('Prof!', {
        //   icon:'success',
        // });
        $(`#delete${id}`).submit();
      } else {
        // swal('Your Data Berhasil Di Hapus.')
      }
    });
  });
</script>
@endsection