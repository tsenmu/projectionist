$(document).ready(function() {
    set_active_navbar_button('#home');  
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });    
    record_update_chain();
    record_update_user();

   $('#search-record-submit').click( function(){
        film_name = $("#search-record #film-name").val();
        chain_name = $("#search-record #chain-name").val();
        date_time_begin = $("#search-record #date-time-begin").val();
        date_time_end = $("#search-record #date-time-end").val();
        the_location = $("#search-record #location").val();
        user_name = $("#search-record #user-name").val();
        window.location.replace("records.php?search=1&film="+film_name+"&chain="+chain_name+"&from="+date_time_begin+"&to="+date_time_end+"&location="+the_location+"&user="+user_name+"&page=1"); 
    });
 function record_update_film()
    {
        record_update_film_options();
    }
    $('#insert-record #chain-name').change( function (){
        record_update_film_options();
    });
    $('#update-record #chain-name').change( function() {
        record_update_film_options();
    });
    function record_update_film_options()
    {
        $('#insert-record #film-name').load('logic/ajax_target.php', {'func': 'records_get_film_options', 'chain-name': $('#insert-record #chain-name').val() });
        $('#update-record #film-name').load('logic/ajax_target.php', {'func': 'records_get_film_options', 'chain-name': $('#update-record #chain-name').val() });
    }
    function record_update_chain()
    {
        record_update_chain_options();
    }
    function record_update_user()
    {
        record_update_user_name_options();
    }
    function record_update_chain_options()
    {
        $('#insert-record #chain-name').load('logic/ajax_target.php', {'func' : 'records_get_chain_options' });
        $('#update-record #chain-name').load('logic/ajax_target.php', {'func' : 'records_get_chain_options' });
    }
    function record_update_user_name_options()
    {
        $('#insert-record #user-name').load('logic/ajax_target.php', {'func' : 'records_get_user_name_options'});
        $('#update-record #user-name').load('logic/ajax_target.php', {'func' : 'records_get_user_name_options'});
    }
    $("#insert-record-submit").click(function(event) {
        init_validation();
        if (!validate_insert_record()) {
            return;
        }
        film_name = $("#insert-record #film-name").val();
        chain_name = $("#insert-record #chain-name").val();
        date_time = $("#insert-record #date-time").val();
        the_location = $("#insert-record #location").val();
        user_name = $("#insert-record #user-name").val();
        $.post(
            "logic/ajax_target.php",
            {
                'func' : 'records_insert_record',
            'film-name' : film_name,
            'chain-name' : chain_name,
            'date-time' : date_time,
            'location' : the_location,
            'user-name' : user_name
            },
            function(data, status) {
                console.log(data);
                if (data.indexOf('SUCCESS') != -1) {
                    generate_alert('#insert-record #alert', 'alert-success', '记录添加成功');
                    update_record();
                }
                else{
                    generate_alert('#insert-record #alert', 'alert-danger', '记录添加失败：不匹配的电影和院线记录或服务器发生错误');
                }
            }
            );
    });
    function trim_all_white_space(str) {
        return str.replace(/\s+/g, '');
    }
   function validate_insert_record()
    {
        chain_name = $('#insert-record #chain-name');
        film_name = $('#insert-record #film-name');
        user_name = $('#insert-record #user-name');
        date_time = $('#insert-record #date-time');
        the_location = $('#insert-record #location');
        ret = true;
        if (chain_name.val() == null || trim_all_white_space(chain_name.val()).length == 0) {
            $('#insert-record #div-chain-name').addClass('has-error');
            ret = false;
        }

        if (film_name.val() == null || trim_all_white_space(film_name.val()).length == 0) {
            $('#insert-record #div-film-name').addClass('has-error');
            ret = false;
        }
        if (user_name.val() == null || trim_all_white_space(user_name.val()).length == 0) {
            $('#insert-record #div-user-name').addClass('has-error');
            ret = false;
        }
        if (trim_all_white_space(date_time.val()).length == 0) {
            $('#insert-record #div-date-time').addClass('has-error');
            ret = false;
        }
        if (trim_all_white_space(the_location.val()).length == 0) {
            $('#insert-record #div-location').addClass('has-error');
            ret = false;
        }
        if (!ret) {
            generate_alert('#insert-record #alert', 'alert-danger', '添加失败：信息填写不完整');
        }
        return ret;
    }
