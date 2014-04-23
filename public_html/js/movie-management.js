$(document).ready(function() {
// --BEG Pagers
// Film
$('#current-page-film').keypress(function(e) {
    if (e.which == 13) {
        vars = getUrlVars();
        vars['film-page'] = vars['film-page'].replace('#', '');
        vars['film-page'] = Number($('#current-page-film').val());
        new_page = 'movie-management.php?';
        jQuery.each(vars, function(index, key) {
            new_page = new_page + key + "=" + vars[key] + '&';
        });
        new_page = new_page.substr(0, new_page.length - 1);
        window.location.replace(new_page);
    }
});
$('#current-page-chain').keypress(function(e) {
    if (e.which == 13) {
        vars = getUrlVars();
        vars['chain-page'] = vars['film-page'].replace('#', '');
        vars['chain-page'] = Number($('#current-page-chain').val());
        new_page = 'movie-management.php?';
        jQuery.each(vars, function(index, key) {
            new_page = new_page + key + "=" + vars[key] + '&';
        });
        new_page = new_page.substr(0, new_page.length - 1);
        window.location.replace(new_page);
    }
});

$('li#previous-film').click(function() {
    if ($('li#previous-film').hasClass('disabled')) return;
    vars = getUrlVars();
    vars['film-page'] = vars['film-page'].replace('#', '');
    vars['film-page'] = Number(vars['film-page']) - 1;
    new_page = 'movie-management.php?';
    jQuery.each(vars, function(index, key) {
        new_page = new_page + key + "=" + vars[key] + '&';
    });
    new_page = new_page.substr(0, new_page.length - 1);
    window.location.replace(new_page);
});
$('li#next-film').click(function() {
    if($('li#next-film').hasClass('disabled')) return;
    vars = getUrlVars();
    vars['film-page'] = vars['film-page'].replace('#', '');
    vars['film-page'] = Number(vars['film-page']) + 1;
    new_page = 'movie-management.php?';
    jQuery.each(vars, function(index, key) {
        new_page = new_page + key + "=" + vars[key] + '&';
    });
    new_page = new_page.substr(0, new_page.length - 1);
    window.location.replace(new_page);
});
if($("span#film-count").text() == "") {
    update_film_count();
}
if($("span#page-count-film").text() == "") {
    update_page_count_film();
}
function update_pager_film()
{
    if($.urlParam('film-page') != null && Number($.urlParam('film-page')) == 1)
    {
        $('li#previous-film').addClass('disabled');
    } else {
        $('li#previous-film').removeClass('disabled');
    }
    if($.urlParam('film-page') != null && Number($.urlParam('film-page')) == Number($("span#page-count-film").text())) {
        $('li#next-film').addClass('disabled');
    } else {
        $('li#next-film').removeClass('disabled');
    }
}
function update_page_count_film()
{
    $('span#page-count-film').load('logic/ajax_target.php', {'func' : 'movie_management_get_default_page_count_film'}, function() {
        if (Number($('span#page-count-film').text()) < Number($('input#current-page-film').val())) {
            vars = getUrlVars();
            vars['film-page'] = vars['film-page'].replace('#', '');
            vars['film-page'] = Number($('span#page-count-film').text());
            new_page = "movie-management.php?";
            jQuery.each(vars, function(index, key) {
                new_page = new_page + key + "=" + vars[key] + '&';
            });
            new_page = new_page.substr(0, new_page.length - 1);
            window.location.replace(new_page);
            return;
        }
        update_pager_film();
    });
}
function update_film_count()
{
    $('span#film-count').load('logic/ajax_target.php', {'func' : 'movie_management_get_default_film_count' });
}


// - Chain
$('li#previous-chain').click(function() {
    if ($('li#previous-chain').hasClass('disabled')) return;
    vars = getUrlVars();
    vars['chain-page'] = vars['chain-page'].replace('#', '');
    vars['chain-page'] = Number(vars['chain-page']) - 1;
    new_page = 'movie-management.php?';
    jQuery.each(vars, function(index, key) {
        new_page = new_page + key + "=" + vars[key] + '&';
    });
    new_page = new_page.substr(0, new_page.length - 1);
    window.location.replace(new_page);
});
$('li#next-chain').click(function() {
    if($('li#next-chain').hasClass('disabled')) return;
    vars = getUrlVars();
    vars['chain-page'] = vars['chain-page'].replace('#', '');
    vars['chain-page'] = Number(vars['chain-page']) + 1;
    new_page = 'movie-management.php?';
    jQuery.each(vars, function(index, key) {
        new_page = new_page + key + "=" + vars[key] + '&';
    });
    new_page = new_page.substr(0, new_page.length - 1);
    window.location.replace(new_page);
});
if($("span#chain-count").text() == "") {
    update_chain_count();
}
if($("span#page-count-chain").text() == "") {
    update_page_count_chain();
}
function update_pager_chain()
{
    if($.urlParam('chain-page') != null && Number($.urlParam('chain-page')) == 1)
    {
        $('li#previous-chain').addClass('disabled');
    } else {
        $('li#previous-chain').removeClass('disabled');
    }
    if($.urlParam('chain-page') != null && Number($.urlParam('chain-page')) == Number($("span#page-count-chain").text())) {
        $('li#next-chain').addClass('disabled');
    } else {
        $('li#next-chain').removeClass('disabled');
    }
}
function update_page_count_chain()
{
    $('span#page-count-chain').load('logic/ajax_target.php', {'func' : 'movie_management_get_default_page_count_chain'}, function() {
        if (Number($('span#page-count-chain').text()) < Number($('input#current-page-chain').val())) {
            vars = getUrlVars();
            vars['chain-page'] = vars['chain-page'].replace('#', '');
            vars['chain-page'] = Number($('span#page-count-chain').text());
            new_page = "movie-management.php?";
            jQuery.each(vars, function(index, key) {
                new_page = new_page + key + "=" + vars[key] + '&';
            });
            new_page = new_page.substr(0, new_page.length - 1);
            window.location.replace(new_page);
            return;
        }
        update_pager_chain();
    });
}
function update_chain_count()
{
    $('span#chain-count').load('logic/ajax_target.php', {'func' : 'movie_management_get_default_chain_count' });
}

// -- END Pagers
    set_active_navbar_button('#movie-management');  
    set_active_navbar_button('#management');
    set_active_sidebar_button('#sidebar-movie-management');
    update_chain();
    update_film();
    var update_film_id;
    var delete_film_id;
    var update_chain_id;
    var delete_chain_id;
    $("#alert").fadeOut();

    $('.modal').on('hidden.bs.modal', function () {
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
        $("#chain-list").load('logic/ajax_target.php', {'func' : 'movie_management_get_chain_list', 'chain-page': $.urlParam('chain-page')}, function() { update_chain_count(); update_page_count_chain();  });
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
        $("#film-list").load('logic/ajax_target.php', {'func' : 'movie_management_get_film_list', 'film-page' : $.urlParam('film-page')}, function() { update_film_count(); update_page_count_film();});
    }
    function validate_update_film()
    {
        film_name = $("#update-film #film-name");
        film_userdefine_id = $("#update-film #film-userdefine-id");
        chain_name = $("#update-film #chain-name");
        film_path = $("#update-film #film-path");
        ret = true;
        if (trim_all_white_space(film_name.val()).length == 0)
        {
            $("#update-film #div-film-name").addClass("has-error");
            ret = false;
        }
        if(trim_all_white_space(film_userdefine_id.val()).length == 0)
        {
            $("#update-film #div-film-userdefine-id").addClass("has-error");
            ret = false; 
        }
        if(chain_name.val() == null || trim_all_white_space(chain_name.val()).length == 0)
        {
            $("#update-film #div-chain-name").addClass("has-error");
            ret = false;
        }
        if (trim_all_white_space(film_path.val()).length == 0)
        {
            $("#update-film #div-film-path").addClass("has-error");
            ret = false;
        }
        if (!ret)
        {
            generate_alert("#update-film #alert", "alert-danger", "更新失败：信息填写不完整");

        }
        return ret;
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
function validate_update_chain()
    {
        chain_name = $('#update-chain #chain-name');
        ret = true;
        if (trim_all_white_space(chain_name.val()).length  == 0)
        {
            $('#update-chain #div-chain-name').addClass("has-error");
            ret = false;
        }
        if (!ret)
        {
             generate_alert("#update-chain #alert", "alert-danger", "更新失败：信息填写不完整");

        }
        return ret;
    }


    function init_validation()
    {
        $('.form-group').removeClass('has-error');
        
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
    $(document).on("click", ".open-update-chain-dialog", function() {
        chain_id = $(this).data('id');
        update_chain_id = chain_id;
        load_chain_info_on_update_dialog(chain_id);
    });
    $(document).on("click", ".open-delete-film-dialog", function() {
        film_id = $(this).data('id');
        delete_film_id = film_id;
        load_film_info_on_delete_dialog(film_id);
    });
    $(document).on("click", ".open-delete-chain-dialog", function() {
        chain_id = $(this).data('id');
        delete_chain_id = chain_id;
        load_chain_info_on_delete_dialog(chain_id);
    });
    $('#update-film').on('shown.bs.modal', function() {
        //update_chain_name_options();
    });
    $("#delete-film-submit").click( function() {
        $.post('logic/ajax_target.php',
            {
                'func' : 'movie_management_delete_film',
            'film-id' : delete_film_id, 
            }, function(data, status) {
                if (data.indexOf('SUCCESS') != -1)
        {
            generate_alert("#panel-film #alert", "alert-success", "成功删除电影：" + $('#delete-film #delete-film-name').text());
            $('#delete-film').modal('hide');
            update_film();
            return;
        }
        generate_alert("#delete-film #alert", "alert-danger", "删除电影失败：电影可能已被删除或服务器发生错误" );

            });
    });

    $("#delete-chain-submit").click( function() {
        $.post('logic/ajax_target.php',
            {
                'func' : 'movie_management_delete_chain',
            'chain-id' : delete_chain_id, 
            }, function(data, status) {
                if (data.indexOf('SUCCESS') != -1)
        {
            generate_alert("#panel-chain #alert", "alert-success", "成功删除院线：" + $('#delete-chain #delete-chain-name').text());
            $('#delete-chain').modal('hide');
            update_chain();
            update_film();
            return;
        }
        generate_alert("#delete-chain #alert", "alert-danger", "删除院线失败：院线可能已被删除或服务器发生错误" );

            });
    });

    $("#update-film-submit").click( function() {
        init_validation();
        
        if(!validate_update_film())
    {
        return;
    }
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
            generate_alert("#update-film #alert", "alert-success", "成功更新电影：" + $('#update-film #film-name').val());
            update_film();
        } else 
        {
        }
            });
    });

    $("#update-chain-submit").click( function() {
        init_validation();
        if (!validate_update_chain())
    {
        return;
    }
        $.post('logic/ajax_target.php',
            {
                'func' : 'movie_management_update_chain',
            'chain-id' : update_chain_id,
            'chain-name' : $('#update-chain #chain-name').val(),
            }, function(data, status) {
                if (data.indexOf('SUCCESS') != -1)
        {
            generate_alert("#update-chain #alert", "alert-success", "成功更新院线：" + $('#update-chain #chain-name').val());
            update_chain();
        } else 
        {
            generate_alert("#update-chain #alert", "alert-danger", "更新失败：院线名已存在或服务器错误");
        }
            });
    });
    function load_chain_info_on_delete_dialog(chain_id)
    {
        $.post('logic/ajax_target.php',
                {
                    'func' : 'movie_management_load_chain_info',
            'chain-id' : chain_id
                },
                function (data, status)
                {
                    info = jQuery.parseJSON(data);
                    if (status == 'success')
        {
            $('#delete-chain #delete-chain-name').html(info.chain_name);
        }
                });
    }
    function load_film_info_on_delete_dialog(film_id)
    {
        $.post('logic/ajax_target.php',
                {
                    'func' : 'movie_management_load_film_info',
            'film-id' : film_id
                },
                function (data, status)
                {
                    info = jQuery.parseJSON(data);
                    if (status == 'success')
        {
            $('#delete-film #delete-film-name').html(info.film_name);
        }
                }
              );
    }
    function load_chain_info_on_update_dialog(chain_id)
    {
        $.post('logic/ajax_target.php',
                {
                    'func' : 'movie_management_load_chain_info',
        'chain-id' : chain_id
                },
                function(data, status)
                {
                    info = jQuery.parseJSON(data);
                    if (status == 'success')
        {
            $('#update-chain #chain-name').val(info.chain_name);
        }
                }
              );
    }
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



