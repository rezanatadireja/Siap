$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    getSyarat()

    function getSyarat() {
        var URLpath = window.location.pathname;
        $.get(URLpath, {}, function (data) {
            $('#list-syarat').html(data.result);
        }, 'json');
    }

    $('#cekPengaduan').on('submit', function(e){
        e.preventDefault();
        var form = this

        $.ajax({
            url:`cekpengaduan/status`,
            method:"POST",
            processData: false,
            contentType: false,
            data:new FormData(form),
            datatype:'json',
            success:function(res){
                if(res.status == 400){
                    $('#listError').html("")
                    $('#listError').addClass('alert alert-danger')
                    $.each(res.errors, function (key, err_values) {
                        $('#listError').append('<li>' + err_values + '</li>');
                    });
                }else if(res.status == 404){
                    $(form)[0].reset();
                    iziToast.warning({
                        message: res.msg,
                        position: 'topRight',
                    })
                }else if(res.status == 200){
                    $('#list-syarat').html('')
                    $('#listError').removeClass('alert alert-danger')
                    $(form)[0].reset();
                    $('#modalPengaduan').modal('show')
                    $('#pengaduan_no').text(res.pengaduan.no_pengaduan)
                    $('#jenis_pengaduan').text(res.jenis_pengaduan)
                    $('#sub_bidang').text(res.sub_bidang)
                    $('#user_name').text(res.user_name)
                    $('#user_nik').text(res.user_nik)
                    $('#bag_bidang').text(res.bag_bidang)
                    $('#data').text(res.data)
                        console.log(res.syarat)
                    $.each(res.syarat, function (key, item) {
                        $('#list-syarat').append("<tr>\
                                                    <td class=text-capitalize>"+ item.jenis_syarat.nama +"</td>\
                                                    <td>"+ item.status +"</td>\
                                                    <td>"+ item.keterangan +"</td>\
                                                    </tr>")
                    });
                    switch(res.status_pengaduan){
                        case 'baru':
                            $('#status_pengaduan').text(res.status_pengaduan)
                            $('#status_pengaduan').addClass('btn btn-primary')
                        break;
                        case 'diterima':
                            $('#status_pengaduan').text(res.status_pengaduan)
                            $('#status_pengaduan').addClass('btn btn-success')
                        break;
                        case 'diperbaiki':
                            $('#status_pengaduan').text(res.status_pengaduan)
                            $('#status_pengaduan').addClass('btn btn-danger')
                        break;
                    }
                }
            }        
        })
    })
})

    