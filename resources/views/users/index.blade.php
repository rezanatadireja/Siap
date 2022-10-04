@extends('layouts.masterAdmin')

@section('title_name')
    User
@endsection

@section('active_page')
  <li class="breadcrumb-item active">User</li>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manajemen User</h1>
        <div class="section-header-breadcrumb">
            <div class="card-header-action">
                <div class="btn-group">
                @if($user->checkPermission('user.create'))
                  <a href="#addUserModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i> User</a>
                @endif
                @if($user->checkPermission('role.create'))
                  <a href="#createRole" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i> Role</a>
                @endif
                  <a href="{{route('permissions.list')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Permission</a>
                </div>
              </div>
        </div>
    </div>
    <div class="section-body">
          <div class="card card-primary">
            <div class="card-header">
              @include('component.filters', ['filter_route'=>url('/users'), 'filter_id'=>'UserFilter'])
            </div>
            <div class="card-body">
            @include('users.table')
            </div>
          </div>
    </div>
</section>

<div class="modal fade" id="addUserModal">
  <div class="modal-dialog modal-lg">
      @include('users.forms', ['user'=>''])
  </div>
</div>
@endsection

@section('modal')
  <div class="modal fade" id="createRole">
			<div class="modal-dialog">
				{{ Form::open(['route' => 'user.create', 'method' => 'post']) }}
				<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Buat Level User</h5>
						</div>
						<div class="modal-body">
								<div class="form-group">
										{{ Form::label('name', 'Name') }}
										{{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
								</div>
						</div>
						<div class="modal-footer bg-whitesmoke">
                <button type="submit" class="btn btn-primary" onclick="$('.modal-backdrop').remove();$('body').removeClass('modal-open');">Simpan</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						</div>
				</div>
				{{ Form::close() }}
			</div>
    </div>


    <div class="modal fade" id="editUserModal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content"">
            <form action="{{ url('users.update')}}" method="PUT" id="form-edit">
              @csrf
            <div class="modal-header">	
              <h5 class="modal-title">Edit User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer bg-whitesmoke">
                <button type="button" class="btn btn-primary btn-update" onclick="$('.modal-backdrop').remove();$('body').removeClass('modal-open');">Simpan Perubahan</button>
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
			url:`/users/${id}/edit`,
			method:"GET",
			success:function(data){
				$('#editUserModal').find('.modal-body').html(data)
				$('#editUserModal').modal('show')
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
			url:`/users/${id}`,
			method:"PUT",
      data:formData,
			success:function(data){
				// $('#editUserModal').find('.modal-body').html(data)
				$('#editUserModal').modal('hide')
        location.reload();
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
        location.reload();
      } else {
        // swal('Your Data Berhasil Di Hapus.')
      }
    });
  });
</script>
@endsection