$(function () {
    $('#form').on('submit', function (e) {
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
                    getSyarat();
                    iziToast.success({
                        message: data.msg,
                        position: 'topRight',
                    })
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
                // console.log(lengthSyarat)
                if (lengthSyarat != syarat) {
                    $("#formSyarat").removeAttr('hidden');
                    $("#formSyarat").fadeIn();
                    $("#formSyarat").fadeIn("slow");
                    $("#formSyarat").fadeIn(3000);
                } else {
                    $("#formSyarat").fadeOut();
                    $("#formSyarat").fadeOut("slow");
                    $("#formSyarat").fadeOut(3000);
                    Swal.fire({
                        title: 'Persyaratan Pengaduan Sudah Terpenuhi.',
                        text: "Silahkan menunggu admin verifikasi persyratan. Terima kasih.",
                        icon: 'success',
                    })
                }
            })
        }, 'json');
    }

    $(document).on('click', '#showBtn', function () {
        var syarat_id = $(this).data('id')
        var url = `syarat/${syarat_id}`
        $.get(url, function (data) {
            // console.log(data)
            // alert(data)
            var syarat_modal = $('.showSyarat')
            $(syarat_modal).find('a').attr('href', '/storage/files/' + data.file)
            $(syarat_modal).find('a').attr('data-caption', '' + data.nama)
            $(syarat_modal).find('img').attr('src', '/storage/files/' + data.file)
            $(syarat_modal).find('input[name="jenisSyarat_id"]').val(data.nama)
            $(syarat_modal).modal('show')
        }, 'json')
    })

    $(document).on('click', '#editbtn', function () {
        var syarat_id = $(this).data('id');
        var url = `syarat/${syarat_id}`;
        $.get(url, function (data) {
            // alert(data.result.file);
            var syarat_modal = $('.editSyarat');
            $(syarat_modal).find('form').find('input[name="syarat_id"]').val(data.result.id);
            $(syarat_modal).find('form').find('select[name="jenis_syarat_id"]').val(data.result.jenis_syarat_id);
            $(syarat_modal).find('form').find('.img-holder-update').html('<img src="/storage/files/' + data.result.file + '"class="img-fluid" style="max-width:100px;margin-botton:10px;">');
            $(syarat_modal).find('form').find('input[type="file"]').attr('data-value', '<img src="/storage/files/' + data.result.file + '"class="img-fluid" style="max-width:100px;margin-botton:10px;">');
            $(syarat_modal).find('form').find('input[type="file"]').val();
            $(syarat_modal).find('form').find('span.error-text');
            $(syarat_modal).modal('show');
        }, 'json');
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

                    $('.editSyarat').hide()
                    location.reload()
                }
            }
        });
    });

    // $(document).on('click', '.btn-update', function () {
    //     var pengaduan_id = $(this).data('id');
    //     // console.log(pengaduan_id);
    //     var url = `update-pengaduan/${pengaduan_id}`;
    //     // var form = this;
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: url,
    //         method: "GET",
    //         data: { pengaduan_id: pengaduan_id },
    //         dataType: 'json',
    //         success: function (data) {
    //             if (data.code == 1) {
    //                 iziToast.success({
    //                     title: 'Sukses',
    //                     message: data.msg,
    //                     position: 'topRight',
    //                 })
    //                 $('#lihatPesan').modal('hide')
    //                 location.reload();
    //             } else {
    //                 $('#lihatPesan').modal('hide')
    //                 iziToast.error({
    //                     message: data.msg,
    //                     position: 'topRight',
    //                 })
    //             }
    //         }
    //     })
    // })

    // //edit
    // $(document).on('click', '#editbtn', function (){
    //     var syarat_id = $(this).data('id');
    //     var url = `syarat/${syarat_id}`;
    //     $.get(url, function(data){
    //         // alert(data.result.file);
    //         var syarat_modal = $('.lihatSyarat');
    //         $(syarat_modal).find('form').find('input[name="syarat_id"]').val(data.result.id);
    //         $(syarat_modal).find('form').find('select[name="jenis_syarat_id"]').val(data.result.jenis_syarat_id);
    //         $(syarat_modal).find('form').find('.img-holder-update').html('<img src="/storage/files/'+data.result.file+'"class="img-fluid-center" style="max-width:1000px;margin-botton:10px;">');
    //         $(syarat_modal).find('form').find('input[type="file"]').attr('data-value', '<img src="/storage/files/'+data.result.file+'"class="img-fluid" style="max-width:100px;margin-botton:10px;">');
    //         $(syarat_modal).find('form').find('input[type="file"]').val();
    //         $(syarat_modal).find('form').find('span.error-text');
    //         $(syarat_modal).modal('show');
    //     }, 'json');
    // })

    $('input[type="file"][name="file_update"]').on('change', function () {
        var img_path = $(this)[0].value;
        var img_holder = $('.img-holder-update');
        var currentImagePath = $(this).data('value');
        var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCase();
        if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
            if (typeof (FileReader) != 'undefined') {
                img_holder.empty();
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('<img/>', { 'src': e.target.result, 'class': 'img-fluid', 'style': 'max-width:100px;margin-botton:10px;' }
                    ).appendTo(img_holder);
                }
                img_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                $(img_holder).html('This browser not support File Reader');
            }
        } else {
            $(img_holder).html(currentImagePath);
        }
    });

    $(document).on('click', '#clearInput', function () {
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
                    location.reload()
                    $('.editSyarat').hide();
                    iziToast.success({
                        message: data.msg,
                        position: 'topRight',
                    })
                    getSyarat();
                }
            }
        });
    });

    $(document).on('click', '.deleteBtn', function () {
        var syarat_id = $(this).data('id');
        var url = `syarat/${syarat_id}/delete`;

        if (confirm('Anda yakin ingin menghapus syarat ?')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: 'post',
                data: { syarat_id: syarat_id },
                dataType: 'json',
                success: function (data) {
                    if (data.code == 1) {
                        iziToast.success({
                            message: data.msg,
                            position: 'topRight',
                        })
                        getSyarat();
                    } else {
                        alert(data.msg)
                    }
                }
            })
        }
    })

    $(document).on('click', '#popup', function () {
        var src = $(this).attr('src')
        $('#img').modal('show')
        $('#popup-img').attr('src', src)
    })
})