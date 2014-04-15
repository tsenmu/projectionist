$(document).ready(function() {
    set_active_navbar_button('#movie-management');  
    set_active_navbar_button('#management');
    update_chain();
    update_film();
    var update_film_id;
    $("#alert").fadeOut();

    $('#insert-film').on('hidden.bs.modal', function () {
        init_validation();
   });
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
            update_chain();
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
    $("#update-film #chain-name").load('logic/ajax_target.php', {'func' : 'movie_management_get_chain_name_options'});
 
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
        return ret;
    }

    function init_validation()
    {
        console.log('init validation');
        $('#insert-film .form-group').removeClass('has-error');
        $('#insert-chain .form-group').removeClass('has-error');
    }
    function trim_all_white_space(str)
    {
        return str.replace(/\s+/g, '');
    }
    $(document).on("click", ".open-update-film-dialog", function() {
        film_id = $(this).data('id');
        update_film_id = film_id;
        load_film_info_on_update_dialog(film_id);
        
    });
    $('#update-film').on('shown.bs.modal', function() {
        //update_chain_name_options();
    });
    $("#update-film-submit").click( function() {
        
        console.log(update_film_id);
        $.post('logic/ajax_target.php',
            {
                'func' : 'movie_management_update_film',
                'film-id' : update_film_id, 
                'film-userdefine-id' : $("#update-film #film-userdefine-id").val(),
                'film-name': $('#update-film #film-name').val(),
                'film-path': $('#update-film #film-path').val(),
    'chain-name' : $('#update-film #chain-name option:selected').text(),
            }, function(data, status) {
                if (data.indexOf('SUCCESS') != -1)
                {
                    generate_alert('#update-film .alert')
generate_alert("#update-film #alert", "alert-success", "成功更新电影：" + $('#update-film #film-name').val());
                }
            });
    });
    function load_film_info_on_update_dialog(film_id)
    {
        update_chain_name_options();
        $.post('logic/ajax_target.php',
            {
                'func' : 'movie_management_load_film_info',
            'film-id' : film_id 
            },
            function(data, status)
            {
                info = jQuery.parseJSON(data);
                if (status == "success")
                {
                    $('#update-film #film-name').val(info.film_name);
                    $('#update-film #film-userdefine-id').val(info.film_userdefine_id);
                    $('#update-film #film-path').val(info.film_path);
                    $('#update-film #chain-name')
                    $("#update-film #chain-name option:contains(" + info.chain_name + ")").attr('selected', 'selected'); 
                }
                else 
                {
                    log.console(data);
                }
            }
        );
    }
});



