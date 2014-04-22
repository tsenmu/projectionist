$(document).ready(function() {
// pager
$('li.previous').click(function() {
    if ($("li.previous").hasClass('disabled')) return;
    vars = getUrlVars();
    vars['page'] = vars['page'].replace('#', '');
    vars['page'] = Number(vars['page']) - 1;
    new_page = "user-management.php?";
    jQuery.each(vars, function(index, key) {
        new_page = new_page + key + "=" + vars[key] + '&';
    });
    new_page = new_page.substr(0, new_page.length - 1);
    window.location.replace(new_page);
});
$('li.next').click(function() {
    if($('li.next').hasClass('disabled')) return;
    vars = getUrlVars();
    vars['page'] = vars['page'].replace('#', '');
    vars['page'] = Number(vars['page']) + 1;
    new_page = "user-management.php?";
    jQuery.each(vars, function(index, key) {
        new_page = new_page + key + "=" + vars[key] + '&';
    });
    new_page = new_page.substr(0, new_page.length - 1);
    window.location.replace(new_page);
});
if ($("span#user-count").text() == "") {
    update_user_count();
}
if ($("span#page-count").text() == "") {
    update_page_count();
}
function update_pager()
{
    if ($.urlParam('page') != null  && Number($.urlParam('page') == 1)) {
        $('li.previous').addClass('disabled');
    } else
    {
        $('li.previous').removeClass('disabled');
    }
    if ($.urlParam('page') != null && Number($.urlParam('page')) == Number($('span#page-count').text())) {
        $('li.next').addClass('disabled');
    }else {
        $('li.next').removeClass('disabled');
    }
}
function update_page_count()
{
    $('span#page-count').load('logic/ajax_target.php', {'func' : 'user_management_get_default_page_count'}, function() {
        if(Number($('span#page-count').text()) < Number($('input#current-page').val())) {
                    vars = getUrlVars();
                    vars['page'] = vars['page'].replace('#', '');
                    vars['page'] = Number($('span#page-count').text());
                    new_page = "user-management.php?";
                    jQuery.each(vars, function(index, key) {
                        new_page = new_page + key + "=" + vars[key] + '&';
                    });
                    new_page = new_page.substr(0, new_page.length - 1);
                    window.location.replace(new_page); 
                    return;
            }
            update_pager();

    })
}
function update_user_count()
{
    $('span#user-count').load('logic/ajax_target.php', {'func' : 'user_management_get_default_user_count' });
}
// init
    set_active_navbar_button('#user-management');  
    set_active_navbar_button('#management');
    set_active_sidebar_button('#sidebar-user-management');
    update_user();
// Validations
    $('.modal').on('hidden.bs.modal', function() {
        init_validation();
    });
    function trim_all_white_space(str) {
        return str.replace(/\s+/g, '');
    }
    function init_validation() {
       $('.form-group').removeClass('has-error'); 
    }
    function validate_insert_user() {
        user_name = $('#insert-user #user-name');
        password = $('#insert-user #password');
        parent_user_name = $('#insert-user #parent-user-name');
        ret = true;
        if (trim_all_white_space(user_name.val()).length == 0) {
            $('#insert-user #div-user-name').addClass('has-error');
            ret = false;
        }
        if(trim_all_white_space(password.val()).length == 0) {
           $('#insert-user #div-password').addClass('has-error');
           ret = false;
        }
        if(parent_user_name.val() == null || trim_all_white_space(parent_user_name.val()).length == 0) {
            $('#insert-user #div-parent-user-name').addClass('has-error');
            ret = false;
        }
        if (!ret)
        {
            generate_alert("#insert-user #alert", "alert-danger", "添加失败：信息填写不完整");
        }
        return ret;
    }
    function validate_update_user() {
        user_name = $('#update-user #user-name');
        change_password = ($("#update-user #change-password:checked").val() == "on")
        password = $('#update-user #password');
        parent_user_name = $('#update-user #parent-user-name');
        ret = true;
        if (trim_all_white_space(user_name.val()).length == 0) {
            $('#update-user #div-user-name').addClass('has-error');
            ret = false;
        }
        if(change_password && trim_all_white_space(password.val()).length == 0) {
           $('#update-user #div-password').addClass('has-error');
           ret = false;
        }
        if(parent_user_name.val() == null || trim_all_white_space(parent_user_name.val()).length == 0) {
            $('#update-user #div-parent-user-name').addClass('has-error');
            ret = false;
        }
        if (!ret)
        {
            generate_alert("#update-user #alert", "alert-danger", "添加失败：信息填写不完整");
        }
        return ret;
        
    }

//------ delete user scripts ------
    // global variable storing current user info for deletion
    var delete_user_id;
    var delete_user_name;
    // delete button clicks
    $(document).on("click", ".open-delete-user-dialog", function() {
        delete_user_id = $(this).data('id');
        load_user_info_on_delete_dialog();
    });
    // load user info on delete dialog
    function load_user_info_on_delete_dialog()
    {
        $.post('logic/ajax_target.php',
            {
                'func' : 'user_management_load_user_info',
                'user-id' : delete_user_id 
            },
            function (data, status)
            {
                if (status == "success")
                {
                    info = jQuery.parseJSON(data);
                    delete_user_name = info.user_name;
                    $('#delete-user #delete-user-name').html(delete_user_name);
                }
                else
                {
                    console.log("Error: load_user_info_on_delete_dialog");

                }
            });
    }
    // submit delete user 
    $('#delete-user-submit').click(function(event) {
        $.post('logic/ajax_target.php', {
            'func' : 'user_management_delete_user',
            'username' : delete_user_name
        }, function(data, status)
        {
            if (data.indexOf("SUCCESS") != -1)
            {
                generate_alert('#panel-user #alert', 'alert-success', '成功删除用户：' + delete_user_name);
                $('#delete-user').modal('hide');
            }
            else 
            {
                generate_alert('#delete-user #alert', 'alert-danger', '删除用户失败：用户已被删除或服务器错误'); 
            }
            update_user();
        });
    });
//------ insert user scripts ------
    // submit insert user
    $("#insert-user-submit").click(function(event) {
        init_validation();
        if (!validate_insert_user()) {
            return;
        }
        user_name = $("#insert-user #user-name").val();
        password = $("#insert-user #password").val();
        parent_user_name =  $("#insert-user #parent-user-name").val();
        $.post(
            'logic/ajax_target.php',
            {
                'func': 'user_management_insert_user',
                'user-name' : user_name,
                'password' : password,
                'parent-user-name' : parent_user_name
            },
            function(data, status) {
                if (data.indexOf("SUCCESS") != -1)
                {
                    generate_alert('#insert-user #alert', 'alert-success', '成功添加用户：' + user_name);
                }
                else 
                {
                    generate_alert('#insert-user #alert', 'alert-danger', '添加用户失败：用户已存在或服务器错误');
                }
                update_user();
            }
        );
    }); 
//------ update user scripts ------
    // global variable storing current user info for update 
    var update_user_id;
    var update_user_name;
    $(document).on("click", ".open-update-user-dialog", function() {
        update_user_id = $(this).data('id');
        load_user_info_on_update_dialog();
    });
    // load user info on update dialog
    function load_user_info_on_update_dialog()
    {
        $.post('logic/ajax_target.php',
            {
                'func' : 'user_management_load_user_info',
                'user-id' : update_user_id 
            },
            function (data, status)
            {
                if (status == "success")
                {
                    info = jQuery.parseJSON(data);
                    update_user_name = info.user_name;
                    $('#update-user #user-name').val(update_user_name);
                    $('#update-user #parent-user-name').val(info.parent_user_name);
                    $("#update-user #parent-user-name option[user-id="+update_user_id+"]").remove(); }
                    else
                {
                    console.log("Error: load_user_info_on_update_dialog");
                }
            });
    }
    $("#update-user #change-password").change( function(event) {
        if (this.checked) 
        {
            $("#update-user #password").removeAttr("disabled");
        }
        else
        {
            $("#update-user #password").attr("disabled", "");
        }
    });

    // submit update user
    $("#update-user-submit").click(function(event) {
        init_validation();
        if (!validate_update_user()) {
            return;
        }
        user_name = $("#update-user #user-name").val();
        password = "";
        if ($("#update-user #change-password:checked").val() == "on")
        {
            password = $("#update-user #password").val();
        }
        parent_user_name =  $("#update-user #parent-user-name").val();
        $.post(
            'logic/ajax_target.php',
            {
                'func': 'user_management_update_user',
                'user-id' : update_user_id,
                'user-name' : user_name,
                'password' : password,
                'parent-user-name' : parent_user_name
            },
            function(data, status) {
                if (data.indexOf("SUCCESS") != -1)
                {
                    generate_alert('#update-user #alert', 'alert-success', '成功更新用户：' + update_user_name);
                }
                else 
                {
                    generate_alert('#insert-user #alert', 'alert-danger', '更新用户失败：用户已被删除或服务器错误');
                }
                update_user();
                load_user_info_on_update_dialog();
            }
        );
    }); 


    // Ajax reload functions
    function update_user()
    {
        update_user_list();
        update_user_count();
        update_page_count();
        update_parent_options();
    }
    function update_user_list()
    {
        $('#panel-user #user-list').load('logic/ajax_target.php', {'func':'user_management_get_user_list', 'page': $.urlParam('page')});
    }
    function update_parent_options()
    {
        $('#insert-user #parent-user-name').load('logic/ajax_target.php', {'func' : 'user_management_get_parent_options'});
        $('#update-user #parent-user-name').load('logic/ajax_target.php', {'func' : 'user_management_get_parent_options', 'exclude-user-id': update_user_id});
    }
});