$(document).on('click', '.open-insert-record-dialog', function() {
        record_update_film_options();
    });
   $('.modal').on('hidden.bs.modal', function() {
        init_validation(); 
    });
    function init_validation()
    {
        $('.form-group').removeClass('has-error');
    }
//-------------------------------------------------------------------------------
    movie_update_chain();
    $("#alert").fadeOut();

    $("#insert-film-submit").click(function(event) {
        init_validation();
        if(!validate_insert_film())
    {
        return;
    }
    $.post('logic/ajax_target.php',
        {
            'func' : 'movie_management_insert_film',
        'film-name' : $("#film-name").val(),
        'film-userdefine-id' : $("#film-userdefine-id").val(),
        'chain-name' : $('#chain-name option:selected').text(),
        'film-path' : $('#film-path').val()
        },
        function(data, status)
        {
            if (status == "success")
    {
        if (data.indexOf('INSERT_FILM_SUCCESS') != -1)
    {
        update_film();
        generate_alert("#insert-film #alert", "alert-success", "成功添加电影：" + $('#insert-film #film-name').val());
    }
        else {
            generate_alert("#insert-chain #alert", "alert-danger", "添加失败：电影已存在");

        }
    } else {
        generate_alert("#insert-chain #alert", "alert-danger", "添加失败：服务器错误");

    }
        });
    });
    $("#insert-chain-submit").click(function(event) {
        init_validation();
        if (!validate_insert_chain())
    {
        return;
    }
    $.post("logic/ajax_target.php", 
        {
            'func' : 'movie_management_insert_chain',
        'chain-name' : $('#insert-chain #chain-name').val()
        },
        function(data, status) {
            console.log(data);
            if(status == "success")
    {
        if (data.indexOf('INSERT_CHAIN_SUCCESS') != -1)
    {
        movie_update_chain();
        record_update_chain();
        generate_alert("#insert-chain #alert", "alert-success", "成功添加院线：" + $('#insert-chain #chain-name').val());
    }
        else 
    {
        generate_alert("#insert-chain #alert", "alert-danger", "添加失败：院线已存在");
    }
    }
            else {
                generate_alert("#insert-chain #alert", "alert-danger", "添加失败：服务器错误");
            }
        }
    );
    });
    function movie_update_chain()
    {
        movie_update_chain_name_options();
    }
    function movie_update_chain_name_options()
    {
        $("#insert-film #chain-name").load('logic/ajax_target.php', {'func' : 'movie_management_get_chain_name_options'});
        $("#update-film #chain-name").load('logic/ajax_target.php', {'func' : 'movie_management_get_chain_name_options'});

    }

         
    function validate_insert_film()
    {
        film_name = $("#insert-film #film-name");
        film_userdefine_id = $("#insert-film #film-userdefine-id");
        chain_name = $("#insert-film #chain-name");
        film_path = $("#insert-film #film-path");
        ret = true;
        if (trim_all_white_space(film_name.val()).length == 0)
        {
            $("#div-film-name").addClass("has-error");
            ret = false;
        }
        if(trim_all_white_space(film_userdefine_id.val()).length == 0)
        {
            $("#div-film-userdefine-id").addClass("has-error");
            ret = false; 
        }
        if(chain_name.val() == null || trim_all_white_space(chain_name.val()).length == 0)
        {
            $("#div-chain-name").addClass("has-error");
            ret = false;
        }
        if (trim_all_white_space(film_path.val()).length == 0)
        {
            $("#div-film-path").addClass("has-error");
            ret = false;
        }
        if (!ret)
        {
            generate_alert("#insert-film #alert", "alert-danger", "添加失败：信息填写不完整");

        }
        return ret;
    }
    function validate_insert_chain()
    {
        chain_name = $('#insert-chain #chain-name');
        ret = true;
        if (trim_all_white_space(chain_name.val()).length  == 0)
        {
            $('#insert-chain #div-chain-name').addClass("has-error");
            ret = false;
        }
        if (!ret)
        {
             generate_alert("#insert-chain #alert", "alert-danger", "添加失败：信息填写不完整");

        }
        return ret;
    }
//---------------------------------------------------------   

    user_update_user();
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
                user_update_user();
                record_update_user_name_options();
            }
        );
    }); 

    // Ajax reload functions
    function user_update_user()
    {
        update_parent_options();
    }
    function update_parent_options()
    {
        $('#insert-user #parent-user-name').load('logic/ajax_target.php', {'func' : 'user_management_get_parent_options'});
    }

});
       



