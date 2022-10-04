$(function () {
    getPengaduan();

    //getPEngaduan
    function getPengaduan() {
        var URLpath = window.location.pathname;
        $.get(URLpath, {
            beforeSend: function () {
                $('#loading').attr('hidden', false)
            }
        }, function (data) {
            $('#loading').attr('hidden', true)
            $('#list-pengaduan').html(data.result);
        }, 'json');
    }

    $(document).on('click', '#showBtn', function () {
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({
            url: `pengaduan/show/${id}`,
            method: "GET",
            success: function (data) {
                // $('#list-pengaduan').hide()
                // location.reload()
                // getPengaduan().destroy
                // alert(data)
                // $('#lihatSyarat').find('.modal-body').html(data)
                // $('#lihatSyarat').modal('show')
            },
            error: function (error) {
                console.log(error)
            }
        })
    })
})