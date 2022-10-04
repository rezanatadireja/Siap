@extends('layouts.masterAdmin')

@section('title_name')
    Manajemen Role & Permission
@endsection

@section('content')
<section class="section">
        <div class="section-header">
            <h1>Manajemen Permission</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Manajemen User & Permission</a></div>
            <div class="breadcrumb-item active"><a href="#">Manajemen Permission</a></div>
            </div>
        </div>

        <div class="section-body">
            <div id="output-status"></div>
                    <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar User</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary text-white" data-toggle="modal" data-target="#modaltambah"><h7>Tambah Permission User</h7> <i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTableBuilder">
                                    <thead>
                                        <tr>
                                            <td>Username</td>
                                            <td>Nama</td>
                                            <td>Deskripsi</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@role('admin')
    @include('role-permission.modal')
@endrole
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modaltambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Data User</h5>
                </div>
                <div class="modal-body">
                    @include('role-permission.form')
                </div>
                <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button id="simpantambah" type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div> 
@endsection

@section('custom_style')
    <link href="{{ asset('admin/stisla/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('admin/stisla/plugins/duallistbox/css/bootstrap-duallistbox.min.css') }}" rel="stylesheet">
@endsection

@section('custom_script')
    <script src="{{ asset('admin/stisla/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/stisla/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/stisla/plugins/duallistbox/js/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

@section('custom_script_footer')
    <script src="{{ asset('js/pengaturan/role.js') }}"></script>
@endsection