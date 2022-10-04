$(document).ready(function(){
    $(function() {
    $('#form').on('submit', function (e){
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
    function getSyarat(){
        var URLpath = window.location.pathname; 
        $.get(URLpath, {beforeSend:function(){
            $('#loading').attr('hidden', false)
        }}, function(data){
            $('#loading').attr('hidden', true)
            $('#list-syarat').html(data.result);
                $.each(data.cek, function(key, item){
                    var syarat = item.jenis_syarat_count
                    var lengthSyarat = $('#dataSyarat').find('tbody > tr').length
                    console.log(lengthSyarat)
                    if (lengthSyarat != syarat){
                        // alert("yes")
                        // $('#valueSyarat').show()
                        ''
                    }else{
                        // $('#valueSyarat').hide()
                        // alert("no")
                        Swal.fire({
                            title: 'Persyaratan pengaduan sudah terpenuhi.',
                            text: "Silahkan tunggu, admin verifikasi persyratan.<br> Terima kasih.",
                            icon: 'success',
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location.href = "/dashboard/mYpengaduan"
                                // location.href()
                            }
                        })
                    }
                })
            }, 'json');
    }

    //show
    $(document).on('click', '#popup', function () {
        var src = $(this).attr('src')
        $('#img').modal('show')
        $('#popup-img').attr('src', src)
    })

    $(document).on('click', '#showBtn', function(){
        var syarat_id = $(this).data('id')
        var url = `syarat/${syarat_id}/show`
        $.get(url, function(data){
            // console.log(data)
            // alert(data)
            var syarat_modal = $('.showSyarat')
            $(syarat_modal).find('a').attr('href', '/storage/files/'+data.file)
            $(syarat_modal).find('a').attr('data-caption', ''+data.nama)
            $(syarat_modal).find('img').attr('src', '/storage/files/'+data.file)
            $(syarat_modal).find('input[name="jenisSyarat_id"]').val(data.nama)
            $(syarat_modal).modal('show')
        }, 'json')
    })


    //edit
    $(document).on('click', '#editbtn', function (){
        var syarat_id = $(this).data('id');
        var url = `syarat/${syarat_id}`;
        $.get(url, function(data){
            // alert(data.result.file);
            var syarat_modal = $('.editSyarat');
            $(syarat_modal).find('form').find('input[name="syarat_id"]').val(data.result.id);
            $(syarat_modal).find('form').find('select[name="jenis_syarat_id"]').val(data.result.jenis_syarat_id);
            $(syarat_modal).find('form').find('.img-holder-update').html('<img src="/storage/files/'+data.result.file+'"class="img-fluid justify-content-center" style="max-width:150px;margin-bottom:10px;">');
            $(syarat_modal).find('form').find('input[type="file"]').attr('data-value', '<img src="/storage/files/'+data.result.file+'"class="img-fluid" style="max-width:100px;margin-botton:10px;">');
            $(syarat_modal).find('form').find('input[type="file"]').val();
            $(syarat_modal).find('form').find('span.error-text');
            $(syarat_modal).modal('show');
        }, 'json');
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
                    $('<img/>', {'src':e.target.result, 'class' : 'img-fluid', 'style' : 'max-width:100px;margin-botton:10px;margin:0;'}
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
                        message: data.msg,
                        position: 'topRight',
                    })
                    getSyarat();
                    $('.editSyarat').modal('hide');
                }
            }
        });
    });

    $(document).on('click', '.deleteBtn', function () {
        let syarat_id = $(this).data('id')
        var url = `syarat/${syarat_id}/delete`;
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
                        },
                    })
                }
            })
        })
    })
})