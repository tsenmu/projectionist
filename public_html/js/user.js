$(document).ready( function() {
    set_active_navbar_button('#user');  
    $("#panel-user-cp #submit-change-password").click( function() {
        init_validation();
        if (!validate_change_password()) {
            return;
        }
    });
    function trim_all_white_space(str) {
        return str.replace(/\s+/g, '');
    }
    function validate_change_password() {
        password = $("#panel-user-cp #password");
        new_password = $("#panel-user-cp #new-password");
        repeat_new_password = $("#panel-user-cp #repeat-new-password");
        all_filled = true;
        if (password.val() == null || trim_all_white_space(password.val()).length == 0) {
            $('#panel-user-cp #div-password').addClass('has-error');
            all_filled = false; 
        }
        if (new_password.val() == null || trim_all_white_space(new_password.val()).length == 0) {
            $('#panel-user-cp #div-new-password').addClass('has-error');
            all_filled = false;
        }
        if (repeat_new_password.val() == null || trim_all_white_space(repeat_new_password.val()).length == 0) {
            $('#panel-user-cp #div-repeat-new-password').addClass('has-error');
            all_filled = false;
        }
        if (!all_filled) {
            generate_alert('#panel-user-cp #alert', 'alert-danger', "更改失败：信息填写不完整");
            return false;
        }
        if (new_password.val() != repeat_new_password.val()) {
            generate_alert('#panel-user-cp #alert', 'alert-danger', "更改失败：新密码与重复新密码不符");
            $('#panel-user-cp #div-repeat-new-password').addClass('has-error');
            $('#panel-user-cp #div-new-password').addClass('has-error');
            return false;
        }
        $.post('logic/ajax_target.php', {
            'func' : 'user_change_password',
         'password': password.val(),
        'new-password' : new_password.val(),
        }, function(data, status)
        {
            if(data.indexOf("SUCCESS") != -1) {
                generate_alert('#panel-user-cp #alert', 'alert-success', "更改成功");
            } else
        {
            generate_alert('#panel-user-cp #alert', 'alert-danger', '更改失败：旧密码输入错误');
        }
        });
    }
    function init_validation() {
        $('.form-group').removeClass('has-error');
    }
});
