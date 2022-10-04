@extends('layouts.masterGuest')

@section('title_name')
    Berkas Formulir
@endsection

@section('custom_style')
    <link href="{{asset('admin\stisla\plugins\datatables\css\datatabels.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin\stisla\plugins\datatables\css\dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Berkas Formulir Pengaduan / Pelayanan</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Pelayanan Pengaduan</h4>
            </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="formulir" class="table table-stripped no-footer" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Berkas</th>
                            <th class="text-center">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_script')
    <script src="{{ asset('admin\stisla\plugins\datatables\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin\stisla\plugins\datatables\js\dataTables.bootstrap4.min.js')}}"></script>
@endsection

@section('custom_script_footer')
<script>
    $('#formulir').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ordering: true, // Set true agar bisa di sorting
            order: [[ 1, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            aLengthMenu: [[5, 10, 50, -1],[ 5, 10, 50, 'Semua']],
            ajax: "{{ route('formulirGuest') }}",
            language: {
                url: "{{asset('js/id.js')}}"
            },
            columns: [
                {  
                    "data": null,
                    "class": "align-top col-md-1",
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {'data': 'name', 'class': 'col-md-7'},
                {'data': 'file', 'class': 'col-md-2'}
        ]
    });

    $('#formUpload').on('submit', function (e) {
        e.preventDefault();
        // alert('submit form');
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    $(form)[0].reset();
                    $('#addFormulirModal').hide()
                    location.reload()
                    iziToast.success({
                        message: data.msg,
                        position: 'topRight',
                    })
                }
            }
        });
    });

	$('.btn-edit').on('click', function(){
		// console.log($(this).data('id'))
		let id = $(this).data('id')
		$.ajax({
			url:`/jenis-pengaduan/${id}/edit`,
			method:"GET",
			success:function(data){
				$('#editPelayananModal').find('.modal-body').html(data)
				$('#editPelayananModal').modal('show')
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
			url:`/jenis-pengaduan/${id}`,
			method:"PUT",
            data:formData,
			success:function(data){
				// $('#editUserModal').find('.modal-body').html(data)
				$('#editPelayananModal').modal('hide')
            window.location.assign('/jenis-pengaduan')
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
