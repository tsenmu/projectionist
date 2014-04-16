$(document).ready(function() {
    set_active_navbar_button('#user-management');  
    set_active_navbar_button('#management');
    update_user();
    var update_user_id;
    var delete_user_id;
    function load_user_info_on_delete_dialog(user_id)
    {
        $.post('logic/ajax_target.php',
            {
                'func' : 'user_management_load_user_info',
                'user-id' : delete_user_id 
            },
            function (data, status)
            {
                info = jQuery.parseJSON(data);
                if (status == "success")
                {
                    $('#delete-user #delete-user-name').html(info.user_name);
                }
            });
    }
    $(document).on("click", ".open-delete-user-dialog", function() {
        delete_user_id = $(this).data('id');
        load_user_info_on_delete_dialog(delete_user_id);
    });
    $('#delete-user-submit').click(function(event) {
        console.log("aaaaa");
        delete_username = $("#delete-user #delete-user-name").text(); 
        $.post('logic/ajax_target.php', {
            'func' : 'user_management_delete_user',
            'username' : delete_username
        }, function(data, status)
        {
            if (data.indexOf("SUCCESS") != -1)
            {

 generate_alert('#panel-user #alert', 'alert-success', '成功删除用户：' + $("#delete-user #delete-user-name").text());
            $('#delete-user').modal('hide');
            }
        });
    });
    $("#insert-user-submit").click(function(event) {
        insert_username = $("#insert-username").val();
        insert_password = $("#insert-password").val();
        insert_parent =  $("#insert-parent").val();
        $.post('logic/ajax_target.php', {
            'func': 'user_management_insert_user',
            'username' : insert_username,
            'password' : insert_password,
            'parent' : insert_parent
        }, function(data, status) {
            if (data.indexOf("SUCCESS") != -1)
        {
            generate_alert('#insert-user #alert', 'alert-success', '成功添加用户：' + insert_username);
            update_user();
        }
            else 
        {
            generate_alert('#insert-user #alert', 'alert-danger', '添加用户失败：用户已存在或服务器错误');

            update_user();
        }
        });
    }); 


    $("#delete-submit").click(function(event) {
        event.preventDefault();
        delete_username = $("#delete-username").val();
        console.log(delete_username);
        $.ajax( {
            url: "logic/user_management.php",
            type: "POST",
            data: {
                'type' : 'delete',
            'username' : delete_username 
            },
            success: function(data, status) {
                if (data.indexOf('DELETE_USER_SUCCESS') != -1) {
                    alert("删除成功");
                    $("#delete-user").modal('hide');
                }
                else if(data.indexOf('ERROR_USER_NOT_EXIST') != -1) {
                    alert("用户不存在，删除失败");
                }
                else {
                    alert("未知错误，删除失败");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log("error");
            }
        });
    });
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
        $('#insert-user #insert-parent').load('logic/ajax_target.php', {'func' : 'user_management_get_parent_options'});
    }

});
