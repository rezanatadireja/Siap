@extends('layouts.masterAdmin')

@section('title_name')
    User
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manajemen User</h1>
        <div class="section-header-breadcrumb">
            {{-- <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="#">Settings</a></div>
            <div class="breadcrumb-item">General Settings</div> --}}
        </div>
    </div>
    <div class="section-body">
        <div id="output-status"></div>
    </div>
</section>

<section class="section">
    <div class="section-header">
        <h1>Manajemen User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="#">Settings</a></div>
            <div class="breadcrumb-item">General Settings</div>
        </div>
        </div>
        <div class="section-body">
        <div id="output-status"></div>
    <div class="row">
            {{-- <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Form User</h4>
                </div>
                @role('admin')
                <div class="card-body">
                    @include('user.form')
                </div>
                @endrole
                <div class="card-footer bg-whitesmoke text-md-righ">
                    <a href="#" class="btn btn-primary float-right" id="simpantambah"> Simpan Data</a>
                </div>
            </div>
            </div> --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar User</h4>
                        <div class="card-header-action">
                            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#modaltambah"><h7>Tambah User</h7> <i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTableBuilder">
                                <thead>
                                    <tr>
                                        <td style="vertical-align:middle;text-align:center;">Username</td>
                                        <td style="vertical-align:middle;text-align:center;">Nama</td>
                                        {{-- <td style="vertical-align:middle;text-align:center;">Level User (Role)</td> --}}
                                        <td style="vertical-align:middle;text-align:center;">Aktif</td>
                                        <td style="vertical-align:middle;text-align:center;">Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        </div>
</section>

@role('admin')
    @include('user.modal')
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
                    @include('user.form')
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
    {{-- <link href="{{ asset('admin/stisla/plugins/select2/css/select2.min.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('admin/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}"> --}}
@endsection

@section('custom_script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('admin/stisla/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/stisla/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
    {{-- <script src="{{ asset('admin/stisla/plugins/select2/js/select2.full.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js')}}"></script> --}}
@endsection

@section('custom_script_footer')
    <script src="{{ asset('js/pengaturan/user.js') }}"></script>
@endsection