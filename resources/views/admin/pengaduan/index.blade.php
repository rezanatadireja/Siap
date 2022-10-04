@extends('layouts.masterAdmin')

@section('title_name')
    Pengaduan
@endsection

@section('custom_style')
    <link href="{{asset('admin\stisla\plugins\datatables\css\datatabels.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin\stisla\plugins\datatables\css\dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin\stisla\plugins\bootstrap-daterangepicker\daterangepicker.css')}}" rel="stylesheet" />--}}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengaduan</h1>
    </div>
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Filter Data</h4>
                    <div class="card-header-action">
                        <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse hide" id="mycard-collapse" style="">
                    <div class="card-body">
                        <div class="row p-2 justify-content-center">
                            <div class="form-group col-md-3 mt-1">
                                <label for="status">Status Pengaduan :</label>
                                <select class="form-control" id="status">
                                    <option value="">Pilih Status</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="diperbaiki">Diperbaiki</option>
                                    <option value="baru">Baru</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="from_date" class="col-form-label">Dari Tanggal :</label>
                                <input type="text" class="form-control datepicker text-center" id="from_date" name="from_date" placeholder="Tanggal Awal">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="to_date" class="col-form-label">Sampai Tanggal :</label>
                                <input type="text" class="form-control datepicker text-center" id="to_date" name="to_date" placeholder="Tanggal Akhir">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke text-right">
                    <button type="button" class="btn btn-primary" id="btn-filter"><i class="fas fa-search"></i> Filter</button>
                    <button type="button" class="btn btn-secondary" id="btn-refresh"><i class="fas fa-sync-alt"></i> Refresh</button>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="list-pengaduan" class="table table-stripped no-footer" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pelayanan</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Bidang Pengaduan</th>
                                        <th>Jenis Pelayanan Pengaduan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
    <script src="{{ asset('admin\stisla\plugins\bootstrap-daterangepicker\daterangepicker.js')}}"></script>
@endsection

@section('custom_script_footer')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            })
        });

        load_data();

        $('.datepicker').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            singleDatePicker: true,
            todayBtn: 'linked',
            autoclose: true,
            });

        $('#btn-filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' && to_date != ''){
                $('#list-pengaduan').DataTable().destroy();
                load_data(from_date, to_date);
            }else{
                alert('Both Date Is Required')
            }
        })

        $('#status').on('change', function(){
            $('#list-pengaduan').DataTable().destroy();
            load_data(status);
        })

        $('#btn-refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#status').val('');
            $('#list-pengaduan').DataTable().destroy();
            load_data();
        })

        function load_data(from_date = '', to_date = '', status = ''){
            $('#list-pengaduan').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ordering: true, // Set true agar bisa di sorting
            order: [[ 1, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            aLengthMenu: [[5, 10, 50, -1],[ 5, 10, 50, 'Semua']],
            ajax: {
                url:"{{ route('admin.index') }}",
                type: 'GET',
                data: function(d){
                    d.status = $('#status').val(),//this is the main point
                    d.from_date = from_date,
                    d.to_date = to_date  
                }
            },
            language: {
                url: "{{asset('js/id.js')}}",
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
                {
                    data: 'created_at',
                    type: 'num',
                    render: {
                        _: 'display',
                        sort: 'timestamp'
                    }
                },
                {'data': 'nik'},
                {'data': 'user_name'},
                {'data': 'jenis_bidang'},
                {'data': 'jenis_pengaduan'},
                {'data': 'status'},
                {'data': 'aksi', 'sortable': false},
        ]
        });
    }
    </script>
@endsection