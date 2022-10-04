$(document).ready(function () {
    var route = "/cekhakakses/ubah_role";
    var bolehUbah;
    $.get(route, function (res) {
        bolehUbah = res;
    });

    var route1 = "/cekhakakses/hapus_role";
    var bolehHapus;
    $.get(route1, function (res) {
        bolehHapus = res;
    });

    $('#dataTableBuilder').DataTable({        
        responsive: true,
        'ajax': {
            'url':'role-permission',
        },
        'columnDefs': [
        {
            'targets':0,
            'sClass': "text-center col-sm-2"
        },{
            'targets':1,
            'sClass': "text-center col-sm-2"
        },{
            'targets':2,
            'sClass': "text-center col-sm-2"
        },{
        
            'targets':3,
            'searchable': false,
            "orderable": false,
            "orderData": false,
            "orderDataType": false,
            "orderSequence": false,
            "sClass": "text-center col-sm-2 td-aksi",
            'render': function (data, type, full, meta) {
                var kembali = '';
                if (bolehUbah == false) {
                    kembali += '<button title="Ubah Data" class="btn btn-sm btn-pill btn-warning" data-toggle="modal" data-target="#modalUbah" onclick="UbahClick(this);"><i class="cil-pencil"></i></button> | ';
                } 
                if (bolehHapus == false) {
                    kembali += '<button title="Hapus Data" class="btn btn-sm btn-pill btn-danger" data-toggle="modal" data-target="#modalHapus" onclick="HapusClick(this);"><i class="cil-trash"></i></button>';
                }
                return kembali;
            }
        },],
        'rowCallback': function (row, data, dataIndex) {
            if (bolehUbah == false) {
                $(row).find('button[class="btn btn-sm btn-pill btn-warning"]').prop('value', data[3]);
            }
            if (bolehHapus == false) {
                $(row).find('button[class="btn btn-sm btn-pill btn-danger"]').prop('value', data[3]);
            }
        }
    });

    $('select[name="permissions_grupubah[]"]').bootstrapDualListbox();

    document.getElementById("nameubah").maxLength = 50;
    document.getElementById("display_nameubah").maxLength = 50;
    document.getElementById("descriptionubah").maxLength = 50;

    document.getElementById("name").maxLength = 50;
    document.getElementById("display_name").maxLength = 50;
    document.getElementById("description").maxLength = 50;
 
    $('#name').focus();

    var inputHakAkses = $('select[name="permissions_grup[]"]').bootstrapDualListbox();
});

function resetTambah() {
    $('#name').val(null);
    $('#display_name').val(null);
    $('#description').val(null);
    $('select[name="permissions_grup[]"]').val(null);
    $('select[name="permissions_grup[]"]').bootstrapDualListbox('refresh');
    $('#name').focus();
}

$('#simpantambah').click(function() {
    var route = "/roles-permissions";
    var token = $('#token').val();

    var name = $('#name').val();
    if (name == '' || name == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Level User tidak boleh kosong!"});
        $('#name').focus();
        return;
    }
    var display_name = $('#display_name').val();
    if (display_name == '' || display_name == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Nama tidak boleh kosong!"});
        $('#display_name').focus();
        return;
    }
    var description = $('#description').val();
    if (description == undefined) {
            description = '';
    }
    var permissions_grup = $('select[name="permissions_grup[]"]').val();
    if (permissions_grup == null || jQuery.isEmptyObject(permissions_grup)) {        
        Swal.fire({icon:"error",title:"Error",text:"Level User harus memiliki hak akses (Permission)"});
        $('select[name="permissions_grup[]"]').focus();
        return;
    }

    $.ajax({
    url: route,
    type: 'POST',
    headers: {'X-CSRF-TOKEN': token},
    dataType: 'json',
    data: {
        name: name,
        display_name: display_name,
        description: description,
        permissions_grup: permissions_grup,
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
    success: function() {
        reloadTable();
        Swal.fire({icon:"success",title:"Success",text:"Data Role Permission berhasil disimpan!"});
        resetTambah();
    }
    });
});

function reloadTable() {
    var table = $('#dataTableBuilder').dataTable();
    table.cleanData;
    table.api().ajax.reload();
}

function HapusClick(btn) {
    $('#idHapus').val(btn.value);
}

$('#yakinhapus').click(function () {
    var token = $('#token').val();
    var id = $('#idHapus').val();
    var route = "/roles-permissions/" + id;

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
            Swal.fire({icon:"success",title:"Success",text:"Data Role Permission berhasil dihapus!"});
            $('#modalHapus').modal('toggle');
        }
    });
});

function UbahClick(btn) {
    route = "/roles-permissions/" + btn.value + "/edit";

    $.get(route, function (res) {
        $('#idubah').val(res.id);
        $('#nameubah').val(res.name);
        $('#display_nameubah').val(res.display_name);
        $('#descriptionubah').val(res.description);
        $('select[name="permissions_grupubah[]"]').val(res.permissions_grup);
        $('select[name="permissions_grupubah[]"]').bootstrapDualListbox('refresh');
        $('#display_nameubah').focus();
    });
}

$('#simpanubah').click(function () {
    var id = $('#idubah').val();
    var token = $('#token').val();
    var route = "/roles-permissions/" + id;

    var name = $('#nameubah').val();
    if (name == '' || name == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Level User tidak boleh kosong!"});
        $('#nameubah').focus();
        return;
    }
    var display_name = $('#display_nameubah').val();
    if (display_name == '' || display_name == undefined) {
        Swal.fire({icon:"error",title:"Error",text:"Nama tidak boleh kosong!"});
        $('#display_nameubah').focus();
        return;
    }
    var description = $('#descriptionubah').val();
    if (description == undefined) {
        description = '';
    }
    var permissions_grup = $('select[name="permissions_grupubah[]"]').val();
    if (permissions_grup == null || jQuery.isEmptyObject(permissions_grup)) {
        Swal.fire({icon:"error",title:"Error",text:"Level User harus memiliki hak akses (Permission)"});
        $('select[name="permissions_grupubah[]"]').focus();
        return;
    }

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: {
            name: name,
            display_name: display_name,
            description: description,
            permissions_grup: permissions_grup,
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
            Swal.fire({icon:"success",title:"Success",text:"Data Role Permission berhasil diupdate!"});
            $('#modalUbah').modal('toggle');
        }
    });
});