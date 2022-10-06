$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // SUB-BIDANG
    $('#subBidang').on('change', function (e) {
        var sub_bidang_id = e.target.value;
        $.get('/list-pengaduan?sub_bidang_id=' + sub_bidang_id, function (data) {
            $('#jenis_pelayanan').empty();
            $('#jenis_pelayanan').append('<option value="0" disable="true" selected="true">Pilih Pelayanan</option>');
            $.each(data, function (index, pelayananObj) {
                $('#jenis_pelayanan').append('<option value="' + pelayananObj.id + '">' + pelayananObj.nama + '</option>');
            })
        });
    });
    
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
            $('#kecamatan').empty();us
            $('#kecamatan').append('<option value="0" disable="true" selected="true">Pilih Kecamatan</option>');
            $.each(data, function (index, districtsObj) {
                $('#kecamatan').append('<option value="' + districtsObj.id + '">' + districtsObj.name + '</option>');
            })
        });
    });
    // Kecamatan
    $('#kecamatan').on('change', function (e) {
        var districts_id = e.target.value;
        // console.log(districts_id)
        $.get('/village?districts_id=' + districts_id, function (data) {
            console.log(data)
            $('#desa').empty();
            $('#desa').append('<option value="0" disable="true" selected="true">Pilih Desa</option>');
            $.each(data, function (index, villagesObj) {
                $('#desa').append('<option value="' + villagesObj.id + '">' + villagesObj.name + '</option>');
            })
        });
    });
    
    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keycode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    $(document).on('click', '.addPengaduan', function(e){
        e.preventDefault()
        var user_id = $('#user_id').val()
        var user_name = $('#user_name').val()
        var jenis_pengaduan_id = $('#jenis_pelayanan').val()

        $.ajax({
            url:'pengaduan',
            method:'POST',
            data:{
                user_id:user_id,
                user_name:user_name,
                jenis_pengaduan_id:jenis_pengaduan_id,
            },
            dataType:'JSON',
            beforeSend:function(){
                $('.addPengaduan').addClass('btn-progress')
            },
            success:function(data){
                if(data.code == 0){
                    $('.addPengaduan').removeClass('btn-progress')
                    $('#subBidang').val('').trigger('change');
                    $('#jenis_pelayanan').val('').trigger('change');
                    Swal.fire({
                        title: 'Kuota Pelayanan Habis.',
                        text: "Silahkan mengajukan dilain waktu, Terima kasih.",
                        icon: 'warning',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // window.location.href = "/dashboard/mYpengaduan"
                            // location.href()
                        }
                    })
                }else if(data.code == 1){
                    $('.addPengaduan').removeClass('btn-progress')
                    $('#subBidang').val('').trigger('change');
                    $('#jenis_pelayanan').val('').trigger('change');
                    var id = data.id
                    Swal.fire({
                        title: 'Pelayanan Berhasil dikirim',
                        text: "Silahkan lengkapi persyaratan pengaduan, Terima kasih.",
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `pengaduan/${id}`
                        }
                    })
                }
                else if(data.code == 2){
                    $('.addPengaduan').removeClass('btn-progress')
                    $.each(data.error, function(prefix, val){
                        iziToast.error({
                            title:'Galat',
                            message: val,
                            position: 'topRight',
                        })
                    })
                }
            },
            error:function(xhr){
                console.log(xhr)
            }
        })
    })
})

