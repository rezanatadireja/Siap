@extends('layouts.masterAdmin')

@section('title_name')
    Laporan Pelayanan Pengaduan
@endsection

@section('custom_style')
    <link href="{{asset('admin\stisla\plugins\datatables\css\datatabels.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin\stisla\plugins\datatables\css\dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin\stisla\plugins\bootstrap-daterangepicker\daterangepicker.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="section">
        <div class="section-header">
            <h1>Laporan Pelayanan Pengaduan</h1>
        </div>
        <div class="section-body">
            <div class="col-12 col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Filter Laporan</h4>
                        <div class="card-header-action">
                            <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="mycard-collapse" style="">
                        <div class="card-body p-0">
                            <div class="d-flex justify-content-center p-2">
                                <div class="form-group col-md-4">
                                    <label for="from_date">Tanggal Awal :</label>
                                    <input id="from_date" name="from_date" class="form-control datepicker" type="text" name="from_date" placeholder="Masukkan Tanggal Awal">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="to_date">Tanggal Akhir :</label>
                                    <input id="to_date" name="to_date" class="form-control datepicker" type="text" name="to_date" placeholder="Masukkan Tanggal Akhir">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-whiotesmoke text-center">
                            <button class="btn btn-primary col-md-2" id="btn-search"><i class="fas fa-search"></i> Cari</button>
                            <button class="btn btn-secondary col-md-2" id="btn-refresh"><i class="fas fa-sync-alt"></i> Refresh</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-white">.</h4>
                    <div class="card-header-action">
                        <div class="d-flex text-right">
                            {{-- <div class="form-group"> --}}
                                <form method="GET" action="{{route('export.excel')}}">
                                    <input class="form-control" type="text" id="minE" name="minE" hidden>
                                    <input class="form-control" type="text" id="maxE" name="maxE" hidden>
                                    <button class="btn btn-success mr-2"><i class="far fa-file-excel"></i> Download Excel</button>
                                </form>
                                <form method="GET" action="{{route('exportPdf')}}">
                                    <input class="form-control" type="text" id="minP" name="minP" hidden>
                                    <input class="form-control" type="text" id="maxP" name="maxP" hidden>
                                    <button target="_blank" type="submit" class="btn btn-danger"><i class="far fa-file-pdf"></i> Download Pdf</button>
                                </form>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body" id="showPengaduan">
                    <div class="table-responsive">
                        <table id="data-pengaduan" class="table table-stripped no-footer" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pelayanan</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Bidang Pengaduan</th>
                                    <th>Jenis Pelayanan Pengaduan</th>
                                    <th>Status</th>
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
@endsection

@section('custom_script')
    <script src="{{ asset('admin\stisla\plugins\datatables\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin\stisla\plugins\datatables\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin\stisla\plugins\bootstrap-daterangepicker\daterangepicker.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
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

        load_pengaduan();

        $('#btn-pdf').click(function(){
            var from_date = $('#from_date').val()
            var to_date = $('#to_date').val()
            console.log(print)
        });

        $('.datepicker').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            singleDatePicker: true,
            todayBtn: 'linked',
            autoclose: true,
        });

        $('#btn-refresh').click(function(){
            $('#from_date').val('')
            $('#to_date').val('')
            $('#data-pengaduan').DataTable().destroy()
            load_pengaduan()
        });

        $('#btn-search').click(function(){
            var from_date = $('#from_date').val()
            var to_date = $('#to_date').val()
            if(from_date != '' && to_date != ''){
                $('#data-pengaduan').DataTable().destroy()
                load_pengaduan(from_date, to_date)
            }else{
                iziToast.error({
                    message: 'Silahkan Isi Kembali Tanggal Awal & Akhir!',
                    position: 'topRight',
                })
            }
            $('#minE').val(from_date)
            $('#maxE').val(to_date)
            $('#minP').val(from_date)
            $('#maxP').val(to_date)
        });

        function load_pengaduan(from_date = '', to_date = ''){
            $('#data-pengaduan').DataTable({
                // dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
                //         "<'row'<'col-xs-12't>>"+
                //         "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
                processing: true,
                serverSide: true,
                searching: true,
                responsive: true,
                ajax: {
                    url: "{{route('laporan-pengaduan')}}",
                    method: 'GET',
                    data: function(d){
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
                ]
            })
        }
    </script>
@endsection