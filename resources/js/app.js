require('./bootstrap');

let userId = document.head.querySelector('meta[name="user-id"]').content;

Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        document.querySelector('.badge-transparent').innerText = notification.count;
        // console.log(notification)
        if(notification.data.status_pengaduan == "baru"){
            iziToast.info({
                title: 'Pengaduan Baru',
                message: notification.data.jenis_pelayanan + "  " + "dari" + "  " + notification.data.name,
                position: 'topRight',
                timeout: 50000,
            });
        }else{
            iziToast.success({
                title: 'Pengaduan',
                message: notification.data.jenis_pelayanan + "  " + "atas nama" + "  " + notification.data.user_name + " " + notification.data.status_pengaduan,
                position: 'topRight',
                timeout: 50000,
            });
        }
    });