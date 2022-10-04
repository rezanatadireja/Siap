$(document).ready(function(){
    $('#jenis_pengaduan').DataTable();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keycode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    $('.btn-edit').on('click', function(){
        // console.log($(this).data('id'))
        let id = $(this).data('id')
        // console.log(id)
        $.ajax({
            url:`jenis-pengaduan/${id}/edit`,
            method:"GET",
            success:function(res){
                $('#editPengaduanModal').modal('show')
                if(res.code == 0)
                {
                    // console.log(res)
                    iziToast.error({
                        title:'Sukses',
                        message: res.msg,
                        position: 'topRight',
                    })
                }else {
                    // console.log(res)
                    $('#id_data').val(res.id)
                    $('#edit_nama').val(res.nama)
                    $('#edit_kuota').val(res.kuota)
                    $('#edit_bidang').val(res.bidang)
                    $('#edit_sub_bidang').val(res.sub_bidang)
                    // $('#id_bidang').val(res.bidang_id)
                    // $('#id_sub_bidang').val(res.sub_id)
                }
            },
            error:function(error){
                console.log(error)
            }
        })
    })

    $('.btn-update').on('click', function(e){
        e.preventDefault()
        var id = $('#id_data').val()
        var data = {
            'id'                    : $('#id_data').val(),
            'nama'                  : $('#edit_nama').val(),
            'kuota'                 : $('#edit_kuota').val(),
            'bidang_pengaduan_id'   : $('#edit_bidang').val(),
            'sub_bidang_id'         : $('#edit_sub_bidang').val(),
        }
        // alert(data)
        // console.log(data)

        $.ajax({
            url:`/jenis-pengaduan/${id}/update`,
            method:"PUT",
            data:data,
            dataType:"json",
            beforeSend:function(){
                $('.btn-update').addClass('btn-progress');
            },
            success:function(res){
                if(res.status == 400){
                    $('.btn-update').removeClass('btn-progress');
                    $('#listError').html("")
                    $('#listError').addClass('alert alert-danger')
                    $.each(res.errors, function(key,err_values){
                        $('#listError').append('<li>'+err_values+'</li>');
                    })
                }else if (res.status == 200){
                    // $(form)[0].reset();
                    $('#editPengaduanModal').modal('hide');
                    iziToast.success({
                        title: 'Sukses',
                        message: res.msg,
                        position: 'topRight',
                    })
                    console.log(data)
                    location.reload();
                }else{
                    iziToast.warning({
                        title:'Galat',
                        message: res.msg,
                        position: 'topRight',
                    })
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