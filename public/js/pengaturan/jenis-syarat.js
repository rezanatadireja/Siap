// $('#list-jenis-syarat').DataTable({
//       processing: true,
//       serverSide: true,
//       responsive: true,
//       ordering: true, // Set true agar bisa di sorting
//       order: [[1, 'asc']], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
//       aLengthMenu: [[5, 10, 50, -1], [5, 10, 50, 'Semua']],
//       ajax: "{{ route('jenis-syarat.index') }}",
//       language: {
//             url: "{{asset('js/id.js')}}"
//       },
//       columns: [
//             {
//                   "data": null,
//                   "class": "align-top",
//                   "orderable": false,
//                   "searchable": false,
//                   "render": function (data, type, row, meta) {
//                         return meta.row + meta.settings._iDisplayStart + 1;
//                   }
//             },
//             { 'data': 'layanan_pengaduan' },
//             { 'data': 'syarat_pengaduan' },
//             { 'data': 'aksi', 'sortable': false },
//       ]
// });

// $(document).on('click', '.edit', function () {
//       let id = $(this).attr('id')
//       // console.log(id);
//       $.ajax({
//             url: `jenis-syarat/${id}/edit`,
//             method: "GET",
//             success: function (data) {
//                   $('#editPelayananModal').find('.modal-body').html(data)
//                   $('#editPelayananModal').modal('show')
//             },
//             error: function (error) {
//                   console.log(error)
//             }
//       })
// })

// $('#update_form').on('submit', function (e) {
//       e.preventDefault();
//       // alert('submit form');
//       var form = this;
//       // console.log(form)
//       $.ajax({
//             headers: {
//                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             url: $(form).attr('action'),
//             method: $(form).attr('method'),
//             data: new FormData(form),
//             processData: false,
//             dataType: 'json',
//             contentType: false,
//             beforeSend: function () {
//                   $(form).find('span.error-text').text('');
//             },
//             success: function (data) {
//                   if (data.code == 0) {
//                         $.each(data.error, function (prefix, val) {
//                               $(form).find('span.' + prefix + '_error').text(val[0]);
//                         });
//                   } else {
//                         $(form)[0].reset();
//                         iziToast.success({
//                               message: data.msg,
//                               position: 'topRight',
//                         })
//                         $('#editPelayananModal').modal('hide');
//                         $('#list-jenis-syarat').DataTable().ajax.reload()
//                   }
//             }
//       });
// });

// $(document).on('click', '.deleteBtn', function () {
//       let id = $(this).data('id')
//       var url = `jenis-syarat/${id}/delete`;
//       Swal.fire({
//             title: 'Anda Yakin Ingin Menghapus Data Ini ?',
//             text: "Data yang dihapus tidak bisa kembali!",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Ya, hapus!',
//             cancelButtonText: 'Kembali'
//       }).then((result) => {
//             if (result.isConfirmed) {
//                   $.ajax({
//                         headers: {
//                               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                         },
//                         url: url,
//                         method: 'POST',
//                         data: { id: id },
//                         dataType: 'json',
//                         success: function (data) {
//                               if (data.code == 1) {
//                                     iziToast.success({
//                                           message: data.msg,
//                                           position: 'topRight',
//                                     })
//                                     $('#list-jenis-syarat').DataTable().ajax.reload()
//                               } else {
//                                     alert(data.msg)
//                               }
//                         },
//                   })
//             }
//       })

// })