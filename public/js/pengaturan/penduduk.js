$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#kecamatan_ubah').select2();
    $('#kecamatan').select2();

    // SUB-BIDANG
    $('#subBidang').on('change', function (e) {
        var sub_bidang_id = e.target.value;
        $.get('/jenis-pengaduan?sub_bidang_id=' + sub_bidang_id, function (data) {
            $('#jenis_pelayanan').empty();
            $('#jenis_pelayanan').append('<option value="0" disable="true" selected="true">Pilih Pelayanan</option>');
            $.each(data, function (index, pelayananObj) {
                $('#jenis_pelayanan').append('<option value="' + pelayananObj.id + '">' + pelayananObj.nama + '</option>');
            })
        });
    });
// 
    $('#jenis_pelayanan').on('change', function (e) {
        var jenis_pengaduan_id = e.target.value;
        $.get('/jenis-syarat?jenis_pengaduan_id=' + jenis_pengaduan_id, function (data) {
            $('#jenis_syarat').empty();
            $('#jenis_syarat').append('<li value="" disable="true" class="list-group-item">Persiapkan syarat-syarat berikut ini :</li>');
            $.each(data, function (index, syaratObj) {
                $('#jenis_syarat').append('<li value="' + syaratObj.id + '" class="list-group-item">' + syaratObj.nama + '</li>');
            })
        });
    });

    // PROVINSI
    $('#provinsi').on('change', function (e) {
        var province_id = e.target.value;
        $.get('/regencies?province_id=' + province_id, function (data) {
            $('#kota').empty();
            $('#kota').append('<option value="0" disable="true" selected="true">Pilih Kota</option>');
            $('#kecamatan').empty();
            $('#kecamatan').append('<option value="0" disable="true" selected="true">Pilih Kecamatan</option>');
            $('#desa').empty();
            $('#desa').append('<option value="0" disable="true" selected="true">Pilih Desa</option>');

            $.each(data, function (index, regenciesObj) {
                $('#kota').append('<option value="' + regenciesObj.id + '">' + regenciesObj.name + '</option>');
            })
        });
    });
    // Kota
    $('#kota').on('change', function (e) {
        var regencies_id = e.target.value;
        $.get('/districts?regencies_id=' + regencies_id, function (data) {
            $('#kecamatan').empty();
            $('#kecamatan').append('<option value="0" disable="true" selected="true">Pilih Kecamatan</option>');
            $.each(data, function (index, districtsObj) {
                $('#kecamatan').append('<option value="' + districtsObj.id + '">' + districtsObj.name + '</option>');
            })
        });
    });
    // Kecamatan
    $('#kecamatan').on('change', function (e) {
        var districts_id = e.target.value;
        $.get('/village?districts_id=' + districts_id, function (data) {
            $('#desa').empty();
            $('#desa').append('<option value="0" disable="true" selected="true">Pilih Desa</option>');
            $.each(data, function (index, villagesObj) {
                $('#desa').append('<option value="' + villagesObj.id + '">' + villagesObj.name + '</option>');
            })
        });
    });
    // Kecamatan
    $('#edit_kecamatan').on('change', function (e) {
        var districts_id = e.target.value;
        $.get('/village?districts_id=' + districts_id, function (data) {
            $('#edit_desa').empty();
            $('#edit_desa').append('<option value="0" disable="true" selected="true">Pilih Desa</option>');
            $.each(data, function (index, villagesObj) {
                $('#edit_desa').append('<option value="' + villagesObj.id + '">' + villagesObj.name + '</option>');
            })
        });
    });

    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keycode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    

    $(document).on('click', '#tambahPenduduk', function (e){
        e.preventDefault();
        // alert('submit form');
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend:function(){
                $(form).find('span.error-text').text('');
            },
            success:function(data){
                if(data.code == 0){
                    $.each(data.error, function(prefix,val){
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                }else{
                    $('#addPenduduk').modal('hide');
                    iziToast.success({
                        message: data.msg,
                        position: 'topRight',
                    })
                    $(form)[0].reset();
                    $('#list-penduduk').DataTable().ajax.reload()
                }
            }
        });
    });

    $(document).on('click', '.btn-edit', function(){
        // console.log($(this).data('id'))
        let id = $(this).data('id')
        // console.log(id)
        $.ajax({
            url:`penduduk/${id}/edit`,
            method:"GET",
            success:function(res){
                if(res.code == 0)
                {
                    // console.log(res)
                    iziToast.error({
                        message: res.msg,
                        position: 'topRight',
                    })
                }else {
                    $('#editPenduduk').modal('show')
                    // console.log(res)
                    $('#edit_nama').val(res.penduduk.nama)
                    $('#edit_username').val(res.penduduk.user.username)
                    $('#edit_email').val(res.penduduk.user.email)
                    $('#edit_nik').val(res.penduduk.nik)
                    $('#edit_kk').val(res.penduduk.no_kk)
                    $('#edit_hp').val(res.penduduk.no_hp)
                    $('#edit_kecamatan').val(res.penduduk.district_id)
                    $('#edit_desa').val(res.penduduk.village_id)
                    $('#id_data').val(res.penduduk.id)
                }
            },
            error:function(error){
                console.log(error)
            }
        })
    })

    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id')
        var url = `/penduduk/${id}/delete`;
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
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (data) {
                        if (data.code == 1) {
                            iziToast.success({
                                message: data.msg,
                                position: 'topRight',
                            })
                            $('#list-penduduk').DataTable().ajax.reload()
                        } else {
                            alert(data.msg)
                        }
                    },
                })
            }
        })
    })

    $('.btn-update').on('click', function(e){
        e.preventDefault()
        var id = $('#id_data').val()
        var data = {
            'nama' : $('#edit_nama').val(),
            'username' : $('#edit_username').val(),
            'email' : $('#edit_email').val(),
            'password' : $('#edit_password').val(),
            'nik' : $('#edit_nik').val(),
            'no_kk' : $('#edit_kk').val(),
            'no_hp' : $('#edit_hp').val(),
            'district_id' : $('#edit_kecamatan').val(),
            'village_id' : $('#edit_desa').val(),
        }
        // alert(id)

        $.ajax({
            url:`/penduduk/${id}/update`,
            method:"PUT",
            data:data,
            dataType:"json",
            beforeSend:function(){
                $('.btn-update').addClass('btn-progress');
            },
            success:function(res){
                if(res.status == 400){
                    $('#update-error').html("")
                    $('#update-error').addClass('alert alert-danger')
                    $.each(res.errors, function(key,err_values){
                        $('#update-error').append('<li>'+err_values+'</li>');
                    });
                }else{
                    // $(form)[0].reset();
                    $('#editPenduduk').modal('hide');
                    iziToast.success({
                        message: res.msg,
                        position: 'topRight',
                    })
                    $('#list-penduduk').DataTable().ajax.reload()
                } 
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
            // location.reload();
            } else {
            // swal('Your Data Berhasil Di Hapus.')
            }
        });
    });
})