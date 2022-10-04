@extends('layouts.masterAdmin')

@section('title_name')
    Dashboard
@endsection


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard SIAP</h1>
        </div>
        <div class="section-body">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Penduduk</h4>
                    <div id="cek"></div>
                  </div>
                  <div class="card-body">
                    {{$penduduk}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pengaduan Hari Ini</h4>
                  </div>
                  <div class="card-body">
                    {{$hitung}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Pengaduan</h4>
                  </div>
                  <div class="card-body">
                    {{$pengaduan->count()}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Perbaikan Pengaduan</h4>
                  </div>
                  <div class="card-body">
                    {{ $perbaikan }}
                  </div>
                </div>
              </div>
            </div>                  
          </div>

          <div class="row">
            <div class="col-md-12 col-12">
              <div class="card">
                  <div class="card-header">
                    <h4>Grafik Pengaduan</h4>
                  </div>
                  <div class="card-body"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="myChart4" style="display: block; width: 655px; height: 327px;" class="chartjs-render-monitor" width="655" height="327"></canvas>
                  </div>
                </div>
            </div>
          </div>
          
          <div class="row">
              <div class="col-12 col-md-6 col-lg-7">
                <div class="card">
                  <div class="card-header">
                    <h4>Kuota Pelayanan Pengaduan</h4>
                  </div>
                  <div class="card-body">
                    <div class="summary">
                      <div class="summary-item">
                        <ul class="list-unstyled list-unstyled-border">
                          @foreach ($kuota as $item)
                          <li class="media">
                            <a href="#">
                              <img class="mr-3 rounded" src="{{asset("icon-layanan/ktp.png")}}" alt="kuota" width="50">
                            </a>
                            <div class="media-body">
                              <div class="media-right">{{$item->kuota}}</div>
                              <div class="media-title"><a href="#">{{$item->nama}}</a></div>
                              <div class="text-muted text-small">by <a href="#">{{$item->subBidang->nama}}</a>
                            </div>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-5">
                <div class="card">
                  <div class="card-header">
                    <h4>Pengaduan Terakhir</h4>
                  </div>
                  <div class="card-body">
                    {{-- @if($recent = 0)
                    <ul class="list-unstyled list-unstyled-border">
                      <li class="media">
                        <div class="media-body">
                          <div class="float-right text-primary" style="font-size: 11px;">Tidak Ada Data!</div>
                        </div>
                      </li>
                    </ul>
                    @else --}}
                      @foreach ($recent as $item)
                      <ul class="list-unstyled list-unstyled-border">
                        <li class="media">
                          <img class="mr-3 avatar avatar-sm" src={{asset("admin/stisla/assets/img/avatar/avatar-1.png")}} alt="avatar" width="50">
                          <div class="media-body">
                            <div class="float-right text-primary" style="font-size: 11px;">{{$item->created_at->diffForHumans()}}</div>
                            <div class="media-title">{{ucwords($item->user->penduduk->nama)}}</div>
                            <span class="text-small text-muted">{{$item->jenisPengaduan->nama}}</span>
                          </div>
                        </li>
                      </ul>
                      @endforeach
                    {{-- @endif              --}}
                    {{-- <div class="text-center pt-1 pb-1">
                      <a href="#" class="btn btn-primary btn-lg btn-round">
                        View All
                      </a>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
            
            <h2 class="section-title">Riwayat Pelayanan Pengaduan</h2>
            <div class="row">
              @foreach ($dates as $date => $raws)
              <div class="col-md-6 col-lg-7 col-12">
                    <div class="pricing">
                      <div class="pricing-title">
                        {{$date}}
                      </div>
                      <div class="pricing-padding">
                        <div class="pricing-details">
                          @foreach ($raws as $raw)
                              <div class="pricing-item">
                                  @switch($raw->status)
                                    @case('diterima')
                                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                        @break
                                    @case('baru')
                                        <div class="pricing-item-icon bg-warning text-white"><i class="fas fa-info-circle"></i></div>
                                        @break
                                    @case('diperbaiki')
                                        <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i></div>
                                        @break
                                    @default
                                @endswitch
                                <div class="pricing-item-label">{{$raw->nama}} : {{$raw->pengaduan_count}}</div>
                              </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
            </div>
        </div>
    </section>
    @include('admin.dashboard.pengaduan')
@endsection


@section('custom_script')
    <script src="{{asset('admin\stisla\plugins\chart.js\dist\chart.js')}}"></script>
    <script src="{{ asset('js/pengaturan/dashboard-admin.js')}}"></script>
    {{-- {!! $chart1->renderChartJsLibrary() !!} --}}
    {{-- {!! $chart1->renderJs() !!} --}}
@endsection

@section('custom_script_footer')
    <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var ctx = document.getElementById("myChart4").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
            datasets: [{
              data: [
                @foreach($jenis as $j)
                  {{$j->pengaduan_count}},
                @endforeach
              ],
              backgroundColor: [
                '#191d21',
                '#63ed7a',
                '#ffa426',
                '#fc544b',
                '#6777ef',
              ],
              label: 'Dataset 1'
            }],
            labels: [
              @foreach($jenis as $key => $j)
                '{{$j->nama}}',
              @endforeach
            ],
          },
          options: {
            responsive: true,
            legend: {
              position: 'bottom',
            },
          }
        });

        // getCek()

        // function getCek(){
        //   var URLpath = window.location.pathname
        //   $.get(URLpath, {}, function(data){
        //       $.each(data.cek, function(key,value){
        //         var angka = value.kuota
        //         var pengaduan = value.nama
        //         if(angka < 0){
        //           // iziToast.success({
        //           //       message: pengaduan,
        //           //       position: 'topRight',
        //           //   })
        //         }else{
        //           Swal.fire({
        //                 title: pengaduan,
        //                 text:  'Kuota pelayanan telah habis.',
        //                 icon: 'warning',
        //                 width: '38em',
        //                 showCancelButton: true,
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     $('#addPengaduanModal').modal('show')
        //                     $('#bidang').val(value.bidang_pengaduan_id)
        //                     $('#sub_bidang').val(value.sub_bidang_id)
        //                     $('#nama').val(pengaduan)
        //                     $('#kuota').val(value.kuota)
        //                     $('#id_data').val(value.id)
        //                 }
        //             })
        //         }
        //       })
        //   }, 'json')
        // }

        // $(document).on('click', '.updateKuota', function(e){
        //     e.preventDefault()
        //     var id = $('#id_data').val()
        //     var data = {
        //       'id'                    : $('#id_data').val(),
        //       'kuota'               : $('#kuota').val(),
        //       'nama'                : $('#nama').val(),
        //       'bidang_pengaduan_id' : $('#bidang').val(),
        //       'sub_bidang_id'       : $('#sub_bidang').val()
        //     }

        //     $.ajax({
        //       url:`/jenis-pengaduan/${id}/update`,
        //       method:'PUT',
        //       data:data,
        //       dataType:'JSON',
        //       beforeSend:function(){
        //         $('.updateKuota').addClass('btn-progress')
        //       },
        //       success:function(data){
        //         if(data.status == 400){
        //           $('.updateKuota').removeClass('btn-progress');
        //           $('#listError').html("")
        //           $('#listError').addClass('alert alert-danger')
        //           $.each(res.errors, function(key,err_values){
        //               $('#listError').append('<li>'+err_values+'</li>');
        //           })
        //         }else if(data.status == 200){
        //           $('.updateKuota').removeClass('btn-progress');
        //           $('#listError').html("")
        //           iziToast.success({
        //               message: data.msg,
        //               position: 'topRight',
        //             })
        //         }else{
        //           $('.updateKuota').removeClass('btn-progress');
        //           iziToast.warning({
        //               position: 'topRight',
        //             })
        //         }
        //       },
        //       error:function(xhr){
        //         console.log(xhr)
        //       }
        //     })
        // })
      })
</script>
@endsection