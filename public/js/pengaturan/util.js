$(function () {
    'use strict';
    $('.select2').select2();
});

// change role change related permissions
function onChange() {
    var roleId = $("#role_id").val();
    var url = '/permissions' + '/' + roleId;
    $.get(url);
}

// check permissions check all if checked
function checkPermissions(elem) {
    var boxCheck = $(elem).parents();
    if ($(elem).is(":checked")) {
        boxCheck.children('div.card-body').children('p').children('input').attr('checked', 'checked');
    } else {
        boxCheck.children('div.card-body').children('p').children('input').removeAttr('checked');
    }
}

// check all permissons is checked
function checkAllPermissions(elem) {
    var boxCheckLen = $(elem).parents().children('div.card-body').children('p').children('input').length;
    var boxCheckedLen = $(elem).parents().children('div.card-body').children('p').children('input:checked').length;
    if (parseInt(boxCheckLen) === parseInt(boxCheckedLen)) {
        $(elem).parents().children('div.card-header').children('input').attr('checked', true);
    } else {
        $(elem).parents().children('div.card-header').children('input').attr('checked', false);
    }
}


function closeEl(removeParentDiv = '', removeClass = '') {
    $(removeParentDiv).removeClass("in");
    $(removeParentDiv).hide();
    $(".modal-backdrop").remove();
}

function onclickTextChange(id, value) {
    $("#" + id).text(value);
}

function onclickHide(id) {
    $("#" + id).hide();
}

function submitWithConfirm(id, message = 'Are you sure?') {
    var rConfirm = confirm(message);
    if (rConfirm) {
        $(id).submit();
    }
}

function submitOnEnter(id) {
    if (event.which == '13') {
        event.preventDefault();
        $(id).submit();
    }
}

