$(document).ready(function() {
    set_active_navbar_button('#movie-management');  
    set_active_navbar_button('#management');
    update_chain();
    update_film();
    $("#alert").fadeOut();

    $('#insert-film').on('hidden.bs.modal', function () {
        $('#insert-film .form-group').removeClass('has-error');
   });
    $("#insert-film-submit").click(function(event) {
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
            generate_alert("#insert-chain #alert", "alert-error", "添加失败：服务器错误");

        }
            });
    });
    $("#insert-chain-submit").click(function(event) {
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
            update_chain();
            generate_alert("#insert-chain #alert", "alert-success", "成功添加院线：" + $('#insert-chain #chain-name').val());
        }
            else 
        {
            generate_alert("#insert-chain #alert", "alert-danger", "添加失败：院线已存在");
        }
        }
                else {
                    generate_alert("#insert-chain #alert", "alert-error", "添加失败：服务器错误");
                }
            }
        );
    });
    function update_chain()
    {
        update_chain_list();
        update_chain_name_options();
    }
    function update_chain_list()
    {
        $("#chain-list").load('logic/ajax_target.php', {'func' : 'movie_management_get_chain_list'});
    }
    function update_chain_name_options()
    {
        $("#insert-film #chain-name").load('logic/ajax_target.php', {'func' : 'movie_management_get_chain_name_options'});
    }

    function update_film()
    {
        update_film_list();
    }
    function update_film_list()
    {
        $("#film-list").load('logic/ajax_target.php', {'func' : 'movie_management_get_film_list'});
    }
    function generate_alert(selector, type, message)
    {
        $(selector).load('logic/ajax_target.php', {'func' : 'utils_generate_alert','type' : type, 'message' : message});
        $(selector).fadeIn();
        window.setTimeout(function() { $(selector).fadeOut(); }, 2000);
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
         if(trim_all_white_space(chain_name.val()).length == 0)
         {
             $("#div-chain-name").addClass("has-error");
             ret = false;
         }
         if (trim_all_white_space(film_path.val()).length == 0)
         {
             $("#div-film-path").addClass("has-error");
             ret = false;
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
        return ret;
    }

    function trim_all_white_space(str)
    {
        return str.replace(/\s+/g, '');
    }
});


