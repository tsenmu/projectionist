$(document).ready(function() {
    $("#submit").click(function(event) {
        event.preventDefault();
        $.ajax( {
            url: "logic/validate.php",
            type: "POST",
            data: {
                'username' : $("#username").val(), 
                'password' : $("#password").val(),
                'remember' : $("#remember").prop('checked')
            },
            success: function(data, status) {
                $("#username_field").removeClass("error");
                $("#password_field").removeClass("error");
                if(data.indexOf("SUCCESS") != -1) {
                    window.location = "records.php";
                } else if (data.indexOf("ERROR_USER_NAME") != -1) {
                    $("#username_field").addClass("error");
                } else if (data.indexOf("ERROR_USER_PASSWORD") != -1) {
                    $("#password_field").addClass("error"); 
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
                alert("服务器发生错误，请联系管理员");
            }
        }); 
    });
});
