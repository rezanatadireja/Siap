$(document).ready(function(){
      $.ajaxSetup({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      getCek()

        function getCek(){
          var URLpath = window.location.pathname
          $.get(URLpath, {}, function(data){
              $.each(data.cek, function(key,value){
                var angka = value.kuota
                var pengaduan = value.nama
                if(angka < 0){
                  // iziToast.success({
                  //       message: pengaduan,
                  //       position: 'topRight',
                  //   })
                }else{
                  Swal.fire({
                        title: pengaduan,
                        text:  'Kuota pelayanan telah habis.',
                        icon: 'warning',
                        width: '38em',
                        showCancelButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#editKuotaPengaduan').modal('show')
                            $('#bidang').val(value.bidang_pengaduan_id)
                            $('#sub_bidang').val(value.sub_bidang_id)
                            $('#nama').val(pengaduan)
                            $('#kuota').val(value.kuota)
                            $('#id_data').val(value.id)
                        }
                    })
                }
              })
          }, 'json')
        }

        $(document).on('click', '.updateKuota', function(e){
            e.preventDefault()
            var id = $('#id_data').val()
            var data = {
              'id'                  : $('#id_data').val(),
              'kuota'               : $('#kuota').val(),
              'nama'                : $('#nama').val(),
              'bidang_pengaduan_id' : $('#bidang').val(),
              'sub_bidang_id'       : $('#sub_bidang').val()
            }

            $.ajax({
              url:`/jenis-pengaduan/${id}/update`,
              method:'PUT',
              data:data,
              dataType:'JSON',
              beforeSend:function(){
                $('.updateKuota').addClass('btn-progress')
              },
              success:function(data){
                if(data.status == 400){
                  $('.updateKuota').removeClass('btn-progress');
                  $('#listError').html("")
                  $('#listError').addClass('alert alert-danger')
                  $.each(res.errors, function(key,err_values){
                      $('#listError').append('<li>'+err_values+'</li>');
                  })
                }else if(data.status == 200){
                  $('.updateKuota').removeClass('btn-progress');
                  $('#listError').html("")
                  iziToast.success({
                        title:'Sukses',
                        message: data.msg,
                        position: 'topRight',
                  })
                  $('#editKuotaPengaduan').modal('hide')
                  location.reload()
                }else{
                  $('.updateKuota').removeClass('btn-progress');
                  iziToast.warning({
                      position: 'topRight',
                    })
                }
              },
              error:function(xhr){
                console.log(xhr)
                  }
            })
      })
})