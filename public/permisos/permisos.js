$('.chk-all').change(function () {
    var cls = $(this).prop('id');
    var chk = $(this).prop('checked');
    $('.' + cls + ' input[type=checkbox]').each(function () {
        $(this).prop('checked', chk);
    });
});

function verifyChecks(idx) {
    var res = true;
    $('.chk-item .chk-' + idx + ' input[type=checkbox]').each(function () {
        res |= $(this).prop('checked');
    });
    $('.chk-' + idx + ' .chk-all').prop('checked', res);
}

function verifyChecksAll(idx, sub, nro) {
    var chk = $('#chk-' + idx + '-' + sub).prop('checked');
    for (i=1; i<=nro; i++)
        $('#chk-' + idx + '-' + sub + '-' + i).prop('checked', chk);
    verifyChecks(idx);
}

function verifyChecksItem(idx, sub, nro) {
    var res = true;
    for (i=1; i<=nro; i++)
        res |= $('#chk-' + idx + '-' + sub + '-' + i).prop('checked');
    $('#chk-' + idx + '-' + sub).prop('checked', res);
    verifyChecks(idx);
}

$('#frm-permisos').submit(function(e) {
    e.preventDefault();
    var permisos = [];
    $('#frm-permisos input[type=checkbox]').each(function () {
        if ($(this).prop('checked'))
            permisos.push($(this).prop('name'));
    });
    $.post($(this).attr('action'), {
        personal_id : $('#personal_id').val(),
        permisos    : permisos,
    })
    .done(function(data) {
        limpiarChecks();
        $('#personal_id').val("");
        $("#rolesModal").modal("hide");
        Swal.fire("", data.message, "success");
    })
    .fail(function(msg) {
        var message = '<b>¡Atención!</b><ul>';
        $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
        Swal.fire("", message + '</ul>', "error");
    });
});

const handleRoles = function(ev) {
    const id = $(ev).attr("objectid");
    const item = datos.find((item) => item.id == id);
    if (item) {
        $.ajax({
            type: 'get',
            url: '../api/personal/obtenerRoles/' + id,
            success: function(data) {
                limpiarChecks();
                $(data).each(function() {
                    $("#frm-permisos [name='"+this.permiso_id+"']").prop('checked',true);
                });
            },
            error: function(msg) {
                var message = '<b>¡Atención!</b><ul>';
                $.each(msg.responseJSON['errors'], function() { message += addItem(this); });
                Swal.fire("", message + '</ul>', "error");
            }
        });
        $('#personal_id').val(id);
        $("#rolesModal").modal("show");
    }
};

function addItem(item) {
    return item ? ('<li>' + item + '</li>') : '';
}

function limpiarChecks() {
    $('#frm-permisos input[type=checkbox]').prop('checked',false);
}

$('#rolesModal').on('hidden.bs.modal', function () {
    limpiarChecks();
});