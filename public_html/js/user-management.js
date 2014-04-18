$(document).ready(function() {
// init
    set_active_navbar_button('#user-management');  
    set_active_navbar_button('#management');
    update_user();

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
                    update_user();
                }
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
        user_name = $("#update-user #user-name").val();
        if ($("#update-user #change-password").attr('checked'))
        {
            password = $("#update-user #password").val();
        }
        else
        {
            password = "";
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
            }
        );
    }); 


    // Ajax reload functions
    function update_user()
    {
        update_user_list();
        update_parent_options();
    }
    function update_user_list()
    {
        $('#panel-user #user-list').load('logic/ajax_target.php', {'func':'user_management_get_user_list'});
    }
    function update_parent_options()
    {
        $('#insert-user #parent-user-name').load('logic/ajax_target.php', {'func' : 'user_management_get_parent_options'});
        $('#update-user #parent-user-name').load('logic/ajax_target.php', {'func' : 'user_management_get_parent_options', 'exclude-user-id': update_user_id});
    }
});
