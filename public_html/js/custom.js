function init_sms() {

    $.ajax({
        method: "POST",
        url: "/phone_check",
        data: {action: "init"}
    }).done(function (respose) {

        if (respose.success == true) {

            $('#code_form').show();
        }
        alert(respose.msg);
    });
}

function check_sms() {

    var code = $('#code').val();
    if (code == '') {

        alert('Введите код с СМС.');
        return false;
    }

    $.ajax({
        method: "POST",
        url: "/phone_check",
        data: {action: "check", val: code}
    }).done(function (respose) {

        if (respose.success == true) {

            $('#code_form, #is_not_check').hide();
            $('#is_check').show();
        }

        alert(respose.msg);
    });
}
