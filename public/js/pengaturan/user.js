$(document).ready(function () {
    document.getElementById("fullnameubah").maxLength = 200;
    document.getElementById("usernameubah").maxLength = 50;
    document.getElementById("passwordubah").maxLength = 50;
    // document.getElementById("validate_password").maxLength = 50;

    var route = "role-list";
    var inputTipe = $('#roleubah');
    var inputTipe1 = $('#role');

    var list = document.getElementById("roleubah");
    var list1 = document.getElementById("role");

    while (list.hasChildNodes()) {
        list.removeChild(list.firstChild);
    }
    while (list1.hasChildNodes()) {
        list1.removeChild(list1.firstChild);
    }

    inputTipe.append('<option value=" ">Pilih Level User</option>');
    inputTipe1.append('<option value=" ">Pilih Level User</option>');

    $.get(route, function (res) {
        $.each(res.data, function (index, value) {
            inputTipe.append('<option value="' + value[0] + '">' + value[1] + '</option>');
            inputTipe1.append('<option value="' + value[0] + '">' + value[1] + '</option>');
        });
    });


    var route1 = "/cekhakakses/ubah_user";
    var bolehUbah;
    $.get(route1, function (res) {
        bolehUbah = res;
    });

    var route2 = "/cekhakakses/hapus_user";
    var bolehHapus;
    $.get(route2, function (res) {
        bolehHapus = res;
    });

    $("#roleubah").select2();
    $("#role").select2();

    $('#dataTableBuilder').DataTable({
        responsive: true,
        'ajax': {
            'url':'/user',
        },
        'columnDefs':[
        {
            'targets':0,
            'sClass': "text-center"
        }, {
            'targets':1,
            'sClass': "text-center"
        },{
            'targets':2,
            'sClass': "text-center",
            'render': function (data, type, full, meta) {
                return '<input type="checkbox" disabled>';
            }
        },{
            'targets':3,
            'searchable': false,
            "orderable": false,
            "orderData": false,
            "orderDataType": false,
            "orderSequence": false,
            "sClass": "text-center td-aksi",
            'render': function (data, type, full, meta) {
                var kembali = '';
                if (bolehUbah == false) {
                    kembali += '<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="UbahClick(this);"><i class="far fa-edit"></i></button> | ';
                } 
                if (bolehHapus == false) {
                    kembali += '<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalHapus" onclick="HapusClick(this);"><i class="fas fa-times"></i></button>';
                }
                return kembali;
            }
        }],
        'rowCallback': function (row, data, dataIndex) {
            if (bolehUbah == false) {
                $(row).find('button[class="btn btn-primary btn-sm"]').prop('value', data[3]);
            }
            if (bolehHapus == false) {
                $(row).find('button[class="btn btn-sm btn-danger"]').prop('value', data[3]);
            }

            if (data[2] == '1') {
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');    
            }
        }
    });
    $('#ubahkatasandi').click(function () {
        var ubahkatasandi = $('#ubahkatasandi').is(':checked') ? 1 : 0;
        if (ubahkatasandi == 1) {
            $('#divSandi').removeClass('invisible');            
        } else {
            $('#divSandi').addClass('invisible');            
        }
    });

    document.getElementById("fullname").maxLength = 200;
    document.getElementById("username").maxLength = 50;
    document.getElementById("password").maxLength = 50;

    $("#active").attr('checked', true);
    $('#username').focus();
});

function resetTambah() {
    $('#username').val(null);
    $('#role').val(' ').trigger('change');
    $('#fullname').val(null);
    $('#password').val(null);
    $("#active").attr('checked', true);
    $('#username').focus();
}

