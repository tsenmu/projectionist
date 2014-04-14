$(document).ready(function() {
    $("#insert-submit").click(function(event) {
        event.preventDefault();
        insert_movie = $("#insert-movie").val();
        insert_chain= $("#insert-chain").val();
        insert_date_time = $("#insert-date-time").val();
        insert_location = $("#insert-location").val();
        insert_user_id = $("#insert-user-id").val();
        console.log(insert_movie);
        console.log(insert_chain);
        console.log(insert_date_time);
        console.log(insert_location);
        console.log(insert_user_id);
        $.ajax( {
            url: "logic/records.php",
            type: "POST",
            data: {
                'type' : 'insert',
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
});
