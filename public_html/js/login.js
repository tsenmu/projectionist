$(document).ready(function() {
    $("#submit").click(function(event) {
        event.preventDefault();
        $.ajax( {
            url: "logic/validate.php",
            type: "POST",
            data: {
                'username' : $("#username").val(), 
                'password' : $("#password").val()
            },
            success: function() {
                alert("success");
                $("#feedback").html("success");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#feedback").html(thrownError); 
            }
        }); 
    });
});