$('#simpantambah').click(function() {
    var route = "/users";
    var token = $('#token').val();

    var username = $('#username').val();
    if (username == '' || username == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Username Tidak boleh kosong!"});
        $('#username').focus();
        return;
    }
    var role = $('#role').val();
    if (role == '' || role == ' ' || role == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Level User tidak boleh kosong!"});
        $('#role').focus();
        return;
    }
    var fullname = $('#fullname').val();
    if (fullname == '' || fullname == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Nama Lengkap tidak boleh kosong!"});
        $('#fullname').focus();
        return;
    }
    var password = $('#password').val();
    if (password == '' || password == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Kata Sandi tidak boleh kosong!"});
        $('#password').focus();
        return;
    }
    var active = $("#active").is(':checked') ? 1 : 0;
    if (active == undefined) {
        active = 1;
    }

    $.ajax({
        url: route,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': token},
        dataType: 'json',
        data: {
            fullname:fullname,
            username:username,
            role:role,
            password:password,
            active:active,
            _token:token
        },
        error: function (res) {
            var errors = res.responseJSON;
            var pesan = '';
            $.each(errors, function (index, value) {
                pesan += value + "\n";
            });

            alert(pesan);
        },
        success: function () {
            reloadTable();
            Swal.fire({ icon: "success", title:"Data User berhasil disimpan!",timer:"3000"});
            resetTambah();
        }
    });
});

function reloadTable() {
    var table = $('#dataTableBuilder').dataTable();
    table.cleanData;
    table.api().ajax.reload();
}

function UbahClick(btn) {
    route = "/users/" + btn.value + "/edit";

    $.get(route, function (res) {
        $('#idubah').val(res.id);
        $('#usernameubah').val(res.username);
        $('#roleubah').val(''+res.role).trigger('change');
        $('#passwordubah').val('');
        $('#fullnameubah').val(res.fullname);
        $("#activeubah").prop('checked', (res.active == '0' ? false : true));
        var ubahkatasandi = $('#ubahkatasandi').is(':checked') ? 1 : 0;
        if (ubahkatasandi == 1) {
            $('#divSandi').addClass('invisible');
            $("#ubahkatasandi").prop('checked', false);
        }
        $('#usernameubah').focus();
    });
}

$('#simpanubah').click(function () {
    var id = $('#idubah').val();
    var token = $('#token').val();
    var route = "/users/" + id;

    var username = $('#usernameubah').val();
    if (username == '' || username == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Username Tidak boleh kosong!"});
        $('#usernameubah').focus();
        return;
    }
    var role = $('#roleubah').val();
    if (role == '' || role == ' ' || role == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Level User tidak boleh kosong!"});
        $('#roleubah').focus();
        return;
    }
    var fullname = $('#fullnameubah').val();
    if (fullname == '' || fullname == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Nama Lengkap tidak boleh kosong!"});
        $('#fullnameubah').focus();
        return;
    }
    var password = '';
    var validate_password = '';

    var ubahkatasandi = $('#ubahkatasandi').is(':checked') ? 1 : 0;
    if (ubahkatasandi == 1) {
        password = $('#passwordubah').val();
        if (password == '' || password == undefined) {
            Swal.fire({icon:"error",title:"Error",text:"Kata Sandi tidak boleh kosong!"});
            $('#passwordubah').focus();
            return;
        }
    }

    var active = $("#activeubah").is(':checked') ? 1 : 0;
    if (active == undefined) {
        active = 1;
    }

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: {
            fullname : fullname,
            username : username,
            role : role,
            ubahkatasandi : ubahkatasandi,
            password : password,
            active : active,
            _token: token
        },
        error: function (res) {
            var errors = res.responseJSON;
            var pesan = '';
            $.each(errors, function (index, value) {
                pesan += value + "\n";
            });

            alert(pesan);
        },
        success: function () {
            reloadTable();
            Swal.fire({icon:"success",title:"Sukses mengubah Data User!"});
            $('#modalUbah').modal('toggle');
        }
    });
});

function HapusClick(btn) {
    $('#idHapus').val(btn.value);
}

$('#yakinhapus').click(function () {
    var token = $('#token').val();
    var id = $('#idHapus').val();
    var route = "/users/" + id;

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        error: function (res) {
            var errors = res.responseJSON;
            var pesan = '';
            $.each(errors, function (index, value) {
                pesan += value + "\n";
            });

            alert(pesan);
        },
        success: function () {
            reloadTable();
            Swal.fire({icon:"success",title:"Success",timer:"3000",text:"Sukses menghapus Data User!"});
            $('#modalHapus').modal('toggle');
        }
    });
});

$('#katasandiautoubah').click(function() {
    $('#passwordubah').val(randomPassword(5));
});
$('#katasandiauto').click(function() {
    $('#password').val(randomPassword(5));
});