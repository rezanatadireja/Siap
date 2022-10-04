@extends('layouts.masterAdmin')

@section('title_name')
    Berkas Formulir
@endsection

@section('custom_style')
<style>
    a[data-fancybox] img {
  cursor: zoom-in;
}

.custom{
    border: 2px dashed #6777ef;
    min-height: 150px;
    text-align: center;
}

.fancybox__caption {
  text-align: center;
}
</style>
        <link href="{{asset('admin\stisla\plugins\datatables\css\datatabels.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admin\stisla\plugins\datatables\css\dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
        <link href="{{asset('css\sweetalert2.min.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
		<link rel="stylesheet" href="{{asset('css/summernote.css')}}" />
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Berkas Formulir Pengaduan / Pelayanan</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Berkas Formulir Pengaduan / Pelayanan</h4>
                    <div class="card-header-action">
                        <a href="#addFormulirModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i> Tambah File</a>
                    </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0" width=100% id="formulir">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Berkas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;?>
                            @forelse($data as $d)
                            <?php $no++ ;?>
                            <tr>
                                <td>{{$no}}.</td>
                                <td>{{$d->name}}</td>
                                {{-- <td><a href="{{url('files/formulir', $d->file)}}" class="btn btn-sm btn-icon icon-left btn-primary" target="_blank"><i class="fa fa-download"></i> Download</a></td> --}}
                                <td>
                                    {{-- <a class="btn btn-success btn-sm editBtn text-white" data-id="{{$d->id}}" data-toggle="tooltip" title="" data-original-title="Edit Formulir" ><i class="far fa-edit"></i></a> --}}
                                    <a href="{{url('storage/files/formulir/', $d->file)}}" class="btn btn-sm btn-icon icon-left btn-primary" target="_blank"><i class="fa fa-download"></i> Download</a>
                                    <a class="btn btn-danger btn-sm deleteBtn text-white" data-id="{{$d->id}}" data-toggle="tooltip" title="" data-original-title="Hapus Formulir" ><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>
                                    <i><strong>Tidak Ada Data,</strong> Silahkan Upload File Formulir!</i>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="addFormulirModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Berkas Pelayanan Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('upload')}}" enctype="multipart/form-data" id="formUpload">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label @error('name') clas="text-danger"@enderror>Nama Berkas / File @error('name') | {{ $message}} @enderror</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Masukkan Nama File" required autofocus>
                            </div>
                            <div class="form-group">
                                <label @error('file') clas="text-danger"@enderror>Berkas File @error('file') | {{ $message}} @enderror</label>
                                <input type="file" name="file" value="{{ old('file')}}" class="form-control">
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

@section('custom_script')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
@endsection

@section('modal')
    <div class="modal fade" id="editFormulirModal">
        <div class="modal-dialog">
            <div class="modal-content"">
                <div class="modal-header">	
                    <h5 class="modal-title">Edit Berkas Formulir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="POST" action="" id="update_syarat">
                    @csrf
                        <div class="modal-body">
                            
                        </div>
                        <div class="modal-footer bg-whitesmoke">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script src="{{ asset('admin\stisla\plugins\datatables\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin\stisla\plugins\datatables\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js\sweetalert2.all.min.js')}}"></script>
@endsection

@section('custom_script_footer')
<script>
    $(document).ready(function(){
            Fancybox.bind('[data-fancybox="gallery"]', {
                caption: function (fancybox, carousel, slide) {
                    return (
                    slide.caption
                    );
                },
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

        $('.editBtn').on('click', function(){
            // console.log($(this).data('id'))
            let id = $(this).data('id')
            $.ajax({
                url:`/formulir/${id}/edit`,
                method:"GET",
                success:function(data){
                    $('#editFormulirModal').find('.modal-body').html(data)
                    $('#editFormulirModal').modal('show')
                },
                error:function(error){
                    console.log(error)
                }
            })
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.deleteBtn').on('click', function(){
            let id = $(this).data('id')
            var url = `formulir/${id}/delete`;
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
                        url:url,
                        method:'post',
                        data: {id:id},
                        dataType:'json',
                        success:function(data){
                            if(data.code == 1){
                            iziToast.success({
                                message: data.msg,
                                position: 'topRight',
                            })
                            console.log(data)
                            // $('#list-jenis-syarat').DataTable().ajax.reload()
                            location.reload()
                        }else{
                            alert(data.msg)
                        }
                        },
                    })
                    }
                })
            
        })
        
        $('.sd').on('click', function() {
            var formulir_id = $(this).data('id');
            var url = `formulir/${formulir_id}/delete`;

            if(confirm('Anda yakin ingin menghapus Formulir Syarat ?')){
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    url:url,
                    method:'post',
                    data:{formulir_id:formulir_id},
                    dataType:'json',
                    success: function(data){
                        if(data.code == 1){
                            iziToast.success({
                                message: data.msg,
                                position: 'topRight',
                            })
                            location.reload()
                        }else{
                            alert(data.msg)
                        }
                    }
                })
            }
        })
    })
</script>
@endsection
