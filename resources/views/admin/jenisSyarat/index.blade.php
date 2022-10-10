@extends('layouts.masterAdmin')

@section('title_name')
    Syarat Pelayanan Pengaduan
@endsection

@section('custom_style')
    <link href="{{asset('admin\stisla\plugins\datatables\css\datatabels.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin\stisla\plugins\datatables\css\dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css\sweetalert2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Syarat Pelayanan Pengaduan</h1>
    </div>
    <div class="section-body">
        <div class="card">
    <div class="card-header">
        <h4>Daftar Syarat Pelayanan Pengaduan</h4>
            <div class="card-header-action">
                <button data-toggle="modal"  data-target="#addSyaratPengaduanModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Syarat Pelayanan Pengaduan</button>
            </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" style="width:100%" id="list-jenis-syarat">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Layanan Pengaduan</th>
                        <th>Syarat Pengaduan</th>
                        <th class="text-center">Aksi</th>
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

<div class="modal fade" id="addSyaratPengaduanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"> 
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Syarat Pelayanan Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal"  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="listError"></div>
                <form id="form">
                    @csrf
                <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label @error('nama') clas="text-danger"@enderror>Nama Pelayanan Pengaduan @error('nama') | {{ $message}} @enderror</label>
                                {!! Form::select('jenis_pengaduan_id', \App\Models\JenisPengaduan::pluck('nama', 'id'), null, ['id' => 'jenis_pengaduan_id', 'class' => 'form-control select2', 'placeholder' => 'Pilih Pelayanan Pengaduan'])!!}
                            </div>
                            <div class="form-group">
                                <label @error('nama') clas="text-danger"@enderror>Nama Syarat Pelayanan Pengaduan @error('nama') | {{ $message}} @enderror</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama')}}" placeholder="Masukkan nama syarat" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-primary add_jenis">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('modal')
    <div class="modal fade" id="editPelayananModal">
        <div class="modal-dialog">
            <div class="modal-content"">
                <form method="POST"  action="{{route("jenis-syarat.update")}}" id="update_form">
                    @csrf
                    <div class="modal-header">	
                        <h5 class="modal-title">Edit Syarat Pelayanan Pengaduan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                    
                    </div>
                    <div class="modal-footer bg-whitesmoke">
                        <button type="submit" class="btn btn-primary btn-update">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script src="{{ asset('admin\stisla\plugins\datatables\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin\stisla\plugins\datatables\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js\sweetalert2.all.min.js')}}"></script>
    {{-- <script src="{{ asset('js/pengaturan/jenis-syarat.js') }}"></script> --}}
@endsection

@section('custom_script_footer')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var url = window.location
        $('#list-jenis-syarat').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ordering: true, // Set true agar bisa di sorting
            order: [[ 1, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            aLengthMenu: [[10, 50, -1],[ 10, 50, 'Semua']],
            ajax: url,
            language: {
                url: "{{asset('js/id.js')}}"
            },
            columns: [
                {  
                    "data": null,
                    "class": "align-top",
                    "orderable": false,
                    "searchable": false,
                    "render": function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {'data': 'layanan_pengaduan'},
                {'data': 'syarat_pengaduan'},
                {'data': 'aksi', 'sortable': false},
        ]
        });

        $(document).on('click', '.add_jenis', function (e){
            e.preventDefault();
            // var form = this;
            var data = {
                'nama' : $('#nama').val(),
                'jenis_pengaduan_id' : $('#jenis_pengaduan_id').val()
            }

            $.ajax({
                url: 'jenis-syarat/store',
                method:'POST',
                data: data,
                dataType: 'json',
                success:function(data){
                    if(data.code == 0){
                        $('#listError').html("")
                        $('#listError').addClass('alert alert-danger')
                        $.each(data.errors, function (key, err_values) {
                            $('#listError').append('<li>' + err_values + '</li>');
                        });
                        // console.log(form)
                    }else if(data.code == 1){
                        $(form)[0].reset();
                        $('#addSyaratPengaduanModal').hide();
                        iziToast.success({
                            title: 'Sukses',
                            message: data.msg,
                            position: 'topRight',
                        })
                        $('#list-jenis-syarat').DataTable().ajax.reload()
                    }
                },
                error:function(xhr){
                    console.log(xhr)
                }
            });
        });

        $(document).on('click', '.edit', function(){
            let id = $(this).attr('id')
            // console.log(id);
            $.ajax({
                url:`jenis-syarat/${id}/edit`,
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

        $('#update_form').on('submit', function (e) {
            e.preventDefault();
            // alert('submit form');
            var form = this;
            // console.log(form)
            $.ajax({
                headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
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
                        iziToast.success({
                            message: data.msg,
                            position: 'topRight',
                        })
                        $('#editPelayananModal').modal('hide');
                        $('#list-jenis-syarat').DataTable().ajax.reload()
                    }
                }
            });
        });

        $(document).on('click', '.deleteBtn', function(){
            let id = $(this).data('id')
            var url = `jenis-syarat/${id}/delete`;
            Swal.fire({
                title: 'Anda Yakin Ingin Menghapus Data Ini ?',
                text: "Data yang dihapus tidak bisa kembali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Kembali'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers:{
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        },
                        url:url,
                        method:'POST',
                        data: {id:id},
                        dataType:'json',
                        success:function(data){
                            if(data.code == 1){
                            iziToast.success({
                                title:'Sukses',
                                message: data.msg,
                                position: 'topRight',
                            })
                            $('#list-jenis-syarat').DataTable().ajax.reload()
                        }else{
                            alert(data.msg)
                        }
                        },
                    })
                    }
                })
            
        })
    })
    
</script>
@endsection