$(document).ready(function() {
    $("#insert-submit").click(function(event) {
        event.preventDefault();
        insert_username = $("#insert-username").val();
        insert_password = $("#insert-password").val();
        insert_parent =  $("#insert-parent").val();
        $.ajax( {
            url: "logic/user_management.php",
            type: "POST",
            data: {
                'type' : 'insert',
                'username' : insert_username,
                'password' : insert_password,
                'parent' : insert_parent
            },
            success: function(data, status) {
                console.log(data);
                if (data.indexOf('INSERT_USER_SUCCESS') != -1) {
                    alert("添加成功");
                    $("#insert-user").modal('hide');
                }
                else if(data.indexOf('ERROR_USER_EXIST') != -1) {
                    alert("用户已存在，添加失败");
                }
                else {
                    alert("未知错误，添加失败");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log("error");
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
});
