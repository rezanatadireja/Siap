$(function() {
    $('#info').on('submit', function (e){
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
            beforeSend:function(){
                $(form).find('span.error-text').text('');
            },
            success:function(data){
                if(data.code == 0){
                    $.each(data.error, function(prefix,val){
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                }else{
                    $(form)[0].reset();
                    iziToast.success({
                        message: data.msg,
                        position: 'topRight',
                    })
                    getSyarat();
                }
            }
        });
    });


    getSyarat();
    
    //getSyarat
    function getSyarat() {
        var URLpath = window.location.pathname;
        $.get(URLpath, {
            beforeSend: function () {
                $('#loading').attr('hidden', false)
            }
        }, function (data) {
            $('#loading').attr('hidden', true)
            $('#daftarSyarat').html(data.result);
            $.each(data.cek, function (key, item) {
                var syarat = item.jenis_syarat_count
                var lengthSyarat = $('#dataSyarat').find('tbody > tr').length
                console.log(lengthSyarat)
                if (lengthSyarat != syarat) {
                    Swal.fire({
                        title: 'Persyaratan pengaduan belum terpenuhi.',
                        icon: 'warning',
                    })
                    $('#btnSMS').hide()
                } else {
                    $('#btnSMS').show()
                    // Swal.fire({
                    //     title: 'Persyaratan pengaduan sudah terpenuhi.',
                    //     text: "Silahkan verifisi persyaratan, Terima kasih.",
                    //     icon: 'success',
                    // })
                }
            })
        }, 'json');
    }

    $(document).on('click', '#editBtn', function(){
		let id = $(this).data('id');
		// console.log(id);
		$.ajax({
			url:`syarat/${id}`,
			method:"GET",
			success:function(data){
                // alert(data)
                $('#lihatSyarat').find('.modal-body').html(data)
                $('#lihatSyarat').modal('show')
			},
			error:function(error){
				console.log(error)
			}
		})
	})


    $(document).on('click', '.kirimPesan', function () {
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({
            url: `konfirmasi-pengaduan/${id}`,
            method: "GET",
            success: function (data) {
                // alert(data)
                $('#lihatPesan').find('.modal-body').html(data)
                $('#lihatPesan').modal('show')
            },
            error: function (error) {
                console.log(error)
            }
        })
    })

    $('#update_syarat').on('submit', function (e) {
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
                    iziToast.success({
                        message: data.msg,
                        position: 'topRight',
                    })

                    $('#lihatSyarat').hide()
                    location.reload()
                }
            }
        });
    });

    $(document).on('click', '.btn-update', function () {
        var pengaduan_id = $(this).data('id');
        // console.log(pengaduan_id);
        var url = `update-pengaduan/${pengaduan_id}`;
        // var form = this;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "GET",
            data: { pengaduan_id: pengaduan_id },
            dataType: 'json',
            success: function (data) {
                if (data.code == 1) {
                    iziToast.success({
                        title: 'Sukses',
                        message: data.msg,
                        position: 'topRight',
                    })
                    $('#lihatPesan').modal('hide')
                    location.reload();
                } else {
                    $('#lihatPesan').modal('hide')
                    iziToast.error({
                        title: 'Error',
                        message: data.msg,
                        position: 'topRight',
                    })
                }
            }
        })
    })

    $('input[type="file"][name="file_update"]').on('change', function(){
        var img_path = $(this)[0].value;
        var img_holder = $('.img-holder-update');
        var currentImagePath = $(this).data('value');
        var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
        if(extension == 'jpg' || extension == 'jpeg' || extension == 'png'){
            if(typeof(FileReader) != 'undefined'){
                img_holder.empty();
                var reader = new FileReader();
                reader.onload = function(e){
                    $('<img/>', {'src':e.target.result, 'class' : 'img-fluid', 'style' : 'max-width:100px;margin-botton:10px;'}
                    ).appendTo(img_holder);
                }
                img_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            }else{
                $(img_holder).html('This browser not support File Reader');
            }
        }else{
            $(img_holder).html(currentImagePath);
        }
    });

    $(document).on('click', '#clearInput', function(){
        var form = $(this).closest('form');
        $('form').find('input[type="file"]').val('');
        $('form').find('.img-holder-update').html($(form).find('input[type="file"]').data('value'));
    })

    //update Syarat
    $('#update_form').on('submit', function (e) {
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
                    iziToast.success({
                        title:'Sukses',
                        message: data.msg,
                        position: 'topRight',
                    })
                    getSyarat();
                    $('#lihatSyarat').modal('hide');
                }
            }
        });
    });

    $(document).on('click', '#clearInput', function () {
        $('form').find('#message').val('');
    })

    $('#sendSMS').on('submit', function(e) {
        e.preventDefault()
        var form = this
        // console.log(form)
        $.ajax({
            url: 'kirim-sms',
            method: 'POST',
            data:new FormData(form),
            dataType:'json',
            processData: false,
            contentType: false,
            beforeSend:function(){
                $('#kirim').addClass('btn-progress')
                $(form).find('span.error-text').text('');
            },
            success:function(data){
                if(data.code == 0){
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                }else{
                    $('#kirim').removeClass('btn-progress')
                    iziToast.success({
                        title: 'Sukses',
                        message: data.msg,
                        position: 'topRight',
                    })
                    $('#kirimSMS').modal('hide')
                }
            }, 
            error:function(xhr){
                console.log(xhr)
            }
        })
    })

    $('#sendWA').on('submit', function(e) {
        e.preventDefault()
        var form = this
        // console.log(form)
        $.ajax({
            url: 'kirim-wa',
            method: 'POST',
            data:new FormData(form),
            dataType:'json',
            processData: false,
            contentType: false,
            beforeSend:function(){
                $('#kirimWA').addClass('btn-progress')
                $(form).find('span.error-text').text('');
            },
            success:function(data){
                if(data.code == 0){
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                }else{
                    $('#kirimWA').removeClass('btn-progress')
                    iziToast.success({
                        title:'Sukses',
                        message: data.msg,
                        position: 'topRight',
                    })
                    $('#kirimWhatsapp').modal('hide')
                }
            }, 
            error:function(xhr){
                console.log(xhr)
            }
        })
    })

    // $(document).on('click', '.deleteBtn', function () {
    //     let syarat_id = $(this).data('id')
    //     var url = `syarat/${syarat_id}/delete`;
    //     Swal.fire({
    //         title: 'Anda Yakin Ingin Menghapus Data Ini ?',
    //         text: "Data yang dihapus tidak bisa kembali!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, hapus!',
    //         cancelButtonText: 'Kembali'
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 $.ajax({
    //                     headers: {
    //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                     },
    //                     url: url,
    //                     method: 'POST',
    //                     data: { syarat_id: syarat_id },
    //                     dataType: 'json',
    //                     success: function (data) {
    //                         if (data.code == 1) {
    //                             iziToast.success({
    //                                 message: data.msg,
    //                                 position: 'topRight',
    //                             })
    //                             getSyarat();
    //                         } else {
    //                             alert(data.msg)
    //                         }
    //                     },
    //                 })
    //             }
    //         })
    //     })

    $(document).on('click', '#popup', function (){
        var src = $(this).attr('src')
        $('#img').modal('show')
        $('#popup-img').attr('src', src)
    })
})